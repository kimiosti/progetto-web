<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
}else {
    $templateParams["titolo"] = "PureEssence - Wishlist";
    $templateParams["categorie"] = $dbh->getCategories();

    if ($_SESSION["tipoUtente"] == "venditore") {
        $templateParams["titoloMessaggio"] = "Wishlist non disponibile";
        $templateParams["corpoMessaggio"] = "La Wishlist non può essere visualizzata dal venditore.";

        $templateParams["main"] = "templates/message.php";
    } else {
        echo "acquirente";
        $templateParams["main"] = null;
    }
}

require 'templates/base.php';
?>