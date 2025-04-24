<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
    die();
} else {
    $templateParams["titolo"] = "PureEssence - Cambia telefono";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["tipoForm"] = "cambiaTelefono";
    $templateParams["main"] = "templates/form.php";
}

require 'templates/base.php';
?>