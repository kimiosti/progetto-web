<?php
function generateFilterLinks($filterParamName, $availableOptions, $optionKey) {
    $selectedOptions = $_GET[$filterParamName] ?? [];

    foreach ($availableOptions as $option) {
        $currentOptionValue = $option[$optionKey];
        $params = $_GET;
        $isSelected = in_array($currentOptionValue, $selectedOptions);

        $tempOptions = $selectedOptions;
        if ($isSelected) {
            $tempOptions = array_diff($tempOptions, [$currentOptionValue]);
        } else {
            $tempOptions[] = $currentOptionValue;
        }

        $params[$filterParamName] = $tempOptions;
        if (empty($params[$filterParamName])) {
            unset($params[$filterParamName]);
        }

        $url = 'prodotti_Categoria.php?' . http_build_query($params);
        $activeClass = $isSelected ? 'filtro-attivo' : '';

        echo '<li><a href="' . htmlspecialchars($url) . '" class="' . htmlspecialchars($activeClass) . '">' . ucfirst(htmlspecialchars($currentOptionValue)) . '</a></li>';
    }
}
?>

<link rel="stylesheet" type="text/css" href="style/stylepage.css"/>
<link rel="stylesheet" type="text/css" href="style/stylefilter.css"/>
<script src="script/filterpage.js"></script>

<div class="prodotti_categoria">
    <section class="intro" <?php if(isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") { echo 'hidden="true"'; } ?>>
        <h2><?php echo strtoupper(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></h2>
        <img src="img/banner.png" alt="#">
        <h3><?php echo htmlspecialchars($templateParams["descrizioneCategoria"]); ?> </h3>
    </section>

    <section class="breadcrumb-wrapper">
        <section class="breadcrumb-left">
            <nav class="breadcrumb">
                <a href="index.php">Home</a>/<?php
                    if (isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") {
                        echo '<a href="profile.php">Pagina personale</a>'
                            . '<span>/</span>'
                            . '<a href="availability.php">Gestione disponibilità</a>'
                            . '<span>/</span>';
                    }
                ?><span><?php echo ucfirst(htmlspecialchars($templateParams['categoriaSelezionata'])); ?></span>
            </nav>
            <h3 class="titoletto">Filtri</h3>
        </section>

        <form class="form" method="GET">
            <input type="hidden" name="categoria" value="<?php echo htmlspecialchars($templateParams['categoriaSelezionata']); ?>">
            <button type="submit">
                <img class="decorazione" src="img/search-icon.svg" alt="Cerca">
            </button>
            <input class="input" name="search" placeholder="Cerca prodotti..." type="text" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button class="reset" type="button" onclick="location.href='prodotti_Categoria.php?categoria=<?php echo urlencode($templateParams['categoriaSelezionata']); ?>'">
                <img class="decor" src="img/reset-icon.svg">
            </button>
        </form>
    </section>

    <section class="filtri">
        <section class="wrapper">
            <button class="click">Marca <img class="arrow" src="img/arrow-up.png" alt=""></button>
            <ul class="dropdown">
                <?php generateFilterLinks('marca', $templateParams['marcafiltri'], 'marca'); ?>
            </ul>
        </section>

        <section class="wrapper">
            <button class="click">Tipologia di prodotto <img class="arrow" src="img/arrow-up.png" alt=""></button>
            <ul class="dropdown">
                <?php generateFilterLinks('sottocategoria', $templateParams['sottocategoriafiltri'], 'sottocategoria'); ?>
            </ul>
        </section>

        <section class="wrapper">
            <button class="click">Taglia <img class="arrow" src="img/arrow-up.png" alt=""></button>
            <ul class="dropdown">
                <?php generateFilterLinks('taglia', $templateParams['taglieprodottofiltri'], 'taglia'); ?>
            </ul>
        </section>

        <section class="wrapper">
            <button class="click">Prezzo <img class="arrow" src="img/arrow-up.png" alt=""></button>
            <ul class="dropdown">
                <?php
                    $prezziSelezionati = $_GET['prezzo'] ?? [];
                    foreach($templateParams['prezzoprodottofiltri'] as $prezzo) {
                        $prezzoCorrente = $prezzo['prezzo'];
                        $params = $_GET;
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
                        echo '<li><a href="' . htmlspecialchars($url) . '" class="' . htmlspecialchars($classeAttiva) . '">' . htmlspecialchars($prezzoCorrente) . ' €</a></li>';
                    }
                ?>
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
                    echo '<span class="filtro-pill">' . htmlspecialchars($singoloValore) . '<a class="remove-filtro" href="' . htmlspecialchars($url) . '">×</a></span>';
                }
            }
        }
    }
    ?>
    </section>

    <section class="elenco_prodotti">
    <?php
    if (empty($templateParams["prodotti"])) {
        echo "<p>Nessun prodotto trovato che soddisfi i criteri di ricerca.</p>";
    } else {
        foreach ($templateParams["prodotti"] as $prodotto) {
            $link = (isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") ? "handle_availability.php" : "product_detail.php";
            $queryParams = [ 'id' => $prodotto['IDprodotto'] ];
    ?>
            <a href="<?php echo $link . '?' . http_build_query($queryParams); ?>" class="prodotto-link">
                <div class="prodotto">
                    <h3><?php echo htmlspecialchars(ucfirst($prodotto['marca'])); ?></h3>
                    <img src="img/<?php echo htmlspecialchars($prodotto['URLimmagine']); ?>" alt="<?php echo htmlspecialchars($prodotto['nome']); ?>" />
                    <h4><?php echo htmlspecialchars(ucfirst($prodotto['nome'])); ?></h4>
                    <p><?php echo htmlspecialchars($prodotto['didascalia']); ?></p>

                    <?php if (!isset($_SESSION["tipoUtente"]) || $_SESSION["tipoUtente"] != "venditore"): ?>
                        <div class="prodotto-bottom">

                            <p class="prezzo">
                                <?php if(isset($prodotto['prezzo'])): ?>
                                    € <?php echo number_format($prodotto['prezzo'], 2, ',', '.'); ?>
                                <?php else: ?>
                                    Non disponibile
                                <?php endif; ?>
                            </p>

                            <?php if(isset($prodotto['taglia'])): ?>
                                <p class="taglia">
                                    <?php echo htmlspecialchars($prodotto['taglia']); ?>
                                </p>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                </div>
            </a>
    <?php
        }
    }
    ?>
</section>
</div>