
// "use strict";

// const PackageForm = (() => {

//     // ================================================
//     // عناصر اصلی
//     // ================================================

//     const productAttributesList = document.getElementById(
//         "product-attributes-list"
//     );

//     const packagesList = document.getElementById(
//         "packages-list"
//     );

//     const attributeTemplate = document.getElementById(
//         "attribute-template"
//     );

//     const attributeValueTemplate = document.getElementById(
//         "attribute-value-template"
//     );

//     const packageTemplate = document.getElementById(
//         "package-template"
//     );


//     // ================================================
//     // ساخت گزینه‌های عنوان ویژگی
//     // ================================================

//     function fillAttributeOptions(select) {

//         select.innerHTML = "";

//         const defaultOption = document.createElement("option");

//         defaultOption.value = "";
//         defaultOption.textContent = "انتخاب ویژگی";

//         select.appendChild(defaultOption);


//         Object.entries(window.CATEGORIES || {}).forEach(
//             ([categoryId, category]) => {

//                 const attributes = category.attributes || [];

//                 if (!attributes.length) return;


//                 const optgroup = document.createElement("optgroup");

//                 optgroup.label = category.name || "ویژگی‌ها";


//                 attributes.forEach(attribute => {

//                     const option = document.createElement("option");

//                     option.value = attribute.id;

//                     option.textContent = attribute.key;

//                     optgroup.appendChild(option);

//                 });


//                 select.appendChild(optgroup);

//             }
//         );

//     }


//     // ================================================
//     // ساخت input مقدار ویژگی
//     // ================================================

//     function createValueInput(type, value = "") {

//         const wrapper = attributeValueTemplate.content
//             .firstElementChild
//             .cloneNode(true);

//         const input = wrapper.querySelector(
//             ".attribute-value-input"
//         );


//         // نوع input
//         if (["text", "number", "color", "date"].includes(type)) {

//             input.type = type;
//             if(type=='color'){
//                 attributeValueTemplate.classList.add('h-10')
//             } else {
//                 attributeValueTemplate.classList.add('h-10')
//             }
//         } else {

//             // select و checkbox در این مرحله مقادیر گزینه‌ها را دریافت می‌کنند
//             input.type = "text";

//         }


//         // مقدار پیش‌فرض
//         if (type === "color") {

//             input.value = value || "#000000";

//         } else {

//             input.value = value;

//         }


//         // محدودیت عدد
//         if (type === "number") {

//             input.min = "0";

//         }


//         return wrapper;

//     }


//     // ================================================
//     // افزودن مقدار جدید
//     // ================================================

//     function addValue(attributeItem, value = "") {

//         const type = attributeItem.querySelector(
//             ".attribute-input-type"
//         ).value;


//         const valuesContainer = attributeItem.querySelector(
//             ".attribute-values"
//         );


//         const valueElement = createValueInput(type, value);


//         // حذف مقدار
//         valueElement.querySelector(
//             ".remove-attribute-value"
//         ).addEventListener("click", () => {

//             valueElement.remove();

//             reindex();

//         });


//         valuesContainer.appendChild(valueElement);


//         reindex();

//     }


//     // ================================================
//     // تغییر نوع ورودی ویژگی
//     // ================================================

//     function changeAttributeInputType(attributeItem) {

//         const type = attributeItem.querySelector(
//             ".attribute-input-type"
//         ).value;


//         const valuesContainer = attributeItem.querySelector(
//             ".attribute-values"
//         );


//         // مقادیر قبلی را حذف می‌کنیم
//         valuesContainer.innerHTML = "";


//         // حداقل یک مقدار ایجاد می‌کنیم
//         addValue(attributeItem);


//     }


//     // ================================================
//     // ساخت یک ویژگی
//     // ================================================

//     function createAttributeItem() {

//         const item = attributeTemplate.content
//             .firstElementChild
//             .cloneNode(true);


//         // Select عنوان ویژگی
//         const attributeSelect = item.querySelector(
//             ".attribute-select"
//         );


//         fillAttributeOptions(attributeSelect);


//         // Select نوع ورودی
//         const inputTypeSelect = item.querySelector(
//             ".attribute-input-type"
//         );


