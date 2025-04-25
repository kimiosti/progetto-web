<!-- prodotti_Categoria.php -->
<?php
require_once 'setup.php';

// Recupera la categoria selezionata tramite GET
$categoria = $_GET["categoria"]; // recupera categoria dal parametro GET

$brandList = $dbh->getBrand($categoria); // Supponendo che $dbHandler sia il tuo oggetto DB
$subcategoryList = $dbh->getSubcategory($categoria); // Supponendo che $dbHandler sia il tuo oggetto DB

// Imposta il titolo, carica le categorie e i prodotti per quella categoria
$templateParams["titolo"] = "PureEssence - Prodotti $categoria";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["descrizioneCategoria"] = $dbh->getDescriptionByCategories($categoria);
$templateParams["prodotti"] = $dbh->getProductByCategories($categoria); // Recupera i prodotti per quella categoria
$templateParams["categoriaSelezionata"] = $categoria; // Passa la categoria selezionata per visualizzarla nel template
$templateParams["main"] = "prodotti_categoria_contenuto.php"; // Il contenuto da caricare
$templateParams["css"] = "style/prodotti_categoria.css";  // Aggiungi il CSS specifico per questa pagina
$templateParams["marcafiltri"]= $brandList;
$templateParams["sottocategoriafiltri"]= $subcategoryList;

require 'templates/base.php';
?>
