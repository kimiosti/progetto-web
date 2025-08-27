<link rel="stylesheet" type="text/css" href="style/stylepage.css" />
<link rel="stylesheet" type="text/css" href="style/research.css" />
<script src="scripts/suggested.js"></script>
<section>
<nav><a href="index.php">Home</a><span>/</span><?php
    if (isset($_SESSION["tipoUtente"]) && $_SESSION["tipoUtente"] == "venditore") {
        echo '<a href="profile.php">Pagina personale</a><span>/</span>'
            . '<a href="availability.php">Gestione disponibilità</a>'
            . '<span>/Ricerca</span>';
    } else {
        echo '<span>Ricerca</span>';
    }
?></nav>
<h1>Ricerca</h1>
<form href="index.php" method="get">
<label for="ricerca">Inserisci il nome, la marca o la categoria del prodotto desiderato</label>
<div><input type="text" id="ricerca" name="q" placeholder="Cerca..." /></div>
<div><input type="submit" name="submit" value="Cerca" /></div>
</form>

<section class="elenco_prodotti"></section>
</section>