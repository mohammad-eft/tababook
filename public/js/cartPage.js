(() => {
    const totalBlock = document.getElementById('totalBlock');
    const cartItemsBlock = document.getElementById('cartItemsBlock');
    const orderBasket = document.getElementById('orderBasket');

    if (!totalBlock || !cartItemsBlock) return;

    const readArray = (key) => {
        try {
            const value = JSON.parse(localStorage.getItem(key) || '[]');
            return Array.isArray(value) ? value : [];
        } catch (error) {
            return [];
        }
    };

    const products = readArray('products');
    const packs = readArray('packs');

    const number = (value) => {
        const parsed = Number(value);
        return Number.isFinite(parsed) ? parsed : 0;
    };

    const formatPrice = (value) => number(value).toLocaleString('fa-IR');

    const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    }[char]));

    const productCartKey = (product) => {
        if (product.cart_key) return String(product.cart_key);
        if (product.feature_value_id) return `${product.id}:${product.feature_value_id}`;
        return `product:${product.id}`;
    };

    const getPrice = (item) => {
        const primary = number(item.primary_price);
        const special = number(item.secondary_price);
        return special > 0 ? special : primary;
    };

    const getDiscount = (item) => {
        const primary = number(item.primary_price);
        const special = number(item.secondary_price);
        return special > 0 ? Math.max(0, primary - special) : 0;
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

    let totalPrice = 0;
    let totalDiscount = 0;
    let hasItems = false;

    const closePopupOnOutsideClick = () => {
        if (!orderBasket || !orderBasket.parentElement || !orderBasket.parentElement.children[1]) return;

        document.addEventListener('click', (event) => {
            const popup = orderBasket.parentElement.children[1];
            if (!orderBasket.contains(event.target) && !popup.contains(event.target)) {
                if (typeof popupFlag !== 'undefined') popupFlag = false;
                popup.classList.add('invisible', 'opacity-0');
            }
        });
    };

    const renderProduct = (product) => {
        const key = productCartKey(product);
        const quantity = Math.max(0, number(product.quantity));
        const stock = Math.max(0, number(product.count));
        const unitPrice = getPrice(product);
        const discount = getDiscount(product);
        const featureText = getFeatureText(product);
        const image = product.mainImg || product.image || '';
        const description = product.summary || product.description || '';

        const wrapper = document.createElement('div');
        wrapper.className = 'lg:col-span-2 space-y-3 products cartPages parentItem';
        wrapper.dataset.productId = product.id;
        wrapper.dataset.cartKey = key;

        wrapper.innerHTML = `
            <div class="bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100">
                <div class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center text-2xl shrink-0 overflow-hidden">
                    ${image ? `<img src="${escapeHtml((typeof imgPath !== 'undefined' ? imgPath : '') + image)}" class="size-full object-cover" alt="">` : ''}
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-800 text-sm sm:text-base">${escapeHtml(product.title || 'محصول')}</h3>
                    ${description ? `<p class="text-xs text-gray-500 mt-0.5 mb-2">${escapeHtml(description)}</p>` : ''}
                    ${featureText ? `<p class="text-xs text-indigo-700 mb-3">${escapeHtml(featureText)}</p>` : ''}
                    <div class="w-full lg:w-1/4 p-2 flex gap-2 justify-center items-center rounded-xl addToCartBtns"
                        data-product-id="${escapeHtml(product.id)}"
                        data-cart-key="${escapeHtml(key)}"
                        data-feature-value-id="${escapeHtml(product.feature_value_id || '')}"
                        data-count="${stock}"
                        data-original-price="${number(product.primary_price)}"
                        data-special-price="${number(product.secondary_price)}"
                        data-selected-features="${escapeHtml(JSON.stringify(product.selected_features || []))}">
                        <button type="button" onclick="setCount(this)" class="w-1/3 text-lg font-bold text-white flex justify-center items-center ${quantity >= stock ? 'cursor-no-drop' : 'cursor-pointer'}" ${quantity >= stock ? 'disabled' : ''} data-state="+">+</button>
                        <input type="number" class="w-1/3 text-sm text-center outline-none text-white" readonly value="${quantity}">
                        <button type="button" onclick="setCount(this)" class="w-1/3 text-lg font-bold text-white flex justify-center items-center cursor-pointer" data-state="-">-</button>
                    </div>
                </div>
                <div class="text-left shrink-0">
                    <p class="font-bold text-gray-800 text-sm sm:text-base in-fa price">${formatPrice(unitPrice)}</p>
                    <p class="text-xs text-gray-400">تومان</p>
                </div>
            </div>
        `;

        cartItemsBlock.append(wrapper);
        totalPrice += unitPrice * quantity;
        totalDiscount += discount * quantity;
        hasItems = true;
    };

    const renderPack = (pack) => {
        const quantity = Math.max(0, number(pack.quantity));
        const stock = Math.max(0, number(pack.count));
        const unitPrice = getPrice(pack);
        const discount = getDiscount(pack);
        const image = pack.image || pack.mainImg || '';

        const wrapper = document.createElement('div');
        wrapper.className = 'lg:col-span-2 space-y-3 products cartPages parentItem';
        wrapper.dataset.packId = pack.id;

        wrapper.innerHTML = `
            <div class="bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100">
                <div class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center text-2xl shrink-0 overflow-hidden">
                    ${image ? `<img src="${escapeHtml((typeof imgPath !== 'undefined' ? imgPath : '') + image)}" class="size-full object-cover" alt="">` : ''}
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-800 text-sm sm:text-base">${escapeHtml(pack.title || 'پک')}</h3>
                    ${pack.summary ? `<p class="text-xs text-gray-500 mt-0.5 mb-3">${escapeHtml(pack.summary)}</p>` : ''}
                    <div class="w-full lg:w-1/4 p-2 flex gap-2 justify-center transition-all duration-300 hover:bg-(--green-btn) group cursor-pointer bg-(--light-green-btn) items-center rounded-xl addPackToCartBtn" data-pack-id="${escapeHtml(pack.id)}">
                        <button type="button" onclick="setPackCount(this)" class="w-1/3 text-lg font-bold transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center ${quantity >= stock ? 'cursor-no-drop' : 'cursor-pointer'}" ${quantity >= stock ? 'disabled' : ''} data-state="+">+</button>
                        <input type="number" class="w-1/3 text-sm text-center outline-none transition-all duration-300 text-(--primary-text-color) group-hover:text-white in-fa" readonly value="${quantity}">
                        <button type="button" onclick="setPackCount(this)" class="w-1/3 text-lg font-bold transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex justify-center items-center cursor-pointer" data-state="-">-</button>
                    </div>
                </div>
                <div class="text-left shrink-0">
                    <p class="font-bold text-gray-800 text-sm sm:text-base in-fa price">${formatPrice(unitPrice)}</p>
                    <p class="text-xs text-gray-400">تومان</p>
                </div>
            </div>
        `;

        cartItemsBlock.append(wrapper);
        totalPrice += unitPrice * quantity;
        totalDiscount += discount * quantity;
        hasItems = true;
    };

    products.forEach(renderProduct);
    packs.forEach(renderPack);

    if (hasItems) {
        totalBlock.classList.remove('hidden');
        const totalPriceEl = totalBlock.querySelector('#totalPriceEl');
        const discountEl = totalBlock.querySelector('#discountEl');
        const discountBlock = totalBlock.querySelector('.discountBlock');

        if (totalPriceEl) totalPriceEl.innerText = formatPrice(totalPrice);
        if (discountEl) discountEl.innerText = `${formatPrice(totalDiscount)} تومان`;
        if (discountBlock) {
            discountBlock.classList.toggle('hidden', totalDiscount <= 0);
            discountBlock.classList.toggle('flex', totalDiscount > 0);
        }
    } else {
        totalBlock.classList.add('hidden');
        cartItemsBlock.innerHTML = '<div class="lg:col-span-2 bg-white rounded-2xl p-8 text-center text-gray-500">سبد خرید شما خالی است.</div>';
    }

    closePopupOnOutsideClick();
})();