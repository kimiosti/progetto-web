<?php
require_once 'setup.php';

$templateParams["categorie"] = $dbh->getCategories();
$templateParams["titolo"] = "PureEssence - Home";
$templateParams["main"] = 'templates/homepage.php';

require 'templates/base.php';
?>
