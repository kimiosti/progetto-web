<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
    die();
} else {
    $templateParams["titolo"] = "PureEssence - Cambia password";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["tipoForm"] = "cambiaPass";
    $templateParams["main"] = "templates/form.php";
}

require 'templates/base.php';
?>