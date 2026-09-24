@extends('app.document')
@section('title')
    ثبت سفارش
@endsection
@section('content')

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Vazirmatn', sans-serif;
      background: #f8fafc;
    }
    /* برای اسکرول‌بار زیباتر (اختیاری) */
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
    /* انیمیشن ملایم برای فوکوس */
    .input-field:focus {
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }
  </style>

  <main class="w-full max-w-2xl mx-auto">
    <!-- کارت اصلی -->
    <div class="bg-white rounded-3xl shadow-xl shadow-indigo-100/60 overflow-hidden border border-indigo-50/80 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-100/80">

      <!-- هدر کارت -->
      <div class="bg-gradient-to-l from-indigo-600 to-indigo-500 px-6 py-5 sm:px-8 sm:py-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-xl backdrop-blur-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
            </div>
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-white">فروشگاه کتاب</h1>
              <p class="text-indigo-100 text-sm mt-0.5">تکمیل اطلاعات ارسال</p>
            </div>
          </div>
          <!-- نشان مراحل -->
          <div class="hidden sm:flex items-center gap-1 text-indigo-100 text-xs font-medium">
            <span class="bg-white/20 px-2.5 py-1 rounded-full">سبد خرید</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="bg-white/30 px-2.5 py-1 rounded-full font-semibold text-white">آدرس</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="bg-white/10 px-2.5 py-1 rounded-full">پرداخت</span>
          </div>
        </div>
      </div>

      <!-- بدنه فرم -->
      <form class="p-6 sm:p-8 space-y-6" action="{{ route('order.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <!-- بخش: اطلاعات گیرنده -->
        {{-- <div class="space-y-5">
          <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-indigo-500 rounded-full inline-block"></span>
            اطلاعات گیرنده
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- نام و نام خانوادگی -->
            <div class="space-y-1.5">
              <label for="fullname" class="block text-sm font-medium text-gray-700">نام و نام خانوادگی <span class="text-rose-500">*</span></label>
              <input type="text" id="fullname" name="fullname" placeholder="مثلاً: علی محمدی" required
                class="input-field w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-400 focus:ring-0 outline-none transition bg-gray-50/50 hover:bg-white text-gray-800 placeholder-gray-400 text-sm">
            </div>

            <!-- شماره تماس -->
            <div class="space-y-1.5">
              <label for="phone" class="block text-sm font-medium text-gray-700">شماره تماس <span class="text-rose-500">*</span></label>
              <input type="tel" id="phone" name="phone" placeholder="۰۹۱۲۳۴۵۶۷۸۹" required
                class="input-field w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-400 focus:ring-0 outline-none transition bg-gray-50/50 hover:bg-white text-gray-800 placeholder-gray-400 text-sm text-left"
                dir="ltr">
            </div>
          </div>
        </div> --}}

        <!-- بخش: آدرس دقیق -->
        <div class="space-y-5 pt-2">
          <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-indigo-500 rounded-full inline-block"></span>
            آدرس تحویل
          </h2>

          <!-- استان و شهر -->
          {{-- <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
              <label for="province" class="block text-sm font-medium text-gray-700">استان <span class="text-rose-500">*</span></label>
              <select id="province" name="province" required
                class="input-field w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-400 focus:ring-0 outline-none transition bg-gray-50/50 hover:bg-white text-gray-800 text-sm appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 20 20%22%3E%3Cpath stroke=%22%236b7280%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%221.5%22 d=%22m6 8 4 4 4-4%22/%3E%3C/svg%3E')] bg-[length:1.25rem] bg-[right_1rem_center] bg-no-repeat pr-10">
                <option value="" disabled selected>انتخاب کنید</option>
                <option value="تهران">تهران</option>
                <option value="اصفهان">اصفهان</option>
                <option value="فارس">فارس</option>
                <option value="خراسان رضوی">خراسان رضوی</option>
                <option value="آذربایجان شرقی">آذربایجان شرقی</option>
                <option value="گیلان">گیلان</option>
                <option value="مازندران">مازندران</option>
                <option value="البرز">البرز</option>
                <option value="قم">قم</option>
                <option value="کردستان">کردستان</option>
              </select>
            </div>

            <div class="space-y-1.5">
              <label for="city" class="block text-sm font-medium text-gray-700">شهر <span class="text-rose-500">*</span></label>
              <input type="text" id="city" name="city" placeholder="مثلاً: تهران" required
                class="input-field w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-400 focus:ring-0 outline-none transition bg-gray-50/50 hover:bg-white text-gray-800 placeholder-gray-400 text-sm">
            </div>
          </div> --}}

          <!-- آدرس کامل -->
          <div class="space-y-1.5">
            <label for="address" class="block text-sm font-medium text-gray-700">نشانی کامل  <span class="text-rose-500">*</span></label>
            <textarea id="address" name="address" rows="3" placeholder="خیابان، کوچه، پلاک، واحد..." required
              class="input-field w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-400 focus:ring-0 outline-none transition bg-gray-50/50 hover:bg-white text-gray-800 placeholder-gray-400 text-sm resize-none"></textarea>
            <p class="text-xs text-gray-400 flex items-center gap-1 mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              لطفاً آدرس را دقیق و کامل وارد کنید.
            </p>
          </div>

          <!-- کد پستی و پلاک -->
          {{-- <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
              <label for="postalCode" class="block text-sm font-medium text-gray-700">کد پستی <span class="text-rose-500">*</span></label>
              <input type="text" id="postalCode" name="postalCode" placeholder="۱۰ رقم بدون خط تیره" required
                class="input-field w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-400 focus:ring-0 outline-none transition bg-gray-50/50 hover:bg-white text-gray-800 placeholder-gray-400 text-sm text-left"
                dir="ltr" maxlength="10" inputmode="numeric" pattern="[0-9]{10}">
            </div>
            <div class="space-y-1.5">
              <label for="plate" class="block text-sm font-medium text-gray-700">پلاک / واحد</label>
              <input type="text" id="plate" name="plate" placeholder="مثلاً: پلاک ۱۲، واحد ۳"
                class="input-field w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-400 focus:ring-0 outline-none transition bg-gray-50/50 hover:bg-white text-gray-800 placeholder-gray-400 text-sm">
            </div>
          </div> --}}
        </div>

        <!-- دکمه‌ها -->
        <div class="pt-4 border-t border-gray-100 flex flex-col-reverse sm:flex-row items-center justify-between gap-4">
          <a href="{{ route('cart.list') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition flex items-center gap-1.5 py-2 px-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            بازگشت به سبد خرید
          </a>
          <button type="submit"
            class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-semibold py-3.5 px-8 rounded-xl transition-all duration-200 shadow-lg shadow-indigo-200 hover:shadow-indigo-300 flex items-center justify-center gap-2 text-sm sm:text-base">
            ادامه و پرداخت
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>

      </form>
    </div>

    <!-- یادآوری امنیت -->
    <p class="text-center text-xs text-gray-400 mt-6 flex items-center justify-center gap-1.5">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
      </svg>
      اطلاعات شما نزد ما محفوظ است.
    </p>
  </main>

@endsection