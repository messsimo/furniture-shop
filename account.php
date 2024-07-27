<?php
    // Запуск сессии
    session_start();

    // Подключение шапки сайта
    require_once("blocks/header.php");

    // Подключение БД
    require("data/db.php");

    // Переменная для хранения почты из сессии
    $userEmail = $_SESSION["email-user"] ?? '';

    // Выборка из БД по записи `email` в таблице `users`
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("email", $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(2);

    // Выборка из БД по записи `email` в таблице `orders`
    $sql = "SELECT * FROM `orders` WHERE `email` = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("email", $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    $order = $stmt->fetchAll(2);

    // Условия выхода из аккаунта
    $action = $_GET["action"] ?? '';

    if (isset($action) && $action == "exit") {
        header("Location: /index.php");
        // Очищение сессии с почтой
        unset($_SESSION["email"]);
    }
?>

<!-- Секция с профилем пользователя -->
<div class="account">
    <div class="card-decoration">
        <img src="images/deco.png">
    </div>

    <div class="user-card">
        <div class="user-avatar">
            <img src="images/user-avatar.png">
        </div>

        <div class="user-info-card">
            <h1><?php echo $user["username"] ?? ''; ?></h1>
        
            <p>Вы зарегестрировались: <?php echo $user["timestamp"] ?? ''; ?></p>
            <p>Ваша почта: <?php echo $user["email"] ?? ''; ?></p>
            
            <span>Cпасибо что вы с нами!</span><br><br>

            <a href="/account.php?action=exit">Выйти из аккаунта</a>
        </div>
    </div>
</div>

<!-- Секция с выводом Заказов пользователя -->
<div class="user-orders">
    <h1>Ваши заказы</h1>

    <div class="oreders-container">
    <table>
        <thead>
            <tr>
                <th>Дата заказа</th>
                <th>Название</th>
                <th>Кол-во</th>
                <th>Общая цена</th>
            </tr>
        </thead>
        <tbody> 
            <?php if (count($order) < 1) { ?>
                <td>Вы еще ничего не заказывали</td>
            <?php } else { ?>
                <?php foreach ($order as $el) { ?>
                    <tr>
                        <td><?php echo $el["timestamp"] ?? ''; ?></td>
                        <td><?php echo $el["product_name"] ?? ''; ?></td>
                        <td><?php echo $el["product_quantity"] ?? ''; ?> шт</td>
                        <td><?php echo number_format($el["product_total"]) ?? ''; ?> рублей</td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    </div>
</div>

<p class="order-alert">*Сведения о ваших заказах берутся по почте, которую вы указали при оформлении заказа</p> 

<?php
    // Подключение футера сайта
    require_once("blocks/footer.php");
?>