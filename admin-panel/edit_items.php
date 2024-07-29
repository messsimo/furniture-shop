<?php
    // Подключение шапки сайта
    require_once("blocks-admin/header-admin.php");

    // Подключение в БД
    require("data-admin/db-admin.php");

    // Запуск сессии
    session_start();

    // Выборка
    $sql = "SELECT * FROM `items`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $items = $stmt->fetchAll(2);

    $sql = "SELECT * FROM `category`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $categorys = $stmt->fetchAll(2);

    // Переменная с GET запросом с действием по товару
    $action = $_POST["action"] ?? null;

    // Переменные с POST данными
    $id = $_POST["id"] ?? null;
    $name = $_POST["name"] ?? null;
    $category = $_POST["category"] ?? null;
    $article = $_POST["article"] ?? null;
    $width = $_POST["width"] ?? null;
    $height = $_POST["height"] ?? null;
    $deep = $_POST["deep"] ?? null;
    $color = $_POST["color"] ?? null;
    $places = $_POST["places"] ?? null;
    $rating = $_POST["rating"] ?? null;
    $price = $_POST["price"] ?? null;
    $photo = $_FILES["photo"]["name"] ?? null;
    $description = $_POST["description"] ?? null;

    // Удаление товара
    if ($action == "remove" && isset($id)) {
        $sql = "DELETE FROM `items` WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["id" => $id]);
        $_SESSION["alert-edit"] = "Товар #$id был удален! Перезагрузите страницу";
    }

    // Обновление данных о товаре
    if ($action == "edit" && isset($id)) {
        $sql = "UPDATE `items` SET 
                `name` = :name, 
                `category` = :category, 
                `article` = :article, 
                `width` = :width, 
                `height` = :height, 
                `deep` = :deep, 
                `color` = :color, 
                `places` = :places, 
                `rating` = :rating, 
                `price` = :price, 
                `description` = :description 
                WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "category" => $category,
            "article" => $article,
            "width" => $width,
            "height" => $height,
            "deep" => $deep,
            "color" => $color,
            "places" => $places,
            "price" => $price,
            "rating" => $rating
        ]);

        $_SESSION["alert-edit"] = "Товар #$id был обновлён! Перезагрузите страницу";
    };

    // Обновление фото если оно изменено
    if ($action == "edit" && isset($id) && isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        // Массив с разрешеными форматами
        $types = ["image/png", "image/jpeg", "image/jpg"];

        // Валидация фото
        if (!in_array($_FILES["photo"]["type"], $types)) {
            $_SESSION["additem-alert"] = "Неверный формат изображения";
        } else if ($_FILES["photo"]["size"] > 3145728) {
            $_SESSION["additem-alert"] = "Фото превышает лимит в 3мб для хранения фото";
        } else {
            // Добавление фото в папку
            $ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            $currentPhoto = "itemPhoto_" . time() . ".$ext";

            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], "/Users/danielmihai/Documents/code/ecom-furniture/cover-items/$currentPhoto")) {
                $_SESSION["additem-alert"] = "Ошибка при загрузке файла";
            } else {
                $sql = "UPDATE `items` SET `photo` = :photo WHERE `id` = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    "id" => $id,
                    "photo" => $currentPhoto
                ]);

                $_SESSION["alert-edit"] = "Товар #$id был обновлён! Перезагрузите страницу";
            }
        }
    }
?>

<!-- Секция с Товарами для редактирования/Удаления -->
<div class="editItems">
    <h1>Редактирование/Удаление товаров</h1>
    <p><?= $_SESSION["alert-edit"] ?? '' ?></p>

    <div class="container-editItems">
        <?php foreach ($items as $el) { ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="img">
                    <img src="/cover-items/<?php echo $el["photo"]; ?>">
                </div>

                <input type="hidden" name="id" value="<?php echo $el["id"]; ?>"><br>

                <label for="name">Название товара</label><br>
                <input type="text" name="name" id="name" value="<?php echo $el["name"]; ?>"><br>

                <label for="category">Категория товара</label><br>
                <select name="category" id="category">
                    <?php foreach ($categorys as $i) { ?>
                        <option value="<?php echo $i["name"]; ?>" <?php echo ($el["category"] == $i["name"]) ? 'selected' : ''; ?>>
                            <?php echo $i["name"]; ?>
                        </option>
                    <?php } ?>
                </select><br>

                <label for="article">Артикул товара</label><br>
                <input type="text" name="article" id="article" value="<?php echo $el["article"]; ?>"><br>

                <label for="width">Ширина товара</label><br>
                <input type="text" name="width" id="width" value="<?php echo $el["width"]; ?>"><br>

                <label for="height">Высота товара</label><br>
                <input type="text" name="height" id="height" value="<?php echo $el["height"]; ?>"><br>

                <label for="deep">Глубина товара</label><br>
                <input type="text" name="deep" id="deep" value="<?php echo $el["deep"]; ?>"><br>

                <label for="color">Цвет товара</label><br>
                <input type="text" name="color" id="color" value="<?php echo $el["color"]; ?>"><br>

                <label for="places">Мест товара</label><br>
                <input type="text" name="places" id="places" value="<?php echo $el["places"]; ?>"><br>

                <label for="rating">Рейтинг товара</label><br>
                <input type="text" name="rating" id="rating" value="<?php echo $el["rating"]; ?>"><br>

                <label for="price">Цена товара</label><br>
                <input type="text" name="price" id="price" value="<?php echo $el["price"]; ?>"><br>

                <label for="photo">Фото товара</label><br>
                <input class="input-file" type="file" name="photo" id="photo" value="<?php echo $el["photo"]; ?>"><br>

                <label for="description">Описание товара</label><br>
                <textarea name="description" id="description"><?php echo $el["description"]; ?></textarea><br>

                <span class="alert"><?= $_SESSION["edititem-alert"] ?? '' ?></span><br>

                <button type="submit" name="action" value="edit">Обновить</button>
                <button type="submit" name="action" value="remove" class="btn-remove">Удалить</button>
            </form>
        <?php } ?>
    </div>
</div>

<!-- Подключение cкрипта переадрессации -->
<script src="/scripts/burgers-admin.js"></script>
</body>
</html>