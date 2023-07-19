<?php
// Language detection code here (detect user's preferred language or IP location)

// For this example, we'll assume the detected language is English.
$selectedLanguage = 'en';

// Check if the user has manually switched languages using the button.
// If so, update the $selectedLanguage accordingly.
if (isset($_GET['lang']) && ($_GET['lang'] === 'nl' || $_GET['lang'] === 'en')) {
    $selectedLanguage = $_GET['lang'];
}

// Redirect to the corresponding language version if the detected language is not Dutch.
if ($selectedLanguage !== 'en') {
    header('Location: /' . $selectedLanguage . '/index.php');
    exit;
}

// Load the shared localization data for the header
$headerLocalizationData = json_decode(file_get_contents('localisation/shared_localisation.json'), true);
$headerContent = $headerLocalizationData[$selectedLanguage];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heng Ren Tang - Home Page</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="favicon.ico" type="assets/images/x-icon">
</head>
<body>
<header>
    <!-- Your header content here -->
</header>