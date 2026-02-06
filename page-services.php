<?php
/**
 * Template Name: Our Services
 *
 * High-End UI/UX Landing Page for B2B Services (Injection Molding & Extrusion)
 */

get_header();
?>

<style>
/* ============================================
   SERVICES PAGE - COMPLETE STYLES
   ============================================ */

/* Reset & Base - EXCLUDE audit-section, process-timeline-section and faq-section */
.services-page *:not(.audit-section):not(.audit-section *):not(.process-timeline-section):not(.process-timeline-section *):not(#faq):not(#faq *) {
    box-sizing: border-box;
    font-family: 'Inter', 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.services-page {
    background: #fff;
    color: #1e293b;
    line-height: 1.6;
}

.services-page h1:not(.audit-section h1):not(.process-timeline-section h1),
.services-page h2:not(.audit-section h2):not(.process-timeline-section h2):not(.expertise-title):not(.faq-main-title),
.services-page h3:not(.audit-section h3):not(.process-timeline-section h3):not(.form-card-title):not(.benefits-heading),
.services-page h4:not(.audit-section h4):not(.process-timeline-section h4) {
    font-family: 'Manrope', 'Inter', sans-serif;
    color: #1e293b;
    line-height: 1.2;
    margin: 0 0 1rem 0;
}

.services-page p:not(.audit-section p):not(.process-timeline-section p) {
    margin: 0 0 1rem 0;
}

/* Container */
.services-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    width: 100%;
}

/* ============================================
   BLOCK 1: HERO SECTION
   ============================================ */
.services-hero {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
    color: #fff;
    overflow: hidden;
    padding: 160px 24px 100px;
    margin-top: -80px;
}

.services-hero__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.services-hero__placeholder {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.3;
}

.services-hero__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,58,95,0.7) 100%);
    z-index: 2;
}

.services-hero__content {
    position: relative;
    z-index: 3;
    max-width: 800px;
    text-align: center;
}

.services-hero__title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #fff;
    margin-bottom: 1.5rem;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.services-hero__subtitle {
    font-size: 1.25rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2.5rem;
    line-height: 1.6;
}

.services-hero__cta {
    display: inline-block;
    background: #f59e0b;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    padding: 16px 40px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(245,158,11,0.4);
}

.services-hero__cta:hover {
    background: #d97706;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(245,158,11,0.5);
}

/* ============================================
   BLOCK 2: TECHNOLOGIES GRID
   ============================================ */
.services-tech {
    padding: 80px 24px;
    background: #fff;
}

.services-tech .services-container {
    max-width: 1000px;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 32px;
}

@media (max-width: 768px) {
    .services-grid {
        grid-template-columns: 1fr;
    }
}

.tech-card {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 20px;
    padding: 48px 32px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.tech-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.1);
    border-color: #f59e0b;
}

.tech-card__icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 24px;
    background: linear-gradient(135deg, #0f4c5c 0%, #1e3a5f 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.tech-card__icon svg {
    width: 40px;
    height: 40px;
    stroke: #fff;
    fill: none;
}

.tech-card__title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 16px;
}

