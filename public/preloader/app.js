function showLoader() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("preloader").style.display = "flex";
}

function hideLoader() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("preloader").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
    // Hide the preloader when the content is loaded
    document.body.classList.add("loaded");
});
