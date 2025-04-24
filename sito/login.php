<?php
require_once 'setup.php';

if (isset($_SESSION["idutente"])) {
    header("Location: profile.php");
} else {
    $templateParams["titolo"] = "PureEssence - Login";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/form.php";
    $templateParams["tipoForm"] = 0;

    if (isset($_SESSION["logErr"])) {
        $templateParams["messaggioForm"] = $_SESSION["logErr"];
        unset($_SESSION["logErr"]);
    } else if (isset($_SESSION["logout"]) && $_SESSION["logout"] == true) {
        $templateParams["messaggioForm"] = "Logout effettuato con successo";
        unset($_SESSION["logout"]);
    }
}

require 'templates/base.php';
?>