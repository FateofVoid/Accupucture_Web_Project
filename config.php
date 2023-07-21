<?php
    session_start();

    $validLanguages = array('en', 'nl');

    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "en";
    else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
        if (in_array($_GET['lang'], $validLanguages))
            $_SESSION['lang'] = $_GET['lang'];
    }

?>