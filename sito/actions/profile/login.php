<?php
require_once '../../setup.php';

if (!isset($_POST["username"]) || !isset($_POST["password"])) {
    $_SESSION["logErr"] = "Formato richiesta non supportato.";
    header("Location: ../../login.php");
} else if (empty($_POST["username"]) || empty($_POST["password"])) {
    $_SESSION["logErr"] = "Inserire username e password.";
    header("Location: ../../login.php");
    die();
} else {
    $loginResult = $dbh->checkLogin($_POST["username"], hash("sha512", $_POST["password"]));
    if ($loginResult == "wrongCredentials") {
        $_SESSION["logErr"] = "Username o password errati.";
        header("Location: ../../login.php");
        die();
    } else {
        $_SESSION["idutente"] = $_POST["username"];
        $_SESSION["tipoUtente"] = $loginResult;
        header("Location: ../../profile.php");
        die();
    }
}
?>