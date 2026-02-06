<?php
/*
Template Name: Разработка и производство
*/
get_header();
?>
<style>
    /* Переопределение цвета заголовков на темно-синий #1E293B */
    .site-main .section-title h2,
    .site-main .section-title h2.text-primary,
    .site-main .injection-card-title,
    .site-main .tab-content-title,
    .site-main .tab-title,
    .site-main .production-vision-preamble h2,
    .site-main section h2,
    .site-main section h2.text-primary,
    .site-main section h3,
    .site-main section h3.text-primary,
    .site-main section h4,
    .site-main section h4.text-primary,
    .site-main h2.text-primary,
    .site-main h3.text-primary,
    .site-main h4.text-primary {
        color: #1E293B !important;
    }
</style>

<main class="site-main">
    <!-- Hero Section for Services - Optimized for LCP -->
    <section class="page-hero page-hero-development">
        <!-- Hero Background Image - LCP optimized -->
        <picture class="hero-bg-picture">
            <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-mobile.webp" type="image/webp">
            <source media="(max-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-tablet.webp" type="image/webp">
            <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_development-production.webp" type="image/webp">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_development-production.webp"
                alt="Разработка и производство"
                class="hero-bg-img"
                width="1920"
                height="1080"
                fetchpriority="high"
                loading="eager"
                decoding="sync">
        </picture>
        <div class="hero-overlay"></div>
        <div class="container">
            <h1 class="text-white">Создаем надежную основу для вашего продукта</h1>
            <p class="lead">Мы трансформируем ваши идеи в реальные изделия с инженерной точностью. Наш подход включает не просто литье, а глубокую проработку конструкции, создание идеальной геометрии с помощью CAM-технологий и выпуск долговечных пресс-форм. Вы получаете готовое решение «под ключ»: от чертежа до запуска в серию.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section section-services">
        <div class="container">

            <!-- Engineering Section -->
            <div class="service-block mb-5">
                <h2 class="section-title mb-4 text-primary">Инженерная подготовка производства</h2>
                <p class="lead mb-4 text-secondary">Качественная подготовка — залог отсутствия брака в тираже. Наши инженеры детально прорабатывают конструкцию, чтобы исключить риски и обеспечить стабильное качество литья.</p>

                <!-- Engineering Image -->
                <div class="mb-5" style="max-width: 100%; display: flex; justify-content: center;">
                    <?php if (file_exists(get_template_directory() . '/assets/images/engineering-cad.webp')) : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/engineering-cad.webp" alt="Инженерное проектирование CAD" class="rounded shadow-lg" loading="lazy" style="cursor: zoom-in; max-width: 100%; height: auto;">
                    <?php else : ?>
                        <div class="image-placeholder placeholder-lg rounded shadow-sm bg-light d-flex align-items-center justify-content-center" style="min-height: 400px; width: 100%; max-width: 800px;">
                            <div class="text-center p-4">
                                <div class="mb-3 opacity-50">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="3" y1="9" x2="21" y2="9"></line>
                                        <line x1="9" y1="21" x2="9" y2="9"></line>
                                    </svg>
                                </div>
                                <h5 class="text-secondary">Инженерное проектирование</h5>
                                <code class="text-small text-muted">engineering-cad.webp</code>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Advantages Grid -->
                <div class="injection-advantages-grid">
                    <!-- Card 1: CAD-проектирование -->
                    <article class="injection-advantage-card">
                        <span class="injection-card-number">01</span>
                        <div class="injection-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <line x1="10" y1="9" x2="8" y2="9"></line>
                            </svg>
                        </div>
                        <h3 class="injection-card-title">Профессиональное CAD-проектирование</h3>
                        <p class="injection-card-text">Превращаем идеи в рабочие чертежи. Оптимизируем конструкцию детали, чтобы упростить производство и снизить себестоимость.</p>
                    </article>

                    <!-- Card 2: Подбор сырья -->
                    <article class="injection-advantage-card">
                        <span class="injection-card-number">02</span>
                        <div class="injection-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M12 1v6m0 6v6M5.64 5.64l4.24 4.24m4.24 4.24l4.24 4.24M1 12h6m6 0h6M5.64 18.36l4.24-4.24m4.24-4.24l4.24-4.24"></path>
                            </svg>
                        </div>
                        <h3 class="injection-card-title">Точный подбор сырья</h3>
                        <p class="injection-card-text">Рекомендуем материалы, которые выдержат реальные нагрузки, не переплачивая за избыточные характеристики.</p>
                    </article>

                    <!-- Card 3: Испытания -->
                    <article class="injection-advantage-card">
                        <span class="injection-card-number">03</span>
                        <div class="injection-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                <path d="M9 21h6"></path>
                                <circle cx="9" cy="9" r="2"></circle>
                                <circle cx="15" cy="15" r="2"></circle>
                            </svg>
                        </div>
                        <h3 class="injection-card-title">Испытания и доработка</h3>
                        <p class="injection-card-text">Тестируем прототипы на прочность и собираемость. Вы получаете уверенность в работоспособности изделия до старта массового производства.</p>
                    </article>

                    <!-- Card 4: Пресс-формы -->
                    <article class="injection-advantage-card">
                        <span class="injection-card-number">04</span>
                        <div class="injection-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <circle cx="12" cy="12" r="6"></circle>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </div>
                        <h3 class="injection-card-title">Проектирование пресс-форм</h3>
                        <p class="injection-card-text">Создаем проекты надежной оснастки, гарантирующей высокую точность размеров и долгий срок службы.</p>
                    </article>

                    <!-- Card 5: Прототипирование -->
                    <article class="injection-advantage-card">
                        <span class="injection-card-number">05</span>
                        <div class="injection-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="injection-card-title">Прототипирование и валидация</h3>
                        <p class="injection-card-text">Изготавливаем опытные образцы для проверки концепции и функциональности. Валидируем конструкцию до запуска серийного производства, экономя время и ресурсы.</p>
                    </article>

                    <!-- Card 6: Техническая документация -->
                    <article class="injection-advantage-card">
                        <span class="injection-card-number">06</span>
                        <div class="injection-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="injection-card-title">Техническая документация</h3>
                        <p class="injection-card-text">Разрабатываем полный комплект технической документации: чертежи, спецификации, технологические карты и инструкции для производства и контроля качества.</p>
                    </article>
                </div>
            </div>

            <hr class="separator-light my-5" style="opacity: 0.1;">

            <!-- Tooling Production Section - Vertical Tabs -->
            <div class="service-block mb-5">
                <h2 class="section-title mb-5 text-center text-primary">Инструментальное производство</h2>

                <div class="tooling-tabs-container">
                    <!-- Left Column: Navigation Tabs -->
                    <div class="tooling-tabs-nav">
                        <button class="tooling-tab-btn active" data-tab="electroerosion">
                            <span class="tab-number">01</span>
                            <span class="tab-title">Электроэрозия</span>
                        </button>
                        <button class="tooling-tab-btn" data-tab="press-forms">
                            <span class="tab-number">02</span>
                            <span class="tab-title">Пресс-формы</span>
                        </button>
                        <button class="tooling-tab-btn" data-tab="metalworking">
                            <span class="tab-number">03</span>
                            <span class="tab-title">Металлообработка</span>
                        </button>
                    </div>

                    <!-- Right Column: Tab Content -->
                    <div class="tooling-tabs-content">
                        <!-- Tab 1: Электроэрозия -->
                        <div class="tooling-tab-panel active" id="tab-electroerosion">
                            <h3 class="tab-content-title">Высокоточная электроэрозионная обработка (Wire-Cut & Die-Sinking)</h3>
                            <p class="tab-content-text">Мы используем технологии проволочной вырезки и прошивной эрозии для обработки токопроводящих материалов любой твердости. Это позволяет изготавливать детали со сложной геометрией, которые невозможно получить традиционным путем.</p>

                            <ul class="tab-content-list">
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Сверхточный раскрой закаленных сталей (до 0,005 мм)</span>
                                </li>
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Изготовление матриц, пуансонов и шпоночных пазов</span>
                                </li>
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Идеальная поверхность без дополнительной шлифовки</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab 2: Пресс-формы -->
                        <div class="tooling-tab-panel" id="tab-press-forms">
                            <h3 class="tab-content-title">Проектирование и изготовление оснастки</h3>
                            <p class="tab-content-text">Обеспечиваем полный цикл создания технологической оснастки: от 3D-моделирования до испытаний. Специализируемся на пресс-формах для литья под давлением и экструзионных фильерах с высоким ресурсом смыканий.</p>

                            <ul class="tab-content-list">
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Индивидуальное проектирование и реверс-инжиниринг</span>
                                </li>
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Изготовление холодноканальных и горячеканальных форм</span>
                                </li>
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Ресурс форм от 500 000 до 1 000 000 циклов</span>
                                </li>
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Сервисное обслуживание и ремонт оснастки</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab 3: Металлообработка -->
                        <div class="tooling-tab-panel" id="tab-metalworking">
                            <h3 class="tab-content-title">Комплексная металлообработка и детали</h3>
                            <p class="tab-content-text">Сочетание парка станков с ЧПУ и универсального оборудования позволяет нам выполнять широкий спектр операций — от черновой обработки до финишной доводки. Работаем с единичными прототипами и сериями.</p>

                            <ul class="tab-content-list">
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Токарно-фрезерные работы любой сложности на ЧПУ</span>
                                </li>
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Плоская и круглая шлифовка для идеальной геометрии</span>
                                </li>
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Термическая обработка (закалка, цементация)</span>
                                </li>
                                <li>
                                    <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Профессиональные слесарные работы</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                /* Tooling Tabs Container */
                .tooling-tabs-container {
                    display: grid;
                    grid-template-columns: 300px 1fr;
                    gap: 40px;
                    margin-top: 40px;
                    background: #ffffff;
                    border-radius: 12px;
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
                    overflow: hidden;
                }

                /* Left Navigation */
                .tooling-tabs-nav {
                    background: #f8fafc;
                    padding: 32px 0;
                    display: flex;
                    flex-direction: column;
                    gap: 8px;
                    border-right: 1px solid #e2e8f0;
                }

                .tooling-tab-btn {
                    position: relative;
                    display: flex;
                    align-items: center;
                    gap: 16px;
                    padding: 20px 32px;
                    background: transparent;
                    border: none;
                    cursor: pointer;
                    text-align: left;
                    transition: all 0.3s ease;
                    font-family: 'Inter', sans-serif;
                }

                .tooling-tab-btn::before {
                    content: '';
                    position: absolute;
                    left: 0;
                    top: 0;
                    bottom: 0;
                    width: 4px;
                    background: #f59e0b;
                    transform: scaleY(0);
                    transition: transform 0.3s ease;
                }

                .tooling-tab-btn:hover {
                    background: rgba(245, 158, 11, 0.05);
                }

                .tooling-tab-btn.active {
                    background: rgba(245, 158, 11, 0.1);
                }

                .tooling-tab-btn.active::before {
                    transform: scaleY(1);
                }

                .tab-number {
                    font-size: 14px;
                    font-weight: 700;
                    color: #94a3b8;
                    min-width: 32px;
                }

                .tooling-tab-btn.active .tab-number {
                    color: #f59e0b;
                }

                .tab-title {
                    font-size: 16px;
                    font-weight: 600;
                    color: #1e293b;
                }

                /* Right Content */
                .tooling-tabs-content {
                    padding: 48px;
                    position: relative;
                }

                .tooling-tab-panel {
                    display: none;
                    animation: fadeIn 0.4s ease;
                }

                .tooling-tab-panel.active {
                    display: block;
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .tab-content-title {
                    font-size: 28px;
                    font-weight: 700;
                    color: #1E293B;
                    margin-bottom: 20px;
                    line-height: 1.3;
                }

                .tab-content-text {
                    font-size: 16px;
                    line-height: 1.7;
                    color: #475569;
                    margin-bottom: 32px;
                }

                .tab-content-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    display: flex;
                    flex-direction: column;
                    gap: 16px;
                }

                .tab-content-list li {
                    display: flex;
                    align-items: flex-start;
                    gap: 12px;
                    font-size: 15px;
                    line-height: 1.6;
                    color: #334155;
                }

                .check-icon {
                    flex-shrink: 0;
                    margin-top: 2px;
                    stroke: #f59e0b;
                }

                /* Responsive: Tablet */
                @media (max-width: 991px) {
                    .tooling-tabs-container {
                        grid-template-columns: 1fr;
                        gap: 0;
                    }

                    .tooling-tabs-nav {
                        flex-direction: row;
                        overflow-x: auto;
                        border-right: none;
                        border-bottom: 1px solid #e2e8f0;
                        padding: 16px;
                        gap: 12px;
                    }

                    .tooling-tab-btn {
                        flex-direction: column;
                        padding: 16px 24px;
                        min-width: 140px;
                        text-align: center;
                        border-radius: 8px;
                    }

                    .tooling-tab-btn::before {
                        left: 0;
                        right: 0;
                        top: auto;
                        bottom: 0;
                        width: auto;
                        height: 4px;
                        transform: scaleX(0);
                    }

                    .tooling-tab-btn.active::before {
                        transform: scaleX(1);
                    }

                    .tooling-tabs-content {
                        padding: 32px 24px;
                    }

                    .tab-content-title {
                        font-size: 24px;
                    }
                }

                /* Responsive: Mobile */
                @media (max-width: 767px) {
                    .tooling-tabs-nav {
                        padding: 12px;
                    }

                    .tooling-tab-btn {
                        padding: 12px 16px;
                        min-width: 120px;
                    }

                    .tab-number {
                        font-size: 12px;
                    }

                    .tab-title {
                        font-size: 14px;
                    }

                    .tooling-tabs-content {
                        padding: 24px 16px;
                    }

                    .tab-content-title {
                        font-size: 20px;
                        margin-bottom: 16px;
                    }

                    .tab-content-text {
                        font-size: 15px;
                        margin-bottom: 24px;
                    }

                    .tab-content-list {
                        gap: 12px;
                    }

                    .tab-content-list li {
                        font-size: 14px;
                    }
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tabButtons = document.querySelectorAll('.tooling-tab-btn');
                    const tabPanels = document.querySelectorAll('.tooling-tab-panel');

                    tabButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const targetTab = this.getAttribute('data-tab');

                            // Remove active class from all buttons and panels
                            tabButtons.forEach(btn => btn.classList.remove('active'));
                            tabPanels.forEach(panel => panel.classList.remove('active'));

                            // Add active class to clicked button
                            this.classList.add('active');

                            // Show corresponding panel
                            const targetPanel = document.getElementById('tab-' + targetTab);
                            if (targetPanel) {
                                targetPanel.classList.add('active');
                            }
                        });
                    });
                });
            </script>

        </div>
    </section>

    <!-- Production Vision Banner -->
    <section class="section section-production-vision">
        <div class="container">
            <div class="production-vision-preamble">
                <h2>От инженерной мысли к масштабному выпуску</h2>
                <p class="production-vision-subtitle">Профессиональная подготовка и высокоточная оснастка позволяют нам запускать производство любой сложности с гарантией стабильного качества в каждой детали</p>
            </div>

            <div class="production-vision-block">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info_development-production.webp"
                    alt="Полный цикл производства пластмассовых изделий: от проектирования пресс-форм до экструзии и литья"
                    loading="lazy"
                    width="1200"
                    height="675"
                    decoding="async">
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="cta-wrapper bg-white p-5 rounded shadow-lg" style="padding: 3rem;">
                <div>
                    <h2 class="mb-3">Ваша идея — наше воплощение</h2>
                    <p class="mb-4 text-muted" style="max-width: 600px; margin-bottom: 2rem;">Свяжитесь с нашими инженерами для предварительного анализа чертежей и расчета стоимости изготовления оснастки.</p>
                    <div style="display: flex; gap: 1rem; justify-content: flex-start; flex-wrap: wrap;">
                        <a href="<?php echo home_url('/quote-request'); ?>" class="btn btn-accent btn-lg">Запросить расчет</a>
                        <a href="<?php echo home_url('/contacts'); ?>" class="btn btn-outline btn-lg" style="border-color: var(--color-primary); color: var(--color-primary);">Связаться с инженерами</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
