let parentCheckout = document.getElementById('parentCheckout')
let totalPriceCheckout = document.getElementById('totalPriceCheckout')
let totalDiscountCheckout = document.getElementById('totalDiscountCheckout')
localCarts = JSON.parse(localStorage.getItem('products'))

let totalPrice = 0
localCarts.find(cart=>{
    let price = 0
    let discount = 0
    if(cart.secondary_price){
        price = cart.secondary_price*cart.quantity
        discount = (cart.primary_price - cart.secondary_price)*cart.quantity
    } else {
        price = cart.primary_price*cart.quantity
    }
    totalPrice = price + totalPrice
    let parent = document.createElement('div')
    parent.classList = 'flex justify-between p-3 border-b border-gray-200 text-sm'
    parent.innerHTML = `
        <span class="text-gray-600">${ cart.title } <span class="text-xs text-gray-400 mx-1">× ${ cart.quantity }</span></span>
        <span class="font-medium in-fa">${ price.toLocaleString('fa-IR') } تومان</span>
    `
    parentCheckout.append(parent)

    
    totalPriceCheckout.innerText = totalPrice.toLocaleString('fa-IR') + ' تومان'
    totalDiscountCheckout.innerText = discount.toLocaleString('fa-IR') + ' تومان'
})