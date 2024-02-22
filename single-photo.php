<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage PhotographeEvent
 */


 get_header();

 /* Start the Loop */
 while (have_posts()) :
    the_post();

    // Affichez les détails de la photo ici. Par exemple :
    echo '<h1>' . get_the_title() . '</h1>'; // Le titre de la photo
    //echo '<p>' . get_the_content() . '</p>'; // La description de la photo
    echo '<div class="single_photo">' . get_the_post_thumbnail() . '</div>';// affiche la photo

    // Utilisez des fonctions  pour récupérer les valeurs des champs personnalisés
    $reference = get_field('référence');
    echo '<p>Référence : ' . $reference . '</p>';
    $type = get_field('type');
    echo '<p>Type : ' . $type . '</p>';

    // Récupérez les termes de la taxonomie "format"
$format_terms = get_the_terms(get_the_ID(), 'format');
if (!empty($format_terms) && !is_wp_error($format_terms)) {
    foreach ($format_terms as $term) {
        echo '<p>Format : ' . $term->name . '</p>';
    }
}

// Récupérez les termes de la taxonomie "categories-photo"
$categories_photos_terms = get_the_terms(get_the_ID(), 'categories-photos');
if (!empty($categories_photos_terms) && !is_wp_error($categories_photos_terms)) {
    foreach ($categories_photos_terms as $term) {
        echo '<p>Catégorie : ' . $term->name . '</p>';
    }
}

//récuperez les dates de publication
$year = get_the_date('Y');
echo '<p>Année : ' . $year . '</p>';

//intégration du bouton contact avec la modal
// intégration du bouton contact avec la modal
echo '<div><p>Cette photo vous intéresse ?</p><button id="contactButton" data-reference="' . esc_attr($reference) . '">Contact</button></div>';

// Ajout de la modal
echo '<div id="myModal" class="modal">';
echo do_shortcode('[contact-form-7 id="04bac1f" title="Formulaire de contact 1"]');
echo '</div>';

// Déterminer les ID des photos précédentes et suivantes
$prev_post = get_previous_post();
$next_post = get_next_post();

// Vérifier si les résultats ne sont pas vides ou null
if ($prev_post) {
    $prev_photo_id = $prev_post->ID;
} else {
    $prev_photo_id = null; // ou toute autre valeur par défaut
}

if ($next_post) {
    $next_photo_id = $next_post->ID;
} else {
    $next_photo_id = null; // ou toute autre valeur par défaut
}



// Affichage des liens de navigation avec miniatures
echo '<div>';
if (!empty($prev_photo_id)) {
    echo '<a href="' . get_permalink($prev_photo_id) . '" class="prev-photo-link" title="Photo précédente">';
    echo '<img src="' . get_template_directory_uri() . './assets/images/left-arrow.png" alt="Flèche gauche">';
    echo '<img src="' . wp_get_attachment_image($prev_photo_id) . '" class="thumbnail-preview" alt="Miniature de la photo précédente">';
    echo '</a>';
}
if (!empty($next_photo_id)) {
    echo '<a href="' . get_permalink($next_photo_id) . '" class="next-photo-link" title="Photo suivante">';
    echo '<img src="' . get_template_directory_uri() . './assets/images/right-arrow.png" alt="Flèche droite">';
    echo '</a>';
}
echo '</div>';



endwhile; // End of the Loop.
 
 get_footer();
