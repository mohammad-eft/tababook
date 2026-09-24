@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد محصول')
@section('content')
<div class="w-full lg:w-1/2 lg:mx-auto my-6">
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="{{ route('user.save') }}" class="w-full flex flex-col items-center gap-3" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-full flex flex-col gap-3">
                <label>نام</label>
                <input type="text" value="{{ Auth::user()->name }}"
                    class="w-full p-[9px] mb-1 rounded-[7px] border border-[#DBDFE9] outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500"
                    name="name" placeholder="نام خود را وارد کنید">
            </div>
            <div class="w-full flex flex-col gap-3">
                <label>نام خانوادگی</label>
                <input type="text" value="{{ Auth::user()->family }}"
                    class="w-full p-[9px] mb-1 rounded-[7px] border border-[#DBDFE9] outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500"
                    name="family" placeholder="نام خانوادگی خود را وارد کنید">
            </div>
            <div class="w-full flex flex-col gap-3">
                <label>ایمیل</label>
                <input type="email" value="{{ Auth::user()->email }}" 
                    class="w-full p-[9px] mb-1 rounded-[7px] border border-[#DBDFE9] outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500"
                    name="email" placeholder="test@example.com">
            </div>
            <button class="text-center w-full bg-purple-600 hover:bg-purple-700 p-3 rounded-[10px] text-white cursor-pointer transition">ذخیره</button>
        </form>
    </div>
</div>
@endsection