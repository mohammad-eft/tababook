@extends('app.document')
@section('title', 'دسته بندی ها')
@section('content')
        <!-- Header -->
        <header class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="#" class="text-lg font-bold text-gray-800">📚 کتاب‌فروشی</a>
                <a href="#" class="text-sm text-gray-500 hover:text-gray-800 transition">ادامه خرید</a>
            </div>
        </header>

        <!-- Main -->
        <main class="max-w-5xl mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">سبد خرید</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-3">

                    <!-- Item 1 -->
                    <div class="bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100">
                        <div
                            class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center text-2xl shrink-0">
                            📖
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">ملت عشق</h3>
                            <p class="text-xs text-gray-500 mt-0.5">الیف شافاک</p>
                            <div class="flex items-center gap-2 mt-3">
                                <button
                                    class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 flex items-center justify-center transition">−</button>
                                <span class="text-sm font-medium w-6 text-center">۱</span>
                                <button
                                    class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 flex items-center justify-center transition">+</button>
                                <button class="mr-auto text-xs text-red-500 hover:text-red-700 transition">حذف</button>
                            </div>
                        </div>
                        <div class="text-left shrink-0">
                            <p class="font-bold text-gray-800 text-sm sm:text-base">۱۸۵,۰۰۰</p>
                            <p class="text-xs text-gray-400">تومان</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100">
                        <div
                            class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-rose-100 to-rose-200 rounded-xl flex items-center justify-center text-2xl shrink-0">
                            📕
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">صد سال تنهایی</h3>
                            <p class="text-xs text-gray-500 mt-0.5">گابریل گارسیا مارکز</p>
                            <div class="flex items-center gap-2 mt-3">
                                <button
                                    class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 flex items-center justify-center transition">−</button>
                                <span class="text-sm font-medium w-6 text-center">۲</span>
                                <button
                                    class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 flex items-center justify-center transition">+</button>
                                <button class="mr-auto text-xs text-red-500 hover:text-red-700 transition">حذف</button>
                            </div>
                        </div>
                        <div class="text-left shrink-0">
                            <p class="font-bold text-gray-800 text-sm sm:text-base">۳۲۰,۰۰۰</p>
                            <p class="text-xs text-gray-400">تومان</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100">
                        <div
                            class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center text-2xl shrink-0">
                            📗
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">کیمیاگر</h3>
                            <p class="text-xs text-gray-500 mt-0.5">پائولو کوئیلو</p>
                            <div class="flex items-center gap-2 mt-3">
                                <button
                                    class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 flex items-center justify-center transition">−</button>
                                <span class="text-sm font-medium w-6 text-center">۱</span>
                                <button
                                    class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 flex items-center justify-center transition">+</button>
                                <button class="mr-auto text-xs text-red-500 hover:text-red-700 transition">حذف</button>
                            </div>
                        </div>
                        <div class="text-left shrink-0">
                            <p class="font-bold text-gray-800 text-sm sm:text-base">۹۵,۰۰۰</p>
                            <p class="text-xs text-gray-400">تومان</p>
                        </div>
                    </div>

                </div>

                <!-- Summary -->
                <aside class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 lg:sticky lg:top-6">
                        <h2 class="font-bold text-gray-800 mb-4">خلاصه سفارش</h2>

                        <div class="space-y-2.5 text-sm">
                            <div class="flex justify-between text-gray-600">
                                <span>جمع کالاها</span>
                                <span>۶۰۰,۰۰۰ تومان</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>هزینه ارسال</span>
                                <span>۳۵,۰۰۰ تومان</span>
                            </div>
                            <div class="flex justify-between text-emerald-600">
                                <span>تخفیف</span>
                                <span>− ۵۰,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <div class="border-t border-dashed border-gray-200 my-4"></div>

                        <div class="flex justify-between items-center mb-5">
                            <span class="font-semibold text-gray-700">مبلغ قابل پرداخت</span>
                            <div class="text-left">
                                <p class="font-bold text-lg text-gray-900">۵۸۵,۰۰۰</p>
                                <p class="text-xs text-gray-400">تومان</p>
                            </div>
                        </div>

                        <button
                            class="w-full bg-gray-900 hover:bg-gray-800 text-white font-medium py-3 rounded-xl transition">
                            تکمیل خرید
                        </button>

                        <p class="text-xs text-gray-400 text-center mt-3">
                            ارسال رایگان برای خرید بالای ۵۰۰ هزار تومان
                        </p>
                    </div>
                </aside>

            </div>
        </main>

    
@endsection
