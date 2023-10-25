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
                <select onchange="window.location.href='?lang=' + this.value">
                    <option value="en" <?php echo ($_SESSION['lang'] === 'en') ? 'selected' : ''; ?>>
                        <img src=$rootPath."/assets/images/icon-en.png" alt="English Flag" width="20" height="15"> English
                    </option>
                    <option value="nl" <?php echo ($_SESSION['lang'] === 'nl') ? 'selected' : ''; ?>>
                        <img src=$rootPath."/assets/images/icon-nl.png" alt="Dutch Flag" width="20" height="15"> Nederland
                    </option>
                </select>
            </div>
        </div>
    </div>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
