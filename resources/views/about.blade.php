@extends('app.document')
@section('title', 'درباره ما')
@section('content')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        vazir: ['Ketabyar', 'Tahoma', 'Arial', 'sans-serif']
                    },
                    colors: {
                        brand: '#0b8f4d',
                        brandDark: '#08733e',
                        cream: '#f7f2e9',
                        softGreen: '#edf6ed'
                    },
                    boxShadow: {
                        soft: '0 12px 40px rgba(20, 60, 35, .08)'
                    }
                }
            }
        }
    </script>
    <style>
        @font-face { font-family: Ketabyar; src: url("assets/fonts/NotoKufiArabic-Regular.ttf") format("truetype"); font-weight: 400; font-display: swap; }
        @font-face { font-family: Ketabyar; src: url("assets/fonts/NotoKufiArabic-Medium.ttf") format("truetype"); font-weight: 500; font-display: swap; }
        @font-face { font-family: Ketabyar; src: url("assets/fonts/NotoKufiArabic-Bold.ttf") format("truetype"); font-weight: 700; font-display: swap; }
        @font-face { font-family: Ketabyar; src: url("assets/fonts/NotoKufiArabic-ExtraBold.ttf") format("truetype"); font-weight: 800; font-display: swap; }
    </style>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: Vazirmatn, Tahoma, Arial, sans-serif; }
        .container-x { width: min(1180px, calc(100% - 32px)); margin-inline: auto; }
        .glass { background: rgba(255,255,255,.76); backdrop-filter: blur(12px); }
        .line-title::after {
            content: ""; display: block; width: 46px; height: 3px;
            background: #0b8f4d; border-radius: 99px; margin: 10px auto 0;
        }
        .hero-image { min-height: 420px; }
        @media (max-width: 768px) {
            .hero-image { min-height: 280px; }
        }
    </style>


<div class="bg-white text-slate-800">

<!-- Top Bar -->
<div class="bg-brand text-white text-center text-xs sm:text-sm py-2 px-4">
    هر کتاب کوچک، شروع یک ایده بزرگ است 🌱
</div>

<!-- Header -->


