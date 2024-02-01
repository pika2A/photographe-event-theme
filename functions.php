<?php

//pour charger les styles de mon thème.
function theme_enqueue_styles()
{
    // Charge le fichier style.css du thème parent.
    wp_enqueue_style('PhotographeEvent', get_template_directory_uri() . '/style.css', array(), 1.0);
}

//actions
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
