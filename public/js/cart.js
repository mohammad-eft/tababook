let addToCartBtns = document.querySelectorAll('.addToCart')

addToCartBtns.forEach(btn=>{
    btn.addEventListener('click', ()=>{
        if(!flag){
            location.assign(url+'login')
        } else {
            $.ajax({
                url: api+'cart/store',
                type: "POST",
                dataType: "json",
                data: {
                    'product_id': btn.dataset.productId,
                    'quantity': 1
                },
                success: function(response){
                    console.log(response)
                    btn.parentElement.innerHTML = `
                    <div class="w-full p-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="${ response.product_id }">
                        <button class="w-1/3 text-white text-lg font-bold quantityBtn cursor-pointer" data-state="+">+</button>
                        <input type="number" class="w-1/3 text-white text-sm text-center outline-none" readonly value="${ response.quantity }">
                        <button class="w-1/3 text-white text-lg font-bold quantityBtn cursor-pointer" data-state="-">-</button>
                    </div>
                    `
                },
                error: function(){
                    console.log('error')
                }
            })
        }
    })
})