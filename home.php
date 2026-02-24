<?php
declare(strict_types=1);

require_once __DIR__ . '/php/debug.php';

dbg_panel_start('Home Debug');

dbg('L keys', array_keys($L ?? []));
dbg('hero exists?', isset($L['hero']) ? 'YES' : 'NO');
dbg('hero.title', $L['hero']['title'] ?? '(missing)');
dbg('treatments exists?', isset($L['treatments']) ? 'YES' : 'NO');
dbg('about exists?', isset($L['about']) ? 'YES' : 'NO');

dbg_panel_end();

$hero = $L['hero'] ?? [];
$t    = $L['treatments'] ?? [];
$a    = $L['about'] ?? [];
$fi   = $L['fees_insurance'] ?? [];
$bm   = $L['balance_method'] ?? [];
$teamLocal  = $L['team'] ?? [];   // title/subtitle/buttons (home.json)
$teamShared = $S['team'] ?? [];   // members list (shared.json)
$loc  = $L['location'] ?? [];
$pol  = $L['policies']['cancel_reschedule'] ?? null;
$faq  = $L['faq'] ?? [];
$ui   = $L['ui'] ?? [];

// HERO media assets (logo unchanged sitewide)
$heroLogo = 'assets/images/Heng_ren_tang_logo.png';

// Images
$heroBg         = 'assets/images/Home_Hero_bg.png';
$aboutImgTop    = 'assets/images/Home_About_top.png';
$aboutImgBottom = 'assets/images/Home_About_bottom.png';
$bmImg          = 'assets/images/Home_BalanceMethod_media.png';

// Partner logos
$feesLogoA = 'assets/images/Zhong Logo.png';
$feesLogoB = 'assets/images/SCAG Logo.png';

/**
 * Helper: build internal href from a CTA object.
 * Supports: { page: "contact", anchor: "contact" } OR fallback { url: "..." }
 */
$cta_href = function(array $cta) use ($base_url, $lang): string {
  if (!empty($cta['page'])) {
    $href = page_url($base_url, $lang, (string)$cta['page']);
    if (!empty($cta['anchor'])) $href .= '#' . ltrim((string)$cta['anchor'], '#');
    return $href;
  }
  if (!empty($cta['url'])) return (string)$cta['url'];
  if (!empty($cta['anchor'])) return '#' . ltrim((string)$cta['anchor'], '#');
  return '#';
};

// Resolve hero CTAs (prefer JSON structure; fallback to old labels)
$heroPrimary = is_array($hero['primary_cta'] ?? null) ? $hero['primary_cta'] : ['page'=>'contact'];
$heroSecond  = is_array($hero['secondary_cta'] ?? null) ? $hero['secondary_cta'] : ['page'=>'contact'];
$heroThird   = is_array($hero['tertiary_cta'] ?? null) ? $hero['tertiary_cta'] : ['page'=>'services'];

$heroPrimaryHref = $cta_href($heroPrimary);
$heroSecondHref  = $cta_href($heroSecond);
$heroThirdHref   = $cta_href($heroThird);
?>

