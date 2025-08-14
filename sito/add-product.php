<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
} else if ($_SESSION["tipoUtente"] != "venditore") {
    $templateParams["titolo"] = "PureEssence - Accesso negato";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titoloMessaggio"] = "Accesso negato";
    $templateParams["corpoMessaggio"] = "Solamente i venditori possono aggiungere nuovi prodotti.";
    $templateParams["linkBottone"] = "profile.php";
    $templateParams["testoBottone"] = "Torna al profilo";

    $templateParams["main"] = "templates/message.php";
    require 'templates/base.php';
} else {
    $templateParams["titolo"] = "PureEssence - Nuovo prodotto";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/form.php";
    $templateParams["tipoForm"] = "nuovoProdotto";

    require 'templates/base.php';
}
?>