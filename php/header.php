<?php

// Load the shared localization data for the header
$headerLocalizationData = json_decode(file_get_contents('localisation/shared_localisation.json'), true);
$headerContent = $headerLocalizationData[$_SESSION['lang']];
?>
<chat-widget
    location-id="JgOoqe6C0MAyDtgxJvFA"
    style="--chat-widget-primary-color: #46C9F0; --chat-widget-active-color:#46C9F0 ;--chat-widget-bubble-color: #46C9F0 ;"
    heading="<?php echo $headerContent['chat_widget_heading']; ?>"
    sub-heading="<?php echo $headerContent['chat_widget_sub_heading']; ?>"
    prompt-msg="<?php echo $headerContent['chat_widget_prompt_msg']; ?>"
    legal-msg="<?php echo $headerContent['chat_widget_legal_msg']; ?>"
    use-email-field="true"
    revisit-prompt-msg="<?php echo $headerContent['chat_widget_revisit_prompt_msg']; ?>"
    support-contact="<?php echo $headerContent['chat_widget_support_contact']; ?>"
    success-msg="<?php echo $headerContent['chat_widget_success_msg']; ?>"
    thank-you-msg="<?php echo $headerContent['chat_widget_thank_you_msg']; ?>"
    prompt-avatar="https://firebasestorage.googleapis.com/v0/b/highlevel-backend.appspot.com/o/locationPhotos%2FJgOoqe6C0MAyDtgxJvFA%2Fchat-widget-person?alt=media&token=22f35409-e8b3-4762-a549-135a7d8ad2cc"
    agency-name="Afspraakmakend"
    agency-website="https://afspraakmakend.nl"
    locale="<?php echo $_SESSION['lang']; ?>"
    send-label="<?php echo $headerContent['chat_widget_send_label']; ?>"
    primary-color="#46C9F0">
</chat-widget>
<script
    src="https://widgets.leadconnectorhq.com/loader.js"
    data-resources-url="https://widgets.leadconnectorhq.com/chat-widget/loader.js" >
</script>
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "m37ojipi9i");
</script>
<header>
    <div class="header-content">
        <div class="left-section">
            <div class="logo">
                <div class="mobile-dropdown-button">
                    <button class="mobile-dropdown-button-icon">☰</button>
                </div>
                <div class="image-logo">
                    <img src="assets/images/Heng_ren_tang_logo_no_text.png" alt="Image">
                    <?php echo $headerContent['header_logo']; ?>
                </div>
            </div>

            <div class="header-buttons page-options" id="page-options">
                <div class="page-option nav-alpha" id="nav1" data-value="home">
                    <button><?php echo $headerContent['header_home_button_label']; ?></button>
                </div>
                <div class="page-option" id="nav2" data-value="services">
                    <button><?php echo $headerContent['header_service_button_label']; ?></button>
                </div>
                <div class="page-option" id="nav3" data-value="staff">
                    <button><?php echo $headerContent['header_staff_button_label']; ?></button>
                </div>
                <div class="page-option nav-omega" id="nav4" data-value="privacy">
                    <button><?php echo $headerContent['header_privacy_button_label']; ?></button>
                </div>
            </div>
        </div>
        <div class="right-section">

            <button onclick="window.open('https://bookings.crossuite.app/ef415adc-c2ee-40c8-a9e6-e1608bda93ca/step2', '_blank')" class="appointment-button appointment-popup"><?php echo $headerContent['header_appointment_button_label']; ?></button>
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
            <!-- Language Selection Dropdown -->
            <div class="language-dropdown">
                <div class="custom-select" id="custom-select">
                    <div class="selected-option">
                        <img src="assets/images/icon-nl.png" alt="English Flag" class="flag-icon"> NL
                    </div>
                    <div class="options" id="options">
                        <div class="option" data-value="en">
                            <img src="assets/images/icon-en.png" alt="English Flag" class="flag-icon"> EN
                        </div>
                        <div class="option" data-value="nl">
                            <img src="assets/images/icon-nl.png" alt="Dutch Flag" class="flag-icon"> NL
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php //echo 'File Path: ' . $rootPath . 'localisation/shared_localisation.json'; ?>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
