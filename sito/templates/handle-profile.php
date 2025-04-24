<link rel="stylesheet" type="text/css" href="style/handle-profile.css"/>
<?php 
$email = "";
if ($_SESSION["tipoUtente"] == 1) {
    $email = $dbh->getCustomerEmail($_SESSION["idutente"])[0]["email"];
} else {
    $email = $dbh->getSellerEmail($_SESSION["idutente"])[0]["email"];
}
?>
<section>
    <h1>Anagrafica del profilo</h1>
    <p>La tua email: <span><?php echo $email; ?></span></p>
    <nav><a href="#"><button>Cambia email</button></a>
    <a href="#"><button>Cambia password</button></a></nav>
</section>