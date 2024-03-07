<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage PhotographeEvent
 */

// J'inclus l'en-tête de la page.
get_header();

// Je commence une boucle qui parcourt tous les articles (dans ce cas, il devrait y avoir un seul article car nous sommes sur une page de type "single").
while (have_posts()) :
    the_post();

    // J'ouvre une section pour la photo avec une classe "section_photo".
    echo '<section class="section_photo">';

    // J'ouvre une div pour la description de la photo avec une classe "description_photo".
    echo '<div class="description_photo">';

    // J'affiche le titre de la photo.
    echo '<h1>' . get_the_title() . '</h1>';

    // Je récupère la référence de la photo et je l'affiche.
    $reference = get_field('référence');
    echo '<p>Référence : ' . $reference . '</p>';

    // Je récupère le type de la photo et je l'affiche.
    $type = get_field('type');
    echo '<p>Type : ' . $type . '</p>';

    // Je récupère les termes de la taxonomie "format" pour la photo courante et je les affiche.
    $format_terms = get_the_terms(get_the_ID(), 'format');
    if (!empty($format_terms) && !is_wp_error($format_terms)) {
        foreach ($format_terms as $term) {
            echo '<p>Format : ' . $term->name . '</p>';
        }
    }

    // Je récupère les termes de la taxonomie "categories-photo" pour la photo courante et je les affiche.
    $categories_photos_terms = get_the_terms(get_the_ID(), 'categories-photos');
    if (!empty($categories_photos_terms) && !is_wp_error($categories_photos_terms)) {
        foreach ($categories_photos_terms as $term) {
            echo '<p>Catégorie : ' . $term->name . '</p>';
        }
    }

    // Je récupère l'année de publication de la photo et je l'affiche.
    $year = get_the_date('Y');
    echo '<p>Année : ' . $year . '</p>';

    // Je ferme la div "description_photo".
    echo '</div>';

    // J'affiche la photo dans une div avec une classe "single_photo".
    echo '<div class="single_photo">' . get_the_post_thumbnail() . '</div>';

    // Je ferme la section "section_photo".
    echo '</section>';

    // J'ouvre une section pour la navigation avec une classe "section_navigation".
    echo '<section class="section_navigation">';

    // J'intègre le bouton de contact avec la modal.
    echo '<div class="contact_photo">
    <p>Cette photo vous intéresse ?</p>
    <button id="contactButton" class="hover_button" data-reference="' . esc_attr($reference) . '">Contact</button>
    </div>';

    // J'ajoute la modal.
    echo '<div id="myModal" class="modal">';
    echo do_shortcode('[contact-form-7 id="04bac1f" title="Formulaire de contact 1"]');
    echo '</div>';

    // J'ouvre une div pour la navigation de la photo avec une classe "navigation_photo".
    echo '<div class="navigation_photo">';

    // Je récupère le post précédent et le post suivant.
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    // Si le post précédent existe, j'affiche un lien vers lui avec une flèche gauche.
    if (!empty($prev_post)) {
        $prev_photo_id = $prev_post->ID;
        echo '<a href="' . get_permalink($prev_photo_id) . '" class="prev-photo-link" title="Photo précédente" data-thumb="' . get_the_post_thumbnail_url($prev_photo_id, 'thumbnail') . '">';
        echo '<img src="' . get_template_directory_uri() . './assets/images/left-arrow.png" alt="Flèche gauche">';
        echo '<div class="thumbnail"></div>';
        echo '</a>';
    }

    // Si le post suivant existe, j'affiche un lien vers lui avec une flèche droite.
    if (!empty($next_post)) {
        $next_photo_id = $next_post->ID;
        echo '<a href="' . get_permalink($next_photo_id) . '" class="next-photo-link" title="Photo suivante" data-thumb="' . get_the_post_thumbnail_url($next_photo_id, 'thumbnail') . '">';
        echo '<img src="' . get_template_directory_uri() . './assets/images/right-arrow.png" alt="Flèche droite">';
        echo '<div class="thumbnail"></div>';
        echo '</a>';
    }

    // Je ferme la div "navigation_photo".
    echo '</div>';

    // Je ferme la section "section_navigation".
    echo '</section>';

// Je termine la boucle.
endwhile;

// Je récupère les termes de la taxonomie "categories-photos" pour la photo courante.
$categories_photos_terms = get_the_terms(get_the_ID(), 'categories-photos');
if (!empty($categories_photos_terms) && !is_wp_error($categories_photos_terms)) {
    $term_ids = array_map(function ($term) {
        return $term->term_id;
    }, $categories_photos_terms);
    $args = array(
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
    );
    $related_photos = new WP_Query($args);
}

// Si il y a des photos liées, je les affiche dans une section "section_suggestion".
if ($related_photos->have_posts()) {
    echo '<section class="section_suggestion">';
    echo '<h2>Vous aimerez aussi :</h2>';
    echo '<div class="block_photo">';
    while ($related_photos->have_posts()) {
        $related_photos->the_post();
        set_query_var('related_photo_reference', get_field('référence'));
        set_query_var('category', get_the_terms(get_the_ID(), 'categories-photos')[0]);
        get_template_part('template-parts/photo_block');
    }
    wp_reset_postdata();
    echo '</div>';
    echo '</section>';

    // J'inclus le template de la lightbox.
    get_template_part('template-parts/lightbox');
}

// J'inclus le pied de page de la page.
get_footer();
