localPacks = JSON.parse(localStorage.getItem('packs'))
addPackToCartBtn = document.querySelector('.addPackToCartBtn')
if(localStorage.getItem('packs') && localPacks.length){
    localPacks.find(cartItem => {
        if (cartItem.id == packId) {
            addPackToCartBtn.innerHTML = `
            <div class="w-full p-2 h-full transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl" data-pack-id="${packId}">
                <button onclick="setPackCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                <input type="number" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white text-sm text-center outline-none in-fa" readonly value="${cartItem.quantity}">
                <button onclick="setPackCount(this)" class="w-1/3 transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
            </div>
            `
        }
    })
}