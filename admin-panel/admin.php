<?php
    // Подключение шапки сайта
    require_once("blocks-admin/header-admin.php");

    // Подключение в БД
    require("data-admin/db-admin.php");

    // Выборка
    $sql = "SELECT * FROM `items`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $items = $stmt->fetchAll(2);
?>

<!-- Таблица со всеми товароми магазина (без никаких действий) -->
<div class="allItems">
    <h1>Все товары</h1>

    <div class="container-allItems">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Фото</th>
                    <th>Категория</th>
                    <th>Артикул</th>
                    <th>Цена</th>
                    <th>Рейтинг</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($items as $el) { ?>
                    <tr>
                        <td><?php echo $el["id"] ?? ''; ?></td>
                        <td><img src="/cover-items/<?php echo $el["photo"] ?? ''; ?>"></td>
                        <td><?php echo $el["category"] ?? ''; ?></td>
                        <td><?php echo $el["article"] ?? ''; ?></td>
                        <td><?php echo number_format($el["price"]) ?? ''; ?> руб</td>
                        <td><?php echo $el["rating"] ?? ''; ?></td>
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