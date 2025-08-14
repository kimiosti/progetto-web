<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
} else if ($_SESSION["tipoUtente"] != "venditore") {
    $templateParams["titolo"] = "PureEssence - Accesso negato";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titoloMessaggio"] = "Accesso negato";
    $templateParams["corpoMessaggio"] = "Solamente i venditori possono gestire la disponibilità dei prodotti.";

    $templateParams["main"] = "templates/message.php";
    require 'templates/base.php';
} else {
    $templateParams["titolo"] = "PureEssence - Disponibilità";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/availability.php";

    require 'templates/base.php';
}
?>