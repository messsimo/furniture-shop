<?php 
    // Подключение БД
    require("db-admin.php");

    // Подключение сессии
    session_start();

    // Переменные с $_POST данными
    $name = $_POST["name"];
    $category = $_POST["category"];
    $article = $_POST["article"];
    $width = $_POST["width"];
    $height = $_POST["height"];
    $deep = $_POST["deep"];
    $color = $_POST["color"];
    $places = $_POST["places"];
    $rating = $_POST["rating"];
    $price = $_POST["price"];
    $photo = $_FILES["photo"];
    $description = $_POST["description"];

    // Валидация данных
    if (empty($name) || empty($category) || empty($article) || empty($width) || empty($height) || empty($deep) 
    || empty($color) || empty($places) || empty($rating) || empty($price) || empty($photo) || empty($description)) {
        $_SESSION["additem-alert"] = "Заполинте все поля";
        header("Location: /admin-panel/add_item.php");
    } else if (strlen($name) < 4 || strlen($name) > 200) {
        $_SESSION["additem-alert"] = "Название товара должно быть от 4-х до 200 символов";
        header("Location: /admin-panel/add_item.php");
    } else if ($rating > 5.00 || $rating < 0) {
        $_SESSION["additem-alert"] = "Рейтинг должен быть от 0.00 до 5";
        header("Location: /admin-panel/add_item.php");
    } 


    // Валидация фото товара
    if (!empty($photo) && is_uploaded_file($photo["tmp_name"])) {
        // Массив с разрешеными форматами
        $types = ["image/png" , "image/jpeg" , "image/jpg"];

        if (!in_array($photo["type"], $types)) {
            $_SESSION["additem-alert"] = "Неверный формат изображения";
            header("Location: /admin-panel/add_item.php");
        } else if ($photo["size"] > 3145728) {
            $_SESSION["additem-alert"] = "Фото превышает лимит в 3мб для хранения фото";
            header("Location: /admin-panel/add_item.php");
        }
    }

    // Добавление фото в папку с фото товаров
    if (!empty($photo) && is_uploaded_file($photo["tmp_name"])) {
        // Переменные с конечными названиями фото товаров
        $ext = pathinfo($photo["name"], flags: PATHINFO_EXTENSION);
        $currentPhoto = "itemPhoto_" . time() . ".$ext";

        if (!move_uploaded_file($photo["tmp_name"], "/Users/danielmihai/Documents/code/ecom-furniture/cover-items/$currentPhoto")) {
            $_SESSION["additem-alert"] = "Ошибка при загрузки файла";
            header("Location: /admin-panel/add_item.php");
        }
    }

    // Занесение данных в БД
    $sql = "INSERT INTO `items` (`name`, `description`, `category`, `article`, `width`, `height`, `deep`, `color`, `places`, `photo`, `price`, `rating`) 
    VALUES (:name, :description, :category, :article, :width, :height, :deep, :color, :places, :photo, :price, :rating)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "name" => $name,
        "description" => $description,
        "category" => $category,
        "article" => $article,
        "width" => $width,
        "height" => $height,
        "deep" => $deep,
        "color" => $color,
        "places" => $places,
        "photo" => $currentPhoto ?? null,
        "price" => $price,
        "rating" => $rating
    ]);

    // Успешная сессия
    $_SESSION["additem-success"] = "Товар успешно добавлен";
    header("Location: /admin-panel/add_items.php");