let hamburgerMenu = document.getElementById('hamburgerMenu')
let openHamburgerMenu = document.getElementById('openHamburgerMenu')
document.getElementById('openHamburgerMenu').addEventListener('click', () => {
    hamburgerMenu.classList.remove('invisible')
    hamburgerMenu.classList.remove('opacity-0')
    hamburgerMenu.children[0].classList.remove('translate-x-full')
})

document.addEventListener('click', (e)=>{
    if(!hamburgerMenu.children[0].contains(e.target) && !openHamburgerMenu.contains(e.target)){
        hamburgerMenu.classList.add('invisible')
        hamburgerMenu.classList.add('opacity-0')
        hamburgerMenu.children[0].classList.add('translate-x-full')
    }
})