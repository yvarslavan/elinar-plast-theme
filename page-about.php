<?php
/*
Template Name: About Page
*/
// Форма обрабатывается универсальным обработчиком в functions.php (elinar_handle_project_form_universal)
get_header();
?>

<!-- HERO BLOCK - Optimized for LCP -->
<div class="page-hero page-hero-compact page-hero-about">
    <!-- Hero Background Image - LCP optimized -->
    <picture class="hero-bg-picture">
        <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg_about_mobile.webp" type="image/webp">
        <source media="(max-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg_about_tablet.webp" type="image/webp">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg_about.webp"
            alt="О компании Элинар Пласт"
            class="hero-bg-img"
            width="1920"
            height="1080"
            fetchpriority="high"
            loading="eager"
            decoding="sync">
    </picture>
    <div class="hero-overlay"></div>
    <div class="container">
        <h1 class="text-white"><span class="accent-text">Немецкие</span> технологии производства изделий из пластмасс в России</h1>
        <p class="lead">Мы работаем на рынке с <span class="fw-bold">2001 года</span>. <span class="fw-bold">Более 20 лет</span> «Элинар Пласт» объединяет высокие стандарты качества с современными производственными мощностями в Московской области.</p>
    </div>

    <!-- Scroll Down Button -->
    <?php get_template_part('template-parts/scroll-down-btn'); ?>
</div>

<!-- HERO INTRO BLOCK - Вводный раздел о компании -->
<section class="section section-hero-intro">
    <div class="container">
        <!-- Заголовок секции -->
        <div class="hero-intro-header">
            <h2 class="hero-intro-title">ООО «Элинар Пласт» — <span class="accent-gradient">современное производственное предприятие с более чем 20-летним опытом</span></h2>
        </div>

        <!-- Вступительный текст (выровнен по сетке карточек) -->
        <div class="hero-intro-content-wrapper">
            <div class="hero-intro-text-full">
                <p>Более 20 лет ООО «Элинар Пласт» занимает лидирующие позиции на рынке полимерной продукции, являясь одним из производственных активов многопрофильной группы компаний «Элинар».

                    Основанное в 2001 году, наше предприятие эволюционировало из цеха по производству изделий из пластмасс в современное производственное предприятие, где опыт российских инженеров соединяется с передовыми европейскими технологиями.</p>

                <h3 class="intro-subtitle">Наши ключевые компетенции:</h3>
                <p>Сегодня мы обеспечиваем потребности крупнейших промышленных предприятий России и СНГ по следующим направлениям:</p>

                <ul class="intro-competencies-list">
                    <li><strong>Высокотехнологичная экструзия:</strong> производство сложных многокомпонентных профилей, совмещающих материалы разной жесткости и цвета в одном изделии.</li>
                    <li><strong>Литье пластмасс под давлением:</strong> изготовление высокоточных деталей на автоматизированных термопластавтоматах.</li>
                    <li><strong>Разработка экструзионной оснастки и пресс-форм для производства изделий по ТЗ заказчиков:</strong> от идеи и проектирования в конструкторском бюро наших партнёров до изготовления пресс-форм и высокоресурсной экструзионной оснастки.</li>
                </ul>

                <h3 class="intro-subtitle">Почему выбирают «Элинар Пласт»:</h3>

                <ul class="intro-advantages-list">
                    <li><strong>Высокие стандарты качества:</strong> многоступенчатый контроль качества каждой партии.</li>
                    <li><strong>Технологическое превосходство:</strong> технологические стандарты, заложенные немецкой компанией-учредителем, и высокоточная оснастка, изготовленная российскими партнёрами, позволяют нам реализовывать сложные проекты, обеспечивая идеальную геометрию и долговечность изделий.</li>
                    <li><strong>Приоритетное, внимательное обслуживание:</strong> мы ценим доверие своих заказчиков, работаем с каждым, исходя из принципов быстрого реагирования, вовлеченности и информационной открытости.</li>
                    <li><strong>Удобное расположение производственных и складских площадей в Подмосковье:</strong> производство и склад в Наро-Фоминском районе (с. Атепцево) позволяют осуществлять оперативную отгрузку и удобную логистику по Москве, Московской области и всей территории России.</li>
                </ul>
            </div>
        </div>

        <!-- Сетка преимуществ (4 карточки) -->
        <div class="hero-intro-advantages-grid">
            <!-- Карточка 1: Высокие стандарты качества -->
            <div class="advantage-card">
                <div class="advantage-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        <path d="M9 12l2 2 4-4" />
                    </svg>
                </div>
                <h3>Высокие стандарты качества</h3>
                <p>Многоступенчатый контроль качества каждой партии.</p>
            </div>

            <!-- Карточка 2: Технологическое превосходство -->
            <div class="advantage-card">
                <div class="advantage-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                    </svg>
                </div>
                <h3>Технологическое превосходство</h3>
                <p>Технологические стандарты, заложенные немецкой компанией-учредителем, и высокоточная оснастка, изготовленная российскими партнёрами, позволяют нам реализовывать сложные проекты, обеспечивая идеальную геометрию и долговечность изделий.</p>
            </div>

            <!-- Карточка 3: Приоритетное, внимательное обслуживание -->
            <div class="advantage-card">
                <div class="advantage-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                        <line x1="12" y1="22.08" x2="12" y2="12" />
                    </svg>
                </div>
                <h3>Приоритетное, внимательное обслуживание</h3>
                <p>Мы ценим доверие своих заказчиков, работаем с каждым, исходя из принципов быстрого реагирования, вовлеченности и информационной открытости.</p>
            </div>

            <!-- Карточка 4: Логистика в Атепцево -->
            <div class="advantage-card">
                <div class="advantage-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="10" r="3" />
                        <path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z" />
                    </svg>
                </div>
                <h3>Логистика в Атепцево</h3>
                <p>Производство и склад в Наро-Фоминском районе (с. Атепцево) позволяют осуществлять оперативную отгрузку и удобную логистику по Москве, Московской области и всей территории России.</p>
            </div>
        </div>
    </div>

    <!-- Визуальный разделитель - диагональная полоса -->
    <div class="section-divider-diagonal"></div>
