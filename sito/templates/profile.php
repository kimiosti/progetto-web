<section>
    <h1>Pagina personale</h1>
    <nav>
        <ul>
            <a href="#"><li><img src="<?php echo LOCAL_IMG_DIR."truck.svg"; ?>" alt="Ordini" /><h2>I tuoi ordini</h2>
            </li></a><a href="#"><li><img src="<?php echo LOCAL_IMG_DIR."bell.svg"; ?>" alt="Notifiche" /><h2>Le tue notifiche</h2>
            </li></a><?php
                if (isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == 1) {
                    echo '<a href="wishlist.php"><li><img src="'.LOCAL_IMG_DIR.'heart.svg'.'" alt="Lista dei desideri" /><h2>Lista dei desideri</h2>';
                } else {
                    echo '<a href="#"><li><img src="'.LOCAL_IMG_DIR.'plus.svg'.'" alt="Disponibilità" /><h2>Gestisci disponibilità</h2>';
                }
            ?></li></a><a href="#"><li><img src="<?php echo LOCAL_IMG_DIR."pencil.svg"; ?>" alt="Anagrafica" /><h2>Gestisci il tuo profilo</h2></li></a>
        </ul>
    </nav>
</section>