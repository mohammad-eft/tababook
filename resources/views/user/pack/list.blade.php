@extends('app.document')
@section('title')
    طبابوک | لیست پک ها
@endsection
@section('content')
    <section class="max-w-[1800px] w-11/12 mx-auto">
        <div class="w-full mx-auto flex flex-col items-center">
            <div class="w-full grid grid-cols-1 lg:grid-cols-3 2xl:grid-cols-4 gap-4 lg:gap-8 mt-5">
                @foreach ($packs as $pack)
                    <div class="relative overflow-hidden rounded-2xl bg-[#f8f3e8]">
                        <div class="relative h-[180px] lg:h-[250px] w-full">
                            <img src="{{ asset('storage/' . $pack->image) }}" class="h-full w-full object-cover"
                                alt="">
                            <div class="absolute inset-y-0 right-0 w-[45%] bg-[#f8f3e8]">
                                <div class="absolute -left-3 -top-8 h-28 w-28 rounded-full bg-[#f8f3e8]"></div>
                                <div class="absolute -left-5 lg:-left-8 top-4 h-28 w-28 rounded-full bg-[#f8f3e8]"></div>
                                <div
                                    class="absolute -left-2 lg:-left-8 top-1/2 h-40 w-40 -translate-y-1/2 rounded-full bg-[#f8f3e8]">
                                </div>
                                <div class="absolute -left-5 bottom-2 h-28 w-28 rounded-full bg-[#f8f3e8]"></div>
                                <div class="absolute -left-3 -bottom-8 h-28 w-28 rounded-full bg-[#f8f3e8]"></div>
                            </div>
                        </div>
                        <div
                            class="absolute right-0 top-0 flex h-full w-[45%] items-center justify-center px-3 py-4 lg:py-8">
                            <div class="text-right flex flex-col gap-3">
                                <h3 class="text-lg lg:text-2xl font-bold text-[#315c50]">
                                    {{ $pack->title }}
                                </h3>
                                <p class="text-sm leading-7 text-gray-500">
                                    {{ $pack->summary }}
                                </p>
                                <div class="flex">
                                    <a href="{{ route('pack.single', $pack->id) }}"
                                        class="mt-3 rounded-full bg-[#8eae9f] px-6 py-2 text-white text-sm lg:text-base">
                                        مشاهده
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection