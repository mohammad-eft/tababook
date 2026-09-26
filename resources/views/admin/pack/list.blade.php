@extends('admin.app.dashboard')
@section('title', 'طبابوک | لیست پک‌ها')

@section('content')
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f1f5f9;
            margin: 0;
        }
        .rtl { direction: rtl; }

        /* اسکرول‌بار سفارشی */
        .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Tooltip */
        .tooltip-wrapper:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
        .tooltip {
            visibility: hidden;
            opacity: 0;
            transition: all .2s;
        }
    </style>
</head>

<!-- هدر -->
<header class="max-w-7xl mx-auto mb-6 px-4 pt-6">
    <div class="bg-white rounded-2xl shadow-sm p-5 flex flex-wrap items-center justify-between gap-4 border border-slate-200">
        <div class="flex items-center gap-3">
            <div class="bg-indigo-100 p-2 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-slate-800">لیست پک‌های محصول</h1>
                <p class="text-xs text-slate-500 mt-1">مدیریت و مشاهده تمامی پک‌های ساخته شده در فروشگاه</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                ایجاد پک جدید
            </a>
        </div>
    </div>
</header>

<!-- آمار سریع -->
<section class="max-w-7xl mx-auto mb-6 px-4">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 flex items-center gap-3">
            <div class="bg-indigo-50 p-2.5 rounded-xl text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-500">کل پک‌ها</p>
                <p class="text-lg font-bold text-slate-800">۱۲۸</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 flex items-center gap-3">
            <div class="bg-emerald-50 p-2.5 rounded-xl text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-500">پک‌های فعال</p>
                <p class="text-lg font-bold text-slate-800">۹۴</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 flex items-center gap-3">
            <div class="bg-amber-50 p-2.5 rounded-xl text-amber-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-500">در انتظار انتشار</p>
                <p class="text-lg font-bold text-slate-800">۲۳</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 flex items-center gap-3">
            <div class="bg-rose-50 p-2.5 rounded-xl text-rose-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-500">غیرفعال</p>
                <p class="text-lg font-bold text-slate-800">۱۱</p>
            </div>
        </div>
    </div>
</section>

<!-- نوار جستجو و فیلتر -->
<section class="max-w-7xl mx-auto mb-6 px-4">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4">
        <div class="flex flex-col md:flex-row gap-3 items-stretch md:items-center">
            <!-- جستجو -->
            <div class="relative flex-1">
                <input type="text" id="searchInput" placeholder="جستجوی عنوان پک..." class="w-full pr-10 pl-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- فیلتر وضعیت -->
            <select id="statusFilter" class="px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-white cursor-pointer md:w-48">
                <option value="">همه وضعیت‌ها</option>
                <option value="active">فعال</option>
                <option value="pending">در انتظار انتشار</option>
                <option value="inactive">غیرفعال</option>
            </select>

            <!-- فیلتر مرتب‌سازی -->
            <select id="sortFilter" class="px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm bg-white cursor-pointer md:w-48">
                <option value="newest">جدیدترین</option>
                <option value="oldest">قدیمی‌ترین</option>
                <option value="price-high">بیشترین قیمت</option>
                <option value="price-low">کمترین قیمت</option>
            </select>

            <!-- دکمه پاک کردن فیلتر -->
            <button id="clearFilters" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-600 text-sm font-medium hover:bg-slate-50 transition-colors whitespace-nowrap flex items-center gap-2 justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                پاک کردن
            </button>
        </div>

        <!-- فیلترهای فعال -->
        <div class="flex flex-wrap items-center gap-2 mt-3 pt-3 border-t border-slate-100" id="activeFilters">
            <span class="text-xs text-slate-500">فیلترهای فعال:</span>
            <span class="hidden text-xs bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-full" id="filterSearchTag">جستجو: <span id="filterSearchValue"></span></span>
            <span class="hidden text-xs bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full" id="filterStatusTag">وضعیت: <span id="filterStatusValue"></span></span>
            <span class="hidden text-xs bg-amber-50 text-amber-700 px-2.5 py-1 rounded-full" id="filterSortTag">مرتب‌سازی: <span id="filterSortValue"></span></span>
        </div>
    </div>
</section>

<!-- لیست پک‌ها -->
<section class="max-w-7xl mx-auto px-4 pb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- نمای دسکتاپ: جدول -->
        <div class="hidden md:block overflow-x-auto custom-scroll">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-right text-slate-600">
                        <th class="py-3 px-4 font-medium w-12">
                            <input type="checkbox" id="selectAllPacks" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        </th>
                        <th class="py-3 px-4 font-medium">پک</th>
                        <th class="py-3 px-4 font-medium">تعداد کتاب</th>
                        <th class="py-3 px-4 font-medium">قیمت</th>
                        <th class="py-3 px-4 font-medium">تخفیف</th>
                        <th class="py-3 px-4 font-medium">وضعیت</th>
                        <th class="py-3 px-4 font-medium">تاریخ ایجاد</th>
                        <th class="py-3 px-4 font-medium w-32">عملیات</th>
                    </tr>
                </thead>
                <tbody id="packsTableBody" class="divide-y divide-slate-100">
                    <!-- ردیف ۱ -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="pack-checkbox w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                    <img src="https://picsum.photos/60/60?random=10" alt="" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 truncate">پک کتاب‌های روانشناسی موفقیت</p>
                                    <p class="text-xs text-slate-500 truncate mt-0.5">شامل ۵ کتاب برتر حوزه روانشناسی</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 text-slate-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                ۵ کتاب
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800">۴۲۵,۰۰۰ تومان</span>
                                <span class="text-xs text-slate-400 line-through">۵۰۰,۰۰۰ تومان</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center bg-rose-50 text-rose-600 text-xs px-2.5 py-1 rounded-full font-medium">۱۵٪</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-medium">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                فعال
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-500 text-xs">۱۴۰۴/۰۱/۱۵</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-1">
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">مشاهده</span>
                                </button>
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">ویرایش</span>
                                </button>
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">حذف</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- ردیف ۲ -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="pack-checkbox w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                    <img src="https://picsum.photos/60/60?random=11" alt="" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 truncate">پک کتاب‌های کلاسیک جهان</p>
                                    <p class="text-xs text-slate-500 truncate mt-0.5">شاهکارهای ادبیات کلاسیک در یک پک</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 text-slate-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                ۳ کتاب
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800">۳۲۰,۰۰۰ تومان</span>
                                <span class="text-xs text-slate-400 line-through">۴۰۰,۰۰۰ تومان</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center bg-rose-50 text-rose-600 text-xs px-2.5 py-1 rounded-full font-medium">۲۰٪</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 text-xs px-2.5 py-1 rounded-full font-medium">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                در انتظار انتشار
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-500 text-xs">۱۴۰۴/۰۱/۱۲</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-1">
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">مشاهده</span>
                                </button>
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">ویرایش</span>
                                </button>
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">حذف</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- ردیف ۳ -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="pack-checkbox w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                    <img src="https://picsum.photos/60/60?random=12" alt="" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 truncate">پک کتاب‌های کودک و نوجوان</p>
                                    <p class="text-xs text-slate-500 truncate mt-0.5">مجموعه‌ای جذاب برای کودکان</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 text-slate-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                ۷ کتاب
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800">۲۸۰,۰۰۰ تومان</span>
                                <span class="text-xs text-slate-400 line-through">۳۵۰,۰۰۰ تومان</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center bg-rose-50 text-rose-600 text-xs px-2.5 py-1 rounded-full font-medium">۲۰٪</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-medium">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                فعال
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-500 text-xs">۱۴۰۴/۰۱/۱۰</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-1">
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">مشاهده</span>
                                </button>
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">ویرایش</span>
                                </button>
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">حذف</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- ردیف ۴ -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-4">
                            <input type="checkbox" class="pack-checkbox w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                    <img src="https://picsum.photos/60/60?random=13" alt="" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 truncate">پک کتاب‌های تاریخی ایران</p>
                                    <p class="text-xs text-slate-500 truncate mt-0.5">سیری در تاریخ پرافتخار ایران</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 text-slate-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                ۴ کتاب
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800">۵۸۰,۰۰۰ تومان</span>
                                <span class="text-xs text-slate-400 line-through">۷۰۰,۰۰۰ تومان</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center bg-rose-50 text-rose-600 text-xs px-2.5 py-1 rounded-full font-medium">۱۷٪</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 bg-rose-50 text-rose-700 text-xs px-2.5 py-1 rounded-full font-medium">
                                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                                غیرفعال
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-500 text-xs">۱۴۰۴/۰۱/۰۵</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-1">
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">مشاهده</span>
                                </button>
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">ویرایش</span>
                                </button>
                                <button class="tooltip-wrapper relative p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="tooltip absolute bottom-full right-1/2 translate-x-1/2 mb-1 bg-slate-800 text-white text-xs px-2 py-1 rounded whitespace-nowrap">حذف</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- نمای موبایل: کارت‌ها -->
        <div class="md:hidden divide-y divide-slate-100" id="packsMobileList">
            <!-- کارت ۱ -->
            <div class="p-4">
                <div class="flex items-start gap-3">
                    <input type="checkbox" class="pack-checkbox w-4 h-4 mt-1 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer flex-shrink-0">
                    <div class="w-14 h-14 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                        <img src="https://picsum.photos/60/60?random=10" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start gap-2">
                            <h3 class="font-bold text-slate-800 text-sm">پک کتاب‌های روانشناسی موفقیت</h3>
                            <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 text-xs px-2 py-0.5 rounded-full font-medium flex-shrink-0">
                                فعال
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-1">شامل ۵ کتاب برتر حوزه روانشناسی</p>

                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="inline-flex items-center gap-1 text-xs text-slate-600 bg-slate-100 px-2 py-0.5 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                ۵ کتاب
                            </span>
                            <span class="inline-flex items-center bg-rose-50 text-rose-600 text-xs px-2 py-0.5 rounded-full font-medium">۱۵٪ تخفیف</span>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800 text-sm">۴۲۵,۰۰۰ تومان</span>
                                <span class="text-xs text-slate-400 line-through">۵۰۰,۰۰۰ تومان</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <button class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <p class="text-xs text-slate-400 mt-2">۱۴۰۴/۰۱/۱۵</p>
                    </div>
                </div>
            </div>

            <!-- کارت ۲ -->
            <div class="p-4">
                <div class="flex items-start gap-3">
                    <input type="checkbox" class="pack-checkbox w-4 h-4 mt-1 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer flex-shrink-0">
                    <div class="w-14 h-14 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                        <img src="https://picsum.photos/60/60?random=11" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start gap-2">
                            <h3 class="font-bold text-slate-800 text-sm">پک کتاب‌های کلاسیک جهان</h3>
                            <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 text-xs px-2 py-0.5 rounded-full font-medium flex-shrink-0">
                                در انتظار
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-1">شاهکارهای ادبیات کلاسیک در یک پک</p>

                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="inline-flex items-center gap-1 text-xs text-slate-600 bg-slate-100 px-2 py-0.5 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                ۳ کتاب
                            </span>
                            <span class="inline-flex items-center bg-rose-50 text-rose-600 text-xs px-2 py-0.5 rounded-full font-medium">۲۰٪ تخفیف</span>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800 text-sm">۳۲۰,۰۰۰ تومان</span>
                                <span class="text-xs text-slate-400 line-through">۴۰۰,۰۰۰ تومان</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <button class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <p class="text-xs text-slate-400 mt-2">۱۴۰۴/۰۱/۱۲</p>
                    </div>
                </div>
            </div>

            <!-- کارت ۳ -->
            <div class="p-4">
                <div class="flex items-start gap-3">
                    <input type="checkbox" class="pack-checkbox w-4 h-4 mt-1 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer flex-shrink-0">
                    <div class="w-14 h-14 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                        <img src="https://picsum.photos/60/60?random=12" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start gap-2">
                            <h3 class="font-bold text-slate-800 text-sm">پک کتاب‌های کودک و نوجوان</h3>
                            <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 text-xs px-2 py-0.5 rounded-full font-medium flex-shrink-0">
                                فعال
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-1">مجموعه‌ای جذاب برای کودکان</p>

                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="inline-flex items-center gap-1 text-xs text-slate-600 bg-slate-100 px-2 py-0.5 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                ۷ کتاب
                            </span>
                            <span class="inline-flex items-center bg-rose-50 text-rose-600 text-xs px-2 py-0.5 rounded-full font-medium">۲۰٪ تخفیف</span>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800 text-sm">۲۸۰,۰۰۰ تومان</span>
                                <span class="text-xs text-slate-400 line-through">۳۵۰,۰۰۰ تومان</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <button class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <p class="text-xs text-slate-400 mt-2">۱۴۰۴/۰۱/۱۰</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- نوار عملیات گروهی -->
        <div id="bulkActionsBar" class="hidden bg-indigo-50 border-t border-indigo-100 px-4 py-3 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2 text-sm text-indigo-800">
                <span class="font-bold" id="selectedCount">۰</span>
                <span>پک انتخاب شده</span>
            </div>
            <div class="flex items-center gap-2">
                <button class="px-4 py-2 rounded-lg bg-white border border-indigo-200 text-indigo-700 text-xs font-medium hover:bg-indigo-100 transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    فعال‌سازی
                </button>
                <button class="px-4 py-2 rounded-lg bg-white border border-indigo-200 text-indigo-700 text-xs font-medium hover:bg-indigo-100 transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                    غیرفعال‌سازی
                </button>
                <button class="px-4 py-2 rounded-lg bg-rose-500 text-white text-xs font-medium hover:bg-rose-600 transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    حذف انتخاب شده‌ها
                </button>
            </div>
        </div>

        <!-- صفحه‌بندی -->
        <div class="border-t border-slate-200 px-4 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-slate-500">
                نمایش <span class="font-medium text-slate-700">۱</span> تا <span class="font-medium text-slate-700">۴</span> از <span class="font-medium text-slate-700">۱۲۸</span> پک
            </div>
            <div class="flex items-center gap-1">
                <button class="p-2 rounded-lg text-slate-400 hover:bg-slate-100 transition-colors disabled:opacity-50" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <button class="w-9 h-9 rounded-lg bg-indigo-600 text-white text-sm font-medium">۱</button>
                <button class="w-9 h-9 rounded-lg text-slate-600 hover:bg-slate-100 text-sm font-medium transition-colors">۲</button>
                <button class="w-9 h-9 rounded-lg text-slate-600 hover:bg-slate-100 text-sm font-medium transition-colors">۳</button>
                <span class="px-1 text-slate-400">...</span>
                <button class="w-9 h-9 rounded-lg text-slate-600 hover:bg-slate-100 text-sm font-medium transition-colors">۳۲</button>
                <button class="p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ==================== اسکریپت‌ها ==================== -->
