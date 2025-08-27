<?php
require_once '../../setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: ../../login.php");
    die();
} else if ($_SESSION["tipoUtente"] != "acquirente") {
    header("Location: ../../profile.php");
    die();
} else if (!isset($_POST["IDordine"])) {
    header("Location: ../../cart.php");
    die();
} else {
    $cart = $dbh->getCartContent($_SESSION["idutente"]);
    $cartOk = true;
    $price = 0;

    foreach ($cart as $availability) {
        if ($availability["rimanenza"] < $availability["quantità"]) {
            $cartOk = false;
        }
        $price = $price + ($availability["prezzo"] * $availability["quantità"]);
    }

    if (empty($cart) || !$cartOk) {
        header("Location: ../../cart.php");
        die();
    }

    $dbh->notifySellers(
        $dbh->getConcernedSellers($_POST["IDordine"]),
        "Hai ricevuto un ordine",
        "Un utente ha appena effettuato un ordine. Visualizzalo ora!",
        orderID: $_POST["IDordine"]
    );

    foreach($cart as $availability) {
        if ($availability["rimanenza"] == $availability["quantità"]) {
            $dbh->notifySellers(
                $dbh->getAvailabilitySeller($availability["IDdisponibilità"]),
                ucfirst($availability["marca"]) . ' ' . ucfirst($availability["nome"]) . ' da ' . $availability["taglia"] . ' è terminato',
                'Hai ricevuto un ordine, e la disponibilità per ' . ucfirst($availability["marca"]) . ' ' . ucfirst($availability["nome"]) . ' da ' . $availability["taglia"] . ' è terminata. Ripristina ora lo stato della disponibilità!',
                availabilityID: $availability["IDdisponibilità"]
            );
        } else if ($availability["rimanenza"] - $availability["quantità"] < 5) {
            $dbh->notifySellers(
                $dbh->getAvailabilitySeller($availability["IDdisponibilità"]),
                ucfirst($availability["marca"]) . ' ' . ucfirst($availability["nome"]) . ' da ' . $availability["taglia"] . ' sta per terminare',
                'Hai ricevuto un ordine, e restano solo ' . ($availability["rimanenza"] - $availability["quantità"]) . ' unità di ' . ucfirst($availability["marca"]) . ' ' . ucfirst($availability["nome"]) . ' da ' . $availability["taglia"] . 'Controlla ora la disponibilità!',
                availabilityID: $availability["IDdisponibilità"]
            );
        }
        $dbh->decrementAvailability($availability["quantità"], $availability["IDdisponibilità"]);
    }

    $dbh->advanceOrderState($_POST["IDordine"]);
    $dbh->recordPayment($_POST["IDordine"], $price);

    $dbh->notifyBuyers(
        $dbh->getBuyerFromID($_SESSION["idutente"]),
        "Il tuo ordine è stato processato",
        "Il pagamento è stato accettato, e il tuo ordine è ora pronto ad essere gestito dai nostri venditori. Controllane ora lo stato!",
        orderID: $_POST["IDordine"]
    );

    header("Location: ../../payment_done.php");
    die();
}
?>