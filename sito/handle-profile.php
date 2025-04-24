<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
} else {
    $templateParams["titolo"] = "PureEssence - Modifica Profilo";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/handle-profile.php";
}

require 'templates/base.php';
?>