// ! toggle menu in dashboard with mr.olyafam
let arrowDowns = document.querySelectorAll(".arrow-down");
arrowDowns.forEach((arrowDown) => {
   arrowDown.addEventListener('click', () => {
      if (arrowDown.nextElementSibling.classList.contains('max-h-0')) {
         arrowDowns.forEach((arrow) => {
            arrow.children[0].classList.remove('rotate-180')
            arrow.nextElementSibling.classList.remove('max-h-100')
            arrow.nextElementSibling.classList.add('max-h-0')
         })
         arrowDown.children[0].classList.add('rotate-180')
         arrowDown.nextElementSibling.classList.remove('max-h-0')
         arrowDown.nextElementSibling.classList.add('max-h-100')
      } else {
         arrowDown.children[0].classList.remove('rotate-180')
         arrowDown.nextElementSibling.classList.remove('max-h-100')
         arrowDown.nextElementSibling.classList.add('max-h-0')
      }
   })
})

let menu = document.getElementById('menu');
function responsive_menu(state) {
   if (state == 'open') {
      menu.classList.remove('opacity-0');
      menu.classList.remove('-right-full');
      menu.classList.add('right-0');
   }
   if (state == 'close') {
      menu.classList.add('opacity-0');
      menu.classList.add('-right-full');
      menu.classList.remove('right-0');
   }
}

let modals = document.querySelectorAll('.modal');
modals.forEach(modal => {
   setTimeout(() => {
      modal.classList.add('opacity-0', 'invisible')
   }, 3000)
})