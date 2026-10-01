let hamburgerMenu = document.getElementById('hamburgerMenu')
let openHamburgerMenu = document.getElementById('openHamburgerMenu')
document.getElementById('openHamburgerMenu').addEventListener('click', () => {
    hamburgerMenu.classList.remove('invisible')
    hamburgerMenu.classList.remove('opacity-0')
    hamburgerMenu.children[0].classList.remove('translate-x-full')
})

document.addEventListener('click', (e) => {
    if (!hamburgerMenu.children[0].contains(e.target) && !openHamburgerMenu.contains(e.target)) {
        hamburgerMenu.classList.add('invisible')
        hamburgerMenu.classList.add('opacity-0')
        hamburgerMenu.children[0].classList.add('translate-x-full')
    }
})
        

        let change_like_svh = document.querySelectorAll('.change_like_svh')
        change_like_svh.forEach((item)=>{
            item.addEventListener('click' , function(){
                item.children[0].classList.toggle('hidden')
                item.children[1].classList.toggle('hidden')
            })
        })


let account_pupup_item = document.getElementById('account_pupup_item')
let account_pupup_close = document.getElementById('account_pupup_close')
// console.log('hfksldhfksjhdfjksdf')
function account_pupup(item){
    if(item == 'open'){
        account_pupup_item.classList.remove('invisible')
        account_pupup_item.classList.remove('opacity-0')
        account_pupup_close.classList.remove('invisible')
        account_pupup_close.classList.remove('opacity-0')
    }
    if(item == 'close'){
        console.log('djfsdfjsjdf')
        account_pupup_item.classList.add('invisible')
        account_pupup_item.classList.add('opacity-0')
        account_pupup_close.classList.add('invisible')
        account_pupup_close.classList.add('opacity-0')
    }
}



let search_pupup_item = document.getElementById('search_pupup_item')
let search_pupup_item_close = document.getElementById('search_pupup_item_close')

// search_pupup
function search_pupup(item){
    if(item == 'open'){
        search_pupup_item.classList.remove('h-0')
        search_pupup_item.classList.add('h-1/4')
        search_pupup_item_close.classList.remove('invisible')
        search_pupup_item_close.classList.remove('opacity-0')

    }if(item == 'close'){
        search_pupup_item.classList.add('h-0')
        search_pupup_item.classList.remove('h-1/4')
        search_pupup_item_close.classList.add('invisible')
        search_pupup_item_close.classList.add('opacity-0')

    }
}





// search_pupup