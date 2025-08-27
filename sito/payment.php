<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: login.php");
    die();
} else {
    $cart = $dbh->getCartContent($_SESSION["idutente"]);
    $cartOk = true;
    $price = 0;

    foreach ($cart as $item) {
        if ($item["rimanenza"] < $item["quantità"]) {
            $cartOk = false;
        }
        $price = $price + ($item["quantità"] * $item["prezzo"]);
    }

    if (empty($cart) || !$cartOk) {
        header("Location: cart.php");
        die();
    } else {
        $templateParams["titolo"] = "PureEssence - Pagamento";
        $templateParams["categorie"] = $dbh->getCategories();
        $templateParams["main"] = "templates/form.php";
        $templateParams["messaggioForm"] = "Prezzo totale €" . number_format($price, 2, ",");
        $templateParams["tipoForm"] = "pagamento";
        $templateParams["IDordine"] = $cart[0]["IDordine"];

        require "templates/base.php";
    }
}
?>