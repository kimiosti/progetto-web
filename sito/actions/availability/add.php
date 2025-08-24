<?php
require_once '../../setup.php';

if (!isset($_POST["id"]) || !isset($_POST["categoria"])) {
    header("Location: ../../add_availability.php");
    die();
} else if (!isset($_POST["taglia"]) || !isset($_POST["quantità"]) || !isset($_POST["prezzo"])) {
    $_SESSION["mess"] = "Formato richiesta non supportato.";
    header("Location: ../..add_availability.php?id=" . $_POST["id"] . "&categoria=" . $_POST["categoria"]);
    die();
} else if (!isset($_SESSION["tipoUtente"]) || $_SESSION["tipoUtente"] != "venditore") {
    header("Location: ../../login.php");
    die();
} else if ($dbh->sameAvailabilityExists($_POST["id"], $_POST["taglia"])) {
    $_SESSION["mess"] = "Disponibilità già registrata. Modificarla dall'apposita pagina.";
    header("Location: ../../add_availability.php?id=" . $_POST["id"] . "&categoria=" . $_POST["categoria"]);
    die();
} else {
    $res = $dbh->recordAvailability($_POST["id"], $_POST["taglia"], $_POST["prezzo"], $_POST["quantità"], $_SESSION["idutente"]);
    $product = $dbh->getProductById($_POST["id"])[0];
    if ($res != -1) {
        $_SESSION["mess"] = "Disponibilità inserita correttamente.";
        $dbh->notifyBuyers(
            $dbh->getInterestedBuyers($res),
            "Nuova disponibilità per " . ucfirst($product["marca"]) . " " . ucfirst($product["nome"]),
            ucfirst($_SESSION["idutente"]) . " ha appena aggiunto una disponibilità per " . ucfirst($product["marca"]) . " " . ucfirst($product["nome"] . " da " . $_POST["taglia"] . ". Acquistala ora!"),
            availabilityID: $res
        );
    } else {
        $_SESSION["mess"] = "Errore durante l'inserimento della disponibilità.";
    }

    header("Location: ../../add_availability.php?id=" . $_POST["id"] . "&categoria=" . $_POST["categoria"]);
    die();
}
?>