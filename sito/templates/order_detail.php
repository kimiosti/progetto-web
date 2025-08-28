<link rel="stylesheet" type="text/css" href="style/order_info.css" />

<section>
    <nav><a href="index.php">Home</a><span>/</span><a href="profile.php">Pagina personale</a><span>/</span><a href="orders.php">I tuoi ordini</a><span>/Dettaglio ordine</span></nav>
    <h1>Dettaglio ordine</h1>
    <p>Data pagamento: <?php echo $templateParams["disponibilità"][0]["data"]; ?>
    <p>Stato: <?php echo $templateParams["disponibilità"][0]["stato"]; ?>
    <section><?php foreach($templateParams["disponibilità"] as $availability): ?><div>
            <header><h2><?php echo ucfirst($availability["marca"]) . " " . ucfirst($availability["nome"]); ?></h2></header>
            <div><img src="<?php echo LOCAL_IMG_DIR . $availability["URLimmagine"]; ?>" alt="" /></div><div><p>Taglia: <?php echo $availability["taglia"]; ?></p>
            <p>Quantità: <?php echo $availability["quantità"]; ?></p>
            <p>Prezzo: €<?php echo number_format($availability["quantità"] * $availability["prezzo"], 2, ","); ?></p>
            <a href="<?php
                if (isset($_SESSION["tipoUtente"]) && ($_SESSION["tipoUtente"]) == "venditore") {
                    echo 'handle_availability.php?id=' . $availability["IDprodotto"];
                } else {
                    echo 'product_detail.php?id=' . $availability["IDprodotto"];
                }?>"><button><?php
                    if (isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") {
                        echo 'Visualizza disponibilità';
                    } else {
                        echo 'Compra di nuovo';
                    }
                ?></button></a></div>
        </div><?php endforeach; ?></section>
</section>