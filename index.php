<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heng Ren Tang - Home Page</title>
    <link rel="stylesheet" href="assets/css/styles.css">
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

</head>
<body>
    <?php
    $_SESSION['lang'] = 'en';
    include "php/header.php";

    // Load the specific localization data for index.php
    $indexLocalizationData = json_decode(file_get_contents('localisation/Index_localisation.json'), true);
    $indexContent = $indexLocalizationData[$_SESSION['lang']];
    ?>

    <main>
        <div class="margin">
        </div>
        <div class="sections">
            <!-- Section 1 -->
            <section class="section_1">
                <div class="content">
                    <div class="section_1_left">
                        <div class="video-container">
                            <video class="video" controls poster="assets/images/HangRenTang_intro_image.png">
                                <!-- Add the video source -->
                                <source src="assets/video/HangRenTang_Intro_Video.mp4" type="video/mp4">
                                <!-- Add other video formats for cross-browser support -->
                                <!-- <source src="path/to/video.webm" type="video/webm"> -->
                                <!-- <source src="path/to/video.ogv" type="video/ogg"> -->
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    <div class="section_1_right">
                        <h1><?php echo $indexContent['section_1_title']; ?></h1>
                        <p><?php echo $indexContent['section_1_paragraph']; ?></p>
                        <button class="appointment-button"><?php echo $indexContent['section_1_button_label']; ?></button>
                    </div>
                </div>
            </section>

            <div class="gradient_even">
            </div>

            <!-- Section 2 -->
            <section class="section_2">
                <div class="content">
                    <div class="section_2_left">
                        <h1><?php echo $indexContent['section_2_title']; ?></h1>
                        <h2><?php echo $indexContent['section_2_subtitle']; ?></h2>
                        <p><?php echo $indexContent['section_2_paragraph1']; ?></p>
                    </div>
                    <div class="section_2_middle">
                        <div class="profile-picture">
                            <!-- Profile picture goes here -->
                            <img src="assets/images/stacks-image-460eb02-5.jpg" alt="Profile Picture">
                            <figcaption><?php echo $indexContent['profile_text']; ?></figcaption>
                        </div>
                    </div>
                    <div class="section_2_right">
                        <button class="image-text-button">
                            <div class="image-container">
                                <img src="assets/images/130129549-close-up-of-doctor-s-hand-perform-medical-professional-acupuncture-treatment-in-beauty-spa-on-woman.jpg" alt="Image">
                            </div>
                            <div class="label-container">
                                <span><?php echo $indexContent['section_2_button_label_1']; ?></span>
                            </div>
                        </button>
                        <button class="image-text-button">
                            <div class="image-container">
                                <img src="assets/images/130129549-close-up-of-doctor-s-hand-perform-medical-professional-acupuncture-treatment-in-beauty-spa-on-woman.jpg" alt="Image">
                            </div>
                            <div class="label-container">
                                <span><?php echo $indexContent['section_2_button_label_2']; ?></span>
                            </div>
                        </button>
                    </div>
                </div>
            </section>

            <div class="gradient_odd">
            </div>

            <!-- Section 3 -->
            <section class="section_3">

                <div class="content">
                    <div class="section_3_left">
                        <h1><?php echo $indexContent['section_3_title']; ?></h1>
                        <h2><?php echo $indexContent['section_3_subtitle_1']; ?></h2>
                        <p>
                            <?php echo $indexContent['section_3_paragraph_1']; ?>
                            <span class="tooltip"><?php echo $indexContent['tooltip_text']; ?></span>
                        </p>
                        <h2><?php echo $indexContent['section_3_subtitle_2']; ?></h2>
                        <p><?php echo $indexContent['section_3_paragraph_2']; ?></p>
                    </div>
                    <div class="section_3_middle">
                    </div>
                    <div class="section_3_right">

                        <button class="image-text-button">
                            <div class="image-container">
                                <img src="assets/images/130129549-close-up-of-doctor-s-hand-perform-medical-professional-acupuncture-treatment-in-beauty-spa-on-woman.jpg" alt="Image">
                            </div>
                            <div class="label-container">
                                <span><?php echo $indexContent['section_3_button_label']; ?></span>
                            </div>
                        </button>
                    </div>
                </div>
            </section>

            <div class="gradient_even">
            </div>

            <!-- Section 4 -->
            <section class="section_4">
                <div class="content">
                    <div class="section_4_left">
                        <h1><?php echo $indexContent['section_4_title']; ?></h1>
                        <h2><?php echo $indexContent['section_4_subtitle']; ?></h2>
                        <p><?php echo $indexContent['section_4_paragraph']; ?></p>
                        <button class="appointment-button"><?php echo $indexContent['section_4_button_label']; ?></button>
                        <h2><?php echo $indexContent['section_4_subtitle_2']; ?></h2>
                        <p><?php echo $indexContent['section_4_paragraph_2']; ?></p>
                    </div>
                    <div class="section_4_right">
                        <div class="map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2436.7330290348536!2d5.146192377588776!3d52.35712714827447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c61112de60e201%3A0xa7698c5e8cab0cf0!2sHerasingel%2013%2C%201363%20TH%20Almere!5e0!3m2!1sen!2snl!4v1693567494770!5m2!1sen!2snl"
                                width=100%
                                height=100%
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </section>

            <div class="gradient_odd">
            </div>

            <!-- Section 5 -->
            <section class="section_5">
                <div class="content">
                    <div class="section_5_title">
                        <h1 class="section-title"><?php echo $indexContent['section_5_title']; ?></h1>

                    <div class="section_5_questions">
                        <div class="faq">
                            <?php for ($i = 1; $i <= 21; $i++) { ?>
                                <div class="qa <?php echo $i % 2 === 1 ? 'left' : 'right'; ?>">
                                    <div class="question">
                                        <?php echo $indexContent['section_5_question_'.$i]; ?>
                                    </div>
                                    <div class="answer" style="max-height: 0px;">
                                        <?php echo $indexContent['section_5_answer_'.$i]; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                </div>
                <div class="margin"></div>

                <h2><?php echo $indexContent['section_5_subtitle_1']; ?></h2>
                <p><?php echo $indexContent['section_5_paragraph_1']; ?></p>
                <img class="section_3_middle_img_1" src="assets/images/stacks-image-5c587d1.png" alt="Image" >
                <img class="section_3_middle_img_2" src="assets/images/stacks-image-dbb4ead.jpg" alt="Image" >

                <div class="margin"></div>
            </section>
        </div>
    </main>

   <script src="assets/js/faq-script.js"></script> <!-- Link to the javascript file -->
</body>
</html>