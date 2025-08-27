<?php
require_once '../../setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: ../../login.php");
    die();
} else {
    if (isset($_POST["quantità"]) && isset($_POST["IDordine"]) && isset($_POST["IDdisponibilità"])) {
        $dbh->addToCart($_POST["IDordine"], $_POST["IDdisponibilità"], $_POST["quantità"]);
    }
    header("Location: ../../cart.php");
    die();
}
?>