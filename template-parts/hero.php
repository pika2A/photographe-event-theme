<?php

//je définis un tableau d'arguments pour ma requête.
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'rand'
);

//je crée une nouvelle instance de WP_Query avec les arguments que j'ai définis.
$hero_image = new WP_Query($args);

if ($hero_image->have_posts()) {
    //je vérifie si ma requête a renvoyé des posts.

    while ($hero_image->have_posts()) {
        //je parcours tous les posts renvoyés par ma requête.

        $hero_image->the_post();
        // Pour chaque post, je vais exécuter le code à l'intérieur des accolades.

        $image_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
        // je récupère l'URL de l'image à la une du post actuel.

        echo '<div class="hero" style="background-image: url(' . $image_url . ')">';
        // je définis son image d'arrière-plan en utilisant l'URL de l'image que j'ai récupérée précédemment.

        echo '<img class="logo_hero" src=" ' .  get_template_directory_uri() . '/assets/images/hero.png" alt="Logo de photographeEvent">';
        // je recupère l'image qui doit venir se mettre sur l'image de fond.

        echo '</div>';
    }
}
