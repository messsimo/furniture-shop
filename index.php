<?php
    // Запуск сессии
    session_start();

    // Подключение БД
    require("data/db.php");

    // Выборка элементов из БД для секции Спец.предложения
    $sql = "SELECT * FROM `items` WHERE `id` IN (15, 16, 17, 18)";
    $stmt = $pdo->query($sql);
    $specailItems = $stmt->fetchAll(2);

    // Выборка элементов из БД для секции с Выскоим Рейтингом
    $sql = 'SELECT * FROM items WHERE `category` = "Диваны" ORDER BY rating DESC LIMIT 8';
    $stmt = $pdo->query($sql);
    $highRating = $stmt->fetchAll(2);
?>

<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");
?>

<!-- Секция Hero -->
<div class="hero">
    <div class="block">
        <img src="images/hero1.jpg" id="image" alt="Фото">

        <div class="text">
            <p id="text" class="hero-text">Скидка 15% на первую покупку</p>
            <button><a href="">Получить!</a></button>
        </div>

        <div class="balls">
            <div class="ball"></div>
            <div class="ball"></div>
        </div>
    </div>
</div>

<!-- Секция с Специальными Предложениями -->
<div class="special-items">
    <h1>Специальные предложения</h1>

    <div class="container">
        <?php foreach ($specailItems as $el) { ?>
        <div class="block">
            <div class="rating">
                <img src="images/star.png">
                <p><?php echo $el["rating"]; ?></p>
            </div>
            <img src="cover-items/<?php echo $el["photo"]; ?>" class="photo-item">
            <div class="name"><?php echo $el["name"]; ?></div>
            <span><?php echo $el["price"]; ?>руб</span><br>

            <a href="/item.php?id=<?php echo $el["id"]; ?>?name=<?php echo $el["name"]; ?>"><button>Купить</button></a>
        </div>
        <?php } ?>
    </div>
</div>

<!-- Секция товаров с Высоким Рейтингом -->
<div class="high-rating">
    <h1>Высокий рейтинг</h1>

    <div class="container">
        <?php foreach ($highRating as $el) { ?>
            <div class="block">
                <div class="rating">
                    <img src="images/star.png">
                    <p><?php echo $el["rating"]; ?></p>
                </div>
                <img src="cover-items/<?php echo $el["photo"]; ?>" class="photo-item">
                <div class="name"><?php echo $el["name"]; ?></div>
                <span><?php echo $el["price"]; ?> руб</span><br>

                <a href="/item.php?id=<?php echo $el["id"]; ?>?name=<?php echo $el["name"]; ?>"><button>Купить</button></a>
        </div>
        <?php } ?>
    </div>

    <a href="/catalog.php"><button class="btn">Смотреть больше товаров</button></a>
</div>

<!-- Промежуточная секция -->
<div class="template">
    <div class="container">
        <h1>Оксфорд 1950</h1>
        <h2>Новая коллекция изысканных кресел</h2>
        <a href=""><button>Ознакомиться</button></a>
    </div>
</div>

<!-- Секция с категориями -->
<div class="category">
    <h1>Топ категории</h1>

    <div class="container">
        <div class="block-1">
            <div class="cat">
                <span>Прямые</span>
                <span>Угловые</span>
                <span>Модульные</span>
            </div>

            <h3>Диваны</h3>

            <img src="images/sofa-cat.png" alt="Диван">

            <div class="nav">
                <a href="/catalog.php">
                    <span>В каталог</span>
                    <img src="images/btn-right.png">
                </a>
            </div>
        </div>

        <div class="block-2">
            <div class="cat">
                <span>Мягкие</span>
                <span>Кресла-кровати</span>
            </div>

            <h3>Кресла</h3>

            <img src="images/chair-cat.png" alt="Кресла">

            <div class="nav">
                <a href="/catalog.php">
                    <span>В каталог</span>
                    <img src="images/btn-right.png">
                </a>
            </div>
        </div>

        <div class="block-3">
            <div class="cat">
                <span>Односпальные</span>
                <span>Двуспальные</span>
            </div>

            <h3>Кровати</h3>

            <img src="images/bad-cat.png" alt="Кровать">

            <div class="nav">
                <a href="/catalog.php">
                    <span>В каталог</span>
                    <img src="images/btn-right.png">
                </a>
            </div>
        </div>

        <div class="block-4">
            <div class="cat">
                <span>Тумбы</span>
                <span>Комоды</span>
            </div>

            <h3>Тумбы и комоды</h3>

            <img src="images/tumb-cat.png" alt="Тумбы и комоды">

            <div class="nav">
                <a href="/catalog.php">
                    <span>В каталог</span>
                    <img src="images/btn-right.png">
                </a>
            </div>
        </div>

        <div class="block-5">
            <div class="cat">
                <span>Деревянные</span>
                <span>Металлокаркас</span>
            </div>

            <h3>Стулья</h3>

            <img src="images/chair2-cat.png" alt="Стулья">

            <div class="nav">
                <a href="/catalog.php">
                    <span>В каталог</span>
                    <img src="images/btn-right.png">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Секция с Полезной Информацией -->
<div class="usefull">
    <div class="buttons">
        <img src="images/btn-left.png" id="btn-left">
        <img src="images/btn-right.png" id="btn-right">
    </div>

    <h1>Полезное</h1>

    <div class="container">
            <div class="block-1">
                <img src="images/usefull1.png" id="img-1" class="block-img">
                <p id="text-1" class="block-text">И нет сомнений, что сделанные на базе интернет-аналитики выводы представляют собой не что иное?</p>
                <a href=""><button>Читать</button></a>
            </div>

            <div class="block-2">
                <img src="images/usefull2.png" id="img-2" class="block-img">
                <p id="text-2" class="block-text">Как принято считать, некоторые особенности приносят несомненную пользу обществу?</p>
                <a href=""><button>Читать</button></a>
            </div>
    </div>
</div>

<!-- Cекция с Связью с клиентов -->
<div class="connection">
    <div class="img">
        <img src="images/deco.png" alt="SidDownPls">
    </div>

    <div class="processing">
        <h1>Мы всегда вам рады!</h1>
        <p>Безусловно, новая модель организационной деятельности в значительной степени обуславливает важность распределения внутренних резервов и ресурсов.</p>

        <form action="data/connection.php" method="POST">
            <input type="text" placeholder="Как вас зовут?" name="name"><br>
            <input type="text" placeholder="Ваш телефон" name="phone"><br>
            <input type="text" placeholder="Ваш e-mail" name="email" class="last"><br>

            <span class="alert"><?= $_SESSION["alert"] ?? ''?></span><br>

            <button type="submit">Отправить</button><br>

            <input type="checkbox" id="checkbox" class="check">
            <label for="checkbox">Принимаю <u>пользовательское соглашение</u></label>
        </form>
    </div>
</div>

<?php
    // Подключение футера сайта
    require_once("blocks/footer.php");
?>
    
