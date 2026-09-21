let categories = document.querySelectorAll('.categories')
let minPrice = document.getElementById('minPrice')
let maxPrice = document.getElementById('maxPrice')
categories.forEach(category=>{
    category.addEventListener('change', ()=>{
        filters.category = {}
        categories.forEach((cat, index)=>{
            if(cat.checked){
                filters.category[index]=cat.getAttribute('data-filter')
            }
        })
        $.ajax({
            url: api+'getFilters',
            type: "POST",
            dataType: "json",
            data: {
                'filters': filters
            },
            success: function(data){
                console.log(data)
            },
            error: function(){
                console.log('error')
            }
        })
    })
})