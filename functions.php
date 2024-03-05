<?php

//enregistrer un emplacement de menu
function photographe_event_register_menu()
{
    register_nav_menu('main-menu', __('Menu principal', 'text-domain'));
    //pour placer le menu dans la barre structure du menu de WP
    register_nav_menu('footer-menu', __('Menu de pied de page', 'text-domain')); // Nouveau menu de pied de page

}

//pour charger les styles de mon thème.
function photographe_event_theme_enqueue_styles()
{
    // Déclarer le fichier CSS à un autre emplacement
    wp_enqueue_style(
        'photographe_event',
        get_template_directory_uri() . '/sass/style.css',
        array(),
        '1.0'
    );

    // Déclarer le fichier style.css à la racine du thème
    wp_enqueue_style(
        'photographe_event',
        get_stylesheet_uri(),
        array(),
        '1.0'
    );
}

// Ajout de JavaScript pour gérer le menu mobile
function photographe_event_enqueue_scripts()
{

    // Ajout du script pour ouvrir la modal avec le boutton contact
    wp_enqueue_script(
        'contact-script', // Nom de mon script
        get_template_directory_uri() . '/js/contact.js', // Emplacement de mon script
        array('jquery'), // Dépendances de mon script
        '1.0', // Version de mon script
        true
    ); // Charger le script dans le pied de page


    // Ajout du script pour la modale
    wp_enqueue_script(
        'photographe_event_modal',
        get_template_directory_uri() . '/js/modal.js',
        array(),
        '1.0',
        true
    );

    // Ajout du script pour le menu burger
    wp_enqueue_script(
        'photographe_event_menu',
        get_template_directory_uri() . '/js/menu.js',
        array(),
        '1.0',
        true
    );
    // Ajout du script pour les miniatures
    wp_enqueue_script(
        'photographe_event_miniature',
        get_template_directory_uri() . '/js/miniature.js',
        array(),
        '1.0',
        true
    );

    wp_enqueue_script(
        'photographe_event_lightbox',
        get_template_directory_uri() . '/js/lightbox.js',
        array(),
        '1.0',
        true
    );
}


//actions
add_action('after_setup_theme', 'photographe_event_register_menu');

add_action('wp_enqueue_scripts', 'photographe_event_theme_enqueue_styles');

add_action('wp_enqueue_scripts', 'photographe_event_enqueue_scripts');
