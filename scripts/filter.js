// Добавляем обработчик событий к документу
document.addEventListener("DOMContentLoaded", () => {
    // Выборка input-поля с чекбоксом
    var checkboxes = document.querySelectorAll(".checkbox");

    // Переборка всех элементов массива и вызов функции для них
    checkboxes.forEach(function (checkbox) {
        // Обработчик события с сменой для чекбокса
        checkbox.addEventListener('change', function () {
            // Условие при которое пользователя будет перебрастывать на url, где checkbox=true
            if (this.checked) {
                window.location.href = this.dataset.url;
            }
        });
    });
});