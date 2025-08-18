<?php
require_once 'setup.php';

$templateParams["titolo"] = "PureEssence - Privacy";
$templateParams["categorie"] = $dbh->getCategories();

$templateParams["main"] = "templates/message.php";

$templateParams["titoloMessaggio"]  = "Informativa sulla Privacy";
$templateParams["corpoMessaggio"] = <<<EOD
A noi di PureEssence sta a cuore la tua privacy.<br />
È per questo che non raccogliamo nessun tipo di dato personale, né ci affidiamo a nessun gestore esterno per salvare cookie
sulle tue abitudini di acquisto.<br />
Abbiamo inoltre come politica aziendale quella di non salvare nessun dato di pagamento degli utenti, e usiamo la massima
cautela nel salvataggio delle password con cifratura per proteggere il tuo account da eventuali attacchi malevoli.<br />
Goditi il tuo shopping in sicurezza sul nostro sito!
EOD;
$templateParams["linkBottone"] = "index.php";
$templateParams["testoBottone"] = "Torna alla home";

require 'templates/base.php';
?>