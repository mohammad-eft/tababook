let subCats = document.querySelectorAll('.subCats')
subCats.forEach((item)=>{
    item.addEventListener('click', ()=>{
        if (item.nextElementSibling.classList.contains('max-h-0')) {
            subCats.forEach((element)=>{
                element.nextElementSibling.classList.remove('max-h-100')
                element.nextElementSibling.classList.add('max-h-0')
                element.nextElementSibling.classList.add('opacity-0')
                element.nextElementSibling.classList.add('invisible')
            })
            item.nextElementSibling.classList.remove('max-h-0')
            item.nextElementSibling.classList.remove('opacity-0')
            item.nextElementSibling.classList.remove('invisible')
            item.nextElementSibling.classList.add('max-h-100')
        } else {
            item.nextElementSibling.classList.remove('max-h-100')
            item.nextElementSibling.classList.add('max-h-0')
            item.nextElementSibling.classList.add('opacity-0')
            item.nextElementSibling.classList.add('invisible')
        }
    })
})