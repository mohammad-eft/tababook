(() => {
    const form = document.getElementById('checkoutForm') || document.querySelector('form');
    const parentCheckout = document.getElementById('parentCheckout');
    const totalPriceCheckout = document.getElementById('totalPriceCheckout');
    const totalDiscountCheckout = document.getElementById('totalDiscountCheckout');
    const productsInput = document.getElementById('productsInput');
    const packsInput = document.getElementById('packsInput');

    if (!form || !parentCheckout || !productsInput || !packsInput) return;

    const readArray = (key) => {
        try {
            const value = JSON.parse(localStorage.getItem(key) || '[]');
            return Array.isArray(value) ? value : [];
        } catch (error) {
            return [];
        }
    };

    const number = (value) => {
        const parsed = Number(value);
        return Number.isFinite(parsed) ? parsed : 0;
    };

    const formatPrice = (value) => number(value).toLocaleString('fa-IR');

    const getUnitPrice = (item) => {
        const special = number(item.secondary_price);
        return special > 0 ? special : number(item.primary_price);
    };

    const getUnitDiscount = (item) => {
        const special = number(item.secondary_price);
        const primary = number(item.primary_price);
        return special > 0 ? Math.max(0, primary - special) : 0;
    };

    const getProductCartKey = (product) => {
        if (product.cart_key) return String(product.cart_key);
        if (product.feature_value_id) return `${product.id}:${product.feature_value_id}`;
        return `product:${product.id}`;
    };

    const getFeatureText = (product) => {
        const features = Array.isArray(product.selected_features) ? product.selected_features : [];
        return features.map((feature) => {
            if (typeof feature === 'string') return feature;
            const name = feature.name || feature.feature_name || '';
            const value = feature.value || feature.value_name || feature.title || '';
            return [name, value].filter(Boolean).join(': ');
        }).filter(Boolean).join('، ');
    };

    const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    }[char]));

    let products = readArray('products');
    let packs = readArray('packs');
    let total = 0;
    let discountTotal = 0;

    parentCheckout.innerHTML = '';

    products.forEach((product) => {
        const quantity = Math.max(0, number(product.quantity));
        const unitPrice = getUnitPrice(product);
        const lineTotal = unitPrice * quantity;
        const lineDiscount = getUnitDiscount(product) * quantity;
        const featureText = getFeatureText(product);
        total += lineTotal;
        discountTotal += lineDiscount;

        const row = document.createElement('div');
        row.className = 'flex justify-between gap-3 p-3 border-b border-gray-200 text-sm';
        row.innerHTML = `
            <span class="text-gray-600 min-w-0">
                ${escapeHtml(product.title || 'محصول')}
                ${featureText ? `<span class="block text-xs text-indigo-700 mt-1">${escapeHtml(featureText)}</span>` : ''}
                <span class="text-xs text-gray-400 mx-1 in-fa">× ${formatPrice(quantity)}</span>
            </span>
            <span class="font-medium in-fa whitespace-nowrap">${formatPrice(lineTotal)} تومان</span>
        `;
        parentCheckout.append(row);
    });

    packs.forEach((pack) => {
        const quantity = Math.max(0, number(pack.quantity));
        const unitPrice = getUnitPrice(pack);
        const lineTotal = unitPrice * quantity;
        const lineDiscount = getUnitDiscount(pack) * quantity;
        total += lineTotal;
        discountTotal += lineDiscount;

        const row = document.createElement('div');
        row.className = 'flex justify-between gap-3 p-3 border-b border-gray-200 text-sm';
        row.innerHTML = `
            <span class="text-gray-600 min-w-0">
                ${escapeHtml(pack.title || 'پک')}
                <span class="text-xs text-gray-400 mx-1 in-fa">× ${formatPrice(quantity)}</span>
            </span>
            <span class="font-medium in-fa whitespace-nowrap">${formatPrice(lineTotal)} تومان</span>
        `;
        parentCheckout.append(row);
    });

    if (totalPriceCheckout) totalPriceCheckout.innerText = `${formatPrice(total)} تومان`;
    if (totalDiscountCheckout) totalDiscountCheckout.innerText = `${formatPrice(discountTotal)} تومان`;

    // فقط شناسه محصول، شناسه مقدار نهایی ویژگی و تعداد به سرور ارسال می‌شود.
    // قیمت و موجودی ارسالی مرورگر مبنای ثبت سفارش نیستند.
    const buildOrderProducts = () => products.map((product) => ({
        product_id: product.id,
        feature_value_id: product.feature_value_id || null,
        quantity: Math.max(1, number(product.quantity))
    }));

    const buildOrderPacks = () => packs.map((pack) => ({
        id: pack.id,
        quantity: Math.max(1, number(pack.quantity))
    }));

    const syncHiddenInputs = () => {
        products = readArray('products');
        packs = readArray('packs');
        productsInput.value = JSON.stringify(buildOrderProducts());
        packsInput.value = JSON.stringify(buildOrderPacks());
    };

    syncHiddenInputs();

    form.addEventListener('submit', (event) => {
        syncHiddenInputs();

        if (!products.length && !packs.length) {
            event.preventDefault();
            alert('سبد خرید شما خالی است.');
            return;
        }

        if (products.some((product) => !product.id || number(product.quantity) < 1) ||
            packs.some((pack) => !pack.id || number(pack.quantity) < 1)) {
            event.preventDefault();
            alert('اطلاعات سبد خرید معتبر نیست. لطفاً صفحه را تازه‌سازی کنید.');
        }
    });

    const province = document.getElementById('province');
    const city = document.getElementById('city');

    if (province && city && typeof $ !== 'undefined' && typeof api !== 'undefined') {
        province.addEventListener('change', () => {
            $.ajax({
                url: api + 'cities',
                type: 'POST',
                dataType: 'json',
                data: { provinceId: province.value },
                success: (response) => {
                    city.innerHTML = '';
                    response.forEach((cityModel) => {
                        const option = document.createElement('option');
                        option.value = cityModel.id;
                        option.innerText = cityModel.title;
                        city.append(option);
                    });
                },
                error: () => console.log('failed to load cities')
            });
        });
    }

    window.copyText = (value) => {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(value).then(() => alert('شماره کپی شد'));
        } else {
            const input = document.createElement('textarea');
            input.value = value;
            document.body.append(input);
            input.select();
            document.execCommand('copy');
            input.remove();
            alert('شماره کپی شد');
        }
    };

    const setUser = document.getElementById('setUser');
    if (setUser) {
        setUser.addEventListener('change', () => {
            const password = document.getElementById('password');
            const parentPass = password ? password.closest('.parentPass') : null;
            if (!password || !parentPass) return;

            parentPass.classList.toggle('hidden', !setUser.checked);
            password.disabled = !setUser.checked;
        });
    }
})();