<?php
// Load the specific localization data for services.php
$certificateLocalizationData = json_decode(file_get_contents('localisation/certificate_localisation.json'), true);
$certificateContent = $certificateLocalizationData[$_SESSION['lang']];
?>

<main>
    <div class="margin"></div>
    <section class="certificate_section">
                <h2><?php echo $certificateContent['certificate_title']; ?></h2>
                <p><?php echo $certificateContent['certificate_paragraph']; ?></p>
        </div>
    </section>
</main>