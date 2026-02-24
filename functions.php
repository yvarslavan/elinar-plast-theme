<?php

/**
 * ============================================================================
 * CONFIGURATION CONSTANTS
 * ============================================================================
 */
if (!defined('ELINAR_OPT_LOCAL_FONTS')) define('ELINAR_OPT_LOCAL_FONTS', false);
if (!defined('ELINAR_OPT_GLIGHTBOX_FOOTER')) define('ELINAR_OPT_GLIGHTBOX_FOOTER', true);
if (!defined('ELINAR_OPT_OPERA_FIX_EXTERNAL')) define('ELINAR_OPT_OPERA_FIX_EXTERNAL', false);
if (!defined('ELINAR_OPT_FRONT_PAGE_ASSETS')) define('ELINAR_OPT_FRONT_PAGE_ASSETS', true);
if (!defined('ELINAR_OPT_DEFER_SCRIPTS')) define('ELINAR_OPT_DEFER_SCRIPTS', true);
if (!defined('ELINAR_OPT_RESOURCE_HINTS')) define('ELINAR_OPT_RESOURCE_HINTS', true);
if (!defined('ELINAR_OPT_DEFER_NONCRIT_CSS')) define('ELINAR_OPT_DEFER_NONCRIT_CSS', false);
if (!defined('ELINAR_OPT_ASYNC_MAIN_CSS')) define('ELINAR_OPT_ASYNC_MAIN_CSS', false);
if (!defined('ELINAR_OPT_ASYNC_FONTS')) define('ELINAR_OPT_ASYNC_FONTS', true);

/**
 * ============================================================================
 * UNIVERSAL PROJECT FORM HANDLER (audit-form-section.php)
 * Обрабатывает форму "Запросить инженерную оценку" на всех страницах
 * ============================================================================
 */
