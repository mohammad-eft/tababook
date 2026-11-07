@extends('admin.app.dashboard')

@section('title', 'طبابوک | ایجاد محصول')

@section('content')

    <style>
        /* اینپوت رنگ: ارتفاع بیشتر تا رنگ انتخاب‌شده کامل دیده شود */
        .attribute-value-input[type="color"] {
            height: 2.75rem;
            /* ~44px */
            padding: 4px;
            cursor: pointer;
        }

        /* پر شدن کامل کادر با رنگ انتخاب‌شده */
        .attribute-value-input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        .attribute-value-input[type="color"]::-webkit-color-swatch {
            border: none;
            border-radius: 0.5rem;
        }

        .attribute-value-input[type="color"]::-moz-color-swatch {
            border: none;
            border-radius: 0.5rem;
        }

        .attribute-value-input[type="color"] {
            flex: 0 0 6rem;
            /* عرض ثابت ۶rem به جای کشیده شدن */
        }
    </style>

    @if (session('message'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-slate-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-slate-500">
                {{ session('message') }}
            </span>
        </div>
    @endif


    <div class="w-full h-full pb-10">

        <h2 class="text-3xl text-center font-bold py-5 text-[#425A8B]">
            فرم ایجاد محصول
        </h2>

        <div class="w-full mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white">

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">

                @csrf


                {{-- ========================================== --}}
                {{-- ساختار اصلی فرم --}}
                {{-- ========================================== --}}

                <div class="flex flex-col md:flex-row gap-3 md:gap-5">


                    {{-- ====================================== --}}
                    {{-- ستون سمت راست: اطلاعات اصلی و ویژگی‌ها --}}
                    {{-- ====================================== --}}

                    <div class="w-full md:w-2/3 space-y-8">


                        {{-- نام محصول --}}
                        <div class="w-full flex flex-col">

                            <label for="title" class="mb-2 flex flex-row items-center">
                                <span>نام محصول:</span>
                                <span class="text-rose-500">*</span>
                            </label>

                            <input type="text" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                name="title" id="title" placeholder="نام محصول را وارد کنید"
                                value="{{ old('title') }}" required>

                            @error('title')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror

                        </div>


                        {{-- خلاصه محصول --}}
                        <div class="w-full flex flex-col mt-5">

                            <label for="summary" class="mb-2">
                                خلاصه محصول:
                            </label>

                            <textarea class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]" rows="4"
                                placeholder="خلاصه محصول" name="summary" id="summary">{{ old('summary') }}</textarea>

                            @error('summary')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror

                        </div>


                        {{-- توضیحات محصول --}}
                        <div class="w-full flex flex-col mt-5">

                            <label for="editor" class="mb-2">
                                توضیحات محصول:
                            </label>

                            <textarea name="description" id="editor" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                rows="4" placeholder="توضیحات محصول را وارد کنید">{!! old('description') !!}</textarea>

                            @error('description')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror

                        </div>

                        {{-- دسته‌بندی محصول --}}
                        <div class="w-full flex flex-col gap-3 mt-5">

                            <label for="category_ids" class="mb-2 flex flex-row items-center">
                                <span>دسته‌بندی:</span>
                                <span class="text-rose-500">*</span>
                            </label>

                            <select name="category_ids[]" id="category_ids"
                                class="w-full bg-[#F9F9F9] py-3 pr-5 rounded-[10px]" multiple size="1" required>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (in_array($category->id, old('category_ids', []))) selected @endif>
                                        {{ $category->title }}
                                    </option>
                                @endforeach

                            </select>

                            <span class="text-xs text-gray-400">
                                برای انتخاب چند دسته‌بندی، کلید Ctrl را نگه دارید.
                            </span>

                            @error('category_ids')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror

                        </div>


                        {{-- ====================================== --}}
                        {{-- ویژگی‌های عمومی محصول --}}
                        {{-- ====================================== --}}

                        <div class="w-full flex flex-col gap-5 mt-8">

                            <div class="flex items-center justify-between gap-3">

                                <h3 class="font-bold text-lg">
                                    مشخصات محصول
                                </h3>

                                <button type="button" id="add-product-attribute"
                                    class="p-2 text-sm rounded-md bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">
                                    افزودن ویژگی +
                                </button>

                            </div>

                            <div id="product-attributes-list" class="space-y-4"></div>

                        </div>


                        {{-- ====================================== --}}
                        {{-- پکیج‌های محصول --}}
                        {{-- ====================================== --}}

                        <div class="w-full flex flex-col gap-5 mt-8">

                            <div class="flex items-center justify-between gap-3">

                                <h3 class="font-bold text-lg">
                                    قیمت های مختلف محصول
                                </h3>

                                <button type="button" id="add-package"
                                    class="p-2 text-sm rounded-md bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">
                                    افزودن پکیج +
                                </button>

                            </div>

                            <div id="packages-list" class="space-y-6"></div>

                        </div>


                        {{-- دکمه ثبت --}}
                        <div class="mt-8 text-center">

                            <button type="submit"
                                class="py-3 px-10 rounded-[10px] bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">
                                ثبت محصول
                            </button>

                        </div>

                    </div>


                    {{-- ========================================== --}}
                    {{-- ستون سمت چپ: تنظیمات، تصاویر و قیمت --}}
                    {{-- ========================================== --}}

                    <div class="w-full md:w-1/3 space-y-8">


                        {{-- تنظیمات محصول --}}
                        <div class="w-full flex flex-col gap-6 mt-5">


                            {{-- نمایش در خانه --}}
                            <div class="flex items-center gap-4">

                                <label for="show_in_home">
                                    نمایش در خانه:
                                </label>

                                <label for="show_in_home"
                                    class="w-[50px] h-[28px] flex rounded-full cursor-pointer relative">

                                    <input type="checkbox" name="show_in_home" value="1" id="show_in_home" hidden
                                        class="peer" @if (old('show_in_home')) checked @endif>

                                    <span
                                        class="size-full bg-gray-300 shadow-inner rounded-full peer-checked:bg-[#1B84FF] transition-all duration-300"></span>

                                    <span
                                        class="size-[20px] rounded-full bg-white absolute top-1 left-1 peer-checked:translate-x-[22px] transition-all duration-300 shadow-md"></span>

                                </label>

                            </div>


                            {{-- تعداد محصول --}}
                            <div class="flex items-center gap-4">

                                <label class="mb-2">
                                    تعداد:
                                </label>

                                <div class="flex">

                                    <div class="bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4] flex flex-row items-center">

                                        <button type="button"
                                            class="inline-block size-7 rounded-lg bg-[#1B84FF] hover:bg-[#056EE9] cursor-pointer text-white"
                                            onclick="calculate('+')">
                                            +
                                        </button>

                                        <input type="number" min="1" value="{{ old('count', 1) }}"
                                            class="outline-none w-14 text-center text-xs" name="count" id="count"
                                            dir="ltr" required>

                                        <button type="button"
                                            class="inline-block size-7 rounded-lg bg-[#1B84FF] hover:bg-[#056EE9] cursor-pointer text-white"
                                            onclick="calculate('-')">
                                            -
                                        </button>

                                    </div>

                                </div>


                                {{-- راهنما --}}
                                <div class="relative group">

                                    <span
                                        class="size-4 text-xs bg-[#ededed] border border-[#6f6f6f] rounded-full p-2 flex justify-center items-center cursor-pointer">
                                        ?
                                    </span>

                                    <span
                                        class="w-70 py-4 text-center rounded-xl text-xs absolute bottom-5 left-5 bg-[#F9F9F9] border border-slate-300 invisible opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">
                                        اگر تعداد موجودی محصول زیاد بود نیازی نیست + را بزنید. روی عدد موجودی دوبار کلیک
                                        کرده و عدد مورد نظر را بنویسید.
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- تصویر اصلی --}}
                        <div class="w-full mt-3 lg:mt-5 flex flex-col">

                            <label for="mainImage" class="mb-2">
                                عکس اصلی:
                            </label>

                            <input type="file"
                                class="w-full outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                name="mainImage" id="mainImage" accept="image/*">

                            @error('mainImage')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror

                        </div>


                        {{-- گالری تصاویر --}}
                        <div class="w-full mt-3 lg:mt-5 flex flex-col">

                            <label for="gallery" class="mb-2">
                                گالری تصاویر:
                            </label>

                            <input type="file"
                                class="w-full outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                name="gallery[]" id="gallery" accept="image/*" multiple>

                            <span class="text-xs text-red-500">
                                حجم کل فایل‌ها نباید بیشتر از 500 کیلوبایت باشد.
                            </span>

                            @error('gallery')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror

                        </div>


                        {{-- قیمت‌ها --}}
                        <div class="w-full flex flex-col gap-3 md:gap-5 mt-3 lg:mt-5">


                            {{-- قیمت اصلی --}}
                            <div class="w-full flex flex-col gap-3">

                                <label for="primary_price" class="flex items-center gap-2">

                                    <span>قیمت اصلی:</span>

                                    <div class="relative group">

                                        <span
                                            class="size-4 text-xs bg-[#ededed] border border-[#6f6f6f] rounded-full p-2 flex justify-center items-center cursor-pointer">
                                            ?
                                        </span>

                                        <span
                                            class="w-70 py-4 text-center rounded-xl text-xs absolute bottom-5 left-5 bg-[#F9F9F9] border border-slate-300 invisible opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">
                                            در صورتی که مایلید برای استعلام قیمت تماس گرفته شود، این فیلد را خالی بگذارید.
                                        </span>

                                    </div>

                                </label>

                                <input type="number"
                                    class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                    name="primary_price" id="primary_price" min="0"
                                    value="{{ old('primary_price') }}">

                                @error('primary_price')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror

                            </div>


                            {{-- قیمت ویژه --}}
                            <div class="w-full flex flex-col gap-3">

                                <label for="secondary_price">
                                    قیمت ویژه:
                                </label>

                                <input type="number"
                                    class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                    name="secondary_price" id="secondary_price" min="0"
                                    value="{{ old('secondary_price') }}">

                                @error('secondary_price')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>
                {{-- پایان ساختار اصلی فرم --}}

            </form>

        </div>

    </div>



    {{-- ============================================== --}}
    {{-- قالب ویژگی --}}
    {{-- ============================================== --}}

    <template id="attribute-template">

        <div class="attribute-item border border-[#D5DFE4] rounded-xl p-4 space-y-4 bg-[#F9F9F9]">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                <div>

                    <label class="block mb-2 text-sm font-medium">
                        عنوان ویژگی
                    </label>

                    <select class="attribute-select w-full border border-[#D5DFE4] rounded-lg p-2 bg-white" required>
                    </select>

                </div>

                <div>

                    <button type="button"
                        class="remove-attribute w-full bg-red-100 hover:bg-red-200 text-red-700 rounded-lg p-2">
                        حذف ویژگی
                    </button>

                </div>

            </div>

            <div class="attribute-values-container border-t border-[#D5DFE4] pt-4">

                <div class="flex items-center justify-between mb-3">

                    <label class="font-medium text-sm">
                        مقادیر ویژگی
                    </label>

                    <button type="button" class="add-attribute-value text-[#1B84FF] hover:text-[#056EE9] text-sm">
                        + افزودن مقدار
                    </button>

                </div>

                <div class="attribute-values space-y-2"></div>

            </div>

        </div>

    </template>



    {{-- ============================================== --}}
    {{-- قالب مقدار ویژگی --}}
    {{-- ============================================== --}}

    <template id="attribute-value-template">

        <div class="attribute-value-item flex items-center gap-2">

            <input type="text" class="attribute-value-input flex-1 border border-[#D5DFE4] rounded-lg p-2 bg-white"
                placeholder="مقدار ویژگی" required>

            <button type="button"
                class="remove-attribute-value bg-red-100 hover:bg-red-200 text-red-600 rounded-lg px-3 py-2">
                ✕
            </button>

        </div>

    </template>



    {{-- ============================================== --}}
    {{-- قالب پکیج --}}
    {{-- ============================================== --}}

    <template id="package-template">

        <div class="package-item border border-[#D5DFE4] rounded-xl p-5 space-y-5 bg-[#F9F9F9]">

            {{-- عنوان پکیج --}}
            <div class="flex items-center justify-between gap-3">

                <h3 class="package-heading font-bold text-lg">
                    محصول متغیر جدید
                </h3>

                <button type="button"
                    class="remove-package bg-red-100 hover:bg-red-200 text-red-700 rounded-lg px-3 py-2">
                    حذف محصول متغیر
                </button>

            </div>


            {{-- اطلاعات پکیج --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- تعداد --}}
                <div>

                    <label class="block mb-2 text-sm">
                        تعداد
                    </label>

                    <input type="number" class="package-count w-full border border-[#D5DFE4] rounded-lg p-2 bg-white"
                        min="1" value="1" required>

                </div>

                {{-- قیمت اصلی --}}
                <div>

                    <label class="block mb-2 text-sm">
                        قیمت اصلی
                    </label>

                    <input type="number"
                        class="package-primary-price w-full border border-[#D5DFE4] rounded-lg p-2 bg-white"
                        min="0" placeholder="قیمت اصلی">

                </div>

                {{-- قیمت ثانویه --}}
                <div>

                    <label class="block mb-2 text-sm">
                        قیمت ویژه
                    </label>

                    <input type="number"
                        class="package-secondary-price w-full border border-[#D5DFE4] rounded-lg p-2 bg-white"
                        min="0" placeholder="قیمت ویژه">

                </div>

            </div>


            {{-- ویژگی‌های پکیج --}}
            <div class="package-attributes-section border-t border-[#D5DFE4] pt-4">

                <div class="flex items-center justify-between gap-3 mb-4">

                    <h4 class="font-bold">
                        ویژگی‌های این پکیج
                    </h4>

                    <button type="button"
                        class="add-package-attribute bg-[#1B84FF] hover:bg-[#056EE9] text-white rounded-lg px-3 py-2 text-sm">
                        + افزودن ویژگی
                    </button>

                </div>

                <div class="package-attributes-list space-y-3"></div>

            </div>

        </div>

    </template>



    {{-- ============================================== --}}
    {{-- ارسال اطلاعات دسته‌بندی‌ها به JavaScript --}}
    {{-- ============================================== --}}

    <script>
        window.CATEGORIES = @json($categoriesData);
    </script>



    {{-- ============================================== --}}
    {{-- فایل‌های JavaScript --}}
    {{-- ============================================== --}}

    <script src="{{ url('js/attribute.js') }}"></script>

    <script src="{{ url('js/product.js') }}"></script>

    <script src="{{ url('js/packageForm.js') }}"></script>


@endsection
