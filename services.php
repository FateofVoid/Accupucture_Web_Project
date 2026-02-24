<?php
declare(strict_types=1);

/**
 * services.php
 * Uses $L (services.json for current lang) loaded by index.php
 * Expects helpers: h(), page_url()
 */

$main = $L['main_title'] ?? 'Treatment Specialties';

$intro        = $L['intro'] ?? [];
$womensBlock  = $L['womens_block'] ?? [];
$servicesIntro = $L['services_intro'] ?? [];
$services     = $L['services'] ?? [];
$ui           = $L['ui'] ?? [];

/** Page assets */
$servicesHeroBg = '../images/Services_Hero_bg.png';
$womensMedia    = 'assets/images/Services_WomensHealth_media.png';

/**
 * Buttons (Women’s Health page + brochure)
 * - b0: internal page route via "page" (preferred), optional "anchor"
 * - b1: brochure file url (can be language-specific)
 */
$b0 = $intro['buttons'][0] ?? null;
$b1 = $intro['buttons'][1] ?? null;

$b0Href = '#';
$b1Href = '#';

if (is_array($b0)) {
  if (!empty($b0['page'])) {
    $b0Href = page_url($base_url, $lang, (string)$b0['page']);
    if (!empty($b0['anchor'])) $b0Href .= '#' . ltrim((string)$b0['anchor'], '#');
  } elseif (!empty($b0['url'])) {
    // fallback if someone provides a direct URL
    $b0Href = (string)$b0['url'];
  }
}

if (is_array($b1) && !empty($b1['url'])) {
  $b1Href = (string)$b1['url'];
}

/**
 * Icon map by stable service key (NOT by translated titles)
 * Keep these filenames stable and language-independent.
 */
$serviceIcons = [
  'respiratory' => 'assets/images/Icon_Service_Respiratory.png',
  'digestive'   => 'assets/images/Icon_Service_Digestive.png',
  'musculoskeletal' => 'assets/images/Icon_Service_Musculoskeletal.png',
  'hormonal'    => 'assets/images/Icon_Service_Hormonal.png',
  'urinary_reproductive' => 'assets/images/Icon_Service_Urinary_Reproductive.png',
  'other'       => 'assets/images/Icon_Service_Other.png',
];
?>

