<?php
/**
 * Production Cycle Integration
 * 
 * Добавьте этот код в functions.php вашей темы для автоматического подключения стилей
 */

// Регистрация и подключение стилей для блока "Полный цикл производства"
function elinar_enqueue_production_cycle_styles() {
    // Вариант 1: Progress Pipeline
    wp_register_style(
        'production-cycle-pipeline',
        get_template_directory_uri() . '/assets/css/production-cycle.css',
        array(),
        '1.0.0',
        'all'
    );

    // Вариант 2: Industrial Cards
    wp_register_style(
        'production-cycle-cards',
        get_template_directory_uri() . '/assets/css/production-cycle-cards.css',
        array(),
        '1.0.0',
        'all'
    );

    // Подключаем на главной странице или на всех страницах
    if (is_front_page() || is_page_template('page-production-demo.php')) {
        wp_enqueue_style('production-cycle-pipeline');
        wp_enqueue_style('production-cycle-cards');
    }
}
add_action('wp_enqueue_scripts', 'elinar_enqueue_production_cycle_styles');

/**
 * Шорткод для вставки блока Progress Pipeline
 * Использование: [production_pipeline]
 */
function elinar_production_pipeline_shortcode() {
    wp_enqueue_style('production-cycle-pipeline');
    
    ob_start();
    include get_template_directory() . '/template-parts/production-cycle.php';
    return ob_get_clean();
}
add_shortcode('production_pipeline', 'elinar_production_pipeline_shortcode');

/**
 * Шорткод для вставки блока Industrial Cards
 * Использование: [production_cards]
 */
function elinar_production_cards_shortcode() {
    wp_enqueue_style('production-cycle-cards');
    
    ob_start();
    include get_template_directory() . '/template-parts/production-cycle-cards.php';
    return ob_get_clean();
}
add_shortcode('production_cards', 'elinar_production_cards_shortcode');

/**
 * Gutenberg Block для Progress Pipeline (опционально)
 */
function elinar_register_production_cycle_block() {
    if (!function_exists('register_block_type')) {
        return;
    }

    // Регистрация блока Progress Pipeline
    register_block_type('elinar/production-pipeline', array(
        'editor_script' => 'elinar-blocks',
        'render_callback' => 'elinar_production_pipeline_shortcode',
    ));

    // Регистрация блока Industrial Cards
    register_block_type('elinar/production-cards', array(
        'editor_script' => 'elinar-blocks',
        'render_callback' => 'elinar_production_cards_shortcode',
    ));
}
add_action('init', 'elinar_register_production_cycle_block');

/**
 * Добавление кастомного шаблона страницы
 */
function elinar_add_production_demo_template($templates) {
    $templates['page-production-demo.php'] = 'Production Cycle Demo';
    return $templates;
}
add_filter('theme_page_templates', 'elinar_add_production_demo_template');

/**
 * Пример использования в коде темы:
 * 
 * // В любом файле шаблона (front-page.php, page.php и т.д.):
 * 
 * // Вариант 1: Прямое подключение
 * <?php include get_template_directory() . '/template-parts/production-cycle.php'; ?>
 * 
 * // Вариант 2: Через шорткод
 * <?php echo do_shortcode('[production_pipeline]'); ?>
 * 
 * // Вариант 3: В редакторе WordPress
 * [production_pipeline]
 * или
 * [production_cards]
 */
?>
