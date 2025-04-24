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
        if ($_SESSION["logErr"] == "emptyFields") {
            $templateParams["erroreLogin"] = "Inserire uno username e una password.";
        } else if ($_SESSION["logErr"] == "wrongCredentials") {
            $templateParams["erroreLogin"] = "Username o password errati.";
        }

        unset($_SESSION["logErr"]);
    } else if (isset($_SESSION["logout"]) && $_SESSION["logout"] == true) {
        $templateParams["erroreLogin"] = "Logout effettuato con successo";
        unset($_SESSION["logout"]);
    }
}

require 'templates/base.php';
?>