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
    } else {
        $templateParams["titolo"] = "PureEssence - Risultati ricerca";
        $templateParams["search_term"] = $term;
        $templateParams["main"] = 'templates/search-result.php'; // Nuovo template per il messaggio

    }
} else {    
    $templateParams["titolo"] = "PureEssence - Ricerca";
    $templateParams["main"] = "templates/research.php";
}

require 'templates/base.php';
?>