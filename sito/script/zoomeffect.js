function imageZoom(imgID, resultID) {
    let img, lens, result, cx, cy;
    let isCalculated = false;

    img = document.getElementById(imgID);
    result = document.getElementById(resultID);

    if (!img || !result) {
        return;
    }

    const existingLens = document.querySelector(".img-zoom-lens");
    if (existingLens) {
        existingLens.remove();
    }

    const container = img.parentElement;
    lens = document.createElement("DIV");
    lens.setAttribute("class", "img-zoom-lens");
    container.insertBefore(lens, img);

    container.removeEventListener("mousemove", moveLens);
    container.removeEventListener("mouseenter", showZoom);
    container.removeEventListener("mouseleave", hideZoom);

    function showZoom() {
        lens.style.display = "block";
        result.style.display = "block";
        if (!isCalculated) {
            cx = result.offsetWidth / lens.offsetWidth;
            cy = result.offsetHeight / lens.offsetHeight;

            result.style.backgroundImage = "url('" + img.src + "')";
            result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";

            isCalculated = true;
        }
    }

    function hideZoom() {
        lens.style.display = "none";
        result.style.display = "none";
    }

    function moveLens(e) {
        if (!isCalculated) return;

        let pos, x, y;
        e.preventDefault();
        pos = getCursorPos(e);
        x = pos.x - (lens.offsetWidth / 2);
        y = pos.y - (lens.offsetHeight / 2);

        if (x > img.width - lens.offsetWidth) { x = img.width - lens.offsetWidth; }
        if (x < 0) { x = 0; }
        if (y > img.height - lens.offsetHeight) { y = img.height - lens.offsetHeight; }
        if (y < 0) { y = 0; }

        lens.style.left = x + "px";
        lens.style.top = y + "px";
        result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
    }

    function getCursorPos(e) {
        let a, x = 0, y = 0;
        e = e || window.event;
        a = img.getBoundingClientRect();
        x = e.clientX - a.left;
        y = e.clientY - a.top;
        return { x: x, y: y };
    }

    container.addEventListener("mousemove", moveLens);
    container.addEventListener("mouseenter", showZoom);
    container.addEventListener("mouseleave", hideZoom);
}