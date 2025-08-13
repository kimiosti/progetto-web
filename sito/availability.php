<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"]) || $_SESSION["tipoUtente"] == "acquirente") {
    header("Location: login.php");
} else {
    $templateParams["titolo"] = "PureEssence - Disponibilità";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/availability.php";

    require 'templates/base.php';
}
?>