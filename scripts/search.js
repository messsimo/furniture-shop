// Добавление обработчика событии
searchForm.addEventListener("submit", (event) => {
    // Превращение функции в стандртное поведение
    event.preventDefault();

    // Выборка input-поля
    var inputValue = document.getElementById("searchInput").value;

    // Условие при котором если функция есть, то будет переадрессация на страницу с названием искаемового товара 
    if (inputValue) {
        window.location.href = `item.php?name=${encodeURIComponent(inputValue)}`;
    }
})