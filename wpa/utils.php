<?php

/**
 * createBase64Image
 * 
 * base64 karakterlánc generálása a feltöltött képből
 */
function createBase64Image($tmp)
{
    $imageData = file_get_contents($tmp);
    $base64Image = base64_encode($imageData);
    $imageType = $_FILES['image']['type'];
    $base64Image = 'data:' . $imageType . ';base64,' . $base64Image;

    return $base64Image;
}
