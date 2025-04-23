<?php
require_once 'setup.php';

if (isset($_SESSION["idutente"])) {
    $templateParams["titolo"] = "PureEssence - Pagina personale";
    $templateParams["categorie"] = $dbh->getCategories();
} else if (isset($_POST["email"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        header("Location: registration.php?err=1");
        die();
    } else if (strcmp($_POST["password"], $_POST["confermaPassword"]) != 0) {
        header("Location: registration.php?err=2");
        die();
    } else if (strcmp($_POST["email"], $_POST["confermaEmail"]) != 0) {
        header("Location: registration.php?err=3");
        die();
    } else {
        if ($dbh->addUser($_POST["username"], hash("sha512", $_POST["password"]), $_POST["email"])) {
            $_SESSION["idutente"] = $_POST["username"];
            $_SESSION["tipoUtente"] = 1;
            header("Location: profile.php");
            die();
        } else {
            header("Location: registration.php?err=4");
            die();
        }
    }
} else if (isset($_POST["username"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        header("Location: login.php?err=1");
        die();
    } else {
        $loginResult = $dbh->checkLogin($_POST["username"], hash("sha512", $_POST["password"]));
        if ($loginResult == 0) {
            header("Location: login.php?err=2");
            die();
        } else {
            $_SESSION["idutente"] = $_POST["username"];
            $_SESSION["tipoUtente"] = $loginResult;
            header("Location: profile.php");
            die();
        }
    }

    $templateParams["erroreLogin"] = "login";
    header("Location: login.php");
    die();
} else {
    header("Location: login.php");
    die();
}

require 'templates/base.php';
?>