@extends('app.document')
@section('title')
    طبابوک | 
@endsection
@section('content')
<div class="w-11/12 h-[90vh] mx-auto bg-red-500 flex gap-5 justify-start items-center p-3">
    <div class="w-1/2 h-full bg-blue-500 flex flex-col gap-4 justify-start items-start">
        <span class="px-2 py-1 bg-green-200 text-green-900 rounded-full">پک اقتصادی</span>
        <div class="w-full h-20 bg-pink-500 flex gap-5 justify-start items-start">
            <div class="size-10 bg-blue-500"></div>
            <div class="flex flex-col gap-4 justify-start items-start pt-1">
                <h4 class="text-xl font-bold text-green-900">پک اقتصادی مدرسه</h4>
                <p class="text-sm text-[#474948]">برای شزوع سال تحصیلی با هزینه کمتر</p>
            </div>
        </div>
        <p class="w-10/12 ">رای شزوع سال تحصیلی با هزینه کمت رای شزوع سال تحصیلی با هزینه کمت رای شزوع سال تحصیلی با هزینه کمت </p>
        <div class="w-full h-30 bg-green-300 p-3 flex justify-between items-center">
            <div class="w-30/100 h-full bg-red-500 flex gap-5 justify-start items-center">
                <div class="size-8 bg-red-900"></div>
                <div class="flex-col gap-4 justify-start items-start text-xs font-bold">
                    <span>مناسب برای دانش آموزان</span>
                    <span>تمام مقاطع</span>
                </div>
            </div>
            <span class="w-0.5 h-full bg-black"></span>
            <div class="w-30/100 h-full bg-red-500 flex gap-5 justify-start items-center">
                <div class="size-8 bg-red-900"></div>
                <div class="flex-col gap-4 justify-start items-start text-xs font-bold">
                    <span>مناسب برای دانش آموزان</span>
                    <span>تمام مقاطع</span>
                </div>
            </div>
            <span class="w-0.5 h-full bg-black"></span>
            <div class="w-30/100 h-full bg-red-500 flex gap-5 justify-start items-center">
                <div class="size-8 bg-red-900"></div>
                <div class="flex-col gap-4 justify-start items-start text-xs font-bold">
                    <span>مناسب برای دانش آموزان</span>
                    <span>تمام مقاطع</span>
                </div>
            </div>
        </div>
    </div>
    <div class="w-1/2 h-full bg-blue-500"></div>
</div>



@endsection