<?php
require_once 'setup.php';

$templateParams["titolo"] = "PureEssence - Home";
$templateParams["categorie"] = $dbh->getCategories();

require 'templates/base.php';
?>