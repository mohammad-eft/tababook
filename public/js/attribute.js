let categoryIds = document.getElementById('category_ids')
function addAttribute(el, state) {
    let attFlag = false
    // categoryIds.children.forEach(opt=>{
    // if(opt.selected){
    //     attFlag = true
    // }
    // })
    for (let opt of categoryIds.children) {
        if (opt.selected) {
            attFlag = true
        }
    }
    if (attFlag) {
        if (state == 'create' || state == 'edit') {
            const prefix = state == 'edit' ? 'attributes[newAttrs]' : 'attributes';
            let div = document.createElement('div');
            div.classList = 'flex flex-row items-center justify-between gap-4 mt-4 border border-slate-300 rounded-xl p-2';
            // let parentElement = state == 'edit' ? el.previousElementSibling : el.parentElement.previousElementSibling;
            let parentElement = state == 'edit' ? el.parentElement.querySelector('#parentAtt') : el.parentElement.querySelector('#parentAtt')

            div.innerHTML = `
                <div class="w-full flex flex-col sm:flex-row items-center gap-4">
                    <input type="text"
                        class="w-full outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                        placeholder="ویژگی" name="${prefix}[attribute_key][]" required>
                    <input type="text"
                        class="w-full outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                        placeholder="مقدار ویژگی" name="${prefix}[attribute_value][]" required>
                </div>
                <button type="button"
                    class="p-3 text-sm rounded-md bg-rose-500 hover:bg-rose-600 text-white cursor-pointer"
                    onclick="remove(this)">حذف</button>
            `;
            parentElement.appendChild(div);
            console.log(parentElement)
        }
    } else {
        alert('حداقل یک دسته انتخاب کنید')
    }
}
function remove(el, id) {
    if (id) {
        let editForm = document.getElementById('editForm')
        let input = document.createElement('input')
        input.setAttribute('type', 'hidden')
        input.setAttribute('name', 'removedAttrs[]')
        input.setAttribute('value', id)
        editForm.appendChild(input)
    }
    el.parentElement.remove()
}

let count = document.getElementById('count')
function calculate(state) {
    if (state == "+") {
        count.value++
    }
    if (count.value > 1) {
        if (state == "-") {
            count.value--
        }
    }
}

function addColor(el) {
    let div = document.createElement('div');
    div.classList = 'flex flex-row items-center justify-between gap-4 mt-4 border border-slate-300 rounded-xl p-2';
    let parentElement = el.parentElement.querySelector('#parentAtt')
    // یا اگر دکمه مستقیم بود: el.previousElementSibling

    div.innerHTML = `
        <div class="w-full flex flex-col sm:flex-row items-center gap-4">
            <input type="text"
                class="hidden"
                name="attributes[attribute_key][]"
                value="color">
            
                <div class="w-full flex items-center gap-3">
                <input type="text"
                    class="flex-1 outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                    placeholder="انتخاب رنگ"
                    name="color_names[]" disabled
                    oninput="this.previousElementSibling.nextElementSibling.value = this.value">
                <input type="color"
                    class="w-14 h-12 rounded-xl border border-slate-300 cursor-pointer bg-white p-1"
                    name="attributes[attribute_value][]"
                    value="#000000"
                    title="انتخاب رنگ">
            </div>
        </div>
        <button type="button"
            class="p-3 text-sm rounded-md bg-rose-500 hover:bg-rose-600 text-white cursor-pointer"
            onclick="remove(this)">حذف</button>
    `;
    parentElement.appendChild(div);
}

// categoryIds.addEventListener('change', () => {
//     document.querySelector('#parentAtt').innerHTML = ''
// })