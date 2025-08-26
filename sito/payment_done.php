<?php
require_once 'setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: login.php");
    die();
} else if ($_SESSION["tipoUtente"] != "acquirente") {
    header("Location: profile.php");
    die();
} else {
    $templateParams["titolo"] = "PureEssence - Pagamento accettato";
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["main"] = "templates/message.php";

    $templateParams["titoloMessaggio"] = "Pagamento accettato";
    $templateParams["corpoMessaggio"] = "Il pagamento è stato accettato, puoi visualizzare lo stato del tuo ordine dalla pagina personale.";
    $templateParams["linkBottone"] = "profile.php";
    $templateParams["testoBottone"] = "Torna al profilo";

    require "templates/base.php";
}
?>