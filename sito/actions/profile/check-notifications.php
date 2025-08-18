<?php
require_once '../../setup.php';

class DataCarrier {
    public $hasNotifications = false;
    public $baseImageFolder = LOCAL_IMG_DIR;
}

$obj = new DataCarrier();

if (isset($_SESSION["idutente"])) {
    $obj->hasNotifications = $dbh->hasUnreadNotifications($_SESSION["idutente"], $_SESSION["tipoUtente"]);
}

echo json_encode($obj);

?>