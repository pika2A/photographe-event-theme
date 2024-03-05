 <?php
    // Récupération des informations de la photo
    $reference = get_field('référence');
    $category = get_the_terms(get_the_ID(), 'categories-photos')[0];
    ?>

 <div id="lightbox">
     <!-- Bouton pour fermer la lightbox -->
     <button class="cross"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/close.png" alt="croix pour fermer la lightbox"></button>

     <!-- Affichage de la photo -->
     <img class="lightbox-photo lightbox-image" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Photo en plein écran">

     <!-- Zone d'information et d'interaction -->
     <div class="lightbox-info">
         <p class="reference">Référence : <?php echo $reference; ?></p>
         <p class="category">Catégorie : <?php echo $category->name; ?></p>
     </div>

     <!-- Boutons de navigation -->
     <button class="prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/prev.png" alt="fleche pour la photo précédente"></button>
     <button class="next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/next.png" alt="fleche pour la photo suivante"></button>
 </div>