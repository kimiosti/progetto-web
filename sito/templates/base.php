<!DOCTYPE html>
<html lang="it">
    <head>
        <title> <?php echo $templateParams["titolo"]; ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style/style.css"/>
    </head>

    <body>
        <header>
            <nav><a href="#"><img src="<?php echo LOCAL_IMG_DIR."list.svg"; ?>" alt="Categorie" /></a>
            </nav><div><a href="index.php"><img src="<?php echo LOCAL_IMG_DIR."logo.png"; ?> " alt="" /></a>
            </div><nav><ul>
                <li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."search.svg"; ?>" alt="Cerca" /></a>
                </li><li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."heart.svg"; ?>" alt="Preferiti" /></a>
                </li><li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."person.svg"; ?>" alt="Profilo" /></a>
                </li><li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."handbag.svg"; ?>" alt="Carrello" /></a></li>
        </ul></nav>
        </header>

        <nav>
            <ul>
                <?php foreach($templateParams["categorie"] as $categoria): ?><li><a href="#"><?php echo strtoupper($categoria["nome"]) ?></a></li><?php endforeach; ?>
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
                <header><h2>I nostri social</h2></header>
                <nav><ul>
                    <li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."instagram-logo.png"; ?>" alt="Instagram" /></a>
                    </li><li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."facebook-logo.png"; ?>" alt="Facebook" /></a>
                    </li><li><a href="#"><img src="<?php echo LOCAL_IMG_DIR."x-logo.png"; ?>" alt="X o Twitter" /></a></li>
                </ul></nav>
            </section>
            <p>© 2025 PureEssence</p>
        </footer>
    </body>
</html>