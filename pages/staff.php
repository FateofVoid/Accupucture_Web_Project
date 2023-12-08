<?php
// Load the specific localization data for services.php
$staffLocalizationData = json_decode(file_get_contents('localisation/staff_localisation.json'), true);
$staffContent = $staffLocalizationData[$_SESSION['lang']];
?>

    <main>
        <div class="margin"></div>
        <section class="staff_section">
                <div class="left-section">
                    <div class="left-section-content">
                        <img src="assets/images/IMG-20231028-WA0003.jpg" alt="Image">
                    </div>
                </div>
                <div class="right-section">
                    <h1><?php echo $staffContent['staff_title']; ?></h1>
                    <p><?php echo $staffContent['staff_paragraph']; ?></p>

                </div>

            </div>
        </section>
        <section class="certificate_section">
            <h2><?php echo $staffContent['certificate_title']; ?></h2>
            <p><?php echo $staffContent['certificate_paragraph']; ?></p>
        </section>
    </main>
