<?php get_header(); ?>


<!-- section hero -->
<section class="section_hero">
    <?php get_template_part('template-parts/hero'); ?>
</section>


<section class="filter-photos">
    <?php $categories = get_terms('categories-photos'); // Remplacez 'category' par le slug de votre taxonomie. 
    ?>
    <select id="category-filter">
        <option value="">Catégories</option>
        <?php foreach ($categories as $category) : ?>
            <option value="<?= esc_attr($category->slug); ?>"><?= esc_html($category->name); ?></option>
        <?php endforeach; ?>
    </select>

    <?php $formats = get_terms('format'); // Remplacez 'format' par le slug de votre taxonomie. 
    ?>
    <select id="format-filter">
        <option value="">Formats</option>
        <?php foreach ($formats as $format) : ?>
            <option value="<?= esc_attr($format->slug); ?>"><?= esc_html($format->name); ?></option>
        <?php endforeach; ?>
    </select>

    <select id="order-filter">
        <option value="">Tier par</option>
        <option value="DESC">La plus récente</option>
        <option value="ASC">La plus ancienne</option>
    </select>

    <!-- section liste photos -->
    <section class="section_block-photo">
        <div id="photos" class="block_photo">
            <?php
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 8,
                'paged' => 1,
                'orderby' => 'rand',
            );

            $photos = new WP_Query($args);

            if ($photos->have_posts()) {
                while ($photos->have_posts()) {
                    $photos->the_post();
                    // Définissez les variables que vous voulez passer au template
                    set_query_var('photo_reference', get_field('référence'));
                    set_query_var('category', get_the_terms(get_the_ID(), 'categories-photos')[0]);
                    get_template_part('template-parts/photo_block');
                }
            }

            ?>
        </div>
        <div class="btn_load-more">
            <button id="load-more" class="hover_button">Charger plus </button>
        </div>
    </section>

    <?php get_template_part('template-parts/lightbox'); ?>

    <?php get_footer(); ?>