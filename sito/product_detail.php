<?php

require_once 'setup.php';

$templateParams["categorie"] = $dbh->getCategories();
$templateParams["titolo"] = "Dettaglio prodotto";
$templateParams["main"] = "product_detail_content.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(404);
    $templateParams["titolo"] = "Pagina non trovata";
    require 'templates/base.php';
    exit();
}

$productData = $dbh->getProductById($id);

if ($productData === null) {
    http_response_code(404);
    $templateParams["titolo"] = "Prodotto non trovato";
    $templateParams["main"] = "404.php";
} else {
    $templateParams["prodotto"] = $productData['prodotto'];
    $templateParams["disponibilita"] = $productData['disponibilita'];
}

require 'templates/base.php';

?>