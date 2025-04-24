<?php
require_once 'setup.php';

if (isset($_POST["email"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $_SESSION["regErr"] = "Inserire username e password per registrarsi.";
        header("Location: registration.php");
        die();
    } else if (strcmp($_POST["password"], $_POST["confermaPassword"]) != 0) {
        $_SESSION["regErr"] = "Le due password non coincidono.";
        header("Location: registration.php");
        die();
    } else if (strcmp($_POST["email"], $_POST["confermaEmail"]) != 0) {
        $_SESSION["regErr"] = "Le due email non coincidono.";
        header("Location: registration.php");
        die();
    } else {
        if ($dbh->addUser($_POST["username"], hash("sha512", $_POST["password"]), $_POST["email"])) {
            $_SESSION["idutente"] = $_POST["username"];
            $_SESSION["tipoUtente"] = "acquirente";
            header("Location: profile.php");
            die();
        } else {
            $_SESSION["regErr"] = "Questo username è già in uso";
            header("Location: registration.php");
            die();
        }
    }
} else if (isset($_POST["username"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $_SESSION["logErr"] = "Inserire username e password.";
        header("Location: login.php");
        die();
    } else {
        $loginResult = $dbh->checkLogin($_POST["username"], hash("sha512", $_POST["password"]));
        if ($loginResult == "wrongCredentials") {
            $_SESSION["logErr"] = "Username o password errati.";
            header("Location: login.php");
            die();
        } else {
            $_SESSION["idutente"] = $_POST["username"];
            $_SESSION["tipoUtente"] = $loginResult;
            header("Location: profile.php");
            die();
        }
    }
} else if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    unset($_SESSION["idutente"]);
    unset($_SESSION["tipoUtente"]);
    $_SESSION["logout"] = true;
    header("Location: login.php");
    die();
} else if (isset($_SESSION["idutente"])) {
    $templateParams["titolo"] = "PureEssence - Pagina personale";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/profile.php";
} else {
    header("Location: login.php");
    die();
}

require 'templates/base.php';
?>