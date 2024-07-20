<?php
    session_start();


    $validLanguages = array('nl', 'en');
    $validPages = array('home', 'services', 'staff', 'contact', 'privacy');
    $validStaffMembers = array('fransisca', 'paz');
    $titles = array(
        'home' => array(
            'en' => 'HENG REN TANG Acupuncture Clinic | Balance Method & Wellness',
            'nl' => 'HENG REN TANG Acupunctuur Kliniek | Balans Methode & Welzijn'
        ),
        'contact' => array(
            'en' => 'Contact Us | HENG REN TANG Acupuncture Clinic',
            'nl' => 'Contacteer Ons | HENG REN TANG Acupunctuur Kliniek'
        ),
        'privacy' => array(
            'en' => 'Privacy Policy | HENG REN TANG Acupuncture Clinic',
            'nl' => 'Privacybeleid | HENG REN TANG Acupunctuur Kliniek'
        ),
        'services' => array(
            'en' => 'Treatment Specialties | HENG REN TANG Acupuncture Clinic',
            'nl' => 'Behandelingsspecialisaties | HENG REN TANG Acupunctuur Kliniek'
        ),
        'staff' => array(
            'en' => 'Meet Our Experts | HENG REN TANG Acupuncture Clinic',
            'nl' => 'Ontmoet Onze Experts | HENG REN TANG Acupunctuur Kliniek'
        )
    );


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