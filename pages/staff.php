<?php
// Load the specific localization data for services.php
$staffLocalizationData = json_decode(file_get_contents('localisation/staff_localisation.json'), true);
$staffContent = $staffLocalizationData[$_SESSION['lang']];
?>

<main>
    <div class="margin"></div>
    <section class="staff_section">
            <div class="left-section">
                <img src="assets/images/stacks-image-460eb02-5.jpg" alt="Image">
            </div>
            <div class="right-section">
                <h2><?php echo $staffContent['staff_title']; ?></h2>
                <p><?php echo $staffContent['staff_paragraph']; ?></p>
            </div>
        </div>
    </section>
</main>
