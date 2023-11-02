<?php
    $rootPath = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . "/Accupucture Web Project/";
    $baseURL = "http://localhost:8080/Accupucture%20Web%20Project/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heng Ren Tang - Home Page</title>
    <link rel="stylesheet" href="/Accupucture Web Project/assets/css/styles.css">
    <link rel="icon" href="favicon.ico" type="assets/images/x-icon">
    <!-- Include Quicksand as the primary font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap">
    <!-- Include other fonts as backup fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Crimson+Pro:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rosarivo:400,700&display=swap">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet" />
</head>
<body>
    <?php
        include $rootPath."/php/header.php";

    // Load the specific localization data for services.php
    $servicesLocalizationData = json_decode(file_get_contents($rootPath.'/localisation/services_localisation.json'), true);
    $taffContent = $servicesLocalizationData[$_SESSION['lang']];
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
                                <img src="<?php echo $baseURL; ?>assets/images/service<?php echo $i + 1; ?>.jpg" alt="<?php echo $servicesContent[$i]['title']; ?>">
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