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
}

.services-hero__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 25, 50, 0.5) 0%, rgba(0, 25, 50, 0.5) 100%);
    z-index: 2;
}

.services-hero__content {
    position: relative;
    z-index: 3;
    max-width: 800px;
    text-align: center;
    transform: translateY(-30px);
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
    box-shadow: 0 4px 15px rgba(245,158,11,0.4);
}

.services-hero__cta:hover {
    background: #d97706;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(245,158,11,0.5);
}

.services-hero .scroll-down-wrapper {
    bottom: 130px;
}

/* ============================================
   OVERLAP INFO BLOCK
   ============================================ */
.services-overlap {
    position: relative;
    padding: 0 24px 90px;
    --overlap-offset: 100px;
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
    background: #ffffff;
    padding: 60px 80px;
    margin-top: calc(var(--overlap-offset) * -1);
    position: relative;
    z-index: 10;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.8s ease, transform 0.8s ease;
    will-change: opacity, transform;
}

.services-overlap__card.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.services-overlap__grid {
    display: grid;
    grid-template-columns: 35% 1fr;
    gap: 48px;
    align-items: start;
}

.services-overlap__title h2 {
    font-size: clamp(1.8rem, 3.2vw, 2.6rem);
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
    margin: 0;
}

.services-overlap__title .text-accent {
    color: #f59e0b;
}

.services-overlap__content p {
    font-size: 1rem;
    line-height: 1.7;
    color: #475569;
    margin: 0 0 1rem 0;
}

.services-overlap__content p:last-of-type {
    margin-bottom: 0;
}

.services-overlap__tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 24px;
}

.services-overlap__tag {
    background: #f3f4f6;
    color: #1f2937;
    border-radius: 4px;
    padding: 5px 12px;
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.01em;
}

@media (max-width: 1024px) {
    .services-overlap {
        --overlap-offset: 80px;
    }

    .services-overlap__card {
        padding: 48px 48px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .services-overlap__card {
        opacity: 1;
        transform: none;
        transition: none;
    }
}

@media (max-width: 768px) {
    .services-overlap {
        padding: 0 16px 64px;
        --overlap-offset: 60px;
    }

    .services-overlap__card {
        padding: 36px 28px;
    }

    .services-overlap__grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
}

/* ============================================
   BLOCK 2: HOW IT WORKS SLIDER
   ============================================ */
.services-steps {
    padding: 90px 24px;
    background:
        radial-gradient(900px 320px at 90% 0%, rgba(245, 158, 11, 0.16) 0%, rgba(245, 158, 11, 0.02) 55%, transparent 65%),
        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
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
    padding: 48px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
}

.steps-slides {
    position: relative;
}

.steps-slide {
    display: none;
    gap: 48px;
    align-items: center;
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
    background: #f8fafc;
    border-radius: 20px;
    padding: 24px;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e2e8f0;
}

.steps-visual img {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain;
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
        min-height: 260px;
    }
}

