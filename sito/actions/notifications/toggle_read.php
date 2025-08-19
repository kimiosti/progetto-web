<?php
require_once '../../setup.php';

if (!isset($_GET["id"])) {
    header("Location: profile.php");
    die();
} else {
    $dbh->toggleNotificationRead($_SESSION["tipoUtente"], $_GET["id"]);
    header("Location: ../../notifications.php");
    die();
}

?>