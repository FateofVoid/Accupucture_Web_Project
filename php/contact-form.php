<?php
declare(strict_types=1);

/**
 * php/contact-form.php
 * Reusable Formspree form.
 *
 * Does NOT depend on $L or $S.
 *
 * Expects (from the page that includes it):
 *  - $base_url, $lang, $page (for redirect + language scope)
 *  - helper h(), page_url()
 *
 * Optional:
 *  - $contactFormAnchor (string) section id override (defaults to json form.id)
 */

// Load JSON independently (json lives in /localization from project root)
$contactFormPath = __DIR__ . '/../localization/contact-form.json';
$raw = is_file($contactFormPath) ? file_get_contents($contactFormPath) : false;
$all = $raw ? json_decode($raw, true) : null;

// Fallback language
if (!is_array($all)) $all = [];
$scope = $all[$lang] ?? $all['en'] ?? [];
$form  = is_array($scope['form'] ?? null) ? $scope['form'] : [];
$ui    = is_array($scope['ui'] ?? null) ? $scope['ui'] : [];

// Helpers
$getStr = function (array $arr, array $path, string $fallback = ''): string {
  $cur = $arr;
  foreach ($path as $k) {
    if (!is_array($cur) || !array_key_exists($k, $cur)) return $fallback;
    $cur = $cur[$k];
  }
  return is_string($cur) ? $cur : $fallback;
};

$action = (string)($form['action'] ?? '');
$formId = (string)($form['id'] ?? 'contact-form');
if (!empty($contactFormAnchor) && is_string($contactFormAnchor)) $formId = $contactFormAnchor;

// Copy
$title      = (string)($form['title'] ?? '');
$lead       = (string)($form['lead'] ?? '');
$intro      = (string)($form['intro'] ?? '');
$thanksHint = (string)($form['thank_you_hint'] ?? '');
$footerNote = (string)($form['footer_note'] ?? '');

$fields = is_array($form['fields'] ?? null) ? $form['fields'] : [];
$submitLabel = (string)($form['submit_label'] ?? 'Send');

$requiredNote = (string)($ui['required_note'] ?? '');
$errRequired  = (string)($ui['error_required'] ?? 'Please fill in all required fields.');
$errEmail     = (string)($ui['error_email'] ?? 'Please enter a valid email address.');

// Optional: readable meta labels (translatable via JSON, with fallbacks)
$metaSourceLabel = (string)($ui['meta_source_label'] ?? 'Source page');
$metaLangLabel   = (string)($ui['meta_lang_label'] ?? 'Language');

// Fields
$msg   = is_array($fields['Message'] ?? null) ? $fields['Message'] : [];
$name  = is_array($fields['Name'] ?? null) ? $fields['Name'] : [];
$phone = is_array($fields['Phone'] ?? null) ? $fields['Phone'] : [];
$email = is_array($fields['Email'] ?? null) ? $fields['Email'] : [];

?>
<section class="section section--contact-form" id="<?= h($formId) ?>">
  <div class="container contact-form-wrap">

    <!-- ONE unified surface -->
    <div class="contact-form-surface">

      <?php if ($title): ?><h2 class="h2 contact-form-title"><?= h($title) ?></h2><?php endif; ?>
      <?php if ($lead): ?><p class="lead contact-form-lead"><?= h($lead) ?></p><?php endif; ?>
      <?php if ($intro): ?><p class="body muted contact-form-intro"><?= h($intro) ?></p><?php endif; ?>
      <?php if ($thanksHint): ?><p class="muted contact-form-hint"><?= h($thanksHint) ?></p><?php endif; ?>

      <form
        class="contact-form"
        method="POST"
        action="<?= h($action) ?>"
        data-contact-form
        data-i18n-required="<?= h($errRequired) ?>"
        data-i18n-email="<?= h($errEmail) ?>"
      >
        <!-- Formspree reserved fields -->
        <input type="hidden" name="Subject" value="Heng Ren Tang — Contact form" />

        <!-- Human-readable meta (kept on purpose, easier emails) -->
        <input type="hidden" name="<?= h($metaSourceLabel) ?>" value="<?= h((string)$page) ?>" />
        <input type="hidden" name="<?= h($metaLangLabel) ?>" value="<?= h((string)$lang) ?>" />

        <!-- Honeypot (Formspree convention). This won’t show up as “website” anymore. -->
        <div class="contact-hp" aria-hidden="true">
          <label>Leave this empty<input type="text" name="_gotcha" tabindex="-1" autocomplete="off"></label>
        </div>

        <label class="contact-field">
          <span class="contact-label"><?= h((string)($msg['label'] ?? 'Message')) ?></span>
          <textarea
            class="contact-input contact-textarea"
            name="<?= h((string)($msg['name'] ?? 'Message')) ?>"
            placeholder="<?= h((string)($msg['placeholder'] ?? '')) ?>"
            rows="7"
            <?= !empty($msg['required']) ? 'required' : '' ?>
          ></textarea>
        </label>

        <div class="contact-row">
          <label class="contact-field">
            <span class="contact-label"><?= h((string)($name['label'] ?? 'Name')) ?></span>
            <input
              class="contact-input"
              type="text"
              name="<?= h((string)($name['name'] ?? 'Name')) ?>"
              placeholder="<?= h((string)($name['placeholder'] ?? '')) ?>"
              <?= !empty($name['required']) ? 'required' : '' ?>
              autocomplete="name"
            />
          </label>

          <label class="contact-field">
            <span class="contact-label"><?= h((string)($phone['label'] ?? 'Phone')) ?></span>
            <input
              class="contact-input"
              type="tel"
              name="<?= h((string)($phone['name'] ?? 'Phone')) ?>"
              placeholder="<?= h((string)($phone['placeholder'] ?? '')) ?>"
              <?= !empty($phone['required']) ? 'required' : '' ?>
              autocomplete="tel"
            />
          </label>
        </div>

        <label class="contact-field">
          <span class="contact-label"><?= h((string)($email['label'] ?? 'Email')) ?></span>
          <input
            class="contact-input"
            type="email"
            name="<?= h((string)($email['name'] ?? 'Email')) ?>"
            placeholder="<?= h((string)($email['placeholder'] ?? '')) ?>"
            <?= !empty($email['required']) ? 'required' : '' ?>
            autocomplete="email"
          />
        </label>

        <?php if ($footerNote): ?>
          <p class="muted contact-form-footnote"><?= h($footerNote) ?></p>
        <?php endif; ?>

        <div class="contact-actions">
          <button class="btn btn--primary" type="submit" data-contact-submit><?= h($submitLabel) ?></button>

          <?php if ($requiredNote): ?>
            <div class="muted small"><?= h($requiredNote) ?></div>
          <?php endif; ?>

          <div class="contact-error muted small" data-contact-error hidden></div>
        </div>
      </form>
    </div>
  </div>
</section>