<!-- pagina prodotti categoria -->
<link rel="stylesheet" type="text/css" href="style/stylepage.css"/>
<script src="script/filterpage.js"></script>
<div class="prodotti_categoria">
    <h2><?php echo strtoupper(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></h2>
    <div class="intro">
        <img src="img/banner.png" alt="#">
        <h3><?php echo htmlspecialchars($templateParams["descrizioneCategoria"]); ?> </h3>
    </div>

<!-- percorso -->
    <nav class="breadcrumb"> 
        <a href="index.php">Home</a> /
        <span><?php echo ucfirst(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></span>
        <h3 class=titoletto>Filtri</h3>
    </nav>

    

<!-- menù a tendina filtri -->
    <div class= "filtri">
        <div class="wrapper">
            <button class="click" >Marca<img class="arrow" src="img/arrow-up.png"></button>
                <ul class="dropdown">
                    <?php foreach($templateParams['marcafiltri'] as $marca): ?>
                        <li><p><?php echo ucfirst(htmlspecialchars($marca['marca']));?></p></li>
                    <?php endforeach; ?>
                </ul>
        </div>
    
        <div class="wrapper">
            <button class="click">Tipologia di prodotto<img class="arrow" src="img/arrow-up.png"></button>
                <ul class="dropdown">
                    <?php foreach($templateParams['sottocategoriafiltri'] as $sottocategoria): ?>
                        <li><p><?php echo ucfirst(htmlspecialchars($sottocategoria['sottocategoria']));?></p></li>
                    <?php endforeach; ?>
                </ul>
        </div>
    
        <div class="wrapper">
            <button class="click">Taglia<img class= "arrow" src="img/arrow-up.png"></button>
                <ul class="dropdown">
                        <?php foreach($templateParams['taglieprodottofiltri'] as $marca): ?>
                            <li><p><?php echo ucfirst(htmlspecialchars($taglia['taglia']));?></p></li>
                        <?php endforeach; ?>
                </ul>
        </div>

        <div class="wrapper">
            <button>Prezzo<img src="img/arrow-up.png"></button>
        </div>

    </div>

<!-- prodotti -->
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
