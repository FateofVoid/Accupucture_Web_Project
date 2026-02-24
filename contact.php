<?php
declare(strict_types=1);

/**
 * contact.php
 * Expects:
 *  - $L (language scoped) from localisation/contact.json
 *  - helpers: h(), page_url()
 *  - $base_url, $lang
 */

// Helpers
$getStr = function (array $arr, array $path, string $fallback = ''): string {
  $cur = $arr;
  foreach ($path as $k) {
    if (!is_array($cur) || !array_key_exists($k, $cur)) return $fallback;
    $cur = $cur[$k];
  }
  return is_string($cur) ? $cur : $fallback;
};
$getArr = function (array $arr, array $path): array {
  $cur = $arr;
  foreach ($path as $k) {
    if (!is_array($cur) || !array_key_exists($k, $cur)) return [];
    $cur = $cur[$k];
  }
  return is_array($cur) ? $cur : [];
};

// Meta + anchors
$pageTitle = $getStr($L, ['meta','page_title'], 'Contact | Heng Ren Tang');
$anchors = $getArr($L, ['meta','nav_anchors']);

// Hero
$heroTitle = $getStr($L, ['hero','title'], 'Contact');
$heroLead  = $getStr($L, ['hero','lead'], '');
$heroChips = $getArr($L, ['hero','chips']);
$heroCta   = $getArr($L, ['hero','primary_cta']);
$heroCtaLabel = (string)($heroCta['label'] ?? '');
$heroCtaAnchor = (string)($heroCta['anchor'] ?? 'form');

// Info cards
$infoTitle = $getStr($L, ['info_cards','title'], '');
$infoCards = $getArr($L, ['info_cards','cards']);

// Form section labels
$formSection = $getArr($L, ['form_section']);
$formSectionId = (string)($formSection['id'] ?? 'form');
$formSectionTitle = (string)($formSection['title'] ?? '');
$formSectionSubtitle = (string)($formSection['subtitle'] ?? '');

// Next steps
$next = $getArr($L, ['next_steps']);
$nextId = (string)($next['id'] ?? 'next');
$nextTitle = (string)($next['title'] ?? '');
$nextSteps = is_array($next['steps'] ?? null) ? $next['steps'] : [];
$nextNote  = (string)($next['note'] ?? '');

?>

<section class="page page--contact" id="contact">

  <!-- HERO -->
  <section
    class="section section--contact-hero section-band band--sky"
    style="--hero-bg: url('../images/contact-hero.png');"
  >
    <div class="container contact-hero">
      <div class="contact-hero__copy">
        <h1 class="h1"><?= h($heroTitle) ?></h1>
        <?php if ($heroLead): ?><p class="lead"><?= h($heroLead) ?></p><?php endif; ?>

        <?php if (!empty($heroChips)): ?>
          <div class="chips" aria-label="Highlights">
            <?php foreach ($heroChips as $chip): ?>
              <span class="chip"><?= h((string)$chip) ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="actions">
          <?php if ($heroCtaLabel): ?>
            <a class="btn btn--primary" href="#<?= h($heroCtaAnchor) ?>"><?= h($heroCtaLabel) ?></a>
          <?php endif; ?>
        </div>

        <?php if (!empty($anchors)): ?>
          <div class="contact-onpage" aria-label="On-page navigation">
            <?php foreach ($anchors as $a): ?>
              <?php
                $aid = (string)($a['id'] ?? '');
                $alabel = (string)($a['label'] ?? '');
                if ($aid === '' || $alabel === '') continue;
              ?>
              <a class="chip" href="#<?= h($aid) ?>"><?= h($alabel) ?></a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="contact-hero__aside">
        <?php if ($infoTitle || !empty($infoCards)): ?>
          <div class="card contact-info">
            <?php if ($infoTitle): ?><h2 class="h3"><?= h($infoTitle) ?></h2><?php endif; ?>

            <?php if (!empty($infoCards)): ?>
              <div class="contact-info__grid">
                <?php foreach ($infoCards as $c): ?>
                  <?php
                    $ct = (string)($c['title'] ?? '');
                    $cp = (string)($c['text'] ?? '');
                  ?>
                  <div class="contact-info__item">
                    <?php if ($ct): ?><div class="contact-info__title"><?= h($ct) ?></div><?php endif; ?>
                    <?php if ($cp): ?><div class="muted small"><?= h($cp) ?></div><?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="band band--b" aria-hidden="true"></div>
  </section>

  <!-- FORM -->
  <section class="section section--contact-form" id="form">
    <div class="container">
      <?php include __DIR__ . '/php/contact-form.php'; ?>
    </div>
  </section>

  <!-- NEXT STEPS -->
  <?php if ($nextTitle || !empty($nextSteps) || $nextNote): ?>
    <section class="section section--contact-next section-band band--lavender" id="<?= h($nextId) ?>">
      <div class="container">
        <header class="section__head">
          <?php if ($nextTitle): ?><h2 class="h2"><?= h($nextTitle) ?></h2><?php endif; ?>
        </header>

        <?php if (!empty($nextSteps)): ?>
          <div class="contact-steps">
            <?php foreach ($nextSteps as $i => $s): ?>
              <?php
                $st = (string)($s['title'] ?? '');
                $sp = (string)($s['text'] ?? '');
                $num = (int)$i + 1;
              ?>
              <div class="card contact-step">
                <div class="contact-step__num"><?= h((string)$num) ?></div>
                <div>
                  <?php if ($st): ?><h3 class="h3" style="margin-bottom:6px;"><?= h($st) ?></h3><?php endif; ?>
                  <?php if ($sp): ?><p class="muted" style="margin:0;"><?= h($sp) ?></p><?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if ($nextNote): ?>
          <div class="contact-note">
            <p class="muted" style="margin:0;"><?= h($nextNote) ?></p>
          </div>
        <?php endif; ?>
      </div>

      <div class="band band--c" aria-hidden="true"></div>
    </section>
  <?php endif; ?>

</section>
