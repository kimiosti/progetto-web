<link rel="stylesheet" type="text/css" href="style/notifications.css">
<section>
<nav>
<a href="index.php">Home</a><span>/</span><a href="profile.php">Pagina personale</a><span>/</span><span>Notifiche</span>
</nav>
<header><h1>Notifiche</h1></header>
<?php
if (empty($templateParams["notifiche"])) {
    if (isset($_GET["read"]) && $_GET["read"] == "true") {
        echo '<p class="errore">Troverai qui le tue notifiche dopo averle visualizzate.</p>';
    } else {
        echo '<p class="errore">Non hai nuove notifiche.</p>';
    }
}
?>
<?php foreach ($templateParams["notifiche"] as $notifica): ?>
<div>
<header><a href="#"><h2><?php echo $notifica["titolo"]; ?></h2></a></header>
<p><?php echo $notifica["contenuto"] ?></p>
<section><?php
if ($notifica["IDordine"] != null) {
    echo '<a href="#"><button>Visualizza ordine</button></a>';
} else if ($notifica["IDdisponibilità"] != null) {
    echo '<a href="#"><button>Visualizza disponibilità</button></a>';
}
?><a href="actions/notifications/toggle_read.php?id=<?php
echo $notifica["IDnotifica"];
?>&read=<?php
echo (isset($_GET["read"]) && $_GET["read"] == "true") ? "true" : "false";
?>"><button><?php
echo $notifica["letto"] == 1 ? 'Segna come non letta' : 'Segna come letta';
?></button></a>
</section>
</div>
<?php endforeach ?>
<?php
if (isset($_GET["read"]) && $_GET["read"] == "true") {
    echo '<a href="notifications.php"><button>Vedi non lette</button></a>';
} else {
    echo '<a href="notifications.php?read=true"><button>Vedi già lette</button></a>';
}
?>
</section>
