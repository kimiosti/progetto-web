<?php
require_once 'setup.php';

$templateParams["titolo"] = "PureEssence - Rimuovi account";
$templateParams["categorie"] = $dbh->getCategories();

$templateParams["main"] = "templates/form.php";
$templateParams["tipoForm"] = "rimuoviAccount";

if (isset($_SESSION["erroreRimozione"])) {
    $templateParams["messaggioForm"] = $_SESSION["erroreRimozione"];
    unset($_SESSION["erroreRimozione"]);
} else {
    $templateParams["messaggioForm"] = "Clicca per confermare la rimozione dell'account.<br />L'azione non potrà essere annullata.";
}

require 'templates/base.php';
?>