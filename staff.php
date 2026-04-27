<?php
declare(strict_types=1);

/**
 * staff.php
 * Uses:
 *  - $S from shared.json (team.members list)
 *  - $L from staff.json (page copy + bios + certificates), already language-scoped (en/nl/es)
 */

$teamMembers = $S['team']['members'] ?? [];
$pageTitle = (string)($L['meta']['page_title'] ?? $L['main_title'] ?? 'Our practitioners');

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

// Map shared member keys to staff.json content keys (keep your existing jon­gejan keys)
$keyMap = [
  'merel' => 'jongejan',
];
$staffKey = fn(string $sharedKey): string => $keyMap[$sharedKey] ?? $sharedKey;

// staff.json flat keys for each practitioner
$staffTitleKey = fn(string $key) => 'staff_title_' . $key;
$staffParaKey  = fn(string $key) => 'staff_paragraph_' . $key;
$aboutTitleKey = fn(string $key) => 'about_title_' . $key;
$aboutParaKey  = fn(string $key) => 'about_paragraph_' . $key;
$certTitleKey  = fn(string $key) => 'certificate_title_' . $key;
$certParaKey   = fn(string $key) => 'certificate_paragraph_' . $key;

// Routes
$contactUrl = page_url($base_url, $lang, 'contact') . '#contact';
$apptUrl = $appointment_url;

// Common labels (all from JSON)
$uiQuickToolsTitle   = $getStr($L, ['ui','quick_tools_title'], 'Quick tools');
$uiSearchLabel       = $getStr($L, ['ui','search_practitioner_label'], 'Search practitioner');
$uiSearchPlaceholder = $getStr($L, ['ui','search_placeholder'], 'Type a name…');
$uiExpandAll         = $getStr($L, ['ui','expand_all'], 'Expand all');
$uiCollapseAll       = $getStr($L, ['ui','collapse_all'], 'Collapse all');
$uiTipExpand         = $getStr($L, ['ui','tip_expand'], '');
$uiAvailabilityLabel = $getStr($L, ['ui','availability_label'], 'Availability');
$uiPhoneLabel        = $getStr($L, ['ui','phone_label'], 'Phone');

// CTA labels
$ctaAppt    = $getStr($L, ['cta_labels','make_appointment'], 'Make an Appointment');
$ctaContact = $getStr($L, ['cta_labels','contact'], 'Contact us');
$ctaAsk     = $getStr($L, ['cta_labels','ask_question'], 'Ask a question');

// HERO
$heroTitle     = $getStr($L, ['hero','title'], $getStr($L, ['main_title'], 'Our practitioners'));
$heroSubtitle  = $getStr($L, ['hero','subtitle'], '');
$heroParas     = $getArr($L, ['hero','paragraphs']);
$heroChips     = $getArr($L, ['hero','trust_chips']);
$heroPrimary   = $getArr($L, ['hero','primary_cta']);
$heroSecondary = $getArr($L, ['hero','secondary_cta']);

$heroPrimaryLabel = (string)($heroPrimary['label'] ?? $ctaAppt);
$heroSecondaryLabel = (string)($heroSecondary['label'] ?? $ctaAsk);

// On-page anchors
$anchors = $getArr($L, ['meta','nav_anchors']);
if (empty($features['staff_join_section'])) {
  $anchors = array_values(array_filter($anchors, function ($a) {
    return is_array($a) && (($a['id'] ?? '') !== 'join');
  }));
}

// TEAM SECTION
$teamId = $getStr($L, ['team_section','id'], 'team');
$teamTitle = $getStr($L, ['team_section','title'], 'Practitioners');
$teamSubtitle = $getStr($L, ['team_section','subtitle'], '');
$teamNote = $getStr($L, ['team_section','note'], '');

// Expandable labels (optional if you later want “Show more/less”)
$expAbout = $getStr($L, ['expandables','about_label'], 'About');
$expCerts = $getStr($L, ['expandables','certs_label'], 'Diplomas & certificates');

