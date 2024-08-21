<?php
/*
 * Template Name: Egy oldal tartalma
 * Template Author: Bakos Attila
 * Date: 2024
 */
?>

<!-- Header -->
<?php get_header(); ?>

<!-- Tartalom -->
<?php
if (have_posts()) : while (have_posts()) : the_post();
        the_content();
    endwhile;
endif;
?>

<!-- Footer -->
<?php get_footer(); ?>