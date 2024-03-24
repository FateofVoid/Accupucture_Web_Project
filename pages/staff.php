<?php
// Load the specific localization data for services.php
$staffLocalizationData = json_decode(file_get_contents('localisation/staff_localisation.json'), true);
$staffContent = $staffLocalizationData[$_SESSION['lang']];
?>

<main>
    <div class="margin-top"></div>

    <?php
    $sectionClass ='odd-section';
    // Loop through staff members
    foreach ($validStaffMembers as $staffMember) {
        ?>
        <section class="staff-member-section <?php echo $sectionClass; ?>">
            <div class="left-section">
                <div class="left-section-content">
                    <img src="<?php echo 'assets/images/staff_profile_image_' . $staffMember . '.jpg'; ?>" alt="Image" class="round-image">
                </div>
            </div>

            <div class="right-section">
                <h1><?php echo $staffContent['staff_title_' . $staffMember]; ?></h1>
                <?php echo $staffContent['staff_paragraph_' . $staffMember]; ?>
            </div>

            <div class="certificate-section">
                <div class="expandable_container">
                    <div class="expandable_title">
                        <span class="expand_icon">▼</span>
                        <span class="expandable_text"><?php echo $staffContent['about_title_' . $staffMember]; ?></span>
                    </div>
                    <div class="expandable_message" style="display: none;">
                        <?php echo $staffContent['about_paragraph_' . $staffMember]; ?>
                    </div>
                </div>

                <div class="expandable_container">
                    <div class="expandable_title">
                        <span class="expand_icon">▼</span>
                        <span class="expandable_text"><?php echo $staffContent['certificate_title_' . $staffMember]; ?></span>
                    </div>
                    <div class="expandable_message" style="display: none;">
                        <?php echo $staffContent['certificate_paragraph_' . $staffMember]; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Toggle section class for next staff member
        $sectionClass = ($sectionClass === 'even-section') ? 'odd-section' : 'even-section';
    }
    ?>
</main>

<script src="assets/js/staff-script.js"></script> <!-- Link to the javascript file -->
