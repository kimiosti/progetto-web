<?php
require_once 'setup.php';

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


if (!empty($search)) {
    $filtroDaAggiungere = false;
    $parametriURL = $_GET;

    foreach ($brandList as $brand) {
        if (strcasecmp($brand['marca'], $search) == 0 && !in_array($brand['marca'], $marcaFiltro)) {
            $parametriURL['marca'][] = $brand['marca'];
            $filtroDaAggiungere = true;
            break;
        }
    }

    if (!$filtroDaAggiungere) {
        foreach ($subcategoryList as $sub) {
            if (strcasecmp($sub['sottocategoria'], $search) == 0 && !in_array($sub['sottocategoria'], $sottocategoriaFiltro)) {
                $parametriURL['sottocategoria'][] = $sub['sottocategoria'];
                $filtroDaAggiungere = true;
                break;
            }
        }
    }

    if ($filtroDaAggiungere) {
        header('Location: prodotti_Categoria.php?' . http_build_query($parametriURL));
        exit();
    }
}


$templateParams["titolo"] = "PureEssence - Prodotti $categoria";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["descrizioneCategoria"] = $dbh->getDescriptionByCategories($categoria);

$templateParams["prodotti"] = $dbh->getProductByCategories($categoria, $marcaFiltro, $sottocategoriaFiltro, $tagliaFiltro, $prezzoFiltro, $search);

$templateParams["categoriaSelezionata"] = $categoria;
$templateParams["main"] = "prodotti_categoria_contenuto.php";
$templateParams["css"] = "style/prodotti_categoria.css";
$templateParams["marcafiltri"] = $brandList;
$templateParams["sottocategoriafiltri"] = $subcategoryList;
$templateParams["taglieprodottofiltri"] = $sizeList;
$templateParams["prezzoprodottofiltri"] = $priceList;

require 'templates/base.php';
?>