.tech-card__text {
    font-size: 1rem;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* ============================================
   BLOCK 3: TIMELINE / PROCESS
   ============================================ */
.services-timeline-section {
    padding: 80px 24px;
    background: #f8fafc;
}

.services-section-header {
    text-align: center;
    margin-bottom: 60px;
}

.services-section-header__title {
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 800;
    color: #1e293b;
}

.services-section-header__title .highlight {
    color: #f59e0b;
}

.services-section-header__desc {
    font-size: 1.1rem;
    color: #64748b;
    margin-top: 12px;
}

.services-timeline {
    position: relative;
    max-width: 900px;
    margin: 0 auto;
}

.services-timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 100%;
    background: linear-gradient(to bottom, #0f4c5c, #f59e0b);
    border-radius: 4px;
}

@media (max-width: 768px) {
    .services-timeline::before {
        left: 30px;
    }
}

.services-timeline-item {
    position: relative;
    display: flex;
    align-items: flex-start;
    margin-bottom: 50px;
}

.services-timeline-item:last-child {
    margin-bottom: 0;
}

.services-timeline-item:nth-child(odd) {
    flex-direction: row;
}

.services-timeline-item:nth-child(even) {
    flex-direction: row-reverse;
}

@media (max-width: 768px) {
    .services-timeline-item,
    .services-timeline-item:nth-child(odd),
    .services-timeline-item:nth-child(even) {
        flex-direction: row;
        padding-left: 70px;
    }
}

.services-timeline-marker {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #0f4c5c 0%, #1e3a5f 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
    font-weight: 800;
    z-index: 2;
    box-shadow: 0 4px 15px rgba(15,76,92,0.3);
}

@media (max-width: 768px) {
    .services-timeline-marker {
        left: 30px;
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }
}

.services-timeline-content {
    width: calc(50% - 50px);
    background: #fff;
    padding: 28px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
}

@media (max-width: 768px) {
    .services-timeline-content {
        width: 100%;
    }
}

.services-timeline-content h4 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.services-timeline-content h4 svg {
    width: 24px;
    height: 24px;
    color: #0f4c5c;
    flex-shrink: 0;
}

.services-timeline-content p {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* ============================================
   BLOCK 4: TRUST BLOCK
   ============================================ */
.services-trust {
    padding: 80px 24px;
    background: #fff;
}

.services-trust-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
}

@media (max-width: 992px) {
    .services-trust-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
}

.services-trust-item {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    background: #f8fafc;
    padding: 28px;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
}

.services-trust-icon {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.services-trust-icon svg {
    width: 28px;
    height: 28px;
    stroke: #fff;
    fill: none;
}

.services-trust-content h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}

.services-trust-content p {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* ============================================
   BLOCK 5: FAQ SECTION (Modernized)
   ============================================ */
.faq-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    max-width: 800px;
    margin: 0 auto;
}

.faq-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-card-header {
    width: 100%;
    text-align: left;
    padding: 20px 24px;
    background: #fff;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.faq-card-title {
    font-weight: 700;
    color: #1e293b;
    font-size: 1.1rem;
    line-height: 1.4;
    transition: color 0.3s ease;
    padding-right: 16px;
    font-family: 'Manrope', sans-serif;
}

.faq-icon-wrapper {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.faq-arrow {
    width: 20px;
    height: 20px;
    stroke: #64748b;
    stroke-width: 2.5;
    fill: none;
    transition: stroke 0.3s ease, transform 0.3s ease;
}

/* Active State */
.faq-item[aria-expanded="true"] .faq-card-header {
    background-color: #0f4c5c;
}

.faq-item[aria-expanded="true"] .faq-card-title {
    color: #ffffff;
}

.faq-item[aria-expanded="true"] .faq-icon-wrapper {
    background-color: #f59e0b;
}

.faq-item[aria-expanded="true"] .faq-arrow {
    stroke: #ffffff;
    transform: rotate(180deg);
}

.faq-card-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease-in-out;
    background: #fff;
}

.faq-item[aria-expanded="true"] .faq-card-body {
    max-height: 1000px;
}

.faq-answer-content {
    padding: 0 24px 24px 24px;
    color: #334155;
    line-height: 1.6;
}

.faq-answer-content p {
    margin-bottom: 0.75rem;
}

.faq-answer-content p:last-child {
    margin-bottom: 0;
}

.faq-answer-content ul {
    margin: 0.75rem 0 0.5rem 1.25rem;
    padding: 0;
}

.faq-answer-content li {
    margin: 0.35rem 0;
}

.faq-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center !important;
    margin-bottom: 3rem;
    position: relative;
    width: 100%;
}

.faq-label {
    display: block;
    text-align: center !important;
    color: #f59e0b;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
}

.faq-main-title {
    display: block;
    text-align: center !important;
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
    line-height: 1.2;
    font-family: 'Manrope', sans-serif;
}

.faq-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.faq-expand-all-btn {
    margin-top: 1.5rem;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background-color: #f59e0b;
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
}

.faq-expand-all-btn:hover {
    background-color: #d97706;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
    color: #ffffff;
}

