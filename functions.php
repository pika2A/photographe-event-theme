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
        'photographe_event_custom',
        get_template_directory_uri() . '/sass/style.css',
        array(),
        '1.0'
    );

    // Déclarer le fichier style.css à la racine du thème
    wp_enqueue_style(
        'photographe_event_main',
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

    wp_enqueue_script(
        'pagination',
        get_template_directory_uri() . '/js/pagination.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_localize_script('pagination', 'theme_directory', array('uri' => get_template_directory_uri()));
}


//PAGINATION
function photo_load_more()
{
    $ajaxposts = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $_POST['paged'],
    ]);

    $response = '';
    $max_pages = $ajaxposts->max_num_pages;

    if ($ajaxposts->have_posts()) {
        ob_start();
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            set_query_var('photo_reference', get_field('référence'));
            set_query_var('category', get_the_terms(get_the_ID(), 'categories-photos')[0]);
            $response .= get_template_part('template-parts/photo_block');
        endwhile;
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        $response = '';
    }

    $result = [
        'max' => $max_pages,
        'html' => $output,
    ];

    echo json_encode($result);
    exit;
}
add_action('wp_ajax_photo_load_more', 'photo_load_more');
add_action('wp_ajax_nopriv_photo_load_more', 'photo_load_more');


//actions
add_action('after_setup_theme', 'photographe_event_register_menu');

add_action('wp_enqueue_scripts', 'photographe_event_theme_enqueue_styles');

add_action('wp_enqueue_scripts', 'photographe_event_enqueue_scripts');
