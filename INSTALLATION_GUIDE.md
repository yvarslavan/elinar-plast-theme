# 🚀 Руководство по установке блока "Полный цикл производства"

## Быстрый старт (5 минут)

### Шаг 1: Подключение стилей

Добавьте в `functions.php` вашей темы:

```php
function elinar_enqueue_production_styles() {
    // Выберите нужный вариант:
    
    // Вариант 1: Progress Pipeline
    wp_enqueue_style(
        'production-pipeline',
        get_template_directory_uri() . '/assets/css/production-cycle.css',
        array(),
        '1.0.0'
    );
    
    // ИЛИ Вариант 2: Industrial Cards
    wp_enqueue_style(
        'production-cards',
        get_template_directory_uri() . '/assets/css/production-cycle-cards.css',
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'elinar_enqueue_production_styles');
```

### Шаг 2: Вставка на страницу

В файле шаблона (например, `front-page.php`):

```php
<?php
// Вариант 1: Progress Pipeline
include get_template_directory() . '/template-parts/production-cycle.php';

// ИЛИ Вариант 2: Industrial Cards
include get_template_directory() . '/template-parts/production-cycle-cards.php';
?>
```

### Шаг 3: Готово! 🎉

Откройте страницу и проверьте результат.

---

## 📦 Структура файлов

```
wp-content/themes/elinar-plast/
│
├── template-parts/
│   ├── production-cycle.php              # HTML: Progress Pipeline
│   └── production-cycle-cards.php        # HTML: Industrial Cards
│
├── assets/css/
│   ├── production-cycle.css              # CSS: Progress Pipeline
│   └── production-cycle-cards.css        # CSS: Industrial Cards
│
├── page-production-demo.php              # Демо-страница
├── production-cycle-integration.php      # Код для functions.php
├── PRODUCTION_CYCLE_README.md            # Документация
├── PRODUCTION_CYCLE_COMPARISON.md        # Сравнение вариантов
└── INSTALLATION_GUIDE.md                 # Этот файл
```

---

## 🎨 Настройка цветов

Откройте CSS-файл и измените переменные:

```css
:root {
    --brand-blue: #0066CC;        /* Ваш основной цвет */
    --brand-blue-dark: #004C99;   /* Темный оттенок */
}
```

---

## 🔧 Использование шорткодов

Скопируйте код из `production-cycle-integration.php` в `functions.php`.

Затем используйте в редакторе WordPress:

```
[production_pipeline]
```

или

```
[production_cards]
```

---

## 📱 Проверка адаптивности

Откройте страницу и измените размер окна браузера:

- **Desktop (>1024px)**: Горизонтальная линия / 5 карточек в ряд
- **Tablet (768-1024px)**: Уменьшенные элементы / 3 карточки
- **Mobile (<768px)**: Вертикальный список

---

## ❓ Частые вопросы

### Как изменить количество шагов?

1. Добавьте/удалите блок в PHP-файле
2. Обновите CSS Grid (для карточек):
```css
.production-cards-grid {
    grid-template-columns: repeat(6, 1fr); /* 6 шагов */
}
```

### Как заменить иконки?

Используйте SVG-код из [Heroicons](https://heroicons.com/) или [Feather Icons](https://feathericons.com/).

### Как отключить анимацию?

Удалите или закомментируйте:
```css
.pipeline-progress {
    /* animation: progressFill 2s ease-out forwards; */
}
```

---

## 🐛 Решение проблем

### Стили не применяются
- Очистите кэш WordPress
- Проверьте пути к файлам
- Убедитесь, что CSS подключен в `<head>`

### Иконки не видны
- Проверьте SVG-код на ошибки
- Убедитесь, что `stroke="currentColor"` присутствует

### Мобильная версия не работает
- Проверьте viewport meta-тег:
```html
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

---

## 📞 Поддержка

Если возникли вопросы, проверьте:
1. `PRODUCTION_CYCLE_README.md` - полная документация
2. `PRODUCTION_CYCLE_COMPARISON.md` - сравнение вариантов
3. `page-production-demo.php` - рабочий пример
