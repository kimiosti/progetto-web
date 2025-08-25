<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Test Ricezione Dati Carrello</title>
    <style>
        body { font-family: monospace; padding: 20px; }
        pre { background-color: #f4f4f4; padding: 15px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>

    <h1>Test di ricezione dati per cart-content.php</h1>
    <hr>

    <?php
    // Controlliamo se la richiesta è di tipo POST (inviata dal nostro form)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        echo "<h2> Dati ricevuti correttamente tramite POST:</h2>";

        // La funzione print_r() stampa il contenuto di un array in un formato leggibile.
        // Il tag <pre> aiuta a mantenere la formattazione.
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

    } else {
        echo "<h2>❌ Nessun dato ricevuto con metodo POST.</h2>";
        echo "<p>Assicurati di arrivare a questa pagina inviando il form dalla pagina del prodotto.</p>";
    }
    ?>

</body>
</html>