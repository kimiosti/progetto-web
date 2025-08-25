<link rel="stylesheet" type="text/css" href="style/info_list.css" />

<section>
    <nav><a href="index.php">Home</a><span>/</span><a href="profile.php">Pagina personale</a><span>/I tuoi ordini</span></nav>
    <h1>I tuoi ordini</h1>
    <?php
        if (empty($templateParams["ordini"])) {
            echo '<p class="errore">Non hai ancora'
                . ($_SESSION["tipoUtente"] == "venditore" ? ' ricevuto ' : ' effettuato ')
                . 'ordini.</p>';
        }
    ?>
    <?php foreach($templateParams["ordini"] as $ordine): ?>
        <div>
            <header><h2>Ordine n° <?php echo $ordine["IDordine"]; ?></h2></header>
            <p>Data pagamento: <?php echo $ordine["data"]; ?></p>
            <p>Stato ordine: <?php echo strtolower($ordine["stato"]); ?></p>
            <section>
                <a href="order_detail.php?id=<?php echo $ordine["IDordine"]; ?>"><button>Visualizza dettaglio</button></a>
                <?php
                    if ($_SESSION["tipoUtente"] == "venditore") {
                        echo '<a href="actions/order/advance.php?id="'
                            . $ordine["IDordine"]
                            . '"><button>Avanza stato</button></a>';
                    }
                ?>
            </section>
        </div>
    <?php endforeach ?>
</section>