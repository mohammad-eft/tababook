let totalPriceEl = document.getElementById('totalPriceEl')
let discountEl = document.getElementById('discountEl')
let addPackToCartBtn = document.getElementById('addPackToCartBtn')
let cartItemsBlock = document.getElementById('cartItemsBlock')
let cartLink = document.getElementById('cartLink')
orderBasket = document.getElementById('orderBasket')
localProducts = JSON.parse(localStorage.getItem('products'))
localPacks = JSON.parse(localStorage.getItem('packs'))
let popupFlag = false

function addToCart(btn) {
    let container = btn.closest('.addToCartBtns')
    if (!container) return

    let productId = container.dataset.productId
    if (!productId) return
    cartLink.classList.remove('hidden')
    btn.removeAttribute('onclick')
    btn.innerHTML = `<div class="w-5 h-5 border-2 border-white border-t-(--primary-text-color) rounded-full animate-spin"></div>`

    $.ajax({
        url: api + 'findProduct/' + productId,
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (orderBasket && orderBasket.children[1]) {
                let quan = parseInt(orderBasket.children[1].innerText) || 0
                quan += 1
                orderBasket.children[1].innerText = quan
            }

            response.quantity = 1

            document.querySelectorAll('.addToCartBtns').forEach(button => {
                if (button.dataset.productId != productId) return

                let input = button.querySelector('input[type=number]')
                if (input) {
                    input.value = response.quantity
                } else {
                    button.innerHTML = `
                        <div class="w-full p-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl">
                            <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                            <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none in-fa" readonly value="${response.quantity}">
                            <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                        </div>
                    `
                }
                if (response.quantity == response.count) {
                    button.children[0].children[0].disabled = true
                    button.children[0].children[0].classList.remove('cursor-pointer')
                    button.children[0].children[0].classList.add('cursor-no-drop')
                } else {
                    button.children[0].children[0].disabled = false
                    button.children[0].children[0].classList.remove('cursor-no-drop')
                    button.children[0].children[0].classList.add('cursor-pointer')
                }
            })


            let products = []
            if (localStorage.getItem('products')) {
                try {
                    products = JSON.parse(localStorage.getItem('products')) || []
                } catch (e) {
                    products = []
                }
            }

            let existing = products.find(pro => String(pro.id) === String(response.id))
            if (existing) {
                existing.quantity = (existing.quantity || 1) + 1
            } else {
                response.quantity = 1
                products.push(response)
            }
            localStorage.setItem('products', JSON.stringify(products))
            localProducts = products
        },
        error: function () {
            if (container.querySelector('button')) {
                container.querySelector('button').setAttribute('onclick', 'addToCart(this)')
                container.querySelector('button').innerHTML = `
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="lg:size-4 size-3 fill-(--primary-text-color) group-hover:fill-white transition-all duration-300">
                            <path d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z"></path>
                        </svg>
                    </div>
                    <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
                `
            }
            console.log('failed to load data')
        }
    })
}