add_action('init', 'elinar_handle_project_form_universal');
function elinar_handle_project_form_universal()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['project_form_submit'])) {
        return;
    }

    // Получаем URL текущей страницы для редиректа
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $uri = strtok($_SERVER['REQUEST_URI'], '?'); // Убираем query string
    $redirect_base = $protocol . '://' . $host . $uri;

    // CSRF защита
    if (!isset($_POST['project_form_nonce']) || !wp_verify_nonce($_POST['project_form_nonce'], 'elinar_project_form')) {
        wp_redirect($redirect_base . '?form=error&field=security#contact-form');
        exit;
    }

    // Honeypot проверка
    if (!empty($_POST['website_url'])) {
        wp_redirect($redirect_base . '?form=spam#contact-form');
        exit;
    }

    $name = sanitize_text_field($_POST['name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Валидация
    $error = '';
    if (empty($name)) {
        $error = 'name';
    } elseif (empty($phone) || strlen(preg_replace('/\D/', '', $phone)) < 11) {
        $error = 'phone';
    } elseif (empty($email) || !is_email($email)) {
        $error = 'email';
    }

    if ($error) {
        wp_redirect($redirect_base . '?form=error&field=' . $error . '#contact-form');
        exit;
    }

    // Обработка файлов (множественная загрузка)
    $attachment_paths = array();
    $attachment_names = array();

    if (!empty($_FILES['attachment']) && is_array($_FILES['attachment']['name'])) {
        $files = $_FILES['attachment'];
        $allowed_extensions = array('pdf', 'dwg', 'dxf', 'jpg', 'jpeg', 'png', 'zip', 'step', 'stp', 'iges', 'igs', 'stl');
        $max_size = 15 * 1024 * 1024; // 15 MB per file
        $max_files = 5;

        // Подготовка директории для загрузки
        $upload_dir = wp_upload_dir();
        $temp_dir = $upload_dir['basedir'] . '/project-forms/';

        if (!file_exists($temp_dir)) {
            wp_mkdir_p($temp_dir);
            // Баг #4: закрываем прямой доступ по URL — чертежи клиентов конфиденциальны
            file_put_contents($temp_dir . '.htaccess', "Options -Indexes\nDeny from all\n");
        }

        // Обработка каждого файла
        $file_count = is_array($files['name']) ? count($files['name']) : 1;

        // Если files['name'] - строка, значит один файл
        if (!is_array($files['name'])) {
            $files = array(
                'name' => array($files['name']),
                'type' => array($files['type']),
                'tmp_name' => array($files['tmp_name']),
                'error' => array($files['error']),
                'size' => array($files['size'])
            );
            $file_count = 1;
        }

        if ($file_count > $max_files) {
            wp_redirect($redirect_base . '?form=error&field=file_count#contact-form');
            exit;
        }

        for ($i = 0; $i < $file_count; $i++) {
            // Пропускаем, если файл не загружен
            if (empty($files['name'][$i]) || $files['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }

            $file_name = $files['name'][$i];
            $file_tmp = $files['tmp_name'][$i];
            $file_size = $files['size'][$i];

            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Проверка расширения по белому списку
            if (!in_array($file_ext, $allowed_extensions)) {
                wp_redirect($redirect_base . '?form=error&field=file_type#contact-form');
                exit;
            }

            // Баг #5: проверка реального MIME-типа (защита от переименованных shell-файлов)
            $mime_check = wp_check_filetype_and_ext($file_tmp, $file_name);
            if (!empty($mime_check['ext']) && !in_array(strtolower($mime_check['ext']), $allowed_extensions)) {
                wp_redirect($redirect_base . '?form=error&field=file_type#contact-form');
                exit;
            }

            // Проверка размера
            if ($file_size > $max_size) {
                wp_redirect($redirect_base . '?form=error&field=file_size#contact-form');
                exit;
            }

            // Сохранение файла
            $safe_filename = sanitize_file_name($file_name);
            $unique_filename = time() . '_' . $i . '_' . $safe_filename;
            $attachment_path = $temp_dir . $unique_filename;

            if (move_uploaded_file($file_tmp, $attachment_path)) {
                $attachment_paths[] = $attachment_path;
                $attachment_names[] = $file_name;
            }
        }
    }

    // Определяем страницу источника
    $uri_lower = strtolower($uri);
    $page_source = 'сайта';
    if (strpos($uri_lower, 'product') !== false || strpos($uri_lower, 'продукц') !== false) {
        $page_source = 'страницы Продукция';
    } elseif (strpos($uri_lower, 'about') !== false || strpos($uri_lower, 'компани') !== false) {
        $page_source = 'страницы О компании';
    } elseif (strpos($uri_lower, 'technolog') !== false || strpos($uri_lower, 'производств') !== false) {
        $page_source = 'страницы Технологии';
    } elseif ($uri === '/' || $uri === '' || $uri_lower === '/index.php') {
        $page_source = 'главной страницы';
    }

    // Формируем письмо
    // Баг #14: заменяем date() на wp_date() — учитывает часовой пояс из настроек WP (Москва UTC+3)
    $request_id = 'PRJ-' . wp_date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));
    $formatted_date = wp_date('d.m.Y H:i');

    $email_body = "НОВАЯ ЗАЯВКА С {$page_source}\n";
    $email_body .= "Номер заявки: {$request_id}\n\n";
    $email_body .= "КОНТАКТНЫЕ ДАННЫЕ\n";
    $email_body .= "Имя: {$name}\n";
    $email_body .= "Телефон: {$phone}\n";
    $email_body .= "Email: {$email}\n\n";

    if (!empty($message)) {
        $email_body .= "ОПИСАНИЕ ПРОЕКТА\n{$message}\n\n";
    }

    if (!empty($attachment_names)) {
        $email_body .= "ПРИКРЕПЛЕННЫЕ ФАЙЛЫ:\n";
        // Баг #1: переименовано $name → $attachment_name (конфликт с именем клиента в $subject)
        foreach ($attachment_names as $attachment_name) {
            $email_body .= "  - {$attachment_name}\n";
        }
        $email_body .= "\n";
    }

    $email_body .= "Дата: {$formatted_date}\n";
    $email_body .= "URL страницы: {$redirect_base}\n";

    $subject = "Новая заявка с {$page_source}: {$name}";
    $headers = elinar_build_mail_headers($email);

    $attachments = array();
    if (!empty($attachment_paths)) {
        foreach ($attachment_paths as $path) {
            if (file_exists($path)) {
                $attachments[] = $path;
            }
        }
    }

    // Email-адреса из конфигурации с fallback на значения по умолчанию
    $primary_email = elinar_get_primary_email();
    $copy_email = elinar_get_copy_email();

    // Telegram отправляем в первую очередь, чтобы дубль не зависел от SMTP таймаутов
    $telegram_sent = elinar_send_telegram_notification(array(
        'name'            => $name,
        'phone'           => $phone,
        'email'           => $email,
        'message'         => $message,
        'attachment_paths' => $attachment_paths,
        'attachment_names' => $attachment_names,
        'page_source'     => $page_source,
        'request_id'      => $request_id,
        'page_url'        => $redirect_base,
    ));

    // Отправка на основной адрес (с fallback на mail() без вложений)
    $primary_send = elinar_send_mail_with_fallback($primary_email, $subject, $email_body, $headers, $attachments, $email);
    $mail_sent = !empty($primary_send['sent']);

    // Независимая отправка копии на резервный адрес
    elinar_send_mail_with_fallback($copy_email, $subject, $email_body, $headers, $attachments, $email);

    elinar_delivery_log('project_form_universal', array(
        'request_id' => $request_id,
        'mail_sent' => (bool) $mail_sent,
        'mail_via' => isset($primary_send['via']) ? (string) $primary_send['via'] : '',
        'wp_mail_error' => isset($primary_send['wp_mail_error']) ? (string) $primary_send['wp_mail_error'] : '',
        'telegram_sent' => (bool) $telegram_sent,
        'attachments_count' => count($attachments),
    ));

    // Удаляем временные файлы
    if (!empty($attachment_paths)) {
        foreach ($attachment_paths as $path) {
            if (file_exists($path)) {
                @unlink($path);
            }
        }
    }

    // На локальном сервере считаем успехом
    $is_local = strpos($host, 'localhost') !== false || strpos($host, '.local') !== false;

    if ($mail_sent || $telegram_sent || $is_local) {
        wp_redirect(home_url('/thank-you/'));
        exit;
    } else {
        wp_redirect($redirect_base . '?form=error&field=mail#contact-form');
        exit;
    }
}

/**
 * ============================================================================
 * TELEGRAM NOTIFICATION MODULE
 * Отправка заявок в Telegram параллельно с email (не влияет на email-логику)
 * ============================================================================
 */
if (!function_exists('elinar_telegram_log')) {
    function elinar_telegram_log($context, $message)
    {
        if (!function_exists('elinar_private_log_file')) {
            return;
        }

        $context = sanitize_text_field((string) $context);
        $message = sanitize_textarea_field((string) $message);
        $line = wp_date('Y-m-d H:i:s') . " | {$context} | {$message}\n";
        @file_put_contents(elinar_private_log_file('telegram-log.txt'), $line, FILE_APPEND | LOCK_EX);
    }
}

if (!function_exists('elinar_sanitize_telegram_error_text')) {
    function elinar_sanitize_telegram_error_text($text)
    {
        $text = (string) $text;
        if ($text === '') {
            return $text;
        }

        // Маскируем токен, если он попал в URL ошибки.
        $text = preg_replace('#/bot[0-9]+:[A-Za-z0-9_-]+/#', '/bot***REDACTED***/', $text);

        if (defined('TELEGRAM_BOT_TOKEN') && TELEGRAM_BOT_TOKEN !== '') {
            $text = str_replace((string) TELEGRAM_BOT_TOKEN, '***REDACTED***', $text);
        }

        return $text;
    }
}

if (!function_exists('elinar_get_telegram_chat_id')) {
    function elinar_get_telegram_chat_id()
    {
        if (defined('TELEGRAM_CHAT_ID') && TELEGRAM_CHAT_ID !== '') {
            return (string) TELEGRAM_CHAT_ID;
        }

        return '-1003410037262';
    }
}

if (!function_exists('elinar_get_telegram_api_base_url')) {
    function elinar_get_telegram_api_base_url()
    {
        if (defined('ELINAR_TELEGRAM_API_BASE_URL') && ELINAR_TELEGRAM_API_BASE_URL !== '') {
            return rtrim((string) ELINAR_TELEGRAM_API_BASE_URL, '/');
        }

        return 'https://api.telegram.org';
    }
}

if (!function_exists('elinar_is_telegram_connectivity_error')) {
    function elinar_is_telegram_connectivity_error($error_text)
    {
        if (!is_string($error_text) || $error_text === '') {
            return false;
        }

        $error_text = strtolower($error_text);
        $needles = array(
            'timed out',
            'could not resolve host',
            'couldn\'t connect',
            'connection refused',
            'failed to connect',
            'curl error 28',
            'operation timed out',
            'stream_socket_client',
        );

        foreach ($needles as $needle) {
            if (strpos($error_text, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('elinar_telegram_mark_unreachable')) {
    function elinar_telegram_mark_unreachable($reason = '')
    {
        $enable_backoff = defined('ELINAR_TELEGRAM_ENABLE_BACKOFF') ? (bool) ELINAR_TELEGRAM_ENABLE_BACKOFF : false;
        if ($enable_backoff && function_exists('set_transient')) {
            set_transient('elinar_skip_telegram', 1, 5 * MINUTE_IN_SECONDS);
            if ($reason !== '') {
                elinar_telegram_log('telegram', 'temporary skip enabled: ' . sanitize_text_field((string) $reason));
            }
        }
    }
}

if (!function_exists('elinar_telegram_clear_unreachable_mark')) {
    function elinar_telegram_clear_unreachable_mark()
    {
        $enable_backoff = defined('ELINAR_TELEGRAM_ENABLE_BACKOFF') ? (bool) ELINAR_TELEGRAM_ENABLE_BACKOFF : false;
        if ($enable_backoff && function_exists('delete_transient')) {
            delete_transient('elinar_skip_telegram');
        }
    }
}

if (!function_exists('elinar_telegram_is_temporarily_unreachable')) {
    function elinar_telegram_is_temporarily_unreachable()
    {
        $enable_backoff = defined('ELINAR_TELEGRAM_ENABLE_BACKOFF') ? (bool) ELINAR_TELEGRAM_ENABLE_BACKOFF : false;
        if (!$enable_backoff) {
            return false;
        }

        return function_exists('get_transient') && (bool) get_transient('elinar_skip_telegram');
    }
}

if (!function_exists('elinar_configure_telegram_curl')) {
    function elinar_configure_telegram_curl($handle, $request_args, $url)
    {
        if (!is_string($url) || $url === '') {
            return;
        }

        $request_host = parse_url($url, PHP_URL_HOST);
        $telegram_host = parse_url(elinar_get_telegram_api_base_url(), PHP_URL_HOST);
        $request_host = is_string($request_host) ? strtolower($request_host) : '';
        $telegram_host = is_string($telegram_host) ? strtolower($telegram_host) : '';

        if ($request_host === '' || $telegram_host === '' || $request_host !== $telegram_host) {
            return;
        }

        // На части хостингов Telegram по IPv6 недоступен, а IPv4 работает стабильно.
        $force_ipv4 = defined('ELINAR_TELEGRAM_FORCE_IPV4') ? (bool) ELINAR_TELEGRAM_FORCE_IPV4 : false;
        if (
            $force_ipv4 &&
            defined('CURLOPT_IPRESOLVE') &&
            defined('CURL_IPRESOLVE_V4') &&
            function_exists('curl_setopt')
        ) {
            @curl_setopt($handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }

        if (defined('ELINAR_TELEGRAM_CONNECT_TIMEOUT')) {
            $connect_timeout = (int) ELINAR_TELEGRAM_CONNECT_TIMEOUT;
            if ($connect_timeout < 2) {
                $connect_timeout = 2;
            }
            if (defined('CURLOPT_CONNECTTIMEOUT') && function_exists('curl_setopt')) {
                @curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, $connect_timeout);
            }
        }

        // Опционально: HTTP(S) proxy для Telegram (если хостинг блокирует прямой выход).
        if (defined('ELINAR_TELEGRAM_PROXY') && ELINAR_TELEGRAM_PROXY !== '' && defined('CURLOPT_PROXY') && function_exists('curl_setopt')) {
            @curl_setopt($handle, CURLOPT_PROXY, (string) ELINAR_TELEGRAM_PROXY);

            if (defined('ELINAR_TELEGRAM_PROXY_AUTH') && ELINAR_TELEGRAM_PROXY_AUTH !== '' && defined('CURLOPT_PROXYUSERPWD')) {
                @curl_setopt($handle, CURLOPT_PROXYUSERPWD, (string) ELINAR_TELEGRAM_PROXY_AUTH);
            }
        }
    }
}
add_action('http_api_curl', 'elinar_configure_telegram_curl', 10, 3);

if (!function_exists('elinar_telegram_stream_context_post')) {
    function elinar_telegram_stream_context_post($url, $args = array())
    {
        if (!function_exists('stream_context_create') || !function_exists('file_get_contents')) {
            return new WP_Error('telegram_stream_unavailable', 'PHP stream transport is unavailable');
        }

        $args = is_array($args) ? $args : array();
        $timeout = isset($args['timeout']) ? (int) $args['timeout'] : 10;
        if ($timeout < 2) {
            $timeout = 2;
        }

        $body = isset($args['body']) ? $args['body'] : '';
        $headers = array();

        if (!empty($args['headers']) && is_array($args['headers'])) {
            foreach ($args['headers'] as $key => $value) {
                if (is_int($key)) {
                    $headers[] = trim((string) $value);
                } else {
                    $headers[] = trim((string) $key) . ': ' . trim((string) $value);
                }
            }
        }

        $has_content_type = false;
        foreach ($headers as $header_line) {
            if (stripos($header_line, 'content-type:') === 0) {
                $has_content_type = true;
                break;
            }
        }

        if (is_array($body)) {
            $body = http_build_query($body, '', '&');
            if (!$has_content_type) {
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            }
        } elseif (!is_string($body)) {
            $body = (string) $body;
        }

        $headers[] = 'Connection: close';
        $headers[] = 'Content-Length: ' . strlen($body);

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => implode("\r\n", $headers) . "\r\n",
                'content' => $body,
                'timeout' => $timeout,
                'ignore_errors' => true,
            ),
            'ssl' => array(
                'verify_peer' => true,
                'verify_peer_name' => true,
            ),
        ));

        $raw_body = @file_get_contents($url, false, $context);
        $response_headers = isset($http_response_header) && is_array($http_response_header) ? $http_response_header : array();

        $status_code = 0;
        if (!empty($response_headers[0]) && preg_match('#HTTP/\S+\s+(\d{3})#', (string) $response_headers[0], $m)) {
            $status_code = (int) $m[1];
        }

        if ($raw_body === false && $status_code === 0) {
            $last_error = error_get_last();
            $error_msg = is_array($last_error) && !empty($last_error['message']) ? (string) $last_error['message'] : 'Unknown stream transport error';
            return new WP_Error('telegram_stream_transport_error', $error_msg);
        }

        return array(
            'headers' => $response_headers,
            'body' => (string) $raw_body,
            'response' => array(
                'code' => $status_code,
                'message' => '',
            ),
            'cookies' => array(),
            'filename' => null,
        );
    }
}

if (!function_exists('elinar_telegram_remote_post')) {
    function elinar_telegram_remote_post($url, $args = array(), $log_context = 'telegram')
    {
        $args = is_array($args) ? $args : array();
        $response = wp_remote_post($url, $args);

        if (!is_wp_error($response)) {
            return $response;
        }

        $error = $response->get_error_message();
        if (!elinar_is_telegram_connectivity_error($error)) {
            return $response;
        }

        $allow_stream_retry = defined('ELINAR_TELEGRAM_STREAM_RETRY') ? (bool) ELINAR_TELEGRAM_STREAM_RETRY : true;
        if (!$allow_stream_retry) {
            return $response;
        }

        // Фолбэк: повторяем запрос через Streams transport, если cURL не смог подключиться.
        add_filter('use_curl_transport', '__return_false', 99);
        $retry = wp_remote_post($url, $args);
        remove_filter('use_curl_transport', '__return_false', 99);

        if (!is_wp_error($retry)) {
            elinar_telegram_log($log_context, 'stream transport retry succeeded');
            return $retry;
        }

        $wp_stream_error = elinar_sanitize_telegram_error_text($retry->get_error_message());
        elinar_telegram_log($log_context, 'wp stream transport retry failed: ' . sanitize_text_field($wp_stream_error));

        $stream_fallback = elinar_telegram_stream_context_post($url, $args);
        if (!is_wp_error($stream_fallback)) {
            elinar_telegram_log($log_context, 'php stream_context fallback succeeded');
            return $stream_fallback;
        }

        $stream_error = elinar_sanitize_telegram_error_text($stream_fallback->get_error_message());
        elinar_telegram_log($log_context, 'php stream_context fallback failed: ' . sanitize_text_field($stream_error));

        return $retry;
    }
}

/**
 * Отправляет уведомление о заявке в Telegram
 *
 * @param array $data Данные заявки
 * @return bool Успешность отправки (не влияет на основной процесс)
 */
function elinar_send_telegram_notification($data)
{
    // Проверяем наличие токена бота
    if (!defined('TELEGRAM_BOT_TOKEN') || empty(TELEGRAM_BOT_TOKEN)) {
        elinar_telegram_log('telegram', 'TELEGRAM_BOT_TOKEN is missing');
        return false;
    }

    if (elinar_telegram_is_temporarily_unreachable()) {
        elinar_telegram_log('telegram', 'skipped: temporary connectivity backoff is active');
        return false;
    }

    $bot_token = TELEGRAM_BOT_TOKEN;
    $chat_id = elinar_get_telegram_chat_id();

    // Формируем красиво оформленное сообщение (HTML-разметка Telegram)
    $message = elinar_format_telegram_message($data);

    try {
        // Отправляем текстовое сообщение
        $text_sent = elinar_telegram_send_message($bot_token, $chat_id, $message);

        if (!$text_sent) {
            elinar_telegram_log('telegram', 'sendMessage failed; documents skipped');
            return false;
        }

        // Если есть файлы — отправляем их отдельными сообщениями
        $attachment_paths = $data['attachment_paths'] ?? array();
        $attachment_names = $data['attachment_names'] ?? array();

        if (!empty($attachment_paths) && is_array($attachment_paths)) {
            $max_files = defined('ELINAR_TELEGRAM_MAX_FILES') ? (int) ELINAR_TELEGRAM_MAX_FILES : 3;
            if ($max_files < 1) {
                $max_files = 1;
            }

            foreach ($attachment_paths as $index => $path) {
                if ($index >= $max_files) {
                    break;
                }

                if (file_exists($path)) {
                    $name = isset($attachment_names[$index]) ? $attachment_names[$index] : basename($path);
                    elinar_telegram_send_document(
                        $bot_token,
                        $chat_id,
                        $path,
                        $name,
                        $data['request_id'] ?? ''
                    );
                }
            }
        }

        return $text_sent;
    } catch (Exception $e) {
        // Логируем ошибку, но не прерываем основной процесс
        error_log('Elinar Telegram Error: ' . $e->getMessage());
        elinar_telegram_log('telegram', 'exception: ' . sanitize_text_field($e->getMessage()));
        return false;
    }
}

/**
 * Форматирует сообщение для Telegram с HTML-разметкой
 *
 * @param array $data Данные заявки
 * @return string Отформатированное сообщение
 */
function elinar_format_telegram_message($data)
{
    $name = esc_html($data['name'] ?? '');
    $phone = esc_html($data['phone'] ?? '');
    $email = esc_html($data['email'] ?? '');
    $message_text = esc_html($data['message'] ?? '');
    $page_source = esc_html($data['page_source'] ?? 'сайта');
    $request_id = esc_html($data['request_id'] ?? '');
    $page_url = esc_html($data['page_url'] ?? '');
    $attachment_name = esc_html($data['attachment_name'] ?? '');
    $date = wp_date('d.m.Y H:i'); // wp_date() учитывает часовой пояс из настроек WP

    // Формируем сообщение с HTML-разметкой Telegram
    $lines = array();

    // Заголовок
    $source_title = function_exists('mb_strtoupper') ? mb_strtoupper($page_source, 'UTF-8') : strtoupper($page_source);
    $lines[] = "📋 <b>НОВАЯ ЗАЯВКА С " . $source_title . "</b>";
    $lines[] = "";
    $lines[] = "🔖 <b>Номер:</b> <code>{$request_id}</code>";
    $lines[] = "📅 <b>Дата:</b> {$date}";
    $lines[] = "";

    // Контактные данные
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "👤 <b>КОНТАКТНЫЕ ДАННЫЕ</b>";
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "";
    $lines[] = "   <b>Имя:</b> {$name}";
    $lines[] = "   <b>Телефон:</b> {$phone}";
    $lines[] = "   <b>Email:</b> {$email}";

    // Описание проекта (если есть)
    if (!empty($message_text)) {
        $lines[] = "";
        $lines[] = "━━━━━━━━━━━━━━━━━━━━";
        $lines[] = "📝 <b>ОПИСАНИЕ ПРОЕКТА</b>";
        $lines[] = "━━━━━━━━━━━━━━━━━━━━";
        $lines[] = "";
        $lines[] = $message_text;
    }

    // Информация о файлах (если есть)
    $attachment_names = $data['attachment_names'] ?? array();
    if (!empty($attachment_names) && is_array($attachment_names)) {
        $lines[] = "";
        $lines[] = "━━━━━━━━━━━━━━━━━━━━";
        $lines[] = "📎 <b>ПРИКРЕПЛЁННЫЕ ФАЙЛЫ</b>";
        $lines[] = "━━━━━━━━━━━━━━━━━━━━";
        $lines[] = "";
        foreach ($attachment_names as $name) {
            $lines[] = "   <i>{$name}</i>";
        }
        $lines[] = "   <i>(файлы отправлены отдельными сообщениями)</i>";
    }

    // Источник
    $lines[] = "";
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "🔗 <b>Источник:</b> {$page_url}";

    return implode("\n", $lines);
}

/**
 * Отправляет текстовое сообщение через Telegram Bot API
 *
 * @param string $bot_token Токен бота
 * @param string $chat_id ID чата
 * @param string $message Текст сообщения
 * @return bool Успешность отправки
 */
function elinar_telegram_send_message($bot_token, $chat_id, $message)
{
    $api_base_url = elinar_get_telegram_api_base_url();
    $url = "{$api_base_url}/bot{$bot_token}/sendMessage";
    $message = (string) $message;
    $parse_mode = 'HTML';
    $timeout = defined('ELINAR_TELEGRAM_TIMEOUT') ? (int) ELINAR_TELEGRAM_TIMEOUT : 10;
    if ($timeout < 2) {
        $timeout = 2;
    }

    // Защита от слишком длинных HTML-сообщений Telegram.
    $max_len = 3500;
    $message_len = function_exists('mb_strlen') ? mb_strlen($message, 'UTF-8') : strlen($message);
    if ($message_len > $max_len) {
        $plain = wp_strip_all_tags(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
        if (function_exists('mb_substr')) {
            $message = mb_substr($plain, 0, $max_len, 'UTF-8') . '...';
        } else {
            $message = substr($plain, 0, $max_len) . '...';
        }
        $parse_mode = '';
    }

    $response = elinar_telegram_remote_post($url, array(
        'timeout' => $timeout,
        'body' => array(
            'chat_id'    => $chat_id,
            'text'       => $message,
            'parse_mode' => $parse_mode,
        ),
    ), 'telegram');

    if (is_wp_error($response)) {
        $error = elinar_sanitize_telegram_error_text($response->get_error_message());
        error_log('Elinar Telegram sendMessage Error: ' . $error);
        elinar_telegram_log('telegram', 'sendMessage transport error: ' . sanitize_text_field($error));
        if (elinar_is_telegram_connectivity_error($error)) {
            elinar_telegram_mark_unreachable($error);
        }
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $result = json_decode($body, true);

    if (empty($result['ok'])) {
        $api_error = '';
        if (is_array($result) && !empty($result['description'])) {
            $api_error = (string) $result['description'];
        }
        error_log('Elinar Telegram sendMessage Failed: ' . $body);
        if ($api_error !== '') {
            elinar_telegram_log('telegram', 'sendMessage api error: ' . sanitize_text_field($api_error));
        } else {
            elinar_telegram_log('telegram', 'sendMessage api response is not ok');
        }

        // Повторяем отправку без parse_mode на случай ошибки HTML-разметки.
        if ($parse_mode === 'HTML') {
            $plain_text = wp_strip_all_tags(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            $retry = elinar_telegram_remote_post($url, array(
                'timeout' => $timeout,
                'body' => array(
                    'chat_id' => $chat_id,
                    'text'    => $plain_text,
                ),
            ), 'telegram');

            if (is_wp_error($retry)) {
                $retry_error = elinar_sanitize_telegram_error_text($retry->get_error_message());
                elinar_telegram_log('telegram', 'sendMessage retry transport error: ' . sanitize_text_field($retry_error));
                if (elinar_is_telegram_connectivity_error($retry_error)) {
                    elinar_telegram_mark_unreachable($retry_error);
                }
            } else {
                $retry_body = wp_remote_retrieve_body($retry);
                $retry_result = json_decode($retry_body, true);
                if (!empty($retry_result['ok'])) {
                    $retry_message_id = '';
                    if (is_array($retry_result) && !empty($retry_result['result']) && is_array($retry_result['result']) && isset($retry_result['result']['message_id'])) {
                        $retry_message_id = (string) $retry_result['result']['message_id'];
                    }
                    if ($retry_message_id !== '') {
                        elinar_telegram_log('telegram', 'sendMessage ok via retry, message_id=' . sanitize_text_field($retry_message_id));
                    } else {
                        elinar_telegram_log('telegram', 'sendMessage ok via retry');
                    }
                    elinar_telegram_clear_unreachable_mark();
                    return true;
                }
                error_log('Elinar Telegram sendMessage Retry Failed: ' . $retry_body);
                if (is_array($retry_result) && !empty($retry_result['description'])) {
                    elinar_telegram_log('telegram', 'sendMessage retry api error: ' . sanitize_text_field((string) $retry_result['description']));
                }
            }
        }

        return false;
    }

    $message_id = '';
    if (is_array($result) && !empty($result['result']) && is_array($result['result']) && isset($result['result']['message_id'])) {
        $message_id = (string) $result['result']['message_id'];
    }
    if ($message_id !== '') {
        elinar_telegram_log('telegram', 'sendMessage ok, message_id=' . sanitize_text_field($message_id));
    }

    elinar_telegram_clear_unreachable_mark();
    return true;
}

/**
 * Отправляет документ через Telegram Bot API
 *
 * @param string $bot_token Токен бота
 * @param string $chat_id ID чата
 * @param string $file_path Путь к файлу
 * @param string $file_name Имя файла для отображения
 * @param string $request_id ID заявки для подписи
 * @return bool Успешность отправки
 */
function elinar_telegram_send_document($bot_token, $chat_id, $file_path, $file_name, $request_id = '')
{
    if (elinar_telegram_is_temporarily_unreachable()) {
        return false;
    }

    if (!file_exists($file_path) || !is_readable($file_path)) {
        error_log('Elinar Telegram sendDocument Error: File not found or not readable - ' . $file_path);
        return false;
    }

    $api_base_url = elinar_get_telegram_api_base_url();
    $url = "{$api_base_url}/bot{$bot_token}/sendDocument";
    $timeout = defined('ELINAR_TELEGRAM_FILE_TIMEOUT') ? (int) ELINAR_TELEGRAM_FILE_TIMEOUT : 15;
    if ($timeout < 3) {
        $timeout = 3;
    }

    // Подготавливаем подпись к файлу
    $caption = "📎 Файл к заявке";
    if (!empty($request_id)) {
        $caption .= " <code>{$request_id}</code>";
    }

    // Используем CURLFile для отправки файла
    $boundary = wp_generate_password(24, false);
    $file_contents = file_get_contents($file_path);

    if ($file_contents === false) {
        error_log('Elinar Telegram sendDocument Error: Cannot read file - ' . $file_path);
        return false;
    }

    // Определяем MIME-тип
    $mime_type = 'application/octet-stream';
    if (function_exists('mime_content_type')) {
        $detected_mime = mime_content_type($file_path);
        if ($detected_mime) {
            $mime_type = $detected_mime;
        }
    }

    // Формируем multipart/form-data вручную
    $body = '';

    // chat_id
    $body .= "--{$boundary}\r\n";
    $body .= "Content-Disposition: form-data; name=\"chat_id\"\r\n\r\n";
    $body .= "{$chat_id}\r\n";

    // caption
    $body .= "--{$boundary}\r\n";
    $body .= "Content-Disposition: form-data; name=\"caption\"\r\n\r\n";
    $body .= "{$caption}\r\n";

    // parse_mode
    $body .= "--{$boundary}\r\n";
    $body .= "Content-Disposition: form-data; name=\"parse_mode\"\r\n\r\n";
    $body .= "HTML\r\n";

    // document (файл)
    $body .= "--{$boundary}\r\n";
    $body .= "Content-Disposition: form-data; name=\"document\"; filename=\"{$file_name}\"\r\n";
    $body .= "Content-Type: {$mime_type}\r\n\r\n";
    $body .= $file_contents . "\r\n";

    $body .= "--{$boundary}--\r\n";

    $response = elinar_telegram_remote_post($url, array(
        'timeout' => $timeout,
        'headers' => array(
            'Content-Type' => "multipart/form-data; boundary={$boundary}",
        ),
        'body' => $body,
    ), 'telegram');

    if (is_wp_error($response)) {
        $error = elinar_sanitize_telegram_error_text($response->get_error_message());
        error_log('Elinar Telegram sendDocument Error: ' . $error);
        elinar_telegram_log('telegram', 'sendDocument transport error: ' . sanitize_text_field($error));
        if (elinar_is_telegram_connectivity_error($error)) {
            elinar_telegram_mark_unreachable($error);
        }
        return false;
    }

    $response_body = wp_remote_retrieve_body($response);
    $result = json_decode($response_body, true);

    if (empty($result['ok'])) {
        error_log('Elinar Telegram sendDocument Failed: ' . $response_body);
        if (is_array($result) && !empty($result['description'])) {
            elinar_telegram_log('telegram', 'sendDocument api error: ' . sanitize_text_field((string) $result['description']));
        }
        return false;
    }

    elinar_telegram_clear_unreachable_mark();
    return true;
}

/**
 * ============================================================================
 * TELEGRAM NOTIFICATION FOR QUOTE REQUEST FORM
 * Отправка заявок на расчет производства в Telegram
 * ============================================================================
 */

/**
 * Отправляет уведомление о заявке на расчет производства в Telegram
 *
 * @param array $data Данные заявки
 * @return bool Успешность отправки (не влияет на основной процесс)
 */
function elinar_send_quote_telegram_notification($data)
{
    // Проверяем наличие токена бота
    if (!defined('TELEGRAM_BOT_TOKEN') || empty(TELEGRAM_BOT_TOKEN)) {
        elinar_telegram_log('quote_telegram', 'TELEGRAM_BOT_TOKEN is missing');
        return false;
    }

    if (elinar_telegram_is_temporarily_unreachable()) {
        elinar_telegram_log('quote_telegram', 'skipped: temporary connectivity backoff is active');
        return false;
    }

    $bot_token = TELEGRAM_BOT_TOKEN;
    $chat_id = elinar_get_telegram_chat_id();

    // Формируем красиво оформленное сообщение (HTML-разметка Telegram)
    $message = elinar_format_quote_telegram_message($data);

    try {
        // Отправляем текстовое сообщение
        $text_sent = elinar_telegram_send_message($bot_token, $chat_id, $message);

        if (!$text_sent) {
            elinar_telegram_log('quote_telegram', 'sendMessage failed; documents skipped');
            return false;
        }

        // Отправляем файлы как документы
        $uploaded_files = $data['uploaded_files'] ?? array();
        if (!empty($uploaded_files)) {
            $max_files = defined('ELINAR_TELEGRAM_MAX_FILES') ? (int) ELINAR_TELEGRAM_MAX_FILES : 3;
            if ($max_files < 1) {
                $max_files = 1;
            }

            foreach ($uploaded_files as $index => $file) {
                if ($index >= $max_files) {
                    break;
                }

                if (!empty($file['path']) && file_exists($file['path'])) {
                    elinar_telegram_send_document(
                        $bot_token,
                        $chat_id,
                        $file['path'],
                        $file['name'] ?? basename($file['path']),
                        $data['request_id'] ?? ''
                    );
                }
            }
        }

        return $text_sent;
    } catch (Exception $e) {
        error_log('Elinar Telegram Quote Error: ' . $e->getMessage());
        elinar_telegram_log('quote_telegram', 'exception: ' . sanitize_text_field($e->getMessage()));
        return false;
    }
}

/**
 * Форматирует сообщение о заявке на расчет для Telegram с HTML-разметкой
 *
 * @param array $data Данные заявки
 * @return string Отформатированное сообщение
 */
function elinar_format_quote_telegram_message($data)
{
    $request_id = esc_html($data['request_id'] ?? '');
    $technology_label = esc_html($data['technology_label'] ?? '');
    $project_name = esc_html($data['project_name'] ?? '');
    $stage_label = esc_html($data['stage_label'] ?? '');
    $material_label = esc_html($data['material_label'] ?? '');
    $material_other = esc_html($data['material_other'] ?? '');
    $material = $data['material'] ?? '';
    $color_type = $data['color_type'] ?? '';
    $color_value = esc_html($data['color_value'] ?? '');
    $technology = $data['technology'] ?? '';

    // Габариты
    $width_diameter = esc_html($data['width_diameter'] ?? '');
    $height_extrusion = esc_html($data['height_extrusion'] ?? '');
    $wall_thickness = esc_html($data['wall_thickness'] ?? '');
    $length_injection = esc_html($data['length_injection'] ?? '');
    $width_injection = esc_html($data['width_injection'] ?? '');
    $height_injection = esc_html($data['height_injection'] ?? '');
    $weight_injection = esc_html($data['weight_injection'] ?? '');

    $special_requirements = esc_html($data['special_requirements'] ?? '');
    $production_volume = $data['production_volume'] ?? '';
    $volume_monthly = esc_html($data['volume_monthly'] ?? '');
    $volume_unit = $data['volume_unit'] ?? '';
    $production_start = $data['production_start'] ?? '';
    $target_price = esc_html($data['target_price'] ?? '');
    $tooling_status = $data['tooling_status'] ?? '';
    $additional_requirements = esc_html($data['additional_requirements'] ?? '');

    // Контакты
    $company = esc_html($data['company'] ?? '');
    $contact_person = esc_html($data['contact_person'] ?? '');
    $position = esc_html($data['position'] ?? '');
    $phone = esc_html($data['phone'] ?? '');
    $email = esc_html($data['email'] ?? '');
    $contact_method = $data['contact_method'] ?? '';

    $formatted_date = esc_html($data['formatted_date'] ?? '');
    $ip = esc_html($data['ip'] ?? '');
    $uploaded_files = $data['uploaded_files'] ?? array();

    // Тип изделия
    $product_type = '';
    if ($technology === 'extrusion' && !empty($data['product_type_extrusion'])) {
        $product_type = esc_html($data['product_type_extrusion']);
    } elseif ($technology === 'injection' && !empty($data['product_type_injection'])) {
        $product_type = esc_html($data['product_type_injection']);
    }

    // Цвет
    $color_labels = array('natural' => 'Натуральный', 'colored' => 'Окраска в массе', 'no_requirements' => 'Без требований');
    $color_display = $color_labels[$color_type] ?? $color_type;
    if ($color_type === 'colored' && !empty($color_value)) {
        $color_display .= " ({$color_value})";
    }

    // Объем производства
    $volume_display = $production_volume === 'single' ? 'Разовая партия' : 'Серийное производство';
    if ($production_volume === 'serial' && !empty($volume_monthly)) {
        $unit = $volume_unit === 'pm' ? 'п.м.' : 'шт.';
        $volume_display .= " ({$volume_monthly} {$unit}/мес)";
    }

    // Срок начала
    $start_labels = array(
        '1_month' => 'В течение 1 месяца',
        '2_3_months' => 'В течение 2-3 месяцев',
        '3_6_months' => 'В течение 3-6 месяцев',
        'more_6_months' => 'Более 6 месяцев',
        'later' => 'Уточню позже'
    );
    $start_display = $start_labels[$production_start] ?? $production_start;

    // Оснастка
    $tooling_labels = array(
        'ready' => 'Есть пресс-форма (готова)',
        'needs_revision' => 'Есть пресс-форма (требуется ревизия)',
        'need_new' => 'Нет оснастки (готовы инвестировать)',
        'need_consultation' => 'Требуется консультация'
    );
    $tooling_display = $tooling_labels[$tooling_status] ?? $tooling_status;

    // Способ связи
    $contact_labels = array('phone' => 'Телефон', 'email' => 'Email', 'telegram' => 'Telegram');
    $contact_method_display = $contact_labels[$contact_method] ?? 'Телефон';

    // Формируем сообщение
    $lines = array();

    // Заголовок
    $lines[] = "📊 <b>ЗАПРОС НА РАСЧЕТ ПРОИЗВОДСТВА</b>";
    $lines[] = "";
    $lines[] = "🔖 <b>Номер:</b> <code>{$request_id}</code>";
    $lines[] = "📅 <b>Дата:</b> {$formatted_date}";
    $lines[] = "";

    // Технология
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "⚙️ <b>ТЕХНОЛОГИЯ</b>";
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "";
    $lines[] = "   {$technology_label}";
    $lines[] = "";

    // Информация о проекте
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "📋 <b>ПРОЕКТ</b>";
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "";
    $lines[] = "   <b>Название:</b> {$project_name}";
    if (!empty($product_type)) {
        $lines[] = "   <b>Тип изделия:</b> {$product_type}";
    }
    $lines[] = "   <b>Стадия:</b> {$stage_label}";
    $lines[] = "";

    // Технические параметры
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "🔧 <b>ТЕХНИЧЕСКИЕ ПАРАМЕТРЫ</b>";
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "";

    $material_display = $material_label;
    if ($material === 'other' && !empty($material_other)) {
        $material_display .= " ({$material_other})";
    }
    $lines[] = "   <b>Материал:</b> {$material_display}";
    $lines[] = "   <b>Цвет:</b> {$color_display}";

    // Габариты
    if ($technology === 'extrusion') {
        $dims = array();
        if (!empty($width_diameter)) $dims[] = "Ш/Ø: {$width_diameter} мм";
        if (!empty($height_extrusion)) $dims[] = "В: {$height_extrusion} мм";
        if (!empty($wall_thickness)) $dims[] = "Стенка: {$wall_thickness} мм";
        if (!empty($dims)) {
            $lines[] = "   <b>Габариты:</b> " . implode(', ', $dims);
        }
    } else {
        $dims = array();
        if (!empty($length_injection)) $dims[] = "Д: {$length_injection}";
        if (!empty($width_injection)) $dims[] = "Ш: {$width_injection}";
        if (!empty($height_injection)) $dims[] = "В: {$height_injection}";
        if (!empty($weight_injection)) $dims[] = "Масса: {$weight_injection} г";
        if (!empty($dims)) {
            $lines[] = "   <b>Габариты:</b> " . implode(' × ', $dims) . " мм";
        }
    }

    if (!empty($special_requirements)) {
        $lines[] = "   <b>Особые требования:</b> {$special_requirements}";
    }
    $lines[] = "";

    // Производственные параметры
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "🏭 <b>ПРОИЗВОДСТВО</b>";
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "";
    $lines[] = "   <b>Объем:</b> {$volume_display}";

    if (!empty($start_display)) {
        $lines[] = "   <b>Срок начала:</b> {$start_display}";
    }
    if (!empty($target_price)) {
        $lines[] = "   <b>Целевая цена:</b> {$target_price} руб./ед.";
    }
    if ($technology === 'injection' && !empty($tooling_display)) {
        $lines[] = "   <b>Оснастка:</b> {$tooling_display}";
    }
    if (!empty($additional_requirements)) {
        $lines[] = "   <b>Доп. требования:</b> {$additional_requirements}";
    }
    $lines[] = "";

    // Файлы
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "📎 <b>ФАЙЛЫ</b>";
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "";
    if (!empty($uploaded_files)) {
        foreach ($uploaded_files as $file) {
            $size_kb = isset($file['size']) ? round($file['size'] / 1024, 1) : 0;
            $file_name = esc_html($file['name'] ?? 'файл');
            $lines[] = "   • {$file_name} ({$size_kb} КБ)";
        }
        $lines[] = "   <i>(файлы отправлены отдельными сообщениями)</i>";
    } else {
        $lines[] = "   <i>Файлы не прикреплены</i>";
    }
    $lines[] = "";

    // Контактная информация
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "👤 <b>КОНТАКТЫ</b>";
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "";
    $lines[] = "   <b>Компания:</b> {$company}";
    $lines[] = "   <b>Контактное лицо:</b> {$contact_person}";
    if (!empty($position)) {
        $lines[] = "   <b>Должность:</b> {$position}";
    }
    $lines[] = "   <b>Телефон:</b> {$phone}";
    $lines[] = "   <b>Email:</b> {$email}";
    $lines[] = "   <b>Способ связи:</b> {$contact_method_display}";
    $lines[] = "";

    // Метаданные
    $lines[] = "━━━━━━━━━━━━━━━━━━━━";
    $lines[] = "🌐 <b>IP:</b> {$ip}";

    return implode("\n", $lines);
}

/**
 * ============================================================================
 * ELINAR PLAST THEME - FUNCTIONS
 * ============================================================================
 *
 * TABLE OF CONTENTS:
 *
 * 1. Theme Setup ........................... line 15
 * 2. Enqueue Scripts & Styles .............. line 26
 * 3. Performance Optimizations ............. line 172
 *    - Defer Scripts
 *    - Lazy Loading Images
 *    - Preconnect & Resource Hints
 *    - Preload Hero Images
 * 4. Custom Routing (Fallback) ............ line 314
 * 5. Menu Customization .................... line 390
 * 6. Helper Functions ...................... line 414
 * 7. Breadcrumbs ........................... line 428
 * 8. AJAX Handlers:
 *    - Contact Form ........................ line 660
 *    - Quote Form .......................... line 816
 *    - Project Form ........................ line 1241
 * 9. Favicon ............................... line 1413
 * 10. Analytics ............................ line 1570
 * 11. Debug Diagnostics ...................... line 1600
 *
 * ============================================================================
 */

// ============================================================================
// HELPER FUNCTIONS
// ============================================================================

function elinar_get_real_ip()
{
    $ip = '';

    // Проверяем Cloudflare
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $ip = sanitize_text_field($_SERVER['HTTP_CF_CONNECTING_IP']);
    }
    // Проверяем другие прокси
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim(sanitize_text_field($ips[0]));
    } elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
        $ip = sanitize_text_field($_SERVER['HTTP_X_REAL_IP']);
    } else {
        $ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    }

    // Валидация IP
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        $ip = 'unknown';
    }

    return $ip;
}

// ============================================================================
// 1. THEME SETUP
// ============================================================================

function elinar_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu'
    ));
}
add_action('after_setup_theme', 'elinar_setup');

