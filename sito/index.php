<?php
require_once 'setup.php';

$templateParams["categorie"] = $dbh->getCategories();
if (isset($_GET["q"]) && !empty(trim($_GET["q"]))) {
    $term = trim($_GET["q"]);

    // cerco categoria del termine
    $categoria = $dbh->getCategoryBySearch($term); // funzione che restituisce il nome categoria

    if ($categoria) {
        // passo il termine come search alla pagina categoria
        header("Location: prodotti_categoria.php?categoria=" . urlencode($categoria) . "&search=" . urlencode($term));
        exit;
    }
} else {
    // Home page
    $templateParams["titolo"] = "PureEssence - Home";
    $templateParams["main"] = 'templates/homepage.php';
}

require 'templates/base.php';
?>
