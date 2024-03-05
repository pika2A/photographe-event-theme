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
    echo '<section class="section_photo">';
    echo '<div class="description_photo">';
    // Affichez les détails de la photo ici. Par exemple :
    echo '<h1>' . get_the_title() . '</h1>'; // Le titre de la photo
    //echo '<p>' . get_the_content() . '</p>'; // La description de la photo

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
    echo '</div>';

    echo '<div class="single_photo">' . get_the_post_thumbnail() . '</div>'; // affiche la photo
    echo '</section>';

    echo '<section class="section_navigation">';
    // intégration du bouton contact avec la modal
    echo '<div class="contact_photo">
            <p>Cette photo vous intéresse ?</p>
            <button id="contactButton" class="hover_button" data-reference="' . esc_attr($reference) . '">Contact</button>
        </div>';

    // Ajout de la modal
    echo '<div id="myModal" class="modal">';
    echo do_shortcode('[contact-form-7 id="04bac1f" title="Formulaire de contact 1"]');
    echo '</div>';

    echo '<div class="navigation_photo">';
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
        echo '<div class="thumbnail"></div>'; //pour afficher la miniature
        echo '</a>';
    }

    // la même chose pour le post suivant
    if (!empty($next_post)) {
        $next_photo_id = $next_post->ID;
        echo '<a href="' . get_permalink($next_photo_id) . '" class="next-photo-link" title="Photo suivante" data-thumb="' . get_the_post_thumbnail_url($next_photo_id, 'thumbnail') . '">';
        echo '<img src="' . get_template_directory_uri() . './assets/images/right-arrow.png" alt="Flèche droite">';
        echo '<div class="thumbnail"></div>'; // div pour afficher la miniature
        echo '</a>';
    }
    echo '</div>';
    echo '</section>';

endwhile; // End of the Loop.

// integration de la section box-photo
get_template_part('template-parts/box-photo');

get_footer();
