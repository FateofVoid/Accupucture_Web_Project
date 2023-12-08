<?php
// Load the specific localization data for services.php
$certificateLocalizationData = json_decode(file_get_contents('localisation/certificate_localisation.json'), true);
$certificateContent = $certificateLocalizationData[$_SESSION['lang']];
?>

<main>
    <div class="margin"></div>

</main>