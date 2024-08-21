<?php
/*
 * Template Name: Bejegyzések előnézete
 * Template Author: Bakos Attila
 * Date: 2024
 */
?>

<div class="content col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="wrapper">
        <!-- CÍMSOR -->
        <h3>
            <strong>
                <a href="<?= the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </strong>
        </h3>

        <!-- META -->
        <ul>
            <li>
                <?php the_time(get_option('date_format')); ?>
            </li>
        </ul>

        <!-- TOVÁBB -->
        <?php the_content('Tovább a teljes bejegyzéshez &raquo;'); ?>
    </div>
</div>