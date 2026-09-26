@extends('app.document')
@section('title', 'جست و جو')
@section('content')
    <script src="{{ asset('js/filters.js') }}"></script>
    <main class="max-w-[1280px] mx-auto my-4 md:my-6 px-3 md:px-5">
        <div class="text-[#71717a] text-xs mb-[18px]">خانه / <b class="text-[#333]">جستجو</b></div>

{{--        <div class="flex items-end justify-between gap-2.5 mb-[18px]">--}}
{{--            <div>--}}
{{--                <h1 id="title" class="m-0 text-[18px] md:text-[22px]">نتایج جستجو برای "{{ $title }}"</h1>--}}
{{--                <div id="resultCount" class="text-[#71717a] text-[13px]"></div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="grid grid-cols-1 md:grid-cols-[250px_1fr] gap-[18px]">
            <div class="fixed w-full h-dvh bg-black/50 z-99 top-0 right-0 md:hidden invisible opacity-0 transition-all duration-300" id="filterBg"></div>
            <aside class="invisible opacity-0 transition-all duration-300 md:visible md:opacity-100 fixed top-1/2 w-10/12 -translate-y-1/2 right-1/2 translate-x-1/2 md:translate-x-0 md:translate-y-0 z-999 md:z-0 md:static md:block bg-white border border-[#e4e4e7] rounded-xl h-[500px] overflow-y-auto md:h-max md:overflow-hidden" id="filterSection">
                <div class="flex justify-between p-[18px] border-b border-[#e4e4e7] font-bold">
                    <span>فیلترها</span>
                    <button id="resetFilters" class="text-[#ef394e] border-0 bg-transparent text-xs cursor-pointer">حذف
                        فیلترها</button>
                </div>

                <section class="p-[18px] border-b border-[#e4e4e7]">
                    <div class="font-semibold text-sm mb-[15px]">دسته‌بندی</div>
                    @foreach ($categories as $category)
                        <label class="flex items-center gap-2 my-3 text-[13px] text-[#52525b]"><input
                                    class="accent-[#ef394e] w-[17px] h-[17px] categories" type="checkbox" data-filter="{{ $category->id }}">{{ $category->title }}</label>
                    @endforeach
                </section>

                <section class="p-[18px] border-b border-[#e4e4e7]">
                    <div class="font-semibold text-sm mb-[15px]">محدوده قیمت</div>
                    <div class="grid grid-cols-2 gap-2">
                        <input id="minPrice" type="number" placeholder="حداقل" value="0"
                               class="w-full border border-[#e4e4e7] rounded-lg p-[9px] outline-none text-[11px]">
                        <input id="maxPrice" type="number" placeholder="حداکثر" value=""
                               class="w-full border border-[#e4e4e7] rounded-lg p-[9px] outline-none text-[11px]">
                    </div>
                </section>
                <section class="p-[18px]">
                    <label class="flex items-center gap-2 my-3 text-[13px] text-[#52525b]">
                        <input id="hasDescount" class="accent-[#ef394e] w-[17px] h-[17px]" type="checkbox">
                        تخفیف خورده
                    </label>
                </section>
                <section class="p-[18px]">
                    <label class="flex items-center gap-2 my-3 text-[13px] text-[#52525b]">
                        <input id="exists" class="accent-[#ef394e] w-[17px] h-[17px]" type="checkbox">
                        فقط کالاهای موجود
                    </label>
                </section>
            </aside>

            <section class="min-w-0">
                <div
                        class="bg-white border border-[#e4e4e7] rounded-xl p-3 md:px-[15px] flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3.5">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-xs text-[#71717a]">مرتب‌سازی:</span>
                        <button
                                class="sort-btn text-xs border-0 bg-transparent text-[#ef394e] font-bold px-2.5 py-2 rounded-[7px] cursor-pointer"
                                data-sort-by="created_at" data-sort-type="desc">جدیدترین</button>
                        <button
                                class="sort-btn text-xs border-0 bg-transparent text-[#52525b] px-2.5 py-2 rounded-[7px] cursor-pointer"
                                data-sort-by="primary_price" data-sort-type="asc">ارزان‌ترین</button>
                        <button
                                class="sort-btn text-xs border-0 bg-transparent text-[#52525b] px-2.5 py-2 rounded-[7px] cursor-pointer"
                                data-sort-by="primary_price" data-sort-type="desc">گران‌ترین</button>
                    </div>
                    {{-- <button id="viewToggle"
                        class="border border-[#e4e4e7] bg-white rounded-[7px] w-9 h-[34px] self-end md:self-auto">▦</button> --}}
                </div>

                <div id="chips" class="block lg:hidden mb-3.5">
                    <button class="flex items-center gap-2 px-2 py-1 cursor-pointer rounded-full border border-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-gray-800" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 416c0 8.8 7.2 16 16 16l65.6 0c7.4 36.5 39.7 64 78.4 64s71-27.5 78.4-64L496 432c8.8 0 16-7.2 16-16s-7.2-16-16-16l-257.6 0c-7.4-36.5-39.7-64-78.4-64s-71 27.5-78.4 64L16 400c-8.8 0-16 7.2-16 16zm112 0a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zM304 256a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm48-80c-38.7 0-71 27.5-78.4 64L16 240c-8.8 0-16 7.2-16 16s7.2 16 16 16l257.6 0c7.4 36.5 39.7 64 78.4 64s71-27.5 78.4-64l65.6 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-65.6 0c-7.4-36.5-39.7-64-78.4-64zM192 144a48 48 0 1 1 0-96 48 48 0 1 1 0 96zm78.4-64C263 43.5 230.7 16 192 16s-71 27.5-78.4 64L16 80C7.2 80 0 87.2 0 96s7.2 16 16 16l97.6 0c7.4 36.5 39.7 64 78.4 64s71-27.5 78.4-64L496 112c8.8 0 16-7.2 16-16s-7.2-16-16-16L270.4 80z"/></svg>
                        <span class="text-sm text-gray-800">فیلتر </span>
                    </button>
                </div>

                <div id="products"
                     class="grid gap-3 grid-cols-2 min-[431px]:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 bg-white border border-[#e4e4e7] rounded-xl overflow-hidden">
                    @foreach ($products as $product)
                        <a href="{{ route('product.show', [$product->id]) }}"
                           class="group relative min-w-0 bg-white p-[17px] border-l border-b border-[#e4e4e7] transition duration-200 hover:-translate-y-0.5 hover:shadow-[0_6px_22px_rgba(0,0,0,.08)]">
                            @if ($product->percent)
                                <span
                                        class="absolute top-[25px] right-[25px] z-10 bg-[#ef394e] text-white rounded-[5px] text-[10px] px-[7px] py-1 in-fa">{{ $product->percent }} %</span>
                            @endif
                            {{-- <button
                                class="absolute top-[22px] left-5 z-10 border-0 bg-white text-xl text-[#aaa]">♡</button> --}}
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 alt="{{ $product->title }}" loading="lazy"
                                 class="w-full aspect-square object-contain rounded-lg bg-[#f8f8f8] block mb-3.5">
                            <h3 class="m-0 mb-2.5 text-[13px] leading-[1.9] h-[50px] overflow-hidden">{{ $product->title }}</h3>
                            <div class="flex justify-between items-center mb-2.5 text-[11px]">
                                <span>۴٫۹ ⭐</span><span class="text-[#f59e0b]">★★★★★</span>
                            </div>
                            @if ($product->secondary_price)
                                <div class="flex items-center justify-between gap-2">
                                    <strong class="text-[15px] in-fa">{{ $product->secondary_price }}</strong>
                                    <span
                                            class="text-[10px] text-[#71717a]">تومان
                                    </span>
                                </div>
                                <div class="line-through text-[#a1a1aa] text-[10px] in-fa">{{ $product->primary_price }} تومان</div>
                            @else
                                <div class="flex items-center justify-between gap-2">
                                    <strong class="text-[15px] in-fa">{{ $product->primary_price }}</strong>
                                    <span
                                            class="text-[10px] text-[#71717a]">تومان
                                    </span>
                                </div>
                            @endif
                            @if ($product->count > 0)
                                <div class="mt-2.5 text-[10px] text-[#16a34a]">● موجود در انبار</div>
                            @else
                                <div class="mt-2.5 text-[10px] text-[#a31616]">● ناموجود</div>
                            @endif
                        </a>
                    @endforeach
                </div>

                <div id="empty"
                     class="hidden bg-white border border-[#e4e4e7] rounded-xl text-center p-[70px_20px]">
                    <div class="text-[45px]">🔎</div>
                    <h2 class="text-lg">محصولی پیدا نشد</h2>
                    <p class="text-[13px] text-[#777]">عبارت جستجو یا فیلترها را تغییر دهید و دوباره امتحان کنید.</p>
                </div>

            </section>
        </div>
    </main>

    <script src="{{ asset('js/filterStore.js') }}"></script>
@endsection