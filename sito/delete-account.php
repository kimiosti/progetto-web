<?php
require_once 'setup.php';

$templateParams["titolo"] = "PureEssence - Rimuovi account";
$templateParams["categorie"] = $dbh->getCategories();

$templateParams["main"] = "templates/form.php";
$templateParams["tipoForm"] = "rimuoviAccount";
$templateParams["messaggioForm"] = "Clicca per confermare la rimozione dell'account.<br />L'azione non potrà essere annullata.";

require 'templates/base.php';
?>