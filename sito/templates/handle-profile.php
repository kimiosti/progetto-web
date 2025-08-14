<link rel="stylesheet" type="text/css" href="style/multioption.css"/>
<?php 
$email = "";
$telefono = "";
if ($_SESSION["tipoUtente"] == "acquirente") {
    $email = $dbh->getCustomerInfo($_SESSION["idutente"])[0]["email"];
    $telefono = $dbh->getCustomerInfo($_SESSION["idutente"])[0]["telefono"];
} else {
    $email = $dbh->getSellerInfo($_SESSION["idutente"])[0]["email"];
    $telefono = $dbh->getSellerInfo($_SESSION["idutente"])[0]["telefono"];
}
?>
<section>
    <h1>Anagrafica del profilo</h1>
    <?php
        if ($email == "") {
            echo '<p class="errore">Non hai ancora registrato un indirizzo email.</p>';
        } else {
            echo '<p>La tua email: <span>' . $email . '</span></p>';
        }

        if ($telefono == "") {
            echo '<p class="errore">Non hai ancora registrato un numero di telefono.</p>';
        } else {
            echo '<p>Il tuo numero di telefono: <span>' . $telefono . '</span></p>';
        }
    ?>
    <nav><ul>  
        <li><a href="set-email.php"><div><img src="<?php echo LOCAL_IMG_DIR."envelope.svg"; ?>" alt="Cambia email" /><h2>Cambia email</h2></div></a>
        </li><li><a href="set-password.php"><div><img src="<?php echo LOCAL_IMG_DIR."key.svg"; ?>" alt="Cambia password" /><h2>Cambia password</h2></div></a>
        </li><li><a href="set-phone.php"><div><img src="<?php echo LOCAL_IMG_DIR."telephone.svg"; ?>" alt="Cambia telefono" /><h2>Cambia telefono</h2></div></a>
        </li><li><a href="delete-account.php"><div><img src="<?php echo LOCAL_IMG_DIR."x.svg"; ?>" alt="Rimuovi account" /><h2>Rimuovi account<h2></div></a>
    </ul></nav>
    <a href="profile.php"><button>Torna indietro</button></a>
</section>