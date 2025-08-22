<?php
session_start();
define("LOCAL_IMG_DIR", "img/");
define("UPLOAD_DIR", "img/uploads/");
define("PRODUCT_CAPTION_DEFAULT", "Inserire il testo da visualizzare nell'anteprima del prodotto.");
define("PRODUCT_DESCRIPTION_DEFAULT", "Inserire il testo da visualizzare nella pagina di dettaglio del prodotto.");
define("PRODUCT_INSTRUCTIONS_DEFAULT", "Inserire le istruzioni per l'uso.");
define("PRODUCT_INGREDIENTS_DEFAULT", "Inserire gli ingredienti del prodotto.");
define("PRODUCT_WARNINGS_DEFAULT", "Inserire le avvertenze di sicurezza.");
define("PERMISSION_DENIED_PAGE_TITLE", "PureEssence - Accesso negato");
define("PERMISSION_DENIED_TITLE", "Accesso negato");
define("PERMISSION_DENIED_MESSAGE", "Gli account di questo tipo non possono effettuare l'azione richiesta.");
require_once 'database/database.php';
$dbh = new DatabaseHelper("localhost", "root", "", "pureessence");
?>