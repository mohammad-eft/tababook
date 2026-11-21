document.addEventListener('DOMContentLoaded', function () {
    const root = document.querySelector('#product-tree');
    if (!root) return;

    // const emptyState = document.querySelector('#product-tree-empty');
    const featureCount = document.querySelector('#tree-feature-count');
    const valueCount = document.querySelector('#tree-value-count');
    const leafCount = document.querySelector('#tree-leaf-count');

    let activeForm = null;

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

    function normalizeFeatures(features) {
        if (!Array.isArray(features)) return [];

        return features.map(feature => ({
            id: uid(),
            name: feature.name ?? '',
            open: feature.open !== false,
            values: Array.isArray(feature.values)
                ? feature.values.map(value => ({
                    id: uid(),
                    name: value.name ?? '',
                    originalPrice: value.original_price ?? value.originalPrice ?? '',
                    specialPrice: value.special_price ?? value.specialPrice ?? '',
                    open: value.open !== false,
                    children: normalizeFeatures(value.children ?? [])
                }))
                : []
        }));
    }

    let productFeatures = normalizeFeatures(window.PRODUCT_FEATURES || []);

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

    function renderAddForm(type, targetId = '') {
        if (!activeForm ||
            activeForm.type !== type ||
            activeForm.targetId !== targetId) {
            return '';
        }

        const title = type === 'value'
            ? 'عنوان مقدار جدید'
            : 'عنوان ویژگی جدید';

        return `
            <div class="tree-add-form">
                <div class="tree-add-field">
                    <label>${title}</label>
                    <input
                        type="text"
                        data-add-name
                        autocomplete="off"
                        placeholder="${type === 'value' ? 'مثلاً مشکی' : 'مثلاً سایز'}"
                    >
                </div>

                <button
                    type="button"
                    class="tree-add-confirm"
                    data-action="confirm-add"
                >
                    افزودن
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

    function renderPriceInputs(value, valuePath) {
        const originalName = `${valuePath}[original_price]`;
        const specialName = `${valuePath}[special_price]`;

        const originalValue = escapeHTML(value.originalPrice);
        const specialValue = escapeHTML(value.specialPrice);

        // قیمت هر مقدار در داده‌ها حفظ می‌شود؛
        // اگر مقدار زیرشاخه داشته باشد، ورودی قابل ویرایش مخفی می‌شود.
        if (value.children.length) {
            return `
                <input type="hidden"
                    name="${originalName}"
                    value="${originalValue}">

                <input type="hidden"
                    name="${specialName}"
                    value="${specialValue}">
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
            </div>
        `;
    }

    function renderFeature(feature, featureIndex, parentPath) {
        const featurePath = `${parentPath}[${featureIndex}]`;
        const bodyId = `feature-body-${feature.id}`;

        const valuesHTML = feature.values.map((value, index) =>
            renderValue(value, index, featurePath)
        ).join('');

        const isEditing = activeForm?.type === 'edit-feature' &&
            activeForm.targetId === feature.id;

        return `
        <div class="tree-feature" data-feature-id="${feature.id}">

            <input
                type="hidden"
                name="${featurePath}[name]"
                value="${escapeHTML(feature.name)}"
                data-feature-name="${feature.id}"
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

                    ${isEditing ? `
                        <input
                            type="text"
                            class="tree-edit-input"
                            data-edit-name
                            value="${escapeHTML(feature.name)}"
                        >
                        <button
                            type="button"
                            class="tree-action"
                            data-action="save-edit"
                            data-id="${feature.id}"
                            data-type="feature"
                        >ذخیره</button>
                        <button
                            type="button"
                            class="tree-action tree-action-danger"
                            data-action="cancel-edit"
                        >انصراف</button>
                    ` : `
                        <span>${escapeHTML(feature.name)}</span>
                    `}

                    <span class="pf-hint">
                        (${feature.values.length} مقدار)
                    </span>
                </div>

                ${!isEditing ? `
                    <div class="tree-actions">
                        <button
                            type="button"
                            class="tree-action"
                            data-action="edit-feature"
                            data-id="${feature.id}"
                        >✎ ویرایش</button>

                        <button
                            type="button"
                            class="tree-action"
                            data-action="add-value"
                            data-id="${feature.id}"
                        >＋ افزودن مقدار</button>

                        <button
                            type="button"
                            class="tree-action tree-action-danger"
                            data-action="delete-feature"
                            data-id="${feature.id}"
                        >حذف</button>
                    </div>
                ` : ''}
            </div>

            ${feature.open ? `
                <div class="tree-feature-body" id="${bodyId}">
                    ${valuesHTML}
                    ${renderAddForm('value', feature.id)}
                </div>
            ` : ''}
        </div>
    `;
    }

    function renderValue(value, valueIndex, featurePath) {
        const valuePath = `${featurePath}[values][${valueIndex}]`;
        const hasChildren = value.children.length > 0;

        const childrenHTML = value.children.map((feature, index) =>
            renderFeature(feature, index, `${valuePath}[children]`)
        ).join('');

        const isEditing = activeForm?.type === 'edit-value' &&
            activeForm.targetId === value.id;

        return `
        <div class="tree-value" data-value-id="${value.id}">

            <input
                type="hidden"
                name="${valuePath}[name]"
                value="${escapeHTML(value.name)}"
                data-value-name="${value.id}"
            >

            <div class="tree-value-head">
                <div class="tree-value-name">
                    <span class="tree-value-dot"></span>

                    ${isEditing ? `
                        <input
                            type="text"
                            class="tree-edit-input"
                            data-edit-name
                            value="${escapeHTML(value.name)}"
                        >

                        <button
                            type="button"
                            class="tree-action"
                            data-action="save-edit"
                            data-id="${value.id}"
                            data-type="value"
                        >ذخیره</button>

                        <button
                            type="button"
                            class="tree-action tree-action-danger"
                            data-action="cancel-edit"
                        >انصراف</button>
                    ` : `
                        <span>${escapeHTML(value.name)}</span>
                    `}

                    ${hasChildren
                ? `<span class="pf-hint">دارای ${value.children.length} زیرشاخه</span>`
                : `<span class="pf-hint">ترکیب نهایی</span>`
            }
                </div>

                ${!isEditing ? `
                    <div class="tree-actions">
                        <button
                            type="button"
                            class="tree-action"
                            data-action="edit-value"
                            data-id="${value.id}"
                        >✎ ویرایش</button>

                        <button
                            type="button"
                            class="tree-action"
                            data-action="add-child-feature"
                            data-id="${value.id}"
                        >＋ افزودن زیرشاخه</button>

                        ${hasChildren ? `
                            <button
                                type="button"
                                class="tree-toggle"
                                data-action="toggle-value"
                                data-id="${value.id}"
                            >
                                ${value.open ? '−' : '+'}
                            </button>
                        ` : ''}

                        <button
                            type="button"
                            class="tree-action tree-action-danger"
                            data-action="delete-value"
                            data-id="${value.id}"
                        >حذف</button>
                    </div>
                ` : ''}
            </div>

            ${renderPriceInputs(value, valuePath)}

            ${hasChildren && value.open ? `
                <div class="tree-children">
                    ${childrenHTML}
                </div>
            ` : ''}

            ${renderAddForm('feature', value.id)}
        </div>
    `;
    }

    function renderTree() {
        root.innerHTML = productFeatures.map((feature, index) =>
            renderFeature(feature, index, 'product_features')
        ).join('') + renderAddForm('root', '');

        const counts = countTree(productFeatures);

        featureCount.textContent = counts.features.toLocaleString('fa-IR');
        valueCount.textContent = counts.values.toLocaleString('fa-IR');
        leafCount.textContent = counts.leaves.toLocaleString('fa-IR');

        // emptyState.classList.toggle('hidden', productFeatures.length > 0);

        if (activeForm) {
            requestAnimationFrame(() => {
                const input = root.querySelector('[data-add-name]');
                if (input) input.focus();
            });
        }
    }

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

    function addFeature(name, targetValueId = null) {
        const feature = {
            id: uid(),
            name,
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
        if (!feature) return;

        feature.values.push({
            id: uid(),
            name,
            originalPrice: '',
            specialPrice: '',
            open: true,
            children: []
        });

        feature.open = true;
    }

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

    function confirmAdd() {
        const input = root.querySelector('[data-add-name]');
        if (!input) return;

        const name = input.value.trim();

        if (!name) {
            input.focus();
            return;
        }

        if (activeForm.type === 'root') {
            addFeature(name);
        }

        if (activeForm.type === 'feature') {
            addFeature(name, activeForm.targetId);
        }

        if (activeForm.type === 'value') {
            addValue(name, activeForm.targetId);
        }

        activeForm = null;
        renderTree();
    }

    root.addEventListener('click', function (event) {
        const button = event.target.closest('[data-action]');
        if (!button) return;

        const action = button.dataset.action;
        const id = button.dataset.id;

        switch (action) {
            case 'toggle-feature': {
                const feature = findFeature(id);
                if (feature) feature.open = !feature.open;
                renderTree();
                break;
            }

            case 'toggle-value': {
                const value = findValue(id);
                if (value) value.open = !value.open;
                renderTree();
                break;
            }

            case 'add-value':
                openAddForm('value', id);
                break;

            case 'add-child-feature':
                openAddForm('feature', id);
                break;

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
            case 'edit-feature': {
                const feature = findFeature(id);
                if (feature) feature.open = true;

                activeForm = {
                    type: 'edit-feature',
                    targetId: id
                };

                renderTree();
                break;
            }

            case 'edit-value':
                activeForm = {
                    type: 'edit-value',
                    targetId: id
                };

                renderTree();
                break;

            case 'save-edit': {
                const input = root.querySelector('[data-edit-name]');
                const newName = input?.value.trim();

                if (!newName) {
                    input?.focus();
                    return;
                }

                const type = button.dataset.type;

                if (type === 'feature') {
                    const feature = findFeature(id);
                    if (feature) feature.name = newName;
                }

                if (type === 'value') {
                    const value = findValue(id);
                    if (value) value.name = newName;
                }

                activeForm = null;
                renderTree();
                break;
            }

            case 'cancel-edit':
                activeForm = null;
                renderTree();
                break;

            case 'cancel-add':
                activeForm = null;
                renderTree();
                break;
        }
    });

    root.addEventListener('keydown', function (event) {
        if (event.target.matches('[data-add-name]') && event.key === 'Enter') {
            event.preventDefault();
            confirmAdd();
        }
    });

    root.addEventListener('input', function (event) {
        const input = event.target.closest('[data-price-field]');
        if (!input) return;

        const value = findValue(input.dataset.valueId);
        if (!value) return;

        const field = input.dataset.priceField;

        if (field !== 'originalPrice' && field !== 'specialPrice') return;

        value[field] = input.value;
    });

    document.querySelector('#add-root-feature')?.addEventListener('click', function () {
        activeForm = { type: 'root', targetId: '' };
        renderTree();
    });

    renderTree();
});