<?php

function showTaskById($id) {
  require_once './db/db_config.php';
  
  try {
    $SQL = "SELECT * FROM tasks WHERE id = $id";
    $statement = $pdo->prepare($SQL);
    $statement->execute();
  
    $task = $statement->fetchAll(PDO::FETCH_ASSOC);
  
    if (count($task) === 0) {
      die(json_encode(array("status" => true, "message" => "no data")));
    } else {
      die(json_encode(array("status" => true, "data" => $task[0])));
    }
  } catch (PDOException $e) {
    die(json_encode(array("status" => false, "message" => "error")));
  }
}

