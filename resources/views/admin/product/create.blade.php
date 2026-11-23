@extends('admin.app.dashboard')

@section('title', 'طبابوک | ایجاد محصول')

@section('content')
    <style>

        #brand_id, #publication_id{
            background-color: #f8f9fb !important;
        }

        input[type=text], input[type=number], input[type=file], select, textarea{
            background-color: #f8f9fb !important;
            border: 1px solid #f8f9fb !important;
            padding-block: 8px !important;
        }
        .product-form-shell {
            --pf-primary: #4C6B62;
            --pf-primary-dark: #3B554D;
            --pf-border: #E9E2D9;
            --pf-muted: #87978F;
            --pf-accent: #EA9CA1;
            --pf-accent-soft: #F5E8E6;
            --pf-sage: #95ADA2;
            --pf-lavender: #B4A0D4;
            color: #344B43;
        }

        .product-form-shell .pf-card {
            background: #fff;
            border: 1px solid var(--pf-border);
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 5px 22px rgba(76, 107, 98, .07);
        }
        .product-form-shell .pf-card select, input{
            background-color: #fff !important;
        }

        .product-form-shell .pf-card-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 16px;
            margin-bottom: 18px;
            border-bottom: 1px solid #F0EAE2;
        }

        .product-form-shell .pf-card-title {
            font-size: 15px;
            font-weight: 800;
            color: #344B43;
        }

        .product-form-shell .pf-card-desc {
            margin-top: 5px;
            color: var(--pf-muted);
            font-size: 12px;
            line-height: 1.9;
        }

        .product-form-shell label {
            display: block;
            margin-bottom: 8px;
            color: #465F56;
            font-size: 13px;
            font-weight: 650;
        }

        /* چیدمان اختصاصی گزینه‌های دسته‌بندی؛ جلوگیری از override شدن flex توسط استایل عمومی label */
        .product-form-shell label[data-category-option] {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            width: 100%;
            margin: 0;
            text-align: right;
        }

        .product-form-shell label[data-category-option] .category-checkbox {
            display: block;
            width: 16px;
            height: 16px;
            flex: 0 0 16px;
            margin: 0;
        }

        .product-form-shell label[data-category-option]>span.flex-1 {
            display: block;
            min-width: 0;
            flex: 1 1 auto;
            margin: 0;
            line-height: 1.8;
            white-space: normal;
        }

        .product-form-shell input:not([type=checkbox]):not([type=file]):not([type=color]),
        .product-form-shell textarea,
        .product-form-shell select:not(.attribute-select) {
            width: 100%;
            min-width: 0;
            border: 1px solid #E8E3DA;
            border-radius: 11px;
            background: #FBF6EF;
            padding: 11px 13px;
            color: #465F56;
            font-size: 13px;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .product-form-shell input:focus,
        .product-form-shell textarea:focus,
        .product-form-shell select:focus {
            border-color: #95ADA2;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(76, 107, 98, .12);
        }

        .product-form-shell input::placeholder,
        .product-form-shell textarea::placeholder {
            color: #A6ADA6;
        }

        .product-form-shell input[type=file] {
            width: 100%;
            border: 1px dashed #D8D0C5;
            border-radius: 12px;
            background: #FBF6EF;
            padding: 12px;
            color: #65766E;
            font-size: 12px;
        }

        .product-form-shell .pf-field {
            min-width: 0;
        }

        .product-form-shell .pf-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border-radius: 11px;
            padding: 10px 15px;
            font-size: 12px;
            font-weight: 700;
            transition: .2s;
        }

        .product-form-shell .pf-btn-primary {
            background: #4C6B62;
            color: white;
            box-shadow: 0 5px 12px rgba(76, 107, 98, .18);
        }

        .product-form-shell .pf-btn-primary:hover {
            background: #3B554D;
            transform: translateY(-1px);
        }

        .product-form-shell .pf-btn-soft {
            background: #F5E8E6;
            color: #4C6B62;
        }

        .product-form-shell .pf-btn-soft:hover {
            background: #EDE4DA;
        }

        .product-form-shell .pf-danger {
            background: #FBEAEC;
            color: #C65D6D;
            border-radius: 9px;
            padding: 8px 11px;
            font-size: 12px;
            font-weight: 650;
        }

        .product-form-shell .pf-danger:hover {
            background: #F6DADD;
        }

        .product-form-shell .attribute-item,
        .product-form-shell .package-item {
            border: 1px solid #E8E3DA;
            border-radius: 15px;
            padding: 17px;
            background: #FBF6EF;
        }

        .product-form-shell .attribute-item input,
        .product-form-shell .attribute-item select,
        .product-form-shell .package-item input,
        .product-form-shell .package-item select {
            border: 1px solid #E8E3DA;
            border-radius: 10px;
            padding: 10px 12px;
            background: white;
            width: 100%;
            min-width: 0;
            font-size: 13px;
            outline: none;
        }

        .product-form-shell .attribute-value-input[type=color] {
            height: 2.75rem;
            padding: 4px;
            cursor: pointer;
            flex: 0 0 6rem;
        }

        .product-form-shell .attribute-value-input[type=color]::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        .product-form-shell .attribute-value-input[type=color]::-webkit-color-swatch,
        .product-form-shell .attribute-value-input[type=color]::-moz-color-swatch {
            border: 0;
            border-radius: .5rem;
        }

        .product-form-shell .pf-error {
            display: block;
            margin-top: 6px;
            color: #D96F7D;
            font-size: 11px;
        }

        .product-form-shell .category-checkbox {
            accent-color: #4C6B62;
        }

        .product-form-shell [data-category-option].is-selected {
            background: #EDF3EF;
        }

        .product-form-shell .category-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            max-width: 100%;
            border: 1px solid #DCE8DF;
            border-radius: 999px;
            background: #EDF3EF;
            padding: 6px 9px;
            color: #4C6B62;
            font-size: 11px;
            font-weight: 700;
        }

        .product-form-shell .category-chip button {
            display: inline-flex;
            width: 17px;
            height: 17px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #DCE8DF;
            color: #3B554D;
            line-height: 1;
        }

        .product-form-shell .category-chip button:hover {
            background: #D2E1D7;
        }

        .product-form-shell .pf-hint {
            color: #87978F;
            font-size: 11px;
            line-height: 1.9;
        }

        .product-form-shell .pf-icon {
            display: flex;
            width: 38px;
            height: 38px;
            flex: none;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #f8f9fb;
            color: #4C6B62;
        }

        .product-form-shell .pf-icon:hover + p{
            visibility: visible;
            opacity: 1;
        }

        .product-form-shell .pf-switch {
            position: relative;
            display: inline-flex;
            width: 48px;
            height: 27px;
            cursor: pointer;
        }

        .product-form-shell .pf-switch input {
            position: absolute;
            opacity: 0;
        }

        .product-form-shell .pf-switch span:first-of-type {
            width: 100%;
            height: 100%;
            border-radius: 99px;
            background: #D8D0C5;
            transition: .2s;
        }

        .product-form-shell .pf-switch span:last-of-type {
            position: absolute;
            top: 4px;
            left: 4px;
            width: 19px;
            height: 19px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 1px 4px #0002;
            transition: .2s;
        }

        .product-form-shell .pf-switch input:checked+span:first-of-type {
            background: #4C6B62;
        }

        .product-form-shell .pf-switch input:checked~span:last-of-type {
            transform: translateX(21px);
        }

        @media(max-width:640px) {
            .product-form-shell .pf-card {
                padding: 16px;
                border-radius: 15px
            }

            .product-form-shell .pf-card-head {
                margin-bottom: 15px
            }
        }

        /* تنظیم دقیق موقعیت تیک چک‌باکس دسته‌بندی */
        .product-form-shell .category-checkbox {
            appearance: none;
            -webkit-appearance: none;
            position: relative;
            width: 16px;
            height: 16px;
            flex: 0 0 16px;
            margin: 0;
            border: 1.5px solid #95ADA2;
            border-radius: 4px;
            background: #fff;
            cursor: pointer;
        }

        /* تیک سفارشی */
        .product-form-shell .category-checkbox:checked {
            /* background: #4C6B62; */
            border-color: #4C6B62;
        }

        .product-form-shell .category-checkbox:checked::after {
            content: "";
            position: absolute;
            top: 1px;
            left: 4px;
            width: 4px;
            height: 8px;
            border: solid rgb(148, 16, 255);
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }


        /* ==========================================
                   طراحی بخش ویژگی‌های محصول
                ========================================== */

        .product-form-shell #product-attributes-list,
        .product-form-shell #packages-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* کارت ویژگی */
        .product-form-shell .attribute-item {
            padding: 18px;
            border: 1px solid #E9E2D9;
            border-radius: 15px;
            background: #f8f9fb;
            transition: border-color .2s, box-shadow .2s;
        }

        .product-form-shell .attribute-item:hover {
            border-color: #D5E2D9;
            box-shadow: 0 4px 14px rgba(76, 107, 98, .05);
        }

        /* کارت محصول متغیر */
        .product-form-shell .package-item {
            padding: 20px;
            border: 1px solid #E9E2D9;
            border-radius: 16px;
            background: #FBF6EF;
            transition: border-color .2s, box-shadow .2s;
        }

        .product-form-shell .package-item:hover {
            border-color: #D5E2D9;
        }

        /* عنوان ویژگی‌ها و پکیج‌ها */
        .product-form-shell .attribute-item label,
        .product-form-shell .package-item label {
            display: block;
            margin-bottom: 8px;
            color: #465F56;
            font-size: 12px;
            font-weight: 750;
        }

        /* ورودی‌های داخل ویژگی و پکیج */
        .product-form-shell .attribute-item input:not([type="color"]),
        .product-form-shell .attribute-item select,
        .product-form-shell .package-item input,
        .product-form-shell .package-item select {
            width: 100%;
            min-width: 0;
            min-height: 43px;
            padding: 10px 12px;
            border: 1px solid #E8E3DA;
            border-radius: 10px;
            outline: none;
            background: #FFFFFF;
            color: #465F56;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s;
        }

        .product-form-shell .attribute-item input:focus,
        .product-form-shell .attribute-item select:focus,
        .product-form-shell .package-item input:focus,
        .product-form-shell .package-item select:focus {
            border-color: #95ADA2;
            box-shadow: 0 0 0 3px rgba(76, 107, 98, .10);
        }

        /* ورودی رنگ */
        .product-form-shell .attribute-item input[type="color"] {
            width: 100%;
            height: 43px;
            padding: 4px;
            border: 1px solid #E8E3DA;
            border-radius: 10px;
            background: white;
            cursor: pointer;
        }

        /* ردیف مقادیر ویژگی */
        .product-form-shell .attribute-values {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .product-form-shell .attribute-value-item {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            padding: 8px;
            border: 1px solid #E9E2D9;
            border-radius: 12px;
            background: #FFFFFF;
        }

        .product-form-shell .attribute-value-item input {
            flex: 1;
            min-width: 0;
            border: 0 !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        /* دکمه افزودن مقدار */
        .product-form-shell .add-attribute-value,
        .product-form-shell .add-package-attribute {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 9px;
            padding: 9px 12px;
            background: #EDF3EF;
            color: #4C6B62;
            font-size: 11px;
            font-weight: 750;
            transition: .2s;
        }

        .product-form-shell .add-attribute-value:hover,
        .product-form-shell .add-package-attribute:hover {
            background: #DCE8DF;
            color: #3B554D;
        }

        /* دکمه‌های حذف */
        .product-form-shell .remove-attribute,
        .product-form-shell .remove-package,
        .product-form-shell .remove-attribute-value {
            flex: none;
            border: 1px solid #F2DCDD;
            border-radius: 9px;
            background: #FBEAEC;
            color: #C65D6D;
            font-size: 11px;
            font-weight: 750;
            transition: .2s;
        }

        .product-form-shell .remove-attribute:hover,
        .product-form-shell .remove-package:hover,
        .product-form-shell .remove-attribute-value:hover {
            border-color: #EEC7CC;
            background: #F6DADD;
        }

        /* جداکننده بخش‌ها */
        .product-form-shell .attribute-values-container,
        .product-form-shell .package-attributes-section {
            border-color: #E9E2D9;
        }

        /* عنوان پکیج */
        .product-form-shell .package-heading {
            color: #344B43;
            font-size: 13px;
            font-weight: 850;
        }

        /* موبایل */
        @media (max-width: 640px) {

            .product-form-shell .attribute-item,
            .product-form-shell .package-item {
                padding: 14px;
                border-radius: 13px;
            }

            .product-form-shell .attribute-value-item {
                gap: 7px;
                padding: 6px;
            }

            .product-form-shell .remove-attribute-value {
                padding: 7px 9px;
            }
        }

        /* ==========================================
                   Product Tree - Tababook
                ========================================== */

        .product-form-shell .tree-product-intro {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            padding: 15px;
            margin-bottom: 18px;
            border: 1px solid #DCE8DF;
            border-radius: 13px;
            background: #F6F9F5;
        }

        .product-form-shell .tree-product-intro strong {
            color: #344B43;
            font-size: 13px;
            font-weight: 850;
        }

        .product-form-shell .tree-product-intro p {
            margin-top: 5px;
            color: #87978F;
            font-size: 11px;
            line-height: 1.8;
        }

        .product-form-shell .tree-product-badge {
            padding: 6px 10px;
            border-radius: 8px;
            background: #E8F0EA;
            color: #4C6B62;
            font-size: 10px;
            font-weight: 800;
        }

        .product-form-shell .product-tree {
            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .product-form-shell .tree-feature {
            position: relative;
            min-width: 0;
            padding: 14px;
            border: 1px solid #DCE8DF;
            border-radius: 14px;
            background: #F8FAF7;
        }

        .product-form-shell .tree-feature-head,
        .product-form-shell .tree-value-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .product-form-shell .tree-feature-title,
        .product-form-shell .tree-value-title {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
            color: #344B43;
            font-size: 12px;
            font-weight: 850;
        }

        .product-form-shell .tree-toggle {
            display: flex;
            width: 27px;
            height: 27px;
            flex: none;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #E8F0EA;
            color: #4C6B62;
            cursor: pointer;
        }

        .product-form-shell .tree-toggle:hover {
            background: #DCE8DF;
        }

        .product-form-shell .tree-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .product-form-shell .tree-action {
            padding: 7px 9px;
            border-radius: 8px;
            background: #EDF3EF;
            color: #4C6B62;
            font-size: 10px;
            font-weight: 750;
            transition: .2s;
        }

        .product-form-shell .tree-action:hover {
            background: #DCE8DF;
        }

        .product-form-shell .tree-action-danger {
            background: #FBEAEC;
            color: #C65D6D;
        }

        .product-form-shell .tree-action-danger:hover {
            background: #F6DADD;
        }

        .product-form-shell .tree-feature-body {
            margin-top: 13px;
            padding-right: 17px;
            border-right: 2px solid #DCE8DF;
        }

        .product-form-shell .tree-value {
            position: relative;
            margin-top: 10px;
            padding: 12px;
            border: 1px solid #E9E2D9;
            border-radius: 12px;
            background: #fff;
        }

        .product-form-shell .tree-value-name {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
            color: #465F56;
            font-size: 12px;
            font-weight: 750;
        }

        .product-form-shell .tree-default-option {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 0;
            color: #4C6B62;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .product-form-shell .tree-default-option input[type="radio"] {
            width: 14px;
            height: 14px;
            margin: 0;
            accent-color: #4C6B62;
            cursor: pointer;
        }

        .product-form-shell .tree-value-dot {
            width: 7px;
            height: 7px;
            flex: none;
            border-radius: 50%;
            background: #95ADA2;
        }

        .product-form-shell .tree-price-box {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 12px;
            padding: 12px;
            border-radius: 10px;
            background: #f8f9fb;
        }

        .product-form-shell .tree-price-box label {
            margin-bottom: 6px;
            font-size: 11px;
        }

        .product-form-shell .tree-price-box input {
            min-height: 39px;
            padding: 8px 10px;
            border: 1px solid #E8E3DA;
            border-radius: 9px;
            background-color: #fff !important;
            font-size: 12px;
        }

        .product-form-shell .tree-children {
            margin-top: 12px;
            padding-right: 17px;
            border-right: 2px solid #E9E2D9;
        }

        .product-form-shell .tree-add-form {
            display: flex;
            align-items: end;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 12px;
            padding: 12px;
            border: 1px dashed #95ADA2;
            border-radius: 11px;
            background: #F6F9F5;
        }

        .product-form-shell .tree-add-form .tree-add-field {
            flex: 1;
            min-width: 150px;
        }

        .product-form-shell .tree-add-form label {
            margin-bottom: 6px;
            font-size: 11px;
        }

        .product-form-shell .tree-add-form input {
            min-height: 40px;
            padding: 9px 11px;
            border: 1px solid #DCE8DF;
            border-radius: 9px;
            background: white;
            font-size: 12px;
        }

        .product-form-shell .tree-add-form button {
            min-height: 40px;
            padding: 8px 13px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 750;
        }

        .product-form-shell .tree-add-confirm {
            background: #4C6B62;
            color: white;
        }

        .product-form-shell .tree-add-cancel {
            background: #F5E8E6;
            color: #4C6B62;
        }

        .product-form-shell .product-tree-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
            padding: 30px 15px;
            border: 1px dashed #DCE8DF;
            border-radius: 13px;
            background: #f8f9fb;
            text-align: center;
        }

        .product-form-shell .product-tree-empty .empty-icon {
            display: flex;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #F5E8E6;
            color: #4C6B62;
            font-size: 23px;
        }

        .product-form-shell .product-tree-empty strong {
            color: #465F56;
            font-size: 12px;
        }

        .product-form-shell .product-tree-empty p {
            color: #87978F;
            font-size: 11px;
        }

        .product-form-shell .product-tree-summary {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 17px;
            padding-top: 14px;
            border-top: 1px solid #F0EAE2;
            color: #87978F;
            font-size: 11px;
        }

        .product-form-shell .product-tree-summary strong {
            color: #4C6B62;
            font-weight: 850;
        }

        @media(max-width:640px) {
            .product-form-shell .tree-feature {
                padding: 11px;
            }

            .product-form-shell .tree-feature-body,
            .product-form-shell .tree-children {
                padding-right: 10px;
            }

            .product-form-shell .tree-price-box {
                grid-template-columns: 1fr;
            }

            .product-form-shell .tree-actions {
                width: 100%;
            }
        }

        .product-form-shell .tree-edit-input {
            width: 140px !important;
            min-width: 100px !important;
            min-height: 34px !important;
            padding: 6px 9px !important;
            border: 1px solid #95ADA2 !important;
            border-radius: 8px !important;
            background: #fff !important;
            color: #344B43 !important;
            font-size: 12px !important;
            outline: none;
        }

        .product-form-shell .tree-edit-input:focus {
            border-color: #4C6B62 !important;
            box-shadow: 0 0 0 3px rgba(76, 107, 98, .1) !important;
        }

        .tree-feature-select {
            width: 100%;
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid #dbe3df;
            border-radius: 10px;
            background: #fff;
            color: #334155;
            outline: none;
            direction: rtl;
        }

        .tree-feature-select:focus {
            border-color: #4c6b62;
            box-shadow: 0 0 0 3px rgba(76, 107, 98, 0.10);
        }

        .tree-add-hint {
            padding: 12px;
            border-radius: 10px;
            background: #f8faf9;
            color: #64748b;
            font-size: 13px;
        }

        .tree-select {
            width: 100%;
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid #dce3df;
            border-radius: 10px;
            background: #fff;
            outline: none;
        }

        .tree-select:focus {
            border-color: #4c6b62;
        }

        .tree-color-input {
            width: 48px;
            height: 42px;
            padding: 3px;
            border: 1px solid #dce3df;
            border-radius: 9px;
            cursor: pointer;
            background: #fff;
        }

        .tree-color-preview {
            display: inline-block;
            width: 22px;
            height: 22px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            flex-shrink: 0;
        }

    </style>
    @if (session('message'))
        <div
            class="modal fixed right-4 top-4 z-50 flex items-center gap-3 rounded-xl border border-[#DCE8DF] bg-white px-5 py-4 text-sm font-bold text-[#4C6B62] shadow-xl sm:right-8 sm:top-8">
            <span class="flex size-7 items-center justify-center rounded-full bg-[#EDF3EF]">✓</span>
            {{ session('message') }}
        </div>
    @endif

    

    <div class="product-form-shell w-full rounded-2xl bg-blue-900/3 p-3 pb-10 sm:p-5">
        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span
                    class="mb-2 inline-flex rounded-full bg-[#e8eeff] px-3 py-1 text-[11px] font-bold text-[#4C6B62]">مدیریت
                    فروشگاه / محصولات</span>
                <h2 class="text-2xl font-extrabold tracking-tight text-[#344B43] sm:text-3xl">ایجاد محصول جدید</h2>
                <p class="mt-2 text-xs leading-6 text-[#718078]">اطلاعات محصول، مشخصات، تصاویر و قیمت‌گذاری را تکمیل کنید.
                </p>
            </div>
            <span class="text-xs text-[#87978F]">فیلدهای ستاره‌دار الزامی هستند <b class="text-[#D96F7D]">*</b></span>
        </div>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 items-start gap-5 xl:grid-cols-3">
                {{-- ستون اطلاعات اصلی --}}
                <div class="min-w-0 space-y-5 xl:col-span-2">
                    <section class="pf-card">
                        <div class="pf-card-head relative">
                            <div>
                                <h3 class="pf-card-title">اطلاعات پایه محصول</h3>
                            </div>
                            <span class="pf-icon cursor-pointer">
                                <svg class="size-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                            <p class="absolute text-xs w-[165px] left-1/10 invisible opacity-0 transition-all duration-300">
                                عنوان و اطلاعات شناسنامه‌ای محصول را وارد کنید.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="pf-field sm:col-span-2">
                                <label for="title">نام محصول <span class="text-[#D96F7D]">*</span></label>
                                <input type="text" name="title" id="title" placeholder="مثلاً: دفتر طراحی ۱۰۰ برگ"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pf-field">
                                <label for="brand_id">برند</label>
                                <select id="brand_id" name='brand_id'>
                                    <option value="0">انتخاب کنید</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            @if (in_array($brand->id, old('brand_id', []))) selected @endif>
                                            {{ $brand->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pf-field">
                                <label for="publication_id">انتشارات</label>
                                <select id="publication_id" name='publication_id'>
                                    <option value="0">انتخاب کنید</option>
                                    @foreach ($publications as $publication)
                                        <option value="{{ $publication->id }}"
                                            @if (in_array($publication->id, old('publication_id', []))) selected @endif>
                                            {{ $publication->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('publication_id')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="pf-field"><label for="writer">نویسنده</label><input type="text" name="writer"
                                    id="writer" placeholder="نام نویسنده" value="{{ old('writer') }}">
                                @error('writer')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </section>

                    <section class="pf-card">
                        <div class="pf-card-head relative">
                            <div>
                                <h3 class="pf-card-title">معرفی محصول</h3>
                            </div>
                            <span class="pf-icon cursor-pointer">
                                <svg class="size-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                            <p class="absolute text-xs w-[165px] left-1/10 invisible opacity-0 transition-all duration-300">
                                یک معرفی کوتاه و توضیحات کامل محصول بنویسید.
                            </p>
                        </div>
                        <div class="space-y-4">
                            <div><label for="summary">خلاصه محصول</label>
                                <textarea rows="3" name="summary" id="summary" placeholder="در چند جمله محصول را معرفی کنید...">{{ old('summary') }}</textarea>
                                @error('summary')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div><label for="editor">توضیحات محصول</label>
                                <textarea name="description" id="editor" rows="5" placeholder="توضیحات کامل محصول را وارد کنید...">{!! old('description') !!}</textarea>
                                @error('description')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="pf-card">
                        <div class="pf-card-head relative">
                            <div>
                                <h3 class="pf-card-title">مشخصات و ویژگی‌ها</h3>
                            </div>
                            <span class="pf-icon">
                                <svg class="size-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                            <p class="absolute text-xs w-[175px] left-1/10 invisible opacity-0 transition-all duration-300">
                               ویژگی‌هایی مانند رنگ، سایز، جنس یا سایر مشخصات را تعریف کنید.
                            </p>
                        </div>
                        <div id="product-attributes-list" class="space-y-3"></div>
                        <button type="button" id="add-product-attribute" class="pf-btn pf-btn-soft mt-4" style="background-color: #f8f9fb;">＋ افزودن
                            ویژگی</button>
                    </section>

                    <section class="pf-card">
                        <div class="pf-card-head relative">
                            <div>
                                <h3 class="pf-card-title">تنوع و قیمت‌های مختلف</h3>
                            </div>
                            <span class="pf-icon cursor-pointer">
                                <svg class="size-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                            <p class="absolute text-xs w-[250px] left-1/10 invisible opacity-0 transition-all duration-300">
                                ویژگی‌های متغیر محصول را به‌صورت درختی تعریف کنید؛
                                    برای مثال رنگ، سپس سایز و در نهایت قیمت هر ترکیب.
                            </p>
                        </div>

                        

                        <div id="product-tree" class="product-tree mb-5"></div>

                        <button type="button" id="add-root-feature" class="pf-btn pf-btn-primary">
                            ＋ افزودن  اصلی
                        </button>

                        <div class="product-tree-summary">
                            <span>تعداد ویژگی‌ها: <strong id="tree-feature-count">۰</strong></span>
                            <span>تعداد مقادیر: <strong id="tree-value-count">۰</strong></span>
                            <span>تنوع : <strong id="tree-leaf-count">۰</strong></span>
                        </div>
                    </section>

                    <div
                        class="hidden lg:flex flex-col-reverse gap-3 rounded-2xl border border-[#E9E2D9] bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-5">
                        <p class="text-xs leading-6 text-[#87978F]">قبل از ثبت، اطلاعات و تصاویر محصول را بررسی کنید.</p>
                        <button type="submit" class="pf-btn pf-btn-primary w-full px-8 py-3 sm:w-auto cursor-pointer">ثبت محصول
                            <span>←</span></button>
                    </div>
                </div>

                {{-- سایدبار تنظیمات --}}
                <aside class="min-w-0 space-y-5 xl:col-span-1">
                    <section class="pf-card">
                        <div class="pf-card-head">
                            <h3 class="pf-card-title">دسته‌بندی محصول</h3>
                        </div>
                        <div class="relative">




                            <div class="overflow-hidden rounded-xl border border-[#E8E3DA] bg-white">
                                <div
                                    class="flex items-center justify-between border-b border-[#f8f9fb] bg-[#f8f9fb] px-3 py-2.5">
                                    <span class="text-xs font-bold text-[#465F56]">همه دسته‌بندی‌ها</span>
                                    <span id="category-result-count" class="text-[11px] text-[#87978F]">
                                        {{ $categories->count() }} دسته‌بندی
                                    </span>
                                </div>
                                <div id="category-options" class="max-h-64 overflow-y-auto p-2">
                                    <div
                                        class="mb-3 flex items-center gap-2 rounded-xl border border-[#f8f9fb] bg-[#f8f9fb] px-3 py-2.5 focus-within:border-[#95ADA2] focus-within:ring-4 focus-within:ring-[#4C6B62]/10 sticky top-0 z-2">
                                        <svg class="size-4 flex-none text-[#87978F]" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="7"></circle>
                                            <path stroke-linecap="round" d="m16 16 4 4"></path>
                                        </svg>
                                        <input type="search" id="category-search" autocomplete="off"
                                            class="!border-0 !bg-transparent !p-0 !shadow-none !ring-0"
                                            placeholder="جست‌وجوی دسته‌بندی..." aria-label="جست‌وجوی دسته‌بندی">
                                        <button type="button" id="clear-category-search"
                                            class="hidden flex-none rounded-lg px-2 py-1 text-xs font-bold text-[#4C6B62] hover:bg-white">
                                            پاک کردن
                                        </button>
                                    </div>
                                    {{-- min-h-8 --}}
                                    <div id="selected-category-chips" class="mb-3 flex flex-wrap gap-2"
                                        aria-live="polite">
                                    </div>
                                    @foreach ($categories as $category)
                                        <label data-category-option
                                            data-category-title="{{ mb_strtolower($category->title) }}"
                                            class="!mb-0 flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 transition hover:bg-[#f8f9fb]">
                                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                                class="category-checkbox size-4 flex-none accent-[#4C6B62]"
                                                @if (in_array($category->id, old('category_ids', []))) checked @endif>
                                            <span class="min-w-0 flex-1 truncate text-xs font-medium text-[#465F56]">
                                                {{ $category->title }}
                                            </span>
                                            <span
                                                class="category-check-indicator hidden text-xs font-bold text-[#4C6B62]">✓</span>
                                        </label>
                                    @endforeach
                                    <p id="category-no-results"
                                        class="hidden px-3 py-8 text-center text-xs text-[#87978F]">
                                        دسته‌بندی‌ای با این عبارت پیدا نشد.
                                    </p>
                                </div>
                            </div>

                            {{-- این select برای سازگاری با اسکریپت قبلی ویژگی‌ها حفظ شده است. --}}
                            <select id="category_ids" multiple hidden tabindex="-1" aria-hidden="true">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (in_array($category->id, old('category_ids', []))) selected @endif>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_ids')
                            <span class="pf-error">{{ $message }}</span>
                        @enderror
                    </section>

                    <section class="pf-card">
                        <div class="pf-card-head">
                            <div>
                                <h3 class="pf-card-title">وضعیت و موجودی</h3>
                                <p class="pf-card-desc">نحوه نمایش و تعداد موجودی را مشخص کنید.</p>
                            </div><span class="pf-icon"><svg class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 7h16v13H4zM8 7V4h8v3M8 12h8M8 16h5" />
                                </svg></span>
                        </div>
                        <div class="flex items-center justify-between gap-3 rounded-xl bg-[#f8f9fb] p-3"><span
                                class="text-sm font-semibold text-[#465F56]">نمایش در صفحه اصلی</span><label
                                for="show_in_home" class="pf-switch mb-0"><input type="checkbox" name="show_in_home"
                                    value="1" id="show_in_home"
                                    @if (old('show_in_home')) checked @endif><span></span><span></span></label>
                        </div>
                        <div class="mt-4"><label for="count">تعداد موجودی</label>
                            <div class="flex items-center gap-2"><button type="button"
                                    class="flex size-10 flex-none items-center justify-center rounded-xl bg-[#4C6B62] text-lg text-white hover:bg-[#3B554D]"
                                    onclick="calculate('+')">＋</button><input type="number" min="0"
                                    value="{{ old('count', 0) }}" name="count" id="count" dir="ltr"
                                    class="text-center"><button type="button"
                                    class="flex size-10 flex-none items-center justify-center rounded-xl bg-[#4C6B62] text-lg text-white hover:bg-[#3B554D]"
                                    onclick="calculate('-')">−</button></div>
                            <p class="pf-hint mt-2">می‌توانید عدد موجودی را مستقیماً ویرایش کنید.</p>
                        </div>
                    </section>

                    <section class="pf-card">
                        <div class="pf-card-head">
                            <div>
                                <h3 class="pf-card-title">تصاویر محصول</h3>
                                <p class="pf-card-desc">تصویر اصلی و تصاویر تکمیلی را بارگذاری کنید.</p>
                            </div><span class="pf-icon"><svg class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="4" width="18" height="16" rx="2" />
                                    <circle cx="8.5" cy="9" r="1.5" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 15-5-5L5 20" />
                                </svg></span>
                        </div>
                        <div class="space-y-4">
                            <div><label for="mainImage">تصویر اصلی</label><input type="file" name="mainImage"
                                    id="mainImage" accept="image/*">
                                @error('mainImage')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div><label for="gallery">گالری تصاویر</label><input type="file" name="gallery[]"
                                    id="gallery" accept="image/*" multiple>
                                <p class="pf-hint mt-2">حجم کل فایل‌ها نباید بیشتر از ۱ مگابایت باشد.</p>
                                @error('gallery')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="pf-card" id="fixed-product-pricing-card">
                        <div class="pf-card-head">
                            <div>
                                <h3 class="pf-card-title">قیمت‌گذاری</h3>
                                <p class="pf-card-desc">قیمت اصلی و قیمت تخفیف‌خورده را وارد کنید.</p>
                            </div><span class="pf-icon"><svg class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3v18m5-14.5C17 5.1 15 4 12 4S7 5.1 7 6.8 9 9.5 12 10s5 1.7 5 3.5-2 3.5-5 3.5-5-1.1-5-2.5" />
                                </svg></span>
                        </div>
                        <div class="space-y-4">
                            <div><label for="primary_price">قیمت اصلی</label><input type="number" name="primary_price"
                                    id="primary_price" min="0" value="{{ old('primary_price') }}"
                                    placeholder="مبلغ به تومان">
                                @error('primary_price')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                                <p class="pf-hint mt-2">
                                    برای محصولاتی که نیاز به استعلام قیمت دارند، این فیلد را خالی بگذارید.</p>
                            </div>
                            <div><label for="secondary_price">قیمت ویژه</label><input type="number"
                                    name="secondary_price" id="secondary_price" min="0"
                                    value="{{ old('secondary_price') }}" placeholder="مبلغ به تومان">
                                @error('secondary_price')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
            <div
                        class="lg:hidden flex flex-col-reverse gap-3 rounded-2xl border border-[#E9E2D9] bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-5">
                        <p class="text-xs leading-6 text-[#87978F]">قبل از ثبت، اطلاعات و تصاویر محصول را بررسی کنید.</p>
                        <button type="submit" class="pf-btn pf-btn-primary w-full px-8 py-3 sm:w-auto cursor-pointer">ثبت محصول
                            <span>←</span></button>
                    </div>
        </form>
    </div>

    {{-- قالب ویژگی --}}
    <template id="attribute-template">
        <div class="attribute-item space-y-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                <div class="min-w-0 flex-1"><label class="mb-2 block text-xs font-bold text-[#465F56]">عنوان
                        ویژگی</label><select
                        class="attribute-select w-full rounded-xl border border-[#E8E3DA] bg-white p-3 text-sm"
                        required></select></div>
                <button type="button" class="remove-attribute pf-danger">
                    <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
</svg>

                </button>
            </div>
            <div class="attribute-values-container border-t border-[#E8E3DA] pt-4">
                <div class="mb-3 flex items-center justify-between gap-3"><label class="mb-0 text-xs font-bold">مقادیر
                        ویژگی</label><button type="button"
                        class="add-attribute-value text-xs font-bold text-[#4C6B62] hover:text-[#3B554D]">＋ 
                        </button></div>
                <div class="attribute-values space-y-2"></div>
            </div>
        </div>
    </template>

    {{-- قالب مقدار ویژگی --}}
    <template id="attribute-value-template">
        <div class="attribute-value-item flex items-center gap-2">
            <input type="text"
                class="attribute-value-input min-w-0 flex-1 rounded-xl border border-[#E8E3DA] bg-white p-3 text-sm"
                placeholder="مقدار ویژگی" required>
            <button type="button" class="remove-attribute-value pf-danger" aria-label="حذف مقدار">✕</button>
        </div>
    </template>

    {{-- قالب محصول متغیر --}}
    <template id="package-template">
        <div class="package-item space-y-5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h3 class="package-heading text-sm font-extrabold text-[#344B43]">محصول متغیر جدید</h3><button
                    type="button" class="remove-package pf-danger">حذف محصول متغیر</button>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div><label class="mb-2 block text-xs">تعداد</label><input type="number" class="package-count"
                        min="1" value="1" required></div>
                <div><label class="mb-2 block text-xs">قیمت اصلی</label><input type="number"
                        class="package-primary-price" min="0" placeholder="قیمت اصلی"></div>
                <div><label class="mb-2 block text-xs">قیمت ویژه</label><input type="number"
                        class="package-secondary-price" min="0" placeholder="قیمت ویژه"></div>
            </div>
            <div class="package-attributes-section border-t border-[#E8E3DA] pt-4">
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h4 class="text-xs font-extrabold text-[#344B43]">ویژگی‌های این محصول متغیر</h4><button type="button"
                        class="add-package-attribute pf-btn pf-btn-soft">＋ </button>
                </div>
                <div class="package-attributes-list space-y-3"></div>
            </div>
        </div>
    </template>

    {{-- ============================================== --}}
    {{-- ارسال اطلاعات دسته‌بندی‌ها به JavaScript --}}
    {{-- ============================================== --}}


    <script>
        window.PRODUCT_FEATURES = @json(old('product_features', []));
        window.CATEGORIES = @json($categoriesData);
    </script>



    {{-- ============================================== --}}
    {{-- فایل‌های JavaScript --}}
    {{-- ============================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const root = document.querySelector('.product-form-shell');
            if (!root) return;

            const searchInput = root.querySelector('#category-search');
            const clearSearchButton = root.querySelector('#clear-category-search');
            const optionLabels = Array.from(root.querySelectorAll('[data-category-option]'));
            const checkboxes = Array.from(root.querySelectorAll('.category-checkbox'));
            const chipsContainer = root.querySelector('#selected-category-chips');
            const resultCount = root.querySelector('#category-result-count');
            const noResults = root.querySelector('#category-no-results');
            const compatibilitySelect = root.querySelector('#category_ids');
            const form = root.querySelector('form');

            function updateSelectedCategories() {
                const selected = checkboxes.filter(input => input.checked);

                chipsContainer.querySelectorAll('.category-chip').forEach(chip => chip.remove());

                selected.forEach(input => {
                    const label = input.closest('[data-category-option]');
                    const title = label.querySelector('span.flex-1').textContent.trim();

                    const chip = document.createElement('span');
                    chip.className = 'category-chip';

                    const chipText = document.createElement('span');
                    chipText.textContent = title;

                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.setAttribute('aria-label', 'حذف ' + title);
                    removeButton.textContent = '×';
                    removeButton.addEventListener('click', function() {
                        input.checked = false;
                        input.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    });

                    chip.append(chipText, removeButton);
                    chipsContainer.appendChild(chip);
                });

                if (compatibilitySelect) {
                    Array.from(compatibilitySelect.options).forEach(option => {
                        option.selected = selected.some(input => input.value === option.value);
                    });

                    // اطلاع‌رسانی به کدهای قبلی که روی تغییر دسته‌بندی گوش می‌دهند.
                    compatibilitySelect.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                }

                optionLabels.forEach(label => {
                    const input = label.querySelector('.category-checkbox');
                    const indicator = label.querySelector('.category-check-indicator');
                    label.classList.toggle('is-selected', input.checked);
                    indicator.classList.toggle('hidden', !input.checked);
                });

                resultCount.textContent = selected.length + ' مورد انتخاب شده';
            }

            function filterCategories() {
                const query = (searchInput.value || '').trim().toLocaleLowerCase('fa');
                let visibleCount = 0;

                optionLabels.forEach(label => {
                    const title = (label.dataset.categoryTitle || '').toLocaleLowerCase('fa');
                    const matches = !query || title.includes(query);
                    label.classList.toggle('hidden', !matches);
                    if (matches) visibleCount++;
                });

                noResults.classList.toggle('hidden', visibleCount !== 0);
                clearSearchButton.classList.toggle('hidden', query.length === 0);
                resultCount.textContent = visibleCount + ' از ' + optionLabels.length + ' دسته‌بندی';
            }

            checkboxes.forEach(input => {
                input.addEventListener('change', updateSelectedCategories);
            });

            searchInput.addEventListener('input', filterCategories);
            clearSearchButton.addEventListener('click', function() {
                searchInput.value = '';
                filterCategories();
                searchInput.focus();
            });
            updateSelectedCategories();
            filterCategories();
        });




        function showMessage(text){
            document.getElementById('message').classList.remove('invisible', 'opacity-0')
            document.getElementById('message').innerText = text
            setTimeout(() => {
                document.getElementById('message').classList.add('invisible', 'opacity-0')
            }, 3000);
        }

        
    </script>

    <script src="{{ url('js/attribute.js') }}"></script>

    <script src="{{ url('js/product.js') }}"></script>

    <script src="{{ url('js/packageForm.js') }}"></script>
    <script src="{{ url('js/productTree.js') }}"></script>


@endsection
