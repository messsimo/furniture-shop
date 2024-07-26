<?php 
    // Подключение БД
    require("db.php");

    // Подключение сессии
    session_start();

    print_r($_SESSION["cart"]);

    // Переменные из данных $_POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"] ?? 0;

    // Валидация данных
    if (empty($name) || empty($email) || empty($number)) {
        $_SESSION["alert"] = "Заполните все поля";
        header("Location: /checkout.php");
    } else if (strlen($name) < 2 || strlen($name) > 20) {
        $_SESSION["alert"] = "Ваше имя должно быть от 2-х до 20 символов";
        header("Location: /checkout.php");
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $_SESSION["alert"] = "Введите почту корректно. Примерно: vasya@mail.ru";
       header("Location: /checkout.php");
    } else if (strlen($number) > 12) {
        $_SESSION["alert"] = "Номер должен быть до 8 символов";
       header("Location: /checkout.php");
    } else {
        $_SESSION["alert"] = "Ваша заявка успешно отправлена!";
       header("Location: checkout.php");
    }

    // Добавление данных в БД
    $sql = "INSERT INTO `orders` (`name`, `email`, `number`, `product_name`, `product_quantity`, `product_total`) VALUES (:name, :email, :number, :product_name, :product_quantity, :product_total)";
    $stmt = $pdo->prepare($sql);
    
    foreach ($_SESSION["cart"] as $el) {
        $stmt->execute([
            "name" => $name,
            "email" => $email,
            "number" => $number,
            "product_name" => $el["name"],
            "product_quantity" => $el["quantity"],
            "product_total" => $el["total"]
        ]);
    };


    // Очищаем корзину после успешной отправки
    unset($_SESSION["cart"]);

    // Переадрессация на главную старницу
    header("Location: /index.php");