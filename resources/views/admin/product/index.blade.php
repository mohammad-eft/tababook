@extends('admin.app.dashboard')
@section('title', 'طبابوک | همه محصولات')
@section('content')

    @if (session('message'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-slate-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-slate-500"> {{ session('message') }} </span>
        </div>
    @endif

    <div class="w-full flex flex-col pb-6" dir="rtl">
        <form action="{{ route('product.deleteAll') }}" method="POST"
            class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            @csrf
            {{-- سربرگ لیست --}}
            <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="text-right">
                    <h2 class="text-lg font-bold text-slate-800">مدیریت محصولات</h2>
                    <p class="mt-1 text-xs text-slate-500">مشاهده، بررسی و مدیریت محصولات فروشگاه</p>
                </div>

                <div class="flex items-center gap-2 self-start rounded-xl bg-blue-50 px-3 py-2 sm:self-auto">
                    <span class="text-xs text-blue-700">تعداد محصولات</span>
                    <span
                        class="min-w-7 rounded-lg bg-white px-2 py-1 text-center text-sm font-bold text-blue-700 shadow-sm">
                        {{ $products->count() }}
                    </span>
                </div>
            </div>

            {{-- نوار ابزار --}}
            <div
                class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 bg-slate-50/70 px-5 py-3">
                <label for="all" class="flex cursor-pointer items-center gap-2 text-xs font-medium text-slate-600">
                    <input type="checkbox" id="all" onchange="checkAll()"
                        class="size-4 cursor-pointer rounded border-slate-300 accent-blue-600">
                    انتخاب همه محصولات
                </label>

                {{-- حذف گروهی در نسخه فعلی فرم و مسیر فعال ندارد؛ دکمه عمداً غیرفعال است. --}}
                <button type="submit" disabled
                    class="inline-flex cursor-not-allowed items-center gap-2 rounded-lg bg-slate-200 px-3 py-2 text-xs font-medium text-slate-400"
                    id="deleteAllBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512" aria-hidden="true">
                        <path fill="currentColor"
                            d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80z" />
                    </svg>
                    حذف انتخاب‌شده‌ها
                </button>
            </div>

            {{-- جدول محصولات --}}
            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[900px] border-collapse text-right" dir="rtl">
                    <thead class="sticky top-0 z-10 bg-slate-100/95">
                        <tr class="text-xs font-semibold text-slate-600">
                            <th scope="col" class="w-20 px-4 py-4 text-center">ردیف</th>
                            <th scope="col" class="w-[22%] px-4 py-4">عنوان محصول</th>
                            <th scope="col" class="w-28 px-4 py-4 text-center">تصویر</th>
                            <th scope="col" class="w-[25%] px-4 py-4">خلاصه</th>
                            <th scope="col" class="w-[22%] px-4 py-4">دسته‌بندی‌ها</th>
                            <th scope="col" class="w-36 px-4 py-4 text-center">عملیات</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($products as $product)
                            <tr class="transition-colors duration-150 hover:bg-slate-50/80">
                                <td class="px-4 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <input type="checkbox"
                                            class="check size-4 cursor-pointer rounded border-slate-300 accent-blue-600"
                                            name="products[]" value="{{ $product->id }}"
                                            aria-label="انتخاب {{ $product->title }}">
                                        <span class="text-xs tabular-nums text-slate-500">{{ $loop->iteration }}</span>
                                    </div>
                                </td>

                                <td class="px-4 py-4">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <span class="block max-w-xs truncate text-sm font-semibold text-slate-800"
                                            title="{{ $product->title }}">{{ $product->title }}</span>
                                        <span class="mt-1 block text-[11px] text-slate-400">شناسه:
                                            {{ $product->id }}</span>
                                    </a>
                                </td>

                                <td class="px-4 py-4">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <div class="flex justify-center">
                                            <img src="{{ asset('storage/' . ($product['mainImg'] ?? 'default.jpg')) }}"
                                                alt="{{ $product->title }}" loading="lazy"
                                                class="size-14 rounded-xl border border-slate-200 bg-slate-50 object-cover">
                                        </div>
                                    </a>
                                </td>

                                <td class="px-4 py-4">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <p class="max-w-xs text-xs leading-6 text-slate-600">
                                            {{ $product->summary ?: 'خلاصه‌ای برای این محصول ثبت نشده است.' }}
                                        </p>
                                    </a>
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap gap-1.5">
                                        @forelse ($product['categories'] as $category)
                                            <span
                                                class="inline-flex rounded-lg bg-blue-50 px-2 py-1 text-[11px] font-medium text-blue-700">
                                                {{ $category['title'] }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-slate-400">بدون دسته‌بندی</span>
                                        @endforelse
                                    </div>
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('product.show', $product->id) }}"
                                            class="inline-flex size-9 items-center justify-center rounded-lg bg-sky-50 text-sky-600 transition hover:bg-sky-100"
                                            title="مشاهده محصول" aria-label="مشاهده محصول">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512"
                                                aria-hidden="true">
                                                <path fill="currentColor"
                                                    d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 0 1 0-256z" />
                                            </svg>
                                        </a>

                                        <button type="button" onclick="editForm('open', {{ $product->id }})"
                                            class="inline-flex size-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 transition hover:bg-emerald-100"
                                            title="ویرایش محصول" aria-label="ویرایش محصول">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512"
                                                aria-hidden="true">
                                                <path fill="currentColor"
                                                    d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                            </svg>
                                        </button>

                                        <button type="button" data-title="{{ $product->title }}"
                                            onclick="deleteProduct('open', {{ $product->id }}, this.dataset.title)"
                                            class="inline-flex size-9 items-center justify-center rounded-lg bg-rose-50 text-rose-600 transition hover:bg-rose-100"
                                            title="حذف محصول" aria-label="حذف محصول">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512"
                                                aria-hidden="true">
                                                <path fill="currentColor"
                                                    d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16-16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16-16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16-16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <span
                                            class="mb-3 flex size-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-7" viewBox="0 0 576 512"
                                                aria-hidden="true">
                                                <path fill="currentColor"
                                                    d="M528.1 301.3l47.3-118.2c3.9-9.8-3.3-20.6-13.9-20.6H14.5C3.9 162.5-3.3 173.3.6 183.1l47.3 118.2c3.9 9.8 13.3 16.2 23.8 16.2H504.3c10.5 0 19.9-6.4 23.8-16.2zM64 352v96c0 17.7 14.3 32 32 32h384c17.7 0 32-14.3 32-32v-96H64z" />
                                            </svg>
                                        </span>
                                        <p class="text-sm font-semibold text-slate-700">هنوز محصولی ثبت نشده است</p>
                                        <p class="mt-1 text-xs text-slate-400">بعد از افزودن محصول، فهرست آن در این قسمت
                                            نمایش داده می‌شود.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>


    {{-- start confirmDelete popup --}}
    <div id="confirmDeletePopup"
        class="w-full h-dvh fixed top-0 left-0 z-999 invisible opacity-0 transition-all duration-400">
        <div class="size-full relative">
            <div class="size-full bg-black/40 absolute top-0 left-0" onclick="deleteProduct('close')"></div>
            <div
                class="w-11/12 md:w-1/2 xl:w-1/3 2xl:container 2xl:w-1/3 mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2">
                <div class="relative">
                    <button class="absolute -top-4 -left-4 size-6 flex flex-col justify-center items-center cursor-pointer"
                        onclick="deleteProduct('close')">
                        <span class="w-full h-0.5 rounded-full bg-slate-500 rotate-45 translate-y-1/2"></span>
                        <span class="w-full h-0.5 rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
                    </button>
                </div>
                <div class="">
                    <p>آیا از حذف محصول <span id="confirmDeleteProName" class="font-bold"> </span> اطمینان دارید؟ </p>
                    <div class="flex items-center justify-center gap-5 mt-10">
                        <a id="yes" class="py-2 px-4 bg-green-200 text-green-500 rounded-xl shadow-lg">بله</a>
                        <span class="py-2 px-4 bg-red-200 text-red-500 rounded-xl shadow-lg cursor-pointer"
                            onclick="deleteProduct('close')">خیر</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end confirmDelete popup --}}


    {{-- پاپ‌آپ ویرایش محصول؛ ساختار همسان با فرم ایجاد --}}
    <style>
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
            background: #F5E8E6;
            color: #4C6B62;
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
            background: #FCF9F4;
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
            background: #FBF6EF;
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
            background: #fff;
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
            background: #FCF9F4;
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

    <div id="editFormPopup" class="fixed inset-0 z-[9999] invisible opacity-0 transition-all duration-300" aria-hidden="true">
        <div class="absolute inset-0 bg-[#202A25]/60 backdrop-blur-sm" onclick="editForm('close')"></div>
        <div class="relative z-10 flex h-full w-full items-start justify-center overflow-y-auto p-2 sm:p-5">
    <div class="product-form-shell relative w-full max-w-6xl rounded-2xl bg-[#FBF6EF] p-3 pb-10 shadow-2xl sm:p-5">
        <button type="button" onclick="editForm('close')" aria-label="بستن پنجره"
            class="absolute left-4 top-4 z-20 flex size-9 items-center justify-center rounded-xl border border-[#E9E2D9] bg-white text-xl text-[#4C6B62] transition hover:bg-[#F5E8E6]">×</button>
        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span
                    class="mb-2 inline-flex rounded-full bg-[#F5E8E6] px-3 py-1 text-[11px] font-bold text-[#4C6B62]">مدیریت
                    فروشگاه / محصولات</span>
                <h2 class="text-2xl font-extrabold tracking-tight text-[#344B43] sm:text-3xl">ویرایش محصول</h2>
                <p class="mt-2 text-xs leading-6 text-[#718078]">اطلاعات محصول را بررسی و اصلاح کنید.
                </p>
            </div>
            <span class="text-xs text-[#87978F]">فیلدهای ستاره‌دار الزامی هستند <b class="text-[#D96F7D]">*</b></span>
        </div>

        <form action="{{ route('product.update') }}" method="POST" id="editForm" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="product_id" id="product_id">
            <div id="removed-images-inputs"></div>
            <div class="grid grid-cols-1 items-start gap-5 xl:grid-cols-3">
                {{-- ستون اطلاعات اصلی --}}
                <div class="min-w-0 space-y-5 xl:col-span-2">
                    <section class="pf-card">
                        <div class="pf-card-head">
                            <div>
                                <h3 class="pf-card-title">اطلاعات پایه محصول</h3>
                                <p class="pf-card-desc">عنوان و اطلاعات شناسنامه‌ای محصول را وارد کنید.</p>
                            </div>
                            <span class="pf-icon"><svg class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 5.5A1.5 1.5 0 0 1 5.5 4h13A1.5 1.5 0 0 1 20 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 18.5zM8 8h8M8 12h8M8 16h4" />
                                </svg></span>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="pf-field sm:col-span-2">
                                <label for="title">نام محصول <span class="text-[#D96F7D]">*</span></label>
                                <input type="text" name="title" id="title" placeholder="مثلاً: دفتر طراحی ۱۰۰ برگ"
                                    value="" required>
                                @error('title')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pf-field"><label for="brand">برند</label><input type="text" name="brand"
                                    id="brand" placeholder="نام برند" value="">
                                @error('brand')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pf-field"><label for="writer">نویسنده</label><input type="text" name="writer"
                                    id="writer" placeholder="نام نویسنده" value="">
                                @error('writer')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pf-field sm:col-span-2"><label for="publication">انتشارات</label><input
                                    type="text" name="publication" id="publication" placeholder="نام انتشارات"
                                    value="">
                                @error('publication')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="pf-card">
                        <div class="pf-card-head">
                            <div>
                                <h3 class="pf-card-title">معرفی محصول</h3>
                                <p class="pf-card-desc">یک معرفی کوتاه و توضیحات کامل محصول بنویسید.</p>
                            </div><span class="pf-icon"><svg class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 4h10a2 2 0 0 1 2 2v14H5V6a2 2 0 0 1 2-2zM8 9h8M8 13h8M8 17h5" />
                                </svg></span>
                        </div>
                        <div class="space-y-4">
                            <div><label for="summary">خلاصه محصول</label>
                                <textarea rows="3" name="summary" id="summary" placeholder="در چند جمله محصول را معرفی کنید..."></textarea>
                                @error('summary')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div><label for="editor">توضیحات محصول</label>
                                <textarea name="description" id="editor" rows="5" placeholder="توضیحات کامل محصول را وارد کنید..."></textarea>
                                @error('description')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="pf-card">
                        <div class="pf-card-head">
                            <div>
                                <h3 class="pf-card-title">مشخصات و ویژگی‌ها</h3>
                                <p class="pf-card-desc">ویژگی‌هایی مانند رنگ، سایز، جنس یا سایر مشخصات را تعریف کنید.</p>
                            </div><span class="pf-icon"><svg class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 7h16M4 12h16M4 17h16M8 4v6m8 4v6" />
                                </svg></span>
                        </div>
                        <div id="product-attributes-list" class="space-y-3"></div>
                        <button type="button" id="add-product-attribute" class="pf-btn pf-btn-soft mt-4">＋ افزودن
                            ویژگی</button>
                    </section>

                    <section class="pf-card">
                        <div class="pf-card-head">
                            <div>
                                <h3 class="pf-card-title">تنوع و قیمت‌های مختلف</h3>
                                <p class="pf-card-desc">
                                    ویژگی‌های متغیر محصول را به‌صورت درختی تعریف کنید؛
                                    برای مثال رنگ، سپس سایز و در نهایت قیمت هر ترکیب.
                                </p>
                            </div>
                            <span class="pf-icon">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 7h16M4 12h16M4 17h16M7 4v6m10 4v6" />
                                </svg>
                            </span>
                        </div>

                        <div class="tree-product-intro">
                            <div>
                                <strong>ساختار تنوع‌های محصول</strong>
                                <p>ابتدا یک ویژگی اضافه کنید و سپس مقادیر و زیرشاخه‌های آن را بسازید.</p>
                            </div>
                            <span class="tree-product-badge">مدیریت درختی</span>
                        </div>

                        <div id="product-tree" class="product-tree mb-5"></div>

                        <button type="button" id="add-root-feature" class="pf-btn pf-btn-primary">
                            ＋ افزودن ویژگی اصلی
                        </button>

                        <div class="product-tree-summary">
                            <span>تعداد ویژگی‌ها: <strong id="tree-feature-count">۰</strong></span>
                            <span>تعداد مقادیر: <strong id="tree-value-count">۰</strong></span>
                            <span>ترکیب‌های نهایی: <strong id="tree-leaf-count">۰</strong></span>
                        </div>
                    </section>

                    <script>
                        window.PRODUCT_FEATURES = [];
                    </script>

                    <div
                        class="flex flex-col-reverse gap-3 rounded-2xl border border-[#E9E2D9] bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-5">
                        <p class="text-xs leading-6 text-[#87978F]">پس از بررسی تغییرات، اطلاعات محصول را ذخیره کنید.</p>
                        <button type="submit" class="pf-btn pf-btn-primary w-full px-8 py-3 sm:w-auto">ذخیره تغییرات
                            <span>←</span></button>
                    </div>
                </div>

                {{-- سایدبار تنظیمات --}}
                <aside class="min-w-0 space-y-5 xl:col-span-1">
                    <section class="pf-card">
                        <div class="pf-card-head">
                            <div>
                                <h3 class="pf-card-title">دسته‌بندی محصول</h3>
                                <p class="pf-card-desc">محصول را در دسته‌های مرتبط قرار دهید.</p>
                            </div><span class="pf-icon"><svg class="size-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 5.75A1.75 1.75 0 0 1 5.75 4h4.5L12 6h6.25A1.75 1.75 0 0 1 20 7.75v10.5A1.75 1.75 0 0 1 18.25 20h-12.5A1.75 1.75 0 0 1 4 18.25z" />
                                </svg></span>
                        </div>
                        <div class="relative">
                            <div
                                class="mb-3 flex items-center gap-2 rounded-xl border border-[#E8E3DA] bg-[#FBF6EF] px-3 py-2.5 focus-within:border-[#95ADA2] focus-within:ring-4 focus-within:ring-[#4C6B62]/10">
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

                            <div id="selected-category-chips" class="mb-3 flex min-h-8 flex-wrap gap-2"
                                aria-live="polite">
                                <span id="category-empty-selection" class="text-xs text-[#A6ADA6]">
                                    هنوز دسته‌بندی‌ای انتخاب نشده است.
                                </span>
                            </div>

                            <div class="overflow-hidden rounded-xl border border-[#E8E3DA] bg-white">
                                <div
                                    class="flex items-center justify-between border-b border-[#F0EAE2] bg-[#FCF9F4] px-3 py-2.5">
                                    <span class="text-xs font-bold text-[#465F56]">همه دسته‌بندی‌ها</span>
                                    <span id="category-result-count" class="text-[11px] text-[#87978F]">
                                        دسته‌بندی‌ها
                                    </span>
                                </div>
                                <div id="category-options" class="max-h-64 overflow-y-auto p-2">
                                    {{-- گزینه‌ها پس از دریافت اطلاعات محصول از AJAX ساخته می‌شوند. --}}
                                    <p id="category-no-results"
                                        class="hidden px-3 py-8 text-center text-xs text-[#87978F]">
                                        دسته‌بندی‌ای با این عبارت پیدا نشد.
                                    </p>
                                </div>
                            </div>

                            <p class="pf-hint mt-2">
                                می‌توانید نام دسته‌بندی را جست‌وجو کنید و چند مورد را هم‌زمان انتخاب کنید.
                            </p>

                            {{-- این select برای سازگاری با اسکریپت قبلی ویژگی‌ها حفظ شده است. --}}
                            <select id="category_ids" multiple hidden tabindex="-1" aria-hidden="true">

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
                        <div class="flex items-center justify-between gap-3 rounded-xl bg-[#FBF6EF] p-3"><span
                                class="text-sm font-semibold text-[#465F56]">نمایش در صفحه اصلی</span><label
                                for="show_in_home" class="pf-switch mb-0"><input type="checkbox" name="show_in_home"
                                    value="1" id="show_in_home"
