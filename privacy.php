<?php
declare(strict_types=1);

/**
 * privacy.php (compact / legal-document style, no dropdowns)
 * Uses:
 *  - $L from localisation/privacy.json (language-scoped: en/nl/es)
 *  - shared helpers: h(), page_url()
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

// Meta / hero
$pageTitle = $getStr($L, ['meta','page_title'], $getStr($L, ['hero','title'], 'Privacy Policy'));
$heroTitle = $getStr($L, ['hero','title'], 'Privacy Policy');
$heroLead  = $getStr($L, ['hero','lead'], '');

// Sections
$contact       = $getArr($L, ['sections','contact']);
$dataProcessed = $getArr($L, ['sections','data_processed']);
$under16       = $getArr($L, ['sections','under16']);
$purposes      = $getArr($L, ['sections','purposes']);
$useShare      = $getArr($L, ['sections','use_share']);
$access        = $getArr($L, ['sections','access']);     // <- now rendered as plain blocks
$retention     = $getArr($L, ['sections','retention']);
$sharing       = $getArr($L, ['sections','sharing']);
$rights        = $getArr($L, ['sections','rights']);
$security      = $getArr($L, ['sections','security']);
$cookies       = $getArr($L, ['sections','cookies']);

?>

<section class="page page--privacy">

  <!-- HEADER (plain) -->
  <header class="privacy-head">
    <div class="container">
      <h1 class="privacy-title"><?= h($heroTitle) ?></h1>
      <?php if ($heroLead): ?>
        <p class="privacy-lead"><?= h($heroLead) ?></p>
      <?php endif; ?>
    </div>
  </header>

  <!-- CONTACT -->
  <?php if (!empty($contact)): ?>
    <?php
      $id = (string)($contact['id'] ?? 'contact');
      $title = (string)($contact['title'] ?? '');
      $bodyHtml = (string)($contact['body_html'] ?? '');
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>
        <?php if ($bodyHtml): ?><div class="privacy-rich"><?= $bodyHtml ?></div><?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- DATA WE PROCESS -->
  <?php if (!empty($dataProcessed)): ?>
    <?php
      $id = (string)($dataProcessed['id'] ?? 'data');
      $title = (string)($dataProcessed['title'] ?? '');

      $left  = is_array($dataProcessed['personal'] ?? null) ? $dataProcessed['personal'] : [];
      $right = is_array($dataProcessed['sensitive'] ?? null) ? $dataProcessed['sensitive'] : [];

      $plTitle = (string)($left['title'] ?? '');
      $plText  = (string)($left['text'] ?? '');
      $plList  = is_array($left['list'] ?? null) ? $left['list'] : [];

      $srTitle = (string)($right['title'] ?? '');
      $srText  = (string)($right['text'] ?? '');
      $srList  = is_array($right['list'] ?? null) ? $right['list'] : [];
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>

        <div class="privacy-cols">
          <div class="privacy-col">
            <?php if ($plTitle): ?><h3 class="privacy-h3"><?= h($plTitle) ?></h3><?php endif; ?>
            <?php if ($plText): ?><p class="privacy-p"><?= h($plText) ?></p><?php endif; ?>
            <?php if (!empty($plList)): ?>
              <ul class="privacy-list">
                <?php foreach ($plList as $li): ?><li><?= h((string)$li) ?></li><?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>

          <div class="privacy-col">
            <?php if ($srTitle): ?><h3 class="privacy-h3"><?= h($srTitle) ?></h3><?php endif; ?>
            <?php if ($srText): ?><p class="privacy-p"><?= h($srText) ?></p><?php endif; ?>
            <?php if (!empty($srList)): ?>
              <ul class="privacy-list">
                <?php foreach ($srList as $li): ?><li><?= h((string)$li) ?></li><?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- UNDER 16 -->
  <?php if (!empty($under16)): ?>
    <?php
      $id = (string)($under16['id'] ?? 'under16');
      $title = (string)($under16['title'] ?? '');
      $text = (string)($under16['text'] ?? '');
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>
        <?php if ($text): ?><p class="privacy-p"><?= h($text) ?></p><?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- PURPOSES & LEGAL BASIS -->
  <?php if (!empty($purposes)): ?>
    <?php
      $id = (string)($purposes['id'] ?? 'purposes');
      $title = (string)($purposes['title'] ?? '');
      $cards = is_array($purposes['cards'] ?? null) ? $purposes['cards'] : [];
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>

        <div class="privacy-cols">
          <?php foreach ($cards as $c): ?>
            <?php
              $ct = (string)($c['title'] ?? '');
              $cp = (string)($c['text'] ?? '');
              $list = is_array($c['list'] ?? null) ? $c['list'] : [];
              if ($ct === '' && $cp === '' && empty($list)) continue;
            ?>
            <div class="privacy-col">
              <?php if ($ct): ?><h3 class="privacy-h3"><?= h($ct) ?></h3><?php endif; ?>
              <?php if ($cp): ?><p class="privacy-p"><?= h($cp) ?></p><?php endif; ?>
              <?php if (!empty($list)): ?>
                <ul class="privacy-list">
                  <?php foreach ($list as $li): ?><li><?= h((string)$li) ?></li><?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- USE / SHARE -->
  <?php if (!empty($useShare)): ?>
    <?php
      $id = (string)($useShare['id'] ?? 'use');
      $title = (string)($useShare['title'] ?? '');
      $text = (string)($useShare['text'] ?? '');
      $items = is_array($useShare['items'] ?? null) ? $useShare['items'] : [];
      $note = (string)($useShare['note'] ?? '');
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>
        <?php if ($text): ?><p class="privacy-p"><?= h($text) ?></p><?php endif; ?>

        <?php if (!empty($items)): ?>
          <ul class="privacy-list">
            <?php foreach ($items as $li): ?><li><?= h((string)$li) ?></li><?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if ($note): ?>
          <p class="privacy-note"><?= h($note) ?></p>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- ACCESS (PLAIN — no dropdowns) -->
  <?php if (!empty($access)): ?>
    <?php
      $id = (string)($access['id'] ?? 'access');
      $title = (string)($access['title'] ?? '');
      $accordions = is_array($access['accordions'] ?? null) ? $access['accordions'] : [];
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>

        <?php foreach ($accordions as $acc): ?>
          <?php
            $at = (string)($acc['title'] ?? '');
            $ap = (string)($acc['text'] ?? '');
            if ($at === '' && $ap === '') continue;
          ?>
          <?php if ($at): ?><h3 class="privacy-h3"><?= h($at) ?></h3><?php endif; ?>
          <?php if ($ap): ?><p class="privacy-p"><?= h($ap) ?></p><?php endif; ?>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- RETENTION -->
  <?php if (!empty($retention)): ?>
    <?php
      $id = (string)($retention['id'] ?? 'retention');
      $title = (string)($retention['title'] ?? '');
      $text = (string)($retention['text'] ?? '');
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>
        <?php if ($text): ?><p class="privacy-p"><?= h($text) ?></p><?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- SHARING -->
  <?php if (!empty($sharing)): ?>
    <?php
      $id = (string)($sharing['id'] ?? 'sharing');
      $title = (string)($sharing['title'] ?? '');
      $text = (string)($sharing['text'] ?? '');
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>
        <?php if ($text): ?><p class="privacy-p"><?= h($text) ?></p><?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- RIGHTS -->
  <?php if (!empty($rights)): ?>
    <?php
      $id = (string)($rights['id'] ?? 'rights');
      $title = (string)($rights['title'] ?? '');
      $paras = is_array($rights['paragraphs'] ?? null) ? $rights['paragraphs'] : [];
      $bulletsTitle = (string)($rights['bullets_title'] ?? '');
      $bullets = is_array($rights['bullets'] ?? null) ? $rights['bullets'] : [];
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>

        <?php if (!empty($paras)): ?>
          <?php foreach ($paras as $p): ?>
            <p class="privacy-p"><?= h((string)$p) ?></p>
          <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($bulletsTitle): ?><h3 class="privacy-h3"><?= h($bulletsTitle) ?></h3><?php endif; ?>
        <?php if (!empty($bullets)): ?>
          <ul class="privacy-list">
            <?php foreach ($bullets as $b): ?><li><?= h((string)$b) ?></li><?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- SECURITY -->
  <?php if (!empty($security)): ?>
    <?php
      $id = (string)($security['id'] ?? 'security');
      $title = (string)($security['title'] ?? '');
      $text = (string)($security['text'] ?? '');
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>
        <?php if ($text): ?><p class="privacy-p"><?= h($text) ?></p><?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- COOKIES -->
  <?php if (!empty($cookies)): ?>
    <?php
      $id = (string)($cookies['id'] ?? 'cookies');
      $title = (string)($cookies['title'] ?? '');
      $text = (string)($cookies['text'] ?? '');
    ?>
    <section class="privacy-section" id="<?= h($id) ?>">
      <div class="container">
        <?php if ($title): ?><h2 class="privacy-h2"><?= h($title) ?></h2><?php endif; ?>
        <?php if ($text): ?><p class="privacy-p"><?= h($text) ?></p><?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

</section>
