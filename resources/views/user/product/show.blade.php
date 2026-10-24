@extends('app.document')
@section('title', 'جست و جو')
@section('content')
    @if (session('success'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-green-300 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="text-sm text-[var(--light-theme-text-color)]"> {{ session('success') }} </span>
        </div>
    @endif
    @if ($errors->hasAny(['name', 'family', 'phoneNumber', 'email', 'subject', 'text']))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-red-300 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="text-sm text-[var(--light-theme-text-color)]"> هنگام تکمیل فرم به فیلد ها توجه کنید. </span>
        </div>
    @endif
    @if (session('failure'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-red-300 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="text-sm text-[var(--light-theme-text-color)]"> {{ session('failure') }} </span>
        </div>
    @endif
    <!-- order_box_start -->
    <section class="w-full flex justify-center items-center bg-red-500">
        <div class="w-11/12 h-full flex flex-col justify-between items-center">
            <!-- root_single -->
            <div class="w-full flex justify-start items-center gap-3 py-2">
                <a href="{{ route('home') }}"
                    class="xl:text-lg max-lg:text-xs text-nowrap font-bold text-[var(--text)] cursor-pointer">خانه</a>
                <span class="text-lg text-[var(--gold)]">/</span>
                <a href="{{ route('product.index') }}"
                    class="xl:text-lg max-lg:text-xs text-nowrap font-bold text-[var(--text)] cursor-pointer">محصولات</a>
                <span class="text-lg text-[var(--gold)]">/</span>
                <span
                    class="xl:text-lg max-lg:text-xs text-nowrap font-bold text-[var(--text)] cursor-pointer">{{ $product['title'] }}</span>
            </div>
            <!-- root_single -->
            <div class="w-full flex max-sm:flex-col justify-between items-start gap-5">
                <!-- galeri -->

                <div
                    class="sm:w-7/12 w-full xl:h-100 lg:h-80 sm:h-50 h-90  gap-2 flex max-sm:flex-col justify-between items-center">
                    <div
                        class="sm:w-2/12 max-w-full w-full  max-h-full h-full sm:overflow-y-auto  max-sm:overflow-x-auto max-sm:h-19/100 flex sm:flex-col gap-3 justify-start items-center bg-[var(--background-2)] rounded-xl [&::-webkit-scrollbar]:w-1 max-sm:[&::-webkit-scrollbar]:h-1  [&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  [&::-webkit-scrollbar-thumb]:rounded-full max-sm:order-2">
                        @foreach ($product['media'] as $media)
                            <div
                                class="max-sm:min-w-1/5 max-sm:max-w-1/5 w-full bg-red-500 xl:h-30/100 lg:h-27/100 sm:h-30/100 h-full flex justify-center items-center rounded-xl border-2 border-[var(--border)] hover:border-[var(--gold)] active:border-[var(--gold)] transition_root cursor-pointer">
                                <img src="{{ asset('storage/' . $media['media_path']) }}" alt=""
                                    class="w-full h-full object-cover rounded-xl gallery_product_item">
                            </div>
                        @endforeach
                    </div>
                    <div
                        class="w-10/12 max-sm:w-full h-full max-sm:h-80/100 flex justify-center items-center bg-[var(--background-2)] rounded-xl px-1 max-sm:order-1">
                        <img src="{{ asset('storage/' . $product['mainImg']) }}" alt=""
                            class="max-w-full max-h-full rounded-xl gallery_product_primary transition_root">
                    </div>
                </div>
                <!-- galeri -->
                <!-- order -->
                <div
                    class="sm:w-40/100 w-full h-full border border-[var(--border)] bg-[var(--background-2)] rounded-xl lg:p-6 p-3 flex flex-col gap-6 justify-start items-start max-sm:items-center">
                    <!-- title_product -->
                    <div class="w-full flex justify-between max-sm:justify-center items-center">
                        <h2 class="lg:text-xl text-lg font-bold text-[var(--text)]">{{ $product['title'] }}</h2>
                        {{-- آیکون قلب اینجاس که فعلا کامنت شده --}}
                       
                    </div>
                    <!-- title_product -->
                    <!-- score -->
                    <div class="w-full max-sm:w-7/12 flex gap-4 justify-start max-sm:justify-between items-center">
                     
                    </div>
                    <!-- score -->
                    <!-- discription -->
                    <div class="lg:w-9/12 max-lg:w-full max-sm:w-9/12 flex justify-start items-center">
                        <p class="max-xl:text-xs max-lg:text-[9px] text-[var(--text-secondary)] max-sm:text-center">
                            {{ $product['summary'] }}
                        </p>
                    </div>
                   
                    <div class="w-full flex gap-4 justify-start max-sm:justify-center items-center">
                        {{-- <span class="xl:text-xl lg:text-lg text-[var(--text)]">از</span> --}}
                        @if ($product['primary_price'])
                            @if ($product['secondary_price'])
                                <span class="text-xs text-gray-400 font-bold line-through">{{ $product['primary_price'] }}
                                    تومان</span>
                                <span
                                    class="xl:text-xl lg:text-lg max-sm:text-lg text-[var(--gold)] font-bold">{{ $product['secondary_price'] }}
                                    تومان</span>
                            @else
                                <span
                                    class="xl:text-xl lg:text-lg max-sm:text-lg text-[var(--gold)] font-bold">{{ $product['primary_price'] }}
                                    تومان</span>
                            @endif
                        @else
                            <span class="text-[var(--gold)] w-full text-right text-md">برای استعلام قیمت تماس
                                بگیرید</span>
                        @endif
                    </div>
                   
                    @if ($product->attributes->isNotEmpty())
                        <div class="grid grid-cols-2 gap-8">
                            @if (isset($product->attributes[0]))
                                <div class="w-full flex lg:gap-4 gap-2 justify-start max-sm:justify-center items-center">
                                    <h4 class="xl:text-lg max-lg:text-xs text-nowrap font-bold text-[var(--text)]">
                                        {{ $product->attributes[0]['attribute_key'] }} :
                                    </h4>
                                    <span
                                        class="max-lg:text-xs text-[var(--text)]">{{ $product->attributes[0]['attribute_value'] }}</span>
                                </div>
                            @endif
                            @if (isset($product->attributes[1]))
                                <div class="w-full flex lg:gap-4 gap-2 justify-start max-sm:justify-center items-center">
                                    <h4 class="xl:text-lg max-lg:text-xs text-nowrap font-bold text-[var(--text)]">
                                        {{ $product->attributes[1]['attribute_key'] }} :
                                    </h4>
                                    <span
                                        class="max-lg:text-xs text-[var(--text)]">{{ $product->attributes[1]['attribute_value'] }}</span>
                                </div>
                            @endif
                        </div>
                        <a href="#attributes"
                            class="text-xs md:text-md font-bold text-[var(--gold)] border border-[var(--text)] py-2 px-3 rounded-xl">همه
                            ویژگی ها</a>
                    @endif
                    <!--material_kart -->
                    <!-- bottoms -->
                    <div class="w-full flex max-sm:flex-col lg:gap-5 gap-2 items-center justify-end ">
                        <span onclick="consultForm('open')"
                            class="group sm:w-1/2 w-full xl:py-3 py-2 flex lg:gap-3 gap-1 justify-center items-center rounded-2xl border-2 border-[var(--gold)] cursor-pointer rezume_gradient transition_root">
                            <span class="xl:text-md lg:text-sm text-[9px] font-bold text-white">مشاوره
                                رایگان</span>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="lg:size-6 size-4 stroke-[var(--gold)] group-hover:stroke-white" fill="none"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 13v-1a8 8 0 0 1 16 0v1" />
                                    <rect x="2" y="13" width="5" height="7" rx="1.5" />
                                    <rect x="17" y="13" width="5" height="7" rx="1.5" />
                                    <path d="M20 20v1a3 3 0 0 1-3 3h-3" />
                                </svg>
                            </div>
                        </span>

                        {{-- @dd($cart); --}}
                        @if ($cart && in_array($product->id, $proIds))
                            <div class="sm:w-1/2 w-full xl:py-3 py-2 flex lg:gap-3 gap-1 justify-center items-center rounded-2xl gradient_box1 gradient_box1_hover_chang border-2 border-[var(--gold)] transition_root cursor-pointer"
                                id="cartBtn">
                                <div class="w-10/12 h-full flex flex-row gap-2 items-center justify-between px-1 count">
                                    <button
                                        class="size-7 pt-1 bg-[#f6911e] flex justify-center items-center rounded-md changeButton cursor-pointer"
                                        onclick="setCount(this, '+', {{ $product->id }})">
                                        <span class="text-2xl text-white">+</span>
                                    </button>

                                    <input type="number" disabled min="1" value="{{ $cart->quantity ?? 1 }}"
                                        class="size-7 text-center font-bold text-xs text-white outline-none" name=""
                                        id="quantity">
                                    <button
                                        class="size-7 pt-1 bg-[#f6911e] flex justify-center items-center rounded-md changeButton cursor-pointer"
                                        onclick="setCount(this, '-', {{ $product->id }})">
                                        <span class='text-2xl text-white'>-</span>
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="sm:w-1/2 w-full xl:py-3 py-2 flex lg:gap-3 gap-1 justify-center items-center rounded-2xl gradient_box1 gradient_box1_hover_chang border-2 border-[var(--gold)] transition_root cursor-pointer"
                                onclick='addToCart(this , "{{ $product->id }}")' id="cartBtn">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="xl:size-6 size-4"
                                        fill="white">
                                        <path
                                            d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="xl:text-md lg:text-sm text-[9px] text-white font-bold">ثبت سفارش</span>
                            </div>
                        @endif

                    </div>
                    <!-- bottoms -->
                    <!-- servis_my_in_order -->
                    <div class="w-full flex justify-between items-center">
                        <div class="flex justify-start items-center gap-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="xl:size-8 lg:size-5 size-3 fill-none" stroke="var(--gold)" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 7h11v10H2z"></path>
                                    <path d="M13 10h4l4 3.5V17h-8z"></path>
                                    <circle cx="6" cy="18.5" r="1.6"></circle>
                                    <circle cx="17" cy="18.5" r="1.6"></circle>
                                </svg>
                            </div>
                            <span class="text-[8px] lg:text-xs text-[var(--text-secondary)]">ارسال
                                به سراسر کشور</span>
                        </div>
                        <div class="flex justify-start items-center gap-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 20 20" id="entypo-wallet"
                                    class="xl:size-6 lg:size-5 size-3 fill-[var(--gold)]">
                                    <g>
                                        <path
                                            d="M16 6H3.5v-.5l11-.88v.88H16V4c0-1.1-.891-1.872-1.979-1.717L3.98 3.717C2.891 3.873 2 4.9 2 6v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2zm-1.5 7.006a1.5 1.5 0 1 1 .001-3.001 1.5 1.5 0 0 1-.001 3.001z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-[8px] lg:text-xs text-[var(--text-secondary)]">پرداخت
                                امن</span>
                        </div>
                        <div class="flex justify-start items-center gap-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                    class="xl:size-6 lg:size-5 size-3 fill-[var(--gold)]">
                                    <path
                                        d="M512 112H64c-8.8 0-16 7.2-16 16V384c0 8.8 7.2 16 16 16H348.3c-5.6 7.1-9.6 15.3-11.8 24.1l-6 23.9H64c-35.3 0-64-28.7-64-64V128C0 92.7 28.7 64 64 64H512c35.3 0 64 28.7 64 64v64.6c-15.2 2-29.8 8.8-41.4 20.5l-6.6 6.6V128c0-8.8-7.2-16-16-16zM256 296c0-13.3 10.7-24 24-24h48c13.3 0 24 10.7 24 24s-10.7 24-24 24H280c-13.3 0-24-10.7-24-24zm24-120H424c13.3 0 24 10.7 24 24s-10.7 24-24 24H280c-13.3 0-24-10.7-24-24s10.7-24 24-24zM160 132c11 0 20 9 20 20v13.9c7.5 1.2 14.6 2.9 21.1 4.7c10.7 2.8 17 13.8 14.2 24.5s-13.8 17-24.5 14.2c-11-2.9-21.6-5-31.2-5.2c-7.9-.1-16 1.8-21.5 5c-4.8 2.8-6.2 5.6-6.2 9.3c0 1.8 .1 3.5 5.3 6.7c6.3 3.8 15.5 6.7 28.3 10.5l.7 .2c11.2 3.4 25.6 7.7 37.1 15c12.9 8.1 24.3 21.3 24.6 41.6c.3 20.9-10.5 36.1-24.8 45c-7.2 4.5-15.2 7.3-23.2 9V360c0 11-9 20-20 20s-20-9-20-20V345.4c-10.3-2.2-20-5.5-28.2-8.4l0 0 0 0c-2.1-.7-4.1-1.4-6.1-2.1c-10.5-3.5-16.1-14.8-12.6-25.3s14.8-16.1 25.3-12.6c2.5 .8 4.9 1.7 7.2 2.4c13.6 4.6 24 8.1 35.1 8.5c8.6 .3 16.5-1.6 21.4-4.7c4.1-2.5 6-5.5 5.9-10.5c0-2.9-.8-5-5.9-8.2c-6.3-4-15.4-6.9-28-10.7l-1.7-.5c-10.9-3.3-24.6-7.4-35.6-14c-12.7-7.7-24.6-20.5-24.7-40.7c-.1-21.1 11.8-35.7 25.8-43.9c6.9-4.1 14.5-6.8 22.2-8.5V152c0-11 9-20 20-20zM613.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM375.9 417L505.1 287.8l71 71L446.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z" />
                                </svg>
                            </div>
                            <span class="text-[8px] lg:text-xs text-[var(--text-secondary)]">ضمانت
                                بازگشت کالا</span>
                        </div>
                    </div>
                    <!-- servis_my_in_order -->
                </div>
                <!-- order -->
            </div>
        </div>
    </section>
    <!-- order_box_end -->

    <!-- property -->
    <section
        class="w-11/12 lg:h-30 lg:border lg:border-[var(--border)] max-lg:border sm:border-[var(--gold)] flex max-sm:flex max-sm:flex-col gap-4 items-center justify-between max-lg:grid grid-cols-2 lg:py-4 sm:py-3 sm:px-5 sm:bg-[var(--background-2)]  rounded-xl">
        <div
            class="w-full lg:w-1/6 h-full flex items-center justify-center max-lg:bg-[var(--background)] max-lg:rounded-xl max-lg:border-1 sm:border-[var(--border)] border-[var(--gold)] max-lg:py-2 max-lg:px-2">
            <div class="group max-sm:w-9/12 msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">

                <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_root">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="xl:size-13 lg:size-9 size-7 fill-[var(--gold)]">
                        <path
                            d="M73 127L256 49.4 439 127c5.9 2.5 9.1 7.8 9 12.8c-.4 91.4-38.4 249.3-186.3 320.1c-3.6 1.7-7.8 1.7-11.3 0C102.4 389 64.5 231.2 64 139.7c0-5 3.1-10.2 9-12.8zM457.7 82.8L269.4 2.9C265.2 1 260.7 0 256 0s-9.2 1-13.4 2.9L54.3 82.8c-22 9.3-38.4 31-38.3 57.2c.5 99.2 41.3 280.7 213.6 363.2c16.7 8 36.1 8 52.8 0C454.8 420.7 495.5 239.2 496 140c.1-26.2-16.3-47.9-38.3-57.2zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                    <h5 class="xl:text-lg sm:text-xs text-sm font-bold text-[var(--text)]">کیفیت
                        تضمینی</h5>
                    <div
                        class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[7px] text-[10px] text-[var(--text-secondary)]">
                        <span class=" font-bold">از تفکیک دقیق رنگ ها تابرش و صحافی، تمام مراحل با حساسترین
                            استاندارد ها رعایت میشوند.</span>
                    </div>
                </div>
            </div>
        </div>
        <span class="w-0.5 h-full bg-[var(--border)] rounded-full max-lg:hidden"></span>
        <div
            class="w-full lg:w-1/6 h-full flex items-center justify-center max-lg:bg-[var(--background)] max-lg:rounded-xl max-lg:border-1 sm:border-[var(--border)] border-[var(--gold)] max-lg:py-2 max-lg:px-2">
            <div class="group max-sm:w-9/12 msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">

                <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_root">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                        class="xl:size-13 lg:size-9 size-7 fill-[var(--gold)]">
                        <path
                            d="M128 128a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM269.7 336c80 0 145 64.3 146.3 144H32c1.2-79.7 66.2-144 146.3-144h91.4zM224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3zm431 208c17 0 30.7-13.8 30.7-30.7C640 392.2 567.8 320 478.7 320H417.3c-4.4 0-8.8 .2-13.2 .5c11.3 9.4 21.6 19.9 30.7 31.5h43.9c71 0 128.6 57.2 129.3 128H480c0 .8 0 1.5 0 2.3c0 10.8-2.8 20.9-7.6 29.7H609.3zM432 256c61.9 0 112-50.1 112-112s-50.1-112-112-112c-24.8 0-47.7 8.1-66.3 21.7c5.2 9.8 9.3 20.3 12.4 31.2C392.3 71.9 411.2 64 432 64c44.2 0 80 35.8 80 80s-35.8 80-80 80c-25.2 0-47.6-11.6-62.3-29.8c-4.7 10.3-10.4 19.9-17 28.9C373 243.4 401 256 432 256z" />
                    </svg>
                </div>
                <div class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                    <h5 class="xl:text-lg sm:text-xs text-sm font-bold text-[var(--text)]">تیم
                        حرفه‌ای</h5>
                    <div
                        class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[7px] text-[10px] text-[var(--text-secondary)]">
                        <span class=" font-bold">تیم ما متشکل از کارشناسان با تجربه در زمینه چاپ و طراحی و
                            گرافیک و هنر است.</span>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="w-full lg:w-1/4 h-full flex items-center justify-center max-lg:bg-[var(--background)] max-lg:rounded-xl max-lg:border-1 sm:border-[var(--border)] border-[var(--gold)] max-lg:py-2 px-2 max-lg:col-span-2 gradient_box1 rounded-xl">
            <div class="group max-sm:w-9/12 msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">
                <div class="group-hover:scale-[1.05] group-active:scale-[1.6] transition_root">
                    <svg xmlns="http://www.w3.org/2000/svg" class="xl:size-13 size-9" viewBox="0 0 24 24" fill="none"
                        stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M12 3 C12.7 3.6 13.6 3.5 14.3 3.9 C15.1 4.2 15.5 5 16.2 5.4 C17 5.8 17.8 6.3 18 7.2 C18.3 8 19 8.8 19 9.8 C19 10.8 18.3 11.6 18 12.4 C17.8 13.3 17 13.8 16.2 14.2 C15.5 14.6 15.1 15.4 14.3 15.7 C13.6 16.1 12.7 16 12 16.6 C11.3 16 10.4 16.1 9.7 15.7 C8.9 15.4 8.5 14.6 7.8 14.2 C7 13.8 6.2 13.3 6 12.4 C5.7 11.6 5 10.8 5 9.8 C5 8.8 5.7 8 6 7.2 C6.2 6.3 7 5.8 7.8 5.4 C8.5 5 8.9 4.2 9.7 3.9 C10.4 3.5 11.3 3.6 12 3Z" />
                        <circle cx="12" cy="9.8" r="4.2" />
                        <path d="M9.8 14.6L7.7 20H10L12 17.7" />
                        <path d="M14.2 14.6L16.3 20H14L12 17.7" />
                    </svg>
                </div>
                <div class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                    <h5 class="xl:text-lg text-md font-bold text-[var(--text)]">چرا ما را انتخاب
                        کنید</h5>
                    <div
                        class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] text-[10px] text-[var(--text)]">
                        <span class=" font-bold">ما با دانش فنی بالا و کادر مجرب و به روز همراه شما در مسیر
                            خلق یک اثر ماندگار هستیم.</span>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="w-full lg:w-1/6 h-full flex items-center justify-center max-lg:bg-[var(--background)] max-lg:rounded-xl max-lg:border-1 sm:border-[var(--border)] border-[var(--gold)] max-lg:py-2 max-lg:px-2">
            <div class="group max-sm:w-9/12 msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">

                <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_root">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="xl:size-13 lg:size-9 size-7 fill-none" stroke="var(--gold)" stroke-width="1.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 7h11v10H2z"></path>
                        <path d="M13 10h4l4 3.5V17h-8z"></path>
                        <circle cx="6" cy="18.5" r="1.6"></circle>
                        <circle cx="17" cy="18.5" r="1.6"></circle>
                    </svg>
                </div>
                <div class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                    <h5 class="xl:text-lg sm:text-xs text-sm font-bold text-[var(--text)]">تحویل
                        سریع</h5>
                    <div
                        class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[7px]  text-[10px] text-[var(--text-secondary)]">
                        <span class=" font-bold">با فرایند تولید بهینه و منسجم سفارش شما در سریع ترین زمان
                            ممکن آماده میشود.</span>
                    </div>
                </div>
            </div>
        </div>
        <span class="w-0.5 h-full bg-[var(--border)] rounded-full max-lg:hidden"></span>
        <div
            class="w-full lg:w-1/6 h-full flex items-center justify-center max-lg:bg-[var(--background)] max-lg:rounded-xl max-lg:border-1 sm:border-[var(--border)] border-[var(--gold)] max-lg:py-2 max-lg:px-2">
            <div class="group max-sm:w-9/12 msx-sm:h-full flex max-lg:flex-col gap-2 justify-center items-center">

                <div class="group-hover:scale-[1.05] group-active:scale-[1.3] transition_root">
                    <svg class="xl:size-13 lg:size-9 size-7" viewBox="0 0 64 64" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <!-- Circle -->
                        <circle cx="32" cy="32" r="22" stroke="#D4A437" stroke-width="3.5"
                            stroke-linecap="round" stroke-dasharray="132 12" />

                        <!-- Top & Bottom marks -->
                        <line x1="32" y1="6" x2="32" y2="11" stroke="#D4A437"
                            stroke-width="3" stroke-linecap="round" />
                        <line x1="32" y1="53" x2="32" y2="58" stroke="#D4A437"
                            stroke-width="3" stroke-linecap="round" />

                        <!-- Dollar -->
                        <text x="32" y="42" text-anchor="middle" font-size="28" font-family="Arial, sans-serif"
                            font-weight="700" fill="#D4A437">$</text>
                    </svg>
                </div>
                <div class="flex flex-col sm:gap-2 gap-1 lg:items-start items-center max-sm:items-center justify-center">
                    <h5 class="xl:text-lg sm:text-xs text-sm font-bold text-[var(--text)]">قیمت
                        مناسب</h5>
                    <div
                        class="text-justify flex flex-col lg:items-start items-center max-sm:items-start justify-center xl:text-[11px] sm:text-[7px] text-[10px] text-[var(--text-secondary)]">
                        <span class=" font-bold">با بهینه سازی مصرف مواد اولیه و کاهش هزینه های اضافه به
                            صرفه ترین قیمت ها را داریم.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- property -->

    <!-- specification -->
    <section id="attributes" class="w-full flex justify-center items-center">
        <div
            class="w-11/12 flex flex-col gap-2 justify-start items-center bg-[var(--background-2)] border border-[var(--border)] rounded-xl py-4 px-5">
            <ul
                class="max-w-full min-w-full flex justify-start items-center gap-5 overflow-auto mb-10 [&::-webkit-scrollbar]:h-2  [&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  [&::-webkit-scrollbar-thumb]:rounded-full">
                <li data-id="desc" data-info="{{ $product['description'] }}"
                    class="box-titles flex justify-center items-center pb-1.5 relative cheng_text_colot_hover cursor-pointer">
                    <sapn
                        class="xl:text-xl lg:text-lg max-sm:text-sm transition_root text-nowrap font-bold text-[var(--gold)]">
                        توضیحات محصول</sapn>
                    <div
                        class="w-full absolute bottom-0 right-auto left-auto  oveflow-hidden flex justify-center items-center transition_root">
                        <div class="w-full h-[1px] bg-[var(--gold)] rounded-full transition_root"></div>
                    </div>
                </li>
                @if ($product->attributes->isNotEmpty())
                    <li data-id="attr" data-info="{{ $product['attributes'] }}"
                        class="box-titles flex justify-center items-center pb-1.5 relative cheng_text_colot_hover cursor-pointer">
                        <sapn
                            class="xl:text-xl lg:text-lg max-sm:text-sm transition_root text-nowrap font-bold text-[var(--text)]">
                            مشخصات فنی</sapn>
                        <div
                            class="w-full absolute bottom-0 right-auto left-auto  oveflow-hidden flex justify-center items-center transition_root">
                            <div class="w-full h-[1px] bg-[var(--text)] rounded-full transition_root"></div>
                        </div>
                    </li>
                @endif
            </ul>
            <div class="w-full flex gap-6 justify-between items-center">
                <!-- desciption_product_start -->
                <div id="box-content" class="w-full h-full py-2">
                    <p class="xl:text-lg lg:text-sm sm:text-xs text-[10px] text-[var(--text)] leading-8 text-justify">
                        {{ $product['description'] }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- specification -->
    <!-- common_products_start -->
    <section class="w-full flex items-center justify-center">
        <div class="w-11/12 h-full flex flex-col gap-8 items-center justify-center">
            <div class="w-full flex flex-col gap-3 items-center justify-center">
                <h3 class="xl:text-4xl lg:text-2xl text-xl text-white font-bold">محصولات مرتبط</h3>
                <div class="flex gap-0.5 items-center justify-center">
                    <span class="size-1 rounded-full bg-[var(--gold)]"></span>
                    <span class="w-8 h-0.5 bg-[var(--gold)] rounded-full"></span>
                </div>
            </div>
            <div
                class="max-w-full min-w-full flex gap-4 items-center justify-start overflow-x-auto p-5 [&::-webkit-scrollbar]:h-1  [&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  [&::-webkit-scrollbar-thumb]:rounded-full">
                @foreach ($product['categories'] as $category)
                    @foreach ($category['products'] as $pro)
                        @if ($pro['id'] != $product['id'])
                            <div
                                class="min-w-60 max-w-60 h-75 border-1 border-[var(--gold)] bg-[#181819] rounded-2xl flex flex-col gap-5 items-center justify-between scale transition_root pb-2">
                                <a href="{{ route('product.show', [$pro]) }}" class="w-full lg:h-7/12 h-full">
                                    @if ($pro['media']->isNotEmpty())
                                        @foreach ($pro['media'] as $media)
                                            @if ($media['is_main'])
                                                @php
                                                    $imgSrc = asset('storage/' . $media['media_path']);
                                                @endphp
                                                @break

                                            @else
                                                @php
                                                    $imgSrc = asset('storage/default.jpg');
                                                @endphp
                                            @endif
                                        @endforeach
                                    @else
                                        @php
                                            $imgSrc = asset('storage/default.jpg');
                                        @endphp
                                    @endif
                                    <img src="{{ $imgSrc }}" alt=""
                                        class="object-fit w-full lg:h-55 h-45 rounded-t-2xl">
                                </a>
                                <div class="w-full  px-4">
                                    <div
                                        class="w-full flex flex-col gap-4 justify-center items-end xl:text-sm lg:text-xs sm:text-[11px] md:text-sm text-xs">
                                        <p class="w-full truncate text-nowrap font-bold text-[var(--text)] text-left">
                                            {{ $pro['title'] }}
                                        </p>
                                        @if ($pro['primary_price'])
                                            @if ($pro['secondary_price'])
                                                <div class="flex items-center gap-2 text-end">
                                                    <span
                                                        class="text-xs text-gray-400 font-bold line-through">{{ $pro['primary_price'] }}</span>
                                                    <span
                                                        class="text-[var(--gold)] w-full text-left">{{ $pro['secondary_price'] }}
                                                        <span class="text-[10px]">تومان</span>
                                                    </span>
                                                </div>
                                            @else
                                                <span
                                                    class="text-[var(--gold)] w-full text-left">{{ $pro['primary_price'] }}
                                                    <span class="text-[10px]">تومان</span>
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-[var(--gold)] w-full text-left text-[10px]">برای استعلام قیمت
                                                تماس بگیرید</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="w-full flex justify-center">
        <div class="w-11/12 py-2 lg:px-10 px-5 bg-[#18092A] rounded-xl flex justify-between"
            style="background: linear-gradient(276deg,rgba(24, 9, 42, 1) 68%, rgba(34, 9, 48, 1) 100%);">
            <div class="max-sm:w-full h-full flex max-sm:flex-col justify-start items-center gap-5">
                <span onclick="consultForm('open')"
                    class="lg:px-8 sm:px-5 max-sm:w-full py-3 flex gap-3 justify-center items-center rounded-2xl gradient_box1 border-2 border-[var(--gold)] cursor-pointer transition_root">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="lg:size-6 size-4"
                            fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M4 13v-1a8 8 0 0 1 16 0v1"></path>
                            <rect x="2" y="13" width="5" height="7" rx="1.5"></rect>
                            <rect x="17" y="13" width="5" height="7" rx="1.5"></rect>
                            <path d="M20 20v1a3 3 0 0 1-3 3h-3"></path>
                        </svg>
                    </div>
                    <span class="xl:text-lg max-lg:text-sm text-xs text-white font-bold">ثبت درخواست مشاوره</span>
                </span>
                <div class="max-sm:w-full flex flex-col gap-2 justify-center items-start max-sm:items-center">
                    <h5 class="lg:text-lg max-sm:text-sm text-[var(--text)]">نیاز به مشاوره دارید؟</h5>
                    <p class="max-lg:text-sm max-sm:text-xs text-[var(--text-secondary)]">همکارن ما آماده پاسخگویی
                        به سوالات شما هستن</p>
                </div>
            </div>

            <div class="max-sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="lg:size-15 size-10" fill="none"
                    stroke="var(--gold)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 13v-1a8 8 0 0 1 16 0v1"></path>
                    <rect x="2" y="13" width="5" height="7" rx="1.5"></rect>
                    <rect x="17" y="13" width="5" height="7" rx="1.5"></rect>
                    <path d="M20 20v1a3 3 0 0 1-3 3h-3"></path>
                </svg>
            </div>
        </div>
    </section>
    <!-- up_footer -->
    <!-- consult form popup -->
    <div id="consultForm"
        class="w-full h-dvh fixed top-0 left-0 flex justify-center items-center invisible opacity-0 max-md:px-5 transition-all duration-300 z-5">
        <div class="size-full bg-black/50 absolute backdrop-blur-[5px]" onclick="consultForm('close')"></div>
        <div class="max-h-120 overflow-auto relative p-4 sm:p-10 w-full md:w-3/4 xl:w-1/2 bg-[#1B1C1E] rounded-2xl"
            style="scrollbar-width: none">
            <button
                class="absolute z-1 top-1 left-1 size-6 flex flex-col justify-center items-center cursor-pointer bg-white rounded-full "
                onclick="consultForm('close')">
                <span class=" w-2/3 h-[2.5px] rounded-full bg-slate-500 rotate-45
              translate-y-1/2"></span>
                <span class="w-2/3 h-[2.5px] rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
            </button>
            <form action="{{ route('consultRequest.store') }}" method="post" enctype="multipart/form-data"
                class="w-full h-full grid grid-cols-1 md:grid-cols-2 grid-rows-7 md:grid-rows-5 gap-5">
                @csrf
                <div class="w-full flex flex-col">
                    <label for="name" class="mb-2 flex flex-row items-center text-[var(--text)]">
                        <span>
                            نام :
                            <span class="text-rose-500">*</span>
                        </span>
                    </label>
                    <input type="text"
                        class="text-xs outline-none pr-5 py-4 border border-[var(--gold)] rounded-[12px] text-[var(--text)]"
                        name="name" id="name" placeholder="نام را وارد کنید" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full flex flex-col">
                    <label for="family" class="mb-2 flex flex-row items-center text-[var(--text)]">
                        <span>
                            نام خانوادگی :
                            <span class="text-rose-500">*</span>
                        </span>
                    </label>
                    <input type="text"
                        class="text-xs outline-none pr-5 py-4 border border-[var(--gold)] rounded-[12px] text-[var(--text)]"
                        name="family" id="family" placeholder="نام خانوادگی را وارد کنید"
                        value="{{ old('family') }}">
                    @error('family')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full flex flex-col">
                    <label for="phoneNumber" class="mb-2 flex flex-row items-center text-[var(--text)]">
                        <span>
                            شماره تلفن :
                            <span class="text-rose-500">*</span>
                        </span>
                    </label>
                    <input type="tel"
                        class="text-right text-xs outline-none pr-5 py-4 border border-[var(--gold)] rounded-[12px] text-[var(--text)]"
                        name="phoneNumber" id="phoneNumber" placeholder="0912345678" value="{{ old('phoneNumber') }}">
                    @error('phoneNumber')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full flex flex-col">
                    <label for="email" class="mb-2 text-[var(--text)]">
                        <span>
                            ایمیل :
                        </span>
                    </label>
                    <input type="text"
                        class="text-xs outline-none pr-5 py-4 border border-[var(--gold)] rounded-[12px] text-[var(--text)]"
                        name="email" id="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full flex flex-col md:col-span-2">
                    <label for="subject" class="mb-2 flex flex-row items-center text-[var(--text)]">
                        <span>
                            موضوع و عنوان درخواست :
                        </span>
                        <span class="text-rose-500">*</span>
                    </label>
                    <input type="text"
                        class="text-xs outline-none pr-5 py-4 border border-[var(--gold)] rounded-[12px] text-[var(--text)]"
                        name="subject" id="subject"
                        placeholder="مثال : مشاوره در مورد جنس و متریال استفاده شده در محصولات."
                        value="{{ old('subject') }}">
                    @error('subject')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full flex flex-col md:col-span-2 row-span-2">
                    <label for="text" class="mb-2 flex flex-row items-center text-[var(--text)]">
                        <span>
                            متن درخواست :
                        </span>
                        <span class="text-rose-500">*</span>
                    </label>
                    <textarea class="text-xs outline-none pr-5 py-4 border border-[var(--gold)] rounded-[12px] text-[var(--text)] h-full"
                        name="text" id="text">{{ old('text') }}</textarea>
                    @error('text')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="md:col-span-2 text-center">
                    <button type="submit"
                        class="py-3 px-10 rounded-[10px] bg-[var(--gold)] text-white cursor-pointer">ثبت</button>
                </div>
            </form>
        </div>
    </div>

    <div class="absolute top-0 opacity-0 invisible right-1/2 translate-x-1/2 w-3/4 lg:w-1/3 bg-white rounded-lg shadow-md transition-all duration-500 z-99999999"
        id="message">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="size-4 absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer" onclick="showMessage('close')"
                viewBox="0 0 384 512">
                <path
                    d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z" />
            </svg>

        </div>
    </div>
    <div id="authenticationDiv"
        class="w-full h-dvh fixed top-0 left-0 flex justify-center items-center invisible opacity-0 max-md:px-5 transition-all duration-300 z-5">
        <div class="size-full bg-black/50 absolute backdrop-blur-[5px]" onclick="closeLoginForm()"></div>
        <div class="max-h-120 overflow-auto relative p-4 sm:p-10 w-full md:w-3/4 xl:w-1/2 bg-[#1B1C1E] rounded-2xl"
            style="scrollbar-width: none">
            <button
                class="absolute z-1 top-1 left-1 size-6 flex flex-col justify-center items-center cursor-pointer bg-white rounded-full "
                onclick="closeLoginForm()">
                <span class=" w-2/3 h-[2.5px] rounded-full bg-slate-500 rotate-45
              translate-y-1/2"></span>
                <span class="w-2/3 h-[2.5px] rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
            </button>
            <h3 class="text-center text-sm font-bold text-gray-400">ابتدا وارد شوید</h3>
            <form action="{{ route('user.checkUserPopup') }}" class="flex flex-col items-center my-6 gap-3 w-full"
                method="post" id="loginForm">
                @csrf
                <input type="number"
                    class="placeholder-gray-400 focus:border-1 focus:border-[#d5a743] p-2 md:p-[9px] mb-1 rounded-[7px] border-1 border-[#DBDFE9] focus:outline-none w-full"
                    name="phoneNumber" id="phoneNumber" placeholder="شماره تلفن" required>
                <div class="w-full" id="login">
                    <div class="w-full flex flex-row items-center gap-3">
                        <input type="number"
                            class="w-8/12 p-2 placeholder-gray-400 focus:border-[#d5a743] md:p-[9px] rounded-[7px] border-1 border-[#DBDFE9] outline-none"
                            name="code" placeholder="کد" required id="code">
                        <button type="button"
                            class="w-4/12 text-xs lg:text-base h-full p-2 md:p-[9px] rounded-[7px] bg-[#d5a743] text-white cursor-pointer"
                            onclick="sendCode()" id="countDown">ارسال کد
                        </button>
                    </div>
                </div>
                <div class="w-full flex flex-row items-center justify-between" id="loginWay">
                    <a href="{{ route('user.forgetPassword') }}"
                        class="text-[#d5a743] inline-block max-md:my-1 my-4 max-md:text-sm">فراموشی رمز عبور</a>
                    <span class="text-[#d5a743] inline-block max-md:my-1 my-4 max-md:text-sm cursor-pointer"
                        onclick="loginWithPassKey(this)">ورود با رمز عبور</span>
                </div>
                <button onclick="check(event)"
                    class="focus:bg-[#d5a743] hover:bg-[#d5a743] transition-all duration-400 text-center w-full bg-[#d5a743] p-2 md:p-3 rounded-[10px] text-white cursor-pointer">
                    ورود
                </button>
                <div class="w-full text-center">
                    <span class="text-[#4B5675] mt-1 md:mt-5 max-md:text-sm">
                        هنوز عضو نشدی؟
                        <a href="{{ route('user.signup') }}" class="text-[#d5a743] mr-2">ثبت نام!</a>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal سبد خرید -->
    <div id="shoppingCartModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- بک‌گراند -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeShoppingCart()"></div>

            <!-- محتوای مودال -->
            <div
                class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl">
                <!-- هدر -->
                <div
                    class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                        🛒 سبد خرید
                    </h3>
                    <button onclick="closeShoppingCart()"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- لیست آیتم‌ها -->
                <div id="cartItemsList" class="p-6 overflow-y-auto max-h-[calc(90vh-180px)]">
                    {{-- <div id="cartLoading" class="flex justify-center items-center py-12">
                        <div class="w-8 h-8 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                    </div> --}}
                    <div id="cartEmpty" class="hidden text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <p class="mt-4 text-gray-500 dark:text-gray-400">سبد خرید شما خالی است</p>
                    </div>
                    <div id="cartItemsContainer" class="hidden space-y-4">
                        <!-- آیتم‌ها با جاوااسکریپت اضافه می‌شوند -->
                    </div>
                </div>

                <!-- فوتر با دکمه‌ها -->
                <div
                    class="sticky bottom-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-6 py-4">
                    <div class="flex justify-between items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-600 dark:text-gray-300">جمع کل:</span>
                            <span id="cartTotalPrice" class="text-xl font-bold text-white">0</span>
                            <span class="text-gray-300">تومان</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="canceleOrder()"
                                class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                                id="cancelOrderBtn">
                                لغو همه
                            </button>
                            <button onclick="submitOrder()"
                                class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-primary-dark transition disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submitOrderBtn">
                                ثبت سفارشات
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let proId = "{{ $product->id }}"

        function consultForm(state) {
            let consultForm = document.getElementById('consultForm')
            if (state == 'open') {
                consultForm.classList.remove('opacity-0', 'invisible');
            }
            if (state == 'close') {
                consultForm.classList.add('opacity-0', 'invisible');
            }
        }
        let boxTitles = document.querySelectorAll('.box-titles')
        boxTitles.forEach(title => {
            title.addEventListener('click', () => {
                boxTitles.forEach(el => {
                    el.children[0].classList.remove('text-[var(--gold)]')
                    el.children[0].classList.add('text-[var(--text)]')
                    el.children[1].children[0].classList.remove('bg-[var(--gold)]')
                    el.children[1].children[0].classList.add('bg-[var(--text)]')
                });
                title.children[0].classList.add('text-[var(--gold)]')
                title.children[0].classList.remove('text-[var(--text)]')
                title.children[1].children[0].classList.add('bg-[var(--gold)]')
                title.children[1].children[0].classList.remove('bg-[var(--text)]')

                let boxContent = document.getElementById('box-content')
                boxContent.innerHTML = ''
                if (title.dataset.id == 'desc') {
                    boxContent.innerHTML = `
                            <p class="xl:text-lg lg:text-sm sm:text-xs text-[10px] text-[var(--text)] leading-8 text-justify">
                                ${title.dataset.info}
                            </p>`
                }
                if (title.dataset.id == 'attr') {
                    let arr = JSON.parse(title.dataset.info)
                    innerElements = `
                    <div class="w-full h-full flex flex-col gap-4 items-center py-2 ">`
                    arr.forEach(item => {
                        innerElements +=
                            `
                            <div class="w-11/12 sm:w-3/4 flex gap-2 justify-between">
                                <div class="w-1/2 flex justify-start items-center py-2 pr-4 bg-[#212224]">
                                    <span
                                        class="xl:text-lg max-lg:text-sm max-sm:text-xs font-bold text-[var(--gold)]">${ item['attribute_key'] }</span>
                                </div>
                                <div class="w-1/2 flex justify-start items-center py-2 px-3 max-sm:px-1 bg-[#212224]">
                                    <span
                                        class="max-xl:text-sm max-lg:text-xs max-sm:text-[10px] text-[var(--text)]">${ item['attribute_value'] }</span>
                                </div>
                            </div>
                        `
                    });
                    innerElements += `</div>`
                    boxContent.innerHTML = innerElements
                }
            })
        });

        // showMessage
        function showMessage(state) {
            if (state == 'open') {
                message.classList.remove('top-0')
                message.classList.remove('opacity-0')
                message.classList.remove('invisible')
                message.classList.add('top-1/10')
            }
            if (state == 'close') {
                message.classList.remove('top-1/10')
                message.classList.add('top-0')
                message.classList.add('opacity-0')
                message.classList.add('invisible')
            }
        }
        // loginWithPassKey
        function loginWithPassKey(el) {
            login.innerHTML = `
                <input type="password"
                    class="placeholder-gray-400 focus:border-1 focus:border-[#d5a743] p-2 md:p-[9px] mb-1 rounded-[7px] border-1 border-[#DBDFE9] focus:outline-none w-full"
                    name="password" id="password" placeholder="کلمه عبور" required>
            `
            el.parentElement.children[1].remove()
            let span = document.createElement('span')
            span.classList = "text-[#d5a743] inline-block max-md:my-1 my-4 max-md:text-sm cursor-pointer"
            span.setAttribute('onclick', 'loginWithActivationCode(this)')
            span.innerText = "ورود با کد فعال ساز"
            loginWay.appendChild(span)
        }
        // loginWithActivationCode
        function loginWithActivationCode(el) {
            login.innerHTML = `
                <div class="w-full flex flex-row items-center gap-3">
                    <input type="number"
                        class="w-8/12 p-2 placeholder-gray-400 focus:border-[#d5a743] md:p-[9px] rounded-[7px] border-1 border-[#DBDFE9] outline-none"
                        name="code" placeholder="کد" required id="code">
                    <button type="button"
                        class="w-4/12 text-xs lg:text-base h-full p-2 md:p-[9px] rounded-[7px] bg-[#d5a743] text-white cursor-pointer"
                        onclick="sendCode()" id="countDown">ارسال کد </button>
                </div>
            `
            el.parentElement.children[1].remove()
            let span = document.createElement('span')
            span.classList = "text-[#d5a743] inline-block max-md:my-1 my-4 max-md:text-sm cursor-pointer"
            span.setAttribute('onclick', 'loginWithPassKey(this)')
            span.innerText = "ورود با رمز عبور"
            loginWay.appendChild(span)
        }
    </script>
@endsection
