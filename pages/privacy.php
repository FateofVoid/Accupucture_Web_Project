    <!-- SEO Meta Tags -->
    <meta name="description" content="Read the privacy policy of HENG REN TANG Acupuncture Clinic to understand how we process and protect your personal and sensitive data. Learn about your rights and how we ensure your data security.">
    <meta name="keywords" content="Privacy Policy, Data Protection, Personal Data, Sensitive Data, HENG REN TANG, Acupuncture Clinic">
    <meta name="author" content="HENG REN TANG Acupuncture Clinic">

    <!-- Open Graph Meta Tags for social media -->
    <meta property="og:title" content="Privacy Policy | HENG REN TANG Acupuncture Clinic">
    <meta property="og:description" content="Read the privacy policy of HENG REN TANG Acupuncture Clinic to understand how we process and protect your personal and sensitive data. Learn about your rights and how we ensure your data security.">
    <meta property="og:image" content="https://yourdomain.com/assets/images/privacy_policy_image.png">
    <meta property="og:url" content="https://yourdomain.com/privacy-policy">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Privacy Policy | HENG REN TANG Acupuncture Clinic">
    <meta name="twitter:description" content="Read the privacy policy of HENG REN TANG Acupuncture Clinic to understand how we process and protect your personal and sensitive data. Learn about your rights and how we ensure your data security.">
    <meta name="twitter:image" content="https://yourdomain.com/assets/images/privacy_policy_image.png">
    <meta name="twitter:site" content="@yourtwitterhandle">

    <!-- Additional Meta Tags -->
    <meta name="robots" content="noindex, follow">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="margin-top"></div>


    <?php
    include_once "php/header.php";
    // Load the specific localization data for privacy.php
    $privacyLocalizationData = json_decode(file_get_contents('localisation/privacy_localisation.json'), true);
    $privacyContent = $privacyLocalizationData[$_SESSION['lang']];
    ?>

    <main>
        <div class="margin-top"></div>

        <!-- Contact Section -->
        <section class="contact_section">
            <h2><?php echo $privacyContent['contact_title']; ?></h2>
            <p><?php echo $privacyContent['contact_paragraph']; ?></p>
        </section>

        <!-- Persoonsgegevens die wij verwerken -->
        <section class="personal_data_section">
            <h2><?php echo $privacyContent['personal_data_title']; ?></h2>
            <p><?php echo $privacyContent['personal_data_paragraph']; ?></p>
        </section>

        <!-- Bijzondere en/of gevoelige persoonsgegevens -->
        <section class="sensitive_data_section">
            <h2><?php echo $privacyContent['sensitive_data_title']; ?></h2>
            <p><?php echo $privacyContent['sensitive_data_paragraph']; ?></p>
        </section>

        <!-- Gegevens van personen jonger dan 16 jaar -->
        <section class="under_16_section">
            <h2><?php echo $privacyContent['under_16_title']; ?></h2>
            <p><?php echo $privacyContent['under_16_paragraph']; ?></p>
        </section>

        <!-- Met welk doel en op basis van welke grondslag -->
        <section class="processing_purpose_section">
            <h2><?php echo $privacyContent['processing_purpose_title']; ?></h2>
            <p><?php echo $privacyContent['processing_purpose_paragraph']; ?></p>
        </section>

        <!-- Toegang tot uw dossier -->
        <section class="access_modify_delete_section">
            <h2><?php echo $privacyContent['access_modify_delete_title']; ?></h2>
            <p><?php echo $privacyContent['access_modify_delete_paragraph_1']; ?></p>
            <p><?php echo $privacyContent['access_modify_delete_paragraph_2']; ?></p>
            <p><?php echo $privacyContent['access_modify_delete_paragraph_3']; ?></p>
        </section>

        <!-- Bewaartermijn -->
        <section class="retention_section">
            <h2><?php echo $privacyContent['retention_title']; ?></h2>
            <p><?php echo $privacyContent['retention_paragraph']; ?></p>
        </section>

        <!-- Delen van persoonsgegevens met derden -->
        <section class="sharing_with_third_parties_section">
            <h2><?php echo $privacyContent['sharing_with_third_parties_title']; ?></h2>
            <p><?php echo $privacyContent['sharing_with_third_parties_paragraph']; ?></p>
        </section>

        <!-- Hoe wij persoonsgegevens beveiligen -->
        <section class="data_security_section">
            <h2><?php echo $privacyContent['data_security_title']; ?></h2>
            <p><?php echo $privacyContent['data_security_paragraph']; ?></p>
        </section>

        <!-- Cookies Section -->
        <section class="cookies_section">
            <h2><?php echo $privacyContent['cookies_title']; ?></h2>
            <p><?php echo $privacyContent['cookies_paragraph']; ?></p>
        </section>

        <div class="credits">
            <?php echo $homeContent['section_5_credits']; ?>

            <a href="https://www.flaticon.com/free-icons/certificate" title="certificate icons">Certificate icons created by mikan933 - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/contract" title="contract icons">Contract icons created by Freepik - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/certificate" title="certificate icons">Certificate icons created by Freepik - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/acupuncture" title="acupuncture icons">Acupuncture icons created by Good Ware - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/acupuncture" title="acupuncture icons">Acupuncture icons created by Flat Icons - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/ui" title="ui icons">Ui icons created by Grand Iconic - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/acupuncture" title="acupuncture icons">Acupuncture icons created by Eucalyp - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/healthcare-and-medical" title="healthcare and medical icons">Healthcare and medical icons created by Mayor Icons - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/chinese-medicine" title="chinese medicine icons">Chinese medicine icons created by Darius Dan - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/acupuncture" title="acupuncture icons">Acupuncture icons created by Mayor Icons - Flaticon</a>
        </div>
    </main>