<script>
    // ========== انتخاب همه ==========
    const selectAllCheckbox = document.getElementById('selectAllPacks');
    const packCheckboxes = document.querySelectorAll('.pack-checkbox');
    const bulkActionsBar = document.getElementById('bulkActionsBar');
    const selectedCountSpan = document.getElementById('selectedCount');

    function updateBulkBar() {
        const checked = document.querySelectorAll('.pack-checkbox:checked');
        const count = checked.length;
        if (selectedCountSpan) selectedCountSpan.textContent = count.toLocaleString('fa-IR');
        if (bulkActionsBar) {
            if (count > 0) bulkActionsBar.classList.remove('hidden');
            else bulkActionsBar.classList.add('hidden');
        }
    }

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function () {
            packCheckboxes.forEach(cb => cb.checked = this.checked);
            updateBulkBar();
        });
    }

    packCheckboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            const allChecked = Array.from(packCheckboxes).every(c => c.checked);
            const anyChecked = Array.from(packCheckboxes).some(c => c.checked);
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = anyChecked && !allChecked;
            }
            updateBulkBar();
        });
    });

    // ========== فیلترها ==========
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const sortFilter = document.getElementById('sortFilter');
    const clearFilters = document.getElementById('clearFilters');

    const filterSearchTag = document.getElementById('filterSearchTag');
    const filterSearchValue = document.getElementById('filterSearchValue');
    const filterStatusTag = document.getElementById('filterStatusTag');
    const filterStatusValue = document.getElementById('filterStatusValue');
    const filterSortTag = document.getElementById('filterSortTag');
    const filterSortValue = document.getElementById('filterSortValue');

    function updateFilterTags() {
        // جستجو
        if (searchInput.value.trim()) {
            filterSearchTag.classList.remove('hidden');
            filterSearchValue.textContent = searchInput.value.trim();
        } else {
            filterSearchTag.classList.add('hidden');
        }

        // وضعیت
        if (statusFilter.value) {
            filterStatusTag.classList.remove('hidden');
            filterStatusValue.textContent = statusFilter.options[statusFilter.selectedIndex].text;
        } else {
            filterStatusTag.classList.add('hidden');
        }

        // مرتب‌سازی
        if (sortFilter.value && sortFilter.value !== 'newest') {
            filterSortTag.classList.remove('hidden');
            filterSortValue.textContent = sortFilter.options[sortFilter.selectedIndex].text;
        } else {
            filterSortTag.classList.add('hidden');
        }
    }

    if (searchInput) searchInput.addEventListener('input', updateFilterTags);
    if (statusFilter) statusFilter.addEventListener('change', updateFilterTags);
    if (sortFilter) sortFilter.addEventListener('change', updateFilterTags);

    if (clearFilters) {
        clearFilters.addEventListener('click', function () {
            searchInput.value = '';
            statusFilter.value = '';
            sortFilter.value = 'newest';
            updateFilterTags();
        });
    }

    // ========== حذف با تأیید ==========
    document.querySelectorAll('.tooltip-wrapper').forEach(btn => {
        if (btn.querySelector('.tooltip')?.textContent === 'حذف') {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                if (confirm('آیا از حذف این پک اطمینان دارید؟ این عمل قابل بازگشت نیست.')) {
                    const row = this.closest('tr') || this.closest('.p-4');
                    if (row) {
                        row.style.transition = 'opacity .3s, transform .3s';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(-20px)';
                        setTimeout(() => row.remove(), 300);
                    }
                }
            });
        }
    });
</script>


@endsection