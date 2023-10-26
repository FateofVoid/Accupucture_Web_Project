<?php
$rootPath = $_SERVER['DOCUMENT_ROOT']."/Accupucture Web Project";
include $rootPath."/config.php";

// Extract the language from the URL path


// Load the shared localization data for the header
$headerLocalizationData = json_decode(file_get_contents($rootPath.'/localisation/shared_localisation.json'), true);
$headerContent = $headerLocalizationData[$_SESSION['lang']];

?>

<header>
    <div class="header-content">
        <div class="left-section">
            <div class="logo"><?php echo $headerContent['header_logo']; ?></div>
            <nav class="header-buttons">
                <a href="/Accupucture%20Web%20Project/index.php">
                    <button><?php echo $headerContent['header_home_button_label']; ?></button>
                </a>
                <a href="/Accupucture%20Web%20Project/pages/services.php">
                    <button><?php echo $headerContent['header_service_button_label']; ?></button>
                </a>
            </nav>
        </div>
        <div class="right-section">
            <button class="appointment-button"><?php echo $headerContent['header_appointment_button_label']; ?></button>
            <!-- Language Selection Dropdown -->
            <div class="language-dropdown">
                <div class="custom-select" id="custom-select">
                    <div class="selected-option">
                        <img src="/Accupucture Web Project/assets/images/icon-en.png" alt="English Flag" class="flag-icon"> EN
                    </div>
                    <div class="options" id="options">
                        <div class="option" data-value="en">
                            <img src="/Accupucture Web Project/assets/images/icon-en.png" alt="English Flag" class="flag-icon"> EN
                        </div>
                        <div class="option" data-value="nl">
                            <img src="/Accupucture Web Project/assets/images/icon-nl.png" alt="Dutch Flag" class="flag-icon"> NL
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