// HOW TO CHOOSE
$choose = $getArr($L, ['how_to_choose']);

// STANDARDS
$standards = $getArr($L, ['standards']);

// JOIN TEAM
$join = $getArr($L, ['join_team']);

// CLOSING CTA
$closing = $getArr($L, ['closing_cta']);
$closingTitle = (string)($closing['title'] ?? '');
$closingText  = (string)($closing['text'] ?? '');
$closingPrimary = $closing['primary'] ?? [];
$closingSecondary = $closing['secondary'] ?? [];

$closingPrimaryLabel = (string)($closingPrimary['label'] ?? $ctaAppt);
$closingSecondaryLabel = (string)($closingSecondary['label'] ?? $ctaContact);

?>

<section class="page page--staff">

  <!-- HERO -->
  <section class="section section--staff-hero section-band band--sky">
    <div class="container staff-hero">
      <div class="staff-hero__copy">
        <h1 class="h1"><?= h($heroTitle) ?></h1>

        <?php if ($heroSubtitle): ?>
          <p class="lead"><?= h($heroSubtitle) ?></p>
        <?php endif; ?>

        <?php if (!empty($heroParas)): ?>
          <?php foreach ($heroParas as $p): ?>
            <p class="body"><?= h((string)$p) ?></p>
          <?php endforeach; ?>
        <?php endif; ?>

        <div class="actions">
          <a class="btn btn--primary" href="<?= h($apptUrl) ?>"><?= h($heroPrimaryLabel) ?></a>
          <a class="btn btn--ghost" href="<?= h($contactUrl) ?>"><?= h($heroSecondaryLabel) ?></a>
        </div>

        <?php if (!empty($heroChips)): ?>
          <div class="chips" aria-label="Trust highlights">
            <?php foreach ($heroChips as $chip): ?>
              <span class="chip"><?= h((string)$chip) ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($anchors)): ?>
          <div class="staff-onpage" aria-label="On-page navigation" style="margin-top:14px;">
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

      <div class="staff-hero__aside">
        <div class="card staff-tools">
          <h2 class="h3"><?= h($uiQuickToolsTitle) ?></h2>

          <div class="staff-tools__row">
            <label class="staff-search">
              <span class="staff-search__label muted small"><?= h($uiSearchLabel) ?></span>
              <input
                class="staff-search__input"
                type="search"
                placeholder="<?= h($uiSearchPlaceholder) ?>"
                data-staff-search
              />
            </label>
          </div>

          <div class="actions">
            <button class="btn btn--soft btn--sm" type="button" data-staff-expand-all><?= h($uiExpandAll) ?></button>
            <button class="btn btn--soft btn--sm" type="button" data-staff-collapse-all><?= h($uiCollapseAll) ?></button>
          </div>

          <?php if ($uiTipExpand): ?>
            <p class="muted small" style="margin-top:10px;"><?= h($uiTipExpand) ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- PRACTITIONERS -->
  <section class="section section--practitioners" id="<?= h($teamId) ?>">
    <div class="container">
      <header class="section__head staff-head">
        <div>
          <h2 class="h2"><?= h($teamTitle) ?></h2>
          <?php if ($teamNote): ?>
            <p class="muted"><?= h($teamNote) ?></p>
          <?php endif; ?>
          <?php if ($teamSubtitle): ?>
            <p class="muted small" style="margin-top:6px;"><?= h($teamSubtitle) ?></p>
          <?php endif; ?>
        </div>
      </header>

      <div class="staff-grid" data-staff-grid>
        <?php foreach ($teamMembers as $m): ?>
          <?php
            $kShared = (string)($m['key'] ?? '');
            if ($kShared === '') continue;

            $k = $staffKey($kShared);

            // Pull localized HTML blocks from staff.json
            $nameHtml   = (string)($L[$staffTitleKey($k)] ?? h((string)($m['name'] ?? '')));
            $summaryHtml = (string)($L[$staffParaKey($k)] ?? '');
            $aboutTitle = (string)($L[$aboutTitleKey($k)] ?? $expAbout);
            $aboutHtml  = (string)($L[$aboutParaKey($k)] ?? '');
            $certTitle  = (string)($L[$certTitleKey($k)] ?? $expCerts);
            $certHtml   = (string)($L[$certParaKey($k)] ?? '');

            // Assets
            $img = (string)($m['image'] ?? '');
            $imgPath = $img ? (__DIR__ . '/' . ltrim($img, '/')) : '';
            $imgFinal = ($imgPath && file_exists($imgPath)) ? $img : 'assets/images/Heng_ren_tang_logo.png';

            // Membership + availability + phone
            $membership = is_array($m['membership'] ?? null) ? $m['membership'] : [];
            $availability = is_array($m['availability'] ?? null) ? $m['availability'] : [];
            $phone = trim((string)($m['phone'] ?? ''));

            // Search blob for JS filtering (strip tags from rich HTML)
            $mbBlob = '';
            if (!empty($membership)) {
              $parts = [];
              foreach ($membership as $mb) {
                $parts[] = trim((string)($mb['org'] ?? '') . ' ' . (string)($mb['id'] ?? ''));
              }
              $mbBlob = implode(' ', $parts);
            }

            $blob = mb_strtolower(trim(
              strip_tags((string)($m['name'] ?? '')) . ' ' .
              $mbBlob . ' ' .
              strip_tags($summaryHtml) . ' ' .
              strip_tags($aboutHtml) . ' ' .
              strip_tags($certHtml)
            ));
          ?>

          <article class="card staff-card" data-staff-card data-staff-text="<?= h($blob) ?>">
            <header class="staff-card__top">
              <div class="staff-card__avatar">
                <img src="<?= h($imgFinal) ?>" alt="<?= h((string)($m['name'] ?? 'Practitioner')) ?>" loading="lazy" />
              </div>

              <div class="staff-card__meta">
                <h3 class="h2 staff-card__name"><?= $nameHtml ?></h3>

                <?php if (!empty($membership)): ?>
                  <div class="badges">
                    <?php foreach ($membership as $mb): ?>
                      <span class="badge"><?= h((string)(($mb['org'] ?? '') . ': ' . ($mb['id'] ?? ''))) ?></span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>

                <?php if ($phone): ?>
                  <p class="muted small" style="margin-top:8px;"><?= h($uiPhoneLabel) ?>: <?= h($phone) ?></p>
                <?php endif; ?>
              </div>

              <div class="staff-card__cta">
                <a class="btn btn--primary btn--sm" href="<?= h($apptUrl) ?>"><?= h($ctaAppt) ?></a>
              </div>
            </header>

            <?php if ($summaryHtml): ?>
              <div class="staff-card__summary">
                <?= $summaryHtml ?>
              </div>
            <?php endif; ?>

            <div class="staff-card__details">
              <?php if ($aboutHtml): ?>
                <details class="staff-acc" data-staff-acc>
                  <summary class="staff-acc__sum">
                    <span><?= h($aboutTitle) ?></span>
                    <span class="staff-acc__icon" aria-hidden="true">+</span>
                  </summary>
                  <div class="staff-acc__body">
                    <div class="staff-rich"><?= $aboutHtml ?></div>
                  </div>
                </details>
              <?php endif; ?>

              <?php if ($certHtml): ?>
                <details class="staff-acc" data-staff-acc>
                  <summary class="staff-acc__sum">
                    <span><?= h($certTitle) ?></span>
                    <span class="staff-acc__icon" aria-hidden="true">+</span>
                  </summary>
                  <div class="staff-acc__body">
                    <div class="staff-rich"><?= $certHtml ?></div>
                  </div>
                </details>
              <?php endif; ?>
            </div>

            <?php if (!empty($availability)): ?>
              <div class="staff-card__hours">
                <h4 class="h3" style="margin-bottom:10px;"><?= h($uiAvailabilityLabel) ?></h4>
                <div class="schedule">
                  <?php foreach ($availability as $av): ?>
                    <div class="row">
                      <span class="muted"><?= h((string)($av['day'] ?? '')) ?></span>
                      <span><?= h((string)($av['time'] ?? '')) ?></span>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
          </article>

        <?php endforeach; ?>
      </div>

      <?php if ($closingTitle || $closingText): ?>
        <div class="callout callout--wide">
          <div class="callout__inner">
            <div>
              <?php if ($closingTitle): ?><h3 class="h3"><?= h($closingTitle) ?></h3><?php endif; ?>
              <?php if ($closingText): ?><p class="muted"><?= h($closingText) ?></p><?php endif; ?>
            </div>
            <div class="actions">
              <a class="btn btn--primary" href="<?= h($apptUrl) ?>"><?= h($closingPrimaryLabel) ?></a>
              <a class="btn btn--ghost" href="<?= h($contactUrl) ?>"><?= h($closingSecondaryLabel) ?></a>
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <!-- HOW TO CHOOSE -->
  <?php if (!empty($choose)): ?>
    <?php
      $chooseId = (string)($choose['id'] ?? 'how-to-choose');
      $chooseTitle = (string)($choose['title'] ?? '');
      $chooseSubtitle = (string)($choose['subtitle'] ?? '');
      $chooseCards = is_array($choose['cards'] ?? null) ? $choose['cards'] : [];
      $chooseNote = (string)($choose['note'] ?? '');
    ?>
    <section class="section section--choose section-band band--mint" id="<?= h($chooseId) ?>">
      <div class="container">
        <header class="section__head">
          <?php if ($chooseTitle): ?><h2 class="h2"><?= h($chooseTitle) ?></h2><?php endif; ?>
          <?php if ($chooseSubtitle): ?><p class="muted"><?= h($chooseSubtitle) ?></p><?php endif; ?>
        </header>

        <?php if (!empty($chooseCards)): ?>
          <div class="staff-info-grid">
            <?php foreach ($chooseCards as $c): ?>
              <?php
                $ct = (string)($c['title'] ?? '');
                $tx = (string)($c['text'] ?? '');
                if (!$ct && !$tx) continue;
              ?>
              <article class="card">
                <?php if ($ct): ?><h3 class="h3"><?= h($ct) ?></h3><?php endif; ?>
                <?php if ($tx): ?><p class="muted"><?= h($tx) ?></p><?php endif; ?>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if ($chooseNote): ?>
          <div class="note-card">
            <p class="body"><?= h($chooseNote) ?></p>
            <div class="actions">
              <a class="btn btn--primary" href="<?= h($contactUrl) ?>"><?= h($ctaContact) ?></a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- STANDARDS -->
  <?php if (!empty($standards)): ?>
    <?php
      $stId = (string)($standards['id'] ?? 'standards');
      $stTitle = (string)($standards['title'] ?? '');
      $stItems = is_array($standards['items'] ?? null) ? $standards['items'] : [];
    ?>
    <section class="section section--standards section-band band--butter" id="<?= h($stId) ?>">
      <div class="container">
        <header class="section__head">
          <?php if ($stTitle): ?><h2 class="h2"><?= h($stTitle) ?></h2><?php endif; ?>
        </header>

        <div class="two-col staff-standards">
          <?php
            // Render into two cards (2+2)
            $chunks = array_chunk($stItems, 2);
            foreach ($chunks as $chunk):
          ?>
            <div class="card">
              <?php foreach ($chunk as $it): ?>
                <?php
                  $t = (string)($it['title'] ?? '');
                  $tx = (string)($it['text'] ?? '');
                  if (!$t && !$tx) continue;
                ?>
                <?php if ($t): ?><h3 class="h3"><?= h($t) ?></h3><?php endif; ?>
                <?php if ($tx): ?><p class="muted"><?= h($tx) ?></p><?php endif; ?>
                <div style="height:10px;"></div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- JOIN TEAM -->
  <?php if (!empty($features['staff_join_section'])): ?>
    <?php include __DIR__ . '/php/join-team.php'; ?>
  <?php endif; ?>

</section>
