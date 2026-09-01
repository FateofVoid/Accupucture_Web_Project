<?php
// expects: $base_url, $lang, $page, $page_title, $S, $L

$nav  = $S['nav'] ?? [];
$site = $S['site'] ?? [];

// Remove contact from page links (we already have CTA buttons)
$pages = [
  ['id'=>'home',     'label'=>($nav['home_label'] ?? 'Home'),         'url'=>page_url($base_url,$lang,'home')],
  ['id'=>'services', 'label'=>($nav['services_label'] ?? 'Services'), 'url'=>page_url($base_url,$lang,'services')],
  ['id'=>'staff',    'label'=>($nav['staff_label'] ?? 'Staff'),       'url'=>page_url($base_url,$lang,'staff')],
  ['id'=>'privacy',  'label'=>'Privacy',                              'url'=>page_url($base_url,$lang,'privacy')],
];

$anchors = $L['meta']['nav_anchors'] ?? [];

$brand   = $site['brand'] ?? 'Heng Ren Tang';
$tagline = $site['tagline'] ?? ''; // add this in shared.json (see below)

// Language switcher
$langOptions = [
  'en' => ['label' => 'English',    'icon' => 'assets/images/icon-en.png'],
  'nl' => ['label' => 'Nederlands', 'icon' => 'assets/images/icon-nl.png'],
  'es' => ['label' => 'Español',    'icon' => 'assets/images/icon-es.png'],
];

$currentLangIcon = $langOptions[$lang]['icon'] ?? $langOptions['en']['icon'];
$canonicalUrl = page_url($base_url, $lang, $page);
$metaDescription = trim((string)($L['hero']['subtitle'] ?? $site['tagline'] ?? ''));
if ($metaDescription === '') {
  $metaDescription = 'Heng Ren Tang Acupuncture Clinic in Almere. Personal acupuncture care using the Balance Method.';
}
?>
<!doctype html>
<html lang="<?=h($lang)?>">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="<?=h($metaDescription)?>" />
  <title><?=h($page_title)?></title>
  <link rel="canonical" href="<?=h($canonicalUrl)?>" />
  <?php foreach (array_keys($langOptions) as $alternateLang): ?>
    <link rel="alternate" hreflang="<?=h($alternateLang)?>" href="<?=h(page_url($base_url,$alternateLang,$page))?>" />
  <?php endforeach; ?>
  <link rel="alternate" hreflang="x-default" href="<?=h(page_url($base_url,'en',$page))?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?=h($page_title)?>" />
  <meta property="og:description" content="<?=h($metaDescription)?>" />
  <meta property="og:url" content="<?=h($canonicalUrl)?>" />
  <meta property="og:image" content="<?=h($base_url . '/assets/images/Heng_ren_tang_logo.png')?>" />
  <link rel="stylesheet" href="assets/css/styles.css" />

  <link rel="icon" href="assets/images/Heng_ren_tang_favicon.ico" type="image/x-icon" />

  <link rel="preload" as="image" href="assets/images/Heng_ren_tang_logo.png" />
  <link rel="preload" as="image" href="assets/images/Heng_ren_tang_logo_no_text.png" />
  <link rel="preload" as="image" href="assets/images/icon-en.png" />
  <link rel="preload" as="image" href="assets/images/icon-nl.png" />
  <link rel="preload" as="image" href="assets/images/icon-es.png" />

</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" data-header>
  <div class="container header__inner">
    <a class="brand" href="<?=h(page_url($base_url,$lang,'home'))?>">
      <!-- header should use no-text logo -->
      <img
        class="brand__logo"
        src="assets/images/Heng_ren_tang_logo_no_text.png"
        alt="<?=h($brand)?>"
      />
      <span class="brand__text">
        <span class="brand__name"><?=h($brand)?></span>
        <span class="brand__tagline"><?=h($tagline)?></span>
      </span>
    </a>

    <button class="burger" type="button" aria-label="Open menu" aria-expanded="false" data-burger>
      <span></span><span></span><span></span>
    </button>

    <nav class="site-nav" aria-label="Primary navigation" data-nav>
      <div class="nav__group nav__pages">
        <?php foreach ($pages as $p): ?>
          <a class="nav__link <?=($page===($p['id']??''))?'is-active':''?>" href="<?=h($p['url'] ?? '#')?>"><?=h($p['label'] ?? '')?></a>
        <?php endforeach; ?>
      </div>

      <?php if (!empty($anchors) && $page === 'home'): ?>
        <div class="nav__divider" aria-hidden="true"></div>

        <div class="nav__group nav__anchors">
          <div class="nav-dropdown" data-nav-dd>
            <button class="nav-dd-btn" type="button" aria-haspopup="listbox" aria-expanded="false" data-nav-dd-toggle>
              <?=h($nav['on_this_page_label'] ?? 'On this page')?> <span aria-hidden="true">▾</span>
            </button>

            <div class="nav-dd-menu" role="listbox" aria-label="On this page" data-nav-dd-menu hidden>
              <?php foreach ($anchors as $a): ?>
                <a class="nav-dd-item" role="option" href="#<?=h($a['id'])?>"><?=h($a['label'])?></a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="nav__cta">
        <!-- IMPORTANT: appointment_label_html may contain <br>, so do NOT use h() -->
        <a class="btn btn--primary" href="<?=h($appointment_url)?>" target="_blank" rel="noopener">
          <?=safe_html($nav['appointment_label_html'] ?? 'Make an Appointment')?>
        </a>
        <a class="btn btn--ghost" href="<?=h(page_url($base_url,$lang,'contact'))?>">
          <?=h($nav['contact_label'] ?? 'Contact us')?>
        </a>

        <div class="lang-switch" data-lang-switch>
          <button class="lang-btn" type="button" aria-haspopup="listbox" aria-expanded="false" data-lang-toggle>
            <img class="lang-icon" src="<?=h($currentLangIcon)?>" alt="<?=h($lang)?>" />
            <span class="lang-caret" aria-hidden="true">▾</span>
          </button>

          <div class="lang-menu" role="listbox" aria-label="Language" data-lang-menu hidden>
            <?php foreach ($langOptions as $code => $opt): ?>
              <a class="lang-option <?=($lang===$code)?'is-active':''?>"
                 role="option"
                 aria-selected="<?=($lang===$code)?'true':'false'?>"
                 href="<?=h(page_url($base_url, $code, $page))?>">
                <img class="lang-icon" src="<?=h($opt['icon'])?>" alt="<?=h($opt['label'])?>" />
                <span><?=h($opt['label'])?></span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </nav>
  </div>

  <div class="header__gradient" aria-hidden="true"></div>
</header>

<main id="main">
