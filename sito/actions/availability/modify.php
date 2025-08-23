<?php
require_once '../../setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: ../../login.php");
    die();
} else if (!isset($_POST["id"]) || !isset($_POST["categoria"]) || !isset($_POST["prezzo"]) || !isset($_POST["quantità"])) {
    $_SESSION["mess"] = "Formato richiesta non supportato.";
    header("Location: ../../modify_availability.php");
    die();
} else {
    $availabilities = $dbh->getAvailabilityByID($_POST["id"], $_SESSION["idutente"]);
    $availability = empty($availabilities) ? null : $availabilities[0];

    if ($availability == null) {
        $_SESSION["mess"] = "ID disponibilità non valido.";
        header("Location: ../../modify_availability.php");
        die();
    } else {
        $product = $dbh->getProductById($availability["IDprodotto"])[0];

        if ($_POST["prezzo"] > 0 && $_POST["prezzo"] != $availability["prezzo"]) {
            if ($dbh->updateAvailabilityPrice($_POST["id"], $_POST["prezzo"])) {
                $dbh->notifyBuyers(
                    $dbh->getInterestedBuyers($_POST["id"]),
                    ucfirst($product["marca"]) . " " . ucfirst($product["nome"]) . " ha cambiato prezzo",
                    $_POST["prezzo"] < $availability["prezzo"]
                        ? ucfirst($product["marca"]) . " " . ucfirst($product["nome"])  . " da " . strtolower($availability["taglia"]) . " è appena sceso di prezzo. Controlla ora l'offerta!"
                        : ucfirst($product["marca"]) . " " . ucfirst($product["nome"])  . " da " . strtolower($availability["taglia"]) . " è aumentato di prezzo. Acquistalo ora prima che aumenti ulteriormente!",
                    availabilityID: $_POST["id"]
                );
            } else {
                $_SESSION["mess"] = "Errore durante l'aggiornamento del prezzo.";
            }
        }

        if ($_POST["quantità"] > 0) {
            $finalQuantity = $availability["quantità"] + $_POST["quantità"];
            if ($dbh->updateAvailabilityQuantity($_POST["id"], $finalQuantity)) {
                if ($availability["quantità"] == 0) {
                    $dbh->notifyBuyers(
                        $dbh->getInterestedBuyers($_POST["id"]),
                        ucfirst($product["marca"]) . " " . ucfirst($product["nome"]) . " è tornato disponibile.",
                        ucfirst($_SESSION["idutente"]) . " ha appena aggiunto una disponibilità per " . ucfirst($product["marca"]) . " " . ucfirst($product["nome"]) . " da " . strtolower($availability["taglia"]) . ". Acquistalo ora prima che sia troppo tardi!",
                        availabilityID: $_POST["id"]
                    );
                }
            } else {
                $_SESSION["mess"] = "Errore durante l'aggiornamento della quantità.";
            }
        }

        $_SESSION["mess"] = "Disponibilità aggiornata correttamente.";
        header("Location: ../../modify_availability.php?id=" . $_POST["id"] . "&categoria=" . $_POST["categoria"]);
        die();
    }
}

?>