//         // تغییر نوع ورودی
//         inputTypeSelect.addEventListener("change", () => {

//             changeAttributeInputType(item);

//         });


//         // افزودن مقدار
//         item.querySelector(
//             ".add-attribute-value"
//         ).addEventListener("click", () => {

//             addValue(item);

//         });


//         // حذف ویژگی
//         item.querySelector(
//             ".remove-attribute"
//         ).addEventListener("click", () => {

//             item.remove();

//             reindex();

//         });


//         return item;

//     }


//     // ================================================
//     // افزودن ویژگی عمومی محصول
//     // ================================================

//     function addProductAttribute() {

//         const item = createAttributeItem();


//         productAttributesList.appendChild(item);


//         // مقدار اولیه
//         addValue(item);


//         reindex();

//     }


//     // ================================================
//     // افزودن ویژگی به پکیج
//     // ================================================

//     function addPackageAttribute(packageItem) {

//         const attributesList = packageItem.querySelector(
//             ".package-attributes-list"
//         );


//         const item = createAttributeItem();


//         attributesList.appendChild(item);


//         // مقدار اولیه
//         addValue(item);


//         reindex();

//     }


//     // ================================================
//     // افزودن پکیج
//     // ================================================

//     function addPackage() {

//         const packageItem = packageTemplate.content
//             .firstElementChild
//             .cloneNode(true);


//         // حذف پکیج
//         packageItem.querySelector(
//             ".remove-package"
//         ).addEventListener("click", () => {

//             packageItem.remove();

//             reindex();

//         });


//         // افزودن ویژگی به پکیج
//         packageItem.querySelector(
//             ".add-package-attribute"
//         ).addEventListener("click", () => {

//             addPackageAttribute(packageItem);

//         });


//         packagesList.appendChild(packageItem);


//         reindex();

//     }


//     // ================================================
//     // تنظیم name فیلدها
//     // ================================================

//     function reindex() {


//         // --------------------------------------------
//         // ویژگی‌های عمومی محصول
//         // --------------------------------------------

//         productAttributesList
//             .querySelectorAll(".attribute-item")
//             .forEach((attributeItem, attributeIndex) => {


//                 // شناسه ویژگی
//                 attributeItem.querySelector(
//                     ".attribute-select"
//                 ).name = `attributes[${attributeIndex}][attribute_id]`;


//                 // نوع ورودی
//                 attributeItem.querySelector(
//                     ".attribute-input-type"
//                 ).name = `attributes[${attributeIndex}][input_type]`;


//                 // مقادیر
//                 attributeItem.querySelectorAll(
//                     ".attribute-value-input"
//                 ).forEach((input, valueIndex) => {

//                     input.name =
//                         `attributes[${attributeIndex}][values][${valueIndex}]`;

//                 });

//             });



//         // --------------------------------------------
//         // پکیج‌ها
//         // --------------------------------------------

//         packagesList
//             .querySelectorAll(".package-item")
//             .forEach((packageItem, packageIndex) => {


//                 // عنوان
//                 packageItem.querySelector(
//                     ".package-title"
//                 ).name = `packages[${packageIndex}][title]`;


//                 // تعداد
//                 packageItem.querySelector(
//                     ".package-count"
//                 ).name = `packages[${packageIndex}][count]`;


//                 // قیمت اصلی
//                 packageItem.querySelector(
//                     ".package-primary-price"
//                 ).name = `packages[${packageIndex}][primary_price]`;


//                 // قیمت ثانویه
//                 packageItem.querySelector(
//                     ".package-secondary-price"
//                 ).name = `packages[${packageIndex}][secondary_price]`;


//                 // تصویر
//                 packageItem.querySelector(
//                     ".package-image"
//                 ).name = `packages[${packageIndex}][image]`;


//                 // خلاصه
//                 packageItem.querySelector(
//                     ".package-summary"
//                 ).name = `packages[${packageIndex}][summary]`;


//                 // توضیحات
//                 packageItem.querySelector(
//                     ".package-description"
//                 ).name = `packages[${packageIndex}][description]`;


//                 // نمایش در صفحه اصلی
//                 packageItem.querySelector(
//                     ".package-show-in-home"
//                 ).name = `packages[${packageIndex}][show_in_home]`;




