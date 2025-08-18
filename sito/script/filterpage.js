//il codice viene eseguito solo dopo che tutta la pagina HTML è stata caricata
document.addEventListener('DOMContentLoaded', () => {
    const clickButtons = document.querySelectorAll('.click'); //seleziono tutti i bottoni

    clickButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Trova il dropdown subito dopo il bottone
            const dropdown = button.nextElementSibling; //prende l'elemento dopo button

            // Chiudi tutti i dropdown
            document.querySelectorAll('.dropdown').forEach(d => {
                if (d !== dropdown) {
                    d.style.display = 'none';
                }
            });

            // Toggle visibilità solo di quello cliccato
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    });
});
