@extends('admin.app.dashboard')
@section('title', 'طبابوک | تنظیمات فوتر')
@section('content')
<div class="max-w-6xl mx-auto pb-24">

    <!-- ==================== عنوان صفحه ==================== -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <span>تنظیمات</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="text-gray-800 font-medium">فوتر</span>
        </div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">تنظیمات فوتر</h1>
        <p class="text-gray-500 mt-2 text-sm md:text-base">
            مدیریت برند، خدمات، دسته‌بندی‌ها، اطلاعات تماس و شبکه‌های اجتماعی.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.74-2.99l-6.93-12a2 2 0 00-3.48 0l-6.93 12A2 2 0 005.07 19z"/>
                </svg>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-sm text-emerald-800">{{ session('success') }}</span>
        </div>
    @endif

    <form id="footerForm" class="space-y-6" action="{{ route('setting.footerStore') }}" method="POST">
        @csrf

        <!-- ==================== ستون ۱: برند ==================== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-l from-indigo-50/60 to-transparent px-6 py-4">
                <h2 class="text-base md:text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </span>
                    ستون اول — برند فروشگاه
                </h2>
            </div>

            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerBrandName" class="text-sm font-medium text-gray-700">نام فروشگاه</label>
                    <div class="md:col-span-2">
                        <input type="text" id="footerBrandName" name="footerBrandName"
                            value="{{ old('footerBrandName', $footerBrandName->meta_value ?? '') }}"
                            placeholder="مثلا: کتاب فروشی طباطبایی"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                    <label for="footerBrandDescription" class="text-sm font-medium text-gray-700 md:pt-2.5">توضیح کوتاه</label>
                    <div class="md:col-span-2">
                        <textarea id="footerBrandDescription" name="footerBrandDescription" rows="3"
                            placeholder="مثلا: با ما کتاب را جوری دیگر تجربه کنید"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition resize-none">{{ old('footerBrandDescription', $footerBrandDescription->meta_value ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== ستون ۲: خدمات ما ==================== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-l from-emerald-50/60 to-transparent px-6 py-4 flex items-center justify-between">
                <h2 class="text-base md:text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    ستون دوم — خدمات ما
                </h2>
                <button type="button" onclick="addItem('services')"
                    class="text-xs px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition font-medium flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    افزودن
                </button>
            </div>

            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerServicesTitle" class="text-sm font-medium text-gray-700">عنوان ستون</label>
                    <div class="md:col-span-2">
                        <input type="text" id="footerServicesTitle" name="footerServicesTitle"
                            value="{{ old('footerServicesTitle', $footerServicesTitle->meta_value ?? 'خدمات ما') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 outline-none transition">
                    </div>
                </div>

                @php
                    $servicesItems = json_decode($footerServices->meta_value ?? '[]', true) ?: [
                        ['title' => 'فوتوکپی و پرینت', 'url' => '#'],
                        ['title' => 'اجاره بیلبورد', 'url' => '#'],
                        ['title' => 'اعلامیه ترحیم', 'url' => '#'],
                        ['title' => 'بنر زیارتی و تبریک', 'url' => '#'],
                        ['title' => 'سفارش تابلو خطاطی', 'url' => '#'],
                        ['title' => 'چاپ طرح روی ماگ', 'url' => '#'],
                    ];
                @endphp

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">آیتم‌های لیست</label>
                    <div id="services-items" class="space-y-2">
                        @foreach ($servicesItems as $index => $item)
                            <div class="flex gap-2 items-center item-row">
                                <span class="w-6 h-6 rounded-md bg-gray-100 text-gray-500 text-xs flex items-center justify-center shrink-0 drag-handle cursor-grab">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                                    </svg>
                                </span>
                                <input type="text" placeholder="عنوان" value="{{ $item['title'] ?? '' }}"
                                    data-field="title"
                                    class="flex-1 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition text-sm">
                                <input type="text" placeholder="لینک" value="{{ $item['url'] ?? '#' }}" dir="ltr"
                                    data-field="url"
                                    class="flex-1 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition text-sm">
                                <button type="button" onclick="removeItem(this)"
                                    class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="footerServices" id="footerServicesInput">
                </div>
            </div>
        </div>

        <!-- ==================== ستون ۳: دسته‌بندی‌ها ==================== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-l from-amber-50/60 to-transparent px-6 py-4 flex items-center justify-between">
                <h2 class="text-base md:text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </span>
                    ستون سوم — دسته‌بندی‌ها
                </h2>
                <button type="button" onclick="addItem('categories')"
                    class="text-xs px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 transition font-medium flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    افزودن
                </button>
            </div>

            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerCategoriesTitle" class="text-sm font-medium text-gray-700">عنوان ستون</label>
                    <div class="md:col-span-2">
                        <input type="text" id="footerCategoriesTitle" name="footerCategoriesTitle"
                            value="{{ old('footerCategoriesTitle', $footerCategoriesTitle->meta_value ?? 'دسته بندی ها') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-100 outline-none transition">
                    </div>
                </div>

                @php
                    $categoriesItems = json_decode($footerCategories->meta_value ?? '[]', true) ?: [
                        ['title' => 'چاپ روی پارچه', 'url' => '#'],
                        ['title' => 'تابلو', 'url' => '#'],
                        ['title' => 'کارت ویزیت', 'url' => '#'],
                        ['title' => 'پرچم رومیزی', 'url' => '#'],
                        ['title' => 'بنر', 'url' => '#'],
                        ['title' => 'بنر تبلیغاتی', 'url' => '#'],
                        ['title' => 'چاپ', 'url' => '#'],
                        ['title' => 'تجهیزات تبلیغاتی', 'url' => '#'],
                    ];
                @endphp

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">آیتم‌های لیست</label>
                    <div id="categories-items" class="space-y-2">
                        @foreach ($categoriesItems as $index => $item)
                            <div class="flex gap-2 items-center item-row">
                                <span class="w-6 h-6 rounded-md bg-gray-100 text-gray-500 text-xs flex items-center justify-center shrink-0 drag-handle cursor-grab">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                                    </svg>
                                </span>
                                <input type="text" placeholder="عنوان" value="{{ $item['title'] ?? '' }}"
                                    data-field="title"
                                    class="flex-1 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-2 focus:ring-amber-100 outline-none transition text-sm">
                                <input type="text" placeholder="لینک" value="{{ $item['url'] ?? '#' }}" dir="ltr"
                                    data-field="url"
                                    class="flex-1 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-2 focus:ring-amber-100 outline-none transition text-sm">
                                <button type="button" onclick="removeItem(this)"
                                    class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="footerCategories" id="footerCategoriesInput">
                </div>
            </div>
        </div>

        <!-- ==================== ستون ۴: درباره ما ==================== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-l from-rose-50/60 to-transparent px-6 py-4">
                <h2 class="text-base md:text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    ستون چهارم — درباره ما
                </h2>
            </div>

            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerAboutTitle" class="text-sm font-medium text-gray-700">عنوان ستون</label>
                    <div class="md:col-span-2">
                        <input type="text" id="footerAboutTitle" name="footerAboutTitle"
                            value="{{ old('footerAboutTitle', $footerAboutTitle->meta_value ?? 'درباره ما') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-rose-500 focus:ring-4 focus:ring-rose-100 outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerPhone" class="text-sm font-medium text-gray-700">شماره تماس</label>
                    <div class="md:col-span-2">
                        <div class="relative">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-rose-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                            <input type="text" id="footerPhone" name="footerPhone"
                                value="{{ old('footerPhone', $footerPhone->meta_value ?? '') }}"
                                placeholder="09371509497"
                                class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-rose-500 focus:ring-4 focus:ring-rose-100 outline-none transition">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerEmail" class="text-sm font-medium text-gray-700">ایمیل</label>
                    <div class="md:col-span-2">
                        <div class="relative">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-rose-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" id="footerEmail" name="footerEmail"
                                value="{{ old('footerEmail', $footerEmail->meta_value ?? '') }}"
                                placeholder="shahkar@gmail.com" dir="ltr"
                                class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-rose-500 focus:ring-4 focus:ring-rose-100 outline-none transition">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                    <label for="footerAddress" class="text-sm font-medium text-gray-700 md:pt-2.5">آدرس</label>
                    <div class="md:col-span-2">
                        <div class="relative">
                            <span class="absolute right-3 top-3 text-rose-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            <textarea id="footerAddress" name="footerAddress" rows="2"
                                placeholder="آذربایجان شرقی، بناب، خیابان طالقانی"
                                class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-rose-500 focus:ring-4 focus:ring-rose-100 outline-none transition resize-none">{{ old('footerAddress', $footerAddress->meta_value ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== شبکه‌های اجتماعی ==================== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-l from-sky-50/60 to-transparent px-6 py-4">
                <h2 class="text-base md:text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </span>
                    شبکه‌های اجتماعی
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label for="footerInstagram" class="block text-sm font-medium text-gray-700 mb-2">اینستاگرام</label>
                    <div class="relative">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-pink-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </span>
                        <input type="text" id="footerInstagram" name="footerInstagram"
                            value="{{ old('footerInstagram', $footerInstagram->meta_value ?? '') }}"
                            placeholder="https://instagram.com/..." dir="ltr"
                            class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="footerTelegram" class="block text-sm font-medium text-gray-700 mb-2">تلگرام</label>
                    <div class="relative">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-sky-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 000 12a12 12 0 0012 12 12 12 0 0012-12A12 12 0 0012 0a12 12 0 00-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 01.171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                        </span>
                        <input type="text" id="footerTelegram" name="footerTelegram"
                            value="{{ old('footerTelegram', $footerTelegram->meta_value ?? '') }}"
                            placeholder="https://t.me/..." dir="ltr"
                            class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="footerWhatsapp" class="block text-sm font-medium text-gray-700 mb-2">واتساپ</label>
                    <div class="relative">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-emerald-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                        </span>
                        <input type="text" id="footerWhatsapp" name="footerWhatsapp"
                            value="{{ old('footerWhatsapp', $footerWhatsapp->meta_value ?? '') }}"
                            placeholder="https://wa.me/..." dir="ltr"
                            class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="footerEmailSocial" class="block text-sm font-medium text-gray-700 mb-2">لینک ایمیل</label>
                    <div class="relative">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-rose-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input type="text" id="footerEmailSocial" name="footerEmailSocial"
                            value="{{ old('footerEmailSocial', $footerEmailSocial->meta_value ?? '') }}"
                            placeholder="mailto:info@example.com" dir="ltr"
                            class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 outline-none transition">
                    </div>
                </div>

            </div>
        </div>

        <!-- ==================== پایین فوتر ==================== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-l from-gray-50 to-transparent px-6 py-4">
                <h2 class="text-base md:text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </span>
                    پایین فوتر — کپی‌رایت و اطلاعات طراح
                </h2>
            </div>

            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerCopyright" class="text-sm font-medium text-gray-700">متن کپی‌رایت</label>
                    <div class="md:col-span-2">
                        <input type="text" id="footerCopyright" name="footerCopyright"
                            value="{{ old('footerCopyright', $footerCopyright->meta_value ?? '') }}"
                            placeholder="© ۱۴۰۳ کتاب فروشی طباطبایی — تمامی حقوق محفوظ است."
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerDesignerText" class="text-sm font-medium text-gray-700">متن طراح</label>
                    <div class="md:col-span-2">
                        <input type="text" id="footerDesignerText" name="footerDesignerText"
                            value="{{ old('footerDesignerText', $footerDesignerText->meta_value ?? '') }}"
                            placeholder="طراحی و توسعه شرکت اندیشه گِران طراحان دیجیتال (قانوس)"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerDesignerPhone" class="text-sm font-medium text-gray-700">شماره تماس طراح</label>
                    <div class="md:col-span-2">
                        <input type="text" id="footerDesignerPhone" name="footerDesignerPhone"
                            value="{{ old('footerDesignerPhone', $footerDesignerPhone->meta_value ?? '') }}"
                            placeholder="09147794595"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <label for="footerDesignerUrl" class="text-sm font-medium text-gray-700">لینک سایت طراح</label>
                    <div class="md:col-span-2">
                        <input type="text" id="footerDesignerUrl" name="footerDesignerUrl"
                            value="{{ old('footerDesignerUrl', $footerDesignerUrl->meta_value ?? '') }}"
                            placeholder="https://ghanous.com" dir="ltr"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== دکمه‌های عملیات ==================== -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky bottom-4 z-20 backdrop-blur">
            <button type="reset"
                class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-700 font-medium hover:bg-gray-50 transition focus:outline-none focus:ring-4 focus:ring-gray-100">
                بازنشانی
            </button>
            <button type="submit"
                class="px-6 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 shadow-sm hover:shadow transition flex items-center justify-center gap-2 focus:outline-none focus:ring-4 focus:ring-indigo-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                ذخیره تغییرات
            </button>
        </div>

    </form>
