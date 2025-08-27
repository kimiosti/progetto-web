const TITLE = '<h2>Potrebbero interessarti</h2>';

function createProductsHTML(products) {
    console.log(products);
    let text = "";
    for (let i = 0; i < products.length; i = i+1) {
        let link;
        if (element.visualizzatore == "venditore") {
            link = "handle_availability.php?id=" + products[i].IDprodotto;
        } else {
            link = "product_detail.php?id=" + products[i].IDprodotto;
        }

        text = text
            + '<a href="' + link + '" class="prodotto-link"><div class="prodotto">'
            + '<h3>' + products[i].marca.charAt(0).toUpperCase() + products[i].marca.slice(1) + '</h3>'
            + '<img src="' + products[i].URLimmagine + '" alt="' + products[i].nome + '">'
            + '<h4>' + products[i].nome.charAt(0).toUpperCase() + products[i].nome.slice(1) + '</h4>'
            + '<p>' + products[i].didascalia + '</p>';
        
        if (products[i]["visualizzatore"] != "venditore") {
            text = text
                + '<div class="prodotto-bottom">'
                + '<p class="prezzo">'
                + (products[i].prezzo != null ? '€' + products[i].prezzo : 'Non disponibile')
                + '</p>'
                + (products[i].taglia != null ? ('<p class="taglia">' + products[i].taglia + '</p>') : '')
                + '</div>';
        }

        text = text + '</div></a>';
    }
    
    return text;
}

function refresh() {
    fetch("actions/product/get-suggested.php", {
        method: "POST"
    }).then(res => {
        return res.json();
    }).then(data => {
        element = document.querySelector("body > main > section > section");
        element.innerHTML = TITLE + createProductsHTML(data);
    })
}

refresh();
setInterval(refresh, 5000);