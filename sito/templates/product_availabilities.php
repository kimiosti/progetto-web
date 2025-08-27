<link rel="stylesheet" type="text/css" href="style/info_list.css" />

<section>
    <nav><a href="index.php">Home</a><span>/</span><a href="profile.php">Pagina personale</a><span>/</span><a href="availability.php">Gestione disponibilità</a><span>/</span><?php
    if ($templateParams["categoria"] != null) {
        echo '<a href="prodotti_categoria.php?categoria=' . $templateParams["categoria"]["nome"] . '">'
            . ucfirst($templateParams["categoria"]["nome"]) . '</a>';
    }
    ?><span>/Singolo prodotto</span></nav>

    <?php
    if ($templateParams["prodotto"] == null) {
        echo '<p class="errore">Nessun prodotto corrisponde all\'ID indicato.</p>';
    } else if (empty($templateParams["disponibilita"])) {
        echo '<p class="errore">Nessuna disponibilità presente per il prodotto.</p>';
    }
    ?>

    <?php foreach($templateParams["disponibilita"] as $availability): ?>
        <div>
        <header><h2><?php echo $templateParams["prodotto"]["marca"] . ' ' . $templateParams["prodotto"]["nome"] . ' - ' . htmlspecialchars($availability["taglia"]); ?></h2></header>
        <p>Disponibilità rimasta: <?php echo $availability["quantità"] ?></p>
        <p>Prezzo applicato: €<?php echo number_format($availability['prezzo'], 2, ',', '') ?></p>
        <section><a href="modify_availability.php?id=<?php echo $availability["IDdisponibilità"]; ?>&categoria=<?php echo $templateParams["categoria"]["nome"]; ?>"><button>Modifica disponibilità</button></a></section>
        </div>
    <?php endforeach; ?>

    <a href="add_availability.php?id=<?php echo $_GET["id"]; ?>&categoria=<?php echo $templateParams["categoria"]["nome"] ?>"><button>Aggiungi disponibilità</button></a>
</section>