<?php
$foot = $S['footer'] ?? [];
$site = $S['site'] ?? [];
?>
</main>

<footer class="site-footer">
  <div class="footer__gradient" aria-hidden="true"></div>

  <div class="container footer__grid">
    <!-- Brand -->
    <div class="footer__col">
      <div class="footer-brand">
        <img class="footer-logo" src="assets/images/Heng_ren_tang_favicon.ico" alt="<?=h($site['brand'] ?? 'Heng Ren Tang')?>" />
        <div>
          <div class="footer-brand__name"><?=h($site['brand'] ?? 'Heng Ren Tang')?></div>
          <div class="footer-brand__tagline"><?=h($site['tagline'] ?? '')?></div>
        </div>
      </div>

      <?php if (!empty($foot['blurb'])): ?>
        <p class="muted"><?=h($foot['blurb'])?></p>
      <?php endif; ?>

      <p class="muted small"><?=h($foot['credits'] ?? '')?></p>
    </div>

    <!-- Contact -->
    <div class="footer__col">
      <h4 class="footer__title"><?=h($foot['contact_title'] ?? 'Contact')?></h4>
      <p class="muted"><?=safe_html($foot['address_html'] ?? '')?></p>
      <p class="muted"><?=safe_html($foot['contact_html'] ?? '')?></p>
      <div class="actions">
        <a class="btn btn--primary btn--sm" href="<?=h($appointment_url)?>" target="_blank" rel="noopener">
          <?=h($nav['appointment_label'] ?? 'Make an Appointment')?>
        </a>
        <a class="btn btn--ghost btn--sm" href="<?=h(page_url($base_url,$lang,'contact'))?>">
          <?=h($nav['contact_label'] ?? 'Contact')?>
        </a>
      </div>
    </div>

    <!-- Links + Partnership -->
    <!-- Links -->
    <div class="footer__col">
      <h4 class="footer__title"><?=h($foot['links_title'] ?? 'Quick links')?></h4>
      <div class="footer__links">
        <a href="<?=h(page_url($base_url,$lang,'home'))?>">Home</a>
        <a href="<?=h(page_url($base_url,$lang,'services'))?>">Services</a>
        <a href="<?=h(page_url($base_url,$lang,'staff'))?>">Staff</a>
        <a href="<?=h(page_url($base_url,$lang,'privacy'))?>">Privacy</a>
        <a href="<?=h(page_url($base_url,$lang,'contact'))?>">Contact</a>
      </div>
    </div>

  </div> <!-- end .container.footer__grid -->

  <?php if (!empty($foot['partnership'])): ?>
    <div class="container footer__partner">
      <div class="footer-partnership">
        <div class="footer-partnership__copy">
          <h4 class="footer__title"><?=h($foot['partnership']['title'] ?? 'Partnership')?></h4>
          <p class="muted"><?=h($foot['partnership']['paragraph'] ?? '')?></p>
        </div>

        <div class="footer-partnership__logos" aria-label="Partnership logos">
          <div class="partner-logo">
            <img src="assets/images/zhong-logo.svg" alt="ZHONG logo" loading="lazy" />
          </div>
          <div class="partner-logo">
            <img src="assets/images/scag-logo.png" alt="SCAG logo" loading="lazy" />
          </div>
          <div class="partner-logo">
            <img src="assets/images/kab-logo.png" alt="KAB logo" loading="lazy" />
          </div>
          <a class="partner-logo" href="https://www.lvnt.nl/" target="_blank" rel="noopener" aria-label="Visit the LVNT website">
            <img src="assets/images/lvnt-logo.svg" alt="LVNT logo" loading="lazy" />
          </a>
          <a class="partner-logo" href="https://rbcz.nu/" target="_blank" rel="noopener" aria-label="Visit the RBCZ website">
            <img src="assets/images/rbcz-logo.png" alt="RBCZ — een vrije zorgkeuze" loading="lazy" />
          </a>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="container footer__bottom">
    <span class="muted small">© <?=date('Y')?> <?=h($site['brand'] ?? 'Heng Ren Tang')?>.</span>
    <a class="text-link small" href="#main">Back to top</a>
  </div>
</footer>

<script src="assets/js/app.js" defer></script>
</body>
</html>
