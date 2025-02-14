    <!-- SEO Meta Tags -->
    <meta name="description" content="Meet the skilled professionals at HENG REN TANG Acupuncture Clinic. Learn about Fransisca Ekkel and Paz Lobo, their qualifications, expertise in traditional Chinese medicine, and how they can help with your health needs.">
    <meta name="keywords" content="Acupuncture Experts, Traditional Chinese Medicine, Fransisca Ekkel, Paz Lobo, HENG REN TANG, Acupuncture Clinic Staff">
    <meta name="author" content="HENG REN TANG Acupuncture Clinic">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Meet Our Experts | HENG REN TANG Acupuncture Clinic">
    <meta property="og:description" content="Meet the skilled professionals at HENG REN TANG Acupuncture Clinic. Discover the qualifications and expertise of Fransisca Ekkel and Paz Lobo in traditional Chinese medicine and acupuncture.">
    <meta property="og:image" content="https://yourdomain.com/assets/images/staff_image_preview.png">
    <meta property="og:url" content="https://yourdomain.com/staff">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Meet Our Experts | HENG REN TANG Acupuncture Clinic">
    <meta name="twitter:description" content="Meet the skilled professionals at HENG REN TANG Acupuncture Clinic. Discover the qualifications and expertise of Fransisca Ekkel and Paz Lobo in traditional Chinese medicine and acupuncture.">
    <meta name="twitter:image" content="https://yourdomain.com/assets/images/staff_image_preview.png">
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
    $staffLocalizationData = json_decode(file_get_contents('localisation/staff_localisation.json'), true);
    $staffContent = $staffLocalizationData[$_SESSION['lang']];
    ?>

    <main>
        <?php
        $sectionClass ='odd-section';
        // Loop through staff members
        foreach ($validStaffMembers as $staffMember) {
            $imagePath = 'assets/images/staff_profile_image_' . $staffMember . '.jpg';
            $fallbackImage = 'assets/images/Heng_ren_tang_logo_no_text.png'; // Path to a default/fallback image
            ?>
            <section class="staff-member-section <?php echo $sectionClass; ?>">
                <div class="left-section">
                    <div class="left-section-content">
                        <img src="<?php echo file_exists($imagePath) ? $imagePath : $fallbackImage; ?>" alt="Image" class="round-image">
                    </div>
                </div>

                <div class="right-section">
                    <h1><?php echo $staffContent['staff_title_' . $staffMember]; ?></h1>
                    <?php echo $staffContent['staff_paragraph_' . $staffMember]; ?>
                </div>

                <div class="certificate-section">
                    <div class="expandable_container">
                        <div class="expandable_title">
                            <span class="expand_icon">▼</span>
                            <span class="expandable_text"><?php echo $staffContent['about_title_' . $staffMember]; ?></span>
                        </div>
                        <div class="expandable_message" style="display: none;">
                            <?php echo $staffContent['about_paragraph_' . $staffMember]; ?>
                        </div>
                    </div>

                    <div class="expandable_container">
                        <div class="expandable_title">
                            <span class="expand_icon">▼</span>
                            <span class="expandable_text"><?php echo $staffContent['certificate_title_' . $staffMember]; ?></span>
                        </div>
                        <div class="expandable_message" style="display: none;">
                            <?php echo $staffContent['certificate_paragraph_' . $staffMember]; ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            // Toggle section class for next staff member
            $sectionClass = ($sectionClass === 'even-section') ? 'odd-section' : 'even-section';
        }
        ?>
    </main>

    <script src="assets/js/staff-script.js"></script> <!-- Link to the javascript file -->
