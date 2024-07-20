<?php
    session_start();


    $validLanguages = array('nl', 'en');
    $validPages = array('home', 'services', 'staff', 'contact', 'privacy');
    $validStaffMembers = array('fransisca', 'paz');



    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "nl";
    else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
        if (in_array($_GET['lang'], $validLanguages))
            $_SESSION['lang'] = $_GET['lang'];
    }

    if (!isset($_SESSION['selectedPage'])) {
        $_SESSION['selectedPage'] = "home"; // Set a default page
    } else if (isset($_GET['page']) && $_SESSION['selectedPage'] != $_GET['page'] && !empty($_GET['page'])) {
        if (in_array($_GET['page'], $validPages)) {
            $_SESSION['selectedPage'] = $_GET['page'];
        }
    }
?>