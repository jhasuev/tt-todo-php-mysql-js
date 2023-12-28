<?php
$host = "localhost";
$dbname = "tt-todo-php-mysql-js";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  runMigration($pdo, $dbname);

} catch (PDOException $e) {
  die(json_encode(array("status" => false, "message" => "Ошибка подключения к базе данных: " . $e->getMessage())));
}

function runMigration($pdo, $dbname) {
  $SQL = "SELECT id FROM tasks LIMIT 1";
  $statement = $pdo->prepare($SQL);
  $statement->execute();

  $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

  if (count($tasks) === 0) {
    $SQL_VALUES = '';
    for ($i = 1; $i <= 1000; $i++) {
        $status = $i % 2 ? 'done' : 'at work';
        $author = $i % 2 ? 'Jamal Hasuev' : 'Someone Else';
        
        $SQL_VALUES .= "(NULL, 'Задача $i', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL $i HOUR), '$author', '$status', 'Описание $i'),";
    }

    $SQL_VALUES = rtrim($SQL_VALUES, ',');

    $SQL = "INSERT INTO `$dbname`.`tasks` (`id`, `title`, `date`, `author`, `status`, `description`) VALUES $SQL_VALUES;";
    $statement = $pdo->prepare($SQL);
    $statement->execute();
  }
}