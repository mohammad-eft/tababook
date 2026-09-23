
    <footer class="w-full mt-20 flex justify-center items-start bg-white py-6">
        <section class="w-11/12 flex flex-col gap-4 justify-between items-start">
            <div class="w-full flex flex-col md:flex-row gap-5">
                <div class="w-full md:w-2/3 h-full flex flex-col sm:flex-row gap-5 justify-between items-start">
                    <!-- address -->
                    <div class="sm:w-1/2 w-full h-full flex flex-col justify-start lg:items-start items-center">

                        <img src="{{ asset('storage/home/ei_1788433185339-removebg-preview.webp') }}" alt=""
                            class="w-45">
                        <div class="flex flex-col gap-2 items-start text-xs lg:text-sm xl:text-md">
                            <span class="text-lg text-green-700 font-bold">{{ $setting['footerBrandName'] }}</span>
                            <p>{{ $setting['footerBrandDescription'] }}</p>
                        </div>

                    </div>
                    <!-- address -->
                    <!-- servis -->
                    <div class="sm:w-1/2 w-full h-full flex flex-col gap-3 justify-start items-start">
                        <div class="flex w-full h-full">
                            <div class="w-1/2 h-full flex flex-col gap-3 justify-start items-start">
                                <h5 class="xl:text-2xl lg:text-xl font-bold text-[var(--text)]">{{ $setting['footerServicesTitle'] }}</h5>
                                <div
                                    class="w-full flex flex-col gap-2 items-start justify-start xl:text-md lg:text-sm text-xs font-bold text-[#A4A4A5]">
                                    @foreach ($setting['footerServices'] as $service)
                                        <a href="{{ $service->url }}" class="hover:text-green-700 transition duration-300 cursor-pointer">{{ $service->title }}</a>
                                    @endforeach
                                 

                                </div>
                            </div>
                            <div class="w-1/2 h-full flex flex-col gap-3 justify-start items-start">
                                <h5 class="xl:text-2xl lg:text-xl font-bold text-[var(--text)]">{{ $setting['footerCategoriesTitle'] }}</h5>
                                <div
                                    class="w-full flex flex-col gap-1 items-start justify-start xl:text-md lg:text-sm text-xs font-bold text-[#A4A4A5]">
                                    @foreach ($setting['footerCategories'] as $category)
                                    <a href="{{ $category->url }}"
                                        class="hover:text-green-700 transition duration-300 cursor-pointer">{{ $category->title }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- servis -->
                </div>
                <!-- news -->
                <div class="w-full md:w-1/3 h-full flex flex-col justify-center items-start">
                    <div class="flex flex-col gap-3 justify-center items-start mx-auto">
                        <h5 class="xl:text-2xl lg:text-xl font-bold">{{ $setting['footerAboutTitle'] }}</h5>
                        <div class="flex flex-col gap-2 items-start text-xs lg:text-sm xl:text-md">
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="lg:size-4 size-3 fill-green-700">
                                        <path
                                            d="M375.8 275.2c-16.4-7-35.4-2.4-46.7 11.4l-33.2 40.6c-46-26.7-84.4-65.1-111.1-111.1L225.3 183c13.8-11.3 18.5-30.3 11.4-46.7l-48-112C181.2 6.7 162.3-3.1 143.6 .9l-112 24C13.2 28.8 0 45.1 0 64v0C0 295.2 175.2 485.6 400.1 509.5c9.8 1 19.6 1.8 29.6 2.2c0 0 0 0 0 0c0 0 .1 0 .1 0c6.1 .2 12.1 .4 18.2 .4l0 0c18.9 0 35.2-13.2 39.1-31.6l24-112c4-18.7-5.8-37.6-23.4-45.1l-112-48zM441.5 464C225.8 460.5 51.5 286.2 48.1 70.5l99.2-21.3 43 100.4L154.4 179c-18.2 14.9-22.9 40.8-11.1 61.2c30.9 53.3 75.3 97.7 128.6 128.6c20.4 11.8 46.3 7.1 61.2-11.1l29.4-35.9 100.4 43L441.5 464zM48 64v0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0s0 0 0 0">
                                        </path>
                                    </svg>
                                </div>
                                <span class="font-bold">{{ $setting['footerPhone'] }}</span>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"
                                        class="lg:size-4 size-3 fill-green-700">
                                        <path
                                            d="M1664 1504v-768q-32 36-69 66-268 206-426 338-51 43-83 67t-86.5 48.5-102.5 24.5h-2q-48 0-102.5-24.5t-86.5-48.5-83-67q-158-132-426-338-37-30-69-66v768q0 13 9.5 22.5t22.5 9.5h1472q13 0 22.5-9.5t9.5-22.5zm0-1051v-24.5l-.5-13-3-12.5-5.5-9-9-7.5-14-2.5h-1472q-13 0-22.5 9.5t-9.5 22.5q0 168 147 284 193 152 401 317 6 5 35 29.5t46 37.5 44.5 31.5 50.5 27.5 43 9h2q20 0 43-9t50.5-27.5 44.5-31.5 46-37.5 35-29.5q208-165 401-317 54-43 100.5-115.5t46.5-131.5zm128-37v1088q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-1088q0-66 47-113t113-47h1472q66 0 113 47t47 113z">
                                        </path>
                                    </svg>
                                </div>
                                <span class=" font-bold">{{ $setting['footerEmail'] }}</span>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                        class="lg:size-4 size-3 fill-green-700">
                                        <path
                                            d="M336 192c0-79.5-64.5-144-144-144S48 112.5 48 192c0 16.3 7.7 42 24.7 75.4c16.4 32.2 38.8 66.4 62.1 98.3c20.3 27.9 40.7 53.3 57.2 73.1c16.5-19.8 36.9-45.2 57.2-73.1c23.2-31.9 45.6-66.2 62.1-98.3C328.3 234 336 208.3 336 192zm48 0c0 83.1-105.6 219-160.2 283.6C204.8 498.1 192 512 192 512s-12.8-13.9-31.8-36.4C105.6 411 0 275.1 0 192C0 86 86 0 192 0S384 86 384 192zm-160 0a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm-112 0a80 80 0 1 1 160 0 80 80 0 1 1 -160 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class=" font-bold">{{ $setting['footerAddress'] }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- social_network_svg -->
                    <div class="w-full py-6 flex items-center justify-center gap-10">
                        <a href="{{ $setting['footerInstagram'] }}"
                            class="p-2 rounded-full bg-[var(--background)] border border-green-700 flex justify-center items-center cursor-pointer scale transition_root">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="sm:size-4 size-4 fill-green-700">
                                <path
                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                </path>
                            </svg>
                        </a>
                        <a href="{{ $setting['footerTelegram'] }}"
                            class="p-2 rounded-full bg-[var(--background)] border border-green-700 flex justify-center items-center cursor-pointer scale transition_root">
                            <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"
                                class="sm:size-4 size-4 fill-green-700">
                                <path
                                    d="M1764 11q33 24 27 64l-256 1536q-5 29-32 45-14 8-31 8-11 0-24-5l-527-215-298 327q-18 21-47 21-14 0-23-4-19-7-30-23.5t-11-36.5v-452l-472-193q-37-14-40-55-3-39 32-59l1664-960q35-21 68 2zm-342 1499l221-1323-1434 827 336 137 863-639-478 797z">
                                </path>
                            </svg>
                        </a>
                        <a href="{{ $setting['footerEmailSocial'] }}"
                            class="p-2 rounded-full bg-[var(--background)] border border-green-700 flex justify-center items-center cursor-pointer scale transition_root">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="sm:size-4 size-4 fill-green-700">
                                <path
                                    d="M464 258.2c0 2.7-1 5.2-4.2 8c-3.8 3.1-10.1 5.8-17.8 5.8H344c-53 0-96 43-96 96c0 6.8 .7 13.4 2.1 19.8c3.3 15.7 10.2 31.1 14.4 40.6l0 0c.7 1.6 1.4 3 1.9 4.3c5 11.5 5.6 15.4 5.6 17.1c0 5.3-1.9 9.5-3.8 11.8c-.9 1.1-1.6 1.6-2 1.8c-.3 .2-.8 .3-1.6 .4c-2.9 .1-5.7 .2-8.6 .2C141.1 464 48 370.9 48 256S141.1 48 256 48s208 93.1 208 208c0 .7 0 1.4 0 2.2zm48 .5c0-.9 0-1.8 0-2.7C512 114.6 397.4 0 256 0S0 114.6 0 256S114.6 512 256 512c3.5 0 7.1-.1 10.6-.2c31.8-1.3 53.4-30.1 53.4-62c0-14.5-6.1-28.3-12.1-42c-4.3-9.8-8.7-19.7-10.8-29.9c-.7-3.2-1-6.5-1-9.9c0-26.5 21.5-48 48-48h97.9c36.5 0 69.7-24.8 70.1-61.3zM160 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-64a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm128-64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm64 64a32 32 0 1 0 0-64 32 32 0 1 0 0 64z">
                                </path>
                            </svg>
                        </a>
                        <a href="{{ $setting['footerCopyright'] }}"
                            class="p-2 rounded-full bg-[var(--background)] border border-green-700 flex justify-center items-center cursor-pointer scale transition_root">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class="sm:size-4 size-4 fill-green-700">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <!-- social_network_svg -->
                </div>
                <!-- news -->
            </div>
            <div class="mx-auto flex flex-col gap-1 items-center justify-center">
                <p class="xl:text-[15px] lg:text-[12px] text-[13px]">{{ $setting['footerDesignerText'] }}</p>
                <span class="text-[17px] font-bold text-green-700">{{ $setting['footerDesignerPhone'] }}</span>
            </div>
        </section>
    </footer>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
</body>

</html>
