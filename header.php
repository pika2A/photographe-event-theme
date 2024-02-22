<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photograohe Event</title>
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() . './assets/images/appareil-photo.png' ; ?> ">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>
    <header class="header">
        <a href="http://photographe-event.local/">
            <img class="logo" src="<?php echo get_template_directory_uri() . '/assets/images/logo.png'; ?> " alt="Logo de photographeEvent">
        </a>
    <nav>
        <button class="menu-toggle" aria-controls="menu" aria-expanded="false">
            <div class="menu-toggle-icon">
                <span class="line" ></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </button>
        
        <?php wp_nav_menu([
            'theme_location' => 'main-menu',
        ]); ?>
    </nav>

    </header>

    <main>