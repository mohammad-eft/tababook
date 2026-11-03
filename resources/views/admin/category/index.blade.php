{{-- @extends('admin.app.dashboard')
@section('title', 'طبابوک | جست و جو')
@section('content')
     @if (session('message'))
        <div
            class="modal py-5 px-8 rounded-lg shadow-lg bg-slate-100 fixed top-10 right-10 z-5 flex justify-center items-center transition-all duration-300">
            <span class="font-bold text-sm text-slate-500"> {{ session('message') }} </span>
        </div>
    @endif
    <div class="w-11/12 mx-auto flex flex-col pb-4">
        <div class="bg-white rounded-lg">
            <h2 class="text-lg font-bold text-gray-800 p-4 text-center">لیست دسته بندی ها</h2>
        
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
        </div>
    </div>
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

@endsection --}}

@extends('admin.app.dashboard')
@section('title', 'طبابوک | لیست دسته‌بندی‌ها')

@section('content')
    {{-- پیام موفقیت --}}
    @if (session('message'))
        <div id="flash-message"
            class="py-3 px-5 rounded-xl shadow-lg bg-white border border-emerald-200 fixed top-6 left-6 z-50
                   flex items-center gap-3 transition-all duration-300">
            <span class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-emerald-500" viewBox="0 0 512 512">
                    <path
                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                </svg>
            </span>
            <span class="font-bold text-sm text-gray-700">{{ session('message') }}</span>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 mr-2">✕</button>
        </div>
    @endif

    <div class="w-11/12 mx-auto pb-6">
        <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- هدر --}}
            <div
                class="px-5 py-4 flex flex-row justify-between items-center gap-3 flex-wrap
                        bg-gradient-to-l from-blue-50 via-white to-white border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-blue-500" viewBox="0 0 512 512">
                            <path
                                d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-base font-bold text-gray-800">لیست دسته‌بندی‌ها</h2>
                        <p class="text-xs text-gray-400 mt-0.5">مدیریت و سازمان‌دهی دسته‌ها</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 flex-wrap">
                    <label
                        class="flex items-center gap-2 px-3 py-2 rounded-lg bg-white border border-gray-200
                                  cursor-pointer hover:border-blue-300 transition-colors">
                        <input type="checkbox" id="all" class="w-4 h-4 cursor-pointer accent-blue-600">
                        <span class="text-xs text-gray-600 select-none">انتخاب همه</span>
                    </label>
                    <span id="selected-count"
                        class="hidden text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg"></span>
                    <button type="button" id="bulk-delete-btn" disabled
                        class="flex items-center gap-1.5 bg-red-500 hover:bg-red-600
                               disabled:bg-gray-200 disabled:text-gray-400
                               px-4 py-2 rounded-lg cursor-pointer transition-colors
                               text-xs text-white font-medium shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 fill-current" viewBox="0 0 448 512">
                            <path
                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                        </svg>
                        حذف
                    </button>
                </div>
            </div>

            {{-- هدر ستون‌ها --}}
            <div class="w-full overflow-x-auto [&::-webkit-scrollbar]:hidden">
                <div class="min-w-[700px]">
                    <div
                        class="grid grid-cols-12 px-4 py-3 bg-gray-50/70 border-b border-gray-100
                                text-[11px] font-semibold text-gray-500 uppercase tracking-wide">
                        <div class="col-span-1 text-center">#</div>
                        <div class="col-span-4">دسته‌بندی</div>
                        <div class="col-span-3 text-center">زیر دسته‌ها</div>
                        <div class="col-span-2 text-center">وضعیت</div>
                        <div class="col-span-2 text-center">عملیات</div>
                    </div>

                    {{-- ردیف‌ها --}}
                    <div class="divide-y divide-gray-100">
                        @php $i = 1; @endphp
                        @forelse ($categories as $category)
                            <div
                                class="grid grid-cols-12 items-center px-4 py-3 gap-2
                                        hover:bg-blue-50/40 transition-colors group row-item">
                                {{-- شماره + چک‌باکس --}}
                                <div class="col-span-1 flex items-center justify-center gap-2">
                                    <input type="checkbox" class="check w-4 h-4 cursor-pointer accent-blue-600"
                                        name="categories[]" value="{{ $category->id }}">
                                    <span class="text-xs text-gray-400 tabular-nums">{{ $i }}</span>
                                </div>

                                {{-- تصویر + عنوان --}}
                                <div class="col-span-4 flex items-center gap-3 min-w-0">
                                    <div
                                        class="w-12 h-12 rounded-xl overflow-hidden ring-1 ring-gray-200 bg-gray-50
                                                shrink-0 flex items-center justify-center group-hover:ring-blue-300 transition-all">
                                        @if ($category->image)
                                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                                src="{{ asset('storage/' . $category->image) }}"
                                                alt="{{ $category->title }}" loading="lazy">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M0 96C0 60.7 28.7 32 64 32H196.1c19.1 0 37.4 7.6 50.9 21.1L289.9 96H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16H289.9c-10.6 0-20.7-4.2-28.3-11.7l-42.9-42.9c-3.8-3.8-8.9-5.4-14.1-5.4H64z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 truncate"
                                            title="{{ $category->title }}">
                                            {{ $category->title }}
                                        </p>
                                        <p class="text-[11px] text-gray-400 mt-0.5">ID: {{ $category->id }}</p>
                                    </div>
                                </div>

                                {{-- زیر دسته‌ها --}}
                                <div class="col-span-3 flex justify-center relative">
                                    @if ($category->children->isNotEmpty())
                                        <button type="button"
                                            class="subCats-btn inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                                   text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100
                                                   cursor-pointer transition-colors"
                                            aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 fill-current"
                                                viewBox="0 0 448 512">
                                                <path
                                                    d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                                            </svg>
                                            {{ $category->children->count() }} زیردسته
                                        </button>
                                        <ul
                                            class="subCats-list absolute w-56 top-full mt-1 bg-white right-0 max-h-0 overflow-hidden
                                                   transition-all duration-300 opacity-0 invisible
                                                   flex flex-col divide-y divide-gray-100 border border-gray-200 rounded-xl shadow-xl z-20">
                                            <div class="w-full overflow-auto max-h-60">
                                                @foreach ($category->children as $child)
                                                    <li
                                                        class="w-full py-2 px-3 text-xs text-gray-700 text-right
                                                               hover:bg-blue-50 transition-colors flex items-center gap-2">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400 shrink-0"></span>
                                                        {{ $child->title }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                    @else
                                        <span class="text-xs text-gray-300">—</span>
                                    @endif
                                </div>

                                {{-- وضعیت --}}
                                <div class="col-span-2 flex justify-center">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                                 text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        فعال
                                    </span>
                                </div>

                                {{-- عملیات --}}
                                <div class="col-span-2 flex items-center justify-center gap-1.5">
                                    <button type="button" data-action="show" data-id="{{ $category->id }}" title="مشاهده"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center
                                               bg-sky-50 text-sky-500 hover:bg-sky-500 hover:text-white
                                               transition-all cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current"
                                            viewBox="0 0 576 512">
                                            <path
                                                d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                        </svg>
                                    </button>
                                    <button type="button" data-action="edit" data-id="{{ $category->id }}" title="ویرایش"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center
                                               bg-emerald-50 text-emerald-500 hover:bg-emerald-500 hover:text-white
                                               transition-all cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                        </svg>
                                    </button>
                                    <button type="button" data-action="delete" data-id="{{ $category->id }}"
                                        data-title="{{ $category->title }}" title="حذف"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center
                                               bg-red-50 text-red-500 hover:bg-red-500 hover:text-white
                                               transition-all cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @php $i++; @endphp
                        @empty
                            <div class="w-full py-20 flex flex-col items-center justify-center gap-4">
                                <div class="w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 fill-blue-300"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M0 96C0 60.7 28.7 32 64 32H196.1c19.1 0 37.4 7.6 50.9 21.1L289.9 96H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16H289.9c-10.6 0-20.7-4.2-28.3-11.7l-42.9-42.9c-3.8-3.8-8.9-5.4-14.1-5.4H64zM176 256a16 16 0 1 1 32 0v48h48a16 16 0 1 1 0 32H208v48a16 16 0 1 1 -32 0V336H128a16 16 0 1 1 0-32h48V256z" />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm font-semibold text-gray-600">هنوز دسته‌بندی‌ای ثبت نشده</p>
                                    <p class="text-xs text-gray-400 mt-1">اولین دسته‌بندی خود را بسازید</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ⬇️ پاپ‌آپ‌ها بدون تغییر نسبت به نسخه قبل ⬇️ --}}

    {{-- پاپ‌آپ مشاهده --}}
    {{-- <div id="showSinglePopup" class="w-full h-dvh fixed inset-0 z-50 invisible opacity-0 transition-all duration-300">
        <div class="size-full relative">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-close="show"></div>
            <div class="w-10/12 xl:w-8/12 mx-auto border border-gray-200 rounded-2xl text-[#425A8B] p-6 bg-white
                        absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 max-h-[90vh] overflow-auto shadow-2xl">
                <button class="absolute top-4 left-4 size-8 flex items-center justify-center rounded-full hover:bg-gray-100 cursor-pointer"
                    data-close="show" aria-label="بستن">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-500" viewBox="0 0 384 512">
                        <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                    </svg>
                </button>
                <div class="w-full flex flex-col gap-4 pt-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl px-4 py-3 border border-blue-100">
                            <h3 class="font-bold text-blue-600 text-xs mb-2">عنوان</h3>
                            <p id="singleTitle" class="text-sm text-gray-700"></p>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl px-4 py-3 border border-emerald-100">
                            <h3 class="font-bold text-emerald-600 text-xs mb-2">دسته والد</h3>
                            <p id="singleParent" class="text-sm text-gray-700"></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-slate-50 rounded-xl px-4 py-3">
                            <h3 class="font-bold text-slate-600 text-xs mb-2">توضیحات</h3>
                            <div id="singleDesc" class="text-sm text-gray-700 h-32 overflow-auto leading-6"></div>
                        </div>
                        <div class="bg-slate-50 rounded-xl px-4 py-3">
                            <h3 class="font-bold text-slate-600 text-xs mb-2">زیر دسته‌ها</h3>
                            <div id="singleChildren" class="text-sm text-gray-700 h-32 overflow-auto"></div>
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <h3 class="font-bold text-slate-600 text-xs mb-2">تصویر</h3>
                        <div id="singleImg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- پاپ‌آپ مشاهده --}}
    <div id="showSinglePopup" class="fixed inset-0 z-50 invisible opacity-0 transition-all duration-300">
        <div class="size-full relative flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" data-close="show"></div>

            <div class="relative w-full max-w-3xl bg-white rounded-2xl shadow-2xl
                    max-h-[90vh] overflow-hidden flex flex-col
                    translate-y-4 scale-95 transition-all duration-300"
                id="showSingleContent">

                {{-- هدر --}}
                <div
                    class="flex items-center justify-between gap-3 px-6 py-4
                        bg-gradient-to-l from-blue-500 via-blue-400 to-sky-400
                        text-white shrink-0">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 576 512">
                                <path
                                    d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-bold text-base">جزئیات دسته‌بندی</h3>
                            <p class="text-xs text-white/80 mt-0.5">اطلاعات کامل این دسته</p>
                        </div>
                    </div>
                    <button type="button" data-close="show"
                        class="w-9 h-9 rounded-full bg-white/15 hover:bg-white/30 flex items-center justify-center
                           transition-colors cursor-pointer"
                        aria-label="بستن">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white" viewBox="0 0 384 512">
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>

                {{-- محتوا --}}
                <div class="overflow-auto p-6 flex flex-col gap-5 bg-slate-50/40">

                    {{-- ردیف اول: عنوان + والد --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div
                            class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                                hover:shadow-md hover:border-blue-200 transition-all">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-blue-500"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M0 64C0 28.7 28.7 0 64 0H384c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z" />
                                    </svg>
                                </span>
                                <h4 class="text-xs font-bold text-blue-600">عنوان</h4>
                            </div>
                            <p id="singleTitle" class="text-sm font-semibold text-gray-800"></p>
                        </div>

                        <div
                            class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                                hover:shadow-md hover:border-emerald-200 transition-all">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-emerald-500"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32L109.2 224 214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                                    </svg>
                                </span>
                                <h4 class="text-xs font-bold text-emerald-600">دسته والد</h4>
                            </div>
                            <p id="singleParent" class="text-sm font-semibold text-gray-800"></p>
                        </div>
                    </div>

                    {{-- توضیحات --}}
                    <div
                        class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                            hover:shadow-md hover:border-violet-200 transition-all">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-7 h-7 rounded-lg bg-violet-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-violet-500"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                                </svg>
                            </span>
                            <h4 class="text-xs font-bold text-violet-600">توضیحات</h4>
                        </div>
                        <div id="singleDesc" class="text-sm text-gray-700 leading-7 max-h-32 overflow-auto"></div>
                    </div>

                    {{-- زیر دسته‌ها --}}
                    <div
                        class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                            hover:shadow-md hover:border-amber-200 transition-all">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-amber-500"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                </svg>
                            </span>
                            <h4 class="text-xs font-bold text-amber-600">زیر دسته‌ها</h4>
                        </div>
                        <div id="singleChildren"
                            class="text-sm text-gray-700 max-h-40 overflow-auto
                                                    flex flex-wrap gap-2">
                        </div>
                    </div>

                    {{-- تصویر --}}
                    <div
                        class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                            hover:shadow-md hover:border-pink-200 transition-all">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-7 h-7 rounded-lg bg-pink-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-pink-500"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                </svg>
                            </span>
                            <h4 class="text-xs font-bold text-pink-600">تصویر</h4>
                        </div>
                        <div id="singleImg" class="flex justify-center"></div>
                    </div>
                </div>

                {{-- فوتر --}}
                <div class="px-6 py-3 bg-white border-t border-gray-100 flex justify-end shrink-0">
                    <button type="button" data-close="show"
                        class="px-6 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700
                           text-sm font-medium transition-colors cursor-pointer">بستن</button>
                </div>
            </div>
        </div>
    </div>

    {{-- پاپ‌آپ ویرایش --}}
    {{-- <div id="editFormPopup" class="w-full h-dvh fixed inset-0 z-50 invisible opacity-0 transition-all duration-300">
        <div class="size-full relative">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-close="edit"></div>
            <div
                class="w-11/12 md:w-8/12 mx-auto border border-gray-200 rounded-2xl text-[#425A8B] p-6 bg-white
                        absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 max-h-[90vh] overflow-auto shadow-2xl">
                <button
                    class="absolute top-4 left-4 size-8 flex items-center justify-center rounded-full hover:bg-gray-100 cursor-pointer"
                    data-close="edit" aria-label="بستن">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-500" viewBox="0 0 384 512">
                        <path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                    </svg>
                </button>
                <div id="popupContent" class="pt-6">
                    <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data"
                        class="flex flex-col gap-6" id="editForm">
                        @csrf
                        <input type="hidden" name="cat_id" id="cat_id">
                        <div class="flex flex-col">
                            <label for="catTitle" class="mb-2 text-sm font-medium">
                                عنوان دسته‌بندی: <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="title" id="catTitle" placeholder="نام دسته را وارد کنید"
                                class="outline-none px-4 py-3 bg-gray-50 rounded-xl border border-transparent
                                       focus:bg-white focus:border-blue-400 transition-colors"
                                required>
                        </div>
                        <div class="flex flex-col">
                            <label for="cat_desc" class="mb-2 text-sm font-medium">توضیحات دسته‌بندی:</label>
                            <input type="text" name="description" id="cat_desc" placeholder="توضیحات"
                                class="outline-none px-4 py-3 bg-gray-50 rounded-xl border border-transparent
                                       focus:bg-white focus:border-blue-400 transition-colors">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="flex flex-col">
                                <label for="parent_id" class="mb-2 text-sm font-medium">دسته والد:</label>
                                <select name="parent_id" id="parent_id"
                                    class="bg-gray-50 px-4 py-3 rounded-xl border border-transparent focus:border-blue-400 outline-none">
                                    <option value="0">بدون والد</option>
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <label for="image" class="mb-2 text-sm font-medium">عکس دسته‌بندی:</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="outline-none px-4 py-2.5 bg-gray-50 rounded-xl border border-transparent
                                           focus:border-blue-400 file:mr-3 file:py-1 file:px-3 file:rounded-md
                                           file:border-0 file:bg-blue-100 file:text-blue-600 file:text-xs file:cursor-pointer">
                            </div>
                            <div class="relative" id="cat_img"></div>
                        </div>
                        <div class="text-center pt-2">
                            <button type="submit"
                                class="py-3 px-10 rounded-xl bg-blue-500 hover:bg-blue-600 text-white
                                       font-medium cursor-pointer transition-colors shadow-sm">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- پاپ‌آپ ویرایش --}}
    <div id="editFormPopup" class="fixed inset-0 z-50 invisible opacity-0 transition-all duration-300">
        <div class="size-full relative flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" data-close="edit"></div>

            <div
                class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl
                    max-h-[90vh] overflow-hidden flex flex-col">

                {{-- هدر --}}
                <div
                    class="flex items-center justify-between gap-3 px-6 py-4
                        bg-gradient-to-l from-emerald-500 via-emerald-400 to-teal-400
                        text-white shrink-0">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 512 512">
                                <path
                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-bold text-base">ویرایش دسته‌بندی</h3>
                            <p class="text-xs text-white/80 mt-0.5">اطلاعات را به‌روزرسانی کنید</p>
                        </div>
                    </div>
                    <button type="button" data-close="edit"
                        class="w-9 h-9 rounded-full bg-white/15 hover:bg-white/30 flex items-center justify-center
                           transition-colors cursor-pointer"
                        aria-label="بستن">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white" viewBox="0 0 384 512">
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>

                {{-- محتوا --}}
                <div class="overflow-auto p-6 bg-slate-50/40">
                    <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data"
                        class="flex flex-col gap-4" id="editForm">
                        @csrf
                        <input type="hidden" name="cat_id" id="cat_id">

                        {{-- عنوان --}}
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                            <label for="catTitle" class="flex items-center gap-2 mb-3">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-blue-500"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M0 64C0 28.7 28.7 0 64 0H384c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z" />
                                    </svg>
                                </span>
                                <span class="text-xs font-bold text-gray-700">عنوان دسته‌بندی <span
                                        class="text-rose-500">*</span></span>
                            </label>
                            <input type="text" name="title" id="catTitle" placeholder="نام دسته را وارد کنید"
                                required
                                class="w-full outline-none px-4 py-3 bg-gray-50 rounded-xl border border-transparent
                                   text-sm text-gray-800 placeholder:text-gray-400
                                   focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100
                                   transition-all duration-150">
                        </div>

                        {{-- توضیحات --}}
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                            <label for="cat_desc" class="flex items-center gap-2 mb-3">
                                <span class="w-7 h-7 rounded-lg bg-violet-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-violet-500"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                                    </svg>
                                </span>
                                <span class="text-xs font-bold text-gray-700">توضیحات</span>
                            </label>
                            <textarea name="description" id="cat_desc" placeholder="توضیحات دسته را وارد کنید" rows="3"
                                class="w-full outline-none px-4 py-3 bg-gray-50 rounded-xl border border-transparent
                                   text-sm text-gray-800 placeholder:text-gray-400 resize-none
                                   focus:bg-white focus:border-violet-400 focus:ring-2 focus:ring-violet-100
                                   transition-all duration-150"></textarea>
                        </div>

                        {{-- والد + تصویر --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                                <label for="parent_id" class="flex items-center gap-2 mb-3">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-emerald-500"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32L109.2 224 214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                                        </svg>
                                    </span>
                                    <span class="text-xs font-bold text-gray-700">دسته والد</span>
                                </label>
                                <select name="parent_id" id="parent_id"
                                    class="w-full bg-gray-50 px-4 py-3 rounded-xl border border-transparent
                                       text-sm text-gray-800
                                       focus:bg-white focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100
                                       outline-none transition-all duration-150">
                                    <option value="0">بدون والد</option>
                                </select>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                                <label for="image" class="flex items-center gap-2 mb-3">
                                    <span class="w-7 h-7 rounded-lg bg-pink-50 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-pink-500"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                        </svg>
                                    </span>
                                    <span class="text-xs font-bold text-gray-700">تصویر دسته‌بندی</span>
                                </label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="w-full text-xs text-gray-600
                                       file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0
                                       file:bg-pink-50 file:text-pink-600 file:text-xs file:font-medium
                                       file:cursor-pointer hover:file:bg-pink-100 file:transition-colors
                                       outline-none bg-gray-50 rounded-xl py-2 px-2 cursor-pointer">
                            </div>
                        </div>

                        {{-- پیش‌نمایش تصویر فعلی --}}
                        <div id="cat_img" class="relative hidden"></div>
                    </form>
                </div>

                {{-- فوتر --}}
                <div class="px-6 py-3 bg-white border-t border-gray-100 flex justify-end gap-2 shrink-0">
                    <button type="button" data-close="edit"
                        class="px-5 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700
                           text-sm font-medium transition-colors cursor-pointer">انصراف</button>
                    <button type="submit" form="editForm"
                        class="px-6 py-2 rounded-xl bg-gradient-to-l from-emerald-500 to-teal-500
                           hover:from-emerald-600 hover:to-teal-600 text-white text-sm font-medium
                           shadow-md hover:shadow-lg transition-all cursor-pointer
                           flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-white" viewBox="0 0 448 512">
                            <path
                                d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                        </svg>
                        ذخیره تغییرات
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- پاپ‌آپ تأیید حذف --}}
    <div id="confirmDeletePopup" class="w-full h-dvh fixed inset-0 z-50 invisible opacity-0 transition-all duration-300">
        <div class="size-full relative">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-close="delete"></div>
            <div
                class="w-11/12 md:w-1/2 xl:w-1/3 mx-auto border border-gray-200 rounded-2xl text-[#425A8B] p-6 bg-white
                        absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 shadow-2xl">
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 fill-red-500" viewBox="0 0 512 512">
                            <path
                                d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <p class="text-base font-semibold text-gray-800">حذف دسته‌بندی</p>
                    <p class="text-sm text-gray-600 leading-7">آیا از حذف
                        <span id="confirmDeleteCatName" class="font-bold text-gray-900"></span>
                        اطمینان دارید؟
                    </p>
                    <p class="text-xs text-gray-400">این عملیات قابل بازگشت نیست.</p>
                    <div class="flex items-center justify-center gap-3 mt-2 w-full">
                        <a id="yes" href="#"
                            class="flex-1 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium
                                   rounded-xl text-center transition-colors">بله،
                            حذف کن</a>
                        <button type="button" data-close="delete"
                            class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium
                                   rounded-xl transition-colors">خیر</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            'use strict';

            const $ = (s, el = document) => el.querySelector(s);
            const $$ = (s, el = document) => [...el.querySelectorAll(s)];
            const csrfToken = "{{ csrf_token() }}";

            /* Flash */
            const flash = $('#flash-message');
            if (flash) setTimeout(() => {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 300);
            }, 4000);

            /* Popup helpers */
            function openPopup(id) {
                const el = document.getElementById(id);
                if (!el) return;
                el.classList.remove('invisible', 'opacity-0');
            }

            function closePopup(id) {
                const el = document.getElementById(id);
                if (!el) return;
                el.classList.add('invisible', 'opacity-0');
            }
            $$('[data-close]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const key = btn.dataset.close;
                    if (key === 'show') closePopup('showSinglePopup');
                    if (key === 'edit') closePopup('editFormPopup');
                    if (key === 'delete') closePopup('confirmDeletePopup');
                });
            });
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    closePopup('showSinglePopup');
                    closePopup('editFormPopup');
                    closePopup('confirmDeletePopup');
                }
            });

            /* Selection / bulk */
            const allCheck = $('#all');
            const bulkDeleteBtn = $('#bulk-delete-btn');
            const selectedCount = $('#selected-count');
            const checks = () => $$('.check');

            function refreshSelection() {
                const total = checks().length;
                const selected = checks().filter(c => c.checked).length;
                if (selected > 0) {
                    selectedCount.textContent = `${selected} انتخاب شده`;
                    selectedCount.classList.remove('hidden');
                    bulkDeleteBtn.disabled = false;
                } else {
                    selectedCount.classList.add('hidden');
                    bulkDeleteBtn.disabled = true;
                }
                allCheck.checked = selected === total && total > 0;
                allCheck.indeterminate = selected > 0 && selected < total;
            }
            allCheck.addEventListener('change', () => {
                checks().forEach(c => c.checked = allCheck.checked);
                refreshSelection();
            });
            document.addEventListener('change', e => {
                if (e.target.classList.contains('check')) refreshSelection();
            });
            bulkDeleteBtn.addEventListener('click', () => {
                const ids = checks().filter(c => c.checked).map(c => c.value);
                if (!ids.length) return;
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('category.bulkDelete') }}";
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="DELETE">
                    ${ids.map(id => `<input type="hidden" name="ids[]" value="${id}">`).join('')}
                `;
                document.body.appendChild(form);
                form.submit();
            });

            /* Sub-cats dropdown */
            document.addEventListener('click', e => {
                const btn = e.target.closest('.subCats-btn');
                if (btn) {
                    const list = btn.parentElement.querySelector('.subCats-list');
                    const isOpen = list.classList.contains('opacity-100');
                    $$('.subCats-list').forEach(l => {
                        l.classList.remove('opacity-100', 'visible');
                        l.classList.add('opacity-0', 'invisible', 'max-h-0');
                    });
                    $$('.subCats-btn').forEach(b => b.setAttribute('aria-expanded', 'false'));
                    if (!isOpen) {
                        list.classList.remove('opacity-0', 'invisible', 'max-h-0');
                        list.classList.add('opacity-100', 'visible');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                } else if (!e.target.closest('.subCats-list')) {
                    $$('.subCats-list').forEach(l => {
                        l.classList.remove('opacity-100', 'visible');
                        l.classList.add('opacity-0', 'invisible', 'max-h-0');
                    });
                }
            });

            /* Actions */
            document.addEventListener('click', e => {
                const btn = e.target.closest('[data-action]');
                if (!btn) return;
                const {
                    action,
                    id,
                    title
                } = btn.dataset;
                if (action === 'show') showCategory(id);
                if (action === 'edit') editCategory(id);
                if (action === 'delete') openDeleteConfirm(id, title);
            });

            function showCategory(id) {
                fetch("{{ route('category.adminShow') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            id
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        $('#singleTitle').textContent = data.title ?? '—';
                        $('#singleDesc').textContent = data.description ?? '—';
                        $('#singleParent').textContent = data.parent?.title ?? 'بدون والد';
                        $('#singleChildren').innerHTML = data.subCats ??
                            '<span class="text-xs text-gray-400">بدون زیردسته</span>';
                        const imgBox = $('#singleImg');
                        imgBox.innerHTML = '';
                        if (data.image) {
                            const img = document.createElement('img');
                            img.className = 'w-full max-h-72 object-contain rounded-xl';
                            img.src = data.image;
                            img.alt = data.title ?? '';
                            imgBox.appendChild(img);
                        } else {
                            imgBox.innerHTML = '<span class="text-xs text-gray-400 italic">بدون تصویر</span>';
                        }
                        openPopup('showSinglePopup');
                    })
                    .catch(() => alert('خطا در دریافت اطلاعات'));
            }

            function editCategory(id) {
                fetch("{{ route('category.edit') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            id
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        const cat = data.cat;
                        $('#catTitle').value = cat.title ?? '';
                        $('#cat_desc').value = cat.description ?? '';
                        $('#cat_id').value = cat.id;

                        // const imgBox = $('#cat_img');
                        // imgBox.innerHTML = '';
                        // if (cat.image) {
                        //     const img = document.createElement('img');
                        //     img.className = 'w-full h-28 object-cover rounded-lg ring-1 ring-gray-200';
                        //     img.src = cat.image;
                        //     imgBox.appendChild(img);
                        //     const delBtn = document.createElement('button');
                        //     delBtn.type = 'button';
                        //     delBtn.className =
                        //         'absolute top-1 left-1 w-6 h-6 rounded-full bg-red-500 text-white text-xs flex items-center justify-center cursor-pointer';
                        //     delBtn.textContent = '✕';
                        //     delBtn.addEventListener('click', () => markImageForRemoval(imgBox, cat.image));
                        //     imgBox.appendChild(delBtn);
                        // }

                        // در تابع editCategory، بخش image preview
                        const imgBox = $('#cat_img');
                        imgBox.innerHTML = '';
                        if (cat.image) {
                            imgBox.classList.remove('hidden');
                            imgBox.className = 'relative bg-white rounded-xl p-4 border border-gray-100 shadow-sm';

                            const wrapper = document.createElement('div');
                            wrapper.className = 'flex items-center gap-4';

                            const img = document.createElement('img');
                            img.className = 'w-20 h-20 object-cover rounded-xl ring-1 ring-gray-200';
                            img.src = cat.image;
                            wrapper.appendChild(img);

                            const info = document.createElement('div');
                            info.className = 'flex-1';
                            info.innerHTML = `
                                    <p class="text-xs font-medium text-gray-700">تصویر فعلی</p>
                                    <p class="text-[11px] text-gray-400 mt-1">برای تغییر، فایل جدید انتخاب کنید</p>
                                `;
                            wrapper.appendChild(info);

                            const delBtn = document.createElement('button');
                            delBtn.type = 'button';
                            delBtn.className =
                                'w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors cursor-pointer';
                            delBtn.innerHTML = `
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                `;
                            delBtn.addEventListener('click', () => markImageForRemoval(imgBox, cat.image));
                            wrapper.appendChild(delBtn);

                            imgBox.appendChild(wrapper);
                        } else {
                            imgBox.classList.add('hidden');
                        }

                        const select = $('#parent_id');
                        select.innerHTML = '<option value="0">بدون والد</option>';
                        (data.cats || []).forEach(c => {
                            if (c.id === cat.id) return;
                            const opt = document.createElement('option');
                            opt.value = c.id;
                            opt.textContent = c.title;
                            if (c.id === cat.parent_id) opt.selected = true;
                            select.appendChild(opt);
                        });
                        if (!cat.parent_id) select.value = '0';

                        openPopup('editFormPopup');
                    })
                    .catch(() => alert('خطا در دریافت اطلاعات'));
            }

            function markImageForRemoval(container, url) {
                const idx = url.indexOf('categoryImgs');
                const relative = idx >= 0 ? url.slice(idx) : url;
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'removedImg';
                input.value = relative;
                $('#editForm').appendChild(input);
                container.innerHTML = '<span class="text-xs text-gray-400 italic">تصویر حذف شد</span>';
            }

            function openDeleteConfirm(id, title) {
                $('#confirmDeleteCatName').textContent = title ?? '';
                $('#yes').setAttribute('href', `{{ url('category/delete') }}/${id}`);
                openPopup('confirmDeletePopup');
            }
        })();
    </script>
@endsection
