<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/item.css">
    <link rel="stylesheet" href="/css/catalog.css">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/checkout.css">
    <link rel="stylesheet" href="/css/reg_sign.css">
    <title>SitDownPls</title>
</head>
<body>
    <!-- Щапка сайта -->
    <header>
        <div class="header-top">
            <div class="block-1">
                <span>Регион: <b>Москва</b></span>

                <div class="call">
                    <img src="/images/call.png">
                    <span>+7 (495) 885-45-47</span>
                </div>
            </div>

            <div class="block-2">
                <span>О компании</span>
                <span>Гарантия и возврат</span>
                <span>Корпоративным клиентам</span>
                <span>Дизайн-решение</span>
            </div>
        </div>

        <div class="header-main">
            <a href="/index.php"><img src="images/logo.png"></a>

            <div class="block">
                <ul>
                    <li><a href="/catalog.php">Каталог</a></li>
                    <li><a href="">Магазины</a></li>
                    <li><a href="">Шоу-рум</a></li>
                    <li><a href="">Доставка и оплата</a></li>
                    <li><a href="">Дисконт</a></li>
                    <li><a href="">Контакты</a></li>
                </ul>
            </div>
        </div>

        <div class="header-bottom">
            <div class="search">
                <form action="" method="GET" id="searchForm">
                    <input type="text" placeholder="Я хочу купить..." id="searchInput"><br>
                    <button><img src="/images/search.png" alt="Найти"></button>
                </form>
            </div>

            <div class="cart-account">
                <a href="/reg_sign.php?form=Вход"><img src="/images/account.png" alt="Аккаунт"></a>
                <a href="/cart.php"><img src="/images/cart.png" alt="Корзина"></a>
            </div>
        </div>
    </header>
</body>
</html>