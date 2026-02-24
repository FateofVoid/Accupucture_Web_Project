<?php
declare(strict_types=1);

/**
 * contact-success.php
 * Uses:
 *  - $L from localisation/contact-success.json (language-scoped)
 *  - helpers: h(), page_url()
 *  - $base_url, $lang
 */

$getStr = function (array $arr, array $path, string $fallback = ''): string {
  $cur = $arr;
  foreach ($path as $k) {
    if (!is_array($cur) || !array_key_exists($k, $cur)) return $fallback;
    $cur = $cur[$k];
  }
  return is_string($cur) ? $cur : $fallback;
};

$from = isset($_GET['from']) ? preg_replace('/[^a-z\-]/i', '', (string)$_GET['from']) : '';
$validFrom = ['home','services','staff','contact','privacy','womens-health'];
if (!in_array($from, $validFrom, true)) $from = '';

$heroTitle = $getStr($L, ['hero','title'], 'Message sent');
$heroLead  = $getStr($L, ['hero','lead'], '');
$body      = $getStr($L, ['body','text'], '');
$replyNote = $getStr($L, ['body','reply_note'], '');

$btnHomeLabel = $getStr($L, ['buttons','home'], 'Back to Home');
$btnBackLabel = $getStr($L, ['buttons','back'], 'Back');

$homeUrl = page_url($base_url, $lang, 'home');
$backUrl = $from ? page_url($base_url, $lang, $from) : page_url($base_url, $lang, 'contact');

?>
<section class="page page--contact-success">
  <section class="section section-band band--sky">
    <div class="container" style="max-width: 860px;">
      <h1 class="h1"><?= h($heroTitle) ?></h1>
      <?php if ($heroLead): ?><p class="lead"><?= h($heroLead) ?></p><?php endif; ?>

      <div class="card" style="margin-top:14px;">
        <?php if ($body): ?><p class="body"><?= h($body) ?></p><?php endif; ?>
        <?php if ($replyNote): ?><p class="muted" style="margin:0;"><?= h($replyNote) ?></p><?php endif; ?>

        <div class="actions" style="margin-top:14px;">
          <a class="btn btn--primary" href="<?= h($homeUrl) ?>"><?= h($btnHomeLabel) ?></a>
          <a class="btn btn--ghost" href="<?= h($backUrl) ?>"><?= h($btnBackLabel) ?></a>
        </div>
      </div>
    </div>

    <div class="band band--b" aria-hidden="true"></div>
  </section>
</section>