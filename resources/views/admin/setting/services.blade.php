@extends('admin.app.dashboard')
@section('title', 'طبابوک | تنظیمات بخش خدمات')
@section('content')
<div class="max-w-6xl mx-auto pb-24">

    <!-- ==================== عنوان صفحه ==================== -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <span>تنظیمات</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="text-gray-800 font-medium">بخش خدمات</span>
        </div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">تنظیمات بخش خدمات</h1>
        <p class="text-gray-500 mt-2 text-sm md:text-base">
            مدیریت پنج بخش خدمات (عنوان، زیرعنوان و تصویر).
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.74-2.99l-6.93-12a2 2 0 00-3.48 0l-6.93 12A2 2 0 005.07 19z"/>
                </svg>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-sm text-emerald-800">{{ session('success') }}</span>
        </div>
    @endif

    <form id="servicesForm" class="space-y-6" action="{{ route('setting.serviceStore') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- ==================== پیش‌نمایش زنده ==================== -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-l from-gray-50 to-transparent px-6 py-4">
                <h2 class="text-base md:text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </span>
                    پیش‌نمایش زنده
                </h2>
            </div>

            <div class="p-6 bg-gradient-to-br from-gray-50 to-white">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-4">

                    @php
                        $colors = ['indigo', 'emerald', 'amber', 'rose', 'sky'];
                    @endphp

                    @for ($i = 1; $i <= 5; $i++)
                        @php
                            $color = $colors[$i - 1];
                            $title = ${"serviceTitle{$i}"};
                            $subtitle = ${"serviceSubTitle{$i}"};
                            $image = ${"serviceImage{$i}"};
                        @endphp

                        <div class="rounded-2xl bg-white border border-gray-100 p-4 text-center shadow-sm hover:shadow-md transition">
                            <div class="w-14 h-14 mx-auto mb-3 rounded-xl bg-{{ $color }}-50 flex items-center justify-center overflow-hidden">
                                <img id="previewImage{{ $i }}"
                                     src="{{ asset('storage/'.$image->meta_value) ?? '' }}"
                                     alt=""
                                     class="w-full h-full object-contain {{ isset($image) && asset('storage/'.$image->meta_value) ? '' : 'hidden' }}">
                                <div id="previewPlaceholder{{ $i }}"
                                     class="{{ isset($image) && asset('storage/'.$image->meta_value) ? 'hidden' : '' }} text-gray-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <h4 id="previewTitle{{ $i }}" class="font-bold text-sm text-gray-800 mb-1 line-clamp-1">
                                {{ $title->meta_value ?? "عنوان سرویس {$i}" }}
                            </h4>
                            <p id="previewSubtitle{{ $i }}" class="text-[11px] text-gray-500 leading-relaxed line-clamp-2">
                                {{ $subtitle->meta_value ?? "زیرعنوان سرویس {$i}" }}
                            </p>
                        </div>
                    @endfor

                </div>
            </div>
        </div>

        <!-- ==================== پنج سرویس ==================== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">

            @php
                $services = [
                    ['num' => 1, 'icon' => 'truck',    'color' => 'indigo'],
                    ['num' => 2, 'icon' => 'shield',   'color' => 'emerald'],
                    ['num' => 3, 'icon' => 'sparkles', 'color' => 'amber'],
                    ['num' => 4, 'icon' => 'heart',    'color' => 'rose'],
                    ['num' => 5, 'icon' => 'headset',  'color' => 'sky'],
                ];
            @endphp

            @foreach ($services as $service)
                @php
                    $n      = $service['num'];
                    $color  = $service['color'];
                    $title  = ${"serviceTitle{$n}"};
                    $subtitle = ${"serviceSubTitle{$n}"};
                    $image  = ${"serviceImage{$n}"};
                @endphp

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="border-b border-gray-100 bg-gradient-to-l from-{{ $color }}-50/60 to-transparent px-5 py-4">
                        <h2 class="text-base font-semibold text-gray-800 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-{{ $color }}-100 text-{{ $color }}-600 flex items-center justify-center">

                                @switch($service['icon'])
                                    @case('truck')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                                        </svg>
                                        @break
                                    @case('shield')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        @break
                                    @case('sparkles')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                        </svg>
                                        @break
                                    @case('heart')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        @break
                                    @case('headset')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3"/>
                                        </svg>
                                        @break
                                @endswitch

                            </span>
                            سرویس {{ $n }}
                        </h2>
                    </div>

                    <div class="p-5 space-y-5 flex-1">

                        <!-- تصویر -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">تصویر</label>
                            <div class="group border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-{{ $color }}-400 hover:bg-{{ $color }}-50/30 transition cursor-pointer relative"
                                 onclick="document.getElementById('serviceImage{{ $n }}').click()">
                                <img id="serviceImagePreview{{ $n }}"
                                     src="{{ asset('storage/'.$image->meta_value) ?? '' }}"
                                     alt=""
                                     class="w-full h-32 object-contain rounded-lg mb-3 bg-gray-50 {{ isset($image) && asset('storage/'.$image->meta_value) ? '' : 'hidden' }}">
                                <div id="serviceImagePlaceholder{{ $n }}"
                                     class="{{ isset($image) && asset('storage/'.$image->meta_value) ? 'hidden' : '' }}">
                                    <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-{{ $color }}-50 flex items-center justify-center group-hover:bg-{{ $color }}-100 transition">
                                        <svg class="w-6 h-6 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-700">برای انتخاب تصویر کلیک کنید</p>
                                    <p class="text-xs text-gray-400 mt-1">PNG شفاف یا JPG - حداکثر ۱ مگابایت</p>
                                </div>
                                <input type="file"
                                       id="serviceImage{{ $n }}"
                                       name="serviceImage{{ $n }}"
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewServiceImage(event, {{ $n }})">
                            </div>
                        </div>

                        <!-- عنوان -->
                        <div>
                            <label for="serviceTitle{{ $n }}" class="block text-sm font-medium text-gray-700 mb-2">عنوان</label>
                            <input type="text"
                                   id="serviceTitle{{ $n }}"
                                   name="serviceTitle{{ $n }}"
                                   value="{{ old('serviceTitle' . $n, $title->meta_value ?? '') }}"
                                   placeholder="مثلا: ارسال سریع"
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-{{ $color }}-500 focus:ring-4 focus:ring-{{ $color }}-100 outline-none transition">
                        </div>

                        <!-- زیرعنوان -->
                        <div>
                            <label for="serviceSubTitle{{ $n }}" class="block text-sm font-medium text-gray-700 mb-2">زیرعنوان / توضیح</label>
                            <textarea id="serviceSubTitle{{ $n }}"
                                      name="serviceSubTitle{{ $n }}"
                                      rows="3"
                                      placeholder="مثلا: ارسال به سراسر کشور در کمترین زمان"
                                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 focus:bg-white focus:border-{{ $color }}-500 focus:ring-4 focus:ring-{{ $color }}-100 outline-none transition resize-none">{{ old('serviceSubTitle' . $n, $subtitle->meta_value ?? '') }}</textarea>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        <!-- ==================== دکمه‌های عملیات ==================== -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky bottom-4 z-20 backdrop-blur">
            <button type="reset"
                class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-700 font-medium hover:bg-gray-50 transition focus:outline-none focus:ring-4 focus:ring-gray-100">
                بازنشانی
            </button>
            <button type="submit"
                class="px-6 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 shadow-sm hover:shadow transition flex items-center justify-center gap-2 focus:outline-none focus:ring-4 focus:ring-indigo-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                ذخیره تغییرات
            </button>
        </div>

    </form>
