<?php
require_once '../../setup.php';

if (!isset($_SESSION["idutente"]) || !isset($_SESSION["tipoUtente"])) {
    header("Location: ../../login.php");
    die();
} else if ($_SESSION["tipoUtente"] != "acquirente") {
    header("Location: ../../profile.php");
    die();
} else if (!isset($_GET["IDdisponibilità"]) || !isset($_GET["IDordine"])) {
    header("Location: ../../cart.php");
    die();
} else {
    $dbh->removeInclusion($_GET["IDordine"], $_GET["IDdisponibilità"]);
    header("Location: ../../cart.php");
    die();
}
?>