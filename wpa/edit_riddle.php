<?php

/**
 * Template Name: Rejtvény szerkesztése
 */
?>

<?php
require_once('http.php');
require_once('utils.php');

//API
$api = new HTTPRequest();

//Képfájl elérési címe
$imageUrl = "http://127.0.0.1:3001/public/images/riddles/";

//Adatokat tároló változó
$riddle;

//Kategóriák lekérése
$categories = $api->post('categories', []);


//Rejtvény megnyitása szerkesztésre, ha van id
if (isset($_GET['_id'])) {
    $route = 'riddles/find/id/' . $_GET['_id'];
    $riddle = $api->get($route);
}


//POST http kérés esetén
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Módosítás
    if (isset($_POST['edit'])) {
        $route = 'riddles/update/' . $_POST['_id'];
        $data = [
            "name" => $_POST['name'],
            "category" => $_POST['category'],
            "description" => $_POST['description'],
            "solution" => $_POST['solution'],
        ];

        //Ha van új kép kiválasztva
        if (isset($_FILES['image'])) {
            $fileTmp = $_FILES['image']['tmp_name'];

            //Kép feltöltésének ellenörzése
            if (is_uploaded_file($fileTmp)) {
                $base64Image = createBase64Image($fileTmp);
                $data['image'] = $base64Image;
            }
        }
        $riddle = $api->put($route, $data);
    }

    //Törlés
    if (isset($_POST['delete'])) {
        $route = 'riddles/remove/' . $_POST['_id'];
        $riddle = $api->delete($route);
    }
}
?>

<div class="container">
    <h1>Rejtvény szerkesztése</h1>

    <!-- Törlés vagy adatmódosítás esetén megjelenítendő visszajelzés -->
    <?php if (isset($_POST['delete']) || isset($_POST['edit'])): ?>
        <div class="wrapper">
            <?php if ($riddle): ?>
                <span class="success">
                    <?= isset($_POST['delete']) ?
                        "A rejtvény törlésre került."
                        :
                        "A rejtvény adatai módosítva."
                    ?>
                </span>
            <?php endif; ?>
            <button class="btn submit" onclick="window.location.href = '<?= admin_url() ?>admin.php?page=list_riddles'">
                Vissza a rejtvényekhez
            </button>
        </div>

        <!-- Űrlap -->
    <?php else : ?>
        <?php if (isset($_GET['_id']) || isset($_POST['_id']) || $riddle != null): ?>
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>?page=edit_riddle" enctype="multipart/form-data">
                <!-- ID -->
                <input hidden name="_id" value="<?= @$riddle['_id'] ?>" />

                <!-- Név -->
                <div class="wrapper">
                    <label class="label">
                        Rejtvény neve
                    </label>
                    <input type="text" name="name" value="<?= @$riddle['name'] ?>" />
                </div>

                <!-- Kategória -->
                <div class="wrapper">
                    <label class="label">
                        Rejtvény kategóriája
                    </label>
                    <select name="category">
                        <?php foreach ($categories as $category): ?>
                            <option <?= $category['_id'] == $riddle['category'] ? 'selected' : '' ?> value="<?= $category['_id'] ?>">
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
                    <textarea rows="10" name="description" value="<?= $riddle['description'] ?>"><?= $riddle['description'] ?></textarea>
                </div>

                <!-- Megoldás -->
                <div class="wrapper">
                    <label class="label">
                        Rejtvény megoldása
                    </label>
                    <input type="text" name="solution" value="<?= $riddle['solution'] ?>" />
                </div>

                <!-- Kép -->
                <div class="wrapper">
                    <label class="label">
                        Képfájl
                    </label>
                    <img src="<?= $imageUrl . $riddle['image'] ?>" class="image" />
                    <input type="file" name="image" accept="image/png" />
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
                Hiba lépett fel a rejtvényszerkesztő betöltése közben.
            </span>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- STYLES -->
<link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/wpa/style-editor.css' ?>">