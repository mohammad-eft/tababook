// // let chocolateMenu = document.getElementById('chocolateMenu')
// // let chocIcon = document.getElementById('chocIcon')
// // let chocIconMobile = document.getElementById('chocIconMobile')
// // let boxC = document.getElementById('boxC')

// // function closeChocMenu() {
// //     chocolateMenu.classList.remove('right-0')
// //     chocolateMenu.classList.add('-right-full')
// //     boxC.classList.add('opacity-0')
// // }
// // chocIcon.addEventListener('click', () => {
// //     chocolateMenu.classList.remove('-right-full')
// //     boxC.classList.remove('opacity-0')
// //     chocolateMenu.classList.add('right-0')
// // })
// // chocIconMobile.addEventListener('click', () => {
// //     chocolateMenu.classList.remove('-right-full')
// //     boxC.classList.remove('opacity-0')
// //     chocolateMenu.classList.add('right-0')
// // })

// let subMenuActive = document.querySelectorAll('.subMenuActive');
// subMenuActive.forEach((item) => {
//     item.addEventListener('click', () => {
//         if (item.parentElement.nextElementSibling.classList.contains('max-h-0')) {
//             item.parentElement.nextElementSibling.classList.remove("max-h-0")
//             item.parentElement.nextElementSibling.classList.add("max-h-[2000px]")
//             item.children[0].classList.add('rotate-180');
//             subMenuActive.forEach((close) => {
//                 if (close.parentElement.nextElementSibling != item.parentElement.nextElementSibling) {
//                     close.parentElement.nextElementSibling.classList.add("max-h-0")
//                     close.parentElement.nextElementSibling.classList.remove("max-h-[2000px]")
//                     close.children[0].classList.remove('rotate-180');
//                 }

//             })
//         } else {
//             subMenuActive.forEach((item) => {
//                 item.parentElement.nextElementSibling.classList.add("max-h-0")
//                 item.parentElement.nextElementSibling.classList.remove("max-h-[2000px]")
//                 item.children[0].classList.remove('rotate-180');
//             })
//         }
//     });
// });

// let subMenuCat = document.querySelectorAll('.subMenuCat')
// subMenuCat.forEach((item) => {
//     item.addEventListener('click', () => {
//         subMenuCat.forEach((element) => {
//             element.classList.remove('activeSubMenuCat')
//         })
//         item.classList.add('activeSubMenuCat')
//     })
// })


// const children = document.querySelectorAll('.child');
// let maxHeight = 0;

// children.forEach(el => {
//     if (el.offsetHeight > maxHeight) {
//         maxHeight = el.offsetHeight;
//     }
// });

// children.forEach(el => {
//     el.style.height = maxHeight + 'px';
// });

// let commentModal = document.getElementById('commentModal')
// function comment(state) {
//     if (state == "open") {
//         commentModal.classList.remove('invisible')
//         commentModal.classList.remove('opacity-0')
//         commentModal.children[0].classList.remove('opacity-0')
//         commentModal.children[0].classList.remove('scale-50')
//     }
//     if (state == "close") {
//         commentModal.children[0].classList.remove('delay-300')
//         commentModal.classList.add('invisible')
//         commentModal.classList.add('opacity-0')
//         commentModal.children[0].classList.add('opacity-0')
//         commentModal.children[0].classList.add('scale-50')
//     }
// }

// let questionModal = document.getElementById('questionModal')
// function question(state) {
//     if (state == "open") {
//         questionModal.classList.remove('invisible')
//         questionModal.classList.remove('opacity-0')
//         questionModal.children[0].classList.remove('opacity-0')
//         questionModal.children[0].classList.remove('scale-50')
//     }
//     if (state == "close") {
//         questionModal.children[0].classList.remove('delay-300')
//         questionModal.classList.add('invisible')
//         questionModal.classList.add('opacity-0')
//         questionModal.children[0].classList.add('opacity-0')
//         questionModal.children[0].classList.add('scale-50')
//     }
// }

// let commentModalMobile = document.getElementById('commentModalMobile')
// function commentMobile(state) {
//     if (state == "open") {
//         commentModalMobile.classList.remove('-bottom-full')
//         commentModalMobile.classList.add('bottom-0')
//     }






//     if (state == 'close') {
//         commentModalMobile.classList.remove('bottom-0')
//         commentModalMobile.classList.add('-bottom-full')
//     }
// }

