<?php
require_once 'setup.php';

$templateParams["titolo"] = "PureEssence - Pagamenti";
$templateParams["categorie"] = $dbh->getCategories();

$templateParams["main"] = "templates/message.php";

$templateParams["titoloMessaggio"] = "Metodi di pagamento";
$templateParams["corpoMessaggio"] = <<<EOD
In PureEssence accettiamo tutti i principali metodi di pagamento tramite carta, per offrirti un'esperienza di acquisto
sicura e senza stress.<br />
Puoi pagare comodamente con tutte le carte di credito e debito dei circuiti più diffusi come Visa, MasterCard e
American Express.<br />
Garantiamo inoltre transazioni protette grazie all'uso delle più moderne tecnologie di sicurezza e non salviamo nessun dato
sui tuoi metodi di pagamento per farti acquistare in tutta tranquillità.<br />
Scegli il metodo che preferisci e completa il tuo ordine in pochi semplici passaggi!
EOD;
$templateParams["linkBottone"] = "index.php";
$templateParams["testoBottone"] = "Torna alla home";

require 'templates/base.php';
?>