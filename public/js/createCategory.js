(function () {
    const addBtn = document.getElementById('add-attribute-btn');
    const list = document.getElementById('attributes-list');
    const template = document.getElementById('attribute-row-template');
    const countLabel = document.getElementById('attributes-count');

    // تبدیل عدد به فارسی
    function toFa(n) {
        return n.toString().replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);
    }

    // به‌روزرسانی شمارنده
    function updateCount() {
        const count = list.querySelectorAll('.attribute-row').length;
        countLabel.textContent = count === 0 ? 'بدون ویژگی' : `${toFa(count)} مورد`;
    }

    // افزودن ردیف جدید
    function addAttributeRow(focus = true) {
        const fragment = template.content.cloneNode(true);
        const row = fragment.querySelector('.attribute-row');
        const input = fragment.querySelector('input');
        const removeBtn = fragment.querySelector('.remove-attribute-btn');

        // حذف ردیف
        removeBtn.addEventListener('click', () => {
            row.style.transition = 'opacity .15s ease, transform .15s ease';
            row.style.opacity = '0';
            row.style.transform = 'translateY(-4px)';
            setTimeout(() => {
                row.remove();
                updateCount();
            }, 150);
        });

        // Enter → افزودن ردیف جدید
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                addAttributeRow(true);
            }
        });

        list.appendChild(row);
        updateCount();

        if (focus) {
            // بعد از رندر شدن، فوکوس کن
            requestAnimationFrame(() => input.focus());
        }
    }

    // کلیک روی دکمه افزودن
    addBtn.addEventListener('click', () => addAttributeRow(true));

    // مقدار اولیه
    updateCount();
})();