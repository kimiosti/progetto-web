<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: login.php");
    die();
} else if (!isset($_GET["id"])) {
    $templateParams["titolo"] = "PureEssence - Errore";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["main"] = "templates/message.php";

    $templateParams["titoloMessaggio"] = "Errore nella richiesta";
    $templateParams["corpoMessaggio"] = "Per visualizzare il dettaglio di un ordine, indicare il suo ID.";
    $templateParams["testoBottone"] = "I tuoi ordini";
    $templateParams["linkBottone"] = "orders.php";

    require "templates/base.php";
} else {
    $availabilities = $dbh->getOrderedAvailabilities($_GET["id"]);

    if (empty($availabilities)) {
        $templateParams["titolo"] = "PureEssence - Errore";
        $templateParams["categorie"] = $dbh->getCategories();
        $templateParams["main"] = "templates/message.php";

        $templateParams["titoloMessaggio"] = "Errore nella richiesta";
        $templateParams["corpoMessaggio"] = "Per visualizzare il dettaglio di un ordine, inserire un ID valido.";
        $templateParams["testoBottone"] = "I tuoi ordini";
        $templateParams["linkBottone"] = "orders.php";

        require "templates/base.php";
    } else {
        $templateParams["titolo"] = "PureEssence - Dettaglio ordine";
        $templateParams["categorie"] = $dbh->getCategories();
        $templateParams["main"] = "templates/order_detail.php";

        $templateParams["disponibilità"] = $availabilities;

        require "templates/base.php";
    }
}
?>