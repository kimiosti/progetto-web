<link rel="stylesheet" type="text/css" href="style/search_result.css"/>

<nav><a href="index.php">Home</a><span>/</span><?php
    if (isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") {
        echo '<a href="profile.php">Pagina personale</a><span>/</span>'
            . '<a href="availability.php">Gestione disponibilità</a>'
            . '<span>/Ricerca</span>';
    } else {
        echo '<span>Ricerca</span>';
    }
?></nav>
<div class="empty-result">
    <h2>Nessun risultato</h2>

    <?php if (isset($templateParams["search_term"]) && !empty($templateParams["search_term"])): ?>
        <p class="lead">
            La tua ricerca per "<strong><?php echo htmlspecialchars($templateParams["search_term"]); ?></strong>" non ha prodotto risultati.
        </p>
    <?php else: ?>
        <p class="lead">La tua ricerca non ha prodotto risultati.</p>
    <?php endif; ?>

    <p>
        Prova a usare termini di ricerca diversi oppure esplora le pagine delle categorie.
    </p>

    <a href="research.php" class="btn-home">Continua a cercare</a>
</div>