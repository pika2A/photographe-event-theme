<?php get_header(); ?>

<?php
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8,
);

$related_photos = new WP_Query($args);

if ($related_photos->have_posts()) {

    echo '<section class="block_photo">';

    while ($related_photos->have_posts()) {
        $related_photos->the_post();

        // Définissez les variables que vous voulez passer au template
        set_query_var('related_photo_reference', get_field('référence'));
        set_query_var('category', get_the_terms(get_the_ID(), 'categories-photos')[0]);

        get_template_part('template-parts/photo_block');
    }

    echo '</section>';

    get_template_part('template-parts/lightbox');
}
?>

<?php get_footer(); ?>
