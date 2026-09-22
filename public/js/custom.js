let hamburger_menu_item = document.getElementById('hamburger_menu_item')
        let hamburger_menu_item_close = document.getElementById('hamburger_menu_item_close')

        function hamburger_menu(type) {
            if (type == 'open') {
                hamburger_menu_item.classList.remove('translate-x-full')
                hamburger_menu_item_close.classList.remove('invisible')
                hamburger_menu_item_close.classList.remove('opacity-0')
            }
            if (type == 'close') {
                hamburger_menu_item.classList.add('translate-x-full')
                hamburger_menu_item_close.classList.add('invisible')
                hamburger_menu_item_close.classList.add('opacity-0')
            }
        }

        let change_like_svh = document.querySelectorAll('.change_like_svh')
        change_like_svh.forEach((item)=>{
            item.addEventListener('click' , function(){
                item.children[0].classList.toggle('hidden')
                item.children[1].classList.toggle('hidden')
            })
        })