//                 // ----------------------------------------
//                 // ویژگی‌های هر پکیج
//                 // ----------------------------------------

//                 packageItem
//                     .querySelectorAll(".attribute-item")
//                     .forEach((attributeItem, attributeIndex) => {


//                         // شناسه ویژگی
//                         attributeItem.querySelector(
//                             ".attribute-select"
//                         ).name =
//                             `packages[${packageIndex}][attributes][${attributeIndex}][attribute_id]`;


//                         // نوع ورودی
//                         attributeItem.querySelector(
//                             ".attribute-input-type"
//                         ).name =
//                             `packages[${packageIndex}][attributes][${attributeIndex}][input_type]`;


//                         // مقادیر
//                         attributeItem.querySelectorAll(
//                             ".attribute-value-input"
//                         ).forEach((input, valueIndex) => {

//                             input.name =
//                                 `packages[${packageIndex}][attributes][${attributeIndex}][values][${valueIndex}]`;

//                         });

//                     });

//             });

//     }


//     // ================================================
//     // راه‌اندازی
//     // ================================================

//     function init() {


//         // افزودن ویژگی محصول
//         document.getElementById(
//             "add-product-attribute"
//         )?.addEventListener("click", addProductAttribute);


//         // افزودن پکیج
//         document.getElementById(
//             "add-package"
//         )?.addEventListener("click", addPackage);

//     }


//     // ================================================
//     // خروجی
//     // ================================================

//     return {

//         init,

//         addPackage,

//         addProductAttribute,

//         addPackageAttribute,

//         reindex

//     };


// })();


// // ================================================
// // اجرای برنامه پس از بارگذاری صفحه
// // ================================================

// document.addEventListener("DOMContentLoaded", () => {

//     PackageForm.init();

// });


"use strict";

