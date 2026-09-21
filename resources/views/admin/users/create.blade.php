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

    <div class="pt-3 my-4 lg:my-8">

        <form action="{{ route('user.store_user') }}" method="post"
            class="shadow__profaill__list_products rounded-lg pb-4 bg-white" enctype="multipart/form-data">
            @csrf


            <div class="p-5 px-6">
                <div class="w-full">
                    <div class="flex flex-col gap-3">

                        <div class="flex flex-col lg:flex-row">
                            <div class="w-full lg:w-2/12 text-sm py-4">نام کامل</div>
                            <div class="w-full lg:w-10/12 text-sm flex flex-col lg:flex-row gap-4">
                                <input
                                    class="w-full lg:w-1/2 p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] "
                                    type="text" name="name" placeholder="نام" required>
                                <input
                                    class="w-full lg:w-1/2 p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] "
                                    type="text" name="family" placeholder="نام خانوادگی" required>
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row">
                            <div class="w-full lg:w-2/12 text-sm py-4">شماره تلفن</div>
                            <div class="w-full lg:w-10/12 text-sm">
                                <input
                                    class="w-full lg:w-1/2 p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9]"
                                    type="number" name="phoneNumber" placeholder="شماره تلفن" required>
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row">
                            <div class="w-full lg:w-2/12 text-sm py-4">ایمیل</div>
                            <div class="w-full lg:w-10/12 text-sm">
                                <input
                                    class="w-full p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9]"
                                    type="email" name="email" placeholder="ایمیل">
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row">
                            <div class="w-full lg:w-2/12 text-sm py-4">رمز عبور</div>
                            <div class="w-full lg:w-10/12 text-sm">
                                <input
                                    class="w-full p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9]"
                                    type="password" name="password" placeholder="رمز عبور" required>
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row">
                            <div class="w-full lg:w-2/12 text-sm py-4">نقش</div>
                            <div class="w-full lg:w-10/12 text-sm">
                                <select
                                    class="w-full p-4 rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9]"
                                    name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->title }}
                                        </option>
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

</body>

</html>
