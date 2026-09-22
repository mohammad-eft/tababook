@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد محصول')
@section('content')
<div class="max-w-4xl mx-auto">

        <!-- عنوان صفحه -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">تنظیمات تبلیغات و بنرها</h1>
            <p class="text-gray-500 mt-2 text-sm md:text-base">مدیریت تبلیغات بالا، بنر دوم و بنرهای کناری سایت.</p>
        </div>

        <form class="space-y-6" action="{{ route('setting.storeBanners') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ==================== تبلیغ بالا (Top Ads) ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        تبلیغ بالای سایت
                    </h2>
                </div>

                <div class="p-6 space-y-5">
                    <!-- تصویر تبلیغ بالا -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">تصویر تبلیغ</label>
                        <div class="md:col-span-2">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="topBannerPreview" src="{{ $topBanner ? asset('storage/'.$topBanner->meta_value) : '' }}" alt=""
                                    class="w-full h-32 object-contain rounded-lg mb-3 {{ isset($topBanner) ? '' : 'hidden' }}">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <label class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" name="setting[topBanner]" class="hidden" accept="image/*" onchange="previewImage(event, 'topBannerPreview')">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">فرمت JPG, PNG, GIF - حداکثر ۱ مگابایت</p>
                            </div>
                        </div>
                    </div>

                    <!-- لینک تبلیغ بالا -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="topBannerLink" class="text-sm font-medium text-gray-700">لینک تبلیغ</label>
                        <div class="md:col-span-2">
                            <input type="text" id="topBannerLink" name="setting[topBannerLink]"
                                value="{{ $topBannerLink->meta_value ?? '' }}"
                                placeholder="https://example.com"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== بنر دوم (Second Ads) ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        بنر دوم (Second Ads)
                    </h2>
                </div>

                <div class="p-6 space-y-5">
                    <!-- تصویر بنر دوم -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">تصویر بنر</label>
                        <div class="md:col-span-2">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="secondBannerPreview" src="{{ $secondBanner ? asset('storage/'.$secondBanner->meta_value) : '' }}" alt=""
                                    class="w-full h-40 object-cover rounded-lg mb-3 {{ isset($secondBanner) ? '' : 'hidden' }}">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <label class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" name="setting[secondBanner]" class="hidden" accept="image/*" onchange="previewImage(event, 'secondBannerPreview')">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG - حداکثر ۲ مگابایت</p>
                            </div>
                        </div>
                    </div>

                    <!-- عنوان بنر دوم -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="secondBannerTitle" class="text-sm font-medium text-gray-700">عنوان</label>
                        <div class="md:col-span-2">
                            <input type="text" id="secondBannerTitle" name="setting[secondBannerTitle]"
                                value="{{ $secondBannerTitle->meta_value ?? '' }}"
                                placeholder="عنوان بنر دوم"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- زیرعنوان بنر دوم -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="secondBannerSubtitle" class="text-sm font-medium text-gray-700 md:pt-2.5">زیرعنوان</label>
                        <div class="md:col-span-2">
                            <textarea id="secondBannerSubtitle" name="setting[secondBannerSubtitle]" rows="3"
                                placeholder="توضیح کوتاه..."
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none">{{ $secondBannerSubtitle->meta_value ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- متن دکمه بنر دوم -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="secondBannerButton" class="text-sm font-medium text-gray-700">متن دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="secondBannerButton" name="setting[secondBannerButton]"
                                value="{{ $secondBannerButton->meta_value ?? '' }}"
                                placeholder="مثلا: اطلاعات بیشتر"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- لینک دکمه بنر دوم -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="secondBannerButtonLink" class="text-sm font-medium text-gray-700">لینک دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="secondBannerButtonLink" name="setting[secondBannerButtonLink]"
                                value="{{ $secondBannerButtonLink->meta_value ?? '' }}"
                                placeholder="https://example.com"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== بنر راست (Right Banner) ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        بنر سمت راست
                    </h2>
                </div>

                <div class="p-6 space-y-5">
                    <!-- تصویر بنر راست -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">تصویر بنر</label>
                        <div class="md:col-span-2">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="rightBannerPreview" src="{{ $rightBanner ? asset('storage/'.$rightBanner->meta_value) : '' }}" alt=""
                                    class="w-full h-40 object-cover rounded-lg mb-3 {{ isset($rightBanner) ? '' : 'hidden' }}">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <label class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" name="setting[rightBanner]" class="hidden" accept="image/*" onchange="previewImage(event, 'rightBannerPreview')">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG - حداکثر ۱ مگابایت</p>
                            </div>
                        </div>
                    </div>

                    <!-- لینک بنر راست -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="rightBannerLink" class="text-sm font-medium text-gray-700">لینک بنر</label>
                        <div class="md:col-span-2">
                            <input type="text" id="rightBannerLink" name="setting[rightBannerLink]"
                                value="{{ $rightBannerLink->meta_value ?? '' }}"
                                placeholder="https://example.com"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== بنر چپ (Left Banner) ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        بنر سمت چپ
                    </h2>
                </div>

                <div class="p-6 space-y-5">
                    <!-- تصویر بنر چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">تصویر بنر</label>
                        <div class="md:col-span-2">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="leftBannerPreview" src="{{ $leftBanner ? asset('storage/'.$leftBanner->meta_value) : '' }}" alt=""
                                    class="w-full h-40 object-cover rounded-lg mb-3 {{ isset($leftBanner) ? '' : 'hidden' }}">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <label class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" name="setting[leftBanner]" class="hidden" accept="image/*" onchange="previewImage(event, 'leftBannerPreview')">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG - حداکثر ۱ مگابایت</p>
                            </div>
                        </div>
                    </div>

                    <!-- عنوان بنر چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="leftBannerTitle" class="text-sm font-medium text-gray-700">عنوان</label>
                        <div class="md:col-span-2">
                            <input type="text" id="leftBannerTitle" name="setting[leftBannerTitle]"
                                value="{{ $leftBannerTitle->meta_value ?? '' }}"
                                placeholder="عنوان بنر چپ"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- زیرعنوان بنر چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="leftBannerSubtitle" class="text-sm font-medium text-gray-700 md:pt-2.5">زیرعنوان</label>
                        <div class="md:col-span-2">
                            <textarea id="leftBannerSubtitle" name="setting[leftBannerSubtitle]" rows="3"
                                placeholder="توضیح کوتاه..."
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none">{{ $leftBannerSubtitle->meta_value ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- متن دکمه بنر چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="leftBannerButton" class="text-sm font-medium text-gray-700">متن دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="leftBannerButton" name="setting[leftBannerButton]"
                                value="{{ $leftBannerButton->meta_value ?? '' }}"
                                placeholder="مثلا: مشاهده"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- لینک دکمه بنر چپ -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="leftBannerButtonLink" class="text-sm font-medium text-gray-700">لینک دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="leftBannerButtonLink" name="setting[leftBannerButtonLink]"
                                value="{{ $leftBannerButtonLink->meta_value ?? '' }}"
                                placeholder="https://example.com"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== دکمه‌های عملیات ==================== -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 bg-white rounded-xl shadow-sm border border-gray-200 p-4 sticky bottom-4">
                <button type="reset"
                    class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                    بازنشانی
                </button>
                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700 shadow-sm hover:shadow transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    ذخیره تغییرات
                </button>
            </div>

        </form>
    </div>

    <script>
        // پیش‌نمایش عمومی تصاویر
        function previewImage(event, previewId) {
            const file = event.target.files[0]
            if (file) {
                const reader = new FileReader()
                reader.onload = e => {
                    const img = document.getElementById(previewId)
                    img.src = e.target.result
                    img.classList.remove('hidden')
                }
                reader.readAsDataURL(file)
            }
        }
    </script>
@endsection