<?php
$host = "localhost";
$dbname = "tt-todo-php-mysql-js";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die(json_encode(array("status" => false, "message" => "Ошибка подключения к базе данных: " . $e->getMessage())));
}
