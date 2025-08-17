<?php
require_once '../../setup.php';

if (isset($_SESSION["idutente"]) && isset($_SESSION["tipoUtente"])) {
    if ($_SESSION["tipoUtente"] != "venditore") {
        header("Location: ../../availability.php");
        die();
    } else if (!isset($_POST["marca"]) || !isset($_POST["nome"]) || !isset($_POST["didascalia"])
               || !isset($_POST["descrizione"]) || !isset($_POST["categoria"]) || !isset($_POST["sottocategoria"])) {
        $_SESSION["mess"] = "Formato richiesta non supportato.";
    } else {
        $didascalia = str_replace("+", " ", $_POST["didascalia"]);
        $descrizione = str_replace("+", " ", $_POST["descrizione"]);
    }
    
    if (empty($_POST["marca"])) {
        $_SESSION["mess"] = "Inserire una marca.";
    } else if (empty($_POST["nome"])) {
        $_SESSION["mess"] = "Inserire il nome del prodotto.";
    } else if (empty($_POST["categoria"])) {
        $_SESSION["mess"] = "Specificare una categoria.";
    } else if (empty($_POST["sottocategoria"])) {
        $_SESSION["mess"] = "Specificare una sottocategoria.";
    } else if ($_FILES["immagine"]["error"] == UPLOAD_ERR_NO_FILE) {
        $_SESSION["mess"] = "Inserire un'immagine.";
    } else if ($_FILES["immagine"]["error"] != UPLOAD_ERR_OK ) {
        $_SESSION["mess"] = "Errore nel caricamento dell'immagine.";
    } else if ($dbh->sameProductExists($_POST["nome"], $_POST["marca"], $_POST["sottocategoria"])) {
        $_SESSION["mess"] = "Prodotto già esistente. Gestirne la disponibilità nell'apposita pagina.";
    } else {
        $dest_dir = "../../" . UPLOAD_DIR 
                    . strtolower(str_replace(" ", "_", $_POST["marca"])) 
                    . "/" . strtolower(str_replace(" ", "_", $_POST["nome"])) . "/";
        if (!is_dir($dest_dir)) { mkdir($dest_dir, recursive: true); }
        $dest_file = $dest_dir . basename($_FILES["immagine"]["name"]);
        if (!getimagesize($_FILES["immagine"]["tmp_name"])) {
            $_SESSION["mess"] = "Inserire un file supportato come immagine.";
        } else if (!move_uploaded_file($_FILES["immagine"]["tmp_name"], $dest_file)) {
            $_SESSION["mess"] = "Errore nel salvataggio dell'immagine.";
        } else if (!$dbh->brandExists($_POST["marca"]) && !$dbh->createBrand($_POST["marca"])) {
            $_SESSION["mess"] = "Errore nella registrazione della marca.";
        } else if (
            !$dbh->subcategoryExists($_POST["categoria"], $_POST["sottocategoria"])
            && !$dbh->createSubcategory($_POST["categoria"], $_POST["sottocategoria"])
        ) {
            $_SESSION["mess"] = "Errore nella registrazione della sottocategoria.";
        } else {
            $image = substr($dest_file, 6);
            $caption = ($_POST["didascalia"] == PRODUCT_CAPTION_DEFAULT) ? "" : $_POST["didascalia"];
            $description = ($_POST["descrizione"] == PRODUCT_DESCRIPTION_DEFAULT) ? "" : $_POST["descrizione"];
            if ($dbh->addProduct(
                    $_POST["nome"],
                    $_POST["marca"],
                    $caption,
                    $description,
                    $image, 
                    $_POST["sottocategoria"])
            ) {
                $_SESSION["mess"] = "Prodotto inserito correttamente.";
            } else {
                $_SESSION["mess"] = "Errore nell'inserimento del prodotto.";
            }
        }
    }

    header("Location: ../../add-product.php");
    die();
} else {
    header("Location: ../../login.php");
    die();
}

?>