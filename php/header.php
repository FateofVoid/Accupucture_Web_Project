<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'];
include $rootPath."/config.php";

// Extract the language from the URL path


// Load the shared localization data for the header
$headerLocalizationData = json_decode(file_get_contents($rootPath.'/localisation/shared_localisation.json'), true);
$headerContent = $headerLocalizationData[$_SESSION['lang']];

?>

<header>
    <div class="header-content">
        <div class="logo"><?php echo $headerContent['header_logo']; ?></div>

        <!-- Other Header Buttons -->
        <nav class="header-buttons">
            <ul>
                <li><a href="/<?php echo ($selectedLanguage === 'nl') ? 'en' : 'nl'; ?>"><?php echo $headerContent['header_button1_label']; ?></a></li>
                <!-- Add more buttons here if needed -->
            </ul>
        </nav>

        <!-- Language Selection Dropdown -->
        <div class="language-dropdown">
            <select onchange="window.location.href='?lang=' + this.value">
                <option value="en" <?php echo ($_SESSION['lang'] === 'en') ? 'selected' : ''; ?>>English</option>
                <option value="nl" <?php echo ($_SESSION['lang'] === 'nl') ? 'selected' : ''; ?>>Nederlands</option>
            </select>
        </div>
    </div>
</header>