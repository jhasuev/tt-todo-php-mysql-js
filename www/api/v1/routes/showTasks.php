<?php

function showTasks($start, $limit, $SEARCH) {
  require_once './db/db_config.php';

  $start = is_int($start) && $start != 0 ? $start - 1 : 0;
  $page = $start * $limit;
  $limit = is_int($limit) && $limit != 0 ? $limit : 10;
  
  try {
    $WHERE = '';
    if ($SEARCH) {
      $SEARCH = htmlentities(addslashes($SEARCH));
      $WHERE = "WHERE title Like '%$SEARCH%'";
    }

    $SQL = "SELECT `id`, `title`, `date` FROM tasks $WHERE ORDER BY `id` DESC LIMIT $page, $limit";
    $statement = $pdo->prepare($SQL);
    $statement->execute();

    
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statementCount = $pdo->prepare("SELECT Count(*) as count FROM tasks $WHERE");
    $statementCount->execute();

    $count = $statementCount->fetchAll(PDO::FETCH_ASSOC);
  
    if (count($tasks) === 0) {
      die(json_encode(array("status" => true, "message" => 'no data')));
    } else {
      die(json_encode(array(
        "status" => true,
        "data" => array(
          "tasks" => $tasks,
          "count" => $count[0]['count'] * 1
        )
      )));
    }
  } catch (PDOException $e) {
    die(json_encode(array("status" => false, "message" => "error" . $e)));
  }
}

