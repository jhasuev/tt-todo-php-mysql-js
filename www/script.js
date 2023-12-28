function modalOpen(modalId){
  document.querySelector('.modals').classList.add('show')
  document.getElementById(modalId).classList.add('show')
}

function modalsClose(){
	document.querySelector('.modals').classList.remove('show')
  document.querySelectorAll('.modals__item').forEach((modal) => {
    modal.classList.remove('show')
  })
}