<?php
    // Подключение к БД
    $host = "localhost";
    $dbname = "sitdownpls";
    $password = "root";
    $username = "root";
    $port = "5004";
    $dsn = "mysql:host=$host;dbname=$dbname;port=$port;";

    $pdo = new PDO($dsn, $username, $password);