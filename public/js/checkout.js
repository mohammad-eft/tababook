(() => {
    'use strict';

    const form = document.getElementById('checkoutForm');
    const parentCheckout = document.getElementById('parentCheckout');
    const totalPriceCheckout = document.getElementById('totalPriceCheckout');
    const totalDiscountCheckout = document.getElementById('totalDiscountCheckout');
    const productsInput = document.getElementById('productsInput');
    const packsInput = document.getElementById('packsInput');
    const province = document.getElementById('province');
    const city = document.getElementById('city');
    const setUser = document.getElementById('setUser');

    // خواندن امن اطلاعات از localStorage
    const readArray = (key) => {
        try {
            const parsed = JSON.parse(localStorage.getItem(key) || '[]');
            return Array.isArray(parsed) ? parsed : [];
        } catch (error) {
            return [];
        }
    };

    const number = (value) => {
        const parsed = Number(value);
        return Number.isFinite(parsed) ? parsed : 0;
    };

    const formatPrice = (value) => {
        return number(value).toLocaleString('fa-IR');
    };

    // آماده‌سازی محصولات برای ارسال به سرور
    // قیمت از سمت سرور و دیتابیس محاسبه می‌شود.
    const normalizeProducts = () => {
        return readArray('products')
            .map((item) => ({
                product_id: Number(item.product_id ?? item.id ?? 0),
                feature_value_id: item.feature_value_id
                    ? Number(item.feature_value_id)
                    : null,
                quantity: Number(item.quantity ?? 0),
            }))
            .filter((item) => {
                return item.product_id > 0 && item.quantity > 0;
            });
    };

    // آماده‌سازی پکیج‌ها برای ارسال به سرور
    const normalizePacks = () => {
        return readArray('packs')
            .map((item) => ({
                pack_id: Number(item.pack_id ?? item.id ?? 0),
                quantity: Number(item.quantity ?? 0),
            }))
            .filter((item) => {
                return item.pack_id > 0 && item.quantity > 0;
            });
    };

    // همگام‌سازی اطلاعات سبد خرید با inputهای مخفی فرم
    const syncHiddenInputs = () => {
        if (productsInput) {
            productsInput.value = JSON.stringify(normalizeProducts());
        }

        if (packsInput) {
            packsInput.value = JSON.stringify(normalizePacks());
        }
    };

    let totalPrice = 0;
    let totalDiscount = 0;

    // ساخت ردیف هر محصول در خلاصه سفارش
    const appendSummary = (title, quantity, primaryPrice, specialPrice) => {
        const primary = number(primaryPrice);
        const special = number(specialPrice);

        const unitPrice = special > 0 ? special : primary;
        const lineTotal = unitPrice * quantity;

        const lineDiscount = special > 0
            ? Math.max(0, primary - special) * quantity
            : 0;

        totalPrice += lineTotal;
        totalDiscount += lineDiscount;

        if (!parentCheckout) return;

        const row = document.createElement('div');

        row.className = 'flex justify-between p-3 border-b border-gray-200 text-sm';

        const name = document.createElement('span');

        name.className = 'text-gray-600';

        name.textContent = `${title || 'کالا'} × ${quantity.toLocaleString('fa-IR')}`;

        const price = document.createElement('span');

        price.className = 'font-medium in-fa';

        price.textContent = `${formatPrice(lineTotal)} تومان`;

        row.append(name, price);

        parentCheckout.append(row);
    };

    // اطلاعات محصولات
    const products = normalizeProducts();
    const productSources = readArray('products');

    products.forEach((item, index) => {
        const source = productSources.find((product) => {
            return (
                Number(product.product_id ?? product.id) === item.product_id &&
                Number(product.feature_value_id || 0) === Number(item.feature_value_id || 0)
            );
        });

        appendSummary(
            source?.title || source?.product_name || `محصول ${index + 1}`,
            item.quantity,
            source?.primary_price,
            source?.secondary_price
        );
    });

    // اطلاعات پکیج‌ها
    const packs = normalizePacks();
    const packSources = readArray('packs');

    packs.forEach((item, index) => {
        const source = packSources.find((pack) => {
            return Number(pack.pack_id ?? pack.id) === item.pack_id;
        });

        appendSummary(
            source?.title || source?.name || `پکیج ${index + 1}`,
            item.quantity,
            source?.primary_price,
            source?.secondary_price
        );
    });

    // نمایش مجموع قیمت و تخفیف
    if (totalPriceCheckout) {
        totalPriceCheckout.textContent = `${formatPrice(totalPrice)} تومان`;
    }

    if (totalDiscountCheckout) {
        totalDiscountCheckout.textContent = `${formatPrice(totalDiscount)} تومان`;
    }

    // ثبت اطلاعات در inputهای مخفی
    syncHiddenInputs();

    // بررسی سبد خرید هنگام ثبت سفارش
    if (form) {
        form.addEventListener('submit', (event) => {
            syncHiddenInputs();

            const hasItems =
                normalizeProducts().length > 0 ||
                normalizePacks().length > 0;

            if (!hasItems) {
                event.preventDefault();
                alert('سبد خرید شما خالی است.');
            }
        });
    }

    // دریافت شهرهای استان انتخاب‌شده
    if (
        province &&
        city &&
        typeof window.$ !== 'undefined' &&
        typeof window.api !== 'undefined'
    ) {
        province.addEventListener('change', () => {
            window.$.ajax({
                url: window.api + 'cities',
                type: 'POST',
                dataType: 'json',
                data: {
                    provinceId: province.value
                },

                success(response) {
                    city.innerHTML = '<option value="">یک شهر انتخاب کنید</option>';

                    (Array.isArray(response) ? response : []).forEach((cityModel) => {
                        const option = document.createElement('option');

                        option.value = cityModel.id;
                        option.textContent = cityModel.title;

                        city.append(option);
                    });
                },

                error() {
                    console.error('دریافت فهرست شهرها انجام نشد.');
                }
            });
        });
    }

    // کپی شماره کارت و شبا
    window.copyText = (value) => {
        if (navigator.clipboard?.writeText) {
            navigator.clipboard.writeText(value)
                .then(() => {
                    alert('شماره کپی شد');
                });
        }
    };

    // تنظیم نمایش فیلد رمز عبور، در صورت وجود گزینه setUser
    if (setUser) {
        setUser.addEventListener('change', () => {
            const password = document.getElementById('password');
            const parentPass = password?.closest('.parentPass');

            if (!password || !parentPass) return;

            parentPass.classList.toggle('hidden', !setUser.checked);

            password.disabled = !setUser.checked;
        });
    }

})();
