<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>فروشگاه | جستجوی محصولات</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <script src="{{ asset('js/filters.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body class="m-0 bg-[#f7f7f8] text-[#3f3f46]">

    <div class="h-[38px] bg-white border-b border-[#e4e4e7] flex items-center justify-center text-[#71717a] text-xs">
        ارسال رایگان برای سفارش‌های بالای ۱ میلیون تومان
    </div>

    <header class="bg-white sticky top-0 z-20 shadow-[0_2px_10px_rgba(0,0,0,.04)]">
        <div
            class="max-w-[1280px] min-h-[78px] mx-auto flex flex-wrap items-center gap-2.5 md:gap-[22px] px-3.5 md:px-5 py-2.5">
            <div class="text-[21px] md:text-[26px] font-extrabold text-[#ef394e] whitespace-nowrap">طبابوک</div>

            <div
                class="search flex-1 basis-full md:basis-auto order-3 md:order-none relative max-w-none md:max-w-[760px]">
                <span class="absolute right-[18px] top-1/2 -translate-y-1/2 text-[#71717a] text-xl">⌕</span>
                <input id="searchInput" type="search"
                    class="w-full h-[50px] border-0 outline-none rounded-[10px] bg-[#f1f2f4] focus:bg-white focus:shadow-[0_0_0_2px_rgba(239,57,78,.15)] pr-[52px] pl-[50px] text-sm"
                    placeholder="جستجو در محصولات، برندها و دسته‌ها..." autocomplete="off">
                <button id="clearSearch"
                    class="hidden absolute left-[14px] top-1/2 -translate-y-1/2 border-0 bg-transparent text-[#888] text-xl">×</button>
            </div>

            <button
                class="h-11 border border-[#e4e4e7] bg-white rounded-[9px] px-[15px] text-[#333] whitespace-nowrap mr-auto md:mr-0">
                ورود | ثبت‌نام
            </button>
            <button class="border-0 bg-transparent text-[22px] relative" aria-label="سبد خرید">
                🛒<span
                    class="absolute -top-1.5 -right-1.5 w-[18px] h-[18px] rounded-full bg-[#ef394e] text-white text-[10px] grid place-items-center">2</span>
            </button>
        </div>

        <nav class="hidden md:block border-t border-[#fafafa]">
            <div class="max-w-[1280px] mx-auto px-5 h-[46px] flex items-center gap-[25px] text-[13px] text-[#52525b]">
                <a href="#" class="hover:text-[#ef394e]">دسته‌بندی کالاها</a>
                <a href="#" class="hover:text-[#ef394e]">پیشنهاد شگفت‌انگیز</a>
                <a href="#" class="hover:text-[#ef394e]">پرفروش‌ترین‌ها</a>
                <a href="#" class="hover:text-[#ef394e]">تخفیف‌ها</a>
                <a href="#" class="hover:text-[#ef394e]">سوپرمارکت</a>
            </div>
        </nav>
    </header>

    <main class="max-w-[1280px] mx-auto my-4 md:my-6 px-3 md:px-5">
        <div class="text-[#71717a] text-xs mb-[18px]">خانه / <b class="text-[#333]">جستجو</b></div>

        <div class="flex items-end justify-between gap-2.5 mb-[18px]">
            <div>
                <h1 id="title" class="m-0 text-[18px] md:text-[22px]">نتایج جستجو برای «گوشی»</h1>
                <div id="resultCount" class="text-[#71717a] text-[13px]"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-[250px_1fr] gap-[18px]">
            <aside class="hidden md:block bg-white border border-[#e4e4e7] rounded-xl h-max overflow-hidden">
                <div class="flex justify-between p-[18px] border-b border-[#e4e4e7] font-bold">
                    <span>فیلترها</span>
                    <button id="resetFilters" class="text-[#ef394e] border-0 bg-transparent text-xs">حذف
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

                {{-- <section class="p-[18px] border-b border-[#e4e4e7]">
                    <div class="font-semibold text-sm mb-[15px]">امتیاز کاربران</div>
                    <label class="flex items-center gap-2 my-3 text-[13px] text-[#52525b]"><input
                            class="accent-[#ef394e] w-[17px] h-[17px]" type="radio" name="rating" value="4"> ۴
                        به بالا ⭐</label>
                    <label class="flex items-center gap-2 my-3 text-[13px] text-[#52525b]"><input
                            class="accent-[#ef394e] w-[17px] h-[17px]" type="radio" name="rating" value="3"> ۳
                        به بالا ⭐</label>
                    <label class="flex items-center gap-2 my-3 text-[13px] text-[#52525b]"><input
                            class="accent-[#ef394e] w-[17px] h-[17px]" type="radio" name="rating" value="0"
                            checked> همه</label>
                </section> --}}

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
                            class="sort-btn text-xs border-0 bg-[#fff0f2] text-[#ef394e] font-bold px-2.5 py-2 rounded-[7px]"
                            data-sort="relevance">مرتبط‌ترین</button>
                        <button
                            class="sort-btn text-xs border-0 bg-transparent text-[#52525b] px-2.5 py-2 rounded-[7px]"
                            data-sort="popular">پربازدیدترین</button>
                        <button
                            class="sort-btn text-xs border-0 bg-transparent text-[#52525b] px-2.5 py-2 rounded-[7px]"
                            data-sort="cheap">ارزان‌ترین</button>
                        <button
                            class="sort-btn text-xs border-0 bg-transparent text-[#52525b] px-2.5 py-2 rounded-[7px]"
                            data-sort="expensive">گران‌ترین</button>
                        <button
                            class="sort-btn text-xs border-0 bg-transparent text-[#52525b] px-2.5 py-2 rounded-[7px]"
                            data-sort="newest">جدیدترین</button>
                    </div>
                    <button id="viewToggle"
                        class="border border-[#e4e4e7] bg-white rounded-[7px] w-9 h-[34px] self-end md:self-auto">▦</button>
                </div>

                <div id="chips" class="flex gap-2 flex-wrap mb-3.5"></div>

                <div id="products"
                    class="grid grid-cols-1 min-[431px]:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 bg-white border border-[#e4e4e7] rounded-xl overflow-hidden">
                    <article
                        class="group relative min-w-0 bg-white p-[17px] border-l border-b border-[#e4e4e7] transition duration-200 hover:-translate-y-0.5 hover:shadow-[0_6px_22px_rgba(0,0,0,.08)]">
                        <span
                            class="absolute top-[25px] right-[25px] z-10 bg-[#ef394e] text-white rounded-[5px] text-[10px] px-[7px] py-1">5٪</span>
                        <button onclick="toggleFav(5)"
                            class="absolute top-[22px] left-5 z-10 border-0 bg-white text-xl text-[#aaa]">♡</button>
                        <img src=""
                            alt="گوشی موبایل اپل iPhone 15 ظرفیت 128 گیگابایت" loading="lazy"
                            onerror=""
                            class="w-full aspect-square object-contain rounded-lg bg-[#f8f8f8] block mb-3.5">
                        <h3 class="m-0 mb-2.5 text-[13px] leading-[1.9] h-[50px] overflow-hidden">گوشی موبایل اپل
                            iPhone 15 ظرفیت 128 گیگابایت</h3>
                        <div class="flex justify-between items-center mb-2.5 text-[11px]">
                            <span>۴٫۹ ⭐</span><span class="text-[#f59e0b]">★★★★★</span>
                        </div>
                        <div class="flex items-center justify-between gap-2">
                            <strong class="text-[15px]">۵۱٬۹۹۰٬۰۰۰</strong><span
                                class="text-[10px] text-[#71717a]">تومان</span>
                        </div>
                        <div class="line-through text-[#a1a1aa] text-[10px]">۵۴٬۹۹۰٬۰۰۰ تومان</div>
                        <div class="mt-2.5 text-[10px] text-[#16a34a]">● موجود در انبار</div>
                    </article>
                </div>

                <div id="empty"
                    class="hidden bg-white border border-[#e4e4e7] rounded-xl text-center p-[70px_20px]">
                    <div class="text-[45px]">🔎</div>
                    <h2 class="text-lg">محصولی پیدا نشد</h2>
                    <p class="text-[13px] text-[#777]">عبارت جستجو یا فیلترها را تغییر دهید و دوباره امتحان کنید.</p>
                </div>

                <div id="pagination" class="flex justify-center gap-1.5 my-[22px] mb-10">
                    <button class="page w-[38px] h-[38px] border border-[#e4e4e7] bg-white rounded-lg">‹</button>
                    <button
                        class="page active w-[38px] h-[38px] border border-[#ef394e] bg-[#ef394e] text-white rounded-lg">۱</button>
                    <button class="page w-[38px] h-[38px] border border-[#e4e4e7] bg-white rounded-lg">۲</button>
                    <button class="page w-[38px] h-[38px] border border-[#e4e4e7] bg-white rounded-lg">۳</button>
                    <button class="page w-[38px] h-[38px] border border-[#e4e4e7] bg-white rounded-lg">۴</button>
                    <button class="page w-[38px] h-[38px] border border-[#e4e4e7] bg-white rounded-lg">›</button>
                </div>
            </section>
        </div>
    </main>
    <script>
        let url = "{{ url('/') }}/"
        let api = "{{ url('api/') }}/"
        let imgPath = "{{ asset('storage/') }}/"
    </script>
    <script src="{{ asset('js/filterStore.js') }}"></script>
    <script>
        // /*
        // |--------------------------------------------------------------------------
        // | Laravel / API configuration
        // |--------------------------------------------------------------------------
        // | If your route is different, only change API_URL.
        // | Expected backend response:
        // | {
        // |   products: { data: [...], current_page: 1, last_page: 5, total: 120, ... },
        // |   categories: [...]
        // | }
        // */
        // const API_URL = "{{ url('api/search/getFilters') }}";

        // const $ = s => document.querySelector(s);
        // const $$ = s => [...document.querySelectorAll(s)];

        // let state = {
        //     query: new URLSearchParams(location.search).get('keyword') || '',
        //     sortBy: 'created_at',
        //     sortType: 'desc',
        //     page: Number(new URLSearchParams(location.search).get('page') || 1),
        //     favorites: new Set(),
        //     writer: '',
        //     exists: null,
        //     hasDescount: null,
        //     fromPrice: null,
        //     toPrice: null,
        //     loading: false
        // };

        // /*
        // |--------------------------------------------------------------------------
        // | Backend field helpers
        // |--------------------------------------------------------------------------
        // | The backend model's exact image/title field names were not provided.
        // | These helpers support common names and can be adjusted in one place.
        // */
        // function productTitle(p) {
        //     return p.title ?? p.name ?? p.summary ?? p.description ?? 'بدون عنوان';
        // }

        // function productImage(p) {
        //     return p.image_url ??
        //            p.image ??
        //            p.thumbnail ??
        //            p.cover ??
        //            p.photo ??
        //            p.image?.url ??
        //            'https://placehold.co/600x600/f3f4f6/777?text=Product';
        // }

        // function productPrice(p) {
        //     return Number(p.secondary_price ?? p.primary_price ?? p.price ?? 0);
        // }

        // function primaryPrice(p) {
        //     return Number(p.primary_price ?? p.price ?? 0);
        // }

        // function oldPrice(p) {
        //     const old = Number(p.primary_price ?? p.old_price ?? 0);
        //     const current = Number(p.secondary_price ?? p.price ?? 0);
        //     return old > current && current > 0 ? old : null;
        // }

        // function productStock(p) {
        //     return Number(p.count ?? p.stock ?? p.quantity ?? 0) !== 0;
        // }

        // function productRating(p) {
        //     return Number(p.rating ?? p.rate ?? p.average_rating ?? 0);
        // }

        // function productId(p) {
        //     return p.id ?? p.product_id;
        // }

        // function money(n) {
        //     return new Intl.NumberFormat('fa-IR').format(Number(n || 0));
        // }

        // function stars(r) {
        //     const n = Math.max(0, Math.min(5, Math.round(Number(r) || 0)));
        //     return '★'.repeat(n) + '☆'.repeat(5 - n);
        // }

        // function getFiltersPayload() {
        //     return {
        //         writer: state.writer || null,
        //         exists: state.exists,
        //         hasDescount: state.hasDescount,
        //         fromPrice: state.fromPrice,
        //         toPrice: state.toPrice,
        //         sortType: state.sortType,
        //         sortBy: state.sortBy
        //     };
        // }

        // function updateUrl() {
        //     const params = new URLSearchParams();
        //     if (state.query) params.set('keyword', state.query);
        //     if (state.page > 1) params.set('page', state.page);
        //     const query = params.toString();
        //     history.replaceState(null, '', query ? `${location.pathname}?${query}` : location.pathname);
        // }

        // function setLoading(loading) {
        //     state.loading = loading;
        //     $('#products').classList.toggle('opacity-50', loading);
        //     $('#products').classList.toggle('pointer-events-none', loading);
        // }

        // function renderLoading() {
        //     $('#products').innerHTML = `
    //       <div class="col-span-full p-14 text-center text-sm text-[#71717a]">
    //         <div class="inline-block w-7 h-7 border-2 border-[#e4e4e7] border-t-[#ef394e] rounded-full animate-spin mb-3"></div>
    //         <div>در حال دریافت محصولات...</div>
    //       </div>`;
        //     $('#products').classList.remove('hidden');
        //     $('#empty').classList.add('hidden');
        // }

        // function normalizeResponse(json) {
        //     /*
        //      * Laravel paginate() returns products.data.
        //      * This also supports an API that returns products directly as an array.
        //      */
        //     const pagination = json.products && !Array.isArray(json.products)
        //         ? json.products
        //         : {
        //             data: Array.isArray(json.products) ? json.products : [],
        //             current_page: state.page,
        //             last_page: 1,
        //             total: Array.isArray(json.products) ? json.products.length : 0
        //         };

        //     return {
        //         products: Array.isArray(pagination.data) ? pagination.data : [],
        //         currentPage: Number(pagination.current_page || state.page),
        //         lastPage: Number(pagination.last_page || 1),
        //         total: Number(pagination.total || 0),
        //         categories: Array.isArray(json.categories) ? json.categories : []
        //     };
        // }

        // async function fetchProducts() {
        //     if (state.loading) return;

        //     setLoading(true);
        //     renderLoading();

        //     try {
        //         const params = new URLSearchParams({
        //             keyword: state.query,
        //             page: String(state.page),
        //             filters: JSON.stringify(getFiltersPayload())
        //         });

        //         const response = await fetch(`${API_URL}?${params.toString()}`, {
        //             method: 'GET',
        //             headers: {
        //                 'Accept': 'application/json',
        //                 'X-Requested-With': 'XMLHttpRequest'
        //             },
        //             credentials: 'same-origin'
        //         });

        //         if (!response.ok) {
        //             throw new Error(`HTTP ${response.status}`);
        //         }

        //         const json = await response.json();
        //         const result = normalizeResponse(json);

        //         renderProducts(result.products);
        //         renderMeta(result);
        //         renderPagination(result);
        //         renderChips();
        //         renderCategories(result.categories);

        //     } catch (error) {
        //         console.error('Product search error:', error);

        //         $('#products').innerHTML = `
    //           <div class="col-span-full p-14 text-center">
    //             <div class="text-4xl mb-3">⚠️</div>
    //             <h2 class="text-base font-semibold mb-2">دریافت محصولات انجام نشد</h2>
    //             <p class="text-xs text-[#71717a] mb-4">آدرس API یا اتصال به سرور را بررسی کنید.</p>
    //             <button onclick="fetchProducts()"
    //               class="bg-[#ef394e] text-white border-0 rounded-lg px-5 py-2 text-xs">
    //               تلاش مجدد
    //             </button>
    //           </div>`;

        //         $('#resultCount').textContent = '';
        //         $('#empty').classList.add('hidden');
        //         $('#pagination').classList.add('hidden');
        //     } finally {
        //         setLoading(false);
        //     }
        // }

        // function renderProducts(list) {
        //     if (!list.length) {
        //         $('#products').classList.add('hidden');
        //         $('#empty').classList.remove('hidden');
        //         return;
        //     }

        //     $('#products').classList.remove('hidden');
        //     $('#empty').classList.add('hidden');

        //     $('#products').innerHTML = list.map(p => {
        //         const id = productId(p);
        //         const title = productTitle(p);
        //         const image = productImage(p);
        //         const current = productPrice(p);
        //         const old = oldPrice(p);
        //         const rating = productRating(p);
        //         const stock = productStock(p);
        //         const discount = old ? Math.round((1 - current / old) * 100) : 0;
        //         const favorite = state.favorites.has(id);

        //         return `
    //           <article class="group relative min-w-0 bg-white p-[17px] border-l border-b border-[#e4e4e7] transition duration-200 hover:-translate-y-0.5 hover:shadow-[0_6px_22px_rgba(0,0,0,.08)]">
    //             ${discount > 0 ? `
        //               <span class="absolute top-[25px] right-[25px] z-10 bg-[#ef394e] text-white rounded-[5px] text-[10px] px-[7px] py-1">
        //                 ${discount}٪
        //               </span>` : ''}

    //             <button onclick="toggleFav(${JSON.stringify(id)})"
    //               class="absolute top-[22px] left-5 z-10 border-0 bg-white text-xl ${favorite ? 'text-[#ef394e]' : 'text-[#aaa]'}">
    //               ${favorite ? '♥' : '♡'}
    //             </button>

    //             <img src="${image}" alt="${title}" loading="lazy"
    //               onerror="this.src='https://placehold.co/600x600/f3f4f6/777?text=Product'"
    //               class="w-full aspect-square object-contain rounded-lg bg-[#f8f8f8] block mb-3.5">

    //             <h3 class="m-0 mb-2.5 text-[13px] leading-[1.9] h-[50px] overflow-hidden">
    //               ${title}
    //             </h3>

    //             <div class="flex justify-between items-center mb-2.5 text-[11px]">
    //               <span>${rating ? rating.toLocaleString('fa-IR') + ' ⭐' : 'بدون امتیاز'}</span>
    //               <span class="text-[#f59e0b]">${rating ? stars(rating) : ''}</span>
    //             </div>

    //             <div class="flex items-center justify-between gap-2">
    //               <strong class="text-[15px]">${money(current)}</strong>
    //               <span class="text-[10px] text-[#71717a]">تومان</span>
    //             </div>

    //             ${old ? `
        //               <div class="line-through text-[#a1a1aa] text-[10px]">
        //                 ${money(old)} تومان
        //               </div>` : ''}

    //             <div class="mt-2.5 text-[10px] ${stock ? 'text-[#16a34a]' : 'text-[#a1a1aa]'}">
    //               ${stock ? '● موجود در انبار' : '○ ناموجود'}
    //             </div>
    //           </article>`;
        //     }).join('');
        // }

        // function renderMeta(result) {
        //     $('#resultCount').textContent =
        //         `${result.total.toLocaleString('fa-IR')} کالا`;

        //     $('#title').textContent = state.query
        //         ? `نتایج جستجو برای «${state.query}»`
        //         : 'همه محصولات';
        // }

        // function renderPagination(result) {
        //     const pagination = $('#pagination');

        //     if (result.lastPage <= 1) {
        //         pagination.classList.add('hidden');
        //         return;
        //     }

        //     pagination.classList.remove('hidden');

        //     const buttons = [];
        //     const current = result.currentPage;
        //     const last = result.lastPage;

        //     buttons.push(`
    //       <button
    //         class="page w-[38px] h-[38px] border border-[#e4e4e7] bg-white rounded-lg disabled:opacity-40"
    //         ${current <= 1 ? 'disabled' : ''}
    //         onclick="goToPage(${current - 1})">‹</button>`);

        //     const start = Math.max(1, current - 2);
        //     const end = Math.min(last, current + 2);

        //     for (let i = start; i <= end; i++) {
        //         buttons.push(`
    //           <button
    //             class="page w-[38px] h-[38px] border rounded-lg ${i === current
    //                 ? 'border-[#ef394e] bg-[#ef394e] text-white'
    //                 : 'border-[#e4e4e7] bg-white'}"
    //             onclick="goToPage(${i})">${i.toLocaleString('fa-IR')}</button>`);
        //     }

        //     buttons.push(`
    //       <button
    //         class="page w-[38px] h-[38px] border border-[#e4e4e7] bg-white rounded-lg disabled:opacity-40"
    //         ${current >= last ? 'disabled' : ''}
    //         onclick="goToPage(${current + 1})">›</button>`);

        //     pagination.innerHTML = buttons.join('');
        // }

        // function renderCategories(categories) {
        //     /*
        //      * Your backend returns categories separately.
        //      * The existing sidebar is kept visually unchanged.
        //      * If category filtering is added to Laravel later, this is the place
        //      * to render the returned categories dynamically.
        //      */
        //     console.debug('categories from API:', categories);
        // }

        // function renderChips() {
        //     const chips = [];

        //     if (state.query) {
        //         chips.push(`
    //           <span class="bg-white border border-[#e4e4e7] rounded-full px-3 py-1.5 text-[11px] text-[#52525b]">
    //             جستجو: ${state.query}
    //             <button onclick="clearQuery()" class="border-0 bg-transparent mr-1 text-[#999]">×</button>
    //           </span>`);
        //     }

        //     if (state.writer) {
        //         chips.push(`
    //           <span class="bg-white border border-[#e4e4e7] rounded-full px-3 py-1.5 text-[11px] text-[#52525b]">
    //             نویسنده: ${state.writer}
    //             <button onclick="clearWriter()" class="border-0 bg-transparent mr-1 text-[#999]">×</button>
    //           </span>`);
        //     }

        //     if (state.fromPrice !== null) {
        //         chips.push(`
    //           <span class="bg-white border border-[#e4e4e7] rounded-full px-3 py-1.5 text-[11px] text-[#52525b]">
    //             از ${money(state.fromPrice)}
    //           </span>`);
        //     }

        //     if (state.toPrice !== null) {
        //         chips.push(`
    //           <span class="bg-white border border-[#e4e4e7] rounded-full px-3 py-1.5 text-[11px] text-[#52525b]">
    //             تا ${money(state.toPrice)}
    //           </span>`);
        //     }

        //     if (state.exists !== null) {
        //         chips.push(`
    //           <span class="bg-white border border-[#e4e4e7] rounded-full px-3 py-1.5 text-[11px] text-[#52525b]">
    //             ${state.exists === 1 ? 'فقط موجود' : 'فقط ناموجود'}
    //           </span>`);
        //     }

        //     if (state.hasDescount !== null) {
        //         chips.push(`
    //           <span class="bg-white border border-[#e4e4e7] rounded-full px-3 py-1.5 text-[11px] text-[#52525b]">
    //             ${state.hasDescount === 1 ? 'فقط تخفیف‌دار' : 'بدون تخفیف'}
    //           </span>`);
        //     }

        //     $('#chips').innerHTML = chips.join('');
        // }

        // function toggleFav(id) {
        //     state.favorites.has(id)
        //         ? state.favorites.delete(id)
        //         : state.favorites.add(id);

        //     // Favorites are UI-only; they are not part of getFilters().
        //     fetchProducts();
        // }

        // function clearQuery() {
        //     state.query = '';
        //     state.page = 1;
        //     $('#searchInput').value = '';
        //     $('#clearSearch').classList.add('hidden');
        //     updateUrl();
        //     fetchProducts();
        // }

        // function clearWriter() {
        //     state.writer = '';
        //     state.page = 1;
        //     updateUrl();
        //     fetchProducts();
        // }

        // function goToPage(page) {
        //     state.page = Math.max(1, page);
        //     updateUrl();
        //     fetchProducts();
        //     window.scrollTo({ top: 0, behavior: 'smooth' });
        // }

        // function syncFiltersFromUI() {
        //     const min = $('#minPrice').value.trim();
        //     const max = $('#maxPrice').value.trim();

        //     state.fromPrice = min !== '' ? Number(min) : null;
        //     state.toPrice = max !== '' ? Number(max) : null;

        //     if ($('#availableOnly').checked) {
        //         state.exists = 1;
        //     } else {
        //         state.exists = null;
        //     }
        // }

        // $('#searchInput').addEventListener('input', e => {
        //     state.query = e.target.value;
        //     state.page = 1;
        //     $('#clearSearch').classList.toggle('hidden', !state.query);
        //     updateUrl();

        //     clearTimeout(window.searchTimer);
        //     window.searchTimer = setTimeout(fetchProducts, 350);
        // });

        // $('#searchInput').addEventListener('keydown', e => {
        //     if (e.key === 'Enter') {
        //         clearTimeout(window.searchTimer);
        //         state.query = e.target.value.trim();
        //         state.page = 1;
        //         updateUrl();
        //         fetchProducts();
        //     }
        // });

        // $('#clearSearch').addEventListener('click', clearQuery);

        // $('#minPrice').addEventListener('input', () => {
        //     syncFiltersFromUI();
        //     state.page = 1;
        //     clearTimeout(window.filterTimer);
        //     window.filterTimer = setTimeout(fetchProducts, 350);
        // });

        // $('#maxPrice').addEventListener('input', () => {
        //     syncFiltersFromUI();
        //     state.page = 1;
        //     clearTimeout(window.filterTimer);
        //     window.filterTimer = setTimeout(fetchProducts, 350);
        // });

        // $('#availableOnly').addEventListener('change', () => {
        //     syncFiltersFromUI();
        //     state.page = 1;
        //     fetchProducts();
        // });

        // $$('input[name="rating"]').forEach(input => {
        //     /*
        //      * The current Laravel getFilters() does not accept a rating filter.
        //      * Keep the control visually present, but do not send unsupported data.
        //      */
        //     input.addEventListener('change', () => {
        //         console.warn('Rating filter is not supported by the current backend getFilters() method.');
        //     });
        // });

        // $$('[data-filter]').forEach(input => {
        //     /*
        //      * The current backend has no category filter:
        //      * // $category = $filters['category'] ?? null;
        //      * Therefore these checkboxes are intentionally not sent to the API.
        //      */
        //     input.addEventListener('change', () => {
        //         console.warn('Category filtering is not supported by the current backend getFilters() method.');
        //     });
        // });

        // $$('.sort-btn').forEach(btn => {
        //     btn.addEventListener('click', () => {
        //         $$('.sort-btn').forEach(x => {
        //             x.className = 'sort-btn text-xs border-0 bg-transparent text-[#52525b] px-2.5 py-2 rounded-[7px]';
        //         });

        //         btn.className =
        //             'sort-btn text-xs border-0 bg-[#fff0f2] text-[#ef394e] font-bold px-2.5 py-2 rounded-[7px]';

        //         /*
        //          * Backend supports arbitrary orderBy fields, but only these are
        //          * mapped because the original UI has these five sort choices.
        //          */
        //         switch (btn.dataset.sort) {
        //             case 'cheap':
        //                 state.sortBy = 'primary_price';
        //                 state.sortType = 'asc';
        //                 break;

        //             case 'expensive':
        //                 state.sortBy = 'primary_price';
        //                 state.sortType = 'desc';
        //                 break;

        //             case 'newest':
        //                 state.sortBy = 'created_at';
        //                 state.sortType = 'desc';
        //                 break;

        //             case 'popular':
        //                 /*
        //                  * There is no "views" field mentioned in getFilters().
        //                  * Keep it on created_at rather than sending an unsupported
        //                  * field to Laravel.
        //                  */
        //                 state.sortBy = 'created_at';
        //                 state.sortType = 'desc';
        //                 break;

        //             case 'relevance':
        //             default:
        //                 state.sortBy = 'created_at';
        //                 state.sortType = 'desc';
        //                 break;
        //         }

        //         state.page = 1;
        //         fetchProducts();
        //     });
        // });

        // $('#resetFilters').addEventListener('click', () => {
        //     state.writer = '';
        //     state.exists = null;
        //     state.hasDescount = null;
        //     state.fromPrice = null;
        //     state.toPrice = null;
        //     state.page = 1;

        //     $('#minPrice').value = '';
        //     $('#maxPrice').value = '';
        //     $('#availableOnly').checked = false;

        //     document.querySelector('input[name="rating"][value="0"]').checked = true;
        //     $$('[data-filter]').forEach(x => x.checked = false);

        //     fetchProducts();
        // });

        // let compact = false;

        // $('#viewToggle').addEventListener('click', () => {
        //     compact = !compact;

        //     $('#products').classList.toggle('lg:grid-cols-3', compact);
        //     $('#products').classList.toggle('lg:grid-cols-4', !compact);
        //     $('#viewToggle').textContent = compact ? '▦' : '▤';
        // });

        // // Initial state
        // $('#searchInput').value = state.query;
        // $('#clearSearch').classList.toggle('hidden', !state.query);
        // fetchProducts();
    </script>
</body>

</html>
