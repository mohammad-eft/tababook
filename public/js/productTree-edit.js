
document.addEventListener('DOMContentLoaded', function () {
    const root = document.querySelector('#editForm #product-tree');
    if (!root) return;

    const categorySelect = document.querySelector('#editForm #category_ids');
    const featureCount = document.querySelector('#tree-feature-count');
    const valueCount = document.querySelector('#tree-value-count');
    const leafCount = document.querySelector('#tree-leaf-count');

    let activeForm = null;

    // --------------------------------------------------
    // ابزارهای عمومی
    // --------------------------------------------------

    function uid() {
        return window.crypto?.randomUUID
            ? window.crypto.randomUUID()
            : 'tree-' + Date.now() + '-' + Math.random().toString(36).slice(2);
    }

    function escapeHTML(value) {
        return String(value ?? '').replace(/[&<>"']/g, char => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[char]);
    }

    function normalizeKey(value) {
        return String(value ?? '')
            .trim()
            .replace(/ي/g, 'ی')
            .replace(/ك/g, 'ک')
            .replace(/\s+/g, ' ');
    }

    function isColorFeature(feature) {
        const key = normalizeKey(feature?.name);

        return key === 'رنگ' ||
            String(feature?.type ?? '').toLowerCase() === 'color';
    }

    function isValidHex(value) {
        return /^#[0-9a-fA-F]{6}$/.test(String(value ?? ''));
    }

    function normalizeFeatures(features) {
        if (!Array.isArray(features)) return [];

        return features.map(feature => ({
            id: uid(),

            attributeId: feature.attribute_id ?? feature.attributeId ?? '',

            name: feature.name ?? '',
            type: feature.type ?? '',

            open: feature.open !== false,

            values: Array.isArray(feature.values)
                ? feature.values.map(value => ({
                    id: uid(),
                    name: value.name ?? '',

                    isDefault: [true, 1, '1'].includes(
                        value.is_default ?? value.isDefault ?? false
                    ),

                    originalPrice:
                        value.original_price ??
                        value.originalPrice ??
                        '',

                    specialPrice:
                        value.special_price ??
                        value.specialPrice ??
                        '',

                    count: value.count ?? 0,

                    open: value.open !== false,

                    children: normalizeFeatures(value.children ?? [])
                }))
                : []
        }));
    }

    let productFeatures = normalizeFeatures(window.PRODUCT_FEATURES || []);

    // --------------------------------------------------
    // ویژگی‌های مجاز دسته‌بندی‌های انتخاب‌شده
    // --------------------------------------------------

    function getSelectedCategoryIds() {
        if (!categorySelect) return [];

        return Array.from(categorySelect.selectedOptions)
            .map(option => String(option.value));
    }

    function getAvailableAttributes() {
        const categories = window.CATEGORIES || {};
        const selectedIds = getSelectedCategoryIds();

        const attributesMap = new Map();

        selectedIds.forEach(categoryId => {
            const category = categories[categoryId];

            if (!category || !Array.isArray(category.attributes)) return;

            category.attributes.forEach(attribute => {
                const id = String(attribute.id);

                if (!attributesMap.has(id)) {
                    attributesMap.set(id, {
                        id,
                        key: attribute.key ?? '',
                        type: attribute.type ?? '',
                        categories: [category.name ?? '']
                    });
                } else {
                    const existing = attributesMap.get(id);

                    if (!existing.categories.includes(category.name ?? '')) {
                        existing.categories.push(category.name ?? '');
                    }
                }
            });
        });

        return Array.from(attributesMap.values());
    }

    function getAttributeById(id) {
        return getAvailableAttributes().find(
            attribute => String(attribute.id) === String(id)
        ) || null;
    }

    function getAttributeLabel(attribute) {
        const categoryName = attribute.categories.join('، ');

        return categoryName
            ? `${attribute.key} — ${categoryName}`
            : attribute.key;
    }

    // --------------------------------------------------
    // جست‌وجوی اعضای درخت
    // --------------------------------------------------

    function findFeature(id, features = productFeatures) {
        for (const feature of features) {
            if (feature.id === id) return feature;

            for (const value of feature.values) {
                const found = findFeature(id, value.children);

                if (found) return found;
            }
        }

        return null;
    }

    function findValue(id, features = productFeatures) {
        for (const feature of features) {
            for (const value of feature.values) {
                if (value.id === id) return value;

                const found = findValue(id, value.children);

                if (found) return found;
            }
        }

        return null;
    }

    // --------------------------------------------------
    // بررسی ویژگی‌های استفاده‌شده در مسیر
    // --------------------------------------------------

    function getUsedAttributeIds(targetValueId = null) {
        const usedIds = new Set();

        if (!targetValueId) {
            productFeatures.forEach(feature => {
                if (feature.attributeId) {
                    usedIds.add(String(feature.attributeId));
                }
            });

            return usedIds;
        }

        function search(features, ancestors = []) {
            for (const feature of features) {
                if (feature.attributeId) {
                    ancestors.push(String(feature.attributeId));
                }

                for (const value of feature.values) {
                    if (value.id === targetValueId) {
                        ancestors.forEach(id => usedIds.add(id));
                        return true;
                    }

                    if (search(value.children, [...ancestors])) {
                        return true;
                    }
                }

                ancestors.pop();
            }

            return false;
        }

        search(productFeatures);

        return usedIds;
    }

    // --------------------------------------------------
    // آمار درخت
    // --------------------------------------------------

    function countTree(features) {
        let featuresTotal = 0;
        let valuesTotal = 0;
        let leavesTotal = 0;

        features.forEach(feature => {
            featuresTotal++;

            feature.values.forEach(value => {
                valuesTotal++;

                if (value.children.length) {
                    const childCounts = countTree(value.children);

                    featuresTotal += childCounts.features;
                    valuesTotal += childCounts.values;
                    leavesTotal += childCounts.leaves;
                } else {
                    leavesTotal++;
                }
            });
        });

        return {
            features: featuresTotal,
            values: valuesTotal,
            leaves: leavesTotal
        };
    }

    // --------------------------------------------------
    // فرم افزودن ویژگی
    // --------------------------------------------------

    function renderAttributeSelect(targetValueId = null) {
        const attributes = getAvailableAttributes();
        const usedIds = getUsedAttributeIds(targetValueId);

        const availableAttributes = attributes.filter(
            attribute => !usedIds.has(String(attribute.id))
        );

        if (!availableAttributes.length) {
            return `
                <select
                    data-add-attribute
                    class="tree-select"
                    disabled
                >
                    <option value="">ویژگی مجازی برای انتخاب وجود ندارد</option>
                </select>
            `;
        }

        return `
            <select
                data-add-attribute
                class="tree-select"
            >
                <option value="">انتخاب ویژگی</option>

                ${availableAttributes.map(attribute => `
                    <option
                        value="${escapeHTML(attribute.id)}"
                        data-key="${escapeHTML(attribute.key)}"
                        data-type="${escapeHTML(attribute.type)}"
                    >
                        ${escapeHTML(getAttributeLabel(attribute))}
                    </option>
                `).join('')}
            </select>
        `;
    }

    function renderAddForm(type, targetId = '') {
        if (
            !activeForm ||
            activeForm.type !== type ||
            activeForm.targetId !== targetId
        ) {
            return '';
        }

        // افزودن ویژگی اصلی یا زیرشاخه
        if (type === 'root' || type === 'feature') {
            return `
                <div class="tree-add-form">

                    <div class="tree-add-field">
                        <label>انتخاب ویژگی</label>
                        ${renderAttributeSelect(
                type === 'feature' ? targetId : null
            )}
                    </div>

                    <button
                        type="button"
                        class="tree-add-confirm"
                        data-action="confirm-add"
                    >
                        ثبت 
                    </button>

                    <button
                        type="button"
                        class="tree-add-cancel"
                        data-action="cancel-add"
                    >
                        انصراف
                    </button>

                </div>
            `;
        }

        // افزودن مقدار به ویژگی
        if (type === 'value') {
            const feature = findFeature(targetId);

            if (!feature) return '';

            if (isColorFeature(feature)) {
                return `
                    <div class="tree-add-form">

                        <div class="tree-add-field">
                            <label>انتخاب رنگ</label>

                            <div class="flex items-center gap-3">
                                <input
                                    type="color"
                                    data-add-color
                                    value="#000000"
                                    class="tree-color-input"
                                >

                                <input
                                    type="text"
                                    data-add-color-hex
                                    value="#000000"
                                    maxlength="7"
                                    class="tree-edit-input"
                                    dir="ltr"
                                    placeholder="#000000"
                                >
                            </div>
                        </div>

                        <button
                            type="button"
                            class="tree-add-confirm"
                            data-action="confirm-add"
                        >
                            ثبت 
                        </button>

                        <button
                            type="button"
                            class="tree-add-cancel"
                            data-action="cancel-add"
                        >
                            انصراف
                        </button>

                    </div>
                `;
            }

            return `
                <div class="tree-add-form">

                    <div class="tree-add-field">
                        <label>عنوان مقدار جدید</label>

                        <input
                            type="text"
                            data-add-name
                            autocomplete="off"
                            placeholder="مثلاً بزرگ، کوچک یا چوبی"
                        >
                    </div>

                    <button
                        type="button"
                        class="tree-add-confirm"
                        data-action="confirm-add"
                    >
                        ثبت 
                    </button>

                    <button
                        type="button"
                        class="tree-add-cancel"
                        data-action="cancel-add"
                    >
                        انصراف
                    </button>

                </div>
            `;
        }

        return '';
    }

    // --------------------------------------------------
    // نمایش قیمت
    // --------------------------------------------------

    function renderPriceInputs(value, valuePath) {
        const originalName = `${valuePath}[original_price]`;
        const specialName = `${valuePath}[special_price]`;
        const countName = `${valuePath}[count]`;

        const originalValue = escapeHTML(value.originalPrice);
        const specialValue = escapeHTML(value.specialPrice);
        const countValue = escapeHTML(value.count ?? 0);

        if (value.children.length) {
            return `
                <input
                    type="hidden"
                    name="${originalName}"
                    value="${originalValue}"
                >

                <input
                    type="hidden"
                    name="${specialName}"
                    value="${specialValue}"
                >

                <input
                    type="hidden"
                    name="${countName}"
                    value="${countValue}"
                >
            `;
        }

        return `
            <div class="tree-price-box">

                <div>
                    <label>قیمت اصلی (تومان)</label>

                    <input
                        type="number"
                        min="0"
                        name="${originalName}"
                        value="${originalValue}"
                        data-price-field="originalPrice"
                        data-value-id="${value.id}"
                        placeholder="قیمت اصلی"
                    >
                </div>

                <div>
                    <label>قیمت ویژه (تومان)</label>

                    <input
                        type="number"
                        min="0"
                        name="${specialName}"
                        value="${specialValue}"
                        data-price-field="specialPrice"
                        data-value-id="${value.id}"
                        placeholder="قیمت ویژه"
                    >
                </div>

                <div>
                    <label>موجودی </label>

                    <input
                        type="number"
                        min="0"
                        step="1"
                        name="${countName}"
                        value="${countValue}"
                        data-count-field
                        data-value-id="${value.id}"
                        placeholder="تعداد "
                    >
                </div>

            </div>
        `;
    }

    // --------------------------------------------------
    // نمایش ویژگی
    // --------------------------------------------------

    function renderFeature(feature, featureIndex, parentPath) {
        const featurePath = `${parentPath}[${featureIndex}]`;

        const bodyId = `feature-body-${feature.id}`;

        const valuesHTML = feature.values.map((value, index) =>
            renderValue(value, index, feature, featurePath)
        ).join('');

        const isEditing = activeForm?.type === 'edit-feature' &&
            activeForm.targetId === feature.id;

        const availableAttribute = getAttributeById(feature.attributeId);

        const isInvalid = !availableAttribute;

        return `
            <div
                class="tree-feature"
                data-feature-id="${feature.id}"
            >

                <input
                    type="hidden"
                    name="${featurePath}[attribute_id]"
                    value="${escapeHTML(feature.attributeId)}"
                >

                <input
                    type="hidden"
                    name="${featurePath}[name]"
                    value="${escapeHTML(feature.name)}"
                >

                <input
                    type="hidden"
                    name="${featurePath}[type]"
                    value="${escapeHTML(feature.type)}"
                >

                <div class="tree-feature-head">

                    <div class="tree-feature-title">

                        <button
                            type="button"
                            class="tree-toggle"
                            data-action="toggle-feature"
                            data-id="${feature.id}"
                        >
                            ${feature.open ? '−' : '+'}
                        </button>

                        <span>${escapeHTML(feature.name)}</span>

                        <span class="pf-hint">
                            (${feature.values.length} مقدار)
                        </span>

                        ${isInvalid ? `
                            <span class="text-red-600 text-xs">
                                این ویژگی دیگر در دسته‌بندی‌های انتخاب‌شده مجاز نیست
                            </span>
                        ` : ''}

                    </div>

                    <div class="tree-actions">

                        <button
                            type="button"
                            class="tree-action"
                            data-action="add-value"
                            data-id="${feature.id}"
                        >
                            <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14m-7 7V5"/>
                            </svg>

                        </button>

                        <button
                            type="button"
                            class="tree-action tree-action-danger"
                            data-action="delete-feature"
                            data-id="${feature.id}"
                        >
                            <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>

                        </button>

                    </div>

                </div>

                <div
                    class="tree-feature-body"
                    id="${bodyId}"
                    style="${feature.open ? '' : 'display: none;'}"
                >
                    ${valuesHTML}

                    ${renderAddForm('value', feature.id)}
                </div>

            </div>
        `;
    }

    // --------------------------------------------------
    // نمایش مقدار
    // --------------------------------------------------

    function renderValue(value, valueIndex, parentFeature, featurePath) {
        const valuePath = `${featurePath}[values][${valueIndex}]`;

        const hasChildren = value.children.length > 0;

        // ویژگی‌هایی که در این مسیر هنوز قابل انتخاب‌اند.
        // اگر همه ویژگی‌های دسته‌بندی‌ها مصرف شده باشند، افزودن زیرشاخه مخفی می‌شود.
        const usedAttributeIds = getUsedAttributeIds(value.id);
        const hasAvailableChildAttributes = getAvailableAttributes().some(
            attribute => !usedAttributeIds.has(String(attribute.id))
        );

        const isColor = isColorFeature(parentFeature);

        const childrenHTML = value.children.map((feature, index) =>
            renderFeature(feature, index, `${valuePath}[children]`)
        ).join('');

        const isEditing = activeForm?.type === 'edit-value' &&
            activeForm.targetId === value.id;

        const colorValue = isValidHex(value.name)
            ? value.name
            : '#000000';

        let valueTitle = '';

        if (isEditing) {
            valueTitle = isColor
                ? `
                    <div class="flex items-center gap-2">
                        <input
                            type="color"
                            data-edit-color
                            value="${colorValue}"
                            class="tree-color-input"
                        >

                        <input
                            type="text"
                            data-edit-color-hex
                            value="${colorValue}"
                            maxlength="7"
                            dir="ltr"
                            class="tree-edit-input"
                        >
                    </div>
                `
                : `
                    <input
                        type="text"
                        class="tree-edit-input"
                        data-edit-name
                        value="${escapeHTML(value.name)}"
                    >
                `;
        } else if (isColor) {
            valueTitle = `
                <span
                    class="tree-color-preview"
                    style="background-color: ${colorValue}"
                ></span>

                <span dir="ltr">${escapeHTML(value.name)}</span>
            `;
        } else {
            valueTitle = `
                <span>${escapeHTML(value.name)}</span>
            `;
        }

        return `
            <div
                class="tree-value"
                data-value-id="${value.id}"
            >

                <input
                    type="hidden"
                    name="${valuePath}[name]"
                    value="${escapeHTML(value.name)}"
                    data-value-name="${value.id}"
                >

                <input
                    type="hidden"
                    name="${valuePath}[is_default]"
                    value="${value.isDefault ? '1' : '0'}"
                >

                <div class="tree-value-head">

                    <div class="tree-value-name">

            
                                <button
                                    type="button"
                                    class="tree-toggle"
                                    data-action="toggle-value"
                                    data-id="${value.id}"
                                >
                                    ${value.open ? '−' : '+'}
                                </button>
                 

                        ${valueTitle}

                        ${hasChildren
                ? `<span class="pf-hint">دارای ${value.children.length} زیرشاخه</span>`
                : ``
            }

                        ${hasChildren ? `
                            <label class="inline-flex items-center gap-1.5 mr-2 text-xs text-slate-600 cursor-pointer select-none">
                                <input
                                    type="radio"
                                    class="accent-blue-600"
                                    name="tree-default-${parentFeature.id}"
                                    value="${value.id}"
                                    data-default-value-id="${value.id}"
                                    data-default-feature-id="${parentFeature.id}"
                                    ${value.isDefault ? 'checked' : ''}
                                >
                                <span>پیش‌فرض</span>
                            </label>
                        ` : ''}

                    </div>

                    <div class="tree-actions">

                        ${isEditing ? `
                            <button
                                type="button"
                                class="tree-action"
                                data-action="save-edit"
                                data-id="${value.id}"
                            >
                                ذخیره
                            </button>

                            <button
                                type="button"
                                class="tree-action tree-action-danger"
                                data-action="cancel-edit"
                            >
                                انصراف
                            </button>
                        ` : `
                            <button
                                type="button"
                                class="tree-action"
                                data-action="edit-value"
                                data-id="${value.id}"
                            >
                                ✎ 
                            </button>

                            ${hasAvailableChildAttributes ? `
                                <button
                                    type="button"
                                    class="tree-action"
                                    data-action="add-child-feature"
                                    data-id="${value.id}"
                                >
                                    <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14m-7 7V5"/>
</svg>

                                </button>
                            ` : ''}

                            

                            <button
                                type="button"
                                class="tree-action tree-action-danger"
                                data-action="delete-value"
                                data-id="${value.id}"
                            >
                                <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>

                            </button>
                        `}

                    </div>

                </div>

               ${value.open ? `
                    ${renderPriceInputs(value, valuePath)}

                    ${hasChildren ? `
                        <div class="tree-children">
                            ${childrenHTML}
                        </div>
                    ` : ''}

                    ${renderAddForm('feature', value.id)}` : `<div class="tree-collapsed"></div>`
            }

                ${renderAddForm('feature', value.id)}

            </div>
        `;
    }


    // --------------------------------------------------
    // رندر اصلی
    // --------------------------------------------------

    function renderTree() {
        root.innerHTML = productFeatures.map((feature, index) =>
            renderFeature(feature, index, 'product_features')
        ).join('') + renderAddForm('root', '');

        const counts = countTree(productFeatures);

        if (featureCount) {
            featureCount.textContent = counts.features.toLocaleString('fa-IR');
        }

        if (valueCount) {
            valueCount.textContent = counts.values.toLocaleString('fa-IR');
        }

        if (leafCount) {
            leafCount.textContent = counts.leaves.toLocaleString('fa-IR');
        }

        if (activeForm) {
            requestAnimationFrame(() => {
                const input = root.querySelector(
                    '[data-add-name], [data-add-attribute], [data-add-color-hex], [data-edit-name], [data-edit-color-hex]'
                );

                input?.focus();
            });
        }
    }

    // --------------------------------------------------
    // API عمومی برای بارگذاری داده در حالت ویرایش
    // --------------------------------------------------

    window.ProductTreeEdit = {
        load(features = []) {
            productFeatures = normalizeFeatures(features);
            activeForm = null;
            renderTree();
        },
        reset() {
            productFeatures = [];
            activeForm = null;
            renderTree();
        },
        getData() {
            return productFeatures;
        }
    };

    // --------------------------------------------------
    // باز کردن فرم افزودن
    // --------------------------------------------------

    function openAddForm(type, targetId = '') {
        if (type === 'value' && targetId) {
            const feature = findFeature(targetId);

            if (feature) feature.open = true;
        }

        if (type === 'feature' && targetId) {
            const value = findValue(targetId);

            if (value) value.open = true;
        }

        activeForm = { type, targetId };

        renderTree();
    }

    // --------------------------------------------------
    // افزودن ویژگی و مقدار
    // --------------------------------------------------

    function addFeature(attribute, targetValueId = null) {
        if (!attribute) return;

        const feature = {
            id: uid(),

            attributeId: String(attribute.id),

            name: attribute.key,
            type: attribute.type ?? '',

            open: true,
            values: []
        };

        if (!targetValueId) {
            productFeatures.push(feature);
            return;
        }

        const value = findValue(targetValueId);

        if (!value) return;

        value.children.push(feature);
        value.open = true;
    }

    function addValue(name, featureId) {
        const feature = findFeature(featureId);

        if (!feature || !name) return;

        feature.values.push({
            id: uid(),

            name,

            isDefault: false,

            originalPrice: '',
            specialPrice: '',
            count: 0,

            open: true,
            children: []
        });

        feature.open = true;
    }

    // --------------------------------------------------
    // حذف ویژگی و مقدار
    // --------------------------------------------------

    function deleteFeature(id, features = productFeatures) {
        const index = features.findIndex(feature => feature.id === id);

        if (index !== -1) {
            features.splice(index, 1);
            return true;
        }

        for (const feature of features) {
            for (const value of feature.values) {
                if (deleteFeature(id, value.children)) {
                    return true;
                }
            }
        }

        return false;
    }

    function deleteValue(id, features = productFeatures) {
        for (const feature of features) {
            const index = feature.values.findIndex(value => value.id === id);

            if (index !== -1) {
                feature.values.splice(index, 1);
                return true;
            }

            for (const value of feature.values) {
                if (deleteValue(id, value.children)) {
                    return true;
                }
            }
        }

        return false;
    }

    // --------------------------------------------------
    // تأیید افزودن
    // --------------------------------------------------

    function confirmAdd() {
        if (!activeForm) return;

        // افزودن ویژگی اصلی یا زیرشاخه
        if (activeForm.type === 'root' || activeForm.type === 'feature') {
            const select = root.querySelector('[data-add-attribute]');

            const attributeId = select?.value;

            if (!attributeId) {
                select?.focus();
                return;
            }

            const attribute = getAttributeById(attributeId);

            if (!attribute) {
                showMessage('این ویژگی در دسته‌بندی‌های انتخاب‌شده موجود نیست.');
                return;
            }

            const usedIds = getUsedAttributeIds(
                activeForm.type === 'feature'
                    ? activeForm.targetId
                    : null
            );

            if (usedIds.has(String(attribute.id))) {
                showMessage('این ویژگی قبلاً در این مسیر انتخاب شده است.');
                return;
            }

            if (activeForm.type === 'root') {
                addFeature(attribute);
            } else {
                addFeature(attribute, activeForm.targetId);
            }

            activeForm = null;
            renderTree();

            return;
        }

        // افزودن مقدار
        if (activeForm.type === 'value') {
            const feature = findFeature(activeForm.targetId);

            if (!feature) return;

            let name = '';

            if (isColorFeature(feature)) {
                name = root.querySelector('[data-add-color-hex]')?.value.trim();

                if (!isValidHex(name)) {
                    showMessage('لطفاً یک کد رنگ معتبر وارد کنید.');
                    return;
                }
            } else {
                name = root.querySelector('[data-add-name]')?.value.trim();

                if (!name) {
                    root.querySelector('[data-add-name]')?.focus();
                    return;
                }
            }

            addValue(name, activeForm.targetId);

            activeForm = null;
            renderTree();
        }
    }

    // --------------------------------------------------
    // هماهنگی انتخابگر رنگ و کد HEX
    // --------------------------------------------------

    root.addEventListener('input', function (event) {
        const target = event.target;

        if (target.matches('[data-add-color]')) {
            const hexInput = root.querySelector('[data-add-color-hex]');

            if (hexInput) {
                hexInput.value = target.value.toUpperCase();
            }

            return;
        }

        if (target.matches('[data-add-color-hex]')) {
            const colorInput = root.querySelector('[data-add-color]');

            if (colorInput && isValidHex(target.value)) {
                colorInput.value = target.value;
            }

            return;
        }

        if (target.matches('[data-edit-color]')) {
            const hexInput = root.querySelector('[data-edit-color-hex]');

            if (hexInput) {
                hexInput.value = target.value.toUpperCase();
            }

            return;
        }

        if (target.matches('[data-edit-color-hex]')) {
            const colorInput = root.querySelector('[data-edit-color]');

            if (colorInput && isValidHex(target.value)) {
                colorInput.value = target.value;
            }

            return;
        }

        const priceInput = target.closest('[data-price-field]');

        if (priceInput) {
            const value = findValue(priceInput.dataset.valueId);

            if (!value) return;

            const field = priceInput.dataset.priceField;

            if (
                field !== 'originalPrice' &&
                field !== 'specialPrice'
            ) {
                return;
            }

            value[field] = priceInput.value;
        }
    });

    // --------------------------------------------------
    // انتخاب مقدار پیش‌فرض در هر گروه از مقادیر هم‌سطح
    // --------------------------------------------------

    root.addEventListener('change', function (event) {
        const radio = event.target.closest('[data-default-value-id]');

        if (!radio) return;

        const feature = findFeature(radio.dataset.defaultFeatureId);

        if (!feature) return;

        feature.values.forEach(value => {
            value.isDefault = String(value.id) === String(radio.dataset.defaultValueId);
        });

        renderTree();
    });

    // --------------------------------------------------
    // کلیک‌های درخت
    // --------------------------------------------------

    root.addEventListener('click', function (event) {
        const button = event.target.closest('[data-action]');

        if (!button) return;

        const action = button.dataset.action;
        const id = button.dataset.id;

        switch (action) {
            case 'toggle-feature': {
                const feature = findFeature(id);

                if (feature) {
                    feature.open = !feature.open;
                }

                renderTree();
                break;
            }

            case 'toggle-value': {
                const value = findValue(id);

                if (value) {
                    value.open = !value.open;
                }

                renderTree();
                break;
            }

            case 'add-value':
                openAddForm('value', id);
                break;

            case 'add-child-feature': {
                if (!getSelectedCategoryIds().length) {
                    showMessage('برای افزودن زیرشاخه، ابتدا حداقل یک دسته‌بندی را انتخاب کنید.');
                    return;
                }

                const usedIds = getUsedAttributeIds(id);
                const hasAvailableAttribute = getAvailableAttributes().some(
                    attribute => !usedIds.has(String(attribute.id))
                );

                if (!hasAvailableAttribute) {
                    renderTree();
                    return;
                }

                openAddForm('feature', id);
                break;
            }

            case 'delete-feature':
                if (confirm('این ویژگی و تمام زیرشاخه‌های آن حذف شود؟')) {
                    deleteFeature(id);

                    activeForm = null;

                    renderTree();
                }
                break;

            case 'delete-value':
                if (confirm('این مقدار و تمام زیرشاخه‌های آن حذف شود؟')) {
                    deleteValue(id);

                    activeForm = null;

                    renderTree();
                }
                break;

            case 'confirm-add':
                confirmAdd();
                break;

            case 'edit-value':
                activeForm = {
                    type: 'edit-value',
                    targetId: id
                };

                renderTree();
                break;

            case 'save-edit': {
                const value = findValue(id);

                if (!value) return;

                const feature = findParentFeatureOfValue(id);

                if (!feature) return;

                let newName = '';

                if (isColorFeature(feature)) {
                    newName = root.querySelector('[data-edit-color-hex]')?.value.trim();

                    if (!isValidHex(newName)) {
                        showMessage('لطفاً یک کد رنگ معتبر وارد کنید.');
                        return;
                    }
                } else {
                    newName = root.querySelector('[data-edit-name]')?.value.trim();

                    if (!newName) {
                        root.querySelector('[data-edit-name]')?.focus();
                        return;
                    }
                }

                value.name = newName;

                activeForm = null;

                renderTree();
                break;
            }

            case 'cancel-edit':
            case 'cancel-add':
                activeForm = null;
                renderTree();
                break;
        }
    });

    // --------------------------------------------------
    // پیدا کردن ویژگی والد یک مقدار
    // --------------------------------------------------

    function findParentFeatureOfValue(valueId, features = productFeatures) {
        for (const feature of features) {
            for (const value of feature.values) {
                if (value.id === valueId) {
                    return feature;
                }

                const found = findParentFeatureOfValue(
                    valueId,
                    value.children
                );

                if (found) return found;
            }
        }

        return null;
    }

    // --------------------------------------------------
    // کلید Enter
    // --------------------------------------------------

    root.addEventListener('keydown', function (event) {
        if (event.key !== 'Enter') return;

        if (
            event.target.matches('[data-add-name]') ||
            event.target.matches('[data-add-color-hex]')
        ) {
            event.preventDefault();

            if (activeForm?.type === 'value') {
                confirmAdd();
            }
        }

        if (
            event.target.matches('[data-edit-name]') ||
            event.target.matches('[data-edit-color-hex]')
        ) {
            event.preventDefault();

            const saveButton = root.querySelector('[data-action="save-edit"]');

            saveButton?.click();
        }
    });

    // --------------------------------------------------
    // تغییر دسته‌بندی‌ها
    // --------------------------------------------------

    categorySelect?.addEventListener('change', function () {
        renderTree();
    });

    // --------------------------------------------------
    // افزودن ویژگی اصلی
    // --------------------------------------------------

    document.querySelector('#add-root-feature')?.addEventListener('click', function () {
        if (!getSelectedCategoryIds().length) {
            showMessage('برای افزودن ویژگی، ابتدا حداقل یک دسته‌بندی را انتخاب کنید.');
            return;
        }

        const usedIds = getUsedAttributeIds();
        const hasAvailableAttribute = getAvailableAttributes().some(
            attribute => !usedIds.has(String(attribute.id))
        );

        if (!hasAvailableAttribute) {
            showMessage('تمام ویژگی‌های قابل انتخاب برای دسته‌بندی‌های انتخاب‌شده اضافه شده‌اند.');
            return;
        }

        activeForm = {
            type: 'root',
            targetId: ''
        };

        renderTree();
    });

    // --------------------------------------------------
    // جلوگیری از ارسال ویژگی نامعتبر
    // --------------------------------------------------

    const productForm = root.closest('form');

    productForm?.addEventListener('submit', function (event) {
        const availableIds = new Set(
            getAvailableAttributes().map(attribute => String(attribute.id))
        );

        function validateFeatures(features) {
            for (const feature of features) {
                if (
                    !feature.attributeId ||
                    !availableIds.has(String(feature.attributeId))
                ) {
                    return false;
                }

                if (!validateFeatures(
                    feature.values.flatMap(value => value.children)
                )) {
                    return false;
                }
            }

            return true;
        }

        if (!validateFeatures(productFeatures)) {
            event.preventDefault();

            showMessage(
                'یکی از ویژگی‌های درخت با دسته‌بندی‌های انتخاب‌شده مطابقت ندارد. لطفاً آن ویژگی یا زیرشاخه را حذف کنید.'
            );
        }
    });

    // --------------------------------------------------
    // شروع
    // --------------------------------------------------

    renderTree();
});