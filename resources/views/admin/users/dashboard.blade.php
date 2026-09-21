@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد محصول')
@section('content')
<div class="w-full max-w-4xl mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="pb-6 w-full">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 text-center md:text-right">
            داشبورد من
        </h1>
        <div class="flex flex-row justify-center md:justify-start items-center gap-2 text-gray-500 text-sm mt-2">
            <a href="#" class="text-purple-600 hover:text-purple-700 transition">
                داشبورد
            </a>
            <span class="text-gray-400">/</span>
            <a href="#" class="hover:text-purple-600 transition">خانه</a>
        </div>
    </div>

    <!-- Stats Cards - 3 Column -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <!-- دوره های ثبت نام شده -->
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition group">
            <div class="flex items-center justify-between">
                <div>
                    @if($user->role[0]->title == "admin")
                    <p class="text-gray-500 text-sm">دوره‌های ثبت شده</p>
                    @else
                    <p class="text-gray-500 text-sm">دوره‌های ثبت‌نام شده</p>
                    @endif
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{count($user->courses)}}</p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
            <!-- <a href="#" class="text-xs text-purple-600 mt-2 inline-block hover:text-purple-700">مشاهده دوره‌ها →</a> -->
        </div>

        <!-- تعداد لغات -->
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">تعداد لغات لایتنرمن</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{count($user->leitnaries)}}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <!-- <a href="#" class="text-xs text-blue-600 mt-2 inline-block hover:text-blue-700">مشاهده لغات →</a> -->
        </div>

        <!-- تعداد هم بحثی ها -->
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">هم‌بحثی‌های من</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{$partnerCount}}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
            </div>
            <!-- <a href="#" class="text-xs text-green-600 mt-2 inline-block hover:text-green-700">مشاهده هم‌بحثی‌ها →</a> -->
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6 md:p-8">
            <!-- Avatar -->
            <!-- <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center shadow-lg">
                        <span class="text-white text-2xl md:text-3xl font-bold">ع</span>
                    </div>
                </div> -->

            <!-- Name -->
            <div class="text-center mb-6">
                @if($user->name && $user->family)
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">{{$user->name}}{{$user->family}}</h2>
                @else
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">کاربرعادی</h2>
                <!-- <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm inline-block">کاربر حرفه‌ای</span> -->
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-2xl mx-auto">
                <!-- نام کامل -->
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        نام کامل
                    </div>
                    @if($user->name && $user->family)
                    <p class="text-gray-800 font-medium">{{$user->name}}{{$user->family}}</p>
                    @else
                    <p class="text-gray-800 font-medium">کاربرعادی</p>
                    @endif
                </div>

                <!-- شماره تلفن -->
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        شماره تلفن
                    </div>
                    <p class="text-gray-800 font-medium">{{$user->phoneNumber}}</p>
                </div>

                <!-- ایمیل -->
                <div class="bg-gray-100 rounded-lg p-4">
                    <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        ایمیل
                    </div>
                    @if($user->email)
                    <p class="text-gray-800 font-medium">{{$user->email}}</p>
                    @else
                    <p class="text-gray-800 font-medium">ایمیلی وارد نشده است</p>
                    @endif
                </div>

                <!-- تاریخ عضویت
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            تاریخ عضویت
                        </div>
                        <p class="text-gray-800 font-medium">۱۵ فروردین ۱۴۰۳</p>
                    </div> -->
            </div>

            <!-- دکمه ویرایش -->
            <!-- <div class="flex justify-center mt-6">
                    <a href="#" class="inline-flex items-center gap-2 px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        ویرایش پروفایل
                    </a>
                </div> -->
        </div>
    </div>
</div>
@endsection