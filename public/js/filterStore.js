let categories = document.querySelectorAll('.categories')
let minPrice = document.getElementById('minPrice')
let maxPrice = document.getElementById('maxPrice')
let searchInput = document.getElementById('searchInput')
let hasDescount = document.getElementById('hasDescount')
let exists = document.getElementById('exists')
let searchButton = document.getElementById('searchButton')
let sortBtn = document.querySelectorAll('.sort-btn')
let productsElement = document.getElementById('products')

function getFilters() {
    $.ajax({
        url: api + 'getFilters',
        type: "POST",
        dataType: "json",
        data: {
            'filters': filters
        },
        success: function (products) {
            productsElement.innerHTML = ''
            products.forEach(product=>{
                let link = document.createElement('a')
                link.href = url+'product/show/'+product.id
                link.classList = 'group relative min-w-0 bg-white p-[17px] border-l border-b border-[#e4e4e7] transition duration-200 hover:-translate-y-0.5 hover:shadow-[0_6px_22px_rgba(0,0,0,.08)]'
                let elements = ``
                if (product.percent){
                    elements += `<span class="absolute top-[25px] right-[25px] z-10 bg-[#ef394e] text-white rounded-[5px] text-[10px] px-[7px] py-1 in-fa">${ product.percent } %</span>`
                }
                elements += `
                    <button
                        class="absolute top-[22px] left-5 z-10 border-0 bg-white text-xl text-[#aaa]">♡</button>
                    <img src="${imgPath+product.image}"
                        alt="${ product.title }" loading="lazy"
                        class="w-full aspect-square object-contain rounded-lg bg-[#f8f8f8] block mb-3.5">
                    <h3 class="m-0 mb-2.5 text-[13px] leading-[1.9] h-[50px] overflow-hidden">${ product.title }</h3>
                    <div class="flex justify-between items-center mb-2.5 text-[11px]">
                        <span>۴٫۹ ⭐</span><span class="text-[#f59e0b]">★★★★★</span>
                    </div>`
                if (product.secondary_price){

                    elements+=`
                        <div class="flex items-center justify-between gap-2">
                            <strong class="text-[15px] in-fa">${ product.secondary_price }</strong>
                            <span
                                class="text-[10px] text-[#71717a]">تومان
                            </span>
                        </div>
                        <div class="line-through text-[#a1a1aa] text-[10px] in-fa">${ product.primary_price } تومان</div>
                    `
                } else {
                    elements += `
                    <div class= "flex items-center justify-between gap-2" >
                        <strong class="text-[15px] in-fa">${ product.primary_price }</strong>
                        <span
                            class="text-[10px] text-[#71717a]">تومان
                        </span>
                    </div>`
                }
                if (product.count > 0){
                    elements += `<div class="mt-2.5 text-[10px] text-[#16a34a]">● موجود در انبار</div>`
                } else {
                    elements += `<div class= "mt-2.5 text-[10px] text-[#a31616]" >● ناموجود</div>`
                }
                link.innerHTML = elements
                productsElement.append(link)
            })
        },
        error: function (xhr) {
            console.log('error:', xhr.responseText);
        }
    })
}

window.filters = window.filters || {}
categories.forEach(category => {
    category.addEventListener('change', () => {
        let categoryObj = {}
        let hasAny = false
        categories.forEach((cat, index) => {
            if (cat.checked) {
                hasAny = true
                categoryObj[index] = cat.getAttribute('data-filter')
            }
        })
        if (hasAny) {
            filters.category = categoryObj
        } else {
            delete filters.category
        }
        getFilters()
    })
})

minPrice.addEventListener('keyup', ()=>{
    filters.fromPrice = minPrice.value
    getFilters()
})
maxPrice.addEventListener('keyup', ()=>{
    filters.toPrice = maxPrice.value
    getFilters()
})
searchButton.addEventListener('click', ()=>{
    filters.keyword = searchInput.value
    getFilters()
})
hasDescount.addEventListener('change', ()=>{
    hasDescount.checked ? filters.hasDescount = 1 : filters.hasDescount = 0
    getFilters()
})
exists.addEventListener('change', ()=>{
    exists.checked ? filters.exists = 1 : filters.exists = 0
    getFilters()
})

sortBtn.forEach(btn=>{
    btn.addEventListener('click', ()=>{
        sortBtn.forEach(button=>{
            button.classList.remove('font-bold')
            button.classList.remove('text-[#ef394e]')
            button.classList.add('text-[#52525b]')
        })
        btn.classList.remove('text-[#52525b]')
        btn.classList.add('font-bold')
        btn.classList.add('text-[#ef394e]')
        filters.sortBy = btn.dataset.sortBy
        filters.sortType = btn.dataset.sortType
        getFilters()
    })
})