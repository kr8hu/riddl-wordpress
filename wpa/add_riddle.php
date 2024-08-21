<?php

/**
 * Template Name: Rejtvény hozzáadása
 */
?>

<?php
require_once('http.php');
require_once('utils.php');

//API
$api = new HTTPRequest();

//Létrehozott rejtvényt tároló változó
$riddle = null;

//Kategóriák lekérése
$categories = $api->post('categories', []);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Kiválasztott kategória ellenörzése
    if (isset($_POST['category']) || $_POST['category'] != "null") {
        //Kép kiválasztásának ellenörzése
        if (isset($_FILES['image'])) {
            $fileTmp = $_FILES['image']['tmp_name'];

            //Kép feltöltésének ellenörzése
            if (is_uploaded_file($fileTmp)) {
                $base64Image = createBase64Image($fileTmp);

                $route = 'riddles/create';
                $data = [
                    "name" => $_POST['name'],
                    "category" => $_POST['category'],
                    "description" => $_POST['description'],
                    "solution" => $_POST['solution'],
                    "image" => $base64Image,
                ];
                $riddle = $api->post($route, $data);
            }
        }
    }
}
?>

<div class="container">
    <h1>Rejtvény létrehozása</h1>

    <!-- Visszajelzés -->
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST") : ?>
        <div class="wrapper">
            <span class="<?= $riddle ? 'success' : 'error' ?>">
                <?=
                $riddle ?
                    "A(z) " . @$riddle['name'] . " rejtvény létrehozva."
                    :
                    "Hiba történt a rejtvény felvétele közben."
                ?>
            </span>
        </div>
    <?php endif; ?>

    <!-- Űrlap -->
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>?page=add_riddle" enctype="multipart/form-data">
        <!-- Név -->
        <div class="wrapper">
            <label class="label">
                Rejtvény neve
            </label>
            <input type="text" name="name" value="" />
        </div>

        <!-- Kategória -->
        <div class="wrapper">
            <label class="label">
                Rejtvény kategóriája
            </label>
            <select name="category">
                <option selected hidden value="null">
                    Válassz egy kategóriát
                </option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['_id'] ?>">
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Leírás -->
        <div class="wrapper">
            <label class="label">
                Rejtvény leírása
            </label>
            <textarea rows="10" name="description" value=""></textarea>
        </div>

        <!-- Megoldás -->
        <div class="wrapper">
            <label class="label">
                Rejtvény megoldása
            </label>
            <input type="text" name="solution" value="" />
        </div>

        <!-- Kép -->
        <div class="wrapper">
            <label class="label">
                Képfájl
            </label>
            <input type="file" name="image" accept="image/png" />
        </div>

        <!-- Gomb -->
        <div class="wrapper">
            <button class="btn submit" type="submit">
                Rejtvény felvétele
            </button>
        </div>
    </form>
</div>

<!-- STYLES -->
<link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/wpa/style-editor.css' ?>">