// let questionModalMobile = document.getElementById('questionModalMobile')
// function questionMobile(state) {
//     if (state == 'open') {
//         questionModalMobile.classList.remove('-bottom-full')
//         questionModalMobile.classList.add('bottom-0')
//     }
//     if (state == 'close') {
//         questionModalMobile.classList.remove('bottom-0')
//         questionModalMobile.classList.add('-bottom-full')
//     }
// }

// // search page

// function btn(el) {
//     if (el.children[0].classList.contains('translate-x-0')) {
//         el.children[0].classList.remove('translate-x-0')
//         el.children[0].classList.add('-translate-x-5')
//         el.children[0].classList.add('bg-white')
//         el.classList.add('bg-[var(--color-secondary)]')
//         el.classList.remove('border-gray-400')
//         el.classList.add('border-[var(--color-secondary)]')
//     } else {
//         el.children[0].classList.remove('-translate-x-5')
//         el.children[0].classList.add('translate-x-0')
//         el.children[0].classList.remove('bg-white')
//         el.classList.remove('bg-[var(--color-secondary)]')
//         el.classList.add('border-gray-400')
//         el.classList.remove('border-[var(--color-secondary)]')
//     }
// }

// let sidebarFeatures = document.querySelectorAll('.sidebarFeatures')
// sidebarFeatures.forEach((item) => {
//     item.addEventListener('click', () => {
//         if (item.children[1].classList.contains('max-h-0')) {
//             item.children[1].classList.remove('max-h-0')
//             item.children[1].classList.add('max-h-svh')
//             item.children[0].children[0].children[1].classList.add('rotate-180')
//             sidebarFeatures.forEach((subItem) => {
//                 // console.log(item);
//                 // console.log(subItem);
//                 if (subItem.children[1] != item.children[1]) {
//                     subItem.children[1].classList.remove('max-h-svh')
//                     subItem.children[0].children[0].children[1].classList.remove('rotate-180')
//                     subItem.children[1].classList.add('max-h-0')
//                 }
//             })
//         } else {
//             item.children[1].classList.remove('max-h-svh')
//             item.children[0].children[0].children[1].classList.remove('rotate-180')
//             item.children[1].classList.add('max-h-0')
//         }
//     })
// })

// // new
// let loginItem = document.getElementById('login')
// function login(state) {
//     if (state == "open") {
//         loginItem.classList.remove('opacity-0')
//         loginItem.classList.remove('invisible')
//         loginItem.children[0].children[1].classList.remove('opacity-0')
//         loginItem.children[0].children[1].classList.remove('scale-75')
//     }
//     if (state == "close") {
//         loginItem.classList.add('opacity-0')
//         loginItem.classList.add('invisible')
//         loginItem.children[0].children[1].classList.add('opacity-0')
//         loginItem.children[0].children[1].classList.add('scale-75')
//     }

// }

// //! add to shopping cart by mr.olyafam
// function addToShoppingCart(element, id, title, description, image, price) {
//     let productCountInCookie = 0;
//     let allCookies = document.cookie;
//     let allCookiesArr = allCookies.split(';');
//     allCookiesArr.forEach((cookie) => {
//         if (cookie.indexOf('shahkarProduct') !== -1) {
//             productCountInCookie++;
//         }
//     })
//     let productCartInfo = 'shahkarProduct' + (productCountInCookie + 1) + 'title=' + title + '&&shahkarProduct' + (productCountInCookie + 1) + 'price=' + price + '&&shahkarProduct' + (productCountInCookie + 1) + 'description=' + description + '&&shahkarProduct' + (productCountInCookie + 1) + 'image=' + image + '&&shahkarProduct' + (productCountInCookie + 1) + 'id=' + id;
//     document.cookie = productCartInfo;
//     proNumber()
// }
// // product count in top of shopping cart icon
// function proNumber() {
//     let productCount = 0
//     document.cookie.split(';').forEach((cookie) => {
//         if (cookie.indexOf('shahkarProduct') !== -1) {
//             productCount++
//         }
//     })




//     document.querySelectorAll('.product-count-in-shoppingCart').forEach((proCount) => {
//         proCount.innerHTML = productCount;
//     })
// }
// proNumber()

