@extends('admin.app.dashboard')
@section('title', 'شاهکار | ایجاد محصول')
@section('content')
    @if (session('message'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-slate-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-slate-500"> {{ session('message') }} </span>
        </div>
    @endif
    <div class="w-full h-full pb-10">
        <h2 class="text-3xl text-center font-bold py-5 text-[#425A8B]">فرم ایجاد محصول</h2>
        <div class="w-full mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row gap-3 md:gap-5">
                    <div class="w-full md:w-2/3 space-y-8">
                        <div class="w-full flex flex-col">
                            <label for="title" class="mb-2 flex flex-row items-center">
                                <span>نام محصول:</span>
                                <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                name="title" id="title" placeholder="نام محصول را وارد کنید"
                                value="{{ old('title') }}">
                            @error('title')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col mt-5">
                            <label for="description" class="mb-2">توضیحات محصول:</label>
                            <textarea name="description" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]" rows="4"
                                id="description" placeholder="توضیحات محصول را وارد کنید">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col mt-5">
                            <label for="summary" class="mb-2">خلاصه محصول:</label>
                            <textarea class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]" rows="4" placeholder="خلاصه"
                                name="summary" id="summary">{{ old('summary') }}</textarea>
                            @error('summary')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col gap-3 mt-5">
                            <label for="category_ids" class="mb-2 flex flex-row items-center">
                                <span>دسته بندی :</span>
                                <span class="text-rose-500">*</span>
                            </label>
                            <select name="category_ids[]" id="category_ids"
                                class="w-full bg-[#F9F9F9] py-3 pr-5 rounded-[10px]" multiple size="1">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (in_array($category->id, old('category_ids', []))) selected @endif>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_ids')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col gap-5 mt-5">
                            <div class=""></div>
                            <button type="button" onclick="addAttribute(this, 'create')"
                                class="w-30 mx-auto p-2 text-sm rounded-md bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">
                                افزودن ویژگی +
                            </button>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 space-y-8">
                        <div class="w-full flex flex-col gap-6 mt-5">
                            <div class="flex items-center gap-4">
                                <label for="show_in_home">نمایش در خانه :</label>
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
                            <div class="flex items-center gap-4">
                                <label class="mb-2"> تعداد :</label>
                                <div class="flex">
                                    <div class="bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4] flex flex-row items-center">
                                        <button type="button"
                                            class="inline-block size-7 rounded-lg bg-[#1B84FF] hover:bg-[#056EE9] cursor-pointer text-white"
                                            onclick="calculate('+')">+</button>
                                        <input type="number" min="1" value="{{ old('count', 1) }}"
                                            class="outline-none w-14 text-center text-xs" name="count" id="count"
                                            dir="ltr">
                                        <button type="button"
                                            class="inline-block size-7 rounded-lg bg-[#1B84FF] hover:bg-[#056EE9] cursor-pointer text-white"
                                            onclick="calculate('-')">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 lg:mt-5 flex flex-col">
                            <label for="mainImage" class="mb-2">عکس اصلی:</label>
                            <input type="file"
                                class="w-full outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                name="mainImage" id="mainImage">
                            @error('mainImage')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full mt-3 lg:mt-5 flex flex-col">
                            <label for="gallery" class="mb-2">گالری تصاویر :</label>
                            <input type="file"
                                class="w-full outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                name="gallery[]" id="gallery" multiple>
                            <span class="text-xs text-red-500">حجم کل فایل ها نباید بیشتر از 500 کیلوبایت باشد.</span>
                            @error('gallery')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col gap-3 md:gap-5 mt-3 lg:mt-5">
                            <div class="w-full flex flex-col gap-3">
                                <label for="primary_price" class="flex items-center gap-2">
                                    <span>قیمت اصلی :</span>
                                    <div class="relative group">
                                        <span
                                            class="size-4 text-xs bg-[#ededed] border border-[#6f6f6f] rounded-full p-2 flex justify-center items-center cursor-pointer">?</span>
                                        <span
                                            class="w-70 py-4 text-center rounded-xl text-xs absolute bottom-5 left-5 bg-[#F9F9F9] border border-slate-300 invisible opacity-0 transition-all duration-300 group-hover:visible group-hover:opacity-100">در
                                            صورتی که مایلید برای استعلام قیمت تماس گرفته شود این فیلد را خالی
                                            بگذارید.</span>
                                    </div>
                                </label>
                                <input type="number"
                                    class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                    name="primary_price" id="primary_price" value="{{ old('primary_price') }}">
                            </div>
                            <div class="w-full flex flex-col gap-3">
                                <label for="secondary_price"> قیمت ویژه :</label>
                                <input type="number"
                                    class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-xl focus:bg-[#f1f1f4]"
                                    name="secondary_price" id="secondary_price" value="{{ old('secondary_price') }}">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button type="submit"
                                class="py-3 px-10 rounded-[10px] bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">ثبت</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ url('assets/js/attribute.js') }}"></script>
@endsection
