<!-- podotti_Categoria.php -->
<?php
require_once 'setup.php';

// Recupera la categoria selezionata tramite GET
$categoria = $_GET["categoria"]; // recupera categoria dal parametro GET

// Imposta il titolo, carica le categorie e i prodotti per quella categoria
$templateParams["titolo"] = "PureEssence - Prodotti $categoria";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["prodotti"] = $dbh->getProductByCategories($categoria); // Recupera i prodotti per quella categoria
$templateParams["categoriaSelezionata"] = $categoria; // Passa la categoria selezionata per visualizzarla nel template
$templateParams["main"] = "prodotti_categoria_contenuto.php"; // Il contenuto da caricare
$templateParams["css"] = "style/prodotti_categoria.css";  // Aggiungi il CSS specifico per questa pagina

require 'templates/base.php';
?>
