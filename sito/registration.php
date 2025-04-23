<?php
require_once 'setup.php';

if (isset($_SESSION["idutente"])) {
    header("Location: profile.php");
} else {
    $templateParams["titolo"] = "PureEssence - Registrazione";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/form.php";
    $templateParams["tipoForm"] = 1;

    if (isset($_GET["err"])) {
        if ($_GET["err"] == 1) {
            $templateParams["erroreLogin"] = "Inserisci username e password per completare la registrazione.";
        } else if ($_GET["err"] == 2) {
            $templateParams["erroreLogin"] = "Le due password non coincidono.";
        } else if ($_GET["err"] == 3) {
            $templateParams["erroreLogin"] = "Le due email non coincidono.";
        }
    }
}

require 'templates/base.php';
?>