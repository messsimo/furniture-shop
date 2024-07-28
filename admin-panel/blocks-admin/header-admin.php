<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-admin/header-admin.css">
    <link rel="stylesheet" href="css-admin/admin.css">
    <link rel="stylesheet" href="css-admin/add-item.css">
    <title>AdminPanel</title>
</head>
<body>
    <header>
        <div class="burger">
            <img src="/images/burger.png" id="burger">

            <div class="burger-container">
                <p>Работа с товаром</p>
                <a href="/admin-panel/add_item.php">Добавить товар</a>
                <a href="/admin-panel/edit.php">Редактировать товар</a>

                <p>Работа с категориями</p>
                <a href="/admin-panel/add_category.php">Добавить категорию</a>
                <a href="/admin-panel/edit_category.php">Редактировать категорию</a>

                <p>Работа с магазином</p>
                <a href="/admin-panel/admin.php">Все товары</a>
                <a href="/admin-panel/oreders.php">Заказы</a>
                <a href="/admin-panel/questions.php">Вопросы пользователей</a>
            </div>
        </div>

        <h1>AdminPanel</h1>

        <a href="/index.php" class="logout">Выйти</a>
    </header>