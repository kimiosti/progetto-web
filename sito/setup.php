<?php
session_start();
define("UPLOAD_DIR", "./img/");
require_once 'database/database.php';
$dbh = new DatabaseHelper("localhost", "root", "", "pureessence");
?>