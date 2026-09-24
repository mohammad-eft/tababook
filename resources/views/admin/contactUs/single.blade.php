@extends('admin.app.dashboard')
@section('title', 'صفحه ارتباط با ما')
@section('content')
    <div class="pt-3 mt-4 lg:mt-8">
        <div class="bg-white rounded-md lg:p-5 p-2 mb-3 lg:mb-5">
            <h1 class="lg:text-xl mt-5 font-bold pb-3 border-b border-gray-200">جزییات دسته بندی  </h1>
           
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
@endsection