const PackageForm = (() => {

    // ================================================
    // عناصر اصلی
    // ================================================

    const productAttributesList = document.getElementById(
        "product-attributes-list"
    );

    const packagesList = document.getElementById(
        "packages-list"
    );

    const attributeTemplate = document.getElementById(
        "attribute-template"
    );

    const attributeValueTemplate = document.getElementById(
        "attribute-value-template"
    );

    const packageTemplate = document.getElementById(
        "package-template"
    );

    const categorySelect = document.getElementById(
        "category_ids"
    );


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

        const selectedCategoryIds = getSelectedCategories();

        const attributes = [];

        const uniqueAttributeIds = new Set();


        selectedCategoryIds.forEach(categoryId => {

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
    // ساخت گزینه‌های عنوان ویژگی
    // فقط ویژگی‌های دسته‌های انتخاب‌شده
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


        // دریافت ویژگی‌های مجاز
        const availableAttributes = getAvailableAttributes();


        // گروه‌بندی ویژگی‌ها بر اساس دسته
        const groupedAttributes = {};


        availableAttributes.forEach(attribute => {

            const categoryName = attribute.categoryName;

            if (!groupedAttributes[categoryName]) {
                groupedAttributes[categoryName] = [];
            }

            groupedAttributes[categoryName].push(attribute);

        });


        // ساخت optgroup ها
        Object.entries(groupedAttributes).forEach(
            ([categoryName, attributes]) => {

                const optgroup = document.createElement("optgroup");

                optgroup.label = categoryName;


                attributes.forEach(attribute => {

                    const option = document.createElement("option");

                    option.value = attribute.id;

                    option.textContent = attribute.key;

                    optgroup.appendChild(option);

                });


                select.appendChild(optgroup);

            }
        );


        // حفظ انتخاب قبلی در صورت مجاز بودن
        const stillAvailable = availableAttributes.some(
            attribute => String(attribute.id) === String(previousValue)
        );

        if (stillAvailable) {
            select.value = previousValue;
        } else {
            select.value = "";
        }

    }


    // ================================================
    // به‌روزرسانی ویژگی‌های تمام فرم
    // هنگام تغییر دسته‌بندی
    // ================================================

    function updateAttributeOptions() {

        // ویژگی‌های عمومی محصول
        productAttributesList
            ?.querySelectorAll(".attribute-select")
            .forEach(select => {

                const previousValue = select.value;

                fillAttributeOptions(select);


                // اگر ویژگی دیگر متعلق به دسته‌های انتخاب‌شده نیست
                if (
                    previousValue &&
                    select.value === ""
                ) {

                    const attributeItem = select.closest(
                        ".attribute-item"
                    );

                    // حذف ویژگی نامعتبر از فرم
                    attributeItem?.remove();

                }

            });


        // ویژگی‌های تمام پکیج‌ها
        packagesList
            ?.querySelectorAll(".attribute-select")
            .forEach(select => {

                const previousValue = select.value;

                fillAttributeOptions(select);


                // حذف ویژگی نامعتبر
                if (
                    previousValue &&
                    select.value === ""
                ) {

                    const attributeItem = select.closest(
                        ".attribute-item"
                    );

                    attributeItem?.remove();

                }

            });


        // تنظیم مجدد نام فیلدها
        reindex();

    }


    // ================================================
    // ساخت input مقدار ویژگی
    // ================================================

    function createValueInput(type, value = "") {

        const wrapper = attributeValueTemplate.content
            .firstElementChild
            .cloneNode(true);

        const input = wrapper.querySelector(
            ".attribute-value-input"
        );


        // تعیین نوع ورودی
        if (["text", "number", "color", "date"].includes(type)) {

            input.type = type;

        } else {

            // select و checkbox در حال حاضر
            // مقادیر گزینه‌ها را به‌صورت متن دریافت می‌کنند
            input.type = "text";

        }


        // مقدار پیش‌فرض
        if (type === "color") {

            input.value = value || "#000000";

        } else {

            input.value = value;

        }


        // محدودیت مقدار عددی
        if (type === "number") {

            input.min = "0";

        }


        return wrapper;

    }


    // ================================================
    // افزودن مقدار جدید به ویژگی
    // ================================================

    function addValue(attributeItem, value = "") {

        const type = attributeItem.querySelector(
            ".attribute-input-type"
        ).value;


        const valuesContainer = attributeItem.querySelector(
            ".attribute-values"
        );


        const valueElement = createValueInput(type, value);


        // حذف مقدار
        valueElement.querySelector(
            ".remove-attribute-value"
        ).addEventListener("click", () => {

            valueElement.remove();

            reindex();

        });


        valuesContainer.appendChild(valueElement);

        reindex();

    }


    // ================================================
    // تغییر نوع ورودی ویژگی
    // ================================================

    function changeAttributeInputType(attributeItem) {

        const type = attributeItem.querySelector(
            ".attribute-input-type"
        ).value;


        const valuesContainer = attributeItem.querySelector(
            ".attribute-values"
        );


        // حذف مقادیر قبلی
        valuesContainer.innerHTML = "";


        // ایجاد یک مقدار جدید
        addValue(attributeItem);

    }


    // ================================================
    // ساخت یک ویژگی
    // ================================================

    function createAttributeItem() {

        const item = attributeTemplate.content
            .firstElementChild
            .cloneNode(true);


        // عنوان ویژگی
        const attributeSelect = item.querySelector(
            ".attribute-select"
        );


        // فقط ویژگی‌های دسته‌های انتخاب‌شده
        fillAttributeOptions(attributeSelect);


        // نوع ورودی ویژگی
        const inputTypeSelect = item.querySelector(
            ".attribute-input-type"
        );


        // تغییر نوع ورودی
        inputTypeSelect.addEventListener("change", () => {

            changeAttributeInputType(item);

        });


        // افزودن مقدار
        item.querySelector(
            ".add-attribute-value"
        ).addEventListener("click", () => {

            addValue(item);

        });


        // حذف ویژگی
        item.querySelector(
            ".remove-attribute"
        ).addEventListener("click", () => {

            item.remove();

            reindex();

        });


        return item;

    }


    // ================================================
    // افزودن ویژگی عمومی محصول
    // ================================================

    function addProductAttribute() {

        // بدون انتخاب دسته امکان افزودن ویژگی وجود ندارد
        if (getSelectedCategories().length === 0) {

            alert("ابتدا یک دسته‌بندی برای محصول انتخاب کنید.");

            return;

        }


        const item = createAttributeItem();


        productAttributesList.appendChild(item);


        // مقدار اولیه ویژگی
        addValue(item);


        reindex();

    }


    // ================================================
    // افزودن ویژگی به پکیج
    // ================================================

    function addPackageAttribute(packageItem) {

        // بدون انتخاب دسته امکان افزودن ویژگی وجود ندارد
        if (getSelectedCategories().length === 0) {

            alert("ابتدا یک دسته‌بندی برای محصول انتخاب کنید.");

            return;

        }


        const attributesList = packageItem.querySelector(
            ".package-attributes-list"
        );


        const item = createAttributeItem();


        attributesList.appendChild(item);


        // مقدار اولیه ویژگی
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
        packageItem.querySelector(
            ".remove-package"
        ).addEventListener("click", () => {

            packageItem.remove();

            reindex();

        });


        // افزودن ویژگی به پکیج
        packageItem.querySelector(
            ".add-package-attribute"
        ).addEventListener("click", () => {

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
            .querySelectorAll(".attribute-item")
            .forEach((attributeItem, attributeIndex) => {


                // شناسه ویژگی
                attributeItem.querySelector(
                    ".attribute-select"
                ).name = `attributes[${attributeIndex}][attribute_id]`;


                // نوع ورودی
                attributeItem.querySelector(
                    ".attribute-input-type"
                ).name = `attributes[${attributeIndex}][input_type]`;


                // مقادیر ویژگی
                attributeItem.querySelectorAll(
                    ".attribute-value-input"
                ).forEach((input, valueIndex) => {

                    input.name =
                        `attributes[${attributeIndex}][values][${valueIndex}]`;

                });

            });



        // --------------------------------------------
        // پکیج‌ها
        // --------------------------------------------

        packagesList
            .querySelectorAll(".package-item")
            .forEach((packageItem, packageIndex) => {


                // عنوان
                packageItem.querySelector(
                    ".package-title"
                ).name = `packages[${packageIndex}][title]`;


                // تعداد
                packageItem.querySelector(
                    ".package-count"
                ).name = `packages[${packageIndex}][count]`;


                // قیمت اصلی
                packageItem.querySelector(
                    ".package-primary-price"
                ).name = `packages[${packageIndex}][primary_price]`;


                // قیمت ثانویه
                packageItem.querySelector(
                    ".package-secondary-price"
                ).name = `packages[${packageIndex}][secondary_price]`;


                // تصویر
                packageItem.querySelector(
                    ".package-image"
                ).name = `packages[${packageIndex}][image]`;


                // خلاصه
                packageItem.querySelector(
                    ".package-summary"
                ).name = `packages[${packageIndex}][summary]`;


                // توضیحات
                packageItem.querySelector(
                    ".package-description"
                ).name = `packages[${packageIndex}][description]`;


                // نمایش در صفحه اصلی
                packageItem.querySelector(
                    ".package-show-in-home"
                ).name = `packages[${packageIndex}][show_in_home]`;




                // ----------------------------------------
                // ویژگی‌های هر پکیج
                // ----------------------------------------

                packageItem
                    .querySelectorAll(".attribute-item")
                    .forEach((attributeItem, attributeIndex) => {


                        // شناسه ویژگی
                        attributeItem.querySelector(
                            ".attribute-select"
                        ).name =
                            `packages[${packageIndex}][attributes][${attributeIndex}][attribute_id]`;


                        // نوع ورودی
                        attributeItem.querySelector(
                            ".attribute-input-type"
                        ).name =
                            `packages[${packageIndex}][attributes][${attributeIndex}][input_type]`;


                        // مقادیر
                        attributeItem.querySelectorAll(
                            ".attribute-value-input"
                        ).forEach((input, valueIndex) => {

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
        categorySelect?.addEventListener("change", () => {

            updateAttributeOptions();

        });


        // افزودن ویژگی عمومی محصول
        document.getElementById(
            "add-product-attribute"
        )?.addEventListener("click", addProductAttribute);


        // افزودن پکیج
        document.getElementById(
            "add-package"
        )?.addEventListener("click", addPackage);

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
