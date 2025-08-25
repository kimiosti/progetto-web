<?php
require_once '../../setup.php';

class ResponseCarrier {
    public $isFavorite = false;
}

$response = new ResponseCarrier();
$request = json_decode(file_get_contents("php://input"), true);

if (isset($_SESSION["idutente"]) && isset($request["id"])) {
    $response->isFavorite = $dbh->isFavorite($_SESSION["idutente"], $request["id"]);
}

header("Content-type: application/json");
echo json_encode($response);
?>