<?php
    // Подключение шапки сайта
    require_once("blocks/header.php");
?>

<!-- Секция с формами Регистрации и Входа -->
<div class="container-form">
    <div class="container--reg-form">
        <h1>Регистрация</h1>
        <form action="">
            <label for="usernmae">Ваше имя</label><br>
            <input type="text" name="usernmae" id="usernmae"><br>
            <label for="email">Ваша почта</label><br>
            <input type="text" name="email" id="email"><br>
            <label for="password">Ваш пароль</label><br>
            <input type="text" name="password" id="password"><br>
            <label for="rePassword">Повтор пароля</label><br>
            <input type="text" name="rePassword" id="rePassword"><br>

            <span class="form-alert"></span><br>

            <button type="submit">Зарегестрироватся</button>
        </form>
    </div>

    <div class="container--signin-form">
        <h1>Вход в аккаунт</h1>
        <form action="">
            <label for="email">Ваша почта</label><br>
            <input type="text" name="email" id="email"><br>
            <label for="password">Ваш пароль</label><br>
            <input type="text" name="password" id="password"><br>

            <span class="form-alert"></span><br>

            <button type="submit">Войти</button>
        </form>
    </div>
</div>

<?php
    // Подключение футера сайта
    require_once("blocks/footer.php");
?>