<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: login.php");
    die();
} else if ($_SESSION["tipoUtente"] != "venditore") {
    $templateParams["main"] = "templates/message.php";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titolo"] = PERMISSION_DENIED_PAGE_TITLE;
    $templateParams["titoloMessaggio"] = PERMISSION_DENIED_TITLE;
    $templateParams["corpoMessaggio"] = PERMISSION_DENIED_MESSAGE;
    $templateParams["linkBottone"] = "profile.php";
    $templateParams["testoBottone"] = "Torna al profilo";
    require 'templates/base.php';
} else if (!isset($_GET["id"])) {
    $templateParams["main"] = "templates/message.php";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titolo"] = "PureEssence - Aggiornamento disponibilità";
    $templateParams["titoloMessaggio"] = "Errore nella richiesta";
    $templateParams["corpoMessaggio"] = "Per completare l'azione richiesta, è necessario indicare l'ID della disponibilità da modificare.";
    $templateParams["linkBottone"] = "availability.php";
    $templateParams["testoBottone"] = "Gestisci disponibilità";
    require "templates/base.php";
} else {
    $availabilities = $dbh->getAvailabilityByID($_GET["id"]);
    $availability = empty($availabilities) ? null : $availabilities[0];
    $templateParams["titolo"] = "PureEssence - Aggiornamento disponibilità";
    $templateParams["categorie"] = $dbh->getCategories();

    if ($availability == null) {
        $templateParams["main"] = "templates/message.php";
        $templateParams["titoloMessaggio"] = "Errore nella richiesta";
        $templateParams["corpoMessaggio"] = "Per completare l'azione richiesta, indicare un ID valido.";
        $templateParams["linkBottone"] = "availability.php";
        $templateParams["testoBottone"] = "Gestisci disponibilità";

        require 'templates/base.php';
    } else {
        $templateParams["main"] = "templates/form.php";
        $templateParams["tipoForm"] = "aggiornaDisponibilità";
        $templateParams["prezzoBase"] = $availability["prezzo"];

        require "templates/base.php";
    }
}
?>