@media (max-width: 767px) {
    .services-steps {
        padding: 70px 16px;
    }

    .steps-slider {
        padding: 24px;
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

    .tech-service-card {
        padding: 28px 24px;
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
    <section class="services-hero">
        <div class="services-hero__bg">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contract-plastic-manufacturing-hero.webp" alt="Контрактное производство изделий из пластмасс" class="services-hero__placeholder" loading="eager" decoding="sync">
            <div class="services-hero__overlay"></div>
        </div>
        <div class="services-hero__content">
            <h1 class="services-hero__title">
                Контрактное производство полимерных изделий <span class="text-accent">полного цикла</span>
            </h1>
            <p class="services-hero__subtitle">Литье под давлением и экструзия. Берем на себя всё: от проектирования пресс-форм до выпуска серийной партии.</p>
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
                        <h2>Производство полимерных изделий <span class="text-accent">любой формы и назначения</span> — ключевая компетенция «Элинар Пласт»</h2>
                    </div>
                    <div class="services-overlap__content">
                        <p>Мы выполняем заказы любой сложности: от серийных комплектующих для бытовой техники до высокоточных профилей для светотехники и строительства. Парк современного экструзионного и литьевого оборудования позволяет нам выдерживать строгие допуски и гарантировать стабильную геометрию изделий.</p>
                        <p>Для решения задач заказчика мы работаем с широким спектром полимеров. Сегодня мы выпускаем: сложные технические профили, термовставки, элементы для световых шинопроводов, комплектующие для спецтранспорта, а также фаскообразователи и втулки.</p>
                        <div class="services-overlap__tags" aria-label="Материалы">
                            <span class="services-overlap__tag">ПВХ</span>
                            <span class="services-overlap__tag">АБС-пластик</span>
                            <span class="services-overlap__tag">Полиэтилен (PE)</span>
                            <span class="services-overlap__tag">Полипропилен (PP)</span>
                            <span class="services-overlap__tag">Поликарбонат (PC)</span>
                            <span class="services-overlap__tag">Полистирол (PS)</span>
                            <span class="services-overlap__tag">Полиамид (PA)</span>
                            <span class="services-overlap__tag">ТЭП</span>
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
                            <h3 class="steps-title">Техническое задание и расчет</h3>
                            <p class="steps-desc">Вы присылаете нам чертеж, 3D-модель или физический образец изделия. Инженеры проводят аудит конструкции на технологичность (DFM-анализ), подбирают оптимальный полимер и рассчитывают точную смету проекта.</p>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_1.webp" alt="Иллюстрация: Техническое задание и расчет" width="600" height="400" loading="lazy">
                        </div>
                    </article>

                    <article class="steps-slide" id="step-slide-2" role="tabpanel" aria-labelledby="step-tab-2" aria-hidden="true">
                        <div class="steps-text">
                            <div class="steps-number">02</div>
                            <h3 class="steps-title">Подготовка оснастки</h3>
                            <p class="steps-desc">Если у вас нет своей пресс-формы (или фильеры), мы проектируем и изготавливаем её «с нуля». Если оснастка есть — проводим её дефектовку и обслуживание перед запуском.</p>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_2.webp" alt="Иллюстрация: Подготовка оснастки" width="600" height="400" loading="lazy">
                        </div>
                    </article>

                    <article class="steps-slide" id="step-slide-3" role="tabpanel" aria-labelledby="step-tab-3" aria-hidden="true">
                        <div class="steps-text">
                            <div class="steps-number">03</div>
                            <h3 class="steps-title">Опытные образцы (T1)</h3>
                            <p class="steps-desc">Перед запуском серии мы делаем тестовые отливки (или пробный прокат профиля). Вы получаете эталонные образцы для проверки геометрии, собираемости и физических свойств.</p>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_3.webp" alt="Иллюстрация: Опытные образцы (T1)" width="600" height="400" loading="lazy">
                        </div>
                    </article>

                    <article class="steps-slide" id="step-slide-4" role="tabpanel" aria-labelledby="step-tab-4" aria-hidden="true">
                        <div class="steps-text">
                            <div class="steps-number">04</div>
                            <h3 class="steps-title">Серийное производство</h3>
                            <p class="steps-desc">После утверждения образцов запускаем промышленную партию. Процесс включает автоматизированное литье/экструзию, контроль качества ОТК, маркировку и упаковку согласно ТЗ.</p>
                        </div>
                        <div class="steps-visual">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stages_work_4.webp" alt="Иллюстрация: Серийное производство" width="600" height="400" loading="lazy">
                        </div>
                    </article>

                    <article class="steps-slide" id="step-slide-5" role="tabpanel" aria-labelledby="step-tab-5" aria-hidden="true">
                        <div class="steps-text">
                            <div class="steps-number">05</div>
                            <h3 class="steps-title">Отгрузка и логистика</h3>
                            <p class="steps-desc">Передаем готовую партию вместе с закрывающими документами и паспортами качества. Организуем доставку до вашего склада в любой регион РФ или готовим груз к самовывозу.</p>
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
                <p class="services-section-header__desc">Оборудование не ради характеристик, а ради результата — изделий, которые готовы к сборке и серийному выпуску.</p>
            </div>

            <div class="tech-capabilities-grid">
                <!-- Блок 1: Экструзия -->
                <article class="tech-capability">
                    <div class="tech-capability__visual tech-capability__visual--stack">
                        <div class="tech-visual-stack">
                            <img class="tech-visual-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/bernhard-ide-logo.webp" alt="Логотип IDE" width="200" height="80" loading="lazy">
                            <img class="tech-visual-photo" src="<?php echo get_template_directory_uri(); ?>/assets/images/bernhard-ide-plastic-extruder.webp" alt="Экструзионная линия IDE" width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="tech-capability__text">
                        <h3 class="tech-capability__title">Выпуск профилей сложного сечения (ПВХ, АБС, ПЭ)</h3>
                        <p class="tech-capability__desc">Используем немецкие комплексы IDE, чтобы гарантировать стабильность геометрии на всей длине изделия. Это критично для строительных и монтажных профилей.</p>
                        <ul class="tech-capability__benefits">
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Без «волн» и деформаций: гусеничная протяжка исключает проскальзывание профиля.
                            </li>
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Сразу в размер: встроенный пильный узел делает чистый рез без заусенцев — деталь готова к сборке.
                            </li>
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Сложная форма: вакуумная калибровка позволяет отливать многокамерные профили с тонкими перегородками.
                            </li>
                        </ul>
                    </div>
                </article>

                <!-- Блок 2: Литье -->
                <article class="tech-capability tech-capability--reverse">
                    <div class="tech-capability__text">
                        <h3 class="tech-capability__title">Высокоточное литье серийных партий</h3>
                        <p class="tech-capability__desc">Работаем на станках Union (Тайвань) с сервоприводами. Это оборудование класса "Precision", которое позволяет лить как массивные корпуса, так и миниатюрные детали весом в несколько грамм.</p>
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
                                Эстетика: работаем с лицевыми деталями (корпуса приборов), где недопустимы утяжины и облой.
                            </li>
                            <li>
                                <svg class="tech-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Экономия: сервоприводы снижают себестоимость цикла, что делает нашу цену конкурентной.
                            </li>
                        </ul>
                    </div>
                    <div class="tech-capability__visual tech-capability__visual--stack">
                        <div class="tech-visual-stack">
                            <img class="tech-visual-logo tech-visual-logo--compact" src="<?php echo get_template_directory_uri(); ?>/assets/images/un_m711_logo.webp" alt="Логотип Union" width="200" height="80" loading="lazy">
                            <img class="tech-visual-photo" src="<?php echo get_template_directory_uri(); ?>/assets/images/un_m711.webp" alt="Термопластавтомат Union" width="600" height="400" loading="lazy">
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
                            Быстрый старт: если вашу пресс-форму нужно «подогнать» под наши станки — сделаем это на месте.
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
        }, { threshold: 0.2 });

        overlapObserver.observe(overlapCard);
    } else if (overlapCard) {
        overlapCard.classList.add('is-visible');
    }
</script>

<?php get_footer(); ?>
