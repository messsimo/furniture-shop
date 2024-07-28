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


?>

<!-- Секция для Добавления товара -->
<div class="addItem">
    <form action="data-admin/additem_post.php" method="post" enctype="multipart/form-data">
        <h1>Добавить товар</h1>

        <label for="name">Название товара</label><br>
        <input type="text" name="name" id="name"><br>

        <label for="category">Категория товара</label><br>
        <select name="category" id="category">
            <?php foreach ($categorys as $el) { ?>
                <option value="<?php echo $el["name"]; ?>"><?php echo $el["name"] ?? ''; ?></option>
            <?php } ?>
        </select><br>

        <label for="article">Артикул товара</label><br>
        <input type="text" name="article" id="article"><br>

        <label for="width">Ширина товара</label><br>
        <input type="text" name="width" id="width"><br>

        <label for="height">Высота товара</label><br>
        <input type="text" name="height" id="height"><br>

        <label for="deep">Глубина товара</label><br>
        <input type="text" name="deep" id="deep"><br>

        <label for="color">Цвет товара</label><br>
        <input type="text" name="color" id="color"><br>

        <label for="places">Мест товара</label><br>
        <input type="text" name="places" id="places"><br>

        <label for="rating">Рейтинг товара</label><br>
        <input type="text" name="rating" id="rating"><br>

        <label for="price">Цена товара</label><br>
        <input type="text" name="price" id="price"><br>

        <label for="photo">Фото товара</label><br>
        <input class="input-file" type="file" name="photo" id="photo"><br>

        <label for="description">Описание товара</label><br>
        <textarea name="description" id="description"></textarea><br>

        <span class="alert"><?= $_SESSION["additem-alert"] ?? '' ?></span><br>

        <button type="submit">Добавить</button>
    </form>

    <div class="rules-additems">
        <p>Правила заполнения формы</p>

        <div class="container-ruler">
            <span>*Все поля должны быть заполнены</span><br>
            <span>*Фото товара должен быть формата (png, jpg, jpeg)</span><br>
            <span>*Укажите единицу измерения для ширины, высоты и глубины</span><br>
            <span>*Не нужно указывать валюту для цены</span><br>
            <span>*Описание товара должно быть до 500 символов</span><br>
            <span>*После добавления товара, его можно увидеть во вкладке "Все товары"</span><br>
        </div>
    </div>
</div>

<!-- Подключение cкрипта переадрессации -->
<script src="/scripts/burgers-admin.js"></script>
</body>
</html>