<section class="page page--home">

  <!-- HERO -->
  <section class="section section--hero" style="--hero-bg: url('../images/Home_Hero_bg.png');">
    <div class="container hero">
      <div class="hero__copy">
        <h1 class="h1"><?=h((string)($hero['title'] ?? ''))?></h1>
        <p class="lead"><?=h((string)($hero['subtitle'] ?? ''))?></p>
        <p class="body"><?=h((string)($hero['paragraph'] ?? ''))?></p>

        <div class="actions">
          <a class="btn btn--primary" href="<?=h($heroPrimaryHref)?>">
            <?=h((string)($heroPrimary['label'] ?? $hero['primary_button_label'] ?? ($ui['buttons']['make_appointment'] ?? 'Make an Appointment')))?>
          </a>

          <a class="btn btn--ghost" href="<?=h($heroSecondHref)?>">
            <?=h((string)($heroSecond['label'] ?? $hero['secondary_button_label'] ?? ($ui['buttons']['contact'] ?? 'Contact')))?>
          </a>

          <a class="btn btn--soft" href="<?=h($heroThirdHref)?>">
            <?=h((string)($heroThird['label'] ?? ($ui['buttons']['services'] ?? 'Services')))?>
          </a>
        </div>

        <div class="chips" role="list">
          <?php foreach (($hero['trust_chips'] ?? []) as $chip): ?>
            <span class="chip" role="listitem"><?=h((string)$chip)?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="hero__media">
        <div class="hero-media">
          <div class="hero-media__inner">
            <img class="hero-media__logo" src="<?=h($heroLogo)?>" alt="Heng Ren Tang logo" loading="lazy" />
          </div>
        </div>
      </div>
    </div>

    <div class="band band--a" aria-hidden="true"></div>
  </section>

  <!-- TREATMENTS -->
  <section class="section section--treatments section-band band--mint" id="treatments">
    <div class="container">
      <header class="section__head">
        <h2 class="h2"><?=h((string)($t['title'] ?? ''))?></h2>
        <p class="muted"><?=h((string)($t['subtitle'] ?? ''))?></p>
      </header>

      <div class="pill-grid">
        <?php foreach (($t['items'] ?? []) as $item): ?>
          <div class="pill"><?=h((string)$item)?></div>
        <?php endforeach; ?>
      </div>

      <div class="note-card">
        <p class="body"><?=h((string)($t['note'] ?? ''))?></p>
        <div class="actions">
          <a class="btn btn--primary" href="<?=h(page_url($base_url,$lang,'contact'))?>">
            <?=h((string)($ui['buttons']['contact'] ?? 'Contact'))?>
          </a>
          <a class="btn btn--soft" href="<?=h(page_url($base_url,$lang,'services'))?>">
            <?=h((string)($ui['buttons']['view_services'] ?? 'View services'))?>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <?php
    $p0 = $a['paragraphs'][0] ?? '';
    $p1 = $a['paragraphs'][1] ?? '';
    $p2 = $a['paragraphs'][2] ?? '';
    $jump = $a['jump_prompt'] ?? null;

    // jump_prompt supports either:
    // - { "html": "...", "cta": {page:"contact"} }
    // - legacy string (rendered as safe html)
    $jumpHtml = '';
    $jumpCta  = null;

    if (is_array($jump)) {
      $jumpHtml = (string)($jump['html'] ?? '');
      $jumpCta  = is_array($jump['cta'] ?? null) ? $jump['cta'] : null;
    } else {
      // legacy string
      $jumpHtml = (string)$jump;
    }
  ?>
  <section class="section section--about" id="about">
    <div class="container">
      <header class="section__head">
        <h2 class="h2"><?=h((string)($a['title'] ?? ''))?></h2>
      </header>

      <div class="about-split">
        <!-- Row 1 -->
        <div class="about-row">
          <div class="about-cell about-media">
            <figure class="media-card">
              <img src="<?=h($aboutImgTop)?>" alt="" loading="lazy" aria-hidden="true" />
            </figure>
          </div>

          <div class="about-cell about-content">
            <div class="stack">
              <?php if ($p0): ?><p class="body"><?=h((string)$p0)?></p><?php endif; ?>
              <?php if ($p1): ?><p class="body"><?=h((string)$p1)?></p><?php endif; ?>
              <?php if ($p2): ?><p class="body"><?=h((string)$p2)?></p><?php endif; ?>

              <?php if ($jumpHtml): ?>
                <div class="callout" role="note">
                  <div class="callout__inner">
                    <div class="muted"><?= $jumpHtml ?></div>
                    <?php if ($jumpCta): ?>
                      <a class="btn btn--soft" href="<?=h($cta_href($jumpCta))?>">
                        <?=h((string)($jumpCta['label'] ?? ($ui['buttons']['contact'] ?? 'Contact')))?>
                      </a>
                    <?php else: ?>
                      <a class="btn btn--soft" href="<?=h(page_url($base_url,$lang,'contact'))?>">
                        <?=h((string)($ui['buttons']['contact'] ?? 'Contact'))?>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endif; ?>

              <div class="actions">
                <!-- FIX: 'about' is not a valid page route. Use in-page anchor instead -->
                <a class="btn btn--soft" href="#about">
                  <?=h((string)($ui['buttons']['about_section'] ?? 'About'))?>
                </a>
                <a class="btn btn--soft" href="<?=h(page_url($base_url,$lang,'staff'))?>">
                  <?=h((string)($ui['buttons']['staff_page'] ?? 'Staff page'))?>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="about-row about-row--reverse">
          <div class="about-cell about-content">
            <div class="stack">
              <div class="card-grid">
                <?php foreach (($a['highlights'] ?? []) as $hl): ?>
                  <article class="card">
                    <h3 class="h3"><?=h((string)($hl['title'] ?? ''))?></h3>
                    <p class="muted"><?=h((string)($hl['text'] ?? ''))?></p>
                  </article>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <div class="about-cell about-media">
            <figure class="media-card">
              <img src="<?=h($aboutImgBottom)?>" alt="" loading="lazy" aria-hidden="true" />
            </figure>
          </div>
        </div>
      </div>
    </div>

    <div class="band band--b" aria-hidden="true"></div>
  </section>

  <!-- FEES & INSURANCE -->
  <section class="section section--fees section-band band--butter" id="fees-insurance">
    <div class="container">
      <header class="section__head">
        <h2 class="h2"><?=h((string)($fi['title'] ?? ''))?></h2>
      </header>

      <div class="two-col cards-2">
        <?php foreach (($fi['cards'] ?? []) as $card): ?>
          <article class="card">
            <h3 class="h3"><?=h((string)($card['title'] ?? ''))?></h3>

            <?php if (!empty($card['items'])): ?>
              <ul class="list">
                <?php foreach ($card['items'] as $it): ?>
                  <li>
                    <span class="muted"><?=h((string)($it['label'] ?? ''))?></span>
                    <span class="value"><?=h((string)($it['value'] ?? ''))?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <?php if (!empty($card['notes'])): ?>
              <?php foreach ($card['notes'] as $n): ?>
                <p class="muted small"><?=h((string)$n)?></p>
              <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($card['paragraphs'])): ?>
              <?php foreach ($card['paragraphs'] as $p): ?>
                <p class="body"><?=h((string)$p)?></p>
              <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($card['links'])): ?>
              <?php foreach ($card['links'] as $ln): ?>
                <?php
                  $href = (string)($ln['url'] ?? '#');
                  $isExternal = (bool)($ln['external'] ?? true);
                ?>
                <a class="text-link"
                   href="<?=h($href)?>"
                   <?= $isExternal ? 'target="_blank" rel="noopener"' : '' ?>>
                   <?=h((string)($ln['label'] ?? 'Link'))?>
                </a>
              <?php endforeach; ?>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="partner-strip partner-strip--fees" aria-label="Partnership logos">
          <div class="partner-logo">
            <img src="assets/images/Zhong Logo.png" alt="ZHONG logo" loading="lazy" />
          </div>
          <div class="partner-logo">
            <img src="assets/images/SCAG Logo.png" alt="SCAG logo" loading="lazy" />
          </div>
          <div class="partner-logo">
            <img src="assets/images/KAB Logo.png" alt="SCAG logo" loading="lazy" />
          </div>
      </div>
    </div>
  </section>

  <!-- BALANCE METHOD -->
  <section class="section section--balance section-band band--lavender" id="balance-method">
    <div class="container">
      <div class="two-col two-col--media-left">
        <div class="card bm-media">
          <img src="<?=h($bmImg)?>" alt="" loading="lazy" aria-hidden="true" />
        </div>

        <div class="stack">
          <h2 class="h2"><?=h((string)($bm['title'] ?? ''))?></h2>

          <?php foreach (($bm['paragraphs'] ?? []) as $p): ?>
            <p class="body"><?=h((string)$p)?></p>
          <?php endforeach; ?>

          <p class="muted small"><?=h((string)($bm['disclaimer'] ?? ''))?></p>

          <div class="actions">
            <a class="btn btn--primary" href="<?=h(page_url($base_url,$lang,'services'))?>">
              <?=h((string)($ui['buttons']['services'] ?? 'Services'))?>
            </a>
            <a class="btn btn--ghost" href="#faq">
              <?=h((string)($ui['buttons']['faq'] ?? 'FAQ'))?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TEAM -->
  <section class="section section--team" id="team">
    <div class="container">
      <header class="section__head section-head section-head--split">
        <div class="section-head__copy">
          <h2 class="h2"><?=h((string)($teamLocal['title'] ?? ''))?></h2>
          <p class="muted"><?=h((string)($teamLocal['subtitle'] ?? ''))?></p>
        </div>

        <div class="section-head__actions">
          <a class="btn btn--soft" href="<?=h(page_url($base_url,$lang,'staff'))?>">
            <?=h((string)($ui['buttons']['staff_page'] ?? 'Staff page'))?>
          </a>
          <a class="btn btn--primary" href="<?=h(page_url($base_url,$lang,'contact'))?>">
            <?=h((string)($ui['buttons']['appointments'] ?? 'Appointments'))?>
          </a>
        </div>
      </header>

      <div class="team-grid">
        <?php foreach (($teamShared['members'] ?? []) as $m): ?>
          <?php
            $img = (string)($m['image'] ?? '');
            $imgPath = $img ? (__DIR__ . '/' . ltrim($img, '/')) : '';
            $imgFinal = ($imgPath && file_exists($imgPath)) ? $img : 'assets/images/Heng_ren_tang_logo.png';
          ?>
          <article class="card team-card">
            <div class="team-card__head">
              <div class="team-card__avatar">
                <img src="<?=h($imgFinal)?>" alt="<?=h((string)(($m['name'] ?? 'Acupuncturist') . ' profile photo'))?>" loading="lazy" />
              </div>

              <div class="team-card__meta">
                <h3 class="h3 team-card__name"><?=h((string)($m['name'] ?? ''))?></h3>

                <?php if (!empty($m['membership'])): ?>
                  <div class="badges">
                    <?php foreach (($m['membership'] ?? []) as $mb): ?>
                      <span class="badge"><?=h((string)(($mb['org'] ?? '') . ': ' . ($mb['id'] ?? '')))?></span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <?php if (!empty($m['availability'])): ?>
              <div class="schedule">
                <?php foreach (($m['availability'] ?? []) as $av): ?>
                  <div class="row">
                    <span class="muted"><?=h((string)($av['day'] ?? ''))?></span>
                    <span><?=h((string)($av['time'] ?? ''))?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="band band--c" aria-hidden="true"></div>
  </section>

  <!-- LOCATION -->
  <section class="section section--location" id="location">
    <div class="container">
      <div class="two-col">
        <div class="stack">
          <h2 class="h2"><?=h((string)($loc['title'] ?? ''))?></h2>

          <div class="card">
            <h3 class="h3"><?=h((string)($ui['labels']['address'] ?? 'Address'))?></h3>
            <p class="body"><?= $loc['address_html'] ?? '' ?></p>

            <h3 class="h3"><?=h((string)($ui['labels']['contact'] ?? 'Contact'))?></h3>
            <p class="body"><?= $loc['contact_html'] ?? '' ?></p>

            <div class="actions">
              <a class="btn btn--primary" href="<?=h(page_url($base_url,$lang,'contact'))?>">
                <?=h((string)($ui['buttons']['make_appointment'] ?? 'Make an Appointment'))?>
              </a>
              <a class="btn btn--ghost" href="<?=h(page_url($base_url,$lang,'contact'))?>">
                <?=h((string)($ui['buttons']['contact'] ?? 'Contact'))?>
              </a>
            </div>
          </div>
        </div>

        <div class="card map-card">
          <h3 class="h3"><?=h((string)($ui['labels']['map'] ?? 'Map'))?></h3>
          <div class="map-embed">
            <iframe
              src="<?=h((string)($loc['map_iframe_src'] ?? ''))?>"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              allowfullscreen=""
              title="<?=h((string)($loc['map_title'] ?? 'Map'))?>"
            ></iframe>
          </div>
        </div>
      </div>

      <?php if ($pol): ?>
        <div class="policy" id="contact">
          <div class="card">
            <h3 class="h3"><?=h((string)($pol['title'] ?? ''))?></h3>
            <p class="muted"><?=h((string)($pol['paragraph'] ?? ''))?></p>
            <div class="actions">
              <a class="btn btn--primary" href="<?=h(page_url($base_url,$lang,'contact'))?>">
                <?=h((string)($ui['buttons']['contact'] ?? 'Contact'))?>
              </a>
              <a class="btn btn--soft" href="<?=h(page_url($base_url,$lang,'privacy'))?>">
                <?=h((string)($ui['buttons']['privacy'] ?? 'Privacy'))?>
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="band band--d" aria-hidden="true"></div>
  </section>

  <!-- FAQ -->
  <section class="section section--faq section-band band--sky" id="faq">
    <div class="container">
      <header class="section__head">
        <h2 class="h2"><?=h((string)($faq['title'] ?? ''))?></h2>
        <p class="muted"><?=h((string)($faq['subtitle'] ?? ''))?></p>
      </header>

      <div class="faq">
        <?php foreach (($faq['categories'] ?? []) as $cat): ?>
          <div class="faq-cat">
            <button class="faq-cat__header" type="button" data-faq-cat>
              <span class="faq-cat__title"><?=h((string)($cat['title'] ?? ''))?></span>
              <span class="faq-cat__icon" aria-hidden="true">+</span>
            </button>

            <div class="faq-cat__body" hidden>
              <?php foreach (($cat['items'] ?? []) as $it): ?>
                <div class="faq-item">
                  <button class="faq-q" type="button" data-faq-q aria-expanded="false">
                    <span><?=h((string)($it['q'] ?? ''))?></span>
                    <span class="faq-icon" aria-hidden="true">+</span>
                  </button>
                  <div class="faq-a" hidden>
                    <p class="muted"><?=h((string)($it['a'] ?? ''))?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <?php
        $cta = $faq['closing_cta'] ?? [];
        $ctaPrimary = is_array($cta['primary'] ?? null) ? $cta['primary'] : ['page'=>'contact'];
        $ctaSecond  = is_array($cta['secondary'] ?? null) ? $cta['secondary'] : ['page'=>'contact','anchor'=>'contact'];
      ?>
      <div class="callout callout--wide">
        <div class="callout__inner">
          <div>
            <h3 class="h3"><?=h((string)($cta['title'] ?? 'Still have questions?'))?></h3>
            <p class="muted"><?=h((string)($cta['text'] ?? ''))?></p>
          </div>
          <div class="actions">
            <a class="btn btn--primary" href="<?=h($cta_href($ctaPrimary))?>">
              <?=h((string)($ctaPrimary['label'] ?? ($ui['buttons']['contact'] ?? 'Contact')) )?>
            </a>
            <a class="btn btn--ghost" href="<?=h($cta_href($ctaSecond))?>">
              <?=h((string)($ctaSecond['label'] ?? ($ui['buttons']['make_appointment'] ?? 'Make an Appointment')) )?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</section>
