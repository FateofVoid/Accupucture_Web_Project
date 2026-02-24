<?php
declare(strict_types=1);

/**
 * Join Team section include (reusable)
 *
 * Loads its own localization from: /localization/join-team.json
 *
 * Expects:
 *  - $lang (string) current language (en/nl/es)
 *  - $base_url (string)
 *
 * For links/labels:
 *  - $contactUrl (string) preferred (if provided)
 *  - OR it will build from page_url($base_url,$lang,'contact') . '#contact'
 *  - $ctaContact (string) fallback label for the soft button
 *
 * Feature gating (optional):
 *  - $featureEnabled callable OR $features array with ['staff_join_section']
 */

if (isset($featureEnabled) && is_callable($featureEnabled)) {
  if (!$featureEnabled('staff_join_section')) return;
} elseif (isset($features) && empty($features['staff_join_section'])) {
  return;
}

$joinJsonPath = dirname(__DIR__, 3) . '/localization/join-team.json';
if (!is_file($joinJsonPath)) return;

$raw = file_get_contents($joinJsonPath);
if ($raw === false) return;

$data = json_decode($raw, true);
if (!is_array($data)) return;

$langKey = isset($lang) && is_string($lang) ? $lang : 'en';
$bundle = $data[$langKey] ?? ($data['en'] ?? null);
if (!is_array($bundle)) return;

$join = $bundle['join_team'] ?? null;
if (empty($join) || !is_array($join)) return;

// URL fallback if not provided by parent
if (!isset($contactUrl) || !is_string($contactUrl) || $contactUrl === '') {
  if (function_exists('page_url') && isset($base_url) && is_string($base_url)) {
    $contactUrl = page_url($base_url, $langKey, 'contact') . '#contact';
  } else {
    $contactUrl = '#';
  }
}

$jId       = (string)($join['id'] ?? 'join');
$jTitle    = (string)($join['title'] ?? '');
$jSubtitle = (string)($join['subtitle'] ?? '');
$jParas    = is_array($join['paragraphs'] ?? null) ? $join['paragraphs'] : [];

$reqTitle  = (string)($join['requirements_title'] ?? '');
$reqs      = is_array($join['requirements'] ?? null) ? $join['requirements'] : [];

$sendTitle = (string)($join['what_to_send_title'] ?? '');
$send      = is_array($join['what_to_send'] ?? null) ? $join['what_to_send'] : [];

$jNote     = (string)($join['note'] ?? '');
$jCta      = is_array($join['cta'] ?? null) ? $join['cta'] : [];
$jCtaLabel = (string)($jCta['label'] ?? ($ctaContact ?? 'Contact us'));
?>

<section class="section section--join" id="<?= h($jId) ?>">
  <div class="container">
    <header class="section__head section-head section-head--split">
      <div class="section-head__copy">
        <?php if ($jTitle): ?><h2 class="h2"><?= h($jTitle) ?></h2><?php endif; ?>
        <?php if ($jSubtitle): ?><p class="muted"><?= h($jSubtitle) ?></p><?php endif; ?>

        <?php if (!empty($jParas)): ?>
          <?php foreach ($jParas as $p): ?>
            <p class="muted"><?= h((string)$p) ?></p>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="section-head__actions">
        <a class="btn btn--primary" href="<?= h($contactUrl) ?>"><?= h($jCtaLabel) ?></a>
      </div>
    </header>

    <div class="two-col">
      <div class="card">
        <?php if ($reqTitle): ?><h3 class="h3"><?= h($reqTitle) ?></h3><?php endif; ?>
        <?php if (!empty($reqs)): ?>
          <ul class="bullets">
            <?php foreach ($reqs as $r): ?>
              <li><?= h((string)$r) ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>

      <div class="card">
        <?php if ($sendTitle): ?><h3 class="h3"><?= h($sendTitle) ?></h3><?php endif; ?>
        <?php if (!empty($send)): ?>
          <ul class="bullets">
            <?php foreach ($send as $s): ?>
              <li><?= h((string)$s) ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if ($jNote): ?>
          <div class="callout" style="margin-top:14px;">
            <div class="callout__inner">
              <div><p class="muted" style="margin:0;"><?= h($jNote) ?></p></div>
              <div class="actions">
                <a class="btn btn--soft" href="<?= h($contactUrl) ?>"><?= h((string)($ctaContact ?? 'Contact us')) ?></a>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
