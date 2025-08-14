<!-- pagina prodotti categoria -->
<link rel="stylesheet" type="text/css" href="style/stylepage.css"/>
<link rel="stylesheet" type="text/css" href="style/stylefilter.css"/>

<script src="script/filterpage.js"></script>
<div class="prodotti_categoria">
    <h2><?php echo strtoupper(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></h2>
    <div class="intro">
        <img src="img/banner.png" alt="#">
        <h3><?php echo htmlspecialchars($templateParams["descrizioneCategoria"]); ?> </h3>
    </div>

<!-- percorso -->
 <div class="breadcrumb-wrapper">
  <div class="breadcrumb-left">
    <nav class="breadcrumb">
      <a href="index.php">Home</a> /
      <span><?php echo ucfirst(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></span>
    </nav>
    <h3 class="titoletto">Filtri</h3>
  </div>

  <form class="form">
    <button type="submit">
        <img class="decorazione" src="img/search-icon.svg" alt="Cerca">
    </button>

    <input class="input" placeholder="Cerca prodotti..." required type="text">

    <button class="reset" >
              <img class="decor" src="img/reset-icon.svg">
    </button>
  </form>
</div>



<!-- menù a tendina filtri -->
    <div class= "filtri">

        <!-- Marca -->
        <div class="wrapper">
        <button class="click">Marca <img class="arrow" src="img/arrow-up.png"></button>
        <ul class="dropdown">
            <?php foreach($templateParams['marcafiltri'] as $marca):
                $params = $_GET;
                $params['marca'] = $marca['marca']; // aggiungi/aggiorna filtro marca
                $url = 'prodotti_Categoria.php?' . http_build_query($params);
            ?>
                <li><a href="<?php echo $url; ?>"><?php echo ucfirst(htmlspecialchars($marca['marca'])); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Tipologia -->
    <div class="wrapper">
        <button class="click">Tipologia di prodotto <img class="arrow" src="img/arrow-up.png"></button>
        <ul class="dropdown">
            <?php foreach($templateParams['sottocategoriafiltri'] as $sottocategoria):
                $params = $_GET;
                $params['sottocategoria'] = $sottocategoria['sottocategoria']; // aggiungi filtro sottocategoria
                $url = 'prodotti_Categoria.php?' . http_build_query($params);
            ?>
                <li><a href="<?php echo $url; ?>"><?php echo ucfirst(htmlspecialchars($sottocategoria['sottocategoria'])); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>


    <!-- Taglia -->
    <div class="wrapper">
        <button class="click">Taglia <img class="arrow" src="img/arrow-up.png"></button>
        <ul class="dropdown">
            <?php foreach($templateParams['taglieprodottofiltri'] as $taglia):
                $params = $_GET;
                $params['taglia'] = $taglia['taglia'];
                $url = 'prodotti_Categoria.php?' . http_build_query($params);
            ?>
                <li><a href="<?php echo $url; ?>"><?php echo htmlspecialchars($taglia['taglia']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Prezzo -->
    <div class="wrapper">
        <button class="click">Prezzo <img class="arrow" src="img/arrow-up.png"></button>
        <ul class="dropdown">
            <?php foreach($templateParams['prezzoprodottofiltri'] as $prezzo):
                $params = $_GET;
                $params['prezzo'] = $prezzo['prezzo'];
                $url = 'prodotti_Categoria.php?' . http_build_query($params);
            ?>
                <li><a href="<?php echo $url; ?>"><?php echo htmlspecialchars($prezzo['prezzo']); ?> €</a></li>
            <?php endforeach; ?>
        </ul>
    </div>

<!-- filtri attivi -->
<div class="filtri-attivi-container">
    <?php
    $filtri = ['marca', 'sottocategoria', 'taglia', 'prezzo'];
    $filtriAttivi = array_intersect_key($_GET, array_flip($filtri));

    if (!empty($filtriAttivi)) {

        // Cancella tutti
        echo '<a class="filtro-pill cancella-tutti" href="prodotti_Categoria.php?categoria=' . urlencode($templateParams['categoriaSelezionata']) . '">Cancella tutti i filtri</a>';

        // Ogni filtro attivo
        foreach ($filtriAttivi as $chiave => $valore) {
            $params = $_GET;
            unset($params[$chiave]);
            $url = 'prodotti_Categoria.php?' . http_build_query($params);

            echo '<span class="filtro-pill">';
            echo htmlspecialchars($valore);
            echo '<a class="remove-filtro" href="' . $url . '">×</a>';
            echo '</span>';
        }
    }
    ?>
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

                echo "<div class='prodotto-bottom'>";
                    echo "<p class='prezzo'>€ " . number_format($prodotto['prezzo'], 2, ',', '') . "</p>";
                    echo "<p class='taglia'>" . htmlspecialchars($prodotto['taglia']) . "</p>";
                echo "</div>";

                echo "</div>";
            }
        }
        ?>
    </div>
</div>