/**
 * Отправляет кэш-заголовки для HTML-страниц
 * Помогает браузерам кэшировать страницы в случаях, когда .htaccess не работает
 */
function elinar_cache_headers_control($headers)
{
    // Только для фронтенда, не для админки
    if (is_admin()) {
        return $headers;
    }

    // Не кэшировать для авторизованных пользователей и формы
    if (is_user_logged_in() || is_search() || is_404()) {
        $headers['Cache-Control'] = 'no-cache, no-store, must-revalidate';
        $headers['Pragma'] = 'no-cache';
        $headers['Expires'] = '0';
        return $headers;
    }

    // Кэширование на 5 минут для обычных страниц
    $cache_time = 300; // 5 минут

    $headers['Cache-Control'] = 'public, max-age=' . $cache_time;
    $headers['Expires'] = gmdate('D, d M Y H:i:s', time() + $cache_time) . ' GMT';
    $headers['Vary'] = 'Accept-Encoding';

    return $headers;
}
add_filter('wp_headers', 'elinar_cache_headers_control', 10);

/**
 * Настройка заголовков (Title) для вкладок браузера — SEO-оптимизация
 * Обновлено: 2026-02-20 — добавлены title для всех ключевых страниц
 */
add_filter('document_title_parts', function ($title) {
    // 1. Принудительно ставим правильное название бренда (исправляет elinarplast на продакшене)
    $title['site'] = 'Элинар Пласт';

    // Убираем стандартный слоган везде, чтобы title не был перегружен
    unset($title['tagline']);

    // 2. Настройка для каждой страницы по slug шаблона
    if (is_front_page()) {
        $title['title'] = 'Производство изделий из пластмасс — с 2001 года';
    } elseif (is_page('products') || is_page('продукция')) {
        $title['title'] = 'Каталог полимерных профилей и изделий';
    } elseif (is_page('services') || is_page('услуги')) {
        $title['title'] = 'Экструзия и литьё пластмасс под давлением';
    } elseif (is_page('about') || is_page('о-компании') || is_page('o-kompanii')) {
        $title['title'] = 'О компании — производство пластмасс с 2001 года';
    } elseif (is_page('contacts') || is_page('контакты')) {
        $title['title'] = 'Контакты — производство в Наро-Фоминске';
    } elseif (is_page('technologies-production') || is_page('technologies-and-production') || is_page_template('page-technologies-production.php')) {
        $title['title'] = 'Технологии и производственные возможности';
    } elseif (is_page('sotrudnichestvo') || is_page('cooperation') || is_page_template('page-sotrudnichestvo.php')) {
        $title['title'] = 'Сотрудничество и контрактное производство';
    } elseif (is_page('privacy-policy') || is_page('politika-konfidenczialnosti') || is_page_template('page-privacy-policy.php')) {
        $title['title'] = 'Политика обработки персональных данных';
    } elseif (is_page('partners') || is_page('партнеры') || is_page('partnyory')) {
        $title['title'] = 'Партнёры и клиенты';
    } elseif (is_page('production-demo') || is_page('demo') || is_page_template('page-production-demo.php')) {
        $title['title'] = 'Демо: производственный цикл';
    } elseif (is_page('quote-request') || is_page('zayavka') || is_page('заявка')) {
        $title['title'] = 'Запрос на расчёт производства';
    } elseif (is_page('thank-you') || is_page('spasibo')) {
        $title['title'] = 'Спасибо за заявку';
    }

    return $title;
}, 20);

/**
 * Изменение разделителя в заголовке на более современный
 */
add_filter('document_title_separator', function ($sep) {
    return '|';
});

/**
 * SEO: Meta Descriptions и Robots для всех страниц
 * Добавлено: 2026-02-20 — работает без плагина напрямую из темы
 */
add_action('wp_head', 'elinar_seo_meta_tags', 1);
function elinar_seo_meta_tags()
{
    // --- Описания для каждой страницы ---
    $description = '';

    if (is_front_page()) {
        $description = 'Элинар Пласт — производство изделий из пластмасс с 2001 года. Экструзия и литьё под давлением по немецким технологиям. Термовставки, профили, втулки — звоните: +7 (496) 34-77-944.';
    } elseif (is_page('products') || is_page('продукция')) {
        $description = 'Каталог полимерных изделий Элинар Пласт: термовставки ПВХ, фаскообразователи, профили для шинопровода, бытовой техники и автофургонов. Производство по чертежам заказчика.';
    } elseif (is_page('services') || is_page('услуги')) {
        $description = 'Контрактное производство пластиковых изделий полного цикла: экструзия профилей и литьё под давлением. Проектирование оснастки, опытная серия, серийный выпуск по вашим чертежам.';
    } elseif (is_page('about') || is_page('о-компании') || is_page('o-kompanii')) {
        $description = 'ООО «Элинар Пласт» — современное производственное предприятие с более чем 20-летним опытом. Производство в Наро-Фоминском районе (с. Атепцево). Немецкие технологии экструзии и литья.';
    } elseif (is_page('contacts') || is_page('контакты')) {
        $description = 'Контакты Элинар Пласт: адрес производства — Московская обл., Наро-Фоминский р-н, с. Атепцево. Телефон: +7 (496) 34-77-944. Заказать производство изделий из пластмасс.';
    } elseif (is_page('technologies-production') || is_page('technologies-and-production') || is_page_template('page-technologies-production.php')) {
        $description = 'Технологии Элинар Пласт: экструзия профилей и литьё под давлением, контроль качества, разработка оснастки и полный цикл контрактного производства пластиковых изделий.';
    } elseif (is_page('sotrudnichestvo') || is_page('cooperation') || is_page_template('page-sotrudnichestvo.php')) {
        $description = 'Сотрудничество с Элинар Пласт: прямые поставки, контрактное производство, резервирование сырья и стабильные отгрузки для промышленных предприятий.';
    } elseif (is_page('privacy-policy') || is_page('politika-konfidenczialnosti') || is_page_template('page-privacy-policy.php')) {
        $description = 'Политика в отношении обработки персональных данных ООО «Элинар Пласт»: цели, состав данных, правовые основания и порядок защиты информации.';
    } elseif (is_page('partners') || is_page('партнеры') || is_page('partnyory')) {
        $description = 'Партнёры и клиенты Элинар Пласт — ведущие промышленные предприятия России, работающие с нашим производством более 20 лет.';
    } elseif (is_page('production-demo') || is_page('demo') || is_page_template('page-production-demo.php')) {
        $description = 'Служебная демо-страница производственного цикла. Предназначена для внутреннего просмотра и закрыта от индексации.';
    } elseif (is_page('quote-request') || is_page('zayavka') || is_page('заявка')) {
        $description = 'Заполните форму запроса на расчёт производства пластиковых изделий. Укажите чертёж, материал, объём партии — мы ответим в течение 1 рабочего дня.';
    }

    // Выводим мета-описание, если оно задано
    if (!empty($description)) {
        // Безопасное экранирование для вывода в атрибут
        $safe_desc = esc_attr($description);
        echo '<meta name="description" content="' . $safe_desc . '">' . "\n";

        // Open Graph описание (для соцсетей)
        echo '<meta property="og:description" content="' . $safe_desc . '">' . "\n";
    }

    // Open Graph: заголовок и URL для всех страниц
    $og_title = wp_get_document_title();
    echo '<meta property="og:title" content="' . esc_attr($og_title) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
    echo '<meta property="og:site_name" content="Элинар Пласт">' . "\n";
    echo '<meta property="og:locale" content="ru_RU">' . "\n";

    // --- Noindex для служебных/мусорных страниц ---
    $is_noindex = (
        is_page('thank-you')
        || is_page('spasibo')
        || is_page('production-demo')
        || is_page('demo')
        || is_page('quote-request')
        || is_page('zayavka')
        || is_page('заявка')
        || is_page_template('page-thank-you.php')
        || is_page_template('page-production-demo.php')
        || is_page_template('page-quote-request.php')
    );

    if ($is_noindex) {
        echo '<meta name="robots" content="noindex, nofollow">' . "\n";
    }
}

