<?php
    // Подключение шапки сайта
    require_once("blocks-admin/header-admin.php");

    // Подключение в БД
    require("data-admin/db-admin.php");

    // Выборка
    $sql = "SELECT * FROM `orders`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $oreders = $stmt->fetchAll(2);
?>

<!-- Таблица со всеми товароми магазина (без никаких действий) -->
<div class="orders">
    <h1>Заказы</h1>

    <div class="container-orders">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Заказчик</th>
                    <th>Почта</th>
                    <th>Телефон</th>
                    <th>Товар</th>
                    <th>Кол-во</th>
                    <th>Сумма</th>
                    <th>Вермя заказа</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($oreders as $el) { ?>
                    <tr>
                        <td><?php echo $el["id"]; ?></td>
                        <td><?php echo $el["name"]; ?></td>
                        <td><?php echo $el["email"]; ?></td>
                        <td><?php echo $el["number"]; ?></td>
                        <td><?php echo $el["product_name"]; ?></td>
                        <td><?php echo $el["product_quantity"]; ?> шт</td>
                        <td><?php echo number_format($el["product_total"]); ?> руб</td>
                        <td><?php echo $el["timestamp"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Подключение cкрипта переадрессации -->
<script src="/scripts/burgers-admin.js"></script>
</body>
</html>