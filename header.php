<!DOCTYPE html>
<html lang="hu">

<?php
$user = wp_get_current_user();
?>

<head>
    <!-- SITE META -->
    <meta charset="UTF-8">
    <meta name="author" content="riddl">
    <meta name="description" content="<?= get_bloginfo('description'); ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- FB META -->
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Riddl" />
    <meta property="og:description" content="Lorem Ipsum" />
    <meta property="og:image" content="<?= get_template_directory_uri() . '/images/logo.png' ?>" />

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- STYLES -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/style.css' ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/style-font.css' ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/style-header.css' ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/style-content.css' ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/style-single.css' ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/style-footer.css' ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/style-mobile.css' ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/bootstrap.min.css' ?>">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/bootstrap-theme.min.css' ?>"> -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/css/font-awesome.min.css' ?>">

    <!-- SCRIPTS -->
    <script src="<?= get_template_directory_uri() . '/js/jquery-3.2.1.min.js' ?>"></script>
    <script src="<?= get_template_directory_uri() . '/js/bootstrap.min.js' ?>"></script>

    <!-- ICON -->
    <link rel="icon" href="<?= get_template_directory_uri() . '/images/favicon.png' ?>">

    <!-- TITLE -->
    <title><?= the_title() ?> - <?= bloginfo('title') ?></title>

    <!-- WP HEAD -->
    <?php wp_head(); ?>
</head>

<body id="body" <?= body_class() ?> data-mobile="<?= wp_is_mobile() ? "true" : "false" ?>">
    <!-- Fejléc -->
    <header class="header">
        <nav class="nav-header">
            <div class="container">
                <div class="nav-row">
                    <!-- Oldal címe -->
                    <div class="nav-col">
                        <a class="site-title" href="<?= get_site_url() ?>">
                            <?= bloginfo('name'); ?>
                        </a>
                    </div>

                    <!-- Bal oldali menüsáv -->
                    <div class="nav-col flex-grow">
                        <?php wp_nav_menu(array('theme_location' => 'header-menu-left')); ?>
                    </div>

                    <!-- Jobb oldali menüsáv -->
                    <div class="nav-col">
                        <!-- Autentikációs menü -->
                        <?php if (!is_user_logged_in()) : wp_nav_menu(array('theme_location' => 'header-menu-right'));  ?>
                            <!-- User menü -->
                        <?php else : ?>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                        <span><?= $user->user_login ?></span>
                                    </a>
                                </li>
                                <?php if (in_array('administrator', (array) $user->roles)) : ?>
                                    <li>
                                        <a href="<?= admin_url() ?>" target="_blank">
                                            <i class="fa fa-wrench"></i>
                                            <span>Vezérlőpult</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?= esc_url(home_url('/signout')) ?>">
                                        <i class="fa fa-sign-out"></i>
                                        <span>Kijelentkezés </span>
                                    </a>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Jumbotron -->
        <?php if (is_front_page()) : ?>
            <div class="jumbotron">
                <div class="layer"></div>
                <div class="container text-center">
                    <h1>Lorem Ipsum</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <p>
                        <a class="btn btn-main btn-lg" href="<?= home_url(is_user_logged_in() ? '/game' : '/signin') ?>" role="button">
                            Játék indítása
                        </a>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </header>

    <!-- Tartalom -->
    <div id="container" class="container">
        <!-- Címsor -->
        <?php if (!is_page('game')) : ?>
            <?php if (!is_front_page()) : ?>
                <h1 class="page-title">
                    <?= the_title() ?>
                </h1>
            <?php endif; ?>
        <?php endif; ?>