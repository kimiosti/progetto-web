<?php
$prodotto = $templateParams['prodotto'];
$disponibilita = $templateParams['disponibilita'];

$immagini = [];
if (isset($prodotto['URLimmagini']) && !empty($prodotto['URLimmagini'])) {
    $immagini = json_decode($prodotto['URLimmagini'], true);
}
if (empty($immagini) && !empty($prodotto['URLimmagine'])) {
    $immagini = [$prodotto['URLimmagine']];
}
?>

<link rel="stylesheet" type="text/css" href="style/product_detail.css"/>
<script src="script/zoomeffect.js"></script>

<section class="product-detail">
    <section class="product-gallery">
        <section class="thumbnails">
            <?php foreach ($immagini as $index => $urlImmagine): ?>
                <div class="img-zoom-container">
                    <img src="img/<?php echo htmlspecialchars($urlImmagine); ?>" alt="<?php echo htmlspecialchars($prodotto['nome']); ?>" class="thumbnail <?php echo ($index === 0) ? 'active' : ''; ?>">
                </div>
                <div id="zoom-result" class="img-zoom-result"></div>
            <?php endforeach; ?>
        </section>
        <section class="main-image">
             <img src="img/<?php echo htmlspecialchars($immagini[0]); ?>" alt="<?php echo htmlspecialchars($prodotto['nome']); ?>" id="mainProductImage">
        </section>
    </section>

    <section class="product-info">
        <h1 class="product-name"><?php echo htmlspecialchars($prodotto['nome']); ?></h1>
        <h2 class="product-subtitle"><?php echo htmlspecialchars($prodotto['didascalia']); ?></h2>
        <?php if (!empty($prodotto['descrizione'])): ?>
        <p class="product-description"><?php echo nl2br(htmlspecialchars($prodotto['descrizione'])); ?></p>
        <?php endif; ?>

        <p class="product-price">€ <span data-js="dynamic-price"><?php echo number_format($disponibilita[0]['prezzo'], 2, ',', ''); ?></span></p>

        <section class="size-wishlist-row">
            <section class="taglia-selector-container">
                <label class="taglia-label">Scegli una taglia</label>
                <section class="taglia-selector" data-js="taglia-selector-button">
                    <span data-js="selected-taglia"><?php echo htmlspecialchars($disponibilita[0]['taglia']); ?></span>
                </section>
            </section>
            <button class="btn-wishlist" title="Aggiungi ai preferiti">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.61l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>
        </section>

        <form action="actions/cart/add.php" method="POST" class="actions">
            <section class="quantity-selector">
                <button type="button" class="qty-btn" data-js="decrease">-</button>
                <label for="quantity-input" hidden="true">Quantità selezionata</label><input type="number" id="quantity-input" data-js="quantity" value="1" min="1" readonly>
                <button type="button" class="qty-btn" data-js="increase">+</button>
            </section>
            <section class="product-buttons">
                <input type="hidden" name="IDprodotto" value="<?php echo htmlspecialchars($prodotto['IDprodotto']); ?>">
                <input type="hidden" name="taglia_selezionata" data-js="form-size" value="<?php echo htmlspecialchars($disponibilita[0]['taglia']); ?>">
                <input type="hidden" name="quantita" data-js="form-quantity" value="1">
                <button type="submit" class="btn-cart">Aggiungi al carrello</button>
            </section>
        </form>

        <div class="product-info-accordion">
            <div class="accordion-item">
                <button type="button" class="accordion-header">
                    <span>Istruzioni per l'uso</span>
                    <img src="img/arrow-up.png" class="accordion-arrow" alt="Apri sezione">
                </button>
                <div class="accordion-panel">
                    <p><?php echo !empty($prodotto['istruzioni']) ? nl2br(htmlspecialchars($prodotto['istruzioni'])) : 'Istruzioni per l\'uso assenti.'; ?></p>
                </div>
            </div>
            <div class="accordion-item">
                <button type="button" class="accordion-header">
                    <span>Ingredienti</span>
                    <img src="img/arrow-up.png" class="accordion-arrow" alt="Apri sezione">
                </button>
                <div class="accordion-panel">
                    <p><?php echo !empty($prodotto['ingredienti']) ? nl2br(htmlspecialchars($prodotto['ingredienti'])) : 'Nessun ingrediente specificato.'; ?></p>
                </div>
            </div>
            <div class="accordion-item">
                <button type="button" class="accordion-header">
                    <span>Avvertenze di sicurezza</span>
                    <img src="img/arrow-up.png" class="accordion-arrow" alt="Apri sezione">
                </button>
                <div class="accordion-panel">
                    <p><?php echo !empty($prodotto["avvertenze"]) ? nl2br(htmlspecialchars($prodotto['avvertenze'])) : "Nessuna avvertenza di sicurezza."; ?></p>
                </div>
            </div>
        </div>
    </section>
</section>

<div data-js="availability-overlay" class="availability-overlay">
    <section class="availability-modal">
        <p>Scegli la taglia:<p>
        <span class="close-btn">&times;</span>
        <section class="availability-options">
            <?php foreach ($disponibilita as $item): ?>
                <section class="availability-card" data-prezzo="<?php echo number_format($item['prezzo'], 2, ',', ''); ?>" data-taglia="<?php echo htmlspecialchars($item['taglia']); ?>">
                    <section class="card-info">
                        <span class="taglia-name"><?php echo htmlspecialchars($item['taglia']); ?></span>
                        <section class="price-info">
                            <span class="current-price">€ <?php echo number_format($item['prezzo'], 2, ',', ''); ?></span>
                        </section>
                    </section>
                    <section class="card-status">
                        <section class="status-dot available"></section>
                        <span>Disponibile</span>
                    </section>
                </section>
            <?php endforeach; ?>
        </section>
    </section>
</div>

<script src="script/product_detail.js"></script>