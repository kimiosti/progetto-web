function initializeZoom() {
    setTimeout(() => {
        if (typeof imageZoom === 'function') {
            imageZoom("mainProductImage", "zoom-result");
        } else {
            console.error("La funzione imageZoom non è stata trovata. Assicurati che il file zoomeffect.js sia caricato prima di questo.");
        }
    }, 200);
}

document.addEventListener('DOMContentLoaded', function() {
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
        const header = item.querySelector('.accordion-header');
        const panel = item.querySelector('.accordion-panel');

        header.addEventListener('click', function() {
            if (item.classList.contains('active')) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
            item.classList.toggle('active');
        });
    });
});



document.addEventListener('DOMContentLoaded', () => {
    const mainImage = document.getElementById('mainProductImage');
    const thumbnails = document.querySelectorAll('.thumbnail');

    const setupZoomForImage = () => {
        if (typeof imageZoom === 'function') {
            imageZoom("mainProductImage", "zoom-result");
        } else {
            console.error("ERRORE: La funzione imageZoom() non è stata trovata. Controlla che il file zoom_effect.js sia caricato PRIMA di product_detail.js nel tuo HTML.");
        }
    };

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            thumbnails.forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
            mainImage.onload = setupZoomForImage;
            mainImage.src = thumbnail.src;
        });
    });

    if (mainImage.complete) {
        setupZoomForImage();
    } else {
        mainImage.onload = setupZoomForImage;
    }


    const tagliaSelectorButton = document.getElementById('tagliaSelectorButton');
    const availabilityOverlay = document.getElementById('availabilityOverlay');
    const closeBtn = document.querySelector('#availabilityOverlay .close-btn');
    const availabilityCards = document.querySelectorAll('.availability-card');
    const selectedTagliaSpan = document.getElementById('selectedTaglia');
    const dynamicPriceSpan = document.getElementById('dynamic-price');

    if (tagliaSelectorButton && availabilityOverlay) {
        tagliaSelectorButton.addEventListener('click', () => {
            availabilityOverlay.style.display = 'flex';
        });
        if(closeBtn) {
            closeBtn.addEventListener('click', () => {
                availabilityOverlay.style.display = 'none';
            });
        }
        availabilityOverlay.addEventListener('click', (event) => {
            if (event.target === availabilityOverlay) {
                availabilityOverlay.style.display = 'none';
            }
        });
    }

    if(availabilityCards.length > 0) {
        availabilityCards.forEach(card => {
            card.addEventListener('click', () => {
                const newTaglia = card.getAttribute('data-taglia');
                const newPrice = card.getAttribute('data-prezzo');
                selectedTagliaSpan.textContent = newTaglia;
                dynamicPriceSpan.textContent = newPrice;
                availabilityOverlay.style.display = 'none';
            });
        });
    }

    const decreaseBtn = document.getElementById('decrease');
    const increaseBtn = document.getElementById('increase');
    const quantityInput = document.getElementById('quantity');

    if (decreaseBtn && increaseBtn && quantityInput) {
        decreaseBtn.addEventListener('click', () => {
            let currentQuantity = parseInt(quantityInput.value, 10);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
            }
        });
        increaseBtn.addEventListener('click', () => {
            let currentQuantity = parseInt(quantityInput.value, 10);
            quantityInput.value = currentQuantity + 1;
        });
    }
});