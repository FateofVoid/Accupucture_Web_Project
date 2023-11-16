<?php

// Load the shared localization data for the header
$headerLocalizationData = json_decode(file_get_contents('localisation/shared_localisation.json'), true);
$headerContent = $headerLocalizationData[$_SESSION['lang']];
?>

<header>
    <div class="header-content">
        <div class="left-section">
            <div class="mobile-dropdown-button">
                <button class="mobile-dropdown-button-icon">☰</button>
            </div>
            <div class="logo"><?php echo $headerContent['header_logo']; ?></div>

            <div class="header-buttons page-options" id="page-options">
                <div class="page-option" data-value="home">
                    <button><?php echo $headerContent['header_home_button_label']; ?></button>
                </div>
                <div class="page-option" data-value="services">
                    <button><?php echo $headerContent['header_service_button_label']; ?></button>
                </div>
                <div class="page-option" data-value="staff">
                    <button><?php echo $headerContent['header_staff_button_label']; ?></button>
                </div>
                <div class="page-option" data-value="certificate">
                    <button><?php echo $headerContent['header_certificate_button_label']; ?></button>
                </div>
                <div class="page-option" data-value="privacy">
                    <button><?php echo $headerContent['header_privacy_button_label']; ?></button>
                </div>
            </div>
        </div>
        <div class="right-section">
            <button class="appointment-button popup-button"><?php echo $headerContent['header_appointment_button_label']; ?></button>
            <!-- Language Selection Dropdown -->
            <div class="language-dropdown">
                <div class="custom-select" id="custom-select">
                    <div class="selected-option">
                        <img src="assets/images/icon-en.png" alt="English Flag" class="flag-icon"> EN
                    </div>
                    <div class="options" id="options">
                        <div class="option" data-value="en">
                            <img src="assets/images/icon-en.png" alt="English Flag" class="flag-icon"> EN
                        </div>
                        <div class="option" data-value="nl">
                            <img src="assets/images/icon-nl.png" alt="Dutch Flag" class="flag-icon"> NL
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php //echo 'File Path: ' . $rootPath . 'localisation/shared_localisation.json'; ?>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
