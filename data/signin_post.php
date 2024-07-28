<?php
    // Подключение сессий
    session_start();

    // Подключение БД
    require("db.php");

    // Переменные с данными $_POST
    $email = $_POST["email-signin"];
    $password = $_POST["password-signin"];

    // Логин и пароль для админа
    $adminLogin = "admin";
    $adminPassword = "aDmin123";

    // Проверка на админа
    if ($email == $adminLogin && $password == $adminPassword) {
        header("Location: /admin-panel/admin.php");
        exit();
    }

    // Валидация данных
    if (empty($email) || empty($password)) {
        $_SESSION["signin-alert"] = "Заполните все поля";
        header("Location: /reg_sign.php?form=Вход");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["signin-alert"] = "Введите корректную почту! Пример: danil@mail.ru";
        header("Location: /reg_sign.php?form=Вход");
    } else if (strlen($password) > 12 || strlen($password) < 4) {
        $_SESSION["signin-alert"] = "Ваш пароль должен быть от 4-х до 12 символов";
        header("Location: /reg_sign.php?form=Вход");
    }

    // Выборка из БД для проверки наличия пользователя в БД
    $sql = "SELECT `email`, `password` FROM `users` WHERE `email` = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $findUser = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверка на наличие пользователя в БД
    if($findUser != false) {
        $user = $findUser;

        if (password_verify($password, $user["password"]) === false) {
            $_SESSION["signin-alert"] = "Ваш пароль не верный";
            header("Location: /reg_sign.php?form=Вход");
        } else {
            header("Location: /account.php");

            // Cессия с почтой пользователя
            $_SESSION["email-user"] = $email;
        }
    } else {
        $_SESSION["signin-alert"] = "Ваш логин или пароль не совпадает";
        header("Location: /reg_sign.php?form=Вход");
    }