><span></span><span></span></label>
                        </div>
                        <div class="mt-4"><label for="count">تعداد موجودی</label>
                            <div class="flex items-center gap-2"><button type="button"
                                    class="flex size-10 flex-none items-center justify-center rounded-xl bg-[#4C6B62] text-lg text-white hover:bg-[#3B554D]"
                                    onclick="calculate('+')">＋</button><input type="number" min="0"
                                    value="0" name="count" id="count" dir="ltr"
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
                            <div><label for="mainImage">تصویر اصلی جدید</label><input type="file" name="mainImage"
                                    id="mainImage" accept="image/*">
                                <div id="mainImgContainer" class="mt-3 flex flex-wrap gap-3"></div>
                                @error('mainImage')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div><label for="gallery">گالری تصاویر جدید</label><input type="file" name="gallery[]"
                                    id="gallery" accept="image/*" multiple>
                                <div id="galleryContainer" class="mt-3 flex flex-wrap gap-3"></div>
                                <p class="pf-hint mt-2">حجم کل فایل‌ها نباید بیشتر از ۱ مگابایت باشد.</p>
                                @error('gallery')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="pf-card">
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
                                    id="primary_price" min="0" value=""
                                    placeholder="مبلغ به تومان">
                                @error('primary_price')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                                <p class="pf-hint mt-2">
                                    برای محصولاتی که نیاز به استعلام قیمت دارند، این فیلد را خالی بگذارید.</p>
                            </div>
                            <div><label for="secondary_price">قیمت ویژه</label><input type="number"
                                    name="secondary_price" id="secondary_price" min="0"
                                    value="" placeholder="مبلغ به تومان">
                                @error('secondary_price')
                                    <span class="pf-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </form>
    </div>

        </div>
    </div>

    {{-- قالب ویژگی عمومی و مقادیر آن --}}
    <template id="attribute-template">
        <div class="attribute-item space-y-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                <div class="min-w-0 flex-1"><label class="mb-2 block text-xs font-bold text-[#465F56]">عنوان
                        ویژگی</label><select
                        class="attribute-select w-full rounded-xl border border-[#E8E3DA] bg-white p-3 text-sm"
                        required></select></div>
                <button type="button" class="remove-attribute pf-danger">حذف ویژگی</button>
            </div>
            <div class="attribute-values-container border-t border-[#E8E3DA] pt-4">
                <div class="mb-3 flex items-center justify-between gap-3"><label class="mb-0 text-xs font-bold">مقادیر
                        ویژگی</label><button type="button"
                        class="add-attribute-value text-xs font-bold text-[#4C6B62] hover:text-[#3B554D]">＋ افزودن
                        مقدار</button></div>
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
                        class="add-package-attribute pf-btn pf-btn-soft">＋ افزودن ویژگی</button>
                </div>
                <div class="package-attributes-list space-y-3"></div>
            </div>
        </div>
    </template>


    <script>
        window.PRODUCT_FEATURES = [];
        window.CATEGORIES = {};
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const root = document.querySelector('#editFormPopup .product-form-shell');
            if (!root) return;

            const searchInput = root.querySelector('#category-search');
            const clearSearchButton = root.querySelector('#clear-category-search');
            const getOptionLabels = () => Array.from(root.querySelectorAll('[data-category-option]'));
            const getCheckboxes = () => Array.from(root.querySelectorAll('.category-checkbox'));
            const chipsContainer = root.querySelector('#selected-category-chips');
            const emptySelection = root.querySelector('#category-empty-selection');
            const resultCount = root.querySelector('#category-result-count');
            const noResults = root.querySelector('#category-no-results');
            const compatibilitySelect = root.querySelector('#category_ids');

            function updateSelectedCategories() {
                const selected = getCheckboxes().filter(input => input.checked);
                chipsContainer.querySelectorAll('.category-chip').forEach(chip => chip.remove());
                emptySelection.classList.toggle('hidden', selected.length > 0);

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
                    removeButton.addEventListener('click', function () {
                        input.checked = false;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    });
                    chip.append(chipText, removeButton);
                    chipsContainer.appendChild(chip);
                });

                Array.from(compatibilitySelect.options).forEach(option => {
                    option.selected = selected.some(input => input.value === option.value);
                });
                compatibilitySelect.dispatchEvent(new Event('change', { bubbles: true }));

                getOptionLabels().forEach(label => {
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
                getOptionLabels().forEach(label => {
                    const title = (label.dataset.categoryTitle || '').toLocaleLowerCase('fa');
                    const matches = !query || title.includes(query);
                    label.classList.toggle('hidden', !matches);
                    if (matches) visibleCount++;
                });
                noResults.classList.toggle('hidden', visibleCount !== 0);
                clearSearchButton.classList.toggle('hidden', query.length === 0);
                resultCount.textContent = visibleCount + ' از ' + getOptionLabels().length + ' دسته‌بندی';
            }

            getCheckboxes().forEach(input => input.addEventListener('change', updateSelectedCategories));
            searchInput.addEventListener('input', filterCategories);
            clearSearchButton.addEventListener('click', function () {
                searchInput.value = '';
                filterCategories();
                searchInput.focus();
            });

            window.populateEditCategories = function (categories) {
                const optionsContainer = root.querySelector('#category-options');
                optionsContainer.querySelectorAll('[data-category-option]').forEach(node => node.remove());
                compatibilitySelect.innerHTML = '';

                (categories || []).forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.title;
                    compatibilitySelect.appendChild(option);

                    const label = document.createElement('label');
                    label.dataset.categoryOption = '';
                    label.dataset.categoryTitle = String(category.title || '').toLocaleLowerCase('fa');
                    label.className = '!mb-0 flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 transition hover:bg-[#FBF6EF]';

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'category_ids[]';
                    checkbox.value = category.id;
                    checkbox.className = 'category-checkbox size-4 flex-none accent-[#4C6B62]';
                    checkbox.addEventListener('change', updateSelectedCategories);

                    const title = document.createElement('span');
                    title.className = 'min-w-0 flex-1 truncate text-xs font-medium text-[#465F56]';
                    title.textContent = category.title;

                    const indicator = document.createElement('span');
                    indicator.className = 'category-check-indicator hidden text-xs font-bold text-[#4C6B62]';
                    indicator.textContent = '✓';

                    label.append(checkbox, title, indicator);
                    optionsContainer.insertBefore(label, noResults);
                });

                filterCategories();
            };

            window.setEditCategorySelection = function (ids) {
                const selectedIds = (ids || []).map(String);
                getCheckboxes().forEach(input => input.checked = selectedIds.includes(String(input.value)));
                updateSelectedCategories();
            };

            updateSelectedCategories();
            filterCategories();
        });
    </script>

    <script src="{{ url('js/attribute.js') }}"></script>
    <script src="{{ url('js/product.js') }}"></script>
    <script src="{{ url('js/packageForm.js') }}"></script>
    <script src="{{ url('js/productTree-edit.js') }}"></script>

    <script>
        function editForm(state, id) {
            const popup = document.getElementById('editFormPopup');
            const form = document.getElementById('editForm');

            if (state === 'close') {
                popup.classList.add('invisible', 'opacity-0');
                popup.setAttribute('aria-hidden', 'true');
                return;
            }

            if (state !== 'open') return;

            form.reset();
            form.querySelectorAll('input[name^="removedImgs"]').forEach(input => input.remove());
            document.getElementById('mainImgContainer').innerHTML = '';
            document.getElementById('galleryContainer').innerHTML = '';
            document.getElementById('product-attributes-list').innerHTML = '';
            if (window.ProductTreeEdit && typeof ProductTreeEdit.reset === 'function') ProductTreeEdit.reset();
            document.getElementById('product_id').value = id;
            popup.classList.remove('invisible', 'opacity-0');
            popup.setAttribute('aria-hidden', 'false');

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" } });
            $.ajax({
                url: "{{ route('product.edit') }}",
                type: 'POST',
                dataType: 'json',
                data: { id: id },
                success: function (data) {
                   
                    console.log('----------------------------------------------------')
                    console.log(data)
                    const product = data.product || {};
                    document.getElementById('product_id').value = product.id;
                    document.getElementById('title').value = product.title || '';
                    document.getElementById('brand').value = product.brand || '';
                    document.getElementById('writer').value = product.writer || '';
                    document.getElementById('publication').value = product.publication || '';
                    document.getElementById('summary').value = product.summary || '';
                    document.getElementById('count').value = product.count ?? 0;
                    document.getElementById('primary_price').value = product.primary_price ?? '';
                    document.getElementById('secondary_price').value = product.secondary_price ?? '';
                    document.getElementById('show_in_home').checked = !!Number(product.show_in_home);

                    const editor = document.getElementById('editor');
                    if (window.productEditor && typeof window.productEditor.value !== 'undefined') {
                        window.productEditor.value = product.description || '';
                    } else if (editor) {
                        editor.value = product.description || '';
                    }

                    // دسته‌بندی‌ها و ویژگی‌های قابل انتخاب
                    if (data.categoriesData) window.CATEGORIES = data.categoriesData;
                    window.populateEditCategories(data.cats || []);
                    window.setEditCategorySelection(data.catIds || []);

                    // ویژگی‌های عمومی واریانت‌های قدیمی (در صورت وجود)
                    if (typeof PackageForm !== 'undefined' && typeof PackageForm.load === 'function') {
                        PackageForm.load({ attributes: product.attributes || [], packages: [] });
                    }

                    // ساختار درختی جدید؛ API در productTree.js اضافه شده است.
                    if (window.ProductTreeEdit && typeof ProductTreeEdit.load === 'function') {
                        ProductTreeEdit.load(product.product_features || product.productFeatures || []);
                    }

                    // تصاویر فعلی
                    (product.media || []).forEach(media => {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'relative';
                        const image = document.createElement('img');
                        image.src = media.media_path;
                        image.alt = media.is_main ? 'تصویر اصلی محصول' : 'تصویر گالری محصول';
                        image.className = 'h-20 w-28 rounded-xl border border-[#E9E2D9] object-cover';
                        const remove = document.createElement('button');
                        remove.type = 'button';
                        remove.className = 'absolute -left-2 -top-2 flex size-6 items-center justify-center rounded-full bg-rose-600 text-xs text-white shadow';
                        remove.textContent = '×';
                        remove.addEventListener('click', function () {
                            removeImg(remove, media.media_path, media.is_main ? 'mainImg' : 'gallery');
                        });
                        wrapper.append(image, remove);
                        document.getElementById(media.is_main ? 'mainImgContainer' : 'galleryContainer').appendChild(wrapper);
                    });

                     console.log('Product features from server:', product.product_features);
                    console.log('Product features JSON:', JSON.stringify(product.product_features, null, 2));
                },
                error: function (xhr) {
                    console.error('دریافت اطلاعات محصول برای ویرایش ناموفق بود.', xhr);
                    alert('دریافت اطلاعات محصول با خطا مواجه شد.');
                    editForm('close');
                }
            });
        }

        function removeImg(button, file, type) {
            const form = document.getElementById('editForm');
            const index = file.indexOf('productImgs');
            const path = index >= 0 ? file.slice(index) : file;
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = type === 'mainImg' ? 'removedImgs[mainImg]' : 'removedImgs[gallery][]';
            input.value = path;
            form.appendChild(input);
            button.closest('.relative')?.remove();
        }

        function deleteProduct(state, id, proTitle) {
            const popup = document.getElementById('confirmDeletePopup');
            if (state === 'open') {
                document.getElementById('yes').setAttribute('href', `{{ url('product/delete') }}/${id}`);
                document.getElementById('confirmDeleteProName').innerText = proTitle;
                popup.classList.remove('invisible', 'opacity-0');
            } else if (state === 'close') {
                popup.classList.add('invisible', 'opacity-0');
            }
        }

        function calculate(state) {
            const count = document.getElementById('count');
            if (state === '+') count.value = Number(count.value || 0) + 1;
            if (state === '-' && Number(count.value) > 0) count.value = Number(count.value) - 1;
        }
    </script>




    <style>
        /* اینپوت رنگ: ارتفاع بیشتر تا رنگ انتخاب‌شده کامل دیده شود */
        .attribute-value-input[type="color"] {
            height: 2.75rem;
            padding: 4px;
            cursor: pointer;
        }

        .attribute-value-input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        .attribute-value-input[type="color"]::-webkit-color-swatch {
            border: none;
            border-radius: 0.5rem;
        }

        .attribute-value-input[type="color"]::-moz-color-swatch {
            border: none;
            border-radius: 0.5rem;
        }
    </style>


    {{-- ============================================== --}}
    {{-- قالب ویژگی --}}
    {{-- ============================================== --}}

    <script src="{{ asset('js/checkAll.js') }}"></script>

@endsection
