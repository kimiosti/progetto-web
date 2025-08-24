<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: login.php");
    die();
} else if ($_SESSION["tipoUtente"] != "venditore") {
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["main"] = "templates/message.php";
    $templateParams["titolo"] = PERMISSION_DENIED_PAGE_TITLE;
    $templateParams["titoloMessaggio"] = PERMISSION_DENIED_TITLE;
    $templateParams["corpoMessaggio"] = PERMISSION_DENIED_MESSAGE;
    $templateParams["linkBottone"] = "profile.php";
    $templateParams["testoBottone"] = "Torna al profilo";
} else if (!isset($_GET["id"]) || !isset($_GET["categoria"])) {
    //redirect alla generica pagina di ricerca delle disponibilità da gestire.
} else {
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titolo"] = "PureEssence - Gestione disponibilità";
    $templateParams["main"] = "templates/product_availabilities.php";
    $prodotti = $dbh->getProductById($_GET["id"]);
    $templateParams["prodotto"] = empty($prodotti) ? null : $prodotti[0];
    $templateParams["categoria"] = $_GET["categoria"];
    $templateParams["disponibilita"] = $dbh->getAvailabilitiesBySeller($_GET["id"], $_SESSION["idutente"]);

    require 'templates/base.php';
}

?>