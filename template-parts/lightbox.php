<?php
// Je récupère la référence de la photo courante.
$reference = get_field('référence');

// Je récupère la catégorie de la photo courante.
$category = get_the_terms(get_the_ID(), 'categories-photos')[0];
?>

<!-- J'ouvre une div avec l'ID "lightbox". Cette div contiendra la lightbox. -->
<div id="lightbox">

    <!-- J'ajoute un bouton pour fermer la lightbox. Ce bouton contient une image d'une croix. -->
    <button class="cross"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/close.png" alt="croix pour fermer la lightbox"></button>

    <!-- J'affiche la photo en plein écran. L'URL de l'image est récupérée avec la fonction get_the_post_thumbnail_url(). -->
    <img class="lightbox-photo lightbox-image" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Photo en plein écran">

    <!-- J'ouvre une div pour les informations et les interactions de la lightbox. -->
    <div class="lightbox-info">

        <!-- J'affiche la référence de la photo. -->
        <p class="reference">Référence : <?php echo $reference; ?></p>

        <!-- J'affiche la catégorie de la photo. -->
        <p class="category">Catégorie : <?php echo $category->name; ?></p>
    </div>

    <!-- J'ajoute un bouton pour naviguer vers la photo précédente. Ce bouton contient une image d'une flèche pointant vers la gauche. -->
    <button class="prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/prev.png" alt="fleche pour la photo précédente"></button>

    <!-- J'ajoute un bouton pour naviguer vers la photo suivante. Ce bouton contient une image d'une flèche pointant vers la droite. -->
    <button class="next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/next.png" alt="fleche pour la photo suivante"></button>

    <!-- Je ferme la div "lightbox". -->
</div>