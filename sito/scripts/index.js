function refresh() {
    fetch("actions/notifications/check.php", {
        method: "POST"
    }).then(res => {
        return res.json();
    }).then(data => {
        element = document.querySelector("body > header > nav > ul > li > a > img[alt=Notifiche]");
        if (data.hasNotifications == true) {
            element.src = data.baseImageFolder + "bell-fill.svg";
        } else {
            element.src = data.baseImageFolder + "bell.svg";
        }
    });
}

const mobileMenuButton = document.querySelector("body > header > nav > button");
mobileMenuButton.addEventListener("click", function() {
    const dropdownMenu = document.querySelector("body > header > nav:first-of-type > ul");
    if (dropdownMenu.style.visibility == "hidden") {
        dropdownMenu.style.visibility = "visible";
    } else {
        dropdownMenu.style.visibility = "hidden";
    }
});

refresh();
setInterval(refresh, 2000);