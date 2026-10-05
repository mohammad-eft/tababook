
let totalPriceEl = document.getElementById('totalPriceEl')
function addToCart(btn){
    btn.innerHTML = `<div class="w-5 h-5 border-2 border-white border-t-(--primary-text-color) rounded-full animate-spin"></div>`
    console.log(btn)
    if (!flag) {
        location.assign(url + 'login')
    } else {
        $.ajax({
            url: api + 'cart/store',
            type: "POST",
            dataType: "json",
            data: {
                'product_id': btn.dataset.productId,
                'quantity': 1,
                'user_id': userId
            },
            success: function (response) {
                console.log(response)
                orderBasket.children[1].innerText += 1
                btn.parentElement.innerHTML = `
                    <div class="w-full px-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl" data-product-id="${response.product_id}">
                        <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                        <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none" readonly value="${response.quantity}">
                        <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                    </div>
                    `
            },
            error: function () {
                console.log('error')
            }
        })
    }
}
function addPackToCart(btn){
    btn.innerHTML = `<div class="w-5 h-5 border-2 border-white border-t-(--primary-text-color) rounded-full animate-spin"></div>`
    console.log(btn)
    if (!flag) {
        location.assign(url + 'login')
    } else {
        $.ajax({
            url: api + 'cart/pack/store',
            type: "POST",
            dataType: "json",
            data: {
                'packId': btn.dataset.packId,
                'quantity': 1,
                'userId': userId
            },
            success: function (response) {
                console.log(response)
                orderBasket.children[1].innerText += 1
                btn.parentElement.innerHTML = `
                <div class="w-full px-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl py-2.5" data-pack-id="${response.pack_id}">
                    <button onclick="setPackCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                    <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none" readonly value="${response.quantity}">
                    <button onclick="setPackCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                </div>`
            },
            error: function () {
                console.log('error')
            }
        })
    }
}
function setCount(btn){
    product_id = btn.parentElement.dataset.productId
    btn.parentElement.parentElement.removeAttribute('onclick')
    btn.disabled = true
    btn.innerHTML =`<div class="w-5 h-5 border-2 border-white border-t-(--primary-text-color) rounded-full animate-spin"></div>`

    if (btn.dataset.state == "+") {
        btn.parentElement.children[1].value++
        orderBasket.children[1].innerText++
    }
    if (btn.dataset.state == "-") {
        btn.parentElement.children[1].value--
        orderBasket.children[1].innerText--
    }
    if (btn.parentElement.children[1].value == 0) {
        $.ajax({
            url: api + "cart/delete",
            type: "POST",
            dataType: "json",
            data: {
                'user_id': userId,
                'product_id': btn.parentElement.dataset.productId
            },
            success: function (data) {
                console.log(data)
                if(routeIsCart){
                    btn.closest('.parentItem').remove()
                } else {
                    btn.parentElement.parentElement.innerHTML = `
                    <button onclick="addToCart(this)" class="w-full px-2 h-12 transition-all duration-300 hover:bg-(--green-btn) cursor-pointer group bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl" data-product-id="${data.data.product_id}">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                class="lg:size-4 size-3 fill-(--primary-text-color) transition-all duration-300 group-hover:fill-white">
                                <path
                                    d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
                    </button>`
                }
                if (totalPriceEl) {
                    if (data.data.product.secondary_price) {
                        totalPriceEl.innerText = parseInt(totalPriceEl.innerText) - parseInt(data.data.product.secondary_price)
                    } else {
                        totalPriceEl.innerText = parseInt(totalPriceEl.innerText) - parseInt(data.data.product.primary_price)
                    }
                }
            },
            error: function () {
                console.log('error')
            }
        })
    } else {
        $.ajax({
            url: api + 'cart/update',
            type: "POST",
            dataType: "json",
            data: {
                'product_id': btn.parentElement.dataset.productId,
                'quantity': btn.parentElement.children[1].value,
                'user_id': userId
            },
            success: function (data) {
                console.log(data)
                btn.disabled = false
                let currentQuantity = data.quantity || 0
                btn.parentElement.children[1].value = currentQuantity
                if (btn.dataset.state == "+") {
                    btn.innerHTML = "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>+</bu>"
                    if (data.disabled) {

                        btn.innerHTML = "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>+</button>"
                        btn.disabled = true
                    }
                    btn.parentElement.children[2].innerHTML =
                        "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>-</button>"
                    if(totalPriceEl){
                        if (data.product.secondary_price) {
                            totalPriceEl.innerText = parseInt(totalPriceEl.innerText) + parseInt(data.product.secondary_price)
                        } else {
                            totalPriceEl.innerText = parseInt(totalPriceEl.innerText) + parseInt(data.product.primary_price)
                        }
                    }
                }
                if (btn.dataset.state == "-") {
                    btn.innerHTML = "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>-</button>"
                    if (!data.disabled) {

                        btn.parentElement.children[0].innerHTML =
                            "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>+</button>"
                        btn.parentElement.children[0].disabled = false
                    }
                    if(totalPriceEl){
                        if (data.product.secondary_price) {
                            totalPriceEl.innerText = parseInt(totalPriceEl.innerText) - parseInt(data.product.secondary_price)
                        } else {
                            totalPriceEl.innerText = parseInt(totalPriceEl.innerText) - parseInt(data.product.primary_price)
                        }
                    }
                }
                if (btn.closest('.parentItem') && btn.closest('.parentItem').querySelector('.price')) {
                    if (data.product.secondary_price) {
                        btn.closest('.parentItem').querySelector('.price').innerText = data.product.secondary_price * data.quantity
                    }
                    if (!data.product.secondary_price) {
                        btn.closest('.parentItem').querySelector('.price').innerText = data.product.primary_price * data.quantity
                    }
                }
                if (btn.parentElement.children[1].value == 0) {
                    btn.parentElement.parentElement.innerHTML = `
                    <button onclick="addToCart(this)" class="w-full px-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl" data-product-id="${data.data.product_id}">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                class="lg:size-4 size-3 fill-(--primary-text-color) transition-all duration-300 group-hover:fill-white">
                                <path
                                    d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
                    </button>`
                }
            },
            error: function () {
                console.log('error')
            }
        })
    }
}
function setPackCount(btn){
    packId = btn.parentElement.dataset.packId
    btn.parentElement.parentElement.removeAttribute('onclick')
    btn.disabled = true
    btn.innerHTML =`<div class="w-5 h-5 border-2 border-white border-t-(--primary-text-color) rounded-full animate-spin"></div>`

    if (btn.dataset.state == "+") {
       
        btn.parentElement.children[1].value++
        orderBasket.children[1].innerText++
    }
    if (btn.dataset.state == "-") {
       
        btn.parentElement.children[1].value--
        orderBasket.children[1].innerText--
    }
    if (btn.parentElement.children[1].value == 0) {
      
        $.ajax({
            url: api + "cart/pack/delete",
            type: "POST",
            dataType: "json",
            data: {
                'userId': userId,
                'packId': btn.parentElement.dataset.packId
            },
            success: function (data) {
                if (routeIsCart) {
                    btn.closest('.parentItem').remove()
                } else {
                    btn.parentElement.parentElement.innerHTML = `
                    <button onclick="addPackToCart(this)" class="w-full px-2 h-12 transition-all duration-300 hover:bg-(--green-btn) cursor-pointer group bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl" data-pack-id="${data.data.pack_id}">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                class="lg:size-4 size-3 fill-(--primary-text-color) transition-all duration-300 group-hover:fill-white">
                                <path
                                    d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
                    </button>`
                }
                if (totalPriceEl) {
                    if (data.data.pack.secondary_price) {
                        totalPriceEl.innerText = parseInt(totalPriceEl.innerText) - parseInt(data.data.pack.secondary_price)
                    } else {
                        totalPriceEl.innerText = parseInt(totalPriceEl.innerText) - parseInt(data.data.pack.primary_price)
                    }
                }
            },
            error: function () {
                console.log('error')
            }
        })
    } else {
        $.ajax({
            url: api + 'cart/pack/update',
            type: "POST",
            dataType: "json",
            data: {
                'packId': btn.parentElement.dataset.packId,
                'quantity': btn.parentElement.children[1].value,
                'userId': userId
            },
            success: function (data) {
                console.log(data)
                btn.disabled = false
                let currentQuantity = data.quantity || 0
                btn.parentElement.children[1].value = currentQuantity
                if (btn.dataset.state == "+") {
                    btn.innerHTML = "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>+</bu>"
                    if (data.disabled) {

                        btn.innerHTML = "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>+</button>"
                        btn.disabled = true
                    }
                    btn.parentElement.children[2].innerHTML =
                        "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>-</button>"
                    if(totalPriceEl){
                        if(data.pack.secondary_price){
                            totalPriceEl.innerText = parseInt(totalPriceEl.innerText) + parseInt(data.pack.secondary_price)
                        } else {
                            totalPriceEl.innerText = parseInt(totalPriceEl.innerText) + parseInt(data.pack.primary_price)
                        }
                    }
                }
                if (btn.dataset.state == "-") {
                    btn.innerHTML = "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>-</button>"
                    if (!data.disabled) {

                        btn.parentElement.children[0].innerHTML =
                            "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>+</button>"
                        btn.parentElement.children[0].disabled = false
                    }
                    if(totalPriceEl){
                        if (data.pack.secondary_price) {
                            totalPriceEl.innerText = parseInt(totalPriceEl.innerText) - parseInt(data.pack.secondary_price)
                        } else {
                            totalPriceEl.innerText = parseInt(totalPriceEl.innerText) - parseInt(data.pack.primary_price)
                        }
                    }
                }
                if (btn.closest('.parentItem') && btn.closest('.parentItem').querySelector('.price')) {
                    if (data.pack.secondary_price) {
                        btn.closest('.parentItem').querySelector('.price').innerText = data.pack.secondary_price * data.quantity
                    }
                    if (!data.pack.secondary_price) {
                        btn.closest('.parentItem').querySelector('.price').innerText = data.pack.primary_price * data.quantity
                    }
                }
                if (btn.parentElement.children[1].value == 0) {
                    btn.parentElement.parentElement.innerHTML = `
                                <button onclick="addPackToCart(this)" class="w-full px-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl" data-pack-id="${data.data.pack_id}">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                class="lg:size-4 size-3 fill-(--primary-text-color) transition-all duration-300 group-hover:fill-white">
                                                <path
                                                    d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
                                    </button>`
                }
            },
            error: function () {
                console.log('error')
            }
        })
    }
}
