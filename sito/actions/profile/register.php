<?php
require_once '../../setup.php';
if (
    !isset($_POST["username"]) 
    || !isset($_POST["password"]) 
    || !isset($_POST["confermaPassword"]) 
    || !isset($_POST["email"])
    || !isset($_POST["confermaEmail"])
    || !isset($_POST["telefono"])
    || !isset($_POST["confermaTelefono"])
) {
    $_SESSION["regErr"] = "Formato richiesta non supportato.";
    header("Location: ../../registration.php");
    die();
} else if (empty($_POST["username"]) || empty($_POST["password"])) {
    $_SESSION["regErr"] = "Inserire username e password per registrarsi.";
    header("Location: ../../registration.php");
    die();
} else if (strcmp($_POST["password"], $_POST["confermaPassword"]) != 0) {
    $_SESSION["regErr"] = "Le due password non coincidono.";
    header("Location: ../../registration.php");
    die();
} else if (strcmp($_POST["email"], $_POST["confermaEmail"]) != 0) {
    $_SESSION["regErr"] = "Le due email non coincidono.";
    header("Location: ../../registration.php");
    die();
} else if (strcmp($_POST["telefono"], $_POST["confermaTelefono"]) != 0) {
    $_SESSION["regErr"] = "I due numeri di telefono non coincidono.";
    header("Location: ../../registration.php");
    die();
} else {
    if ($dbh->addUser($_POST["username"], hash("sha512", $_POST["password"]), $_POST["email"], $_POST["telefono"])) {
        $_SESSION["idutente"] = $_POST["username"];
        $_SESSION["tipoUtente"] = "acquirente";
        header("Location: ../../profile.php");
        die();
    } else {
        $_SESSION["regErr"] = "Questo username è già in uso";
        header("Location: ../../registration.php");
        die();
    }
}
?>