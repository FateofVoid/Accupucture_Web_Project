<?php

// Load the shared localization data for the popup
$popupLocalizationData = json_decode(file_get_contents('localisation/shared_localisation.json'), true);
$popupContent = $popupLocalizationData[$_SESSION['lang']];
?>

<div class="overlay" id="overlay"></div>

<div class="popup" id="popup">
    <div class="popup-header">
        <h2><?php echo $popupContent['popup_title']; ?></h2>
        <h2><?php echo $popupContent['popup_subtitle']; ?></h2>
    </div>
    <div class="popup-content">
      <div class="popup-section left-section">
        <h3><?php echo $popupContent['popup_section_1_title']; ?></h3>
        <p><?php echo $popupContent['popup_section_1_content']; ?></p>
        <button onclick="window.open('https://bookings.crossuite.app/ef415adc-c2ee-40c8-a9e6-e1608bda93ca', '_blank')" class="appointment-button appointment-popup"><?php echo $popupContent['popup_section_1_button']; ?></button>
      </div>
      <div class="popup-section right-section">
        <h3><?php echo $popupContent['popup_section_2_title']; ?></h3>
        <p><?php echo $popupContent['popup_section_2_content']; ?></p>
        <button onclick="window.open('https://emtagenda.crossuite.com/ACUpijnkliniek/l/n5r4v5z5j454q2c48454/o/a40354a423z2q2e484d4e41344u2d46484s2q284', '_blank')" class="appointment-button appointment-popup"><?php echo $popupContent['popup_section_2_button']; ?></button>
      </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

