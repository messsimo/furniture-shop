<?php 
    // Запуск сесии
    session_start();

    // Подключение БД
    require("db.php");

    // Переменные с данными $_POST
    $name = $_POST["name"];
    $phone  = $_POST["phone"];
    $email = $_POST["email"];

    // Валидация данных
    if (empty($name)) {
        $_SESSION["alert"] = "*Введиете ваше имя.";
        header("Location: /index.php");
        exit;
    } else if (strlen($name) > 16 || strlen($name) < 4) {
        $_SESSION["alert"] = "*Ваше имя должны быть от 3-х до 16 символов.";
        header("Location: /index.php");
        exit;
    } 
    
    if (empty($phone)) {
        $_SESSION["alert"] = "*Введиете ваш номер телефона.";
        header("Location: /index.php");
        exit;
    } 
    
    if (empty($email)) {
        $_SESSION["alert"] = "*Введиете вашу почту";
        header("Location: /index.php");
        exit;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["alert"] = "*Введите корректную почту. Пример: jhon@mail.ru";
         header("Location: /index.php");
         exit;
     } 
    
    // Вывод успешной отправки заявки
    $_SESSION["alert"] = "Спасибо за вашу заявку! Скоро мы с вами свяжимся.";
    header("Location: /index.php");        


    // Добавление в БД
    $sql = "INSERT INTO `connection` (`name`, `number`, `email`) VALUES (:name, :number, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "name" => $name,
        "number" => $phone,
        "email" => $email
    ]);