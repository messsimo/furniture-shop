// Выборка
var img = document.getElementById("burger");
var burgerBlock = document.querySelector(".burger-container");

// Обработчик событий
img.addEventListener("click", () => {
    if (burgerBlock.style.display === "block") {
        burgerBlock.style.display = "none";
    } else {
        burgerBlock.style.display = "block";
    }

    if (burgerBlock.classList.contains("show")) {
        burgerBlock.classList.remove("show");
    } else {
        burgerBlock.classList.add("show");
    }
});
