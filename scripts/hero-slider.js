// Массивы с фотографиями и текстом
var images = ["/images/hero1.jpg", "/images/hero2.jpg"];
var texts = ["Скидка 15% на первую покупку", "1000+ аксессуаров для дома"];

// Изначальный индекс слайдера
var currentIndex = 0;

// Переменная с интервалом
var interval = 4000;

// Выборка
var image = document.getElementById("image");
var text = document.getElementById("text");
var dots = document.querySelectorAll(".ball");

// Функция для работы слайдера
function updateContent() {
    currentIndex = (currentIndex + 1) % images.length;

    image.src = images[currentIndex];
    text.textContent = texts[currentIndex];

    // Удаление класса .active у всех точек
    dots.forEach(dot => dot.classList.remove("active"));

    // Добавление класса .active к текущей точке
    dots[currentIndex].classList.add("active");
}

// Установка интервала
// setInterval вызывает updateContent через заданный интервал времени
setInterval(updateContent, interval);