// let shoppingCartProducts = document.getElementById('shoppingCartProducts');
// let mobileShoppingCartProducts = document.getElementById('mobileShoppingCartProducts');
// let i = 1
// let array = []
// let x = []
// let count = 0
// let totalPrice = 0
// function getCookies() {
//     shoppingCartProducts.innerHTML = '';
//     mobileShoppingCartProducts.innerHTML = '';
//     let allCookies = document.cookie;
//     i = 1
//     count = 0
//     totalPrice = 0
//     let finalCountOfArray = 0
//     allCookies.split(';').forEach((cookie) => {
//         if (cookie.indexOf('shahkarProduct') !== -1) {
//             let div = document.createElement('div')
//             count++
//             array = []
//             cookie.split('&&').forEach((part) => {
//                 part.trim().split('=').forEach((info, index) => {
//                     if (index == 0) key = info;
//                     if (index == 1) array[key] = info;
//                     if (index == 1) x[key] = info;
//                     if (index == 1) {
//                         finalCountOfArray++
//                         if (finalCountOfArray == 5) {
//                             let element = `
//                                 <div class="relative mb-5 w-full h-25 border-b border-(--color-border) pb-5">
//                                         <input type="hidden" value="${array['shahkarProduct' + i + 'id']}">
//                                         <div class="size-full flex gap-2">
//                                             <div class="w-1/3 h-full">
//                                                 <img src="${array['shahkarProduct' + i + 'image']}" class="size-full" alt="">
//                                             </div>
//                                             <div class="flex flex-col gap-2 w-2/3 h-full">
//                                                 <span class="font-bold text-(--primary-text-color)">${array['shahkarProduct' + i + 'title']}</span>
//                                                 <span class="text-sm font-light text-(--secondary-text-color)">${array['shahkarProduct' + i + 'description']}</span>
//                                                 <span class="text-sm font-light text-(--secondary-text-color)">
//                                                     <span>${array['shahkarProduct' + i + 'price']}</span>
//                                                     <span>تومان</span>
//                                                 </span>
//                                             </div>
//                                         </div>
//                                         <div class="absolute left-0 bottom-3 font-light text-(--secondary-text-color)">
//                                             <div
//                                                 class="w-18 flex flex-row justify-between items-center border border-(--color-border) rounded-md p-0.5">
//                                                 <button class="rounded-md w-5 h-7 flex items-center justify-center cursor-pointer" onclick="changeProductCount(this, 'minus')">
//                                                     <div class="cursor-pointer" onclick="removeProductFromShoppingCart(this,${array['shahkarProduct' + i + 'id']})">
//                                                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
//                                                             class="size-full">
//                                                             <path fill="var(--color-fill)"
//                                                                 d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
//                                                         </svg>
//                                                     </div>
//                                                 </button>
//                                                 <input type="number" class="w-7 outline-none text-center"
//                                                     value="1" min="0" name="" id="">
//                                                 <button
//                                                     class="bg-(--discount-color) rounded-md w-5 h-7 flex items-center justify-center cursor-pointer" onclick="changeProductCount(this, 'plus')">+</button>
//                                             </div>
//                                         </div>
//                                 </div>
//                                 `
//                             div.innerHTML = element
//                             totalPrice += parseInt(array['shahkarProduct' + i + 'price'])
//                             finalCountOfArray = 0
//                         }
//                     }
//                 })
//             })
//             i++
//             mobileShoppingCartProducts.appendChild(div);
//             const clonedDiv = div.cloneNode(true);
//             shoppingCartProducts.appendChild(clonedDiv);
//         }
//     })
//     document.getElementById('shoppingCartProductCount').innerHTML = count
//     document.getElementById('mobileShoppingCartProductCount').innerHTML = count
//     document.getElementById('shoppingCartTotalPrice').innerHTML = totalPrice
//     document.getElementById('mobileShoppingCartTotalPrice').innerHTML = totalPrice
//     console.log(x);
// }

// let shoppingCartContent = document.getElementById('shoppingCartContent')
// let mobileShoppingCartContent = document.getElementById('mobileShoppingCartContent')
// function showCartContent() {
//     getCookies()
//     shoppingCartContent.classList.toggle('invisible');
//     shoppingCartContent.classList.toggle('opacity-0');
//     mobileShoppingCartContent.classList.toggle('invisible');
//     mobileShoppingCartContent.classList.toggle('opacity-0');
// }
// function closeCart() {
//     shoppingCartContent.classList.add('invisible');
//     shoppingCartContent.classList.add('opacity-0');
//     mobileShoppingCartContent.classList.add('invisible');
//     mobileShoppingCartContent.classList.add('opacity-0');
// }
// //! remove product from shopping cart
// function removeProductFromShoppingCart(el, id) {
//     console.log(id);
//     console.log(el.parentElement);
// }

