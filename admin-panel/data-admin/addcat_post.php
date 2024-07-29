<?php 
    // Подключение БД
    require("db-admin.php");

    // Подключение сессии
    session_start();

    // Переменные с данными POST
    $name = $_POST["name"];

    // Валидация данных
    if (empty($name)) {
        $_SESSION["cat-alert-add"] = "Заполните поле";
        header("Location: /admin-panel/managment_category.php");
    } else if ($name < 2 || $name > 100) {
        $_SESSION["cat-alert-add"] = "Название должно быть от 2-х до 100 символов";
        header("Location: /admin-panel/managment_category.php");
    } 

    // Добавление в БД
    $sql = "INSERT INTO `category` (`name`) VALUES (:name)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "name" => $name
    ]);

    $_SESSION["cat-alert-add"] = "Категория успешно добавлена";
    header("Location: /admin-panel/managment_category.php");
