let btnToggle = document.getElementById('toggle-menu')

btnToggle.addEventListener('click', e => {
    let menu = document.querySelector('.menu')
    menu.classList.toggle('show')
})


let btnOpenModal = document.getElementById("open-modal")
let btnCloseModal = document.getElementById("close-modal")
let modal = document.querySelector('.modal-wrapper')
let modalBackDrop = document.querySelector('.modal-backdrop')

btnOpenModal.addEventListener('click', toggleModal);
btnCloseModal.addEventListener('click', toggleModal);
modalBackDrop.addEventListener('click', toggleModal);

function toggleModal(){
    console.log("Test")
    if(modal.classList.contains('show')){
        modal.classList.remove('show')
        modalBackDrop.classList.remove('show')
    } else {
        modal.classList.add("show")
        modalBackDrop.classList.add("show")
    }
}