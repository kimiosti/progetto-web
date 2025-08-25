<?php
require_once 'setup.php';

if (!isset($_GET["categoria"]) || empty($_GET["categoria"])) {
    header('Location: index.php');
    exit();
}

$categoria = $_GET["categoria"];
$marcaFiltro = $_GET["marca"] ?? [];
$sottocategoriaFiltro = $_GET['sottocategoria'] ?? [];
$tagliaFiltro = $_GET['taglia'] ?? [];
$prezzoFiltro = $_GET['prezzo'] ?? [];
$search = trim($_GET['search'] ?? '');

$brandList = $dbh->getBrand($categoria);
$subcategoryList = $dbh->getSubcategory($categoria);
$sizeList = $dbh->getSize($categoria);
$priceList = $dbh->getPrice($categoria);

$templateParams["titolo"] = "PureEssence - Prodotti $categoria";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["descrizioneCategoria"] = $dbh->getDescriptionByCategories($categoria);


$templateParams["prodotti"] = $dbh->getProductByCategories($categoria, $marcaFiltro, $sottocategoriaFiltro, $tagliaFiltro, $prezzoFiltro, $search);

$templateParams["categoriaSelezionata"] = $categoria;
$templateParams["main"] = "prodotti_categoria_contenuto.php";
$templateParams["marcafiltri"] = $brandList;
$templateParams["sottocategoriafiltri"] = $subcategoryList;
$templateParams["taglieprodottofiltri"] = $sizeList;
$templateParams["prezzoprodottofiltri"] = $priceList;

require 'templates/base.php';
?>