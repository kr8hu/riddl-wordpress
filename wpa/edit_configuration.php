<?php

/**
 * Template Name: Konfiguráció szerkesztése
 */
?>

<?php
require_once('http.php');

//API
$api = new HTTPRequest();

//Adatokat tároló változó
$config;


//GET http kérés esetén
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $route = 'configurations/find/query';
    $data = [
        "type" => "main"
    ];
    $config = $api->post($route, $data);
}

//POST http kérés esetén
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit'])) {
        $route = 'configurations/update/';
        $data = [
            "versionCode" => $_POST['versionCode'],
        ];
        $config = $api->put($route, $data);
    }
}
?>

<div class="container">
    <h1>Konfiguráció</h1>

    <!-- Adatmódosítás esetén megjelenítendő visszajelzés -->
    <?php if (isset($_POST['edit'])): ?>
        <div class="wrapper">
            <?php if ($config): ?>
                <span class="success">
                    <?= "A konfiguráció módosítva." ?>
                </span>
            <?php endif; ?>
        <button class="btn submit" onclick="window.location.href = '<?= admin_url() ?>'">
                Vissza a kezdőlapra
            </button>
        </div>

        <!-- Űrlap -->
    <?php else : ?>
        <?php if (isset($_GET['_id']) || isset($_POST['_id']) || $config != null): ?>
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>?page=edit_configuration">
                <!-- versionCode -->
                <div class="wrapper">
                    <label class="label">
                        Verzió kód
                    </label>
                    <span class="description">Ez a minimum megkövetelt verziókód, amivel az alkalmazás kommunikálhat az api-val.</span>
                    <input type="number" name="versionCode" value="<?= @$config['versionCode'] ?>" />
                </div>

                <!-- Módosítás gomb -->
                <div class="wrapper">
                    <button class="btn submit" type="submit" name="edit">
                        Módosítások mentése
                    </button>
                </div>
            </form>
            <!-- Hibakezelés -->
        <?php else : ?>
            <span class="error">
                Hiba lépett fel a konfigurációszerkesztő betöltése közben.
            </span>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- STYLES -->
<link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/wpa/style-editor.css' ?>">