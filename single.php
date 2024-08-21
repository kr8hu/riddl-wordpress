<?php
/*
 * Template Name: Egy bejegyzés teljes tartalma
 * Template Author: Bakos Attila
 * Date: 2021.07.20
 */
?>

<!-- Header -->
<?php get_header(); ?>

<!-- Tartalom -->
<div class="single">
    <?php
    if (have_posts()) : while (have_posts()) : the_post();
            the_content('');
        endwhile;
    endif;
    ?>

    <p class="text-right">
        <span>
            <strong>Bejegyzés létrehozva: </strong>
            <br />
            <?= the_time(get_option('date_format')) ?>
        </span>
    </p>
</div>

<!-- Footer -->
<?php get_footer(); ?>