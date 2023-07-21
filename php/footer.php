<?php
$path = $_SERVER['DOCUMENT_ROOT'];

// Load the shared localization data for the footer
$footerLocalizationData = json_decode(file_get_contents($path.'/localisation/shared_localisation.json'), true);
$footerContent = $footerLocalizationData[$_SESSION['lang']];
?>

<footer>
    <div class="footer-content">
        <div class="footer-logo"><?php echo $footerContent['footer_logo']; ?></div>
        <div class="footer-links">
            <a href="#"><?php echo $footerContent['footer_link_1']; ?></a>
            <a href="#"><?php echo $footerContent['footer_link_2']; ?></a>
            <a href="#"><?php echo $footerContent['footer_link_3']; ?></a>
        </div>
    </div>
</footer>