<main>

    <!-- Hero -->
    <section id="about" class="bg-cream overflow-hidden">
        <div class="container-x grid lg:grid-cols-2 items-stretch">
            <div class="py-14 sm:py-20 lg:py-24 flex flex-col justify-center">
                <div class="flex items-center gap-3 mb-5">
                    <span class="w-12 h-[3px] bg-brand rounded-full"></span>
                    <span class="text-brand font-semibold">{{ $aboutUs->title }}</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.35] text-slate-900">
                    درباره ما
                </h1>
                {{-- <p class="mt-5 text-lg sm:text-xl font-medium leading-9 text-slate-700">
                    ما اینجا هستیم تا کتاب، بخشی از زندگی شما باشد.
                </p> --}}
                <p class="mt-4 text-sm sm:text-base leading-8 text-slate-600 max-w-xl">
                   {{ $aboutUs->description }}
                </p>
                {{-- <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#story" class="px-6 py-3 rounded-xl bg-brand text-white font-semibold hover:bg-brandDark transition">
                        داستان ما
                    </a>
                    <a href="#values" class="px-6 py-3 rounded-xl border border-brand/30 text-brand font-semibold hover:bg-white transition">
                        ارزش‌های ما
                    </a>
                </div> --}}
            </div>

            <div class="hero-image relative overflow-hidden rounded-b-[35px] lg:rounded-b-none lg:rounded-r-[35px]">
                <img
                        src="{{asset('img/about-page-reference.webp')}}"
                        alt="کتاب‌ها و فضای مطالعه"
                        class="absolute inset-0 w-full h-full object-cover"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/25 to-transparent"></div>
                <div class="absolute bottom-6 right-6 left-6 glass rounded-2xl p-5 shadow-soft">
                    <p class="font-bold text-slate-800">برای هر سلیقه، یک کتاب خوب</p>
                    <p class="text-sm text-slate-600 mt-1">انتخابی ساده برای شروع یک تجربه تازه.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why -->
    {{-- <section class="py-16 sm:py-20">
        <div class="container-x">
            <div class="text-center mb-10">
                <h2 class="line-title text-2xl sm:text-3xl font-extrabold text-brand">چرا کتاب‌یار؟</h2>
                <p class="mt-5 text-sm sm:text-base text-slate-500">ما فقط کتاب نمی‌فروشیم؛ یک تجربه بهتر برای انتخاب و خرید می‌سازیم.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <article class="rounded-2xl bg-[#f5faf4] p-7 text-center hover:-translate-y-1 transition shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-[#e0f1df] grid place-items-center text-2xl">📚</div>
                    <h3 class="font-bold mt-5">تنوع بالا</h3>
                    <p class="text-sm text-slate-500 leading-7 mt-3">از پرفروش‌ترین‌ها تا کتاب‌های تخصصی و جذاب.</p>
                </article>
                <article class="rounded-2xl bg-[#f5faf4] p-7 text-center hover:-translate-y-1 transition shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-[#e0f1df] grid place-items-center text-2xl">🚚</div>
                    <h3 class="font-bold mt-5">ارسال سریع</h3>
                    <p class="text-sm text-slate-500 leading-7 mt-3">سفارش شما در کوتاه‌ترین زمان به دستتان می‌رسد.</p>
                </article>
                <article class="rounded-2xl bg-[#f5faf4] p-7 text-center hover:-translate-y-1 transition shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-[#e0f1df] grid place-items-center text-2xl">🛡️</div>
                    <h3 class="font-bold mt-5">اصالت کالا</h3>
                    <p class="text-sm text-slate-500 leading-7 mt-3">تلاش می‌کنیم خریدی مطمئن و باکیفیت داشته باشید.</p>
                </article>
                <article class="rounded-2xl bg-[#f5faf4] p-7 text-center hover:-translate-y-1 transition shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-[#e0f1df] grid place-items-center text-2xl">💬</div>
                    <h3 class="font-bold mt-5">پشتیبانی واقعی</h3>
                    <p class="text-sm text-slate-500 leading-7 mt-3">برای انتخاب و خرید، همیشه کنار شما هستیم.</p>
                </article>
            </div>
        </div>
    </section> --}}

    <!-- Story -->
    {{-- <section id="story" class="pb-16 sm:pb-20">
        <div class="container-x">
            <div class="rounded-[28px] overflow-hidden bg-softGreen grid lg:grid-cols-2 shadow-soft">
                <div class="p-8 sm:p-12 lg:p-16 flex flex-col justify-center">
                    <span class="text-brand font-bold">داستان ما</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold mt-3">از یک علاقه کوچک تا یک دنیای بزرگ</h2>
                    <p class="mt-5 leading-8 text-sm sm:text-base text-slate-600">
                        کتاب‌یار با یک هدف ساده شروع شد؛ اینکه پیدا کردن کتاب مورد علاقه،
                        به اندازه خواندن آن لذت‌بخش باشد. امروز با همین نگاه، سعی می‌کنیم
                        انتخاب‌های متنوع، اطلاعات کاربردی و خریدی آسان را کنار هم قرار دهیم.
                    </p>
                    <a href="#contact" class="mt-7 self-start rounded-xl bg-brand text-white px-6 py-3 font-semibold hover:bg-brandDark transition">
                        با ما آشنا شوید ←
                    </a>
                </div>
                <div class="min-h-[300px] lg:min-h-[440px]">
                    <img
                            src="{{asset('img/about-page-reference.webp')}}"
                            alt="کتاب باز"
                            class="w-full h-full object-cover"
                    />
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Values -->
    {{-- <section id="values" class="py-16 sm:py-20 bg-white">
        <div class="container-x">
            <div class="text-center mb-12">
                <h2 class="line-title text-2xl sm:text-3xl font-extrabold text-brand">ارزش‌های ما</h2>
                <p class="mt-5 text-slate-500">چیزهایی که در مسیرمان به آن‌ها پایبندیم.</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 rounded-full bg-softGreen grid place-items-center text-2xl">🌱</div>
                    <h3 class="font-bold mt-4">رشد</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-7">به سوی آینده‌ای بهتر با کتاب.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 rounded-full bg-softGreen grid place-items-center text-2xl">🤝</div>
                    <h3 class="font-bold mt-4">همراهی</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-7">در تمام مراحل کنار شما هستیم.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 rounded-full bg-softGreen grid place-items-center text-2xl">💡</div>
                    <h3 class="font-bold mt-4">یادگیری</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-7">همیشه در حال یادگیری و بهتر شدنیم.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 rounded-full bg-softGreen grid place-items-center text-2xl">♡</div>
                    <h3 class="font-bold mt-4">اعتماد</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-7">اعتماد شما بزرگ‌ترین سرمایه ماست.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="pb-16 sm:pb-20">
        <div class="container-x">
            <div class="rounded-3xl bg-[#f8f3e9] p-7 sm:p-10 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div><strong class="block text-2xl sm:text-3xl text-brand">+۵۰,۰۰۰</strong><span class="text-sm text-slate-500 mt-2 block">عنوان کتاب</span></div>
                <div><strong class="block text-2xl sm:text-3xl text-brand">+۱۰,۰۰۰</strong><span class="text-sm text-slate-500 mt-2 block">مشتری راضی</span></div>
                <div><strong class="block text-2xl sm:text-3xl text-brand">۹۸٪</strong><span class="text-sm text-slate-500 mt-2 block">ارسال موفق</span></div>
                <div><strong class="block text-2xl sm:text-3xl text-brand">۴.۸</strong><span class="text-sm text-slate-500 mt-2 block">رضایت مشتریان</span></div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="contact" class="pb-16 sm:pb-20">
        <div class="container-x">
            <div class="rounded-[28px] bg-gradient-to-l from-[#eaf5e9] to-[#f8f2e7] p-8 sm:p-12 text-center">
                <div class="text-4xl">📖</div>
                <h2 class="mt-4 text-2xl sm:text-3xl font-extrabold">کتاب بعدی‌تان را پیدا کنید</h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600">یک کتاب خوب شاید شروع یک مسیر تازه باشد.</p>
                <div class="mt-7 flex flex-wrap justify-center gap-3">
                    <a href="#" class="px-7 py-3 rounded-xl bg-brand text-white font-semibold hover:bg-brandDark transition">مشاهده کتاب‌ها</a>
                    <a href="mailto:info@ketabyar.ir" class="px-7 py-3 rounded-xl bg-white border border-slate-200 font-semibold hover:border-brand transition">ارتباط با ما</a>
                </div>
            </div>
        </div>
    </section> --}}
</main>

<!-- Footer -->


</div>
<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
</script>

@endsection

