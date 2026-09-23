
function addToCart(btn){
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
                btn.parentElement.innerHTML = `
                    <div class="w-full p-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="${response.product_id}">
                        <button onclick="setCount(this)" class="w-1/3 text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                        <input type="number" class="w-1/3 text-white text-sm text-center outline-none" readonly value="${response.quantity}">
                        <button onclick="setCount(this)" class="w-1/3 text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                    </div>
                    `
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
    btn.setAttribute('disabled', true)
    btn.innerHTML =
        `<div class="w-5 h-5 border-2 border-white border-t-(--primary-color) rounded-full animate-spin"></div>`

    if (btn.dataset.state == "+") {
        // if (flag) {
        //     document.getElementById('quantity') && document.getElementById('quantity').value++
        //     let plusPr = btn.parentElement.getAttribute('data-price')
        //     let pricee = document.getElementById('cartTotalPrice').innerText
        //     let newPrice = parseInt(pricee) + parseInt(plusPr)
        //     document.getElementById('cartTotalPrice').innerText = newPrice
        // }
        btn.parentElement.children[1].value++
        orderBasket.children[1].innerText++
    }
    if (btn.dataset.state == "-") {
        // if (flag) {
        //     document.getElementById('quantity') && document.getElementById('quantity').value--
        //     let minusPr = btn.parentElement.getAttribute('data-price')
        //     let pricee = document.getElementById('cartTotalPrice').innerText
        //     let newPrice = parseInt(pricee) - parseInt(minusPr)
        //     document.getElementById('cartTotalPrice').innerText = newPrice
        // }
        btn.parentElement.children[1].value--
        orderBasket.children[1].innerText--
    }
    if (btn.parentElement.children[1].value == 0) {
        // document.getElementById('cartTotalPrice').innerText = 0
        $.ajax({
            url: api + "cart/delete",
            type: "POST",
            dataType: "json",
            data: {
                'user_id': userId,
                'product_id': btn.parentElement.dataset.productId
            },
            success: function (data) {
                // message.children[0].innerHTML = ''
                if (orderBasket.children[1].innerText == 0) {
                    document.getElementById('cartEmpty').classList.remove('hidden');
                    document.getElementById('submitOrderBtn').disabled = true;
                    document.getElementById('cancelOrderBtn').disabled = true;
                    document.getElementById('cancelOrderBtn').classList.add('cursor-no-drop')
                }
                console.log(data)
                btn.parentElement.parentElement.innerHTML = `
                                <button onclick="addToCart(this)" class="w-full p-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="${data.data.product_id}">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                class="lg:size-4 size-3" fill="white">
                                                <path
                                                    d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                                    </button>`

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
                btn.removeAttribute('disabled')
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
                }
                if (btn.dataset.state == "-") {
                    btn.innerHTML = "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>-</button>"
                    if (!data.disabled) {

                        btn.parentElement.children[0].innerHTML =
                            "<button class='w-1/3 text-lg font-bold quantityBtn text-white cursor-pointer'>+</button>"
                        btn.parentElement.children[0].disabled = false
                    }
                }
                if (btn.parentElement.children[1].value == 0) {
                    btn.parentElement.parentElement.innerHTML = `
                                <button class="addToCart w-full p-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="${data.data.product_id}">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                class="lg:size-4 size-3" fill="white">
                                                <path
                                                    d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                                    </button>`
                }
            },
            error: function () {
                console.log('error')
            }
        })
    }
}
