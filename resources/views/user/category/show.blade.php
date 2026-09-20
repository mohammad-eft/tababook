@extends('app.document')
@section('title')
    {{ $category->title }}
@endsection
@section('content')
    <div class="w-full">
        <div class="pb-5 w-full">
            <h1 class="text-xl text-center lg:text-start font-bold">{{ $category->title }}</h1>
        </div>
        <div class="flex flex-col items-center lg:items-start lg:flex-row justify-between gap-5 border-none rounded-[7px]">
            <div class="size-27 lg:size-41 rounded-lg mx-auto lg:m-0">
                <img class="size-full" src="{{ asset($category->image) }}" alt="category image" />
            </div>
            <div class="w-full lg:w-[calc(100%-164px)] mt-4 lg:mt-5">
                <div class="bg-[#f2f2f2] shadow-md border border-gray-200 rounded-md lg:p-5 p-2 mb-3 lg:mb-5">
                    <div class="flex flex-row justify-between items-center border-b border-gray-200">
                        <h1 class="lg:text-xl mt-5 font-bold pb-3">
                            جزئیات دسته
                        </h1>
                        <a href="{{ route('category-index') }}"
                            class="text-xs px-2 py-0.5 rounded-sm bg-gray-800 text-white">بازگشت</a>
                    </div>

                    <div class="w-full lg:w-1/2 flex flex-col gap-y-3 lg:gap-y-5 mt-5">
                        <div class="w-full lg:py-3 flex flex-col gap-2 lg:gap-0 lg:flex-row lg:items-center">
                            <div class="w-full lg:w-1/2 text-xs lg:text-sm text-gray-400">
                                عنوان دسته بندی
                            </div>
                            <div class="w-full lg:w-1/2 font-medium pr-3 lg:pr-0 text-sm lg:text-base">
                                {{ $category->title }}
                            </div>
                        </div>
                        <div class="w-full lg:py-3 flex flex-col gap-2 lg:gap-0 lg:flex-row lg:items-center">
                            <div class="w-full lg:w-1/2 text-xs lg:text-sm text-gray-400">
                                توضیحات
                            </div>
                            <div class="w-full lg:w-1/2 font-medium pr-3 lg:pr-0 text-sm lg:text-base">
                                {{ $category->description }}
                            </div>
                        </div>
                        @if ($category->children)
                            <div class="w-full lg:py-3 flex flex-col gap-2 lg:gap-0 lg:flex-row">
                                <div class="w-full lg:w-1/2 text-xs lg:text-sm text-gray-400">
                                    زیر دسته بندی ها
                                </div>
                                <div class="w-1/2 flex flex-col items-center gap-3 pr-3 lg:pr-0">
                                    @foreach ($category->children as $child)
                                        <div class="w-full flex flex-col lg:flex-row">
                                            <div class="w-1/2 text-xs lg:text-sm text-gray-400">
                                                {{ $child->title }}
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="text-(--color-text) pt-3">
        <!-- title section -->
            <div class="flex flex-col lg:flex-row justify-between gap-8 lg:gap-0 lg:items-center py-5 lg:py-10">
                <h2 class="font-bold lg:text-[24px] leading-8">
                    محصولات {{ $category->title }}
                </h2>
            </div>
        <!-- title section -->
        <div class="w-full flex gap-5 overflow-x-auto p-5"
            style="scrollbar-width: thin; scrollbar-color: var(--color-primary) var(--color-primary-text);">
            @foreach ($products as $product)
                <div
                    class="min-w-64 p-2 border border-(--color-border) rounded-[10px] relative flex flex-col justify-between productItem">
                    <div
                        class="absolute top-[5px] lg:top-2.5 left-[5px] lg:left-2.5 hidden md:flex flex-col gap-2 z-555 overflow-hidden">
                        <button
                            class="size-8 border border-(--color-border) buttonProduct btnAnimation bg-white rounded-sm flex justify-center items-center -translate-x-4 opacity-0 cursor-pointer transition-all duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512">
                                <path fill="var(--color-fill)"
                                    d="M306.8 6.3C311.4 2.2 317.3 0 323.4 0c17.2 0 29.2 17.1 23.4 33.3L278.7 224H389c14.9 0 27 12.1 27 27c0 7.8-3.3 15.1-9.1 20.3L141.1 505.8c-4.5 4-10.4 6.2-16.5 6.2c-17.2 0-29.2-17.1-23.5-33.3L169.3 288H57.8C43.6 288 32 276.4 32 262.2c0-7.4 3.2-14.4 8.7-19.3L306.8 6.3zm.5 42.4L74.1 256H192c5.2 0 10.1 2.5 13.1 6.8s3.7 9.7 2 14.6L140.6 463.6 375.8 256H256c-5.2 0-10.1-2.5-13.1-6.8s-3.7-9.7-2-14.6l66.4-186z" />
                            </svg>
                        </button>
                        <button
                            class="size-8 border border-(--color-border) buttonProduct bg-white rounded-sm flex justify-center items-center -translate-x-4 opacity-0 cursor-pointer transition-all duration-500 delay-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512">
                                <path fill="var(--color-fill)"
                                    d="M117.2 136C160.3 96 217.6 64 288 64s127.7 32 170.8 72c43.1 40 71.9 88 85.2 120c-13.3 32-42.1 80-85.2 120c-43.1 40-100.4 72-170.8 72s-127.7-32-170.8-72C74.1 336 45.3 288 32 256c13.3-32 42.1-80 85.2-120zM288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM192 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z" />
                            </svg>
                        </button>
                    </div>
                    
                    <div>
                        <a href="{{ route('product-show', [$product]) }}"
                            class="flex justify-center mb-1 overflow-hidden">
                            <img src="{{ $product['img'] }}"
                                class="w-full transition-all duration-500 hover:scale-[1.04] relative z-10 max-h-[276px] lg:max-h-[186px] md:max-h-[348px] xl:max-h-[254px] h-[254px] object-cover"
                                alt="product">
                        </a>
                    </div>
                    <div>
                        <div class="mb-2 font-bold text-[14px] lg:text-base">
                            <a href="{{ route('product-show', [$product]) }}"
                                class="text-[12px] lg:text-[14px] text-(--color-text)">{{ $product->title }}</a>
                        </div>
                        <div>
                            <div class="mb-1">
                                <a
                                    href="{{ route('product-show', [$product]) }}">{{ $product->description }}</a>
                            </div>
                            <div class="flex flex-row items-center mb-3 gap-2">
                                <div class="w-1/2 flex flex-row items-center text-[12px]">
                                    <div class="text-(--color-secondary-text) flex flex-row items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                    </div>
                                    <span>(0)</span>
                                </div>

                            </div>
                            <div
                                class="hidden lg:flex flex-row items-center gap-2 text-(--color-text) mb-3 text-[18px] font-bold">
                                <span class="font-bold text-lg">{{ $product->price['price'] }}</span>
                                <span class="text-sm">تومان</span>
                            </div>
                        </div>
                        <div class="flex lg:hidden flex-row items-start gap-2 text-(--color-text) mb-3 font-bold">
                            <span class="font-bold text-lg">{{ $product->price['price'] }}</span>
                            <span class="text-sm">تومان</span>
                        </div>
                        <div class="flex flex-col lg:flex-row gap-2 lg:gap-4">
                            <div class="w-full h-12">
                                <button
                                    onclick="addToShoppingCart(this,'{{ $product->id }}', '{{ $product->title }}', '{{ $product->description }}', '{{ $product['img'] }}', '{{ $product->price['price'] }}')"
                                    class="w-full h-full py-3 lg:py-1 text-[12px] text-(--color-primary-text) bg-(--color-bg-card-btn) leading-5 rounded-[10px] cursor-pointer">افزودن
                                    به سبد خرید</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
