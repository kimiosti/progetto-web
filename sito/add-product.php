<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
} else if ($_SESSION["tipoUtente"] != "venditore") {
    $templateParams["titolo"] = PERMISSION_DENIED_PAGE_TITLE;
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["titoloMessaggio"] = PERMISSION_DENIED_TITLE;
    $templateParams["corpoMessaggio"] = PERMISSION_DENIED_MESSAGE;
    $templateParams["linkBottone"] = "profile.php";
    $templateParams["testoBottone"] = "Torna al profilo";

    $templateParams["main"] = "templates/message.php";
    require 'templates/base.php';
} else {
    $templateParams["titolo"] = "PureEssence - Nuovo prodotto";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/form.php";
    $templateParams["tipoForm"] = "nuovoProdotto";

    if (isset($_SESSION["mess"])) {
        $templateParams["messaggioForm"] = $_SESSION["mess"];
        unset($_SESSION["mess"]);
    }

    require 'templates/base.php';
}
?>