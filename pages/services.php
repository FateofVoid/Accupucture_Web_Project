    <!-- SEO Meta Tags -->
    <title>Treatment Specialties | HENG REN TANG Acupuncture Clinic</title>
    <meta name="description" content="Explore the treatment specialties offered by HENG REN TANG Acupuncture Clinic. Our services include respiratory, digestive, musculoskeletal, hormonal, urinary and reproductive health, and more. Learn how we can help with your specific health needs.">
    <meta name="keywords" content="Acupuncture, Treatment Specialties, Respiratory Health, Digestive Health, Musculoskeletal Pain, Hormonal Disorders, Urinary Health, Reproductive Health, HENG REN TANG">
    <meta name="author" content="HENG REN TANG Acupuncture Clinic">

    <!-- Open Graph Meta Tags for social media -->
    <meta property="og:title" content="Treatment Specialties | HENG REN TANG Acupuncture Clinic">
    <meta property="og:description" content="Explore the treatment specialties offered by HENG REN TANG Acupuncture Clinic. Our services include respiratory, digestive, musculoskeletal, hormonal, urinary and reproductive health, and more. Learn how we can help with your specific health needs.">
    <meta property="og:image" content="https://yourdomain.com/assets/images/treatment_specialties_image.png">
    <meta property="og:url" content="https://yourdomain.com/services">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Treatment Specialties | HENG REN TANG Acupuncture Clinic">
    <meta name="twitter:description" content="Explore the treatment specialties offered by HENG REN TANG Acupuncture Clinic. Our services include respiratory, digestive, musculoskeletal, hormonal, urinary and reproductive health, and more. Learn how we can help with your specific health needs.">
    <meta name="twitter:image" content="https://yourdomain.com/assets/images/treatment_specialties_image.png">
    <meta name="twitter:site" content="@yourtwitterhandle">

    <!-- Additional Meta Tags -->
    <meta name="robots" content="noindex, follow"></head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="margin-top"></div>

    include_once "php/header.php";

    <?php
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
