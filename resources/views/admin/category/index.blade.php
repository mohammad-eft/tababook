@extends('admin.app.dashboard')
@section('title', 'طبابوک | لیست دسته‌بندی‌ها')

@section('content')
    {{-- پیام موفقیت --}}
    @if (session('message'))
        <div id="flash-message"
            class="py-3 px-5 rounded-xl shadow-lg bg-white border border-emerald-200 fixed top-6 left-6 z-50
                   flex items-center gap-3 transition-all duration-300">
            <span class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-emerald-500" viewBox="0 0 512 512">
                    <path
                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                </svg>
            </span>
            <span class="font-bold text-sm text-gray-700">{{ session('message') }}</span>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 mr-2">✕</button>
        </div>
    @endif

    <div class="w-11/12 mx-auto pb-6">
        <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- هدر --}}
            <div
                class="px-5 py-4 flex flex-row justify-between items-center gap-3 flex-wrap
                        bg-gradient-to-l from-blue-50 via-white to-white border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-blue-500" viewBox="0 0 512 512">
                            <path
                                d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-base font-bold text-gray-800">لیست دسته‌بندی‌ها</h2>
                        <p class="text-xs text-gray-400 mt-0.5">مدیریت و سازمان‌دهی دسته‌ها</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 flex-wrap">
                    <label
                        class="flex items-center gap-2 px-3 py-2 rounded-lg bg-white border border-gray-200
                                  cursor-pointer hover:border-blue-300 transition-colors">
                        <input type="checkbox" id="all" class="w-4 h-4 cursor-pointer accent-blue-600">
                        <span class="text-xs text-gray-600 select-none">انتخاب همه</span>
                    </label>
                    <span id="selected-count"
                        class="hidden text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg"></span>
                    <button type="button" id="bulk-delete-btn" disabled
                        class="flex items-center gap-1.5 bg-red-500 hover:bg-red-600
                               disabled:bg-gray-200 disabled:text-gray-400
                               px-4 py-2 rounded-lg cursor-pointer transition-colors
                               text-xs text-white font-medium shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 fill-current" viewBox="0 0 448 512">
                            <path
                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                        </svg>
                        حذف
                    </button>
                </div>
            </div>

            {{-- هدر ستون‌ها + ردیف‌ها --}}
            <div class="w-full overflow-x-auto [&::-webkit-scrollbar]:hidden">
                <div class="min-w-[700px]">
                    <div
                        class="grid grid-cols-12 px-4 py-3 bg-gray-50/70 border-b border-gray-100
                                text-[11px] font-semibold text-gray-500 uppercase tracking-wide">
                        <div class="col-span-1 text-center">#</div>
                        <div class="col-span-4">دسته‌بندی</div>
                        <div class="col-span-3 text-center">زیر دسته‌ها</div>
                        <div class="col-span-2 text-center">وضعیت</div>
                        <div class="col-span-2 text-center">عملیات</div>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @php $i = 1; @endphp
                        @forelse ($categories as $category)
                            <div
                                class="grid grid-cols-12 items-center px-4 py-3 gap-2
                                        hover:bg-blue-50/40 transition-colors group row-item">
                                <div class="col-span-1 flex items-center justify-center gap-2">
                                    <input type="checkbox" class="check w-4 h-4 cursor-pointer accent-blue-600"
                                        name="categories[]" value="{{ $category->id }}">
                                    <span class="text-xs text-gray-400 tabular-nums">{{ $i }}</span>
                                </div>

                                <div class="col-span-4 flex items-center gap-3 min-w-0">
                                    <div
                                        class="w-12 h-12 rounded-xl overflow-hidden ring-1 ring-gray-200 bg-gray-50
                                                shrink-0 flex items-center justify-center group-hover:ring-blue-300 transition-all">
                                        @if ($category->image)
                                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                                src="{{ asset('storage/' . $category->image) }}"
                                                alt="{{ $category->title }}" loading="lazy">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M0 96C0 60.7 28.7 32 64 32H196.1c19.1 0 37.4 7.6 50.9 21.1L289.9 96H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16H289.9c-10.6 0-20.7-4.2-28.3-11.7l-42.9-42.9c-3.8-3.8-8.9-5.4-14.1-5.4H64z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 truncate"
                                            title="{{ $category->title }}">
                                            {{ $category->title }}
                                        </p>
                                        <p class="text-[11px] text-gray-400 mt-0.5">ID: {{ $category->id }}</p>
                                    </div>
                                </div>

                                <div class="col-span-3 flex justify-center relative">
                                    @if ($category->children->isNotEmpty())
                                        <button type="button"
                                            class="subCats-btn inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                                   text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100
                                                   cursor-pointer transition-colors"
                                            aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 fill-current"
                                                viewBox="0 0 448 512">
                                                <path
                                                    d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                                            </svg>
                                            {{ $category->children->count() }} زیردسته
                                        </button>
                                        <ul
                                            class="subCats-list absolute w-56 top-full mt-1 bg-white right-0 max-h-0 overflow-hidden
                                                   transition-all duration-300 opacity-0 invisible
                                                   flex flex-col divide-y divide-gray-100 border border-gray-200 rounded-xl shadow-xl z-20">
                                            <div class="w-full overflow-auto max-h-60">
                                                @foreach ($category->children as $child)
                                                    <li
                                                        class="w-full py-2 px-3 text-xs text-gray-700 text-right
                                                               hover:bg-blue-50 transition-colors flex items-center gap-2">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400 shrink-0"></span>
                                                        {{ $child->title }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                    @else
                                        <span class="text-xs text-gray-300">—</span>
                                    @endif
                                </div>

                                <div class="col-span-2 flex justify-center">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                                 text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        فعال
                                    </span>
                                </div>

                                <div class="col-span-2 flex items-center justify-center gap-1.5">
                                    <button type="button" data-action="show" data-id="{{ $category->id }}" title="مشاهده"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center
                                               bg-sky-50 text-sky-500 hover:bg-sky-500 hover:text-white
                                               transition-all cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current"
                                            viewBox="0 0 576 512">
                                            <path
                                                d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                        </svg>
                                    </button>
                                    <button type="button" data-action="edit" data-id="{{ $category->id }}" title="ویرایش"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center
                                               bg-emerald-50 text-emerald-500 hover:bg-emerald-500 hover:text-white
                                               transition-all cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                        </svg>
                                    </button>
                                    <button type="button" data-action="delete" data-id="{{ $category->id }}"
                                        data-title="{{ $category->title }}" title="حذف"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center
                                               bg-red-50 text-red-500 hover:bg-red-500 hover:text-white
                                               transition-all cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @php $i++; @endphp
                        @empty
                            <div class="w-full py-20 flex flex-col items-center justify-center gap-4">
                                <div class="w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 fill-blue-300"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M0 96C0 60.7 28.7 32 64 32H196.1c19.1 0 37.4 7.6 50.9 21.1L289.9 96H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16H289.9c-10.6 0-20.7-4.2-28.3-11.7l-42.9-42.9c-3.8-3.8-8.9-5.4-14.1-5.4H64zM176 256a16 16 0 1 1 32 0v48h48a16 16 0 1 1 0 32H208v48a16 16 0 1 1 -32 0V336H128a16 16 0 1 1 0-32h48V256z" />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm font-semibold text-gray-600">هنوز دسته‌بندی‌ای ثبت نشده</p>
                                    <p class="text-xs text-gray-400 mt-1">اولین دسته‌بندی خود را بسازید</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════ پاپ‌آپ مشاهده ═══════════════ --}}
    <div id="showSinglePopup" class="fixed inset-0 z-50 invisible opacity-0 transition-all duration-300">
        <div class="size-full relative flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" data-close="show"></div>

            <div class="relative w-full max-w-3xl bg-white rounded-2xl shadow-2xl
                    max-h-[90vh] overflow-hidden flex flex-col"
                id="showSingleContent">

                {{-- هدر --}}
                <div
                    class="flex items-center justify-between gap-3 px-6 py-4
                        bg-gradient-to-l from-blue-500 via-blue-400 to-sky-400
                        text-white shrink-0">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 576 512">
                                <path
                                    d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-bold text-base">جزئیات دسته‌بندی</h3>
                            <p class="text-xs text-white/80 mt-0.5">اطلاعات کامل این دسته</p>
                        </div>
                    </div>
                    <button type="button" data-close="show"
                        class="w-9 h-9 rounded-full bg-white/15 hover:bg-white/30 flex items-center justify-center
                           transition-colors cursor-pointer"
                        aria-label="بستن">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white" viewBox="0 0 384 512">
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>

                {{-- محتوا --}}
                <div class="overflow-auto p-6 flex flex-col gap-5 bg-slate-50/40">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div
                            class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                                    hover:shadow-md hover:border-blue-200 transition-all">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-blue-500"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M0 64C0 28.7 28.7 0 64 0H384c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z" />
                                    </svg>
                                </span>
                                <h4 class="text-xs font-bold text-blue-600">عنوان</h4>
                            </div>
                            <p id="singleTitle" class="text-sm font-semibold text-gray-800"></p>
                        </div>

                        <div
                            class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                                    hover:shadow-md hover:border-emerald-200 transition-all">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-emerald-500"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32L109.2 224 214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                                    </svg>
                                </span>
                                <h4 class="text-xs font-bold text-emerald-600">دسته والد</h4>
                            </div>
                            <p id="singleParent" class="text-sm font-semibold text-gray-800"></p>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                                hover:shadow-md hover:border-violet-200 transition-all">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-7 h-7 rounded-lg bg-violet-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-violet-500"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                                </svg>
                            </span>
                            <h4 class="text-xs font-bold text-violet-600">توضیحات</h4>
                        </div>
                        <div id="singleDesc" class="text-sm text-gray-700 leading-7 max-h-32 overflow-auto"></div>
                    </div>

                    <div
                        class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                                hover:shadow-md hover:border-amber-200 transition-all">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-amber-500"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                </svg>
                            </span>
                            <h4 class="text-xs font-bold text-amber-600">زیر دسته‌ها</h4>
                        </div>
                        <div id="singleChildren"
                            class="text-sm text-gray-700 max-h-40 overflow-auto flex flex-wrap gap-2"></div>
                    </div>

                    {{-- ویژگی‌ها ✨ --}}
                    <div
                        class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                                hover:shadow-md hover:border-sky-200 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 rounded-lg bg-sky-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-sky-500"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM192 384c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z" />
                                    </svg>
                                </span>
                                <h4 class="text-xs font-bold text-sky-600">ویژگی‌ها</h4>
                            </div>
                            <span id="singleAttributesCount" class="text-[11px] text-gray-400">۰ مورد</span>
                        </div>
                        <div id="singleAttributes" class="flex flex-wrap gap-2 text-sm text-gray-700"></div>
                    </div>

                    <div
                        class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm
                                hover:shadow-md hover:border-pink-200 transition-all">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-7 h-7 rounded-lg bg-pink-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-pink-500"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                </svg>
                            </span>
                            <h4 class="text-xs font-bold text-pink-600">تصویر</h4>
                        </div>
                        <div id="singleImg" class="flex justify-center"></div>
                    </div>
                </div>

                {{-- فوتر --}}
                <div class="px-6 py-3 bg-white border-t border-gray-100 flex justify-end shrink-0">
                    <button type="button" data-close="show"
                        class="px-6 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700
                           text-sm font-medium transition-colors cursor-pointer">بستن</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════ پاپ‌آپ ویرایش ═══════════════ --}}
    <div id="editFormPopup" class="fixed inset-0 z-50 invisible opacity-0 transition-all duration-300">
        <div class="size-full relative flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" data-close="edit"></div>

            <div
                class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl
                    max-h-[90vh] overflow-hidden flex flex-col">

                {{-- هدر --}}
                <div
                    class="flex items-center justify-between gap-3 px-6 py-4
                        bg-gradient-to-l from-emerald-500 via-emerald-400 to-teal-400
                        text-white shrink-0">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 512 512">
                                <path
                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-bold text-base">ویرایش دسته‌بندی</h3>
                            <p class="text-xs text-white/80 mt-0.5">اطلاعات و ویژگی‌ها را به‌روزرسانی کنید</p>
                        </div>
                    </div>
                    <button type="button" data-close="edit"
                        class="w-9 h-9 rounded-full bg-white/15 hover:bg-white/30 flex items-center justify-center
                           transition-colors cursor-pointer"
                        aria-label="بستن">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white" viewBox="0 0 384 512">
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>

                {{-- محتوا --}}
                <div class="overflow-auto p-6 bg-slate-50/40">
                    <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data"
                        class="flex flex-col gap-4" id="editForm">
                        @csrf
                        <input type="hidden" name="cat_id" id="cat_id">

                        {{-- عنوان --}}
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                            <label for="catTitle" class="flex items-center gap-2 mb-3">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-blue-500"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M0 64C0 28.7 28.7 0 64 0H384c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z" />
                                    </svg>
                                </span>
                                <span class="text-xs font-bold text-gray-700">عنوان دسته‌بندی <span
                                        class="text-rose-500">*</span></span>
                            </label>
                            <input type="text" name="title" id="catTitle" placeholder="نام دسته را وارد کنید"
                                required
                                class="w-full outline-none px-4 py-3 bg-gray-50 rounded-xl border border-transparent
                                       text-sm text-gray-800 placeholder:text-gray-400
                                       focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100
                                       transition-all duration-150">
                        </div>

                        {{-- توضیحات --}}
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                            <label for="cat_desc" class="flex items-center gap-2 mb-3">
                                <span class="w-7 h-7 rounded-lg bg-violet-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-violet-500"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                                    </svg>
                                </span>
                                <span class="text-xs font-bold text-gray-700">توضیحات</span>
                            </label>
                            <textarea name="description" id="cat_desc" placeholder="توضیحات دسته را وارد کنید" rows="3"
                                class="w-full outline-none px-4 py-3 bg-gray-50 rounded-xl border border-transparent
                                       text-sm text-gray-800 placeholder:text-gray-400 resize-none
                                       focus:bg-white focus:border-violet-400 focus:ring-2 focus:ring-violet-100
                                       transition-all duration-150"></textarea>
                        </div>

                        {{-- والد + تصویر --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                                <label for="parent_id" class="flex items-center gap-2 mb-3">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-emerald-500"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32L109.2 224 214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                                        </svg>
                                    </span>
                                    <span class="text-xs font-bold text-gray-700">دسته والد</span>
                                </label>
                                <select name="parent_id" id="parent_id"
                                    class="w-full bg-gray-50 px-4 py-3 rounded-xl border border-transparent
                                           text-sm text-gray-800
                                           focus:bg-white focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100
                                           outline-none transition-all duration-150">
                                    <option value="0">بدون والد</option>
                                </select>
                            </div>

                            <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                                <label for="image" class="flex items-center gap-2 mb-3">
                                    <span class="w-7 h-7 rounded-lg bg-pink-50 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-pink-500"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                        </svg>
                                    </span>
                                    <span class="text-xs font-bold text-gray-700">تصویر دسته‌بندی</span>
                                </label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="w-full text-xs text-gray-600
                                           file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0
                                           file:bg-pink-50 file:text-pink-600 file:text-xs file:font-medium
                                           file:cursor-pointer hover:file:bg-pink-100 file:transition-colors
                                           outline-none bg-gray-50 rounded-xl py-2 px-2 cursor-pointer">
                            </div>
                        </div>

                        {{-- پیش‌نمایش تصویر فعلی --}}
                        <div id="cat_img" class="relative hidden"></div>

                        {{-- ═══ ویژگی‌ها ✨ ═══ --}}
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 rounded-lg bg-sky-50 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-sky-500"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM192 384c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z" />
                                        </svg>
                                    </span>
                                    <span class="text-xs font-bold text-gray-700">ویژگی‌ها</span>
                                </div>
                                <span id="edit-attributes-count" class="text-[11px] text-gray-400">۰ مورد</span>
                            </div>

                            <div id="edit-attributes-list" class="flex flex-col gap-2"></div>

                            <button type="button" id="edit-add-attribute-btn"
                                class="mt-3 w-full flex items-center justify-center gap-2 py-2.5 rounded-lg
                                       border-2 border-dashed border-sky-200 hover:border-sky-400 hover:bg-sky-50/50
                                       text-xs font-medium text-sky-600 transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 fill-current"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M248 72c0-13.3-10.7-24-24-24s-24 10.7-24 24V232H40c-13.3 0-24 10.7-24 24s10.7 24 24 24H200V440c0 13.3 10.7 24 24 24s24-10.7 24-24V280H408c13.3 0 24-10.7 24-24s-10.7-24-24-24H248V72z" />
                                </svg>
                                افزودن ویژگی
                            </button>

                            {{-- تمپلیت ردیف ویژگی: هر ردیف id و key می‌فرستد --}}
                            <template id="edit-attribute-row-template">
                                <div class="edit-attribute-row flex items-center gap-2">
                                    <input type="hidden" name="attributes[__i__][id]" class="attr-id">
                                    <input type="text" name="attributes[__i__][key]" placeholder="مثلاً: جنس، سایز..."
                                        class="attr-key flex-1 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 text-sm
                                               focus:outline-none focus:ring-2 focus:ring-sky-200 focus:border-sky-400 focus:bg-white
                                               transition-all" />
                                    <button type="button"
                                        class="remove-edit-attribute-btn w-9 h-9 rounded-lg flex items-center justify-center
                                               bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </form>
                </div>

                {{-- فوتر --}}
                <div class="px-6 py-3 bg-white border-t border-gray-100 flex justify-end gap-2 shrink-0">
                    <button type="button" data-close="edit"
                        class="px-5 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700
                           text-sm font-medium transition-colors cursor-pointer">انصراف</button>
                    <button type="submit" form="editForm"
                        class="px-6 py-2 rounded-xl bg-gradient-to-l from-emerald-500 to-teal-500
                           hover:from-emerald-600 hover:to-teal-600 text-white text-sm font-medium
                           shadow-md hover:shadow-lg transition-all cursor-pointer
                           flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-white" viewBox="0 0 448 512">
                            <path
                                d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                        </svg>
                        ذخیره تغییرات
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════ پاپ‌آپ تأیید حذف ═══════════════ --}}
    <div id="confirmDeletePopup" class="fixed inset-0 z-50 invisible opacity-0 transition-all duration-300">
        <div class="size-full relative flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" data-close="delete"></div>
            <div class="w-full md:w-1/2 xl:w-1/3 border border-gray-200 rounded-2xl p-6 bg-white shadow-2xl z-1">
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 fill-red-500" viewBox="0 0 512 512">
                            <path
                                d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <p class="text-base font-semibold text-gray-800">حذف دسته‌بندی</p>
                    <p class="text-sm text-gray-600 leading-7">آیا از حذف
                        <span id="confirmDeleteCatName" class="font-bold text-gray-900"></span>
                        اطمینان دارید؟
                    </p>
                    <p class="text-xs text-gray-400">این عملیات قابل بازگشت نیست.</p>
                    <div class="flex items-center justify-center gap-3 mt-2 w-full">
                        <a id="yes" href="#"
                            class="flex-1 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium
                                   rounded-xl text-center transition-colors">بله،
                            حذف کن</a>
                        <button type="button" data-close="delete"
                            class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium
                                   rounded-xl transition-colors">خیر</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════ JavaScript ═══════════════ --}}
    <script>
        (function() {
            'use strict';

            const $ = (s, el = document) => el.querySelector(s);
            const $$ = (s, el = document) => [...el.querySelectorAll(s)];
            const csrfToken = "{{ csrf_token() }}";
            const storageUrl = "{{ asset('storage') }}/";

            /* Helpers */
            function toFa(n) {
                return n.toString().replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹' [d]);
            }

            function escapeHtml(str) {
                const div = document.createElement('div');
                div.textContent = String(str);
                return div.innerHTML;
            }

            /* Flash */
            const flash = $('#flash-message');
            if (flash) setTimeout(() => {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 300);
            }, 4000);

            /* Popup helpers */
            function openPopup(id) {
                const el = document.getElementById(id);
                if (!el) return;
                el.classList.remove('invisible', 'opacity-0');
            }

            function closePopup(id) {
                const el = document.getElementById(id);
                if (!el) return;
                el.classList.add('invisible', 'opacity-0');
            }

            $$('[data-close]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const key = btn.dataset.close;
                    if (key === 'show') closePopup('showSinglePopup');
                    if (key === 'edit') closePopup('editFormPopup');
                    if (key === 'delete') closePopup('confirmDeletePopup');
                });
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    closePopup('showSinglePopup');
                    closePopup('editFormPopup');
                    closePopup('confirmDeletePopup');
                }
            });

            /* Selection / bulk */
            const allCheck = $('#all');
            const bulkDeleteBtn = $('#bulk-delete-btn');
            const selectedCount = $('#selected-count');
            const checks = () => $$('.check');

            function refreshSelection() {
                const total = checks().length;
                const selected = checks().filter(c => c.checked).length;
                if (selected > 0) {
                    selectedCount.textContent = `${toFa(selected)} انتخاب شده`;
                    selectedCount.classList.remove('hidden');
                    bulkDeleteBtn.disabled = false;
                } else {
                    selectedCount.classList.add('hidden');
                    bulkDeleteBtn.disabled = true;
                }
                allCheck.checked = selected === total && total > 0;
                allCheck.indeterminate = selected > 0 && selected < total;
            }
            allCheck.addEventListener('change', () => {
                checks().forEach(c => c.checked = allCheck.checked);
                refreshSelection();
            });
            document.addEventListener('change', e => {
                if (e.target.classList.contains('check')) refreshSelection();
            });
            bulkDeleteBtn.addEventListener('click', () => {
                const ids = checks().filter(c => c.checked).map(c => c.value);
                if (!ids.length) return;
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('category.bulkDelete') }}";
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="DELETE">
                    ${ids.map(id => `<input type="hidden" name="ids[]" value="${id}">`).join('')}
                `;
                document.body.appendChild(form);
                form.submit();
            });

            /* Sub-cats dropdown */
            document.addEventListener('click', e => {
                const btn = e.target.closest('.subCats-btn');
                if (btn) {
                    const list = btn.parentElement.querySelector('.subCats-list');
                    const isOpen = list.classList.contains('opacity-100');
                    $$('.subCats-list').forEach(l => {
                        l.classList.remove('opacity-100', 'visible');
                        l.classList.add('opacity-0', 'invisible', 'max-h-0');
                    });
                    $$('.subCats-btn').forEach(b => b.setAttribute('aria-expanded', 'false'));
                    if (!isOpen) {
                        list.classList.remove('opacity-0', 'invisible', 'max-h-0');
                        list.classList.add('opacity-100', 'visible');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                } else if (!e.target.closest('.subCats-list')) {
                    $$('.subCats-list').forEach(l => {
                        l.classList.remove('opacity-100', 'visible');
                        l.classList.add('opacity-0', 'invisible', 'max-h-0');
                    });
                }
            });

            /* ═══ ویژگی‌ها: مدیریت ردیف‌ها در پاپ‌آپ ویرایش ═══ */
            const editAttrList = $('#edit-attributes-list');
            const editAttrCount = $('#edit-attributes-count');
            const editAttrTmpl = $('#edit-attribute-row-template');
            let editAttrIndex = 0;

            function updateEditAttrCount() {
                const n = editAttrList.querySelectorAll('.edit-attribute-row').length;
                editAttrCount.textContent = n === 0 ? '۰ مورد' : toFa(n) + ' مورد';
            }

            function addEditAttributeRow(attr = {}) {
                const html = editAttrTmpl.innerHTML.replaceAll('__i__', editAttrIndex++);
                const wrap = document.createElement('div');
                wrap.innerHTML = html.trim();
                const row = wrap.firstElementChild;

                row.querySelector('.attr-id').value = attr.id ?? '';
                const input = row.querySelector('.attr-key');
                input.value = attr.key ?? '';

                row.querySelector('.remove-edit-attribute-btn').addEventListener('click', () => {
                    row.style.transition = 'opacity .15s, transform .15s';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-8px)';
                    setTimeout(() => {
                        row.remove();
                        updateEditAttrCount();
                    }, 150);
                });

                input.addEventListener('keydown', e => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        addEditAttributeRow().focus();
                    }
                });

                editAttrList.appendChild(row);
                updateEditAttrCount();
                return input;
            }

            $('#edit-add-attribute-btn').addEventListener('click', () => {
                addEditAttributeRow().focus();
            });

            /* ═══ Actions ═══ */
            document.addEventListener('click', e => {
                const btn = e.target.closest('[data-action]');
                if (!btn) return;
                const {
                    action,
                    id,
                    title
                } = btn.dataset;
                if (action === 'show') showCategory(id);
                if (action === 'edit') editCategory(id);
                if (action === 'delete') openDeleteConfirm(id, title);
            });

            /* ═══ پاپ‌آپ مشاهده ═══ */
            function showCategory(id) {
                fetch("{{ route('category.adminShow') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            id
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        document.getElementById('singleTitle').textContent = data.title ?? '—';
                        document.getElementById('singleDesc').textContent = data.description ?? '—';
                        document.getElementById('singleParent').textContent = data.parent?.title ?? 'بدون والد';

                        /* زیر دسته‌ها */
                        const childrenBox = document.getElementById('singleChildren');
                        if (data.subCats && String(data.subCats).trim() !== '') {
                            childrenBox.innerHTML = data.subCats;
                        } else {
                            childrenBox.innerHTML =
                                '<span class="text-xs text-gray-400 italic">بدون زیردسته</span>';
                        }

                        /* ویژگی‌ها */
                        const attrBox = document.getElementById('singleAttributes');
                        const attrCount = document.getElementById('singleAttributesCount');
                        attrBox.innerHTML = '';

                        const attrs = Array.isArray(data.attributes) ? data.attributes : [];

                        if (attrs.length > 0) {
                            attrs.forEach(name => {
                                const chip = document.createElement('span');
                                chip.className =
                                    'inline-flex items-center gap-1.5 px-3 py-1 rounded-full ' +
                                    'text-xs font-medium bg-sky-50 text-sky-700 border border-sky-100 ' +
                                    'hover:bg-sky-100 transition-colors';
                                chip.innerHTML =
                                    '<span class="w-1.5 h-1.5 rounded-full bg-sky-400"></span>' +
                                    escapeHtml(name);
                                attrBox.appendChild(chip);
                            });
                            attrCount.textContent = toFa(attrs.length) + ' مورد';
                        } else {
                            attrBox.innerHTML = '<span class="text-xs text-gray-400 italic">بدون ویژگی</span>';
                            attrCount.textContent = '۰ مورد';
                        }

                        /* تصویر */
                        const imgBox = document.getElementById('singleImg');
                        imgBox.innerHTML = '';
                        if (data.image) {
                            const img = document.createElement('img');
                            img.className = 'max-h-64 max-w-full object-contain rounded-xl ring-1 ring-gray-200';
                            img.src = data.image;
                            img.alt = data.title ?? '';
                            imgBox.appendChild(img);
                        } else {
                            imgBox.innerHTML = '<span class="text-xs text-gray-400 italic">بدون تصویر</span>';
                        }

                        openPopup('showSinglePopup');
                    })
                    .catch(err => {
                        console.error(err);
                        alert('خطا در دریافت اطلاعات');
                    });
            }

            /* ═══ پاپ‌آپ ویرایش ═══ */
            function editCategory(id) {
                fetch("{{ route('category.edit') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            id
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        const cat = data.cat;
                        $('#catTitle').value = cat.title ?? '';
                        $('#cat_desc').value = cat.description ?? '';
                        $('#cat_id').value = cat.id;

                        /* اگر قبلاً تصویری برای حذف علامت خورده بود، پاک شود */
                        $$('#editForm input[name="removedImg"]').forEach(i => i.remove());

                        /* پیش‌نمایش تصویر فعلی */
                        const imgBox = $('#cat_img');
                        imgBox.innerHTML = '';
                        if (cat.image) {
                            imgBox.className = 'relative bg-white rounded-xl p-4 border border-gray-100 shadow-sm';

                            const wrapper = document.createElement('div');
                            wrapper.className = 'flex items-center gap-4';

                            const img = document.createElement('img');
                            img.className = 'w-20 h-20 object-cover rounded-xl ring-1 ring-gray-200';
                            img.src = storageUrl + cat.image;
                            wrapper.appendChild(img);

                            const info = document.createElement('div');
                            info.className = 'flex-1';
                            info.innerHTML = `
                                <p class="text-xs font-medium text-gray-700">تصویر فعلی</p>
                                <p class="text-[11px] text-gray-400 mt-1">برای تغییر، فایل جدید انتخاب کنید</p>
                            `;
                            wrapper.appendChild(info);

                            const delBtn = document.createElement('button');
                            delBtn.type = 'button';
                            delBtn.className =
                                'w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors cursor-pointer';
                            delBtn.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current" viewBox="0 0 448 512">
                                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                </svg>
                            `;
                            delBtn.addEventListener('click', () => markImageForRemoval(imgBox, cat.image));
                            wrapper.appendChild(delBtn);

                            imgBox.appendChild(wrapper);
                        } else {
                            imgBox.className = 'relative hidden';
                        }

                        /* والد */
                        const select = $('#parent_id');
                        select.innerHTML = '<option value="0">بدون والد</option>';
                        (data.cats || []).forEach(c => {
                            if (c.id === cat.id) return;
                            const opt = document.createElement('option');
                            opt.value = c.id;
                            opt.textContent = c.title;
                            if (c.id === cat.parent_id) opt.selected = true;
                            select.appendChild(opt);
                        });
                        if (!cat.parent_id) select.value = '0';

                        /* ویژگی‌ها: ردیف‌ها را از داده پر کن (هر آیتم {id, key}) */
                        editAttrList.innerHTML = '';
                        editAttrIndex = 0;
                        const attrs = Array.isArray(data.attributes) ? data.attributes : [];
                        attrs.forEach(attr => addEditAttributeRow(attr));
                        updateEditAttrCount();

                        openPopup('editFormPopup');
                    })
                    .catch(err => {
                        console.error(err);
                        alert('خطا در دریافت اطلاعات');
                    });
            }

            function markImageForRemoval(container, relativePath) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'removedImg';
                input.value = relativePath;
                $('#editForm').appendChild(input);
                container.innerHTML =
                    '<span class="text-xs text-gray-400 italic px-4 py-3">تصویر حذف شد (پس از ذخیره اعمال می‌شود)</span>';
            }

            function openDeleteConfirm(id, title) {
                $('#confirmDeleteCatName').textContent = title ?? '';
                $('#yes').setAttribute('href', `{{ url('category/delete') }}/${id}`);
                openPopup('confirmDeletePopup');
            }
        })();
    </script>
@endsection
