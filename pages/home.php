<?php
// Load the specific localization data for services.php
$homeLocalizationData = json_decode(file_get_contents('localisation/home_localisation.json'), true);
$homeContent = $homeLocalizationData[$_SESSION['lang']];
?>

<main>
    <div class="margin-top"></div>

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
                    <h1><?php echo $homeContent['section_1_title']; ?></h1>
                    <p><?php echo $homeContent['section_1_paragraph']; ?></p>
                    <button onclick="window.open('https://bookings.crossuite.app/ef415adc-c2ee-40c8-a9e6-e1608bda93ca/step2', '_blank')" class="appointment-button  popup-button"><?php echo $homeContent['section_1_button_label']; ?></button>
                </div>
            </div>
        </section>

        <div class="gradient_even">
        </div>

        <!-- Section 2 -->
        <section class="section_2">
            <div class="content">
                <div class="section_2_left">
                    <div class="left-content">
                        <h1><?php echo $homeContent['section_2_subtitle']; ?></h1>
                        <p><?php echo $homeContent['section_2_paragraph1']; ?></p>
                        <div class="social-icons">
                            <div class="social-icon">
                                <a href="https://www.facebook.com/hengrentang/" target="_blank">
                                    <i class="fab fa-facebook-square"></i>
                                    <img class="default-image" src="assets/images/facebook_idle.png" alt="Facebook Icon Default">
                                    <img class="hover-image" src="assets/images/facebook_hover.png" alt="Facebook Icon Hover">
                                </a>
                            </div>

                            <div class="social-icon">
                                <a href="https://instagram.com/hengrentang_acupunctuur?igshid=MWszYjEzMmUxd2J2dg%3D%3D&utm_source=qr" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                    <img class="default-image" src="assets/images/Instagram_idle.png" alt="Instagram Icon Default">
                                    <img class="hover-image" src="assets/images/Instagram_hover.png" alt="Instagram Icon Hover">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section_2_middle">
                </div>
                <div class="section_2_right">
                    <div class="profile-picture">
                        <img src="assets/images/IMG-20231028-WA0002.jpg" alt="Image">
                        <img src="assets/images/IMG-20231028-WA0001.jpg" alt="Image">
                    </div>
                </div>
            </div>
        </section>

        <div class="gradient_odd">
        </div>

        <!-- Section 3 -->
        <section class="section_3">

            <div class="content">
                <div class="section_3_left">
                    <h1><?php echo $homeContent['section_3_title']; ?></h1>
                    <h2><?php echo $homeContent['section_3_subtitle_1']; ?></h2>
                    <p>
                        <div class="tooltip-container">
                            <?php echo $homeContent['section_3_paragraph_1_1']; ?>
                            <div class="tooltip">
                                <img src="assets/images/tooltip_icon.png" alt="?" class="tooltip-icon">
                                <span class="tooltiptext tt_1"><?php echo $homeContent['section_3_tooltip_text']; ?></span>
                            </div>
                            <?php echo $homeContent['section_3_paragraph_1_2']; ?>
                            <div class="tooltip">
                                <img src="assets/images/tooltip_icon.png" alt="?" class="tooltip-icon">
                                <span class="tooltiptext tt_2"><?php echo $homeContent['section_3_tooltip_2_text']; ?></span>
                            </div>
                        </div>
                    </p>
                    <h2><?php echo $homeContent['section_3_subtitle_2']; ?></h2>
                    <p><?php echo str_replace(
                        array('[Zhong]', '[Zorgwijzer.nl]'),
                        array('<a href="https://zhong.nl/" class="blue-link" target="_blank">ZHONG</a>', '<a href="https://www.kab-koepel.nl/" class="blue-link" target="_blank">Zorgwijzer.nl</a>'),
                        $homeContent['section_3_paragraph_2']
                    ); ?></p>
                </div>
                <div class="section_3_middle">

                </div>
                <div class="section_3_right">
                    <button class="image-text-button" data-value="services">
                        <div class="image-container">
                            <img src="assets/images/acupuncture.png" alt="Image">
                        </div>
                        <div class="label-container">
                            <span><?php echo $homeContent['section_3_button_label']; ?></span>
                        </div>
                    </button>
                    <button class="image-text-button" data-value="staff">
                        <div class="image-container">
                            <img src="assets/images/users.png" alt="Image">
                        </div>
                        <div class="label-container">
                            <span><?php echo $homeContent['section_2_button_label_2']; ?></span>
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
                <div class="section_4_top">
                    <h1><?php echo $homeContent['section_4_title']; ?></h1>
                    <p><?php echo $homeContent['section_4_paragraph']; ?></p>
                </div>
                <button onclick="window.open('https://bookings.crossuite.app/ef415adc-c2ee-40c8-a9e6-e1608bda93ca/step2', '_blank')" class="appointment-button appointment"><?php echo $homeContent['section_4_left_button_label']; ?></button>
                <div class="section_4_left">
                    <h2><?php echo $homeContent['section_4_left_subtitle']; ?></h2>
                    <p><?php echo $homeContent['section_4_left_paragraph']; ?></p>
                </div>
                <div class="section_4_right">
                    <h2><?php echo $homeContent['section_4_right_subtitle']; ?></h2>
                    <p><?php echo $homeContent['section_4_right_paragraph']; ?></p>
                </div>
                <div class="section_4_bottom">
                    <h2><?php echo $homeContent['section_4_left_subtitle_2']; ?></h2>
                    <p><?php echo $homeContent['section_4_left_paragraph_2']; ?></p>
                </div>
            </div>
        </section>

        <div class="gradient_odd">
        </div>

        <!-- Section 5 -->
        <section class="section_5">
            <div class="section_5_title">
                <h1 class="section-title"><?php echo $homeContent['section_5_title']; ?></h1>
            </div>
            <div class="content">
                <div class="section_5_questions">
                    <div class="faq">
                        <?php for ($i = 1; $i <= 21; $i++) { ?>
                            <div class="expandable_container <?php echo $i % 2 === 1 ? 'left' : 'right'; ?>">
                                <div class="expandable_title">
                                    <span class="expand_icon">▼</span>
                                    <span class="expandable_text"><?php echo $homeContent['section_5_question_'.$i]; ?></span>
                                </div>
                                <div class="expandable_message" style="display: none;">
                                    <?php echo $homeContent['section_5_answer_'.$i]; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="margin"></div>
            <br>
                <h2><?php echo $homeContent['section_5_subtitle_1']; ?></h2>
                <p><?php echo $homeContent['section_5_paragraph_1']; ?></p>
                <div class="logo-container">
                    <img onclick="window.open('https://www.scag.nl/', '_blank')" class="section_3_middle_img_1" src="assets/images/SCAG Logo.png" alt="SCAG Logo">
                    <img onclick="window.open('https://zhong.nl/', '_blank')" class="section_3_middle_img_2" src="assets/images/Zhong Logo.png" alt="Zhong Logo">
                </div>

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
        </section>

    </div>
</main>

<script src="assets/js/home-script.js"></script> <!-- Link to the javascript file -->
