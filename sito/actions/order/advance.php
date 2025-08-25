<?php
require_once '../../setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: ../../login.php");
    die();
} else if (!isset($_GET["id"]) || $_SESSION["tipoUtente"] != "venditore") {
    header("Location: ../../profile.php");
    die();
} else {
    if ($dbh->advanceOrderState($_GET["id"])) {
        $order = $dbh->getOrderByID($_GET["id"])[0];
        $dbh->notifyBuyers(
            $dbh->getOrderAuthor($_GET["id"]),
            "Il tuo ordine è " . strtolower($order["stato"]),
            "L'ordine n° " . $_GET["id"] . " è stato processato da " . ucfirst($_SESSION["idutente"]) . " ed è ora " . strtolower($order["stato"]) . ". Controllalo ora nella tua pagina personale!",
            orderID: $_GET["id"]
        );
    }
    header("Location: ../../orders.php");
}
?>