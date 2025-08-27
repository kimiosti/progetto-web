<?php
require_once '../../setup.php';

$request = json_decode(file_get_contents("php://input"), true);

if (
    isset($_SESSION["idutente"])
    && isset($request["id"])
) {
        $dbh->toggleFavorite($_SESSION["idutente"], $request["id"]);
}
?>