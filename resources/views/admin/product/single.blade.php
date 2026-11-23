@extends('app.document')

@section('title')
    طبابوک | {{ $product->title }}
@endsection

@section('content')
    <!-- breadcrumb -->
    <section
        class="w-11/12 mx-auto lg:mb-5 py-5 flex flex-row justify-between items-center text-[#beb1d6] text-xs lg:text-sm mt-5">
        <nav class="flex flex-row items-center text-xs lg:text-base">
            <div>
                <a href="{{ route('home') }}" class="leading-[2.17]">
                    <span class="border-b border-[#beb1d6] lg:border-none text-(--pastel-purple)">طبابوک</span>
                    <span class="mx-3 text-(--primary-text-color)">/</span>
                </a>
            </div>

            <div>
                @if ($category)
                    <form action="{{ route('search.page') }}" method="POST" class="leading-[2.17]">
                        @csrf
                        <input type="hidden" name="categoryId" value="{{ $category->id }}">
                        <button type="submit"
                            class="border-b border-[#beb1d6] lg:border-none text-(--pastel-purple) cursor-pointer">
                            {{ $category->title }}
                        </button>
                        <span class="mx-3 text-(--primary-text-color)">/</span>
                    </form>
                @else
                    <span class="leading-[2.17] text-(--pastel-purple)">
                        بدون دسته بندی
                        <span class="mx-3 text-(--primary-text-color)">/</span>
                    </span>
                @endif
            </div>

            <div>
                <a href="{{ route('product.show', $product->id) }}" class="leading-[2.17]">
                    <span class="border-b border-[#beb1d6] lg:border-none text-(--pastel-purple)">
                        {{ $product->title }}
                    </span>
                </a>
            </div>
        </nav>
    </section>
    <!-- /breadcrumb -->

    <!-- single product -->
    <section class="w-11/12 text-(--primary-text-color) mx-auto">
        <div class="flex flex-col lg:flex-row">

            <!-- gallery -->
            <div class="lg:ml-4 shrink-0 lg:w-[36%] overflow-hidden">
                <div class="flex flex-col items-center lg:items-start lg:max-w-[368px] xl:max-w-[580px]">
                    <div
                        class="w-full h-[250px] lg:h-[432px] flex justify-center items-center cursor-pointer bg-(--cream-color) lg:bg-white">
                        <img class="gallery_pack_single_primary_img w-full h-full object-cover rounded-lg" id="mainImage"
                            src="{{ $mainImage }}" alt="{{ $product->title }}">
                    </div>

                    @if ($galleryMedia->isNotEmpty())
                        <div class="w-full overflow-x-auto touch-pan-x" style="scrollbar-width:none;">
                            <div class="flex flex-row items-center mt-5 mb-3">
                                @foreach ($galleryMedia as $media)
                                    <div class="cursor-pointer rounded border border-(--color-border) p-1 ml-2 gallery">
                                        <div class="w-[72px] h-[72px] gallery_pack_single">
                                            <img class="size-full object-cover" loading="lazy"
                                                src="{{ asset('storage/' . $media->media_path) }}"
                                                alt="{{ $product->title }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /gallery -->
            <div class="grow min-w-0 flex flex-row gap-3">

                <!-- product info -->
                <div class="w-full lg:w-1/2 xl:w-7/12">
                    <h1
                        class="text-base xl:text-3xl text-(--primary-text-color) font-bold mt-3 mb-2 pointer-events-none px-2 lg:px-0">
                        {{ $product->title }}
                    </h1>
                    @if ($product->brand)
                        <div class="lg:pb-5 mb-5 lg:border-b border-(--color-border) px-2 lg:px-0">
                            <span class="text-xs text-[#beb1d6]">{{ $product->brand }}</span>
                        </div>
                    @endif
                    @if (!empty($product->product_features))
                        <div class="mt-5 space-y-4" id="productFeatureSelector">
                            <div>
                                <h3 class="font-bold text-sm">انتخاب ویژگی‌های محصول</h3>
                                <p class="text-xs text-[#9B91A9] mt-1">برای مشاهده گزینه‌های بعدی، ابتدا یک مورد را انتخاب کنید.</p>
                            </div>
                            <div id="productFeatureLevels" class="space-y-4"></div>
                            <p id="featureSelectionHint" class="text-xs text-[#9B91A9]">لطفاً ویژگی‌های محصول را انتخاب کنید.</p>
                        </div>
                    @endif
                    @if (count($product->attributes) > 0)
                        <div class="w-full pb-3 lg:pb-0 border-b border-(--color-border) lg:border-none px-2 lg:px-0">
                            <h3 class="text-lg font-bold py-3 hidden lg:block">ویژگی ها</h3>
                            <h3 class="text-base font-bold py-3 lg:hidden flex flex-row justify-between items-center">
                                <span>ویژگی ها</span>
                                <a href="#phoneDetails" class="text-xs flex flex-row items-center">
                                    <span>مشاهده همه</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </a>
                            </h3>

                            <ul class="w-full flex flex-row items-center lg:grid lg:grid-cols-3 gap-1 overflow-x-auto"
                                style="scrollbar-width:none;">
                                @foreach ($product->attributes as $attr)
                                    @if ($product->attributes[0] !== $attr)
                                        <li class="w-fit lg:w-full bg-(--cream-color) p-2 rounded-md h-full">
                                            <div class="flex flex-row items-center">
                                                <p class="text-sm text-[var(--primary-text-color-secondary)]">
                                                    {{ $attr['key'] }}
                                                </p>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3 mr-2 lg:hidden"
                                                    viewBox="0 0 320 512">
                                                    <path fill="var(--color-fill)"
                                                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                                </svg>
                                            </div>
                                            <p class="text-sm text-(--primary-text-color) font-bold">
                                                {{ $attr['value'] }}
                                            </p>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="hidden lg:flex flex-row gap-4 justify-center items-center mt-4">
                            <hr class="border-t border-(--color-border) w-1/6 xl:w-full">
                            <a href="#attrDesktop"
                                class="px-4 py-2 rounded-md flex flex-row gap-2 items-center justify-center border border-(--color-border) cursor-pointer w-4/6 xl:w-full">
                                <span class="text-(--primary-text-color) text-sm font-bold w-[120px]">مشاهده ویژگی ها</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                    <path fill="var(--color-fill)"
                                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                </svg>
                            </a>
                            <hr class="border-t border-(--color-border) w-1/6 xl:w-full">
                        </div>
                    @endif

                    @if ($product->summary)
                        <div class="my-3 hidden lg:flex flex-row gap-2">
                            <span
                                class="size-[18px] shrink-0 flex justify-center items-center bg-(--pastel-purple) rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[18px] fill-white"
                                    viewBox="0 0 192 512">
                                    <path
                                        d="M64 64a32 32 0 1 1 64 0A32 32 0 1 1 64 64zM16 176c0-8.8 7.2-16 16-16H96c8.8 0 16 7.2 16 16V448h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H16c-8.8 0-16-7.2-16-16s7.2-16 16-16H80V192H32c-8.8 0-16-7.2-16-16z" />
                                </svg>
                            </span>
                            <p class="text-sm leading-[2.15] text-[#beb1d6] text-justify">
                                {{ $product->summary }}
                            </p>
                        </div>
                    @endif
                </div>
                <!-- /product info -->

                <!-- buy box (desktop) -->
                <div class="hidden lg:block lg:w-1/2 xl:w-5/12">
                    <div class="sticky top-10">
                        <div class="bg-(--second-cream-color) rounded-md p-5 text-(--primary-text-color) cart_shdow">
                            <h3 class="pb-2 font-medium">فروشنده</h3>

                            <div class="flex flex-row items-start gap-4 py-4 border-b border-(--color-border)">
                                <div class="size-6 rounded-full bg-(--discount-color) mt-[5px]"></div>
                                <h3 class="leading-[2.15] mb-1">طبابوک</h3>
                            </div>

                            <div class="py-4 products" data-product-id="{{ $product->id }}">
                                <div class="flex flex-row justify-end mb-3" id="priceBox">
                                    <div class="text-left">
                                        <div class="hidden flex-row items-end gap-3 secondary-price" id="featureOldPriceWrap">
                                            <span class="text-xs text-[#beb1d6] line-through in-fa abolished" id="featureOldPrice"></span>
                                            <span class="hidden px-2 leading-[1.9] bg-[var(--color-discount-bg)] text-(--discount-color-text) text-xs font-medium rounded-full percent in-fa" id="featureDiscount"></span>
                                        </div>
                                        <div class="flex flex-row gap-1 mt-1 items-end">
                                            <span class="text-lg font-bold in-fa mainPrice" id="featureMainPrice">{{ number_format($product->secondary_price ?: $product->primary_price) }}</span>
                                            <span class="text-xs pb-1.5">تومان</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-12 addToCartBtns" data-product-id="{{ $product->id }}"
                                    data-count="{{ $product->count ?? 0 }}" data-feature-value-id="" data-cart-key="">
                                    <button type="button" {{ ($product->count ?? 0) < 1 ? 'disabled' : '' }} onclick="addToCart(this)" data-product-id="{{ $product->id }}"
                                        class="w-full px-2 h-full transition-all duration-300 {{ ($product->count ?? 0) < 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-(--green-btn) group cursor-pointer' }} bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl">
                                        <span class="text-sm text-(--primary-text-color) font-bold">{{ ($product->count ?? 0) < 1 ? 'ناموجود' : 'افزودن به سبد خرید' }}</span>
                                    </button>
                                </div>
                                <p class="text-xs text-rose-500 mt-2 hidden" data-feature-stock-message></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /buy box (desktop) -->

            </div>
        </div>
    </section>
    <!-- /single product -->

    <!-- specifications table (mobile) -->
    @if (count($product->attributes) > 0)
        <section class="w-11/12 mx-auto lg:hidden text-(--primary-text-color)" id="phoneDetails">
            <div class="py-5 px-2">
                <h3 class="text-lg font-bold leading-[180%] mb-4">جدول مشخصات</h3>
                @foreach ($product->attributes as $attribute)
                    @if ($attribute['key'] !== 'رنگ')
                        <div class="flex flex-row border-b border-(--color-border)">
                            <div class="w-1/4 p-1 text-[10px] bg-[var(--color-secondary-bg)] leading-[180%]">
                                {{ $attribute['key'] }}
                            </div>
                            <div class="w-3/4 p-1 text-[10px] leading-[180%]">
                                {{ $attribute['value'] }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif
    <!-- /specifications table (mobile) -->

    <!-- description -->
    @if ($product->description)
        <section class="w-11/12 mx-auto text-(--primary-text-color) mt-4 lg:pb-10">
            <div class="hidden lg:block sticky top-0 bg-white">
                <div class="flex flex-row border-b border-(--color-border)">
                    <span
                        class="text-sm font-medium leading-[180%] py-2 px-4 text-(--discount-color) border-b-4 border-(--discount-color) rounded-b-sm">
                        معرفی
                    </span>
                </div>
            </div>
            <div class="py-3">
                {{-- محتوا HTML خام است؛ مطمئن شو در پنل ادمین sanitize می‌شود --}}
                {!! $product->description !!}
            </div>
        </section>
    @endif
    <!-- /description -->

    <!-- specifications table (desktop) -->
    @if (count($product->attributes) > 0)
        <section class="w-11/12 mx-auto text-(--primary-text-color) mt-4 pb-28 lg:pb-10 hidden lg:block">
            <div class="sticky top-0 bg-white z-[555]">
                <div class="flex flex-row border-b border-(--color-border)">
                    <span
                        class="text-sm font-medium leading-[180%] py-2 px-4 text-(--discount-color) border-b-4 border-(--discount-color) rounded-b-sm">
                        مشخصات
                    </span>
                </div>
            </div>

            <div class="2xl:w-9/12 w-full mt-4">
                <div class="py-3">
                    <h2 class="font-bold leading-[2.17]">مشخصات</h2>
                    <div class="w-[70px] h-0.5 bg-(--discount-color) mt-2"></div>
                </div>

                <div class="mt-4 pt-4 flex flex-row items-start" id="attrDesktop">
                    <div class="w-1/4">
                        <h2 class="font-bold leading-[2.17]">مشخصات کلی</h2>
                    </div>
                    <div class="w-3/4">
                        @foreach ($product->attributes as $attribute)
                            @if ($attribute['key'] !== 'رنگ')
                                <div class="flex flex-row items-start">
                                    <div class="w-1/4 text-[#beb1d6] text-sm py-3 leading-[2.17]">
                                        {{ $attribute['key'] }}
                                    </div>
                                    <div
                                        class="w-3/4 text-sm py-3 leading-[2.17] {{ $loop->last ? '' : 'border-b border-(--color-border)' }}">
                                        {{ $attribute['value'] }}
                                    </div>
                                </div>  
                            @endif  
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- /specifications table (desktop) -->

    <!-- login popup -->
    <div class="w-full h-svh bg-black/30 transition-all duration-300 fixed top-0 right-0 z-[22222] pt-[5%] opacity-0 invisible"
        id="login">
        <div class="size-full relative">
            <div class="absolute size-10 right-[30%] -top-[10%] cursor-pointer bg-white rounded-full flex flex-row justify-center items-center"
                onclick="login('close')">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 384 512">
                    <path fill="var(--color-fill)"
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </div>

            <div class="kt-card max-w-[370px] m-auto transition-all duration-300 opacity-0 scale-75">
                <form action="{{ route('user.check') }}" method="post" class="flex flex-col gap-5 p-10 bg-white">
                    @csrf
                    <div class="text-center mb-2.5">
                        <h3 class="text-lg font-medium text-mono leading-none mb-2.5">ورود</h3>
                        <div class="flex items-center justify-center">
                            <span class="text-sm text-secondary-foreground me-1.5">اکانت ندارید؟</span>
                            <a href="{{ route('user.store') }}" class="text-sm">ثبت نام</a>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5">
                        <a href="#" class="kt-btn kt-btn-outline flex items-center justify-center">
                            <img src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/google.svg"
                                class="size-3.5 shrink-0" alt="Google">
                            استفاده از گوگل
                        </a>
                        <a href="#" class="kt-btn kt-btn-outline flex items-center justify-center">
                            <img src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/apple-black.svg"
                                class="size-3.5 shrink-0" alt="Apple">
                            استفاده از اپل
                        </a>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="border-t border-[#eeeaeb] w-full"></span>
                        <span class="text-xs text-[#1b1718] uppercase">یا</span>
                        <span class="border-t border-[#eeeaeb] w-full"></span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="phoneNumber" class="kt-form-label text-[#0b0809]">شماره تلفن</label>
                        <input type="tel" inputmode="numeric" name="phoneNumber" id="phoneNumber" class="kt-input"
                            placeholder="09141234567" required>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password" class="kt-form-label text-[#0b0809]">گذرواژه</label>
                        <input type="password" name="password" id="password" class="kt-input outline-none" required>
                    </div>

                    <div class="flex flex-row justify-start items-center">
                        <span class="text-sm text-[#0b0809] mr-2 flex flex-row justify-start items-center">
                            گذرواژه خود را
                            <a href="#" class="text-blue-500 mr-1">فراموش کردم</a>
                        </span>
                    </div>

                    <button type="submit"
                        class="py-1.5 rounded-md text-white text-sm font-bold bg-[#2b7fff] cursor-pointer hover:bg-[#2b7fff]/90">
                        ورود
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /login popup -->

    <!-- buy bar (mobile) -->
    <div class="w-full px-2 py-3 bg-white fixed bottom-0 right-0 lg:hidden border-t border-(--color-border) text-(--primary-text-color) z-40">
        <div class="flex flex-row justify-between items-center py-2 gap-3">
            <div class="w-1/2 h-12 addToCartBtns" data-product-id="{{ $product->id }}"
                data-count="{{ $product->count ?? 0 }}" data-feature-value-id="" data-cart-key="">
                <button type="button" {{ ($product->count ?? 0) < 1 ? 'disabled' : '' }} onclick="addToCart(this)" data-product-id="{{ $product->id }}"
                    class="w-full px-2 h-full transition-all duration-300 {{ ($product->count ?? 0) < 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-(--green-btn) group cursor-pointer' }} bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl">
                    <span class="text-[10px] text-(--primary-text-color) font-bold">{{ ($product->count ?? 0) < 1 ? 'ناموجود' : 'افزودن به سبد خرید' }}</span>
                </button>
            </div>
            <div class="flex flex-row items-center gap-2 text-sm" id="footer-price">
                <span class="hidden font-bold text-xs text-gray-400 in-fa line-through abolished" id="mobileOldPrice"></span>
                <span class="font-bold in-fa mainPrice" id="mobileMainPrice">{{ number_format($product->secondary_price ?: $product->primary_price) }}</span>
                <span class="font-medium text-xs">تومان</span>
            </div>
        </div>
    </div>
    <!-- /buy bar (mobile) -->


    <script>
        window.productId = @json((string) $product->id);
        window.productFeatureTree = @json($product->product_features ?? []);

        document.querySelectorAll('.gallery').forEach(item => {
            item.addEventListener('click', () => {
                const image = item.querySelector('img');
                const main = document.getElementById('mainImage');
                if (image && main) main.src = image.src;
            });
        });

        (() => {
            const tree = Array.isArray(window.productFeatureTree) ? window.productFeatureTree : [];
            const levels = document.getElementById('productFeatureLevels');
            const hint = document.getElementById('featureSelectionHint');
            const selectorExists = !!levels;
            const selectedPath = [];
            let selectedLeaf = null;

            const money = value => Number(value || 0).toLocaleString('fa-IR');
            const getValues = feature => Array.isArray(feature?.values) ? feature.values : [];
            const getChildren = value => Array.isArray(value?.children) ? value.children : [];
            const isDefaultValue = value =>
                value?.is_default === true ||
                value?.is_default === 1 ||
                value?.is_default === '1' ||
                value?.isDefault === true ||
                value?.isDefault === 1 ||
                value?.isDefault === '1';

            /**
             * از یک مقدار انتخاب‌شده، زنجیره پیش‌فرض‌ها را تا ترکیب نهایی دنبال می‌کند.
             * در این ساختار هر مقدار باید حداکثر یک ویژگی فرزند داشته باشد تا
             * قیمت و موجودی یک ترکیب نهایی به‌صورت قطعی قابل تشخیص باشد.
             */
            function resolveDefaultLeaf(value) {
                if (!value) return null;

                let currentValue = value;
                let safety = 0;

                while (getChildren(currentValue).length) {
                    if (++safety > 100) return null;

                    const childFeatures = getChildren(currentValue);

                    // اگر چند ویژگی مستقل زیر یک مقدار وجود داشته باشد،
                    // انتخاب یک مسیر پیش‌فرض واحد از روی این ساختار ممکن نیست.
                    if (childFeatures.length !== 1) return null;

                    const childFeature = childFeatures[0];
                    const defaults = getValues(childFeature).filter(isDefaultValue);

                    if (defaults.length !== 1) return null;

                    currentValue = defaults[0];
                }

                return currentValue;
            }

            function markOptionSelected(option) {
                if (!option) return;

                const siblings = option.parentElement?.children || [];
                [...siblings].forEach(element => {
                    element.classList.remove('border-(--pastel-purple)', 'bg-(--cream-color)', 'font-bold');
                    element.classList.add('border-(--color-border)');
                });

                option.classList.remove('border-(--color-border)');
                option.classList.add('border-(--pastel-purple)', 'bg-(--cream-color)', 'font-bold');
            }

            function updatePrice(value) {
                const primary = Number(value?.original_price || 0);
                const special = Number(value?.special_price || 0);
                const hasDiscount = special > 0 && primary > special;
                const finalPrice = hasDiscount ? special : primary;
                const oldWrap = document.getElementById('featureOldPriceWrap');
                const oldPrice = document.getElementById('featureOldPrice');
                const discount = document.getElementById('featureDiscount');
                const main = document.getElementById('featureMainPrice');
                const mobileOld = document.getElementById('mobileOldPrice');
                const mobileMain = document.getElementById('mobileMainPrice');

                if (main) main.textContent = money(finalPrice);
                if (mobileMain) mobileMain.textContent = money(finalPrice);
                if (oldWrap) oldWrap.classList.toggle('hidden', !hasDiscount);
                if (oldWrap) oldWrap.classList.toggle('flex', hasDiscount);
                if (oldPrice) oldPrice.textContent = money(primary);

                if (mobileOld) {
                    mobileOld.textContent = money(primary);
                    mobileOld.classList.toggle('hidden', !hasDiscount);
                }

                if (discount) {
                    discount.textContent = hasDiscount
                        ? Math.round((1 - special / primary) * 100).toLocaleString('fa-IR') + '٪'
                        : '';
                    discount.classList.toggle('hidden', !hasDiscount);
                }
            }

            function updateCartControls(value, path = []) {
                selectedLeaf = value;
                const isLeaf = !!value && getChildren(value).length === 0;
                const stock = isLeaf ? Number(value.count || 0) : 0;
                const valueId = isLeaf ? value.id : '';
                const cartKey = isLeaf ? `${window.productId}:${valueId}` : '';
                const selectedFeatures = isLeaf ? path : [];

                document.querySelectorAll('.addToCartBtns').forEach(control => {
                    // کنترل قبلی ممکن است از دکمه افزودن به کنترل تعداد (+ / -) تبدیل شده باشد.
                    // هر بار بر اساس ترکیب فعلی، کل محتوای کنترل را از نو و با ساختار درست می‌سازیم.
                    if (isLeaf) {
                        let cartProducts = [];
                        try {
                            cartProducts = JSON.parse(localStorage.getItem('products') || '[]');
                            if (!Array.isArray(cartProducts)) cartProducts = [];
                        } catch (error) {
                            cartProducts = [];
                        }

                        const inCart = cartProducts.find(product => {
                            const key = typeof getProductCartKey === 'function'
                                ? getProductCartKey(product)
                                : (product.cart_key || (product.feature_value_id
                                    ? `${product.id}:${product.feature_value_id}`
                                    : `product:${product.id}`));
                            return String(key) === String(cartKey);
                        });

                        if (inCart && typeof renderProductQuantityControl === 'function') {
                            renderProductQuantityControl(control, inCart);
                        } else if (typeof restoreProductAddButton === 'function') {
                            restoreProductAddButton(control);
                        } else {
                            control.innerHTML = `
                                <button type="button" onclick="addToCart(this)" class="w-full px-4 h-full bg-(--light-green-btn) flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 hover:bg-(--green-btn) group">
                                    <span class="text-sm font-bold">افزودن به سبد خرید</span>
                                </button>
                            `;
                        }
                    } else {
                        if (typeof restoreProductAddButton === 'function') {
                            restoreProductAddButton(control);
                        }
                    }

                    control.dataset.productId = String(window.productId);
                    control.dataset.featureValueId = isLeaf ? String(valueId) : '';
                    control.dataset.cartKey = cartKey;
                    control.dataset.count = String(stock);
                    control.dataset.originalPrice = isLeaf && value.original_price != null ? String(value.original_price) : '';
                    control.dataset.specialPrice = isLeaf && value.special_price != null ? String(value.special_price) : '';
                    control.dataset.selectedFeatures = JSON.stringify(selectedFeatures);

                    // موجودی ترکیب انتخابی ممکن است با مقداری که قبلاً در localStorage ذخیره شده متفاوت باشد.
                    // وضعیت دکمه + را با موجودی فعلی همین ترکیب همگام می‌کنیم.
                    const quantityControl = control.querySelector('input[type="number"]');
                    const plusButton = control.querySelector('button[data-state="+"]');
                    if (quantityControl && plusButton) {
                        const currentQuantity = Number(quantityControl.value || 0);
                        const reachedStock = stock < 1 || currentQuantity >= stock;
                        plusButton.disabled = reachedStock;
                        plusButton.classList.toggle('cursor-no-drop', reachedStock);
                        plusButton.classList.toggle('opacity-50', reachedStock);
                        plusButton.classList.toggle('cursor-pointer', !reachedStock);
                    }

                    // اگر این ترکیب قبلاً به سبد اضافه شده، کنترل تعداد را دست‌کاری نکن؛
                    // چون دکمه‌های + و - داخل آن هستند و نباید متن افزودن جایگزینشان شود.
                    const quantityInput = control.querySelector('input[type="number"]');
                    if (quantityInput) return;

                    const button = control.querySelector('button');
                    if (!button) return;

                    button.disabled = !isLeaf || stock < 1;
                    button.classList.toggle('opacity-50', !isLeaf || stock < 1);
                    button.classList.toggle('cursor-not-allowed', !isLeaf || stock < 1);

                    button.innerHTML = !isLeaf
                        ? '<span class="text-xs font-bold">ابتدا زیرمجموعه را انتخاب کنید</span>'
                        : stock < 1
                            ? '<span class="text-xs font-bold">ناموجود</span>'
                            : '<span class="text-sm font-bold">افزودن به سبد خرید</span>';

                    if (isLeaf && stock > 0) button.setAttribute('onclick', 'addToCart(this)');
                    else button.removeAttribute('onclick');
                });

                document.querySelectorAll('[data-feature-stock-message]').forEach(stockMessage => {
                    stockMessage.textContent = isLeaf
                        ? (stock > 0
                            ? `موجودی: ${stock.toLocaleString('fa-IR')} عدد`
                            : 'این ترکیب در حال حاضر موجود نیست.')
                        : '';
                    stockMessage.classList.toggle('hidden', !isLeaf);
                });

                if (isLeaf) updatePrice(value);
            }

            function renderFeature(feature, depth) {
                if (!feature || !levels) return;

                const values = getValues(feature);
                if (!values.length) return;

                const wrapper = document.createElement('section');
                wrapper.className = 'space-y-2';

                const title = document.createElement('h4');
                title.className = 'text-sm font-semibold';
                title.textContent = feature.name || feature.title || 'انتخاب ویژگی';
                wrapper.appendChild(title);

                const options = document.createElement('div');
                options.className = 'flex flex-wrap gap-2';

                values.forEach(value => {
                    const option = document.createElement('button');
                    option.type = 'button';
                    option.className = 'rounded-lg border border-(--color-border) px-3 py-2 text-xs transition hover:border-(--pastel-purple)';
                    option.dataset.valueId = String(value.id ?? '');
                    option.dataset.featureDepth = String(depth);
                    option.textContent = value.name || value.title || '—';

                    option.addEventListener('click', () => {
                        selectedPath.splice(depth);
                        selectedPath.push({
                            feature: feature.name || feature.title || '',
                            value: value.name || value.title || '',
                            id: value.id
                        });

                        markOptionSelected(option);

                        while (levels.children.length > depth + 1) {
                            levels.lastElementChild.remove();
                        }

                        const children = getChildren(value);

                        if (children.length) {
                            children.forEach(childFeature => renderFeature(childFeature, depth + 1));

                            const defaultLeaf = resolveDefaultLeaf(value);
                            if (defaultLeaf) {
                                const defaultPath = [...selectedPath];
                                let currentValue = value;
                                let defaultDepth = depth + 1;

                                while (getChildren(currentValue).length) {
                                    const childFeature = getChildren(currentValue)[0];
                                    const defaultValue = getValues(childFeature).find(isDefaultValue);
                                    if (!defaultValue) break;

                                    defaultPath.push({
                                        feature: childFeature.name || childFeature.title || '',
                                        value: defaultValue.name || defaultValue.title || '',
                                        id: defaultValue.id,
                                        is_default: true
                                    });

                                    const defaultOption = [...levels.querySelectorAll('[data-feature-depth]')]
                                        .find(element =>
                                            element.dataset.featureDepth === String(defaultDepth) &&
                                            element.dataset.valueId === String(defaultValue.id)
                                        );

                                    markOptionSelected(defaultOption);
                                    defaultDepth++;
                                    currentValue = defaultValue;
                                }

                                selectedPath.splice(0, selectedPath.length, ...defaultPath);
                                updateCartControls(defaultLeaf, defaultPath);
                                if (hint) {
                                    hint.textContent = 'قیمت و موجودی بر اساس زیرشاخه پیش‌فرض محاسبه شده است؛ در صورت تمایل می‌توانید گزینه دیگری انتخاب کنید.';
                                }
                            } else {
                                updateCartControls(null);
                                if (hint) hint.textContent = 'برای مشاهده قیمت و موجودی، زیرشاخه را انتخاب کنید.';
                            }
                        } else {
                            updateCartControls(value, [...selectedPath]);
                            if (hint) hint.textContent = 'ترکیب موردنظر انتخاب شد.';
                        }
                    });

                    options.appendChild(option);
                });

                wrapper.appendChild(options);
                levels.appendChild(wrapper);
            }

            if (selectorExists && tree.length) {
                tree.forEach(feature => renderFeature(feature, 0));

                // ویژگی ریشه is_default ندارد؛ بنابراین اولین مقدار ریشه
                // به‌عنوان شاخه آغازین انتخاب می‌شود و زنجیره is_default
                // در تمام ویژگی‌های فرزند تا ترکیب نهایی دنبال خواهد شد.
                const firstRootFeature = tree[0];
                const firstRootValue = getValues(firstRootFeature)[0];

                if (firstRootValue) {
                    const firstRootOption = [...levels.querySelectorAll('[data-feature-depth="0"]')]
                        .find(element => element.dataset.valueId === String(firstRootValue.id));

                    if (firstRootOption) {
                        firstRootOption.click();
                    } else {
                        updateCartControls(null);
                    }
                } else {
                    updateCartControls(null);
                }
            } else if (selectorExists) {
                document.getElementById('productFeatureSelector')?.classList.add('hidden');
            } else {
                // محصول ساده: موجودی صفر از همان ابتدا دکمه افزودن را غیرفعال می‌کند.
                document.querySelectorAll('.addToCartBtns').forEach(control => {
                    const stock = Number(control.dataset.count || 0);
                    const button = control.querySelector('button');
                    if (!button) return;
                    if (stock < 1) {
                        button.disabled = true;
                        button.removeAttribute('onclick');
                        button.classList.add('opacity-50', 'cursor-not-allowed');
                        button.classList.remove('cursor-pointer', 'hover:bg-(--green-btn)', 'group');
                        button.innerHTML = '<span class="text-xs font-bold">ناموجود</span>';
                    }
                });
            }
        })();
    </script>
@endsection
