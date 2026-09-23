@extends('app.document')
@section('title', 'طبابوک | فروشگاه کتاب و لوازم تحیری')
    @section('content')
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
                            <div>
                                <button class="addToCart w-full py-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="{{ $product->id }}">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                            class="lg:size-4 size-3" fill="white">
                                            <path
                                                d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                                </button>
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
                            <div>
                                <button class="addToCart w-full py-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="{{ $product->id }}">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                            class="lg:size-4 size-3" fill="white">
                                            <path
                                                d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                                </button>
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
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">
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
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">
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
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">
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
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">
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
                <div class="group w-full msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">
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
@endsection