<?php

/**
 * Template Name: Felhasználó lista
 */
?>

<?php
require_once('http.php');

//Útvonal
$route = 'users';

//Adatok a http kéréshez
$data = [];

//API
$api = new HTTPRequest();

//HTTP kérés
@$users = $api->post($route, $data);

//Cellák
$cols = [
    '_id' => 'ID',
    'username' => 'Felhasználónév',
    'email' => 'E-mail',
    'createdAt' => 'Létrehozva',
    'points' => 'Pontszám'
];
?>

<div class="container">
    <h1>Felhasználók</h1>

    <!-- Hibakezelés -->
    <?php if ($users === null): ?>
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
            <?php foreach ($users as $user) : ?>
                <a href="#" class="row">
                    <?php foreach ($cols as $key => $value) : ?>
                        <div class="col">
                            <span class="value">
                                <?php
                                if ($key == 'createdAt') {
                                    $createdAt = new DateTime($user['createdAt']);
                                    $formattedDate = $createdAt->format('Y M d');
                                    echo $formattedDate;
                                } else {
                                    echo $user[$key];
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