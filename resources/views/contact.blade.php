@extends('app.document')
@section('title', 'تماس با ما')
@section('content')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { kufi: ['Kufi', 'Tahoma', 'sans-serif'] },
                    colors: { brand:'#0b8f4d', brandDark:'#08733e', cream:'#f7f2e9', mint:'#edf7ed' },
                    boxShadow: { soft:'0 15px 45px rgba(20,70,35,.08)' }
                }
            }
        }
    </script>
    <style>
        @font-face{font-family:Kufi;src:url('./assets/fonts/NotoKufiArabic-Regular.ttf') format('truetype');font-weight:400}
        @font-face{font-family:Kufi;src:url('./assets/fonts/NotoKufiArabic-Medium.ttf') format('truetype');font-weight:500}
        @font-face{font-family:Kufi;src:url('./assets/fonts/NotoKufiArabic-Bold.ttf') format('truetype');font-weight:700}
        @font-face{font-family:Kufi;src:url('./assets/fonts/NotoKufiArabic-ExtraBold.ttf') format('truetype');font-weight:800}
        html{scroll-behavior:smooth}
        body{font-family:Kufi,Tahoma,sans-serif}
        .container-x{width:min(1180px,calc(100% - 32px));margin-inline:auto}
    </style>

<div class="bg-white text-slate-800">


