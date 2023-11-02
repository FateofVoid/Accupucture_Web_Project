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
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

</head>
<body>
    <?php
        include $rootPath."/php/header.php";

    // Load the specific localization data for services.php
    $staffLocalizationData = json_decode(file_get_contents($rootPath.'/localisation/staff_localisation.json'), true);
    $staffContent = $staffLocalizationData[$_SESSION['lang']];
    ?>

    <main>
        <div class="margin"></div>
        <section class="staff_section">
                <div class="left-section">
                    <img src="<?php echo $baseURL; ?>assets/images/stacks-image-460eb02-5.jpg" alt="Image">
                </div>
                <div class="right-section">
                    <h2><?php echo $staffContent['staff_title']; ?></h2>
                    <p><?php echo $staffContent['staff_paragraph']; ?></p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>