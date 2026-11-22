@extends('app.document')

@section('title', 'طبابوک | تیکت‌های من')

@section('content')

<div class="min-h-[75vh] bg-[#fbf6ef] py-8 lg:py-12" dir="rtl">
    <div class="w-11/12 2xl:w-10/12 mx-auto">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5 mb-8">

            <div>

                <h1 class="text-xl md:text-2xl font-black text-[#4c6b62] mb-2">
                    تیکت‌های من
                </h1>

            </div>

            <a href="{{ route('contactUs.create') }}"
               class="inline-flex items-center justify-center gap-2 bg-[#66827a] hover:bg-[#4c6b62] text-white px-5 py-3 rounded-xl text-sm font-bold transition shadow-lg shadow-[#66827a]/15">
                <i class="fa-solid fa-plus"></i>
                ثبت تیکت جدید
            </a>

        </div>

        {{-- Main Container --}}
        <div class="bg-white rounded-3xl border border-[#D5DFE4] shadow-sm overflow-hidden">

            {{-- Card Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-5 md:p-6 border-b border-[#D5DFE4]">

                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-[#bbdfca]/40 text-[#66827a] flex items-center justify-center">
                        <i class="fa-regular fa-folder-open text-xl"></i>
                    </div>

                    <div>
                        <h2 class="font-black text-[#4c6b62] text-base">
                            لیست درخواست‌ها
                        </h2>
                    </div>
                </div>

                <a href="{{ route('contactUs.create') }}"
                   class="text-xs font-bold text-[#66827a] hover:text-[#4c6b62] transition sm:hidden">
                    ارسال درخواست جدید
                    <i class="fa-solid fa-arrow-left mr-1"></i>
                </a>

            </div>

            @if(Auth::user()->contactUs->isEmpty())

                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-20 px-5 text-center">

                    <div class="relative mb-6">
                        <div class="w-24 h-24 rounded-[2rem] bg-[#bbdfca]/30 flex items-center justify-center">
                            <i class="fa-regular fa-comments text-4xl text-[#8faf9d]"></i>
                        </div>

                        <div class="absolute -bottom-2 -left-2 w-9 h-9 rounded-xl bg-[#ea9ca1] text-white flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </div>
                    </div>

                    <h3 class="text-lg font-black text-[#4c6b62] mb-2">
                        هنوز تیکتی ثبت نکرده‌ای!
                    </h3>

                    <p class="text-sm text-[#8c908e] leading-7 max-w-sm mb-6">
                        اگر سؤال یا مشکلی داری، می‌تونی اولین درخواستت رو برای تیم پشتیبانی طبابوک ارسال کنی.
                    </p>

                    <a href="{{ route('contactUs.create') }}"
                       class="inline-flex items-center gap-2 bg-[#66827a] hover:bg-[#4c6b62] text-white px-6 py-3 rounded-xl text-sm font-bold transition shadow-md shadow-[#66827a]/15">
                        <i class="fa-solid fa-plus"></i>
                        ثبت اولین تیکت
                    </a>

                </div>

            @else

                <form action="{{ route('contactUs.deleteAll') }}" method="post" id="bulkForm">
                    @csrf

                    {{-- Toolbar --}}
                    <div class="flex flex-wrap items-center justify-between gap-3 p-4 md:px-6 bg-[#fbf6ef]/60 border-b border-[#D5DFE4]">

                        <label class="flex items-center gap-3 cursor-pointer select-none group">
                            <input
                                type="checkbox"
                                id="all"
                                onchange="checkAll()"
                                class="size-4 rounded border-[#D5DFE4] text-[#66827a] focus:ring-[#8faf9d] cursor-pointer"
                            >

                            <span class="text-xs sm:text-sm font-bold text-[#4c6b62] group-hover:text-[#66827a] transition">
                                انتخاب همه تیکت‌ها
                            </span>
                        </label>

                        <button
                            type="submit"
                            onclick="return confirm('آیا از حذف تیکت‌های انتخاب‌شده مطمئن هستید؟')"
                            class="inline-flex items-center gap-2 bg-[#ea9ca1]/15 hover:bg-[#ea9ca1] text-[#c96e77] hover:text-white px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition"
                            title="حذف تیکت‌های انتخاب‌شده"
                        >
                            <i class="fa-regular fa-trash-can"></i>
                            حذف انتخاب‌شده‌ها
                        </button>

                    </div>

                    {{-- Desktop Table --}}
                    <div class="hidden lg:block overflow-x-auto">

                        <table class="w-full text-sm text-center">

                            <thead class="bg-[#fbf6ef] text-[#8c908e] text-xs">
                                <tr>
                                    <th class="w-12 p-4"></th>
                                    <th class="p-4 w-16 font-bold">ردیف</th>
                                    <th class="p-4 font-bold text-right">عنوان تیکت</th>
                                    <th class="p-4 font-bold text-right">توضیحات</th>
                                    <th class="p-4 w-40 font-bold">شماره تماس</th>
                                    <th class="p-4 w-36 font-bold">عملیات</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-[#D5DFE4]">

                                @foreach (Auth::user()->contactUs as $i => $contactUs)

                                    <tr class="hover:bg-[#fbf6ef]/70 transition duration-200 group">

                                        <td class="p-4">
                                            <input
                                                type="checkbox"
                                                class="check size-4 rounded border-[#D5DFE4] text-[#66827a] focus:ring-[#8faf9d] cursor-pointer"
                                                name="allContactUs[]"
                                                value="{{ $contactUs->id }}"
                                            >
                                        </td>

                                        <td class="p-4">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#bbdfca]/30 text-[#66827a] text-xs font-bold">
                                                {{ $i + 1 }}
                                            </span>
                                        </td>

                                        <td class="p-4 text-right">
                                            <span class="font-bold text-[#4c6b62]">
                                                {{ $contactUs->title }}
                                            </span>
                                        </td>

                                        <td class="p-4 text-right max-w-sm">
                                            <p class="text-xs text-[#8c908e] leading-6 line-clamp-2 break-words">
                                                {{ $contactUs->description }}
                                            </p>
                                        </td>

                                        <td class="p-4 text-[#66827a] text-xs font-semibold whitespace-nowrap" dir="ltr">
                                            {{ $contactUs->phoneNumber }}
                                        </td>

                                        <td class="p-4">
                                            <div class="flex items-center justify-center gap-2">
                                                @include('contactUs._row_actions', ['contactUs' => $contactUs])
                                            </div>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div>

                    {{-- Mobile / Tablet Cards --}}
                    <div class="lg:hidden divide-y divide-[#D5DFE4]">

                        @foreach (Auth::user()->contactUs as $i => $contactUs)

                            <div class="p-4 sm:p-5 hover:bg-[#fbf6ef]/50 transition">

                                <div class="flex items-start gap-3">

                                    <input
                                        type="checkbox"
                                        class="check mt-1 size-4 shrink-0 rounded border-[#D5DFE4] text-[#66827a] focus:ring-[#8faf9d] cursor-pointer"
                                        name="allContactUs[]"
                                        value="{{ $contactUs->id }}"
                                    >

                                    <div class="flex-1 min-w-0">

                                        <div class="flex items-start justify-between gap-3 mb-3">

                                            <div class="min-w-0">
                                                <span class="text-[10px] text-[#8c908e] mb-1 block">
                                                    تیکت شماره {{ $i + 1 }}
                                                </span>

                                                <h3 class="font-black text-sm text-[#4c6b62] break-words">
                                                    {{ $contactUs->title }}
                                                </h3>
                                            </div>

                                            <div class="w-9 h-9 shrink-0 rounded-xl bg-[#bbdfca]/30 text-[#66827a] flex items-center justify-center">
                                                <i class="fa-regular fa-message"></i>
                                            </div>

                                        </div>

                                        <div class="bg-[#fbf6ef] rounded-xl p-3 mb-3">
                                            <p class="text-xs text-[#8c908e] leading-7 break-words">
                                                {{ $contactUs->description }}
                                            </p>
                                        </div>

                                        <div class="flex flex-wrap items-center justify-between gap-3">

                                            <span class="inline-flex items-center gap-2 text-xs text-[#66827a] font-semibold" dir="ltr">
                                                <i class="fa-solid fa-phone text-[#8faf9d]"></i>
                                                {{ $contactUs->phoneNumber }}
                                            </span>

                                            <div class="flex items-center gap-2">
                                                @include('contactUs._row_actions', ['contactUs' => $contactUs])
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </form>

            @endif

        </div>

        {{-- Footer Note --}}
        @if(Auth::user()->contactUs->isNotEmpty())
            <div class="flex items-center gap-2 mt-5 px-2 text-xs text-[#8c908e]">
                <i class="fa-solid fa-circle-info text-[#8faf9d]"></i>
                برای حذف چند تیکت، ابتدا موارد موردنظر را انتخاب کن.
            </div>
        @endif

    </div>
</div>

{{-- Bulk Selection --}}
@push('scripts')
<script>
    function checkAll() {
        const master = document.getElementById('all');

        document.querySelectorAll('.check').forEach(cb => {
            cb.checked = master.checked;
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const master = document.getElementById('all');
        const checkboxes = document.querySelectorAll('.check');

        if (!master) return;

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                const checkedCount = document.querySelectorAll('.check:checked').length;

                master.checked = checkedCount === checkboxes.length;
                master.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
            });
        });
    });
</script>
@endpush
@endsection