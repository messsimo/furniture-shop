// Выборка элементов
var btnRight = document.getElementById("btn-right");
var btnLeft = document.getElementById("btn-left");
var imageBlocks = document.querySelectorAll(".block-img");
var textBlocks = document.querySelectorAll(".block-text");

// Массивы с изображениями и текстом
var imageSources = ["images/usefull1.png", "images/usefull2.png", "images/usefull3.png", "images/usefull4.png", "images/usefull5.png"];
var textContents = [
    "И нет сомнений, что сделанные на базе интернет-аналитики выводы представляют собой не что иное?", 
    "Как принято считать, некоторые особенности приносят несомненную пользу обществу?",
    "Ясность нашей позиции очевидна: укрепление и развитие внутренней структуры?",
    "Прежде всего, консультация с широким активом однозначно фиксирует необходимость распределения?",
    "Как принято считать, некоторые особенности приносят несомненную пользу обществу?"
];

// Изначальный индекс
var currentIndex = 0;

// Обработчики событий для кнопок
btnRight.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % imageSources.length;
    updateManualSliderContent();
});

btnLeft.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + imageSources.length) % imageSources.length;
    updateManualSliderContent();
});

// Функция смены контента
function updateManualSliderContent() {
    imageBlocks.forEach((img, index) => {
        img.src = imageSources[(currentIndex + index) % imageSources.length];
    });

    textBlocks.forEach((txt, index) => {
        txt.textContent = textContents[(currentIndex + index) % textContents.length];
    });
}
