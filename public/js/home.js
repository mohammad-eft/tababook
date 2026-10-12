let addToCartBtns = document.querySelectorAll('.addToCartBtns')
localProducts = JSON.parse(localStorage.getItem('products'))
localPacks = JSON.parse(localStorage.getItem('packs'))
orderBasket = document.getElementById('orderBasket')
addToCartBtns.forEach(product=>{
    if(localProducts){
        localProducts.forEach(cartPro=>{
            if(cartPro.id == product.closest('.products').dataset.productId){
                orderBasket.children[1].innerText += 1
                product.innerHTML = `
                <div class="w-full p-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                    <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none in-fa" readonly value="${cartPro.quantity}">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                </div>`
            }
        })
    }
    if(localPacks){
        localPacks.forEach(cartPro=>{
            if(cartPro.id == product.closest('.products').dataset.productId){
                orderBasket.children[1].innerText += 1
                product.innerHTML = `
                <div class="w-full p-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                    <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none in-fa" readonly value="${cartPro.quantity}">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                </div>`
            }
        })
    }
})
if (localProducts) {orderBasket.children[1].innerText = localProducts.length}
if (localPacks) {orderBasket.children[1].innerText = localPacks.length}