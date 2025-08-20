<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
} else {
    $templateParams["titolo"] = "PureEssence - Wishlist";
    $templateParams["categorie"] = $dbh->getCategories();

    if ($_SESSION["tipoUtente"] == "venditore") {
        $templateParams["titoloMessaggio"] = "Wishlist non disponibile";
        $templateParams["corpoMessaggio"] = "La Wishlist non può essere visualizzata dal venditore.";
        $templateParams["linkBottone"] = "profile.php";
        $templateParams["testoBottone"] = "Torna al profilo";

        $templateParams["main"] = "templates/message.php";
    } else {
        $templateParams["titoloPagina"] = "Lista dei desideri";
        $templateParams["prodotti"] = $dbh->getWishlist($_SESSION["idutente"]);
        if (empty($templateParams["prodotti"])) {
            $templateParams["info"] = "Non hai ancora aggiunto prodotti alla tua Lista dei desideri.";
        } else {
            for ($i = 0; $i < count($templateParams["prodotti"]); $i++) {
                $availabilities = $dbh->getAvailabilities($templateParams["prodotti"][$i]["IDprodotto"]);
                if (empty($availabilities)) {
                    $templateParams["prodotti"][$i]["prezzo"] = -1;
                } else {
                    $templateParams["prodotti"][$i]["prezzo"] = $availabilities[0]["prezzo"];
                    $templateParams["prodotti"][$i]["taglia"] = $availabilities[0]["taglia"];
                }
            }
        }
        $templateParams["main"] = "templates/wishlist.php";
    }
}

require 'templates/base.php';
?>