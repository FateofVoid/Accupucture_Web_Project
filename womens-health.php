<?php
// womens-health.php
declare(strict_types=1);

// Fallback helpers (won't override if your functions.php already provides them)
if (!function_exists('h')) {
  function h($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
}
if (!function_exists('asset_url')) {
  function asset_url(string $path): string { return $path; }
}

$meta     = $L['meta'] ?? [];
$ui       = $L['ui'] ?? [];
$hero     = $L['hero'] ?? [];
$sections = $L['sections'] ?? [];
$pillars  = $L['pillars'] ?? [];
$faq      = $L['faq'] ?? [];

/**
 * Build internal href from a CTA object.
 * Supports:
 * - { "page": "contact", "anchor": "top" }
 * - { "anchor": "faq" } (in-page)
 * - { "url": "https://..." } (external)
 */
$cta_href = function($cta) use ($base_url, $lang): string {
  if (!is_array($cta)) return '#';

  if (!empty($cta['page'])) {
    $href = page_url($base_url, $lang, (string)$cta['page']);
    if (!empty($cta['anchor'])) $href .= '#' . ltrim((string)$cta['anchor'], '#');
    return $href;
  }

  if (!empty($cta['url'])) return (string)$cta['url'];

  if (!empty($cta['anchor'])) return '#' . ltrim((string)$cta['anchor'], '#');

  return '#';
};

/** Helper for label fallback */
$cta_label = function($cta, string $fallback): string {
  if (is_array($cta) && !empty($cta['label'])) return (string)$cta['label'];
  return $fallback;
};

// Resolve HERO CTAs
$heroPrimary = is_array($hero['primary_cta'] ?? null) ? $hero['primary_cta'] : ['page' => 'contact'];
$heroSecond  = is_array($hero['secondary_cta'] ?? null) ? $hero['secondary_cta'] : ['page' => 'contact'];
$heroBro     = is_array($hero['brochure_cta'] ?? null) ? $hero['brochure_cta'] : null;

$heroPrimaryHref = $cta_href($heroPrimary);
$heroSecondHref  = $cta_href($heroSecond);
$heroPrimaryLabel = $cta_label($heroPrimary, (string)($ui['buttons']['make_appointment'] ?? 'Make an Appointment'));
$heroSecondLabel  = $cta_label($heroSecond,  (string)($ui['buttons']['contact'] ?? 'Contact us'));
?>

<main class="page page--womens-health">

  <!-- HERO -->
  <section class="section section-band band--sky section--hero" id="top">
    <div class="band band--a" aria-hidden="true"></div>
    <div class="container">
      <div class="wh-hero">
        <div class="wh-hero__copy">
          <h1 class="h1"><?= h($hero['title'] ?? 'Women’s Health') ?></h1>

          <?php if (!empty($hero['subtitle'])): ?>
            <p class="lead"><?= h($hero['subtitle']) ?></p>
          <?php endif; ?>

          <?php if (!empty($hero['paragraphs']) && is_array($hero['paragraphs'])): ?>
            <div class="stack">
              <?php foreach ($hero['paragraphs'] as $p): ?>
                <p class="body"><?= h($p) ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($hero['trust_chips']) && is_array($hero['trust_chips'])): ?>
            <div class="chips" aria-label="<?= h($ui['labels']['trust_highlights'] ?? 'Trust highlights') ?>">
              <?php foreach ($hero['trust_chips'] as $chip): ?>
                <span class="chip"><?= h($chip) ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <div class="actions">
            <a class="btn btn--primary" href="<?= h($heroPrimaryHref) ?>">
              <?= h($heroPrimaryLabel) ?>
            </a>

            <a class="btn btn--ghost" href="<?= h($heroSecondHref) ?>">
              <?= h($heroSecondLabel) ?>
            </a>

            <?php if ($heroBro): ?>
              <?php
                $broHref = !empty($heroBro['url']) ? asset_url((string)$heroBro['url']) : $cta_href($heroBro);
                $broLabel = $cta_label($heroBro, (string)($ui['buttons']['download_brochure'] ?? 'Download brochure (PDF)'));
              ?>
              <a class="btn btn--soft" href="<?= h($broHref) ?>" target="_blank" rel="noopener">
                <?= h($broLabel) ?>
              </a>
            <?php endif; ?>
          </div>

          <?php if (!empty($hero['disclaimer'])): ?>
            <p class="small muted wh-disclaimer"><?= h($hero['disclaimer']) ?></p>
          <?php endif; ?>
        </div>

        <div class="wh-hero__media">
          <div class="video-card wh-media-card">
            <?php
              $img = $hero['image'] ?? 'assets/images/womens_health_hero.jpg';
              $alt = $hero['image_alt'] ?? 'Women’s health acupuncture support';
            ?>
            <img class="wh-hero__img" src="<?= h(asset_url((string)$img)) ?>" alt="<?= h((string)$alt) ?>" loading="lazy">
            <div class="wh-media-card__overlay" aria-hidden="true"></div>
          </div>

          <?php if (!empty($meta['on_page_label']) && !empty($meta['nav_anchors'])): ?>
            <div class="card wh-onpage">
              <div class="h3"><?= h($meta['on_page_label']) ?></div>
              <div class="wh-onpage__links">
                <?php foreach (($meta['nav_anchors'] ?? []) as $a): ?>
                  <a class="text-link" href="#<?= h($a['id'] ?? '') ?>"><?= h($a['label'] ?? '') ?></a>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </section>

  <!-- PILLARS QUICK NAV -->
  <section class="section section-band band--butter section--pillars" id="overview">
    <div class="band band--b" aria-hidden="true"></div>
    <div class="container">
      <div class="section__head">
        <h2 class="h2"><?= h($pillars['title'] ?? 'Common reasons people book') ?></h2>
        <?php if (!empty($pillars['subtitle'])): ?>
          <p class="lead"><?= h($pillars['subtitle']) ?></p>
        <?php endif; ?>
      </div>

      <div class="wh-pillars">
        <?php foreach (($pillars['items'] ?? []) as $it): ?>
          <?php $aid = (string)($it['anchor_id'] ?? ''); ?>
          <a class="card wh-pillar" href="#<?= h($aid) ?>">
            <div class="wh-pillar__icon" aria-hidden="true">
              <?php if (!empty($it['icon'])): ?>
                <img
                  src="<?= h(asset_url((string)$it['icon'])) ?>"
                  alt=""
                  width="70" height="70"
                  loading="lazy"
                  decoding="async"
                  aria-hidden="true"
                >
              <?php else: ?>
                <span class="wh-pillar__dot"></span>
              <?php endif; ?>
            </div>
            <div class="wh-pillar__text">
              <div class="h3"><?= h($it['title'] ?? '') ?></div>
              <p class="muted small"><?= h($it['text'] ?? '') ?></p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

      <?php if (!empty($pillars['note'])): ?>
        <div class="note-card">
          <p class="body"><?= h($pillars['note']) ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- PREGNANCY SPOTLIGHT -->
  <?php $preg = $sections['pregnancy_spotlight'] ?? null; ?>
  <?php if (is_array($preg)): ?>
    <?php
      $pregPrimary = is_array($preg['primary_cta'] ?? null) ? $preg['primary_cta'] : ['page'=>'contact'];
      $pregSecond  = is_array($preg['secondary_cta'] ?? null) ? $preg['secondary_cta'] : ['page'=>'contact'];
    ?>
    <section class="section section-band band--sky" id="<?= h($preg['id'] ?? 'pregnancy') ?>">
      <div class="band band--c" aria-hidden="true"></div>
      <div class="container">
        <div class="section-head--split">
          <div class="section-head__copy">
            <h2 class="h2"><?= h($preg['title'] ?? 'Pregnancy support') ?></h2>
            <?php if (!empty($preg['subtitle'])): ?>
              <p class="lead"><?= h($preg['subtitle']) ?></p>
            <?php endif; ?>
          </div>
          <div class="section-head__actions">
            <a class="btn btn--primary" href="<?= h($cta_href($pregPrimary)) ?>">
              <?= h($cta_label($pregPrimary, (string)($ui['buttons']['make_appointment'] ?? 'Make an Appointment'))) ?>
            </a>
            <a class="btn btn--ghost" href="<?= h($cta_href($pregSecond)) ?>">
              <?= h($cta_label($pregSecond, (string)($ui['buttons']['ask_question'] ?? 'Ask a question'))) ?>
            </a>
          </div>
        </div>

        <div class="two-col wh-spotlight">
          <div class="card">
            <?php if (!empty($preg['paragraphs']) && is_array($preg['paragraphs'])): ?>
              <?php foreach ($preg['paragraphs'] as $p): ?>
                <p class="body"><?= h($p) ?></p>
              <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($preg['examples']) && is_array($preg['examples'])): ?>
              <div class="wh-list-title"><?= h($preg['examples_title'] ?? ($ui['labels']['examples'] ?? 'Examples')) ?></div>
              <ul class="wh-bullets">
                <?php foreach ($preg['examples'] as $ex): ?>
                  <li><?= h($ex) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>

          <div class="card wh-spotlight__aside">
            <?php if (!empty($preg['image'])): ?>
              <div class="wh-aside__img">
                <img src="<?= h(asset_url((string)$preg['image'])) ?>" alt="<?= h((string)($preg['image_alt'] ?? '')) ?>" loading="lazy">
              </div>
            <?php endif; ?>

            <?php if (!empty($preg['safety']) && is_array($preg['safety'])): ?>
              <div class="wh-safety">
                <div class="wh-safety__title"><?= h($preg['safety']['title'] ?? ($ui['labels']['important_note'] ?? 'Important note')) ?></div>
                <p class="small muted"><?= h($preg['safety']['text'] ?? '') ?></p>
              </div>
            <?php endif; ?>

            <?php if (!empty($preg['micro_trust']) && is_array($preg['micro_trust'])): ?>
              <div class="badges">
                <?php foreach ($preg['micro_trust'] as $b): ?>
                  <span class="badge"><?= h($b) ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </section>
  <?php endif; ?>

  <!-- LIFE STAGES -->
  <?php $life = $sections['life_stages'] ?? []; ?>
  <?php $lifeHead = $sections['life_stages_head'] ?? []; ?>
  <?php if (!empty($life) && is_array($life)): ?>
    <section class="section section-band band--mint" id="life-stages">
      <div class="band band--d" aria-hidden="true"></div>
      <div class="container">
        <div class="section__head">
          <h2 class="h2"><?= h($lifeHead['title'] ?? 'Support across life stages') ?></h2>
          <?php if (!empty($lifeHead['subtitle'])): ?>
            <p class="lead"><?= h($lifeHead['subtitle']) ?></p>
          <?php endif; ?>
        </div>

        <div class="wh-stage-grid">
          <?php foreach ($life as $block): ?>
            <article class="card wh-stage" id="<?= h($block['id'] ?? '') ?>">
              <h3 class="h3"><?= h($block['title'] ?? '') ?></h3>

              <?php if (!empty($block['paragraphs']) && is_array($block['paragraphs'])): ?>
                <?php foreach ($block['paragraphs'] as $p): ?>
                  <p class="body"><?= h($p) ?></p>
                <?php endforeach; ?>
              <?php endif; ?>

              <?php if (!empty($block['examples']) && is_array($block['examples'])): ?>
                <div class="wh-list-title"><?= h($block['examples_title'] ?? ($ui['labels']['examples'] ?? 'Examples')) ?></div>
                <ul class="wh-bullets">
                  <?php foreach ($block['examples'] as $ex): ?>
                    <li><?= h($ex) ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>

              <?php if (!empty($block['often_combined_with']) && is_array($block['often_combined_with'])): ?>
                <div class="wh-list-title"><?= h($block['combined_title'] ?? ($ui['labels']['often_combined'] ?? 'Often combined with')) ?></div>
                <div class="badges">
                  <?php foreach ($block['often_combined_with'] as $tag): ?>
                    <span class="badge"><?= h($tag) ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- WHAT TO EXPECT -->
  <?php $wte = $sections['what_to_expect'] ?? null; ?>
  <?php if (is_array($wte)): ?>
    <section class="section section-band band--butter" id="<?= h($wte['id'] ?? 'what-to-expect') ?>">
      <div class="container">
        <div class="section__head">
          <h2 class="h2"><?= h($wte['title'] ?? 'What to expect') ?></h2>
          <?php if (!empty($wte['subtitle'])): ?>
            <p class="lead"><?= h($wte['subtitle']) ?></p>
          <?php endif; ?>
        </div>

        <div class="wh-steps">
          <?php foreach (($wte['steps'] ?? []) as $step): ?>
            <div class="card">
              <div class="h3"><?= h($step['title'] ?? '') ?></div>
              <p class="body"><?= h($step['text'] ?? '') ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <?php if (!empty($wte['note'])): ?>
          <p class="small muted"><?= h($wte['note']) ?></p>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- DECISION HELPER -->
  <?php $help = $sections['decision_helper'] ?? null; ?>
  <?php if (is_array($help)): ?>
    <?php
      $helpCta = is_array($help['cta'] ?? null) ? $help['cta'] : [];
      $helpPrimary = is_array($helpCta['primary'] ?? null) ? $helpCta['primary'] : ['page'=>'contact'];
      $helpSecond  = is_array($helpCta['secondary'] ?? null) ? $helpCta['secondary'] : ['page'=>'contact'];
    ?>
    <section class="section section-band band--sky" id="<?= h($help['id'] ?? 'is-this-right') ?>">
      <div class="container">
        <div class="section__head">
          <h2 class="h2"><?= h($help['title'] ?? 'Is this right for me?') ?></h2>
          <?php if (!empty($help['subtitle'])): ?>
            <p class="lead"><?= h($help['subtitle']) ?></p>
          <?php endif; ?>
        </div>

        <div class="wh-help two-col">
          <div class="card">
            <?php if (!empty($help['items']) && is_array($help['items'])): ?>
              <ul class="wh-checklist">
                <?php foreach ($help['items'] as $it): ?>
                  <li><?= h($it) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>

          <div class="card">
            <div class="h3"><?= h($helpCta['title'] ?? 'Not sure where you fit?') ?></div>
            <p class="body"><?= h($helpCta['text'] ?? '') ?></p>

            <div class="actions">
              <a class="btn btn--primary" href="<?= h($cta_href($helpPrimary)) ?>">
                <?= h($cta_label($helpPrimary, (string)($ui['buttons']['make_appointment'] ?? 'Make an Appointment'))) ?>
              </a>
              <a class="btn btn--ghost" href="<?= h($cta_href($helpSecond)) ?>">
                <?= h($cta_label($helpSecond, (string)($ui['buttons']['contact'] ?? 'Contact us'))) ?>
              </a>
            </div>
          </div>
        </div>

        <?php if (!empty($help['safety_note']) && is_array($help['safety_note'])): ?>
          <div class="callout callout--wide">
            <div class="callout__inner">
              <div>
                <div class="diagram__title"><?= h($help['safety_note']['title'] ?? ($ui['labels']['safety_first'] ?? 'Safety first')) ?></div>
                <p class="small muted" style="margin:0;"><?= h($help['safety_note']['text'] ?? '') ?></p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- FAQ -->
  <?php if (is_array($faq) && !empty($faq['items'])): ?>
    <?php
      $faqCta = is_array($faq['closing_cta'] ?? null) ? $faq['closing_cta'] : [];
      $faqPrimary = is_array($faqCta['primary'] ?? null) ? $faqCta['primary'] : ['page'=>'contact'];
      $faqSecond  = is_array($faqCta['secondary'] ?? null) ? $faqCta['secondary'] : ['page'=>'contact'];
    ?>
    <section class="section section-band band--mint" id="<?= h($faq['id'] ?? 'faq') ?>">
      <div class="container">
        <div class="section__head">
          <h2 class="h2"><?= h($faq['title'] ?? 'FAQ') ?></h2>
          <?php if (!empty($faq['subtitle'])): ?>
            <p class="lead"><?= h($faq['subtitle']) ?></p>
          <?php endif; ?>
        </div>

        <div class="faq" data-faq>
          <?php foreach (($faq['items'] ?? []) as $item): ?>
            <div class="faq-cat">
              <button class="faq-cat__header" type="button" aria-expanded="false">
                <span><?= h($item['q'] ?? '') ?></span>
                <span class="faq-cat__icon">+</span>
              </button>
              <div class="faq-cat__body" hidden>
                <p class="body" style="margin:0;"><?= h($item['a'] ?? '') ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php if (!empty($faqCta)): ?>
          <div class="callout callout--wide">
            <div class="callout__inner">
              <div>
                <div class="diagram__title"><?= h($faqCta['title'] ?? 'Still have questions?') ?></div>
                <p class="small muted" style="margin:0;"><?= h($faqCta['text'] ?? '') ?></p>
              </div>
              <div class="actions" style="margin:0;">
                <a class="btn btn--ghost" href="<?= h($cta_href($faqPrimary)) ?>">
                  <?= h($cta_label($faqPrimary, (string)($ui['buttons']['contact'] ?? 'Contact us'))) ?>
                </a>
                <a class="btn btn--primary" href="<?= h($cta_href($faqSecond)) ?>">
                  <?= h($cta_label($faqSecond, (string)($ui['buttons']['make_appointment'] ?? 'Make an Appointment'))) ?>
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </section>
  <?php endif; ?>

</main>
