@extends('admin.app.dashboard')
@section('title', 'طبابوک | لیست سفارشات')
@section('content')

    <style>
        .shadow_box {
            box-shadow: 0px 0px 1px 1px #ebebeb;
        }

        .selected_shadow_box {
            box-shadow: 0px 0px 1px 1px var(--primary-color);
        }

        .through::after {
            content: '';
            position: absolute;
            height: 1px;
            width: 100%;
            background-color: gray;
            top: 35%;
        }

        .through {
            font-size: 8px !important;
        }
    </style>

    <div class="absolute top-0 opacity-0 invisible right-1/2 translate-x-1/2 w-3/4 lg:w-1/3 bg-white rounded-lg shadow-md transition-all duration-500 z-99999999"
         id="message">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="size-4 absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer"
                 onclick="showMessage('close')" viewBox="0 0 384 512">
                <path d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z"/>
            </svg>
        </div>
    </div>

    <div class="2xl:container w-full mx-auto flex flex-col gap-3 bg-(#f6f7fc) pb-5">
        <div class="w-full flex flex-row items-center justify-between">
            <div class="flex flex-col gap-1.5">
                <h2 class="text-md font-bold text-(--primary-text-color)">لیست سفارشات</h2>
                <span class="text-xs text-(--secondary-text-color)">مدیریت و مشاهده سفارشات</span>
            </div>
            <button class="flex flex-row items-center justify-center gap-2 px-3 py-1.5 rounded-md border-1 border-gray-200 bg-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-(--primary-text-color)"
                     viewBox="0 0 512 512">
                    <path d="M0 73.7C0 50.7 18.7 32 41.7 32H470.3c23 0 41.7 18.7 41.7 41.7c0 9.6-3.3 18.9-9.4 26.3L336 304.5V447.7c0 17.8-14.5 32.3-32.3 32.3c-7.3 0-14.4-2.5-20.1-7l-92.5-73.4c-9.6-7.6-15.1-19.1-15.1-31.3V304.5L9.4 100C3.3 92.6 0 83.3 0 73.7zM55 80L218.6 280.8c3.5 4.3 5.4 9.6 5.4 15.2v68.4l64 50.8V296c0-5.5 1.9-10.9 5.4-15.2L457 80H55z"/>
                </svg>
                <span class="text-xs font-bold text-(--primary-text-color)">فیلتر</span>
            </button>
        </div>
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-3" id="parentOrdersBlock">
            @if (isset($orders))
                @foreach ($orders as $order)
                  
                        <div class="w-full p-3 bg-white rounded-md flex flex-col shadow-[0px_0px_2px_1px_#e7e7ef] orders"
                             >
                            <div class="w-full flex flex-row items-center justify-between pb-3 border-b border-[#e4e5ea]">
                                <div class="flex flex-row items-center gap-2">
                                    <div class="size-8 bg-[#f4f4f6] rounded-full flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="size-6"
                                             viewBox="0 0 48 48"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="2"
                                             stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <!-- Table -->
                                            <path d="M19 10H29"/>
                                            <path d="M19 10V16"/>
                                            <path d="M29 10V16"/>
                                            <!-- Left chair -->
                                            <path d="M10 10V36"/>
                                            <path d="M10 24H20"/>
                                            <path d="M20 24V36"/>
                                            <!-- Right chair -->
                                            <path d="M38 10V36"/>
                                            <path d="M28 24H38"/>
                                            <path d="M28 24V36"/>
                                        </svg>
                                    </div>
                                    <span class="font-bold text-xs text-(--primary-text-color) in-fa order-table">{{ $order->user->phoneNumber }}</span>
                                    <span class="text-[10px] px-2 py-0.5 bg-blue-500/10 rounded-full border-1 border-blue-500 order-status">در انتظار</span>
                                </div>
                                <div class="flex flex-col gap-1.5 items-end">
                                    <span class="text-[10px] text-(--secondary-text-color)">شماره سفارش</span>
                                    <span class="text-xs font-bold text-(--primary-text-color) order-code">#{{ $order->order_code }}</span>
                                </div>
                            </div>
                            <div class="pt-3 w-full flex flex-col gap-3.5">
                                <div class="w-full flex flex-row items-center">
                                    <div class="w-1/3 flex flex-col items-center justify-center gap-1.5 border-l-1 border-[#e4e5ea]">
                                        <div class="flex flex-row items-center gap-0.5">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="size-5"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="black"
                                                 stroke-width="1.7"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <!-- Bag body -->
                                                <path d="M6 8H18L19 20H5L6 8Z"/>
                                                <!-- Handle -->
                                                <path d="M8.5 8V6.8
                                     C8.5 4.7 10 3.5 12 3.5
                                     C14 3.5 15.5 4.7 15.5 6.8V8"/>
                                            </svg>
                                            <span class="text-[10px] text-(--secondary-text-color)">تعداد آیتم</span>
                                        </div>
                                        <span class="text-xs font-bold text-(--primary-text-color) in-fa order-item-count">{{ count($order->carts) }} آیتم</span>
                                    </div>
                                    <div class="w-1/3 flex flex-col items-center justify-center gap-1.5 border-l-1 border-[#e4e5ea]">
                                        <div class="flex flex-row items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="size-4 fill-(--secondary-text-color)" viewBox="0 0 448 512">
                                                <path d="M112 0c8.8 0 16 7.2 16 16V64H320V16c0-8.8 7.2-16 16-16s16 7.2 16 16V64h32c35.3 0 64 28.7 64 64v32 32V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V192 160 128C0 92.7 28.7 64 64 64H96V16c0-8.8 7.2-16 16-16zM416 192H312v72H416V192zm0 104H312v80H416V296zm0 112H312v72h72c17.7 0 32-14.3 32-32V408zM280 376V296H168v80H280zM168 408v72H280V408H168zm-32-32V296H32v80H136zM32 408v40c0 17.7 14.3 32 32 32h72V408H32zm0-144H136V192H32v72zm136 0H280V192H168v72zM384 96H64c-17.7 0-32 14.3-32 32v32H416V128c0-17.7-14.3-32-32-32z"/>
                                            </svg>
                                            <span class="text-[10px] text-(--secondary-text-color)">تاریخ</span>
                                        </div>
                                        <span class="text-xs font-bold text-(--primary-text-color) in-fa order-date">{{ $order->date }}</span>
                                    </div>
                                    <div class="w-1/3 flex flex-col items-center justify-center gap-1.5">
                                        <div class="flex flex-row items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="size-5"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="black"
                                                 stroke-width="1.6"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="6.8"/>
                                                <path d="M12 8.5V12"/>
                                                <path d="M12 12L14.8 13.8"/>
                                            </svg>
                                            <span class="text-[10px] text-(--secondary-text-color)">زمان ثبت</span>
                                        </div>
                                        <span class="text-xs font-bold text-(--primary-text-color) in-fa order-time">{{ $order->time }}</span>
                                    </div>
                                </div>
                                <div class="w-full flex flex-col gap-1">

                                    <div class="w-full flex flex-row items-center gap-2">
                                        <button class="w-1/2 flex flex-row gap-1 items-center justify-center py-1.5 rounded-md border-1 border-blue-500 bg-blue-500 text-white text-xs cursor-pointer order-show-btn" onclick="showItems(this, {{ $order->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-white"
                                                 viewBox="0 0 576 512">
                                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                            </svg>
                                            مشاهده آیتم ها
                                        </button>
                                        <button class="w-[25%] flex flex-row gap-1 items-center justify-center py-1.5 rounded-md border-1 border-[#e4e5ea] text-(--secondary-text-color) text-xs cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="size-4"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="black"
                                                 stroke-width="1.4"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <rect x="8.2" y="4" width="7.6" height="3.8" rx="0.4"/>
                                                <rect x="4.8" y="8" width="14.4" height="6.8" rx="0.8"/>
                                                <rect x="8.2" y="13.2" width="7.6" height="6.8" rx="0.4"/>
                                                <circle cx="17" cy="11.2" r="0.5" fill="currentColor" stroke="none"/>
                                            </svg>
                                            چاپ فیش
                                        </button>
                                        <button class="w-[20%] flex flex-row gap-1 items-center justify-center py-1.5 rounded-md border-1 border-rose-500 text-rose-500 text-xs cursor-pointer"
                                                onclick='deleteOrder(this, "{{ $order->id }}")'>
                                            حذف
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-rose-500"
                                                 viewBox="0 0 448 512">
                                                <path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    {{-- <div class="w-full flex justify-center">
                                        <button class="min-w-full max-w-full flex items-center justify-center gap-0.5 bg-(--color-green) py-1 rounded-lg cursor-pointer order-accept-btn"
                                                onclick='accept("{{ $order->id }}", this, "{{ $order->status->id }}")'>
                                            <span class="text-white text-sm font-bold">{{ $order->status->admin_title }}</span>
                                            <svg class="size-6 rounded-lg" viewBox="0 0 36 36" fill="white">
                                                <path class="clr-i-outline clr-i-outline-path-1"
                                                      d="M18,6A12,12,0,1,0,30,18,12,12,0,0,0,18,6Zm0,22A10,10,0,1,1,28,18,10,10,0,0,1,18,28Z"></path>
                                                <path d="M16.34,23.74l-5-5a1,1,0,0,1,1.41-1.41l3.59,3.59,6.78-6.78a1,1,0,0,1,1.41,1.41Z"></path>
                                                <path class="clr-i-solid clr-i-solid-path-1"
                                                      d="M30,18A12,12,0,1,1,18,6,12,12,0,0,1,30,18Zm-4.77-2.16a1.4,1.4,0,0,0-2-2l-6.77,6.77L13,17.16a1.4,1.4,0,0,0-2,2l5.45,5.45Z"
                                                      style="display:none"></path>
                                            </svg>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    
                @endforeach
            @endif
        </div>


    </div>

    <div id="orderBlock" class="fixed w-full h-dvh bg-black/50 top-0 right-0 z-999999 transition-all duration-300 invisible opacity-0">
        <div class="w-full h-full flex justify-center items-center lg:w-[calc(100%-265px)] lg:float-end">
            <div class="w-11/12 lg:w-3/4 p-3 lg:p-5 rounded-xl bg-white relative pt-5">
                <span class="absolute -top-4 -right-2 text-md bg-white p-2 rounded-full cursor-pointer" onclick="hideItems()">❌</span>
                <div class="w-full flex flex-row items-center">
                    <h2 class="w-1/3 text-sm font-bold text-(--primary-text-color) in-fa" id="tableName"></h2>
                    <div class="w-1/3 flex flex-row justify-center">
                        <span id="orderStatus"></span>
                    </div>
                    <h3 class="w-1/3 text-sm font-bold text-(--primary-text-color) in-fa text-end" id="orderCode"></h3>
                </div>
                <div class="mt-2 hidden">
                    <h4 class="text-xs text-(--primary-text-color) mb-2">آدرس :</h4>
                    <p class="text-xs text-(--secondary-text-color) text-center my-2 in-fa" id="address"></p>
                </div>
                <div class="w-full flex flex-col gap-2 max-h-[500px] overflow-y-auto p-3 mt-3 border-t-1 border-gray-200" style="scrollbar-width: thin;" id="itemList"></div>
            </div>
        </div>
    </div>

        {{-- <script src="https://cdn.jsdeliver.net/npm/pusher-js8/dist/web/pusher.min.js"></script>
        <script src="{{ asset('assets/js/echo.js') }}"></script> --}}
    <script>
        let orderBlock = document.getElementById('orderBlock')
        let itemList = document.getElementById('itemList')
        let tableName = document.getElementById('tableName')
        let orderCode = document.getElementById('orderCode')
        let orderStatus = document.getElementById('orderStatus')
        let address = document.getElementById('address')
        let orders = document.querySelectorAll('.orders')
        let message = document.getElementById('message')
        let element = document.createElement('div')
        element.classList = "text-sm font-bold flex flex-row items-center justify-center py-3 gap-2 lg:gap-3"


        function showItems(el, orderId) {
            el.disabled = true
            el.classList.add('cursor-no-drop')
            el.classList.remove('cursor-pointer')
            el.classList.add('opacity-50')
            $.ajax({
                url: "{{ url('api/order/showItems') }}/"+orderId,
                type: "GET",
                success: function (data) {
                    console.log(data)
                    let formatter = new Intl.NumberFormat('en-US')
                    console.log(data)
                    itemList.innerHTML = ""
                    orderBlock.classList.remove('invisible')
                    orderBlock.classList.remove('opacity-0')
                    el.disabled = false
                    el.classList.remove('cursor-no-drop')
                    el.classList.remove('opacity-50')
                    el.classList.add('cursor-pointer')

                    tableName.innerText = data.qr_code ? (data.qr_code.description ? data.qr_code.description : data.qr_code.slug) : "-"
                    // orderStatus.innerText = data.status.title
                    orderStatus.classList = `text-[10px] font-bold px-2 py-0.5 rounded-full border-1 border-blue-500 text-blue-500 bg-blue-500/10`
                    orderCode.innerText = '#'+data.order_code
                    if(data.address){
                        address.parentElement.classList.remove('hidden')
                        address.innerText = data.address
                    }
                    data.carts.forEach((cart)=>{
                        let item = document.createElement('div')
                        item.classList = 'w-full px-2 py-1.5 bg-white rounded-xl flex justify-between items-center shadow_box menuItems'
                        item.setAttribute('data-menu-item-id', cart.product_id)
                        let inner = `
                        <div class="w-full flex gap-3 items-center relative">
                            <div class="w-7/12 relative">
                    `

                    inner+= `
                    <img src='${cart.product.media[0].media_path ? "{{ asset('storage/') }}/" + cart.product.media[0].media_path : "{{ asset('storage/resturan_img/807c88cc-7948-4f75-88e5-4c4598ab8175_1767800481_6872954f6e4630ba6c0eda84b2ca1882.jpg') }}"}'
                            alt="" class="w-full min-h-24 max-h-24 rounded-xl">
                   </div>
                    <div class="w-full flex h-full flex-col gap-1 items-start">
                        <div class="w-full flex gap-1 items-center">
                            <span class="w-[7px] h-[7px] rounded-full bg-[#f6911e]"></span>
                            <h3 class="text-[14px] font-bold">${ cart.product.title }</h3>
                        </div>
                        <div class="flex flex-row items-center gap-2">
                            <div class="flex gap-1 relative ${ cart.product.secondary_price ? 'through' : '' }">
                                <span class="text-[10px] text-[#f6911e] in-fa">${ formatter.format(cart.product.primary_price) }</span>
                                <span class='text-[10px] text-[#f6911e] ${ cart.product.secondary_price ? '' : 'hidden' } '></span>
                            </div>
                            <div class="flex gap-1 relative ${ cart.product.secondary_price ? '' : 'hidden' }">
                                <span class="text-[10px] text-[#f6911e] font-bold in-fa">${ formatter.format(cart.product.secondary_price) }</span>
                                <span class="text-[10px] text-[#f6911e]">تومان</span>
                            </div>
                        </div>
                        <p class="text-[10px] text-[#6B7280] mt-0.5">${ cart.product.description ?? "" }</p>
                        <div class="flex flex-wrap gap-1">
                            <span class="px-1.5 py-0.5 rounded-full text-[9px] bg-[#f5d4ae] text-[#f6911e]">محبوب ها</span>
                            <span class="px-1.5 py-0.5 rounded-full text-[9px] bg-[#F3F3F3] ">محبوب ها</span>
                            <span class="px-1.5 py-0.5 rounded-full text-[9px] bg-[#F3F3F3] ">محبوب ها</span>
                        </div>
                    </div>
                </div>
                    <div class="flex gap-1 items-center">
                        <div class="h-full flex flex-col gap-2 items-center justify-center px-1" data-item-id="${ cart.product_id }">

                            <span class="text-xs text-(--secondary-text-color)">تعداد</span>
                            <span class="text-xs text-(--primary-text-color) font-bold in-fa">${cart.quantity}</span>

                        </div>
                    </div>
                `
                        item.innerHTML = inner
                        itemList.appendChild(item)

                    })
                },
                error: function () {
                    showMessage('open')
                    element.innerHTML = `
                        <span>خطا در دریافت اطلاعات</span>
                        <span class="text-red-500">!</span>
                        `
                    message.children[0].appendChild(element)
                    setTimeout(() => {
                        showMessage('close')
                    }, 2000)
                }
            })
        }

        function hideItems() {
            orderBlock.classList.add('invisible')
            orderBlock.classList.add('opacity-0')
            // orderStatus.innerText = ''
            // orderCode.innerText = ''
            // tableName.innerText = ''
            // address.innerText = ''
        }

        function showMessage(state) {
            if (state == 'open') {
                message.classList.remove('top-0')
                message.classList.remove('opacity-0')
                message.classList.remove('invisible')
                message.classList.add('top-1/10')
            }
            if (state == 'close') {
                message.classList.remove('top-1/10')
                message.classList.add('top-0')
                message.classList.add('opacity-0')
                message.classList.add('invisible')
            }
        }

        {{-- function accept(orderId, element, status) {
            orders = document.querySelectorAll('.orders')
            $.ajax({
                url: "{{ url('api/order/acceptOrder') }}",
                type: "POST",
                dataType: "json",
                data: {
                    'status': status,
                    'order_id': orderId
                },
                success: function (data) {
                    console.log(data.status.title)
                    orders.forEach((order) => {
                        if (order.getAttribute('data-order-id') == data.id) {
                            if (data.status.id === 5 || data.status.id === 6) {
                                order.remove()
                            } else {
                                let table = order.querySelector('.order-table')
                                let status = order.querySelector('.order-status')
                                let show = order.querySelector('.order-show-btn')
                                let accept = order.querySelector('.order-accept-btn')
                                table.innerText = data.qr_code ? (data.qr_code.description ? data.qr_code.description : data.qr_code.slug) : "-"
                                status.classList = `text-[10px] text-blue-500 px-2 py-0.5 bg-blue-500/10 rounded-full border-1 border-blue-500 order-status`
                                status.innerText = data.status.title
                                show.classList = `w-1/2 flex flex-row gap-1 items-center justify-center py-1.5 rounded-md border-1 border-blue-500 bg-blue-500 text-white text-xs cursor-pointer order-show-btn`
                                accept.setAttribute('onclick', `accept(${data.id}, this, ${data.status.id})`)
                                accept.innerHTML = `
                                    <span class="text-white text-sm font-bold">${data.status.admin_title}</span>
                                    <svg class="size-6 rounded-lg" viewBox="0 0 36 36" fill="white">
                                        <path class="clr-i-outline clr-i-outline-path-1" d="M18,6A12,12,0,1,0,30,18,12,12,0,0,0,18,6Zm0,22A10,10,0,1,1,28,18,10,10,0,0,1,18,28Z"></path>
                                        <path d="M16.34,23.74l-5-5a1,1,0,0,1,1.41-1.41l3.59,3.59,6.78-6.78a1,1,0,0,1,1.41,1.41Z"></path>
                                        <path class="clr-i-solid clr-i-solid-path-1" d="M30,18A12,12,0,1,1,18,6,12,12,0,0,1,30,18Zm-4.77-2.16a1.4,1.4,0,0,0-2-2l-6.77,6.77L13,17.16a1.4,1.4,0,0,0-2,2l5.45,5.45Z" style="display:none"></path>
                                    </svg>`
                            }
                        }
                    })

                },
                error: function () {
                    alert('error')
                }
            })
        } --}}

        {{-- function deleteOrder(el, id) {
            orders = document.querySelectorAll('.orders')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })
            $.ajax({
                url: "{{ url('api/order/delete') }}/" + id,
                type: "GET",
                success: function (data) {
                    console.log(data)
                    orders.forEach((order) => {
                        if (order.getAttribute('data-order-id') == data) {
                            order.remove()
                        }
                    })
                },
                error: function () {
                    console.log('error')
                }
            })
        }--}}
        
 </script>

  
@endsection