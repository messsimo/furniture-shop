<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");

    // Подключение БД
    require("data/db.php");

    // Пременная с id из url($_GET)
    $id = $_GET["id"];

    // Выборка из БД
    $sql = "SELECT * FROM `items` WHERE `id` = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $item = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Преоброзование массива
    if (count($item) > 0) {
        $item = $item[0];
    }
?>

<!-- Секция с навигацией -->
<div class="navigation">
    <span>Главная / Каталог / <?php echo $item["category"]; ?> / <?php echo $item["name"]; ?></span>
</div>

<!-- Секция с Информацией о Товаре -->
<div class="item-info">
    <div class="item-info-top">
        <div class="info">
            <div class="rating">
                <img src="images/star.png">
                <p><?php echo $item["rating"]; ?></p>
            </div>

            <h3><?php echo $item["name"]; ?></h3>
            <h1><?php echo $item["price"]; ?> руб</h1>

            <button>Купить в один клик</button><br>  

            <a href="">+ Добавить в корзину</a>

        </div>

        <div class="item-photo">
            <img src="cover-items/<?php echo $item["photo"]; ?>" alt="Товар">
        </div>
    </div>


    
</div>



<?php
    // подключение футера сайта
    require_once("blocks/footer.php");
?>