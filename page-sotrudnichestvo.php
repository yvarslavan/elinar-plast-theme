<?php
/*
Template Name: Cooperation Page
*/

get_header();
?>

<!-- 1. HERO SECTION -->
<div class="page-hero page-hero-cooperation">
    <picture class="hero-bg-picture">
        <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-sotrudnichestvo.webp" type="image/webp">
        <source media="(max-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-sotrudnichestvo.webp" type="image/webp">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-sotrudnichestvo.webp"
             alt="Производственный цех Элинар Пласт"
             class="hero-bg-img"
             fetchpriority="high"
             loading="eager">
    </picture>
    <div class="hero-overlay hero-overlay-graphite"></div>
    <div class="container">
        <div class="hero-content-cooperation">
            <h1 class="text-white">Прямые поставки и контрактное производство</h1>
            <p class="lead text-white-opacity">
                «Элинар Пласт» приглашает к сотрудничеству промышленные предприятия и строительные холдинги. Мы обеспечиваем стабильность поставок благодаря собственным мощностям и продуманной логистике.
            </p>
            <div class="hero-actions">
                <a href="#contact-form" class="btn btn-primary">Оставить заявку</a>
            </div>
        </div>
    </div>
</div>

<main class="section-cooperation">

    <!-- 2. COMMERCIAL CONDITIONS -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Коммерческие условия</h2>
                <p>Прозрачная модель работы для среднего и крупного бизнеса</p>
            </div>

            <div class="conditions-grid">
                <!-- Block 1 -->
                <div class="condition-card">
                    <div class="condition-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </div>
                    <h3>Гибкость масштабирования</h3>
                    <p class="condition-text">Минимальный объем заказа — от <strong>1000 погонных метров</strong>. Оптимально для средних и крупных серий. Собственный парк оборудования позволяет оперативно наращивать объемы без потери качества.</p>
                </div>

                <!-- Block 2 -->
                <div class="condition-card condition-card-highlight">
                    <div class="condition-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M8 11l4 4 4-8"></path>
                        </svg>
                    </div>
                    <h3>Резервирование сырья</h3>
                    <p class="condition-text">Для постоянных партнеров действует <strong>программа лояльности</strong>: мы резервируем необходимые объемы полимерного сырья под ваш график производства. Это гарантирует неизменность цены и соблюдение сроков отгрузки даже при рыночных колебаниях.</p>
                </div>

                <!-- Block 3 -->
                <div class="condition-card">
                    <div class="condition-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <h3>Отгрузка из центрального хаба</h3>
                    <p class="condition-text">Склад готовой продукции расположен непосредственно при производстве (Московская обл., с. Атепцево). Это исключает лишние звенья в логистике и позволяет контролировать качество упаковки перед отправкой.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. CLIENTS (TRUST) -->
    <section class="section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Отраслевая экспертиза</h2>
                <p>Более 150 постоянных заказчиков в России и СНГ</p>
            </div>

            <div class="clients-logos-wrapper">
                <!--
                   NOTE: Replace src with actual client logos.
                   Using placeholders with text for now as requested by "Logos of known brands" logic.
                -->
                <div class="client-logo-item" title="Производитель бытовой техники">
                    <div class="logo-placeholder">BOSCH (Ref)</div>
                </div>
                <div class="client-logo-item" title="Строительный холдинг">
                    <div class="logo-placeholder">ПИК (Ref)</div>
                </div>
                <div class="client-logo-item" title="Автопром">
                    <div class="logo-placeholder">GAZ (Ref)</div>
                </div>
                <div class="client-logo-item" title="Фасадные системы">
                    <div class="logo-placeholder">ALUTECH (Ref)</div>
                </div>
                <div class="client-logo-item" title="Электротехника">
                    <div class="logo-placeholder">IEK (Ref)</div>
                </div>
                <div class="client-logo-item" title="Ритейл">
                    <div class="logo-placeholder">LEROY MERLIN (Ref)</div>
                </div>
            </div>

            <div class="clients-note">
                <p>Мы являемся сертифицированным поставщиком для международных брендов бытовой техники и лидеров строительной отрасли.</p>
            </div>
        </div>
    </section>

    <!-- 4. TIMELINE -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Этапы взаимодействия</h2>
            </div>

            <div class="coop-timeline">
                <!-- Step 1 -->
                <div class="timeline-item">
                    <div class="timeline-marker">1</div>
                    <div class="timeline-content">
                        <h4>Заявка</h4>
                        <p>Анализ вашего ТЗ или чертежа инженерами.</p>
                    </div>
                </div>

                <!-- Connector -->
                <div class="timeline-connector"></div>

                <!-- Step 2 -->
                <div class="timeline-item">
                    <div class="timeline-marker">2</div>
                    <div class="timeline-content">
                        <h4>Расчет</h4>
                        <p>Коммерческое предложение в течение 24 часов.</p>
                    </div>
                </div>

                <!-- Connector -->
                <div class="timeline-connector"></div>

                <!-- Step 3 -->
                <div class="timeline-item">
                    <div class="timeline-marker">3</div>
                    <div class="timeline-content">
                        <h4>Образцы</h4>
                        <p>Изготовление и согласование контрольных образцов.</p>
                    </div>
                </div>

                <!-- Connector -->
                <div class="timeline-connector"></div>

                <!-- Step 4 -->
                <div class="timeline-item">
                    <div class="timeline-marker">4</div>
                    <div class="timeline-content">
                        <h4>Серия</h4>
                        <p>Запуск производства и плановая отгрузка.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. FINAL CTA -->
    <section id="contact-form" class="section bg-dark text-white cta-cooperation">
        <div class="container">
            <div class="cta-cooperation-inner">
                <div class="cta-cooperation-text">
                    <h2>Начните сотрудничество сегодня</h2>
                    <p>Получите расчет стоимости вашего проекта и индивидуальные условия поставки.</p>
                </div>
                <div class="cta-cooperation-buttons">
                    <a href="<?php echo home_url('/quote-request'); ?>" class="btn btn-accent btn-lg">Оставить заявку на расчет</a>
                    <a href="#" class="btn btn-outline-white btn-lg" onclick="alert('Файл договора будет доступен позже'); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Скачать типовой договор
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
    /* --- HERO STYLES --- */
    .page-hero-cooperation {
        position: relative;
        min-height: 500px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .page-hero-cooperation .hero-overlay-graphite {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(26,26,26,0.35) 0%, rgba(26,26,26,0.3) 50%, rgba(26,26,26,0.2) 100%) !important;
        z-index: 1;
    }

    .hero-content-cooperation {
        position: relative;
        z-index: 2;
        max-width: 800px;
        padding: 60px 0;
    }

    .text-white-opacity {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.25rem;
        line-height: 1.6;
        margin-top: 1.5rem;
        margin-bottom: 2.5rem;
    }

    /* --- COMMERCIAL CONDITIONS --- */
    .conditions-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 30px;
        margin-top: 40px;
    }

    @media (min-width: 992px) {
        .conditions-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .condition-card {
        background: #fff;
        padding: 40px 30px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .condition-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border-color: #0056B3;
    }

    .condition-card-highlight {
        border-top: 4px solid #F39C12; /* Фирменный оранжевый */
    }

    .condition-icon {
        color: #0056B3; /* Глубокий синий */
        margin-bottom: 25px;
    }

    .condition-icon svg {
        width: 48px;
        height: 48px;
    }

    .condition-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1A1A1A;
    }

    .condition-text {
        color: #4b5563;
        line-height: 1.6;
        font-size: 1rem;
    }

    /* --- CLIENTS LOGOS --- */
    .clients-logos-wrapper {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 40px;
    }

    @media (min-width: 768px) {
        .clients-logos-wrapper {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .clients-logos-wrapper {
            grid-template-columns: repeat(6, 1fr);
        }
    }

    .client-logo-item {
        background: #fff;
        border: 1px solid #f3f4f6;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.3s ease;
        padding: 10px;
    }

    .logo-placeholder {
        font-weight: 800;
        color: #d1d5db; /* Светло-серый */
        font-size: 1.2rem;
        text-align: center;
        transition: color 0.3s ease;
    }

    .client-logo-item:hover {
        border-color: #0056B3;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .client-logo-item:hover .logo-placeholder {
        color: #0056B3; /* Подсветка при наведении */
    }

    .clients-note {
        text-align: center;
        margin-top: 3rem;
        color: #6b7280;
        font-style: italic;
    }

    /* --- TIMELINE --- */
    .coop-timeline {
        display: flex;
        flex-direction: column;
        gap: 30px;
        margin-top: 40px;
        position: relative;
    }

    @media (min-width: 768px) {
        .coop-timeline {
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0;
        }
    }

    .timeline-item {
        display: flex;
        flex-direction: column;
        align-items: center; /* Центрирование на мобильных */
        text-align: center;
        position: relative;
        flex: 1;
        z-index: 2;
    }

    .timeline-marker {
        width: 50px;
        height: 50px;
        background: #fff;
        border: 2px solid #0056B3;
        color: #0056B3;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
    }

    .timeline-content h4 {
        color: #1A1A1A;
        font-size: 1.25rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .timeline-content p {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.5;
        max-width: 250px;
        margin: 0 auto;
    }

    .timeline-connector {
        display: none;
    }

    @media (min-width: 768px) {
        .timeline-connector {
            display: block;
            height: 2px;
            background: #e5e7eb;
            flex-grow: 1;
            margin-top: 25px; /* Half of marker height */
            position: relative;
            z-index: 1;
        }
    }

    /* --- FINAL CTA --- */
    .cta-cooperation {
        padding: 80px 0;
        background-color: #111827; /* Dark graphite */
    }

    .cta-cooperation-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 40px;
    }

    @media (min-width: 992px) {
        .cta-cooperation-inner {
            flex-direction: row;
            justify-content: space-between;
            text-align: left;
        }

        .cta-cooperation-buttons {
            flex-shrink: 0;
        }
    }

    .cta-cooperation-text h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #fff;
    }

    .cta-cooperation-text p {
        color: #9ca3af;
        font-size: 1.1rem;
    }

    .cta-cooperation-buttons {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 100%;
        max-width: 400px;
    }

    @media (min-width: 768px) {
        .cta-cooperation-buttons {
            flex-direction: row;
            max-width: none;
        }
    }

    .btn-lg {
        padding: 15px 30px;
        font-size: 1.1rem;
    }

    .btn-outline-white {
        border: 2px solid rgba(255,255,255,0.3);
        color: #fff;
        background: transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-outline-white:hover {
        background: rgba(255,255,255,0.1);
        border-color: #fff;
        color: #fff;
    }

    @media (max-width: 767px) {
        .page-hero-cooperation {
            min-height: 360px;
        }

        .hero-content-cooperation {
            padding: 36px 0;
        }

        .text-white-opacity {
            font-size: 1rem;
            line-height: 1.5;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
        }

        .condition-card {
            padding: 28px 20px;
        }

        .condition-card h3 {
            font-size: 1.25rem;
        }

        .cta-cooperation {
            padding: 56px 0;
        }

        .cta-cooperation-text h2 {
            font-size: 1.75rem;
        }

        .cta-cooperation-text p {
            font-size: 1rem;
        }

        .btn-lg {
            width: 100%;
            padding: 14px 18px;
            font-size: 1rem;
        }
    }

    @media (max-width: 390px) {
        .page-hero-cooperation {
            min-height: 320px;
        }

        .condition-card {
            padding: 22px 16px;
        }

        .condition-icon svg {
            width: 40px;
            height: 40px;
        }

        .cta-cooperation-text h2 {
            font-size: 1.5rem;
            line-height: 1.3;
        }
    }
</style>

<?php get_footer(); ?>