.faq-expand-all-btn svg {
    transition: transform 0.3s ease;
}

.faq-expand-all-btn.expanded svg {
    transform: rotate(180deg);
}

@media (max-width: 768px) {
    .faq-main-title {
        font-size: 2rem;
    }

    .faq-subtitle {
        font-size: 1rem;
    }
}

/* ============================================
   AUDIT SECTION - DO NOT OVERRIDE (uses audit-form.css)
   ============================================ */
/* No custom overrides - audit-form.css handles all styling */
</style>

<main class="services-page">
    <!-- Блок 1: Hero-секция -->
    <section class="services-hero">
        <div class="services-hero__bg">
            <img src="https://via.placeholder.com/1920x800/1e3a5f/1e3a5f?text=+" alt="Hero background" class="services-hero__placeholder">
            <div class="services-hero__overlay"></div>
        </div>
        <div class="services-hero__content">
            <h1 class="services-hero__title">Контрактное производство изделий из пластмасс полного цикла</h1>
            <p class="services-hero__subtitle">Литье под давлением и экструзия. От разработки чертежа и пресс-формы до серийной партии.</p>
            <a href="#contact-form" class="services-hero__cta">Рассчитать проект</a>
        </div>
    </section>

    <!-- Блок 2: Технологии -->
    <section class="services-tech">
        <div class="services-container">
            <div class="services-grid">
                <!-- Литье под давлением -->
                <div class="tech-card">
                    <div class="tech-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M12 22V7"></path>
                            <path d="M12 7V2"></path>
                            <path d="M7 7V4"></path>
                            <path d="M17 7V4"></path>
                        </svg>
                    </div>
                    <h3 class="tech-card__title">Литье под давлением</h3>
                    <p class="tech-card__text">Для сложных корпусных деталей, тар и штучных изделий тиражом от 1000 шт.</p>
                </div>

                <!-- Экструзия -->
                <div class="tech-card">
                    <div class="tech-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12h16"></path>
                            <path d="M4 6h16"></path>
                            <path d="M4 18h16"></path>
                            <path d="M20 4v16"></path>
                            <path d="M4 4v16"></path>
                        </svg>
                    </div>
                    <h3 class="tech-card__title">Экструзия</h3>
                    <p class="tech-card__text">Для профилей, труб, рассеивателей и погонажных изделий.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Блок 3: Таймлайн (Premium Timeline from Products Page) -->
    <section class="process-timeline-section" id="process-timeline">
        <div class="container">
            <div class="section-header" data-animate="fade-up">
                <h2 class="section-header__title"><span>От чертежа</span> <span class="highlight">до серии</span></h2>
                <p class="section-header__desc">Системный подход к производству полимерных изделий</p>
            </div>

            <div class="process-timeline">
                <div class="timeline-track">
                    <div class="timeline-progress-bar"></div>
                </div>

                <!-- Step 1 -->
                <div class="timeline-item">
                    <div class="timeline-content-wrapper">
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                <span class="timeline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                </span>
                                Заявка и анализ
                            </h4>
                            <p class="timeline-desc">Анализируем ваш чертеж или 3D-модель. Подбираем оптимальный материал (ПВХ, ПЭ, ПП, АБС) и рассчитываем стоимость проекта.</p>
                            <div class="timeline-meta">
                                <span>Чертеж / 3D модель</span>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-marker-wrapper">
                        <div class="timeline-marker"><span class="timeline-number">1</span></div>
                    </div>
                    <div class="timeline-content-wrapper"><!-- Empty for layout balance --></div>
                </div>

                <!-- Step 2 -->
                <div class="timeline-item">
                    <div class="timeline-content-wrapper"><!-- Empty for layout balance --></div>
                    <div class="timeline-marker-wrapper">
                        <div class="timeline-marker"><span class="timeline-number">2</span></div>
                    </div>
                    <div class="timeline-content-wrapper">
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                <span class="timeline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                    </svg>
                                </span>
                                Проектирование оснастки
                            </h4>
                            <p class="timeline-desc">Совместно с партнерами проектируем и изготавливаем пресс-форму или экструзионную оснастку (срок: 2-4 месяца).</p>
                            <div class="timeline-meta">
                                <span>Опыт и надёжность</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="timeline-item">
                    <div class="timeline-content-wrapper">
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                <span class="timeline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </span>
                                Образцы и испытания
                            </h4>
                            <p class="timeline-desc">Запускаем пилотную партию для проверки геометрии и физико-механических свойств. Вы получаете эталонный образец перед началом серийного производства.</p>
                            <div class="timeline-meta">
                                <span>Контроль качества</span>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-marker-wrapper">
                        <div class="timeline-marker"><span class="timeline-number">3</span></div>
                    </div>
                    <div class="timeline-content-wrapper"><!-- Empty for layout balance --></div>
                </div>

                <!-- Step 4 -->
                <div class="timeline-item">
                    <div class="timeline-content-wrapper"><!-- Empty for layout balance --></div>
                    <div class="timeline-marker-wrapper">
                        <div class="timeline-marker"><span class="timeline-number">4</span></div>
                    </div>
                    <div class="timeline-content-wrapper">
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                <span class="timeline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                        <rect x="1" y="3" width="22" height="5"></rect>
                                        <line x1="10" y1="12" x2="14" y2="12"></line>
                                    </svg>
                                </span>
                                Серийное производство
                            </h4>
                            <p class="timeline-desc">Запускаем полномасштабное производство с постоянным контролем качества. Упаковываем и доставляем готовую продукцию на ваш склад.</p>
                            <div class="timeline-meta">
                                <span>Объем партии по запросу</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Блок 4: Инжиниринг и Оснастка -->
    <section class="services-trust">
        <div class="services-container">
            <div class="services-trust-grid">
                <div class="services-trust-item">
                    <div class="services-trust-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div class="services-trust-content">
                        <h4>Собственность</h4>
                        <p>Оснастка на 100% принадлежит заказчику.</p>
                    </div>
                </div>
                <div class="services-trust-item">
                    <div class="services-trust-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                    </div>
                    <div class="services-trust-content">
                        <h4>Сервис</h4>
                        <p>Бесплатное хранение и обслуживание (чистка, смазка) на нашем складе.</p>
                    </div>
                </div>
                <div class="services-trust-item">
                    <div class="services-trust-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="services-trust-content">
                        <h4>Экономия</h4>
                        <p>Реверс-инжиниринг для оптимизации стоимости изделия.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Блок 5: FAQ (Modernized) -->
    <section id="faq" class="section" style="background: #f8fafc; padding: 80px 0;" itemscope itemtype="https://schema.org/FAQPage">
        <div class="services-container">
            <div class="faq-header">
                <div class="faq-label">ГОТОВЫЕ ОТВЕТЫ</div>
                <h2 class="faq-main-title">Самые Популярные Вопросы</h2>
                <p class="faq-subtitle">Здесь мы собрали вопросы, которые наши заказчики задают чаще всего.</p>
                <button class="faq-expand-all-btn" id="faq-expand-all" aria-label="Развернуть все вопросы">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="17 11 12 6 7 11"></polyline>
                        <polyline points="17 18 12 13 7 18"></polyline>
                    </svg>
                    <span>Развернуть все</span>
                </button>
            </div>

            <div class="faq-grid faq-accordion">
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">Каков минимальный объем заказа?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Мы ориентированы на серийное промышленное производство.</p>
                            <ul>
                                <li>Для литья под давлением: от 1000 единиц изделий.</li>
                                <li>Для экструзии: оптимальная партия — от 1000 до 3000 погонных метров (в зависимости от веса профиля).</li>
                            </ul>
                            <p>Для постоянных клиентов и крупных проектов мы готовы обсуждать индивидуальные условия и тестовые партии меньшего объема.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">У меня нет чертежа, только образец или идея. Вы поможете?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Да. Совместно с разработчиками оснастки мы оказываем услуги реверс-инжиниринга. Мы можем разработать 3D-модель и чертеж на основе вашего физического образца, эскиза или технического задания, адаптировав изделие под технологии экструзии или литья.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">С какими видами пластиков вы работаете?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Мы перерабатываем широкий спектр полимеров. Основные материалы: жесткий и мягкий ПВХ (PVC), полиэтилен (PE), полипропилен (PP), АБС-пластик (ABS). Если вашему проекту требуется специфический компаунд, наши технологи помогут подобрать сырье с нужными характеристиками (морозостойкость, УФ-стабильность, ударопрочность).</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">Как быстро вы можете изготовить профиль или деталь?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <ul>
                                <li>Если есть готовая оснастка: запуск производства занимает от нескольких дней до 2 недель (в зависимости от загрузки линий).</li>
                                <li>Если нужна оснастка «с нуля»: процесс занимает от 2 до 4 месяцев (включая проектирование, производство пресс-формы/фильеры и пуско-наладку).</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">Какие виды финишной обработки доступны?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Мы предлагаем нарезку в размер, сверление отверстий, фрезеровку пазов, нанесение двухстороннего скотча и маркировку. По запросу возможно изготовление профилей с заданным цветом по шкале RAL.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">Кому принадлежит пресс-форма или фильера после изготовления?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Если вы оплачиваете изготовление оснастки, она является вашей 100% собственностью. Мы берем её на ответственное хранение и проводим бесплатное техническое обслуживание (чистку, смазку, консервацию) на протяжении всего срока сотрудничества. Вы в любой момент можете забрать оснастку.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">Предоставляете ли вы образцы продукции?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Да. При запуске нового изделия мы обязательно предоставляем опытные образцы (отливки или метры профиля) для утверждения геометрии и качества перед запуском серии. Образцы стандартной продукции могут быть предоставлены по запросу.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">Как осуществляется контроль качества?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>На производстве внедрена многоступенчатая система контроля. Мы проверяем входное сырье, контролируем геометрию первых изделий при запуске линии и проводим выборочную проверку партии в процессе производства. При необходимости предоставляем паспорт качества на партию.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header" type="button">
                        <span class="faq-card-title" itemprop="name">Есть ли у вас доставка?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Наше производство находится в Московской области. Мы отгружаем продукцию по всей России и странам СНГ через транспортные компании (Деловые Линии, ПЭК и др.) или отдельными машинами. Возможен самовывоз со склада готовой продукции.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <?php include get_template_directory() . '/template-parts/audit-form-section.php'; ?>
