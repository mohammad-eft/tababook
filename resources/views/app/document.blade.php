<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}" type="text/css">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/IMG_20251225_131334_688.png') }}">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body
    class="max-w-[1700px] bg-[var(--background)] mx-auto [&::-webkit-scrollbar]:w-1.5  [&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  [&::-webkit-scrollbar-thumb]:rounded-full">
    <!-- menu -->
    <section class="max-w-[1700px] mx-auto w-full flex justify-center items-center sticky top-0 right-0 z-2">
        <div class="w-11/12 py-3 flex justify-between items-center xl:gap-10 bg-[var(--background)] px-3 rounded-2xl">
            <div class="w-1/3 flex justify-start lg:hidden cursor-pointer">
                <!-- hamburger_menu_svg -->
                <div class="flex flex-col gap-1 items-start justify-center " onclick="hamburger_menu('open')">
                    <span class="w-7 h-1 bg-white rounded-full"></span>
                    <span class="w-7 h-1 bg-white rounded-full"></span>
                    <span class="w-7 h-1 bg-white rounded-full"></span>
                </div>
                <!-- hamburger_menu_svg -->
            </div>
            <div class="w-1/3 lg:w-1/5 h-full  cursor-pointer">
                {{-- @if ($logo)
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('storage/' . $logo->logo) }}" alt=""
                            class="object-fit w-3/4 sm:w-2/4 max-lg:mx-auto">
                    </a>
                @endif --}}
            </div>
            <div class="w-1/3 lg:w-4/5 h-8/12 flex gap-4 items-center justify-end lg:justify-between">
                <ul class="h-9/12 h-full flex items-center gap-5 text-xs xl:text-md font-bold max-lg:hidden">
                    <li>
                        <a href="{{ route('home') }}" class="flex justify-center items-center py-3 relative">
                            <sapn class="transition_root text-nowrap font-bold text-[var(--gold)]">صفحه اصلی</sapn>
                            <div
                                class="w-full absolute bottom-0 right-auto left-auto  overflow-hidden flex justify-center items-center transition_root">
                                <div class="w-full h-[2px] bg-[var(--gold)] rounded-full"></div>
                            </div>
                        </a>
                    </li>
                    <li class="relative">
                        <span
                            class="flex gap-1 font-bold justify-center items-center py-3 relative cheng_text_colot_hover text-[var(--text)] cursor-pointer servis_pup_up_hover">
                            <span>خدمات</span>
                            <div class="transition_root">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="size-4 fill-[var(--gold)]">
                                    <path
                                        d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="w-0 absolute bottom-0 right-auto left-auto gradent_text_sub_heder overflow-hidden flex justify-center items-center transition_root">
                                <div class="w-full h-[2px] bg-white rounded-full"></div>
                            </div>
                        </span>
                        <!-- items_serviss -->
                        <div
                            class="w-100 h-dvh absolute top-13 right-0 flex justify-end items-start invisible opacity-0 transition_root servis_pup_up_item">
                            <div class="w-full h-full bg-black/50 fixed top-23 right-0 servis_pup_up_hover_close">
                            </div>
                            <div
                                class="w-full flex flex-col justify-start items-start overflow-y-auto max-h-100 [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:bg-[var(--gold)] [&::-webkit-scrollbar-thumb]:rounded-full">
                                @foreach ($services as $service)
                                    <div
                                        class="w-full bg-[var(--background-2)] relative flex flex-col items-start justify-start p-4">
                                        <div class="group pb-4 pr-4">
                                            <span
                                                class="text-[15px] md:text-md font-bold text-white group-hover:pr-5 group-hover:text-[var(--gold)] transition_root">{{ $service['title'] }}</span>
                                        </div>
                                        <span class="w-full h-[1px] bg-[#292931]"></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- items_serviss -->
                    </li>
                    <li class="relative">
                        <span
                            class="flex gap-1 font-bold justify-center items-center py-3 relative cheng_text_colot_hover text-[var(--text)] cursor-pointer servis_pup_up_hover">
                            <span>دسته بندی ها</span>
                            <div class="transition_root">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="size-4 fill-[var(--gold)]">
                                    <path
                                        d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="w-0 absolute bottom-0 right-auto left-auto gradent_text_sub_heder overflow-hidden flex justify-center items-center transition_root">
                                <div class="w-full h-[2px] bg-white rounded-full"></div>
                            </div>
                        </span>
                        <div
                            class="w-100 h-dvh absolute top-13 right-0 flex justify-end items-start invisible opacity-0 transition_root servis_pup_up_item">
                            <div class="w-full h-full bg-black/50 fixed top-23 right-0 servis_pup_up_hover_close">
                            </div>
                            <div
                                class="w-full flex flex-col justify-start items-start overflow-y-auto max-h-100 [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:bg-[var(--gold)] [&::-webkit-scrollbar-thumb]:rounded-full">
                                @foreach ($categories as $category)
                                    <a href="{{ route('category.relatedProducts', [$category]) }}"
                                        class="w-full bg-[var(--background-2)] relative flex flex-col items-start justify-start p-4">
                                        <div class="group pb-4 pr-4">
                                            <span
                                                class="text-[15px] md:text-md font-bold text-white group-hover:pr-5 group-hover:text-[var(--gold)] transition_root">{{ $category['title'] }}</span>
                                        </div>
                                        <span class="w-full h-[1px] bg-[#292931]"></span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}"
                            class="flex justify-center items-center py-3 relative cheng_text_colot_hover">
                            <sapn class="transition_root text-nowrap font-bold text-[var(--text)]">نمونه کار ها
                            </sapn>
                            <div
                                class="w-0 absolute bottom-0 right-auto left-auto gradent_text_sub_heder overflow-hidden flex justify-center items-center transition_root">
                                <div class="w-full h-[2px] bg-white rounded-full"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <span
                            class="flex justify-center items-center py-3 relative cursor-pointer cheng_text_colot_hover">
                            <sapn class="transition_root text-nowrap font-bold text-[var(--text)]">مقالات</sapn>
                            <div
                                class="w-0 absolute bottom-0 right-auto left-auto gradent_text_sub_heder overflow-hidden flex justify-center items-center transition_root">
                                <div class="w-full h-[2px] bg-white rounded-full"></div>
                            </div>
                        </span>
                    </li>
                    <li>
                        <span
                            class="flex justify-center items-center py-3 relative cursor-pointer cheng_text_colot_hover">
                            <sapn class="transition_root text-nowrap font-bold text-[var(--text)]">درباره ما</sapn>
                            <div
                                class="w-0 absolute bottom-0 right-auto left-auto gradent_text_sub_heder overflow-hidden flex justify-center items-center transition_root">
                                <div class="w-full h-[2px] bg-white rounded-full"></div>
                            </div>
                        </span>
                    </li>
                    <li>
                        <span
                            class="flex justify-center items-center py-3 relative cursor-pointer cheng_text_colot_hover">
                            <sapn class="transition_root text-nowrap font-bold text-[var(--text)]">تماس با ما</sapn>
                            <div
                                class="w-0 absolute bottom-0 right-auto left-auto gradent_text_sub_heder overflow-hidden flex justify-center items-center transition_root">
                                <div class="w-full h-[2px] bg-white rounded-full"></div>
                            </div>
                        </span>
                    </li>
                </ul>
                <div class="flex items-center gap-2">
                    <div class="px-3 py-2 rounded-xl relative gradient_box1 dropdown" onclick="openShoppingCart()"
                        id="orderBasket">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                            class="size-4 fill-white cursor-pointer">
                            <path
                                d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H69.5c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H199.7c-11.5 0-21.4-8.2-23.6-19.5L170.7 288H459.2c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32h-411C111 12.8 91.6 0 69.5 0H24zM131.1 80H520.7L482.4 222.2c-2.8 10.5-12.3 17.8-23.2 17.8H161.6L131.1 80zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z" />
                        </svg>
                        <div
                            class="size-4 rounded-full p-1 absolute -top-2 -right-2 text-xs bg-[var(--gold)] flex items-center justify-center">
                            @if (isset($allCartCount) && $allCartCount)
                                {{ $allCartCount }}
                            @else
                                {{ '0' }}
                            @endif
                        </div>
                    </div>
                    @if (Auth::check())
                        <div class="px-3 py-2 rounded-xl relative gradient_box1 dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="size-4 fill-white cursor-pointer">
                                <path
                                    d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                            </svg>
                            <div class="absolute top-10 left-0 rounded-xl transition-all duration-300 dropdown-child">
                                <ul class="space-y-4 p-4 text-center rounded-xl gradient_box1">
                                    <li class="w-full text-nowrap font-bold text-slate-800 rounded-xl">
                                        {{ Auth::user()['name'] }} {{ Auth::user()['family'] }}</li>
                                    <li class="w-full text-nowrap font-bold text-slate-800 rounded-xl"><a
                                            href="{{ route('user.profile') }}">حساب کاربری</a>
                                    </li>
                                    <li class="w-full text-nowrap font-bold text-slate-800 rounded-xl"><a
                                            href="{{ route('user.logout') }}">خروج</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('user.login') }}"
                            class="xl:px-7 sm:px-5 px-3 sm:py-2 py-2 rounded-xl flex flex-col sm:flex-row gap-2 justify-center items-center gradient_box1">

                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="size-3 fill-white">
                                    <path
                                        d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                                </svg>
                            </div>
                            <span class="text-[10px] sm:text-sm text-white">ورود / ثبت نام</span>

                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- !-- hamburger_menu_item -->
        <section class="w-full h-dvh fixed top-0 right-0 z-5 lg:hidden translate-x-full transition_root"
            id="hamburger_menu_item">
            <div class="w-full h-full bg-black/40 absolute top-0 right-0 invisible opacity-0 transition_root delay-190"
                onclick="hamburger_menu('close') " id="close_hamburger_document"></div>
            <div
                class="md:w-6/12 sm:w-7/12 w-11/12 max-h-full min-h-full bg-[var(--background-2)] rounded-l-4xl flex flex-col gap-5  justify-between pt-9 relative pb-5 overflow-y-auto [&::-webkit-scrollbar]:w-2  [&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  [&::-webkit-scrollbar-thumb]:rounded-full">
                <div class="w-full flex flex-col gap-5">
                    <div class="absolute top-9 right-6" onclick="hamburger_menu('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                            class="size-5 fill-[var(--gold)]">
                            <path
                                d="M378.4 71.4c8.5-10.1 7.2-25.3-2.9-33.8s-25.3-7.2-33.8 2.9L192 218.7 42.4 40.6C33.9 30.4 18.7 29.1 8.6 37.6S-2.9 61.3 5.6 71.4L160.7 256 5.6 440.6c-8.5 10.2-7.2 25.3 2.9 33.8s25.3 7.2 33.8-2.9L192 293.3 341.6 471.4c8.5 10.1 23.7 11.5 33.8 2.9s11.5-23.7 2.9-33.8L223.3 256l155-184.6z">
                            </path>
                        </svg>
                    </div>
                    <div class="w-full flex flex-col gap-3 items-center">
                        {{-- @if ($logo)
                            <img src="{{ asset('storage/' . $logo->logo) }}" alt="" class="w-5/12">
                        @endif --}}
                        <h4 class="text-[15px] text-[#868686] font-bold ">چاپخانه آنلاین طبابوک</h4>
                        <span class="w-full h-[1px] bg-[#292931]"></span>
                    </div>

                    <div class="w-11/12 flex flex-col gap-3 items-center pr-5">
                        <div class=" w-11/12 mx-auto py-1.5 flex items-center justify-start md:gap-5 gap-3 px-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                    class="size-6 fill-[var(--gold)]">
                                    <path
                                        d="M272.5 5.7c9-7.6 22.1-7.6 31.1 0l264 224c10.1 8.6 11.4 23.7 2.8 33.8s-23.7 11.3-33.8 2.8L512 245.5V432c0 44.2-35.8 80-80 80H144c-44.2 0-80-35.8-80-80V245.5L39.5 266.3c-10.1 8.6-25.3 7.3-33.8-2.8s-7.3-25.3 2.8-33.8l264-224zM288 55.5L112 204.8V432c0 17.7 14.3 32 32 32h48V312c0-22.1 17.9-40 40-40H344c22.1 0 40 17.9 40 40V464h48c17.7 0 32-14.3 32-32V204.8L288 55.5zM240 464h96V320H240V464z" />
                                </svg>
                            </div>
                            <span class="text-[15px] md:text-lg text-[var(--gold)] font-bold">خانه</span>
                        </div>
                        <span class="w-full h-[1px] bg-[#292931]"></span>
                        <div
                            class="group w-11/12 mx-auto py-1.5 flex justify-between items-center px-3 pu_up_servis_hamburger_menu">
                            <div class="w-full flex items-center justify-start gap-4">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="size-6 fill-none stroke-[var(--gold)]" viewBox="0 0 24 24"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2" />
                                        <polyline points="2 17 12 22 22 17" />
                                        <polyline points="2 12 12 17 22 12" />
                                    </svg>
                                </div>
                                <span
                                    class="text-[15px] md:text-lg font-bold text-white group-active:pr-5 group-active:text-[var(--gold)] transition_root">خدمات</span>
                            </div>
                            <div class="transition_root">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="size-4 fill-[var(--gold)]">
                                    <path
                                        d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!-- rezume_item_hamburger_menu -->
                        <div class="w-full h-0 flex flex-col gap-2 overflow-y-auto transition_root">
                            <span class="w-full h-[1px] bg-[#292931]"></span>
                            @foreach ($services as $service)
                                <div class="group w-11/12 mx-auto py-1.5 flex items-center justify-start gap-4 px-3">
                                    <div class="size-6 flex justify-center items-center">
                                        <span class="size-2 rounded-full bg-[var(--gold)]"></span>
                                    </div>
                                    <span
                                        class="text-xs sm:text-md font-bold text-white group-active:pr-5 group-active:text-[var(--gold)] transition_root">{{ $service['title'] }}</span>
                                </div>
                            @endforeach
                        </div>
                        <!-- rezume_item_hamburger_menu -->
                        <span class="w-full h-[1px] bg-[#292931]"></span>
                        <div
                            class="group w-11/12 mx-auto py-1.5 flex justify-between items-center px-3 pu_up_servis_hamburger_menu">
                            <div class="w-full flex items-center justify-start gap-4">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="size-6 fill-[var(--gold)]">
                                        <path
                                            d="M258.8 50.7c-1.8-.7-3.8-.7-5.7 0L63.6 122.6 256 198.2l192.4-75.6L258.8 50.7zM48 377.9c0 3.3 2.1 6.3 5.2 7.5L232 453.2V240.4L48 168.1V377.9zm232 75.3l178.8-67.8c3.1-1.2 5.2-4.2 5.2-7.5V168.1L280 240.4V453.2zM236.1 5.9c12.8-4.9 26.9-4.9 39.7 0l200 75.9C497.6 90 512 110.8 512 134.1V377.9c0 23.3-14.4 44.1-36.1 52.4l-200 75.9c-12.8 4.9-26.9 4.9-39.7 0l-200-75.9C14.4 422 0 401.2 0 377.9V134.1C0 110.8 14.4 90 36.1 81.7l200-75.9z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-[15px] md:text-lg font-bold text-white group-active:pr-5 group-active:text-[var(--gold)] transition_root">دسته
                                    بندی ها</span>
                            </div>
                            <div class="transition_root">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="size-4 fill-[var(--gold)]">
                                    <path
                                        d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                    </path>
                                </svg>
                            </div>

                        </div>
                        <!-- servis_item_hamburger_menu -->
                        <div class="w-full h-0 flex flex-col gap-2 overflow-y-auto transition_root">
                            <span class="w-full h-[1px] bg-[#292931]"></span>
                            @foreach ($categories as $category)
                                <a href="{{ route('category.relatedProducts', [$category]) }}"
                                    class="group w-11/12 mx-auto py-1.5 flex items-center justify-start gap-4 px-3">
                                    <div class="size-6 flex justify-center items-center">
                                        <span class="size-2 rounded-full bg-[var(--gold)]"></span>
                                    </div>
                                    <span
                                        class="text-xs sm:text-md font-bold text-white group-active:pr-5 group-active:text-[var(--gold)] transition_root">{{ $category['title'] }}</span>
                                </a>
                            @endforeach
                        </div>
                        <!-- servis_item_hamburger_menu -->
                        <span class="w-full h-[1px] bg-[#292931]"></span>
                        <a href="{{ route('product.index') }}"
                            class="group w-11/12 mx-auto py-1.5 flex items-center justify-start gap-4 px-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 fill-none stroke-[var(--gold)]"
                                    viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                                </svg>
                            </div>
                            <span
                                class="text-[15px] md:text-lg font-bold text-white group-active:pr-5 group-active:text-[var(--gold)] transition_root">نمونه
                                کار ها</span>
                        </a>
                        <span class="w-full h-[1px] bg-[#292931]"></span>
                        <div class="group w-11/12 mx-auto py-1.5 flex items-center justify-start gap-4 px-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 fill-none stroke-[var(--gold)]"
                                    viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </div>
                            <span
                                class="text-[15px] md:text-lg font-bold text-white group-active:pr-5 group-active:text-[var(--gold)] transition_root">مقالات</span>
                        </div>
                        <span class="w-full h-[1px] bg-[#292931]"></span>
                        <div class="group w-11/12 mx-auto py-1.5 flex items-center justify-start gap-4 px-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 fill-none stroke-[var(--gold)]"
                                    viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <circle cx="12" cy="11" r="2.5" />
                                    <path d="M17 17v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3v1" />
                                </svg>
                            </div>
                            <span
                                class="text-[15px] md:text-lg font-bold text-white group-active:pr-5 group-active:text-[var(--gold)] transition_root">درباره
                                ما</span>
                        </div>
                        <span class="w-full h-[1px] bg-[#292931]"></span>
                        <div class="group w-11/12 mx-auto py-1.5 flex items-center justify-start gap-4 px-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="size-6 fill-[var(--gold)]">
                                    <path
                                        d="M375.8 275.2c-16.4-7-35.4-2.4-46.7 11.4l-33.2 40.6c-46-26.7-84.4-65.1-111.1-111.1L225.3 183c13.8-11.3 18.5-30.3 11.4-46.7l-48-112C181.2 6.7 162.3-3.1 143.6 .9l-112 24C13.2 28.8 0 45.1 0 64v0C0 295.2 175.2 485.6 400.1 509.5c9.8 1 19.6 1.8 29.6 2.2c0 0 0 0 0 0c0 0 .1 0 .1 0c6.1 .2 12.1 .4 18.2 .4l0 0c18.9 0 35.2-13.2 39.1-31.6l24-112c4-18.7-5.8-37.6-23.4-45.1l-112-48zM441.5 464C225.8 460.5 51.5 286.2 48.1 70.5l99.2-21.3 43 100.4L154.4 179c-18.2 14.9-22.9 40.8-11.1 61.2c30.9 53.3 75.3 97.7 128.6 128.6c20.4 11.8 46.3 7.1 61.2-11.1l29.4-35.9 100.4 43L441.5 464zM48 64v0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0s0 0 0 0">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="text-[15px] md:text-lg font-bold text-white group-active:pr-5 group-active:text-[var(--gold)] transition_root">تماس
                                با
                                ما</span>
                        </div>
                    </div>
                </div>
                <div class="w-full border-t-1 border-[#292931] flex flex-col items-center justify-between">
                    <div class="w-full py-6 flex items-center justify-center gap-10">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="sm:size-6 size-5 fill-[var(--gold)]">
                                <path
                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                            </svg>
                        </div>
                        <div>
                            <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"
                                class="sm:size-6 size-5 fill-[var(--gold)]">
                                <path
                                    d="M1764 11q33 24 27 64l-256 1536q-5 29-32 45-14 8-31 8-11 0-24-5l-527-215-298 327q-18 21-47 21-14 0-23-4-19-7-30-23.5t-11-36.5v-452l-472-193q-37-14-40-55-3-39 32-59l1664-960q35-21 68 2zm-342 1499l221-1323-1434 827 336 137 863-639-478 797z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="sm:size-6 size-5 fill-[var(--gold)]">
                                <path
                                    d="M464 258.2c0 2.7-1 5.2-4.2 8c-3.8 3.1-10.1 5.8-17.8 5.8H344c-53 0-96 43-96 96c0 6.8 .7 13.4 2.1 19.8c3.3 15.7 10.2 31.1 14.4 40.6l0 0c.7 1.6 1.4 3 1.9 4.3c5 11.5 5.6 15.4 5.6 17.1c0 5.3-1.9 9.5-3.8 11.8c-.9 1.1-1.6 1.6-2 1.8c-.3 .2-.8 .3-1.6 .4c-2.9 .1-5.7 .2-8.6 .2C141.1 464 48 370.9 48 256S141.1 48 256 48s208 93.1 208 208c0 .7 0 1.4 0 2.2zm48 .5c0-.9 0-1.8 0-2.7C512 114.6 397.4 0 256 0S0 114.6 0 256S114.6 512 256 512c3.5 0 7.1-.1 10.6-.2c31.8-1.3 53.4-30.1 53.4-62c0-14.5-6.1-28.3-12.1-42c-4.3-9.8-8.7-19.7-10.8-29.9c-.7-3.2-1-6.5-1-9.9c0-26.5 21.5-48 48-48h97.9c36.5 0 69.7-24.8 70.1-61.3zM160 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-64a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm128-64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm64 64a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                            </svg>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="sm:size-6 size-5 fill-[var(--gold)]">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                </path>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- hamburger_menu_item -->

    </section>
    <!-- menu -->

    @yield('homeHeader')

    <main class="flex flex-col gap-20 items-center">
        @yield('content')
    </main>


    <footer
        class="w-full mt-20 flex justify-center items-start bg-[var(--background-2)] border-t-1 border-[var(--border)] py-6">
        <section class="w-11/12 flex flex-col gap-4 justify-between items-start">
            <div class="w-full flex flex-col md:flex-row gap-5">
                <div class="w-full md:w-2/3 h-full flex flex-col sm:flex-row gap-5 justify-between items-start">
                    <!-- address -->
                    <div class="sm:w-1/2 w-full h-full flex flex-col gap-3 justify-start items-start">

                        <h5 class="xl:text-2xl lg:text-xl font-bold text-[var(--text)]">اطلاعات تماس</h5>
                        <div class="flex flex-col gap-2 items-start text-xs lg:text-sm xl:text-md">
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="lg:size-4 size-3 fill-[var(--gold)]">
                                        <path
                                            d="M375.8 275.2c-16.4-7-35.4-2.4-46.7 11.4l-33.2 40.6c-46-26.7-84.4-65.1-111.1-111.1L225.3 183c13.8-11.3 18.5-30.3 11.4-46.7l-48-112C181.2 6.7 162.3-3.1 143.6 .9l-112 24C13.2 28.8 0 45.1 0 64v0C0 295.2 175.2 485.6 400.1 509.5c9.8 1 19.6 1.8 29.6 2.2c0 0 0 0 0 0c0 0 .1 0 .1 0c6.1 .2 12.1 .4 18.2 .4l0 0c18.9 0 35.2-13.2 39.1-31.6l24-112c4-18.7-5.8-37.6-23.4-45.1l-112-48zM441.5 464C225.8 460.5 51.5 286.2 48.1 70.5l99.2-21.3 43 100.4L154.4 179c-18.2 14.9-22.9 40.8-11.1 61.2c30.9 53.3 75.3 97.7 128.6 128.6c20.4 11.8 46.3 7.1 61.2-11.1l29.4-35.9 100.4 43L441.5 464zM48 64v0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0s0 0 0 0">
                                        </path>
                                    </svg>
                                </div>
                                <span class=" font-bold text-[var(--text-secondary)]">09371509497</span>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"
                                        class="lg:size-4 size-3 fill-[var(--gold)]">
                                        <path
                                            d="M1664 1504v-768q-32 36-69 66-268 206-426 338-51 43-83 67t-86.5 48.5-102.5 24.5h-2q-48 0-102.5-24.5t-86.5-48.5-83-67q-158-132-426-338-37-30-69-66v768q0 13 9.5 22.5t22.5 9.5h1472q13 0 22.5-9.5t9.5-22.5zm0-1051v-24.5l-.5-13-3-12.5-5.5-9-9-7.5-14-2.5h-1472q-13 0-22.5 9.5t-9.5 22.5q0 168 147 284 193 152 401 317 6 5 35 29.5t46 37.5 44.5 31.5 50.5 27.5 43 9h2q20 0 43-9t50.5-27.5 44.5-31.5 46-37.5 35-29.5q208-165 401-317 54-43 100.5-115.5t46.5-131.5zm128-37v1088q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-1088q0-66 47-113t113-47h1472q66 0 113 47t47 113z">
                                        </path>
                                    </svg>
                                </div>
                                <span class=" font-bold text-[var(--text-secondary)]">shahkar@gmail.com</span>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                        class="lg:size-4 size-3 fill-[var(--gold)]">
                                        <path
                                            d="M336 192c0-79.5-64.5-144-144-144S48 112.5 48 192c0 16.3 7.7 42 24.7 75.4c16.4 32.2 38.8 66.4 62.1 98.3c20.3 27.9 40.7 53.3 57.2 73.1c16.5-19.8 36.9-45.2 57.2-73.1c23.2-31.9 45.6-66.2 62.1-98.3C328.3 234 336 208.3 336 192zm48 0c0 83.1-105.6 219-160.2 283.6C204.8 498.1 192 512 192 512s-12.8-13.9-31.8-36.4C105.6 411 0 275.1 0 192C0 86 86 0 192 0S384 86 384 192zm-160 0a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm-112 0a80 80 0 1 1 160 0 80 80 0 1 1 -160 0z" />
                                    </svg>
                                </div>
                                <span class=" font-bold text-[var(--text-secondary)]">آذربایجان
                                    شرقی،بناب،خیابان طالقانی</span>
                            </div>
                        </div>

                    </div>
                    <!-- address -->
                    <!-- servis -->
                    <div class="sm:w-1/2 w-full h-full flex flex-col gap-3 justify-start items-start">
                        <div class="flex w-full h-full">
                            <div class="w-1/2 h-full flex flex-col gap-3 justify-start items-start">
                                <h5 class="xl:text-2xl lg:text-xl font-bold text-[var(--text)]">خدمات ما</h5>
                                <div
                                    class="w-full flex flex-col gap-1 items-start justify-start xl:text-md lg:text-sm text-xs font-bold text-[#A4A4A5]">
                                    @foreach ($services as $service)
                                        <span
                                            class="hover:text-[var(--gold)] transition duration-300 cursor-pointer">{{ $service['title'] }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="w-1/2 h-full flex flex-col gap-3 justify-start items-start">
                                <h5 class="xl:text-2xl lg:text-xl font-bold text-[var(--text)]">دسته بندی ها</h5>
                                <div
                                    class="w-full flex flex-col gap-1 items-start justify-start xl:text-md lg:text-sm text-xs font-bold text-[#A4A4A5]">
                                    @foreach ($categories as $category)
                                        <a href="{{ route('category.relatedProducts', [$category]) }}"
                                            class="hover:text-[var(--gold)] transition duration-300 cursor-pointer">{{ $category['title'] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- servis -->
                </div>
                <!-- news -->
                <div class="w-full md:w-1/3 h-full flex flex-col justify-center items-start">
                    <div class="flex flex-col gap-3 justify-center items-start mx-auto">
                        <h5 class="xl:text-2xl lg:text-xl font-bold text-[var(--text)]">درباره ما</h5>
                        <p class="w-10/12 xl:text-lg text-sm font-bold text-[var(--text-secondary)]">
                            چاپ <span class="text-[var(--gold)]">طبابوک</span> با سال‌ها تجربه در زمینه چاپ دیجیتال و
                            تبلیغات محیطی، همراه مطمئن شما در مسیر برندسازی و معرفی کسب‌وکار است.</p>
                    </div>
                    <!-- social_network_svg -->
                    <div class="w-full py-6 flex items-center justify-center gap-10">
                        <div
                            class="p-2 rounded-full bg-[var(--background)] border border-[var(--gold)] flex justify-center items-center cursor-pointer scale transition_root">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="sm:size-4 size-4 fill-[var(--gold)]">
                                <path
                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                            </svg>
                        </div>
                        <div
                            class="p-2 rounded-full bg-[var(--background)] border border-[var(--gold)] flex justify-center items-center cursor-pointer scale transition_root">
                            <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"
                                class="sm:size-4 size-4 fill-[var(--gold)]">
                                <path
                                    d="M1764 11q33 24 27 64l-256 1536q-5 29-32 45-14 8-31 8-11 0-24-5l-527-215-298 327q-18 21-47 21-14 0-23-4-19-7-30-23.5t-11-36.5v-452l-472-193q-37-14-40-55-3-39 32-59l1664-960q35-21 68 2zm-342 1499l221-1323-1434 827 336 137 863-639-478 797z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="p-2 rounded-full bg-[var(--background)] border border-[var(--gold)] flex justify-center items-center cursor-pointer scale transition_root">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="sm:size-4 size-4 fill-[var(--gold)]">
                                <path
                                    d="M464 258.2c0 2.7-1 5.2-4.2 8c-3.8 3.1-10.1 5.8-17.8 5.8H344c-53 0-96 43-96 96c0 6.8 .7 13.4 2.1 19.8c3.3 15.7 10.2 31.1 14.4 40.6l0 0c.7 1.6 1.4 3 1.9 4.3c5 11.5 5.6 15.4 5.6 17.1c0 5.3-1.9 9.5-3.8 11.8c-.9 1.1-1.6 1.6-2 1.8c-.3 .2-.8 .3-1.6 .4c-2.9 .1-5.7 .2-8.6 .2C141.1 464 48 370.9 48 256S141.1 48 256 48s208 93.1 208 208c0 .7 0 1.4 0 2.2zm48 .5c0-.9 0-1.8 0-2.7C512 114.6 397.4 0 256 0S0 114.6 0 256S114.6 512 256 512c3.5 0 7.1-.1 10.6-.2c31.8-1.3 53.4-30.1 53.4-62c0-14.5-6.1-28.3-12.1-42c-4.3-9.8-8.7-19.7-10.8-29.9c-.7-3.2-1-6.5-1-9.9c0-26.5 21.5-48 48-48h97.9c36.5 0 69.7-24.8 70.1-61.3zM160 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-64a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm128-64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm64 64a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                            </svg>
                        </div>
                        <div
                            class="p-2 rounded-full bg-[var(--background)] border border-[var(--gold)] flex justify-center items-center cursor-pointer scale transition_root">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="sm:size-4 size-4 fill-[var(--gold)]">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <!-- social_network_svg -->
                </div>
                <!-- news -->
            </div>
            <div class="mx-auto flex flex-col gap-1 items-center justify-center">
                <p class="xl:text-[15px] lg:text-[12px] text-[13px] text-[var(--text-secondary)]">طراحی و توسعه <span
                        class="font-bold">شرکت اندیشه
                        گران طراحان دیجیتال<span class="text-[var(--gold)]">(فائوس)</span> </span></p>
                <span class="text-[17px] font-bold text-[var(--gold)]">09147794595</span>
            </div>
        </section>
    </footer>
    <script>
        const csrfToken = "{{ csrf_token() }}"
        const route = ""
        const link = "{{ url('/') }}/"
        const storage = "{{ asset('storage/') }}/"
        let flag = "{{ Auth::check() }}";
        let userId = "{{ Auth::id() }}";
        let product_id = "{{ $product->id ?? '' }}";
        // let link = "{{ url('/') }}/";
        let element = document.getElementById('cartBtn')
        let message = document.getElementById('message')
        let authenticationDiv = document.getElementById('authenticationDiv')
        let orderBasket = document.getElementById('orderBasket')
    </script>
    {{-- <script src="{{ asset('js/shoppingCart.js') }}"></script> --}}
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
