<?php
    // Подключение шапки сайта
    require_once("blocks-admin/header-admin.php");

    // Подключение в БД
    require("data-admin/db-admin.php");

    // Выборка
    $sql = "SELECT * FROM `connection` ORDER BY `id` DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(2);
?>

<!-- Таблица клиентов которые хотят связаться -->
<div class="universal">
    <h1>Обратная связь</h1>

    <div class="container-universal">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Заказчик</th>
                    <th>Почта</th>
                    <th>Телефон</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($users as $el) { ?>
                    <tr>
                        <td><?php echo $el["id"]; ?></td>
                        <td><?php echo $el["name"]; ?></td>
                        <td><?php echo $el["email"]; ?></td>
                        <td><?php echo $el["number"]; ?></td>
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