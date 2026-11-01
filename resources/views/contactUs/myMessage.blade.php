
@extends('app.document')
@section('title', 'طبابوک | تیکت های من')
@section('content')
<div class="w-11/12 lg:w-3/4 mx-auto flex flex-col pb-4">
    <div class="bg-white rounded-lg shadow-sm">

        {{-- هدر صفحه --}}
        <div class="flex items-center justify-between gap-3 p-4 border-b border-gray-100">
            <h2 class="text-base sm:text-lg font-bold text-red-600">لیست تیکت‌های من</h2>
            <a href="{{ route('contactUs.create') }}"
               class="text-sm text-sky-700 hover:text-sky-800 hover:underline">
                ← برگشت
            </a>
        </div>

        @if(Auth::user()->contactUs->isEmpty())
            {{-- حالت خالی --}}
            <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                <p class="text-gray-500 text-sm mb-3">هنوز هیچ تیکتی ثبت نکرده‌اید.</p>
                <a href="{{ route('contactUs.create') }}"
                   class="bg-sky-500 hover:bg-sky-600 text-white text-sm px-4 py-2 rounded-md">
                    ثبت تیکت جدید
                </a>
            </div>
        @else
            <form action="{{ route('contactUs.deleteAll') }}" method="post" id="bulkForm">
                @csrf
               

                {{-- نوار ابزار --}}
                <div class="flex items-center justify-between gap-3 px-4 py-3 border-b border-gray-100">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" id="all" onchange="checkAll()"
                               class="size-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                        <span class="text-xs sm:text-sm text-gray-700">انتخاب همه</span>
                    </label>

                    <button type="submit"
                            onclick="return confirm('آیا از حذف تیکت‌های انتخاب‌شده مطمئن هستید؟')"
                            class="flex items-center gap-1.5 bg-red-500 hover:bg-red-600 active:bg-red-700
                                   text-white text-xs sm:text-sm px-3 py-1.5 rounded-md transition"
                            title="حذف انتخاب‌شده‌ها">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512">
                            <path fill="currentColor" d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80z"/>
                        </svg>
                        <span class="hidden sm:inline">حذف</span>
                    </button>
                </div>

                {{-- نمای دسکتاپ: جدول --}}
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-sm text-center">
                        <thead class="bg-gray-100 text-gray-600 text-xs">
                            <tr>
                                <th class="w-10 p-3"></th>
                                <th class="p-3 w-16">ردیف</th>
                                <th class="p-3">عنوان</th>
                                <th class="p-3">توضیحات</th>
                                <th class="p-3 w-32">شماره تماس</th>
                                <th class="p-3 w-36">عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach (Auth::user()->contactUs as $i => $contactUs)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-3">
                                        <input type="checkbox" class="check size-4 rounded border-gray-300
                                               text-sky-600 focus:ring-sky-500"
                                               name="allContactUs[]" value="{{ $contactUs->id }}">
                                    </td>
                                    <td class="p-3 text-gray-700">{{ $i + 1 }}</td>
                                    <td class="p-3 text-gray-900 font-medium">{{ $contactUs->title }}</td>
                                    <td class="p-3 text-gray-700 max-w-xs">
                                        <span class="line-clamp-2 break-words">{{ $contactUs->description }}</span>
                                    </td>
                                    <td class="p-3 text-gray-700 whitespace-nowrap" dir="ltr">
                                        {{ $contactUs->phoneNumber }}
                                    </td>
                                    <td class="p-3">
                                        <div class="flex items-center justify-center gap-1.5">
                                            @include('contactUs._row_actions', ['contactUs' => $contactUs])
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- نمای موبایل/تبلت: کارت --}}
                <div class="lg:hidden divide-y divide-gray-100">
                    @foreach (Auth::user()->contactUs as $i => $contactUs)
                        <div class="p-4 flex gap-3">
                            <input type="checkbox" class="check mt-1 size-4 shrink-0 rounded border-gray-300
                                   text-sky-600 focus:ring-sky-500"
                                   name="allContactUs[]" value="{{ $contactUs->id }}">

                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2 mb-1">
                                    <h3 class="font-medium text-gray-900 text-sm truncate">
                                        {{ $contactUs->title }}
                                    </h3>
                                    <span class="text-xs text-gray-400 shrink-0">#{{ $i + 1 }}</span>
                                </div>

                                <p class="text-xs text-gray-600 break-words mb-2">
                                    {{ $contactUs->description }}
                                </p>

                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs text-gray-500" dir="ltr">
                                        📞 {{ $contactUs->phoneNumber }}
                                    </span>
                                    <div class="flex items-center gap-1.5">
                                        @include('contactUs._row_actions', ['contactUs' => $contactUs])
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        @endif
    </div>
</div>

{{-- partial مشترک دکمه‌های عملیات --}}
@push('scripts')
<script>
function checkAll() {
    const master = document.getElementById('all');
    document.querySelectorAll('.check').forEach(cb => cb.checked = master.checked);
}
</script>
@endpush
@endsection