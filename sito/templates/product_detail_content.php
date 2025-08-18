<?php

$prodotto = $templateParams['prodotto'];
$disponibilita = $templateParams['disponibilita'];
?>
<link rel="stylesheet" type="text/css" href="style/product_detail.css"/>

<div class="product-detail">
    <div class="product-gallery">
        <div class="thumbnails">
            <?php if (!empty($prodotto['URLimmagine'])): ?>
                <img src="img/<?php echo htmlspecialchars($prodotto['URLimmagine']); ?>" alt="<?php echo htmlspecialchars($prodotto['nome']); ?>" class="thumbnail active">
            <?php endif; ?>
        </div>
        <div class="main-image">
            <img src="img/<?php echo htmlspecialchars($prodotto['URLimmagine']); ?>" alt="<?php echo htmlspecialchars($prodotto['nome']); ?>">
        </div>
    </div>

    <div class="product-info">
        <h1 class="product-name"><?php echo htmlspecialchars($prodotto['nome']); ?></h1>
        <p class="product-subtitle"><?php echo htmlspecialchars($prodotto['didascalia']); ?></p>

        <p class="product-price">€ <?php echo number_format($disponibilita[0]['prezzo'], 2, ',', ''); ?></p>

        <label for="taglia-prezzo">Scegli una taglia</label>
        <select name="taglia-prezzo" id="taglia-prezzo">
            <?php foreach ($disponibilita as $item): ?>
                <option value="<?php echo $item['IDdisponibilità']; ?>">
                    <?php echo htmlspecialchars($item['taglia']); ?> - € <?php echo number_format($item['prezzo'], 2, ',', ''); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="quantity-selector">
            <button type="button" class="qty-btn" id="decrease">-</button>
            <input type="number" id="quantity" name="quantity" value="1" min="1">
            <button type="button" class="qty-btn" id="increase">+</button>
        </div>

        <div class="actions">
            <button class="btn-cart">Aggiungi al carrello</button>
            <button class="btn-wishlist">♡</button>
        </div>
    </div>
</div>
