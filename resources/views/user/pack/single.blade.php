@extends('app.document')
@section('title')
    طبابوک | {{ $pack->title }}
@endsection
@section('content')
    <style>
        .cart_shdow {
            box-shadow: 0 0 3px 2px rgb(239, 238, 238);
        }

        .transition_fast {
            transition: all 0.2s ease;
        }
        .transition_normal {
            transition: all 0.3s ease;
        }
        .transition_slow {
            transition: all 0.5s ease;
        }
    </style>

    <div class="w-11/12 mx-auto flex max-lg:flex-col gap-5 justify-start p-3 mt-10 bg-white"
        style="box-shadow: 0 0 3px 2px rgb(239, 238, 238);">
        <div class="lg:w-1/2 w-full lg:h-full flex flex-col gap-4 justify-start items-start max-lg:order-2">
            <span class="px-2 py-1 text-[#0B2116] rounded-full bg-[#CFECD2] max-lg:text-sm">پک اقتصادی</span>
            <div class="w-full h-20 flex gap-5 justify-start items-start">
                <div class="lg:size-10 size-7 bg-[#0B2116]"></div>
                <div class="flex flex-col lg:gap-4 gap-2 justify-start items-start pt-1">
                    <h4 class="lg:text-xl text-lg font-bold text-[#0B2116]">{{ $pack->title }}</h4>
                    <p class="lg:text-sm text-xs text-[#474948]">{{ $pack->summary }}</p>
                </div>
            </div>
            <p class="lg:w-10/12 w-full max-xl:text-sm max-lg:text-xs max-lg:text-center">{{ $pack->description }}</p>
            {{-- <div
                class="w-full bg-[#ECEEEB] p-3 flex max-lg:grid max-lg:gap-3 max-lg:grid-cols-2 max-lg:grid-rows-2 lg:justify-between justify-start items-center rounded-xl">
                <div
                    class="lg:w-31/100 w-full lg:h-full flex max-lg:flex-col lg:gap-5 gap-3 justify-start items-center max-lg:col-span-2">
                    <div class="size-8 bg-[#0B2116]"></div>
                    <div class="flex flex-col gap-2 justify-start lg:items-start items-center xl:text-sm text-xs font-bold">
                        <span>مناسب برای دانش آموزان</span>
                        <span>تمام مقاطع</span>
                    </div>
                </div>
                <span class="w-0.5 h-7/12 bg-[#D7DCD8] max-lg:hidden"></span>
                <div class="lg:w-31/100 w-full lg:h-full flex max-lg:flex-col lg:gap-5 gap-3 justify-start items-center">
                    <div class="size-8 bg-[#0B2116]"></div>
                    <div class="flex flex-col gap-2 justify-start lg:items-start items-center xl:text-sm text-xs font-bold">
                        <span>تضمین کیفیت</span>
                        <span>مخصولات</span>
                    </div>
                </div>
                <span class="w-0.5 h-7/12 bg-[#D7DCD8] max-lg:hidden"></span>
                <div class="lg:w-31/100 w-full lg:h-full flex max-lg:flex-col lg:gap-5 gap-3 justify-start items-center">
                    <div class="size-8 bg-[#0B2116]"></div>
                    <div class="flex flex-col gap-2 justify-start lg:items-start items-center xl:text-sm text-xs font-bold">
                        <span>تضمین کیفیت</span>
                        <span>مخصولات</span>
                    </div>
                </div>

            </div> --}}
            <div class="w-full flex flex-col gap-4 justify-start items-start">
                <div class="w-full flex gap-2 justify-start items-center">
                    <div class="size-6 bg-[#0B2116]"></div>
                    <h6 class="font-bold">اقلام همراه</h6>
                </div>
                <div class="w-full flex flex-wrap gap-4 justify-start items-start">
                    @foreach ($pack->products as $product)
                        <div class="xl:w-31/100 lg:w-48/100 w-full lg:h-17 h-15 flex bg-white justify-between items-center rounded-xl lg:p-2 p-1.5 gap-3"
                            style="box-shadow: 0 0 3px 2px rgb(239, 238, 238);">
                            <div class="w-4/12 h-full flex justify-center items-center">
                                <img src="{{ asset('storage/'.$product->image) }}" alt="" class="max-w-full max-h-full">
                            </div>
                            <div class="w-8/12 h-full flex flex-col gap-1 justify-center items-start text-sm max-lg:text-xs">
                                <span class="max-w-full text-nowrap truncate font-bold">{{ $product->title }}</span>
                                {{-- <span>2×</span> --}}
                            </div>
                        </div>
                    @endforeach
                   

                </div>
            </div>
            <div class="w-full flex flex-col gap-5 justify-between items-center">
                <button
                    class="w-full lg:px-7 py-2 bg-[#0B4D32] flex gap-2 justify-center items-center rounded-xl max-lg:order-2 cursor-pointer">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="lg:size-4 size-3"
                            fill="white">
                            <path
                                d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                </button>
                <div class="max-lg:w-full flex flex-col gap-2 justify-center items-end max-lg:order-1">
                    @if ($pack->secondary_price)
                        <div class="flex gap-1 justify-start items-start text-[#0B4D32] font-bold">
                            <span class="in-fa">{{ number_format($pack->secondary_price) }}</span>
                            <span>تومان</span>
                        </div>
                        <div class="flex gap-1 justify-start items-center">
                            <del class="flex gap-1 justify-start items-start text-xs text-[#BBBABC]">
                                <span class="in-fa">{{ number_format($pack->primary_price) }}</span>
                                <span>تومان</span>
                            </del>
                            <div
                                class="flex gap-1 justify-start items-start bg-[#CFECD2] text-xs text-[#0B4D32] font-bold p-1 rounded-full">
                                {{-- <span>تخفیف</span>  --}}
                                <span class="in-fa">{{ $pack->percent }} %</span>
                            </div>
                        </div>
                    @else
                        <div class="flex gap-1 justify-start items-start text-[#0B4D32] font-bold">
                            <span class="in-fa">{{ number_format($pack->primary_price) }}</span>
                            <span>تومان</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="lg:w-1/2 w-full lg:min-h-full flex flex-col lg:gap-10 gap-4 justify-start items-center max-lg:order-1">
            <div class="w-full flex flex-col lg:gap-4 gap-2 justify-start items-center">
                <div class="w-full xl:h-100 lg:h-80 h-55 bg-[#EAEFE9] rounded-xl flex justify-center items-center"
                    id="gallery_pack_single_primary_img">
                    <img src="{{ asset('storage/'.$pack->image) }}" alt=""
                        class="min-w-6/12 max-w-full min-h-6/12 max-h-full rounded-xl">
                </div>
                @if (count($pack->gallery))
                <div
                    class="w-full lg:h-24 h-17 flex gap-2 justify-start items-center overflow-x-auto py-2 [&::-webkit-scrollbar]:h-1.5  [&::-webkit-scrollbar-thumb]:bg-[#EAEFE9]  [&::-webkit-scrollbar-thumb]:rounded-full">
                    @foreach ($pack->gallery as $gallery)
                        <div
                            class="lg:min-w-20 lg:w-20 min-w-13 w-13 h-full bg-white rounded-xl flex justify-center items-center gallery_pack_single">
                            <img src="{{ asset('storage/'.$gallery->image) }}" alt="" class="w-full max-h-full rounded-xl">
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="w-full xl:h-35 lg:h-30 h-25 bg-[#EAEFE9] rounded-xl flex justify-center items-center relative">
                <div class="absolute lg:top-5 top-2 lg:left-3 left-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="lg:size-5 size-3 fill-[#0B2116]">
                        <path
                            d="M149.6 234.4c20.9-6.7 43.2-10.4 66.4-10.4h80c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-25.4 0-49.5 5.6-71 15.7C152.7 351 206.6 400 271.9 400h.1l.8 0 .1 0C370.2 399.5 464 299.7 464 156.6c0-12.8-.8-25.3-2.3-37.5C437 134.9 407.6 144 376 144l-104 0c-57.6 0-106.3 38.1-122.4 90.4zM96.4 260.1C102.5 168.5 178.8 96 272 96l104 0c28.7 0 54.8-10.8 74.6-28.5c.7-.6 1.4-1.3 2.1-1.9c6.6-6.2 12.5-13.2 17.4-20.9c1.6-2.5 3.2-5.1 4.6-7.8c3.5-6.5 13.6-6.8 16.2 .1c1.3 3.5 2.5 7 3.7 10.6c2.9 8.9 5.5 17.9 7.8 27.2c.5 1.9 .9 3.8 1.3 5.6c5.4 24.3 8.3 49.8 8.3 76.2C512 317.1 405.1 447.3 273 448l-1 0c-81.7 0-150.4-55.7-170.2-131.2C68.7 347.5 48 391.3 48 440v16c0 13.3-10.7 24-24 24s-24-10.7-24-24V440c0-75.1 38.3-141.2 96.4-179.9z" />
                    </svg>
                </div>
                <p class="font-bold xl:text-xl lg:text-lg text-sm text-center text-[#0B2116]">"هر کتاب ، بک قدم به سوی
                    آینده ای روشن تر است"</p>
            </div>
        </div>
    </div>




    <script>
        let gallery_pack_single_primary_img = document.getElementById('gallery_pack_single_primary_img')
        let gallery_pack_single = document.querySelectorAll('.gallery_pack_single')
        gallery_pack_single.forEach((item) => {
            item.addEventListener('click', function() {
                let src = item.children[0].getAttribute('src')
                // console.log(src)
                gallery_pack_single_primary_img.children[0].setAttribute('src', src)
            })
        })
    </script>
@endsection
