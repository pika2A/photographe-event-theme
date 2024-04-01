</main>

<footer class="footer">

    <!-- j'integre le footer de mon interface WP -->
    <?php wp_nav_menu([
        'theme_location' => 'footer-menu',
    ]); ?>

    <p class="footer_droits">Tous droits réservés</p>

    <!-- j'integre ma modale -->
    <?php get_template_part('template-parts/contact-modal'); ?>

    <?php wp_footer(); ?>

</footer>

</body>

</html>