function setCount(btn) {
    let container = btn.closest('.addToCartBtns')
    if (!container) return

    let productId = container.dataset.productId
    if (!productId) return

    localProducts = JSON.parse(localStorage.getItem('products')) || []

    let product = localProducts.find(p => String(p.id) === String(productId))
    if (!product) return

    let finalPrice = product.secondary_price ? product.secondary_price : product.primary_price

    if (btn.dataset.state === '+') {
        btn.parentElement.children[1].value++
        product.quantity++
        if (totalPriceEl) {
            let currentPrice = parseInt(totalPriceEl.innerText) || 0
            totalPriceEl.innerText = currentPrice + finalPrice
        }
    }

    if (btn.dataset.state === '-') {
        btn.parentElement.children[1].value--
        product.quantity--
        if (totalPriceEl) {
            let currentPrice = parseInt(totalPriceEl.innerText) || 0
            totalPriceEl.innerText = currentPrice - finalPrice
        }
    }

    if (product.quantity == product.count) {
        btn.disabled = true
        btn.classList.remove('cursor-pointer')
        btn.classList.add('cursor-no-drop')
    } else {
        btn.parentElement.children[0].disabled = false
        btn.parentElement.children[0].classList.remove('cursor-no-drop')
        btn.parentElement.children[0].classList.add('cursor-pointer')
    }

    document.querySelectorAll('.addToCartBtns').forEach(button => {
        if (button === container) return
        if (String(button.dataset.productId) !== String(productId)) return

        let input = button.querySelector('input[type=number]')
        if (input) {
            input.value = btn.parentElement.children[1].value
        }
    })

    localStorage.setItem('products', JSON.stringify(localProducts))

    if (btn.parentElement.children[1].value == 0) {
        if (orderBasket && orderBasket.children[1]) {
            orderBasket.children[1].innerText = Math.max(0, (parseInt(orderBasket.children[1].innerText) || 1) - 1)
        }

        localProducts = localProducts.filter(cart => String(cart.id) !== String(productId))
        localStorage.setItem('products', JSON.stringify(localProducts))

        if (!popupFlag) {
            let initialHtml = `
                <button onclick="addToCart(this)" class="w-full px-4 h-full bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 hover:bg-(--green-btn) group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="lg:size-4 size-3 fill-(--primary-text-color) transition-all duration-300 group-hover:fill-white">
                            <path d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
                </button>
            `

            document.querySelectorAll('.addToCartBtns').forEach(button => {
                if (String(button.dataset.productId) === String(productId)) {
                    button.innerHTML = initialHtml
                }
            })
            if(window.currentPage == 'cart'){
                document.querySelectorAll('.cartPages').forEach(item=>{
                    if(item.dataset.productId == productId){
                        item.remove()
                    }
                })
            }
        } else {
            let parentItem = btn.closest('.parentItem')
            if (parentItem) {
                parentItem.remove()
            }

            if (window.currentPage == 'cart') {
                document.querySelectorAll('.cartPages').forEach(item => {
                    if (item.dataset.productId == productId) {
                        item.remove()
                    }
                })
            }
            let initialHtml = `
                <button onclick="addToCart(this)" class="w-full px-4 h-full bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 hover:bg-(--green-btn) group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="lg:size-4 size-3 fill-(--primary-text-color) transition-all duration-300 group-hover:fill-white">
                            <path d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
                </button>
            `

            document.querySelectorAll('.addToCartBtns').forEach(button => {
                if (String(button.dataset.productId) === String(productId) && !button.closest('.parentItem')) {
                    button.innerHTML = initialHtml
                }
            })
        }
    }
}

function addPackToCart(btn) {
    let container = btn.closest('.addPackToCartBtn')
    if (!container) return

    let packId = container.dataset.packId
    if (!packId) return
    cartLink.classList.remove('hidden')

    btn.innerHTML = `<div class="w-5 h-5 border-2 border-white border-t-(--primary-text-color) rounded-full animate-spin"></div>`

    $.ajax({
        url: api + 'findPack/' + packId,
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (orderBasket && orderBasket.children[1]) {
                orderBasket.children[1].innerText = (parseInt(orderBasket.children[1].innerText) || 0) + 1
            }

            response.quantity = 1

            document.querySelectorAll('.addPackToCartBtn').forEach(button => {
                if (String(button.dataset.packId) !== String(packId)) return

                let input = button.querySelector('input[type=number]')
                if (input) {
                    input.value = response.quantity
                } else {
                    let innerBtn = button.querySelector('button')
                    if (innerBtn) {
                        innerBtn.removeAttribute('onclick')
                        innerBtn.innerHTML = `
                            <button onclick="setPackCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                            <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none in-fa" readonly value="${response.quantity}">
                            <button onclick="setPackCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                        `
                    }
                }
                if (response.quantity == response.count) {
                    button.children[0].children[0].disabled = true
                    button.children[0].children[0].classList.remove('cursor-pointer')
                    button.children[0].children[0].classList.add('cursor-no-drop')
                } else {
                    button.children[0].children[0].disabled = false
                    button.children[0].children[0].classList.remove('cursor-no-drop')
                    button.children[0].children[0].classList.add('cursor-pointer')
                }
            })

            let packs = []
            if (localStorage.getItem('packs')) {
                try {
                    packs = JSON.parse(localStorage.getItem('packs')) || []
                } catch (e) {
                    packs = []
                }
            }

            let existing = packs.find(pck => String(pck.id) === String(response.id))
            if (existing) {
                existing.quantity = (existing.quantity || 1) + 1
            } else {
                response.quantity = 1
                packs.push(response)
            }
            localStorage.setItem('packs', JSON.stringify(packs))
            localPacks = packs
        },
        error: function () {
            console.log('failed to load data')
        }
    })
}

