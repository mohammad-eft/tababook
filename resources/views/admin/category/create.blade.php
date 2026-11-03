{{-- @extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد دسته')
@section('content')
    @if (session('message'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-slate-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-slate-500"> {{ session('message') }} </span>
        </div>
    @endif
    <div class="w-full h-full pb-10">
        <h2 class="text-3xl text-center font-bold py-10 text-[#425A8B]">فرم ایجاد دسته بندی</h2>
        <div class="lg:w-2/3 w-full mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white">
            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-full flex flex-col">
                    <label for="catTitle" class="mb-2 flex flex-row items-center">
                        <span>
                            عنوان دسته بندی:
                            <span class="text-rose-500">*</span>
                        </span>
                    </label>
                    <input type="text" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                        name="title" id="catTitle" placeholder="نام دسته را وارد کنید" value="{{ old('title') }}">
                    @error('title')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full flex flex-col mt-5">
                    <label for="cat_desc" class="mb-2">توضیحات دسته بندی:</label>
                    <input type="text" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                        placeholder="توضیحات" name="description" id="cat_desc" value="{{ old('description') }}">
                </div>
                <div class="flex flex-col-reverse md:flex-row gap-5 md:gap-10 mt-5">
                    <div class="md:w-1/2 flex flex-col">
                        <label for="parent_id">دسته بندی :</label>
                        <select name="parent_id" id="parent_id" class="md:w-1/2 bg-[#F9F9F9] py-3 pr-5 rounded-[10px]">
                            <option value="0">بدون والد</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('parent_id') == $category->id) selected @endif>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:w-1/2 flex flex-col">
                        <label for="image" class="mb-2">تصویر دسته بندی:</label>
                        <input type="file" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                            name="image" id="image">
                        @error('image')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="w-full border border-gray-300 rounded-xl p-3 lg:p-5 bg-white shadow-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-(--primary-text-color) flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-(--primary-text-color)"
                                viewBox="0 0 512 512">
                                <path
                                    d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z" />
                            </svg>
                            ویژگی‌ها
                        </h3>
                        <span class="text-xs text-gray-400 font-medium" id="attributes-count">۰ مورد</span>
                    </div>

                    <!-- لیست ویژگی‌ها (خالی در ابتدا) -->
                    <div id="attributes-list" class="mt-4 flex flex-col gap-3"></div>

                    <!-- دکمه افزودن -->
                    <button type="button" id="add-attribute-btn" aria-label="افزودن ویژگی جدید"
                        class="group mt-4 w-full flex flex-row items-center justify-center gap-3 py-4 rounded-xl
               border-2 border-dashed border-gray-300
               hover:border-(--primary-text-color) hover:bg-(--primary-text-color)/5
               active:scale-[0.99]
               transition-all duration-200 ease-out
               cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-(--primary-text-color) focus-visible:ring-offset-2">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-full
                     bg-(--primary-text-color)/10 group-hover:bg-(--primary-text-color)/15
                     transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 fill-(--primary-text-color)"
                                viewBox="0 0 448 512">
                                <path
                                    d="M248 72c0-13.3-10.7-24-24-24s-24 10.7-24 24V232H40c-13.3 0-24 10.7-24 24s10.7 24 24 24H200V440c0 13.3 10.7 24 24 24s24-10.7 24-24V280H408c13.3 0 24-10.7 24-24s-10.7-24-24-24H248V72z" />
                            </svg>
                        </span>
                        <span class="text-sm font-bold text-(--primary-text-color)">افزودن ویژگی</span>
                    </button>

                    <!-- تمپلیت ردیف ویژگی (مخفی) -->
                    <template id="attribute-row-template">
                        <div class="attribute-row flex items-center justify-center gap-3 animate-[fadeIn_0.2s_ease-out]">
                            <input type="text" name="attributes[]" placeholder="مثلاً: ضدآب، سبک، ..."
                                class="w-10/12 px-3 py-2 rounded-lg border border-gray-300 bg-white
                       text-sm text-gray-800 placeholder:text-gray-400
                       focus:outline-none focus:ring-2 focus:ring-(--primary-text-color) focus:border-(--primary-text-color)
                       transition-shadow duration-150" />
                            <button type="button"
                                class="remove-attribute-btn flex items-center gap-1.5 px-3 py-2 rounded-lg
                       text-sm font-medium text-red-600 bg-red-50
                       hover:bg-red-100 active:scale-[0.97]
                       transition-all duration-150 cursor-pointer"
                                aria-label="حذف ویژگی">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 fill-current" viewBox="0 0 448 512">
                                    <path
                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                                حذف
                            </button>
                        </div>
                    </template>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit"
                        class="py-3 px-10 rounded-[10px] bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">ثبت</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/createCategory.js') }}"></script>
@endsection --}}
@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد دسته')
@section('content')
    @if (session('message'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-slate-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-slate-500"> {{ session('message') }} </span>
        </div>
    @endif
    <div class="w-full h-full pb-10">
        <h2 class="text-3xl text-center font-bold py-10 text-[#425A8B]">فرم ایجاد دسته بندی</h2>
        <div class="lg:w-2/3 w-full mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white">
            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-full flex flex-col">
                    <label for="catTitle" class="mb-2 flex flex-row items-center">
                        <span>
                            عنوان دسته بندی:
                            <span class="text-rose-500">*</span>
                        </span>
                    </label>
                    <input type="text" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                        name="title" id="catTitle" placeholder="نام دسته را وارد کنید" value="{{ old('title') }}">
                    @error('title')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full flex flex-col mt-5">
                    <label for="cat_desc" class="mb-2">توضیحات دسته بندی:</label>
                    <input type="text" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                        placeholder="توضیحات" name="description" id="cat_desc" value="{{ old('description') }}">
                </div>
                <div class="flex flex-col-reverse md:flex-row gap-5 md:gap-10 mt-5">
                    <div class="md:w-1/2 flex flex-col">
                        <label for="parent_id">دسته بندی :</label>
                        <select name="parent_id" id="parent_id" class="md:w-1/2 bg-[#F9F9F9] py-3 pr-5 rounded-[10px]">
                            <option value="0">بدون والد</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('parent_id') == $category->id) selected @endif>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:w-1/2 flex flex-col">
                        <label for="image" class="mb-2">تصویر دسته بندی:</label>
                        <input type="file" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                            name="image" id="image">
                        @error('image')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="w-full border border-gray-300 rounded-xl p-3 lg:p-5 bg-white shadow-sm mt-5">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-(--primary-text-color) flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-(--primary-text-color)"
                                viewBox="0 0 512 512">
                                <path
                                    d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z" />
                            </svg>
                            ویژگی‌ها
                        </h3>
                        <span class="text-xs text-gray-400 font-medium" id="attributes-count">۰ مورد</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">
                        اینجا فقط «کلید» ویژگی را تعریف کنید (مثلاً رنگ، سایز). مقدار آن هنگام ایجاد محصول وارد می‌شود.
                    </p>

                    <!-- لیست ویژگی‌ها (خالی در ابتدا) -->
                    <div id="attributes-list" class="mt-4 flex flex-col gap-3"></div>

                    <!-- دکمه افزودن -->
                    <button type="button" id="add-attribute-btn" aria-label="افزودن ویژگی جدید"
                        class="group mt-4 w-full flex flex-row items-center justify-center gap-3 py-4 rounded-xl
               border-2 border-dashed border-gray-300
               hover:border-(--primary-text-color) hover:bg-(--primary-text-color)/5
               active:scale-[0.99]
               transition-all duration-200 ease-out
               cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-(--primary-text-color) focus-visible:ring-offset-2">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-full
                     bg-(--primary-text-color)/10 group-hover:bg-(--primary-text-color)/15
                     transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 fill-(--primary-text-color)"
                                viewBox="0 0 448 512">
                                <path
                                    d="M248 72c0-13.3-10.7-24-24-24s-24 10.7-24 24V232H40c-13.3 0-24 10.7-24 24s10.7 24 24 24H200V440c0 13.3 10.7 24 24 24s24-10.7 24-24V280H408c13.3 0 24-10.7 24-24s-10.7-24-24-24H248V72z" />
                            </svg>
                        </span>
                        <span class="text-sm font-bold text-(--primary-text-color)">افزودن ویژگی</span>
                    </button>

                    <!-- تمپلیت ردیف ویژگی (مخفی): کلید + نوع مقدار -->
                    <template id="attribute-row-template">
                        <div class="attribute-row flex items-center justify-center gap-3 animate-[fadeIn_0.2s_ease-out]">
                            <input type="hidden" data-field="id">
                            <input type="text" data-field="key" placeholder="مثلاً: رنگ، سایز، جنس"
                                class="w-7/12 px-3 py-2 rounded-lg border border-gray-300 bg-white
                       text-sm text-gray-800 placeholder:text-gray-400
                       focus:outline-none focus:ring-2 focus:ring-(--primary-text-color) focus:border-(--primary-text-color)
                       transition-shadow duration-150" />
                            <select data-field="type"
                                class="w-3/12 px-3 py-2 rounded-lg border border-gray-300 bg-white text-sm text-gray-800
                       focus:outline-none focus:ring-2 focus:ring-(--primary-text-color)">
                                <option value="text">متن</option>
                                <option value="color">رنگ</option>
                            </select>
                            <button type="button"
                                class="remove-attribute-btn flex items-center gap-1.5 px-3 py-2 rounded-lg
                       text-sm font-medium text-red-600 bg-red-50
                       hover:bg-red-100 active:scale-[0.97]
                       transition-all duration-150 cursor-pointer"
                                aria-label="حذف ویژگی">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 fill-current" viewBox="0 0 448 512">
                                    <path
                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                                حذف
                            </button>
                        </div>
                    </template>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit"
                        class="py-3 px-10 rounded-[10px] bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">ثبت</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.OLD_ATTRS = @json(old('attributes', []));
    </script>
    <script src="{{ asset('js/createCategory.js') }}"></script>
@endsection
