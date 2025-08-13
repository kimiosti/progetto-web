<link rel="stylesheet" type="text/css" href="style/profile.css"/>
<section>
    <h1>Pagina personale</h1>
    <nav>
        <ul>
            <li><a href="#"><div><img src="<?php echo LOCAL_IMG_DIR."truck.svg"; ?>" alt="Ordini" /><h2>I tuoi ordini</h2></div>
            </a></li><li><a href="#"><div><img src="<?php echo LOCAL_IMG_DIR."bell.svg"; ?>" alt="Notifiche" /><h2>Le tue notifiche</h2></div>
            </a></li><?php
                if (isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "acquirente") {
                    echo '<li><a href="wishlist.php"><div><img src="'.LOCAL_IMG_DIR.'heart.svg'.'" alt="Lista dei desideri" /><h2>Lista dei desideri</h2></div>';
                } else {
                    echo '<li><a href="availability.php"><div><img src="'.LOCAL_IMG_DIR.'plus.svg'.'" alt="Disponibilità" /><h2>Gestisci disponibilità</h2></div>';
                }
            ?></a></li><li><a href="handle-profile.php"><div><img src="<?php echo LOCAL_IMG_DIR."pencil.svg"; ?>" alt="Anagrafica" /><h2>Gestisci il tuo profilo</h2></div></a></li>
        </ul>
    </nav>
    <a href="actions/profile/logout.php"><button>Logout</button></a>
</section>
<script src="scripts/profile.js"></script>