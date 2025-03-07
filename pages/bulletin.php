    <!-- SEO Meta Tags -->
    <meta name="description" content="Get in touch with HENG REN TANG Acupuncture Clinic for inquiries or to schedule an appointment. Use our optimized contact form to reach out directly to our team. We are here to assist you with all your acupuncture needs.">
    <meta name="keywords" content="Contact, HENG REN TANG, Acupuncture Clinic, Appointment, Inquiries">
    <meta name="author" content="HENG REN TANG Acupuncture Clinic">

    <!-- Open Graph Meta Tags for social media -->
    <meta property="og:title" content="Contact Us | HENG REN TANG Acupuncture Clinic">
    <meta property="og:description" content="Get in touch with HENG REN TANG Acupuncture Clinic for inquiries or to schedule an appointment. Use our optimized contact form to reach out directly to our team. We are here to assist you with all your acupuncture needs.">
    <meta property="og:image" content="https://yourdomain.com/assets/images/contact_us_image.png">
    <meta property="og:url" content="https://yourdomain.com/contact">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Contact Us | HENG REN TANG Acupuncture Clinic">
    <meta name="twitter:description" content="Get in touch with HENG REN TANG Acupuncture Clinic for inquiries or to schedule an appointment. Use our optimized contact form to reach out directly to our team. We are here to assist you with all your acupuncture needs.">
    <meta name="twitter:image" content="https://yourdomain.com/assets/images/contact_us_image.png">
    <meta name="twitter:site" content="@yourtwitterhandle">

    <!-- Additional Meta Tags -->
    <meta name="robots" content="noindex, follow">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <div class="margin-top"></div>


        <?php
        include_once "php/header.php";
        // Load the specific localization data for services.php
        $servicesLocalizationData = json_decode(file_get_contents('localisation/services_localisation.json'), true);
        $servicesContent = $servicesLocalizationData[$_SESSION['lang']];
        ?>

        <main>
            <div class="margin-top"></div>
            <section class="services_section">
                <h1><?php echo $servicesContent['main_title']; ?></h1>
                <ul class="service-grid">
                    <?php for ($i = 0; $i < count($servicesContent['services']); $i++) { ?>
                        <li>
                            <button class="image-text-button">
                                <div class="image-container">
                                    <img src="assets/images/service<?php echo $i + 1; ?>.png" alt="<?php echo $servicesContent[$i]['title']; ?>">
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
        <script src="assets/js/services-script.js"></script> <!-- Link to the javascript file -->