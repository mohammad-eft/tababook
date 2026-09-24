<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <title>@yield('title')</title>
    <script>
        let url = "{{ url('/') }}/"
        let api = "{{ url('api/') }}/"
        let imgPath = "{{ asset('storage/') }}/"
        let flag = "{{ Auth::check() }}"
        let userId = null;
        let user = null
        if(flag){
            userId = "{{ Auth::id() }}"
            user = "{{ Auth::user() }}"
        }
    </script>
</head>

<body>
    <header class="w-full flex flex-col justify-start items-center">
        <a href="{{ $setting['topBannerLink'] }}" class="w-full py-2 bg-green-700 flex justify-center items-center">
            <img src="{{ asset('storage/' . $setting['topBanner']) }}" class="w-full" alt="">
        </a>
        <section class="w-11/12 flex flex-col gap-4 justify-start items-center">
            <div class="w-full flex justify-between gap-1 items-center pt-5 lg:pt-10">
                <div class="xl:w-1/3 lg:w-1/4 max-lg:w-1/3 h-full flex justify-start items-center lg:hidden">
                    <div class="flex flex-col gap-1 items-start justify-center " onclick="hamburger_menu('open')">
                        <span class="lg:w-7 w-4 lg:h-1 h-0.5 bg-black rounded-full"></span>
                        <span class="lg:w-7 w-4 lg:h-1 h-0.5 bg-black rounded-full"></span>
                        <span class="lg:w-7 w-4 lg:h-1 h-0.5 bg-black rounded-full"></span>
                    </div>
                </div>
                <div
                    class="hidden xl:w-1/3 lg:w-1/4 max-lg:w-1/3 h-full lg:flex lg:justify-start justify-center items-center">
                    <img src="{{ asset('storage/' . $setting['logo']) }}" alt="" class="xl:w-1/3 lg:w-1/2 w-full">
                </div>
                <form action="{{ route('search.page') }}" method="POST" class="xl:w-1/3 lg:w-2/4 max-lg:w-1/3 h-full flex justify-center items-center max-lg:hidden">
                    @csrf
                    <div
                        class="w-full py-2 flex justify-between items-center px-4 cart_shdow bg-[#F3ECE2] border border-[#e9d2b1] rounded-lg">
                        <input type="text" name="title" class="outline-none w-full h-full"
                            placeholder="کتاب یا نویسنده یا محصول خود را جستجو کنید">
                        <button class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 fill-[#929391]">
                                <path
                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </button>
                    </div>
                </form>
                <div class="xl:w-1/3 lg:w-1/4 max-lg:w-1/3 h-full flex justify-end items-center lg:gap-5 gap-2">
                    <a @if (!Auth::check()) href="{{ route('login') }}" @else href="{{ route('user.profile') }}" @endif
                        class="block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="lg:size-5 size-4">
                            <path
                                d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                        </svg>
                    </a>
                    @if(Auth::check())
                    <a href="{{ route('cart.list') }}" class="block relative" id="orderBasket">
                        <svg class="w-[29px] h-[29px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                        <span></span>
                    </a>
                    @else
                    <div     class="relative">
                        <svg class="w-[29px] h-[29px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                        <span></span>
                    </div>
                    @endif
                    {{-- <div class="relative sm:p-2.5 p-1.5 flex items-center gap-4">
                       
                            <a href="{{ route('search.page') }}">
                                <svg class="w-[30px] h-[30px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        
                            <a @if (!Auth::check()) href="{{ route('login') }}" @else href="{{ route('user.profile') }}" @endif>
                                <svg class="w-[30px] h-[30px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                            </a>
                        
                    </div> --}}
{{--                    <div class="w-full relative lg:hidden block mt-5">--}}
{{--                        <input type="text" class="w-full outline-none rounded-md py-2 md:py-4 pl-2 pr-10 md:pr-20"--}}
{{--                            placeholder="جست و جو">--}}
{{--                        <svg class="absolute w-5 md:w-8 top-[20%] right-[3%]" xmlns="http://www.w3.org/2000/svg"--}}
{{--                            viewBox="0 0 512 512">--}}
{{--                            <path--}}
{{--                                d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H69.5c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H199.7c-11.5 0-21.4-8.2-23.6-19.5L170.7 288H459.2c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32h-411C111 12.8 91.6 0 69.5 0H24zM131.1 80H520.7L482.4 222.2c-2.8 10.5-12.3 17.8-23.2 17.8H161.6L131.1 80zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z">--}}
{{--                            </path>--}}
{{--                        </svg>--}}
{{--                        <span--}}
{{--                            class="sm:size-3 size-1 bg-green-700 rounded-full absolute top-0 right-0 text-xs flex justify-center items-center">4</span>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="w-full h-10 flex justify-center items-center">
                <ul class="flex gap-4 lg:gap-6 xl:gap-10 text-sm lg:text-base justify-end max-lg:hidden">
                    <li>
                        <a href="{{ route('home') }}"
                            class="flex justify-center flex-col items-center cursor-pointer py-1 group transition-all duration-300">
                            <span>خانه</span>
                            <div
                                class="rounded-md group-hover:w-full @if (Route::is('home')) w-full @else w-0 @endif bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}"
                            class="flex justify-center flex-col items-center group cursor-pointer py-1 transition-all duration-300">
                            <span>محصولات</span>
                            <div
                                class="rounded-md group-hover:w-full w-0 bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}"
                            class="flex justify-center flex-col items-center group cursor-pointer py-1 transition-all duration-300">
                            <span>دسته بندی ها</span>
                            <div
                                class="rounded-md group-hover:w-full w-[0px] bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('user.contact')}}"
                            class="flex justify-center flex-col items-center group cursor-pointer py-1 transition-all duration-300">
                            <span>تماس باما</span>
                            <div
                                class="rounded-md group-hover:w-full w-[0px] bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('user.about')}}"
                            class="flex justify-center flex-col items-center group cursor-pointer py-1 transition-all duration-300">
                            <span>درباره ما</span>
                            <div
                                class="rounded-md group-hover:w-full w-[0px] bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                </ul>
                <div
                    class="w-full py-2 bg-white rounded-full flex justify-between items-center px-2 cart_shdow lg:hidden">
                    <input type="text" class="outline-none w-full h-full text-xs"
                        placeholder="کتاب یا نویسنده یا محصول خود را جستجو کنید">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-4 fill-[#929391]">
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- hamburger_menu_item -->
        <div class="w-full h-dvh bg-black/50 invisible opacity-0 fixed top-0 right-0 transition_normal lg:hidden z-3"
            onclick="hamburger_menu('close')" id="hamburger_menu_item_close"></div>
        <div class="xl:w-18/100 lg:w-21/100 sm:w-1/2 w-2/3 bg-white h-dvh flex flex-col justify-start items-center fixed top-0 right-0 rounded-l-4xl transition_normal z-3 lg:hidden translate-x-full"
            id="hamburger_menu_item">
            <div class="w-11/12 h-full flex flex-col gap-6 justify-start items-start rounded-l-4xl  relative">
                <div class="w-full h-20 flex gap-3 justify-between items-center px-">
                    <img src="{{ asset('storage/' . $setting['logo']) }}" alt=""
                        class="w-2/3 h-full">
                    <div onclick="hamburger_menu('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="size-7">
                            <path
                                d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z" />
                        </svg>
                    </div>
                </div>
                <!-- item -->
                <div class="w-full flex flex-col gap-2 justify-start items-center">
                    <a href="{{ route('home') }}"
                        class="w-full py-2 bg-green-300/50 rounded-xl gradient_item flex gap-3 justify-start items-center px-4">

                        <span class="xl:text-lg text-green-700 font-bold">صفحه اصلی</span>
                    </a>
                    <a href="{{ route('product.index') }}"
                        class="w-full py-2 bg-green-300/50 rounded-xl gradient_item flex gap-3 justify-start items-center px-4">
                        <span class="xl:text-lg text-green-700 font-bold"> محصولات</span>
                    </a>
                    <a href="{{ route('category.index') }}"
                        class="w-full py-2 bg-green-300/50 rounded-xl gradient_item flex gap-3 justify-start items-center px-4">
                        <span class="xl:text-lg text-green-700 font-bold"> دسته بندی ها</span>
                    </a>
                    <a href="{{route('user.contact')}}"
                        class="w-full py-2 bg-green-300/50 rounded-xl gradient_item flex gap-3 justify-start items-center px-4">
                        <span class="xl:text-lg text-green-700 font-bold">تماس باما</span>
                    </a>
                    <a href="{{route('user.about')}}"
                        class="w-full py-2 bg-green-300/50 rounded-xl gradient_item flex gap-3 justify-start items-center px-4">
                        <span class="xl:text-lg text-green-700 font-bold">درباره ما</span>
                    </a>

                </div>
                <!-- item -->
            </div>
        </div>
        <!-- hamburger_menu_item -->
    </header>