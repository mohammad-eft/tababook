@extends('app.document')
@section('title', 'ایجاد ارتباط باما')
@section('content')
    <div class="2xl:container w-10/12 mx-auto">
        <div class="text-center mb-4 mt-4 lg:mt-10">
            <h1 class="text-lg font-bold text-gray-800">
               ارسال تیکت به ادمین
            </h1>
        </div>
        @if (Auth::user()->contactUs && count(Auth::user()->contactUs))
            <a href="{{ route('contactUs.myMessage') }}" class="text-sky-700 inline-block mb-5">لیست تیکت ها</a>
        @endif
        <form action="{{ route('contactUs.store') }}" method="post">
            @csrf
            <div class="flex items-start justify-center">
                <div class="bg-white rounded-2xl shadow-md p-3 w-full lg:w-3/4">
                    <div class="text-center mb-4">
                        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-3 my-4">
                            <div class="w-full flex flex-col gap-3 itmes-center max-md:flex-col max-md:gap-1">
                                <label class="w-30 text-sm mb-1 mt-2.5 flex">شماره تماس</label>
                                <div
                                        class="rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] text-[#99A1B7] w-full flex">
                                    <input class="p-4 w-full focus:outline-none text-sm font-bold mr-2 " type="number"
                                           name='phoneNumber' placeholder="شماره تماس" title="شماره تماس" required>
                                </div>
                            </div>
                            <div class="w-full flex flex-col gap-3 itmes-center max-md:flex-col max-md:gap-1">
                                <label class="w-30 text-sm mb-1 mt-2.5 flex">عنوان</label>
                                <div
                                        class="rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] text-[#99A1B7] w-full flex">
                                    <input class="p-4 w-full focus:outline-none text-sm font-bold mr-2" type="text"
                                           name='title' placeholder="عنوان" required>
                                </div>
                            </div>
                            <div class="w-full flex flex-col gap-3 itmes-center max-md:flex-col max-md:gap-1 lg:col-span-2">
                                <label class="w-30 text-sm mb-1 mt-2.5 flex">توضیحات</label>
                                <div
                                        class="rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] text-[#99A1B7] w-full flex">
                                    <textarea class="p-4 w-full focus:outline-none text-sm font-bold mr-2"
                                              name='description' placeholder="توضیحات را وارد کنید" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-center">
                            <button type="submit"
                                    class="mt-2 bg-[#eb3254] text-white p-3 max-md:p-2 rounded-md hover:bg-blue-700 transition duration-200 font-medium cursor-pointer">
                                ثبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
