@extends('admin.app.dashboard')
@section('title', 'طبابوک | تنظیمات پک ها')
@section('content')
 <div class="max-w-4xl mx-auto">

        <!-- عنوان صفحه -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">تنظیمات پک ها</h1>
            <p class="text-gray-500 mt-2 text-sm md:text-base">اطلاعات پک های سایت خود را در اینجا تنظیم کنید.</p>
        </div>

        <form class="space-y-6" action="{{ route('setting.storePackSetting') }}" method="POST" enctype="multipart/form-data">
            @csrf
          
           

            <!-- ==================== بخش پک ==================== -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        تنظیمات پک
                    </h2>
                </div>

                <div class="p-6 space-y-5">

                    <!-- عنوان هیرو -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="packTitle" class="text-sm font-medium text-gray-700 md:pt-2.5">عنوان اصلی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="packTitle" name="setting[packTitle]" placeholder="پک های آماده برای هر موقعیت" value="{{ $packTitle->meta_value }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>

                    <!-- زیرعنوان -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="packSubtitle" class="text-sm font-medium text-gray-700 md:pt-2.5">عنوان فرعی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="packSubtitle" name="setting[packSubtitle]" placeholder="با انتخاب هر پک، مجموعه ای از محصولات کاربردی و مرتبط با موضوع را در یک بسته دریافت کنید"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none" value="{{ $packSubtitle->meta_value }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="packLinkTitle" class="text-sm font-medium text-gray-700 md:pt-2.5">متن دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" id="packLinkTitle" placeholder="مشاهده همه"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none" value="{{ $packLinkTitle->meta_value }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label for="packLinkUrl" class="text-sm font-medium text-gray-700 md:pt-2.5">متن دکمه</label>
                        <div class="md:col-span-2">
                            <input type="text" dir="ltr" id="packLinkUrl" name="setting[packLinkUrl]" placeholder="مشاهده همه"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none" value="{{ $packLinkUrl->meta_value }}">
                        </div>
                    </div>

                    <!-- تصویر هیرو -->
                    {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">تصویر سکشن پک</label>
                        <div class="md:col-span-2">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="packPreview" src="{{ asset('storage/'.$packImage->meta_value) }}" alt="" class="w-full h-40 object-cover rounded-lg mb-3 @if(!$packImage) hidden @endif">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <label class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" class="hidden" name="setting[packImage]" accept="image/*" onchange="previewHero(event)">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG - حداکثر ۲ مگابایت</p>
                            </div>
                        </div>
                    </div> --}}

                    <!-- متن دکمه -->
                    {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="packLabelText" class="text-sm font-medium text-gray-700">متن لیبل </label>
                        <div class="md:col-span-2">
                            <input type="text" id="packLabelText" name="setting[packLabelText]" value="{{ $packLabelText->meta_value }}" placeholder="پک های پیشنهادی"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                        <label class="text-sm font-medium text-gray-700 md:pt-2.5">آیکون لیبل</label>
                        <div class="md:col-span-2">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <img id="iconPreview" src="{{ asset('storage/'.$packLabelIcon->meta_value) }}" alt="" class="w-full h-40 object-cover rounded-lg mb-3 @if(!$packLabelIcon) hidden @endif">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <label class="cursor-pointer inline-block px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition">
                                    انتخاب تصویر
                                    <input type="file" class="hidden" name="setting[packLabelIcon]" accept="image/*" onchange="previewIcon(event)">
                                </label>
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG - حداکثر ۲ مگابایت</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="packLabelColor" class="text-sm font-medium text-gray-700">رنگ پس زمینه لیبل</label>
                        <div class="md:col-span-2">
                            <input type="color" id="packLabelColor" name="setting[packLabelColor]" value="{{ $packLabelColor->meta_value }}"
                                class="w-full px-4 py-2.5 rounded-lg h-[60px] border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="packLabelColorHex" class="text-sm font-medium text-gray-700">کد رنگی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="packLabelColorHex" value="{{ $packLabelColor->meta_value }}" dir="ltr"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="packTextColor" class="text-sm font-medium text-gray-700">رنگ لیبل</label>
                        <div class="md:col-span-2">
                            <input type="color" id="packTextColor" name="setting[packTextColor]" value="{{ $packTextColor->meta_value }}"
                                class="w-full px-4 py-2.5 rounded-lg h-[60px] border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <label for="packTextColorHex" class="text-sm font-medium text-gray-700">کد رنگی</label>
                        <div class="md:col-span-2">
                            <input type="text" id="packTextColorHex" value="{{ $packTextColor->meta_value }}" dir="ltr"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition">
                        </div>
                    </div>
                </div> --}}
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
     
        // پیش‌نمایش تصویر هیرو
        function previewHero(event) {
            const file = event.target.files[0]
            if (file) {
                const reader = new FileReader()
                reader.onload = e => {
                    const img = document.getElementById('packPreview')
                    img.src = e.target.result
                    img.classList.remove('hidden')
                }
                reader.readAsDataURL(file)
            }
        }
        function previewIcon(event) {
            const file = event.target.files[0]
            if (file) {
                const reader = new FileReader()
                reader.onload = e => {
                    const img = document.getElementById('iconPreview')
                    img.src = e.target.result
                    img.classList.remove('hidden')
                }
                reader.readAsDataURL(file)
            }
        }

        document.getElementById('packLabelColorHex').addEventListener('keyup', ()=>{
            document.getElementById('packLabelColor').value = document.getElementById('packLabelColorHex').value
            console.log(document.getElementById('packLabelColor').value)
        })
        document.getElementById('packLabelColor').addEventListener('change', ()=>{
            document.getElementById('packLabelColorHex').value = document.getElementById('packLabelColor').value
        })
        document.getElementById('packTextColorHex').addEventListener('keyup', ()=>{
            document.getElementById('packTextColor').value = document.getElementById('packTextColorHex').value
            console.log(document.getElementById('packTextColor').value)
        })
        document.getElementById('packTextColor').addEventListener('change', ()=>{
            document.getElementById('packTextColorHex').value = document.getElementById('packTextColor').value
        })

       
    </script>

@endsection