</main>

<script>
    // 3. Кнопка "Развернуть все" для FAQ
    const expandAllBtn = document.getElementById('faq-expand-all');
    if (expandAllBtn) {
        let allExpanded = false;

        expandAllBtn.addEventListener('click', function() {
            const faqItems = document.querySelectorAll('.faq-item');
            allExpanded = !allExpanded;

            faqItems.forEach(item => {
                item.setAttribute('aria-expanded', allExpanded ? 'true' : 'false');
            });

            // Обновляем текст кнопки
            const btnText = this.querySelector('span');
            if (btnText) {
                btnText.textContent = allExpanded ? 'Свернуть все' : 'Развернуть все';
            }

            // Добавляем класс для анимации иконки
            this.classList.toggle('expanded', allExpanded);
        });
    }

    // 4. Отслеживание раскрытия отдельных вопросов FAQ
    function toggleFAQItem(faqItem) {
        if (!faqItem) return;
        const isExpanded = faqItem.getAttribute('aria-expanded') === 'true';
        faqItem.setAttribute('aria-expanded', !isExpanded ? 'true' : 'false');
    }

    const faqQuestions = document.querySelectorAll('.faq-question, .faq-card-header');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const faqItem = this.closest('.faq-item');
            toggleFAQItem(faqItem);
        });
    });

    const faqIconWrappers = document.querySelectorAll('.faq-icon-wrapper');
    faqIconWrappers.forEach(iconWrapper => {
        iconWrapper.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const faqItem = this.closest('.faq-item');
            toggleFAQItem(faqItem);
        });
    });

    // Smooth scroll for CTA
    const ctaBtn = document.querySelector('.services-hero__cta');
    if (ctaBtn) {
        ctaBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }
</script>

<?php get_footer(); ?>
