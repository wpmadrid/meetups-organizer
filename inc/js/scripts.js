window.onload = () => {
    document.querySelector(".mo-play-button").addEventListener("click", () => {
        document.querySelector(".mo-hero iframe").src += "&autoplay=1";
        document.querySelector(".mo-hero iframe").classList.remove("mo-hidden");
        document.querySelector(".mo-hero .mo-hero-content").classList.add("mo-display-none");
    }) 
}