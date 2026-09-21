<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <style>
        .chosenItem:hover img {
            transform: scale(1.1);
        }

        .borderGradient {
            background: rgb(180, 115, 187);
            background: linear-gradient(90deg, rgba(180, 115, 187, 1) 50%, rgba(255, 255, 255, 1) 100%);
        }
    </style>
    <title>tabaBook</title>
</head>

<body>

    <div class="w-full bg-[#f2f2f2] md:bg-white">
        <!-- header -->

        <section class="2xl:container m-auto">
            <!-- top banner -->
            <img src="{{ asset('img/top-banner.png') }}" class="w-full h-20 object-cover">
            <!-- top banner -->

            <div class="bg-[#f2f2f2] py-6">
                <div class="w-11/12 m-auto flex flex-col lg:flex-row justify-between items-center">
                    <div class="w-full lg:w-8/12 flex flex-row justify-between lg:justify-start items-center">
                        <button onclick="hamburgerMenu()"
                            class="w-6 lg:hidden h-4 flex flex-col justify-between items-start">
                            <span class="w-full h-0.5 rounded-sm bg-slate-600"></span>
                            <span class="w-10/12 h-0.5 rounded-sm bg-slate-600"></span>
                            <span class="w-full h-0.5 rounded-sm bg-slate-600"></span>
                        </button>
                        <div class="ml-4">
                            <a href="#">
                                <img src="{{ asset('img/logo.png') }}" alt="">
                            </a>
                        </div>
                        <ul class="hidden lg:flex flex-row justify-start items-center">
                            <li class="mx-3">
                                <a href="#" class="transition-all duration-300 font-bold hover:text-[#B473BB]">
                                    کتاب های صوتی
                                </a>
                            </li>
                            <li class="mx-3">
                                <a href="#" class="transition-all duration-300 font-bold hover:text-[#B473BB]">
                                    کتاب رایگان
                                </a>
                            </li>
                            <li class="mx-3">
                                <a href="#" class="transition-all duration-300 font-bold hover:text-[#B473BB]">
                                    پر فروش های ماه
                                </a>
                            </li>
                            <li class="mx-3">
                                <a href="#" class="transition-all duration-300 font-bold hover:text-[#B473BB]">
                                    کتاب های برگزیده
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="w-4/12 hidden lg:flex items-center justify-end gap-5">
                        
                            {{-- <input type="text" class="w-full outline-none rounded-md py-3 pl-2 pr-10 text-xs bg-white"
                                placeholder="جست و جو">
                            <svg class="absolute w-6 top-[20%] right-[3%]" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path
                                    d="M400 208A192 192 0 1 0 16 208a192 192 0 1 0 384 0zM349.3 360.6C312.2 395 262.6 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 54.6-21 104.2-55.4 141.3l149 149c3.1 3.1 3.1 8.2 0 11.3s-8.2 3.1-11.3 0l-149-149z" />
                            </svg> --}}
                            <a href="{{ route('search.page') }}">
                                <svg class="w-[30px] h-[30px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        
                            <a @if(!Auth::check()) href="{{ route('login') }}" @else href="{{ route('user.profile') }}" @endif>
                                <svg class="w-[30px] h-[30px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                            </a>
                        
                    </div>
                    <div class="w-full relative lg:hidden block mt-5">
                        <input type="text" class="w-full outline-none rounded-md py-2 md:py-4 pl-2 pr-10 md:pr-20"
                            placeholder="جست و جو">
                        <svg class="absolute w-5 md:w-8 top-[20%] right-[3%]" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path
                                d="M400 208A192 192 0 1 0 16 208a192 192 0 1 0 384 0zM349.3 360.6C312.2 395 262.6 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 54.6-21 104.2-55.4 141.3l149 149c3.1 3.1 3.1 8.2 0 11.3s-8.2 3.1-11.3 0l-149-149z" />
                        </svg>
                    </div>
                </div>
                <div class="w-full h-svh flex flex-row lg:hidden bg-black bg-opacity-50 absolute top-0 -right-full transition-all duration-500"
                    id="hamburgerMenu">
                    <div class="w-9/12 h-full bg-black p-4">
                        <div>
                            <a href="#">
                                <img src="{{ asset('img/logo.png') }}" alt="">
                            </a>
                        </div>
                        <ul class="mt-8 grid grid-cols-1 gap-6">
                            <li class="flex flex-row justify-between items-center">
                                <a href="#" class="font-bold text-white text-xs">کتاب های صوتی</a>
                                <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="#fff"
                                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                </svg>
                            </li>
                            <li class="flex flex-row justify-between items-center">
                                <a href="#" class="font-bold text-white text-xs">کتاب های رایگان</a>
                                <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="#fff"
                                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                </svg>
                            </li>
                            <li class="flex flex-row justify-between items-center">
                                <a href="#" class="font-bold text-white text-xs">پرفروش های ماه</a>
                                <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="#fff"
                                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                </svg>
                            </li>
                            <li class="flex flex-row justify-between items-center">
                                <a href="#" class="font-bold text-white text-xs">کتاب های برگزیده</a>
                                <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="#fff"
                                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                </svg>
                            </li>
                            <li class="flex flex-row justify-between items-center">
                                <a href="#" class="font-bold text-[#DA3638]">تخفیف های شگفت انگیز</a>
                            </li>
                        </ul>
                    </div>
                    <div onclick="removeHamburgerMenu()" class="w-3/12 h-full"></div>
                </div>
            </div>

        </section>

        <!-- header -->

        <!-- sub header -->

        <section class="2xl:container mx-auto my-10">
            <div class="w-11/12 md:h-[310px] lg:h-[380px] xl:h-[493px] m-auto flex flex-col-reverse md:flex-row items-start">
                <div class="w-full md:w-5/12 h-full">
                    <div class="w-full h-2/6 bg-[#BEB1D6] md:rounded-l-none rounded-2xl md:rounded-r-[32px] lg:rounded-r-[45px] p-3 lg:p-5 xl:p-9">
                        <div class="w-full h-full md:rounded-[21px] rounded-xl lg:rounded-[27px] bg-white p-3 flex flex-col justify-between">
                            <h1 class="text-base lg:text-xl">هدف حقیقی کتاب ها چیست؟</h1>
                            <span class="mr-4 mt-2 md:mt-0">انیس کنج تنهایی کتاب..!</span>
                        </div>
                    </div>
                    <div class="w-full h-1/6 bg-[#BEB1D6] mt-3 md:mt-0 rounded-t-2xl md:rounded-t-none">
                        <div class="w-full md:rounded-tl-[32px] rounded-t-2xl lg:rounded-tl-[45px] md:rounded-tr-none px-3 md:px-0 md:pl-3 h-full bg-white lg:py-2 py-3 pl-3 xl:py-4 lg:pl-4">
                            <div
                                class="bg-[#BEB1D6] bg-opacity-40 text-[10px] lg:text-base p-2 lg:p-3 xl:p-6 rounded-tl-[32px] rounded-bl-[17px] rounded-r-[17px]">
                                چگونه کتابخوان شویم و کتابخوان باقی بمانیم؟
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-2/6 bg-[#fff] pl-4 pr-4 md:pr-0 pt-3 xl:pt-4">
                        <p class="leading-7 text-sm h-full overflow-hidden xl:text-base">
                            در پاسخ به این سوال که چرا کتاب خواندن مفید است و اهمیت کتاب خواندن در چیست
                            باید بگوییم که کتاب قرار است به بهبود کیفیت زندگی ما کمک کند. بهتر است به ان به چشم یک کالای
                            لوکس نگاه نکنید، کالایی که هیچوقت هم پولی برای خریدنش ندارید!
                            همه کتاب های نوشته شده،پتانسیل بهبود کیفیت زندگی شمارا ندارند.مخم است که بدانیم چه کتابی
                            بخوانیم.
                        </p>
                        <a href="#" class="mr-3 text-sm text-gray-500 xl:hidden">...بیشتر</a>
                    </div>
                </div>
                <div class="w-full md:w-8/12 h-[200px] mb-3 md:rounded-tr-none md:mb-0 md:h-full rounded-2xl bg-[#BEB1D6] md:rounded-l-[32px] md:rounded-br-[32px] lg:rounded-l-[45px] lg:rounded-br-[45px] p-3 lg:p-5 xl:p-9">
                    <a href="#" class="inline-block w-full h-full">
                        <img src="{{ asset('img/IMG_20240916_131037_356.jpg') }}"
                            class="w-full h-full object-cover md:rounded-l-[25px] rounded-xl md:rounded-br-[25px] lg:rounded-l-[38px] lg:rounded-br-[38px] md:rounded-tr-lg" alt="">
                    </a>
                </div>
            </div>
        </section>

        <!-- sub header -->

        <!-- banner -->

        <section class="2xl:container m-auto">
            <div class="w-11/12 m-auto">
                <img src="{{ asset('img/banner1.png') }}" class="w-full" alt="">
            </div>
        </section>

        <!-- banner -->

        <!-- chosen -->


        <section class="2xl:container m-auto">
            <div class="md:bg-[#FFDDE3]">
                <div class="w-full md:h-8 lg:h-20 bg-white rounded-b-[100%]"></div>
                <div class="w-11/12 m-auto md:py-10 pt-10 pb-5">
                    <div class="w-full border-b border-[#D2D2D2] pb-3 mb-12 lg:mb-16 relative">
                        <h2
                            class="absolute -bottom-[17px] pl-2 md:pl-0 bg-[#f2f2f2] md:bg-inherit md:text-[42px] lg:text-[52px] md:static">
                            برگزیده</h2>
                    </div>
                    <div class="grid xl:grid-cols-4 grid-cols-2 md:grid-cols-3 gap-3 md:gap-6">



                        <div class="w-full bg-white rounded-lg">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/8117448608719503.jpg') }}"
                                            class="w-full h-[117px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-[#6E3075] text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            آدم های معمولی دنیا را تغییر میدهند ..!
                                        </h2>
                                    </a>
                                    <div class="flex flex-col text-xs md:text-base lg:text-lg mb-4">
                                        <span>اپرا وینفری</span>
                                        <span>مترجم : شبنم حیدری پور</span>
                                    </div>
                                    <div class="borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5"></div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pr-[6px] md:pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-[7px] md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-[7px] md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>

                        <div class="w-full bg-white rounded-lg">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/download (8).jfif') }}"
                                            class="w-full h-[117px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-[#6E3075] text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            پارسا و کاپشن جادویی..!
                                        </h2>
                                    </a>
                                    <div class="flex flex-col text-xs md:text-base lg:text-lg mb-4">
                                        <span>سایه گستر</span>
                                        <span>ناشر : سایه گستر</span>
                                    </div>
                                    <div class="borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5"></div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pr-[6px] md:pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-[7px] md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-[7px] md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>

                        <div class="w-full bg-white rounded-lg">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/1535812623054466.jpg') }}"
                                            class="w-full h-[117px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-[#6E3075] text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            هنر سرسختی و تسلیم نشدن..!
                                        </h2>
                                    </a>
                                    <div class="flex flex-col text-xs md:text-base lg:text-lg mb-4">
                                        <span>تاد کاشدن</span>
                                        <span>ناشر : نشر هورمزد</span>
                                    </div>
                                    <div class="borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5"></div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pr-[6px] md:pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-[7px] md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-[7px] md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>

                        <div class="w-full bg-white rounded-lg">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/317717 1.png') }}"
                                            class="w-full h-[117px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-[#6E3075] text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            سفر به انتهای دنیا..!
                                        </h2>
                                    </a>
                                    <div class="flex flex-col text-xs md:text-base lg:text-lg mb-4">
                                        <span>سلفون</span>
                                        <span>مترجم : آرزو ویشکا</span>
                                    </div>
                                    <div class="borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5"></div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pr-[6px] md:pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-[7px] md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-[7px] md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>

                        <div class="w-full bg-white rounded-lg">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/8117448608719503.jpg') }}"
                                            class="w-full h-[117px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-[#6E3075] text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            آدم های معمولی دنیا را تغییر میدهند ..!
                                        </h2>
                                    </a>
                                    <div class="flex flex-col text-xs md:text-base lg:text-lg mb-4">
                                        <span>اپرا وینفری</span>
                                        <span>مترجم : شبنم حیدری پور</span>
                                    </div>
                                    <div class="borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5"></div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pr-[6px] md:pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-[7px] md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-[7px] md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>

                        <div class="w-full bg-white rounded-lg">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/download (8).jfif') }}"
                                            class="w-full h-[117px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-[#6E3075] text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            پارسا و کاپشن جادویی..!
                                        </h2>
                                    </a>
                                    <div class="flex flex-col text-xs md:text-base lg:text-lg mb-4">
                                        <span>سایه گستر</span>
                                        <span>ناشر : سایه گستر</span>
                                    </div>
                                    <div class="borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5"></div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pr-[6px] md:pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-[7px] md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-[7px] md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>

                        <div class="w-full bg-white rounded-lg">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/1535812623054466.jpg') }}"
                                            class="w-full h-[117px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-[#6E3075] text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            هنر سرسختی و تسلیم نشدن..!
                                        </h2>
                                    </a>
                                    <div class="flex flex-col text-xs md:text-base lg:text-lg mb-4">
                                        <span>تاد کاشدن</span>
                                        <span>ناشر : نشر هورمزد</span>
                                    </div>
                                    <div class="borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5"></div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pr-[6px] md:pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-[7px] md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-[7px] md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>

                        <div class="w-full bg-white rounded-lg">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/317717 1.png') }}"
                                            class="w-full h-[117px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-[#6E3075] text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            سفر به انتهای دنیا..!
                                        </h2>
                                    </a>
                                    <div class="flex flex-col text-xs md:text-base lg:text-lg mb-4">
                                        <span>سلفون</span>
                                        <span>مترجم : آرزو ویشکا</span>
                                    </div>
                                    <div class="borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5"></div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pr-[6px] md:pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-[7px] md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-[7px] md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>








                    </div>
                </div>
            </div>
            <div class="md:h-8 lg:h-12 bg-[#FFDDE3] rounded-b-[100%]"></div>

        </section>


        <!-- chosen -->


        <!-- website news -->

        <section class="2xl:container m-auto bg-white">
            <div class="w-11/12 m-auto py-6 md:py-0 md:mt-20">
                <div class="w-full flex flex-row justify-start items-center">
                    <svg class="w-5 h-5 md:w-8 md:h-8 ml-3 md:ml-5" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path fill="#ff1098"
                            d="M168 80c-13.3 0-24 10.7-24 24V408c0 8.4-1.4 16.5-4.1 24H440c13.3 0 24-10.7 24-24V104c0-13.3-10.7-24-24-24H168zM72 480c-39.8 0-72-32.2-72-72V112C0 98.7 10.7 88 24 88s24 10.7 24 24V408c0 13.3 10.7 24 24 24s24-10.7 24-24V104c0-39.8 32.2-72 72-72H440c39.8 0 72 32.2 72 72V408c0 39.8-32.2 72-72 72H72zM176 136c0-13.3 10.7-24 24-24h96c13.3 0 24 10.7 24 24v80c0 13.3-10.7 24-24 24H200c-13.3 0-24-10.7-24-24V136zm200-24h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H376c-13.3 0-24-10.7-24-24s10.7-24 24-24zm0 80h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H376c-13.3 0-24-10.7-24-24s10.7-24 24-24zM200 272H408c13.3 0 24 10.7 24 24s-10.7 24-24 24H200c-13.3 0-24-10.7-24-24s10.7-24 24-24zm0 80H408c13.3 0 24 10.7 24 24s-10.7 24-24 24H200c-13.3 0-24-10.7-24-24s10.7-24 24-24z" />
                    </svg>
                    <h2 class="text-base md:text-xl">چه‌خبر؟</h2>
                </div>
                <div class="w-full flex flex-col md:flex-row items-center mt-4">
                    <div
                        class="w-full h-40 md:w-1/3 rounded-lg md:h-[300px] lg:h-[412px] p-3 md:p-4 lg:p-5 bg-[#FAF0F8]">
                        <h3 class="text-base md:text-[1.17em] mb-3 md:mb-8">
                            سایت کتابخوانی
                        </h3>
                        <div class="lg:mb-6 xl:mb-10 leading-7">
                            <p class="text-xs md:text-sm lg:text-base">
                                کتاب، مونس و غمخوار اوقات حزن و خستگی است که غم و اندوه را به سرور و شادمانی تبدیل
                                می‌کند؛
                                رنج و غم را از آینه‌ی خاطر زدوده و گنجینه‌ی ذهن را پر از گوهرهای گرانبها می‌کند.
                            </p>
                            <a href="#" class="lg:hidden inline-block text-[#727272]">...بیشتر</a>
                            <p class="hidden lg:block">
                                مطالعه، یگانه راهی است برای آشنایی و گفتگو با بزرگان روزگار که قرن‌ها پیش در دنیا به سر
                                برده
                                و اکنون در زیر خاک منزل دارند.
                                <a href="#" class="xl:hidden inline-block text-[#727272] mr-2">...بیشتر</a>
                            </p>
                            <p class="hidden xl:block">
                                چیزهایی که به دنبال آن می‌گردی،‌ همه در همین دنیاست! اما تنها راهی که آدمیزاد بتواند نود
                                و
                                نه درصد آن‌ها را ببیند، در کتاب است.
                            </p>
                        </div>
                        <div
                            class="flex md:flex-col xl:flex-row justify-start items-start xl:items-center mt-3 md:mt-2 lg:mt-0">
                            <a href="#"
                                class="text-xs text-[#ff1098] pl-2 relative xl:after:absolute xl:after:w-px xl:after:h-[14px] xl:after:bg-[#727272] xl:after:left-0 xl:after:top-0 md:mb-1 xl:mb-0">نویسنده
                                سایت کتابخوانی</a>
                            <span
                                class="xl:mr-2 text-xs text-[#727272] pl-2 relative xl:after:absolute xl:after:w-px xl:after:h-[14px] xl:after:bg-[#727272] xl:after:left-0 xl:after:top-0 md:mb-1 xl:mb-0">20
                                ساعت قبل</span>
                            <span class="text-xs text-[#727272] xl:mr-2">1505 بازدید</span>
                        </div>
                    </div>
                    <div
                        class="w-full h-40 md:w-2/3 md:mr-5 lg:mr-7 md:h-[300px] lg:h-[412px] rounded-lg relative mt-4 md:mt-0">
                        <img src="{{ asset('img/a7ea116f27d5d0d5a4e37c3f8400c638.jpg') }}"
                            class="w-full h-full rounded-lg object-cover" alt="">
                        <svg class="absolute md:w-20 w-16 md:h-20 h-16 rotate-180 top-[30%] right-[38%] md:inset-[40%] lg:inset-[42%] xl:inset-[45%]"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <path class="fa-secondary"
                                d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                            <path class="fa-primary" fill="#fff"
                                d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />
                        </svg>
                    </div>
                </div>


                <div class="hidden md:grid grid-cols-6 md:gap-3 lg:gap-5 xl:gap-10 md:mt-4 lg:mt-8">


                    <div class="w-full relative rounded-md">
                        <a href="#">
                            <img src="{{ asset('img/images (2).jfif') }}"
                                class="w-full md:h-20 lg:h-24 xl:h-28 rounded-md object-cover" alt="">
                            <svg class="absolute md:w-10 md:h-10 lg:w-14 lg:h-14 rotate-180 md:top-[17%] xl:top-[20%] right-[32%]"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <defs>
                                    <style>
                                        .fa-secondary {
                                            opacity: .4
                                        }
                                    </style>
                                </defs>
                                <path class="fa-secondary"
                                    d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                                <path class="fa-primary" fill="#fff"
                                    d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />
                            </svg>
                            <span href="#"
                                class="inline-block mt-2.5 md:text-[10px] lg:text-sm font-bold transition-all duration-300 hover:text-[#B473BB]">
                                ویدیو هفته کتاب خوانی
                            </span>
                        </a>
                    </div>


                    <div class="w-full relative rounded-md">
                        <a href="#">
                            <img src="{{ asset('img/download (1).jfif') }}"
                                class="w-full md:h-20 lg:h-24 xl:h-28 rounded-md object-cover" alt="">
                            <svg class="absolute md:w-10 md:h-10 lg:w-14 lg:h-14 rotate-180 md:top-[17%] xl:top-[20%] right-[32%]"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <defs>
                                    <style>
                                        .fa-secondary {
                                            opacity: .4
                                        }
                                    </style>
                                </defs>
                                <path class="fa-secondary"
                                    d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                                <path class="fa-primary" fill="#fff"
                                    d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />
                            </svg>
                            <span href="#"
                                class="inline-block mt-2.5 md:text-[10px] lg:text-sm font-bold transition-all duration-300 hover:text-[#B473BB]">
                                ویدیوی آموزشی
                            </span>
                        </a>
                    </div>


                    <div class="w-full relative rounded-md">
                        <a href="#">
                            <img src="{{ asset('img/images.jfif') }}" class="w-full md:h-20 lg:h-24 xl:h-28 rounded-md object-cover"
                                alt="">
                            <svg class="absolute md:w-10 md:h-10 lg:w-14 lg:h-14 rotate-180 md:top-[17%] xl:top-[20%] right-[32%]"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <defs>
                                    <style>
                                        .fa-secondary {
                                            opacity: .4
                                        }
                                    </style>
                                </defs>
                                <path class="fa-secondary"
                                    d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                                <path class="fa-primary" fill="#fff"
                                    d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />
                            </svg>
                            <span href="#"
                                class="inline-block mt-2.5 md:text-[10px] lg:text-sm font-bold transition-all duration-300 hover:text-[#B473BB]">
                                آموزش زبان انگلیسی
                            </span>
                        </a>
                    </div>


                    <div class="w-full relative rounded-md">
                        <a href="#">
                            <img src="{{ asset('img/download (7).jfif') }}"
                                class="w-full md:h-20 lg:h-24 xl:h-28 rounded-md object-cover" alt="">
                            <svg class="absolute md:w-10 md:h-10 lg:w-14 lg:h-14 rotate-180 md:top-[17%] xl:top-[20%] right-[32%]"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <defs>
                                    <style>
                                        .fa-secondary {
                                            opacity: .4
                                        }
                                    </style>
                                </defs>
                                <path class="fa-secondary"
                                    d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                                <path class="fa-primary" fill="#fff"
                                    d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />
                            </svg>
                            <span href="#"
                                class="inline-block mt-2.5 md:text-[10px] lg:text-sm font-bold transition-all duration-300 hover:text-[#B473BB]">
                                رها کردن طریقت تسلیم
                            </span>
                        </a>
                    </div>


                    <div class="w-full relative rounded-md">
                        <a href="#">
                            <img src="{{ asset('img/images (1).jfif') }}"
                                class="w-full md:h-20 lg:h-24 xl:h-28 rounded-md object-cover" alt="">
                            <svg class="absolute md:w-10 md:h-10 lg:w-14 lg:h-14 rotate-180 md:top-[17%] xl:top-[20%] right-[32%]"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <defs>
                                    <style>
                                        .fa-secondary {
                                            opacity: .4
                                        }
                                    </style>
                                </defs>
                                <path class="fa-secondary"
                                    d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                                <path class="fa-primary" fill="#fff"
                                    d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />
                            </svg>
                            <span href="#"
                                class="inline-block mt-2.5 md:text-[10px] lg:text-sm font-bold transition-all duration-300 hover:text-[#B473BB]">
                                آموزش آشپزی
                            </span>
                        </a>
                    </div>


                    <div class="w-full relative rounded-md">
                        <a href="#">
                            <img src="{{ asset('img/images (3).jfif') }}"
                                class="w-full md:h-20 lg:h-24 xl:h-28 rounded-md object-cover" alt="">
                            <svg class="absolute md:w-10 md:h-10 lg:w-14 lg:h-14 rotate-180 md:top-[17%] xl:top-[20%] right-[32%]"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <defs>
                                    <style>
                                        .fa-secondary {
                                            opacity: .4
                                        }
                                    </style>
                                </defs>
                                <path class="fa-secondary"
                                    d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                                <path class="fa-primary" fill="#fff"
                                    d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />
                            </svg>
                            <span href="#"
                                class="inline-block mt-2.5 md:text-[10px] lg:text-sm font-bold transition-all duration-300 hover:text-[#B473BB]">
                                ویدیو علمی
                            </span>
                        </a>
                    </div>


                </div>

                <div class="md:hidden mt-4">
                    <div class="h-24 flex flex-row items-center">
                        <div class="w-[11%] rounded-lg h-24 bg-[#FFDBE6]"></div>
                        <div class="w-[89%] mr-1.5 rounded-lg h-24 bg-[#FFDBE6] p-2 relative">
                            <a href="#" class="w-full flex flex-row items-center">
                                <img src="{{ asset('img/db45b6492571406bb0336aa19a2b0d3f.jpg') }}"
                                    class="w-1/3 h-20 object-cover rounded-lg" alt="">
                                <h4 class="mr-2 text-xs">
                                    دهه شصتی ها پیشتاز تالیف در حوزه کودک و نوجوان
                                </h4>
                            </a>
                            <a href="#"
                                class="absolute w-14 pt-2 pb-[7px] rounded-b-lg -right-11 top-[32%] rotate-[270deg] text-white text-center text-xs bg-[#B473BB]">
                                بیشتر
                            </a>
                        </div>
                    </div>

                    <div class="h-24 flex flex-row items-center mt-2">
                        <div class="w-[11%] rounded-lg h-24 bg-[#FFDBE6]"></div>
                        <div class="w-[89%] mr-1.5 rounded-lg h-24 bg-[#FFDBE6] p-2 relative">
                            <a href="#" class="w-full flex flex-row items-center">
                                <img src="{{ asset('img/4cb69059405d4fb7aa6fc3b093de8cc2.jpg') }}"
                                    class="w-1/3 h-20 object-cover rounded-lg" alt="">
                                <h4 class="mr-2 text-xs">
                                    بازار کتاب و رونق کسب و کار های کتابی
                                </h4>
                            </a>
                            <a href="#"
                                class="absolute w-14 pt-2 pb-[7px] rounded-b-lg -right-11 top-[32%] rotate-[270deg] text-white text-center text-xs bg-[#B473BB]">
                                بیشتر
                            </a>
                        </div>
                    </div>

                    <div class="h-24 flex flex-row items-center mt-2">
                        <div class="w-[11%] rounded-lg h-24 bg-[#FFDBE6]"></div>
                        <div class="w-[89%] mr-1.5 rounded-lg h-24 bg-[#FFDBE6] p-2 relative">
                            <a href="#" class="w-full flex flex-row items-center">
                                <img src="{{ asset('img/mark-twain-chitext-300x200.gif') }}"
                                    class="w-1/3 h-20 object-cover rounded-lg" alt="">
                                <h4 class="mr-2 text-xs">
                                    جملات کوتاه از مارتین تواین( 140 نقل قول )
                                </h4>
                            </a>
                            <a href="#"
                                class="absolute w-14 pt-2 pb-[7px] rounded-b-lg -right-11 top-[32%] rotate-[270deg] text-white text-center text-xs bg-[#B473BB]">
                                بیشتر
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- website news -->


        <!-- image item -->

        <section class="2xl:container m-auto py-6 md:py-0 md:mt-10 xl:mt-20">
            <div class="w-full h-5 md:h-8 lg:h-12 bg-[#FFDDE3] rounded-t-[100%]"></div>
            <div class="bg-[#FFDDE3]">
                <div class="w-11/12 m-auto grid grid-cols-3 lg:grid-cols-6 gap-4 md:gap-10 lg:gap-20">
                    <a href="#" class="inline-block w-full rounded-lg">
                        <img src="{{ asset('img/0009892_-_200 1.png') }}" class="w-full rounded-lg h-[100px] lg:h-[200px]" alt="">
                    </a>
                    <a href="#" class="inline-block w-full rounded-lg">
                        <img src="{{ asset('img/0009887_-_200 1.png') }}" class="w-full rounded-lg h-[100px] lg:h-[200px]" alt="">
                    </a>
                    <a href="#" class="inline-block w-full rounded-lg">
                        <img src="{{ asset('img/0009609_-_200 1.png') }}" class="w-full rounded-lg h-[100px] lg:h-[200px]" alt="">
                    </a>
                    <a href="#" class="inline-block w-full rounded-lg">
                        <img src="{{ asset('img/0009614_-_200 1.png') }}" class="w-full rounded-lg h-[100px] lg:h-[200px]" alt="">
                    </a>
                    <a href="#" class="inline-block w-full rounded-lg">
                        <img src="{{ asset('img/0010068_-_200 1.png') }}" class="w-full rounded-lg h-[100px] lg:h-[200px]" alt="">
                    </a>
                    <a href="#" class="inline-block w-full rounded-lg">
                        <img src="{{ asset('img/0010086_-_200 1.png') }}" class="w-full rounded-lg h-[100px] lg:h-[200px]" alt="">
                    </a>
                </div>
            </div>
            <div class="h-5 md:h-8 lg:h-12 bg-[#FFDDE3] rounded-b-[100%]"></div>
        </section>

        <!-- image item -->


        <!-- big without title image -->

        <section class="2xl:container m-auto py-6 md:py-0 md:mt-10">
            <div class="w-11/12 m-auto xl:py-10">
                <div class="w-full border-b border-[#D2D2D2] pb-3 mb-8 lg:mb-16 relative">
                    <h2
                        class="absolute -bottom-[17px] pl-2 md:pl-0 bg-[#f2f2f2] md:bg-inherit md:text-[42px] lg:text-[52px] md:static">
                    بنر تبلیغاتی    
                    </h2>
                </div>
                <div>
                    <a href="#">
                        <img src="{{ asset('img/0001013 1.png') }}" class="w-full h-28 md:h-48 lg:h-56 xl:h-[474px] object-cover"
                            alt="">
                    </a>
                </div>
            </div>
        </section>

        <!-- big without title image -->


        <!-- new text paragraph -->

        <section class="2xl:container m-auto">

            <div class="w-full md:h-8 lg:h-12 bg-[#FFDDE3] rounded-t-[100%] md:mt-10 lg:mt-20"></div>
            <div class="w-full md:bg-[#FFDDE3]">
                <div class="w-11/12 m-auto pb-5">
                    <div class="w-full border-b border-[#D2D2D2] pb-3 mb-12 lg:mb-16 relative">
                        <h2
                            class="absolute -bottom-[17px] pl-2 md:pl-0 bg-[#f2f2f2] md:bg-inherit md:text-[42px] lg:text-[52px] md:static">
                            تازه های متنی</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4 lg:gap-6">



                        <div class="w-full bg-white rounded-lg flex flex-col justify-between">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/download (3).jfif') }}"
                                            class="w-full h-[242px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            کتاب نیه توچکا نیزوانوا
                                        </h2>
                                    </a>
                                    <p class="flex flex-col h-[72px] text-xs md:text-base mb-4 overflow-hidden">
                                        کتاب نیه توچکا رمان ناتمام فئودور داستایوفسکی‌ است که به شکل یک اعتراف
                                        نگاشته شده و در پس زمینه به مضمون کودکی و بزرگسالی می‌پردازد.
                                    </p>
                                    <div class="md:hidden borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pb-2 md:pb-0 pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-xs md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-xs md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>


                        <div class="w-full bg-white rounded-lg flex flex-col justify-between">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/ketabkhoob 1.png') }}"
                                            class="w-full h-[242px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            کتاب قلعه حیوانات
                                        </h2>
                                    </a>
                                    <p class="flex flex-col h-[72px] text-xs md:text-base mb-4 overflow-hidden">
                                        نمی‌توانستند تشخیص دهند که کدام‌یک حیوان است و کدام‌یک انسان! دیگر ممکن نبود
                                        که یکی را از دیگری تمیز دهند. آدم‌ها شبیه خوک‌ها بودند و خوک‌ها شبیه آدم‌ها!
                                    </p>
                                    <div class="md:hidden borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pb-2 md:pb-0 pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-xs md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-xs md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>


                        <div class="w-full bg-white rounded-lg flex flex-col justify-between">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/شازده-کوچولو-768x432 1.png') }}"
                                            class="w-full h-[242px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            کتاب شازده کوچولو
                                        </h2>
                                    </a>
                                    <p class="flex flex-col h-[72px] text-xs md:text-base mb-4 overflow-hidden">
                                        شازده کوچولو پرسید: کی اوضاع بهتر میشه؟روباه گفت: از وقتی که بفهمی همه چیز
                                        به خودت بستگی داره
                                    </p>
                                    <div class="md:hidden borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pb-2 md:pb-0 pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-xs md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-xs md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>


                        <div class="w-full bg-white rounded-lg flex flex-col justify-between">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/download (7).jfif') }}"
                                            class="w-full h-[242px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            کتاب رهایی، طریقت تسلیم
                                        </h2>
                                    </a>
                                    <p class="flex flex-col h-[72px] text-xs md:text-base mb-4 overflow-hidden">
                                        در بخشی از کتاب رهایی، طریقت تسلیم: سازوکاری برای شاد زیستن می‌خوانیم استرس،
                                        نتیجه فشار انباشته‌شده احساسات سرکوب و مهارشده ماست.
                                    </p>
                                    <div class="md:hidden borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pb-2 md:pb-0 pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-xs md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-xs md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>


                        <div class="w-full bg-white rounded-lg flex flex-col justify-between">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/download (6).jfif') }}"
                                            class="w-full h-[242px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            کتاب خانه ارواح
                                        </h2>
                                    </a>
                                    <p class="flex flex-col h-[72px] text-xs md:text-base mb-4 overflow-hidden">
                                        من عاشق کتاب‌ها شده بودم. ما مُدام در حال جابه‌جایی بودیم و من نمی‌توانستم
                                        هیچ دوستی داشته باشم؛ کتاب‌ها به من کمک می‌کردند....
                                    </p>
                                    <div class="md:hidden borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pb-2 md:pb-0 pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-xs md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-xs md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>


                        <div class="w-full bg-white rounded-lg flex flex-col justify-between">
                            <div class="p-1 md:p-2 lg:p-3">
                                <div class="overflow-hidden rounded-lg">
                                    <a href="#" class="chosenItem">
                                        <img src="{{ asset('img/download (5).jfif') }}"
                                            class="w-full h-[242px] lg:h-[272px] object-cover rounded-lg transition-all duration-500"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-1.5 md:mt-3 lg:mt-5">
                                    <a href="#" class="inline-block lg:mb-7">
                                        <h2
                                            class="text-xs md:text-base lg:text-[22px] font-bold h-[30px] md:h-[48px] lg:h-[66px]">
                                            کتاب قوانین تفکر
                                        </h2>
                                    </a>
                                    <p class="flex flex-col h-[72px] text-xs md:text-base mb-4 overflow-hidden">
                                        کتاب قوانین تفکر، به تألیف ریچارد تمپلر، ذهنیت و شیوه‌ی تفکر شما را زیر و رو
                                        می‌کند! این کتاب مجموعه‌ای از صد قانون و اصولی است که مرحله‌به‌مرحله به شما
                                        می‌آموزد عادت‌های فکری‌تان را تغییر دهید
                                    </p>
                                    <div class="md:hidden borderGradient w-10/12 float-left h-0.5 mb-1 md:mb-2.5">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-row justify-between items-center lg:pt-6 pb-2 md:pb-0 pr-2 lg:pr-3">
                                <div class="flex flex-row justify-start items-center">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-6 ml-1 lg:ml-2.5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path fill="#B473BB"
                                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                    </svg>
                                    <span
                                        class="text-[#B473BB] text-xs md:text-sm lg:text-base font-bold mt-[4px]">1402/12/07</span>
                                </div>
                                <a href="#"
                                    class="text-[#B473BB] text-xs md:text-sm lg:text-base pb-2.5 pt-2.5 lg:pb-5 lg:pt-4 px-[14px] lg:border-t-[6px] lg:border-r-[6px] lg:border-[#FFDDE3] lg:rounded-tr-[11px]">بیشتر
                                    بخوانید</a>
                            </div>
                        </div>





                    </div>
                </div>
            </div>

            <div class="md:h-8 lg:h-12 bg-[#FFDDE3] rounded-b-[100%]"></div>

        </section>

        <!-- new text paragraph -->

        <!-- banner -->

        <section class="2xl:container m-auto hidden md:block md:my-7 lg:my-10">
            <div class="w-11/12 m-auto">
                <a href="#" class="inline-block">
                    <img src="{{ asset('img/last-banner.png') }}" class="h-[127px] rounded-lg" alt="">
                </a>
            </div>
        </section>

        <!-- banner -->


        <!-- footer -->

        <section class="2xl:container m-auto">
            <div class="w-full md:h-8 lg:h-12 bg-[#FFDDE3] rounded-t-[100%] md:mt-10"></div>
            <div class="w-full bg-[#1E0937] py-5">
                <div class="w-11/12 m-auto">
                    <p class="text-center text-white text-xs md:text-base">
                        تمامی حقوق مادی و معنوی این وبسایت متعلق به فروشگاه طبابوک میباشد.
                    </p>
                </div>
            </div>
        </section>

        <!-- footer -->

    </div>


    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>