function addAttribute(el, state) {
    if (state == 'create') {
        let div = document.createElement('div');
        div.classList = 'flex flex-row items-center justify-between gap-4 mt-4 border border-slate-300 rounded-xl p-2'
        let parentElement = el.previousElementSibling
        div.innerHTML = `
                    <div class="w-full flex flex-col sm:flex-row items-center gap-4">
                        <input type="text"
                            class="w-full outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                            placeholder="ویژگی" name="attributes[attribute_key][]" required>
                        <input type="text"
                            class="w-full outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                            placeholder="مقدار ویژگی" name="attributes[attribute_value][]" required>
                    </div>
                    <button type="button"
                        class="p-3 text-sm rounded-md bg-rose-500 hover:bg-rose-600 text-white cursor-pointer"
                        onclick="remove(this)">حذف</button>
            `
        parentElement.appendChild(div)
    }
    if (state == 'edit') {
        let div = document.createElement('div');
        div.classList = 'flex flex-row items-center justify-between gap-4 mt-4 border border-slate-300 rounded-xl p-2'
        let parentElement = el.previousElementSibling
        div.innerHTML = `
                    <div class="w-full flex flex-col sm:flex-row items-center gap-4">
                        <input type="text"
                            class="w-full outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                            placeholder="ویژگی" name="attributes[newAttrs][attribute_key][]" required>
                        <input type="text"
                            class="w-full outline-none pr-3 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                            placeholder="مقدار ویژگی" name="attributes[newAttrs][attribute_value][]" required>
                    </div>
                    <button type="button"
                        class="p-3 text-sm rounded-md bg-rose-500 hover:bg-rose-600 text-white cursor-pointer"
                        onclick="remove(this)">حذف</button>
            `
        parentElement.appendChild(div)
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