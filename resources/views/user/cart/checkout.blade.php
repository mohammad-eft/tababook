@extends('app.document')
@section('title', 'پرداخت')
@section('content')
    <style>
        .card-glow {
            box-shadow: 0 20px 35px -8px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
        }

        .card-number {
            direction: ltr;
            font-family: 'Courier New', monospace;
            letter-spacing: 0.12em;
        }

        .sheba-number {
            direction: ltr;
            font-family: 'Courier New', monospace;
            letter-spacing: 0.06em;
        }
    </style>
    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data"
        class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 mt-5">

        <div class="lg:col-span-7 xl:col-span-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold mb-6 text-gray-700">صورت حساب و حمل و نقل</h2>

            <div class="space-y-5">
                @csrf
                <input type="hidden" name="products" id="productsInput">
                <input type="hidden" name="packs" id="packsInput">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">نام <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}"
                            class="w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">نام خانوادگی <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="family" value="{{ Auth::check() ? Auth::user()->family : '' }}"
                            class="w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none"
                            required>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">استان <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="province"
                                class="w-full bg-gray-100 border-none rounded-lg p-3 appearance-none focus:ring-2 focus:ring-(--bg-dark-green) focus:ring-(--bg-dark-green) outline-none cursor-pointer
               [&>option]:bg-(--bg-dark-green) [&>option]:text-white">
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" @if (Auth::check() &&
                                            (count(Auth::user()->addresses) && Auth::user()->addresses[0]->city->province->id == $province->id)) selected @endif>
                                        {{ $province->title }}</option>
                                @endforeach
                            </select>
                            <div class="absolute left-3 top-3.5 pointer-events-none text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">شهر <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="cityId" id="city"
                                class="w-full bg-gray-100 border-none rounded-lg p-3 appearance-none focus:ring-2 focus:ring-(--bg-dark-green) focus:ring-(--bg-dark-green) outline-none cursor-pointer
               [&>option]:bg-(--bg-dark-green) [&>option]:text-white">
                                <option disabled>یک شهر انتخاب کنید</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if (Auth::check() && (count(Auth::user()->addresses) && Auth::user()->addresses[0]->city->id == $city->id)) selected @endif>
                                        {{ $city->title }}</option>
                                @endforeach
                            </select>
                            <div class="absolute left-3 top-3.5 pointer-events-none text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">جزئیات آدرس <span class="text-red-500">*</span></label>
                    <input type="text" name="address"
                        value="{{ Auth::check() ? (count(Auth::user()->addresses) ? Auth::user()->addresses[0]->address : '') : '' }}"
                        placeholder="نام خیابان و پلاک خانه"
                        class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">کد پستی (اختیاری)</label>
                    <input type="text" name="postalCode"
                        value="{{ Auth::check() ? (count(Auth::user()->addresses) ? Auth::user()->addresses[0]->postalCode : '') : '' }}"
                        class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none"
                        dir="ltr">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">تلفن <span class="text-red-500">*</span></label>
                    <input type="tel" name="phoneNumber" value="{{ Auth::check() ? Auth::user()->phoneNumber : '' }}"
                        class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">آدرس ایمیل (اختیاری)</label>
                    <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                        class="w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none"
                        dir="ltr">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">کد ملی (اختیاری)</label>
                    <input type="text" name="nationalCode" value="{{ Auth::check() ? Auth::user()->nationalCode : '' }}"
                        class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none"
                        dir="ltr">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">توضیحات تکمیلی</label>
                    <textarea rows="4" name="description"
                        placeholder="یادداشت‌ها درباره سفارش شما، برای مثال نکات مهم درباره نحوه تحویل سفارش."
                        class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none resize-none"></textarea>
                </div>
                
                <div class="w-full flex items-center gap-5">
                    <input type="checkbox" name="" id="setUser">
                    <span class="text-sm text-(--primary-text-color)">افزودن حساب کاربری</span>
                </div>

                <div class="parentPass hidden">
                    <label class="block text-sm font-medium mb-2"> رمز عبور <span class="text-red-500">*</span></label>
                    <input type="password" name="password" placeholder="رمز عبور خود را وارد کنید " disabled id="password" class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none">
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 xl:col-span-4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 sticky top-32">
                <h2 class="text-lg font-bold mb-6 text-gray-700">سفارش شما</h2>

                <div class="border border-gray-200 rounded-lg overflow-hidden mb-6">
                    <div
                        class="flex justify-between bg-gray-50 p-3 border-b border-gray-200 text-sm font-bold text-gray-700">
                        <span>محصول</span>
                        <span>جمع جزء</span>
                    </div>

                    <div id="parentCheckout"></div>

                    {{-- <div class="p-3 border-b border-gray-200 text-sm">
                        <div class="flex justify-between mb-2">
                            <span class="font-bold">مرسوله</span>
                        </div>
                        <div class="space-y-2 text-gray-600">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="onlinePayment" value="0" class="text-blue-600 focus:ring-(--bg-dark-green)" checked>
                                <span>پرداخت درب منزل</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="onlinePayment" value="1" class="text-blue-600 focus:ring-(--bg-dark-green)">
                                <span>پرداخت آنلاین</span>
                            </label>
                        </div>
                    </div> --}}

                    <div class="flex justify-between p-3 border-b border-gray-200 text-sm font-bold">
                        <span>مجموع</span>
                        <span id="totalPriceCheckout">0</span>
                    </div>

                    <div class="flex justify-between p-3 bg-gray-50 text-sm font-bold text-gray-800">
                        <span>سود شما از این خرید</span>
                        <span class="text-(--discount-color)" id="totalDiscountCheckout">0</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="w-full max-w-[340px] sm:max-w-[380px] md:max-w-[420px] transition-all duration-300 mb-5">
                        <div
                            class="relative w-full rounded-2xl bg-gradient-to-br from-indigo-800 via-indigo-700 to-purple-800 p-5 sm:p-6 text-white shadow-2xl card-glow overflow-hidden transition hover:shadow-indigo-500/30 duration-300">

                        

                            <!-- محتوای کارت -->
                            <div class="relative z-10 h-full flex flex-col justify-between">

                                <!-- ردیف بالا: لوگو و تراشه -->
                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-2">
                                        <div
                                            class="size-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                                            <span class="text-sm font-bold text-white/90">
                                                <img src="{{ asset('img/bank.png') }}" class="size-10 rounded-full" alt="">
                                            </span>
                                        </div>
                                        <span class="text-sm font-semibold tracking-wide text-white/90">بانک مهر
                                            ایران</span>
                                    </div>
                                    <div
                                        class="w-10 h-8 rounded-md bg-gradient-to-br from-amber-200 to-amber-400/80 border border-amber-300/50 shadow-inner flex items-center justify-center">
                                        <div class="grid grid-cols-3 gap-0.5 w-6 h-5 opacity-60">
                                            <div class="border border-amber-800/30 rounded-sm"></div>
                                            <div class="border border-amber-800/30 rounded-sm"></div>
                                            <div class="border border-amber-800/30 rounded-sm"></div>
                                            <div class="border border-amber-800/30 rounded-sm"></div>
                                            <div class="border border-amber-800/30 rounded-sm"></div>
                                            <div class="border border-amber-800/30 rounded-sm"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- شماره کارت -->
                                <div class="w-full flex items-end justify-between">
                                    <div class="mt-3 sm:mt-4">
                                        <p class="text-[10px] sm:text-xs text-white/60 uppercase tracking-wider mb-0.5">
                                            شماره
                                            کارت</p>
                                        <div
                                            class="card-number text-base sm:text-lg md:text-xl font-medium text-white/95 drop-shadow-sm">
                                            6063 7311 2068 4353
                                        </div>
                                    </div>
                                    <svg class="w-6 h-6 cursor-pointer text-white" onclick="copyText('6063 7311 2068 4353')" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                            d="M9 8v3a1 1 0 0 1-1 1H5m11 4h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1v1m4 3v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-7.13a1 1 0 0 1 .24-.65L7.7 8.35A1 1 0 0 1 8.46 8H13a1 1 0 0 1 1 1Z" />
                                    </svg>

                                </div>

                                <!-- شماره شبا -->
                                <div class="w-full flex items-end justify-between">
                                    <div class="mt-2 sm:mt-3">
                                        <p class="text-[10px] sm:text-xs text-white/60 uppercase tracking-wider mb-0.5">
                                            شماره
                                            شبا</p>
                                        <div
                                            class="sheba-number flex items-center gap-1 text-[11px] sm:text-sm md:text-base font-medium text-white/95">
                                            <span class="text-white/70 font-sans">IR</span>
                                            <span class="text-sm">67 0600 2002 7001 1408 8140 01</span>
                                        </div>
                                    </div>
                                    <svg class="w-6 h-6 cursor-pointer text-white" onclick="copyText('67 0600 2002 7001 1408 8140 01')" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                            d="M9 8v3a1 1 0 0 1-1 1H5m11 4h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1v1m4 3v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-7.13a1 1 0 0 1 .24-.65L7.7 8.35A1 1 0 0 1 8.46 8H13a1 1 0 0 1 1 1Z" />
                                    </svg>

                                </div>

                                <!-- ردیف پایین: نام، تاریخ انقضا و شتاب -->
                                <div class="flex items-end justify-between mt-2 sm:mt-3">
                                    <div>
                                        <p class="text-[9px] sm:text-[10px] text-white/50 uppercase tracking-wider">به نام
                                        </p>
                                        <p class="text-sm sm:text-base font-medium text-white/90 tracking-wide">عباس ملکی
                                        </p>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-[9px] sm:text-[10px] text-white/50 uppercase tracking-wider">تاریخ
                                            انقضا</p>
                                        <p class="text-sm sm:text-base font-medium text-white/90 tracking-wider">۱۲/۲۸</p>
                                    </div>
                                    <div class="flex items-center gap-1 opacity-80">
                                        <div
                                            class="w-6 h-6 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/20">
                                            <span class="text-[8px] font-bold text-white/90">شتاب</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div
                                class="absolute top-0 left-4 right-4 h-px bg-gradient-to-r from-transparent via-white/40 to-transparent">
                            </div>
                            <div
                                class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-white/5 via-transparent to-white/10 pointer-events-none">
                            </div>
                        </div>

                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">رسید پرداخت <span
                                class="text-red-500">*</span></label>
                        <input type="file" dir="ltr" name="receipt"
                            class="w-full bg-gray-100 cursor-pointer border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none"
                            required>
                    </div>
                </div>

                {{-- <div class="bg-gray-100/80 p-4 rounded-lg border border-gray-200 mb-4">
                    <div class="flex items-center gap-2 mb-4">
                        <input type="checkbox" id="zarinpal" class="w-4 h-4 text-primary rounded focus:ring-primary border-gray-300" checked>
                        <label for="zarinpal" class="flex items-center gap-2 cursor-pointer font-bold text-gray-700">
                            <img src="https://www.zarinpal.com/assets/images/logo/logo.svg" alt="زرین‌پال" class="h-6 w-auto" onerror="this.style.display='none'"> <!-- لوگو آنلاین -->
                            <span class="text-blue-700 hidden">زرین‌پال</span> 
                            پرداخت امن زرین‌پال
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 leading-5 text-justify">
                        پرداخت امن به وسیله کلیه کارت‌های عضو شتاب از طریق درگاه زرین‌پال.
                        <br>
                        اطلاعات شخصی شما برای پردازش سفارش شما، پشتیبانی از تجربه شما در سراسر این وب سایت و برای اهداف دیگری که در سیاست حفظ حریم خصوصی ذکر شده است استفاده می‌شود.
                    </p>
                </div> --}}

                <button
                    class="w-full bg-(--purple-btn) text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md cursor-pointer">
                    ثبت
                </button>
            </div>
        </div>

    </form>

    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection
