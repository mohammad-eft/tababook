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


    {{-- start editForm popup --}}

    <style>
        .product-edit-shell {
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

        .product-edit-shell .pf-card {
            background: #fff;
            border: 1px solid var(--pf-border);
            border-radius: 17px;
            padding: 19px;
            box-shadow: 0 5px 22px rgba(76, 107, 98, .06);
            min-width: 0;
        }

        .product-edit-shell .pf-card-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 14px;
            margin-bottom: 16px;
            border-bottom: 1px solid #F0EAE2;
        }

        .product-edit-shell .pf-card-title {
            font-size: 14px;
            font-weight: 800;
            color: #344B43;
        }

        .product-edit-shell .pf-card-desc {
            margin-top: 5px;
            color: var(--pf-muted);
            font-size: 11px;
            line-height: 1.9;
        }

        .product-edit-shell label {
            display: block;
            margin-bottom: 7px;
            color: #465F56;
            font-size: 12px;
            font-weight: 650;
        }

        .product-edit-shell input:not([type=checkbox]):not([type=file]):not([type=color]),
        .product-edit-shell textarea,
        .product-edit-shell select:not(.attribute-select):not(#category_ids) {
            width: 100%;
            min-width: 0;
            border: 1px solid #E8E3DA;
            border-radius: 10px;
            background: #FBF6EF;
            padding: 10px 12px;
            color: #465F56;
            font-size: 12px;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .product-edit-shell input:focus,
        .product-edit-shell textarea:focus,
        .product-edit-shell select:focus {
            border-color: #95ADA2;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(76, 107, 98, .12);
        }

        .product-edit-shell input::placeholder,
        .product-edit-shell textarea::placeholder {
            color: #A6ADA6;
        }

        .product-edit-shell input[type=file] {
            width: 100%;
            border: 1px dashed #D8D0C5;
            border-radius: 11px;
            background: #FBF6EF;
            padding: 10px;
            color: #65766E;
            font-size: 11px;
        }

        .product-edit-shell .pf-field {
            min-width: 0;
        }

        .product-edit-shell .pf-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border-radius: 10px;
            padding: 9px 13px;
            font-size: 11px;
            font-weight: 700;
            transition: .2s;
        }

        .product-edit-shell .pf-btn-primary {
            background: #4C6B62;
            color: white;
            box-shadow: 0 5px 12px rgba(76, 107, 98, .18);
        }

        .product-edit-shell .pf-btn-primary:hover {
            background: #3B554D;
            transform: translateY(-1px);
        }

        .product-edit-shell .pf-btn-soft {
            background: #F5E8E6;
            color: #4C6B62;
        }

        .product-edit-shell .pf-btn-soft:hover {
            background: #EDE4DA;
        }

        .product-edit-shell .pf-danger {
            background: #FBEAEC;
            color: #C65D6D;
            border-radius: 9px;
            padding: 7px 10px;
            font-size: 11px;
            font-weight: 650;
        }

        .product-edit-shell .attribute-item,
        .product-edit-shell .package-item {
            border: 1px solid #E8E3DA;
            border-radius: 13px;
            padding: 14px;
            background: #FBF6EF;
        }

        .product-edit-shell .attribute-item input,
        .product-edit-shell .attribute-item select,
        .product-edit-shell .package-item input,
        .product-edit-shell .package-item select {
            border: 1px solid #E8E3DA;
            border-radius: 9px;
            padding: 9px 10px;
            background: white;
            width: 100%;
            min-width: 0;
            font-size: 12px;
            outline: none;
        }

        .product-edit-shell .attribute-value-input[type=color] {
            height: 2.6rem;
            padding: 4px;
            cursor: pointer;
            flex: 0 0 6rem;
        }

        .product-edit-shell .pf-error {
            display: block;
            margin-top: 5px;
            color: #D96F7D;
            font-size: 11px;
        }

        .product-edit-shell .pf-hint {
            color: #87978F;
            font-size: 10px;
            line-height: 1.9;
        }

        .product-edit-shell .pf-icon {
            display: flex;
            width: 35px;
            height: 35px;
            flex: none;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #F5E8E6;
            color: #4C6B62;
        }

        .product-edit-shell .pf-switch {
            position: relative;
            display: inline-flex;
            width: 46px;
            height: 26px;
            cursor: pointer;
            margin: 0;
        }

        .product-edit-shell .pf-switch input {
            position: absolute;
            opacity: 0;
        }

        .product-edit-shell .pf-switch span:first-of-type {
            width: 100%;
            height: 100%;
            border-radius: 99px;
            background: #D8D0C5;
            transition: .2s;
        }

        .product-edit-shell .pf-switch span:last-of-type {
            position: absolute;
            top: 4px;
            left: 4px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 1px 4px #0002;
            transition: .2s;
        }

        .product-edit-shell .pf-switch input:checked+span:first-of-type {
            background: #4C6B62;
        }

        .product-edit-shell .pf-switch input:checked~span:last-of-type {
            transform: translateX(20px);
        }

        .product-edit-shell .category-checkbox {
            accent-color: #4C6B62;
        }

        .product-edit-shell [data-category-option].is-selected {
            background: #EDF3EF;
        }

        .product-edit-shell .category-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            max-width: 100%;
            border: 1px solid #DCE8DF;
            border-radius: 999px;
            background: #EDF3EF;
            padding: 5px 8px;
            color: #4C6B62;
            font-size: 10px;
            font-weight: 700;
        }

        .product-edit-shell .category-chip button {
            display: inline-flex;
            width: 16px;
            height: 16px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #DCE8DF;
            color: #3B554D;
            line-height: 1;
        }

        .product-edit-shell .category-chip button:hover {
            background: #D2E1D7;
        }

        .product-edit-shell #edit-category-search {
            width: 100%;
            border: 0 !important;
            background: transparent !important;
            padding: 0 !important;
            box-shadow: none !important;
        }

        /* اصلاح چیدمان دسته‌بندی‌ها */
        .product-edit-shell #edit-category-options label[data-edit-category-option] {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 12px !important;
            width: 100%;
            min-height: 42px;
            margin: 0 !important;
            padding: 10px 12px !important;
            text-align: right;
            cursor: pointer;
            border-radius: 9px;
            box-sizing: border-box;
        }

        .product-edit-shell #edit-category-options .category-checkbox {
            display: block;
            width: 16px;
            height: 16px;
            flex: 0 0 16px;
            margin: 0 !important;
            cursor: pointer;
        }

        .product-edit-shell #edit-category-options label[data-edit-category-option]>span:first-of-type {
            display: block;
            flex: 1;
            min-width: 0;
            margin: 0 !important;
            line-height: 1.8;
            text-align: right;
        }

        .product-edit-shell #edit-category-options .category-check-indicator {
            flex: 0 0 auto;
            margin-right: auto;
        }

        .product-edit-shell #edit-category-options .category-checkbox {
            appearance: none;
            position: relative;
            width: 16px;
            height: 16px;
            flex: 0 0 16px;
        }

        /* تیک داخل چک‌باکس */
        .product-edit-shell #edit-category-options .category-checkbox:checked::after {
            content: "";
            position: absolute;
            top: 2px;
            /* بالا و پایین */
            left: 5px;
            /* چپ و راست */
            width: 4px;
            height: 8px;
            border: solid rgb(148, 16, 255);
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        @media(max-width:640px) {
            .product-edit-shell .pf-card {
                padding: 14px;
                border-radius: 14px
            }
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

    </style>

    @error('title')
        <div
            class="modal fixed right-4 top-4 z-[10000] rounded-xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-bold text-rose-600 shadow-xl">
            {{ $message }}</div>
    @enderror
    @error('category_ids')
        <div
            class="modal fixed right-4 top-20 z-[10000] rounded-xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-bold text-rose-600 shadow-xl">
            {{ $message }}</div>
    @enderror

    <div id="editFormPopup" class="fixed inset-0 z-[9999] invisible opacity-0 transition-all duration-300">
        <div class="relative size-full p-2 sm:p-5">
            <div class="absolute inset-0 bg-[#202A25]/55 backdrop-blur-[2px]" onclick="editForm('close')"></div>

            <div
                class="product-edit-shell absolute right-1/2 top-1/2 flex max-h-[94dvh] w-full max-w-6xl -translate-y-1/2 translate-x-1/2 flex-col overflow-hidden rounded-2xl border border-[#E9E2D9] bg-[#FBF6EF] shadow-2xl sm:w-[96%]">
                <div
                    class="flex flex-none items-center justify-between gap-3 border-b border-[#E9E2D9] bg-white px-4 py-3 sm:px-6">
                    <div>
                        <span
                            class="inline-flex rounded-full bg-[#F5E8E6] px-3 py-1 text-[10px] font-bold text-[#4C6B62]">مدیریت
                            فروشگاه / محصولات</span>
                        <h2 class="mt-1 text-lg font-extrabold text-[#344B43] sm:text-xl">ویرایش محصول</h2>
                        <p class="mt-1 text-[10px] text-[#87978F]">اطلاعات محصول، مشخصات، تصاویر و قیمت‌گذاری را ویرایش
                            کنید.</p>
                    </div>
                    <button type="button" onclick="editForm('close')" aria-label="بستن پنجره"
                        class="flex size-9 flex-none items-center justify-center rounded-xl bg-[#F5E8E6] text-xl text-[#4C6B62] transition hover:bg-[#EED9D8]">×</button>
                </div>

                <div id="popupContent" class="min-h-0 flex-1 overflow-y-auto p-3 sm:p-5">
                    <form action="{{ route('product.update') }}" method="post" id="editForm"
                        enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">

                        <div class="grid grid-cols-1 items-start gap-4 xl:grid-cols-3">
                            {{-- اطلاعات اصلی --}}
                            <div class="min-w-0 space-y-4 xl:col-span-2">
                                <section class="pf-card">
                                    <div class="pf-card-head">
                                        <div>
                                            <h3 class="pf-card-title">اطلاعات پایه محصول</h3>
                                            <p class="pf-card-desc">عنوان و اطلاعات شناسنامه‌ای محصول را ویرایش کنید.</p>
                                        </div>
                                        <span class="pf-icon">▤</span>
                                    </div>
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div class="pf-field sm:col-span-2"><label for="title">نام محصول <span
                                                    class="text-[#D96F7D]">*</span></label><input type="text"
                                                name="title" id="title" placeholder="نام محصول را وارد کنید"
                                                required>
                                            @error('title')
                                                <span class="pf-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="pf-field"><label for="brand">برند</label><input type="text"
                                                name="brand" id="brand" placeholder="نام برند">
                                            @error('brand')
                                                <span class="pf-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="pf-field"><label for="writer">نویسنده</label><input type="text"
                                                name="writer" id="writer" placeholder="نام نویسنده">
                                            @error('writer')
                                                <span class="pf-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="pf-field sm:col-span-2"><label
                                                for="publication">انتشارات</label><input type="text"
                                                name="publication" id="publication" placeholder="نام انتشارات">
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
                                            <p class="pf-card-desc">خلاصه و توضیحات کامل محصول را مدیریت کنید.</p>
                                        </div><span class="pf-icon">▤</span>
                                    </div>
                                    <div class="space-y-4">
                                        <div><label for="summary">خلاصه محصول</label>
                                            <textarea rows="3" name="summary" id="summary" placeholder="خلاصه‌ای از محصول..."></textarea>
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
                                            <p class="pf-card-desc">ویژگی‌هایی مانند رنگ، سایز، جنس و سایر مشخصات محصول.
                                            </p>
                                        </div><span class="pf-icon">≡</span>
                                    </div>
                                    <div id="product-attributes-list" class="space-y-3"></div>
                                    <button type="button" id="add-product-attribute" class="pf-btn pf-btn-soft mt-4">＋
                                        افزودن ویژگی</button>
                                </section>

                                <section class="pf-card">
                                    <div class="pf-card-head">
                                        <div>
                                            <h3 class="pf-card-title">تنوع و قیمت‌های مختلف</h3>
                                            <p class="pf-card-desc">مدل‌ها و ترکیب‌های مختلف محصول را مدیریت کنید.</p>
                                        </div><span class="pf-icon">＋</span>
                                    </div>
                                    <div id="packages-list" class="w-full space-y-4"></div>
                                    <button type="button" id="add-package" class="pf-btn pf-btn-soft mt-4">＋ افزودن
                                        پکیج</button>
                                </section>
                            </div>

                            {{-- سایدبار --}}
                            <aside class="min-w-0 space-y-4">
                                <section class="pf-card">
                                    <div class="pf-card-head">
                                        <div>
                                            <h3 class="pf-card-title">دسته‌بندی محصول</h3>
                                            <p class="pf-card-desc">یک یا چند دسته‌بندی مرتبط انتخاب کنید.</p>
                                        </div><span class="pf-icon">▰</span>
                                    </div>
                                    <div
                                        class="mb-3 flex items-center gap-2 rounded-xl border border-[#E8E3DA] bg-[#FBF6EF] px-3 py-2.5 focus-within:border-[#95ADA2] focus-within:ring-4 focus-within:ring-[#4C6B62]/10">
                                        <svg class="size-4 flex-none text-[#87978F]" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="7"></circle>
                                            <path stroke-linecap="round" d="m16 16 4 4"></path>
                                        </svg>
                                        <input type="search" id="edit-category-search" autocomplete="off"
                                            placeholder="جست‌وجوی دسته‌بندی..." aria-label="جست‌وجوی دسته‌بندی">
                                        <button type="button" id="edit-clear-category-search"
                                            class="hidden flex-none rounded-lg px-2 py-1 text-[10px] font-bold text-[#4C6B62] hover:bg-white">پاک
                                            کردن</button>
                                    </div>
                                    <div id="edit-selected-category-chips" class="mb-3 flex min-h-7 flex-wrap gap-2"
                                        aria-live="polite">
                                        <span id="edit-category-empty-selection" class="text-[10px] text-[#A6ADA6]">در حال
                                            بارگذاری دسته‌بندی‌ها...</span>
                                    </div>
                                    <div class="overflow-hidden rounded-xl border border-[#E8E3DA] bg-white">
                                        <div
                                            class="flex items-center justify-between border-b border-[#F0EAE2] bg-[#FCF9F4] px-3 py-2.5">
                                            <span class="text-[11px] font-bold text-[#465F56]">دسته‌بندی‌ها</span><span
                                                id="edit-category-result-count" class="text-[10px] text-[#87978F]">۰
                                                دسته‌بندی</span>
                                        </div>
                                        <div id="edit-category-options" class="max-h-56 overflow-y-auto p-2">
                                            <p id="edit-category-no-results"
                                                class="hidden px-3 py-7 text-center text-[11px] text-[#87978F]">
                                                دسته‌بندی‌ای با این عبارت پیدا نشد.</p>
                                        </div>
                                    </div>
                                    <p class="pf-hint mt-2">با تایپ هر عبارت، دسته‌بندی‌های شامل آن عبارت نمایش داده
                                        می‌شوند. انتخاب‌های قبلی حفظ می‌شوند.</p>
                                    {{-- select اصلی حفظ شده تا کد قبلی و ارسال فرم بدون تغییر کار کند --}}
                                    <select name="category_ids[]" id="category_ids" multiple hidden tabindex="-1"
                                        aria-hidden="true"></select>
                                    @error('category_ids')
                                        <span class="pf-error">{{ $message }}</span>
                                    @enderror
                                </section>

                                <section class="pf-card">
                                    <div class="pf-card-head">
                                        <div>
                                            <h3 class="pf-card-title">وضعیت و موجودی</h3>
                                            <p class="pf-card-desc">نمایش محصول و تعداد موجودی را تعیین کنید.</p>
                                        </div><span class="pf-icon">▣</span>
                                    </div>
                                    <div class="flex items-center justify-between gap-3 rounded-xl bg-[#FBF6EF] p-3"><span
                                            class="text-xs font-semibold text-[#465F56]">نمایش در صفحه اصلی</span><label
                                            for="show_in_home" class="pf-switch"><input type="checkbox"
                                                name="show_in_home" value="1"
                                                id="show_in_home"><span></span><span></span></label></div>
                                    <div class="mt-4"><label for="count">تعداد موجودی</label>
                                        <div class="flex items-center gap-2"><button type="button"
                                                class="flex size-9 flex-none items-center justify-center rounded-xl bg-[#4C6B62] text-lg text-white hover:bg-[#3B554D]"
                                                onclick="calculate('+')">＋</button><input type="number" min="1"
                                                name="count" id="count" dir="ltr" class="text-center"><button
                                                type="button"
                                                class="flex size-9 flex-none items-center justify-center rounded-xl bg-[#4C6B62] text-lg text-white hover:bg-[#3B554D]"
                                                onclick="calculate('-')">−</button></div>
                                        <p class="pf-hint mt-2">عدد موجودی را می‌توانید مستقیماً وارد کنید.</p>
                                    </div>
                                </section>

                                <section class="pf-card">
                                    <div class="pf-card-head">
                                        <div>
                                            <h3 class="pf-card-title">تصاویر محصول</h3>
                                            <p class="pf-card-desc">تصویر اصلی و تصاویر گالری را تغییر دهید.</p>
                                        </div><span class="pf-icon">▧</span>
                                    </div>
                                    <div class="space-y-4">
                                        <div><label for="mainImage">تصویر اصلی جدید</label><input type="file"
                                                name="mainImage" id="mainImage" accept="image/*">
                                            <div id="mainImgContainer" class="relative mt-2 min-h-2"></div>
                                        </div>
                                        <div><label for="gallery">تصاویر گالری</label><input type="file"
                                                name="gallery[]" id="gallery" accept="image/*" multiple>
                                            <p class="pf-hint mt-2">حجم کل فایل‌ها نباید بیشتر از ۱ مگابایت باشد.</p>
                                            <div id="galleryContainer"
                                                class="mt-2 flex items-center gap-3 overflow-x-auto p-1"></div>
                                        </div>
                                    </div>
                                </section>

                                <section class="pf-card">
                                    <div class="pf-card-head">
                                        <div>
                                            <h3 class="pf-card-title">قیمت‌گذاری</h3>
                                            <p class="pf-card-desc">قیمت اصلی و قیمت ویژه محصول.</p>
                                        </div><span class="pf-icon">＄</span>
                                    </div>
                                    <div class="space-y-4">
                                        <div><label for="primary_price">قیمت اصلی</label><input type="number"
                                                name="primary_price" id="primary_price" min="0"
                                                placeholder="مبلغ به تومان">
                                            <p class="pf-hint mt-2">برای استعلام قیمت، این فیلد را خالی بگذارید.</p>
                                        </div>
                                        <div><label for="secondary_price">قیمت ویژه</label><input type="number"
                                                name="secondary_price" id="secondary_price" min="0"
                                                placeholder="مبلغ به تومان"></div>
                                    </div>
                                </section>
                            </aside>
                        </div>

                        <div
                            class="flex flex-col-reverse gap-3 rounded-2xl border border-[#E9E2D9] bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-5">
                            <p class="text-[10px] leading-6 text-[#87978F]">پس از بررسی اطلاعات، تغییرات محصول را ذخیره
                                کنید.</p>
                            <div class="flex flex-col-reverse gap-2 sm:flex-row">
                                <button type="button" onclick="editForm('close')"
                                    class="pf-btn border border-[#E9E2D9] bg-white px-6 py-3 text-[#65766E]">انصراف</button>
                                <button type="submit" class="pf-btn pf-btn-primary px-8 py-3">ذخیره تغییرات
                                    <span>←</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.getElementById('editFormPopup');
            if (!popup || popup.dataset.categorySearchReady === '1') return;
            popup.dataset.categorySearchReady = '1';

            const select = popup.querySelector('#category_ids');
            const list = popup.querySelector('#edit-category-options');
            const search = popup.querySelector('#edit-category-search');
            const clear = popup.querySelector('#edit-clear-category-search');
            const chips = popup.querySelector('#edit-selected-category-chips');
            const empty = popup.querySelector('#edit-category-empty-selection');
            const count = popup.querySelector('#edit-category-result-count');
            const noResults = popup.querySelector('#edit-category-no-results');

            if (!select || !list) return;

            function normalize(value) {
                return String(value || '').trim().toLocaleLowerCase('fa').replace(/ي/g, 'ی').replace(/ك/g, 'ک');
            }

            function renderOptions() {
                const previous = new Map(Array.from(list.querySelectorAll('[data-edit-category-option]')).map(
                    el => [el.dataset.id, el]));
                const options = Array.from(select.options);
                const existingIds = new Set(options.map(option => String(option.value)));

                previous.forEach((element, id) => {
                    if (!existingIds.has(id)) element.remove();
                });

                options.forEach(option => {
                    const id = String(option.value);
                    let row = previous.get(id);
                    if (!row) {
                        row = document.createElement('label');
                        row.dataset.editCategoryOption = '1';
                        row.dataset.id = id;
                        row.className =
                            'flex items-center gap-3 cursor-pointer rounded-lg px-3 py-2.5 transition hover:bg-[#FBF6EF]';
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.className = 'category-checkbox size-4 flex-none';
                        checkbox.value = id;
                        const title = document.createElement('span');
                        title.className = 'min-w-0 flex-1 truncate text-[11px] font-medium text-[#465F56]';
                        const tick = document.createElement('span');
                        tick.className = 'category-check-indicator hidden text-xs font-bold text-[#4C6B62]';
                        tick.textContent = '✓';
                        row.append(checkbox, title, tick);
                        list.insertBefore(row, noResults);
                    }
                    row.querySelector('span').textContent = option.textContent.trim();
                    row.dataset.title = normalize(option.textContent);
                    row.querySelector('input').checked = option.selected;
                    row.classList.toggle('is-selected', option.selected);
                    row.querySelector('.category-check-indicator').classList.toggle('hidden', !option
                        .selected);
                });

                applyFilter();
                renderChips();
            }

            function renderChips() {
                chips.innerHTML = '';
                const selected = Array.from(select.options).filter(option => option.selected);
                empty.classList.toggle('hidden', selected.length > 0);
                if (!selected.length) {
                    empty.textContent = select.options.length ? 'هنوز دسته‌بندی‌ای انتخاب نشده است.' :
                        'دسته‌بندی‌ای برای این محصول ثبت نشده است.';
                    chips.appendChild(empty);
                } else {
                    selected.forEach(option => {
                        const chip = document.createElement('span');
                        chip.className = 'category-chip';
                        const title = document.createElement('span');
                        title.textContent = option.textContent.trim();
                        const remove = document.createElement('button');
                        remove.type = 'button';
                        remove.textContent = '×';
                        remove.setAttribute('aria-label', 'حذف ' + option.textContent.trim());
                        remove.addEventListener('click', () => {
                            option.selected = false;
                            syncFromSelect();
                            select.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                        });
                        chip.append(title, remove);
                        chips.appendChild(chip);
                    });
                }
            }

            function applyFilter() {
                const query = normalize(search.value);
                let visible = 0;
                list.querySelectorAll('[data-edit-category-option]').forEach(row => {
                    const matches = !query || row.dataset.title.includes(query);
                    row.classList.toggle('hidden', !matches);
                    if (matches) visible++;
                });
                count.textContent = visible + ' از ' + select.options.length + ' دسته‌بندی';
                noResults.classList.toggle('hidden', visible > 0 || select.options.length === 0);
                clear.classList.toggle('hidden', !search.value);
            }

            function syncFromSelect() {
                list.querySelectorAll('[data-edit-category-option]').forEach(row => {
                    const option = Array.from(select.options).find(item => String(item.value) === row
                        .dataset.id);
                    const checked = !!option && option.selected;
                    row.querySelector('input').checked = checked;
                    row.classList.toggle('is-selected', checked);
                    row.querySelector('.category-check-indicator').classList.toggle('hidden', !checked);
                });
                renderChips();
            }

            list.addEventListener('change', event => {
                if (!event.target.matches('.category-checkbox')) return;
                const option = Array.from(select.options).find(item => String(item.value) === event.target
                    .value);
                if (option) option.selected = event.target.checked;
                syncFromSelect();
                select.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            });

            search.addEventListener('input', applyFilter);
            clear.addEventListener('click', () => {
                search.value = '';
                applyFilter();
                search.focus();
            });
            select.addEventListener('change', syncFromSelect);

            // گزینه‌ها ممکن است هنگام باز شدن فرم و توسط کد قبلی ویرایش محصول اضافه شوند.
            const observer = new MutationObserver(renderOptions);
            observer.observe(select, {
                childList: true,
                subtree: true
            });
            renderOptions();

            // اگر کد قبلی مقدار selected را بعد از ساخت گزینه‌ها تنظیم کرد، هنگام بازشدن پاپ‌آپ همگام‌سازی شود.
            const popupObserver = new MutationObserver(() => {
                if (!popup.classList.contains('invisible')) renderOptions();
            });
            popupObserver.observe(popup, {
                attributes: true,
                attributeFilter: ['class', 'style']
            });
        });
    </script>
    {{-- end editForm popup --}}



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

    <template id="attribute-template">

        <div class="attribute-item border border-[#D5DFE4] rounded-xl p-4 space-y-4 bg-[#F9F9F9]">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                <div>
                    <label class="block mb-2 text-sm font-medium">عنوان ویژگی</label>

                    <select class="attribute-select w-full border border-[#D5DFE4] rounded-lg p-2 bg-white" required>
                    </select>
                </div>

                <div>
                    <button type="button"
                        class="remove-attribute w-full bg-red-100 hover:bg-red-200 text-red-700 rounded-lg p-2">
                        حذف ویژگی
                    </button>
                </div>

            </div>

            <div class="attribute-values-container border-t border-[#D5DFE4] pt-4">

                <div class="flex items-center justify-between mb-3">
                    <label class="font-medium text-sm">مقادیر ویژگی</label>

                    <button type="button" class="add-attribute-value text-[#1B84FF] hover:text-[#056EE9] text-sm">
                        + افزودن مقدار
                    </button>
                </div>

                <div class="attribute-values space-y-2"></div>

            </div>

        </div>

    </template>


    {{-- ============================================== --}}
    {{-- قالب مقدار ویژگی --}}
    {{-- ============================================== --}}

    <template id="attribute-value-template">

        <div class="attribute-value-item flex items-center gap-2">

            <input type="text" class="attribute-value-input flex-1 border border-[#D5DFE4] rounded-lg p-2 bg-white"
                placeholder="مقدار ویژگی" required>

            <button type="button"
                class="remove-attribute-value bg-red-100 hover:bg-red-200 text-red-600 rounded-lg px-3 py-2">
                ✕
            </button>

        </div>

    </template>


    {{-- ============================================== --}}
    {{-- قالب پکیج --}}
    {{-- ============================================== --}}

    <template id="package-template">

        <div class="package-item border border-[#D5DFE4] rounded-xl p-5 space-y-5 bg-[#F9F9F9]">

            <div class="flex items-center justify-between gap-3">

                <h3 class="package-heading font-bold text-lg">محصول متغیر جدید</h3>

                <button type="button"
                    class="remove-package bg-red-100 hover:bg-red-200 text-red-700 rounded-lg px-3 py-2">
                    حذف محصول متغیر
                </button>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-2 text-sm">تعداد</label>
                    <input type="number" class="package-count w-full border border-[#D5DFE4] rounded-lg p-2 bg-white"
                        min="1" value="1" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm">قیمت اصلی</label>
                    <input type="number"
                        class="package-primary-price w-full border border-[#D5DFE4] rounded-lg p-2 bg-white"
                        min="0" placeholder="قیمت اصلی">
                </div>

                <div>
                    <label class="block mb-2 text-sm">قیمت ویژه</label>
                    <input type="number"
                        class="package-secondary-price w-full border border-[#D5DFE4] rounded-lg p-2 bg-white"
                        min="0" placeholder="قیمت ویژه">
                </div>

            </div>

            <div class="package-attributes-section border-t border-[#D5DFE4] pt-4">

                <div class="flex items-center justify-between gap-3 mb-4">

                    <h4 class="font-bold">ویژگی‌های این پکیج</h4>

                    <button type="button"
                        class="add-package-attribute bg-[#1B84FF] hover:bg-[#056EE9] text-white rounded-lg px-3 py-2 text-sm">
                        + افزودن ویژگی
                    </button>

                </div>

                <div class="package-attributes-list space-y-3"></div>

            </div>

        </div>

    </template>


    <script src="{{ asset('js/product.js') }}"></script>

    <script>
        function editForm(state, id) {

            let editFormPopup = document.getElementById('editFormPopup')

            if (state == 'open') {

                let product_id = document.getElementById('product_id')
                let title = document.getElementById('title')
                let summary = document.getElementById('summary')
                let show_in_home = document.getElementById('show_in_home')
                let count = document.getElementById('count')
                let mainImgContainer = document.getElementById('mainImgContainer')
                let galleryContainer = document.getElementById('galleryContainer')
                let primary_price = document.getElementById('primary_price')
                let secondary_price = document.getElementById('secondary_price')
                let category_ids = document.getElementById('category_ids')
                let editFormEl = document.getElementById('editForm')

                // پاک کردن اینپوت‌های حذف عکس مربوط به دفعه قبل
                editFormEl.querySelectorAll('input[name^="removedImgs"]').forEach(input => input.remove())

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                })

                $.ajax({
                    url: "{{ route('product.edit') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'id': id,
                    },
                    success: function(data) {

                        const product = data['product']

                        product_id.value = product.id
                        title.value = product.title
                        summary.value = product.summary ?? ''
                        count.value = product.count
                        primary_price.value = product.primary_price ?? ''
                        secondary_price.value = product.secondary_price ?? ''
                        show_in_home.checked = !!product.show_in_home
                        window.productEditor.value = product.description ?? '';

                        // تصاویر
                        mainImgContainer.innerHTML = ''
                        galleryContainer.innerHTML = ''

                        product.media.forEach(media => {
                            if (media.is_main) {
                                let div = document.createElement('div')
                                div.innerHTML = `
                                <img src="${media['media_path']}" class="w-35 h-20 rounded-lg">
                                <span class="absolute top-0 left-5 cursor-pointer" onclick="removeImg(this, '${media['media_path']}', 'mainImg')">❌</span>
                            `
                                mainImgContainer.appendChild(div)
                            } else {
                                let div = document.createElement('div')
                                div.classList = 'relative'
                                div.innerHTML = `
                                <img src="${media['media_path']}" class="min-w-35 h-20 rounded-lg">
                                <span class="absolute top-0 left-0 cursor-pointer" onclick="removeImg(this, '${media['media_path']}', 'gallery')">❌</span>
                            `
                                galleryContainer.appendChild(div)
                            }
                        })

                        // دسته‌بندی‌ها
                        category_ids.innerHTML = ''

                        data['cats'].forEach(category => {
                            let option = document.createElement('option')
                            option.value = category.id
                            option.innerText = category.title
                            option.selected = data.catIds.map(String).includes(String(category.id))
                            category_ids.appendChild(option)
                        })

                        // ویژگی‌های دسته‌بندی‌ها (برای سلکت ویژگی‌ها و تشخیص رنگ)
                        if (data.categoriesData) {
                            window.CATEGORIES = data.categoriesData
                        }

                        // ویژگی‌ها و پکیج‌ها (باید بعد از انتخاب دسته‌بندی‌ها باشد)
                        PackageForm.load({
                            attributes: product.attributes || [],
                            packages: product.packages || []
                        })

                    },
                    error: function() {
                        alert('error')
                    }
                })

                editFormPopup.classList.remove('invisible', 'opacity-0')
            }

            if (state == 'close') {
                editFormPopup.classList.add('invisible', 'opacity-0')
            }
        }

        function removeImg(el, file, type) {

            let editForm = document.getElementById('editForm')

            let index = file.indexOf('productImgs')
            let result = file.slice(index)

            if (type == 'mainImg') {
                let input = document.createElement('input')
                input.setAttribute("type", 'hidden')
                input.setAttribute("name", "removedImgs[mainImg]")
                input.setAttribute("value", result)
                editForm.appendChild(input)
            }

            if (type == 'gallery') {
                let input = document.createElement('input')
                input.setAttribute("type", 'hidden')
                input.setAttribute("name", "removedImgs[gallery][]")
                input.setAttribute("value", result)
                editForm.appendChild(input)
            }

            el.parentElement.remove()
        }

        function deleteProduct(state, id, proTitle) {

            let confirmDeletePopup = document.getElementById('confirmDeletePopup')

            if (state == 'open') {
                let yes = document.getElementById('yes')
                yes.setAttribute('href', `{{ url('product/delete') }}/${id}`)

                let confirmDeleteProName = document.getElementById('confirmDeleteProName')
                confirmDeleteProName.innerText = proTitle

                confirmDeletePopup.classList.remove('invisible', 'opacity-0')
            }

            if (state == 'close') {
                confirmDeletePopup.classList.add('invisible', 'opacity-0')
            }
        }

        function calculate(state) {

            let count = document.getElementById('count')

            if (state == "+") {
                count.value++
            }

            if (count.value > 1) {
                if (state == "-") {
                    count.value--
                }
            }
        }
    </script>

    {{-- باید بعد از template ها لود شود --}}
    <script src="{{ url('js/packageForm.js') }}"></script>
    <script src="{{ asset('js/checkAll.js') }}"></script>

@endsection
