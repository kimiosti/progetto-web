<?php
require_once 'setup.php';

$templateParams["titolo"] = "Contatti - PureEssence";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["main"] = 'templates/contacts-content.php';
$templateParams["css"] = ["style/contact.css"];

require 'templates/base.php';
?>