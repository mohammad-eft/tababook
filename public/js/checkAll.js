function checkAll(){
    let rows = document.querySelectorAll('.check')
    let all = document.getElementById('all')
    if (all.checked) {
        rows.forEach((row)=>{
            row.checked = true
        })
    }
    if (!all.checked) {
        rows.forEach((row)=>{
            row.checked = false
        })
    }
}

let rows = document.querySelectorAll('.check')
let all = document.getElementById('all')
let flag = true
rows.forEach((row)=>{
    row.addEventListener('click', ()=>{
        if (!row.checked) {
            all.checked = false
            flag = false
        }
        rows.forEach((item)=>{
            if (!item.checked) {
                flag = false
            }
        })
        if (flag) {
            all.checked = true
        }
    })
})