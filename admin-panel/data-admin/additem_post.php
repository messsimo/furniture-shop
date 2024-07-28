<?php 
    // Подключение БД
    require("db-admin.php");

    // Подключение сессии
    session_start();

    // Переменные с $_POST данными
    $name = $_POST["name"];
    $category = $_POST["category"];
    $artcile = $_POST["artcile"];
    $width = $_POST["width"];
    $height = $_POST["height"];
    $deep = $_POST["deep"];
    $color = $_POST["color"];
    $places = $_POST["places"];
    $rating = $_POST["rating"];
    $price = $_POST["price"];
    $photo = $_POST["photo"];
    $description = $_POST["description"];