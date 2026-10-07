let addToCartBtns = document.querySelectorAll('.addToCartBtns')
let cartProducts = JSON.parse(localStorage.getItem('products'))
orderBasket = document.getElementById('orderBasket')
addToCartBtns.forEach(product=>{
    if(cartProducts){
        cartProducts.forEach(cartPro=>{
            if(cartPro.id == product.closest('.products').dataset.productId){
                orderBasket.children[1].innerText += 1
                product.innerHTML = `
                <div class="w-full px-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                    <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none" readonly value="${cartPro.quantity}">
                    <button onclick="setCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                </div>`
            }
        })
    }
})
if (cartProducts) {orderBasket.children[1].innerText = cartProducts.length}