<?php
require_once 'setup.php';

$templateParams["titolo"] = "Contatti - PureEssence";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["main"] = 'templates/cart-content.php';
$templateParams["css"] = ["style/contact.css"];

require 'templates/base.php';
?>