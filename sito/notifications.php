<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
    die();
} else {
    $templateParams["titolo"] = "PureEssence - Notifiche";
    $templateParams["categorie"] = $dbh->getCategories();

    if (isset($_GET["read"]) && $_GET["read"] == "true") {
        $templateParams["notifiche"] = $dbh->getAllNotifications($_SESSION["idutente"], $_SESSION["tipoUtente"], true);
    } else {
        $templateParams["notifiche"] = $dbh->getAllNotifications($_SESSION["idutente"], $_SESSION["tipoUtente"], false);
    }
    $templateParams["main"] = 'templates/notifications.php';

    require_once 'templates/base.php';
}
?>