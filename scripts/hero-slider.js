// Массивы с фотографиями и текстом
var imagesSlider = ["/images/hero1.jpg", "/images/hero2.jpg"];
var textsSlider = ["Скидка 15% на первую покупку", "1000+ аксессуаров для дома"];

// Изначальный индекс слайдера
var currentSliderIndex = 0;

// Переменная с интервалом
var sliderInterval = 4000;

// Выборка
var imageSlider = document.getElementById("image");
var textSlider = document.getElementById("text");
var dots = document.querySelectorAll(".ball");

// Функция для работы слайдера
function updateSliderContent() {
    currentSliderIndex = (currentSliderIndex + 1) % imagesSlider.length;

    imageSlider.src = imagesSlider[currentSliderIndex];
    textSlider.textContent = textsSlider[currentSliderIndex];

    // Удаление класса .active у всех точек
    dots.forEach(dot => dot.classList.remove("active"));

    // Добавление класса .active к текущей точке
    dots[currentSliderIndex].classList.add("active");
}

// Установка интервала
setInterval(updateSliderContent, sliderInterval);
