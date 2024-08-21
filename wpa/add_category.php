<?php

/**
 * Template Name: Kategória hozzáadása
 */
?>

<?php
require_once('http.php');

//API
$api = new HTTPRequest();

//Létrehozott kategóriát tároló változó
$category = null;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Kategórianév ellenörzése
    if (isset($_POST["name"]) && $_POST["name"] != "") {
        $route = 'categories/create';
        $data = [
            "name" => $_POST['name'],
            "description" => $_POST['description'],
            "level" => $_POST['level'],
        ];
        $category = $api->post($route, $data);
    }
}
?>

<div class="container">
    <h1>Kategória létrehozása</h1>

    <!-- Visszajelzés -->
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST") : ?>
        <div class="wrapper">
            <span class="<?= $category ? 'success' : 'error' ?>">
                <?=
                $category ?
                    "A(z) " . @$category['name'] . " kategória létrehozva."
                    :
                    "Hiba történt a kategória felvétele közben."
                ?>
            </span>
        </div>
    <?php endif; ?>

    <!-- Űrlap -->
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>?page=add_category">
        <!-- Név -->
        <div class="wrapper">
            <label class="label">
                Kategória neve
            </label>
            <input type="text" name="name" value="" />
        </div>

        <!-- Leírás -->
        <div class="wrapper">
            <label class="label">
                Kategória leírása
            </label>
            <input type="text" name="description" value="" />
        </div>


        <!-- Szint -->
        <div class="wrapper">
            <label class="label">
                Kategória szintje
            </label>
            <select name="level">
                <option hidden selected value="1">
                    Válassz nehézségi szintet
                </option>
                <?php for ($i = 0; $i < 10; $i++) : ?>
                    <option value="<?= $i + 1 ?>">
                        <?= $i + 1 ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <!-- Gomb -->
        <div class="wrapper">
            <button class="btn submit" type="submit">
                Kategória felvétele
            </button>
        </div>
    </form>
</div>

<!-- STYLES -->
<link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/wpa/style-editor.css' ?>">