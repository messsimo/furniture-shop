<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");

?>

<!-- Секция с формами Регистрации и Входа -->
<div class="container-form">
    <?php
        // Подключение сессий
        session_start();
    ?>

    <!-- Условия при котором будет показываться форма Регистрации -->
    <?php if (isset($_GET["form"]) && $_GET["form"] == "Регистрация") { ?>
    <div class="container--reg-form">
        <h1>Регистрация</h1>
        <form action="data/reg_post.php" method="POST">
            <label for="username">Ваше имя</label><br>
            <input type="text" name="username" id="username"><br>
            <label for="email">Ваша почта</label><br>
            <input type="email" name="email" id="email"><br>
            <label for="password">Ваш пароль</label><br>
            <input type="password" name="password" id="password"><br>
            <label for="rePassword">Повтор пароля</label><br>
            <input type="password" name="rePassword" id="rePassword"><br>

            <span class="form-alert"><?= $_SESSION["reg-alert"] ?? '' ?></span><br>

            <button type="submit">Зарегестрироватся</button>

            <div class="link">
                <span>Есть аккаунт?</span><br>
                <a href="/reg_sign.php?form=Вход">Войти</a>
            </div>
        </form>
    </div>
    <?php } ?>

    <!-- Условия при котором будет показываться форма Входа -->
    <?php if (isset($_GET["form"]) && $_GET["form"] == "Вход") { ?>
    <div class="container--signin-form">
        <h1>Вход в аккаунт</h1>
        <form action="data/signin_post.php" method="POST">
            <label for="email">Ваша почта</label><br>
            <input type="email" name="email-signin" id="email"><br>
            <label for="password">Ваш пароль</label><br>
            <input type="password" name="password-signin" id="password"><br>

            <span class="form-alert"><?= $_SESSION["signin-alert"] ?? '' ?></span><br>

            <button type="submit">Войти</button><br>

            <div class="link">
                <span>Нету аккаунта?</span><br>
                <a href="/reg_sign.php?form=Регистрация">Зарегестрироватся</a>
            </div>
        </form>
    </div>
    <?php } ?>
</div>

<?php
    // Подключение футера сайта
    require_once("blocks/footer.php");
?>