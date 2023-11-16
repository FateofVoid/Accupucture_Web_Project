<?php
// Load the specific localization data for privacy.php
$privacyLocalizationData = json_decode(file_get_contents('localisation/privacy_localisation.json'), true);
$privacyContent = $privacyLocalizationData[$_SESSION['lang']];
?>

<main>
    <div class="margin"></div>

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
</main>
