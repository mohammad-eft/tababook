<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="../css/output.css" type="text/css"> --}}
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <style>
        .chosenItem:hover img {
            transform: scale(1.1);
        }

        .borderGradient {
            background: rgb(180, 115, 187);
            background: linear-gradient(90deg, rgba(180, 115, 187, 1) 50%, rgba(255, 255, 255, 1) 100%);
        }
    </style>
    <title>tabaBook</title>
</head>

<body>
<div class="w-full lg:w-1/2 lg:mx-auto my-6">
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="{{ route('user.save') }}" class="w-full flex flex-col items-center gap-3" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-full flex flex-col gap-3">
                <label>نام</label>
                <input type="text"
                    class="w-full p-[9px] mb-1 rounded-[7px] border border-[#DBDFE9] outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500"
                    name="name" placeholder="نام خود را وارد کنید">
            </div>
            <div class="w-full flex flex-col gap-3">
                <label>نام خانوادگی</label>
                <input type="text"
                    class="w-full p-[9px] mb-1 rounded-[7px] border border-[#DBDFE9] outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500"
                    name="family" placeholder="نام خانوادگی خود را وارد کنید">
            </div>
            <div class="w-full flex flex-col gap-3">
                <label>ایمیل</label>
                <input type="email"
                    class="w-full p-[9px] mb-1 rounded-[7px] border border-[#DBDFE9] outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500"
                    name="email" placeholder="test@example.com">
            </div>
            <button class="text-center w-full bg-purple-600 hover:bg-purple-700 p-3 rounded-[10px] text-white cursor-pointer transition">ذخیره</button>
        </form>
    </div>
</div>
</body>
</html>