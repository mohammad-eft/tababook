 @extends('admin.app.dashboard')
 @section('title', 'ارتباط با ما')
 @section('content')
     <div class="w-full flex flex-col pb-4">
         <div class="bg-white rounded-lg">
             <div class="pb-4">
                 <h2 class="text-lg font-bold text-gray-800 p-2.5">لیست ارتباط با ما</h2>
             </div>
             <form action="{{ route('contactUs.deleteAll') }}" method="post" class="flex flex-col gap-5">
                 @csrf
             <div class="flex flex-col gap-5">
                 <div class="w-10/12 mx-auto flex flex-row justify-between items-center pb-4">
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
            <div class="w-10/12 mx-auto shadow-md rounded mb-5 overflow-x-scroll [&::-webkit-scrollbar]:hidden">
                <div class="w-full grid grid-cols-5 items-center divide-x divide-[#f1f1f4] sticky -top-5">
                    <!-- ستون چک‌باکس -->
                    <div class="px-1 lg:px-6 py-3 text-center text-xs font-medium text-gray-600 bg-gray-100 h-full">
                        <div class="block w-full h-full">-</div>
                   </div>

                   <!-- ستون ردیف -->
                    <div class="px-1 lg:px-6 py-3 text-center text-xs font-medium text-gray-600 bg-gray-100">
                       <span class="block w-full">ردیف</span>
                   </div>

                   <!-- ستون عنوان -->
                   <div class="px-1 lg:px-6 py-3 text-center text-xs font-medium text-gray-600 bg-gray-100">
                       <span class="block w-full">عنوان</span>
                    </div>

                    <!-- ستون شماره تماس -->
                    <div class="px-1 lg:px-6 py-3 text-center text-xs font-medium text-gray-600 bg-gray-100">
                        <span class="block w-full">شماره تماس</span>
                   </div>

                   <!-- ستون عملیات -->
                   <div class="px-1 lg:px-6 py-3 text-center text-xs font-medium text-gray-600 bg-gray-100">
                       <span class="block w-full">عملیات</span>
                   </div>
                </div>
    <div class="bg-white divide-y divide-[#f1f1f4]">
        @php
            $i = 1;
        @endphp

        @foreach ($allContactUs as $contactUs)
            <div class="w-full grid grid-cols-5 items-center divide-x divide-[#f1f1f4]">
                <!-- ستون چک‌باکس -->
                <div class="p-1 lg:p-3 text-xs lg:text-sm h-full flex items-center justify-center text-gray-900 text-center">
                    <div class="w-full">
                        <input type="checkbox" class="check" name="allContactUs[]" value="{{ $contactUs->id }}">
                    </div>
                </div>
                
                <!-- ستون ردیف -->
                <div class="p-1 lg:p-3 text-xs lg:text-sm h-full flex items-center justify-center text-gray-900 text-center">
                    <span class="block w-full">{{ $i }}</span>
                </div>
                
                <!-- ستون عنوان -->
                <div class="p-1 lg:p-3 text-xs lg:text-sm h-full flex items-center justify-center text-gray-900 text-center">
                    <a href="{{ route('contactUs.single', [$contactUs]) }}" class="block w-full">{{ $contactUs->title }}</a>
                </div>
                
                <!-- ستون شماره تماس -->
                <div class="p-1 lg:p-3 text-xs lg:text-sm h-full text-end flex items-center justify-center text-gray-900">
                    <div class="w-full">
                        <span class="block w-full">{{ $contactUs->phoneNumber }}</span>
                    </div>
                </div>
                
                <!-- ستون عملیات -->
                <ul class="text-sm rounded-sm p-1 grid grid-cols-2 gap-1">
                    <li class="flex justify-center">
                        <a href="{{ route('contactUs.single', [$contactUs]) }}"
                            class="w-fit flex flex-row items-center justify-center bg-sky-500 hover:bg-sky-600 p-1 rounded-sm"
                            title="مشاهده">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512">
                                <path fill="white"
                                    d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center">
                        <a href="{{ route('contactUs.delete', [$contactUs]) }}"
                            class="w-fit flex flex-row items-center justify-center bg-red-500 hover:bg-red-600 p-1 rounded-sm"
                            title="حذف">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512">
                                <path fill="white"
                                    d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
    </div>
</div>
    <script src="{{ asset('assets/js/checkAll.js') }}"></script>
 @endsection
