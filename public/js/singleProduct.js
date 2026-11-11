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

document.querySelectorAll('.gallery').forEach(item=>{
    item.addEventListener('click', ()=>{
        document.querySelector('#mainImage').src = item.querySelector('img').src
    })
})

let allVariants = document.querySelectorAll('.variants')
// ============================================================
let priceBox = document.getElementById('priceBox')
// abolished
// percent
// mainPrice
let footerPrice = document.getElementById('footer-price')
// abolished
// mainPrice

allVariants.forEach(variant=>{
    variant.addEventListener('click', ()=>{
        allVariants.forEach(vari=>{
            vari.classList.remove('ring-4', 'ring-offset-2', 'ring-blue-500')
            vari.classList.add('ring-1', 'ring-offset-5', 'ring-gray-300')
            vari.innerHTML = ""
        })
        variant.classList.remove('ring-1', 'ring-offset-5', 'ring-gray-300')
        variant.classList.add('ring-4', 'ring-offset-2', 'ring-blue-500')
        variant.innerHTML = `<svg class="size-5 text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                            </svg>`
        if (variant.dataset.secondaryPrice) {
            priceBox.classList.remove('hidden')
            priceBox.classList.add('flex')
            let abolishedPrice = variant.dataset.primaryPrice
            let mainPrice = variant.dataset.secondaryPrice
            let discountPercent = Math.round((1 - parseInt(variant.dataset.secondary_price) / parseInt(variant.dataset.primary_price)) * 100)
            priceBox.querySelector('.abolished').innerText = parseInt(abolishedPrice).toLocaleString('fa-IR')
            priceBox.querySelector('.mainPrice').innerText = parseInt(mainPrice).toLocaleString('fa-IR')
            priceBox.querySelector('.percent').innerText = parseInt(discountPercent).toLocaleString('fa-IR')+' %'
            footerPrice.querySelector('.abolished').classList.remove('hidden')
            footerPrice.querySelector('.abolished').classList.add('flex')
            footerPrice.querySelector('.abolished').innerText = parseInt(abolishedPrice).toLocaleString('fa-IR')
            footerPrice.querySelector('.mainPrice').innerText = parseInt(mainPrice).toLocaleString('fa-IR')
        } else {
            let price = variant.dataset.primaryPrice
            priceBox.querySelector('.mainPrice').innerText = parseInt(price).toLocaleString('fa-IR')
            footerPrice.querySelector('.mainPrice').innerText = parseInt(price).toLocaleString('fa-IR')
        }
    })
})