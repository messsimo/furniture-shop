<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");
?>

<!-- Cекция с навигацией -->
<div class="nav-cart">
    <h1>Корзина товаров</h1>
</div>

<!-- Секция с Отображением Товара -->
<div class="cart-items">
    <div class="container-totalItems">
        <table>
        <thead>
            <tr>
                <th>Фото</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Общая цена</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="cover-items/sofa1.png"></td>
                <td>Кресло велюровое “X-24”</td>
                <td>59 990 руб</td>
                <td>1</td>
                <td>59 990 руб</td>
            </tr>
            <tr>
                <td><img src="cover-items/sofa1.png"></td>
                <td>Кресло велюровое “X-24”</td>
                <td>59 990 руб</td>
                <td>1</td>
                <td>59 990 руб</td>
            </tr>
        </tbody>
    </table>
    </div>

    <div class="container-shopping">
        <div class="shop">
            <p>Итог:</p>

            <span>Всего товаров: 2 шт</span><br>
            <span>Общая сумма: 100 000 руб</span><br>

            <a href=""><button>Оформить заказ</button></a>
        </div>
    </div>
</div>

<?php
    // Подключение футера сайта
    require_once("blocks/footer.php");
?>