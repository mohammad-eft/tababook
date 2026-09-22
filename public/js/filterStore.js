// let categories = document.querySelectorAll('.categories')
// let minPrice = document.getElementById('minPrice')
// let maxPrice = document.getElementById('maxPrice')
// categories.forEach(category=>{
//     category.addEventListener('change', ()=>{
//         filters.category = {}
//         categories.forEach((cat, index)=>{
//             if(cat.checked){
//                 filters.category[index]=cat.getAttribute('data-filter')
//             }
//         })
//         $.ajax({
//             url: api+'getFilters',
//             type: "POST",
//             dataType: "json",
//             data: {
//                 'filters': filters
//             },
//             success: function(data){
//                 console.log(data)
//             },
//             error: function(){
//                 console.log('error')
//             }
//         })
//     })
// })

let categories = document.querySelectorAll('.categories');
let minPrice = document.getElementById('minPrice');
let maxPrice = document.getElementById('maxPrice');

// اطمینان از اینکه filters همیشه یه آبجکت هست
window.filters = window.filters || {};

categories.forEach(category => {
    category.addEventListener('change', () => {

        // ساخت آبجکت دسته‌بندی از چک‌باکس‌های انتخاب‌شده
        let categoryObj = {};
        let hasAny = false;

        categories.forEach((cat, index) => {
            if (cat.checked) {
                hasAny = true;
                // از data-filter استفاده می‌کنیم (id واقعی دسته)
                categoryObj[index] = cat.getAttribute('data-filter');
            }
        });

        // اگه چیزی چک شده بود، بذار؛ وگرنه کلاً حذفش کن
        if (hasAny) {
            filters.category = categoryObj;
        } else {
            delete filters.category;
        }

        // لاگ برای دیباگ
        // console.log('filters being sent:', JSON.stringify(filters));
        // console.log(filters)

        $.ajax({
            url: api + 'getFilters',
            type: "POST",
            dataType: "json",
            data: {
                filters: filters
            },
            success: function (data) {
                console.log(data.filters)
                console.log(data.results.products)
                console.log(data.results.categories)
               
            },
            error: function (xhr) {
                console.log('error:', xhr.responseText);
            }
        });
    });
});