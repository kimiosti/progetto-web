document.addEventListener('DOMContentLoaded', () => {

    const mainImage = document.getElementById('mainProductImage');
    const thumbnails = document.querySelectorAll('.thumbnail');
    const setupZoomForImage = () => {
        const oldZoomResult = document.getElementById("zoom-result");
        if(oldZoomResult) oldZoomResult.innerHTML = '';
        if (typeof imageZoom === 'function') {
            imageZoom("mainProductImage", "zoom-result");
        } else {
            console.error("ERRORE: La funzione imageZoom() non è stata trovata.");
        }
    };
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            thumbnails.forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
            mainImage.src = thumbnail.src;
            mainImage.onload = setupZoomForImage;
        });
    });
    if (mainImage.complete) {
        setupZoomForImage();
    } else {
        mainImage.onload = setupZoomForImage;
    }

    //accordio
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

    //taglia e aggiornamento form
    const tagliaSelectorButton = document.querySelector('[data-js="taglia-selector-button"]');
    const availabilityOverlay = document.querySelector('[data-js="availability-overlay"]');
    const closeBtn = document.querySelector('[data-js="availability-overlay"] .close-btn');
    const availabilityCards = document.querySelectorAll('.availability-card');
    const selectedTagliaSpan = document.querySelector('[data-js="selected-taglia"]');
    const dynamicPriceSpan = document.querySelector('[data-js="dynamic-price"]');
    const formSizeInput = document.querySelector('[data-js="form-size"]');

    if (tagliaSelectorButton && availabilityOverlay) {
        tagliaSelectorButton.addEventListener('click', () => { availabilityOverlay.style.display = 'flex'; });
        if (closeBtn) { closeBtn.addEventListener('click', () => { availabilityOverlay.style.display = 'none'; }); }
        availabilityOverlay.addEventListener('click', (event) => {
            if (event.target === availabilityOverlay) { availabilityOverlay.style.display = 'none'; }
        });
    }

    availabilityCards.forEach(card => {
        card.addEventListener('click', () => {
            const newTaglia = card.getAttribute('data-taglia');
            const newPrice = card.getAttribute('data-prezzo');
            selectedTagliaSpan.textContent = newTaglia;
            dynamicPriceSpan.textContent = newPrice;
            if (formSizeInput) {
                formSizeInput.value = newTaglia;
            }
            availabilityOverlay.style.display = 'none';
        });
    });

    //quantità e aggiornamento form
    const decreaseBtn = document.querySelector('[data-js="decrease"]');
    const increaseBtn = document.querySelector('[data-js="increase"]');
    const quantityInput = document.querySelector('[data-js="quantity"]');
    const formQuantityInput = document.querySelector('[data-js="form-quantity"]');

    if (decreaseBtn && increaseBtn && quantityInput) {
        decreaseBtn.addEventListener('click', () => {
            let currentQuantity = parseInt(quantityInput.value, 10);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
                if (formQuantityInput) {
                    formQuantityInput.value = quantityInput.value;
                }
            }
        });
        increaseBtn.addEventListener('click', () => {
            quantityInput.value = parseInt(quantityInput.value, 10) + 1;
            if (formQuantityInput) {
                formQuantityInput.value = quantityInput.value;
            }
        });
    }
});