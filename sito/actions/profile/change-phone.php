<?php
require_once '../../setup.php';
if (isset($_SESSION["idutente"]) && isset($_SESSION["tipoUtente"])) {
    if (!isset($_POST["telefono"]) || !isset($_POST["confermaTelefono"])) {
        $_SESSION["mess"] = "Formato richiesta non supportato.";
    } else if (empty($_POST["telefono"]) || empty($_POST["confermaTelefono"])) {
        $_SESSION["mess"] = "Inserisci e ripeti un numero di telefono.";
    } else if (strcmp($_POST["telefono"], $_POST["confermaTelefono"]) != 0) {
        $_SESSION["mess"] = "I due numeri di telefono non coincidono.";
    } else if ($dbh->setPhoneNumber($_SESSION["tipoUtente"], $_SESSION["idutente"], $_POST["telefono"])) {
        $_SESSION["mess"] = "Numero di telefono modificato correttamente.";
    } else {
        $_SESSION["mess"] = "Impossibile modificare il numero di telefono.";
    }

    header("Location: ../../set-phone.php");
    die();
} else {
    header("Location: ../../login.php");
    die();
}
?>