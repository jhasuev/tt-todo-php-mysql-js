<?php

function showTasks($start, $limit, $SEARCH) {
  require_once './db/db_config.php';

  $start = is_int($start) && $start != 0 ? $start - 1 : 0;
  $limit = is_int($limit) ? $limit : 10;
  
  try {
    $WHERE = '';
    if ($SEARCH) {
      $SEARCH = htmlentities(addslashes($SEARCH));
      $WHERE = "WHERE title Like '%$SEARCH%'";
    }

    $SQL = "SELECT id, title, date FROM tasks $WHERE ORDER BY DESC `id` LIMIT $start, $limit";
    $statement = $pdo->prepare($SQL);
    $statement->execute();
  
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
  
    if (count($tasks) === 0) {
      die(json_encode(array("status" => true, "message" => "no data")));
    } else {
      die(json_encode(array("status" => true, "data" => $tasks)));
    }
  } catch (PDOException $e) {
    die(json_encode(array("status" => false, "message" => "error")));
  }
}

