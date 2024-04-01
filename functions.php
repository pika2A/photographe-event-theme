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

    // Ajout du CSS de Select2
    wp_enqueue_style(
        'select2-css',
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css',
        array(),
        '4.1.0-beta.1'
    );
}

// Fonction pour charger mes scripts
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

    wp_enqueue_script(
        'filtre_photos',
        get_template_directory_uri() . '/js/filter-photos.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_localize_script('filtre_photos', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));

    // Ajout du JavaScript de Select2
    wp_enqueue_script(
        'select2-js',
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js',
        array('jquery'),
        '4.1.0-beta.1',
        true
    );

    // Ajout du script pour initialiser Select2 sur les éléments <select>
    wp_enqueue_script(
        'select2-init',
        get_template_directory_uri() . '/js/select2-init.js',
        array('jquery', 'select2-js'),
        '1.0.0',
        true
    );
}

// Cette fonction gère la requête et renvoie les résultats
function handle_request($category, $format, $order, $paged)
{
    // Initialisation de la requête
    $tax_query = array();

    // Si une catégorie est spécifiée, ajoutez-la à la requête
    if (!empty($category)) {
        $tax_query[] = [
            'taxonomy' => 'categories-photos',
            'field' => 'slug',
            'terms' => $category
        ];
    }

    // Si un format est spécifié, ajoutez-le à la requête
    if (!empty($format)) {
        $tax_query[] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format
        ];
    }

    // Exécute la requête avec les paramètres spécifiés
    $ajaxposts = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $paged,
        'tax_query' => $tax_query,
        'orderby' => 'date',
        'order' => $order,
    ]);

    // Initialisation de la réponse
    $response = '';
    // Obtention du nombre maximum de pages
    $max_pages = $ajaxposts->max_num_pages;

    // Si la requête a des résultats
    if ($ajaxposts->have_posts()) {
        // Démarre la capture de sortie
        ob_start();
        // Parcourez tous les posts
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            // Définissez les variables de requête pour la référence de la photo et la catégorie
            set_query_var('photo_reference', get_field('référence'));
            set_query_var('category', get_the_terms(get_the_ID(), 'categories-photos')[0]);
            // Ajoutez le bloc de photo à la réponse
            $response .= get_template_part('template-parts/photo_block');
        endwhile;
        // Obtenez le contenu de la capture de sortie et nettoyez-la
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        // Si la requête n'a pas de résultats, la réponse est vide
        $response = '';
    }

    // Retourne le résultat sous forme de tableau
    return [
        'max' => $max_pages,
        'html' => $output,
    ];
}

// Cette fonction est appelée pour charger plus de photos
function photo_load_more()
{
    // Appelle la fonction handle_request avec les paramètres POST
    $result = handle_request($_POST['category'], $_POST['format'], $_POST['order'], $_POST['paged']);
    // Renvoie le résultat sous forme de JSON
    echo json_encode($result);
    exit;
}

// Cette fonction est appelée pour filtrer les photos
function filter_photos()
{
    // Appelle la fonction handle_request avec les paramètres POST
    $result = handle_request($_POST['category'], $_POST['format'], $_POST['order'], 1);
    // Renvoie le résultat sous forme de JSON
    echo json_encode($result);
    exit;
}

//actions
add_action('after_setup_theme', 'photographe_event_register_menu');

add_action('wp_enqueue_scripts', 'photographe_event_theme_enqueue_styles');

add_action('wp_enqueue_scripts', 'photographe_event_enqueue_scripts');

add_action('wp_ajax_photo_load_more', 'photo_load_more');
add_action('wp_ajax_nopriv_photo_load_more', 'photo_load_more');


add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
