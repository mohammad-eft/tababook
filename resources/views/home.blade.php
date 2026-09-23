<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book</title>
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
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
                    class="xl:w-1/3 lg:w-1/4 max-lg:w-1/3 h-full flex lg:justify-start justify-center items-center">
                    <img src="{{ asset('storage/' . $setting['logo']) }}" alt="" class="xl:w-1/3 lg:w-1/2 w-full">
                </div>
                <div class="xl:w-1/3 lg:w-2/4 max-lg:w-1/3 h-full flex justify-center items-center max-lg:hidden">
                    <div
                        class="w-full py-2 flex justify-between items-center px-4 cart_shdow bg-[#F3ECE2] border border-[#e9d2b1] rounded-lg">
                        <input type="text" class="outline-none w-full h-full"
                            placeholder="کتاب یا نویسنده یا مخصول خود را جستجو کنید">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 fill-[#929391]">
                                <path
                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/3 lg:w-1/4 max-lg:w-1/3 h-full flex justify-end items-center lg:gap-5 gap-2">
                    <a @if (!Auth::check()) href="{{ route('login') }}" @else href="{{ route('user.profile') }}" @endif
                        class="block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="lg:size-5 size-4">
                            <path
                                d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                        </svg>
                    </a>
                    <div class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="lg:size-5 size-4">
                            <path
                                d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                        </svg>
                    </div>

                    <a href="" class="relative sm:p-2.5 p-1.5">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                             class="lg:size-5 size-4 cursor-pointer">
                            <path
                                    d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H69.5c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H199.7c-11.5 0-21.4-8.2-23.6-19.5L170.7 288H459.2c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32h-411C111 12.8 91.6 0 69.5 0H24zM131.1 80H520.7L482.4 222.2c-2.8 10.5-12.3 17.8-23.2 17.8H161.6L131.1 80zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z">
                            </path>
                        </svg>
                        <span
                                    class="sm:size-4 size-3 bg-green-700 rounded-full absolute top-0 right-0 lg:text-xs text-[9px] flex justify-center items-center text-white">4</span>

                    </a>
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
                        <a href="#"
                            class="flex justify-center flex-col items-center group cursor-pointer py-1 transition-all duration-300">
                            <span>محصولات</span>
                            <div
                                class="rounded-md group-hover:w-full w-0 bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex justify-center flex-col items-center group cursor-pointer py-1 transition-all duration-300">
                            <span>دسته بندی ها</span>
                            <div
                                class="rounded-md group-hover:w-full w-[0px] bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex justify-center flex-col items-center group cursor-pointer py-1 transition-all duration-300">
                            <span>تماس باما</span>
                            <div
                                class="rounded-md group-hover:w-full w-[0px] bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex justify-center flex-col items-center group cursor-pointer py-1 transition-all duration-300">
                            <span>درباره ما</span>
                            <div
                                class="rounded-md group-hover:w-full w-[0px] bg-[#fcd7a4] h-[2px] transition-all duration-300">
                            </div>
                        </a>
                    </li>
                </ul>
                <div
                    class="w-full py-3 bg-white rounded-full flex justify-between items-center px-2 cart_shdow lg:hidden">
                    <input type="text" class="outline-none w-full h-full text-xs"
                        placeholder="کتاب یا نویسنده یا مخصول خود را جستجو کنید">
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
                    <img src="{{ asset('storage/' . $setting['logo']) }}" alt="" class="w-2/3 h-full">
                    <div onclick="hamburger_menu('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="size-7">
                            <path
                                d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z" />
                        </svg>
                    </div>
                </div>
                <!-- item -->
                <div class="w-full flex flex-col gap-2 justify-start items-center">
                    <div
                        class="w-full py-2 bg-green-300/50 rounded-xl gradient_item flex gap-3 justify-start items-center px-4">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                class="xl:size-6 size-5 fill-green-700">
                                <path
                                    d="M272.5 5.7c9-7.6 22.1-7.6 31.1 0l264 224c10.1 8.6 11.4 23.7 2.8 33.8s-23.7 11.3-33.8 2.8L512 245.5V432c0 44.2-35.8 80-80 80H144c-44.2 0-80-35.8-80-80V245.5L39.5 266.3c-10.1 8.6-25.3 7.3-33.8-2.8s-7.3-25.3 2.8-33.8l264-224zM288 55.5L112 204.8V432c0 17.7 14.3 32 32 32h48V312c0-22.1 17.9-40 40-40H344c22.1 0 40 17.9 40 40V464h48c17.7 0 32-14.3 32-32V204.8L288 55.5zM240 464h96V320H240V464z">
                                </path>
                            </svg>
                        </div>
                        <span class="xl:text-lg text-green-700 font-bold">صفحه اصلی</span>
                    </div>
                    <div class="w-full py-2 rounded-xl gradient_item flex gap-3 justify-start items-center px-4">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="xl:size-6 size-5">
                                <path
                                    d="M272.5 5.7c9-7.6 22.1-7.6 31.1 0l264 224c10.1 8.6 11.4 23.7 2.8 33.8s-23.7 11.3-33.8 2.8L512 245.5V432c0 44.2-35.8 80-80 80H144c-44.2 0-80-35.8-80-80V245.5L39.5 266.3c-10.1 8.6-25.3 7.3-33.8-2.8s-7.3-25.3 2.8-33.8l264-224zM288 55.5L112 204.8V432c0 17.7 14.3 32 32 32h48V312c0-22.1 17.9-40 40-40H344c22.1 0 40 17.9 40 40V464h48c17.7 0 32-14.3 32-32V204.8L288 55.5zM240 464h96V320H240V464z">
                                </path>
                            </svg>
                        </div>
                        <span class="xl:text-lg font-bold">کتاب ها</span>
                    </div>
                </div>
                <!-- item -->
            </div>
        </div>
        <!-- hamburger_menu_item -->
    </header>

    <main class="w-full flex flex-col gap-10 justify-start items-center my-10">
        <!-- hero -->
        <section class="w-full xl:h-90 lg:h-80 flex max-lg:flex-col xl:gap-20 lg:gap-15 gap-5 justify-start items-center bg-[#F3ECE2] max-lg:pb-5">
            <div class="lg:w-1/2 w-full h-full flex justify-center items-center">
                <img src="{{ asset('storage/' . $setting['heroBanner']) }}" alt=""
                    class="w-full lg:h-full max-h-full">
            </div>
            <div class="lg:w-1/2 w-full h-full  flex lg:justify-start justify-center items-center">
                <div
                    class="xl:w-9/12 lg:w-10/12 w-11/12 h-full flex flex-col gap-5 justify-center lg:items-start items-center">
                    <div
                        class="flex flex-col gap-2 justify-start items-start max-lg:items-center xl:text-4xl lg:text-4xl text-[8vw] font-bold max-lg:text-center">
                        <h1>{{ $setting['heroTitle'] }}</h1>

                    </div>
                    <p class="max-xl:text-sm max-lg:text-center">{{ $setting['heroSubtitle'] }}</p>
                    <div class="w-full flex lg:gap-6 gap-3 justify-between items-center">
                        <a href="{{ $setting['heroPrimaryButtonLink'] }}"
                            class="w-1/2 lg:py-4 py-3 bg-green-700 xl:text-lg max-lg:text-sm text-white font-bold rounded-xl flex justify-center items-center">
                            {{ $setting['heroPrimaryButton'] }}
                        </a>
                        <a href="{{ $setting['heroSecondaryButtonLink'] }}"
                            class="w-1/2 lg:py-3 py-2 border-2 border-[#254c24] rounded-xl xl:text-lg max-lg:text-sm text-green-700 font-bold flex justify-center items-center">
                            {{ $setting['heroSecondaryButton'] }}
                        </a>
                    </div>
                </div>
            </div>

        </section>
        <!-- hero -->
        <!-- category -->
        <section
            class="max-w-11/12 w-11/12 lg:h-32 h-25  flex lg:gap-5 gap-3 justify-start items-center overflow-x-auto p-1">
            @foreach ($categories as $category)
                <a href="{{ route('category.relatedProducts', [$category->id]) }}"
                    class="xl:min-w-1/9 xl:max-w-1/9 lg:min-w-1/8 max-w-1/8 min-w-1/3 max-w-1/3  h-full bg-white flex flex-col gap-3 justify-center items-center rounded-xl cart_shdow">
                    <div class="lg:size-15 size-12 rounded-full bg-[#FAEDD9] flex justify-center items-center">
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : '' }}"
                            class="size-7/12 rounded-full" alt="">
                    </div>
                    <span class="max-lg:text-xs font-bold">{{ $category->title }}</span>
                </a>
            @endforeach

        </section>
        <!-- category -->
        <!-- likly -->
        <section class="w-11/12 flex flex-col gap-4 justify-start items-start">
            <div class="flex flex-col gap-1 justify-start lg:items-start items-center">
                <h3 class="text-xl font-bold">محبوب ترین های این روز ها</h3>
                <p class="text-[#ADB4B2] max-lg:text-center max-lg:text-sm">انتخاب هایی که بیشتر از همه مورد توجه
                    کاربران قرار گرفته است</p>
            </div>
            <div class="max-w-full w-full overflow-x-auto py-2 px-1 flex gap-4 justify-start">
                @foreach ($products as $product)
                    <div
                        class="xl:min-w-19/100 xl:max-w-19/100 lg:min-w-24/100 max-w-24/100 min-w-48/100 max-w-48/100  min-h-full bg-white flex flex-col gap-2 justify-start items-center rounded-xl cart_shdow p-2">
                        <div class="w-full h-1/2 flex justify-center items-center relative">
                            <a href={{ route('product.show', [$product->id]) }} class="block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                    class="max-w-full max-h-24 lg:max-h-42">
                            </a>
                            @if ($product->percent)
                                <span
                                    class="lg:px-2 px-1 lg:py-1 py-0.5 bg-red-500 rounded-md text-xs max-lg:text-[9px] text-white absolute top-0 right-0">{{ $product->percent }}%</span>
                            @endif
                            <div class="px-2 py-1 absolute top-0 left-0 change_like_svh">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="lg:size-5 size-4">
                                        <path
                                            d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                    </svg>
                                </div>
                                <div class="hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="size-5 fill-red-500">
                                        <path
                                            d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full h-1/2 flex flex-col gap-1 justify-start items-start">
                            <a href={{ route('product.show', [$product->id]) }}
                                class="lg:text-lg text-sm font-bold max-w-full truncate">{{ $product->title }}</a>
                            <span class="text-[#ADB4B2] max-lg:text-xs">{{ $product->writer }}</span>
                            <div class="flex justify-start items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                        class="size-4 fill-yellow-400">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </div>
                                <span class="lg:text-xs text-[10px] text-[#ADB4B2]">5.0</span>
                            </div>
                            @if ($product->secondary_price)
                                <div class="flex items-center justify-between gap-2">
                                    <strong class="text-[15px] in-fa">{{ $product->secondary_price }}</strong>
                                    <span class="text-[10px] text-[#71717a]">تومان
                                    </span>
                                </div>
                                <div class="line-through text-[#a1a1aa] text-[10px] in-fa">
                                    {{ $product->primary_price }} تومان</div>
                            @else
                                <div class="flex items-center justify-between gap-2">
                                    <strong class="text-[15px] in-fa">{{ $product->primary_price }}</strong>
                                    <span class="text-[10px] text-[#71717a]">تومان
                                    </span>
                                </div>
                            @endif
                            <div class="w-full py-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                        class="lg:size-4 size-3" fill="white">
                                        <path
                                            d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- likly -->

        <!-- baner1 -->
        <section class="w-11/12 flex max-lg:flex-col justify-start items-center bg-[#EBEFE1] rounded-xl">
            <div class="lg:w-1/2 w-full flex justify-center items-center relative">
                <img src="{{ asset('storage/' . $setting['secondBanner']) }}" alt=""
                    class="w-full h-full object-cover rounded-r-xl lg:max-h-90 max-h-70">
                {{-- <div
                    class="lg:size-25 size-20 rounded-full bg-green-700 flex flex-col gap-1 justify-center items-center absolute lg:top-1/12 top-0 right-1/24">
                    <div class="flex gap-1 justify-start items-center">
                        <span class="max-lg:text-sm text-white">تا</span>
                        <span class="lg:text-lg font-bold text-white">%30</span>
                    </div>
                    <span class="max-lg:text-sm text-white">تخفیف</span>
                </div> --}}
            </div>
            <div
                class="lg:w-1/2 w-full min-h-full  flex lg:justify-start justify-center items-center lg:pr-20 lg:py-4 max-lg:px-2 max-lg:pt-7 max-lg:pb-5">
                <div class="w-full h-full flex flex-col gap-3 justify-center lg:items-start items-center">
                    <h3 class="lg:text-4xl text-2xl font-bold">{{ $setting['secondBannerTitle'] }}</h3>
                    <p class="max-xl:text-sm max-lg:text-xs max-lg:text-center">{{ $setting['secondBannerSubtitle'] }}
                    </p>

                    <a href="{{ $setting['secondBannerButtonLink'] }}"
                        class="px-6 lg:py-3 py-2 bg-green-700  text-sm text-white font-bold rounded-xl flex justify-center items-center mt-2">
                        {{ $setting['secondBannerButton'] }}
                    </a>


                </div>
            </div>

        </section>
        <!-- baner1 -->
        <!-- new product -->
        <section class="w-11/12 flex flex-col gap-4 justify-start items-start">
            <div class="flex flex-col gap-1 justify-start lg:items-start items-center">
                <h3 class="text-xl font-bold">تازه به قفسه ها اضافه شده</h3>
                <p class="text-[#ADB4B2] max-lg:text-center max-lg:text-sm">جدید ترین کتاب ها و محصولات فروشگاه را
                    زودتر از بقیه ببین</p>
            </div>
            <div class="max-w-full w-full overflow-x-auto py-2 px-1 flex gap-4 justify-start">

                @foreach ($newProducts as $product)
                    <div
                        class="xl:min-w-19/100 xl:max-w-19/100 lg:min-w-24/100 max-w-24/100 min-w-48/100 max-w-48/100  min-h-full bg-white flex flex-col gap-2 justify-start items-center rounded-xl cart_shdow p-2 pb-5">
                        <div class="w-full h-1/2 flex justify-center items-center relative">
                            <a href={{ route('product.show', [$product->id]) }} class="block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                    class="max-w-full max-h-24 lg:max-h-42">
                            </a>
                            @if ($product->percent)
                                <span
                                    class="lg:px-2 px-1 lg:py-1 py-0.5 bg-red-500 rounded-md text-xs max-lg:text-[9px] text-white absolute top-0 right-0">{{ $product->percent }}%</span>
                            @endif
                            <div class="px-2 py-1 absolute top-0 left-0 change_like_svh">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="lg:size-5 size-4">
                                        <path
                                            d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                    </svg>
                                </div>
                                <div class="hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="size-5 fill-red-500">
                                        <path
                                            d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full h-1/2 flex flex-col gap-1 justify-start items-start">
                            <a href={{ route('product.show', [$product->id]) }}
                                class="lg:text-lg text-sm font-bold max-w-full truncate">{{ $product->title }}</a>
                            <span class="text-[#ADB4B2] max-lg:text-xs">{{ $product->writer }}</span>
                            <div class="flex justify-start items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                        class="size-4 fill-yellow-400">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </div>
                                <span class="lg:text-xs text-[10px] text-[#ADB4B2]">5.0</span>
                            </div>
                            @if ($product->secondary_price)
                                <div class="flex items-center justify-between gap-2">
                                    <strong class="text-[15px] in-fa">{{ $product->secondary_price }}</strong>
                                    <span class="text-[10px] text-[#71717a]">تومان
                                    </span>
                                </div>
                                <div class="line-through text-[#a1a1aa] text-[10px] in-fa">
                                    {{ $product->primary_price }} تومان</div>
                            @else
                                <div class="flex items-center justify-between gap-2">
                                    <strong class="text-[15px] in-fa">{{ $product->primary_price }}</strong>
                                    <span class="text-[10px] text-[#71717a]">تومان
                                    </span>
                                </div>
                            @endif
                            <div class="w-full py-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                        class="lg:size-4 size-3" fill="white">
                                        <path
                                            d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </section>












        {{-- <section class="w-full flex justify-center">
            <div class="w-11/12 flex flex-col gap-5">
                <span class="text-2xl fount-bold">امروز دنباله چه چیزی هستی؟</span>
                <div class="flex w-full max-w-full items-center gap-4 overflow-hidden overflow-x-auto">
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                    <div class="flex flex-col items-center gap-5 py-4 px-5 shadow-lg lg:rounded-xl rounded-md">
                        <img class="rounded-xl lg:min-w-35 lg:max-w-35 min-w-16 max-w-16 "
                            src="{{ asset('storage/home/d05d5a19-651d-4bae-b31d-0e018e208b93.jfif') }}"
                            alt="">
                        <span class="lg:text-xl text-xs">فلسفه</span>
                    </div>
                </div>
            </div>
        </section> --}}


        <section class="w-full flex justify-center ">
            <div class="w-11/12 flex max-lg:flex-col justify-between items-center gap-3">
                <a href="{{ $setting['rightBannerLink'] }}" class="lg:w-5/12 w-full rounded-2xl h-full">
                    <img class="w-full h-full rounded-xl"
                        src="{{ asset('storage/'.$setting['rightBanner']) }}" alt="">
                </a>
                <div class="lg:w-7/12 w-full lg:h-60 relative flex max-lg:flex-col items-center gap-3 bg-[#F3ECE2] rounded-xl">
                    <img class="h-full lg:w-1/2 w-full rounded-r-xl object-cover max-h-40"
                        src="{{ asset('storage/'.$setting['leftBanner']) }}" alt="">
                    <div class="lg:w-1/2 w-full flex flex-col gap-2 lg:items-start items-center p-3">
                        <span class="lg:text-xl text-md font-bold">{{ $setting['leftBannerTitle'] }}</span>
                       
                        <span class="lg:text-md text-xs">{{ $setting['leftBannerSubtitle'] }}</span>
                        <a href="{{ $setting['leftBannerButtonLink'] }}"
                            class="w-full rounded-xl bg-green-600 flex items-center justify-center gap-2 mt-5 p-2">
                            <span class="lg:text-md text-xs text-white">{{ $setting['leftBannerButton'] }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="lg:size-5 size-3 fill-white">
                                <path
                                    d="M7.4 273.4C2.7 268.8 0 262.6 0 256s2.7-12.8 7.4-17.4l176-168c9.6-9.2 24.8-8.8 33.9 .8s8.8 24.8-.8 33.9L83.9 232 424 232c13.3 0 24 10.7 24 24s-10.7 24-24 24L83.9 280 216.6 406.6c9.6 9.2 9.9 24.3 .8 33.9s-24.3 9.9-33.9 .8l-176-168z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <section class="w-full flex justify-center gap-5">
            <div class="w-11/12 flex flex-col gap-5">
                <div class="w-full flex justify-between items-center">
                    <span class="lg:text-2xl text-xl font-bold">{{ $setting['twoCardsSectionTitle'] }} </span>
                    <a href="{{ $setting['twoCardsSectionLinkUrl'] }}" class="text-sm text-gray-500">{{ $setting['twoCardsSectionLinkText'] }}</a>
                </div>
                <div class="flex items-center flex-col lg:flex-row gap-8">
                    <div class="lg:w-6/12 w-full flex max-lg:flex-col gap-2 justify-between p-5 px-7 bg-[#f8f4eb] rounded-xl">
                        <div class="lg:w-1/2 w-full flex flex-col max-lg:items-center justify-center gap-3 max-lg:order-2">
                            <span class="text-xl max-lg:text-lg font-bold">{{ $setting['twoCardsRightTitle'] }}</span>
                            <span class="max-lg:text-sm text-gray-600 max-lg:text-center">{{ $setting['twoCardsRightSubtitle'] }}</span>
                            <a href="{{ $setting['twoCardsRightButtonLink'] }}"
                                class="flex justify-center items-center w-9/12 py-2 border-2 border-gray-300 rounded-xl">
                                <span>{{ $setting['twoCardsRightButton'] }}</span>
                            </a>
                        </div>
                        <img class="lg:w-1/2 w-full max-h-60 rounded-l-xl max-lg:order-1"
                            src="{{ asset('storage/'.$setting['twoCardsRightImage']) }}"
                            alt="">
                    </div>
                    <div class="lg:w-6/12 w-full flex max-lg:flex-col gap-2 justify-between p-5 px-7 bg-[#f8f4eb] rounded-xl">
                        <div class="lg:w-1/2 w-full flex flex-col max-lg:items-center justify-center gap-3 max-lg:order-2">
                            <span class="text-2xl font-bold">{{ $setting['twoCardsLeftTitle'] }}</span>
                            <span class="max-lg:text-sm text-gray-600 max-lg:text-center">{{ $setting['twoCardsLeftSubtitle'] }} </span>
                            <a href="{{ $setting['twoCardsLeftButtonLink'] }}" class="flex justify-center items-center w-9/12 py-2 border-2 border-gray-300 rounded-xl">
                                <span>{{ $setting['twoCardsLeftButton'] }}</span>
                            </a>
                        </div>
                        <img class="lg:w-1/2 w-full max-h-60 rounded-l-xl max-lg:order-1"
                            src="{{ asset('storage/'.$setting['twoCardsLeftImage']) }}"
                            alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- new product -->
        <!-- maybe likly-->
        {{-- <section class="w-11/12 flex flex-col gap-4 justify-start items-start">
            <div class="flex flex-col gap-1 justify-start lg:items-start items-center">
                <h3 class="text-xl font-bold">شاید این ها را دوست داشته باشی</h3>
                <p class="text-[#ADB4B2] max-lg:text-center max-lg:text-sm">این لیست طبق علایق قبلی شما در فروشکاه ما
                    حمع شده</p>
            </div>
            <div class="max-w-full w-full overflow-x-auto p-1 flex gap-4 justify-start items-center">
                <div
                    class="xl:min-w-19/100 xl:max-w-19/100 lg:min-w-24/100 max-w-24/100 min-w-48/100 max-w-48/100  h-full bg-white flex flex-col gap-2 justify-start items-center rounded-xl cart_shdow p-2">
                    <div class="w-full h-1/2 flex justify-center items-center relative">
                        <img src="{{ asset('storage/home/bookSM_1847177_0 (1).jpg') }}" alt=""
                            class="max-w-full max-h-24 lg:max-h-42">
                        <span
                            class="lg:px-2 px-1 lg:py-1 py-0.5 bg-red-500 rounded-md text-xs max-lg:text-[9px] text-white absolute top-0 right-0">-13%</span>
                        <div class="px-2 py-1 absolute top-0 left-0 change_like_svh">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="lg:size-5 size-4">
                                    <path
                                        d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                </svg>
                            </div>
                            <div class="hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="size-5 fill-red-500">
                                    <path
                                        d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-1/2 flex flex-col gap-1 justify-start items-start">
                        <h5 class="lg:text-lg text-sm font-bold">عادت های اتمی</h5>
                        <span class="text-[#ADB4B2] max-lg:text-xs">جمیز کلیر</span>
                        <div class="flex justify-start items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                    class="size-4 fill-yellow-400">
                                    <path
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                </svg>
                            </div>
                            <span class="lg:text-xs text-[10px] text-[#ADB4B2]">5.0</span>
                        </div>
                        <div class="flex gap-1 justify-start items-center font-bold mt-2 max-lg:text-sm">
                            <span>450,000</span>
                            <span>تومان</span>
                        </div>
                        <div class="w-full py-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                    class="lg:size-4 size-3" fill="white">
                                    <path
                                        d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                        </div>
                    </div>
                </div>
       


            </div>
        </section> --}}
        <!-- maybe likly -->

        <!-- weblag -->
        {{-- <section
            class="max-w-full w-full flex justify-start lg:gap-6 sm:gap-2 gap-1 overflow-x-auto lg:px-8 md:px-6 px-3 py-5">
            <div
                class="xl:min-w-24/100 lg:min-w-32/100 sm:min-w-49/100 min-w-full xl:max-w-24/100 lg:max-w-32/100 sm:max-w-49/100 min-h-full bg-white rounded-md flex flex-col  gap-1 items-center justify-between sm:p-1 p-0.5 cart_shdow">
                <div class="w-full h-1/2 max-h-40">
                    <img src="{{ asset('storage/home/weblog1.png') }}" alt=""
                        class="object-fit w-full h-full rounded-t-2xl rounded-b-sm">
                </div>
                <div class="w-full h-5/12 flex flex-col lg:gap-3 gap-2 justify-start items-center">
                    <p class=" w-10/12 lg:text-sm sm:text-xs text-[10px] text-[#ADB4B2] text-center">کتاب و مطالعه</p>
                    <h3 class=" w-11/12 max-xl:text-sm max-lg:text-xs max-sm:text-base text-center font-bold">چطور یک
                        کتاب خوب را انتخاب کنیم</h3>


                    <span class="xl:text-xs lg:text-[11px] sm:text-[9px] text-xs text-[#ADB4B2]">18فروردین
                        1403</span>
                </div>
            </div>
        

        </section> --}}
        <!-- weblag -->
        <!-- prapery -->
        <section
            class="w-11/12  grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-center lg:py-4 sm:py-3 rounded-xl">
            <div
                class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center w-full items-center">
                    <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_normal">
                        <img src="{{ asset('storage/'.$setting['serviceImage1']) }}" class="xl:size-13 xl:min-w-13 lg:size-9 lg:min-w-9 size-12 object-cover" alt="">
                    </div>
                    <div
                        class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                        <h5 class="text-lg font-bold text-[var(--text)]">{{ $setting['serviceTitle1'] }}</h5>
                        <div
                            class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold max-lg:text-center">{{ $setting['serviceSubTitle1'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center w-full items-center">
                    <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_normal">
                        <img src="{{ asset('storage/'.$setting['serviceImage2']) }}" class="xl:size-13 xl:min-w-13 lg:size-9 lg:min-w-9 size-12 object-cover" alt="">
                    </div>
                    <div
                        class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-[var(--text)]">{{ $setting['serviceTitle2'] }}</h5>
                        <div
                            class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold max-lg:text-center">{{ $setting['serviceSubTitle2'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2 max-lg:col-span-2 max-sm:col-span-1">
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center w-full items-center">
                    <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_normal">
                        <img src="{{ asset('storage/'.$setting['serviceImage3']) }}" class="xl:size-13 xl:min-w-13 lg:size-9 lg:min-w-9 size-12 object-cover" alt="">
                    </div>
                    <div
                        class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-[var(--text)]">{{ $setting['serviceTitle3'] }}</h5>
                        <div
                            class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px]sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold max-lg:text-center">{{ $setting['serviceSubTitle3'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center w-full items-center">
                    <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_normal">
                        <img src="{{ asset('storage/'.$setting['serviceImage4']) }}" class="xl:size-13 xl:min-w-13 lg:size-9 lg:min-w-9 size-12 object-cover" alt="">
                    </div>
                    <div
                        class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-[var(--text)]">{{ $setting['serviceTitle4'] }}</h5>
                        <div
                            class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold max-lg:text-center">{{ $setting['serviceSubTitle4'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center w-full items-center">
                    <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_normal">
                        <img src="{{ asset('storage/'.$setting['serviceImage5']) }}" class="xl:size-13 xl:min-w-13 lg:size-9 lg:min-w-9 size-12 object-cover" alt="">
                    </div>
                    <div
                        class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-[var(--text)]">{{ $setting['serviceTitle5'] }}</h5>
                        <div
                            class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold max-lg:text-center">{{ $setting['serviceSubTitle5'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full flex justify-center gap-5 mt-10">
            <div
                class="w-11/12 flex items-center justify-center bg-gray-200 p-5 rounded-md lg:flex-row flex-col-reverse gap-10 lg:gap-0">
                <div class="flex flex-col lg:w-5/12 w-full gap-3">
                    <div class="flex w-full gap-1">
                        <input type="text" class="lg:w-8/12 w-10/12 bg-white rounded-md px-3 outline-none"
                            placeholder="ایمیل خود را وارد کنید">
                        <button class="p-3 bg-green-600 text-white font-bold rounded-md max-lg:text-sm">عضویت</button>
                    </div>
                </div>
                <div class="lg:w-5/12 flex items-start justify-evenly flex-row-reverse gap-5">
                    <div class="flex flex-col max-lg:text-sm ">
                        <span>یک خبر خوب برای صندوق ورودی ات</span>
                        <span>از انتخاب های , محصولات جدید و پیشنهاد ویژه با خبرشو</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-15 fill-green-600">
                        <path
                            d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z" />
                    </svg>
                </div>
            </div>
        </section>
        <!-- prapery -->



    </main>

    <footer class="w-full mt-20 flex justify-center items-start bg-white py-6">
        <section class="w-11/12 flex flex-col gap-4 justify-between items-start">
            <div class="w-full flex flex-col md:flex-row gap-5">
                <div class="w-full md:w-2/3 h-full flex flex-col sm:flex-row gap-5 justify-between items-start">
                    <!-- address -->
                    <div class="sm:w-1/2 w-full h-full flex flex-col justify-start lg:items-start items-center">

                        <img src="{{ asset('storage/' . $setting['logo']) }}" alt="" class="w-45">
                        <div class="flex flex-col gap-2 items-start text-xs lg:text-sm xl:text-md">
                            <span class="text-lg text-green-700 font-bold">{{ $setting['footerBrandName'] }}</span>
                            <p>{{ $setting['footerBrandDescription'] }}</p>
                        </div>

                    </div>
                    <!-- address -->
                    <!-- servis -->
                    <div class="sm:w-1/2 w-full h-full flex flex-col gap-3 justify-start items-start">
                        <div class="flex w-full h-full">
                            <div class="w-1/2 h-full flex flex-col gap-3 justify-start items-start">
                                <h5 class="xl:text-2xl lg:text-xl font-bold text-[var(--text)]">{{ $setting['footerServicesTitle'] }}</h5>
                                <div
                                    class="w-full flex flex-col gap-2 items-start justify-start xl:text-md lg:text-sm text-xs font-bold text-[#A4A4A5]">
                                    @foreach ($setting['footerServices'] as $service)
                                        <a href="{{ $service->url }}" class="hover:text-green-700 transition duration-300 cursor-pointer">{{ $service->title }}</a>
                                    @endforeach
                                 

                                </div>
                            </div>
                            <div class="w-1/2 h-full flex flex-col gap-3 justify-start items-start">
                                <h5 class="xl:text-2xl lg:text-xl font-bold text-[var(--text)]">{{ $setting['footerCategoriesTitle'] }}</h5>
                                <div
                                    class="w-full flex flex-col gap-1 items-start justify-start xl:text-md lg:text-sm text-xs font-bold text-[#A4A4A5]">
                                    @foreach ($setting['footerCategories'] as $category)
                                    <a href="{{ $category->url }}"
                                        class="hover:text-green-700 transition duration-300 cursor-pointer">{{ $category->title }}</a>
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
                        <h5 class="xl:text-2xl lg:text-xl font-bold">{{ $setting['footerAboutTitle'] }}</h5>
                        <div class="flex flex-col gap-2 items-start text-xs lg:text-sm xl:text-md">
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="lg:size-4 size-3 fill-green-700">
                                        <path
                                            d="M375.8 275.2c-16.4-7-35.4-2.4-46.7 11.4l-33.2 40.6c-46-26.7-84.4-65.1-111.1-111.1L225.3 183c13.8-11.3 18.5-30.3 11.4-46.7l-48-112C181.2 6.7 162.3-3.1 143.6 .9l-112 24C13.2 28.8 0 45.1 0 64v0C0 295.2 175.2 485.6 400.1 509.5c9.8 1 19.6 1.8 29.6 2.2c0 0 0 0 0 0c0 0 .1 0 .1 0c6.1 .2 12.1 .4 18.2 .4l0 0c18.9 0 35.2-13.2 39.1-31.6l24-112c4-18.7-5.8-37.6-23.4-45.1l-112-48zM441.5 464C225.8 460.5 51.5 286.2 48.1 70.5l99.2-21.3 43 100.4L154.4 179c-18.2 14.9-22.9 40.8-11.1 61.2c30.9 53.3 75.3 97.7 128.6 128.6c20.4 11.8 46.3 7.1 61.2-11.1l29.4-35.9 100.4 43L441.5 464zM48 64v0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0s0 0 0 0">
                                        </path>
                                    </svg>
                                </div>
                                <span class="font-bold">{{ $setting['footerPhone'] }}</span>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"
                                        class="lg:size-4 size-3 fill-green-700">
                                        <path
                                            d="M1664 1504v-768q-32 36-69 66-268 206-426 338-51 43-83 67t-86.5 48.5-102.5 24.5h-2q-48 0-102.5-24.5t-86.5-48.5-83-67q-158-132-426-338-37-30-69-66v768q0 13 9.5 22.5t22.5 9.5h1472q13 0 22.5-9.5t9.5-22.5zm0-1051v-24.5l-.5-13-3-12.5-5.5-9-9-7.5-14-2.5h-1472q-13 0-22.5 9.5t-9.5 22.5q0 168 147 284 193 152 401 317 6 5 35 29.5t46 37.5 44.5 31.5 50.5 27.5 43 9h2q20 0 43-9t50.5-27.5 44.5-31.5 46-37.5 35-29.5q208-165 401-317 54-43 100.5-115.5t46.5-131.5zm128-37v1088q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-1088q0-66 47-113t113-47h1472q66 0 113 47t47 113z">
                                        </path>
                                    </svg>
                                </div>
                                <span class=" font-bold">{{ $setting['footerEmail'] }}</span>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                        class="lg:size-4 size-3 fill-green-700">
                                        <path
                                            d="M336 192c0-79.5-64.5-144-144-144S48 112.5 48 192c0 16.3 7.7 42 24.7 75.4c16.4 32.2 38.8 66.4 62.1 98.3c20.3 27.9 40.7 53.3 57.2 73.1c16.5-19.8 36.9-45.2 57.2-73.1c23.2-31.9 45.6-66.2 62.1-98.3C328.3 234 336 208.3 336 192zm48 0c0 83.1-105.6 219-160.2 283.6C204.8 498.1 192 512 192 512s-12.8-13.9-31.8-36.4C105.6 411 0 275.1 0 192C0 86 86 0 192 0S384 86 384 192zm-160 0a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm-112 0a80 80 0 1 1 160 0 80 80 0 1 1 -160 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class=" font-bold">{{ $setting['footerAddress'] }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- social_network_svg -->
                    <div class="w-full py-6 flex items-center justify-center gap-10">
                        <a href="{{ $setting['footerInstagram'] }}"
                            class="p-2 rounded-full bg-[var(--background)] border border-green-700 flex justify-center items-center cursor-pointer scale transition_normal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="sm:size-4 size-4 fill-green-700">
                                <path
                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                </path>
                            </svg>
                        </a>
                        <a href="{{ $setting['footerTelegram'] }}"
                            class="p-2 rounded-full bg-[var(--background)] border border-green-700 flex justify-center items-center cursor-pointer scale transition_normal">
                            <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"
                                class="sm:size-4 size-4 fill-green-700">
                                <path
                                    d="M1764 11q33 24 27 64l-256 1536q-5 29-32 45-14 8-31 8-11 0-24-5l-527-215-298 327q-18 21-47 21-14 0-23-4-19-7-30-23.5t-11-36.5v-452l-472-193q-37-14-40-55-3-39 32-59l1664-960q35-21 68 2zm-342 1499l221-1323-1434 827 336 137 863-639-478 797z">
                                </path>
                            </svg>
                        </a>
                        <a href="{{ $setting['footerEmailSocial'] }}"
                            class="p-2 rounded-full bg-[var(--background)] border border-green-700 flex justify-center items-center cursor-pointer scale transition_normal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="sm:size-4 size-4 fill-green-700">
                                <path
                                    d="M464 258.2c0 2.7-1 5.2-4.2 8c-3.8 3.1-10.1 5.8-17.8 5.8H344c-53 0-96 43-96 96c0 6.8 .7 13.4 2.1 19.8c3.3 15.7 10.2 31.1 14.4 40.6l0 0c.7 1.6 1.4 3 1.9 4.3c5 11.5 5.6 15.4 5.6 17.1c0 5.3-1.9 9.5-3.8 11.8c-.9 1.1-1.6 1.6-2 1.8c-.3 .2-.8 .3-1.6 .4c-2.9 .1-5.7 .2-8.6 .2C141.1 464 48 370.9 48 256S141.1 48 256 48s208 93.1 208 208c0 .7 0 1.4 0 2.2zm48 .5c0-.9 0-1.8 0-2.7C512 114.6 397.4 0 256 0S0 114.6 0 256S114.6 512 256 512c3.5 0 7.1-.1 10.6-.2c31.8-1.3 53.4-30.1 53.4-62c0-14.5-6.1-28.3-12.1-42c-4.3-9.8-8.7-19.7-10.8-29.9c-.7-3.2-1-6.5-1-9.9c0-26.5 21.5-48 48-48h97.9c36.5 0 69.7-24.8 70.1-61.3zM160 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-64a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm128-64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm64 64a32 32 0 1 0 0-64 32 32 0 1 0 0 64z">
                                </path>
                            </svg>
                        </a>
                        <a href="{{ $setting['footerCopyright'] }}"
                            class="p-2 rounded-full bg-[var(--background)] border border-green-700 flex justify-center items-center cursor-pointer scale transition_normal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="sm:size-4 size-4 fill-green-700">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <!-- social_network_svg -->
                </div>
                <!-- news -->
            </div>
            <div class="mx-auto flex flex-col gap-1 items-center justify-center">
                <p class="xl:text-[15px] lg:text-[12px] text-[13px]">{{ $setting['footerDesignerText'] }}</p>
                <span class="text-[17px] font-bold text-green-700">{{ $setting['footerDesignerPhone'] }}</span>
            </div>
        </section>
    </footer>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
