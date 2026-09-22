@extends('app.document')
@section('title', 'شاهکار | همه محصولات')
@section('content')
    <section class="w-full flex justify-center items-start">
        <div class="w-11/12 h-full flex max-lg:flex-col justify-between items-start xl:gap-12 gap-6">
            <!-- filter_index_product -->
            <div
                class="lg:w-3/12 w-full pt-1 pb-9 lg:sticky lg:top-27 lg:left-0 lg:max-h-[90vh] lg:overflow-auto lg:[&::-webkit-scrollbar]:w-1  lg:[&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  lg:[&::-webkit-scrollbar-thumb]:rounded-full">
                <div
                    class=" w-full bg-[var(--background-2)] border border-[var(--gold)] rounded-2xl flex flex-col justify-start items-start pb-3 ">
                    <div class="w-full py-2 border-b border-[var(--gold)] flex justify-center items-center relative">
                        <div
                            class="w-11/12 bg-[var(--background)] border border-[var(--border)] rounded-xl flex gap-3 justify-between items-center shadow_boxs xl:px-6 px-4 xl:py-5 py-4">
                            <form action="{{ route('product.searchResult') }}" method="post"
                                class="flex xl:gap-4 gap-2 items-center">
                                @csrf
                                <button class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="xl:size-4 size-3 fill-[var(--text)]">
                                        <path
                                            d="M368 208A160 160 0 1 0 48 208a160 160 0 1 0 320 0zM337.1 371.1C301.7 399.2 256.8 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 48.8-16.8 93.7-44.9 129.1L505 471c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L337.1 371.1z">
                                        </path>
                                    </svg>
                                </button>
                                <input type="text" placeholder="جستحوی مجصول..." id="searchInput" name="searchedValue"
                                    class="outline-none xl:text-sm text-xs font-bold text-[var(--text-secondary)]"
                                    onkeyup="searchProduct(this)" required>
                            </form>
                        </div>
                        <div id="searchResultBox"
                            class="invisible opacity-0 absolute top-18 left-0 w-full max-h-70 overflow-auto bg-[var(--background)] border border-[var(--gold)] shadow-xl rounded-xl z-5 [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:bg-[var(--gold)] [&::-webkit-scrollbar-thumb]:rounded-full">
                            <a href="#"
                                class="w-full flex justify-between items-center px-2 py-4 border-b border-[var(--gold)]">
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('product.filter') }}" method="POST" id="filterForm"
                        class="w-full h-full  flex flex-col justify-start items-center">
                        @csrf
                        <div
                            class="w-full pb-3 flex flex-col gap-2 justify-start items-start  border-b border-[var(--gold)] overflow-y-hidden transition_root ">
                            <label for=""
                                class="w-full px-4 min-h-12 flex justify-between items-center filter_product_list">
                                <span class="xl:text-lg text-sm text-[var(--text)]">دسته بندی</span>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                        class="xl:size-5 size-3 fill-[var(--gold)] rotate-180">
                                        <path
                                            d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                        </path>
                                    </svg>
                                </div>
                            </label>
                            <div class="w-full h-full flex flex-col gap-4 justify-start items-start px-4 pr-7 max-xl:mt-1">
                                <div
                                    class="w-full max-h-50 overflow-y-auto flex flex-col gap-4 justify-start items-start [&::-webkit-scrollbar]:w-1  [&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  [&::-webkit-scrollbar-thumb]:rounded-full">
                                    <div class="w-full flex justify-start items-center gap-4">
                                        <input id="all" @if (!isset($currentCat) && !isset($catIds)) checked @endif
                                            name="all" value="all" type="checkbox"
                                            class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                        <label for="all"
                                            class="xl:text-sm text-xs font-bold text-[var(--text-secondary)] cursor-pointer">همه</label>
                                    </div>
                                    @foreach ($categories as $category)
                                        <div class="w-full flex justify-start items-center gap-4">
                                            <input id="{{ $category['id'] }}" type="checkbox" name="selectedCats[]"
                                                value="{{ $category->id }}"
                                                @if (isset($currentCat)) @if ($currentCat->id == $category->id) checked @endif
                                                @endif
                                            @if (isset($catIds)) @if (in_array($category->id, $catIds)) checked @endif
                                    @endif
                                    class="checkBox appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="{{ $category['id'] }}"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)] cursor-pointer">{{ $category['title'] }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                </div>
                {{-- <div
                    class="w-full h-12 pb-3 flex flex-col justify-start items-start border-b border-[var(--gold)] overflow-y-hidden transition_root ">
                    <label for=""
                        class="w-full min-h-12 px-4 flex justify-between items-center filter_product_list">
                        <span class="xl:text-lg text-sm text-[var(--text)] flex justify-center items-center gap-2">بازه
                            قیمت<span class="text-xs text-[var(--text-secondary)]">(تومان)</span></span>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="xl:size-5 size-3 fill-[var(--gold)]">
                                <path
                                    d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                </path>
                            </svg>
                        </div>
                    </label>
                    <div class="w-full flex flex-col gap-7 justify-start items-center px-4 max-xl:mt-1 py-4">
                        <div class="w-full flex justify-center items-start">
                            <input type="range" class="w-11/12 xl:h-2 h-1.5 accent-[var(--gold)]" min="0"
                                max="20000" value="20000" dir="ltr">
                        </div>
                        <div class="w-full flex justify-between items-center">
                            <div class="w-1/2 flex justify-end items-center gap-2">
                                <span class="text-[var(--text-secondary)] max-xl:text-sm">تا</span>
                                <input type="number"
                                    class="bg-[var(--backgorund)] border border-[var(--border)] text-[var(--text-secondary)] max-xl:text-sm w-full px-2 py-1 rounded-md"
                                    placeholder="20,000">
                            </div>
                            <div class="w-1/2 flex justify-end items-center gap-2">
                                <span class="text-[var(--text-secondary)] max-xl:text-sm">از</span>
                                <input type="number"
                                    class="bg-[var(--backgorund)] border border-[var(--border)] text-[var(--text-secondary)] max-xl:text-sm w-2/3 px-2 py-1 rounded-md"
                                    placeholder="0">
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="w-full flex flex-col gap-4 justify-start items-center mt-7">
                    <button type="submit"
                        class="w-11/12 py-2 gradient_box1 rounded-xl flex gap-2 justify-center items-center cursor-pointer">
                        <div>
                            <svg version="1.1" class="xl:size-4 size-3 fill-[var(--text)]" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M.75 3a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5H.75zM3 7.75A.75.75 0 013.75 7h8.5a.75.75 0 010 1.5h-8.5A.75.75 0 013 7.75zm3 4a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75z">
                                </path>
                            </svg>
                        </div>
                        <span class="max-xl:text-sm font-bold text-[var(--text)]">اعمال فیلتر</span>
                    </button>
                    <button type="reset" onclick="resetForm(this)"
                        class="w-11/12 py-2 rounded-xl flex gap-2 justify-center items-center cursor-pointer">
                        <div>
                            <svg version="1.1" viewBox="0 0 36 36" class="size-4 fill-[var(--gold)]"
                                preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false" role="img">
                                <path class="clr-i-outline clr-i-outline-path-1"
                                    d="M22.4,11.65a1.09,1.09,0,0,0,1.09,1.09H34.43V1.81a1.09,1.09,0,1,0-2.19,0V8.95a16.41,16.41,0,1,0,1.47,15.86,1.12,1.12,0,0,0-2.05-.9,14.18,14.18,0,1,1-1.05-13.36H23.5A1.09,1.09,0,0,0,22.4,11.65Z">
                                </path>
                            </svg>
                        </div>
                        <span class="xl:text-sm text-xs font-bold text-[var(--text)]">حذف فیلتر ها</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
        <!-- filter_index_product -->
        <!-- button_filter_mobile_start -->
        {{-- <div class="w-full flex flex-col gap-5 justify-start items-center sm:hidden relative">
                <button class="w-11/12 py-2 gradient_box1 rounded-xl flex gap-2 justify-center items-center"
                    onclick="filter_index_product_pop_up_mobile('open')">
                    <div>
                        <svg version="1.1" class="xl:size-4 size-3 fill-[var(--text)]" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M.75 3a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5H.75zM3 7.75A.75.75 0 013.75 7h8.5a.75.75 0 010 1.5h-8.5A.75.75 0 013 7.75zm3 4a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75z">
                            </path>
                        </svg>
                    </div>
                    <span class="max-xl:text-sm font-bold text-[var(--text)]"> فیلتر</span>
                </button>
                <!-- button_sort_product_mobile -->
                <div class="w-full h-12 relative flex justify-center items-center">
                    <div
                        class="w-11/12 h-12 bg-[var(--background-2)] border border-[var(--border)] flex flex-col  justify-between items-center rounded-xl overflow-y-hidden absolute top-0 left-auto right-auto transition_root z-1">
                        <div class="w-full min-h-12  flex justify-between gap-12 items-center px-4 cursor-pointer"
                            onclick="sort_product(this)">
                            <div class="h-full flex xl:gap-2 gap-1 justify-start items-center">
                                <span class="max-xl:text-xs max-sm:text-[10px] text-[var(--text)]">مرتب سازی :</span>
                                <!-- value_item -->
                                <span class="xl:text-lg text-sm text-[var(--text)]">پر فروش ترین</span>
                                <!-- value_item -->
                            </div>
                            <div class="transition_root">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="xl:size-5 size-3 fill-[var(--gold)]">
                                    <path
                                        d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div
                            class="w-full min-h-12 flex justify-between items-center px-4 cursor-pointer hover:border hover:border-[var(--gold)] hover:px-6 hover:bg-[var(--background)] active:border active:border-[var(--gold)] active:bg-[var(--background)] active::px-6 transition_root">
                            <div class="w-9/12 h-full flex gap-2 justify-start items-center">
                                <span class="xl:text-lg text-sm text-[var(--text)]">همه</span>
                            </div>
                        </div>
                        <div
                            class="w-full min-h-12 flex justify-between items-center px-4 cursor-pointer hover:border hover:border-[var(--gold)] hover:px-6 hover:bg-[var(--background)] active:border active:border-[var(--gold)] active:bg-[var(--background)] active::px-6 transition_root">
                            <div class="w-9/12 h-full flex gap-2 justify-start items-center">
                                <span class="xl:text-lg text-sm text-[var(--text)]">جدید ترین</span>
                            </div>
                        </div>
                        <div
                            class="w-full min-h-12  flex justify-between items-center px-4 cursor-pointer hover:border hover:border-[var(--gold)] hover:px-6 hover:bg-[var(--background)] active:border active:border-[var(--gold)] active:bg-[var(--background)] active::px-6 transition_root">
                            <div class="w-9/12 h-full flex gap-2 justify-start items-center">
                                <span class="xl:text-lg text-sm text-[var(--text)]">پرفروش ترین</span>
                            </div>
                        </div>
                        <div
                            class="w-full min-h-12  flex justify-between items-center px-4 cursor-pointer hover:border hover:border-[var(--gold)] hover:px-6 hover:bg-[var(--background)] active:border active:border-[var(--gold)] active:bg-[var(--background)] active::px-6 transition_root">
                            <div class="w-9/12 h-full flex gap-2 justify-start items-center">
                                <span class="xl:text-lg text-sm text-[var(--text)]">محبوب ترین</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- button_sort_product_mobile -->
            </div> --}}
        <!-- button_filter_mobile_end -->

        <!-- products -->
        <div class="lg:w-9/12 w-full h-full flex flex-col gap-10 justify-start items-center">
            <div class="w-full flex justify-between  items-start relative pt-4">
                <span class="text-sm text-[var(--text)]">{{ count($products) }} محصول</span>
                {{-- <div
                    class="h-12 bg-[var(--background-2)] border border-[var(--border)] flex flex-col gap-2 justify-start items-center rounded-xl overflow-y-hidden absolute top-0 left-0 transition_root">
                    <div class="w-full min-h-12 flex justify-between gap-12 items-center px-4 cursor-pointer"
                        onclick="sort_product(this)">
                        <div class="h-full flex xl:gap-2 gap-1 justify-start items-center">
                            <span class="max-xl:text-xs max-sm:text-[10px] text-[var(--text)]">مرتب سازی :</span>
                            <!-- value_item -->
                            <span class="xl:text-lg text-sm text-[var(--text)]">جدید ترین</span>
                            <!-- value_item -->
                        </div>
                        <div class="transition_root">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="xl:size-5 size-3 fill-[var(--gold)]">
                                <path
                                    d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div
                        class="w-full min-h-12 flex justify-between items-center px-4 cursor-pointer hover:border hover:border-[var(--gold)] hover:px-6 hover:bg-[var(--background)] active:border active:border-[var(--gold)] active:bg-[var(--background)] active::px-6 transition_root">
                        <div class="w-9/12 h-full flex gap-2 justify-start items-center">
                            <span class="xl:text-lg text-sm text-[var(--text)]">جدید ترین</span>
                        </div>
                    </div>
                    <div
                        class="w-full min-h-12  flex justify-between items-center px-4 cursor-pointer hover:border hover:border-[var(--gold)] hover:px-6 hover:bg-[var(--background)] active:border active:border-[var(--gold)] active:bg-[var(--background)] active::px-6 transition_root">
                        <div class="w-9/12 h-full flex gap-2 justify-start items-center">
                            <span class="xl:text-lg text-sm text-[var(--text)]">پرفروش ترین</span>
                        </div>
                    </div>
                    <div
                        class="w-full min-h-12  flex justify-between items-center px-4 cursor-pointer hover:border hover:border-[var(--gold)] hover:px-6 hover:bg-[var(--background)] active:border active:border-[var(--gold)] active:bg-[var(--background)] active::px-6 transition_root">
                        <div class="w-9/12 h-full flex gap-2 justify-start items-center">
                            <span class="xl:text-lg text-sm text-[var(--text)]">محبوب ترین</span>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div
                class="w-full grid xl:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5 justify-start items-start">
                @foreach ($products as $product)
                    <div
                        class="w-full h-75 border-1 border-[var(--gold)] bg-[#181819] rounded-2xl flex flex-col gap-5 items-center justify-between scale transition_root pb-2">
                        <a href="{{ route('product.show', [$product]) }}" class="w-full lg:h-7/12 h-full">
                            @if ($product['media']->isNotEmpty())
                                @foreach ($product['media'] as $media)
                                    @if ($media['is_main'])
                                        @php
                                            $imgSrc = asset('storage/' . $media['media_path']);
                                        @endphp
                                        @break

                                    @else
                                        @php
                                            $imgSrc = asset('storage/default.jpg');
                                        @endphp
                                    @endif
                                @endforeach
                            @else
                                @php
                                    $imgSrc = asset('storage/default.jpg');
                                @endphp
                            @endif
                            <img src="{{ $imgSrc }}" alt=""
                                class="object-fit w-full lg:h-55 h-45 rounded-t-2xl">
                        </a>
                        <div class="w-full flex gap-4 justify-between items-center px-4">
                            <div
                                class="min-w-11 min-h-11 max-w-11 max-h-11 gradient_box1 rounded-xl flex justify-center items-center cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="size-1/2"
                                    fill="white">
                                    <path
                                        d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="w-8/12 flex flex-col gap-4 justify-center items-end xl:text-sm lg:text-xs sm:text-[11px] md:text-sm text-xs">
                                <p class="w-full truncate text-nowrap font-bold text-[var(--text)] text-left">
                                    {{ $product['title'] }}</p>
                                @if ($product['primary_price'])
                                    @if ($product['secondary_price'])
                                        <div class="flex items-center gap-2 text-end">
                                            <span
                                                class="text-xs text-gray-400 font-bold line-through">{{ $product['primary_price'] }}</span>
                                            <span
                                                class="text-[var(--gold)] w-full text-left">{{ $product['secondary_price'] }}
                                                <span class="text-[10px]">تومان</span>
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-[var(--gold)] w-full text-left">{{ $product['primary_price'] }}
                                            <span class="text-[10px]">تومان</span>
                                        </span>
                                    @endif
                                @else
                                    <span class="text-[var(--gold)] w-full text-left text-[10px]">برای استعلام قیمت تماس
                                        بگیرید</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- products -->
        </div>
        <!-- filter_mobild_item_start -->
        {{-- <div class="w-full h-dvh overflow-y-auto fixed top-0 z-2 flex justify-center items-start invisible opacity-0 transition_root sm:hidden lg:[&::-webkit-scrollbar]:w-1  lg:[&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  lg:[&::-webkit-scrollbar-thumb]:rounded-full"
            id="filter_index_product_pop_up_mobile_item">
            <div class="w-full h-full bg-black/50 absolute -z-1" onclick="filter_index_product_pop_up_mobile('close')">
            </div>
            <div
                class="lg:w-3/12 w-full bg-[var(--background-2)] border border-[var(--gold)] rounded-2xl flex flex-col justify-start items-center pb-3">
                <div class="w-full py-2 border-b border-[var(--gold)] flex justify-between items-center px-4">
                    <div onclick="filter_index_product_pop_up_mobile('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="size-5 fill-[var(--gold)]">
                            <path
                                d="M440.6 273.4c4.7-4.5 7.4-10.8 7.4-17.4s-2.7-12.8-7.4-17.4l-176-168c-9.6-9.2-24.8-8.8-33.9 .8s-8.8 24.8 .8 33.9L364.1 232 24 232c-13.3 0-24 10.7-24 24s10.7 24 24 24l340.1 0L231.4 406.6c-9.6 9.2-9.9 24.3-.8 33.9s24.3 9.9 33.9 .8l176-168z">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="w-9/12 bg-[var(--background)] border border-[var(--border)] rounded-xl flex gap-3 justify-between items-center shadow_boxs xl:px-6 px-4 xl:py-5 py-4">
                        <div class="flex xl:gap-4 gap-2 items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="xl:size-4 size-3 fill-[var(--text)]">
                                    <path
                                        d="M368 208A160 160 0 1 0 48 208a160 160 0 1 0 320 0zM337.1 371.1C301.7 399.2 256.8 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 48.8-16.8 93.7-44.9 129.1L505 471c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L337.1 371.1z">
                                    </path>
                                </svg>
                            </div>
                            <input type="text" placeholder="جستحوی مجصول..."
                                class="outline-none xl:text-sm text-xs font-bold text-[var(--text-secondary)]"
                                onclick="search_focus_box('open')">
                        </div>
                    </div>
                </div>
                <form action="" class="w-full h-full  flex flex-col justify-start items-center">
                    <div
                        class="w-full pb-3 flex flex-col gap-2 justify-start items-start  border-b border-[var(--gold)] overflow-y-hidden transition_root cursor-pointer">
                        <label for=""
                            class="w-full px-4 min-h-12 flex justify-between items-center filter_product_list">
                            <span class="xl:text-lg text-sm text-[var(--text)]">دسته بندی</span>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="xl:size-5 size-3 fill-[var(--gold)]">
                                    <path
                                        d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                    </path>
                                </svg>
                            </div>
                        </label>
                        <div class="w-full h-full flex flex-col gap-4 justify-start items-start px-4 pr-7 max-xl:mt-1">
                            <div
                                class="w-full max-h-50 overflow-y-auto flex flex-col gap-4 justify-start items-start [&::-webkit-scrollbar]:w-1  [&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  [&::-webkit-scrollbar-thumb]:rounded-full">
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="all" checked type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="all"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">همه</label>
                                </div>
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="kart" type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="kart"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">کارت
                                        ویزیت</label>
                                </div>
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="baner" type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="baner"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">چاپ بنر</label>
                                </div>
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="baner" type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="baner"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">چاپ بنر</label>
                                </div>
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="baner" type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="baner"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">چاپ بنر</label>
                                </div>
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="baner" type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="baner"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">چاپ بنر</label>
                                </div>
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="baner" type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="baner"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">چاپ بنر</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <span class="w-full h-[1px] bg-[var(--gold)]"></span> -->
                    <div
                        class="w-full h-12  pb-3 flex flex-col justify-start items-start border-b border-[var(--gold)] overflow-y-hidden transition_root cursor-pointer">
                        <label for=""
                            class="w-full min-h-12 px-4 flex justify-between items-center filter_product_list">
                            <span class="xl:text-lg text-sm text-[var(--text)] flex justify-center items-center gap-2">رنج
                                قیمت<span class="xl:text-base text-xs text-[var(--text-secondary)]">(تومان)</span></span>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="xl:size-5 size-3 fill-[var(--gold)]">
                                    <path
                                        d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                    </path>
                                </svg>
                            </div>
                        </label>
                        <div class="w-full flex flex-col gap-7 justify-start items-center px-4 max-xl:mt-1">
                            <div class="w-full flex justify-center items-start">
                                <input type="range"
                                    class="w-11/12 xl:h-2 h-1.5 accent-[var(--gold)] bg-[var(--background-)]"
                                    min="0" max="20000" value="20000" dir="ltr">
                                <input type="range"
                                    class="w-11/12 xl:h-2 h-1.5 accent-[var(--gold)] bg-[var(--background-)]"
                                    min="0" max="20000" value="20000">
                            </div>
                            <div class="w-full flex justify-between items-start">
                                <div class="w-1/2 flex justify-start items-center gap-2">
                                    <span class="text-[var(--text-secondary)] max-xl:text-sm">از</span>
                                    <input type="number"
                                        class="bg-[var(--backgorund)] border border-[var(--border)] text-[var(--text-secondary)] max-xl:text-sm w-2/3 px-2 py-1 rounded-md"
                                        placeholder="0">
                                </div>
                                <div class="w-1/2 flex justify-start items-center gap-2">
                                    <span class="text-[var(--text-secondary)] max-xl:text-sm">تا</span>
                                    <input type="number"
                                        class="bg-[var(--backgorund)] border border-[var(--border)] text-[var(--text-secondary)] max-xl:text-sm w-full px-2 py-1 rounded-md"
                                        placeholder="20,000">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <span class="w-full h-[1px] bg-[var(--gold)]"></span> -->
                    <div
                        class="w-full h-12 pb-3 flex flex-col justify-start items-start rounded-xl overflow-y-hidden transition_root cursor-pointer">
                        <label for=""
                            class="w-full min-h-12 px-4 flex justify-between items-center filter_product_list">
                            <span class="xl:text-lg text-sm text-[var(--text)]">رنگ</span>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class="xl:size-5 size-3 fill-[var(--gold)]">
                                    <path
                                        d="M241 337c-9.4 9.4-24.6 9.4-33.9 0L47 177c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l143 143L367 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L241 337z">
                                    </path>
                                </svg>
                            </div>
                        </label>
                        <div class="w-full h-full flex flex-col gap-4 justify-start items-start px-4 pr-7 max-xl:mt-1">
                            <div
                                class="w-full pb-2 max-h-50 overflow-y-auto flex flex-col gap-4 justify-start items-start [&::-webkit-scrollbar]:w-1  [&::-webkit-scrollbar-thumb]:bg-[var(--gold)]  [&::-webkit-scrollbar-thumb]:rounded-full">
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="all" checked type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="all"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">همه</label>
                                </div>
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="kart" type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="kart"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">کارت
                                        ویزیت</label>
                                </div>
                                <div class="w-full flex justify-start items-center gap-4">
                                    <input id="baner" type="checkbox"
                                        class="appearance-none xl:size-5 size-4 bg-[var(--background)] border border-[var(--gold)] checked:bg-[var(--gold)] rounded-sm after:content-['✓'] after:flex after:justify-center after:items-center  after:opacity-0 checked:after:opacity-100 max-xl:after:text-xs after:text-white transition_root">
                                    <label for="baner"
                                        class="xl:text-sm text-xs font-bold text-[var(--text-secondary)]">چاپ بنر</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="w-full flex flex-col gap-4 justify-start items-center mt-4">
                        <button class="w-11/12 py-2 gradient_box1 rounded-xl flex gap-2 justify-center items-center">
                            <div>
                                <svg version="1.1" class="xl:size-4 size-3 fill-[var(--text)]" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M.75 3a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5H.75zM3 7.75A.75.75 0 013.75 7h8.5a.75.75 0 010 1.5h-8.5A.75.75 0 013 7.75zm3 4a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75z">
                                    </path>
                                </svg>
                            </div>
                            <span class="max-xl:text-sm font-bold text-[var(--text)]">اعمال فیلتر</span>
                        </button>
                        <button class="w-11/12 py-2 rounded-xl flex gap-2 justify-center items-center">
                            <div>
                                <svg version="1.1" viewBox="0 0 36 36" class="size-4 fill-[var(--gold)]"
                                    preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false" role="img">
                                    <path class="clr-i-outline clr-i-outline-path-1"
                                        d="M22.4,11.65a1.09,1.09,0,0,0,1.09,1.09H34.43V1.81a1.09,1.09,0,1,0-2.19,0V8.95a16.41,16.41,0,1,0,1.47,15.86,1.12,1.12,0,0,0-2.05-.9,14.18,14.18,0,1,1-1.05-13.36H23.5A1.09,1.09,0,0,0,22.4,11.65Z">
                                    </path>
                                </svg>
                            </div>
                            <span class="xl:text-sm text-xs font-bold text-[var(--text)]">حذف فیلتر ها</span>
                        </button>
                    </div>
                </form>
            </div>
        </div> --}}
        <!-- filter_mobild_item_end -->
    </section>
    <div class="absolute top-0 opacity-0 invisible right-1/2 translate-x-1/2 w-3/4 lg:w-1/3 bg-white rounded-lg shadow-md transition-all duration-500 z-99999999"
        id="message">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="size-4 absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer" onclick="showMessage('close')"
                viewBox="0 0 384 512">
                <path
                    d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z" />
            </svg>

        </div>
    </div>
    <div id="authenticationDiv"
        class="w-full h-dvh fixed top-0 left-0 flex justify-center items-center invisible opacity-0 max-md:px-5 transition-all duration-300 z-5">
        <div class="size-full bg-black/50 absolute backdrop-blur-[5px]" onclick="closeLoginForm()"></div>
        <div class="max-h-120 overflow-auto relative p-4 sm:p-10 w-full md:w-3/4 xl:w-1/2 bg-[#1B1C1E] rounded-2xl"
            style="scrollbar-width: none">
            <button
                class="absolute z-1 top-1 left-1 size-6 flex flex-col justify-center items-center cursor-pointer bg-white rounded-full "
                onclick="closeLoginForm()">
                <span class=" w-2/3 h-[2.5px] rounded-full bg-slate-500 rotate-45
              translate-y-1/2"></span>
                <span class="w-2/3 h-[2.5px] rounded-full bg-slate-500 -rotate-45 -translate-y-1/2"></span>
            </button>
            <h3 class="text-center text-sm font-bold text-gray-400">ابتدا وارد شوید</h3>
            {{-- {{ route('user.checkUserPopup') }} --}}
            <form action="" class="flex flex-col items-center my-6 gap-3 w-full"
                method="post" id="loginForm">
                @csrf
                <input type="number"
                    class="placeholder-gray-400 focus:border-1 focus:border-[#d5a743] p-2 md:p-[9px] mb-1 rounded-[7px] border-1 border-[#DBDFE9] focus:outline-none w-full"
                    name="phoneNumber" id="phoneNumber" placeholder="شماره تلفن" required>
                <div class="w-full" id="login">
                    <div class="w-full flex flex-row items-center gap-3">
                        <input type="number"
                            class="w-8/12 p-2 placeholder-gray-400 focus:border-[#d5a743] md:p-[9px] rounded-[7px] border-1 border-[#DBDFE9] outline-none"
                            name="code" placeholder="کد" required id="code">
                        <button type="button"
                            class="w-4/12 text-xs lg:text-base h-full p-2 md:p-[9px] rounded-[7px] bg-[#d5a743] text-white cursor-pointer"
                            onclick="sendCode()" id="countDown">ارسال کد
                        </button>
                    </div>
                </div>
                <div class="w-full flex flex-row items-center justify-between" id="loginWay">
                    {{-- {{ route('user.forgetPassword') }} --}}
                    <a href="#"
                        class="text-[#d5a743] inline-block max-md:my-1 my-4 max-md:text-sm">فراموشی رمز عبور</a>
                    <span class="text-[#d5a743] inline-block max-md:my-1 my-4 max-md:text-sm cursor-pointer"
                        onclick="loginWithPassKey(this)">ورود با رمز عبور</span>
                </div>
                <button onclick="check(event)"
                    class="focus:bg-[#d5a743] hover:bg-[#d5a743] transition-all duration-400 text-center w-full bg-[#d5a743] p-2 md:p-3 rounded-[10px] text-white cursor-pointer">
                    ورود
                </button>
                <div class="w-full text-center">
                    <span class="text-[#4B5675] mt-1 md:mt-5 max-md:text-sm">
                        هنوز عضو نشدی؟
                        <a href="{{ route('signup') }}" class="text-[#d5a743] mr-2">ثبت نام!</a>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal سبد خرید -->
    <div id="shoppingCartModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- بک‌گراند -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeShoppingCart()"></div>

            <!-- محتوای مودال -->
            <div
                class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl">
                <!-- هدر -->
                <div
                    class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                        🛒 سبد خرید
                    </h3>
                    <button onclick="closeShoppingCart()"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- لیست آیتم‌ها -->
                <div id="cartItemsList" class="p-6 overflow-y-auto max-h-[calc(90vh-180px)]">
                    {{-- <div id="cartLoading" class="flex justify-center items-center py-12">
                        <div class="w-8 h-8 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                    </div> --}}
                    <div id="cartEmpty" class="hidden text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <p class="mt-4 text-gray-500 dark:text-gray-400">سبد خرید شما خالی است</p>
                    </div>
                    <div id="cartItemsContainer" class="hidden space-y-4">
                        <!-- آیتم‌ها با جاوااسکریپت اضافه می‌شوند -->
                    </div>
                </div>

                <!-- فوتر با دکمه‌ها -->
                <div
                    class="sticky bottom-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-6 py-4">
                    <div class="flex justify-between items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-600 dark:text-gray-300">جمع کل:</span>
                            <span id="cartTotalPrice" class="text-xl font-bold text-white">0</span>
                            <span class="text-gray-300">تومان</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="canceleOrder()"
                                class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                                id="cancelOrderBtn">
                                لغو همه
                            </button>
                            <button onclick="submitOrder()"
                                class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-primary-dark transition disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submitOrderBtn">
                                ثبت سفارشات
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let checkBoxs = document.querySelectorAll('.checkBox')
        let allCheckbox = document.getElementById('all')
        allCheckbox.addEventListener('click', () => {
            checkBoxs.forEach(checkBox => {
                if (checkBox.checked) {
                    checkBox.checked = false
                } else {
                    allCheckbox.checked = true
                }
            });
        })
        checkBoxs.forEach(el => {
            el.addEventListener('click', () => {
                if (allCheckbox.checked) {
                    allCheckbox.checked = false
                }
                let i = 0
                checkBoxs.forEach(item => {
                    if (!item.checked) {
                        i++
                    }
                })
                if (i == checkBoxs.length) {
                    allCheckbox.checked = true
                }

                let j = 0
                checkBoxs.forEach(item => {
                    if (item.checked) {
                        j++
                    }
                })
                if (j == checkBoxs.length) {
                    allCheckbox.checked = true
                }
            })
        });

        function resetForm(el) {
            checkBoxs.forEach(checkBox => {
                checkBox.checked = false
            });
            allCheckbox.checked = true
            document.getElementById('filterForm').submit()
        }

        let searchResultBox = document.getElementById('searchResultBox')
        let searchInput = document.getElementById('searchInput')
        // searchInput.addEventListener('blur', () => {
        //     searchResultBox.classList.add('invisible', 'opacity-0')
        // })

        let timeout

        function searchProduct(el) {
            if (el.value != '') {
                clearTimeout(timeout)
                timeout = setTimeout(() => {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    })
                    $.ajax({
                        url: "{{ route('product.search') }}",
                        type: "POST",
                        dataType: "json",
                        data: {
                            'title': el.value,
                        },
                        success: function(data) {
                            searchResultBox.classList.remove('opacity-0', 'invisible')
                            searchResultBox.innerHTML = ''
                            data.forEach(product => {
                                let a = document.createElement('a')
                                a.classList =
                                    'w-full flex justify-between items-center px-2 py-4 border-b border-[var(--gold)]'
                                a.setAttribute('href',
                                    `{{ url('product/show/${product.id}') }}`)
                                let imgSrc
                                if (product.media.length > 0) {
                                    for (let i = 0; i < product.media.length; i++) {
                                        if (product.media[i].is_main) {
                                            imgSrc =
                                                `{{ asset('storage/${product.media[i].media_path}') }}`
                                            break
                                        } else {
                                            imgSrc = `{{ asset('storage/default.jpg') }}`
                                        }
                                    };
                                } else {
                                    imgSrc = `{{ asset('storage/default.jpg') }}`
                                }
                                element = `
                                    <img src="${imgSrc}" alt=""
                                        class="size-15 rounded-xl">
                                    <div class="flex flex-col items-end gap-4 text-xs text-[var(--text)]">
                                        <span class="text-nowrap w-11/12 truncate text-end">${product.title}</span>
                                        `
                                if (product['primary_price']) {
                                    if (product['secondary_price']) {
                                        element += `
                                            <div class="flex items-center gap-2 text-end">
                                                <span
                                                    class="text-xs text-gray-400 font-bold line-through">${product.primary_price}</span>
                                                <span
                                                    class="text-[var(--gold)]">${product.secondary_price}
                                                    <span class="text-[10px]">تومان</span>
                                                </span>
                                            </div>
                                            `
                                    } else {
                                        element += `
                                            <span class="text-[var(--gold)]">${product.primary_price}
                                                <span class="text-[10px]">تومان</span>
                                            </span>
                                            `
                                    }
                                } else {
                                    element += `
                                        <span class="text-[var(--gold)] w-full text-left text-[10px]">برای استعلام قیمت تماس بگیرید</span>
                                    `
                                }
                                element += `</div>`
                                a.innerHTML = element
                                searchResultBox.append(a)
                            })
                        },
                        error: function() {
                            alert('error')
                        }
                    })
                }, 500);
            }
        }
    </script>
@endsection
