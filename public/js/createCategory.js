// (function () {
//     const addBtn = document.getElementById('add-attribute-btn');
//     const list = document.getElementById('attributes-list');
//     const template = document.getElementById('attribute-row-template');
//     const countLabel = document.getElementById('attributes-count');

//     // تبدیل عدد به فارسی
//     function toFa(n) {
//         return n.toString().replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);
//     }

//     // به‌روزرسانی شمارنده
//     function updateCount() {
//         const count = list.querySelectorAll('.attribute-row').length;
//         countLabel.textContent = count === 0 ? 'بدون ویژگی' : `${toFa(count)} مورد`;
//     }

//     // افزودن ردیف جدید
//     function addAttributeRow(focus = true) {
//         const fragment = template.content.cloneNode(true);
//         const row = fragment.querySelector('.attribute-row');
//         const input = fragment.querySelector('input');
//         const removeBtn = fragment.querySelector('.remove-attribute-btn');

//         // حذف ردیف
//         removeBtn.addEventListener('click', () => {
//             row.style.transition = 'opacity .15s ease, transform .15s ease';
//             row.style.opacity = '0';
//             row.style.transform = 'translateY(-4px)';
//             setTimeout(() => {
//                 row.remove();
//                 updateCount();
//             }, 150);
//         });

//         // Enter → افزودن ردیف جدید
//         input.addEventListener('keydown', (e) => {
//             if (e.key === 'Enter') {
//                 e.preventDefault();
//                 addAttributeRow(true);
//             }
//         });

//         list.appendChild(row);
//         updateCount();

//         if (focus) {
//             // بعد از رندر شدن، فوکوس کن
//             requestAnimationFrame(() => input.focus());
//         }
//     }

//     // کلیک روی دکمه افزودن
//     addBtn.addEventListener('click', () => addAttributeRow(true));

//     // مقدار اولیه
//     updateCount();
// })();

(function () {
    const list = document.getElementById('attributes-list');
    const count = document.getElementById('attributes-count');
    const tmpl = document.getElementById('attribute-row-template');
    const toFa = n => n.toString().replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);

    // اسم فیلدها رو دوباره ایندکس می‌کنه: attributes[0][key], attributes[0][type], ...
    function refresh() {
        const rows = list.querySelectorAll('.attribute-row');
        rows.forEach((row, i) => {
            row.querySelectorAll('[data-field]').forEach(el => {
                el.name = `attributes[${i}][${el.dataset.field}]`;
            });
        });
        count.textContent = toFa(rows.length) + ' مورد';
    }

    function addRow(data = {}) {
        const row = tmpl.content.firstElementChild.cloneNode(true);
        row.querySelector('[data-field="id"]').value = data.id ?? '';
        row.querySelector('[data-field="key"]').value = data.key ?? '';
        // row.querySelector('[data-field="type"]').value = data.type ?? 'text';
        row.querySelector('.remove-attribute-btn').addEventListener('click', () => {
            row.remove();
            refresh();
        });
        list.appendChild(row);
        refresh();
        return row;
    }

    document.getElementById('add-attribute-btn').addEventListener('click', () => {
        addRow().querySelector('[data-field="key"]').focus();
    });

    // بعد از خطای ولیدیشن، ردیف‌هایی که کاربر پر کرده بود برمی‌گردن
    (window.OLD_ATTRS || []).forEach(a => addRow(a));
})();
