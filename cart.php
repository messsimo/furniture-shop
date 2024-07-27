<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");

    // Подключение БД
    require("data/db.php");

    // Запуск сессии
    session_start();

    // Переменная с GET запросом
    $id = $_GET["id"] ?? '';
    $quantity = $_GET["quantity"] ?? 0;
    $action = $_GET["action"] ?? '';

    // Удаление товара из корзины
    if (!empty($_GET["remove"])) {
        $removeId = $_GET["remove"];
        if (isset($_SESSION["cart"][$removeId])) {
            unset($_SESSION["cart"][$removeId]);
        }
    }

    // Увелечение кол-во товара
    if ($action == "add" && !empty($id)) {
        if (isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id]["quantity"]++;
            $_SESSION["cart"][$id]["total"] = $_SESSION["cart"][$id]["quantity"] * $_SESSION["cart"][$id]["price"];
        }
    }

    // Уменьшение кол-во товаров 
    if ($action == "minus" && !empty($id)) {
        if (isset($_SESSION["cart"][$id])) {
            if ($_SESSION["cart"][$id]["quantity"] > 1) {
                $_SESSION["cart"][$id]["quantity"]--;
                $_SESSION["cart"][$id]["total"] = $_SESSION["cart"][$id]["quantity"] * $_SESSION["cart"][$id]["price"];
            } else {
                unset($_SESSION["cart"][$id]);
            }
        }
    }
    
 
    // Выборка из БД
    $sql = "SELECT * FROM `items` WHERE `id` = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => $id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    // Переменные с данными из БД
    $name = $item["name"] ?? '';
    $photo = $item["photo"] ?? '';
    $price = (float)($item["price"] ?? '');
    $total = $price * $quantity; 

    // Проверка на наличие массива SESSION для содержимого корзины
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    // Функция для добавления объекта в массив
    function addToCart($id, $name, $photo, $price, $quantity, $total) {
        // Проверка на наличие товара в корзине
        if ($quantity > 0) { 
            if (isset($_SESSION["cart"][$id])) { 
                $price = (float)$price;
                $quantity = 1;
                $_SESSION["cart"][$id]["quantity"] += $quantity;
                $_SESSION["cart"][$id]["total"] = $_SESSION["cart"][$id]["quantity"] * $price;
            } else {
                // Добавление нового товара
                $_SESSION["cart"][$id] = [
                    "id" => $id,
                    "name" => $name,
                    "photo" => $photo,
                    "price" => $price,
                    "quantity" => $quantity,
                    "total" => $total
                ];
            }
        }
    }
    // Вызов функции добавления товара + записи товаров в массив
    addToCart($id, $name, $photo, $price, $quantity, $total);
?>

<!-- Cекция с навигацией -->
<div class="nav-cart">
    <h1>Корзина товаров</h1>
</div>

<!-- Секция с Отображением Товара -->
<div class="cart-items">
<?php if (empty($_SESSION["cart"])) { ?>
        <p>У вас нету товаров в корзине</p>
    <?php } else { ?>
    <div class="container-totalItems">
        <table>
        <thead>
            <tr>
                <th>Фото</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Общая цена</th>
            </tr>
        </thead>
        <tbody> 
                <?php foreach ($_SESSION["cart"] as $el) { ?>
                    <tr>
                        <td><img src="cover-items/<?= $el['photo'] ?? '' ?>" alt="<?= $el['name'] ?? '' ?>"></td>
                        <td><?= $el['name'] ?? '' ?></td>
                        <td><?= number_format($el['price'] ?? '') ?></td>
                        <td>
                            <a class="quantity" href="/cart.php?action=add&id=<?= $el["id"] ?? '' ?>">+</a>
                            <?= $el['quantity'] ?? '' ?>
                            <a class="quantity" href="/cart.php?action=minus&id=<?= $el["id"] ?? '' ?>">-</a>
                        </td>
                        <td><?= number_format($el["total"] ?? '') ?></td>
                        <td><a class="remove-btn" href="/cart.php?remove=<?php echo $el["id"] ?? ''; ?>">Убрать</a></td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
    </div>

    <div class="container-shopping">
        <div class="shop">
            <span>Общая сумма: <?= number_format(array_sum(array_column($_SESSION["cart"], 'total'))) ?> рублей</span><br>
            <a type="submit" href="/checkout.php"><button>Оформить заказ</button></a>
        </div>
    </div>
    <?php } ?>
</div>

<?php
    // Подключение футера сайта
    require_once("blocks/footer.php");
?>
