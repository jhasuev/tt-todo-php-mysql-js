<?php
header('Content-Type: application/json');
require_once './routes/showTasks.php';
require_once './routes/showTaskById.php';

$q = $_GET['q'];

$params = explode('/', $q);
$type = $params[0];
$id = abs($params[1] * 1);

// All tasks with params
if ($type === 'tasks') {
  $start = abs(filter_input(INPUT_GET, 'start', FILTER_VALIDATE_INT));
  $limit = abs(filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT));
  $search = urldecode($_GET['s']);
  
  showTasks($start, $limit, $search);
}

// One task by id
if ($type === 'task') {
  showTaskById($id);
}
