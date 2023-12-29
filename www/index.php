<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css" />
  <title>Test task (php, mysql, js)</title>
</head>
<body>

  <i class="circle-preloader"></i>

  <form method="get" onsubmit="return todos.onSearchSubmit()">
    <input id="search" name="s" type="text" class="search" placeholder="Поиск">
  </form>

  <table class="todos" cellspacing="0">
    <thead>
      <tr>
        <td>Номер задачи</td>
        <td>Заголовок</td>
        <td>Дата выполненеия</td>
      </tr>
    </thead>
    <tbody id="todosBodyWrapper">
      <!-- тут будут все таски -->
    </tbody>
  </table>

  <div id="pagination" class="pagination">
    <!-- тут будет пагинация -->
  </div>

  <div class="modals">
    <div class="modals__wrapper">
      <div id="todo" class="modals__item">
        <div>
          <div class="modals__header">
            Задача: <span id="task-title"></span>
          </div>
          <div class="todo" id="task-todos">
            <div class="todo__item">
              <div class="todo__label">label</div>
              <input type="text" class="todo__field" disabled>
            </div>
          </div>

          <button button="button" class="modals__close-btn" onclick="modal.close()">Close</button>
        </div>
      </div>
      <div class="modals__bg" onclick="modal.close()"></div>
    </div>
  </div> <!-- /.modals -->

  <script src="script.js"></script>
</body>
</html>