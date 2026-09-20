//! new codes
//! home page
let hamburger_menu_item = document.getElementById('hamburger_menu_item')
let close_hamburger_document = document.getElementById('close_hamburger_document')

function hamburger_menu(item) {
    if (item == 'open') {
        hamburger_menu_item.classList.remove('translate-x-full')
        hamburger_menu_item.classList.add('translate-x-0')
        close_hamburger_document.classList.remove('invisible')
        close_hamburger_document.classList.remove('opacity-0')
    }
    if (item == 'close') {
        hamburger_menu_item.classList.add('translate-x-full')
        hamburger_menu_item.classList.remove('translate-x-0')
        close_hamburger_document.classList.add('invisible')
        close_hamburger_document.classList.add('opacity-0')
    }
}
////////
let servis_pup_up_hover = document.querySelectorAll('.servis_pup_up_hover')
let servis_pup_up_item = document.querySelectorAll('.servis_pup_up_item')
let servis_pup_up_hover_close = document.querySelectorAll('.servis_pup_up_hover_close')

servis_pup_up_hover.forEach((item) => {
    item.addEventListener('mouseenter', function () {
        item.nextElementSibling.classList.remove('invisible')
        item.nextElementSibling.classList.remove('opacity-0')
        item.children[1].classList.add('rotate-180')

    })
})
servis_pup_up_hover.forEach((item) => {
    item.addEventListener('mouseleave', function () {
        item.nextElementSibling.classList.add('invisible')
        item.nextElementSibling.classList.add('opacity-0')
        item.children[1].classList.remove('rotate-180')
    })
})
servis_pup_up_item.forEach((item) => {
    item.addEventListener('mouseenter', function () {
        item.classList.remove('invisible')
        item.classList.remove('opacity-0')
    })
})

servis_pup_up_hover_close.forEach((item) => {
    item.addEventListener('mouseenter', function () {
        servis_pup_up_item.forEach((e) => {
            e.classList.add('invisible', 'opacity-0')
        })
    })
})
////////

let pu_up_servis_hamburger_menu = document.querySelectorAll('.pu_up_servis_hamburger_menu')
pu_up_servis_hamburger_menu.forEach((item) => {
    item.addEventListener('click', function () {
        item.nextElementSibling.classList.toggle('h-0')
        item.nextElementSibling.classList.toggle('h-50')
        item.children[1].classList.toggle('rotate-180')
    })
})

//! product single 
function like_svg(item) {
    item.children[0].classList.toggle('hidden')
    item.children[1].classList.toggle('hidden')
}

let question_common_onclick = document.querySelectorAll('.question_common_onclick')
question_common_onclick.forEach((item) => {
    item.addEventListener('click', function () {
        if (item.parentElement.classList.contains('min-h-12')) {
            question_common_onclick.forEach((element) => {
                element.parentElement.classList.add('min-h-12')
                element.parentElement.classList.remove('min-h-48')
                element.children[1].classList.remove('-rotate-90')
            })
        }
        item.parentElement.classList.toggle('min-h-12')
        item.parentElement.classList.toggle('min-h-48')
        item.children[1].classList.toggle('-rotate-90')
    })
})

let gallery_product_primary = document.querySelector('.gallery_product_primary')
let gallery_product_item = document.querySelectorAll('.gallery_product_item')
gallery_product_item.forEach((item) => {
    item.addEventListener('click', function () {
        let src_img_gallery = item.getAttribute('src')
        gallery_product_primary.setAttribute('src', src_img_gallery)
    })
})

let number_order_item = document.querySelector('.number_order_item')

function number_order(item) {
    let value_input = number_order_item.getAttribute('value')
    console.log(value_input)
    if (item == 'plus') {
        let plus_value = +value_input + 1
        number_order_item.setAttribute('value', plus_value)

    }
    if (item == 'minez') {
        let minez_value = +value_input - 1
        number_order_item.setAttribute('value', minez_value)
    }
}

//! category children on menu mr.olyafam
// let mainCats = document.querySelectorAll('.mainCat')
// mainCats.forEach((cat) => {
//     cat.addEventListener('click', () => {
//         mainCats.forEach((el) => {
//             el.classList.remove('bg-[var(--background)]', 'border-[var(--gold)]')
//             el.children[0].children[0].classList.remove('text-[var(--gold)]')
//             el.children[0].children[0].classList.add('text-[var(--text)]')
//             el.children[1].children[0].classList.remove('fill-[var(--gold)]')
//             el.children[1].children[0].classList.add('fill-[var(--text)]')
//         })
//         cat.classList.add('bg-[var(--background)]', 'border-[var(--gold)]')
//         cat.children[0].children[0].classList.remove('text-[var(--text)]')
//         cat.children[0].children[0].classList.add('text-[var(--gold)]')
//         cat.children[1].children[0].classList.remove('fill-[var(--text)]')
//         cat.children[1].children[0].classList.add('fill-[var(--gold)]')
//         let id = cat.getAttribute('id')
//         fetchSubCats(id)
//     })
// })


// function fetchSubCats(id) {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': csrfToken
//         }
//     })
//     $.ajax({
//         url: route,
//         type: "POST",
//         dataType: "json",
//         data: {
//             'catId': id,
//         },
//         success: function (data) {
//             console.log(data);
//         },
//         error: function () {
//             alert('error')
//         }
//     })
// }

let filter_product_list = document.querySelectorAll('.filter_product_list')
filter_product_list.forEach((item) => {
    item.addEventListener('click', function () {
        item.parentElement.classList.toggle('h-12')
        item.parentElement.classList.toggle('max-h-80')
        item.children[1].classList.toggle('rotate-180')

    })
})

let filter_index_product_pop_up_mobile_item = document.getElementById('filter_index_product_pop_up_mobile_item')
function filter_index_product_pop_up_mobile(item) {
    if (item == 'open') {
        filter_index_product_pop_up_mobile_item.classList.remove('invisible')
        filter_index_product_pop_up_mobile_item.classList.remove('opacity-0')
    }
    if (item == 'close') {
        filter_index_product_pop_up_mobile_item.classList.add('invisible')
        filter_index_product_pop_up_mobile_item.classList.add('opacity-0')
    }
}

function sort_product(item) {
    item.parentElement.classList.toggle('h-12')
    item.parentElement.classList.toggle('h-60')
    item.children[1].classList.toggle('rotate-180')

}

let modals = document.querySelectorAll('.modal');
modals.forEach(modal => {
    setTimeout(() => {
        modal.classList.add('opacity-0', 'invisible')
    }, 3000)
})