// function changeProductCount(el, state) {
//     if (state == "plus") {
//         count++
//         document.getElementById('shoppingCartProductCount').innerHTML = count
//         document.getElementById('mobileShoppingCartProductCount').innerHTML = count
//         document.getElementById('shoppingCartTotalPrice').innerHTML = totalPrice
//         document.getElementById('mobileShoppingCartTotalPrice').innerHTML = totalPrice
//         el.parentElement.children[1].value++
//         if (el.parentElement.children[1].value > 1) {
//             el.parentElement.children[0].classList.add('bg-(--discount-color)')
//             el.parentElement.children[0].innerHTML = '-'
//         }
//     }
//     if (state == "minus") {
//         count--
//         document.getElementById('shoppingCartProductCount').innerHTML = count
//         document.getElementById('mobileShoppingCartProductCount').innerHTML = count
//         document.getElementById('shoppingCartTotalPrice').innerHTML = totalPrice
//         document.getElementById('mobileShoppingCartTotalPrice').innerHTML = totalPrice
//         if (el.parentElement.children[1].value > 1) {
//             el.parentElement.children[1].value--
//         }
//         if (el.parentElement.children[1].value == 1) {
//             el.parentElement.children[0].classList.remove('bg-(--discount-color)')
//             el.parentElement.children[0].innerHTML = `
//                                                     <div class="cursor-pointer" onclick="removeProductFromShoppingCart(this,${array['shahkarProduct' + i + 'id']})">
//                                                                                                             <svg xmlns="http://www.w3.org/2000/

//                                                             svg" viewBox="0 0 448 512"
//                                                             class="size-full">
//                                                             <path fill="var(--color-fill)"
//                                                                 d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
//                                                         </svg>
//                                                     </div>
//             `
//         }
//     }
// }

// //! related products to per category by mr.olyafam
// let categoryTitles = document.querySelectorAll('.category-title')
// categoryTitles.forEach((item) => {
//     item.addEventListener('click', () => {
//         categoryTitles.forEach((el) => {
//             el.classList.remove('text-(--primary-text-color)')
//             el.classList.add('text-(--secondary-text-color)')
//         })
//         item.classList.add('text-(--primary-text-color)')
//     })
// })

// let relatedProducts = document.getElementById('relatedProducts');
// let headerRelatedProducts = document.querySelectorAll('.headerRelatedProducts');
// function getRelatedProducts(param, section) {
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
//             'id': param
//         },
//         success: function (data) {
//             if (section == "home") {
//                 document.getElementById('relatedProductsCount').innerHTML = data.length
//                 relatedProducts.innerHTML = '';
//                 data.forEach((product) => {
//                     let id = product.id;
//                     let title = product.title;
//                     let description = product.description;
//                     let price = product.price.price;
//                     let image = product.img;
//                     let div = document.createElement('div');
//                     div.classList = 'p-2 min-w-65 h-100 border border-(--color-border) rounded-[10px] relative flex flex-col justify-between productItem'
//                     let element = `

//                             <div>
//                                 <a href=""
//                                     class="flex justify-center mb-1 overflow-hidden">
//                                     <img src="${image}"
//                                         class="w-full transition-all duration-500 hover:scale-[1.04] relative z-10 max-h-[182px] lg:max-h-[186px] md:max-h-[348px] xl:max-h-[171px]"
//                                         alt="product">
//                                 </a>
//                             </div>
//                             <div class="flex flex-col">
//                                 <div class="mb-2 font-bold text-[14px] lg:text-base">
//                                     <a href=""
//                                         class="text-[12px] lg:text-[14px] text-(--primary-text-color)">${title}</a>
//                                 </div>
//                                 <div class="mb-1">
//                                     <a href="">${description}</a>
//                                 </div>
//                             </div>
//                             <div class="flex flex-row items-center mb-3 gap-3">
//                                 <div class="lg:w-1/2 flex flex-row items-center text-[12px]">
//                                     <div class="text-(--secondary-text-color) flex flex-row items-center">
//                                         <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"

//                                                     viewBox="0 0 576 512">
//                                             <path fill="#8C9EC5"
//                                                 d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
//                                         </svg>
//                                         <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
//                                             viewBox="0 0 576 512">
//                                             <path fill="#8C9EC5"
//                                                 d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
//                                         </svg>
//                                         <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
//                                             viewBox="0 0 576 512">
//                                             <path fill="#8C9EC5"
//                                                 d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
//                                         </svg>
//                                         <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
//                                             viewBox="0 0 576 512">
//                                             <path fill="#8C9EC5"
//                                                 d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
//                                         </svg>
//                                         <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
//                                             viewBox="0 0 576 512">
//                                             <path fill="#8C9EC5"
//                                                 d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l2

