<?php
require_once 'setup.php';

$templateParams["titolo"] = "PureEssence - Spedizioni e Resi";
$templateParams["categorie"] = $dbh->getCategories();

$templateParams["main"] = "templates/message.php";

$templateParams["titoloMessaggio"] = "Spedizioni e resi";
$templateParams["corpoMessaggio"] = <<<EOD
Le spedizioni sono tutte effettuate al Campus Universitario in via dell'Università 50 a Cesena.<br />
A seconda della disponibilità del prodotto, le consegne possono richiedere da 1 a 5 giorni lavorativi, con tempi superiori
solo per prodotti non disponibili e in attesa di rifornimento.<br />
I resi si possono sempre effettuare entro 3 giorni lavorativi dalla ricezione del prodotto, e danno diritto a un rimborso
completo sotto forma di buono sconto in caso di prodotto difettoso.<br />
Sono considerati lavorativi per i tempi di consegna e reso tutti i giorni in cui il Campus è aperto.<br />
Grazie per aver scelto PureEssence, e buona spesa!
EOD;

require 'templates/base.php';
?>