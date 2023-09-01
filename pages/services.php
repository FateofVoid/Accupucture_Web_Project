<?php
    $rootPath = $_SERVER['DOCUMENT_ROOT']."/Accupucture Web Project";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heng Ren Tang - Home Page</title>
    <link rel="stylesheet" href="/Accupucture Web Project/assets/css/styles.css">
    <link rel="icon" href="favicon.ico" type="assets/images/x-icon">
</head>
<body>
    <?php
        include $rootPath."/php/header.php";

    // Load the specific localization data for index.php
    $servicesLocalizationData = json_decode(file_get_contents($rootPath.'/localisation/services_localisation.json'), true);
    $servicesContent = $servicesLocalizationData[$_SESSION['lang']];
    ?>

   <script src="script.js"></script> <!-- Link to the javascript file -->
</body>
</html>