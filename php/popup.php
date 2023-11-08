<?php
$rootPath = $_SERVER['DOCUMENT_ROOT']."/Accupucture Web Project";

// Load the shared localization data for the popup
$popupLocalizationData = json_decode(file_get_contents($rootPath.'/localisation/shared_localisation.json'), true);
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
            <button class="appointment-button appointment-popup"><?php echo $popupContent['popup_section_1_button']; ?></button>
        </div>
        <div class="popup-section right-section">
            <h3><?php echo $popupContent['popup_section_2_title']; ?></h3>
            <p><?php echo $popupContent['popup_section_2_content']; ?></p>
            <button class="appointment-button appointment-popup"><?php echo $popupContent['popup_section_2_button']; ?></button>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

