@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد محصول')
@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- عنوان صفحه -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">تنظیمات بخش دو کارت</h1>
            <p class="text-gray-500 mt-2 text-sm md:text-base">مدیریت کارت‌های «برای خودم» و «برای هدیه».</p>
        </div>

        <form class="space-y-6" action="{{ route('setting.cardStore') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ==================== تنظیمات کل بخش ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        تنظیمات کلی بخش
                    </h2>
                </div>

                <div class="p-6 space-y-5">
                    <!-- عنوان بخش -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsSectionTitle" class="text-sm font-medium text-gray-700">عنوان بخش</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsSectionTitle" name="setting[twoCardsSectionTitle]"
                                value="{{ $twoCardsSectionTitle->meta_value ?? '' }}"
                                placeholder="مثلا: برای خودت می‌خری یا هدیه؟"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- لینک مشاهده همه - متن -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsSectionLinkText" class="text-sm font-medium text-gray-700">متن لینک «مشاهده
                            همه»</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsSectionLinkText" name="setting[twoCardsSectionLinkText]"
                                value="{{ $twoCardsSectionLinkText->meta_value ?? '' }}" placeholder="مثلا: مشاهده همه"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- لینک مشاهده همه - آدرس -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsSectionLinkUrl" class="text-sm font-medium text-gray-700">آدرس لینک «مشاهده
                            همه»</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsSectionLinkUrl" name="setting[twoCardsSectionLinkUrl]"
                                value="{{ $twoCardsSectionLinkUrl->meta_value ?? '' }}"
                                placeholder="https://example.com/all"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                                dir="ltr">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== کارت راست: برای خودم ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        کارت راست — «برای خودم»
                    </h2>
                    {{-- <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="twoCardsRightActive" value="1" class="sr-only peer"
                            {{ ($twoCardsRightActive->meta_value ?? '1') == '1' ? 'checked' : '' }}>
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                        </div>
                    </label> --}}
                </div>

                <div class="p-6 space-y-5">
                    <!-- تصویر کارت راست -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">تصویر کارت</label>
                        <div class="md:col-span-2">
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="twoCardsRightImagePreview" src="{{ $twoCardsRightImage->meta_value ?? '' }}"
                                    alt=""
                                    class="w-full h-40 object-contain rounded-lg mb-3 {{ isset($twoCardsRightImage) ? '' : 'hidden' }}">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <label
                                    class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" name="setting[twoCardsRightImage]" class="hidden" accept="image/*"
                                        onchange="previewImage(event, 'twoCardsRightImagePreview')">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">PNG شفاف یا JPG - حداکثر ۱ مگابایت</p>
                            </div>
                        </div>
                    </div>

                    <!-- عنوان کارت راست -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsRightTitle" class="text-sm font-medium text-gray-700">عنوان</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsRightTitle" name="setting[twoCardsRightTitle]"
                                value="{{ $twoCardsRightTitle->meta_value ?? '' }}" placeholder="مثلا: برای خودم"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- زیرعنوان کارت راست -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="twoCardsRightSubtitle" class="text-sm font-medium text-gray-700 md:pt-2.5">زیرعنوان /
                            توضیح</label>
                        <div class="md:col-span-2">
                            <textarea id="twoCardsRightSubtitle" name="setting[twoCardsRightSubtitle]" rows="3"
                                placeholder="مثلا: چیزکی برای خواندن، یاد گرفتن و ساختن"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none">{{ $twoCardsRightSubtitle->meta_value ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- متن دکمه کارت راست -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsRightButton" class="text-sm font-medium text-gray-700">متن دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsRightButton" name="setting[twoCardsRightButton]"
                                value="{{ $twoCardsRightButton->meta_value ?? '' }}" placeholder="مثلا: شروع خرید"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- لینک دکمه کارت راست -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsRightButtonLink" class="text-sm font-medium text-gray-700">لینک دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsRightButtonLink" name="setting[twoCardsRightButtonLink]"
                                value="{{ $twoCardsRightButtonLink->meta_value ?? '' }}"
                                placeholder="https://example.com/shop"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                                dir="ltr">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== کارت چپ: برای هدیه ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                        کارت چپ — «برای هدیه»
                    </h2>
                    {{-- <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="twoCardsLeftActive" value="1" class="sr-only peer"
                            {{ ($twoCardsLeftActive->meta_value ?? '1') == '1' ? 'checked' : '' }}>
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                        </div>
                    </label> --}}
                </div>

                <div class="p-6 space-y-5">
                    <!-- تصویر کارت چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">تصویر کارت</label>
                        <div class="md:col-span-2">
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="twoCardsLeftImagePreview" src="{{ $twoCardsLeftImage->meta_value ?? '' }}"
                                    alt=""
                                    class="w-full h-40 object-contain rounded-lg mb-3 {{ isset($twoCardsLeftImage) ? '' : 'hidden' }}">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <label
                                    class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" name="setting[twoCardsLeftImage]" class="hidden" accept="image/*"
                                        onchange="previewImage(event, 'twoCardsLeftImagePreview')">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">PNG شفاف یا JPG - حداکثر ۱ مگابایت</p>
                            </div>
                        </div>
                    </div>

                    <!-- عنوان کارت چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsLeftTitle" class="text-sm font-medium text-gray-700">عنوان</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsLeftTitle" name="setting[twoCardsLeftTitle]"
                                value="{{ $twoCardsLeftTitle->meta_value ?? '' }}" placeholder="مثلا: برای هدیه"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- زیرعنوان کارت چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="twoCardsLeftSubtitle" class="text-sm font-medium text-gray-700 md:pt-2.5">زیرعنوان /
                            توضیح</label>
                        <div class="md:col-span-2">
                            <textarea id="twoCardsLeftSubtitle" name="setting[twoCardsLeftSubtitle]" rows="3"
                                placeholder="مثلا: کتاب‌ها و محتواهایی که برای هدیه دادن انتخاب..."
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none">{{ $twoCardsLeftSubtitle->meta_value ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- متن دکمه کارت چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsLeftButton" class="text-sm font-medium text-gray-700">متن دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsLeftButton" name="setting[twoCardsLeftButton]"
                                value="{{ $twoCardsLeftButton->meta_value ?? '' }}" placeholder="مثلا: مشاهده هدیه‌ها"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- لینک دکمه کارت چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="twoCardsLeftButtonLink" class="text-sm font-medium text-gray-700">لینک دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="twoCardsLeftButtonLink" name="setting[twoCardsLeftButtonLink]"
                                value="{{ $twoCardsLeftButtonLink->meta_value ?? '' }}"
                                placeholder="https://example.com/gifts"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                                dir="ltr">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== دکمه‌های عملیات ==================== -->
            <div
                class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 bg-white rounded-xl shadow-sm border border-gray-200 p-4 sticky bottom-4">
                <button type="reset"
                    class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                    بازنشانی
                </button>
                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700 shadow-sm hover:shadow transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    ذخیره تغییرات
                </button>
            </div>

        </form>
    </div>

    <script>
        // پیش‌نمایش عمومی تصاویر
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.getElementById(previewId);
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
