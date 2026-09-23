@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد محصول')
@section('content')
    <div class="w-full">
        <div class="pb-5 w-full flex justify-center items-center">
            <h1 class="text-xl text-center font-bold lg:text-start">کاربر {{ $user->name }}{{ $user->family }}</h1>
        </div>
        </div>
        <div class="pt-3 mt-4 lg:mt-8">

            <form action="{{ route('user.update') }}" method="post"
                class="shadow__profaill__list_products rounded-lg pb-4 bg-white" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="border-b border-gray-300">
                    <h2 class="text-xl mr-5 text-center lg:text-right py-4">جزییات پروفایل</h2>
                </div>
                <div class="p-5 px-6">
                    <div class="w-full">
                        <div class="tsble">
                            <div class="flex flex-col lg:flex-row">
                                <div class="w-full lg:w-2/12 text-sm py-4">نام کامل</div>
                                <div class="w-full lg:w-10/12 text-sm py-4 flex flex-col lg:flex-row gap-4">
                                    <input
                                        class="w-full lg:w-1/2 p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] "
                                        type="text" value="{{ $user->name }}" name="name" placeholder="نام"
                                        required>
                                    <input
                                        class="w-full lg:w-1/2 p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] "
                                        type="text" value="{{ $user->family }}" name="family"
                                        placeholder="نام خانوادگی" required>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row">
                                <div class="w-full lg:w-2/12 text-sm py-4">شماره تلفن</div>
                                <div class="w-full lg:w-10/12 text-sm">
                                    <input
                                        class="w-full lg:w-1/2 p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9]"
                                        type="number" name="phoneNumber" value="{{ $user->phoneNumber }}"
                                        placeholder="شماره تلفن" required>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row">
                                <div class="w-full lg:w-2/12 text-sm py-4">ایمیل</div>
                                <div class="w-full lg:w-10/12 text-sm py-4">
                                    <input
                                        class="w-full p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9]"
                                        type="email" name="email" value="{{ $user->email }}" placeholder="ایمیل">
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row">
                                <div class="w-full lg:w-2/12 text-sm py-4">رمز عبور</div>
                                <div class="w-full lg:w-10/12 text-sm py-4">
                                    <input
                                        class="w-full p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9]"
                                        type="password" name="password" placeholder="رمز عبور">
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row">
                                <div class="w-full lg:w-2/12 text-sm py-4">نقش</div>
                                <div class="w-full lg:w-10/12 text-sm py-4">
                                    <select
                                        class="w-full p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9]"
                                        name="role">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @if ($role->id == $user->roles[0]->id) {{ 'selected' }} @endif>
                                                {{ $role->fa_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full h-10  flex justify-end pl-6 gap-2">
                    <button class="px-4 py-2 bg-[#F1F1F4] rounded-[7px] cursor-pointer" type="reset">لغو</button>
                    <button class="px-4 py-2 bg-purple-700 rounded-[7px] text-white cursor-pointer" type="submit">ذخیره
                        تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection