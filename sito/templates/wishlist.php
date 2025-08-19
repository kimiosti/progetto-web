<link rel="stylesheet" type="text/css" href="style/wishlist.css" />
<section>
<nav><a href="index.php">Home</a><span>/</span><a href="profile.php">Pagina personale</a><span>/Lista dei desideri</a></nav>
    <header><h1><?php echo $templateParams["titoloPagina"]; ?></h1></header>
    <p class="errore"><?php
        if (isset($templateParams["info"])) {
            echo $templateParams["info"];
        }
    ?></p>
    <div class="prodotti_wishlist"><div class="elenco_prodotti">
        <?php
            foreach ($templateParams["prodotti"] as $prodotto) {
                echo "<div class='prodotto'>";
                echo "<h3>" . htmlspecialchars($prodotto['marca']) . "</h3>";
                echo "<img src='img/" . htmlspecialchars($prodotto['URLimmagine']) . "' alt='" . htmlspecialchars($prodotto['nome']) . "' />";
                echo "<h3>" . htmlspecialchars($prodotto['nome']) . "</h3>";
                echo "<p>" . htmlspecialchars($prodotto['didascalia']) . "</p>";
                echo "</div>";
            }
        ?>
    </div></div>
</section>