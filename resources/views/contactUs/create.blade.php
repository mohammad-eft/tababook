@extends('app.document')

@section('title', 'طبابوک | ارتباط با ما')

@section('content')

    <div class="min-h-[75vh] bg-[#f7f9fc] py-10 lg:py-16" dir="rtl">
        <div class="2xl:container w-11/12 lg:w-10/12 mx-auto">

            {{-- Header --}}
            <div class="max-w-2xl mx-auto text-center mb-10">
                <div class="inline-flex items-center gap-2 bg-[#eef5f1] text-[#4c6b62] px-4 py-2 rounded-full text-xs font-bold mb-5">
                    <i class="fa-regular fa-comments"></i>
                    پشتیبانی طبابوک
                </div>

                <h1 class="text-2xl md:text-3xl font-black text-[#263b35] mb-4">
                    چطور می‌تونیم کمکت کنیم؟
                </h1>

                <p class="text-sm md:text-base text-gray-500 leading-8">
                    اگر سؤال، پیشنهاد یا مشکلی داری، از همین‌جا با ما در ارتباط باش.
                    پیام تو توسط تیم پشتیبانی بررسی می‌شه و در اولین فرصت پاسخ می‌دیم.
                </p>
            </div>

            {{-- Main Content --}}
            <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                {{-- Information Card --}}
                <div class="lg:col-span-1 space-y-4">

                    <div class="bg-[#4c6b62] rounded-3xl p-6 text-white relative overflow-hidden">
                        <div class="absolute -left-10 -top-10 w-36 h-36 rounded-full bg-white/10"></div>
                        <div class="absolute -left-5 -bottom-16 w-40 h-40 rounded-full bg-white/5"></div>

                        <div class="relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center mb-5">
                                <i class="fa-regular fa-headset text-2xl"></i>
                            </div>

                            <h2 class="text-lg font-black mb-3">
                                همیشه کنار تو هستیم
                            </h2>

                            <p class="text-sm text-white/80 leading-8">
                                تیم پشتیبانی طبابوک آماده پاسخ‌گویی به سؤالات و پیگیری درخواست‌های شماست.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
                        <div class="flex items-start gap-3">
                            <div class="w-11 h-11 shrink-0 rounded-xl bg-[#fdf1f2] text-[#df8290] flex items-center justify-center">
                                <i class="fa-regular fa-clock text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm mb-1">
                                    پیگیری درخواست
                                </h3>
                                <p class="text-xs text-gray-500 leading-7">
                                    بعد از ثبت پیام، می‌تونی وضعیت و پاسخ تیکتت رو از بخش لیست تیکت‌ها دنبال کنی.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
                        <div class="flex items-start gap-3">
                            <div class="w-11 h-11 shrink-0 rounded-xl bg-[#eef5f1] text-[#4c6b62] flex items-center justify-center">
                                <i class="fa-regular fa-message text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm mb-1">
                                    ارتباط مستقیم
                                </h3>
                                <p class="text-xs text-gray-500 leading-7">
                                    موضوع درخواستت رو دقیق بنویس تا بهتر و سریع‌تر راهنماییت کنیم.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Contact Form --}}
                <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm p-5 md:p-8">

                    <div class="flex items-center justify-between gap-3 mb-7">
                        <div>
                            <h2 class="text-lg font-black text-gray-800 mb-2">
                                ارسال تیکت جدید
                            </h2>
                            <p class="text-xs text-gray-400">
                                اطلاعات زیر رو وارد کن تا درخواستت ثبت بشه.
                            </p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-[#fdf1f2] text-[#df8290] flex items-center justify-center shrink-0">
                            <i class="fa-regular fa-paper-plane text-xl"></i>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-100 rounded-2xl p-4 mb-6">
                            <ul class="text-sm text-red-600 space-y-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contactUs.store') }}" method="post">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- Phone --}}
                            <div>
                                <label for="phoneNumber" class="block text-sm font-bold text-gray-700 mb-2">
                                    شماره تماس
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>

                                    <input
                                        id="phoneNumber"
                                        type="tel"
                                        inputmode="numeric"
                                        name="phoneNumber"
                                        value="{{ old('phoneNumber') }}"
                                        placeholder="مثلاً 09123456789"
                                        required
                                        class="w-full h-14 pr-11 pl-4 rounded-xl bg-[#f8fafb] border border-gray-100 text-sm text-gray-700 placeholder:text-gray-400 focus:bg-white focus:border-[#95ADA2] focus:ring-4 focus:ring-[#95ADA2]/15 outline-none transition"
                                    >
                                </div>
                            </div>

                            {{-- Title --}}
                            <div>
                                <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                                    موضوع درخواست
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </span>

                                    <input
                                        id="title"
                                        type="text"
                                        name="title"
                                        value="{{ old('title') }}"
                                        placeholder="موضوع پیام خود را بنویسید"
                                        required
                                        class="w-full h-14 pr-11 pl-4 rounded-xl bg-[#f8fafb] border border-gray-100 text-sm text-gray-700 placeholder:text-gray-400 focus:bg-white focus:border-[#95ADA2] focus:ring-4 focus:ring-[#95ADA2]/15 outline-none transition"
                                    >
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                                    متن پیام
                                    <span class="text-red-500">*</span>
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    rows="7"
                                    placeholder="توضیحات درخواست یا مشکل خود را اینجا بنویسید..."
                                    required
                                    class="w-full p-4 rounded-xl bg-[#f8fafb] border border-gray-100 text-sm text-gray-700 placeholder:text-gray-400 focus:bg-white focus:border-[#95ADA2] focus:ring-4 focus:ring-[#95ADA2]/15 outline-none transition resize-y leading-8"
                                >{{ old('description') }}</textarea>

                                <p class="text-[11px] text-gray-400 mt-2">
                                    لطفاً توضیحات کافی و دقیق وارد کنید تا بهتر راهنمایی‌تون کنیم.
                                </p>
                            </div>

                        </div>

                        {{-- Submit --}}
                        <div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-4 mt-7 pt-6 border-t border-gray-100">

                            @if (Auth::check() && Auth::user()->contactUs && count(Auth::user()->contactUs))
                                <a
                                    href="{{ route('contactUs.myMessage') }}"
                                    class="text-sm font-bold text-[#4c6b62] hover:text-[#344e45] transition flex items-center gap-2"
                                >
                                    <i class="fa-regular fa-folder-open"></i>
                                    مشاهده تیکت‌های من
                                </a>
                            @else
                                <span class="text-xs text-gray-400">
                                    پیام شما پس از ثبت برای پشتیبانی ارسال می‌شود.
                                </span>
                            @endif

                            <button
                                type="submit"
                                class="w-full sm:w-auto min-w-44 h-12 px-7 rounded-xl bg-[#4c6b62] hover:bg-[#3d5a51] text-white text-sm font-bold flex items-center justify-center gap-2 shadow-lg shadow-[#4c6b62]/15 transition duration-200 hover:-translate-y-0.5"
                            >
                                <i class="fa-regular fa-paper-plane"></i>
                                ثبت و ارسال تیکت
                            </button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection