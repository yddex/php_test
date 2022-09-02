<?php

//подключение к mysql
//$db = new PDO("mysql:dbname=database;host=localhost", "username", "password");

//подключение к базе sqlite
//если ее нет, будет создана автоматически в папке с fixture.php
$db = new PDO("sqlite:database.sqlite");

//схема таблицы с записями
$db->exec("CREATE TABLE posts (
    id INT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL
);");


//схема таблицы с комментариями
$db->exec("CREATE TABLE comments (
    id INT PRIMARY KEY,
    post_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    body TEXT NOT NULL
);");
