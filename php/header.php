<?php

// Load the shared localization data for the header
$headerLocalizationData = json_decode(file_get_contents('localisation/shared_localisation.json'), true);
$headerContent = $headerLocalizationData[$_SESSION['lang']];
?>

<header>
    <div class="header-content">
        <div class="left-section">

            <div class="logo">
                <div class="mobile-dropdown-button">
                    <button class="mobile-dropdown-button-icon">☰</button>
                </div>
                <?php echo $headerContent['header_logo']; ?>
            </div>

            <div class="header-buttons page-options" id="page-options">
                <div class="page-option nav-alpha" id="nav1" data-value="home">
                    <button><?php echo $headerContent['header_home_button_label']; ?></button>
                </div>
                <div class="page-option" id="nav2" data-value="services">
                    <button><?php echo $headerContent['header_service_button_label']; ?></button>
                </div>
                <div class="page-option" id="nav3" data-value="staff">
                    <button><?php echo $headerContent['header_staff_button_label']; ?></button>
                </div>
                <div class="page-option nav-omega" id="nav4" data-value="privacy">
                    <button><?php echo $headerContent['header_privacy_button_label']; ?></button>
                </div>
            </div>
        </div>
        <div class="right-section">

            <button class="appointment-button popup-button"><?php echo $headerContent['header_appointment_button_label']; ?></button>
            <div class="social-icons">
                <div class="social-icon">
                    <a href="https://www.facebook.com/hengrentang/" target="_blank">
                        <i class="fab fa-facebook-square"></i>
                        <img class="default-image" src="assets/images/facebook_idle.png" alt="Facebook Icon Default">
                        <img class="hover-image" src="assets/images/facebook_hover.png" alt="Facebook Icon Hover">
                    </a>
                </div>

                <div class="social-icon">
                    <a href="https://instagram.com/hengrentang_acupunctuur?igshid=MWszYjEzMmUxd2J2dg%3D%3D&utm_source=qr" target="_blank">
                        <i class="fab fa-instagram"></i>
                        <img class="default-image" src="assets/images/Instagram_idle.png" alt="Instagram Icon Default">
                        <img class="hover-image" src="assets/images/Instagram_hover.png" alt="Instagram Icon Hover">
                    </a>
                </div>
            </div>
            <!-- Language Selection Dropdown -->
            <div class="language-dropdown">
                <div class="custom-select" id="custom-select">
                    <div class="selected-option">
                        <img src="assets/images/icon-nl.png" alt="English Flag" class="flag-icon"> NL
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
