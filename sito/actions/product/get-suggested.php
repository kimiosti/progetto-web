<?php
require_once '../../setup.php';

$products = $dbh->getRandomProducts();

for ($i = 0; $i < count($products); $i++) {
    $availabilities = $dbh->getAvailabilities($products[$i]["IDprodotto"]);

    $products[$i]["URLimmagine"] = LOCAL_IMG_DIR . $products[$i]["URLimmagine"];
    $products[$i]["prezzo"] = empty($availabilities) ? null : $availabilities[0]["prezzo"];
    $products[$i]["taglia"] = empty($availabilities) ? null : $availabilities[0]["taglia"];
    $products[$i]["visualizzatore"] = isset($_SESSION["tipoUtente"]) ? $_SESSION["tipoUtente"] : null;
}

header("Content-type: application/json");
echo json_encode($products);
?>