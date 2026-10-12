let parentCheckout = document.getElementById('parentCheckout')
let totalPriceCheckout = document.getElementById('totalPriceCheckout')
let totalDiscountCheckout = document.getElementById('totalDiscountCheckout')
let totalPrice = 0
let productsInput = document.getElementById('productsInput')
let packsInput = document.getElementById('packsInput')
localProducts = JSON.parse(localStorage.getItem('products'))
localPacks = JSON.parse(localStorage.getItem('packs'))
if(localStorage.getItem('products') && lcoalProducts.length){
    localProducts.find(cart=>{
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
            <span class="text-gray-600">${ cart.title } <span class="text-xs text-gray-400 mx-1 in-fa">× ${ cart.quantity }</span></span>
            <span class="font-medium in-fa">${ price.toLocaleString('fa-IR') } تومان</span>
        `
        parentCheckout.append(parent)
        totalPriceCheckout.innerText = totalPrice.toLocaleString('fa-IR') + ' تومان'
        totalDiscountCheckout.innerText = discount.toLocaleString('fa-IR') + ' تومان'
    })
    productsInput.value = localStorage.getItem('products')  
}
if(localStorage.getItem('packs') && localPacks.length){
    localPacks.find(cart=>{
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
            <span class="text-gray-600">${ cart.title } <span class="text-xs text-gray-400 mx-1 in-fa">× ${ cart.quantity }</span></span>
            <span class="font-medium in-fa">${ price.toLocaleString('fa-IR') } تومان</span>
        `
        parentCheckout.append(parent)
        totalPriceCheckout.innerText = totalPrice.toLocaleString('fa-IR') + ' تومان'
        totalDiscountCheckout.innerText = discount.toLocaleString('fa-IR') + ' تومان'
    })
    packsInput.value = localStorage.getItem('packs')
}
let province = document.getElementById('province')
let city = document.getElementById('city')
province.addEventListener('change', ()=>{
    $.ajax({
        url: api +'cities',
        type: "POST",
        dataType: "json",
        data: {
            'provinceId': province.value 
        },
        success: function(response){
            city.innerHTML = ""
            response.forEach(cityModel=>{
                let option = document.createElement('option')
                option.value = cityModel.id
                option.innerText = cityModel.title
                city.append(option)
            })
        },
        error: function(){
            console.log('failed to load data')
        }
    })
})
