<?php
/*
 * Template Name: Bejelentkezés
 * Template Author: Bakos Attila
 * Date: 2021.07.20
 */
?>

<?php
$error = null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Adatok ellenörzése
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $creds = array(
            'user_login'    => $_POST['username'],
            'user_password' => $_POST['password'],
            'remember'      => isset($_POST['remember'])
        );

        //Bejelentkezési kísérlet
        $user = wp_signon($creds, false);

        //Ellenörzés
        if (is_wp_error($user)) {
            $error = $user->get_error_message();
        } else {
            // Sikeres bejelentkezés esetén átirányítás
            wp_redirect(home_url('?action=signin'));
            exit;
        }
    }
}
?>

<!-- Header -->
<?php get_header(); ?>

<!-- Tartalom -->
<form class="custom-form" method="post" action="<?= get_permalink() ?>">
    <!-- Alert -->
    <?php if ($error !== null) : ?>
        <div class="alertbox alert alert-danger text-justify" role="alert">
            <i class="fa fa-exclamation-circle"></i>
            <span>
                <?= str_replace("Hiba:", "", $error); ?>
            </span>
        </div>
    <?php endif; ?>

    <!-- Input mezők -->
    <input type="text" name="username" placeholder="Felhasználónév" maxlength="16">
    <input type="password" name="password" placeholder="Jelszó" maxlength="32">

    <!-- Checkbox -->
    <div class="group-row">
        <div class="group-col">
            <input type="checkbox" name="remember">
        </div>
        <div class="group-col">
            <label for="remember">
                Maradjak bejelentkezve
            </label>
        </div>
    </div>

    <!-- Gomb -->
    <button type="submit" class="btn btn-main btn-lg">
        Bejelentkezés
    </button>
</form>

<!-- Footer -->
<?php get_footer(); ?>