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
        <div class="w-full">
            <div class="flex flex-col border-none rounded-[7px]">
                <div class="block lg:flex flex-row justify-between gap-8">
                    <div class="flex flex-col xm:flex-row lg:flex-row gap-5 py-3 rounded-full">
                      
                        <div class="flex flex-col justify-end">
                            <div class="div1 text-center lg:text-start">
                                <strong class="text-gray-700">{{ $user->name }} {{ $user?->family }}</strong>
                            </div>
                            <div class="div2 hidden">
                                <ul class="flex flex-col lg:flex-row gap-3 text-[#99A1B7]">
                                    <li>
                                        <a href="">توسعه دهنده</a>
                                    </li>
                                    <li>
                                        <a href="">منطقه زندگی</a>
                                    </li>
                                    <li>
                                        <a href="">max@kt.com</a>
                                    </li>
                                </ul>
                            </div>
                      
                        </div>
                    </div>
                </div>

            </div>

            <div class="pt-3 mt-4 lg:mt-8">
                {{-- @dd($user); --}}
                <div class="shadow__profaill__karbary rounded-md lg:p-5 p-2 mb-3 lg:mb-5 bg-white">
                    <h1 class="lg:text-xl mt-5 font-bold mx-2">جزییات پروفایل </h1>

                    <div class="w-full h-px bg-gray-200 my-5 "></div>
                    <div class="flex gap-7 sm:hidden">
                        <div class="flex w-full flex-col">
                            <label class="p-2.5 text-gray-400">نام کامل</label>
                            <span class="p-2.5 text-gary-600"><strong>{{ $user->name }}
                                    {{ $user?->family }}</strong></span>
                            <span class="p-2.5 text-gary-600">فائوس</span>
                            <label class="p-2.5 text-gray-400">شماره تلفن</label>
                            <span class="p-2.5 text-gary-600">{{ $user->phoneNumber }}<mark
                                    class="mx-2 text-green-700 bg-green-300 px-1 rounded-md">تایید
                                    شده</mark></span>
                            <label class="p-2.5 text-gray-400">ایمیل</label>
                            <span class="p-2.5 text-gary-600">{{ $user->email }}</span>
                            <label class="p-2.5 text-gray-400">نقش</label>
                            <span class="p-2.5 text-gary-600">{{ $user->role[0]->title }}</span>
                            {{-- <label class="p-2.5 text-gray-400">سایت کمپانی</label>
                    <a href="#" class="p-2.5 text-gary-600">famenu.ie</a>
                    <label class="p-2.5 text-gray-400">کشور </label>
                    <span class="p-2.5 text-gary-600">ایران</span>
                    <label class="p-2.5 text-gray-400">ارتباط</label>
                    <span class="p-2.5 text-gary-600">ایمیل, تلفن</span> --}}
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-2 sm:gap-2 hidden">
                        <div class="flex w-full flex-col">
                            <label class="p-2.5 text-gray-400">نام کامل</label>
                            <label class="p-2.5 text-gray-400">شماره تلفن</label>
                            <label class="p-2.5 text-gray-400">نقش</label>
                            <label class="p-2.5 text-gray-400">ایمیل</label>
                            {{-- <label class="p-2.5 text-gray-400">کشور </label>
                    <label class="p-2.5 text-gray-400">ارتباط</label> --}}
                        </div>
                        <div class="flex w-full flex-col">
                            <span class="p-2.5 text-gary-600"><strong>{{ $user->name }}
                                    {{ $user?->family }}</strong></span>
                            {{-- <span class="p-2.5 text-gary-600">فائوس</span> --}}
                            <span class="p-2.5 text-gary-600">{{ $user->phoneNumber }}<mark
                                    class="mx-2 text-green-700 bg-green-300 px-1 rounded-md">تایید
                                    شده</mark></span>
                            <span class="p-2.5 text-gary-600">{{ $user->role[0]->title}}</span>
                            <span class="p-2.5 text-gary-600">{{ $user->email }}</span>
                            {{-- <a href="#" class="p-2.5 text-gary-600">famenu.ie</a>
                    <span class="p-2.5 text-gary-600">ایران</span>
                    <span class="p-2.5 text-gary-600">ایمیل, تلفن</span> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
</body>
</html>