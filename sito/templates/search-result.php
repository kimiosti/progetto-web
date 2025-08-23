<link rel="stylesheet" type="text/css" href="style/search_result.css"/>

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
        Prova a usare termini di ricerca diversi oppure torna alla pagina principale.
    </p>

    <a href="index.php" class="btn-home">Torna alla Home</a>
</div>