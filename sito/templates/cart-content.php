<link rel="stylesheet" type="text/css" href="style/order_info.css" />

<section>
<nav><a href="index.php">Home</a><span>/</span><a href="research.php">Ricerca</a><span>/Carrello</span></nav>
<h1>Il tuo carrello</h1>
<?php
    if (empty($templateParams["disponibilità"])) {
        echo '<p>Il tuo carrello è vuoto. Comincia ora a fare acquisti!</p>';
    }
?>
<section><?php foreach($templateParams["disponibilità"] as $availability): ?><div>
            <header><h2><?php echo ucfirst($availability["marca"]) . " " . ucfirst($availability["nome"]); ?></h2></header>
            <div><img src="<?php echo LOCAL_IMG_DIR . $availability["URLimmagine"]; ?>" alt="" /></div><div><p>Taglia: <?php echo $availability["taglia"]; ?></p>
            <p>Quantità: <?php echo $availability["quantità"]; ?></p>
            <p>Prezzo: €<?php echo number_format($availability["quantità"] * $availability["prezzo"], 2, ","); ?></p>
            <a href="actions/cart/remove.php?IDdisponibilità=<?php echo $availability["IDdisponibilità"]; ?>&IDordine=<?php echo $availability["IDordine"]; ?>"><button>Rimuovi</button></a></div>
        </div><?php endforeach; ?></section>
<?php
    if (!empty($templateParams["disponibilità"])) {
        echo '<footer>'
            . '<a href="#"><button>Vai al pagamento</button></a>'
            . '<a href="research.php"><button>Continua lo shopping</button></a>'
            . '</footer>';
    }
?>
</section>