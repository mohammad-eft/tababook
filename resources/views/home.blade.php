@extends('app.document')
@section('title', 'طبابوک | فروشگاه کتاب و لوازم تحریر')
@section('content')
    <main class="w-full flex flex-col gap-10 justify-start items-center my-3 lg:my-5">
        <!-- hero -->
        <section
                class="max-w-[1800px] w-full mx-auto xl:h-90 bg-[url('{{ asset('storage/' . $setting['heroBanner']) }}')] bg-cover bg-no-repeat bg-center lg:h-80 flex max-lg:flex-col xl:gap-20 lg:gap-15 gap-5 justify-start items-center bg-(--second-cream-color) max-lg:pb-5">
            <div class="lg:w-1/2 w-full h-full flex justify-center items-center">
                <img src="{{ asset('storage/' . $setting['heroBanner']) }}" alt=""
                     class="w-full lg:h-full max-h-full hidden">
            </div>
            <div class="lg:w-1/2 w-full h-full  flex lg:justify-start justify-end pl-5 lg:pl-0 items-center">
                <div
                        class="xl:w-9/12 lg:w-10/12 w-11/12 h-full flex flex-col gap-5 justify-center lg:items-start items-end">
                    <div
                            class="flex flex-col gap-2 justify-start items-end max-lg:items-center text-lg xl:text-4xl lg:text-4xl font-bold text-center lg:text-start">
                        <h1 class="text-(--primary-text-color)">{{ $setting['heroTitle'] }}</h1>

                    </div>
                    <p class="max-xl:text-sm w-2/3 max-lg:text-center text-(--secondary-text-color)">{{ $setting['heroSubtitle'] }}</p>
                    <div class="w-full flex lg:gap-6 gap-3 justify-between items-center">
                        <a href="{{ $setting['heroPrimaryButtonLink'] }}"
                           class="w-1/2 lg:py-4 py-3 bg-(--purple-btn) xl:text-lg max-lg:text-sm text-white font-bold rounded-xl flex justify-center items-center">
                            {{ $setting['heroPrimaryButton'] }}
                        </a>
                        <a href="{{ $setting['heroSecondaryButtonLink'] }}"
                           class="w-1/2 lg:py-3 py-2 bg-(--green-btn) rounded-xl xl:text-lg max-lg:text-sm text-white font-bold flex justify-center items-center">
                            {{ $setting['heroSecondaryButton'] }}
                        </a>
                    </div>
                </div>
            </div>

        </section>
        <!-- hero -->



        <section class="max-w-[1800px] w-11/12 mx-auto">
            <div class="w-full mx-auto flex flex-col items-center">
                <div class="w-full flex flex-col items-center">
                    <div class="w-full flex gap-2 items-center">
                        <div class="w-[50px] h-1 bg-(--primary-text-color)"></div>
                        <span class="text-sm lg:text-lg text-(--secondary-text-color)">{{ $setting['packSubtitle'] }}</span>
                    </div>
                    <div class="w-full flex flex-row justify-between items-center">
                        <span class="lg:text-[30px] text-(--primary-text-color) font-bold">{{ $setting['packTitle'] }}</span>
                        <a href="#" class="text-sm text-(--secondary-text-color)">مشاهده همه</a>
                    </div>
                </div>
                <div class="w-full grid grid-cols-1 lg:grid-cols-3 2xl:grid-cols-4 gap-4 lg:gap-8 mt-5">
                    @foreach ($packs as $pack)
                        <div class="relative overflow-hidden rounded-2xl bg-[#f8f3e8]">
                            <div class="relative h-[180px] lg:h-[250px] w-full">
                                <img src="{{ asset('storage/'.$pack->image) }}" class="h-full w-full object-cover" alt="">
                                <div class="absolute inset-y-0 right-0 w-[45%] bg-[#f8f3e8]">
                                    <div class="absolute -left-3 -top-8 h-28 w-28 rounded-full bg-[#f8f3e8]"></div>
                                    <div class="absolute -left-5 lg:-left-8 top-4 h-28 w-28 rounded-full bg-[#f8f3e8]"></div>
                                    <div class="absolute -left-2 lg:-left-8 top-1/2 h-40 w-40 -translate-y-1/2 rounded-full bg-[#f8f3e8]"></div>
                                    <div class="absolute -left-5 bottom-2 h-28 w-28 rounded-full bg-[#f8f3e8]"></div>
                                    <div class="absolute -left-3 -bottom-8 h-28 w-28 rounded-full bg-[#f8f3e8]"></div>
                                </div>
                            </div>
                            <div class="absolute right-0 top-0 flex h-full w-[45%] items-center justify-center px-3 py-4 lg:py-8">
                                <div class="text-right flex flex-col gap-3">
                                    <h3 class="text-lg lg:text-2xl font-bold text-[#315c50]">
                                       {{ $pack->title }}
                                    </h3>
                                    <p class="text-sm leading-7 text-gray-500">
                                       {{ $pack->summary }}
                                    </p>
                                    <div class="flex">
                                        <a href="{{ route('pack.single', $pack->id) }}" class="mt-3 rounded-full bg-[#8eae9f] px-6 py-2 text-white text-sm lg:text-base">
                                            مشاهده
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>


        <!-- category -->
        <!-- likly -->
        <section class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-4 justify-start items-start">
            <div class="w-full flex flex-row gap-1 justify-between items-center">
                <h3 class="text-xl font-bold text-(--primary-text-color)">محبوب ترین های این روز ها</h3>
{{--                <p class="text-[#ADB4B2] max-lg:text-center max-lg:text-sm">انتخاب هایی که بیشتر از همه مورد توجه--}}
{{--                    کاربران قرار گرفته است</p>--}}
                <a href="#" class="text-sm text-(--secondary-text-color)">مشاهده همه</a>
            </div>
            <div class="max-w-full w-full py-2 px-1 flex gap-4 justify-start overflow-x-auto lg:overflow-x-visible">
                @foreach ($products as $product)
                    <div
                            class="xl:min-w-19/100 xl:max-w-19/100 lg:min-w-24/100 max-w-24/100 min-w-48/100 max-w-48/100  min-h-full bg-white flex flex-col gap-2 justify-start items-center rounded-xl cart_shdow p-2 products" data-product-id="{{ $product->id }}">
                        <div class="w-full flex justify-center items-center relative py-7">
                            <a href={{ route('product.show', [$product->id]) }} class="block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                     class="max-w-full max-h-24 lg:max-h-42">
                            </a>
                            @if ($product->percent)
                                <span
                                        class="lg:px-2 px-1 lg:py-1 py-0.5 bg-(--discount-color) rounded-md text-xs max-lg:text-[9px] text-white absolute top-0 right-0">{{ $product->percent }}%</span>
                            @endif

                        </div>
                        <div class="w-full flex flex-col gap-1.5 lg:gap-2.5 justify-start items-start">
                            <a href={{ route('product.show', [$product->id]) }}
                                class="lg:text-lg text-sm font-bold max-w-full truncate text-(--primary-text-color)">{{ $product->title }}</a>
                            <span class="text-[#ADB4B2] text-sm h-10 max-h-10 ellipsis-2 text-(--secondary-text)">{{ $product->summary }}</span>

                            <div class="flex items-center gap-3">
                            @if ($product->secondary_price)
                                    <div class="line-through text-[#a1a1aa] text-[10px] in-fa">
                                        {{ $product->primary_price }} تومان
                                    </div>
                                <div class="flex items-center justify-between gap-2">
                                    <strong class="text-[15px] in-fa">{{ $product->secondary_price }}</strong>
                                    <span class="text-[10px] text-[#71717a]">تومان
                                    </span>
                                </div>

                            @else
                                <div class="flex items-center justify-between gap-2">
                                    <strong class="text-[15px] in-fa">{{ $product->primary_price }}</strong>
                                    <span class="text-[10px] text-[#71717a]">تومان
                                    </span>
                                </div>
                            @endif
                            </div>
                            <div class="w-full h-12 addToCartBtns" data-product-id="{{ $product->id }}">
                                {{-- @if (Auth::check() && in_array($product->id, $cartProIds) && count($product->carts))

                                    <div class="w-full h-full px-4 transition-all bg-(--light-green-btn) duration-300 hover:bg-(--green-btn) cursor-pointer group flex gap-2 justify-center items-center rounded-xl"
                                         data-product-id="{{ $product->id }}">
                                        <button onclick="setCount(this)"
                                                class="w-1/3 text-lg font-bold transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex itmes-center justify-center cursor-pointer"
                                                data-state="+">+
                                        </button>
                                        <input type="number" class="w-1/3 text-sm text-center outline-none transition-all duration-300 text-(--primary-text-color) group-hover:text-white"
                                               readonly value="{{ $product->carts[0]->quantity }}">
                                        <button onclick="setCount(this)"
                                                class="w-1/3 text-lg font-bold transition-all duration-300 text-(--primary-text-color) group-hover:text-white flex itmes-center justify-center cursor-pointer"
                                                data-state="-">-
                                        </button>
                                    </div>
                                @else --}}
                                    <button onclick="addToCart(this)"
                                            class="w-full px-4 h-full bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 hover:bg-(--green-btn) group"
                                            >
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                 class="lg:size-4 size-3 fill-(--primary-text-color) transition-all duration-300 group-hover:fill-white">
                                                <path
                                                        d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="lg:text-sm text-[10px] text-(--primary-text-color) font-bold transition-all duration-300 group-hover:text-white">افزودن به سبد خرید</span>
                                    </button>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- likly -->

        <!-- baner1 -->
        <section
                class="max-w-[1800px] w-11/12 mx-auto flex max-lg:flex-col justify-start items-center bg-(--cream-color) rounded-xl">
            <div class="lg:w-1/2 w-full flex justify-center items-center relative">
                <img src="{{ asset('storage/' . $setting['secondBanner']) }}" alt=""
                     class="w-full h-full object-cover rounded-r-xl lg:max-h-90 max-h-70">
                
            </div>
            <div
                    class="lg:w-1/2 w-full min-h-full  flex lg:justify-start justify-center items-center lg:pr-20 lg:py-4 max-lg:px-2 max-lg:pt-7 max-lg:pb-5">
                <div class="w-full h-full flex flex-col gap-3 justify-center lg:items-start items-center">
                    <h3 class="lg:text-4xl text-2xl font-bold">{{ $setting['secondBannerTitle'] }}</h3>
                    <p class="max-xl:text-sm max-lg:text-xs max-lg:text-center">{{ $setting['secondBannerSubtitle'] }}
                    </p>

                    <a href="{{ $setting['secondBannerButtonLink'] }}"
                       class="px-6 lg:py-3 py-2 bg-(--purple-btn)  text-sm text-white font-bold rounded-xl flex justify-center items-center mt-2">
                        {{ $setting['secondBannerButton'] }}
                    </a>


                </div>
            </div>

        </section>
        <!-- baner1 -->
        <!-- new product -->
        <section class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-4 justify-start items-start">
            <div class="w-full flex flex-row justify-between items-center">
                <h3 class="text-xl font-bold text-(--primary-text-color)">تازه به قفسه ها اضافه شده</h3>
                <a href="#" class="text-sm text-(--secondary-text-color)">مشاهده همه</a>
            </div>
            <div class="max-w-full w-full py-2 px-1 flex gap-4 justify-start overflow-x-auto lg:overflow-x-visible">

                @foreach ($newProducts as $product)
                    <div
                            class="xl:min-w-19/100 xl:max-w-19/100 lg:min-w-24/100 max-w-24/100 min-w-48/100 max-w-48/100  min-h-full bg-white flex flex-col gap-2 justify-start items-center rounded-xl cart_shdow p-2 pb-5 products" data-product-id="{{ $product->id }}">
                        <div class="w-full flex justify-center items-center relative py-7">
                            <a href={{ route('product.show', [$product->id]) }} class="block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                     class="max-w-full max-h-24 lg:max-h-42">
                            </a>
                            @if ($product->percent)
                                <span
                                        class="lg:px-2 px-1 lg:py-1 py-0.5 bg-(--discount-color) rounded-md text-xs max-lg:text-[9px] text-white absolute top-0 right-0">{{ $product->percent }}%</span>
                            @endif

                        </div>
                        <div class="w-full flex flex-col gap-1.5 lg:gap-2.5 justify-start items-start">
                            <a href={{ route('product.show', [$product->id]) }}
                                class="lg:text-lg text-sm font-bold max-w-full truncate text-(--primary-text-color)">{{ $product->title }}</a>
                            <span class="text-[#ADB4B2] text-sm h-10 max-h-10 ellipsis-2 text-(--secondary-text-color)">{{ $product->summary }}</span>

                            <div class="flex items-center gap-3">
                                @if ($product->secondary_price)
                                    <div class="line-through text-[#a1a1aa] text-[10px] in-fa">
                                        {{ $product->primary_price }} تومان
                                    </div>
                                    <div class="flex items-center justify-between gap-2">
                                        <strong class="text-[15px] in-fa">{{ $product->secondary_price }}</strong>
                                        <span class="text-[10px] text-[#71717a]">تومان
                                        </span>
                                    </div>

                                @else
                                    <div class="flex items-center justify-between gap-2">
                                        <strong class="text-[15px] in-fa">{{ $product->primary_price }}</strong>
                                        <span class="text-[10px] text-[#71717a]">تومان
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full h-12 addToCartBtns" data-product-id="{{ $product->id }}">
                                {{-- @if (Auth::check() && in_array($product->id, $cartProIds) && count($product->carts))
                                    <div class="w-full h-full px-4 transition-all duration-300 hover:bg-(--green-btn) cursor-pointer group bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl"
                                         data-product-id="{{ $product->id }}">
                                        <button onclick="setCount(this)"
                                                class="w-1/3 text-lg font-bold text-(--primary-text-color) flex justify-center items-center cursor-pointer group-hover:text-white"
                                                data-state="+">+
                                        </button>
                                        <input type="number" class="w-1/3 text-sm text-center outline-none text-(--primary-text-color) group-hover:text-white"
                                               readonly value="{{ $product->carts[0]->quantity }}">
                                        <button onclick="setCount(this)"
                                                class="w-1/3 text-lg font-bold text-(--primary-text-color) flex justify-center items-center cursor-pointer group-hover:text-white"
                                                data-state="-">-
                                        </button>
                                    </div>
                                @else --}}
                                    <button onclick="addToCart(this)"
                                            class="w-full px-4 h-full bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl transition-all duration-300 hover:bg-(--green-btn) cursor-pointer group"
                                            >
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                 class="lg:size-4 size-3 transition-all duration-300 group-hover:fill-white fill-(--primary-text-color)">
                                                <path
                                                        d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="lg:text-sm text-[10px] text-(--primary-text-color) transition-all duration-300 group-hover:text-white font-bold">افزودن به سبد خرید</span>
                                    </button>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </section>


        <section class="w-full flex justify-center ">
            <div class="max-w-[1800px] w-11/12 mx-auto lg:h-60 flex max-lg:flex-col justify-between gap-3">
                <a href="{{ $setting['rightBannerLink'] }}" class="lg:w-5/12 w-full rounded-2xl h-full bg-(--bg-dark-green) flex justify-center items-center">
                    <img class="w-full h-full rounded-xl"
                         src="{{ asset('storage/'.$setting['rightBanner']) }}" alt="">
                </a>
                <div class="lg:w-7/12 w-full h-full relative flex max-lg:flex-col items-center gap-3 bg-(--cream-color) rounded-xl">
                    <img class="h-full w-1/2 rounded-r-xl object-cover max-h-40"
                         src="{{ asset('storage/'.$setting['leftBanner']) }}" alt="">
                    <div class="lg:w-1/2 w-full flex flex-col gap-2 lg:items-start items-center p-3">
                        <span class="lg:text-xl text-md font-bold text-(--primary-text-color)">{{ $setting['leftBannerTitle'] }}</span>

                        <span class="lg:text-md text-xs text-(--secondary-text-color)">{{ $setting['leftBannerSubtitle'] }}</span>
                        <a href="{{ $setting['leftBannerButtonLink'] }}"
                           class="w-1/2 rounded-xl bg-(--pastel-pink) flex items-center justify-center gap-2 mt-5 p-2">
                            <span class="lg:text-md text-xs text-white">{{ $setting['leftBannerButton'] }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                 class="lg:size-5 size-3 fill-white">
                                <path
                                        d="M7.4 273.4C2.7 268.8 0 262.6 0 256s2.7-12.8 7.4-17.4l176-168c9.6-9.2 24.8-8.8 33.9 .8s8.8 24.8-.8 33.9L83.9 232 424 232c13.3 0 24 10.7 24 24s-10.7 24-24 24L83.9 280 216.6 406.6c9.6 9.2 9.9 24.3 .8 33.9s-24.3 9.9-33.9 .8l-176-168z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <section class="w-full flex justify-center gap-5">
            <div class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-5">
                <div class="w-full flex justify-between items-center">
                    <span class="lg:text-2xl text-xl font-bold text-(--primary-text-color)">{{ $setting['twoCardsSectionTitle'] }} </span>
                    <a href="{{ $setting['twoCardsSectionLinkUrl'] }}"
                       class="text-sm text-(--secondary-text-color)">{{ $setting['twoCardsSectionLinkText'] }}</a>
                </div>
                <div class="flex items-center flex-col lg:flex-row gap-8">
                    <div class="lg:w-6/12 w-full flex max-lg:flex-col gap-2 justify-between py-5 px-7 bg-(--cream-color) rounded-xl">
                        <div class="lg:w-1/2 w-full flex flex-col max-lg:items-center justify-center gap-3 max-lg:order-2">
                            <span class="text-xl max-lg:text-lg font-bold text-(--primary-text-color)">{{ $setting['twoCardsRightTitle'] }}</span>
                            <span class="max-lg:text-sm text-(--secondary-text-color) max-lg:text-center">{{ $setting['twoCardsRightSubtitle'] }}</span>
                            <a href="{{ $setting['twoCardsRightButtonLink'] }}"
                               class="flex justify-center items-center w-9/12 py-2 border-2 border-gray-300 rounded-xl">
                                <span class="text-(--secondary-text-color)">{{ $setting['twoCardsRightButton'] }}</span>
                            </a>
                        </div>
                        <img class="w-1/2 mx-auto max-h-60 rounded-l-xl max-lg:order-1"
                             src="{{ asset('storage/'.$setting['twoCardsRightImage']) }}"
                             alt="">
                    </div>
                    <div class="lg:w-6/12 w-full flex max-lg:flex-col gap-2 justify-between p-5 px-7 bg-(--second-cream-color) rounded-xl">
                        <div class="lg:w-1/2 w-full flex flex-col max-lg:items-center justify-center gap-3 max-lg:order-2">
                            <span class="text-2xl font-bold text-(--primary-text-color)">{{ $setting['twoCardsLeftTitle'] }}</span>
                            <span class="max-lg:text-sm max-lg:text-center text-(--secondary-text-color)">{{ $setting['twoCardsLeftSubtitle'] }} </span>
                            <a href="{{ $setting['twoCardsLeftButtonLink'] }}"
                               class="flex justify-center items-center w-9/12 py-2 border-2 border-gray-300 rounded-xl text-(--secondary-text-color)">
                                <span>{{ $setting['twoCardsLeftButton'] }}</span>
                            </a>
                        </div>
                        <img class="w-1/2 mx-auto max-h-60 rounded-l-xl max-lg:order-1"
                             src="{{ asset('storage/'.$setting['twoCardsLeftImage']) }}"
                             alt="">
                    </div>
                </div>
            </div>
        </section>
   

        <section
                class="max-w-[1800px] w-11/12 mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-center lg:py-4 sm:py-3 rounded-xl">
            <div
                    class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full flex flex-col gap-2 justify-center items-center">
                    <div class="">
                        <img src="{{ asset('storage/'.$setting['serviceImage1']) }}"
                             class="lg:w-8 w-5 object-cover" alt="">
                    </div>
                    <div
                            class="flex flex-col sm:gap-2 gap-1 items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-(--primary-text-color)">{{ $setting['serviceTitle1'] }}</h5>
                        <div
                                class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold text-center text-(--secondary-text-color)">{{ $setting['serviceSubTitle1'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                    class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full flex flex-col gap-2 justify-center items-center">
                    <div class="">
                        <img src="{{ asset('storage/'.$setting['serviceImage2']) }}"
                             class="lg:w-8 w-5 object-cover" alt="">
                    </div>
                    <div
                            class="flex flex-col sm:gap-2 gap-1 items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-(--primary-text-color)">{{ $setting['serviceTitle2'] }}</h5>
                        <div
                                class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold text-center text-(--secondary-text-color)">{{ $setting['serviceSubTitle2'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                    class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full flex flex-col gap-2 justify-center items-center">
                    <div class="">
                        <img src="{{ asset('storage/'.$setting['serviceImage3']) }}"
                             class="lg:w-8 w-5 object-cover" alt="">
                    </div>
                    <div
                            class="flex flex-col sm:gap-2 gap-1 items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-(--primary-text-color)">{{ $setting['serviceTitle3'] }}</h5>
                        <div
                                class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px]sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold text-center text-(--secondary-text-color)">{{ $setting['serviceSubTitle3'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                    class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full flex flex-col gap-2 justify-center items-center">
                    <div class="">
                        <img src="{{ asset('storage/'.$setting['serviceImage4']) }}"
                             class="lg:w-8 w-5 object-cover" alt="">
                    </div>
                    <div
                            class="flex flex-col sm:gap-2 gap-1 items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-(--primary-text-color)">{{ $setting['serviceTitle4'] }}</h5>
                        <div
                                class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold text-center text-(--secondary-text-color)">{{ $setting['serviceSubTitle4'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                    class="w-full flex items-center justify-center max-lg:rounded-xl max-lg:py-2 max-lg:px-2">
                <div class="group w-full flex flex-col gap-2 justify-center items-center">
                    <div class="">
                        <img src="{{ asset('storage/'.$setting['serviceImage5']) }}"
                             class="lg:w-8 w-5 object-cover" alt="">
                    </div>
                    <div
                            class="flex flex-col sm:gap-2 gap-1 items-center max-sm:items-center justify-center">
                        <h5 class="xl:text-lg text-md font-bold text-(--primary-text-color)">{{ $setting['serviceTitle5'] }}</h5>
                        <div
                                class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[10px] text-[11px] text-[var(--text-secondary)]">
                            <span class="font-bold text-center text-(--secondary-text-color)">{{ $setting['serviceSubTitle5'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <!-- prapery -->
    </main>
@endsection