<?php
/*
 * Template Name: Játék 
 * Template Author: Bakos Attila
 * Date: 2024
 */
?>

<?php
//Bejelentkezett felhasználó
$current_user = wp_get_current_user();

//Átirányítási url
$redirect_url = home_url();

//Paraméterek
$params = array(
    'action' => 'not_authorized'
);

//Kibővített átirányítási url
$redirect_url_ext = add_query_arg($params, home_url());

//Ha nincs bejelentkezve, átirányítás a főoldalra
if (!is_user_logged_in()) {
    wp_redirect($redirect_url_ext);
    exit();
}
?>


<!-- Header -->
<?php get_header(); ?>

<!-- Tartalom -->
<div style="margin-top: 48px">
    <iframe id="app" class="game-window" src="<?= content_url() . '/apps/game/index.html' ?>" width="100%" height="500"></iframe>
</div>

<!-- Footer -->
<?php get_footer(); ?>


<!-- Javascript -->
<script src="<?= get_template_directory_uri() . '/js/riddle-game.js' ?>"></script>
<script type="text/javascript">
    //Jobb klikk menü tiltás
    window.addEventListener('contextmenu', (e) => e.preventDefault());

    //Kommunikáció a react alkalmazással
    window.addEventListener('message', (event) => {
        const message = event.data;

        //felhasználói adatok küldése az appnak
        if (message.type === 'LAUNCHED') {
            if (message.data) {
                const message = {
                    type: 'USERDATA',
                    data: {
                        username: "<?= $current_user->user_login ?>",
                        email: "<?= $current_user->user_email ?>",
                        role: <?= $current_user->user_level ?>
                    }
                };

                element.contentWindow.postMessage(message, '*');
            }
        }
    });
</script>