/**
 * Диагностика модулей Apache (доступна по ?elinar_diag=1 для админов)
 * Используйте: https://varslavan.ru/elinarplast/?elinar_diag=1
 */
function elinar_server_diagnostics()
{
    if (!isset($_GET['elinar_diag']) || $_GET['elinar_diag'] !== '1') {
        return;
    }

    // Только для администраторов
    if (!current_user_can('manage_options')) {
        return;
    }

    header('Content-Type: text/plain; charset=utf-8');

    echo "=== ELINAR PLAST SERVER DIAGNOSTICS ===\n\n";

    // Проверка модулей Apache
    if (function_exists('apache_get_modules')) {
        $modules = apache_get_modules();
        echo "Apache Modules:\n";
        echo "- mod_expires: " . (in_array('mod_expires', $modules) ? 'YES ✅' : 'NO ❌') . "\n";
        echo "- mod_headers: " . (in_array('mod_headers', $modules) ? 'YES ✅' : 'NO ❌') . "\n";
        echo "- mod_deflate: " . (in_array('mod_deflate', $modules) ? 'YES ✅' : 'NO ❌') . "\n";
        echo "- mod_rewrite: " . (in_array('mod_rewrite', $modules) ? 'YES ✅' : 'NO ❌') . "\n";
    } else {
        echo "Apache Modules: Cannot detect (CGI/FastCGI mode)\n";
        $server_software = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';
        echo "Server Software: " . $server_software . "\n";

        // Проверка для Nginx
        if (stripos($server_software, 'nginx') !== false) {
            echo "- Web Server: Nginx (rewrite rules in nginx.conf)\n";
        }
    }

    echo "\n.htaccess Status:\n";
    $htaccess = ABSPATH . '.htaccess';
    if (file_exists($htaccess)) {
        echo "- File exists: YES ✅\n";
        echo "- Size: " . filesize($htaccess) . " bytes\n";
        $htaccess_content = @file_get_contents($htaccess);
        if ($htaccess_content !== false) {
            echo "- Contains 'mod_expires': " . (strpos($htaccess_content, 'mod_expires') !== false ? 'YES ✅' : 'NO ❌') . "\n";
            echo "- Contains 'Cache-Control': " . (strpos($htaccess_content, 'Cache-Control') !== false ? 'YES ✅' : 'NO ❌') . "\n";
        } else {
            echo "- File readable: NO ❌\n";
        }
    } else {
        echo "- File exists: NO ❌\n";
    }

    echo "\nPHP Info:\n";
    echo "- PHP Version: " . phpversion() . "\n";
    echo "- SAPI: " . php_sapi_name() . "\n";

    echo "\n=== END DIAGNOSTICS ===\n";
    exit;
}
add_action('init', 'elinar_server_diagnostics');

// ============================================================================
// 2. ENQUEUE SCRIPTS & STYLES
// ============================================================================

function elinar_scripts()
{
    // Определяем контекст страницы для условного подключения CSS/JS
    $request_uri = isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '';
    $request_uri = filter_var($request_uri, FILTER_SANITIZE_URL);

    $is_front_page      = is_front_page();
    $is_about_page      = is_page_template('page-about.php') || strpos($request_uri, 'about') !== false;
    $is_tech_page       = is_page_template('page-technologies-production.php')
        || strpos($request_uri, 'technologies-and-contract-manufacturing') !== false
        || strpos($request_uri, 'technologies-production') !== false
        || strpos($request_uri, 'technologies') !== false;
    $is_contacts_page   = is_page_template('page-contacts.php') || strpos($request_uri, 'contacts') !== false;
    $is_products_page   = is_page_template('page-products.php') || strpos($request_uri, 'products') !== false;
    $is_quote_page      = is_page_template('page-quote-request.php')
        || strpos($request_uri, 'quote-request') !== false
        || strpos($request_uri, 'zapros-rascheta') !== false;

    $needs_production_slider = $is_front_page || $is_about_page;
    $needs_production_cycle  = $is_front_page;
    $needs_glightbox         = $needs_production_slider || $is_about_page || $is_tech_page || $is_products_page;
    $needs_swiper            = $is_tech_page;

    $theme_uri = get_template_directory_uri();

    // Базовые стили темы (минифицированная версия для производительности)
    // Оригинал: style.css (232 KB) → Минифицированный: style.min.css (150 KB)
    // После Gzip: ~41 KB → ~26 KB
    // Баг #3: заменяем time() на filemtime() — time() менялся каждую секунду и полностью ломал кэш браузера
    $elinar_style_ver = filemtime(get_template_directory() . '/style.min.css') ?: '2.7.0';
    wp_enqueue_style('elinar-style', $theme_uri . '/style.min.css', array(), $elinar_style_ver);

    wp_add_inline_style('elinar-style', '.cookie-banner{position:fixed;bottom:20px;left:50%;transform:translateX(-50%) translateY(calc(100% + 40px));background:#ffffff;border-radius:20px;box-shadow:0 12px 40px rgba(0,0,0,0.12),0 4px 12px rgba(0,0,0,0.08);z-index:9999;padding:1.25rem 1.5rem;transition:transform 0.4s cubic-bezier(0.4,0,0.2,1),opacity 0.4s ease;max-width:640px;width:min(calc(100% - 40px),640px);opacity:0}.cookie-banner.show{transform:translateX(-50%) translateY(0);opacity:1}.cookie-banner-content{display:flex;align-items:flex-start;gap:1.25rem}.cookie-icon{flex-shrink:0;color:#0066cc;margin-top:0.25rem}.cookie-icon svg{display:block}.cookie-banner-main{flex:1;display:flex;flex-direction:column;gap:0.9rem}.cookie-banner-text{display:flex;flex-direction:column;gap:0.5rem}.cookie-banner-title{font-size:1rem;font-weight:700;color:#1e293b;margin:0;line-height:1.4}.cookie-banner-text p{margin:0;font-size:0.9rem;line-height:1.55;color:#64748b}.cookie-banner-links{margin-top:0.25rem;display:flex;flex-wrap:wrap;gap:0.5rem;align-items:center;font-size:0.8125rem;line-height:1.4}.cookie-banner-link{color:#0066cc;text-decoration:none;font-weight:500;transition:color 0.2s ease;border-bottom:1px solid rgba(0,102,204,0.3)}.cookie-banner-link:hover{color:#0052a3;border-bottom-color:#0052a3}.cookie-banner-actions{display:flex;align-items:center;gap:0.625rem;flex-wrap:wrap}.cookie-banner-btn{border:none;padding:0.55rem 1.05rem;font-size:0.85rem;font-weight:600;font-family:var(--font-main);border-radius:12px;cursor:pointer;transition:all 0.2s ease;white-space:nowrap;line-height:1.2}.cookie-banner-btn--primary{background-color:#0066cc;color:#fff}.cookie-banner-btn--primary:hover{background-color:#0052a3;transform:translateY(-1px);box-shadow:0 4px 12px rgba(0,102,204,0.25)}.cookie-banner-btn--outline{background:transparent;color:#0066cc;border:1.5px solid #0066cc}.cookie-banner-btn--outline:hover{background:rgba(0,102,204,0.08);transform:translateY(-1px)}.cookie-banner-btn--secondary{background:transparent;color:#64748b;border:1.5px solid #cbd5e1}.cookie-banner-btn--secondary:hover{background:#f8fafc;border-color:#94a3b8;color:#475569;transform:translateY(-1px)}.cookie-banner-settings{border-top:1px solid #e2e8f0;margin-top:1.25rem;padding-top:1.25rem;display:grid;gap:1rem}.cookie-banner-settings[hidden]{display:none!important}@media (max-width:768px){.cookie-banner{padding:1.15rem;width:calc(100% - 24px);max-width:100%;bottom:12px;border-radius:16px}.cookie-banner-content{flex-direction:column;gap:1rem}.cookie-icon{margin-top:0}.cookie-banner-actions{width:100%;flex-direction:column;align-items:stretch;gap:0.5rem}.cookie-banner-btn{width:100%;padding:0.75rem 1rem}}');

    // Хлебные крошки нужны на всех страницах, кроме главной
    if (!$is_front_page) {
        wp_enqueue_style('breadcrumbs', $theme_uri . '/assets/css/breadcrumbs.css', array(), '1.0.0');
    }

    // Google Fonts (Inter, Manrope, Space Grotesk)
    // ВАЖНО: $ver = null, иначе WP добавляет ver=... через add_query_arg() и может сломать URL с повторяющимися параметрами (family=...&family=...).
    if (defined('ELINAR_OPT_LOCAL_FONTS') && ELINAR_OPT_LOCAL_FONTS) {
        $local_fonts_ver = defined('WP_DEBUG') && WP_DEBUG ? '1.0.0.' . time() : '1.0.0';
        wp_enqueue_style(
            'elinar-fonts',
            $theme_uri . '/assets/css/fonts-local.css',
            array(),
            $local_fonts_ver
        );
    } else {
        wp_enqueue_style(
            'elinar-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@500;700;800;900&family=Space+Grotesk:wght@500&display=swap&subset=cyrillic,cyrillic-ext',
            array(),
            null
        );
    }

    // GLightbox – только там, где реально есть галерея (главная, О компании, Технологии)
    if ($needs_glightbox) {
        wp_enqueue_style('glightbox-css', 'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css', array(), '3.2.0');
        $glightbox_custom_ver = defined('WP_DEBUG') && WP_DEBUG ? '1.5.4.' . time() : '1.5.4';
        wp_enqueue_style('glightbox-custom', $theme_uri . '/assets/css/glightbox-custom.css', array('glightbox-css'), $glightbox_custom_ver);
        $glightbox_in_footer = (!defined('ELINAR_OPT_GLIGHTBOX_FOOTER') || ELINAR_OPT_GLIGHTBOX_FOOTER);
        wp_enqueue_script('glightbox-js', 'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js', array(), '3.2.0', $glightbox_in_footer);
    }

    // Swiper.js – for technologies page gallery
    if ($needs_swiper) {
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);
    }

    // Opera Android fix extracted to external file (kept in head for early execution)
    if (defined('ELINAR_OPT_OPERA_FIX_EXTERNAL') && ELINAR_OPT_OPERA_FIX_EXTERNAL) {
        $opera_fix_ver = defined('WP_DEBUG') && WP_DEBUG ? '1.0.0.' . time() : '1.0.0';
        wp_enqueue_script('opera-android-fix', $theme_uri . '/assets/js/opera-android-fix.js', array(), $opera_fix_ver, false);
    }

    // Production Cycle / Slider – используются только на главной
    if ($needs_production_cycle) {
        wp_enqueue_style('production-cycle', $theme_uri . '/assets/css/production-cycle.css', array(), '1.0.0');
    }

    // Production Slider
    if ($needs_production_slider) {
        $production_slider_ver = defined('WP_DEBUG') && WP_DEBUG ? '4.3.0.' . time() : '4.3.0';
        wp_enqueue_style('production-slider', $theme_uri . '/assets/css/production-slider.css', array(), $production_slider_ver);
        $production_slider_js_ver = defined('WP_DEBUG') && WP_DEBUG ? '2.7.3.' . time() : '2.7.3';
        wp_enqueue_script('production-slider', $theme_uri . '/assets/js/production-slider.js', array('glightbox-js'), $production_slider_js_ver, true);
    }

    // Key Directions - Industrial Tech Redesign (Front Page)
    if ($is_front_page) {
        $key_directions_ver = defined('WP_DEBUG') && WP_DEBUG ? '1.0.0.' . time() : '1.0.0';
        wp_enqueue_style('key-directions', $theme_uri . '/assets/css/key-directions.css', array(), $key_directions_ver);

        // Stats Block Redesign (Front Page)
        $stats_ver = defined('WP_DEBUG') && WP_DEBUG ? '1.0.0.' . time() : '1.0.0';
        wp_enqueue_style('products-stats', $theme_uri . '/assets/css/products-stats.css', array(), $stats_ver);
        wp_enqueue_script('products-stats', $theme_uri . '/assets/js/products-stats.js', array(), $stats_ver, true);
    }

    // Front page inline assets extracted to files (safe rollback via flag)
    if (
        $is_front_page
        && (!defined('ELINAR_OPT_FRONT_PAGE_ASSETS') || ELINAR_OPT_FRONT_PAGE_ASSETS)
    ) {
        $front_page_inline_ver = defined('WP_DEBUG') && WP_DEBUG ? '1.0.0.' . time() : '1.0.0';
        wp_enqueue_style('front-page-inline', $theme_uri . '/assets/css/front-page-inline.css', array('elinar-style'), $front_page_inline_ver);
        wp_enqueue_script('front-page-inline', $theme_uri . '/assets/js/front-page-inline.js', array(), $front_page_inline_ver, true);
    }

    // Шаблонные страницы: подключаем их CSS только на соответствующих URL
    if ($is_about_page) {
        wp_enqueue_style('elinar-about', $theme_uri . '/assets/css/page-about.css', array(), '1.0.4');
        wp_enqueue_script('elinar-about-js', $theme_uri . '/assets/js/page-about.js', array(), '1.0.0', true);
    }

    if ($is_tech_page) {
        wp_enqueue_style('elinar-technologies-production', $theme_uri . '/assets/css/page-technologies-production.css', array('elinar-style'), '1.0.1');

        // Hero Panorama (interactive)
        wp_enqueue_style('hero-panorama', $theme_uri . '/assets/css/hero-panorama.css', array(), '2.0.0');

        // GSAP для анимаций
        wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);

        // Hero Panorama JS
        $hero_panorama_ver = defined('WP_DEBUG') && WP_DEBUG ? '3.0.0.' . time() : '3.0.0';
        wp_enqueue_script('hero-panorama', $theme_uri . '/assets/js/hero-panorama.js', array('gsap'), $hero_panorama_ver, true);
    }

    if ($is_contacts_page) {
        wp_enqueue_style('elinar-contacts', $theme_uri . '/assets/css/page-contacts.css', array(), '2.0.' . time());
    }

    if ($is_products_page) {
        $elinar_products_ver = defined('WP_DEBUG') && WP_DEBUG ? '2.2.1.' . time() : '2.2.1';
        wp_enqueue_style('elinar-products', $theme_uri . '/assets/css/page-products.css', array(), $elinar_products_ver);

        // Products Slider
        $products_slider_ver = defined('WP_DEBUG') && WP_DEBUG ? '6.2.5.' . time() : '6.2.5';
        wp_enqueue_style('products-slider', $theme_uri . '/assets/css/products-slider.css', array('elinar-products'), $products_slider_ver);
        wp_enqueue_script('products-slider', $theme_uri . '/assets/js/products-slider.js', array(), $products_slider_ver, true);

        // Injection Video Player
        wp_enqueue_style('injection-video-player', $theme_uri . '/assets/css/injection-video-player.css', array('elinar-products'), '1.0.0');
        wp_enqueue_script('injection-video-player', $theme_uri . '/assets/js/injection-video-player.js', array(), '1.0.0', true);

        // GSAP для анимаций (используется для других элементов на странице)
        wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);
        wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('gsap'), '3.12.5', true);

        // PDF Generation
        wp_enqueue_script('jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js', array(), '2.5.1', true);
        wp_enqueue_script('html2canvas', 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js', array(), '1.4.1', true);
        wp_enqueue_script('products-pdf', $theme_uri . '/assets/js/products-pdf.js', array('jspdf', 'html2canvas'), '1.0.1', true);

        // Передаем настройки и пути для генерации PDF
        wp_localize_script('products-pdf', 'pdfSettings', array(
            'logoUrl' => $theme_uri . '/assets/images/logo-color-200.webp'
        ));
    }

    // Audit Form - используется на страницах Products, Technologies, About, Contacts, Services и Front Page
    $is_services_page = is_page_template('page-services.php') || strpos($request_uri, 'services') !== false;
    $needs_audit_form = $is_front_page || $is_products_page || $is_tech_page || $is_about_page || $is_contacts_page || $is_services_page;
    if ($needs_audit_form) {
        $audit_form_ver = defined('WP_DEBUG') && WP_DEBUG ? '1.0.3.' . time() : '1.0.3';
        wp_enqueue_style('audit-form', $theme_uri . '/assets/css/audit-form.css', array(), $audit_form_ver);
        wp_enqueue_script('audit-form', $theme_uri . '/assets/js/audit-form.js', array(), '1.0.1', true);
    }

    // Products Timeline - теперь используется на странице Services вместо Products
    if ($is_services_page) {
        // Сначала подключаем GSAP (зависимости), чтобы они были доступны при подключении таймлайна
        if (!wp_script_is('gsap', 'enqueued')) {
            wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);
        }
        if (!wp_script_is('gsap-scrolltrigger', 'enqueued')) {
            wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('gsap'), '3.12.5', true);
        }

        wp_enqueue_style('products-timeline', $theme_uri . '/assets/css/products-timeline.css', array(), '1.0.0');
        wp_enqueue_script('products-timeline', $theme_uri . '/assets/js/products-timeline.js', array('gsap', 'gsap-scrolltrigger'), '1.0.0', true);
    }


    // Форма запроса КП – только на странице "Запрос расчета"
    if ($is_quote_page) {
        wp_enqueue_style('quote-form', $theme_uri . '/assets/css/quote-form.css', array(), '1.0.3');
        wp_enqueue_script('quote-form', $theme_uri . '/assets/js/quote-form.js', array(), '1.0.0', true);

        // Localize script for quote form AJAX
        wp_localize_script('quote-form', 'quoteFormAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('elinar_quote_form_nonce'),
            'maxFileSize' => 10 * 1024 * 1024, // 10MB
            'maxFiles' => 5,
            'allowedTypes' => array('jpg', 'jpeg', 'png', 'pdf', 'dwg', 'dxf', 'step', 'stp', 'iges', 'igs', 'stl')
        ));
    }

    // Yandex Maps API
    // API ключ можно задать через константу ELINAR_YANDEX_MAPS_API_KEY в wp-config.php
    // Получить ключ можно здесь: https://developer.tech.yandex.ru/services/
    $yandex_api_key = defined('ELINAR_YANDEX_MAPS_API_KEY') ? ELINAR_YANDEX_MAPS_API_KEY : 'b376f600-5f23-4f98-aff8-76b815df14bf';
    $yandex_maps_url = 'https://api-maps.yandex.ru/2.1/?apikey=' . esc_attr($yandex_api_key) . '&lang=ru_RU';

    // Main JS (используем main.js для разработки, чтобы видеть изменения)
    $main_js_path = get_template_directory_uri() . '/assets/js/main.js';
    $main_js_ver = '2.1.3.' . time();

    wp_add_inline_script('elinar-script', 'console.log("ELINAR: Loading main.js v2.1.3");', 'before');
    wp_enqueue_script('elinar-script', $main_js_path, array(), $main_js_ver, true);

    // Локализация для AJAX
    wp_localize_script('elinar-script', 'elinarAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('elinar_contact_form_nonce'),
        'yandexMapsUrl' => $yandex_maps_url,
        'themeUrl' => get_template_directory_uri()
    ));

    // #region agent log
    // Debug: log enqueued CSS/JS handles per request for performance analysis (HTTP requests count)
    if (!defined('ELINAR_DEBUG_HTTP_LOGGED')) {
        define('ELINAR_DEBUG_HTTP_LOGGED', true);
        global $wp_styles, $wp_scripts;

        $template_type = 'other';
        if (is_front_page()) {
            $template_type = 'front-page';
        } elseif (is_page_template('page-about.php') || is_page('about')) {
            $template_type = 'about';
        } elseif (is_page_template('page-technologies-production.php') || strpos(filter_var(wp_unslash($_SERVER['REQUEST_URI'] ?? ''), FILTER_SANITIZE_URL), 'technologies') !== false) {
            $template_type = 'technologies';
        } elseif (is_page_template('page-contacts.php') || is_page('contacts')) {
            $template_type = 'contacts';
        } elseif (is_page_template('page-products.php') || is_page('products')) {
            $template_type = 'products';
        } elseif (is_page_template('page-quote-request.php') || strpos(filter_var(wp_unslash($_SERVER['REQUEST_URI'] ?? ''), FILTER_SANITIZE_URL), 'quote-request') !== false) {
            $template_type = 'quote-request';
        }

        $base_dir = defined('ABSPATH') ? rtrim(ABSPATH, "/\\") : dirname(dirname(dirname(__FILE__)));
        $debug_log_path = $base_dir . DIRECTORY_SEPARATOR . '.cursor' . DIRECTORY_SEPARATOR . 'debug.log';
        $payload = array(
            'sessionId'   => 'debug-session',
            'runId'       => 'pre-fix',
            'hypothesisId' => 'H1',
            'location'    => 'functions.php:elinar_scripts',
            'message'     => 'Enqueued assets snapshot',
            'data'        => array(
                'templateType'   => $template_type,
                'requestUri'     => isset($_SERVER['REQUEST_URI']) ? strtok(esc_url_raw($_SERVER['REQUEST_URI']), '?') : '',
                'stylesCount'    => isset($wp_styles, $wp_styles->queue) ? count((array) $wp_styles->queue) : 0,
                'scriptsCount'   => isset($wp_scripts, $wp_scripts->queue) ? count((array) $wp_scripts->queue) : 0,
                'stylesHandles'  => isset($wp_styles, $wp_styles->queue) ? array_values((array) $wp_styles->queue) : array(),
                'scriptsHandles' => isset($wp_scripts, $wp_scripts->queue) ? array_values((array) $wp_scripts->queue) : array(),
            ),
            'timestamp'   => round(microtime(true) * 1000),
        );
        $json = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json !== false && is_string($json)) {
            @file_put_contents($debug_log_path, $json . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }
    // #endregion agent log
}
add_action('wp_enqueue_scripts', 'elinar_scripts');

