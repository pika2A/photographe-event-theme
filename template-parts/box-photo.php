<?php
$categories_photos_terms = get_the_terms(get_the_ID(), 'categories-photos');
if (!empty($categories_photos_terms) && !is_wp_error($categories_photos_terms)) {
    $term_ids = array_map(function ($term) {
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
    echo '<section class="section_suggestion">'; // Crée un conteneur pour les photos suggérées
    echo '<h2>Vous aimerez aussi :</h2>'; // Ajoute un titre pour la section des photos suggérées
    echo '<div class="suggestion_photo">';

    foreach ($related_photos as $photo) { // Parcoure chaque photo suggérée
        $related_photo_reference = get_field('référence', $photo->ID); //récupère la référence de la photo
        $category = get_the_terms($photo->ID, 'categories-photos')[0];
        echo '<div class="related-photo">'; // Crée un conteneur pour chaque photo suggérée

        echo get_the_post_thumbnail($photo->ID); // Affiche la photo
        echo '<div class="hover_photo">'; // conteneur pour le hover
        echo '<a href="' . get_permalink($photo->ID) . '" title="' . get_the_title($photo->ID) . '">'; // Crée un lien vers la page de la photo
        echo '<img class="eye" src="' . get_template_directory_uri() . './assets/images/eye-icon.png" alt="icone oeil pour voir la photo">'; //affiche icone oeil pour voir la photo
        echo '</a>';

        echo '<a href="' . get_the_post_thumbnail_url($photo->ID) . '" data-image-url="' . get_the_post_thumbnail_url($photo->ID) . '" data-reference="' . esc_attr($related_photo_reference) . '" data-category="' . $category->name . '">';
        echo '<img class="fullscreen" src="' . get_template_directory_uri() . '/assets/images/fullscreen-icon.png" alt="icon pour agrandir la photo">';
        echo '</a>';

        echo '<p class="reference">Référence : ' . esc_attr($related_photo_reference) . '
        </p>';
        echo '<p class="categorie">Catégorie : ' . $category->name . '</p>'; // Affiche la catégorie de la photo suggérée
        echo '</div>';
        echo '</div>'; // Ferme le conteneur de la photo suggérée
    }
    echo '</div>';
    echo '</section>'; // Ferme le conteneur des photos suggérées
}
