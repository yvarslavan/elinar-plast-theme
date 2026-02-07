<?php

/**
 * Production Video Section - Final Corrected Layout
 * Large video focus with visible glow, gradient border, and no overflow
 */

$video_url = get_template_directory_uri() . '/assets/video/elinar_plast_music.mp4';
$poster_url = get_template_directory_uri() . '/assets/video/poster_elinar_plast.webp';
?>

<style>
  /* ============================================
       PRODUCTION VIDEO SECTION - FINAL FIX
       ============================================ */
  .pv-section {
    padding: 40px 0 100px;
    background-color: #ffffff;
    position: relative;
    overflow-x: hidden;
    /* CRITICAL: Prevents horizontal scroll from bg-shape */
  }

  .pv-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
  }

  /* Top floor: intro + video */
  .pv-top-row {
    display: grid;
    grid-template-columns: 40% 60%;
    gap: 60px;
    align-items: center;
    width: 100%;
  }

  /* Intro Column */
  .pv-intro-col {
    background: #ffffff;
    padding: 50px;
    border-radius: 24px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
    position: relative;
    z-index: 2;
  }

  .pv-accent-line {
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #0052D4 0%, #0077CC 100%);
    border-radius: 2px;
    margin-bottom: 24px;
  }

  .pv-title {
    font-family: 'Inter', sans-serif;
    font-size: clamp(24px, 3.5vw, 36px);
    font-weight: 800;
    color: #1e293b;
    line-height: 1.2;
    margin: 0 0 24px 0;
    letter-spacing: -0.02em;
  }

  .pv-lead {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    line-height: 1.7;
    color: #475569;
    margin: 0;
  }

  /* Bottom floor: technologies */
  .pv-tech-floor {
    margin-top: 36px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 36px;
    box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
  }

  .pv-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 24px 0;
  }

  .pv-tech-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
  }

  .pv-tech-list li {
    background: #f8fbff;
    border: 1px solid #dbeafe;
    border-radius: 16px;
    position: relative;
    padding: 20px 20px 20px 56px;
    font-size: 15px;
    line-height: 1.6;
    color: #475569;
  }

  .pv-tech-list li::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 20px;
    width: 24px;
    height: 24px;
    background: #eff6ff;
    border-radius: 50%;
  }

  .pv-tech-list li::after {
    content: '';
    position: absolute;
    left: 27px;
    top: 26px;
    width: 10px;
    height: 6px;
    border-left: 2.5px solid #0052D4;
    border-bottom: 2.5px solid #0052D4;
    transform: rotate(-45deg);
  }

  .pv-tech-list li strong {
    color: #1e293b;
    font-weight: 700;
  }

  .pv-tech-desc {
    color: #64748b;
  }

  /* Video Column - PROMINENT Effects */
  .pv-video-col {
    position: relative;
    z-index: 1;
    padding: 24px;
  }

  .pv-video-col::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #F1F5F9 0%, #E2E8F0 100%);
    border-radius: 40px;
    z-index: 0;
  }

  /* Gradient border wrapper */
  .pv-video-glow-wrapper {
    position: relative;
    padding: 8px;
    /* Thick visible gradient border */
    background: linear-gradient(135deg, #0052D4 0%, #0077CC 50%, #00A3E0 100%);
    border-radius: 28px;
    /* Strong blue glow */
    box-shadow: 0 35px 70px -15px rgba(0, 82, 212, 0.5);
    z-index: 1;
  }

  .pv-video-inner {
    border-radius: 20px;
    overflow: hidden;
    background: #000;
    line-height: 0;
    aspect-ratio: 16 / 9;
    /* Ensure poster fits without cropping */
  }

  .pv-video-player {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    object-position: center top;
  }

  /* ============================================
       RESPONSIVE
       ============================================ */
  @media (max-width: 1024px) {
    .pv-top-row {
      grid-template-columns: 1fr;
      gap: 28px;
    }

    .pv-intro-col {
      padding: 40px;
      border-radius: 20px;
    }

    .pv-video-col {
      padding: 0;
    }

    .pv-tech-floor {
      padding: 28px;
      margin-top: 28px;
    }

    .pv-tech-list {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 768px) {
    .pv-section {
      padding: 60px 0;
    }

    .pv-video-glow-wrapper {
      border-radius: 20px;
      padding: 5px;
    }

    .pv-video-inner {
      border-radius: 15px;
    }

    .pv-intro-col {
      padding: 30px 20px;
      border-radius: 20px;
    }

    .pv-tech-floor {
      padding: 24px 20px;
      border-radius: 20px;
    }

    .pv-subtitle {
      font-size: 20px;
    }

    .pv-tech-list li {
      padding: 18px 16px 18px 50px;
    }

    .pv-tech-list li::before {
      left: 16px;
      top: 18px;
    }

    .pv-tech-list li::after {
      left: 23px;
      top: 24px;
    }
  }
</style>

<section class="pv-section" id="production-video-tour">
  <div class="pv-container">
    <div class="pv-top-row">

      <!-- Intro Column (Left) -->
      <div class="pv-intro-col">
        <div class="pv-accent-line"></div>

        <h2 class="pv-title">Видеоэкскурсия по производству</h2>

        <p class="pv-lead">
          За многолетний опыт работы компания «Элинар Пласт» объединила под одной крышей передовые методы переработки пластмасс. Комплексный подход и различные виды декоративной отделки позволяют нам создавать стильные, качественные изделия, точно соответствующие требованиям заказчика, и сохранять при этом оптимальную стоимость.
        </p>
      </div>

      <!-- Video Column (Right) -->
      <div class="pv-video-col">
        <div class="pv-video-glow-wrapper">
          <div class="pv-video-inner">
            <video
              class="pv-video-player"
              controls
              playsinline
              preload="metadata"
              poster="<?php echo esc_url($poster_url); ?>">
              <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
              Ваш браузер не поддерживает воспроизведение видео.
            </video>
          </div>
        </div>
      </div>

    </div>

    <div class="pv-tech-floor">
      <h3 class="pv-subtitle">Ключевые технологии производства:</h3>

      <ul class="pv-tech-list">
        <li>
          <strong>Экструзия.</strong> <span class="pv-tech-desc">Метод непрерывного формования, позволяющий получать изделия или полуфабрикаты из полимерных материалов неограниченной длины. Процесс происходит путем выдавливания расплава полимера через формующую головку (фильеру).</span>
        </li>
        <li>
          <strong>Литье под давлением.</strong> <span class="pv-tech-desc">Высокопроизводительный процесс изготовления деталей сложной формы. Заключается во впрыске расплавленного материала под высоким давлением в пресс-форму с последующим охлаждением и затвердеванием.</span>
        </li>
      </ul>
    </div>
  </div>
</section>


