<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");

    // Подключение БД
    require("data/db.php");

    // Пременная с id, name из url($_GET)
    $id = $_GET["id"] ?? '';
    $name = $_GET["name"] ?? '';

    // Выборка из БД по id
    $sql = "SELECT * FROM `items` WHERE (`id` = :id OR `name` = :name)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id, 
        ':name' => $name
    ]);
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

    <div class="item-info-bottom">
        <div class="desc-table">
            <table>
                <tbody>
                    <tr>
                        <th>Категория</th>
                        <td><?php echo $item["category"]; ?></td>
                    </tr>
                    <tr>
                        <th>Артикул</th>
                        <td><?php echo $item["article"]; ?></td>
                    </tr>
                    <tr>
                        <th>Цвет</th>
                        <td><?php echo $item["color"]; ?></td>
                    </tr>
                    <tr>
                        <th>Ширина</th>
                        <td><?php echo $item["width"]; ?></td>
                    </tr>
                    <tr>
                        <th>Высота</th>
                        <td><?php echo $item["height"]; ?></td>
                    </tr>
                    <tr>
                        <th>Глбина</th>
                        <td><?php echo $item["deep"]; ?></td>
                    </tr>
                    <tr>
                        <th>Мест</th>
                        <td><?php echo $item["places"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="description">
            <h1>Описание</h1>

            <span><?php echo $item["description"]; ?></span>

            <img src="images/img-desc.png">
        </div>
    </div>
    
</div>



<?php
    // подключение футера сайта
    require_once("blocks/footer.php");
?>