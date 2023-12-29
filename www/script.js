class Modal {
  open(modalId) {
    document.querySelector('.modals').classList.add('show')
    document.getElementById(modalId).classList.add('show')
  }

  close() {
    document.querySelector('.modals').classList.remove('show')
    document.querySelectorAll('.modals__item').forEach((modal) => {
      modal.classList.remove('show')
    })
  }
}

const modal = new Modal()


class Todos {
  #todos
  #todosCount
  #currentPage
  #todosPerPage
  #search
  #todosBodyWrapper
  #paginationWrapper
  #taskTitle
  #taskTodos
  #tasksById
  #loading

  constructor() {
    this.currentPage = this.currentPage || 1
    this.todosPerPage = this.todosPerPage || 10
    this.tasksById = {}
    this.search = document.getElementById('search')
    this.todosBodyWrapper = document.getElementById('todosBodyWrapper')
    this.paginationWrapper = document.getElementById('pagination')
    this.taskTitle = document.getElementById('task-title')
    this.taskTodos = document.getElementById('task-todos')
    this.loadingFinish()

    this.load()
  }

  clear() {
    this.todosBodyWrapper.innerHTML = ''
    this.paginationWrapper.innerHTML = ''
  }

  load() {
    this.clear()
    this.loadingStart()

    fetch(`/api/v1/tasks?start=${this.currentPage}&limit=${this.todosPerPage}&s=${this.search.value}`)
      .then((response) => response.json())
      .then((response) => {
        this.todos = response.data.tasks
        this.todosCount = response.data.count

        this.draw()
        this.paginationDraw()
      })
      .finally(() => {
        this.loadingFinish()
      })
  }

  draw() {
    this.todosBodyWrapper.innerHTML = this.todos.map((todo) => {
      return `
        <tr onclick="todos.onTaskClick(${todo.id})">
          <td>${ todo.id }</td>
          <td>${ todo.title }</td>
          <td>${ todo.date }</td>
        </tr>
      `
    }).join('')
  }

  async onTaskClick(id) {
    if (!this.tasksById[id]) {
      this.loadingStart()
      const response = await fetch(`/api/v1/task/${ id }`).then((response) => response.json())
      this.tasksById[id] = response.data
      this.loadingFinish()
    }
    this.drawTaskModal(id)
  }

  drawTaskModal(id) {
    const task = this.tasksById[id]

    this.taskTitle.innerText = task.title
    const todoLabels = {
      id: 'Номер задачи',
      title: 'Название',
      date: 'Дата',
      author: 'Автор',
      status: 'Статус',
      description: 'Описание',
    }

    let todoItemsHtml = ''

    Object.keys(task).map((key) => {
       todoItemsHtml += `
        <div class="todo__item">
          <div class="todo__label">${ todoLabels[key] }</div>
          <input type="text" class="todo__field" disabled value="${task[key]}">
        </div>
      `
    })
    this.taskTodos.innerHTML = todoItemsHtml

    modal.open('todo')
  }

  paginationDraw() {
    const allPages = Math.ceil(this.todosCount / this.todosPerPage)
    let start = Math.max(this.currentPage - 2, 1)
    let end = Math.min(this.currentPage + 2, allPages)
    const pages = []

    for (let i = start; i <= end; i++) {
      pages.push(i)
    }

    if (pages[0] != 1) {
      pages.unshift('fisrt')
    }

    if (pages[pages.length - 1] != allPages) {
      pages.push('last')
    }

    this.paginationWrapper.innerHTML = pages.map((page) => {
      let pageNumber = page
      if (page === 'fisrt') {
        pageNumber = 1
      }
      if (page === 'last') {
        pageNumber = allPages
      }
      return `
        <button
          onclick="todos.onPageClick(${ pageNumber })"
          class="pagination__btn ${ page == this.currentPage ? 'pagination__btn--active' : '' }"
          type="button"
        >${ { fisrt: '&laquo;', last: '&raquo;' }[page] || page }</button>
      `
    }).join('')
  }

  onPageClick(page) {
    if (this.currentPage != page) {
      this.currentPage = page
      this.load()
    }
  }

  onSearchSubmit() {
    this.currentPage = 1
    this.load()

    return false
  }

  loadingStart() {
    document.body.classList.add('loading')
  }

  loadingFinish() {
    document.body.classList.remove('loading')
  }
}

const todos = new Todos()