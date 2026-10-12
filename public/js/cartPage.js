
let totalBlock = document.getElementById('totalBlock')
let priceSum = 0;
orderBasket = document.getElementById('orderBasket')
localProducts = JSON.parse(localStorage.getItem('products'))
localPacks = JSON.parse(localStorage.getItem('packs'))
if (localStorage.getItem('products')) {
    totalBlock.classList.remove('hidden')
    document.addEventListener('click', (e) => {
        if (!orderBasket.contains(e.target) && !orderBasket.parentElement.children[1].contains(e.target)) {
            popupFlag = false
            orderBasket.parentElement.children[1].classList.add('invisible')
            orderBasket.parentElement.children[1].classList.add('opacity-0')
        }
    })
    localProducts.find(cart => {
        let parentDiv = document.createElement('div')
        parentDiv.classList = 'lg:col-span-2 space-y-3 products'
        parentDiv.dataset.productId = cart.id
        let html = ''
        html += `
            <div class="bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100 parentItem">
                <div
                    class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center text-2xl shrink-0">
                    <img src="${imgPath + cart.mainImg}" class="size-full object-cover" alt="">
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">${cart.title}</h3>
                    <p class="text-xs text-gray-500 mt-0.5 mb-5">${cart.summary}</p>
                    <div class="w-full lg:w-1/4 p-2 flex gap-2 justify-center items-center rounded-xl addToCartBtns" data-product-id="${cart.id}">
                        <button onclick="setCount(this)" class="w-1/3 text-lg font-bold text-white flex justify-center items-center cursor-pointer" data-state="+">+</button>
                        <input type="number" class="w-1/3 text-sm text-center outline-none text-white" readonly value="${cart.quantity}">
                        <button onclick="setCount(this)" class="w-1/3 text-lg font-bold text-white flex justify-center items-center cursor-pointer" data-state="-">-</button>
                    </div>
                </div>
                <div class="text-left shrink-0">
                    <p class="font-bold text-gray-800 text-sm sm:text-base in-fa price">${cart.secondary_price ? cart.secondary_price : cart.primary_price}</p>
                    <p class="text-xs text-gray-400">تومان</p>
                </div>
            </div>
        `
        parentDiv.innerHTML = html
        cartItemsBlock.append(parentDiv)
        if (cart.secondary_price) {
            let compare = cart.primary_price - cart.secondary_price
            totalBlock.querySelector('.discountBlock').classList.remove('hidden')
            totalBlock.querySelector('.discountBlock').classList.add('flex')
            totalBlock.querySelector('#discountEl').innerText = parseInt(totalBlock.querySelector('#discountEl').innerText) + parseInt(compare) + ' تومان '
            priceSum += cart.secondary_price * cart.quantity
        } else {
            priceSum += cart.primary_price * cart.quantity
        }
        totalBlock.querySelector('#totalPriceEl').innerText = priceSum
    })
}
if (localStorage.getItem('packs')) {
    totalBlock.classList.remove('hidden')
    document.addEventListener('click', (e) => {
        if (!orderBasket.contains(e.target) && !orderBasket.parentElement.children[1].contains(e.target)) {
            popupFlag = false
            orderBasket.parentElement.children[1].classList.add('invisible')
            orderBasket.parentElement.children[1].classList.add('opacity-0')
        }
    })
    localPacks.find(cart => {
        let parentDiv = document.createElement('div')
        parentDiv.classList = 'lg:col-span-2 space-y-3 products'
        parentDiv.dataset.packId = cart.id
        let html = ''
        html += `
            <div class="bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100 parentItem">
                <div
                    class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center text-2xl shrink-0">
                    <img src="${imgPath + cart.image}" class="size-full object-cover" alt="">
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">${cart.title}</h3>
                    <p class="text-xs text-gray-500 mt-0.5 mb-5">${cart.summary}</p>
                    <div class="w-full lg:w-1/4 p-2 flex gap-2 justify-center transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) items-center rounded-xl addPackToCartBtn" data-pack-id="${cart.id}">
                        <button onclick="setPackCount(this)" class="w-1/3 text-lg font-bold transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center cursor-pointer" data-state="+">+</button>
                        <input type="number" class="w-1/3 text-sm text-center outline-none transition-all duration-300 text-(--primary-text-color) group-hover:text-white in-fa" readonly value="${cart.quantity}">
                        <button onclick="setPackCount(this)" class="w-1/3 text-lg font-bold transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center cursor-pointer" data-state="-">-</button>
                    </div>
                </div>
                <div class="text-left shrink-0">
                    <p class="font-bold text-gray-800 text-sm sm:text-base in-fa price">${cart.secondary_price ? cart.secondary_price : cart.primary_price}</p>
                    <p class="text-xs text-gray-400">تومان</p>
                </div>
            </div>
        `
        parentDiv.innerHTML = html
        cartItemsBlock.append(parentDiv)
        if (cart.secondary_price) {
            let compare = cart.primary_price - cart.secondary_price
            totalBlock.querySelector('.discountBlock').classList.remove('hidden')
            totalBlock.querySelector('.discountBlock').classList.add('flex')
            totalBlock.querySelector('#discountEl').innerText = parseInt(totalBlock.querySelector('#discountEl').innerText) + parseInt(compare) + ' تومان '
            priceSum += cart.secondary_price * cart.quantity
        } else {
            priceSum += cart.primary_price * cart.quantity
        }
        totalBlock.querySelector('#totalPriceEl').innerText = priceSum
    })
}