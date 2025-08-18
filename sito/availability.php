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
    $templateParams["titolo"] = "PureEssence - Disponibilità";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/availability.php";

    require 'templates/base.php';
}
?>