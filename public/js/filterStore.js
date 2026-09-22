let categories = document.querySelectorAll('.categories')
let minPrice = document.getElementById('minPrice')
let maxPrice = document.getElementById('maxPrice')
let searchInput = document.getElementById('searchInput')
let hasDescount = document.getElementById('hasDescount')
let exists = document.getElementById('exists')

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
searchInput.addEventListener('keyup', ()=>{
    filters.keyword = searchInput.value
    console.log(searchInput.value)
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
function getFilters(){
    $.ajax({
        url: api + 'getFilters',
        type: "POST",
        dataType: "json",
        data: {
            'filters': filters
        },
        success: function (response) {
            console.log(response.filters)
            console.log(response.products)
        },
        error: function (xhr) {
            console.log('error:', xhr.responseText);
        }
    })
}