<?php
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
