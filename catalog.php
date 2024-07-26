<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");

    // Подключение БД
    require("data/db.php");

    // Выборка из БД
    $sql = "SELECT * FROM `items`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM `category`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Общее кол-во записей в БД
    $totalItems = count($items);
    // Кол-во записей на страницу
    $itemsPerPage = 9;
    // Кол-во страниц для записей
    $totalPages = ceil($totalItems / $itemsPerPage);
    // Определниен номера текущей старницы
    if (empty($_GET["page"])) {
        $currentPage = 1;
    } else {
        $currentPage = intval($_GET["page"]);
    }
    // С какой записи начинаеться вывод 
    $offset = ($currentPage - 1) * $itemsPerPage; 

    // Выборк из БД для вывода записей 
    $sql = "SELECT * FROM `items` LIMIT ?, ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(2, (int)$itemsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Переменная с значениями GET
    $categoryGet = $_GET["category"] ?? '';
    $colorGet = $_GET["color"] ?? '';
    $page = $_GET["page"] ?? 1;

    // Базовый url для пагинации с фильтрами
    $baseurl = '/catalog.php?' . http_build_query([
    'category' => $categoryGet,
    'color' => $colorGet,
    ]);

    if($categoryGet) {
        $sql = "SELECT * FROM `items` WHERE `category` = :category LIMIT :offset, :itemsPerPage";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':category', $categoryGet, PDO::PARAM_STR);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':itemsPerPage', (int)$itemsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else if ($colorGet) {
        $sql = "SELECT * FROM `items` WHERE `color` = :color LIMIT :offset, :itemsPerPage";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':color', $colorGet, PDO::PARAM_STR);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->bindValue(':itemsPerPage', (int)$itemsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<!-- Cекция с Навигацией -->
<div class="nav-catalog">
    <span>Главная / Каталог</span>
</div>

<!-- Cекция с Фильтрами -->
<div class="filters">
    <div class="conteiner-filters">
        <h1>Фильтровать по:</h1>
        <div class="block">
            <p>Категория</p>
            <form action="" method="GET">
                <?php foreach ($category as $el) { ?>
                    <input type="checkbox" id="input-category-<?php echo $el["id"]; ?>" class="checkbox" data-url="/catalog.php?category=<?php echo $el["name"]; ?>">
                    <label for="input-category-<?php echo $el["id"]; ?>"><?php echo $el["name"]; ?></label><br>
                <?php } ?>
            </form>
        </div>

        <div class="block">
            <p>Цвет</p>
            <form action="" method="GET">
               <?php foreach ($items as $el) { ?>
                    <input type="checkbox" id="input-color-<?php echo $el["id"]; ?>" class="checkbox" data-url="/catalog.php?color=<?php echo $el["color"]; ?>">
                    <label for="input-color"><?php echo $el["color"]; ?></label><br>
                <?php } ?>
            </form>
        </div>

        <div class="oxford">
            <img src="images/card-oxford.jpg">
            <div class="text-card">
                <p>Оксфорд 1950 </p>
                <span>Новая коллекция изысканных кресел</span>
            </div>

            <div class="nav-сard">
                <a href="/catalog.php">
                    <span>В каталог</span>
                    <img src="images/btn-right.png">
                </a>
            </div>
        </div>
    </div> 
    
    <div class="container-products-main">
    <div class="container-products">
        <?php foreach ($items as $el) { ?>
            <div class="block">
                <div class="rating-catalog">
                    <img src="images/star.png">
                    <p><?php echo $el["rating"]; ?></p>
                </div>

                <img src="cover-items/<?php echo $el["photo"]; ?>" class="photo-item">
                <div class="name-catalog"><?php echo $el["name"]; ?></div>
                <span><?php echo number_format($el["price"]); ?> руб</span><br>

                <a href="/item.php?id=<?php echo $el["id"]; ?>?name=<?php echo $el["name"]; ?>"><button>Купить</button></a>
            </div>
        <?php } ?>
    </div>

    <div class="pagination">
        <?php for ($el = 1; $el <= $totalPages; $el++) {
            $url = $baseurl . '&page=' . $el;
            if ($currentPage == $el) {
                echo "<a href='$url' class='active'>$el</a>";
            } else {
                echo "<a href='$url'>$el</a>";
            }
        } ?>
    </div>
    </div>
</div>

<?php
    // Подключение футера сайта
    require_once("blocks/footer.php");
?>