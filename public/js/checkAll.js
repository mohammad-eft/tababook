let deleteAllBtn = document.getElementById('deleteAllBtn')
function checkAll(){
    let rows = document.querySelectorAll('.check')
    let all = document.getElementById('all')
    if (all.checked) {
        rows.forEach((row)=>{
            row.checked = true
        })
        deleteAllBtn.classList.remove('bg-slate-200', 'text-slate-400', 'cursor-not-allowed')
        deleteAllBtn.classList.add('bg-red-500', 'text-white', 'cursor-pointer')
        deleteAllBtn.children[0].classList.add('fill-red-400')
        deleteAllBtn.disabled = false
    }
    if (!all.checked) {
        rows.forEach((row)=>{
            row.checked = false
        })
        deleteAllBtn.classList.add('bg-slate-200', 'text-slate-400', 'cursor-not-allowed')
        deleteAllBtn.classList.remove('bg-red-500', 'text-white', 'cursor-pointer')
        deleteAllBtn.children[0].classList.remove('fill-red-400')
        deleteAllBtn.disabled = true
    }
}

let rows = document.querySelectorAll('.check')
let all = document.getElementById('all')
let checked = true
rows.forEach((row)=>{
    row.addEventListener('click', ()=>{
        if (!row.checked) {
            all.checked = false
            checked = false
            deleteAllBtn.classList.add('bg-slate-200', 'text-slate-400', 'cursor-not-allowed')
            deleteAllBtn.classList.remove('bg-red-500', 'text-white', 'cursor-pointer')
            deleteAllBtn.children[0].classList.remove('fill-red-400')
            deleteAllBtn.disabled = true
        } else {
            checked = true
            deleteAllBtn.classList.remove('bg-slate-200', 'text-slate-400', 'cursor-not-allowed')
            deleteAllBtn.classList.add('bg-red-500', 'text-white', 'cursor-pointer')
            deleteAllBtn.children[0].classList.add('fill-red-400')
            deleteAllBtn.disabled = false
        }
        rows.forEach((item)=>{
            if (!item.checked) {
                checked = false
            }
        })
        if (checked) {
            all.checked = true
        }
    })
})