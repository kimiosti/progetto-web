<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
    die();
} else {
    $templateParams["titolo"] = "PureEssence - Pagina personale";
    $templateParams["categorie"] = $dbh->getCategories();

    $templateParams["main"] = "templates/profile.php";
}

require 'templates/base.php';
?>