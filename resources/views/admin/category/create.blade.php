@extends('admin.app.dashboard')
@section('title', 'شاهکار | ایجاد دسته')
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
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:w-1/2 flex flex-col">
                        <label for="image" class="mb-2">عکس دسته بندی:</label>
                        <input type="file" class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                            name="image" id="image">
                        @error('image')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button type="submit"
                        class="py-3 px-10 rounded-[10px] bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">ثبت</button>
                </div>
            </form>
        </div>
    </div>
@endsection
