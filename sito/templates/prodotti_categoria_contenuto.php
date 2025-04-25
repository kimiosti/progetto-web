<!-- pagina prodotti categoria -->
<link rel="stylesheet" type="text/css" href="style/stylepage.css"/>
<div class="prodotti_categoria">
    <h2><?php echo strtoupper(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></h2>
    <div class="intro">
        <img src="img/banner.png" alt="#">
        <h3><?php echo htmlspecialchars($templateParams["descrizioneCategoria"]); ?> </h3>
    </div>

    <div class= "filtri">
        <button class="click">Marca<img class="arrow" src="img/arrow-up.png"></button>
        <ul class="dropdown">
            <?php foreach($templateParams['marcafiltri'] as $marca): ?>
                <li><h3><?php echo htmlspecialchars($marca['marca']); ?></h3></li>
            <?php endforeach; ?>
        </ul>
        <button class="click">Taglia<img class="arrow" src="img/arrow-up.png"></button>
        <ul class="dropdown">
            <?php foreach($templateParams['sottocategoriafiltri'] as $sottocategoria): ?>
                <li><h3><?php echo htmlspecialchars($sottocategoria['sottocategoria']); ?></h3></li>
            <?php endforeach; ?>
        </ul>
        <button>Tipo di prodotto<img src="img/arrow-up.png"></button>
        <button>Prezzo<img src="img/arrow-up.png"></button>
    </div>

    
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
