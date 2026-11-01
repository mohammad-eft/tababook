 {{-- @extends('admin.app.dashboard')
    @section('title', 'طبابوک | درباره ما')
    @section('content')
        <div class="w-full flex flex-col pb-4">
         <div class="bg-white rounded-lg">
             <div class="pb-4">
                 <h2 class="text-lg font-bold text-gray-800 p-2.5"> درباره ما </h2>
             </div>
             <div class="flex flex-col gap-5">
                 <div class="max-w-10/12 min-w-10/12 mx-auto shadow-md rounded mb-5 overflow-auto">
                     <div
                         class="w-full grid grid-cols-3 items-center divide-x divide-[#f1f1f4] sticky -top-5">
                         <div class="px-1 lg:px-6 py-3 text-center text-xs font-medium text-gray-600 bg-gray-100">
                             <span class="block w-full">ردیف</span>
                         </div>
                         <div class="px-1 lg:px-6 py-3 text-center text-xs font-medium text-gray-600 bg-gray-100">
                             <span class="block w-full">عنوان</span>
                         </div>

                         <div class="px-1 lg:px-6 py-3 text-center text-xs font-medium text-gray-600 bg-gray-100">
                             <span class="block w-full">عملیات</span>
                         </div>

                     </div>
                     <div class="bg-white divide-y divide-[#f1f1f4]">
                         @php
                             $i = 1;
                         @endphp

                         @foreach ($allAboutUs as $aboutUs)
                             <div
                                 class="w-full grid grid-cols-3 items-center divide-x divide-[#f1f1f4]">
                                 <div
                                     class="p-1 lg:p-3 text-xs lg:text-sm h-full flex items-center justify-center text-gray-900 text-center">
                                     <span class="block w-full">{{ $i }}</span>
                                 </div>
                                 <div
                                     class="p-1 lg:p-3 text-xs lg:text-sm h-full flex items-center justify-center text-gray-900">

                                        <span class="block w-full text-center">{{ $aboutUs->title }}</span>

                                 </div>


                                 <ul class="text-sm mt-1 rounded-sm p-1 grid grid-cols-2">

                                     <li class="flex justify-center">
                                         <a href="{{ route('aboutUs.create_edit', [$aboutUs]) }}"
                                             class="w-fit flex flex-row items-center justify-center bg-green-500 hover:bg-green-600 p-1 rounded-sm"
                                             title="ویرایش">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512">
                                                 <path fill="white"
                                                     d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                             </svg>
                                         </a>
                                     </li>
                                     <li class="flex justify-center">
                                         <a href="{{ route('aboutUs.delete', [$aboutUs]) }}"
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
             </div>
         </div>
     </div>
@endsection --}}

@extends('admin.app.dashboard')
@section('title', 'طبابوک | درباره ما')
@section('content')
<div class="w-full flex flex-col pb-4">
    <div class="bg-white rounded-lg shadow-sm">

        {{-- هدر صفحه --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3
                    p-4 border-b border-gray-100">
            <div>
                <h2 class="text-base sm:text-lg font-bold text-gray-800">درباره ما</h2>
                <p class="text-xs text-gray-500 mt-0.5">
                    مدیریت بخش‌های صفحه «درباره ما»
                </p>
            </div>

            {{-- اگر روت ایجاد وجود دارد، این دکمه را فعال کنید --}}
            {{-- <a href="{{ route('aboutUs.create_edit') }}"
               class="inline-flex items-center gap-1.5 bg-sky-500 hover:bg-sky-600
                      text-white text-sm px-4 py-2 rounded-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                </svg>
                افزودن
            </a> --}}
        </div>

        @if($allAboutUs->isEmpty())
            {{-- حالت خالی --}}
            <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-14 text-gray-300 mb-3"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 text-sm">هنوز هیچ مطلبی برای «درباره ما» ثبت نشده است.</p>
            </div>
        @else

            {{-- نمای دسکتاپ: جدول --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm text-center">
                    <thead class="bg-gray-100 text-gray-600 text-xs">
                        <tr>
                            <th class="p-3 w-16">ردیف</th>
                            <th class="p-3 text-right">عنوان</th>
                            <th class="p-3 w-40">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($allAboutUs as $i => $aboutUs)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3 text-gray-700">{{ $i + 1 }}</td>
                                <td class="p-3 text-gray-900 text-right">
                                    <span class="line-clamp-2 break-words">{{ $aboutUs->title }}</span>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center justify-center gap-2">
                                        @include('admin.aboutUs._row_actions', ['aboutUs' => $aboutUs])
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- نمای موبایل/تبلت: کارت --}}
            <div class="md:hidden divide-y divide-gray-100">
                @foreach ($allAboutUs as $i => $aboutUs)
                    <div class="p-4 flex items-start gap-3">
                        <span class="shrink-0 inline-flex items-center justify-center
                                     size-7 rounded-full bg-gray-100 text-xs
                                     font-medium text-gray-600">
                            {{ $i + 1 }}
                        </span>

                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-medium text-gray-900 break-words mb-2">
                                {{ $aboutUs->title }}
                            </h3>
                            <div class="flex items-center gap-2">
                                @include('admin.aboutUs._row_actions', ['aboutUs' => $aboutUs])
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>
</div>
@endsection