<?php
// php/chat_widget.php
// Expects: $L (merged localization), $_SESSION['lang'], and helper h()

$chat = $S['chat_widget'] ?? null;
if (!$chat || empty($chat['enabled'])) {
  return;
}

$config = $chat['config'] ?? [];

// Required config
$locationId = $config['location_id'] ?? '';
if ($locationId === '') {
  // If no location id, don't render to avoid broken widget
  return;
}

$useEmailField = !empty($config['use_email_field']) ? 'true' : 'false';
$locale = $_SESSION['lang'] ?? 'en';

// Colors / style vars
$primaryColor = $config['primary_color'] ?? '#46C9F0';
$styleVars = $config['style_vars'] ?? [];

$stylePrimary = $styleVars['chat_widget_primary_color'] ?? $primaryColor;
$styleActive  = $styleVars['chat_widget_active_color']  ?? $primaryColor;
$styleBubble  = $styleVars['chat_widget_bubble_color']  ?? $primaryColor;

$styleAttr = "--chat-widget-primary-color: {$stylePrimary}; --chat-widget-active-color: {$styleActive}; --chat-widget-bubble-color: {$styleBubble};";

// Loader
$loaderSrc = $config['loader_script_src'] ?? 'https://widgets.leadconnectorhq.com/loader.js';
$resourcesUrl = $config['loader_resources_url'] ?? 'https://widgets.leadconnectorhq.com/chat-widget/loader.js';

// Optional values
$promptAvatar = $config['prompt_avatar'] ?? '';
$agencyName = $config['agency_name'] ?? '';
$agencyWebsite = $config['agency_website'] ?? '';
?>
<chat-widget
  location-id="<?=h($locationId)?>"
  style="<?=h($styleAttr)?>"
  heading="<?=h($chat['heading'] ?? '')?>"
  sub-heading="<?=h($chat['sub_heading'] ?? '')?>"
  prompt-msg="<?=h($chat['prompt_msg'] ?? '')?>"
  legal-msg="<?=h($chat['legal_msg'] ?? '')?>"
  use-email-field="<?=h($useEmailField)?>"
  revisit-prompt-msg="<?=h($chat['revisit_prompt_msg'] ?? '')?>"
  support-contact="<?=h($chat['support_contact'] ?? '')?>"
  success-msg="<?=h($chat['success_msg'] ?? '')?>"
  thank-you-msg="<?=h($chat['thank_you_msg'] ?? '')?>"
  <?php if ($promptAvatar !== ''): ?>
    prompt-avatar="<?=h($promptAvatar)?>"
  <?php endif; ?>
  <?php if ($agencyName !== ''): ?>
    agency-name="<?=h($agencyName)?>"
  <?php endif; ?>
  <?php if ($agencyWebsite !== ''): ?>
    agency-website="<?=h($agencyWebsite)?>"
  <?php endif; ?>
  locale="<?=h($locale)?>"
  send-label="<?=h($chat['send_label'] ?? 'Send message')?>"
  primary-color="<?=h($primaryColor)?>"
></chat-widget>

<script
  src="<?=h($loaderSrc)?>"
  data-resources-url="<?=h($resourcesUrl)?>"
></script>
