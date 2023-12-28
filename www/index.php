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

  <input type="text" class="search" placeholder="Поиск">

  <table class="todos" cellspacing="0">
    <thead>
      <tr>
        <td>Номер задачи</td>
        <td>Заголовок</td>
        <td>Дата выполненеия</td>
      </tr>
    </thead>
    <tbody>
      <tr onclick="modalOpen('todo')">
        <td>11</td>
        <td>11</td>
        <td>11</td>
      </tr>
    </tbody>
  </table>

  <div class="pagination">
    <button class="pagination__btn" type="button">1</button>
    <button class="pagination__btn pagination__btn--active" type="button">2</button>
  </div>

  <div class="modals">
    <div class="modals__wrapper">
      <div id="todo" class="modals__item">
        <div>
          <div class="modals__header">
            Задача: 1234567
          </div>
          <div class="todo">

            <div class="todo__item">
              <div class="todo__label">label</div>
              <input type="text" class="todo__field" disabled>
            </div>
          </div>

          <button button="button" class="modals__close-btn" onclick="modalsClose()">Close</button>
        </div>
      </div>
      <div class="modals__bg" onclick="modalsClose()"></div>
    </div>
  </div> <!-- /.modals -->

  <script src="script.js"></script>
</body>
</html>