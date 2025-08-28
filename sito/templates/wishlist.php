<link rel="stylesheet" type="text/css" href="style/stylepage.css" />
<link rel="stylesheet" type="text/css" href="style/wishlist.css" />
<section>
<nav><a href="index.php">Home</a><span>/</span><a href="profile.php">Pagina personale</a><span>/Lista dei desideri</span></nav>
    <header><h1><?php echo $templateParams["titoloPagina"]; ?></h1></header>
    <p class="errore"><?php
        if (isset($templateParams["info"])) {
            echo $templateParams["info"];
        }
    ?></p>
    <section class="elenco-prodotti">
        <?php foreach ($templateParams["prodotti"] as $prodotto): ?><a href="product_detail.php?id=<?php
            echo $prodotto["IDprodotto"];
        ?>" class="prodotto-link"><div class="prodotto">
            <h3><?php echo ucfirst($prodotto["marca"]); ?></h3>
            <img src="<?php echo LOCAL_IMG_DIR . $prodotto["URLimmagine"]; ?>?" alt="<?php echo $prodotto["nome"]; ?>" />
            <h4><?php echo ucfirst($prodotto["nome"]); ?></h4>
            <p><?php echo $prodotto["didascalia"]; ?></p>
            <div class="prodotto-bottom">
                <?php
                    if ($prodotto["prezzo"] != null && $prodotto["taglia"] != null) {
                        echo '<p class="prezzo">€ ' . number_format($prodotto["prezzo"], 2, ",", ".") . '</p>'
                            . '<p class="taglia">' . $prodotto["taglia"] . '</p>';
                    } else {
                        echo '<p class="prezzo">Non disponibile</p>';
                    }
                ?>
            </div>
        </div></a><?php endforeach; ?>
    </section>
</section>