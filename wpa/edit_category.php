<?php

/**
 * Template Name: Kategória szerkesztése
 */
?>

<?php
require_once('http.php');

//API
$api = new HTTPRequest();

//Adatokat tároló változó
$category;

//Kategória megnyitása szerkesztésre, ha van id
if (isset($_GET['_id'])) {
    $route = 'categories/find/id/' . $_GET['_id'];
    $category = $api->get($route);
}


//POST http kérés esetén
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Módosítás
    if (isset($_POST['edit'])) {
        $route = 'categories/update/' . $_POST['_id'];
        $data = [
            "name" => $_POST['name'],
            "level" => $_POST['level']
        ];
        $category = $api->put($route, $data);
    }

    //Törlés
    if (isset($_POST['delete'])) {
        $route = 'categories/remove/' . $_POST['_id'];
        $category = $api->delete($route);
    }
}
?>

<div class="container">
    <h1>Kategória szerkesztése</h1>

    <!-- Törlés vagy adatmódosítás esetén megjelenítendő visszajelzés -->
    <?php if (isset($_POST['delete']) || isset($_POST['edit'])): ?>
        <div class="wrapper">
            <?php if ($category): ?>
                <span class="success">
                    <?= isset($_POST['delete']) ?
                        "A kategória törlésre került."
                        :
                        "A kategória adatai módosítva."
                    ?>
                </span>
            <?php endif; ?>
            <button class="btn submit" onclick="window.location.href = '<?= admin_url() ?>admin.php?page=list_categories'">
                Vissza a kategóriákhoz
            </button>
        </div>

        <!-- Űrlap -->
    <?php else : ?>
        <?php if (isset($_GET['_id']) || isset($_POST['_id']) || $category != null): ?>
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>?page=edit_category">
                <!-- ID -->
                <input hidden name="_id" value="<?= @$category['_id'] ?>" />

                <!-- Név -->
                <div class="wrapper">
                    <label class="label">
                        Kategória neve
                    </label>
                    <input type="text" name="name" value="<?= @$category['name'] ?>" />
                </div>

                <!-- Szint -->
                <div class="wrapper">
                    <label class="label">
                        Kategória szintje
                    </label>
                    <select name="level" default="<?= @$category['level'] ?>">
                        <?php for ($i = 0; $i < 10; $i++) : ?>
                            <option value="<?= $i + 1 ?>">
                                <?= $i + 1 ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <!-- Módosítás gomb -->
                <div class="wrapper">
                    <button class="btn submit" type="submit" name="edit">
                        Módosítások mentése
                    </button>
                </div>

                <!-- Törlés gomb -->
                <div class="wrapper">
                    <button class="btn delete" type="submit" name="delete">
                        Törlés
                    </button>
                </div>
            </form>
            <!-- Hibakezelés -->
        <?php else : ?>
            <span class="error">
                Hiba lépett fel a kategóriaszerkesztő betöltése közben.
            </span>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- STYLES -->
<link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/wpa/style-editor.css' ?>">