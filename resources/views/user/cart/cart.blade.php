@extends('app.document')
@section('title', 'دسته بندی ها')
@section('content')
        <!-- Header -->
        <header class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="#" class="text-lg font-bold text-gray-800">📚 کتاب‌فروشی</a>
                <a href="#" class="text-sm text-gray-500 hover:text-gray-800 transition">ادامه خرید</a>
            </div>
        </header>

        <!-- Main -->
        <main class="max-w-5xl mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">سبد خرید</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-3">
                    @foreach(Auth::user()->carts as $cart)
                    <!-- Item 1 -->
                    <div class="bg-white rounded-2xl p-4 flex gap-4 items-center shadow-sm border border-gray-100">
                        <div
                            class="w-16 h-20 sm:w-20 sm:h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center text-2xl shrink-0">
                            <img src="{{ asset('storage/'.$cart->product->image) }}" class="size-full object-cover" alt="">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">{{ $cart->product->title }}</h3>
                            <p class="text-xs text-gray-500 mt-0.5 mb-5">{{ $cart->product->summary }}</p>
                            <div class="w-1/4 p-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="{{ $cart->product_id }}">
                                <button onclick="setCount(this)" class="w-1/3 text-lg font-bold text-white flex justify-center items-center cursor-pointer" data-state="+">+</button>
                                <input type="number" class="w-1/3 text-sm text-center outline-none text-white" readonly value="{{ $cart->quantity }}">
                                <button onclick="setCount(this)" class="w-1/3 text-lg font-bold text-white flex justify-center items-center cursor-pointer" data-state="-">-</button>
                            </div>
                        </div>
                        <div class="text-left shrink-0">
                            <p class="font-bold text-gray-800 text-sm sm:text-base in-fa">{{ $cart->product->secondary_price ? $cart->product->secondary_price*$cart->quantity : $cart->product->primary_price*$cart->quantity }}</p>
                            <p class="text-xs text-gray-400">تومان</p>
                        </div>
                    </div>
                    @endforeach
           

                </div>

                <!-- Summary -->
                <aside class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 lg:sticky lg:top-6">
                        <h2 class="font-bold text-gray-800 mb-4">خلاصه سفارش</h2>

                        <div class="space-y-2.5 text-sm">
                            <div class="flex justify-between text-gray-600">
                                <span>جمع کالاها</span>
                                <span class="in-fa">{{ $totalPrice }} تومان</span>
                            </div>
                            {{-- <div class="flex justify-between text-gray-600">
                                <span>هزینه ارسال</span>
                                <span>۳۵,۰۰۰ تومان</span>
                            </div> --}}
                            @if ($totalDiscount)
                                <div class="flex justify-between text-emerald-600">
                                    <span>تخفیف</span>
                                    <span class="in-fa">− {{ $totalDiscount }} تومان</span>
                                </div>
                            @endif
                        </div>

                        <div class="border-t border-dashed border-gray-200 my-4"></div>

                        <div class="flex justify-between items-center mb-5">
                            <span class="font-semibold text-gray-700">مبلغ قابل پرداخت</span>
                            <div class="text-left">
                                <p class="font-bold text-lg text-gray-900 in-fa">{{ $totalPrice }}</p>
                                <p class="text-xs text-gray-400">تومان</p>
                            </div>
                        </div>

                        <a href="{{ route('order.create') }}"
                            class="w-full block text-center bg-gray-900 hover:bg-gray-800 text-white font-medium py-3 rounded-xl transition">
                            تکمیل خرید
                        </a>

                        <p class="text-xs text-gray-400 text-center mt-3">
                            ارسال رایگان برای خرید بالای ۵۰۰ هزار تومان
                        </p>
                    </div>
                </aside>

            </div>
        </main>

    
@endsection