</section>

<!-- BLOCK 1: HISTORY TIMELINE -->
<section class="section section-history">
    <div class="container">
        <div class="history-intro">
            <h2>История развития</h2>
            <p>Путь от цеха по производству изделий из пластмасс до современного производственного предприятия</p>
        </div>

        <div class="timeline-container">
            <!-- Stage 0: Origin -->
            <div class="timeline-item">
                <div class="timeline-icon">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                </div>
                <div class="timeline-content">
                    <span class="timeline-date">1995 г.</span>
                    <h3 class="timeline-title">История</h3>
                    <p class="timeline-text">На заводе электроизоляционных материалов «Элинар» был открыт цех по производству изделий из пластмасс. Цех выпускал электроизоляционные трубки и комплектующие для намотки электроизоляции.</p>
                </div>
            </div>

            <!-- Stage 1: Foundation -->
            <div class="timeline-item">
                <div class="timeline-icon">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21h18" />
                        <path d="M5 21V7l8-4 8 4v14" />
                        <path d="M17 21v-8h-6v8" />
                    </svg>
                </div>
                <div class="timeline-content">
                    <span class="timeline-date">Начало 2000-х</span>
                    <h3 class="timeline-title">Основание</h3>
                    <p class="timeline-text">На базе цеха по производству изделий из пластмасс в 2001 году было создано совместное российско-германское «Элинар Пласт».
                        Основная задача - обеспечение потребности завода «Элинар» комплектующими для намотки электроизоляции, а также производство профильно-погонажных изделий для крупных российских предприятий.</p>
                </div>
            </div>

            <!-- Stage 2: Formation -->
            <div class="timeline-item">
                <div class="timeline-icon">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                    </svg>
                </div>
                <div class="timeline-content">
                    <span class="timeline-date">2005-2014 гг.</span>
                    <h3 class="timeline-title">Становление</h3>
                    <p class="timeline-text">Предприятие развивалось в составе промышленной группы «Элинар» и всегда ориентировалось на строгие требования к качеству, стабильность поставок и технологическую гибкость. Первые годы были сосредоточены на запуске экструзионных линий, подборе оптимальных рецептур под задачи заказчиков. Постепенно рос портфель заказов и парк оснастки к ним, на производстве появились оборудованные рабочие зоны для мелкосерийных проектов.</p>
                </div>
            </div>

            <!-- Stage 3: Modernization -->
            <div class="timeline-item">
                <div class="timeline-icon">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                    </svg>
                </div>
                <div class="timeline-content">
                    <span class="timeline-date">2015-2021 гг.</span>
                    <h3 class="timeline-title">Модернизация</h3>
                    <p class="timeline-text">С 2015 г. предприятие активно расширяет линейку производимой продукции, осваивает новые направления деятельности и модернизирует оборудование. Были установлены новые высокопроизводительные экструзионные линии, модернизирован парк литьевых машин, введены новые подходы контроля параметров сырья и готовой продукции.</p>
                </div>
            </div>

            <!-- Stage 4: Present -->
            <div class="timeline-item">
                <div class="timeline-icon">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                </div>
                <div class="timeline-content">
                    <span class="timeline-date">Настоящее время</span>
                    <h3 class="timeline-title">Стабильный рост</h3>
                    <p class="timeline-text">Сегодня «Элинар Пласт» — надёжный производитель пластмассовых изделий различных отраслей промышленности. Мы работаем по долгосрочным контрактам, беремся за нестандартные задачи, обеспечиваем индивидуальную разработку профиля и производство комплектующих по техническим требованиям заказчика.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 1.5: OUR TEAM - REDESIGNED -->
<section class="section section-team-redesigned">
    <div class="container">
        <!-- Vertical Timeline Connection Line -->
        <div class="team-section-line"></div>

        <div class="team-asymmetric-layout">
            <!-- Left Column: Text Content (45%) -->
            <div class="team-content-col">
                <h2 class="team-main-title">Наша команда</h2>
                <p class="team-intro-text">За качеством продукции «Элинар Пласт» стоят люди. Наш коллектив — это сплав опыта инженеров, стоявших у истоков основания завода в 2001 году, и энергии молодых специалистов.</p>

                <!-- Specialists Tags -->
                <div class="team-specialists-tags">
                    <span class="specialist-tag">Технологи</span>
                    <span class="specialist-tag">Операторы линий</span>
                    <span class="specialist-tag">Наладчики ТПА</span>
                    <span class="specialist-tag">Инженеры</span>
                </div>

                <p class="team-quality-text">Обучение по стандартам немецких партнеров и минимальная текучесть кадров позволяют сохранять уникальные знания и поддерживать стабильно высокое качество.</p>

                <!-- Infographic Stats -->
                <div class="team-stats-infographic">
                    <div class="stat-item">
                        <div class="stat-number" data-target=">20">&gt;20</div>
                        <div class="stat-label">лет опыта в отрасли</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-target="100%">100%</div>
                        <div class="stat-label">контроль каждой партии</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-target="2001">2001</div>
                        <div class="stat-label">год основания</div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Visual Part (55%) -->
            <div class="team-visual-col">
                <!-- Geometric Background Element -->
                <div class="team-photo-bg-element"></div>

                <!-- Team Photo with Bleed Effect -->
                <div class="team-photo-container">
                    <!-- Industrial Corner Markers -->
                    <div class="corner-marker corner-tl"></div>
                    <div class="corner-marker corner-tr"></div>
                    <div class="corner-marker corner-bl"></div>
                    <div class="corner-marker corner-br"></div>

                    <a href="<?php echo get_template_directory_uri(); ?>/assets/images/team-engineers-production.webp" class="glightbox team-photo-link" data-gallery="team-gallery">
                        <div class="team-photo-wrapper">
                            <picture>
                                <source media="(max-width: 480px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/team-engineers-production.webp" type="image/webp">
                                <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/team-engineers-production.webp" type="image/webp">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/team-engineers-production.webp" type="image/webp">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-engineers-production.webp" alt="Инженеры завода Элинар Пласт на производстве" loading="lazy" width="800" height="600" decoding="async">
                            </picture>
                            <div class="team-photo-hover-overlay">
                                <span class="view-label">Просмотр</span>
                            </div>
                        </div>
                    </a>

                    <!-- Technical Caption -->
                    <div class="team-photo-caption">
                        <span class="caption-line"></span>
                        производство «Элинар Пласт». Наро-Фоминск, 2025
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 2: VIDEO PRESENTATION -->
<section class="section about-video-section">
    <div class="container">
        <div class="about-video-wrapper">
            <div class="about-video-header">
                <div class="video-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                </div>
                <h3 class="about-video-title">Видеопрезентация компании</h3>
            </div>
            <div class="video-container">
                <video
                    controls
                    poster="<?php echo get_template_directory_uri(); ?>/assets/video/poster.webp"
                    preload="none"
                    loop
                    playsinline
                    style="width: 100%; height: auto; display: block;">
                    <source src="<?php echo get_template_directory_uri(); ?>/assets/video/company_presentation.mp4" type="video/mp4">
                    Ваш браузер не поддерживает воспроизведение видео.
                </video>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 2: PRODUCTION (Redesigned - Process Grid) -->
<section class="section section-tech-process">
    <div class="container">
        <!-- Intro Header -->
        <div class="tech-process-header">
            <h2 class="section-title">Технологии и оборудование</h2>
            <div class="tech-process-lead">
                <p>Производственные процессы предприятия построены на двух ключевых технологиях: экструзии и литье под давлением. Такое сочетание позволяет выпускать как профили сложного сечения, так и многокомпонентные изделия технического назначения, объединяющие разные материалы.</p>
            </div>
        </div>

        <!-- Process Cards Grid -->
        <div class="tech-process-grid">
            <!-- Card 01: Extrusion -->
            <div class="process-card">
                <div class="process-card-number">01</div>
                <div class="process-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h20" />
                        <path d="M2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6" />
                        <path d="M12 2v20" />
                        <path d="M2 12V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v6" />
                    </svg>
                </div>
                <h3 class="process-card-title">Экструзионный участок</h3>
                <p class="process-card-text">
                    Оснащен современным европейским оборудованием. Мы используем сырье от сертифицированных поставщиков. Производственные мастера отслеживают геометрию профиля, стабильность толщины и качество поверхности по утвержденным картам контроля. Реализована технология со-экструзии для создания многокомпонентных профилей.
                </p>
            </div>

            <!-- Card 02: Injection -->
            <div class="process-card">
                <div class="process-card-number">02</div>
                <div class="process-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3v19" />
                        <path d="M5 8h14" />
                        <path d="M19 16H5" />
                    </svg>
                </div>
                <h3 class="process-card-title">Литьевой участок</h3>
                <p class="process-card-text">
                    Работает на термопластавтоматах с автоматизированной подачей сырья и стабильным температурным режимом. Производственная оснастка обеспечивает точность формы, стабильность изделия и ресурс долговечной эксплуатации. Мы гарантируем высокую повторяемость изделий в партии.
                </p>
            </div>

            <!-- Card 03: Quality & Series -->
            <div class="process-card">
                <div class="process-card-number">03</div>
                <div class="process-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                        <polyline points="14 2 14 8 20 8" />
                        <path d="M9 15l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="process-card-title">Системный контроль</h3>
                <p class="process-card-text">
                    Для серийных заказов действует регламентированная система настройки оборудования и контроля качества. Для нестандартных проектов мы выполняем опытные партии, корректируем параметры изделия и при необходимости дорабатываем оснастку до получения идеального результата.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- TECHNOLOGY SLIDER BLOCK -->
<section class="technology-slider-section">
    <div class="container">
        <div class="slider-header">
            <h2>Визуальное воплощение наших мощностей</h2>
            <p>Познакомьтесь с нашими технологическими возможностями и современным оборудованием, которое позволяет нам реализовывать самые сложные проекты в области переработки полимеров.</p>
        </div>

        <div class="slider-container">
            <div class="slider-wrapper">
                <!-- Слайд 1: Главный баннер -->
                <div class="slide active">
                    <a href="<?php echo get_template_directory_uri(); ?>/assets/images/technologies-banner.webp"
                        class="glightbox"
                        data-gallery="tech-capacities"
                        data-glightbox="title: Производственный цех; description: Общий вид современного производственного комплекса Элинар Пласт">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/technologies-banner.webp"
                            alt="Производственный цех Элинар Пласт"
                            loading="lazy">
                    </a>
                </div>

                <!-- Слайд 2: Экструзия -->
                <div class="slide">
                    <a href="<?php echo get_template_directory_uri(); ?>/assets/images/extrusion-infographic.webp"
                        class="glightbox"
                        data-gallery="tech-capacities"
                        data-glightbox="title: Экструзия полимеров; description: Линия для производства погонажных изделий сложного сечения">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/extrusion-infographic.webp"
                            alt="Технология экструзии полимеров"
                            loading="lazy">
                    </a>
                </div>

                <!-- Слайд 3: Литьё под давлением -->
                <div class="slide">
                    <a href="<?php echo get_template_directory_uri(); ?>/assets/images/injection-molding-infographic.webp"
                        class="glightbox"
                        data-gallery="tech-capacities"
                        data-glightbox="title: Литье под давлением; description: Высокоточные термопластавтоматы для производства объемных деталей">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/injection-molding-infographic.webp"
                            alt="Литье пластмасс под давлением"
                            loading="lazy">
                    </a>
                </div>

                <!-- Слайд 4: Сырье -->
                <div class="slide">
                    <a href="<?php echo get_template_directory_uri(); ?>/assets/images/production-slide-3.webp"
                        class="glightbox"
                        data-gallery="tech-capacities"
                        data-glightbox="title: Сырье высшего качества; description: Используем только первичные полимеры от ведущих мировых поставщиков. Чистота материала на входе — гарантия стабильности физико-химических свойств готового изделия.">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/production-slide-3.webp"
                            alt="Контроль качества сырья"
                            loading="lazy">
                    </a>
                </div>

                <!-- Слайд 5: Контроль параметров -->
                <div class="slide slide-portrait">
                    <a href="<?php echo get_template_directory_uri(); ?>/assets/images/production-slide-5.webp"
                        class="glightbox"
                        data-gallery="tech-capacities"
                        data-glightbox="title: Контроль параметров; description: Современные системы контроля давления и температуры литья обеспечивают отсутствие брака и полное соответствие изделий вашим чертежам.">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/production-slide-5.webp"
                            alt="Автоматизированный контроль производства"
                            loading="lazy">
                    </a>
                </div>

                <!-- Слайд 6: Оборудование -->
                <div class="slide">
                    <a href="<?php echo get_template_directory_uri(); ?>/assets/images/production-slide-7.webp"
                        class="glightbox"
                        data-gallery="tech-capacities"
                        data-glightbox="title: Высокотехнологичное оборудование; description: Мы превращаем полимерный гранулят в готовые инженерные решения. Наш парк оборудования настроен на работу с пресс-формами высокой сложности, обеспечивая безупречное качество поверхности и точность размеров. «Элинар Пласт» — это стабильное серийное производство, где каждый цикл литья контролируется электроникой для достижения 100% повторяемости результата.">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/production-slide-7.webp"
                            alt="Современное производственное оборудование"
                            loading="lazy">
                    </a>
                </div>
            </div>

            <!-- Навигационные стрелки -->
            <div class="slider-nav">
                <button class="nav-arrow prev-slide">❮</button>
                <button class="nav-arrow next-slide">❯</button>
            </div>

            <!-- Буллеты -->
            <div class="slider-bullets">
                <span class="bullet active" data-slide="0"></span>
                <span class="bullet" data-slide="1"></span>
                <span class="bullet" data-slide="2"></span>
                <span class="bullet" data-slide="3"></span>
                <span class="bullet" data-slide="4"></span>
                <span class="bullet" data-slide="5"></span>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 3: PRODUCTS (Grid) -->
<section class="section section-products-grid">
    <div class="container">
        <h2 class="section-title text-center mb-5">Наша продукция</h2>

        <div class="products-grid-3">
            <!-- Card 1: Extrusion -->
            <div class="product-card-modern">
                <div class="product-card-head">
                    <div class="product-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12h18M3 12l4-4M3 12l4 4M21 12l-4-4M21 12l-4 4" />
                        </svg>
                    </div>
                    <h3 class="product-card-title">Профильно-погонажные изделия</h3>
                </div>
                <ul class="product-card-list">
                    <li>Технические профили</li>
                    <li>Двухкомпонентные профили</li>
                    <li>Втулки и шпули</li>
                    <li>Изделия под спецификацию</li>
                </ul>
            </div>

            <!-- Card 2: Injection -->
            <div class="product-card-modern">
                <div class="product-card-head">
                    <div class="product-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <circle cx="12" cy="12" r="2" />
                        </svg>
                    </div>
                    <h3 class="product-card-title">Литье под давлением</h3>
                </div>
                <ul class="product-card-list">
                    <li>Кольца и заглушки</li>
                    <li>Элементы корпусов</li>
                    <li>Компоненты для сборки</li>
                    <li>Детали пром. оборудования</li>
                </ul>
            </div>

            <!-- Card 3: Custom -->
            <div class="product-card-modern">
                <div class="product-card-head">
                    <div class="product-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                        </svg>
                    </div>
                    <h3 class="product-card-title">Спецзаказы</h3>
                </div>
                <ul class="product-card-list">
                    <li>Индивидуальная разработка</li>
                    <li>Изготовление по образцу</li>
                    <li>Производство по чертежам</li>
                    <li>Подбор материала</li>
                </ul>
            </div>
        </div>

        <div class="products-quality-note">
            Каждое изделие проходит строгий контроль размеров, качества поверхности и стабильности химического состава.
        </div>
    </div>
</section>

<!-- BLOCK 4: TECHNOLOGIES (Grid with Icons) -->
<section class="section section-technologies-grid">
    <div class="container">
        <h2 class="section-title text-center mb-5">Технологии производства</h2>

        <div class="technologies-cards-wrapper">
            <!-- Tech 1: Extrusion -->
            <div class="tech-card-item">
                <div class="tech-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h20" />
                        <path d="M2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6" />
                        <path d="M12 2v20" />
                        <path d="M2 12V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v6" />
                    </svg>
                </div>
                <h3>Экструзия</h3>
                <p>Базовая технология нашего производства для создания погонажных изделий. Процесс непрерывного формования позволяет выпускать профили с постоянным сечением любой сложности, обеспечивая идеальную геометрию и соблюдение размеров по всей длине изделия.</p>
            </div>

            <!-- Tech 2: Co-Extrusion -->
            <div class="tech-card-item">
                <div class="tech-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" />
                        <path d="M2 17l10 5 10-5" />
                        <path d="M2 12l10 5 10-5" />
                    </svg>
                </div>
                <h3>Со-экструзия</h3>
                <p>Передовой метод соединения разнородных материалов в едином профиле за одну стадию. Мы комбинируем жесткие и мягкие пластики, разные цвета или функциональные слои, создавая изделия с уникальными свойствами без дополнительной сборки.</p>
            </div>

            <!-- Tech 3: Injection Molding -->
            <div class="tech-card-item">
                <div class="tech-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3v19" />
                        <path d="M5 8h14" />
                        <path d="M19 16H5" />
                    </svg>
                </div>
                <h3>Литье под давлением</h3>
                <p>Технология для выпуска объемных деталей сложной конфигурации с высокой точностью. Мы гарантируем стабильность веса, отсутствие дефектов и высокую прочность каждого компонента в партии.</p>
            </div>
        </div>
    </div>
</section>

<style>
    /* Styles for Technologies Grid */
    .technologies-cards-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .tech-card-item {
        background: #fff;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .tech-card-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .tech-icon-wrapper {
        width: 64px;
        height: 64px;
        background: rgba(0, 102, 204, 0.08);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: #0066cc;
        transition: background 0.3s ease, color 0.3s ease;
    }

    .tech-card-item:hover .tech-icon-wrapper {
        background: #0066cc;
        color: #fff;
    }

    .tech-card-item h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #1e293b;
    }

    .tech-card-item p {
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 0;
        flex-grow: 1;
    }
</style>

<!-- BLOCK 5: ADVANTAGES -->
<section class="section section-advantages-grid">
    <div class="container">
        <h2 class="section-title text-center mb-5">Преимущества работы с нами</h2>

        <div class="advantages-grid-modern">
            <!-- 1. Accuracy -->
            <div class="advantage-item-modern">
                <div class="adv-icon-modern">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                </div>
                <div class="adv-text-modern">Оборудование с высокой точностью настройки</div>
            </div>

            <!-- 2. German Tooling -->
            <div class="advantage-item-modern">
                <div class="adv-icon-modern">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                </div>
                <div class="adv-text-modern">Высокоресурсная оснастка</div>
            </div>

            <!-- 3. Total Control -->
            <div class="advantage-item-modern">
                <div class="adv-icon-modern">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h20" />
                        <path d="M2 12l5 5" />
                        <path d="M22 12l-5-5" />
                    </svg>
                </div>
                <div class="adv-text-modern">Полный контроль параметров сырья и продукции</div>
            </div>

            <!-- 4. R&D -->
            <div class="advantage-item-modern">
                <div class="adv-icon-modern">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                    </svg>
                </div>
                <div class="adv-text-modern">Разработка профиля и изделия под требования</div>
            </div>

            <!-- 5. Regional Industry -->
            <div class="advantage-item-modern">
                <div class="adv-icon-modern">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21h18" />
                        <path d="M9 8h1" />
                        <path d="M9 12h1" />
                        <path d="M9 16h1" />
                        <path d="M14 8h1" />
                        <path d="M14 12h1" />
                        <path d="M14 16h1" />
                        <path d="M5 21V7l8-4 8 4v14" />
                    </svg>
                </div>
                <div class="adv-text-modern">Работа с промышленными предприятиями региона</div>
            </div>

            <!-- 6. Stability -->
            <div class="advantage-item-modern">
                <div class="adv-icon-modern">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                </div>
                <div class="adv-text-modern">Стабильные поставки и гибкость по объемам</div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Cross-Promo Banner -->
<section class="section faq-cross-promo-section">
    <div class="container">
        <div class="faq-cross-promo" id="faq-cross-promo" data-page="about">
            <div class="faq-cross-promo-content">
                <div class="faq-cross-promo-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div class="faq-cross-promo-text">
                    <h3 class="faq-cross-promo-title">Вопросы по срокам, партиям и оснастке?</h3>
                    <p class="faq-cross-promo-desc">Готовые ответы по контрактному производству</p>
                </div>
                <a href="<?php echo home_url('/technologies-and-contract-manufacturing/#faq'); ?>" class="faq-cross-promo-btn" data-faq-teaser="cross-promo-about">
                    Смотреть ответы
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            <button class="faq-cross-promo-close" aria-label="Закрыть" data-close-banner="faq-cross-promo">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- BLOCK 6: TARGET AUDIENCE -->
<section class="section section-target-audience bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5">Для кого мы работаем</h2>

        <div class="audience-cards-grid">
            <!-- Card 1: Manufacturing Companies -->
            <div class="audience-card">
                <div class="audience-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21h18" />
                        <path d="M5 21V7l8-4 8 4v14" />
                        <path d="M9 9h1M9 13h1M9 17h1" />
                        <path d="M14 9h1M14 13h1M14 17h1" />
                    </svg>
                </div>
                <h3 class="audience-card-title">Производственные предприятия</h3>
                <p class="audience-card-desc">Поставляем профили и комплектующие для серийного производства с гарантией стабильного качества</p>
            </div>

            <!-- Card 2: Assembly Lines -->
            <div class="audience-card">
                <div class="audience-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" />
                        <path d="M16 3v4M8 3v4" />
                        <path d="M2 11h20" />
                        <path d="M7 15h.01M12 15h.01M17 15h.01" />
                    </svg>
                </div>
                <h3 class="audience-card-title">Компании с собственными сборочными линиями</h3>
                <p class="audience-card-desc">Изготавливаем детали точно в срок для бесперебойной работы ваших производственных линий</p>
            </div>

            <!-- Card 3: Contractors -->
            <div class="audience-card">
                <div class="audience-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                        <line x1="10" y1="9" x2="8" y2="9" />
                    </svg>
                </div>
                <h3 class="audience-card-title">Подрядчики (детали по спецификации)</h3>
                <p class="audience-card-desc">Производим изделия строго по вашим чертежам и техническим требованиям заказчика</p>
            </div>

            <!-- Card 4: Factories -->
            <div class="audience-card">
                <div class="audience-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 2v6l3 3 3-3V2" />
                        <path d="M3 11h18" />
                        <path d="M5 11v10h14V11" />
                        <path d="M9 15h6" />
                        <path d="M9 18h6" />
                    </svg>
                </div>
                <h3 class="audience-card-title">Заводы (профили под индивидуальные задачи)</h3>
                <p class="audience-card-desc">Разрабатываем уникальные профили под специфические производственные задачи вашего завода</p>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 6.5: COMMERCIAL CONDITIONS (from Cooperation Page) -->
<section class="section section-commercial-conditions">
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
                <h3>Отгрузка с производственного склада</h3>
                <p class="condition-text">Склад готовой продукции расположен непосредственно при производстве (Московская обл., с. Атепцево). Это исключает лишние звенья в логистике и позволяет контролировать качество упаковки перед отправкой.</p>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 6.6: COOPERATION TIMELINE (Redesigned - Milestones) -->
<section class="section section-coop-timeline">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Этапы взаимодействия</h2>
            <p>Прозрачный путь от заявки до отгрузки партии</p>
        </div>

        <div class="milestone-grid">
            <!-- Connecting Line (Desktop) -->
            <div class="milestone-track"></div>

            <!-- Step 1 -->
            <div class="milestone-card">
                <div class="milestone-header">
                    <div class="milestone-number">01</div>
                    <div class="milestone-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                </div>
                <div class="milestone-body">
                    <h4>Заявка и анализ</h4>
                    <p>Прием вашего ТЗ, чертежей или 3D-моделей. Экспресс-оценка технологичности инженерами.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="milestone-card">
                <div class="milestone-header">
                    <div class="milestone-number">02</div>
                    <div class="milestone-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2"></rect>
                            <line x1="8" y1="6" x2="16" y2="6"></line>
                            <line x1="16" y1="14" x2="16" y2="18"></line>
                            <path d="M16 10h.01"></path>
                            <path d="M12 10h.01"></path>
                            <path d="M8 10h.01"></path>
                            <path d="M12 14h.01"></path>
                            <path d="M8 14h.01"></path>
                            <path d="M12 18h.01"></path>
                            <path d="M8 18h.01"></path>
                        </svg>
                    </div>
                </div>
                <div class="milestone-body">
                    <h4>Расчет проекта</h4>
                    <p>Подбор сырья, выбор типа оснастки и подготовка коммерческого предложения (КП).</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="milestone-card">
                <div class="milestone-header">
                    <div class="milestone-number">03</div>
                    <div class="milestone-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </div>
                </div>
                <div class="milestone-body">
                    <h4>Оснастка и образцы</h4>
                    <p>Производство пресс-формы/оснастки, выпуск опытной партии и утверждение эталонного образца.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="milestone-card">
                <div class="milestone-header">
                    <div class="milestone-number">04</div>
                    <div class="milestone-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                    </div>
                </div>
                <div class="milestone-body">
                    <h4>Серийный выпуск</h4>
                    <p>Запуск массового производства, контроль качества ОТК, упаковка и отгрузка на ваш склад.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 7: QUALITY & CERTIFICATES -->
<section class="section section-quality-cert">
    <div class="container">
        <!-- Awards Gallery -->
        <div class="awards-section">
            <div class="awards-header">
                <div class="awards-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6" />
                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11" />
                    </svg>
                </div>
                <h3>Признание и ответственность</h3>
                <p class="awards-subtitle">Наша работа отмечена благодарностями на региональном уровне. Мы дорожим своей репутацией и вносим вклад в развитие отрасли.</p>
            </div>
            <div class="awards-grid">
                <?php
                $cert_uri = get_template_directory_uri() . '/assets/images/certificates/';

                // Certificates with descriptions
                $certificates = [
                    [
                        'url' => $cert_uri . 'Благодарность.jpg',
                        'caption' => 'Благодарность Губернатора Московской области Генеральному директору Ураковой С.А.'
                    ],
                    [
                        'url' => $cert_uri . 'Почетная Грамота.jpg',
                        'caption' => 'Почетная грамота Московской областной Думы коллективу общества'
                    ],
                    [
                        'url' => $cert_uri . 'Благодарственное письмо.jpg',
                        'caption' => 'Благодарственное письмо Московской областной Думы Ураковой С.А. за многолетний труд'
                    ]
                ];

                foreach ($certificates as $cert) : ?>
                    <a href="<?php echo esc_url($cert['url']); ?>" class="award-item glightbox" data-gallery="awards" data-title="<?php echo esc_attr($cert['caption']); ?>">
                        <div class="award-img-wrapper">
                            <img src="<?php echo esc_url($cert['url']); ?>" alt="<?php echo esc_attr($cert['caption']); ?>" loading="lazy">
                            <div class="award-overlay">
                                <div class="award-overlay-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                        <line x1="11" y1="8" x2="11" y2="14" />
                                        <line x1="8" y1="11" x2="14" y2="11" />
                                    </svg>
                                    <span class="award-overlay-text">Увеличить</span>
                                </div>
                            </div>
                        </div>
                        <div class="award-caption">
                            <?php echo esc_html($cert['caption']); ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- CLIENT TESTIMONIALS (Moved from Home Page) -->
        <div class="awards-testimonials-section" style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(0,0,0,0.05);">
            <div class="section-title text-center">
                <h2>Отзывы клиентов</h2>
                <p>Что говорят о нас наши партнеры</p>
            </div>
            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&h=400&fit=crop"
                                alt="Артем Ковальчук"
                                loading="lazy"
                                onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/images/avatar-placeholder.svg'">
                        </div>
                        <div class="testimonial-author">
                            <div class="author-name">Артем Ковальчук</div>
                            <div class="author-position">Ведущий инженер-технолог</div>
                            <div class="author-company">ГК «Индустрия-М»</div>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <svg class="quote-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" fill="#0056B3" opacity="0.2" />
                            <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" fill="#0056B3" opacity="0.2" />
                        </svg>
                        <p>«Долго искали поставщика, способного выдержать строгие допуски по геометрии профиля. Специалисты "Элинар Пласт" не просто приняли чертежи, а предложили оптимизировать состав полимера, что повысило износостойкость деталей на 20%. Поставки идут строго по графику, входной контроль качества проходит без нареканий».</p>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&h=400&fit=crop"
                                alt="Наталья Верещагина"
                                loading="lazy"
                                onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/images/avatar-placeholder.svg'">
                        </div>
                        <div class="testimonial-author">
                            <div class="author-name">Наталья Верещагина</div>
                            <div class="author-position">Коммерческий директор</div>
                            <div class="author-company">ТД «СтройРесурс»</div>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <svg class="quote-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" fill="#0056B3" opacity="0.2" />
                            <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" fill="#0056B3" opacity="0.2" />
                        </svg>
                        <p>«Работаем с компанией уже четвертый год. Для нас критически важна стабильность цвета и физико-механических свойств от партии к партии, так как мы комплектуем федеральные объекты. Все сертификаты соответствия и паспорта качества предоставляются вовремя, что упрощает нам сдачу объектов технадзору».</p>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400&h=400&fit=crop"
                                alt="Игорь Данилов"
                                loading="lazy"
                                onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/images/avatar-placeholder.svg'">
                        </div>
                        <div class="testimonial-author">
                            <div class="author-name">Игорь Данилов</div>
                            <div class="author-position">Руководитель отдела закупок</div>
                            <div class="author-company">ООО «ТехноСфера-Юг»</div>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <svg class="quote-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" fill="#0056B3" opacity="0.2" />
                            <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" fill="#0056B3" opacity="0.2" />
                        </svg>
                        <p>«В производстве пластиковых профилей важна оперативность. Бывали случаи, когда нам требовалось экстренно увеличить объем отгрузки в разгар сезона — коллеги всегда шли навстречу и корректировали план производства под наши задачи. Рекомендуем как надежного партнера, на которого можно положиться в сложных ситуациях».</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BLOCK 7.5: CLIENTS (TRUST) - Redesigned with Ticker -->
<section class="section section-clients-trust">
    <div class="container">
        <div class="section-header-modern">
            <h2 class="ticker-title">Партнерство с ведущими брендами бытовой техники и строительного рынка</h2>
            <p class="ticker-subtitle">Наша репутация строится на стабильном качестве и прозрачности процессов. Мы ценим каждого заказчика и нацелены на годы совместной продуктивной работы.</p>
        </div>
    </div>

    <div class="logo-ticker-container">
        <div class="logo-ticker-track">
            <!-- First Group -->
            <div class="ticker-item" data-tooltip="Профили для стеклянных полок холодильников LG Electronics">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/LG_Electronic.webp" alt="LG Electronics">
            </div>
            <div class="ticker-item" data-tooltip="Профили для стеклянных полок холодильников Haier">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Haier_Logo.webp" alt="Haier">
            </div>
            <div class="ticker-item" data-tooltip="Профили для фасадных систем">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tatprof.webp" alt="Tatprof">
            </div>
            <div class="ticker-item" data-tooltip="Намоточные кольца">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/xk.webp" alt="XK">
            </div>
            <div class="ticker-item" data-tooltip="Профили для осветительного шинопровода">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/allnord.webp" alt="Allnord">
            </div>
            <div class="ticker-item" data-tooltip="Профили для фасадных систем">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tbm.webp" alt="TBM">
            </div>
            <div class="ticker-item" data-tooltip="Отделочные профили для строительной отрасли">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sb.webp" alt="SB">
            </div>

            <!-- Duplicated Group for Seamless Loop -->
            <div class="ticker-item" data-tooltip="Профили для стеклянных полок холодильников LG Electronics">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/LG_Electronic.webp" alt="LG Electronics">
            </div>
            <div class="ticker-item" data-tooltip="Профили для стеклянных полок холодильников Haier">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Haier_Logo.webp" alt="Haier">
            </div>
            <div class="ticker-item" data-tooltip="Профили для фасадных систем">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tatprof.webp" alt="Tatprof">
            </div>
            <div class="ticker-item" data-tooltip="Намоточные кольца">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/xk.webp" alt="XK">
            </div>
            <div class="ticker-item" data-tooltip="Профили для осветительного шинопровода">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/allnord.webp" alt="Allnord">
            </div>
            <div class="ticker-item" data-tooltip="Профили для фасадных систем">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tbm.webp" alt="TBM">
            </div>
            <div class="ticker-item" data-tooltip="Отделочные профили для строительной отрасли">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sb.webp" alt="SB">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="ticker-footer-note">
            <p>Опыт поставок для крупнейших предприятий отрасли</p>
        </div>
    </div>
</section>

<!-- BLOCK 8: CTA -->
<?php include get_template_directory() . '/template-parts/audit-form-section.php'; ?>

<script>
    // === FAQ CROSS-PROMO BANNER FUNCTIONALITY ===
    (function() {
        'use strict';

        // Закрытие баннера с сохранением в localStorage
        function closeBanner(bannerId) {
            const banner = document.getElementById(bannerId);
            if (banner) {
                banner.classList.add('hidden');
                localStorage.setItem('faq_banner_' + bannerId + '_closed', 'true');

                // Отслеживание закрытия для аналитики
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'faq_banner_closed', {
                        'event_category': 'FAQ Banner',
                        'event_label': bannerId + '_about',
                        'value': 1
                    });
                }
            }
        }

        // Обработчик закрытия баннера
        const closeButton = document.querySelector('[data-close-banner="faq-cross-promo"]');
        if (closeButton) {
            closeButton.addEventListener('click', function(e) {
                e.preventDefault();
                closeBanner('faq-cross-promo');
            });
        }

        // Проверка localStorage при загрузке страницы
        const banner = document.getElementById('faq-cross-promo');
        if (banner && localStorage.getItem('faq_banner_faq-cross-promo_closed') === 'true') {
            banner.classList.add('hidden');
        }

        // Отслеживание клика на кнопку тизера
        const promoBtn = document.querySelector('[data-faq-teaser="cross-promo-about"]');
        if (promoBtn) {
            promoBtn.addEventListener('click', function() {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'faq_teaser_click', {
                        'event_category': 'FAQ Teaser',
                        'event_label': 'cross-promo-about',
                        'value': 1
                    });
                }
                if (typeof ym !== 'undefined') {
                    ym(window.yaCounterId || 0, 'reachGoal', 'faq_teaser_click', {
                        teaser_type: 'cross-promo-about'
                    });
                }
            });
        }
    })();
</script>

<?php get_footer(); ?>
