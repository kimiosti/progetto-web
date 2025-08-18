<?php
require_once 'setup.php';

if (isset($_SESSION["idutente"])) {
    header("Location: profile.php");
} else {
    $templateParams["titolo"] = "PureEssence - Registrazione";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/form.php";
    $templateParams["tipoForm"] = "registrazione";

    if (isset($_SESSION["regErr"])) {
        $templateParams["messaggioForm"] = $_SESSION["regErr"];
        unset($_SESSION["regErr"]);
    }
}

require 'templates/base.php';
?>