</div>

<script>
    /* ---------- افزودن آیتم جدید ---------- */
    function addItem(type) {
        const container = document.getElementById(type + '-items');
        const color = type === 'services' ? 'emerald' : 'amber';
        
        const row = document.createElement('div');
        row.className = 'flex gap-2 items-center item-row';
        row.innerHTML = `
            <span class="w-6 h-6 rounded-md bg-gray-100 text-gray-500 text-xs flex items-center justify-center shrink-0 drag-handle cursor-grab">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                </svg>
            </span>
            <input type="text" placeholder="عنوان" data-field="title"
                class="flex-1 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-${color}-500 focus:ring-2 focus:ring-${color}-100 outline-none transition text-sm">
            <input type="text" placeholder="لینک" value="#" dir="ltr" data-field="url"
                class="flex-1 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-${color}-500 focus:ring-2 focus:ring-${color}-100 outline-none transition text-sm">
            <button type="button" onclick="removeItem(this)"
                class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        `;
        container.appendChild(row);
    }

    /* ---------- حذف آیتم ---------- */
    function removeItem(btn) {
        btn.closest('.item-row').remove();
    }

    /* ---------- تبدیل لیست‌ها به JSON قبل از ارسال ---------- */
    function serializeItems(containerId, hiddenInputId) {
        const container = document.getElementById(containerId);
        const rows = container.querySelectorAll('.item-row');
        const data = [];
        
        rows.forEach(row => {
            const title = row.querySelector('[data-field="title"]').value.trim();
            const url = row.querySelector('[data-field="url"]').value.trim();
            if (title) {
                data.push({ title, url: url || '#' });
            }
        });
        
        document.getElementById(hiddenInputId).value = JSON.stringify(data);
    }

    /* ---------- جلوگیری از ارسال دوباره + سریالایز ---------- */
    document.getElementById('footerForm').addEventListener('submit', function (e) {
        serializeItems('services-items', 'footerServicesInput');
        serializeItems('categories-items', 'footerCategoriesInput');
        
        const btn = this.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = `
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                در حال ذخیره...
            `;
        }
    });
</script>
@endsection