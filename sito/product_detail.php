<?php

require_once 'setup.php';
$templateParams["categorie"] = $dbh->getCategories();

$id = $_GET['id'] ?? null;
if ($id === null) {
    die("ID prodotto mancante");
}

$rows = $dbh->getProductById($id);
if (empty($rows)) {
    die("Prodotto non trovato");
}

$templateParams["prodotto"] = $rows[0];

$templateParams["disponibilita"] = $rows;

$templateParams["titolo"] = "Dettaglio prodotto";
$templateParams["main"] = "product_detail_content.php";

require 'templates/base.php';
?>
