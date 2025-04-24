<?php
require_once 'setup.php';

if (isset($_SESSION["idutente"])) {
    header("Location: profile.php");
} else {
    $templateParams["titolo"] = "PureEssence - Registrazione";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/form.php";
    $templateParams["tipoForm"] = 1;

    if (isset($_SESSION["regErr"])) {
        if ($_SESSION["regErr"] == "emptyFields") {
            $templateParams["erroreLogin"] = "Inserisci username e password per completare la registrazione.";
        } else if ($_SESSION["regErr"] == "diffPass") {
            $templateParams["erroreLogin"] = "Le due password non coincidono.";
        } else if ($_SESSION["regErr"] == "diffEmail") {
            $templateParams["erroreLogin"] = "Le due email non coincidono.";
        } else if ($_SESSION["regErr"] == "userTaken") {
            $templateParams["erroreLogin"] = "Username già in uso.";
        }

        unset($_SESSION["regErr"]);
    }
}

require 'templates/base.php';
?>