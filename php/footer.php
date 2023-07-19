<?php
// Load the shared localization data for the footer
$footerLocalizationFile = 'shared_localization.json';
$footerLocalizationData = json_decode(file_get_contents($footerLocalizationFile), true);
$footerContent = $footerLocalizationData[$selectedLanguage];
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
    
</body>
</html>