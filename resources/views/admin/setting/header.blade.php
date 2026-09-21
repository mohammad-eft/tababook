@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد محصول')
@section('content')
 <div class="max-w-4xl mx-auto">

        <!-- عنوان صفحه -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">تنظیمات هدر و هیرو</h1>
            <p class="text-gray-500 mt-2 text-sm md:text-base">اطلاعات هدر و بخش هیرو سایت خود را در اینجا تنظیم کنید.</p>
        </div>

        <form class="space-y-6" action="{{ route('setting.storeHeaderSetting') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- ==================== بخش هدر ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        تنظیمات هدر
                    </h2>
                </div>

                <div class="p-6 space-y-5">

                    <!-- لوگو -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label class="text-sm font-medium text-gray-700 md:text-left">لوگو سایت</label>
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-lg bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                                    <img id="logoPreview" src="{{ $logo ? asset('storage/'.$logo->meta_value) : null }}" alt="" class="w-full h-full object-contain hidden">
                                    <svg id="logoPlaceholder" class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <label class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    انتخاب لوگو
                                    <input type="file" class="hidden" name="setting[logo]" accept="image/*" onchange="previewLogo(event)">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">فرمت PNG یا SVG - حداکثر ۵۰۰ کیلوبایت</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== بخش هیرو ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        تنظیمات هیرو
                    </h2>
                </div>

                <div class="p-6 space-y-5">

                    <!-- عنوان هیرو -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="heroTitle" class="text-sm font-medium text-gray-700 md:pt-2.5">عنوان اصلی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="heroTitle" name="setting[heroTitle]" placeholder="به سایت ما خوش آمدید" value="{{ $heroTitle && $heroTitle->meta_value }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- زیرعنوان -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="heroSubtitle" class="text-sm font-medium text-gray-700 md:pt-2.5">زیرعنوان</label>
                        <div class="md:col-span-2">
                            <textarea id="heroSubtitle" rows="3" name="setting[heroSubtitle]" placeholder="توضیح کوتاهی درباره کسب‌وکار شما..."
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none">{{ $heroSubtitle && $heroSubtitle->meta_value }}</textarea>
                        </div>
                    </div>

                    <!-- تصویر هیرو -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">تصویر هیرو</label>
                        <div class="md:col-span-2">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="heroPreview" src="{{ $heroBanner && asset('storage/'.$heroBanner->meta_value) }}" alt="" class="w-full h-40 object-cover rounded-lg mb-3 hidden">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <label class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" class="hidden" name="setting[heroBanner]" accept="image/*" onchange="previewHero(event)">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG - حداکثر ۲ مگابایت</p>
                            </div>
                        </div>
                    </div>

                    <!-- متن دکمه -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="heroPrimaryButton" class="text-sm font-medium text-gray-700">متن دکمه اصلی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="heroPrimaryButton" name="setting[heroPrimaryButton]" placeholder="شروع کنید"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- لینک دکمه -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="heroPrimaryButtonLink" class="text-sm font-medium text-gray-700">لینک دکمه اصلی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="heroPrimaryButtonLink" name="setting[heroPrimaryButtonLink]" placeholder="https://example.com"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition" dir="ltr">
                        </div>
                    </div>
                    <!-- متن دکمه -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="heroSecondaryButton" class="text-sm font-medium text-gray-700">متن دکمه فرعی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="heroSecondaryButton" name="setting[heroSecondaryButton]" placeholder="شروع کنید"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- لینک دکمه -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="heroSecondaryButtonLink" class="text-sm font-medium text-gray-700">لینک دکمه فرعی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="heroSecondaryButtonLink" name="setting[heroSecondaryButtonLink]" placeholder="https://example.com"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== دکمه‌های عملیات ==================== -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 bg-white rounded-xl shadow-sm border border-gray-200 p-4">
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
        // پیش‌نمایش لوگو
        function previewLogo(event) {
            const file = event.target.files[0]
            if (file) {
                const reader = new FileReader()
                reader.onload = e => {
                    const img = document.getElementById('logoPreview')
                    img.src = e.target.result
                    img.classList.remove('hidden')
                    document.getElementById('logoPlaceholder').classList.add('hidden')
                }
                reader.readAsDataURL(file)
            }
        }

        // پیش‌نمایش تصویر هیرو
        function previewHero(event) {
            const file = event.target.files[0]
            if (file) {
                const reader = new FileReader()
                reader.onload = e => {
                    const img = document.getElementById('heroPreview')
                    img.src = e.target.result
                    img.classList.remove('hidden')
                }
                reader.readAsDataURL(file)
            }
        }

        // همگام‌سازی رنگ هدر
        const headerColor = document.getElementById('headerColor')
        const headerColorText = document.getElementById('headerColorText')
        headerColor.addEventListener('input', e => {
            headerColorText.value = e.target.value
        })
    </script>

@endsection