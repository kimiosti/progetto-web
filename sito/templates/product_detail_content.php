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
        <h3 class="product-subtitle"><?php echo htmlspecialchars($prodotto['didascalia']); ?></h3>
        <?php if (!empty($prodotto['descrizione'])): ?>
        <p class="product-description"><?php echo nl2br(htmlspecialchars($prodotto['descrizione'])); ?></p>
        <?php endif; ?>

        <p class="product-price">€ <span id="dynamic-price"><?php echo number_format($disponibilita[0]['prezzo'], 2, ',', ''); ?></span></p>

        <section class="size-wishlist-row">
            <section class="taglia-selector-container">
                <label for="taglia-prezzo" class="taglia-label">Scegli una taglia</label>
                <section class="taglia-selector" id="tagliaSelectorButton">
                    <span id="selectedTaglia"><?php echo htmlspecialchars($disponibilita[0]['taglia']); ?></span>
                    <i class="fas fa-chevron-down"></i>
                </section>
            </section>
            <button class="btn-wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.61l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>
        </section>

        <section class="actions">
            <section class="quantity-selector">
                <button type="button" class="qty-btn" id="decrease">-</button>
                <input type="number" id="quantity" name="quantity" value="1" min="1" readonly>
                <button type="button" class="qty-btn" id="increase">+</button>
            </section>
            <section class="product-buttons">
                <button class="btn-cart">Aggiungi al carrello</button>
            </section>
        </section>

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

<div id="availabilityOverlay" class="availability-overlay">
    <section class="availability-modal">
        <p>Scegli la taglia:<p>
        <span class="close-btn">&times;</span>
        <section class="availability-options">
            <?php foreach ($disponibilita as $item): ?>
                <section class="availability-card" data-id="<?php echo $item['IDdisponibilità']; ?>" data-prezzo="<?php echo number_format($item['prezzo'], 2, ',', ''); ?>" data-taglia="<?php echo htmlspecialchars($item['taglia']); ?>">
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