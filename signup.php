<?php
/*
 * Template Name: Regisztráció
 * Template Author: Bakos Attila
 * Date: 2021.07.20
 */
?>

<?php
$error = true;
$message = null;

//Adatok ellenörzése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['checkbox'])) {
        $message = "A regisztrációhoz el kell fogadni az adatkezelési tájékoztatót.";
    } else if (empty($_POST['password']) || empty($_POST['email'])) {
        $message = "A regisztrációhoz minden mezőt ki kell tölteni.";
    } else if ($_POST['password'] !== $_POST['password-repeat']) {
        $message = "A megadott jelszavak nem egyeznek.";
    } else {
        $userdata = array(
            'user_login'    => $_POST['username'],
            'user_pass'     => $_POST['password'],
            'user_email'    => $_POST['email'],
            'first_name'    => "",
            'last_name'     => "",
            'role'          => 'subscriber'
        );

        //Ha még nem lépett fel hiba a folyamatban
        $user = wp_insert_user($userdata);

        //Regisztráció ellenőrzése
        if (is_wp_error($user)) {
            $message = $user->get_error_message();
        } else {
            $error = false;
            $message = "Sikeres regisztráció.";
        }
    }
}
?>

<!-- Header -->
<?php get_header(); ?>

<!-- Tartalom -->
<form class="custom-form" method="post" action="<?= get_permalink() ?>">
    <!-- Alert -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <div class="alertbox alert <?= $error ? 'alert-danger' : 'alert-success' ?> text-justify" role="alert">
            <i class="fa <?= $error ? 'fa-exclamation-circle' : 'fa-check-circle' ?>"></i>
            <span>
                <?= str_replace("Hiba:", "", $message); ?>
            </span>
        </div>
    <?php endif; ?>

    <!-- Input mezők -->
    <input type="text" name="username" placeholder="Felhasználónév (max. 16 karakter)" maxlength="16">
    <input type="password" name="password" placeholder="Jelszó (max. 64 karakter)" maxlength="64">
    <input type="password" name="password-repeat" placeholder="Jelszó ismét" maxlength="64">
    <input type="e-mail" name="email" placeholder="E-mail cím" maxlength="128">

    <!-- Checkbox -->
    <div class="group-row">
        <div class="group-col">
            <input type="checkbox" name="checkbox">
        </div>
        <div class="group-col">
            <label for="checkbox">
                Adatkezelési tájékoztató elfogadása
            </label>
        </div>
    </div>

    <!-- Gomb -->
    <button type="submit" class="btn btn-main btn-lg">
        Regisztráció
    </button>
</form>

<!-- Footer -->
<?php get_footer(); ?>