<link rel="stylesheet" type="text/css" href="style/order_info.css" />

<?php
$cartOk = true;

foreach($templateParams["disponibilità"] as $availability) {
    if ($availability["rimanenza"] < $availability["quantità"]) {
        $cartOk = false;
    }
}
?>

<section>
<nav><a href="index.php">Home</a><span>/</span><a href="research.php">Ricerca</a><span>/Carrello</span></nav>
<h1>Il tuo carrello</h1>
<?php
    if (empty($templateParams["disponibilità"])) {
        echo '<p>Il tuo carrello è vuoto. Comincia ora a fare acquisti!</p>';
    } else if (!$cartOk) {
        echo '<p class="errore">Impossibile procedere al pagamento. Le disponibilità richieste superano le disponibilità di alcuni prodotti.</p>';
    }
?>
<section><?php foreach($templateParams["disponibilità"] as $availability): ?><div>
            <header><h2><?php echo ucfirst($availability["marca"]) . " " . ucfirst($availability["nome"]); ?></h2></header>
            <div><img src="<?php echo LOCAL_IMG_DIR . $availability["URLimmagine"]; ?>" alt="" /></div><div><p>Taglia: <?php echo $availability["taglia"]; ?></p>
            <p>Prezzo: €<?php echo number_format($availability["quantità"] * $availability["prezzo"], 2, ","); ?></p>
            <p>Disponibilità: <?php echo $availability["rimanenza"]; ?></p>
            <form method="post" action="actions/cart/modify-request.php"><input type="hidden" name="quantità" value="-1"/><input type="hidden" name="IDdisponibilità" value="<?php
                echo $availability["IDdisponibilità"];
            ?>" /><input type="hidden" name="IDordine" value="<?php
                echo $availability["IDordine"];
            ?>" /><button type="submit">-</button></form><span <?php
                if ($availability["rimanenza"] < $availability["quantità"]) {
                    echo ' class="errore"';
                } else {
                    echo ' class="ok"';
                }
            ?>> <?php echo $availability["quantità"]; ?> </span><form method="post" action="actions/cart/modify-request.php"><input type="hidden" name="quantità" value="1"/><input type="hidden" name="IDdisponibilità" value="<?php
                echo $availability["IDdisponibilità"];
            ?>" /><input type="hidden" name="IDordine" value="<?php
                echo $availability["IDordine"];
            ?>" /><button>+</button></form>
            <a href="actions/cart/remove.php?IDdisponibilità=<?php echo $availability["IDdisponibilità"]; ?>&IDordine=<?php echo $availability["IDordine"]; ?>"><button>Rimuovi</button></a></div>
        </div><?php endforeach; ?></section>
<?php
    if (!empty($templateParams["disponibilità"])) {
        echo '<footer>'
            . ($cartOk ? '<a href="payment.php"><button>Vai al pagamento</button></a>' : '')
            . '<a href="research.php"><button>Continua lo shopping</button></a>'
            . '</footer>';
    }
?>
</section>