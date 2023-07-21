<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heng Ren Tang - Home Page</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="favicon.ico" type="assets/images/x-icon">
</head>
<body>
    <?php
    include "php/header.php";

    // Load the specific localization data for index.php
    $indexLocalizationData = json_decode(file_get_contents('localisation/Index_localisation.json'), true);
    $indexContent = $indexLocalizationData[$_SESSION['lang']];
    ?>

    <main>
        <!-- Section 1 -->
        <section class="section section_1">
            <video class="video">
                <!-- Video goes here -->
            </video>
            <div class="content">
                <h1><?php echo $indexContent['section_1_title']; ?></h1>
                <p><?php echo $indexContent['section_1_paragraph']; ?></p>
                <button><?php echo $indexContent['section_1_button_label']; ?></button>
            </div>
        </section>

        <!-- Section 2 -->
        <section class="section section_2">
            <div class="content">
                <h1><?php echo $indexContent['section_2_title']; ?></h1>
                <h2><?php echo $indexContent['section_2_subtitle']; ?></h2>
                <p><?php echo $indexContent['section_2_paragraph']; ?></p>
                <figure class="profile_picture">
                    <!-- Profile picture goes here -->
                    <figcaption><?php echo $indexContent['profile_text']; ?></figcaption>
                </figure>
                <button><?php echo $indexContent['section_2_button_label_1']; ?></button>
                <button><?php echo $indexContent['section_2_button_label_2']; ?></button>
            </div>
        </section>

        <!-- Section 3 -->
        <section class="section section_3">
            <div class="content">
                <h1><?php echo $indexContent['section_3_title']; ?></h1>
                <h2><?php echo $indexContent['section_3_subtitle_1']; ?></h2>
                <p>
                    <?php echo $indexContent['section_3_paragraph_1']; ?>
                    <span class="tooltip"><?php echo $indexContent['tooltip_text']; ?></span>
                </p>
                <h2><?php echo $indexContent['section_3_subtitle_2']; ?></h2>
                <p><?php echo $indexContent['section_3_paragraph_2']; ?></p>
                <button><?php echo $indexContent['section_3_button_label']; ?></button>
            </div>
        </section>

        <!-- Section 4 -->
        <section class="section section_4">
            <div class="content">
                <h1><?php echo $indexContent['section_4_title']; ?></h1>
                <h2><?php echo $indexContent['section_4_subtitle']; ?></h2>
                <p><?php echo $indexContent['section_4_paragraph']; ?></p>
                <div class="map">
                    <!-- Map goes here -->
                </div>
                <button><?php echo $indexContent['section_4_button_label']; ?></button>
                <h2><?php echo $indexContent['section_4_subtitle_2']; ?></h2>
                <p><?php echo $indexContent['section_4_paragraph_2']; ?></p>
            </div>
        </section>

        <!-- Section 5 -->
        <section class="section section_5">
            <h1><?php echo $indexContent['section_5_title']; ?></h1>
        </section>
    </main>

    <?php
    include "php/footer.php";
    ?>

</body>
</html>