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

    require "templates/base.php";
} else if (!isset($_GET["id"]) || !isset($_GET["categoria"])) {
    $templateParams["main"] = "templates/message.php";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titolo"] = "PureEssence - Aggiunta disponibilità";
    $templateParams["titoloMessaggio"] = "Errore nella richiesta";
    $templateParams["corpoMessaggio"] = "Per completare l'azione richiesta, è necessario indicare l'ID e la categoria del prodotto.";
    $templateParams["linkBottone"] = "availability.php";
    $templateParams["testoBottone"] = "Gestisci disponibilità";

    require "templates/base.php";
} else {
    if (empty($dbh->getProductById($_GET["id"]))) {
        $templateParams["main"] = "templates/message.php";
        $templateParams["categorie"] = $dbh->getCategories();
        $templateParams["titolo"] = "PureEssence - Aggiunta disponibilità";
        $templateParams["titoloMessaggio"] = "Errore nella richiesta";
        $templateParams["corpoMessaggio"] = "L'ID indicato non corrisponde a nessun prodotto.";
        $templateParams["linkBottone"] = "availability.php";
        $templateParams["testoBottone"] = "Gestisci disponibilità";

        require "templates/base.php";
    } else {
        $templateParams["titolo"] = "PureEssence - Aggiunta disponibilità";
        $templateParams["categorie"] = $dbh->getCategories();
        $templateParams["main"] = "templates/form.php";
        $templateParams["tipoForm"] = "nuovaDisponibilità";
        $templateParams["IDprodotto"] = $_GET["id"];
        $templateParams["categoria"] = $_GET["categoria"];

        if (isset($_SESSION["mess"])) {
            $templateParams["messaggioForm"] = $_SESSION["mess"];
            unset($_SESSION["mess"]);
        }

        require "templates/base.php";
    }
}

?>