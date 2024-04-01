<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères pour la page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend la page web responsive -->
    <title>Photograohe Event</title> <!-- Définit le titre de la page -->
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() . './assets/images/appareil-photo.png'; ?> "> <!-- Définit l'icône de la page -->
    <?php wp_head(); ?> <!-- Inclut les scripts et les styles de WordPress et des plugins -->
</head>

<body <?php body_class(); ?>> <!-- Ajoute des classes au corps pour aider à styliser spécifiquement cette page -->
    <?php wp_body_open(); ?> <!-- Permet aux plugins d'injecter du code juste après l'ouverture de la balise body -->
    <header>
        <div class="header">
            <a class="logo1" href="http://photographe-event.local/"> <!-- Lien vers la page d'accueil -->
                <img class="logo" src="<?php echo get_template_directory_uri() . '/assets/images/logo.png'; ?> " alt="Logo de photographeEvent"> <!-- Logo du site -->
            </a>
            <nav>
                <button class="menu-toggle" aria-controls="menu" aria-expanded="false"> <!-- Bouton pour afficher le menu sur les petits écrans -->
                    <div class="menu-toggle-icon">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </button>
                <?php wp_nav_menu([
                    'theme_location' => 'main-menu',
                ]); ?> <!-- Affiche le menu principal -->
            </nav>
        </div>
    </header>
    <main> <!-- Début du contenu principal -->