function elinar_dequeue_vendor_yandex_maps()
{
    if (is_admin()) {
        return;
    }

    $wp_scripts = wp_scripts();
    if (!$wp_scripts || !isset($wp_scripts->queue)) {
        return;
    }

    foreach ((array) $wp_scripts->queue as $handle) {
        $src = isset($wp_scripts->registered[$handle]) ? (string) $wp_scripts->registered[$handle]->src : '';
        if ($src && stripos($src, 'api-maps.yandex.ru/2.1/') !== false) {
            wp_dequeue_script($handle);
            wp_deregister_script($handle);
        }
    }
}
add_action('wp_enqueue_scripts', 'elinar_dequeue_vendor_yandex_maps', 999);

// ============================================================================
// 3. PERFORMANCE OPTIMIZATIONS
// ============================================================================

// Добавляем defer/async к скриптам для улучшения FCP и снижения TBT
function elinar_add_defer_to_scripts($tag, $handle, $src)
{
    // Уже содержит defer или async - не модифицируем
    if (strpos($tag, 'defer') !== false || strpos($tag, 'async') !== false) {
        return $tag;
    }

    // Критичные скрипты - без defer (нужны для рендеринга контента above-the-fold)
    // Эти скрипты НЕ добавляются ни в один список - загружаются стандартно
    $critical_scripts = array();

    // Важные скрипты - defer (зависимые, порядок выполнения важен)
    // GSAP и зависимые анимации - defer для снижения TBT
    $defer_scripts = array(
        'elinar-script',
        'production-slider',
        'quote-form',
        'glightbox-js',
        'gsap',
        'gsap-scrolltrigger',
        'hero-panorama',
        'products-timeline',
        'products-slider',
        'swiper-js',
        'injection-video-player',
        'audit-form',
        'elinar-about-js',
        'jspdf',
        'html2canvas',
        'products-pdf'
    );

    // Второстепенные скрипты - async (независимые, аналитика, виджеты)
    $async_scripts = array(
        'google-analytics',
        'gtag',
        'yandex-metrika',
        'facebook-pixel'
    );

    // Добавляем async для независимых скриптов
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }

    // Добавляем defer для важных скриптов
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
if (!defined('ELINAR_OPT_DEFER_SCRIPTS') || ELINAR_OPT_DEFER_SCRIPTS) {
    add_filter('script_loader_tag', 'elinar_add_defer_to_scripts', 10, 3);
}

// Автоматическое добавление loading="lazy" к изображениям в контенте с исключениями для LCP
function elinar_add_lazy_loading($content)
{
    // Исключения для критичных изображений:
    // - fetchpriority="high" - явно указан высокий приоритет
    // - Классы Hero-секции и слайдеров
    // - Уже имеют loading атрибут

    // Используем callback для более точной обработки
    $content = preg_replace_callback(
        '/<img([^>]*)>/i',
        function ($matches) {
            $attributes = $matches[1];

            // Уже есть loading атрибут - не модифицируем
            if (preg_match('/\bloading\s*=/i', $attributes)) {
                return $matches[0];
            }

            // Изображение с fetchpriority="high" - не добавляем lazy (LCP-критичное)
            if (preg_match('/\bfetchpriority\s*=\s*["\']high["\']/i', $attributes)) {
                return $matches[0];
            }

            // Исключения по классам (Hero, слайдеры, первые изображения)
            $exclude_classes = array(
                'hero-bg-img',
                'hero-panorama-image',
                'panorama-1',
                'slider-first',
                'slide-active',
                'lcp-image',
                'no-lazy'
            );

            foreach ($exclude_classes as $class) {
                if (preg_match('/\bclass\s*=\s*["\'][^"\']*\b' . preg_quote($class, '/') . '\b/i', $attributes)) {
                    return $matches[0];
                }
            }

            // Добавляем loading="lazy" для остальных изображений
            return '<img loading="lazy"' . $attributes . '>';
        },
        $content
    );

    return $content;
}
add_filter('the_content', 'elinar_add_lazy_loading', 10);
add_filter('post_thumbnail_html', 'elinar_add_lazy_loading', 10);
add_filter('get_avatar', 'elinar_add_lazy_loading', 10);

