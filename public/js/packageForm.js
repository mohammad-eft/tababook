"use strict";

const PackageForm = (() => {

    // ================================================
    // تنظیمات
    // ================================================

    // نام ویژگی رنگ (همان ویژگی پیش‌فرضی که با ساخت دسته‌بندی اضافه می‌شود)
    const COLOR_ATTRIBUTE_KEY = "رنگ";


    // ================================================
    // عناصر اصلی
    // ================================================

    const productAttributesList = document.getElementById("product-attributes-list");
    const packagesList = document.getElementById("packages-list");

    const attributeTemplate = document.getElementById("attribute-template");
    const attributeValueTemplate = document.getElementById("attribute-value-template");
    const packageTemplate = document.getElementById("package-template");

    const categorySelect = document.getElementById("category_ids");


    // ================================================
    // دریافت دسته‌بندی‌های انتخاب‌شده
    // ================================================

    function getSelectedCategories() {

        if (!categorySelect) {
            return [];
        }

        return Array.from(categorySelect.selectedOptions)
            .map(option => option.value);

    }


    // ================================================
    // دریافت ویژگی‌های دسته‌بندی‌های انتخاب‌شده
    // ================================================

    function getAvailableAttributes() {

        const attributes = [];
        const uniqueAttributeIds = new Set();

        getSelectedCategories().forEach(categoryId => {

            const category = window.CATEGORIES?.[categoryId];

            if (!category) {
                return;
            }

            (category.attributes || []).forEach(attribute => {

                // جلوگیری از نمایش ویژگی تکراری
                if (uniqueAttributeIds.has(String(attribute.id))) {
                    return;
                }

                uniqueAttributeIds.add(String(attribute.id));

                attributes.push({
                    ...attribute,
                    categoryId: categoryId,
                    categoryName: category.name || "ویژگی‌ها"
                });

            });

        });

        return attributes;

    }


    // ================================================
    // آیا ویژگی انتخاب‌شده «رنگ» است؟
    // ================================================

    function isColorAttribute(attributeId) {

        if (!attributeId) {
            return false;
        }

        const attribute = getAvailableAttributes().find(
            item => String(item.id) === String(attributeId)
        );

        if (!attribute) {
            return false;
        }

        // اگر در دیتابیس فیلد type داری، همان اولویت دارد
        return attribute.type === "color" || attribute.key === COLOR_ATTRIBUTE_KEY;

    }


    // ================================================
    // نوع اینپوت مقدار برای یک آیتم ویژگی
    // ================================================

    function getInputTypeForItem(attributeItem) {

        const select = attributeItem.querySelector(".attribute-select");

        return isColorAttribute(select?.value) ? "color" : "text";

    }


    // ================================================
    // اعمال نوع اینپوت روی تمام مقادیر یک آیتم
    // ================================================

    function applyInputType(attributeItem) {

        const type = getInputTypeForItem(attributeItem);

        attributeItem
            .querySelectorAll(".attribute-value-input")
            .forEach(input => {

                // اگر نوع تغییری نکرده، کاری نکن
                if (input.type === type) {
                    return;
                }

                input.type = type;

                // مقدار قبلی با نوع جدید سازگار نیست
                input.value = type === "color" ? "#000000" : "";

            });

    }


    // ================================================
    // ساخت گزینه‌های عنوان ویژگی (فقط دسته‌های انتخاب‌شده)
    // ================================================

    function fillAttributeOptions(select) {

        const previousValue = select.value;

        select.innerHTML = "";

        // گزینه پیش‌فرض
        const defaultOption = document.createElement("option");

        defaultOption.value = "";

        defaultOption.textContent = getSelectedCategories().length
            ? "انتخاب ویژگی"
            : "ابتدا دسته‌بندی را انتخاب کنید";

        select.appendChild(defaultOption);

        const availableAttributes = getAvailableAttributes();

        // گروه‌بندی ویژگی‌ها بر اساس دسته
        const groupedAttributes = {};

        availableAttributes.forEach(attribute => {

            if (!groupedAttributes[attribute.categoryName]) {
                groupedAttributes[attribute.categoryName] = [];
            }

            groupedAttributes[attribute.categoryName].push(attribute);

        });

        Object.entries(groupedAttributes).forEach(([categoryName, attributes]) => {

            const optgroup = document.createElement("optgroup");

            optgroup.label = categoryName;

            attributes.forEach(attribute => {

                const option = document.createElement("option");

                option.value = attribute.id;
                option.textContent = attribute.key;

                optgroup.appendChild(option);

            });

            select.appendChild(optgroup);

        });

        // حفظ انتخاب قبلی در صورت مجاز بودن
        const stillAvailable = availableAttributes.some(
            attribute => String(attribute.id) === String(previousValue)
        );

        select.value = stillAvailable ? previousValue : "";

    }


    // ================================================
    // به‌روزرسانی ویژگی‌های کل فرم هنگام تغییر دسته‌بندی
    // ================================================

    function refreshSelects(container) {

        container
            ?.querySelectorAll(".attribute-select")
            .forEach(select => {

                const previousValue = select.value;

                fillAttributeOptions(select);

                const attributeItem = select.closest(".attribute-item");

                if (previousValue && select.value === "") {

                    // ویژگی دیگر متعلق به دسته‌های انتخاب‌شده نیست
                    attributeItem?.remove();

                } else if (attributeItem) {

                    // ممکن است ویژگی همان بماند ولی نوعش نیاز به بازبینی داشته باشد
                    applyInputType(attributeItem);

                }

            });

    }

    function updateAttributeOptions() {

        refreshSelects(productAttributesList);
        refreshSelects(packagesList);

        reindex();

    }


    // ================================================
    // ساخت input مقدار ویژگی
    // ================================================

    function createValueInput(type, value = "") {

        const wrapper = attributeValueTemplate.content
            .firstElementChild
            .cloneNode(true);

        const input = wrapper.querySelector(".attribute-value-input");

        input.type = ["text", "number", "color", "date"].includes(type)
            ? type
            : "text";

        if (type === "color") {
            input.value = value || "#000000";
        } else {
            input.value = value;
        }

        if (type === "number") {
            input.min = "0";
        }

        return wrapper;

    }


    // ================================================
    // افزودن مقدار جدید به ویژگی
    // ================================================

    function addValue(attributeItem, value = "") {

        // نوع اینپوت بر اساس ویژگی انتخاب‌شده
        const type = getInputTypeForItem(attributeItem);

        const valuesContainer = attributeItem.querySelector(".attribute-values");

        const valueElement = createValueInput(type, value);

        // حذف مقدار
        valueElement
            .querySelector(".remove-attribute-value")
            .addEventListener("click", () => {

                valueElement.remove();

                reindex();

            });

        valuesContainer.appendChild(valueElement);

        reindex();

    }


    // ================================================
    // ساخت یک ویژگی
    // ================================================

    function createAttributeItem() {

        const item = attributeTemplate.content
            .firstElementChild
            .cloneNode(true);

        const attributeSelect = item.querySelector(".attribute-select");

        // فقط ویژگی‌های دسته‌های انتخاب‌شده
        fillAttributeOptions(attributeSelect);

        // تغییر نوع اینپوت‌ها با تغییر ویژگی (رنگ => color، غیر از آن => text)
        attributeSelect.addEventListener("change", () => {

            applyInputType(item);

        });

        // افزودن مقدار
        item
            .querySelector(".add-attribute-value")
            .addEventListener("click", () => {

                addValue(item);

            });

        // حذف ویژگی
        item
            .querySelector(".remove-attribute")
            .addEventListener("click", () => {

                item.remove();

                reindex();

            });

        return item;

    }


    // ================================================
    // افزودن ویژگی عمومی محصول
    // ================================================

    function addProductAttribute() {

        if (getSelectedCategories().length === 0) {

            alert("ابتدا یک دسته‌بندی برای محصول انتخاب کنید.");

            return;

        }

        const item = createAttributeItem();

        productAttributesList.appendChild(item);

        // مقدار اولیه
        addValue(item);

        reindex();

    }


    // ================================================
    // افزودن ویژگی به پکیج
    // ================================================

    function addPackageAttribute(packageItem) {

        if (getSelectedCategories().length === 0) {

            alert("ابتدا یک دسته‌بندی برای محصول انتخاب کنید.");

            return;

        }

        const attributesList = packageItem.querySelector(".package-attributes-list");

        const item = createAttributeItem();

        attributesList.appendChild(item);

        // مقدار اولیه
        addValue(item);

        reindex();

    }


    // ================================================
    // افزودن پکیج
    // ================================================

    function addPackage() {

        const packageItem = packageTemplate.content
            .firstElementChild
            .cloneNode(true);

        // حذف پکیج
        packageItem
            .querySelector(".remove-package")
            .addEventListener("click", () => {

                packageItem.remove();

                reindex();

            });

        // افزودن ویژگی به پکیج
        packageItem
            .querySelector(".add-package-attribute")
            .addEventListener("click", () => {

                addPackageAttribute(packageItem);

            });

        packagesList.appendChild(packageItem);

        reindex();

    }


    // ================================================
    // تنظیم name فیلدها
    // ================================================

    function reindex() {

        // --------------------------------------------
        // ویژگی‌های عمومی محصول
        // --------------------------------------------

        productAttributesList
            ?.querySelectorAll(".attribute-item")
            .forEach((attributeItem, attributeIndex) => {

                attributeItem.querySelector(".attribute-select").name =
                    `attributes[${attributeIndex}][attribute_id]`;

                attributeItem
                    .querySelectorAll(".attribute-value-input")
                    .forEach((input, valueIndex) => {

                        input.name =
                            `attributes[${attributeIndex}][values][${valueIndex}]`;

                    });

            });


        // --------------------------------------------
        // پکیج‌ها
        // --------------------------------------------

        packagesList
            ?.querySelectorAll(".package-item")
            .forEach((packageItem, packageIndex) => {

                packageItem.querySelector(".package-count").name =
                    `packages[${packageIndex}][count]`;

                packageItem.querySelector(".package-primary-price").name =
                    `packages[${packageIndex}][primary_price]`;

                packageItem.querySelector(".package-secondary-price").name =
                    `packages[${packageIndex}][secondary_price]`;


                // ویژگی‌های هر پکیج
                packageItem
                    .querySelectorAll(".attribute-item")
                    .forEach((attributeItem, attributeIndex) => {

                        attributeItem.querySelector(".attribute-select").name =
                            `packages[${packageIndex}][attributes][${attributeIndex}][attribute_id]`;

                        attributeItem
                            .querySelectorAll(".attribute-value-input")
                            .forEach((input, valueIndex) => {

                                input.name =
                                    `packages[${packageIndex}][attributes][${attributeIndex}][values][${valueIndex}]`;

                            });

                    });

            });

    }


    // ================================================
    // راه‌اندازی
    // ================================================

    function init() {

        // تغییر دسته‌بندی محصول
        categorySelect?.addEventListener("change", updateAttributeOptions);

        // افزودن ویژگی عمومی محصول
        document
            .getElementById("add-product-attribute")
            ?.addEventListener("click", addProductAttribute);

        // افزودن پکیج
        document
            .getElementById("add-package")
            ?.addEventListener("click", addPackage);

    }


    // ================================================
    // خروجی
    // ================================================

    return {
        init,
        addPackage,
        addProductAttribute,
        addPackageAttribute,
        reindex,
        updateAttributeOptions
    };

})();


// ================================================
// اجرای برنامه پس از بارگذاری صفحه
// ================================================

document.addEventListener("DOMContentLoaded", () => {

    PackageForm.init();

});
