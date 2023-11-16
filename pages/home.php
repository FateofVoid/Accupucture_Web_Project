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
                    <h1><?php echo $homeContent['section_1_title']; ?></h1>
                    <p><?php echo $homeContent['section_1_paragraph']; ?></p>
                    <button class="appointment-button  popup-button"><?php echo $homeContent['section_1_button_label']; ?></button>
                </div>
            </div>
        </section>

        <div class="gradient_even">
        </div>

        <!-- Section 2 -->
        <section class="section_2">
            <div class="content">
                <div class="section_2_left">
                    <h1><?php echo $homeContent['section_2_title']; ?></h1>
                    <h2><?php echo $homeContent['section_2_subtitle']; ?></h2>
                    <p><?php echo $homeContent['section_2_paragraph1']; ?></p>
                </div>
                <div class="section_2_middle">
                    <div class="profile-picture">
                            <img src="assets/images/IMG-20231028-WA0002.jpg" alt="Image">
                            <img src="assets/images/IMG-20231028-WA0001.jpg" alt="Image">
                    </div>
                </div>
                <div class="section_2_right">
                    <button class="image-text-button">
                        <div class="image-container">
                            <img src="assets/images/130129549-close-up-of-doctor-s-hand-perform-medical-professional-acupuncture-treatment-in-beauty-spa-on-woman.jpg" alt="Image">
                        </div>
                        <div class="label-container">
                            <span><?php echo $homeContent['section_2_button_label_1']; ?></span>
                        </div>
                    </button>
                    <button class="image-text-button">
                        <div class="image-container">
                            <img src="assets/images/130129549-close-up-of-doctor-s-hand-perform-medical-professional-acupuncture-treatment-in-beauty-spa-on-woman.jpg" alt="Image">
                        </div>
                        <div class="label-container">
                            <span><?php echo $homeContent['section_2_button_label_2']; ?></span>
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
                    <h1><?php echo $homeContent['section_3_title']; ?></h1>
                    <h2><?php echo $homeContent['section_3_subtitle_1']; ?></h2>
                    <p>
                        <div class="tooltip-container">
                            <?php echo $homeContent['section_3_paragraph_1_1']; ?>
                            <div class="tooltip">
                                <img src="<?php echo $baseURL; ?>assets/images/tooltip_icon.png" alt="?" class="tooltip-icon">
                                <span class="tooltiptext"><?php echo $homeContent['section_3_tooltip_text']; ?></span>
                            </div>
                            <?php echo $homeContent['section_3_paragraph_1_2']; ?>
                        </div>
                    </p>
                    <h2><?php echo $homeContent['section_3_subtitle_2']; ?></h2>
                    <p><?php echo str_replace(
                        array('[Zhong]', '[Zorgwijzer.nl]'),
                        array('<a href="https://zhong.nl/" class="blue-link">ZHONG</a>', '<a href="https://www.kab-koepel.nl/" class="blue-link">Zorgwijzer.nl</a>'),
                        $homeContent['section_3_paragraph_2']
                    ); ?></p>
                </div>
                <div class="section_3_middle">
                </div>
                <div class="section_3_right">

                    <button class="image-text-button">
                        <div class="image-container">
                            <img src="assets/images/130129549-close-up-of-doctor-s-hand-perform-medical-professional-acupuncture-treatment-in-beauty-spa-on-woman.jpg" alt="Image">
                        </div>
                        <div class="label-container">
                            <span><?php echo $homeContent['section_3_button_label']; ?></span>
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
                <button class="appointment-button  popup-button"><?php echo $homeContent['section_4_left_button_label']; ?></button>
                <div class="section_4_left">
                    <h2><?php echo $indexContent['section_4_left_subtitle']; ?></h2>
                    <p><?php echo $indexContent['section_4_left_paragraph']; ?></p>
                </div>
                <div class="section_4_right">
                    <h1><?php echo $indexContent['section_4_right_title']; ?></h1>
                    <h2><?php echo $indexContent['section_4_right_subtitle']; ?></h2>
                    <p><?php echo $indexContent['section_4_right_paragraph']; ?></p>
                </div>
                <div class="section_4_bottom">
                    <h2><?php echo $indexContent['section_4_left_subtitle_2']; ?></h2>
                    <p><?php echo $indexContent['section_4_left_paragraph_2']; ?></p>
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
                            <div class="qa <?php echo $i % 2 === 1 ? 'left' : 'right'; ?>">
                                <div class="question">
                                    <?php echo $homeContent['section_5_question_'.$i]; ?>
                                </div>
                                <div class="answer" style="max-height: 0px;">
                                    <?php echo $homeContent['section_5_answer_'.$i]; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
            </div>
            <div class="margin"></div>

            <h2><?php echo $homeContent['section_5_subtitle_1']; ?></h2>
            <p><?php echo $homeContent['section_5_paragraph_1']; ?></p>
            <img class="section_3_middle_img_1" src="assets/images/stacks-image-5c587d1.png" alt="Image" >
            <img class="section_3_middle_img_2" src="assets/images/stacks-image-dbb4ead.jpg" alt="Image" >

            <div class="margin"></div>
        </section>
    </div>
</main>

<script src="assets/js/home-script.js"></script> <!-- Link to the javascript file -->