<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"])) {
    header("Location: login.php");
}

require 'templates/base.php';
?>