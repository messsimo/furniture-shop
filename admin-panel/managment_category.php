<?php 
    // Подключение шапки сайта
    require_once("blocks-admin/header-admin.php");

    // Подключение в БД
    require("data-admin/db-admin.php");

    // Подключение сессии
    session_start();

    // Выборка всех категорий из БД
    $sql = "SELECT * FROM `category`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $categorys = $stmt->fetchAll(2);

    // Переменные с POST данным
    $id = $_POST["id-edit"] ?? null;
    $name = $_POST["name-edit"] ?? null;
    $action = $_POST["action"] ?? null;

    // Удаление категории из БД
    if ($action == "remove" && isset($name)) {
        $sql = "DELETE FROM category WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["id" => $id]);

        $_SESSION["alert-cat-edit"] = "Категоря #$id была удалена! Перезагрузите страницу";
    }

    // Редактирование категории
    if ($action == "edit" && isset($name)) {
        $sql = "UPDATE `category` SET `name` = :name WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "name" => $name
        ]);

        $_SESSION["alert-cat-edit"] = "Категоря #$id была изменена! Перезагрузите страницу";
    }
?>

<!-- Секция со всеми заказами -->
<div class="category">
    <div class="add-cat">
        <h1>Добавление категории</h1>

        <form action="data-admin/addcat_post.php" method="post">
            <label for="name">Название категории</label><br>
            <input type="text" name="name" id="name"><br>

            <span class="cat-alert"><?php echo $_SESSION["cat-alert-add"] ?? ''; ?></span><br>

            <button>Добавить</button>
        </form>
    </div>

    <div class="edit-cat">
        <h1>Редактирование/Удаление категорий</h1>
        <span><?= $_SESSION["alert-cat-edit"] ?? '' ?></span>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($categorys as $el) { ?>
                    <form action="" method="POST">
                        <tr>
                            <input type="hidden" name="id-edit" value="<?php echo $el["id"]; ?>">
                            <td><?php echo $el["id"]; ?></td>
                            <td><input type="text" value="<?php echo $el["name"]; ?>" name="name-edit"></td>
                            <td><button type="submit" name="action" value="edit">Редактировать</button></td>
                            <td><button type="submit" class="btn-remove-cat" name="action" value="remove">Удалить</button></td>
                        </tr>
                    </form>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Подключение cкрипта переадрессации -->
<script src="/scripts/burgers-admin.js"></script>
</body>
</html>