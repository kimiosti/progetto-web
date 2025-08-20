<link rel="stylesheet" type="text/css" href="style/wishlist.css" />
<section>
<nav><a href="index.php">Home</a><span>/</span><a href="profile.php">Pagina personale</a><span>/Lista dei desideri</span></nav>
    <header><h1><?php echo $templateParams["titoloPagina"]; ?></h1></header>
    <p class="errore"><?php
        if (isset($templateParams["info"])) {
            echo $templateParams["info"];
        }
    ?></p>
    <section><?php foreach ($templateParams["prodotti"] as $prodotto): ?><a href="product_detail.php?id=<?php echo $prodotto["IDprodotto"]; ?>"><div>
                <header><h2><?php echo htmlspecialchars($prodotto["marca"]); ?></h2></header>
                <div><img src="<?php echo $prodotto["URLimmagine"]; ?>" alt="<?php echo htmlspecialchars($prodotto["nome"]); ?>" /></div>
                <section><h3><?php echo htmlspecialchars($prodotto["nome"]); ?></h3><p><?php echo htmlspecialchars($prodotto["didascalia"]); ?></p></section>
            </div></a><?php endforeach; ?></section>
</section>