<?php

/**
 * Template Name: Our Services
 *
 * High-End UI/UX Landing Page for B2B Services (Injection Molding & Extrusion)
 */

get_header();
?>

<script>
    document.documentElement.classList.add('js-hero-anim');
</script>

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
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #0f172a;
        color: #fff;
        overflow: hidden;
        padding: 160px 24px 130px;
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
        opacity: 0.75;
        transform: scale(1.01) translate3d(0, 0, 0);
        transform-origin: center center;
        will-change: transform;
    }

    .services-hero__overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 25, 50, 0.26) 0%, rgba(0, 25, 50, 0.34) 100%);
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
        color: #ffffff !important;
        margin-bottom: 1.5rem;
        line-height: 1.15;
        letter-spacing: -0.02em;
        text-transform: none;
        font-family: 'Manrope', sans-serif;
        text-shadow: 0 6px 18px rgba(0, 0, 0, 0.5);
        text-wrap: balance;
        overflow-wrap: anywhere;
    }

    .services-hero__title .text-accent {
        color: #F39C12;
    }

    .services-hero__subtitle {
        font-size: 1.25rem;
        color: #ffffff !important;
        margin-bottom: 2.5rem;
        line-height: 1.6;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.45);
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
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        position: relative;
        overflow: hidden;
        isolation: isolate;
    }

    .services-hero__cta::before {
        content: '';
        position: absolute;
        top: -240%;
        left: -230%;
        width: 92%;
        height: 650%;
        border-radius: 14px;
        pointer-events: none;
        background: linear-gradient(110deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 40%,
                rgba(255, 255, 255, 1) 50%,
                rgba(255, 255, 255, 0.4) 60%,
                rgba(255, 255, 255, 0) 100%);
        transform: translate3d(-300%, 0, 0) rotate(18deg);
        mix-blend-mode: screen;
    }

    .services-hero__cta:hover {
        background: #d97706;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.5);
    }

    .services-hero .scroll-down-wrapper {
        bottom: clamp(64px, 8vw, 96px);
    }

    .services-hero .mouse-icon,
    .services-hero .wheel {
        animation: none !important;
    }

    html:not(.js-hero-anim) .services-hero__placeholder {
        animation: servicesHeroBackgroundZoom 18s cubic-bezier(0.45, 0, 0.55, 1) infinite alternate;
    }

    html:not(.js-hero-anim) .services-hero__cta::before {
        animation: servicesHeroSheen 4.8s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }

    html:not(.js-hero-anim) .services-hero .mouse-icon,
    html:not(.js-hero-anim) .services-hero .wheel {
        animation: none !important;
    }

    .js-hero-anim .services-hero.is-prepared:not(.is-loaded) .services-hero__title {
        opacity: 0;
        transform: translate3d(0, 74px, 0) scale(0.95);
        filter: blur(10px);
    }

    .js-hero-anim .services-hero.is-prepared:not(.is-loaded) .services-hero__subtitle {
        opacity: 0;
        transform: translate3d(0, 58px, 0);
        filter: blur(7px);
    }

    .js-hero-anim .services-hero.is-prepared:not(.is-loaded) .services-hero__cta {
        opacity: 0;
        transform: translate3d(0, 48px, 0);
        filter: blur(6px);
    }

    .js-hero-anim .services-hero.is-prepared:not(.is-loaded) .scroll-down-wrapper {
        opacity: 0;
        transform: translate3d(-50%, 34px, 0);
    }

    .js-hero-anim .services-hero.is-loaded .services-hero__placeholder {
        animation: servicesHeroBackgroundZoom 18s cubic-bezier(0.45, 0, 0.55, 1) infinite alternate;
    }

    .js-hero-anim .services-hero.is-loaded .services-hero__title {
        animation: servicesHeroFadeUpTitle 1.75s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        animation-delay: 0s;
        will-change: transform, opacity, filter;
    }

    .js-hero-anim .services-hero.is-loaded .services-hero__subtitle {
        animation: servicesHeroFadeUp 1.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        animation-delay: 0.35s;
        will-change: transform, opacity, filter;
    }

    .js-hero-anim .services-hero.is-loaded .services-hero__cta {
        animation: servicesHeroFadeUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        animation-delay: 0.62s;
        will-change: transform, opacity, filter;
    }

    .js-hero-anim .services-hero.is-loaded .services-hero__cta::before {
        animation: servicesHeroSheen 4.8s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }

    .js-hero-anim .services-hero.is-loaded .scroll-down-wrapper {
        animation: servicesHeroScrollReveal 1.15s cubic-bezier(0.16, 1, 0.3, 1) 1.05s forwards;
        will-change: transform, opacity;
    }

    .js-hero-anim .services-hero.is-loaded .mouse-icon,
    .js-hero-anim .services-hero.is-loaded .wheel {
        animation: none !important;
    }

    @keyframes servicesHeroFadeUpTitle {
        0% {
            opacity: 0;
            transform: translate3d(0, 74px, 0) scale(0.95);
            filter: blur(10px);
        }

        68% {
            opacity: 1;
            transform: translate3d(0, -6px, 0) scale(1.01);
            filter: blur(0.8px);
        }

        100% {
            opacity: 1;
            transform: translate3d(0, 0, 0) scale(1);
            filter: blur(0);
        }
    }

    @keyframes servicesHeroFadeUp {
        from {
            opacity: 0;
            transform: translate3d(0, 58px, 0);
            filter: blur(7px);
        }

        65% {
            opacity: 1;
            transform: translate3d(0, -4px, 0);
            filter: blur(0.6px);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
            filter: blur(0);
        }
    }

    @keyframes servicesHeroScrollReveal {
        from {
            opacity: 0;
            transform: translate3d(-50%, 34px, 0);
        }

        to {
            opacity: 1;
            transform: translate3d(-50%, 0, 0);
        }
    }

    @keyframes servicesHeroBackgroundZoom {
        from {
            transform: scale(1.01) translate3d(0, 0, 0);
        }

        to {
            transform: scale(1.1) translate3d(-1.8%, -1.1%, 0);
        }
    }

    @keyframes servicesHeroSheen {

        0%,
        74% {
            opacity: 0;
            transform: translate3d(-300%, 0, 0) rotate(18deg);
        }

        79% {
            opacity: 1;
        }

        95%,
        100% {
            opacity: 0;
            transform: translate3d(500%, 0, 0) rotate(18deg);
        }
    }

    @keyframes servicesHeroMouseBounce {

        0%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-5px);
        }

        70% {
            transform: translateY(7px);
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .services-hero__placeholder,
        .services-hero__title,
        .services-hero__subtitle,
        .services-hero__cta,
        .services-hero__cta::before,
        .services-hero .scroll-down-wrapper,
        .services-hero .mouse-icon {
            animation: none !important;
        }

        .services-hero__title,
        .services-hero__subtitle,
        .services-hero__cta {
            opacity: 1;
            transform: translate3d(0, 0, 0);
            filter: blur(0);
        }

        .js-hero-anim .services-hero.is-prepared:not(.is-loaded) .services-hero__title,
        .js-hero-anim .services-hero.is-prepared:not(.is-loaded) .services-hero__subtitle,
        .js-hero-anim .services-hero.is-prepared:not(.is-loaded) .services-hero__cta {
            opacity: 1;
            transform: translate3d(0, 0, 0);
            filter: blur(0);
        }

        .js-hero-anim .services-hero.is-prepared:not(.is-loaded) .scroll-down-wrapper {
            opacity: 1;
            transform: translate3d(-50%, 0, 0);
        }

        .services-hero .scroll-down-wrapper {
            opacity: 1;
            transform: translate3d(-50%, 0, 0);
        }
    }

    /* ============================================
   OVERLAP INFO BLOCK
   ============================================ */
    .services-overlap {
        position: relative;
        padding: 0 24px 90px;
        --overlap-offset: 48px;
    }

    .services-overlap::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: var(--overlap-offset);
        bottom: 0;
        background: #E9EDF3;
        z-index: 0;
    }

    .services-overlap .services-container {
        position: relative;
        z-index: 1;
    }

    .services-overlap__card {
        background: linear-gradient(155deg, #ffffff 0%, #f9fcff 58%, #f2f7ff 100%);
        padding: 54px 58px 46px;
        margin-top: calc(var(--overlap-offset) * -1);
        position: relative;
        z-index: 10;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(148, 163, 184, 0.2);
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.8s ease, transform 0.8s ease;
        will-change: opacity, transform;
        overflow: hidden;
    }

    .services-overlap__card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #0066cc 0%, #2d83ff 58%, #ff6b35 100%);
        z-index: 0;
        pointer-events: none;
    }

    .services-overlap__card::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        top: -140px;
        right: -110px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0, 102, 204, 0.14) 0%, rgba(0, 102, 204, 0) 72%);
        z-index: 0;
        pointer-events: none;
    }

    .services-overlap__card.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .services-overlap__grid {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        gap: 30px;
        align-items: stretch;
    }

    .services-overlap__title h2 {
        font-family: 'Manrope', sans-serif;
        font-size: clamp(1.6rem, 3.2vw, 2.75rem);
        font-weight: 900;
        color: #0f172a;
        line-height: 0.98;
        letter-spacing: -0.03em;
        text-transform: none;
        margin: 0;
        max-width: 920px;
        text-align: center;
    }

    .services-overlap__title h2 .highlight {
        color: #f59e0b;
    }

    .services-overlap__title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 28px;
        padding-bottom: 28px;
    }

    .services-overlap__badge-image {
        width: 148px;
        height: 148px;
        display: block;
        object-fit: contain;
        flex-shrink: 0;
        filter: drop-shadow(0 14px 22px rgba(15, 23, 42, 0.22));
    }

    .services-overlap__content {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        align-items: stretch;
    }

    .services-overlap__feature {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin: 0;
        padding: 22px 20px;
        border: 1px solid #dbe5f2;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.76);
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    }

    .services-overlap__feature-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        color: #0066CC;
        background: linear-gradient(180deg, #ebf4ff 0%, #dcebff 100%);
        border: 1px solid rgba(0, 102, 204, 0.2);
        border-radius: 14px;
        padding: 10px;
        opacity: 0;
        transform: translateY(8px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .services-overlap__feature:nth-of-type(2) .services-overlap__feature-icon {
        color: #FF6B35;
        background: linear-gradient(180deg, #fff3eb 0%, #ffe7dc 100%);
        border-color: rgba(255, 107, 53, 0.28);
        transition-delay: 120ms;
    }

    .services-overlap__feature-icon svg {
        width: 100%;
        height: 100%;
        display: block;
    }

    .services-overlap__card.is-visible .services-overlap__feature-icon {
        opacity: 1;
        transform: translateY(0);
    }

    .services-overlap__feature p {
        font-size: 1rem;
        line-height: 1.66;
        color: #334155;
        margin: 0;
    }

    .services-overlap__feature-subtitle {
        display: block;
        margin-bottom: 8px;
        font-size: 1.12em;
        line-height: 1.35;
        font-weight: 800;
        color: #0f172a;
    }

    .services-overlap__tags {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-top: 6px;
        padding-top: 20px;
        border-top: 1px solid rgba(148, 163, 184, 0.36);
        grid-column: 1 / -1;
    }

    .services-overlap__tag {
        background: linear-gradient(180deg, #ffffff 0%, #f1f5f9 100%);
        color: #243447;
        border-radius: 999px;
        padding: 8px 14px;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        border: 1px solid #d3dde9;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.88);
    }

    @media (max-width: 1024px) {
        .services-overlap {
            --overlap-offset: 56px;
        }

        .services-overlap__card {
            padding: 44px 36px 34px;
        }

        .services-overlap__title {
            gap: 22px;
            padding-bottom: 22px;
        }

        .services-overlap__title h2 {
            font-size: clamp(1.5rem, 3.8vw, 2.2rem);
            line-height: 1.02;
            letter-spacing: -0.03em;
        }

        .services-overlap__badge-image {
            width: 124px;
            height: 124px;
        }

        .services-overlap__content {
            grid-template-columns: 1fr;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .services-overlap__card {
            opacity: 1;
            transform: none;
            transition: none;
        }

        .services-overlap__feature-icon {
            opacity: 1;
            transform: none;
            transition: none;
        }
    }

    @media (max-width: 768px) {
        .services-overlap {
            padding: 0 16px 64px;
            --overlap-offset: 40px;
        }

        .services-overlap__card {
            padding: 30px 20px 24px;
            border-radius: 18px;
        }

        .services-overlap__grid {
            gap: 20px;
        }

        .services-overlap__title {
            align-items: flex-start;
            gap: 14px;
            padding-bottom: 18px;
        }

        .services-overlap__title h2 {
            font-size: 1.25rem;
            line-height: 1.24;
            letter-spacing: -0.03em;
        }

        .services-overlap__badge-image {
            width: 88px;
            height: 88px;
        }

        .services-overlap__feature {
            padding: 16px 14px;
            border-radius: 14px;
        }

        .services-overlap__feature-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            padding: 8px;
            border-radius: 12px;
        }

        .services-overlap__feature p {
            font-size: 0.95rem;
            line-height: 1.58;
        }

        .services-overlap__tags {
            gap: 8px;
            margin-top: 2px;
            padding-top: 14px;
        }

        .services-overlap__tag {
            padding: 6px 10px;
            font-size: 0.76rem;
        }
    }

    /* ============================================
   BLOCK 2: HOW IT WORKS SLIDER
   ============================================ */
    .services-steps {
        --steps-image-fit: contain;
        --steps-image-bleed: 0px;
        padding: 90px 24px;
        background:
            radial-gradient(900px 320px at 90% 0%, rgba(245, 158, 11, 0.16) 0%, rgba(245, 158, 11, 0.02) 55%, transparent 65%),
            linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .services-steps,
    .services-steps *,
    .services-steps *::before,
    .services-steps *::after {
        box-sizing: border-box;
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

    .steps-slider {
        background: #ffffff;
        border-radius: 24px;
        padding: 32px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        width: 100%;
    }

    .steps-slides {
        position: relative;
        width: 100%;
    }

    .steps-slide {
        display: none;
        gap: 48px;
        align-items: center;
        width: 100%;
        max-width: 100%;
    }

    .steps-slide.is-active {
        display: grid;
        grid-template-columns: minmax(0, 40%) minmax(0, 60%);
        animation: stepsFade 0.45s ease;
    }

    @keyframes stepsFade {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .steps-text {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .steps-number {
        font-size: clamp(2.8rem, 6vw, 4.5rem);
        font-weight: 800;
        color: rgba(245, 158, 11, 0.25);
        letter-spacing: -0.04em;
    }

    .steps-title {
        font-size: clamp(1.4rem, 2.6vw, 2rem);
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    .steps-desc {
        font-size: 1rem;
        line-height: 1.8;
        color: #475569;
        margin: 0;
    }

    .steps-visual {
        background: #ffffff;
        border-radius: 20px;
        padding: 0;
        min-height: 0;
        width: 100%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #e2e8f0;
    }

    .steps-visual img {
        width: 100%;
        max-width: 100%;
        height: auto;
        margin: 0 auto;
        object-fit: contain;
        object-position: center;
        background-color: transparent;
        display: block;
    }

    .steps-nav {
        margin-top: 28px;
        display: flex;
        flex-wrap: nowrap;
        gap: 12px;
        justify-content: center;
    }

    .steps-nav-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 18px;
        min-width: 84px;
        background: #e2e8f0;
        color: #475569;
        border: none;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        cursor: pointer;
        transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        clip-path: polygon(0 0, calc(100% - 18px) 0, 100% 50%, calc(100% - 18px) 100%, 0 100%);
    }

    .steps-nav-btn:focus-visible {
        outline: 2px solid rgba(245, 158, 11, 0.6);
        outline-offset: 2px;
    }

    .steps-nav-btn:hover {
        transform: translateY(-2px);
    }

    .steps-nav-btn.is-complete {
        background: #fde68a;
        color: #92400e;
    }

    .steps-nav-btn.is-active {
        background: #f59e0b;
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.35);
    }

    .steps-nav-icon svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
    }

    .steps-cta {
        margin-top: 32px;
        text-align: center;
    }

    .steps-cta-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 36px;
        background: #f59e0b;
        color: #ffffff;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 700;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        box-shadow: 0 8px 22px rgba(245, 158, 11, 0.3);
    }

    .steps-cta-btn:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(245, 158, 11, 0.4);
    }

    @media (max-width: 991px) {
        .steps-slider {
            padding: 32px;
        }

        .steps-slide.is-active {
            grid-template-columns: 1fr;
        }

        .steps-visual {
            order: -1;
            min-height: 0;
        }
    }

    @media (max-width: 767px) {
        .services-steps {
            padding: 56px 16px;
            overflow-x: hidden;
        }

        .services-steps .services-container {
            padding-left: 0;
            padding-right: 0;
        }

        .steps-slider {
            padding: 20px;
            width: 100%;
        }

        .steps-slides,
        .steps-slide,
        .steps-slide.is-active {
            width: 100%;
            max-width: 100%;
        }

        .steps-visual {
            margin: 0;
            padding: 10px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
        }

        .steps-visual img {
            width: 100%;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
        }

        .steps-nav {
            gap: 6px;
        }

        .steps-nav-btn {
            min-width: 36px;
            min-height: 36px;
            padding: 0;
            border-radius: 999px;
            background: transparent;
            box-shadow: none;
            clip-path: none;
        }

        .steps-nav-btn::after {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: #cbd5e1;
            display: block;
        }

        .steps-nav-btn.is-complete::after {
            background: #fde68a;
        }

        .steps-nav-btn.is-active::after {
            background: #f59e0b;
        }

        .steps-nav-btn span {
            display: none;
        }
    }

    @media (max-width: 390px) {
        .services-steps {
            padding: 48px 12px;
        }

        .steps-slider {
            padding: 16px 16px 20px;
            border-radius: 16px;
        }

        .steps-slide {
            gap: 20px;
        }

        .steps-title {
            font-size: 1.25rem;
            line-height: 1.3;
        }

        .steps-desc {
            font-size: 0.95rem;
            line-height: 1.65;
        }

        .steps-cta-btn {
            width: 100%;
            padding: 12px 14px;
        }
    }

    @media (max-width: 360px) {
        .steps-number {
            font-size: 2.4rem;
        }

        .steps-nav {
            gap: 4px;
        }

        .steps-nav-btn {
            min-width: 32px;
            min-height: 32px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .steps-slide.is-active {
            animation: none;
        }

        .steps-nav-btn,
        .steps-cta-btn {
            transition: none;
        }
    }

    /* ============================================
   BLOCK 2.5: TECHNOLOGICAL CAPABILITIES
   ============================================ */
    .services-tech-capabilities {
        padding: 90px 24px;
        background: #ffffff;
    }

    .tech-capabilities-grid {
        display: flex;
        flex-direction: column;
        gap: 56px;
    }

    .tech-capability {
        display: grid;
        grid-template-columns: minmax(0, 46%) minmax(0, 54%);
        gap: 48px;
        align-items: center;
    }

    .tech-capability--reverse {
        grid-template-columns: minmax(0, 54%) minmax(0, 46%);
    }

    .tech-capability--reverse .tech-capability__text {
        order: 2;
    }

    .tech-capability--reverse .tech-capability__visual {
        order: 1;
    }

    .tech-capability__visual {
        background: #f8fafc;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tech-capability__visual img {
        width: 100%;
        height: auto;
        max-height: 420px;
        object-fit: contain;
        display: block;
    }

    .tech-capability__visual--stack {
        align-items: flex-start;
    }

    .tech-visual-stack {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .tech-visual-logo {
        width: 100%;
        max-width: none;
        height: auto;
        margin-bottom: 20px;
        object-fit: contain;
    }

    .tech-visual-logo--compact {
        width: 60%;
        max-width: 200px;
    }

    .tech-visual-photo {
        width: 100%;
        height: auto;
        border-radius: 20px;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
    }

    .tech-visual-photo-wrap {
        position: relative;
        width: 100%;
    }

    .tech-visual-disclaimer {
        position: absolute;
        right: 10px;
        bottom: 8px;
        margin: 0;
        padding: 2px 6px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.45);
        font-family: 'Montserrat', sans-serif;
        font-size: 10.5px;
        font-weight: 300;
        line-height: 1.25;
        color: #666;
        opacity: 0.7;
        transition: opacity 0.2s ease, color 0.2s ease;
        pointer-events: none;
    }

    .tech-visual-photo-wrap:hover .tech-visual-disclaimer {
        opacity: 0.92;
        color: #555;
    }

    .tech-capability__title {
        font-size: clamp(1.4rem, 2.6vw, 2rem);
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 16px;
    }

    .tech-capability__desc {
        font-size: 1rem;
        line-height: 1.8;
        color: #475569;
        margin: 0 0 20px;
    }

    .tech-capability__benefits {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .tech-capability__benefits li {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        font-size: 0.98rem;
        line-height: 1.6;
        color: #334155;
    }

    .tech-check-icon {
        width: 22px;
        height: 22px;
        flex-shrink: 0;
        margin-top: 2px;
        stroke: #f59e0b;
    }

    .tech-service-card {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.04), rgba(245, 158, 11, 0.08));
        border-radius: 24px;
        padding: 40px 48px;
        border: 1px solid rgba(245, 158, 11, 0.2);
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 36px;
        align-items: center;
    }

    .tech-service-card__title {
        font-size: clamp(1.4rem, 2.4vw, 1.9rem);
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 12px;
    }

    .tech-service-card__desc {
        font-size: 1rem;
        line-height: 1.8;
        color: #475569;
        margin: 0;
    }

    .tech-service-card__benefits {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .tech-service-card__benefits li {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        font-size: 0.98rem;
        line-height: 1.6;
        color: #334155;
    }

    .tech-capabilities-cta {
        margin-top: 36px;
        text-align: center;
    }

    .tech-capabilities-cta a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 36px;
        background: #f59e0b;
        color: #ffffff;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 700;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        box-shadow: 0 10px 24px rgba(15, 76, 92, 0.25);
    }

    .tech-capabilities-cta a:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(245, 158, 11, 0.35);
    }

    @media (max-width: 991px) {

        .tech-capability,
        .tech-capability--reverse {
            grid-template-columns: 1fr;
        }

        .tech-capability--reverse .tech-capability__text,
        .tech-capability--reverse .tech-capability__visual {
            order: initial;
        }

        .tech-service-card {
            grid-template-columns: 1fr;
            padding: 32px;
        }
    }

    @media (max-width: 767px) {
        .services-tech-capabilities {
            padding: 70px 16px;
        }

        .tech-capabilities-grid {
            gap: 40px;
        }

        .tech-capability__visual {
            padding: 18px;
        }

        .tech-visual-disclaimer {
            right: 8px;
            bottom: 7px;
            font-size: 10px;
        }

        .tech-service-card {
            padding: 28px 24px;
        }
    }

    /* ============================================
   BLOCK 2.6: PRODUCT PORTFOLIO (BENTO GRID)
   ============================================ */
    .services-portfolio {
        padding: 90px 24px;
        background: radial-gradient(1200px 500px at 20% -5%, rgba(245, 158, 11, 0.08), rgba(245, 158, 11, 0) 60%), #ffffff;
    }

    .services-portfolio-header {
        text-align: center;
        margin-bottom: 42px;
        max-width: 920px;
        margin-left: auto;
        margin-right: auto;
    }

    .services-portfolio-title {
        margin: 0;
        font-size: clamp(1.8rem, 4vw, 2.7rem);
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.02em;
    }

    .services-portfolio-subtitle {
        margin: 12px auto 0;
        max-width: 920px;
        color: #64748b;
        font-size: 1.02rem;
        line-height: 1.75;
        text-align: center;
        text-wrap: balance;
    }

    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        grid-template-rows: repeat(4, minmax(300px, auto));
        gap: 18px;
    }

    .portfolio-card {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        isolation: isolate;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .portfolio-card::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.05) 35%, rgba(15, 23, 42, 0.55) 100%);
        pointer-events: none;
        z-index: 1;
    }

    .portfolio-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: 50% 20%;
        display: block;
        transition: transform 0.55s ease;
    }

    .portfolio-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 30px 56px rgba(15, 23, 42, 0.28);
    }

    .portfolio-card:hover img {
        transform: scale(1.05);
    }

    .portfolio-card__info {
        position: absolute;
        left: 14px;
        right: 14px;
        bottom: 14px;
        z-index: 2;
        border-radius: 16px;
        background: rgba(15, 23, 42, 0.38);
        border: 1px solid rgba(255, 255, 255, 0.24);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 10px 12px;
        transition: background 0.35s ease, border-color 0.35s ease;
    }

    .portfolio-card:hover .portfolio-card__info {
        background: rgba(15, 23, 42, 0.58);
        border-color: rgba(255, 255, 255, 0.36);
    }

    .portfolio-card__tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        margin-bottom: 6px;
        border-radius: 999px;
        background: rgba(245, 158, 11, 0.86);
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .portfolio-card__title {
        margin: 0;
        color: #ffffff !important;
        font-size: clamp(1rem, 1.2vw, 1.2rem);
        font-weight: 700;
        line-height: 1.3;
    }

    .portfolio-card__material {
        margin-top: 4px;
        color: rgba(255, 255, 255, 0.86);
        font-size: 0.82rem;
        line-height: 1.3;
    }

    .portfolio-card--large {
        grid-column: span 2;
        grid-row: span 2;
    }

    .portfolio-card--medium {
        grid-column: span 2;
        grid-row: span 1;
    }

    .portfolio-card--small {
        grid-column: span 1;
        grid-row: span 1;
    }

    .portfolio-card--1 {
        grid-column: 1 / span 2;
        grid-row: 1 / span 2;
    }

    .portfolio-card--2 {
        grid-column: 3 / span 2;
        grid-row: 1 / span 1;
    }

    .portfolio-card--3 {
        grid-column: 3 / span 1;
        grid-row: 2 / span 1;
    }

    .portfolio-card--4 {
        grid-column: 4 / span 1;
        grid-row: 2 / span 1;
    }

    .portfolio-card--5 {
        grid-column: 1 / span 2;
        grid-row: 3 / span 2;
    }

    .portfolio-card--6 {
        grid-column: 3 / span 2;
        grid-row: 3 / span 2;
    }

    .prod-card {
        cursor: zoom-in;
        will-change: opacity;
    }

    .prod-card:focus-visible {
        outline: 3px solid rgba(245, 158, 11, 0.85);
        outline-offset: 2px;
    }

    body.lightbox-open {
        overflow: hidden;
    }

    .lightbox {
        position: fixed;
        inset: 0;
        z-index: 2200;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        opacity: 0;
        pointer-events: none;
        background: rgba(15, 23, 42, 0);
        backdrop-filter: blur(0);
        -webkit-backdrop-filter: blur(0);
        transition: opacity 0.3s ease, backdrop-filter 0.3s ease, background-color 0.3s ease;
        will-change: opacity, backdrop-filter;
    }

    .lightbox.active {
        opacity: 1;
        pointer-events: all;
        background: rgba(15, 23, 42, 0.58);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .lightbox__image {
        max-width: 90vw;
        max-height: 90vh;
        width: auto;
        height: auto;
        object-fit: contain;
        transform: translate3d(0, 0, 0) scale(1);
        border-radius: 18px;
        box-shadow: 0 24px 56px rgba(2, 6, 23, 0.5);
        opacity: 0;
        transition: opacity 0.22s ease, transform 0.22s ease;
        will-change: transform, opacity;
        cursor: zoom-in;
    }

    .lightbox__image.is-visible {
        opacity: 1;
    }

    .lightbox.is-zoomed .lightbox__image {
        cursor: grab;
        touch-action: none;
    }

    .lightbox.is-zoomed.is-dragging .lightbox__image {
        cursor: grabbing;
    }

    .lightbox__close {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 46px;
        height: 46px;
        border: none;
        border-radius: 999px;
        cursor: pointer;
        background: rgba(15, 23, 42, 0.72);
        color: #ffffff;
        font-size: 28px;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .lightbox__close:hover {
        background: rgba(245, 158, 11, 0.96);
        transform: scale(1.05);
    }

    .lightbox-ghost {
        position: fixed;
        z-index: 2147483647;
        margin: 0;
        object-fit: cover;
        pointer-events: none;
        box-shadow: 0 20px 45px rgba(2, 6, 23, 0.42);
        transition: all 0.4s cubic-bezier(0.22, 0.8, 0.2, 1);
        will-change: transform, opacity, left, top, width, height;
    }

    @media (max-width: 767px) {
        .services-portfolio {
            padding: 70px 16px;
        }

        .portfolio-grid {
            grid-template-columns: 1fr;
            grid-template-rows: none;
            gap: 14px;
        }

        .portfolio-card,
        .portfolio-card--large,
        .portfolio-card--medium,
        .portfolio-card--small,
        .portfolio-card--1,
        .portfolio-card--2,
        .portfolio-card--3,
        .portfolio-card--4,
        .portfolio-card--5,
        .portfolio-card--6 {
            grid-column: auto;
            grid-row: auto;
            min-height: 280px;
        }
    }

    /* ============================================
   BLOCK 3: TIMELINE / PROCESS
   ============================================ */
    .services-timeline-section {
        padding: 80px 24px;
        background: #f8fafc;
    }

    .process-timeline-section .timeline-content {
        background: linear-gradient(135deg, rgba(30, 40, 60, 0.55) 0%, rgba(30, 40, 60, 0.18) 100%);
        border: 1px solid rgba(255, 255, 255, 0.12);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .process-timeline-section .timeline-item:hover .timeline-content {
        background: linear-gradient(135deg, rgba(30, 40, 60, 0.65) 0%, rgba(30, 40, 60, 0.25) 100%);
        border-color: rgba(249, 115, 22, 0.25);
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
        box-shadow: 0 4px 15px rgba(15, 76, 92, 0.3);
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
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
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
        padding: 88px 24px 96px;
        background: #f9fafb;
    }

    .services-trust-header {
        text-align: center;
        max-width: 860px;
        margin: 0 auto 42px;
    }

    .services-trust-title {
        margin: 0;
        font-size: clamp(1.85rem, 3.8vw, 2.7rem);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.02em;
        color: #0f172a;
    }

    .services-trust-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
    }

    .services-trust-item {
        background: #ffffff;
        padding: 40px;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .services-trust-item:hover {
        transform: translateY(-5px);
        border-color: rgba(0, 102, 204, 0.28);
        box-shadow: 0 22px 40px rgba(15, 23, 42, 0.16);
    }

    .services-trust-icon {
        width: 64px;
        height: 64px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        color: #0b3f85;
        background: linear-gradient(145deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid rgba(11, 63, 133, 0.16);
        transition: transform 0.28s ease, background 0.28s ease;
    }

    .services-trust-item:hover .services-trust-icon {
        transform: translateY(-2px) scale(1.03);
        background: linear-gradient(145deg, #e7f1ff 0%, #d2e6ff 100%);
    }

    .services-trust-icon svg {
        width: 34px;
        height: 34px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.9;
    }

    .services-trust-card-title {
        margin: 0 0 12px;
        font-size: 1.28rem;
        font-weight: 800;
        line-height: 1.25;
        color: #1e293b;
    }

    .services-trust-card-text {
        margin: 0;
        font-size: 0.98rem;
        line-height: 1.72;
        color: #475569;
    }

    .services-trust-cta-wrap {
        text-align: center;
        margin-top: 38px;
    }

    .services-trust-cta-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 250px;
        padding: 16px 36px;
        border-radius: 50px;
        background: #f97316;
        color: #ffffff;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 800;
        letter-spacing: 0.01em;
        box-shadow: 0 14px 30px rgba(249, 115, 22, 0.3);
        transition: transform 0.28s ease, box-shadow 0.28s ease, background 0.28s ease;
    }

    .services-trust-cta-btn:hover {
        background: linear-gradient(135deg, #ff8d1a 0%, #f97316 58%, #ea580c 100%);
        transform: translateY(-3px);
        box-shadow: 0 20px 36px rgba(249, 115, 22, 0.4), 0 0 0 6px rgba(249, 115, 22, 0.14);
        color: #ffffff;
    }

    @media (max-width: 1024px) {
        .services-trust {
            padding: 76px 24px 82px;
        }

        .services-trust-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .services-trust-item {
            padding: 32px;
        }
    }

    @media (max-width: 767px) {
        .services-trust {
            padding: 64px 16px 70px;
        }

        .services-trust-header {
            margin-bottom: 26px;
        }

        .services-trust-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .services-trust-item {
            padding: 24px;
        }

        .services-trust-icon {
            width: 58px;
            height: 58px;
            margin-bottom: 14px;
        }

        .services-trust-icon svg {
            width: 30px;
            height: 30px;
        }
    }

    /* ============================================
   BLOCK 5: FAQ SECTION (Modernized)
   ============================================ */
    #faq {
        scroll-margin-top: 120px;
    }

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
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border-left: 4px solid #124E5B;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #124E5B;
    }

    .faq-card-header {
        width: 100%;
        text-align: left;
        padding: 22px 24px;
        background: #f8fafc;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .faq-card-title {
        font-weight: 700;
        color: #111827;
        font-size: 1.125rem;
        line-height: 1.4;
        transition: color 0.3s ease;
        padding-right: 16px;
        font-family: 'Manrope', sans-serif;
        letter-spacing: -0.01em;
    }

    .faq-icon-wrapper {
        width: auto;
        height: auto;
        border-radius: 0;
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: none;
        cursor: pointer;
    }

    .faq-arrow {
        width: 20px;
        height: 20px;
        stroke: #F29F05;
        stroke-width: 2.5;
        fill: none;
        transition: transform 0.3s ease;
    }

    /* Active State */
    .faq-item[aria-expanded="true"] .faq-card-header {
        background-color: #f8fafc;
    }

    .faq-item[aria-expanded="true"] .faq-card-title {
        color: #111827;
    }

    .faq-item[aria-expanded="true"] .faq-icon-wrapper {
        transform: none;
    }

    .faq-item[aria-expanded="true"] .faq-arrow {
        transform: rotate(180deg);
    }

    .faq-card-body {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transform: translateY(-6px);
        transition: max-height 0.5s ease, opacity 0.35s ease, transform 0.35s ease;
        will-change: max-height, opacity, transform;
        background: #fff;
    }

    .faq-item[aria-expanded="true"] .faq-card-body {
        max-height: 1000px;
        opacity: 1;
        transform: translateY(0);
    }

    .faq-answer-content {
        padding: 20px 40px 30px 20px;
        color: #475569;
        line-height: 1.6;
    }

    .faq-answer-content p {
        margin-bottom: 0.75rem;
    }

    .faq-answer-content p:last-child {
        margin-bottom: 0;
    }

    .faq-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
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
    <section class="services-hero is-prepared">
        <div class="services-hero__bg">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contract-plastic-manufacturing-hero.webp" alt="Контрактное производство изделий из пластмасс" class="services-hero__placeholder" loading="eager" decoding="sync">
            <div class="services-hero__overlay"></div>
        </div>
        <div class="services-hero__content">
            <h1 class="services-hero__title">
                <span class="text-accent">Экструзия <span style="color: #ffffff;">и</span> литье под давлением</span>
            </h1>
            <p class="services-hero__subtitle">Берем на себя всё: от проектирования оснастки до выпуска серийной партии</p>
            <a href="#contact-form" class="services-hero__cta">Рассчитать стоимость проекта</a>
        </div>

        <?php get_template_part('template-parts/scroll-down-btn'); ?>
    </section>

    <!-- Overlap Info Block -->
    <section class="services-overlap">
        <div class="services-container">
            <div class="services-overlap__card">
                <div class="services-overlap__grid">
                    <div class="services-overlap__title">
                        <img class="services-overlap__badge-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/20-years-experience-badge.webp" alt="Опыт компании с 2004 года" width="148" height="148" loading="lazy" decoding="async">
                        <h2><span class="highlight">Комплексные решения</span> в производстве пластиковых изделий</h2>
                    </div>
                    <div class="services-overlap__content">
                        <div class="services-overlap__feature">
                            <span class="services-overlap__feature-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path d="M19.4 15a1.67 1.67 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.67 1.67 0 0 0-1.82-.33a1.67 1.67 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.67 1.67 0 0 0-1-1.51a1.67 1.67 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.67 1.67 0 0 0 .33-1.82a1.67 1.67 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.67 1.67 0 0 0 1.51-1a1.67 1.67 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.67 1.67 0 0 0 1.82.33h.01a1.67 1.67 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.67 1.67 0 0 0 1 1.51a1.67 1.67 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.67 1.67 0 0 0-.33 1.82v.01a1.67 1.67 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.67 1.67 0 0 0-1.51 1z"></path>
                                </svg>
                            </span>
                            <p><span class="services-overlap__feature-subtitle">Производство полного цикла</span>Реализация проектов начинается с проектирования оснастки и разработки чертежей, завершаясь серийным выпуском методами экструзии или литья под давлением. Особое внимание уделяется точности параметров и скорости выполнения заказов. Гарантией качества служит строгое соответствие готовых изделий согласованному техническому заданию.</p>
                        </div>
                        <div class="services-overlap__feature">
                            <span class="services-overlap__feature-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="9" y="9" width="6" height="6" rx="1"></rect>
                                    <path d="M5 9h2M5 15h2M17 9h2M17 15h2M9 5v2M15 5v2M9 17v2M15 17v2M12 5v4M12 15v4M5 12h4M15 12h4"></path>
                                </svg>
                            </span>
                            <p><span class="services-overlap__feature-subtitle">Контроль и ассортимент</span>Современные автоматизированные линии и строгий контроль качества гарантируют высокую прочность и износостойкость продукции. Текущий ассортимент включает: сложные технические профили, термовставки, элементы для осветительных шинопроводов, комплектующие для автофургонов и фаскообразователи.</p>
                        </div>
                        <div class="services-overlap__tags" aria-label="Материалы">
                            <span class="services-overlap__tag">ПВХ (PVC) • АБС-пластик (ABS) • Полиэтилен (PE) • Полипропилен (PP) • Полистирол (PS) • ТПЭ (TPE)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Блок 2: Этапы работы -->
    <section class="services-steps" id="how-it-works">
        <div class="services-container">
            <div class="services-section-header">
                <h2 class="services-section-header__title">Этапы работы <span class="highlight">под ключ</span></h2>
                <p class="services-section-header__desc">Прозрачный процесс от инженерной проверки до логистики готовой партии.</p>
            </div>

            <div class="steps-slider" data-steps-slider>
                <div class="steps-slides">
                    <article class="steps-slide is-active" id="step-slide-1" role="tabpanel" aria-labelledby="step-tab-1" aria-hidden="false">
                        <div class="steps-text">
                            <div class="steps-number">01</div>
                            <h3 class="steps-title">ТЗ и расчет</h3>
                            <ul class="steps-desc">
                                <li>Принимаем чертеж/3D-модель и проверяем технологичность изделия.</li>
                                <li>Согласовываем требования по ГОСТ/ТУ и условия эксплуатации: УФ, мороз, химические среды.</li>
                                <li>Рассчитываем не только стоимость, но и оптимальный тираж.</li>
                                <li>По плановому объему определяем производительность оснастки и фиксируем смету.</li>
                            </ul>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_1.webp" alt="Иллюстрация: Техническое задание и расчет" width="600" height="400" loading="lazy">
                        </div>
                    </article>

                    <article class="steps-slide" id="step-slide-2" role="tabpanel" aria-labelledby="step-tab-2" aria-hidden="true">
                        <div class="steps-text">
                            <div class="steps-number">02</div>
                            <h3 class="steps-title">Подготовка оснастки</h3>
                            <ul class="steps-desc">
                                <li>Совместно с партнерами проектируем и изготавливаем пресс-формы и экструзионные фильеры.</li>
                                <li><strong>Срок реализации — от 2 до 4 месяцев</strong> (включая производство инструмента и пуско-наладку).</li>
                                <li>Проводим полный инженерный контроль: проверку размеров, дефектовку и балансировку оснастки перед запуском.</li>
                            </ul>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_2.webp" alt="Иллюстрация: Подготовка оснастки" width="600" height="400" loading="lazy">
                        </div>
                    </article>

                    <article class="steps-slide" id="step-slide-3" role="tabpanel" aria-labelledby="step-tab-3" aria-hidden="true">
                        <div class="steps-text">
                            <div class="steps-number">03</div>
                            <h3 class="steps-title">Опытные образцы T1</h3>
                            <ul class="steps-desc">
                                <li>Выпускаем тестовую серию T1 и передаем эталонные образцы: обычно 5-10 шт. или 5-10 м профиля.</li>
                                <li>Выполняем приёмочный контроль по геометрии, внешнему виду и стабильности размеров.</li>
                                <li>Проверяем собираемость с ответными деталями заказчика.</li>
                                <li>По результатам согласуем корректировки и утверждаем эталон.</li>
                            </ul>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_3.webp" alt="Иллюстрация: Опытные образцы (T1)" width="600" height="400" loading="lazy">
                        </div>
                    </article>

                    <article class="steps-slide" id="step-slide-4" role="tabpanel" aria-labelledby="step-tab-4" aria-hidden="true">
                        <div class="steps-text">
                            <div class="steps-number">04</div>
                            <h3 class="steps-title">Серийное производство</h3>
                            <ul class="steps-desc">
                                <li>Запускаем серию по утвержденной оснастке и технологической карте.</li>
                                <li>При запуске выполняем 100% контроль первых изделий.</li>
                                <li>При производстве партии ведем выборочный контроль по критическим параметрам.</li>
                                <li>На партию оформляем паспорт качества.</li>
                            </ul>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_4.webp" alt="Иллюстрация: Серийное производство" width="600" height="400" loading="lazy">
                        </div>
                    </article>

                    <article class="steps-slide" id="step-slide-5" role="tabpanel" aria-labelledby="step-tab-5" aria-hidden="true">
                        <div class="steps-text">
                            <div class="steps-number">05</div>
                            <h3 class="steps-title">Отгрузка и логистика</h3>
                            <ul class="steps-desc">
                                <li>Готовим закрывающие документы: УПД, протоколы испытаний.</li>
                                <li>Маркируем партию и обеспечиваем прослеживаемость по отгрузочным данным.</li>
                                <li>Упаковываем продукцию в транспортную тару с фиксацией, исключающей повреждения.</li>
                                <li>Передаем груз и комплект документов по согласованной схеме доставки.</li>
                            </ul>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_5.webp" alt="Иллюстрация: Отгрузка и логистика" width="600" height="400" loading="lazy">
                        </div>
                    </article>
                </div>

                <div class="steps-nav" role="tablist" aria-label="Этапы работы">
                    <button class="steps-nav-btn is-active" id="step-tab-1" role="tab" aria-selected="true" aria-controls="step-slide-1" data-step="0" type="button">
                        <span class="steps-nav-label">01</span>
                        <span class="steps-nav-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M13 6l6 6-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <button class="steps-nav-btn" id="step-tab-2" role="tab" aria-selected="false" aria-controls="step-slide-2" data-step="1" type="button" tabindex="-1">
                        <span class="steps-nav-label">02</span>
                        <span class="steps-nav-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M13 6l6 6-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <button class="steps-nav-btn" id="step-tab-3" role="tab" aria-selected="false" aria-controls="step-slide-3" data-step="2" type="button" tabindex="-1">
                        <span class="steps-nav-label">03</span>
                        <span class="steps-nav-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M13 6l6 6-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <button class="steps-nav-btn" id="step-tab-4" role="tab" aria-selected="false" aria-controls="step-slide-4" data-step="3" type="button" tabindex="-1">
                        <span class="steps-nav-label">04</span>
                        <span class="steps-nav-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M13 6l6 6-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <button class="steps-nav-btn" id="step-tab-5" role="tab" aria-selected="false" aria-controls="step-slide-5" data-step="4" type="button" tabindex="-1">
                        <span class="steps-nav-label">05</span>
                        <span class="steps-nav-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M13 6l6 6-6 6"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>

            <div class="steps-cta">
                <a href="#contact-form" class="steps-cta-btn">Начать работу над проектом</a>
            </div>
        </div>
    </section>

    <!-- Блок 2.5: Технологические возможности -->
    <section class="services-tech-capabilities" id="tech-capabilities">
        <div class="services-container">
            <div class="services-section-header">
                <h2 class="services-section-header__title">Технологическая база для реализации <span class="highlight">ваших проектов</span></h2>
                <p class="services-section-header__desc">Оборудование не ради характеристик, а ради результата — изделий, которые готовы к серийному выпуску и сборке.</p>
            </div>

            <div class="tech-capabilities-grid">
                <!-- Блок 1: Экструзия -->
                <article class="tech-capability">
                    <div class="tech-capability__visual tech-capability__visual--stack">
                        <div class="tech-visual-stack">
                            <img class="tech-visual-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/bernhard-ide-logo.webp" alt="Логотип IDE" width="200" height="80" loading="lazy">
                            <div class="tech-visual-photo-wrap">
                                <img class="tech-visual-photo" src="<?php echo get_template_directory_uri(); ?>/assets/images/bernhard-ide-plastic-extruder.webp" alt="Экструзионная линия IDE" width="600" height="400" loading="lazy">
                                <span class="tech-visual-disclaimer">Иллюстрация производственной базы</span>
                            </div>
                        </div>
                    </div>
                    <div class="tech-capability__text">
                        <h3 class="tech-capability__title">Выпуск втулок и профилей сложного сечения (ПВХ, АБС, ТПЭ)</h3>
                        <p class="tech-capability__desc">Используем немецкие экструзионные линии IDE, чтобы гарантировать стабильность геометрии по всей длине изделия. Это критично для строительных и монтажных профилей.</p>
                        <ul class="tech-capability__benefits">
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Без «волн» и деформаций: ленточное тянущее устройство исключает проскальзывание профиля.
                            </li>
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Сразу в размер: высокоточное отрезное устройство делает чистый рез без заусенцев — деталь готова к сборке.
                            </li>
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Сложная форма: вакуумная калибровка позволяет производить многокамерные профили с тонкими перегородками.
                            </li>
                        </ul>
                    </div>
                </article>

                <!-- Блок 2: Литье -->
                <article class="tech-capability tech-capability--reverse">
                    <div class="tech-capability__text">
                        <h3 class="tech-capability__title">Высокоточное литье серийных партий</h3>
                        <p class="tech-capability__desc">Работаем на современных ТПА, которые позволяют производить различные типы изделий.</p>
                        <ul class="tech-capability__benefits">
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                100% повторяемость: первая и тысячная деталь в партии идентичны до 0.01 мм.
                            </li>
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Эстетика: работаем с деталями, где недопустимы утяжины и облой.
                            </li>


                        </ul>
                    </div>
                    <div class="tech-capability__visual tech-capability__visual--stack">
                        <div class="tech-visual-stack">
                            <img class="tech-visual-logo tech-visual-logo--compact" src="<?php echo get_template_directory_uri(); ?>/assets/images/un_m711_logo.webp" alt="Логотип Union" width="200" height="80" loading="lazy">
                            <div class="tech-visual-photo-wrap">
                                <img class="tech-visual-photo" src="<?php echo get_template_directory_uri(); ?>/assets/images/un_m711.webp" alt="Термопластавтомат Union" width="600" height="400" loading="lazy">
                                <span class="tech-visual-disclaimer">Презентационное фото оборудования</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Блок 3: Сервис оснастки -->
                <article class="tech-service-card">
                    <div>
                        <h3 class="tech-service-card__title">Оперативная адаптация и обслуживание оснастки</h3>
                        <p class="tech-service-card__desc">Наличие собственного слесарного участка с ЧПУ позволяет нам не отправлять форму подрядчикам при малейшей поломке.</p>
                    </div>
                    <ul class="tech-service-card__benefits">
                        <li>
                            <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Быстрый старт: если вашу оснастку нужно «подогнать» под наши станки — оперативно сделаем это.
                        </li>
                        <li>
                            <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Бесплатный уход: чистка, смазка и консервация вашей оснастки — за наш счет.
                        </li>
                    </ul>
                </article>
            </div>

            <div class="tech-capabilities-cta">
                <a href="#contact-form">Узнать, подходит ли ваше изделие под наши технологии</a>
            </div>
        </div>
    </section>

    <!-- Блок 2.6: Примеры продукции (Portfolio) -->
    <section class="services-portfolio" id="product-portfolio">
        <div class="services-container">
            <div class="services-portfolio-header">
                <h2 class="services-portfolio-title">Примеры продукции</h2>
                <p class="services-portfolio-subtitle">Серийные изделия, которые мы выпускаем на экструзионных и литьевых линиях под требования B2B-клиентов.</p>
            </div>

            <div class="portfolio-grid">
                <article class="portfolio-card prod-card portfolio-card--large portfolio-card--1" data-full-img="<?php echo get_template_directory_uri(); ?>/assets/images/termovstavki_full.webp" role="button" tabindex="0">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/termovstavki_small.webp" alt="Термовставки из ПВХ" loading="lazy">
                    <div class="portfolio-card__info">
                        <span class="portfolio-card__tag">ПВХ</span>
                        <h3 class="portfolio-card__title">Термовставки из ПВХ</h3>
                        <p class="portfolio-card__material">Материал: ПВХ</p>
                    </div>
                </article>

                <article class="portfolio-card prod-card portfolio-card--medium portfolio-card--2" data-full-img="<?php echo get_template_directory_uri(); ?>/assets/images/lighting-track-busbar-profile-cross-section_full.webp" role="button" tabindex="0">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lighting-track-busbar-profile-cross-section_small.webp" alt="Профили для шинопровода" loading="lazy">
                    <div class="portfolio-card__info">
                        <span class="portfolio-card__tag">ПВХ</span>
                        <h3 class="portfolio-card__title">Профили для шинопровода</h3>
                        <p class="portfolio-card__material">Материал: ПВХ</p>
                    </div>
                </article>

                <article class="portfolio-card prod-card portfolio-card--small portfolio-card--3" data-full-img="<?php echo get_template_directory_uri(); ?>/assets/images/faskoobrazovatel-pvh-dlya-opalubki_full.webp" role="button" tabindex="0">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/faskoobrazovatel-pvh-dlya-opalubki_small.webp" alt="Фаскообразователи" loading="lazy">
                    <div class="portfolio-card__info">
                        <span class="portfolio-card__tag">ПВХ</span>
                        <h3 class="portfolio-card__title">Фаскообразователи</h3>
                        <p class="portfolio-card__material">Материал: ПВХ</p>
                    </div>
                </article>

                <article class="portfolio-card prod-card portfolio-card--small portfolio-card--4" data-full-img="<?php echo get_template_directory_uri(); ?>/assets/images/white-plastic-extrusion-tube-profile_full.webp" role="button" tabindex="0">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-plastic-extrusion-tube-profile_small.webp" alt="Полимерные втулки" loading="lazy">
                    <div class="portfolio-card__info">
                        <span class="portfolio-card__tag">ПЭ</span>
                        <h3 class="portfolio-card__title">Полимерные втулки</h3>
                        <p class="portfolio-card__material">Материал: полиэтилен</p>
                    </div>
                </article>

                <article class="portfolio-card prod-card portfolio-card--medium portfolio-card--5" data-full-img="<?php echo get_template_directory_uri(); ?>/assets/images/plastic-profiles-for-refrigerators-and-appliances_full.webp" role="button" tabindex="0">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/plastic-profiles-for-refrigerators-and-appliances_small.webp" alt="Профили для бытовой техники" loading="lazy">
                    <div class="portfolio-card__info">
                        <span class="portfolio-card__tag">АБС, ПВХ, ТЭП</span>
                        <h3 class="portfolio-card__title">Профили для бытовой техники</h3>
                        <p class="portfolio-card__material">Материал: АБС, ПВХ, ТЭП</p>
                    </div>
                </article>

                <article class="portfolio-card prod-card portfolio-card--large portfolio-card--6" data-full-img="<?php echo get_template_directory_uri(); ?>/assets/images/grey-plastic-extrusion-profile-trucks_full.webp" role="button" tabindex="0">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/grey-plastic-extrusion-profile-trucks_small.webp" alt="Профили для автофургонов" loading="lazy">
                    <div class="portfolio-card__info">
                        <span class="portfolio-card__tag">АБС</span>
                        <h3 class="portfolio-card__title">Профили для автофургонов</h3>
                        <p class="portfolio-card__material">Материал: АБС</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <div class="lightbox" id="portfolio-lightbox" aria-hidden="true">
        <button class="lightbox__close" type="button" aria-label="Закрыть">&times;</button>
        <img class="lightbox__image" src="" alt="">
    </div>

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

    <!-- Блок 2.7: Trust Block -->
    <section class="services-trust" id="trust-block">
        <div class="services-container">
            <div class="services-trust-header">
                <h2 class="services-trust-title">Что вы получаете в итоге</h2>
            </div>

            <div class="services-trust-grid">
                <article class="services-trust-item">
                    <div class="services-trust-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 3l7 3v6c0 5-3.5 8-7 9-3.5-1-7-4-7-9V6l7-3z"></path>
                            <path d="M8.5 12.5l2.2 2.2 4.8-4.8"></path>
                        </svg>
                    </div>
                    <h3 class="services-trust-card-title">Первоклассный товар</h3>
                    <p class="services-trust-card-text">Высокоточные изделия, полностью отвечающие вашим требованиям, чертежам и эталонным образцам.</p>
                </article>

                <article class="services-trust-item">
                    <div class="services-trust-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M14 10V7a4 4 0 0 0-8 0v3"></path>
                            <rect x="3" y="10" width="18" height="10" rx="2"></rect>
                            <path d="M7 14h10"></path>
                            <path d="M12 14v3"></path>
                        </svg>
                    </div>
                    <h3 class="services-trust-card-title">По хорошим ценам</h3>
                    <p class="services-trust-card-text">Более выгодные цены по сравнению с конкурентами за счет своего сырья, автоматизации и отсутствия посредников.</p>
                </article>

                <article class="services-trust-item">
                    <div class="services-trust-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M3 7h12v8H3z"></path>
                            <path d="M15 10h3l3 3v2h-6z"></path>
                            <circle cx="7" cy="17" r="2"></circle>
                            <circle cx="17" cy="17" r="2"></circle>
                        </svg>
                    </div>
                    <h3 class="services-trust-card-title">В короткие сроки</h3>
                    <p class="services-trust-card-text">Персональное общение и контроль процесса на каждом этапе: от запуска производства до отгрузки на ваш склад.</p>
                </article>
            </div>

            <div class="services-trust-cta-wrap">
                <a class="services-trust-cta-btn" href="<?php echo home_url('/quote-request/'); ?>">Сделать заказ</a>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <?php include get_template_directory() . '/template-parts/audit-form-section.php'; ?>
</main>

<script>
    // Steps slider (How it works)
    const stepsSlider = document.querySelector('[data-steps-slider]');
    if (stepsSlider) {
        const slides = Array.from(stepsSlider.querySelectorAll('.steps-slide'));
        const tabs = Array.from(stepsSlider.querySelectorAll('.steps-nav-btn'));

        const setActiveStep = (index) => {
            slides.forEach((slide, i) => {
                const isActive = i === index;
                slide.classList.toggle('is-active', isActive);
                slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
            });

            tabs.forEach((tab, i) => {
                const isActive = i === index;
                tab.classList.toggle('is-active', isActive);
                tab.classList.toggle('is-complete', i < index);
                tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                tab.setAttribute('tabindex', isActive ? '0' : '-1');
            });
        };

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => setActiveStep(index));
            tab.addEventListener('keydown', (event) => {
                if (event.key === 'ArrowRight' || event.key === 'ArrowLeft') {
                    event.preventDefault();
                    const direction = event.key === 'ArrowRight' ? 1 : -1;
                    const nextIndex = (index + direction + tabs.length) % tabs.length;
                    tabs[nextIndex].focus();
                    setActiveStep(nextIndex);
                }
            });
        });

        setActiveStep(0);
    }

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

    const servicesHero = document.querySelector('.services-hero.is-prepared');
    if (servicesHero) {
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        const revealHeroLevel3 = () => {
            if (prefersReducedMotion) {
                servicesHero.classList.add('is-loaded');
                return;
            }

            window.requestAnimationFrame(() => {
                window.requestAnimationFrame(() => {
                    servicesHero.classList.add('is-loaded');
                });
            });
        };

        if (document.readyState === 'complete') {
            window.setTimeout(revealHeroLevel3, 80);
        } else {
            window.addEventListener('load', () => {
                window.setTimeout(revealHeroLevel3, 80);
            }, {
                once: true
            });
        }
    }

    // Smooth scroll for CTA
    const ctaBtn = document.querySelector('.services-hero__cta');
    if (ctaBtn) {
        ctaBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    // Overlap block reveal on scroll
    const overlapCard = document.querySelector('.services-overlap__card');
    if (overlapCard && 'IntersectionObserver' in window) {
        const overlapObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2
        });

        overlapObserver.observe(overlapCard);
    } else if (overlapCard) {
        overlapCard.classList.add('is-visible');
    }

    // Stable anchor navigation to FAQ from other pages
    function scrollToFaqHash() {
        if (window.location.hash !== '#faq' && window.location.hash !== '#questions') {
            return;
        }

        const faqTarget = document.getElementById('faq') || document.getElementById('questions');
        if (!faqTarget) {
            return;
        }

        const siteHeader = document.querySelector('header.site-header, .site-header, #site-header');
        const headerOffset = siteHeader ? siteHeader.offsetHeight + 16 : 120;
        const faqTop = faqTarget.getBoundingClientRect().top + window.pageYOffset - headerOffset;

        window.scrollTo({
            top: faqTop,
            behavior: 'smooth'
        });
    }

    window.addEventListener('hashchange', scrollToFaqHash);
    window.addEventListener('load', () => {
        window.setTimeout(scrollToFaqHash, 120);
    });

    // Portfolio lightbox with FLIP animation and zoom/pan
    const productCards = Array.from(document.querySelectorAll('.prod-card'));
    const lightbox = document.getElementById('portfolio-lightbox');
    const lightboxImage = lightbox ? lightbox.querySelector('.lightbox__image') : null;
    const lightboxCloseBtn = lightbox ? lightbox.querySelector('.lightbox__close') : null;
    const lightboxState = {
        activeCard: null,
        activeThumb: null,
        activeToken: 0,
        animating: false,
        open: false,
        zoomed: false,
        zoomScale: 2,
        panDamping: 0.8,
        panX: 0,
        panY: 0,
        targetPanX: 0,
        targetPanY: 0,
        dragging: false,
        dragMoved: false,
        dragStartX: 0,
        dragStartY: 0,
        dragBaseX: 0,
        dragBaseY: 0,
        activePointerId: null,
        panRaf: null
    };

    function clamp(value, min, max) {
        return Math.min(max, Math.max(min, value));
    }

    function getCenteredRect(aspectRatio) {
        const maxWidth = window.innerWidth * 0.9;
        const maxHeight = window.innerHeight * 0.9;
        let width = maxWidth;
        let height = width / aspectRatio;
        if (height > maxHeight) {
            height = maxHeight;
            width = height * aspectRatio;
        }
        return {
            width: width,
            height: height,
            left: (window.innerWidth - width) / 2,
            top: (window.innerHeight - height) / 2
        };
    }

    function setLightboxTransform() {
        if (!lightboxImage) {
            return;
        }
        const scale = lightboxState.zoomed ? lightboxState.zoomScale : 1;
        lightboxImage.style.transform = `translate3d(${lightboxState.panX}px, ${lightboxState.panY}px, 0) scale(${scale})`;
    }

    function getPanLimits() {
        if (!lightboxImage) {
            return {
                maxX: 0,
                maxY: 0
            };
        }
        const scale = lightboxState.zoomed ? lightboxState.zoomScale : 1;
        const scaledWidth = lightboxImage.offsetWidth * scale;
        const scaledHeight = lightboxImage.offsetHeight * scale;
        return {
            maxX: Math.max(0, (scaledWidth - window.innerWidth) / 2),
            maxY: Math.max(0, (scaledHeight - window.innerHeight) / 2)
        };
    }

    function clampPanTargets() {
        const limits = getPanLimits();
        lightboxState.targetPanX = clamp(lightboxState.targetPanX, -limits.maxX, limits.maxX);
        lightboxState.targetPanY = clamp(lightboxState.targetPanY, -limits.maxY, limits.maxY);
    }

    function queuePanAnimation() {
        if (lightboxState.panRaf) {
            return;
        }

        function animatePan() {
            const deltaX = lightboxState.targetPanX - lightboxState.panX;
            const deltaY = lightboxState.targetPanY - lightboxState.panY;
            lightboxState.panX += deltaX * 0.22;
            lightboxState.panY += deltaY * 0.22;

            if (Math.abs(deltaX) < 0.35 && Math.abs(deltaY) < 0.35) {
                lightboxState.panX = lightboxState.targetPanX;
                lightboxState.panY = lightboxState.targetPanY;
                setLightboxTransform();
                lightboxState.panRaf = null;
                return;
            }

            setLightboxTransform();
            lightboxState.panRaf = window.requestAnimationFrame(animatePan);
        }

        lightboxState.panRaf = window.requestAnimationFrame(animatePan);
    }

    function stopDrag(event) {
        if (!lightboxState.dragging) {
            return;
        }
        if (
            event &&
            lightboxState.activePointerId !== null &&
            event.pointerId !== undefined &&
            event.pointerId !== lightboxState.activePointerId
        ) {
            return;
        }
        lightboxState.dragging = false;
        if (lightbox) {
            lightbox.classList.remove('is-dragging');
        }
        if (
            lightboxImage &&
            lightboxState.activePointerId !== null &&
            lightboxImage.hasPointerCapture &&
            lightboxImage.hasPointerCapture(lightboxState.activePointerId)
        ) {
            lightboxImage.releasePointerCapture(lightboxState.activePointerId);
        }
        lightboxState.activePointerId = null;
    }

    function startDrag(event) {
        if (!lightboxState.zoomed || lightboxState.animating || !lightboxState.open) {
            return;
        }
        event.preventDefault();
        lightboxState.dragging = true;
        lightboxState.dragMoved = false;
        lightboxState.dragStartX = event.clientX;
        lightboxState.dragStartY = event.clientY;
        lightboxState.dragBaseX = lightboxState.targetPanX;
        lightboxState.dragBaseY = lightboxState.targetPanY;
        if (lightbox) {
            lightbox.classList.add('is-dragging');
        }
        if (event.pointerId !== undefined && lightboxImage && lightboxImage.setPointerCapture) {
            lightboxState.activePointerId = event.pointerId;
            lightboxImage.setPointerCapture(event.pointerId);
        }
    }

    function dragMove(event) {
        if (!lightboxState.dragging) {
            return;
        }
        if (
            lightboxState.activePointerId !== null &&
            event.pointerId !== undefined &&
            event.pointerId !== lightboxState.activePointerId
        ) {
            return;
        }

        event.preventDefault();
        const diffX = event.clientX - lightboxState.dragStartX;
        const diffY = event.clientY - lightboxState.dragStartY;

        if (Math.abs(diffX) > 2 || Math.abs(diffY) > 2) {
            lightboxState.dragMoved = true;
        }

        lightboxState.targetPanX = lightboxState.dragBaseX + diffX * lightboxState.panDamping;
        lightboxState.targetPanY = lightboxState.dragBaseY + diffY * lightboxState.panDamping;
        clampPanTargets();
        queuePanAnimation();
    }

    function resetZoomState() {
        if (!lightbox || !lightboxImage) {
            return;
        }
        stopDrag();
        lightboxState.zoomed = false;
        lightboxState.panX = 0;
        lightboxState.panY = 0;
        lightboxState.targetPanX = 0;
        lightboxState.targetPanY = 0;
        lightbox.classList.remove('is-zoomed');
        lightbox.classList.remove('is-dragging');
        setLightboxTransform();
    }

    function createGhost(source, altText, rect, radiusPx, objectFit) {
        const ghost = document.createElement('img');
        ghost.className = 'lightbox-ghost';
        ghost.src = source;
        ghost.alt = altText || '';
        ghost.style.left = `${rect.left}px`;
        ghost.style.top = `${rect.top}px`;
        ghost.style.width = `${rect.width}px`;
        ghost.style.height = `${rect.height}px`;
        ghost.style.borderRadius = `${radiusPx}px`;
        ghost.style.objectFit = objectFit || 'cover';
        return ghost;
    }

    function cleanupAfterClose() {
        if (lightboxState.activeThumb) {
            lightboxState.activeThumb.style.opacity = '';
        }
        document.body.classList.remove('lightbox-open');
        lightboxState.activeCard = null;
        lightboxState.activeThumb = null;
        lightboxState.open = false;
        lightboxState.animating = false;
        lightboxState.panX = 0;
        lightboxState.panY = 0;
        lightboxState.targetPanX = 0;
        lightboxState.targetPanY = 0;
        lightboxState.dragMoved = false;
        lightbox.classList.remove('is-zoomed');
        lightbox.classList.remove('is-dragging');
        if (lightboxState.panRaf) {
            cancelAnimationFrame(lightboxState.panRaf);
            lightboxState.panRaf = null;
        }
    }

    function closeLightbox() {
        if (!lightbox || !lightboxImage || !lightboxState.open || lightboxState.animating) {
            return;
        }

        lightboxState.animating = true;
        lightboxState.activeToken += 1;
        resetZoomState();

        const thumb = lightboxState.activeThumb;
        const startRect = lightboxImage.getBoundingClientRect();
        const endRect = thumb ? thumb.getBoundingClientRect() : null;

        const ghost = createGhost(
            lightboxImage.currentSrc || lightboxImage.src,
            lightboxImage.alt,
            startRect,
            18,
            'contain'
        );
        document.body.appendChild(ghost);

        lightboxImage.classList.remove('is-visible');
        lightbox.classList.remove('active');
        lightbox.setAttribute('aria-hidden', 'true');

        if (!endRect || !endRect.width || !endRect.height) {
            ghost.style.opacity = '0';
            ghost.addEventListener('transitionend', () => {
                ghost.remove();
                cleanupAfterClose();
            }, {
                once: true
            });
            return;
        }

        const cardRadius = lightboxState.activeCard ?
            parseFloat(window.getComputedStyle(lightboxState.activeCard).borderRadius) || 24 :
            24;

        requestAnimationFrame(() => {
            ghost.style.left = `${endRect.left}px`;
            ghost.style.top = `${endRect.top}px`;
            ghost.style.width = `${endRect.width}px`;
            ghost.style.height = `${endRect.height}px`;
            ghost.style.borderRadius = `${cardRadius}px`;
        });

        ghost.addEventListener('transitionend', () => {
            ghost.remove();
            cleanupAfterClose();
        }, {
            once: true
        });
    }

    function openLightbox(card) {
        if (!lightbox || !lightboxImage || lightboxState.animating || lightboxState.open) {
            return;
        }

        const thumb = card.querySelector('img');
        if (!thumb) {
            return;
        }

        const startRect = thumb.getBoundingClientRect();
        if (!startRect.width || !startRect.height) {
            return;
        }

        lightboxState.animating = true;
        lightboxState.activeCard = card;
        lightboxState.activeThumb = thumb;
        const openToken = lightboxState.activeToken + 1;
        lightboxState.activeToken = openToken;
        resetZoomState();

        const cardRadius = parseFloat(window.getComputedStyle(card).borderRadius) || 24;
        const aspect = thumb.naturalWidth && thumb.naturalHeight ?
            thumb.naturalWidth / thumb.naturalHeight :
            startRect.width / startRect.height;
        const endRect = getCenteredRect(aspect);
        const previewSrc = thumb.currentSrc || thumb.src;
        const fullSrc = card.dataset.fullImg || previewSrc;

        const ghost = thumb.cloneNode(true);
        ghost.classList.add('lightbox-ghost');
        ghost.style.left = `${startRect.left}px`;
        ghost.style.top = `${startRect.top}px`;
        ghost.style.width = `${startRect.width}px`;
        ghost.style.height = `${startRect.height}px`;
        ghost.style.borderRadius = `${cardRadius}px`;
        document.body.appendChild(ghost);

        thumb.style.opacity = '0';
        document.body.classList.add('lightbox-open');

        lightboxImage.classList.remove('is-visible');
        lightboxImage.src = previewSrc;
        lightboxImage.alt = thumb.alt || '';
        lightbox.setAttribute('aria-hidden', 'false');
        setLightboxTransform();

        requestAnimationFrame(() => {
            ghost.style.left = `${endRect.left}px`;
            ghost.style.top = `${endRect.top}px`;
            ghost.style.width = `${endRect.width}px`;
            ghost.style.height = `${endRect.height}px`;
            ghost.style.borderRadius = '18px';
        });

        ghost.addEventListener('transitionend', () => {
            ghost.remove();

            if (lightboxState.activeToken !== openToken) {
                return;
            }

            lightbox.classList.add('active');
            lightboxImage.classList.add('is-visible');
            lightboxState.animating = false;
            lightboxState.open = true;

            if (fullSrc && fullSrc !== previewSrc) {
                const hdImage = new Image();
                hdImage.decoding = 'async';
                hdImage.src = fullSrc;
                hdImage.onload = () => {
                    if (lightboxState.open && lightboxState.activeToken === openToken) {
                        lightboxImage.src = fullSrc;
                        setLightboxTransform();
                    }
                };
            }
        }, {
            once: true
        });
    }

    if (productCards.length && lightbox && lightboxImage) {
        productCards.forEach((card) => {
            card.addEventListener('click', () => openLightbox(card));
            card.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    openLightbox(card);
                }
            });
        });

        if (lightboxCloseBtn) {
            lightboxCloseBtn.addEventListener('click', closeLightbox);
        }

        lightboxImage.addEventListener('click', (event) => {
            event.stopPropagation();
            if (lightboxState.animating || !lightboxState.open) {
                return;
            }
            if (lightboxState.dragMoved) {
                lightboxState.dragMoved = false;
                return;
            }
            if (lightboxState.zoomed) {
                resetZoomState();
            } else {
                lightboxState.zoomed = true;
                lightbox.classList.add('is-zoomed');
                lightboxState.targetPanX = 0;
                lightboxState.targetPanY = 0;
                queuePanAnimation();
                setLightboxTransform();
            }
        });

        lightboxImage.addEventListener('pointerdown', startDrag);
        window.addEventListener('pointermove', dragMove, {
            passive: false
        });
        window.addEventListener('pointerup', stopDrag);
        window.addEventListener('pointercancel', stopDrag);
        window.addEventListener('resize', () => {
            if (!lightboxState.zoomed) {
                return;
            }
            clampPanTargets();
            queuePanAnimation();
        });

        lightbox.addEventListener('click', (event) => {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeLightbox();
            }
        });
    }
</script>

<?php get_footer(); ?>
