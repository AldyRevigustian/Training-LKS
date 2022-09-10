import PVZ from './PVZ.js'

let btnInstructions = document.getElementById('instructions')
btnInstructions.addEventListener('click', ()=>{
    let instructionsTab = document.querySelector('.instructions')
    instructionsTab.style.display = instructionsTab.style.display == 'none' ? 'block' : 'none'
})

let usernameInput = document.getElementById('username')
let btnPlay = document.getElementById('play')
usernameInput.addEventListener('input', () => {
    if(usernameInput.value == ""){
        btnPlay.setAttribute('disabled', true)
    } 
    else{
        btnPlay.removeAttribute('disabled')
    } 
})

const pvz = new PVZ(document.getElementById('canvas'))
pvz.render()

btnPlay.addEventListener('click', ()=>{
    document.querySelector('.flex').style.display = 'none'
    document.querySelector('#canvas').style.display = 'block'

})

