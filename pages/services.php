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

    // Load the specific localization data for services.php
    $servicesLocalizationData = json_decode(file_get_contents($rootPath.'/localisation/services_localisation.json'), true);
    $servicesContent = $servicesLocalizationData[$_SESSION['lang']];
    ?>

    <main>
        <div class="margin"></div>
        <section class="services_section">
            <h1><?php echo $servicesContent['main_title']; ?></h1>
            <ul class="service-grid">
                <?php for ($i = 0; $i < count($servicesContent['services']); $i++) { ?>
                    <li>
                        <button class="image-text-button">
                            <div class="image-container">
                                <img src="/Accupucture Web Project/assets/images/service<?php echo $i + 1; ?>.jpg" alt="<?php echo $servicesContent[$i]['title']; ?>">
                            </div>
                            <div class="label-container">
                                <span><?php echo $servicesContent['services'][$i]['title']; ?></span>
                            </div>
                        </button>
                    </li>
                    <li class="fullwidth is-hidden" id="quickview-<?php echo $i + 1; ?>">
                        <div class="text-container">
                            <h2><?php echo $servicesContent['services'][$i]['title']; ?></h2>
                            <p><?php echo $servicesContent['services'][$i]['description']; ?></p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </section>
    </main>
    <script src="/Accupucture Web Project/assets/js/services-script.js"></script> <!-- Link to the javascript file -->
</body>
</html>