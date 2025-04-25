<?php
require_once '../../setup.php';
if (isset($_SESSION["idutente"]) && isset($_SESSION["tipoUtente"])) {
    if (!isset($_POST["vecchiaPassword"]) || !isset($_POST["password"]) || !isset($_POST["confermaPassword"])) {
        $_SESSION["mess"] = "Formato richiesta non supportato.";
    } else if ($dbh->checkLogin($_SESSION["idutente"], hash("sha512", $_POST["vecchiaPassword"])) == "wrongCredentials") {
        $_SESSION["mess"] = "Vecchia password errata.";
    } else if (empty($_POST["password"]) || empty($_POST["confermaPassword"])) {
        $_SESSION["mess"] = "Inserire una nuova password e ripeterla.";
    } else if (strcmp($_POST["confermaPassword"], $_POST["password"]) != 0) {
        $_SESSION["mess"] = "Le due password non coincidono.";
    } else if (strcmp($_POST["password"], $_POST["vecchiaPassword"]) == 0) {
        $_SESSION["mess"] = "Inserire una password diversa dalla precedente.";
    } else if ($dbh->setPassword($_SESSION["tipoUtente"], $_SESSION["idutente"], hash("sha512", $_POST["password"]))) {
        $_SESSION["mess"] = "Password cambiata correttamente.";
    } else {
        $_SESSION["mess"] = "Errore durante la modifica della password.";
    }

    header("Location: ../../set-password.php");
    die();
} else {
    header("Location: ../../login.php");
    die();
}
?>