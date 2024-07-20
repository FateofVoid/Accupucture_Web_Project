
<?php
include_once "config.php";
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titles[$_SESSION['selectedPage']][$_SESSION['lang']]) ? $titles[$_SESSION['selectedPage']][$_SESSION['lang']] : $titles['home']['nl']; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="assets/images/Heng_ren_tang_favicon.ico" type="image/x-icon">
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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:wght@400;700&display=swap">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap">

    <?php

    // Include the selected page based on the session variable
    include_once 'pages/' . $_SESSION['selectedPage'] . '.php';
    ?>
    <script src="assets/js/index-script.js"></script> <!-- Link to the javascript file -->
</body>
</html>