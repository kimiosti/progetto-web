<?php
require_once '../../setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: ../../login.php");
    die();
} else if ($_SESSION["tipoUtente"] != "acquirente") {
    header("Location: ../../profile.php");
    die();
} else if (!isset($_POST["IDprodotto"]) || !isset($_POST["taglia_selezionata"]) || !isset($_POST["quantita"])) {
    header("Location: ../../cart.php");
    die();
} else {
    if (!$dbh->userHasOpenCart($_SESSION["idutente"])) {
        while (!$dbh->openCart($_SESSION["idutente"])) { }
    }
    $cart = $dbh->getUserCart($_SESSION["idutente"])[0];
    $availability = $dbh->getAvailabilityFromProductAndSize($_POST["IDprodotto"], $_POST["taglia_selezionata"])[0];

    $dbh->addToCart($cart["IDordine"], $availability["IDdisponibilità"], $_POST["quantita"]);
    header("Location: ../../product_detail.php?id=" . $_POST["IDprodotto"]);
    die();
}
?>