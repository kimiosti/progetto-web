<!DOCTYPE html>
<html lang="it">
    <head>
        <title> <?php echo $templateParams["titolo"]; ?> </title>
        <link rel="icon" type="images/png" href="img/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style/style.css"/>
        <script src="scripts/index.js"></script>
        <script src="script/search.js"></script>

    </head>

    <body>
        <header class="site-header">
            <nav><a href="#"><img src="<?php echo LOCAL_IMG_DIR."list.svg"; ?>" alt="Categorie" /></a>
            </nav><div><a href="index.php"><img src="<?php echo LOCAL_IMG_DIR."logo.png"; ?> " alt="Home Page" /></a>
            </div><nav><ul>
                <li><a href="#" title="Cerca" <?php if(isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") {echo 'hidden="true"';} ?>>
                    <form action="research.php" method="get">
                        <label for="cerca" hidden="true">Cerca</label><input type="text" id="cerca" name="q" placeholder="Cerca..." class="search-input" />
                    </form>
                    <button class="search-btn">
                        <img src="<?php echo LOCAL_IMG_DIR."search.svg"; ?>" alt="Cerca" />
                    </button></a>
                </li><li><a href="wishlist.php"  <?php if(isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") {echo 'hidden="true"';} ?>><img src="<?php echo LOCAL_IMG_DIR."heart.svg"; ?>" alt="Preferiti" /></a>
                </li><li><a href="cart.php"><img src="<?php echo LOCAL_IMG_DIR."handbag.svg"; ?>" <?php if(isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") {echo 'hidden="true"';} ?> alt="Carrello" /></a>
                </li><li><a href="profile.php"><img src="<?php echo LOCAL_IMG_DIR."person.svg"; ?>" alt="Profilo" /></a>
                </li><li><a href="notifications.php"><img src="<?php echo LOCAL_IMG_DIR."bell.svg"; ?>" alt="Notifiche" /></a></li>
        </ul></nav>
        </header>

        <nav>
            <ul>
                <?php foreach($templateParams["categorie"] as $categoria): ?><li><a href="prodotti_categoria.php?categoria=<?php echo urlencode($categoria["nome"]); ?>"><?php echo strtoupper($categoria["nome"]); ?></a></li><?php endforeach; ?>
            </ul>
        </nav>

        <main>
            <?php
                if (isset($templateParams["main"])) {
                    require($templateParams["main"]);
                }
            ?>
        </main>

        <footer>
            <section>
                <header><h2>Politiche aziendali</h2></header>
                <nav><ul>
                    <li><a href="privacy.php">Informativa sulla privacy</a></li>
                    <li><a href="shipping.php">Spedizioni e resi</a></li>
                    <li><a href="payments.php">Metodi di pagamento</a></li>
                </ul></nav>
            </section><section>
                <header><h2>A proposito di PureEssence</h2></header>
                <nav><ul>
                    <li><a href="about.php">About us</a></li>
                    <li><a href="contacts.php">Contatti</a></li>
                </ul></nav>
            </section><section>
                <header><h2>I nostri social</h2></header>
                <nav><ul>
                    <li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."instagram.svg"; ?>" alt="Instagram" /></a>
                    </li><li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."facebook.svg"; ?>" alt="Facebook" /></a>
                    </li><li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."twitter-x.svg"; ?>" alt="X o Twitter" /></a></li>
                </ul></nav>
            </section>
            <p>© 2025 PureEssence</p>
        </footer>
    </body>
</html>