function setPackCount(btn) {
    let container = btn.closest('.addPackToCartBtn')
    if (!container) return

    let packId = container.dataset.packId
    if (!packId) return

    localPacks = JSON.parse(localStorage.getItem('packs')) || []

    let pack = localPacks.find(p => String(p.id) === String(packId))
    if (!pack) return

    let finalPrice = pack.secondary_price ? pack.secondary_price : pack.primary_price

    if (btn.dataset.state === '+') {
        btn.parentElement.children[1].value++
        pack.quantity++
        if (totalPriceEl) {
            let currentPrice = parseInt(totalPriceEl.innerText) || 0
            totalPriceEl.innerText = currentPrice + finalPrice
        }
    }

    if (btn.dataset.state === '-') {
        btn.parentElement.children[1].value--
        pack.quantity--
        if (totalPriceEl) {
            let currentPrice = parseInt(totalPriceEl.innerText) || 0
            totalPriceEl.innerText = currentPrice - finalPrice
        }
    }

    if (product.quantity == product.count) {
        btn.disabled = true
        btn.classList.remove('cursor-pointer')
        btn.classList.add('cursor-no-drop')
    } else {
        btn.parentElement.children[0].disabled = false
        btn.parentElement.children[0].classList.remove('cursor-no-drop')
        btn.parentElement.children[0].classList.add('cursor-pointer')
    }

    document.querySelectorAll('.addPackToCartBtn').forEach(button => {
        if (button === container) return
        if (String(button.dataset.packId) !== String(packId)) return

        let input = button.querySelector('input[type=number]')
        if (input) {
            input.value = btn.parentElement.children[1].value
        }
    })

    localStorage.setItem('packs', JSON.stringify(localPacks))

    if (btn.parentElement.children[1].value == 0) {
        if (orderBasket && orderBasket.children[1]) {
            orderBasket.children[1].innerText = Math.max(0, (parseInt(orderBasket.children[1].innerText) || 1) - 1)
        }

        localPacks = localPacks.filter(cart => String(cart.id) !== String(packId))
        localStorage.setItem('packs', JSON.stringify(localPacks))

        let initialHtml = `
            <button onclick="addPackToCart(this)" class="w-full p-3 h-full bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 hover:bg-(--green-btn) group">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="lg:size-4 size-3 fill-(--primary-text-color) transition-all duration-300 group-hover:fill-white">
                        <path d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                        </path>
                    </svg>
                </div>
                <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
            </button>
        `

        if (!popupFlag) {
            document.querySelectorAll('.addPackToCartBtn').forEach(button => {
                if (String(button.dataset.packId) === String(packId)) {
                    button.innerHTML = initialHtml
                }
            })
        } else {
            let parentItem = btn.closest('.parentItem')
            if (parentItem && parentItem.parentElement) {
                parentItem.parentElement.remove()
            } else if (parentItem) {
                parentItem.remove()
            }

            document.querySelectorAll('.addPackToCartBtn').forEach(button => {
                if (String(button.dataset.packId) === String(packId)) {
                    button.innerHTML = initialHtml
                }
            })
        }
    }
}

