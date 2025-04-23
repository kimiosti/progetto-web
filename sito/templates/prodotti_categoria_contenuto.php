<!-- pagina prodotti categoria -->
<link rel="stylesheet" type="text/css" href="style/stylepage.css"/>
<div class="prodotti_categoria">
    <h2>Prodotti nella categoria: <?php echo htmlspecialchars($templateParams['categoriaSelezionata']); ?></h2>
    <div class="elenco_prodotti">
        <?php
        if (empty($templateParams["prodotti"])) {
            echo "<p>Nessun prodotto trovato.</p>";
        } else {
            foreach ($templateParams["prodotti"] as $prodotto) {
                echo "<div class='prodotto'>";
                echo "<h3>" . htmlspecialchars($prodotto['marca']) . "</h3>";
                echo "<img src='img/" . htmlspecialchars($prodotto['URLimmagine']) . "' alt='" . htmlspecialchars($prodotto['nome']) . "' />";
                echo "<h3>" . htmlspecialchars($prodotto['nome']) . "</h3>";
                echo "<p>" . htmlspecialchars($prodotto['didascalia']) . "</p>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>
