<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}" type="text/css">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/IMG_20251225_131334_688.png') }}">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body>
    <div class="2xl:container mx-auto flex flex-row">
        <div class="lg:hidden bg-white size-10 border rounded-md flex justify-center items-center cursor-pointer fixed top-2 right-2"
            onclick="responsive_menu('open')">
            <div class="w-7 h-6 flex flex-col justify-between items-center">
                <span class="inline-block w-full h-1/5 bg-black rounded-md"></span>
                <span class="inline-block w-full h-1/5 bg-black rounded-md"></span>
                <span class="inline-block w-full h-1/5 bg-black rounded-md"></span>
            </div>
        </div>
        <div class="hidden lg:block lg:w-3/12 bg-[#0D0E12] fixed right-0 top-0 h-dvh px-5">
            <div class="flex justify-center pt-5">
                <a href="{{ route('home') }}" class="right-0 mr-[15px]">
                    <img src="{{ asset('storage/' . $setting['logo']) }}" alt="" class="w-full">
                </a>
            </div>
            <hr class="text-[darkslategray] mt-2.5">
            <div class="py-3 h-[80%] overflow-y-auto flex flex-col gap-3" style="scrollbar-width: none;">
                @can('access', ['admin'])
                 
                    <div class="border-b border-gray-500 pb-3">
                        <div
                            class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('category.*')) bg-[#383c4d] @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('category.*')) rotate-180 @endif">
                                <path fill-rule="evenodd"
                                    d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="flex flex-row-reverse items-center gap-2 text-white">
                                <span class="flex justify-end">تنظیمات</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 fill-white">
                                    <path
                                        d="M64 80c0-26.5 21.5-48 48-48h80c17.7 0 33.6 7.1 45.3 19.7L248.3 64H400c26.5 0 48 21.5 48 48v32H64V80z" />
                                    <path
                                        d="M64 160v272c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V160H64zm48 64h288v208H112V224zm40 40c-13.3 0-24 10.7-24 24s10.7 24 24 24h208c13.3 0 24-10.7 24-24s-10.7-24-24-24H152z" />
                                </svg>
                            </div>
                        </div>
                        <div class="overflow-y-auto transition-all duration-300 @if (Route::is('setting.*')) max-h-100 @else max-h-0 @endif"
                            style="scrollbar-width: none;">
                            <ul class="gap-2.5 pr-3">
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('setting.headerSettings') }}"
                                        class="py-1 @if (Route::is('setting.headerSettings')) text-[#FF0000] @endif">تنظیمات هدر و هیرو</a>
                                </li>
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('setting.bannerSettings') }}"
                                        class="py-1 @if (Route::is('setting.bannerSettings')) text-[#FF0000] @endif">تنظیمات بنر ها</a>
                                </li>
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('setting.cardSettings') }}"
                                        class="py-1 @if (Route::is('setting.cardSettings')) text-[#FF0000] @endif">تنظیمات کارت ها</a>
                                </li>
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('setting.serviceSettings') }}"
                                        class="py-1 @if (Route::is('setting.serviceSettings')) text-[#FF0000] @endif">تنظیمات خدمات</a>
                                </li>
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('setting.footerSettings') }}"
                                        class="py-1 @if (Route::is('setting.footerSettings')) text-[#FF0000] @endif">فوتر</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-b border-gray-500 pb-3">
                        <div
                            class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('category.*')) bg-[#383c4d] @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('category.*')) rotate-180 @endif">
                                <path fill-rule="evenodd"
                                    d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="flex flex-row-reverse items-center gap-2 text-white">
                                <span class="flex justify-end">دسته بندی ها</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 fill-white">
                                    <path
                                        d="M64 80c0-26.5 21.5-48 48-48h80c17.7 0 33.6 7.1 45.3 19.7L248.3 64H400c26.5 0 48 21.5 48 48v32H64V80z" />
                                    <path
                                        d="M64 160v272c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V160H64zm48 64h288v208H112V224zm40 40c-13.3 0-24 10.7-24 24s10.7 24 24 24h208c13.3 0 24-10.7 24-24s-10.7-24-24-24H152z" />
                                </svg>
                            </div>
                        </div>
                        <div class="overflow-y-auto transition-all duration-300 @if (Route::is('category.*')) max-h-100 @else max-h-0 @endif"
                            style="scrollbar-width: none;">
                            <ul class="gap-2.5 pr-3">
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('category.create') }}"
                                        class="py-1 @if (Route::is('category.create')) text-[#FF0000] @endif">ایجاد دسته
                                        جدید</a>
                                </li>
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('category.adminIndex') }}"
                                        class="py-1 @if (Route::is('category.adminIndex')) text-[#FF0000] @endif">لیست دسته
                                        بندی ها</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-b border-gray-500 pb-3">
                        <div
                            class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('product.*')) bg-[#383c4d] @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('product.*')) rotate-180 @endif">
                                <path fill-rule="evenodd"
                                    d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="flex flex-row-reverse items-center gap-2 text-white">
                                <span class="flex justify-end">محصولات</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="size-5 fill-white">
                                    <path
                                        d="M0 185.8c0-6.4 1.6-12.7 4.7-18.3L82.4 25C90.8 9.6 106.9 0 124.5 0h391c17.6 0 33.7 9.6 42.1 25l77.7 142.4c3.1 5.6 4.7 11.9 4.7 18.3c0 21.1-17.1 38.2-38.2 38.2H576V488c0 13.3-10.7 24-24 24s-24-10.7-24-24V224H384V472c0 22.1-17.9 40-40 40H104c-22.1 0-40-17.9-40-40V224H38.2C17.1 224 0 206.9 0 185.8zM112 224v96H336V224H112zM515.5 48l-391 0L54.7 176H585.3L515.5 48zM112 464H336V368H112v96z" />
                                </svg>
                            </div>
                        </div>
                        <div class="overflow-y-auto transition-all duration-300 @if (Route::is('product.*')) max-h-100 @else max-h-0 @endif"
                            style="scrollbar-width: none;">
                            <ul class="gap-2.5 pr-3">
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('product.create') }}"
                                        class="py-1 @if (Route::is('product.create')) text-[#FF0000] @endif">ایجاد محصول
                                        جدید</a>
                                </li>
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('product.adminIndex') }}"
                                        class="py-1 @if (Route::is('product.adminIndex')) text-[#FF0000] @endif">لیست
                                        محصولات</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                @endcan
                <div class="border-b border-gray-500 pb-3">
                    <div
                        class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('user.*')) bg-[#383c4d] @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('user.*')) rotate-180 @endif">
                            <path fill-rule="evenodd"
                                d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="flex flex-row-reverse items-center gap-2 text-white">
                            <span class="flex justify-end">کاربران</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="size-5 fill-white">
                                <path
                                    d="M224 48a80 80 0 1 1 0 160 80 80 0 1 1 0-160zm0 208A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 96h91.4c65.7 0 120.1 48.7 129 112H49.3c8.9-63.3 63.3-112 129-112zm0-48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3zm431 208c17 0 30.7-13.8 30.7-30.7C640 392.2 567.8 320 478.7 320H417.3c-4.4 0-8.8 .2-13.2 .5c46.4 38.6 75.9 96.7 75.9 161.8c0 10.8-2.8 20.9-7.6 29.7H609.3zM432 256c61.9 0 112-50.1 112-112s-50.1-112-112-112c-24.8 0-47.7 8.1-66.3 21.7C377.4 75.9 384 101.2 384 128c0 35.6-11.6 68.5-31.3 95.1C373 243.4 401 256 432 256z" />
                            </svg>
                        </div>
                    </div>
                    <div class="overflow-y-auto transition-all duration-300 @if (Route::is('user.*')) max-h-100 @else max-h-0 @endif"
                        style="scrollbar-width: none;">
                        <ul class="gap-2.5 pr-3">
                            @can('access', ['admin'])
                                {{-- <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('user.admin_create_user') }}"
                                        class="py-1 @if (Route::is('user.admin_create_user')) text-[#FF0000] @endif">ایجاد کاربر
                                        جدید</a>
                                </li> --}}
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('user.list') }}"
                                        class="py-1 @if (Route::is('user.list')) text-[#FF0000] @endif">لیست
                                        کاربران</a>
                                </li>
                            @endcan
                            <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                <span class="size-1 bg-white rounded-sm"></span>
                                <a href="{{ route('user.profile') }}"
                                    class="py-1 @if (Route::is('user.profile')) text-[#FF0000] @endif">حساب
                                    کاربری</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- responsive menu -->
        <div class="lg:hidden flex fixed z-1000 -right-full w-full h-dvh transition-all duration-500" id="menu">
            <div class="responsive-menu-shadow w-2/3 md:w-5/12 px-5 pt-10 bg-[#0D0E12]">
                <div class="relative" onclick="responsive_menu('close')">
                    <button
                        class="absolute -top-7 left-0 w-5 h-5 flex flex-col justify-center items-center cursor-pointer">
                        <span class="w-full h-[1.5px] bg-white rotate-45 translate-y-1/2"></span>
                        <span class="w-full h-[1.5px] bg-white -rotate-45 -translate-y-1/2"></span>
                    </button>
                </div>
                <div class="flex justify-center pt-5">
                    <a href="{{ route('home') }}" class="right-0 mr-[15px]">
                        {{-- @if ($logo)
                            <img src="{{ asset('storage/' . $logo->logo) }}" alt="" class="w-40 h-15">
                        @endif --}}
                    </a>
                </div>
                <hr class="text-[darkslategray] mt-2.5">
                <div class="py-5 h-[80%] overflow-y-auto flex flex-col gap-3" style="scrollbar-width: none;">
                    @can('access', ['admin'])
                        {{-- <div class="border-b border-gray-500 pb-3">
                            <div
                                class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('settings.*')) bg-[#383c4d] @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('settings.*')) rotate-180 @endif">
                                    <path fill-rule="evenodd"
                                        d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex flex-row-reverse items-center gap-2 text-white">
                                    <span class="flex justify-end">تنظیمات خانه</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="size-5 fill-white">
                                        <path
                                            d="M256 0c17 0 33.6 1.7 49.8 4.8c7.9 1.5 21.8 6.1 29.4 20.1c2 3.7 3.6 7.6 4.6 11.8l9.3 38.5C350.5 81 360.3 86.7 366 85l38-11.2c4-1.2 8.1-1.8 12.2-1.9c16.1-.5 27 9.4 32.3 15.4c22.1 25.1 39.1 54.6 49.9 86.3c2.6 7.6 5.6 21.8-2.7 35.4c-2.2 3.6-4.9 7-8 10L459 246.3c-4.2 4-4.2 15.5 0 19.5l28.7 27.3c3.1 3 5.8 6.4 8 10c8.2 13.6 5.2 27.8 2.7 35.4c-10.8 31.7-27.8 61.1-49.9 86.3c-5.3 6-16.3 15.9-32.3 15.4c-4.1-.1-8.2-.8-12.2-1.9L366 427c-5.7-1.7-15.5 4-16.9 9.8l-9.3 38.5c-1 4.2-2.6 8.2-4.6 11.8c-7.7 14-21.6 18.5-29.4 20.1C289.6 510.3 273 512 256 512s-33.6-1.7-49.8-4.8c-7.9-1.5-21.8-6.1-29.4-20.1c-2-3.7-3.6-7.6-4.6-11.8l-9.3-38.5c-1.4-5.8-11.2-11.5-16.9-9.8l-38 11.2c-4 1.2-8.1 1.8-12.2 1.9c-16.1 .5-27-9.4-32.3-15.4c-22-25.1-39.1-54.6-49.9-86.3c-2.6-7.6-5.6-21.8 2.7-35.4c2.2-3.6 4.9-7 8-10L53 265.7c4.2-4 4.2-15.5 0-19.5L24.2 218.9c-3.1-3-5.8-6.4-8-10C8 195.3 11 181.1 13.6 173.6c10.8-31.7 27.8-61.1 49.9-86.3c5.3-6 16.3-15.9 32.3-15.4c4.1 .1 8.2 .8 12.2 1.9L146 85c5.7 1.7 15.5-4 16.9-9.8l9.3-38.5c1-4.2 2.6-8.2 4.6-11.8c7.7-14 21.6-18.5 29.4-20.1C222.4 1.7 239 0 256 0zM218.1 51.4l-8.5 35.1c-7.8 32.3-45.3 53.9-77.2 44.6L97.9 120.9c-16.5 19.3-29.5 41.7-38 65.7l26.2 24.9c24 22.8 24 66.2 0 89L59.9 325.4c8.5 24 21.5 46.4 38 65.7l34.6-10.2c31.8-9.4 69.4 12.3 77.2 44.6l8.5 35.1c24.6 4.5 51.3 4.5 75.9 0l8.5-35.1c7.8-32.3 45.3-53.9 77.2-44.6l34.6 10.2c16.5-19.3 29.5-41.7 38-65.7l-26.2-24.9c-24-22.8-24-66.2 0-89l26.2-24.9c-8.5-24-21.5-46.4-38-65.7l-34.6 10.2c-31.8 9.4-69.4-12.3-77.2-44.6l-8.5-35.1c-24.6-4.5-51.3-4.5-75.9 0zM208 256a48 48 0 1 0 96 0 48 48 0 1 0 -96 0zm48 96a96 96 0 1 1 0-192 96 96 0 1 1 0 192z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="overflow-y-auto transition-all duration-300 @if (Route::is('settings.*')) max-h-100 @else max-h-0 @endif"
                                style="scrollbar-width: none;">
                                <ul class="gap-2.5 pr-3">
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('settings.header.create') }}"
                                            class="py-1 @if (Route::is('settings.header.create')) text-[#FF0000] @endif">
                                            هدر</a>
                                    </li>
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('settings.logo.create') }}"
                                            class="py-1 @if (Route::is('settings.logo.create')) text-[#FF0000] @endif">
                                            لوگو</a>
                                    </li>
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('settings.service.create') }}"
                                            class="py-1 @if (Route::is('settings.service.create')) text-[#FF0000] @endif">خدمات
                                            ما</a>
                                    </li>
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('settings.introduction.create') }}"
                                            class="py-1 @if (Route::is('settings.introduction.create')) text-[#FF0000] @endif">معرفی
                                            ما</a>
                                    </li>
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('settings.defaultComment.create') }}"
                                            class="py-1 @if (Route::is('settings.defaultComment.create')) text-[#FF0000] @endif">نظرات
                                            پیش فرض</a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                        <div class="border-b border-gray-500 pb-3">
                            <div
                                class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('category.*')) bg-[#383c4d] @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('category.*')) rotate-180 @endif">
                                    <path fill-rule="evenodd"
                                        d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex flex-row-reverse items-center gap-2 text-white">
                                    <span class="flex justify-end">دسته بندی ها</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="size-5 fill-white">
                                        <path
                                            d="M256 0c17 0 33.6 1.7 49.8 4.8c7.9 1.5 21.8 6.1 29.4 20.1c2 3.7 3.6 7.6 4.6 11.8l9.3 38.5C350.5 81 360.3 86.7 366 85l38-11.2c4-1.2 8.1-1.8 12.2-1.9c16.1-.5 27 9.4 32.3 15.4c22.1 25.1 39.1 54.6 49.9 86.3c2.6 7.6 5.6 21.8-2.7 35.4c-2.2 3.6-4.9 7-8 10L459 246.3c-4.2 4-4.2 15.5 0 19.5l28.7 27.3c3.1 3 5.8 6.4 8 10c8.2 13.6 5.2 27.8 2.7 35.4c-10.8 31.7-27.8 61.1-49.9 86.3c-5.3 6-16.3 15.9-32.3 15.4c-4.1-.1-8.2-.8-12.2-1.9L366 427c-5.7-1.7-15.5 4-16.9 9.8l-9.3 38.5c-1 4.2-2.6 8.2-4.6 11.8c-7.7 14-21.6 18.5-29.4 20.1C289.6 510.3 273 512 256 512s-33.6-1.7-49.8-4.8c-7.9-1.5-21.8-6.1-29.4-20.1c-2-3.7-3.6-7.6-4.6-11.8l-9.3-38.5c-1.4-5.8-11.2-11.5-16.9-9.8l-38 11.2c-4 1.2-8.1 1.8-12.2 1.9c-16.1 .5-27-9.4-32.3-15.4c-22-25.1-39.1-54.6-49.9-86.3c-2.6-7.6-5.6-21.8 2.7-35.4c2.2-3.6 4.9-7 8-10L53 265.7c4.2-4 4.2-15.5 0-19.5L24.2 218.9c-3.1-3-5.8-6.4-8-10C8 195.3 11 181.1 13.6 173.6c10.8-31.7 27.8-61.1 49.9-86.3c5.3-6 16.3-15.9 32.3-15.4c4.1 .1 8.2 .8 12.2 1.9L146 85c5.7 1.7 15.5-4 16.9-9.8l9.3-38.5c1-4.2 2.6-8.2 4.6-11.8c7.7-14 21.6-18.5 29.4-20.1C222.4 1.7 239 0 256 0zM218.1 51.4l-8.5 35.1c-7.8 32.3-45.3 53.9-77.2 44.6L97.9 120.9c-16.5 19.3-29.5 41.7-38 65.7l26.2 24.9c24 22.8 24 66.2 0 89L59.9 325.4c8.5 24 21.5 46.4 38 65.7l34.6-10.2c31.8-9.4 69.4 12.3 77.2 44.6l8.5 35.1c24.6 4.5 51.3 4.5 75.9 0l8.5-35.1c7.8-32.3 45.3-53.9 77.2-44.6l34.6 10.2c16.5-19.3 29.5-41.7 38-65.7l-26.2-24.9c-24-22.8-24-66.2 0-89l26.2-24.9c-8.5-24-21.5-46.4-38-65.7l-34.6 10.2c-31.8 9.4-69.4-12.3-77.2-44.6l-8.5-35.1c-24.6-4.5-51.3-4.5-75.9 0zM208 256a48 48 0 1 0 96 0 48 48 0 1 0 -96 0zm48 96a96 96 0 1 1 0-192 96 96 0 1 1 0 192z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="overflow-y-auto transition-all duration-300 @if (Route::is('category.*')) max-h-100 @else max-h-0 @endif"
                                style="scrollbar-width: none;">
                                <ul class="gap-2.5 pr-3">
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('category.create') }}"
                                            class="py-1 @if (Route::is('category.create')) text-[#FF0000] @endif">ایجاد
                                            دسته جدید</a>
                                    </li>
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('category.adminIndex') }}"
                                            class="py-1 @if (Route::is('category.adminIndex')) text-[#FF0000] @endif">لیست
                                            دسته بندی ها</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="border-b border-gray-500 pb-3">
                            <div
                                class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('product.*')) bg-[#383c4d] @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('product.*')) rotate-180 @endif">
                                    <path fill-rule="evenodd"
                                        d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex flex-row-reverse items-center gap-2 text-white">
                                    <span class="flex justify-end">محصولات</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                        class="size-5 fill-white">
                                        <path
                                            d="M0 185.8c0-6.4 1.6-12.7 4.7-18.3L82.4 25C90.8 9.6 106.9 0 124.5 0h391c17.6 0 33.7 9.6 42.1 25l77.7 142.4c3.1 5.6 4.7 11.9 4.7 18.3c0 21.1-17.1 38.2-38.2 38.2H576V488c0 13.3-10.7 24-24 24s-24-10.7-24-24V224H384V472c0 22.1-17.9 40-40 40H104c-22.1 0-40-17.9-40-40V224H38.2C17.1 224 0 206.9 0 185.8zM112 224v96H336V224H112zM515.5 48l-391 0L54.7 176H585.3L515.5 48zM112 464H336V368H112v96z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="overflow-y-auto transition-all duration-300 @if (Route::is('product.*')) max-h-100 @else max-h-0 @endif"
                                style="scrollbar-width: none;">
                                <ul class="gap-2.5 pr-3">
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('product.create') }}"
                                            class="py-1 @if (Route::is('product.create')) text-[#FF0000] @endif">ایجاد
                                            محصول جدید</a>
                                    </li>
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('product.adminIndex') }}"
                                            class="py-1 @if (Route::is('product.adminIndex')) text-[#FF0000] @endif">لیست
                                            محصولات</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="border-b border-gray-500 pb-3">
                            <div
                                class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('consultRequest.*')) bg-[#383c4d] @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('consultRequest.*')) rotate-180 @endif">
                                    <path fill-rule="evenodd"
                                        d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex flex-row-reverse items-center gap-2 text-white">
                                    <span class="flex justify-end">درخواست های مشاوره</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                        class="size-5 fill-white">
                                        <path
                                            d="M192 48a80 80 0 1 1 0 160 80 80 0 1 1 0-160zm0 208A128 128 0 1 0 192 0a128 128 0 1 0 0 256zm-45.7 96h91.4c65.7 0 120.1 48.7 129 112H17.3c8.9-63.3 63.3-112 129-112zm0-48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H386.3c16.4 0 29.7-13.3 29.7-29.7C416 383.8 336.2 304 237.7 304H146.3z" />
                                        <path
                                            d="M440 120c0-48.6-39.4-88-88-88s-88 39.4-88 88c0 32.5 17.6 61 44.2 76.5c-6.4 14.6-15.4 29.2-28.1 41.9c-5.3 5.3-11.2 9.8-17.8 13.7c2 4.7 4.7 9.1 8.1 12.9c7.6 8.4 18.5 13.4 30.5 13.4c9.4 0 17.9-3.4 24.4-8.9c1.2-1 2.4-2.1 3.6-3.3c4.3-4.4 8-10.1 10.9-16.7c8.7-3.3 16.8-8.3 23.5-15c8.7-8.7 14.3-20.1 15.9-32.7c13.1-1.2 24.7-7.2 33.1-16.4C436.9 157.2 440 138.9 440 120zM352 232c-20.7 0-40-10.3-40-24c0-13.7 17.9-24 40-24s40 10.3 40 24-17.9 24-40 24z" />
                                        <path
                                            d="M488 112a56 56 0 1 1 0 112 56 56 0 1 1 0-112zm0 144A88 88 0 1 0 488 80a88 88 0 1 0 0 176zm-32 64h64c45.3 0 83.1 33.6 89 77.3c-5.2-.8-10.6-1.1-16.1-1.1H423.1c5.9-43.7 43.7-77.3 89-77.3h-56.1zm0-32c-66.2 0-120 53.8-120 120c0 17.7 14.3 32 32 32H584c17.7 0 32-14.3 32-32c0-66.2-53.8-120-120-120H456z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="overflow-y-auto transition-all duration-300 @if (Route::is('consultRequest.*')) max-h-100 @else max-h-0 @endif"
                                style="scrollbar-width: none;">
                                <ul class="gap-2.5 pr-3">
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('consultRequest.index') }}"
                                            class="py-1 @if (Route::is('consultRequest.index')) text-[#FF0000] @endif">لیست
                                            درخواست ها</a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    @endcan
                    <div class="border-b border-gray-500 pb-3">
                        <div
                            class="arrow-down cursor-pointer flex justify-between items-center flex-row-reverse py-1 px-3 rounded-md @if (Route::is('user.*')) bg-[#383c4d] @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6 fill-white w-[15px] transition-all duration-300 @if (Route::is('user.*')) rotate-180 @endif">
                                <path fill-rule="evenodd"
                                    d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="flex flex-row-reverse items-center gap-2 text-white">
                                <span class="flex justify-end">کاربران</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                    class="size-5 fill-white">
                                    <path
                                        d="M224 48a80 80 0 1 1 0 160 80 80 0 1 1 0-160zm0 208A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 96h91.4c65.7 0 120.1 48.7 129 112H49.3c8.9-63.3 63.3-112 129-112zm0-48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3zm431 208c17 0 30.7-13.8 30.7-30.7C640 392.2 567.8 320 478.7 320H417.3c-4.4 0-8.8 .2-13.2 .5c46.4 38.6 75.9 96.7 75.9 161.8c0 10.8-2.8 20.9-7.6 29.7H609.3zM432 256c61.9 0 112-50.1 112-112s-50.1-112-112-112c-24.8 0-47.7 8.1-66.3 21.7C377.4 75.9 384 101.2 384 128c0 35.6-11.6 68.5-31.3 95.1C373 243.4 401 256 432 256z" />
                                </svg>
                            </div>
                        </div>
                        <div class="overflow-y-auto transition-all duration-300 @if (Route::is('user.*')) max-h-100 @else max-h-0 @endif"
                            style="scrollbar-width: none;">
                            <ul class="gap-2.5 pr-3">
                                @can('access', ['admin'])
                                    {{-- <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('user.admin_create_user') }}"
                                            class="py-1 @if (Route::is('user.admin_create_user')) text-[#FF0000] @endif">ایجاد
                                            کاربر جدید</a>
                                    </li> --}}
                                    <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                        <span class="size-1 bg-white rounded-sm"></span>
                                        <a href="{{ route('user.list') }}"
                                            class="py-1 @if (Route::is('user.list')) text-[#FF0000] @endif">لیست
                                            کاربران</a>
                                    </li>
                                @endcan
                                <li class="flex flex-row items-center gap-2.5 mt-2.5 mb-2.5 mr-5 text-white">
                                    <span class="size-1 bg-white rounded-sm"></span>
                                    <a href="{{ route('user.profile') }}"
                                        class="py-1 @if (Route::is('user.profile')) text-[#FF0000] @endif">حساب
                                        کاربری</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/3 md:w-7/12 bg-black/50" onclick="responsive_menu('close')"></div>
        </div>
        <!-- end responsive menu -->
        <div class="w-full">
            <div class="w-full lg:w-9/12 float-end p-5 overflow-y-auto" style="scrollbar-width:none;">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