</div>

<script>
    /* ---------- پیش‌نمایش تصویر سرویس ---------- */
    function previewServiceImage(event, num) {
        const file = event.target.files[0];
        if (!file) return;

        // اعتبارسنجی حجم (1MB)
        if (file.size > 1024 * 1024) {
            alert('حجم تصویر نباید بیشتر از ۱ مگابایت باشد.');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('serviceImagePreview' + num);
            const placeholder = document.getElementById('serviceImagePlaceholder' + num);
            const preview = document.getElementById('previewImage' + num);
            const previewPlaceholder = document.getElementById('previewPlaceholder' + num);

            img.src = e.target.result;
            img.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');

            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (previewPlaceholder) previewPlaceholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    /* ---------- پیش‌نمایش زنده فیلدهای متنی ---------- */
    document.addEventListener('DOMContentLoaded', () => {
        for (let i = 1; i <= 5; i++) {
            const titleInput = document.getElementById('serviceTitle' + i);
            const subtitleInput = document.getElementById('serviceSubTitle' + i);
            const titlePreview = document.getElementById('previewTitle' + i);
            const subtitlePreview = document.getElementById('previewSubtitle' + i);

            if (titleInput && titlePreview) {
                titleInput.addEventListener('input', () => {
                    titlePreview.textContent = titleInput.value || titleInput.placeholder || '';
                });
            }
            if (subtitleInput && subtitlePreview) {
                subtitleInput.addEventListener('input', () => {
                    subtitlePreview.textContent = subtitleInput.value || subtitleInput.placeholder || '';
                });
            }
        }
    });

    /* ---------- جلوگیری از ارسال دوباره فرم ---------- */
    document.getElementById('servicesForm').addEventListener('submit', function () {
        const btn = this.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = `
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                در حال ذخیره...
            `;
        }
    });
</script>
@endsection