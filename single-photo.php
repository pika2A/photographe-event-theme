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


// intégration du bouton contact avec la modal
echo '<div><p>Cette photo vous intéresse ?</p><button id="contactButton" class="hover_button" data-reference="' . esc_attr($reference) . '">Contact</button></div>';

// Ajout de la modal
echo '<div id="myModal" class="modal">';
echo do_shortcode('[contact-form-7 id="04bac1f" title="Formulaire de contact 1"]');
echo '</div>';

// Récupérez le post précédent et le post suivant
$prev_post = get_previous_post();
$next_post = get_next_post();

// Vérifiez si le post précédent existe
if (!empty($prev_post)) {
    // Si oui, récupérez son ID
    $prev_photo_id = $prev_post->ID;
    // Créez un lien vers le post précédent
    // L'attribut data-thumb contient l'URL de la miniature de la photo précédente
    echo '<a href="' . get_permalink($prev_photo_id) . '" class="prev-photo-link" title="Photo précédente" data-thumb="' . get_the_post_thumbnail_url($prev_photo_id, 'thumbnail') . '">';
    // Affichez une image de flèche gauche
    echo '<img src="' . get_template_directory_uri() . './assets/images/left-arrow.png" alt="Flèche gauche">';
    echo '</a>';
}

// Faites la même chose pour le post suivant
if (!empty($next_post)) {
    $next_photo_id = $next_post->ID;
    echo '<a href="' . get_permalink($next_photo_id) . '" class="next-photo-link" title="Photo suivante" data-thumb="' . get_the_post_thumbnail_url($next_photo_id, 'thumbnail') . '">';
    echo '<img src="' . get_template_directory_uri() . './assets/images/right-arrow.png" alt="Flèche droite">';
    echo '</a>';
}

echo '</div>';

endwhile; // End of the Loop.

$categories_photos_terms = get_the_terms(get_the_ID(), 'categories-photos');
if (!empty($categories_photos_terms) && !is_wp_error($categories_photos_terms)) {
    $term_ids = array_map(function($term) {
        return $term->term_id;
    }, $categories_photos_terms);
    $related_photos = get_posts(array(
        'post_type' => 'photo',
        'posts_per_page' => 2,
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            array(
                'taxonomy' => 'categories-photos',
                'field'    => 'term_id',
                'terms'    => $term_ids,
            ),
        ),
    ));
}

if (!empty($related_photos)) {
    echo '<div class="related-photos">';
    echo '<h2>Vous aimerez aussi :</h2>';
    foreach ($related_photos as $photo) {
        echo '<div class="related-photo">';
        echo '<a href="' . get_permalink($photo->ID) . '" title="' . get_the_title($photo->ID) . '">';
        echo get_the_post_thumbnail($photo->ID);
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
}

 
 get_footer();
