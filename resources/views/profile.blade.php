@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد محصول')
@section('content')
    <div class="w-full max-w-4xl mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="pb-6 w-full">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 text-center md:text-right">
                اکانت من
            </h1>
            <div class="flex flex-row justify-center md:justify-start items-center gap-2 text-gray-500 text-sm mt-2">
                <a href="{{ route('user.profile', [$user]) }}" class="text-purple-600 hover:text-purple-700 transition">
                    اکانت من
                </a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('home') }}" class="hover:text-purple-600 transition">خانه</a>
            </div>
        </div>

        <!-- Profile Card - Single Section -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="p-6 md:p-8">
                <!-- Avatar & User Info -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 pb-6 border-b border-gray-100">
                    <!-- Avatar with Purple Gradient -->
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 md:w-28 md:h-28 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center shadow-lg">
                            <span class="text-white text-2xl md:text-3xl font-bold">
                                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}{{ strtoupper(substr($user->family ?? '', 0, 1)) }}
                            </span>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="flex-1 text-center md:text-right">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">
                            @if($user->name || $user->family)
                                {{ trim(($user->name ?? '') . ' ' . ($user->family ?? '')) }}
                            @else
                                کاربر عادی
                            @endif
                        </h2>
                        <div class="flex flex-wrap justify-center md:justify-start gap-2">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                {{ $user->role[0]->title ?? 'کاربر عادی' }}
                            </span>
                            @if($user->phoneNumber)
                                <span class="px-3 py-1 bg-purple-50 text-purple-700 rounded-full text-sm flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    {{ $user->phoneNumber }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Edit Button with Purple Theme -->
                    <div class="flex-shrink-0">
                        <a href="{{route('user.compelete_form')}}" class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            ویرایش
                        </a>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="pt-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        اطلاعات کاربری
                    </h3>

                    <div class="space-y-3">
                        <!-- Name -->
                        <div class="flex flex-wrap justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-500 text-sm">نام کامل</span>
                            <span class="text-gray-800 font-medium">
                                @if($user->name || $user->family)
                                    {{ trim(($user->name ?? '') . ' ' . ($user->family ?? '')) }}
                                @else
                                    <span class="text-gray-400">ثبت نشده</span>
                                @endif
                            </span>
                        </div>

                        <!-- Phone Number -->
                        <div class="flex flex-wrap justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-500 text-sm">شماره تلفن</span>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-800 font-medium">{{ $user->phoneNumber ?? 'ثبت نشده' }}</span>
                                @if($user->phoneNumber)
                                    <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">تایید شده</span>
                                @endif
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex flex-wrap justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-500 text-sm">ایمیل</span>
                            <span class="text-gray-800 font-medium">{{ $user->email ?? 'ثبت نشده' }}</span>
                        </div>

                        <!-- Role -->
                        <!-- <div class="flex flex-wrap justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-500 text-sm">نقش کاربری</span>
                            <span class="text-gray-800 font-medium">{{ $user->role[0]->title ?? 'کاربر عادی' }}</span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection