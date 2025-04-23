<?php
require_once 'setup.php';

if (isset($_SESSION["idutente"])) {
    header("Location: profile.php");
} else {
    $templateParams["titolo"] = "PureEssence - Login";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/form.php";
    $templateParams["tipoForm"] = 0;

    if (isset($_GET["err"])) {
        if ($_GET["err"] == 1) {
            $templateParams["erroreLogin"] = "Inserire uno username e una password.";
        } else if ($_GET["err"] == 2) {
            $templateParams["erroreLogin"] = "Username o password errati.";
        }
    }
}

require 'templates/base.php';
?>