if (orderBasket) {
    orderBasket.addEventListener('click', () => {
        let hasProducts = (() => {
            try {
                let p = JSON.parse(localStorage.getItem('products'))
                return p && p.length > 0
            } catch (e) { return false }
        })()

        let hasPacks = (() => {
            try {
                let p = JSON.parse(localStorage.getItem('packs'))
                return p && p.length > 0
            } catch (e) { return false }
        })()

        let popup = orderBasket.parentElement.children[1]
        let parentCart = orderBasket.parentElement.querySelector('.parentHeaderCarts')

        if (hasProducts || hasPacks) {
            if (popup.classList.contains('invisible')) {
                popupFlag = true
                popup.classList.remove('invisible')
                popup.classList.remove('opacity-0')

                if (parentCart) parentCart.innerHTML = ''

                localProducts = JSON.parse(localStorage.getItem('products')) || []
                if (localProducts.length) {
                    localProducts.forEach((prod) => {
                        let element = document.createElement('div')
                        element.classList = 'bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100 parentItem'
                        element.innerHTML = `
                            <div class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center text-2xl shrink-0">
                                <img src="${imgPath + prod.mainImg}" class="size-full object-cover" alt="">
                            </div>
                            <div class="flex-1 min-w-0 products">
                                <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">${prod.title}</h3>
                                <p class="text-xs text-gray-500 mt-0.5 mb-5 max-w-full h-8 max-h-8 overflow-hidden ellipsis-2">${prod.summary ? prod.summary : prod.description}</p>
                                <div class="w-full p-2 bg-(--light-green-btn) hover:bg-(--green-btn) transition-all duration-300 group flex gap-2 justify-center items-center rounded-xl addToCartBtns" data-product-id="${prod.id}">
                                    <button onclick="setCount(this)" class="w-1/3 text-lg font-bold text-(--primary-text-color) transition-all duration-300 group-hover:text-white flex justify-center items-center ${prod.count == prod.quantity ? 'cursor-no-drop' : 'cursor-pointer'}" ${prod.count == prod.quantity ? 'disabled' : ''} data-state="+">+</button>
                                    <input type="number" class="w-1/3 text-sm text-center outline-none text-(--primary-text-color) transition-all duration-300 group-hover:text-white in-fa" readonly value="${prod.quantity}">
                                    <button onclick="setCount(this)" class="w-1/3 text-lg font-bold text-(--primary-text-color) transition-all duration-300 group-hover:text-white flex justify-center items-center cursor-pointer" data-state="-">-</button>
                                </div>
                            </div>
                            <div class="text-left shrink-0">
                                <p class="font-bold text-gray-800 text-sm sm:text-base in-fa price">${prod.secondary_price ? prod.secondary_price : prod.primary_price}</p>
                                <p class="text-xs text-gray-400">تومان</p>
                            </div>
                        `
                        if (parentCart) parentCart.append(element)
                    })
                }

                localPacks = JSON.parse(localStorage.getItem('packs')) || []
                if (localPacks.length) {
                    localPacks.forEach((pack) => {
                        let element = document.createElement('div')
                        element.classList = 'bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100 parentItem'
                        element.innerHTML = `
                            <div class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center text-2xl shrink-0">
                                <img src="${imgPath + pack.image}" class="size-full object-cover" alt="">
                            </div>
                            <div class="flex-1 min-w-0 products">
                                <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">${pack.title}</h3>
                                <p class="text-xs text-gray-500 mt-0.5 mb-5 max-w-full h-8 max-h-8 overflow-hidden ellipsis-2">${pack.summary}</p>
                                <div class="w-full p-2 bg-(--light-green-btn) hover:bg-(--green-btn) transition-all duration-300 group flex gap-2 justify-center items-center rounded-xl addPackToCartBtn" data-pack-id="${pack.id}">
                                    <button onclick="setPackCount(this)" class="w-1/3 text-lg font-bold text-(--primary-text-color) transition-all duration-300 group-hover:text-white flex justify-center items-center ${pack.count == pack.quantity ? 'cursor-no-drop' : 'cursor-pointer'}" ${pack.count == pack.quantity ? 'disabled' : ''} data-state="+">+</button>
                                    <input type="number" class="w-1/3 text-sm text-center outline-none text-(--primary-text-color) transition-all duration-300 group-hover:text-white in-fa" readonly value="${pack.quantity}">
                                    <button onclick="setPackCount(this)" class="w-1/3 text-lg font-bold text-(--primary-text-color) transition-all duration-300 group-hover:text-white flex justify-center items-center cursor-pointer" data-state="-">-</button>
                                </div>
                            </div>
                            <div class="text-left shrink-0">
                                <p class="font-bold text-gray-800 text-sm sm:text-base in-fa price">${pack.secondary_price ? pack.secondary_price : pack.primary_price}</p>
                                <p class="text-xs text-gray-400">تومان</p>
                            </div>
                        `
                        if (parentCart) parentCart.append(element)
                    })
                }
            } else {
                popup.classList.add('invisible')
                popup.classList.add('opacity-0')
                popupFlag = false
            }
        } else {
            popup.classList.remove('invisible')
            popup.classList.remove('opacity-0')
            if (parentCart) {
                parentCart.innerHTML = `
                    <div class="w-full flex flex-col items-center justify-center gap-2 p-5 border border-gray-300 rounded-md cursor-pointer">
                        <h2 class="text-center lg:text-lg font-bold text-gray-400">سبد خرید خالی است</h2>
                        <svg class="w-[29px] h-[29px] text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                        </svg>
                    </div>
                `
                cartLink.classList.add('hidden')

            }
            popupFlag = true
        }
    })

    document.addEventListener('click', (e) => {
        let popup = orderBasket.parentElement.children[1]
        if (!orderBasket.contains(e.target) && !popup.contains(e.target)) {
            popupFlag = false
            popup.classList.add('invisible')
            popup.classList.add('opacity-0')
        }
    })
}