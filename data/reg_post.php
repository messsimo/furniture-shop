<?php
    // Подключение сессий
    session_start();

    // Подключение БД
    require("db.php");

    // Переменные с данными $_POST
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rePassword = $_POST["rePassword"];

    // Валидация данных
    if (empty($username) || empty($email) || empty($password) || empty($rePassword)) {
        $_SESSION["reg-alert"] = "Заполните все поля";
        //header("Location: /reg_sign.php?form=Регистрация");
    } else if (strlen($username) > 16 || strlen($username) < 4) {
        $_SESSION["reg-alert"] = "Ваше имя должно быть от 4-х до 16 символов";
       // header("Location: /reg_sign.php?form=Регистрация");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["reg-alert"] = "Ввведите корректную почту! Пример: danil@mail.ru";
        //header("Location: /reg_sign.php?form=Регистрация");
    } else if (strlen($password) > 12 || strlen($password) < 4) {
        $_SESSION["reg-alert"] = "Ваш пароль должен быть от 4-х до 12 символов";
       // header("Location: /reg_sign.php?form=Регистрация");
    } else if ($rePassword != $password) {
        $_SESSION["reg-alert"] = "Ваши пароли не совпадают";
       // header("Location: /reg_sign.php?form=Регистрация");
    } 

    // Выборка из БД
    $sql = "SELECT `username` FROM `users` WHERE `username` = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $findName = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT `email` FROM `users` WHERE `email` = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $findEmail = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверка на наличие данных в БД
    if ($findName) {
        $_SESSION["reg-alert"] = "Данное имя уже занято";
        header("Location: /reg_sign.php?form=Регистрация");
    } else if ($findEmail) {
        $_SESSION["reg-alert"] = "Данная почта уже занята";
        header("Location: /reg_sign.php?form=Регистрация");
    } else {
        // Хэширование пароля
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Добавление записей в БД
        $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "username" => $username,
            "email" => $email,
            "password" => $passwordHash
        ]);

        // Переадрессация на страницу пользователя
        header("Location: /account.php");
    }