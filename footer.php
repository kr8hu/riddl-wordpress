</div>

<!-- WIDGET AREA -->
<div class="widgetarea">
    <div class="background"></div>
    <div class="layer"></div>
    <div class="container">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Widget Area')) : ?>
        <?php endif; ?>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12-col-md-6 col-lg-6 <?= wp_is_mobile() ? "text-center" : "text-left" ?>">
                &copy; <?= date('Y') . " " . get_bloginfo('name') ?>
            </div>
            <div class="col-xs-12 col-sm-12-col-md-6 col-lg-6 <?= wp_is_mobile() ? "text-center" : "text-right" ?>">
                Lorem Ipsum
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>