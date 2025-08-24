<?php
require_once 'setup.php';

$templateParams["titolo"] = "Chi Siamo - PureEssence";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["main"] = 'templates/about-content.php';
$templateParams["css"] = ["style/about-us.css"];

require 'templates/base.php';
?>