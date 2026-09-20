@extends('admin.app.dashboard')
@section('title', 'شاهکار | همه دسته بندی ها')
@section('content')
    @if (session('message'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-slate-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-slate-500"> {{ session('message') }} </span>
        </div>
    @endif
    <div class="w-full flex flex-col pb-4">
        <div class="bg-white rounded-lg">
            <h2 class="text-lg font-bold text-gray-800 p-4 text-center">لیست دسته بندی ها</h2>
            {{-- <form class="flex flex-col gap-5 w-10/12 mx-auto" action="{{ route('category.deleteAll') }}" method="post"> --}}
            {{-- @csrf --}}
            <div class="w-full flex flex-row justify-between items-center mb-5">
                <div class="flex flex-row items-center gap-3">
                    <input type="checkbox" id="all" onchange="checkAll()">
                    <label for="all" class="text-gray-700 text-xs">انتخاب همه</label>
                </div>
                <div class="flex justify-center">
                    <button
                        class="w-fit flex flex-row items-center justify-center bg-red-500 hover:bg-red-600 p-1 rounded-sm cursor-pointer"
                        title="حذف">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512">
                            <path fill="white"
                                d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="w-full shadow-md [&::-webkit-scrollbar]:hidden lg:overflow-visible overflow-x-auto">
                <div class="w-full min-w-[550px] h-120 max-h-120 overflow-auto">
                    <div class="w-full grid grid-cols-9 divide-x divide-slate-400 sticky top-0 z-1">
                        <div class="py-3 text-center text-xs font-medium text-gray-600 bg-gray-100">
                            <span class="w-10 lg:w-full">ردیف</span>
                        </div>
                        <div class="py-3 text-center text-xs font-medium text-gray-600 bg-gray-100 col-span-2">
                            <span class="w-20 lg:w-full">تصویر</span>
                        </div>
                        <div class="py-3 text-center text-xs font-medium text-gray-600 bg-gray-100 col-span-2">
                            <span class="w-20 lg:w-full">عنوان</span>
                        </div>
                        <div class="py-3 text-center text-xs font-medium text-gray-600 bg-gray-100 col-span-2">
                            <span class="w-30 lg:w-full">زیر دسته ها</span>
                        </div>
                        <div class="py-3 text-center text-xs font-medium text-gray-600 bg-gray-100 col-span-2">
                            <span class="w-[180px] lg:w-full">عملیات</span>
                        </div>
                    </div>
                    <div class="bg-white divide-y divide-[#f1f1f4]">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($categories as $category)
                            <div class="w-full grid grid-cols-9 divide-x divide-slate-400 py-4">
                                <div
                                    class="p-1 lg:p-3 text-xs lg:text-sm h-full flex items-center justify-center  text-center text-gray-900">
                                    <div class="w-10 lg:w-full flex items-center justify-center gap-2">
                                        <input type="checkbox" class="check" name="categories[]"
                                            value="{{ $category->id }}">
                                        <span>{{ $i }}</span>
                                    </div>
                                </div>
                                <div
                                    class="p-1 lg:p-3 text-xs col-span-2 lg:text-sm h-full flex items-center justify-center text-gray-900">
                                    <div class="w-20 lg:w-full">
                                        @if (isset($category['image']))
                                            <img class="max-w-[60px] max-h-[60px] mx-auto size-15 object-cover rounded-md"
                                                src={{ asset('storage/' . $category->image) }}>
                                        @else
                                            <p class="text-xs text-center">بدون تصویر</p>
                                        @endif
                                    </div>
                                </div>
                                <div
                                    class="p-1 lg:p-3 text-xs lg:text-sm h-full flex items-center justify-center text-gray-900 text-center col-span-2">
                                    <span class="block w-20 lg:w-full">{{ $category->title }}</span>
                                </div>
                                <div
                                    class="p-1 lg:p-3 text-xs lg:text-sm h-full flex items-center justify-center text-gray-900 text-center col-span-2 relative">
                                    @if (count($category->children))
                                        <span
                                            class="block w-30 lg:w-full font-bold text-blue-500 hover:text-blue-600 cursor-pointer subCats">مشاهده</span>
                                        <ul
                                            class="absolute w-full top-15 bg-white right-0 max-h-0 transition-all duration-300 flex flex-col items-center divide-y divide-gray-300 opacity-0 invisible border border-gray-300 rounded-sm z-555">
                                            <div class="w-full overflow-auto max-h-60">
                                                @foreach ($category->children as $child)
                                                    <li class="w-full py-2">{{ $child->title }}</li>
                                                @endforeach
                                            </div>
                                        </ul>
                                    @else
                                        <span
                                            class="block w-30 lg:w-full font-bold text-blue-500 hover:text-blue-600 cursor-pointer">-</span>
                                    @endif
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <ul class="w-[180px] lg:w-full text-sm rounded-sm p-1 grid grid-cols-3">
                                        <li class="flex justify-center">
                                            <span
                                                class="w-fit flex flex-row items-center justify-center bg-sky-500 hover:bg-sky-600 p-1 rounded-sm cursor-pointer"
                                                title="مشاهده" onclick="show('open', {{ $category['id'] }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                    viewBox="0 0 576 512">
                                                    <path fill="white"
                                                        d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-center">
                                            <span
                                                class="w-fit flex flex-row items-center justify-center bg-green-500 hover:bg-green-600 p-1 rounded-sm cursor-pointer"
                                                title="ویرایش" onclick="editForm('open', {{ $category['id'] }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                    viewBox="0 0 512 512">
                                                    <path fill="white"
                                                        d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-center">
                                            <span
                                                onclick="deleteCat('open', {{ $category['id'] }}, '{{ $category['title'] }}')"
                                                class="w-fit flex flex-row items-center justify-center bg-red-500 hover:bg-red-600 p-1 rounded-sm cursor-pointer"
                                                title="حذف">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                    viewBox="0 0 448 512">
                                                    <path fill="white"
                                                        d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- </form> --}}
        </div>
    </div>
    {{-- start showSingle popup --}}
    <div id="showSinglePopup" class="w-full h-dvh fixed top-0 left-0 z-5 invisible opacity-0 transition-all duration-400">
        <div class="size-full relative">
            <div class="size-full bg-black/40 absolute top-0 left-0" onclick="show('close')"></div>
            <div
                class="w-10/12 2xl:container 2xl:w-10/12 sm:w-8/12 mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2">
                <div class="relative">
                    <button class="absolute -top-4 -left-4 size-6 flex flex-col justify-center items-center cursor-pointer"
                        onclick="show('close')">
                        <span class="w-full h-0.5 rounded-full bg-slate-500 rotate-45 translate-y-1/2"></span>
                        <span class="w-full h-0.5 rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
                    </button>
                </div>
                <div class="w-full flex flex-col items-start gap-10 p-5 max-h-130 overflow-auto">
                    <div class="w-full flex flex-col sm:flex-row items-center gap-10">
                        <div class="w-full sm:w-1/2 bg-slate-100 rounded-xl px-5 py-2">
                            <h2 class="font-bold text-slate-700 mb-4">عنوان : </h2>
                            <p id="singleTitle"></p>
                        </div>
                        <div class="w-full sm:w-1/2 bg-slate-100 rounded-xl px-5 py-2">
                            <h2 class="font-bold text-slate-700 mb-4">دسته والد : </h2>
                            <p id="singleParent"></p>
                        </div>
                    </div>
                    <div class="w-full flex flex-col sm:flex-row items-center gap-10">
                        <div class="w-full sm:w-1/2 bg-slate-100 rounded-xl px-5 py-2">
                            <h2 class="font-bold text-slate-700 mb-4">توضیحات : </h2>
                            <div id="singleDesc" class="h-30 overflow-auto"></div>
                        </div>
                        <div class="w-full sm:w-1/2 bg-slate-100 rounded-xl px-5 py-2">
                            <h2 class="font-bold text-slate-700 mb-4">زیر دسته ها : </h2>
                            <p id="singleChildren" class="h-30 overflow-auto"></p>
                        </div>
                    </div>
                    <div class="w-full bg-slate-100 rounded-xl px-5 py-2">
                        <h2 class="font-bold text-slate-700 mb-4">تصویر : </h2>
                        <div id="singleImg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end showSingle popup --}}
    {{-- start editForm popup --}}
    @error('title')
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-red-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-red-500"> {{ $message }} </span>
        </div>
    @enderror
    @error('image')
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-red-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-red-500"> {{ $message }} </span>
        </div>
    @enderror
    <div id="editFormPopup" class="w-full h-dvh fixed top-0 left-0 z-5 invisible opacity-0 transition-all duration-400">
        <div class="size-full relative">
            <div class="size-full bg-black/40 absolute top-0 left-0" onclick="editForm('close')"></div>
            <div
                class="w-8/12 2xl:container 2xl:w-8/12 mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2">
                <div class="relative">
                    <button class="absolute -top-4 -left-4 size-6 flex flex-col justify-center items-center cursor-pointer"
                        onclick="editForm('close')">
                        <span class="w-full h-0.5 rounded-full bg-slate-500 rotate-45 translate-y-1/2"></span>
                        <span class="w-full h-0.5 rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
                    </button>
                </div>
                <div id="popupContent" class="max-h-130 overflow-auto">
                    <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data"
                        class="p-5 flex flex-col gap-10" id="editForm">
                        @csrf
                        <input type="hidden" name="cat_id" id="cat_id">
                        <div class="w-full flex flex-col">
                            <label for="catTitle" class="mb-2 flex flex-row items-center">
                                <span>
                                    عنوان دسته بندی:
                                    <span class="text-rose-500">*</span>
                                </span>
                            </label>
                            <input type="text"
                                class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                                name="title" id="catTitle" placeholder="نام دسته را وارد کنید">
                            @error('title')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col mt-5">
                            <label for="cat_desc" class="mb-2">توضیحات دسته بندی:</label>
                            <input type="text"
                                class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                                placeholder="توضیحات" name="description" id="cat_desc">
                        </div>
                        <div class="flex flex-col md:flex-row gap-5 md:gap-10 mt-5">
                            <div class="md:w-1/3 flex flex-col">
                                <label for="parent_id" class="mb-2">دسته والد:</label>
                                <select name="parent_id" id="parent_id" class="bg-[#F9F9F9] py-3 pr-5 rounded-[10px]">
                                    <option value="0">بدون والد</option>
                                </select>
                            </div>
                            <div class="md:w-1/3 flex flex-col">
                                <label for="image" class="mb-2">عکس دسته بندی:</label>
                                <input type="file"
                                    class="outline-none pr-5 py-3 bg-[#F9F9F9] rounded-[12px] focus:bg-[#f1f1f4]"
                                    name="image" id="image">
                                @error('image')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="md:w-1/3 relative" id="cat_img">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button type="submit"
                                class="py-3 px-10 rounded-[10px] bg-[#1B84FF] hover:bg-[#056EE9] text-white cursor-pointer">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end editForm popup --}}
    {{-- start confirmDelete popup --}}
    <div id="confirmDeletePopup"
        class="w-full h-dvh fixed top-0 left-0 z-5 invisible opacity-0 transition-all duration-400">
        <div class="size-full relative">
            <div class="size-full bg-black/40 absolute top-0 left-0" onclick="deleteCat('close')"></div>
            <div
                class="w-11/12 md:w-1/2 xl:w-1/3 2xl:container 2xl:w-1/3 mx-auto border border-[#D5DFE4] rounded-[10px] text-[#425A8B] p-5 bg-white absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2">
                <div class="relative">
                    <button class="absolute -top-4 -left-4 size-6 flex flex-col justify-center items-center cursor-pointer"
                        onclick="deleteCat('close')">
                        <span class="w-full h-0.5 rounded-full bg-slate-500 rotate-45 translate-y-1/2"></span>
                        <span class="w-full h-0.5 rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
                    </button>
                </div>
                <div class="">
                    <p>آیا از حذف دسته بندی <span id="confirmDeleteCatName" class="font-bold"> </span> اطمینان دارید؟ </p>
                    <div class="flex items-center justify-center gap-5 mt-10">
                        <a id="yes" class="py-2 px-4 bg-green-200 text-green-500 rounded-xl shadow-lg">بله</a>
                        <span class="py-2 px-4 bg-red-200 text-red-500 rounded-xl shadow-lg cursor-pointer"
                            onclick="deleteCat('close')">خیر</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end confirmDelete popup --}}
    <script>
        function deleteCat(state, id, catTitle) {
            let confirmDeletePopup = document.getElementById('confirmDeletePopup')
            if (state == 'open') {
                let yes = document.getElementById('yes')
                yes.setAttribute('href', `{{ url('category/delete') }}/${id}`)
                let confirmDeleteCatName = document.getElementById('confirmDeleteCatName')
                confirmDeleteCatName.innerText = catTitle
                confirmDeletePopup.classList.remove('invisible', 'opacity-0')
            }
            if (state == 'close') {
                confirmDeletePopup.classList.add('invisible', 'opacity-0')
            }
        }

        function editForm(state, id) {
            let editFormPopup = document.getElementById('editFormPopup')
            if (state == 'open') {
                let catTitle = document.getElementById('catTitle')
                let cat_desc = document.getElementById('cat_desc')
                let parent_id = document.getElementById('parent_id')
                let cat_img = document.getElementById('cat_img')
                let cat_id = document.getElementById('cat_id')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                })
                $.ajax({
                    url: "{{ route('category.edit') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'id': id,
                    },
                    success: function(data) {
                        console.log(data);
                        catTitle.value = data['cat'].title
                        cat_desc.value = data['cat'].description
                        cat_id.value = data['cat'].id
                        cat_img.innerHTML = ''
                        if (data['cat'].image) {
                            let img = document.createElement('img')
                            img.classList = 'w-full h-30'
                            img.setAttribute('src', data['cat'].image)
                            cat_img.appendChild(img)
                            let deleteImgBtn = document.createElement('span')
                            deleteImgBtn.setAttribute('onclick', `removeImg(this, "${data['cat'].image}")`)
                            deleteImgBtn.classList = "absolute top-0 left-0 cursor-pointer"
                            deleteImgBtn.innerText = '❌'
                            cat_img.appendChild(deleteImgBtn)
                        }
                        parent_id.innerHTML = ''
                        let withoutParent = document.createElement('option')
                        withoutParent.value = 0
                        withoutParent.innerText = 'بدون والد'
                        data['cats'].forEach(category => {
                            if (data['cat'].id != category.id) {
                                let option = document.createElement('option')
                                option.value = category.id
                                option.innerText = category.title
                                if (category.id == data['cat'].parent_id) {
                                    option.setAttribute('selected', true)
                                }
                                if (data['cat'].parent_id == 0) {
                                    withoutParent.setAttribute('selected', true)
                                }
                                parent_id.prepend(withoutParent)
                                parent_id.appendChild(option)
                            }
                        });
                    },
                    error: function() {
                        alert('error')
                    }
                })
                editFormPopup.classList.remove('invisible', 'opacity-0')
            }
            if (state == 'close') {
                editFormPopup.classList.add('invisible', 'opacity-0')
            }
        }

        function removeImg(el, file) {
            let index = file.indexOf('categoryImgs')
            let result = file.slice(index)
            let editForm = document.getElementById('editForm')
            let input = document.createElement('input')
            input.setAttribute("type", 'hidden')
            input.setAttribute("name", "removedImg")
            input.setAttribute("value", result)
            editForm.appendChild(input)
            el.parentElement.remove()
        }

        function show(state, id) {
            let showSinglePopup = document.getElementById('showSinglePopup')
            if (state == 'open') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                })
                $.ajax({
                    url: "{{ route('category.adminShow') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'id': id,
                    },
                    success: function(data) {
                        document.getElementById('singleTitle').innerText = data.title
                        document.getElementById('singleDesc').innerText = data.description
                        if (data.parent) {
                            document.getElementById('singleParent').innerText = data.parent.title
                        } else {
                            document.getElementById('singleParent').innerText = 'بدون والد'
                        }
                        document.getElementById('singleChildren').innerHTML = data.subCats
                        let singleImg = document.getElementById('singleImg')
                        singleImg.innerHTML = ''
                        if (data.image) {
                            let img = document.createElement('img')
                            img.classList = 'w-full h-50'
                            img.setAttribute('src', data.image)
                            singleImg.appendChild(img)
                        }
                    },
                    error: function() {
                        alert('error')
                    }
                })
                showSinglePopup.classList.remove('opacity-0', 'invisible')
            }
            if (state == 'close') {
                showSinglePopup.classList.add('opacity-0', 'invisible')
            }
        }
    </script>
    <script src="{{ asset('assets/js/checkAll.js') }}"></script>
    <script src="{{ asset('assets/js/category.js') }}"></script>
@endsection
