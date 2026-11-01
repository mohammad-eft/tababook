{{-- @extends('app.document')
@section('title', 'طبابوک | تیکت')
@section('content')
 <div class="pt-3 mt-4 lg:mt-8">
        <div class="shadow__profaill__karbary rounded-md lg:p-5 p-2 mb-3 lg:mb-5">
            <h1 class="lg:text-xl mt-5 font-bold pb-3 border-b border-gray-200">جزییات تیکت</h1>
           
            <div class="w-full lg:w-1/2 flex flex-col gap-y-3 lg:gap-y-5 mt-5">
                <div class="w-full lg:py-3 flex flex-col gap-2 lg:gap-0 lg:flex-row lg:items-center">
                    <div class="w-full lg:w-1/2 text-xs lg:text-sm text-gray-400">
                        عنوان 
                    </div>
                    <div class="w-full lg:w-1/2 font-medium pr-3 lg:pr-0 text-sm lg:text-base">
                       {{ $contactUs->title }}
                    </div>
                </div>
                <div class="w-full lg:py-3 flex flex-col gap-2 lg:gap-0 lg:flex-row lg:items-center">
                    <div class="w-full lg:w-1/2 text-xs lg:text-sm text-gray-400">
                       توضیحات
                    </div>
                    <div class="w-full lg:w-1/2 font-medium pr-3 lg:pr-0 text-sm lg:text-base">
                       {{ $contactUs->description }}
                    </div>
                </div>
                <div class="w-full lg:py-3 flex flex-col gap-2 lg:gap-0 lg:flex-row lg:items-center">
                    <div class="w-full lg:w-1/2 text-xs lg:text-sm text-gray-400">
                       شماره تماس
                    </div>
                    <div class="w-full lg:w-1/2 font-medium pr-3 lg:pr-0 text-sm lg:text-base">
                       {{ $contactUs->phoneNumber }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>
@endsection --}}

@extends('app.document')
@section('title', 'طبابوک | جزئیات تیکت')
@section('content')
<div class="pt-3 mt-4 lg:mt-8">
    <div class="shadow__profaill__karbary bg-white rounded-md
                lg:p-5 p-3 mb-3 lg:mb-5 border border-gray-100">

        {{-- هدر صفحه --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between
                    gap-3 pb-3 border-b border-gray-200">
            <h2 class="lg:text-xl font-bold text-gray-800">جزئیات تیکت</h2>

            <a href="{{ route('contactUs.myMessage') }}"
               class="inline-flex items-center gap-1 text-sm text-sky-700
                      hover:text-sky-800 hover:underline self-start sm:self-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                بازگشت به لیست
            </a>
        </div>

        {{-- بدنه جزئیات --}}
        <div class="w-full lg:w-2/3 flex flex-col gap-y-0 mt-4">

            {{-- عنوان --}}
            <div class="flex flex-col lg:flex-row gap-1 lg:gap-4 py-3
                        border-b border-gray-100">
                <div class="w-full lg:w-1/3 text-xs lg:text-sm text-gray-400 shrink-0">
                    عنوان
                </div>
                <div class="w-full lg:w-2/3 font-medium text-sm lg:text-base
                            text-gray-900 break-words">
                    {{ $contactUs->title }}
                </div>
            </div>

            {{-- توضیحات --}}
            <div class="flex flex-col lg:flex-row gap-1 lg:gap-4 py-3
                        border-b border-gray-100">
                <div class="w-full lg:w-1/3 text-xs lg:text-sm text-gray-400 shrink-0">
                    توضیحات
                </div>
                <div class="w-full lg:w-2/3 font-medium text-sm lg:text-base
                            text-gray-900 break-words whitespace-pre-line
                            leading-7">
                    @if($contactUs->description)
                        {{ $contactUs->description }}
                    @else
                        <span class="text-gray-400 italic">—</span>
                    @endif
                </div>
            </div>

            {{-- شماره تماس --}}
            <div class="flex flex-col lg:flex-row gap-1 lg:gap-4 py-3">
                <div class="w-full lg:w-1/3 text-xs lg:text-sm text-gray-400 shrink-0">
                    شماره تماس
                </div>
                <div class="w-full lg:w-2/3 font-medium text-sm lg:text-base
                            text-gray-900" dir="ltr">
                    @if($contactUs->phoneNumber)
                        <a href="tel:{{ $contactUs->phoneNumber }}"
                           class="hover:text-sky-700 hover:underline transition">
                            {{ $contactUs->phoneNumber }}
                        </a>
                    @else
                        <span class="text-gray-400 italic">—</span>
                    @endif
                </div>
            </div>

        </div>

        {{-- عملیات --}}
        <div class="flex flex-col sm:flex-row gap-2 mt-6 pt-4
                    border-t border-gray-100">
            <a href="{{ route('contactUs.edit', [$contactUs]) }}"
               class="inline-flex items-center justify-center gap-1.5
                      bg-green-500 hover:bg-green-600 text-white text-sm
                      px-4 py-2 rounded-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512">
                    <path fill="currentColor"
                          d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/>
                </svg>
                ویرایش تیکت
            </a>

            <a href="{{ route('contactUs.delete', [$contactUs]) }}"
               onclick="return confirm('آیا از حذف این تیکت مطمئن هستید؟')"
               class="inline-flex items-center justify-center gap-1.5
                      bg-red-500 hover:bg-red-600 text-white text-sm
                      px-4 py-2 rounded-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512">
                    <path fill="currentColor"
                          d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80z"/>
                </svg>
                حذف تیکت
            </a>
        </div>

    </div>
</div>
@endsection