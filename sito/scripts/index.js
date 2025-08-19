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

refresh();
setInterval(refresh, 2000);