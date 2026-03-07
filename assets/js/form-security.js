(function (window, document) {
    'use strict';

    var config = window.elinarFormSecurityConfig || {};
    var selectors = {
        forms: 'form[data-elinar-form]',
        widget: '.elinar-turnstile-widget',
        message: '.elinar-turnstile-message',
        renderTs: '.elinar-form-render-ts',
        elapsed: '.elinar-form-elapsed-ms'
    };

    function now() {
        return Date.now ? Date.now() : new Date().getTime();
    }

    function getMessage(key, fallback) {
        if (config.messages && config.messages[key]) {
            return config.messages[key];
        }

        return fallback;
    }

    function toArray(list) {
        return Array.prototype.slice.call(list || []);
    }

    function isManagedForm(form) {
        return !!(form && form.getAttribute && form.getAttribute('data-elinar-form'));
    }

    function getState(form) {
        if (!form.__elinarFormSecurityState) {
            form.__elinarFormSecurityState = {
                renderedAt: 0,
                widgetId: null,
                rendered: false
            };
        }

        return form.__elinarFormSecurityState;
    }

    function ensureTokenField(form) {
        var field = form.querySelector('input[name="cf-turnstile-response"]');
        if (field) {
            return field;
        }

        field = document.createElement('input');
        field.type = 'hidden';
        field.name = 'cf-turnstile-response';
        form.appendChild(field);
        return field;
    }

    function getWidget(form) {
        return form.querySelector(selectors.widget);
    }

    function getMessageNode(form) {
        return form.querySelector(selectors.message);
    }

    function isVisible(element) {
        return !!(element && element.getClientRects && element.getClientRects().length > 0);
    }

    function clearError(form) {
        var messageNode = getMessageNode(form);
        if (!messageNode) {
            return;
        }

        messageNode.textContent = '';
        messageNode.classList.remove('is-visible');
    }

    function showError(form, message) {
        var messageNode = getMessageNode(form);
        if (!messageNode) {
            return;
        }

        messageNode.textContent = message || getMessage('security', 'Проверка безопасности не пройдена, обновите страницу и попробуйте снова.');
        messageNode.classList.add('is-visible');
    }

    function updateTiming(form) {
        var state = getState(form);
        var renderField = form.querySelector(selectors.renderTs);
        var elapsedField = form.querySelector(selectors.elapsed);

        if (!state.renderedAt) {
            state.renderedAt = now();
        }

        if (renderField) {
            renderField.value = String(state.renderedAt);
        }

        if (elapsedField) {
            elapsedField.value = String(Math.max(0, now() - state.renderedAt));
        }
    }

    function refreshForm(form) {
        var state = getState(form);
        state.renderedAt = now();

        ensureTokenField(form).value = '';
        clearError(form);
        updateTiming(form);
    }

    function canBypassLocally() {
        return !!config.isLocal && !config.enabled;
    }

    function renderWidget(form) {
        var state = getState(form);
        var widget = getWidget(form);

        if (!config.enabled || !widget || !isVisible(widget) || state.rendered || !window.turnstile || typeof window.turnstile.render !== 'function') {
            return state.widgetId;
        }

        try {
            state.widgetId = window.turnstile.render(widget, {
                sitekey: config.siteKey,
                theme: 'auto',
                size: 'flexible',
                action: form.getAttribute('data-elinar-form') || 'form',
                callback: function (token) {
                    ensureTokenField(form).value = token || '';
                    clearError(form);
                },
                'expired-callback': function () {
                    ensureTokenField(form).value = '';
                    showError(form, getMessage('security', 'Проверка безопасности не пройдена, обновите страницу и попробуйте снова.'));
                },
                'error-callback': function () {
                    ensureTokenField(form).value = '';
                    showError(form, getMessage('loading', 'Проверка безопасности загружается, попробуйте снова через несколько секунд.'));
                }
            });
            state.rendered = true;
        } catch (error) {
            state.rendered = false;
            if (window.console && typeof window.console.error === 'function') {
                window.console.error('[Turnstile] render failed for form:', form.getAttribute('data-elinar-form'), error);
            }
        }

        return state.widgetId;
    }

    function scheduleRender(form) {
        if (!config.enabled || !form) {
            return;
        }

        if (!window.turnstile) {
            return;
        }

        if (typeof window.turnstile.ready === 'function') {
            window.turnstile.ready(function () {
                renderWidget(form);
            });
            return;
        }

        renderWidget(form);
    }

    function renderPendingWidgets() {
        if (!config.enabled) {
            return;
        }

        toArray(document.querySelectorAll(selectors.forms)).forEach(function (form) {
            if (isManagedForm(form)) {
                scheduleRender(form);
            }
        });
    }

    function ensureToken(form) {
        var tokenField = ensureTokenField(form);

        updateTiming(form);

        if (canBypassLocally()) {
            return { ok: true, bypassed: true };
        }

        if (!config.enabled) {
            showError(form, getMessage('security', 'Проверка безопасности не пройдена, обновите страницу и попробуйте снова.'));
            return { ok: false, message: getMessage('security', 'Проверка безопасности не пройдена, обновите страницу и попробуйте снова.') };
        }

        renderWidget(form);

        if (!tokenField.value) {
            var missingTokenMessage = getState(form).widgetId ? getMessage('security', 'Проверка безопасности не пройдена, обновите страницу и попробуйте снова.') : getMessage('loading', 'Проверка безопасности загружается, попробуйте снова через несколько секунд.');
            showError(form, missingTokenMessage);
            return { ok: false, message: missingTokenMessage };
        }

        clearError(form);
        return { ok: true };
    }

    function reset(form) {
        var state = getState(form);
        var tokenField = ensureTokenField(form);

        tokenField.value = '';
        clearError(form);

        if (config.enabled && state.widgetId !== null && window.turnstile && typeof window.turnstile.reset === 'function') {
            try {
                window.turnstile.reset(state.widgetId);
            } catch (error) {
            }
        }

        refreshForm(form);
    }

    function initForm(form) {
        if (!isManagedForm(form) || form.getAttribute('data-elinar-form-security-init') === 'true') {
            return;
        }

        form.setAttribute('data-elinar-form-security-init', 'true');
        ensureTokenField(form);
        refreshForm(form);
        scheduleRender(form);
    }

    function initAll() {
        toArray(document.querySelectorAll(selectors.forms)).forEach(initForm);
        renderPendingWidgets();
    }

    function observeDomChanges() {
        if (!window.MutationObserver || !document.body) {
            return;
        }

        var observer = new MutationObserver(function () {
            initAll();
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class', 'style', 'hidden', 'aria-hidden']
        });
    }

    function scheduleGlobalRetries() {
        if (!config.enabled) {
            return;
        }

        [250, 1000, 2500].forEach(function (delay) {
            window.setTimeout(function () {
                renderPendingWidgets();
            }, delay);
        });

        window.addEventListener('load', function () {
            renderPendingWidgets();
        });
    }

    document.addEventListener('submit', function (event) {
        if (isManagedForm(event.target)) {
            updateTiming(event.target);
        }
    }, true);

    window.elinarFormSecurity = {
        initAll: initAll,
        ensureToken: ensureToken,
        reset: reset,
        refresh: refreshForm,
        showError: showError,
        clearError: clearError,
        updateTiming: updateTiming
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initAll();
            observeDomChanges();
            scheduleGlobalRetries();
        });
    } else {
        initAll();
        observeDomChanges();
        scheduleGlobalRetries();
    }
})(window, document);
