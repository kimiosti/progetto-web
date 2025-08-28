<?php
require_once '../../setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: ../../login.php");
    die();
} else if (!isset($_GET["id"])) {
    header("Location: ../../notifications.php");
    die();
} else {
    $dbh->deleteNotification($_SESSION["tipoUtente"], $_GET["id"]);

    if (isset($_GET["read"]) && $_GET["read"] == "true") {
        header("Location: ../../notifications.php?read=true");
        die();
    } else {
        header("Location: ../../notifications.php");
        die();
    }
}
?>