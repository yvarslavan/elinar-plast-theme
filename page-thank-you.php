<?php
/*
Template Name: Thank You Page
*/
get_header();
?>

<style>
  @media (max-width: 768px) {
    .thank-you-content[style] {
      padding: 40px 12px !important;
    }

    .thank-you-content .thank-you-icon svg {
      width: 64px;
      height: 64px;
    }

    .thank-you-content h2[style] {
      font-size: 1.5rem !important;
      line-height: 1.3 !important;
    }

    .thank-you-content p[style] {
      font-size: 1rem !important;
    }

    .thank-you-content .thank-you-info[style] {
      padding: 20px !important;
      margin-bottom: 28px !important;
    }

    .thank-you-content .thank-you-info h3[style] {
      font-size: 1.1rem !important;
    }

    .thank-you-content .thank-you-contacts a[style] {
      font-size: 1.2rem !important;
      word-break: break-word;
    }

    .thank-you-content > a.btn[style] {
      display: block !important;
      width: 100%;
      padding: 14px 18px !important;
    }
  }

  @media (max-width: 390px) {
    .thank-you-content[style] {
      padding: 32px 10px !important;
    }

    .thank-you-content h2[style] {
      font-size: 1.35rem !important;
    }

    .thank-you-content .thank-you-info ul[style] {
      padding-left: 16px !important;
    }
  }
</style>

<!-- HERO BLOCK - Thank You Page -->
<div class="page-hero page-hero-compact page-hero-thankyou">
  <!-- Hero Background Image -->
  <picture class="hero-bg-picture">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/thank-you.webp"
      alt="Спасибо за заявку"
      class="hero-bg-img"
      width="1920"
      height="1080"
      fetchpriority="high"
      loading="eager"
      decoding="sync">
  </picture>
  <div class="hero-overlay"></div>
  <div class="container">
    <h1 class="text-white">Спасибо за <span class="text-orange">вашу заявку!</span></h1>
    <p class="lead">Мы получили ваш запрос и свяжемся с вами в ближайшее время.</p>
  </div>
</div>

<main class="section page-content">
  <div class="container">
    <div class="thank-you-content" style="text-align: center; padding: 60px 20px; max-width: 800px; margin: 0 auto;">
      <div class="thank-you-icon" style="margin-bottom: 30px;">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="10" stroke="#F97316" stroke-width="2" fill="none" />
          <path d="M8 12l2.5 2.5L16 9" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>

      <h2 style="color: #1E293B; font-size: 2rem; margin-bottom: 20px;">Ваша заявка принята!</h2>

      <p style="color: #64748B; font-size: 1.125rem; line-height: 1.7; margin-bottom: 30px;">
        Наш инженер свяжется с вами в течение <strong>1 рабочего дня</strong> для уточнения деталей проекта и расчёта стоимости.
      </p>

      <div class="thank-you-info" style="background: #F8FAFC; border-radius: 12px; padding: 30px; margin-bottom: 40px; text-align: left;">
        <h3 style="color: #1E293B; font-size: 1.25rem; margin-bottom: 15px;">Что будет дальше:</h3>
        <ul style="color: #64748B; line-height: 1.8; padding-left: 20px;">
          <li>Мы изучим ваш запрос и подготовим техническое предложение</li>
          <li>Свяжемся с вами для уточнения деталей</li>
          <li>Предоставим точный расчёт стоимости и сроков</li>
        </ul>
      </div>

      <div class="thank-you-contacts" style="margin-bottom: 40px;">
        <p style="color: #64748B; margin-bottom: 15px;">Если у вас срочный вопрос, позвоните нам:</p>
        <a href="tel:+74963477944" style="color: #F97316; font-size: 1.5rem; font-weight: 600; text-decoration: none;">
          +7 (496) 34-77-944
        </a>
      </div>

      <a href="<?php echo home_url('/'); ?>" class="btn btn-primary" style="display: inline-block; background: #F97316; color: white; padding: 15px 40px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background 0.3s;">
        Вернуться на главную
      </a>
    </div>
  </div>
</main>

<?php get_footer(); ?>
