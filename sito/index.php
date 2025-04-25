<!-- index.php -->
<?php
require_once 'setup.php';

$templateParams["titolo"] = "PureEssence - Home";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["main"]=null;

require 'templates/base.php';
?>