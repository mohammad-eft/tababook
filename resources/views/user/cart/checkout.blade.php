@extends('app.document')
@section('title', 'پرداخت')
@section('content')
    <form action="{{ route('order.store') }}" method="POST" class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 mt-5">

        <div class="lg:col-span-7 xl:col-span-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold mb-6 text-gray-700">صورت حساب و حمل و نقل</h2>
            
            <div class="space-y-5">
                @csrf
                <input type="hidden" name="products" id="productsInput">
                <input type="hidden" name="packs" id="packsInput">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">نام <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : "" }}" class="w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">نام خانوادگی <span class="text-red-500">*</span></label>
                        <input type="text" name="family" value="{{ Auth::check() ? Auth::user()->family : "" }}" class="w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none" required>
                    </div>
                </div>
               

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">استان <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="province" class="w-full bg-gray-100 border-none rounded-lg p-3 appearance-none focus:ring-2 focus:ring-(--bg-dark-green) focus:ring-(--bg-dark-green) outline-none cursor-pointer
               [&>option]:bg-(--bg-dark-green) [&>option]:text-white">
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" @if (Auth::check() && (count(Auth::user()->addresses) && Auth::user()->addresses[0]->city->province->id == $province->id)) selected @endif>{{ $province->title }}</option>
                                @endforeach
                            </select>
                            <div class="absolute left-3 top-3.5 pointer-events-none text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">شهر <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="cityId" id="city" class="w-full bg-gray-100 border-none rounded-lg p-3 appearance-none focus:ring-2 focus:ring-(--bg-dark-green) focus:ring-(--bg-dark-green) outline-none cursor-pointer
               [&>option]:bg-(--bg-dark-green) [&>option]:text-white">
                                <option disabled>یک شهر انتخاب کنید</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if (Auth::check() && (count(Auth::user()->addresses) && Auth::user()->addresses[0]->city->id == $city->id)) selected @endif>{{ $city->title }}</option>
                                @endforeach
                            </select>
                            <div class="absolute left-3 top-3.5 pointer-events-none text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">جزئیات آدرس <span class="text-red-500">*</span></label>
                    <input type="text" name="address" value="{{ Auth::check() ? (count(Auth::user()->addresses) ? Auth::user()->addresses[0]->address : '') : "" }}" placeholder="نام خیابان و پلاک خانه" class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">کد پستی (اختیاری)</label>
                    <input type="text" name="postalCode" value="{{ Auth::check() ? (count(Auth::user()->addresses) ? Auth::user()->addresses[0]->postalCode : '') : "" }}" class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none" dir="ltr">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">تلفن <span class="text-red-500">*</span></label>
                    <input type="tel" name="phoneNumber" value="{{ Auth::check() ? Auth::user()->phoneNumber : "" }}" class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">آدرس ایمیل (اختیاری)</label>
                    <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : "" }}" class="w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none" dir="ltr">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">کد ملی (اختیاری)</label>
                    <input type="text" name="nationalCode" value="{{ Auth::check() ? Auth::user()->nationalCode : "" }}" class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none" dir="ltr">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">توضیحات تکمیلی</label>
                    <textarea rows="4" name="description" placeholder="یادداشت‌ها درباره سفارش شما، برای مثال نکات مهم درباره نحوه تحویل سفارش." class="in-fa w-full bg-gray-100 border-none rounded-lg p-3 focus:ring-2 focus:ring-(--bg-dark-green) outline-none resize-none"></textarea>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 xl:col-span-4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 sticky top-8">
                <h2 class="text-lg font-bold mb-6 text-gray-700">سفارش شما</h2>

                <div class="border border-gray-200 rounded-lg overflow-hidden mb-6">
                    <div class="flex justify-between bg-gray-50 p-3 border-b border-gray-200 text-sm font-bold text-gray-700">
                        <span>محصول</span>
                        <span>جمع جزء</span>
                    </div>

                    <div id="parentCheckout"></div>

                    <div class="p-3 border-b border-gray-200 text-sm">
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
                    </div>

                    <div class="flex justify-between p-3 border-b border-gray-200 text-sm font-bold">
                        <span>مجموع</span>
                        <span id="totalPriceCheckout">0</span>
                    </div>

                    <div class="flex justify-between p-3 bg-gray-50 text-sm font-bold text-gray-800">
                        <span>سود شما از این خرید</span>
                        <span class="text-(--discount-color)" id="totalDiscountCheckout">0</span>
                    </div>
                </div>

                <div class="bg-gray-100/80 p-4 rounded-lg border border-gray-200 mb-4">
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
                </div>

                <button class="w-full bg-(--purple-btn) text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md cursor-pointer">
                    پرداخت با زرین‌پال
                </button>
            </div>
        </div>

    </form>

    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection