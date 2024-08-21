<?php
/*
	 * Template Name: Kijelentkezés
 	 * Template Author: Bakos Attila
 	 * Date: 2024
	 */
?>

<?php
//Kijelentkezési url
$redirect_url = wp_redirect(home_url());

//Paraméterek
$params = array(
    'action' => 'signout'
);

//Kibővített kijelentkezési url
$redirect_url_ext = add_query_arg($params, home_url());


if (is_user_logged_in()) {
    wp_logout();
    wp_redirect($redirect_url_ext);
    exit();
} else {
    wp_redirect(home_url());
    exit();
}
?>