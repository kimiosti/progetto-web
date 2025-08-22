document.addEventListener('DOMContentLoaded', function() {

    // Troviamo il primo LI della seconda NAV. Questo è il nostro contenitore.
    const searchLiContainer = document.querySelector('header nav:last-of-type li:first-child');

    if (!searchLiContainer) {
        return;
    }

    const searchButton = searchLiContainer.querySelector('.search-btn');
    const searchInput = searchLiContainer.querySelector('.search-input');

    const toggleSearchBar = (event) => {
        event.stopPropagation();
        searchLiContainer.classList.toggle('active');

        if (searchLiContainer.classList.contains('active')) {
            searchInput.focus();
        }
    };

    if (searchButton) {
        searchButton.addEventListener('click', toggleSearchBar);
    }

    if (searchInput && searchInput.form) {
        searchInput.form.addEventListener('submit', (event) => {
            if (searchInput.value.trim() === '') {
                event.preventDefault();
                searchLiContainer.classList.remove('active');
            }
        });
    }

    document.addEventListener('click', (event) => {
        if (searchLiContainer.classList.contains('active') && !searchLiContainer.contains(event.target)) {
            searchLiContainer.classList.remove('active');
        }
    });
});