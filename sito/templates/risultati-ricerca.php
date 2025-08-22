<?php if (empty($templateParams["prodotti"])): ?>
    <p>Nessun prodotto trovato.</p>
<?php else: ?>
    <h2>Risultati della ricerca</h2>
    <ul class="lista-prodotti">
        <?php foreach ($templateParams["prodotti"] as $p): ?>
            <li>
                <a href="prodotti_categoria.php?categoria=<?php echo urlencode($p["categoria"]); ?>&highlight=<?php echo $p["IDprodotto"]; ?>">
                    <img src="<?php echo htmlspecialchars($p["URLimmagine"]); ?>" alt="<?php echo htmlspecialchars($p["nome"]); ?>">
                    <p><?php echo htmlspecialchars($p["nome"]); ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
