<?php

/**
 * Template Name: Rejtvény lista
 */
?>

<?php
require_once('http.php');

//API
$api = new HTTPRequest();

//HTTP kérés
@$riddles = $api->post('riddles', []);
@$categories = $api->post('categories', []);

//Cellák
$cols = [
    '_id' => 'ID',
    'name' => 'Név',
    'category' => 'Kategória',
    'image' => 'Kép',
    'description' => 'Leírás',
    'solution' => 'Megoldás',
    'createdAt' => 'Létrehozva',
];

//POST http kérés esetén
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['filter']) && $_POST['filter'] != "null") {
        $data = [
            "category" => $_POST['filter']
        ];

        $riddles = $api->post('riddles/find/query', $data);
    }
}
?>

<div class="container">
    <h1>Rejtvények</h1>

    <!-- Hibakezelés -->
    <?php if ($riddles === null): ?>
        <span class="error">
            Hiba történt az adatok lekérdezésénél.
        </span>

    <?php else : ?>
        <!-- Keresés -->
        <div class="float">
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>?page=list_riddles">
                <select name="filter">
                    <option hidden selected value="null">
                        Szűrés kategória alapján
                    </option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['_id'] ?>">
                            <?= $category['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Szűrés</button>
            </form>
        </div>

        <!-- Táblázat -->
        <div class="table">
            <!-- Fejléc -->
            <div class="row header">
                <?php foreach ($cols as $col) : ?>
                    <div class="col">
                        <span class="key">
                            <?= $col ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Adatok -->
            <?php foreach ($riddles as $riddle) : ?>
                <a href="<?= admin_url('admin.php?page=edit_riddle&_id=' . urlencode($riddle['_id'])) ?>" class="row">
                    <?php foreach ($cols as $key => $value) : ?>
                        <div class="col">
                            <span class="value">
                                <?php
                                if ($key == 'category') {
                                    foreach ($categories as $category) {
                                        if ($category['_id'] == $riddle[$key]) {
                                            echo $category['name'];
                                            break;
                                        }
                                    }
                                } else if ($key == 'createdAt') {
                                    $createdAt = new DateTime($riddle[$key]);
                                    $formattedDate = $createdAt->format('Y M d');
                                    echo $formattedDate;
                                } else if ($key == 'image') {
                                    echo '<img src="http://127.0.0.1:3001/public/images/riddles/' . $riddle[$key] . '"/>';
                                } else {
                                    echo $riddle[$key];
                                }
                                ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
</div>

<!-- STYLES -->
<link rel="stylesheet" type="text/css" media="screen" href="<?= get_template_directory_uri() . '/wpa/style-list.css' ?>">