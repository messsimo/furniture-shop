<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");

    // Запуск сессии
    session_start();
?>

<!-- Cекция с выводом товаров и отправки заявки на покупку -->
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
                <?php foreach ($_SESSION["cart"] as $el) { ?>
                    <tr>
                        <td><img src="cover-items/<?= $el['photo'] ?? '' ?>" alt="<?= $el['name'] ?? '' ?>"></td>
                        <td><?= htmlspecialchars($el['name'] ?? '') ?></td>
                        <td><?= number_format($el['price'] ?? '') ?></td>
                        <td><?= $el['quantity'] ?? '' ?></td>
                        <td><?= number_format($el["total"] ?? '') ?></td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
    </div>

    <div class="container-checkout">
       <div class="price">
            <span>Общая сумма: <?= number_format(array_sum(array_column($_SESSION["cart"], 'total'))) ?> рублей</span>
        </div>

        <h1>Форма регистрации заказа</h1>
       <form action="data/checkout_post.php" method="post">
            <label for="name">Ваше имя</label><br>
            <input type="text" name="name" id="name"><br>
            <label for="email">Ваша почта</label><br>
            <input type="text" name="email" id="email"><br>
            <label for="number">Ваш номер телефона</label><br>
            <input type="text" name="number" id="number"><br>

            <span class="alert"><?= $_SESSION["alert"] ?? '' ?></span><br>

            <button>Отправить</button>
       </form>
    </div>
</div>

<?php
    // Подключение футера сайта
    require_once("blocks/footer.php");
?>