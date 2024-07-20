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
    $contactLocalizationData = json_decode(file_get_contents('localisation/contact_localisation.json'), true);
    $contactContent = $contactLocalizationData[$_SESSION['lang']];
    ?>

    <main>
        <div class="margin-top"></div>
        <section class="contact_section">
            <div class="contact_content" id="contact_form_section" >
                <iframe class="contact_form"
                    src="<?php echo $contactContent['contact_form_url']; ?>"
                    id="inline-contact-form"
                    data-layout="{'id':'INLINE'}"
                    data-trigger-type="alwaysShow"
                    data-trigger-value=""
                    data-activation-type="alwaysActivated"
                    data-activation-value=""
                    data-deactivation-type="neverDeactivate"
                    data-deactivation-value=""
                    data-form-name="<?php echo $contactContent['contact_form_name']; ?>"
                    data-height="878"
                    data-layout-iframe-id="inline-contact-form"
                    title="<?php echo $contactContent['contact_form_name']; ?>"
                ></iframe>
            </div>
        </section>
    </main>

    <script src="assets/js/contact-script.js"></script> <!-- Link to the javascript file -->