//                                                     6.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
//                                         </svg>
//                                     </div>
//                                     <span>(0)</span>
//                                 </div>
//                             </div>
//                             <div class="">
//                                 <div
//                                     class="hidden lg:flex flex-row items-center gap-2 text-(--primary-text-color) mb-3 text-[18px] font-bold">
//                                     <span class="font-bold text-lg">${price}</span>
//                                     <span class="text-sm">تومان</span>
//                                 </div>
//                                 <div class="flex lg:hidden flex-row items-start gap-2 text-(--primary-text-color) mb-3 font-bold">
//                                     <span class="font-bold text-lg">${price}</span>
//                                     <span class="text-sm">تومان</span>
//                                 </div>
//                             </div>
//                             <div class="flex flex-col lg:flex-row gap-2 lg:gap-4">
//                                 <div class="w-full h-12">
//                                     <button
//                                         onclick="addToShoppingCart(this,'${id}', '${title}', '${description}', '${image}', '${price}')"
//                                         class="w-full h-full py-3 lg:py-1 text-[12px] lg:text-[14px] text-(--discount-color-text) bg-(--color-bg-card-btn) leading-5 rounded-[10px] cursor-pointer">افزودن
//                                         به سبد خرید</button>
//                                 </div>
//                             </div>
//                     `
//                     div.innerHTML = element;
//                     relatedProducts.appendChild(div)
//                 })
//             }
//             if (section == "header") {
//                 headerRelatedProducts.forEach((headerRelatedProduct) => {
//                     headerRelatedProduct.innerHTML = '';
//                     data.forEach((product) => {
//                         let div = document.createElement('div');
//                         div.classList = 'p-4 border border-(--color-border) rounded-[10px]'
//                         let element = `
//                             <a href="http://localhost/shahkar/public/product/show/${product.id}"
//                                 class="block mb-1">
//                                 <img src="${product.img}"
//                                     class="w-full transition-all duration-500 hover:scale-[1.04] relative z-10 max-h-[276px] lg:max-h-[186px] md:max-h-[348px] xl:max-h-[171px]"
//                                     alt="product">
//                                     <span
//                                         class="inline-block w-full text-center pt-3">${product.title}</span>
//                                     <span
//                                         class="block text-center text-[14px] text-(--secondary-text-color)">${product.description}</span>
//                             </a>
//                         `
//                         div.innerHTML = element;
//                         headerRelatedProduct.appendChild(div)
//                     })
//                 })
//             }
//         },
//         error: function () {
//             alert('error')
//         }
//     })
// }


// let gallery_pack_single_primary_img = document.querySelectorAll('.gallery_pack_single_primary_img')
// let gallery_pack_single = document.querySelectorAll('.gallery_pack_single')
// gallery_pack_single.forEach((item) => {
//     item.addEventListener('click', function () {
//         gallery_pack_single_primary_img.forEach((priamry) => {

//             let src = item.children[0].getAttribute('src')
//             // console.log(src)
//             priamry.setAttribute('src', src)
//         })
//     })
// })


// usage codes

localProducts = JSON.parse(localStorage.getItem('products'))
addToCartBtns = document.querySelectorAll('.addToCartBtns')
if(localStorage.getItem('products') && localProducts.length){
    addToCartBtns.forEach(btn => {
        localProducts.forEach(cartItem => {
            if (cartItem.id == productId) {
                btn.innerHTML = `
                <div class="w-full px-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl" data-product-id="${productId}">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                    <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none in-fa" readonly value="${cartItem.quantity}">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                </div>`
                
            }
        })
    })
}
addToCartBtns.forEach(btn=>{
    if (btn.dataset.count == 0) {
        btn.innerHTML = `
            <button class="w-full px-4 h-full bg-(--pastel-pink) flex gap-2 justify-center items-center rounded-xl relative after:absolute after:w-full after:h-full after:content-[''] after:top-0 after:right-0 after:bg-white/30 after:rounded-xl transition-all duration-300 hover:bg-(--discount-color) cursor-no-drop group">
                <span class="lg:text-sm text-[10px] text-white font-bold transition-all duration-300">عدم موجودی</span>
            </button>`
    }
})