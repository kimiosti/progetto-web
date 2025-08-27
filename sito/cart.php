<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: login.php");
    die();
} else if ($_SESSION["tipoUtente"] != "acquirente") {
    $templateParams["titolo"] = PERMISSION_DENIED_PAGE_TITLE;
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["main"] = "templates/message.php";

    $templateParams["titoloMessaggio"] = PERMISSION_DENIED_TITLE;
    $templateParams["corpoMessaggio"] = PERMISSION_DENIED_MESSAGE;
    $templateParams["testoBottone"] = "Torna al profilo";
    $templateParams["linkBottone"] = "profile.php";
} else {
    $templateParams["titolo"] = "PureEssence - Carrello";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["main"] = "templates/cart-content.php";

    $templateParams["disponibilità"] = $dbh->getCartContent($_SESSION["idutente"]);
}

require 'templates/base.php';
?>