<?php

//enregistrer un emplacement de menu
function photographe_event_register_menu()
{
    register_nav_menu('main-menu', __('Menu principal test', 'text-domain'));
    //pour placer le menu dans la barre structure du menu de WP

}

//pour charger les styles de mon thème.
function photographe_event_theme_enqueue_styles()
// Déclarer le fichier CSS à un autre emplacement
 {     wp_enqueue_style(
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

//actions
add_action('after_setup_theme', 'photographe_event_register_menu');

add_action('wp_enqueue_scripts', 'photographe_event_theme_enqueue_styles');
