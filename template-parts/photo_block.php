<?php
// Je récupère la catégorie de la photo courante.
$category = get_query_var('category');

// Je récupère la référence de la photo courante.
$reference = get_field('référence');
?>

<!-- J'ouvre une div avec la classe "photo". Cette div contiendra la photo et ses informations. -->
<div class="photo">

    <?php
    // J'affiche la miniature de la photo courante.
    echo get_the_post_thumbnail();
    ?>

    <!-- J'ouvre une div avec la classe "hover_photo". Cette div contiendra les icônes qui apparaissent lorsque l'utilisateur survole la photo. -->
    <div class="hover_photo">

        <!-- J'ouvre un lien autour de l'icône "oeil" pour rediriger vers la page de la photo. -->
        <a href="<?php the_permalink(); ?>" class="eye-link">
            <!-- J'affiche une icône "oeil" qui indique que l'utilisateur peut cliquer pour voir la photo. -->
            <img class="eye" src="<?php echo get_template_directory_uri(); ?>/assets/images/eye-icon.png" alt="icone oeil pour voir la photo">
        </a>

        <!-- J'ouvre une balise span qui contient l'URL de la photo en taille réelle, la référence de la photo et la catégorie de la photo. -->
        <span data-image-url="<?php echo get_the_post_thumbnail_url(); ?>" data-reference="<?php echo esc_attr($reference); ?>" data-category="<?php echo $category->name; ?>">


            <!-- J'affiche une icône "fullscreen" qui indique que l'utilisateur peut cliquer pour voir la photo en plein écran. -->
            <img class="fullscreen" src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen-icon.png" alt="icon pour agrandir la photo">

        </span>

        <!-- J'affiche la référence de la photo. -->
        <p class="reference">Référence : <?php echo esc_attr($reference); ?></p>

        <!-- J'affiche la catégorie de la photo. -->
        <p class="categorie">Catégorie : <?php echo $category->name; ?></p>

        <!-- Je ferme la div "hover_photo". -->
    </div>

    <!-- Je ferme la div "photo". -->
</div>