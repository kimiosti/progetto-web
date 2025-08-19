<link rel="stylesheet" type="text/css" href="style/stylepage.css"/>
<link rel="stylesheet" type="text/css" href="style/stylefilter.css"/>

<script src="script/filterpage.js"></script>

<div class="prodotti_categoria">
    <h2><?php echo strtoupper(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></h2>
    <section class="intro">
        <img src="img/banner.png" alt="#">
        <h3><?php echo htmlspecialchars($templateParams["descrizioneCategoria"]); ?> </h3>
    </section>

    <section class="breadcrumb-wrapper">
        <section class="breadcrumb-left">
            <nav class="breadcrumb">
                <a href="index.php">Home</a> /
                <span><?php echo ucfirst(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></span>
            </nav>
            <h3 class="titoletto">Filtri</h3>
        </section>

        <form class="form">
            <input type="hidden" name="categoria" value="<?php echo htmlspecialchars($templateParams['categoriaSelezionata']); ?>">
            <button type="submit">
                <img class="decorazione" src="img/search-icon.svg" alt="Cerca">
            </button>
            <input class="input" name="search" placeholder="Cerca prodotti..." required type="text" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button class="reset" type="button" onclick="location.href='prodotti_Categoria.php?categoria=<?php echo urlencode($templateParams['categoriaSelezionata']); ?>'">
                <img class="decor" src="img/reset-icon.svg">
            </button>
        </form>
    </section>

    <section class="filtri">
        <section class="wrapper">
            <button class="click">Marca <img class="arrow" src="img/arrow-up.png"></button>
            <ul class="dropdown">
                <?php
                $marcheSelezionate = $_GET['marca'] ?? [];
                foreach($templateParams['marcafiltri'] as $marca):
                    $params = $_GET;
                    $marcaCorrente = $marca['marca'];
                    $isSelezionata = in_array($marcaCorrente, $marcheSelezionate);
                    $marcheTemp = $marcheSelezionate;
                    if ($isSelezionata) {
                        $marcheTemp = array_diff($marcheTemp, [$marcaCorrente]);
                    } else {
                        $marcheTemp[] = $marcaCorrente;
                    }
                    $params['marca'] = $marcheTemp;
                    if(empty($params['marca'])) { unset($params['marca']); }
                    $url = 'prodotti_Categoria.php?' . http_build_query($params);
                    $classeAttiva = $isSelezionata ? 'filtro-attivo' : '';
                ?>
                    <li><a href="<?php echo $url; ?>" class="<?php echo $classeAttiva; ?>"><?php echo ucfirst(htmlspecialchars($marcaCorrente)); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="wrapper">
            <button class="click">Tipologia di prodotto <img class="arrow" src="img/arrow-up.png"></button>
            <ul class="dropdown">
                <?php
                $sottocategorieSelezionate = $_GET['sottocategoria'] ?? [];
                foreach($templateParams['sottocategoriafiltri'] as $sottocategoria):
                    $params = $_GET;
                    $sottocategoriaCorrente = $sottocategoria['sottocategoria'];
                    $isSelezionata = in_array($sottocategoriaCorrente, $sottocategorieSelezionate);
                    $sottocategorieTemp = $sottocategorieSelezionate;
                    if ($isSelezionata) {
                        $sottocategorieTemp = array_diff($sottocategorieTemp, [$sottocategoriaCorrente]);
                    } else {
                        $sottocategorieTemp[] = $sottocategoriaCorrente;
                    }
                    $params['sottocategoria'] = $sottocategorieTemp;
                    if(empty($params['sottocategoria'])) { unset($params['sottocategoria']); }
                    $url = 'prodotti_Categoria.php?' . http_build_query($params);
                    $classeAttiva = $isSelezionata ? 'filtro-attivo' : '';
                ?>
                    <li><a href="<?php echo $url; ?>" class="<?php echo $classeAttiva; ?>"><?php echo ucfirst(htmlspecialchars($sottocategoriaCorrente)); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="wrapper">
            <button class="click">Taglia <img class="arrow" src="img/arrow-up.png"></button>
            <ul class="dropdown">
                <?php
                $taglieSelezionate = $_GET['taglia'] ?? [];
                foreach($templateParams['taglieprodottofiltri'] as $taglia):
                    $params = $_GET;
                    $tagliaCorrente = $taglia['taglia'];
                    $isSelezionata = in_array($tagliaCorrente, $taglieSelezionate);
                    $taglieTemp = $taglieSelezionate;
                    if ($isSelezionata) {
                        $taglieTemp = array_diff($taglieTemp, [$tagliaCorrente]);
                    } else {
                        $taglieTemp[] = $tagliaCorrente;
                    }
                    $params['taglia'] = $taglieTemp;
                    if(empty($params['taglia'])) { unset($params['taglia']); }
                    $url = 'prodotti_Categoria.php?' . http_build_query($params);
                    $classeAttiva = $isSelezionata ? 'filtro-attivo' : '';
                ?>
                    <li><a href="<?php echo $url; ?>" class="<?php echo $classeAttiva; ?>"><?php echo htmlspecialchars($tagliaCorrente); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="wrapper">
            <button class="click">Prezzo <img class="arrow" src="img/arrow-up.png"></button>
            <ul class="dropdown">
                <?php
                $prezziSelezionati = $_GET['prezzo'] ?? [];
                foreach($templateParams['prezzoprodottofiltri'] as $prezzo):
                    $params = $_GET;
                    $prezzoCorrente = $prezzo['prezzo'];
                    $isSelezionato = in_array($prezzoCorrente, $prezziSelezionati);
                    $prezziTemp = $prezziSelezionati;
                    if ($isSelezionato) {
                        $prezziTemp = array_diff($prezziTemp, [$prezzoCorrente]);
                    } else {
                        $prezziTemp[] = $prezzoCorrente;
                    }
                    $params['prezzo'] = $prezziTemp;
                    if(empty($params['prezzo'])) { unset($params['prezzo']); }
                    $url = 'prodotti_Categoria.php?' . http_build_query($params);
                    $classeAttiva = $isSelezionato ? 'filtro-attivo' : '';
                ?>
                    <li><a href="<?php echo $url; ?>" class="<?php echo $classeAttiva; ?>"><?php echo htmlspecialchars($prezzoCorrente); ?> €</a></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </section>

    <section class="filtri-attivi-container">
    <?php
    $filtri = ['marca', 'sottocategoria', 'taglia', 'prezzo'];
    $filtriAttivi = array_intersect_key($_GET, array_flip($filtri));

    if (!empty($filtriAttivi)) {
        echo '<a class="filtro-pill cancella-tutti" href="prodotti_Categoria.php?categoria=' . urlencode($templateParams['categoriaSelezionata']) . (isset($_GET['search']) ? '&search='.urlencode($_GET['search']) : '') . '">Cancella filtri</a>';

        foreach ($filtriAttivi as $chiave => $valore) {
            if (is_array($valore)) {
                foreach ($valore as $singoloValore) {
                    $params = $_GET;

                    $params[$chiave] = array_diff($params[$chiave], [$singoloValore]);
                    if (empty($params[$chiave])) {
                        unset($params[$chiave]);
                    }

                    if (isset($params['search']) && strcasecmp($params['search'], $singoloValore) == 0) {
                        unset($params['search']);
                    }

                    $url = 'prodotti_Categoria.php?' . http_build_query($params);
                    echo '<span class="filtro-pill">' . htmlspecialchars($singoloValore) . '<a class="remove-filtro" href="' . $url . '">×</a></span>';
                }
            }
        }
    }
    ?>
    </section>

    <section class="elenco_prodotti">
        <?php
        if (empty($templateParams["prodotti"])) {
            echo "<p>Nessun prodotto trovato.</p>";
        } else {
            foreach ($templateParams["prodotti"] as $prodotto) {
                echo '<a href="product_detail.php?id=' . $prodotto['IDprodotto'] . '" class="prodotto-link">';

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

                echo '</a>';
            }
        }
        ?>
    </section>
</div>