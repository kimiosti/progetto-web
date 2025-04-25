<?php
require_once '../../setup.php';
if (isset($_SESSION["idutente"]) && isset($_SESSION["tipoUtente"])) {
    if(!isset($_POST["email"]) || !isset($_POST["confermaEmail"])) {
        $_SESSION["mess"] = "Formato richiesta non supportato.";
    } else if (strcmp($_POST["email"], $_POST["confermaEmail"]) != 0) {
        $_SESSION["mess"] = "Le due email non coincidono.";
    } else if (empty($_POST["email"])) {
        $_SESSION["mess"] = "Inserire una mail.";
    } else {
        if ($dbh->setEmail($_SESSION["tipoUtente"], $_SESSION["idutente"], $_POST["email"])) {
            $_SESSION["mess"] = "Email cambiata correttamente";
        } else {
            $_SESSION["mess"] = "Errore nella modifica della mail.";
        }
    }
} else {
    header("Location: ../../login.php");
    die();
}

header("Location: ../../set-email.php");
die();
?>