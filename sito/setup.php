<?php
session_start();
define("LOCAL_IMG_DIR", "./img/");
define("UPLOAD_DIR", "./upload-img/");
require_once 'database/database.php';
$dbh = new DatabaseHelper("localhost", "root", "", "pureessence");
?>