// Ускорение FCP: preconnect и dns-prefetch к внешним ресурсам
if (!function_exists('elinar_resource_hints')) {
    function elinar_resource_hints($hints, $relation_type)
    {
        $queued_styles = array();
        $queued_scripts = array();

        $styles = wp_styles();
        if ($styles && !empty($styles->queue)) {
            $queued_styles = (array) $styles->queue;
        }

        $scripts = wp_scripts();
        if ($scripts && !empty($scripts->queue)) {
            $queued_scripts = (array) $scripts->queue;
        }

        $uses_glightbox = in_array('glightbox-js', $queued_scripts, true)
            || in_array('glightbox-css', $queued_styles, true)
            || in_array('glightbox-custom', $queued_styles, true);
        $uses_gsap = in_array('gsap', $queued_scripts, true)
            || in_array('gsap-scrolltrigger', $queued_scripts, true);

        // Preconnect для критичных внешних ресурсов (устанавливает TCP/TLS соединение заранее)
        if ('preconnect' === $relation_type) {
            // Google Fonts (только если не используем локальные шрифты)
            if (!defined('ELINAR_OPT_LOCAL_FONTS') || !ELINAR_OPT_LOCAL_FONTS) {
                $hints[] = 'https://fonts.googleapis.com';
                $hints[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous');
            }
            // CDN для GSAP
            if ($uses_gsap) {
                $hints[] = array('href' => 'https://cdnjs.cloudflare.com', 'crossorigin' => 'anonymous');
            }
            // CDN для GLightbox
            if ($uses_glightbox) {
                $hints[] = array('href' => 'https://cdn.jsdelivr.net', 'crossorigin' => 'anonymous');
            }
        }

        // DNS-prefetch для дополнительных внешних ресурсов (резолвит DNS заранее)
        if ('dns-prefetch' === $relation_type) {
            if ($uses_gsap) {
                $hints[] = 'https://cdnjs.cloudflare.com';
            }
            if ($uses_glightbox) {
                $hints[] = 'https://cdn.jsdelivr.net';
            }
            if (!defined('ELINAR_OPT_LOCAL_FONTS') || !ELINAR_OPT_LOCAL_FONTS) {
                $hints[] = 'https://fonts.googleapis.com';
                $hints[] = 'https://fonts.gstatic.com';
            }
        }

        return $hints;
    }
}
if (!defined('ELINAR_OPT_RESOURCE_HINTS') || ELINAR_OPT_RESOURCE_HINTS) {
    add_filter('wp_resource_hints', 'elinar_resource_hints', 10, 2);
}

/**
 * Отложенная загрузка некритичных CSS (не влияют на above-the-fold контент)
 * Использует технику media="print" + onload="this.media='all'" для неблокирующей загрузки
 */
if (!function_exists('elinar_defer_non_critical_css')) {
    function elinar_defer_non_critical_css($html, $handle, $href, $media)
    {
        // ТОЛЬКО GLightbox - он не нужен до клика по галерее
        // production-slider виден сразу и даёт CLS при defer, поэтому не откладываем.
        $deferred_handles = array(
            'glightbox-css',        // Lightbox стили - не нужны до клика по галерее
            'glightbox-custom',     // Кастомные стили lightbox
        );

        if (function_exists('is_front_page') && is_front_page()) {
            $deferred_handles = array_merge($deferred_handles, array(
                'production-cycle',
                'key-directions',
                'front-page-inline',
                'audit-form',
            ));
        }

        if (!in_array($handle, $deferred_handles)) {
            return $html;
        }

        $href_esc = esc_url($href);
        $id = esc_attr($handle . '-css');

        // Неблокирующая загрузка: media=print + onload переключает на all
        $deferred = "<link rel='stylesheet' id='{$id}' href='{$href_esc}' media='print' onload=\"this.media='all'\" />\n";
        $deferred .= "<noscript><link rel='stylesheet' id='{$id}-noscript' href='{$href_esc}' /></noscript>\n";

        return $deferred;
    }
}
if (!defined('ELINAR_OPT_DEFER_NONCRIT_CSS') || ELINAR_OPT_DEFER_NONCRIT_CSS) {
    add_filter('style_loader_tag', 'elinar_defer_non_critical_css', 10, 4);
}

/**
 * Асинхронная загрузка основного CSS на главной странице (critical CSS уже инлайн).
 */
if (!function_exists('elinar_async_main_stylesheet')) {
    function elinar_async_main_stylesheet($html, $handle, $href, $media)
    {
        if ('elinar-style' !== $handle) {
            return $html;
        }

        if (!function_exists('is_front_page') || !is_front_page()) {
            return $html;
        }

        $href_esc = esc_url($href);
        $id = esc_attr($handle . '-css');

        $preload = "<link rel='preload' as='style' href='{$href_esc}' />\n";
        $async = "<link rel='stylesheet' id='{$id}' href='{$href_esc}' media='print' onload=\"this.media='all'\" />\n";
        $async .= "<noscript><link rel='stylesheet' id='{$id}-noscript' href='{$href_esc}' /></noscript>\n";

        return $preload . $async;
    }
}
if (!defined('ELINAR_OPT_ASYNC_MAIN_CSS') || ELINAR_OPT_ASYNC_MAIN_CSS) {
    add_filter('style_loader_tag', 'elinar_async_main_stylesheet', 10, 4);
}

if (!function_exists('elinar_async_fonts_stylesheet')) {
    function elinar_async_fonts_stylesheet($html, $handle, $href, $media)
    {
        if ('elinar-fonts' !== $handle) {
            return $html;
        }

        $href_esc = esc_url($href);
        $id = esc_attr($handle . '-css');

        // Неблокирующая загрузка CSS: media=print + onload -> all
        $new = "<link rel='stylesheet' id='{$id}' href='{$href_esc}' media='print' onload=\"this.media='all'\" />\n";
        $new .= "<noscript><link rel='stylesheet' href='{$href_esc}' /></noscript>\n";

        return $new;
    }
}
if (!defined('ELINAR_OPT_ASYNC_FONTS') || ELINAR_OPT_ASYNC_FONTS) {
    add_filter('style_loader_tag', 'elinar_async_fonts_stylesheet', 10, 4);
}


/**
 * Возвращает путь к приватному лог-файлу вне webroot (предпочтительно) либо в закрытой папке внутри wp-content (fallback).
 * ВАЖНО: логи могут содержать PII, поэтому не должны лежать в директории темы.
 */
if (!function_exists('elinar_private_log_file')) {
    function elinar_private_log_file($filename)
    {
        $filename = basename((string) $filename);

        // Предпочтительный путь: рядом с папкой public (ABSPATH обычно указывает на .../ public/)
        $base_dir = defined('ABSPATH') ? dirname(rtrim(ABSPATH, "/\\")) : dirname(__DIR__);
        $dir = $base_dir . DIRECTORY_SEPARATOR . 'logs';

        if (function_exists('wp_mkdir_p')) {
            wp_mkdir_p($dir);
        } else {
            @mkdir($dir, 0750, true);
        }

        // Fallback: внутри wp-content, но стараемся закрыть веб-доступ (для Apache)
        if (!is_dir($dir) || !is_writable($dir)) {
            $dir = (defined('WP_CONTENT_DIR') ? WP_CONTENT_DIR : dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'private-logs';

            if (function_exists('wp_mkdir_p')) {
                wp_mkdir_p($dir);
            } else {
                @mkdir($dir, 0750, true);
            }

            $htaccess = $dir . DIRECTORY_SEPARATOR . '.htaccess';
            if (!file_exists($htaccess)) {
                @file_put_contents($htaccess, "<IfModule mod_authz_core.c>\n    Require all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\n    Order Allow,Deny\n    Deny from all\n</IfModule>\n");
            }
            $index = $dir . DIRECTORY_SEPARATOR . 'index.php';
            if (!file_exists($index)) {
                @file_put_contents($index, "<?php\n// Silence is golden.\n");
            }
        }

        return $dir . DIRECTORY_SEPARATOR . $filename;
    }
}

if (!function_exists('elinar_delivery_log')) {
    function elinar_delivery_log($form_key, $payload = array())
    {
        if (!function_exists('elinar_private_log_file')) {
            return;
        }

        $entry = array(
            'time' => wp_date('Y-m-d H:i:s'),
            'form' => sanitize_key((string) $form_key),
            'payload' => is_array($payload) ? $payload : array(),
        );

        $line = wp_json_encode($entry, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if (is_string($line) && $line !== '') {
            @file_put_contents(elinar_private_log_file('delivery-log.txt'), $line . "\n", FILE_APPEND | LOCK_EX);
        }
    }
}

if (!function_exists('elinar_is_local_environment')) {
    function elinar_is_local_environment()
    {
        $home = function_exists('home_url') ? (string) home_url() : '';
        return (
            strpos($home, 'localhost') !== false ||
            strpos($home, '127.0.0.1') !== false ||
            strpos($home, '.local') !== false
        );
    }
}

/**
 * Почтовые адреса и заголовки для форм.
 * Важно: единый From повышает доставляемость писем после смены домена.
 */
if (!function_exists('elinar_get_primary_email')) {
    function elinar_get_primary_email()
    {
        if (defined('ELINAR_PRIMARY_EMAIL') && is_email(ELINAR_PRIMARY_EMAIL)) {
            return ELINAR_PRIMARY_EMAIL;
        }

        return 'plast@elinar.ru';
    }
}

if (!function_exists('elinar_get_copy_email')) {
    function elinar_get_copy_email()
    {
        if (defined('ELINAR_COPY_EMAIL') && is_email(ELINAR_COPY_EMAIL)) {
            return ELINAR_COPY_EMAIL;
        }

        return 'varslavanyury@gmail.com';
    }
}

if (!function_exists('elinar_get_from_email')) {
    function elinar_get_from_email()
    {
        if (defined('ELINAR_FROM_EMAIL') && is_email(ELINAR_FROM_EMAIL)) {
            return ELINAR_FROM_EMAIL;
        }

        $primary_email = elinar_get_primary_email();
        if (is_email($primary_email)) {
            return $primary_email;
        }

        $host = parse_url(home_url(), PHP_URL_HOST);
        $host = is_string($host) ? trim($host) : '';

        return $host !== '' ? 'wordpress@' . $host : 'wordpress@localhost.localdomain';
    }
}

if (!function_exists('elinar_build_mail_headers')) {
    function elinar_build_mail_headers($reply_to = '', $from_name = 'Элинар Пласт')
    {
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        $from_email = elinar_get_from_email();

        if ($from_name !== '') {
            $headers[] = 'From: ' . $from_name . ' <' . $from_email . '>';
        } else {
            $headers[] = 'From: ' . $from_email;
        }

        if (!empty($reply_to) && is_email($reply_to)) {
            $headers[] = 'Reply-To: ' . $reply_to;
        }

        return $headers;
    }
}

if (!function_exists('elinar_build_simple_mail_headers')) {
    function elinar_build_simple_mail_headers($reply_to = '')
    {
        $headers = 'From: ' . elinar_get_from_email() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (!empty($reply_to) && is_email($reply_to)) {
            $headers .= 'Reply-To: ' . $reply_to . "\r\n";
        }

        return $headers;
    }
}

/**
 * Настройка таймаута SMTP для WP Mail SMTP.
 * Уменьшает зависания формы при недоступном SMTP-хосте.
 */
if (!function_exists('elinar_tune_wp_mail_smtp_timeout')) {
    function elinar_tune_wp_mail_smtp_timeout($phpmailer)
    {
        if (!is_object($phpmailer)) {
            return $phpmailer;
        }

        // По умолчанию не трогаем таймауты PHPMailer/WP Mail SMTP.
        // Это снижает риск ложных timeout на медленных/VPN-каналах.
        if (!defined('ELINAR_SMTP_TIMEOUT')) {
            return $phpmailer;
        }

        $timeout = (int) ELINAR_SMTP_TIMEOUT;
        if ($timeout < 3) {
            $timeout = 3;
        }

        if (property_exists($phpmailer, 'Timeout')) {
            $phpmailer->Timeout = $timeout;
        }
        if (property_exists($phpmailer, 'Timelimit')) {
            $phpmailer->Timelimit = $timeout;
        }

        return $phpmailer;
    }
}
add_filter('wp_mail_smtp_custom_options', 'elinar_tune_wp_mail_smtp_timeout', 20);

if (!function_exists('elinar_is_smtp_connectivity_error')) {
    function elinar_is_smtp_connectivity_error($error_text)
    {
        if (!is_string($error_text) || $error_text === '') {
            return false;
        }

        $error_text = strtolower($error_text);
        $needles = array(
            'could not connect to smtp host',
            'failed to connect to server',
            'connection timed out',
            'stream_socket_client',
            'smtp code: 110',
        );

        foreach ($needles as $needle) {
            if (strpos($error_text, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}

/**
 * Унифицированная отправка письма:
 * 1) пробует wp_mail (SMTP/плагины),
 * 2) при неудаче и отсутствии вложений — fallback на mail().
 *
 * @return array{sent:bool,via:string,wp_mail_error:string}
 */
if (!function_exists('elinar_send_mail_with_fallback')) {
    function elinar_send_mail_with_fallback($to, $subject, $message, $headers = array(), $attachments = array(), $reply_to = '')
    {
        static $skip_wp_mail_for_request = false;
        $allow_mail_fallback = defined('ELINAR_ENABLE_MAIL_FALLBACK')
            ? (bool) ELINAR_ENABLE_MAIL_FALLBACK
            : elinar_is_local_environment();

        $result = array(
            'sent' => false,
            'via' => 'none',
            'wp_mail_error' => '',
        );

        $to = (string) $to;
        $subject = (string) $subject;
        $message = (string) $message;
        $headers = is_array($headers) ? $headers : array();
        $attachments = is_array($attachments) ? $attachments : array();

        $should_skip_wp_mail = $skip_wp_mail_for_request;

        if ($should_skip_wp_mail) {
            // mail() не умеет корректно работать с вложениями в этом упрощенном fallback.
            if ($allow_mail_fallback && empty($attachments) && function_exists('mail')) {
                $simple_headers = elinar_build_simple_mail_headers($reply_to);
                $fallback_sent = @mail($to, $subject, $message, $simple_headers);
                if ($fallback_sent) {
                    $result['sent'] = true;
                    $result['via'] = 'mail';
                }
            }
            return $result;
        }

        $wp_mail_error = '';
        $wp_mail_error_callback = function ($wp_error) use (&$wp_mail_error) {
            if (is_wp_error($wp_error)) {
                $wp_mail_error = $wp_error->get_error_message();
            }
        };

        add_action('wp_mail_failed', $wp_mail_error_callback);
        $mail_sent = wp_mail($to, $subject, $message, $headers, $attachments);
        remove_action('wp_mail_failed', $wp_mail_error_callback);

        if ($mail_sent) {
            $result['sent'] = true;
            $result['via'] = 'wp_mail';
            return $result;
        }

        $result['wp_mail_error'] = $wp_mail_error;
        $is_connectivity_error = elinar_is_smtp_connectivity_error($wp_mail_error);
        // В пределах текущего запроса не повторяем только ошибки сетевого подключения.
        $skip_wp_mail_for_request = $is_connectivity_error;

        // При ошибках аутентификации/настроек не подменяем результат fallback-ом.
        if (!$is_connectivity_error) {
            return $result;
        }

        // mail() не умеет корректно работать с вложениями в этом упрощенном fallback.
        if (!$allow_mail_fallback || !empty($attachments) || !function_exists('mail')) {
            return $result;
        }

        $simple_headers = elinar_build_simple_mail_headers($reply_to);
        $fallback_sent = @mail($to, $subject, $message, $simple_headers);

        if ($fallback_sent) {
            $result['sent'] = true;
            $result['via'] = 'mail';
        }

        return $result;
    }
}

// ============================================================================
// 4. CUSTOM ROUTING (FALLBACK)
// ============================================================================

// Перехватываем 404 ошибку для technologies-and-contract-manufacturing
add_action('template_redirect', function () {
    if (is_404()) {
        $url_path = isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '';
        $url_path = filter_var($url_path, FILTER_SANITIZE_URL);

        // Проверяем URL для technologies-and-contract-manufacturing
        if (
            strpos($url_path, 'technologies-and-contract-manufacturing') !== false ||
            strpos($url_path, 'technologies-production') !== false ||
            strpos($url_path, 'technologies') !== false
        ) {
            $template = locate_template(array('page-technologies-production.php'));
            if ($template !== '') {
                status_header(200); // Устанавливаем статус 200 вместо 404
                include($template);
                exit;
            }
        }
    }
}, 1); // Приоритет 1 для раннего срабатывания

// --- Rounting Hack for Static Prototype ---
add_filter('template_include', function ($template) {
    $url_path = isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '';
    $url_path = filter_var($url_path, FILTER_SANITIZE_URL);

    if (strpos($url_path, 'about') !== false) {
        $new_template = locate_template(array('page-about.php'));
        if ($new_template !== '') {
            return $new_template;
        }
    }
    if (
        strpos($url_path, 'technologies-and-contract-manufacturing') !== false ||
        strpos($url_path, 'technologies-production') !== false ||
        strpos($url_path, 'technologies') !== false
    ) {
        $new_template = locate_template(array('page-technologies-production.php'));
        if ($new_template !== '') {
            return $new_template;
        }
    }

    // WordPress will handle it automatically through the page template
    return $template;
});

/**
 * Возвращает путь к приватному лог-файлу вне webroot (предпочтительно) либо в закрытой папке внутри wp-content (fallback).
 * ВАЖНО: логи могут содержать PII, поэтому не должны лежать в директории темы.
 */


// ============================================================================
// 5. MENU CUSTOMIZATION
// ============================================================================

// Убираем пункт "Главная" из меню (логотип используется для перехода на главную)
function elinar_remove_home_from_menu($items, $args)
{
    if ($args->theme_location == 'primary') {
        foreach ($items as $key => $item) {
            // Проверяем, является ли пункт меню ссылкой на главную страницу
            $home_url = home_url('/');
            $item_url = rtrim($item->url, '/');
            $home_url_clean = rtrim($home_url, '/');

            // Удаляем если это главная страница или если название "Главная"
            if (
                $item_url == $home_url_clean ||
                strtolower(trim($item->title)) == 'главная' ||
                strtolower(trim($item->title)) == 'home'
            ) {
                unset($items[$key]);
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'elinar_remove_home_from_menu', 10, 2);

// ============================================================================
// 6. HELPER FUNCTIONS
// ============================================================================

// Helper to limit content length
function elinar_excerpt(int $limit): string
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
    return $excerpt;
}

// ============================================================================
// 7. BREADCRUMBS
// ============================================================================

// Breadcrumb Navigation Function
function elinar_breadcrumbs()
{
    $current_url = isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '';
    $current_url = filter_var($current_url, FILTER_SANITIZE_URL);
    $current_url = rtrim($current_url, '/');

    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-12">';
    echo '<ul class="breadcrumbs-list">';

    // Home link - always show
    echo '<li>';
    echo '<a href="' . esc_url(home_url('/')) . '">';
    echo '<figure>';
    echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" style="enable-background:new 0 0 30 30;" xml:space="preserve">';
    echo '<polygon class="st0" points="15,3.5 2.5,15.5 4.5,15.5 4.5,29.5 12.5,29.5 12.5,21.5 17.5,21.5 17.5,29.5 25.5,29.5 25.5,15.5 27.5,15.5 "></polygon>';
    echo '</svg>';
    echo '</figure>';
    echo '</a>';
    echo '</li>';

    // If on front page, just show home
    if (is_front_page()) {
        echo '<li><span>Главная</span></li>';
    }
    // Check for "technologies-production" page
    elseif (
        strpos($current_url, 'technologies-and-contract-manufacturing') !== false ||
        strpos($current_url, 'technologies-production') !== false ||
        strpos($current_url, 'technologies') !== false ||
        strpos($current_url, 'production') !== false
    ) {
        echo '<li><span>Производство</span></li>';
    }
    // Check for "about" page
    elseif (strpos($current_url, 'about') !== false) {
        echo '<li><span>О нас</span></li>';
    }
    // Check for "quote-request" page
    elseif (strpos($current_url, 'quote-request') !== false || strpos($current_url, 'zapros-rascheta') !== false) {
        echo '<li><span>Запрос на расчет</span></li>';
    }
    // Page hierarchy
    elseif (is_page()) {
        $page = get_queried_object();
        if ($page && isset($page->ID)) {
            $ancestors = get_post_ancestors($page->ID);

            // Add parent pages
            if ($ancestors) {
                $ancestors = array_reverse($ancestors);
                foreach ($ancestors as $ancestor_id) {
                    echo '<li><a href="' . esc_url(get_permalink($ancestor_id)) . '">' . esc_html(get_the_title($ancestor_id)) . '</a></li>';
                }
            }

            // Check if this page is in a menu and has parent menu item
            $menu_items = wp_get_nav_menu_items('primary');
            if ($menu_items) {
                $current_page_id = $page->ID;
                $parent_menu_item = null;
                $current_menu_item = null;

                // First, try to find by page ID
                foreach ($menu_items as $menu_item) {
                    if ($menu_item->object_id == $current_page_id && $menu_item->menu_item_parent != 0) {
                        $current_menu_item = $menu_item;
                        // This is a submenu item, find its parent
                        foreach ($menu_items as $parent_item) {
                            if ($parent_item->ID == $menu_item->menu_item_parent) {
                                $parent_menu_item = $parent_item;
                                break;
                            }
                        }
                        break;
                    }
                }

                // If not found by ID, try to find by URL
                if (!$current_menu_item) {
                    $page_url = rtrim(parse_url(get_permalink($page->ID), PHP_URL_PATH), '/');
                    foreach ($menu_items as $menu_item) {
                        $menu_url = rtrim(parse_url($menu_item->url, PHP_URL_PATH), '/');
                        if ($menu_url == $page_url && $menu_item->menu_item_parent != 0) {
                            $current_menu_item = $menu_item;
                            foreach ($menu_items as $parent_item) {
                                if ($parent_item->ID == $menu_item->menu_item_parent) {
                                    $parent_menu_item = $parent_item;
                                    break;
                                }
                            }
                            break;
                        }
                    }
                }

                // If found parent menu item and it's not already in ancestors, add it
                if ($parent_menu_item && (!$ancestors || !in_array($parent_menu_item->object_id, $ancestors))) {
                    echo '<li><a href="' . esc_url($parent_menu_item->url) . '">' . esc_html($parent_menu_item->title) . '</a></li>';
                }
            }

            // Current page
            echo '<li><span>' . esc_html(get_the_title()) . '</span></li>';
        } else {
            // Fallback if page object is not available
            echo '<li><span>' . esc_html(get_the_title()) . '</span></li>';
        }
    }
    // Single post
    elseif (is_single()) {
        $categories = get_the_category();
        if ($categories) {
            $category = $categories[0];
            echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
        }
        echo '<li><span>' . esc_html(get_the_title()) . '</span></li>';
    }
    // Category archive
    elseif (is_category()) {
        echo '<li><span>' . esc_html(single_cat_title('', false)) . '</span></li>';
    }
    // Tag archive
    elseif (is_tag()) {
        echo '<li><span>' . esc_html(single_tag_title('', false)) . '</span></li>';
    }
    // Archive
    elseif (is_archive()) {
        echo '<li><span>' . esc_html(get_the_archive_title()) . '</span></li>';
    }
    // Search
    elseif (is_search()) {
        echo '<li><span>Результаты поиска</span></li>';
    }
    // 404 - only show if really 404
    elseif (is_404()) {
        echo '<li><span>Страница не найдена</span></li>';
    }
    // Fallback for any other case
    else {
        // Try to get title from current query
        if (have_posts()) {
            the_post();
            echo '<li><span>' . esc_html(get_the_title()) . '</span></li>';
            rewind_posts();
        }
    }

    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

// ============================================================================
// 8. AJAX HANDLERS
// ============================================================================

// --- Обработчик формы "Запросить расчет" ---
function elinar_handle_contact_form()
{
    // Проверка nonce для безопасности
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'elinar_contact_form_nonce')) {
        wp_send_json_error(array('message' => 'Ошибка безопасности. Пожалуйста, обновите страницу и попробуйте снова.'));
    }

    // Получаем и очищаем данные
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $question = isset($_POST['question']) ? sanitize_textarea_field($_POST['question']) : '';
    $consent = isset($_POST['consent']) ? true : false;

    // Валидация
    $errors = array();

    // Проверка согласия на обработку персональных данных
    if (!$consent) {
        $errors[] = 'Необходимо дать согласие на обработку персональных данных.';
    }

    if (empty($phone)) {
        $errors[] = 'Пожалуйста, укажите ваш телефон.';
    } elseif (!preg_match('/^[\d\s\-\+\(\)]+$/', $phone)) {
        $errors[] = 'Некорректный формат телефона.';
    }

    if (empty($question)) {
        $errors[] = 'Пожалуйста, укажите ваш вопрос.';
    }

    if (!empty($email) && !is_email($email)) {
        $errors[] = 'Некорректный формат email.';
    }

    // Если есть ошибки, возвращаем их
    if (!empty($errors)) {
        wp_send_json_error(array('message' => implode(' ', $errors)));
    }

    // Email-адреса из конфигурации с fallback на значения по умолчанию
    $to = elinar_get_primary_email();
    $to_copy = elinar_get_copy_email();

    // Тема письма
    $subject = 'Новая заявка на расчет проекта - Элинар Пласт';

    // Тело письма
    $message = "Поступила новая заявка на расчет проекта с сайта.\n\n";
    if (!empty($name)) {
        $message .= "Имя: " . $name . "\n";
    }
    $message .= "Телефон: " . $phone . "\n";
    if (!empty($email)) {
        $message .= "Email: " . $email . "\n";
    }
    $message .= "Вопрос: " . $question . "\n";

    // Получаем текущее время в московском часовом поясе
    $moscow_timezone = new DateTimeZone('Europe/Moscow');
    $current_time = new DateTime('now', $moscow_timezone);
    $formatted_date = $current_time->format('d.m.Y H:i:s');
    $log_date = $current_time->format('Y-m-d H:i:s');

    $message .= "\nДата и время: " . $formatted_date . "\n";
    $message .= "IP адрес: " . elinar_get_real_ip() . "\n";

    $request_id = 'CNT-' . wp_date('Ymd') . '-' . strtoupper(substr(md5(uniqid('', true)), 0, 6));
    $page_url = wp_get_referer();
    if (!is_string($page_url) || $page_url === '') {
        $page_url = home_url('/');
    }

    // Сохраняем заявку в лог-файл (резервный вариант)
    $log_entry = $log_date . " | Имя: " . (!empty($name) ? $name : 'не указано') . " | Телефон: {$phone} | Email: " . (!empty($email) ? $email : 'не указан') . " | Вопрос: {$question} | IP: " . elinar_get_real_ip() . "\n";
    $log_file = elinar_private_log_file('contact-form-log.txt');
    @file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);

    $telegram_sent = elinar_send_telegram_notification(array(
        'name' => !empty($name) ? $name : 'Не указано',
        'phone' => $phone,
        'email' => !empty($email) ? $email : 'Не указан',
        'message' => $question,
        'page_source' => 'формы Запросить расчет проекта',
        'request_id' => $request_id,
        'page_url' => $page_url,
        'attachment_paths' => array(),
        'attachment_names' => array(),
    ));

    // Заголовки письма
    $headers = elinar_build_mail_headers($email);

    // Отправка на основной адрес (с fallback на mail())
    $primary_send = elinar_send_mail_with_fallback($to, $subject, $message, $headers, array(), $email);
    $mail_sent = !empty($primary_send['sent']);
    $wp_mail_error = isset($primary_send['wp_mail_error']) ? (string) $primary_send['wp_mail_error'] : '';

    // Независимая отправка копии на резервный адрес
    elinar_send_mail_with_fallback($to_copy, $subject, $message, $headers, array(), $email);

    elinar_delivery_log('contact_form', array(
        'request_id' => $request_id,
        'mail_sent' => (bool) $mail_sent,
        'mail_via' => isset($primary_send['via']) ? (string) $primary_send['via'] : '',
        'wp_mail_error' => $wp_mail_error,
        'to' => $to,
        'telegram_sent' => (bool) $telegram_sent,
    ));

    // Если письмо отправлено успешно
    if ($mail_sent || $telegram_sent) {
        wp_send_json_success(array('message' => 'Спасибо! Ваша заявка успешно отправлена. Мы свяжемся с вами в ближайшее время.'));
    } else {
        // На локальном сервере или при проблемах с почтой - все равно показываем успех,
        // так как заявка сохранена в лог-файл
        // На продакшене можно оставить ошибку, но для разработки лучше показывать успех

        // Проверяем, локальный ли это сервер
        $is_local = (
            strpos(home_url(), 'localhost') !== false ||
            strpos(home_url(), '127.0.0.1') !== false ||
            strpos(home_url(), '.local') !== false ||
            strpos(home_url(), 'local') !== false
        );

        if ($is_local) {
            // На локальном сервере показываем успех, так как заявка сохранена в лог
            wp_send_json_success(array('message' => 'Спасибо! Ваша заявка получена. Мы свяжемся с вами в ближайшее время. (Заявка сохранена в лог-файл)'));
        } else {
            // На продакшене показываем ошибку
            $error_msg = 'Произошла ошибка при отправке заявки. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.';
            if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('administrator') && $wp_mail_error) {
                $error_msg .= ' (Отладка: ' . esc_html($wp_mail_error) . ')';
            }
            wp_send_json_error(array('message' => $error_msg));
        }
    }
}

// AJAX обработчики для авторизованных и неавторизованных пользователей
add_action('wp_ajax_elinar_contact_form', 'elinar_handle_contact_form');
add_action('wp_ajax_nopriv_elinar_contact_form', 'elinar_handle_contact_form');

// --- Обработчик формы запроса КП ---
function elinar_handle_quote_form()
{
    // Проверка nonce для безопасности
    if (!isset($_POST['quote_nonce']) || !wp_verify_nonce($_POST['quote_nonce'], 'elinar_quote_form_nonce')) {
        wp_send_json_error(array('message' => 'Ошибка безопасности. Пожалуйста, обновите страницу и попробуйте снова.'));
    }

    // Honeypot check
    if (!empty($_POST['website_url'])) {
        wp_send_json_error(array('message' => 'Ошибка отправки формы.'));
    }

    // Получаем и очищаем данные
    $technology = isset($_POST['technology']) ? sanitize_text_field($_POST['technology']) : '';
    $project_name = isset($_POST['project_name']) ? sanitize_text_field($_POST['project_name']) : '';
    $product_type_extrusion = isset($_POST['product_type_extrusion']) ? sanitize_text_field($_POST['product_type_extrusion']) : '';
    $product_type_injection = isset($_POST['product_type_injection']) ? sanitize_text_field($_POST['product_type_injection']) : '';
    $project_stage = isset($_POST['project_stage']) ? sanitize_text_field($_POST['project_stage']) : '';
    $material = isset($_POST['material']) ? sanitize_text_field($_POST['material']) : '';
    $material_other = isset($_POST['material_other']) ? sanitize_text_field($_POST['material_other']) : '';
    $color_type = isset($_POST['color_type']) ? sanitize_text_field($_POST['color_type']) : '';
    $color_value = isset($_POST['color_value']) ? sanitize_text_field($_POST['color_value']) : '';

    // Габариты
    $width_diameter = isset($_POST['width_diameter']) ? sanitize_text_field($_POST['width_diameter']) : '';
    $height_extrusion = isset($_POST['height_extrusion']) ? sanitize_text_field($_POST['height_extrusion']) : '';
    $wall_thickness = isset($_POST['wall_thickness']) ? sanitize_text_field($_POST['wall_thickness']) : '';
    $length_injection = isset($_POST['length_injection']) ? sanitize_text_field($_POST['length_injection']) : '';
    $width_injection = isset($_POST['width_injection']) ? sanitize_text_field($_POST['width_injection']) : '';
    $height_injection = isset($_POST['height_injection']) ? sanitize_text_field($_POST['height_injection']) : '';
    $weight_injection = isset($_POST['weight_injection']) ? sanitize_text_field($_POST['weight_injection']) : '';

    $special_requirements = isset($_POST['special_requirements']) ? sanitize_textarea_field($_POST['special_requirements']) : '';
    $production_volume = isset($_POST['production_volume']) ? sanitize_text_field($_POST['production_volume']) : '';
    $volume_monthly = isset($_POST['volume_monthly']) ? sanitize_text_field($_POST['volume_monthly']) : '';
    $volume_unit = isset($_POST['volume_unit']) ? sanitize_text_field($_POST['volume_unit']) : '';
    $production_start = isset($_POST['production_start']) ? sanitize_text_field($_POST['production_start']) : '';
    $target_price = isset($_POST['target_price']) ? sanitize_text_field($_POST['target_price']) : '';
    $tooling_status = isset($_POST['tooling_status']) ? sanitize_text_field($_POST['tooling_status']) : '';
    $additional_requirements = isset($_POST['additional_requirements']) ? sanitize_textarea_field($_POST['additional_requirements']) : '';

    // Контактные данные
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $contact_person = isset($_POST['contact_person']) ? sanitize_text_field($_POST['contact_person']) : '';
    $position = isset($_POST['position']) ? sanitize_text_field($_POST['position']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $contact_method = isset($_POST['contact_method']) ? sanitize_text_field($_POST['contact_method']) : '';

    // Валидация обязательных полей
    $errors = array();

    if (empty($technology)) {
        $errors[] = 'Выберите технологию производства.';
    }
    if (empty($project_name) || strlen($project_name) < 5) {
        $errors[] = 'Укажите название проекта (минимум 5 символов).';
    }
    if (empty($project_stage)) {
        $errors[] = 'Укажите стадию проекта.';
    }
    if (empty($material)) {
        $errors[] = 'Выберите материал изделия.';
    }
    if (empty($production_volume)) {
        $errors[] = 'Укажите планируемый объем производства.';
    }
    if (empty($company)) {
        $errors[] = 'Укажите название компании.';
    }
    if (empty($contact_person)) {
        $errors[] = 'Укажите контактное лицо.';
    }
    if (empty($phone)) {
        $errors[] = 'Укажите телефон.';
    } elseif (!preg_match('/^[\d\s\-\+\(\)]{10,20}$/', $phone)) {
        $errors[] = 'Некорректный формат телефона.';
    }
    if (empty($email)) {
        $errors[] = 'Укажите email.';
    } elseif (!is_email($email)) {
        $errors[] = 'Некорректный формат email.';
    }

    if (!empty($errors)) {
        wp_send_json_error(array('message' => implode(' ', $errors)));
    }

    // Обработка файлов
    $uploaded_files = array();
    $upload_dir = wp_upload_dir();
    $quote_upload_dir = $upload_dir['basedir'] . '/quote-requests/' . date('Y/m');

    if (!file_exists($quote_upload_dir)) {
        wp_mkdir_p($quote_upload_dir);
    }

    // Создаем .htaccess для защиты загруженных файлов
    $htaccess_file = $upload_dir['basedir'] . '/quote-requests/.htaccess';
    if (!file_exists($htaccess_file)) {
        file_put_contents($htaccess_file, "Options -Indexes\n<IfModule mod_authz_core.c>\n    <FilesMatch \"\\.(php|php3|php4|php5|phtml)$\">\n        Require all denied\n    </FilesMatch>\n</IfModule>\n<IfModule !mod_authz_core.c>\n    <FilesMatch \"\\.(php|php3|php4|php5|phtml)$\">\n        Order Deny,Allow\n        Deny from all\n    </FilesMatch>\n</IfModule>");
    }

    if (!empty($_FILES['files']['name'][0])) {
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf', 'dwg', 'dxf', 'step', 'stp', 'iges', 'igs', 'stl');
        $max_file_size = 10 * 1024 * 1024; // 10 MB per file
        $allowed_mimes = array(
            'jpg|jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'pdf' => 'application/pdf',
            'dwg|dxf|step|stp|iges|igs|stl' => 'application/octet-stream',
        );

        $file_count = count($_FILES['files']['name']);

        if ($file_count > 5) {
            wp_send_json_error(array('message' => 'Максимум 5 файлов.'));
        }

        for ($i = 0; $i < $file_count; $i++) {
            if ($_FILES['files']['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }

            $file = array(
                'name' => $_FILES['files']['name'][$i],
                'type' => $_FILES['files']['type'][$i],
                'tmp_name' => $_FILES['files']['tmp_name'][$i],
                'error' => $_FILES['files']['error'][$i],
                'size' => $_FILES['files']['size'][$i]
            );

            $file_ext = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
            if (!in_array($file_ext, $allowed_extensions, true)) {
                wp_send_json_error(array('message' => 'Недопустимый формат файла. Разрешены: JPG, PNG, PDF, DWG, DXF, STEP, STP, IGES, STL.'));
            }

            if ((int) $file['size'] > $max_file_size) {
                wp_send_json_error(array('message' => 'Файл слишком большой. Максимальный размер: 10 МБ.'));
            }

            // Для CAD-файлов MIME определяется на разных серверах по-разному.
            // Проверку типа делаем по whitelist расширений выше.
            $upload_overrides = array(
                'test_form' => false,
                'test_type' => false,
                'mimes' => $allowed_mimes,
                'test_size' => true,
                'unique_filename_callback' => function ($dir, $name, $ext) {
                    return uniqid() . '_' . $name;
                }
            );

            $upload = wp_handle_upload($file, $upload_overrides);

            if (isset($upload['error'])) {
                wp_send_json_error(array('message' => $upload['error']));
            }

            if (isset($upload['file'])) {
                $file_size = $upload['file'] && file_exists($upload['file']) ? filesize($upload['file']) : 0;
                $uploaded_files[] = array(
                    'name' => $file['name'],
                    'path' => $upload['file'],
                    'url' => $upload['url'],
                    'size' => $file_size
                );
            }
        }
    }

    // Формируем текст письма
    $technology_labels = array(
        'extrusion' => 'Экструзия',
        'injection' => 'Литье под давлением',
        'consultation' => 'Требуется консультация'
    );

    $stage_labels = array(
        'sample' => 'Есть готовый образец',
        'drawing' => 'Есть чертеж / 3D-модель',
        'sketch' => 'Есть эскиз / набросок',
        'description' => 'Только техническое описание',
        'from_scratch' => 'Требуется разработка с нуля'
    );

    $material_labels = array(
        'pvc_rigid' => 'ПВХ жесткий (PVC-U)',
        'pvc_flex' => 'ПВХ пластифицированный (PVC-P)',
        'pp' => 'Полипропилен (PP)',
        'pe' => 'Полиэтилен (PE)',
        'abs' => 'АБС-пластик (ABS)',
        'pc' => 'Поликарбонат (PC)',
        'pa' => 'Полиамид (PA)',
        'composite' => 'Композитные материалы',
        'undefined' => 'Не определен / требуется подбор',
        'other' => 'Другой'
    );

    $moscow_timezone = new DateTimeZone('Europe/Moscow');
    $current_time = new DateTime('now', $moscow_timezone);
    $formatted_date = $current_time->format('d.m.Y H:i:s');
    $request_id = $current_time->format('Ymd-His') . '-' . substr(uniqid(), -4);

    $message = "═══════════════════════════════════════════════════════════\n";
    $message .= "  ЗАПРОС НА РАСЧЕТ ПРОИЗВОДСТВА №{$request_id}\n";
    $message .= "═══════════════════════════════════════════════════════════\n\n";

    $message .= "▶ ТЕХНОЛОГИЯ ПРОИЗВОДСТВА\n";
    $message .= "  " . ($technology_labels[$technology] ?? $technology) . "\n\n";

    $message .= "▶ ИНФОРМАЦИЯ О ПРОЕКТЕ\n";
    $message .= "  Название: {$project_name}\n";
    if ($technology === 'extrusion' && !empty($product_type_extrusion)) {
        $message .= "  Тип изделия: {$product_type_extrusion}\n";
    }
    if ($technology === 'injection' && !empty($product_type_injection)) {
        $message .= "  Тип изделия: {$product_type_injection}\n";
    }
    $message .= "  Стадия проекта: " . ($stage_labels[$project_stage] ?? $project_stage) . "\n\n";

    $message .= "▶ ТЕХНИЧЕСКИЕ ПАРАМЕТРЫ\n";
    $message .= "  Материал: " . ($material_labels[$material] ?? $material);
    if ($material === 'other' && !empty($material_other)) {
        $message .= " ({$material_other})";
    }
    $message .= "\n";

    $color_labels = array('natural' => 'Натуральный', 'colored' => 'Окраска в массе', 'no_requirements' => 'Без требований');
    $message .= "  Цвет: " . ($color_labels[$color_type] ?? $color_type);
    if ($color_type === 'colored' && !empty($color_value)) {
        $message .= " ({$color_value})";
    }
    $message .= "\n";

    // Габариты
    if ($technology === 'extrusion') {
        $dims = array();
        if (!empty($width_diameter)) $dims[] = "Ширина/диаметр: {$width_diameter} мм";
        if (!empty($height_extrusion)) $dims[] = "Высота: {$height_extrusion} мм";
        if (!empty($wall_thickness)) $dims[] = "Толщина стенки: {$wall_thickness} мм";
        if (!empty($dims)) {
            $message .= "  Габариты: " . implode(', ', $dims) . "\n";
        }
    } else {
        $dims = array();
        if (!empty($length_injection)) $dims[] = "Д: {$length_injection}";
        if (!empty($width_injection)) $dims[] = "Ш: {$width_injection}";
        if (!empty($height_injection)) $dims[] = "В: {$height_injection}";
        if (!empty($weight_injection)) $dims[] = "Масса: {$weight_injection} г";
        if (!empty($dims)) {
            $message .= "  Габариты: " . implode(' × ', $dims) . " мм\n";
        }
    }

    if (!empty($special_requirements)) {
        $message .= "  Особые требования: {$special_requirements}\n";
    }
    $message .= "\n";

    $message .= "▶ ПРОИЗВОДСТВЕННЫЕ ПАРАМЕТРЫ\n";
    $message .= "  Объем: " . ($production_volume === 'single' ? 'Разовая партия' : 'Серийное производство');
    if ($production_volume === 'serial' && !empty($volume_monthly)) {
        $unit = $volume_unit === 'pm' ? 'п.м.' : 'шт.';
        $message .= " ({$volume_monthly} {$unit}/мес)";
    }
    $message .= "\n";

    if (!empty($production_start)) {
        $start_labels = array(
            '1_month' => 'В течение 1 месяца',
            '2_3_months' => 'В течение 2-3 месяцев',
            '3_6_months' => 'В течение 3-6 месяцев',
            'more_6_months' => 'Более 6 месяцев',
            'later' => 'Уточню позже'
        );
        $message .= "  Срок начала: " . ($start_labels[$production_start] ?? $production_start) . "\n";
    }

    if (!empty($target_price)) {
        $message .= "  Целевая стоимость: {$target_price} руб. за ед.\n";
    }

    if ($technology === 'injection' && !empty($tooling_status)) {
        $tooling_labels = array(
            'ready' => 'Есть пресс-форма (готова)',
            'needs_revision' => 'Есть пресс-форма (требуется ревизия)',
            'need_new' => 'Нет оснастки (готовы инвестировать)',
            'need_consultation' => 'Требуется консультация'
        );
        $message .= "  Оснастка: " . ($tooling_labels[$tooling_status] ?? $tooling_status) . "\n";
    }

    if (!empty($additional_requirements)) {
        $message .= "  Доп. требования: {$additional_requirements}\n";
    }
    $message .= "\n";

    $message .= "▶ ПРИЛОЖЕННЫЕ ФАЙЛЫ\n";
    if (!empty($uploaded_files)) {
        foreach ($uploaded_files as $file) {
            $size_kb = round($file['size'] / 1024, 1);
            $message .= "  • {$file['name']} ({$size_kb} КБ)\n";
        }
    } else {
        $message .= "  Файлы не прикреплены\n";
    }
    $message .= "\n";

    $message .= "▶ КОНТАКТНАЯ ИНФОРМАЦИЯ\n";
    $message .= "  Компания: {$company}\n";
    $message .= "  Контактное лицо: {$contact_person}\n";
    if (!empty($position)) {
        $message .= "  Должность: {$position}\n";
    }
    $message .= "  Телефон: {$phone}\n";
    $message .= "  Email: {$email}\n";

    $contact_labels = array('phone' => 'Телефон', 'email' => 'Email', 'telegram' => 'Telegram');
    $message .= "  Предпочтительный способ связи: " . ($contact_labels[$contact_method] ?? 'Телефон') . "\n\n";

    $message .= "───────────────────────────────────────────────────────────\n";
    $message .= "Дата и время: {$formatted_date}\n";
    $message .= "IP адрес: " . elinar_get_real_ip() . "\n";
    $message .= "═══════════════════════════════════════════════════════════\n";

    // Сохраняем в лог
    $log_entry = json_encode(array(
        'request_id' => $request_id,
        'date' => $formatted_date,
        'technology' => $technology,
        'project_name' => $project_name,
        'company' => $company,
        'contact_person' => $contact_person,
        'phone' => $phone,
        'email' => $email,
        'files_count' => count($uploaded_files),
        'ip' => elinar_get_real_ip()
    ), JSON_UNESCAPED_UNICODE) . "\n";

    $log_file = elinar_private_log_file('quote-form-log.txt');
    @file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);

    // Email-адреса из конфигурации с fallback на значения по умолчанию
    $to = elinar_get_primary_email();
    $to_copy = elinar_get_copy_email();
    $subject = "Запрос на расчет производства №{$request_id} - {$project_name}";

    // Telegram отправляем в первую очередь, чтобы дубль не зависел от SMTP таймаутов
    $telegram_sent = elinar_send_quote_telegram_notification(array(
        'request_id'           => $request_id,
        'technology'           => $technology,
        'technology_label'     => $technology_labels[$technology] ?? $technology,
        'project_name'         => $project_name,
        'product_type_extrusion' => $product_type_extrusion,
        'product_type_injection' => $product_type_injection,
        'project_stage'        => $project_stage,
        'stage_label'          => $stage_labels[$project_stage] ?? $project_stage,
        'material'             => $material,
        'material_label'       => $material_labels[$material] ?? $material,
        'material_other'       => $material_other,
        'color_type'           => $color_type,
        'color_value'          => $color_value,
        'width_diameter'       => $width_diameter,
        'height_extrusion'     => $height_extrusion,
        'wall_thickness'       => $wall_thickness,
        'length_injection'     => $length_injection,
        'width_injection'      => $width_injection,
        'height_injection'     => $height_injection,
        'weight_injection'     => $weight_injection,
        'special_requirements' => $special_requirements,
        'production_volume'    => $production_volume,
        'volume_monthly'       => $volume_monthly,
        'volume_unit'          => $volume_unit,
        'production_start'     => $production_start,
        'target_price'         => $target_price,
        'tooling_status'       => $tooling_status,
        'additional_requirements' => $additional_requirements,
        'company'              => $company,
        'contact_person'       => $contact_person,
        'position'             => $position,
        'phone'                => $phone,
        'email'                => $email,
        'contact_method'       => $contact_method,
        'uploaded_files'       => $uploaded_files,
        'formatted_date'       => $formatted_date,
        'ip'                   => elinar_get_real_ip(),
    ));

    // Заголовки письма
    $headers = elinar_build_mail_headers($email);

    // Отправка письма
    $attachments = array();
    foreach ($uploaded_files as $file) {
        if (!empty($file['path'])) {
            $attachments[] = $file['path'];
        }
    }

    // Отправка на основной адрес (с fallback на mail() без вложений)
    $primary_send = elinar_send_mail_with_fallback($to, $subject, $message, $headers, $attachments, $email);
    $mail_sent = !empty($primary_send['sent']);

    // Независимая отправка копии на резервный адрес
    elinar_send_mail_with_fallback($to_copy, $subject, $message, $headers, $attachments, $email);

    elinar_delivery_log('quote_form', array(
        'request_id' => $request_id,
        'mail_sent' => (bool) $mail_sent,
        'mail_via' => isset($primary_send['via']) ? (string) $primary_send['via'] : '',
        'wp_mail_error' => isset($primary_send['wp_mail_error']) ? (string) $primary_send['wp_mail_error'] : '',
        'telegram_sent' => (bool) $telegram_sent,
        'attachments_count' => count($attachments),
    ));

    // Проверяем результат
    $is_local = (
        strpos(home_url(), 'localhost') !== false ||
        strpos(home_url(), '127.0.0.1') !== false ||
        strpos(home_url(), '.local') !== false ||
        strpos(home_url(), 'local') !== false
    );

    if ($mail_sent || $telegram_sent || $is_local) {
        // Удаляем загруженные файлы после успешной обработки, чтобы не хранить PII/чертежи на сервере
        foreach ($uploaded_files as $file) {
            $path = isset($file['path']) ? (string) $file['path'] : '';
            if ($path !== '' && file_exists($path)) {
                @unlink($path);
            }
        }
        wp_send_json_success(array(
            'message' => 'Спасибо! Ваш запрос успешно отправлен. Наш инженер свяжется с вами в течение 1 рабочего дня.',
            'request_id' => $request_id
        ));
    } else {
        // Ошибка отправки: удаляем загруженные файлы, чтобы не накапливать документы
        foreach ($uploaded_files as $file) {
            $path = isset($file['path']) ? (string) $file['path'] : '';
            if ($path !== '' && file_exists($path)) {
                @unlink($path);
            }
        }
        wp_send_json_error(array('message' => 'Произошла ошибка при отправке. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.'));
    }
}

// AJAX обработчики для формы запроса КП
add_action('wp_ajax_elinar_quote_form', 'elinar_handle_quote_form');
add_action('wp_ajax_nopriv_elinar_quote_form', 'elinar_handle_quote_form');

/**
 * Обработчик формы "Готовы обсудить ваш проект?" на странице technologies-and-contract-manufacturing
 */
function elinar_handle_project_form()
{
    $disable_nonce_checks = (bool) (defined('ELINAR_DISABLE_NONCE_CHECKS') ? constant('ELINAR_DISABLE_NONCE_CHECKS') : false);
    if (!$disable_nonce_checks) {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'project_form_nonce')) {
            wp_send_json_error(array('message' => 'Ошибка безопасности. Обновите страницу и попробуйте снова.'));
            return;
        }
    }

    // Honeypot проверка (антиспам)
    if (!empty($_POST['website_url'])) {
        wp_send_json_error(array('message' => 'Обнаружен спам.'));
        return;
    }

    // Получаем и очищаем данные
    $name = sanitize_text_field($_POST['name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Валидация обязательных полей
    if (empty($name)) {
        wp_send_json_error(array('message' => 'Пожалуйста, введите ваше имя.'));
        return;
    }

    if (empty($phone) || strlen(preg_replace('/\D/', '', $phone)) < 11) {
        wp_send_json_error(array('message' => 'Пожалуйста, введите корректный номер телефона.'));
        return;
    }

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => 'Пожалуйста, введите корректный email.'));
        return;
    }

    // Обработка файла
    $attachment_path = '';
    $attachment_name = '';

    if (!empty($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['attachment'];
        $allowed_extensions = array('pdf', 'dwg', 'dxf', 'jpg', 'jpeg', 'png', 'zip', 'step', 'stp', 'iges', 'igs', 'stl');
        $max_size = 15 * 1024 * 1024; // 15 MB

        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_extensions)) {
            wp_send_json_error(array('message' => 'Недопустимый формат файла. Разрешены: PDF, DWG, DXF, STEP, STP, JPG, PNG, ZIP, IGES, STL.'));
            return;
        }

        if ($file['size'] > $max_size) {
            wp_send_json_error(array('message' => 'Файл слишком большой. Максимальный размер: 15 МБ.'));
            return;
        }

        // Загружаем файл во временную директорию
        $upload_dir = wp_upload_dir();
        $temp_dir = $upload_dir['basedir'] . '/project-forms/';

        if (!file_exists($temp_dir)) {
            wp_mkdir_p($temp_dir);
            // Защищаем директорию от прямого доступа
            file_put_contents($temp_dir . '.htaccess', 'deny from all');
        }

        $safe_filename = sanitize_file_name($file['name']);
        $unique_filename = time() . '_' . $safe_filename;
        $attachment_path = $temp_dir . $unique_filename;
        $attachment_name = $file['name'];

        if (!move_uploaded_file($file['tmp_name'], $attachment_path)) {
            wp_send_json_error(array('message' => 'Ошибка загрузки файла. Попробуйте снова.'));
            return;
        }
    }

    // Формируем письмо
    $request_id = 'PRJ-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));
    $formatted_date = date('d.m.Y H:i');

    $email_body = "═══════════════════════════════════════════════════════════\n";
    $email_body .= "       НОВАЯ ЗАЯВКА НА РАСЧЕТ С САЙТА\n";
    $email_body .= "       Номер заявки: {$request_id}\n";
    $email_body .= "═══════════════════════════════════════════════════════════\n\n";

    $email_body .= "▶ КОНТАКТНЫЕ ДАННЫЕ\n";
    $email_body .= "  Имя: {$name}\n";
    $email_body .= "  Телефон: {$phone}\n";
    $email_body .= "  Email: {$email}\n\n";

    if (!empty($message)) {
        $email_body .= "▶ ОПИСАНИЕ ПРОЕКТА\n";
        $email_body .= "  {$message}\n\n";
    }

    if (!empty($attachment_name)) {
        $email_body .= "▶ ПРИКРЕПЛЕННЫЙ ФАЙЛ\n";
        $file_size_mb = round(filesize($attachment_path) / 1024 / 1024, 2);
        $email_body .= "  {$attachment_name} ({$file_size_mb} МБ)\n\n";
    }

    $email_body .= "───────────────────────────────────────────────────────────\n";
    $email_body .= "Дата и время: {$formatted_date}\n";
    $email_body .= "Страница: Технологии и контрактное производство\n";
    $email_body .= "IP адрес: " . elinar_get_real_ip() . "\n";
    $email_body .= "═══════════════════════════════════════════════════════════\n";

    // Email-адреса из конфигурации с fallback на значения по умолчанию
    $to = elinar_get_primary_email();
    $to_copy = elinar_get_copy_email();
    $subject = "Новая заявка на расчет с сайта: {$name}";

    // Заголовки письма
    $headers = elinar_build_mail_headers($email);

    // Вложения
    $attachments = array();
    if (!empty($attachment_path) && file_exists($attachment_path)) {
        $attachments[] = $attachment_path;
    }

    // Отправка на основной адрес (с fallback на mail() без вложений)
    $primary_send = elinar_send_mail_with_fallback($to, $subject, $email_body, $headers, $attachments, $email);
    $mail_sent = !empty($primary_send['sent']);

    // Независимая отправка копии на резервный адрес
    elinar_send_mail_with_fallback($to_copy, $subject, $email_body, $headers, $attachments, $email);

    elinar_delivery_log('project_form_ajax', array(
        'request_id' => $request_id,
        'mail_sent' => (bool) $mail_sent,
        'mail_via' => isset($primary_send['via']) ? (string) $primary_send['via'] : '',
        'wp_mail_error' => isset($primary_send['wp_mail_error']) ? (string) $primary_send['wp_mail_error'] : '',
        'attachments_count' => count($attachments),
    ));

    // Удаляем временный файл после отправки
    if (!empty($attachment_path) && file_exists($attachment_path)) {
        @unlink($attachment_path);
    }

    // Проверяем результат (на локальном сервере считаем успехом)
    $is_local = (
        strpos(home_url(), 'localhost') !== false ||
        strpos(home_url(), '127.0.0.1') !== false ||
        strpos(home_url(), '.local') !== false
    );

    if ($mail_sent || $is_local) {
        wp_send_json_success(array(
            'message' => 'Спасибо! Ваша заявка принята, инженер свяжется с вами в ближайшее время.',
            'request_id' => $request_id
        ));
    } else {
        wp_send_json_error(array('message' => 'Ошибка отправки. Пожалуйста, попробуйте позже или позвоните нам.'));
    }
}

// AJAX обработчики для формы проекта
add_action('wp_ajax_submit_project_form', 'elinar_handle_project_form');
add_action('wp_ajax_nopriv_submit_project_form', 'elinar_handle_project_form');

// ============================================================================
// 9. FAVICON
// ============================================================================

/**
 * Add New Favicons
 */
function elinar_favicon()
{
    $favicon_path = get_template_directory_uri() . '/assets/images/favicon';
    $favicon_dir = get_template_directory() . '/assets/images/favicon';
?>
    <!-- Принудительно удаляем любые стандартные фавиконы -->
    <link rel="icon" href="data:;base64,=">

    <!-- SVG favicon как основной (для современных браузеров) -->
    <link rel="icon" type="image/svg+xml" sizes="any" href="<?php echo $favicon_path; ?>/favicon.svg">

    <!-- Большие размеры с явным указанием sizes -->
    <link rel="icon" type="image/png" sizes="512x512" href="<?php echo $favicon_path; ?>/android-chrome-512x512.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $favicon_path; ?>/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="128x128" href="<?php echo $favicon_path; ?>/favicon-128x128-optimized.png">

    <!-- Дополнительные размеры -->
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $favicon_path; ?>/favicon-96x96-optimized.png">
    <link rel="icon" type="image/png" sizes="64x64" href="<?php echo $favicon_path; ?>/favicon-64x64-optimized.png">
    <link rel="icon" type="image/png" sizes="48x48" href="<?php echo $favicon_path; ?>/favicon-48x48-optimized.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $favicon_path; ?>/favicon-32x32-optimized.png">

    <!-- Для iOS устройств -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $favicon_path; ?>/apple-touch-icon.png">

    <!-- Для старых браузеров -->
    <link rel="shortcut icon" href="<?php echo $favicon_path; ?>/favicon.ico" type="image/x-icon">

    <!-- Web App Manifest -->
    <link rel="manifest" href="<?php echo $favicon_path; ?>/site.webmanifest">

    <!-- Цвет темы для браузеров -->
    <meta name="theme-color" content="#ffffff">
<?php
}
add_action('wp_head', 'elinar_favicon');

// ============================================================================
// 10. ANALYTICS
// ============================================================================

/**
 * Add Yandex Metrika to <head>
 * ID: 106098510
 * Options: Webvisor, Ecommerce, Clickmap
 */
function elinar_yandex_metrika()
{
    // Не загружаем для админов, чтобы не портить статистику
    if (current_user_can('manage_options')) {
        echo "<!-- Yandex.Metrika: Adming logged in (Disabled) -->\n";
        return;
    }
?>
    <!-- Yandex.Metrika counter (Consent-gated) -->
    <script type="text/javascript">
        (function() {
            var metrikaLoaded = false;
            var metrikaBlocked = false;
            var metrikaScriptSelector = 'script[src*="mc.yandex.ru/metrika/tag.js"]';

            function blockMetrikaRuntime() {
                metrikaBlocked = true;
                metrikaLoaded = false;

                try {
                    var scripts = document.querySelectorAll(metrikaScriptSelector);
                    for (var i = 0; i < scripts.length; i++) {
                        if (scripts[i] && scripts[i].parentNode) {
                            scripts[i].parentNode.removeChild(scripts[i]);
                        }
                    }
                } catch (e) {}

                try {
                    window.ym = undefined;
                } catch (e) {}

                try {
                    window['yaCounter106098510'] = undefined;
                } catch (e) {}
            }

            function loadMetrika() {
                if (metrikaLoaded || metrikaBlocked) return;
                metrikaLoaded = true;
                window.yaCounterId = 106098510;

                (function(m, e, t, r, i, k, a) {
                    m[i] = m[i] || function() {
                        (m[i].a = m[i].a || []).push(arguments);
                    };
                    m[i].l = 1 * new Date();
                    k = e.createElement(t);
                    a = e.getElementsByTagName(t)[0];
                    k.async = 1;
                    k.src = r;
                    a.parentNode.insertBefore(k, a);
                })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=106098510', 'ym');

                ym(106098510, 'init', {
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            }

            function readConsent() {
                try {
                    var raw = localStorage.getItem('elinar_cookie_preferences');
                    if (raw) {
                        var prefs = JSON.parse(raw);
                        if (prefs && typeof prefs === 'object') {
                            return prefs.analytics === true;
                        }
                    }

                    if (localStorage.getItem('elinar_cookie_consent') === 'accepted') {
                        return true;
                    }
                } catch (e) {}

                return null;
            }

            function onConsentChanged(detail) {
                var allowed = !!(detail && detail.analytics);
                if (allowed) {
                    metrikaBlocked = false;
                    loadMetrika();
                    return;
                }

                blockMetrikaRuntime();
            }

            var consent = readConsent();
            if (consent === true) {
                setTimeout(loadMetrika, 500);
            } else if (consent === false) {
                blockMetrikaRuntime();
            }

            window.addEventListener('elinar:cookie-consent', function(e) {
                onConsentChanged(e && e.detail ? e.detail : null);
            });
        })();
    </script>
    <!-- /Yandex.Metrika counter -->
<?php
}
add_action('wp_footer', 'elinar_yandex_metrika', 99); // Переносим в footer для лучшей производительности

// ============================================================================
// 11. DEBUG DIAGNOSTICS
// ============================================================================

function elinar_debug_performance()
{
    if (!current_user_can('administrator') && !is_user_logged_in()) {
        return;
    }
?>
    <script>
        (function() {
            console.log('%c Debug Diagnostics Loaded ', 'background: #222; color: #bada55');

            // 1. Measure First Input Delay (simulated for clicks)
            document.addEventListener('click', (e) => {
                const start = performance.now();

                // Use setTimeout to measure how long it takes for the main thread to unblock
                // and execute the next task in the queue.
                setTimeout(() => {
                    const end = performance.now();
                    const duration = end - start;

                    if (duration > 50) {
                        console.warn(`%c Long Interaction detected! Duration: ${duration.toFixed(2)}ms`, 'color: orange; font-weight: bold;');
                        console.log('Target:', e.target);

                        // Check if GSAP is refreshing
                        if (window.ScrollTrigger && window.ScrollTrigger.isRefreshing) {
                            console.error('GSAP ScrollTrigger was refreshing during interaction!');
                        }
                    } else {
                        console.log(`Interaction latency: ${duration.toFixed(2)}ms`);
                    }
                }, 0);
            }, true); // Capture phase

            // 2. Monitor Long Tasks (if supported)
            if ('PerformanceObserver' in window) {
                try {
                    const observer = new PerformanceObserver((list) => {
                        for (const entry of list.getEntries()) {
                            if (entry.duration > 50) {
                                console.warn(`%c Long Task detected: ${entry.duration.toFixed(2)}ms`, 'color: red', entry);
                                // Try to attribute to source
                                if (entry.attribution) {
                                    console.log('Attribution:', entry.attribution);
                                }
                            }
                        }
                    });
                    observer.observe({
                        entryTypes: ['longtask']
                    });
                } catch (e) {}
            }

            // 3. Log active timers/intervals (simple check)
            // This is intrusive, so we only do it if requested or extremely necessary.
            // For now, we rely on the Long Task observer.

            // 4. Check Navigation Timing (TTFB) on this page load
            window.addEventListener('load', () => {
                const navEntry = performance.getEntriesByType('navigation')[0];
                if (navEntry) {
                    console.groupCollapsed('Page Load Timing');
                    console.log(`TTFB (Server Response): ${navEntry.responseStart - navEntry.requestStart}ms`);
                    console.log(`DOM Content Loaded: ${navEntry.domContentLoadedEventEnd}ms`);
                    console.log(`Full Page Load: ${navEntry.loadEventEnd}ms`);
                    console.groupEnd();
                }
            });

        })();
    </script>
<?php
}
// Run only if a specific query param is present OR always for admins?
// User asked for debugging, so enabling it generally for admins or local dev.
if (defined('WP_DEBUG') && WP_DEBUG || current_user_can('manage_options') || $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    add_action('wp_footer', 'elinar_debug_performance', 999);
}

/**
 * Enqueue Scroll Down Button Assets
 * Added by Antigravity
 */
add_action('wp_enqueue_scripts', 'elinar_enqueue_scroll_down_assets');
function elinar_enqueue_scroll_down_assets() {
    // Load solely on relevant pages
    if (
        is_front_page()
        || is_page_template('page-about.php')
        || is_page_template('page-technologies-production.php')
        || is_page_template('page-services.php')
        || is_page('services')
    ) {

        wp_enqueue_style(
            'elinar-scroll-down',
            get_template_directory_uri() . '/assets/css/scroll-down.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/scroll-down.css')
        );

        wp_enqueue_script(
            'elinar-scroll-down-js',
            get_template_directory_uri() . '/assets/js/scroll-down.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/scroll-down.js'),
            true
        );
    }
}
