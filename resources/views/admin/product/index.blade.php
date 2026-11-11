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
    @error('title')
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-red-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-red-500"> {{ $message }} </span>
        </div>
    @enderror
    @error('category_ids')
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-red-100 fixed top-30 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-red-500"> {{ $message }} </span>
        </div>
    @enderror

    <div id="editFormPopup"
        class="w-full h-dvh fixed z-9999 top-0 left-0 z-5 invisible opacity-0 transition-all duration-400">
        <div class="size-full relative">
            <div class="size-full bg-black/40 absolute top-0 left-0" onclick="editForm('close')"></div>
            <div
                class="w-9/12 2xl:container 2xl:w-9/12 max-h-[calc(100vh-100px)] overflow-auto mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2">
                <div class="relative">
                    <button class="absolute -top-4 -left-4 size-6 flex flex-col justify-center items-center cursor-pointer"
                        onclick="editForm('close')">
                        <span class="w-full h-0.5 rounded-full bg-slate-500 rotate-45 translate-y-1/2"></span>
                        <span class="w-full h-0.5 rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
                    </button>
                </div>

                <div id="popupContent">
                    <form action="{{ route('product.update') }}" method="post" id="editForm"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">

                        <div class="flex flex-col md:flex-row gap-3 md:gap-5">

                            {{-- ستون سمت راست --}}
                            <div class="w-full md:w-2/3 space-y-8">

                                <div class="w-full flex flex-col">
                                    <label for="title" class="mb-2 flex flex-row items-center">
                                        <span>نام محصول:</span>
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text"
                                        class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                        name="title" id="title" placeholder="نام محصول را وارد کنید">
                                    @error('title')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full flex flex-col mt-5">

                                    <label for="brand" class="mb-2">
                                        برند:
                                    </label>

                                    <input type="text"
                                        class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                        placeholder="برند" name="brand" id="brand" value="{{ old('brand') }}">

                                    @error('brand')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="w-full flex flex-col mt-5">

                                    <label for="writer" class="mb-2">
                                        نویسنده:
                                    </label>

                                    <input type="text"
                                        class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                        placeholder="نویسنده" name="writer" id="writer"
                                        value="{{ old('writer') }}">

                                    @error('writer')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="w-full flex flex-col mt-5">

                                    <label for="publication" class="mb-2">
                                        انتشارات:
                                    </label>

                                    <input type="text"
                                        class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                        placeholder="انتشارات" name="publication" id="publication"
                                        value="{{ old('publication') }}">

                                    @error('publication')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="w-full flex flex-col mt-5">
                                    <label for="summary" class="mb-2">خلاصه محصول:</label>
                                    <textarea class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]" rows="4"
                                        placeholder="خلاصه" name="summary" id="summary"></textarea>
                                    @error('summary')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full flex flex-col mt-5">
                                    <label for="editor" class="mb-2">توضیحات محصول:</label>
                                    <textarea name="description" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]" rows="4"
                                        id="editor" placeholder="توضیحات محصول را وارد کنید"></textarea>
                                    @error('description')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full flex flex-col gap-3 mt-5">
                                    <label for="category_ids" class="mb-2 flex flex-row items-center">
                                        <span>دسته بندی :</span>
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <select name="category_ids[]" id="category_ids"
                                        class="w-full bg-[#F9F9F9] py-3 pr-5 rounded-[10px]" multiple size="1"
                                        required>
                                    </select>
                                    <span class="text-xs text-gray-400">
                                        برای انتخاب چند دسته‌بندی، کلید Ctrl را نگه دارید.
                                    </span>
                                    @error('category_ids')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>


                                {{-- ویژگی‌های عمومی محصول --}}
                                <div class="w-full flex flex-col gap-5 mt-8">

                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="font-bold text-lg">مشخصات محصول</h3>

                                        <button type="button" id="add-product-attribute"
                                            class="p-2 text-sm rounded-md bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">
                                            افزودن ویژگی +
                                        </button>
                                    </div>

                                    <div id="product-attributes-list" class="space-y-4"></div>

                                </div>


                                {{-- پکیج‌های محصول --}}
                                <div class="w-full flex flex-col gap-5 mt-8">

                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="font-bold text-lg">قیمت های مختلف محصول</h3>

                                        <button type="button" id="add-package"
                                            class="p-2 text-sm rounded-md bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">
                                            افزودن پکیج +
                                        </button>
                                    </div>

                                    <div id="packages-list" class="space-y-6"></div>

                                </div>

                            </div>


                            {{-- ستون سمت چپ --}}
                            <div class="w-full md:w-1/3 space-y-8">

                                <div class="w-full flex flex-col gap-6 mt-5">

                                    <div class="flex items-center gap-4">
                                        <label for="show_in_home">نمایش در خانه :</label>
                                        <label for="show_in_home"
                                            class="w-[50px] h-[28px] flex rounded-full cursor-pointer relative">
                                            <input type="checkbox" name="show_in_home" value="1" id="show_in_home"
                                                hidden class="peer">
                                            <span
                                                class="size-full bg-gray-300 shadow-inner rounded-full peer-checked:bg-[#1B84FF] transition-all duration-300"></span>
                                            <span
                                                class="size-[20px] rounded-full bg-white absolute top-1 left-1 peer-checked:translate-x-[22px] transition-all duration-300 shadow-md"></span>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <label class="mb-2"> تعداد :</label>
                                        <div class="flex">
                                            <div
                                                class="bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4] flex flex-row items-center">
                                                <button type="button"
                                                    class="inline-block size-7 rounded-lg bg-[#1B84FF] hover:bg-[#056EE9] cursor-pointer text-white"
                                                    onclick="calculate('+')">+</button>
                                                <input type="number" min="1"
                                                    class="outline-none w-14 text-center text-xs" name="count"
                                                    id="count" dir="ltr">
                                                <button type="button"
                                                    class="inline-block size-7 rounded-lg bg-[#1B84FF] hover:bg-[#056EE9] cursor-pointer text-white"
                                                    onclick="calculate('-')">-</button>
                                            </div>
                                        </div>
                                        <div class="relative group">
                                            <span
                                                class="size-4 text-xs bg-[#ededed] border border-[#6f6f6f] rounded-full p-2 flex justify-center items-center cursor-pointer">?</span>
                                            <span
                                                class="w-70 py-4 text-center rounded-xl text-xs absolute bottom-5 left-5 bg-[#F9F9F9] border border-slate-300 invisible opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">
                                                اگر تعداد موجودی محصول زیاد بود نیازی نیست + را بزنید روی همان نوشته عددی
                                                موجودی دوبار کلیک کرده و عدد مورد نظر را بنویسید.
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full mt-3 lg:mt-5 flex flex-col">
                                    <label for="mainImage" class="mb-2">عکس اصلی:</label>
                                    <input type="file"
                                        class="w-full outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                        name="mainImage" id="mainImage" accept="image/*">
                                    <div id="mainImgContainer" class="relative mt-2 p-2 "></div>
                                </div>

                                <div class="w-full mt-3 lg:mt-5 flex flex-col">
                                    <label for="gallery" class="mb-2">گالری تصاویر :</label>
                                    <input type="file"
                                        class="w-full outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                        name="gallery[]" id="gallery" accept="image/*" multiple>
                                    <span class="text-xs text-red-500">حجم کل فایل ها نباید بیشتر از 500 کیلوبایت
                                        باشد.</span>
                                    <div id="galleryContainer" class=" mt-2 p-2 flex items-center gap-3 overflow-auto">
                                    </div>
                                </div>

                                <div class="w-full flex flex-col gap-3 md:gap-5 mt-3 lg:mt-5">
                                    <div class="w-full flex flex-col gap-3">
                                        <label for="primary_price" class="flex items-center gap-2">
                                            <span>قیمت اصلی :</span>
                                            <div class="relative group">
                                                <span
                                                    class="size-4 text-xs bg-[#ededed] border border-[#6f6f6f] rounded-full p-2 flex justify-center items-center cursor-pointer">?</span>
                                                <span
                                                    class="w-70 py-4 text-center rounded-xl text-xs absolute bottom-5 left-5 bg-[#F9F9F9] border border-slate-300 invisible opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">در
                                                    صورتی که مایلید برای استعلام قیمت تماس گرفته شود این فیلد را خالی
                                                    بگذارید.</span>
                                            </div>
                                        </label>
                                        <input type="number"
                                            class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                            name="primary_price" id="primary_price" min="0">
                                    </div>
                                    <div class="w-full flex flex-col gap-3">
                                        <label for="secondary_price"> قیمت ویژه :</label>
                                        <input type="number"
                                            class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                            name="secondary_price" id="secondary_price" min="0">
                                    </div>
                                </div>

                                <div class="mt-5 text-center">
                                    <button type="submit"
                                        class="py-3 px-10 rounded-[10px] bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">ثبت</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
