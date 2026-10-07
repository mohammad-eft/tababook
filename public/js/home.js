let addToCartBtns = document.querySelectorAll('.addToCartBtns')
let cartProducts = JSON.parse(localStorage.getItem('products'))
let dropdownCart = document.getElementById('dropdownCart')
addToCartBtns.forEach(product=>{
    if(cartProducts){
        cartProducts.forEach(cartPro=>{
            if(cartPro.id == product.closest('.products').dataset.productId){
                product.classList = 'w-full px-4 h-full bg-(--peach-color) flex gap-2 justify-center items-center rounded-xl transition-all duration-300 hover:bg-(--pastel-pink) hover:text-white text-xs font-bold text-(--primary-text-color) cursor-pointer group'
                product.innerHTML = 'افزوده شد'
            }
        })
    }
})
if (cartProducts) {dropdownCart.children[1].innerText = cartProducts.length}