<main id="contact">

    <!-- Hero -->
    <section class="bg-cream overflow-hidden">
        <div class="container-x grid lg:grid-cols-2 items-center gap-8 py-10 sm:py-14">
            <div class="order-2 lg:order-1">
                <div class="flex items-center gap-3 mb-4"><span class="w-12 h-[3px] rounded bg-brand"></span><span class="text-brand font-bold">ارتباط با کتاب‌یار</span></div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-[1.5]">تماس با ما</h1>
                <p class="text-base sm:text-lg font-medium mt-4 leading-8">ما همیشه آماده پاسخگویی به سوالات و نظرات شما هستیم.</p>
                <p class="text-sm sm:text-base text-slate-600 leading-8 mt-3 max-w-xl">برای ارتباط با ما می‌توانید از طریق فرم زیر اطلاعات خود را ارسال کنید یا با یکی از راه‌های ارتباطی دیگر در تماس باشید.</p>
            </div>
            <img src="{{asset('img/contact-hero.svg')}}" alt="کتاب‌ها و فضای مطالعه" class="order-1 lg:order-2 w-full rounded-3xl shadow-soft">
        </div>
    </section>

    <!-- Contact + Form -->
    <section class="py-12 sm:py-16">
        <div class="container-x grid lg:grid-cols-5 gap-6">

            <aside class="lg:col-span-2 rounded-3xl bg-mint border border-green-100 p-7 sm:p-9">
                <h2 class="text-2xl font-extrabold text-green-800">راه‌های ارتباطی ما</h2>
                <p class="text-sm text-slate-500 leading-7 mt-3">شما می‌توانید از راه‌های زیر با ما در ارتباط باشید.</p>

                <div class="mt-8 grid gap-7">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-white grid place-items-center text-xl">☎</div>
                        <div><h3 class="font-bold">شماره تماس</h3><p class="text-sm text-slate-500 mt-2">۰۲۱-۱۲۳۴۵۶۷۸</p><small class="text-xs text-slate-400">(پاسخگویی از ۸ صبح تا ۸ شب)</small></div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-white grid place-items-center text-xl">✉</div>
                        <div><h3 class="font-bold">ایمیل</h3><p class="text-sm text-slate-500 mt-2" dir="ltr">info@ketabyar.ir</p><small class="text-xs text-slate-400">در سریع‌ترین زمان ممکن پاسخ می‌دهیم.</small></div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-white grid place-items-center text-xl">⌖</div>
                        <div><h3 class="font-bold">آدرس</h3><p class="text-sm text-slate-500 mt-2 leading-7">تهران، خیابان ولیعصر، پلاک ۱۲۳</p><small class="text-xs text-slate-400">(مراجعه حضوری با هماهنگی قبلی)</small></div>
                    </div>
                </div>

                <div class="mt-8">
                    <p class="text-brand font-bold text-sm">منتظر شنیدن نظرات و پیشنهادات شما هستیم ♡</p>
                    <img src="{{asset('img/contact-books.svg')}}" alt="" class="mt-4 w-full">
                </div>
            </aside>

            <section class="lg:col-span-3 rounded-3xl border border-slate-200 p-7 sm:p-9 shadow-soft bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-mint grid place-items-center text-xl">➤</div>
                    <div><h2 class="text-2xl font-extrabold">ارسال پیام</h2><p class="text-sm text-slate-500 mt-1">پیام خود را برای ما ارسال کنید؛ در اسرع وقت پاسخ خواهیم داد.</p></div>
                </div>

                <form class="mt-8 grid sm:grid-cols-2 gap-4" onsubmit="event.preventDefault(); document.getElementById('success').classList.remove('hidden');">
                    <label class="block">
                        <span class="text-sm font-medium">نام و نام خانوادگی <b class="text-red-500">*</b></span>
                        <input required type="text" class="mt-2 w-full h-14 rounded-xl border border-slate-200 px-4 outline-none focus:border-brand focus:ring-2 focus:ring-green-100" placeholder="مثال: محمد علی">
                    </label>
                    <label class="block">
                        <span class="text-sm font-medium">ایمیل <b class="text-red-500">*</b></span>
                        <input required type="email" dir="ltr" class="mt-2 w-full h-14 rounded-xl border border-slate-200 px-4 outline-none focus:border-brand focus:ring-2 focus:ring-green-100" placeholder="example@mail.com">
                    </label>
                    <label class="sm:col-span-2 block">
                        <span class="text-sm font-medium">موضوع <b class="text-red-500">*</b></span>
                        <select required class="mt-2 w-full h-14 rounded-xl border border-slate-200 px-4 bg-white outline-none focus:border-brand focus:ring-2 focus:ring-green-100">
                            <option value="">انتخاب کنید</option><option>پیگیری سفارش</option><option>مشاوره خرید کتاب</option><option>پیشنهاد و انتقاد</option><option>سایر</option>
                        </select>
                    </label>
                    <label class="sm:col-span-2 block">
                        <span class="text-sm font-medium">متن پیام <b class="text-red-500">*</b></span>
                        <textarea required rows="6" class="mt-2 w-full rounded-xl border border-slate-200 p-4 outline-none resize-y focus:border-brand focus:ring-2 focus:ring-green-100" placeholder="پیام خود را اینجا بنویسید..."></textarea>
                    </label>
                    <button class="sm:col-span-2 h-14 rounded-xl bg-brand hover:bg-brandDark text-white font-bold transition">ارسال پیام　➤</button>
                    <div id="success" class="hidden sm:col-span-2 rounded-xl bg-green-50 text-green-700 p-4 text-sm">پیام شما با موفقیت ثبت شد. این پیام نمونه است و به سرور ارسال نمی‌شود.</div>
                </form>
            </section>
        </div>
    </section>

    <!-- Map -->
    <section class="pb-12 sm:pb-16">
        <div class="container-x grid lg:grid-cols-5 rounded-3xl overflow-hidden border border-green-100 shadow-soft">
            <div class="lg:col-span-3 min-h-[300px]"><img src="{{asset('img/contact-map.svg')}}" class="w-full h-full object-cover" alt="نقشه موقعیت کتاب‌یار"></div>
            <div class="lg:col-span-2 bg-mint p-8 sm:p-12 flex flex-col justify-center">
                <div class="w-14 h-14 rounded-full bg-white grid place-items-center text-2xl">⌖</div>
                <h2 class="text-2xl font-extrabold text-green-800 mt-5">همیشه در دسترس شما هستیم</h2>
                <p class="text-sm text-slate-600 leading-8 mt-4">چه سوالی داشته باشید، چه پیشنهادی، با کمال میل منتظر پیام شما هستیم.</p>
                <a href="#" class="mt-6 self-start px-6 py-3 rounded-xl border border-brand text-brand font-bold hover:bg-white transition">مشاهده روی نقشه</a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="pb-16">
        <div class="container-x">
            <div class="text-center mb-9">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-brand">سوالات متداول</h2>
                <p class="text-sm text-slate-500 mt-3">شاید پاسخ سوال شما در این بخش باشد.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <details class="group rounded-2xl border p-5">
                    <summary class="cursor-pointer font-bold text-sm list-none">چطور سفارش خود را پیگیری کنم؟</summary>
                    <p class="text-xs text-slate-500 leading-6 mt-3">از بخش پیگیری سفارش با کد سفارش می‌توانید وضعیت را مشاهده کنید.</p>
                </details>
                <details class="group rounded-2xl border p-5">
                    <summary class="cursor-pointer font-bold text-sm list-none">آیا امکان تعویض کالا وجود دارد؟</summary>
                    <p class="text-xs text-slate-500 leading-6 mt-3">شرایط تعویض مطابق قوانین فروشگاه در صفحه قوانین درج شده است.</p>
                </details>
                <details class="group rounded-2xl border p-5">
                    <summary class="cursor-pointer font-bold text-sm list-none">مدت زمان ارسال چقدر است؟</summary>
                    <p class="text-xs text-slate-500 leading-6 mt-3">بسته به شهر و روش ارسال، زمان تحویل متفاوت است.</p>
                </details>
                <details class="group rounded-2xl border p-5">
                    <summary class="cursor-pointer font-bold text-sm list-none">چطور کتاب مناسب انتخاب کنم؟</summary>
                    <p class="text-xs text-slate-500 leading-6 mt-3">می‌توانید از طریق فرم تماس برای دریافت راهنمایی پیام بفرستید.</p>
                </details>
            </div>
        </div>
    </section>
</main>

<script>
    const btn=document.getElementById('menuBtn'), menu=document.getElementById('mobileMenu');
    btn.addEventListener('click',()=>menu.classList.toggle('hidden'));
</script>
</div>
@endsection