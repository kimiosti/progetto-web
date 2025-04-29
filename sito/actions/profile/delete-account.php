<?php
require_once '../../setup.php';

function deletedRedirect() {
    unset($_SESSION["idutente"]);
    unset($_SESSION["tipoUtente"]);
    $_SESSION["logErr"] = "Account cancellato correttamente.";
    header("Location: ../../login.php");
    die();
}

function nonDeletedRedirect() {
    $_SESSION["erroreRimozione"] = "Errore durante la rimozione dell'account.";
    header("Location: ../../delete-account.php");
    die();
}

if (isset($_SESSION["idutente"]) && isset($_SESSION["tipoUtente"])) {
    if ($_SESSION["idutente"] == "acquirente") {
        if ($dbh->deleteCustomer($_SESSION["idutente"])) {
            deletedRedirect();
        } else {
            nonDeletedRedirect();
        }
    } else {
        if ($dbh->deleteSeller($_SESSION["idutente"])) {
            deletedRedirect();
        } else {
            nonDeletedRedirect();
        }
    }    
}
?>