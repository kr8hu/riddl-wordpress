<?php

/**
 * Template Name: Felhasználó lista
 */
?>

<?php
require_once('http.php');

//Útvonal
$route = 'categories';

//Adatok a http kéréshez
$data = [];

//API
$api = new HTTPRequest();

//HTTP kérés
@$categories = $api->post($route, $data);

//Cellák
$cols = [
    '_id' => 'ID',
    'name' => 'Megnevezés',
    'description' => 'Leírás',
    'level' => 'Szint'
];
?>

<div class="container">
    <h1>Kategóriák</h1>

    <!-- Hibakezelés -->
    <?php if ($categories === null): ?>
        <span class="error">
            Hiba történt az adatok lekérdezésénél.
        </span>

        <!-- Táblázat -->
    <?php else : ?>
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
            <?php foreach ($categories as $category) : ?>
                <a href="<?= admin_url('admin.php?page=edit_category&_id=' . urlencode($category['_id'])) ?>" class="row">
                    <?php foreach ($cols as $key => $value) : ?>
                        <div class="col">
                            <span class="value">
                                <?= $category[$key] ?>
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