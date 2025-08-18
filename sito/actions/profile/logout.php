<?php
require_once '../../setup.php';
if (isset($_SESSION["idutente"]) && isset($_SESSION["tipoUtente"])) {
    unset($_SESSION["idutente"]);
    unset($_SESSION["tipoUtente"]);
    $_SESSION["logout"] = true;
    header("Location: ../../login.php");
    die();
}
?>