<section class="page page--services">

  <!-- SERVICES HERO -->
  <section class="section section--services-hero" style="--hero-bg: url('<?=h($servicesHeroBg)?>');">
    <div class="container services-hero">
      <div class="services-hero__copy">
        <h1 class="h1"><?=h($main)?></h1>
        <?php if (!empty($intro['subtitle'])): ?>
          <p class="lead"><?=h((string)$intro['subtitle'])?></p>
        <?php endif; ?>
      </div>

      <div class="services-hero__card">
        <div class="card services-hero__inner">
          <?php if (!empty($intro['title'])): ?>
            <h2 class="h2 services-hero__title"><?=h((string)$intro['title'])?></h2>
          <?php endif; ?>

          <?php if (!empty($intro['paragraphs']) && is_array($intro['paragraphs'])): ?>
            <?php foreach ($intro['paragraphs'] as $p): ?>
              <p class="body"><?=h((string)$p)?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if (!empty($intro['highlights']) && is_array($intro['highlights'])): ?>
            <ul class="ticklist" aria-label="Highlights">
              <?php foreach ($intro['highlights'] as $hl): ?>
                <li><?=h((string)$hl)?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <?php if (!empty($intro['buttons']) && is_array($intro['buttons'])): ?>
            <div class="actions">
              <?php if ($b0): ?>
                <a class="btn btn--primary" href="<?=h($b0Href)?>">
                  <?=h($b0['label'] ?? 'Women’s Health')?>
                </a>
              <?php endif; ?>

              <?php if ($b1): ?>
                <a class="btn btn--soft" href="<?=h($b1Href)?>" target="_blank" rel="noopener">
                  <?=h($b1['label'] ?? 'Download brochure (PDF)')?>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($intro['disclaimer'])): ?>
            <p class="muted small services-hero__disclaimer"><?=h((string)$intro['disclaimer'])?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="band band--a" aria-hidden="true"></div>
  </section>

  <!-- WOMEN'S HEALTH SUPPORT (extra block BEFORE main services list) -->
  <?php if (!empty($intro['pregnancy_support_examples']) && is_array($intro['pregnancy_support_examples'])): ?>
    <section class="section section--womens section-band band--sky" id="womens-health">
      <div class="container">
        <div class="two-col two-col--media-left womens-grid">

          <figure class="media-card womens-media">
            <img src="<?=h($womensMedia)?>" alt="" loading="lazy" aria-hidden="true" />
          </figure>

          <div class="stack">
            <h2 class="h2"><?=h((string)($intro['title'] ?? 'Women’s Health'))?></h2>

            <div class="card soft-card">
              <h3 class="h3"><?=h((string)($womensBlock['examples_title'] ?? 'Pregnancy & postpartum support examples'))?></h3>

              <ul class="bullets">
                <?php foreach ($intro['pregnancy_support_examples'] as $ex): ?>
                  <li><?=h((string)$ex)?></li>
                <?php endforeach; ?>
              </ul>

              <p class="muted small"><?=h((string)($womensBlock['pregnancy_note'] ?? 'If you are pregnant, please always tell us how far along you are so your treatment can be adapted safely.'))?></p>
            </div>

            <div class="actions">
              <?php if ($b0): ?>
                <a class="btn btn--primary" href="<?=h($b0Href)?>">
                  <?=h($b0['label'] ?? 'Women’s Health')?>
                </a>
              <?php endif; ?>

              <?php if ($b1): ?>
                <a class="btn btn--ghost" href="<?=h($b1Href)?>" target="_blank" rel="noopener">
                  <?=h($b1['label'] ?? 'Download brochure (PDF)')?>
                </a>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- MAIN SERVICES LIST -->
  <section class="section section--services" id="services">
    <div class="container">

      <header class="section__head services-head">
        <div>
          <h2 class="h2"><?=h((string)($servicesIntro['title'] ?? 'Common areas we support'))?></h2>
          <p class="muted"><?=h((string)($servicesIntro['paragraph'] ?? ''))?></p>
        </div>

        <div class="services-tools">
          <label class="search" aria-label="<?=h((string)($ui['search_label'] ?? 'Search'))?>">
            <span class="search__label"><?=h((string)($ui['search_label'] ?? 'Search'))?></span>
            <input
              class="search__input"
              type="search"
              placeholder="<?=h((string)($ui['search_placeholder'] ?? 'e.g. migraines, IBS, shoulder…'))?>"
              data-service-search
            />
          </label>
        </div>
      </header>

      <div class="service-grid" data-service-grid>
        <?php foreach ($services as $svc): ?>
          <?php
            $key     = (string)($svc['key'] ?? '');
            $title   = (string)($svc['title'] ?? '');
            $summary = (string)($svc['summary'] ?? '');
            $notes   = (string)($svc['notes'] ?? '');
            $examples = $svc['examples'] ?? [];

            $iconSrc = $serviceIcons[$key] ?? null;

            $blob = strtolower(
              $title . ' ' . $summary . ' ' . $notes . ' ' .
              (is_array($examples) ? implode(' ', $examples) : '')
            );
          ?>

          <article class="service-card" data-service-card data-service-text="<?=h($blob)?>">
            <details class="service-details">
              <summary class="service-summary">

                <?php if ($iconSrc): ?>
                  <img class="service-icon" src="<?=h($iconSrc)?>" alt="" loading="lazy" aria-hidden="true" />
                <?php endif; ?>

                <div class="service-summary__copy">
                  <h3 class="h3"><?=h($title)?></h3>
                  <?php if ($summary): ?><p class="muted"><?=h($summary)?></p><?php endif; ?>
                </div>

                <span class="service-summary__icon" aria-hidden="true">+</span>
              </summary>

              <div class="service-body">
                <?php if (!empty($examples) && is_array($examples)): ?>
                  <h4 class="service-subtitle"><?=h((string)($ui['examples_label'] ?? 'Examples'))?></h4>
                  <ul class="bullets">
                    <?php foreach ($examples as $ex): ?>
                      <li><?=h((string)$ex)?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>

                <?php if ($notes): ?>
                  <p class="muted small service-notes"><?=h($notes)?></p>
                <?php endif; ?>

                <div class="actions">
                  <a class="btn btn--soft btn--sm" href="<?=h(page_url($base_url,$lang,'contact'))?>">
                    <?=h((string)($ui['ask_question'] ?? 'Ask a question'))?>
                  </a>
                  <a class="btn btn--ghost btn--sm" href="<?=h(page_url($base_url,$lang,'contact'))?>">
                    <?=h((string)($ui['make_appointment'] ?? 'Make an appointment'))?>
                  </a>
                </div>
              </div>
            </details>
          </article>
        <?php endforeach; ?>
      </div>

      <?php if (!empty($intro['disclaimer'])): ?>
        <div class="callout callout--wide" role="note">
          <div class="callout__inner">
            <div>
              <h3 class="h3"><?=h((string)($ui['supportive_care_title'] ?? 'Supportive care'))?></h3>
              <p class="muted"><?=h((string)$intro['disclaimer'])?></p>
            </div>
            <div class="actions">
              <a class="btn btn--primary" href="<?=h(page_url($base_url,$lang,'contact'))?>">
                <?=h((string)($ui['contact_label'] ?? 'Contact'))?>
              </a>
              <a class="btn btn--ghost" href="<?=h(page_url($base_url,$lang,'contact'))?>">
                <?=h((string)($ui['make_appointment'] ?? 'Make an appointment'))?>
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>

    <div class="band band--b" aria-hidden="true"></div>
  </section>

</section>
