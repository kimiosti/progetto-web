<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: login.php");
    die();
} else {
    $templateParams["titolo"] = "PureEssence - Ordini";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["main"] = "templates/orders.php";

    $templateParams["ordini"] = $_SESSION["tipoUtente"] == "venditore"
        ? $dbh->getOrdersToSeller($_SESSION["idutente"])
        : $dbh->getCustomerOrders($_SESSION["idutente"]);

    require "templates/base.php";
}
?>