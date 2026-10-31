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
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer"
                onclick="showMessage('close')" viewBox="0 0 384 512">
                <path
                    d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z" />
            </svg>
        </div>
    </div>

    <div class="2xl:container w-full mx-auto flex flex-col gap-3 bg-(#f6f7fc) pb-5">
        <div class="w-full flex flex-row items-center justify-between">
            <div class="flex flex-col gap-1.5">
                <h2 class="text-md font-bold text-(--primary-text-color)">لیست سفارشات</h2>
                <span class="text-xs text-(--secondary-text-color)">مدیریت و مشاهده سفارشات</span>
            </div>
            <button
                class="flex flex-row items-center justify-center gap-2 px-3 py-1.5 rounded-md border-1 border-gray-200 bg-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-(--primary-text-color)" viewBox="0 0 512 512">
                    <path
                        d="M0 73.7C0 50.7 18.7 32 41.7 32H470.3c23 0 41.7 18.7 41.7 41.7c0 9.6-3.3 18.9-9.4 26.3L336 304.5V447.7c0 17.8-14.5 32.3-32.3 32.3c-7.3 0-14.4-2.5-20.1-7l-92.5-73.4c-9.6-7.6-15.1-19.1-15.1-31.3V304.5L9.4 100C3.3 92.6 0 83.3 0 73.7zM55 80L218.6 280.8c3.5 4.3 5.4 9.6 5.4 15.2v68.4l64 50.8V296c0-5.5 1.9-10.9 5.4-15.2L457 80H55z" />
                </svg>
                <span class="text-xs font-bold text-(--primary-text-color)">فیلتر</span>
            </button>
        </div>

        <div class="hidden md:block bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm text-right">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 font-medium">ردیف</th>
                        <th class="px-4 py-3 font-medium">شماره سفارش</th>
                        <th class="px-4 py-3 font-medium">مشتری</th>
                        <th class="px-4 py-3 font-medium">تاریخ</th>
                        <th class="px-4 py-3 font-medium">مبلغ</th>
                        <th class="px-4 py-3 font-medium">وضعیت</th>
                        <th class="px-4 py-3 font-medium text-left">عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">

                    @if (isset($orders))
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($orders as $order)
                        @php
                            $i++
                        @endphp
                            <tr class="hover:bg-gray-50 orders">
                                <td class="px-4 py-3 font-medium whitespace-nowrap">{{ $i }}</td>
                                <td class="px-4 py-3 font-medium whitespace-nowrap in-fa">#{{ $order->order_code }}</td>
                                <td class="px-4 py-3 whitespace-nowrap in-fa">{{ $order->user->name.' '.$order->user->family }}</td>
                                <td class="px-4 py-3 text-gray-500 whitespace-nowrap in-fa">{{ $order->time . ' | ' . $order->date }}</td>
                                <td class="px-4 py-3 whitespace-nowrap in-fa">{{ number_format($order->totalPrice) }} تومان</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-[{{ $order->state->color }}] whitespace-nowrap order-status-desktop">{{ $order->state->title }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button onclick="showItems(this, {{ $order->id }})"
                                            class="px-2.5 py-1.5 rounded-lg text-xs font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 transition whitespace-nowrap order-show-btn-desktop"
                                            title="مشاهده آیتم‌ها">  
                                            📋 آیتم‌ها
                                        </button>
                                        <button onclick="showReceipt(this, '{{ $order->receipt }}')"
                                            class="px-2.5 py-1.5 rounded-lg text-xs font-medium bg-sky-50 hover:bg-sky-100 text-sky-700 transition whitespace-nowrap"
                                            title="مشاهده رسید">
                                            🧾 رسید
                                        </button>
                                        {{-- <button onclick='deleteOrder(this, "{{ $order->id }}")'
                                            class="px-2.5 py-1.5 rounded-lg text-xs font-medium bg-rose-50 hover:bg-rose-100 text-rose-600 transition whitespace-nowrap"
                                            title="حذف سفارش">
                                            🗑️ حذف
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

        <div class="md:hidden space-y-4" id="parentOrdersBlock">
            @if (isset($orders))
                @php
                    $i = 0;
                @endphp
                @foreach ($orders as $order)
            
                    @php
                        $i++;
                    @endphp

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 space-y-3 orders">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-500 mt-1">{{ $i }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold in-fa">#{{ $order->order_code }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $order->user->name . ' ' . $order->user->family }}
                                </p>
                            </div>
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-[{{ $order->state->color }}] order-status">{{ $order->state->admin_title }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span class="in-fa">{{ $order->time . ' | ' . $order->date }}</span>
                            <span class="font-medium text-gray-900 in-fa">{{ $order->totalPrice }} تومان</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <button onclick="showItems(this, {{ $order->id }})"
                                class="flex items-center justify-center gap-1 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium transition order-show-btn">📋
                                آیتم‌ها</button>
                            <button onclick="showReceipt(this, '{{ $order->receipt }}')"
                                class="flex items-center justify-center gap-1 py-2 rounded-lg bg-sky-50 hover:bg-sky-100 text-sky-700 text-xs font-medium transition">🧾
                                رسید</button>
                            {{-- <button onclick='deleteOrder(this, "{{ $order->id }}")'
                                class="flex items-center justify-center gap-1 py-2 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-medium transition">🗑️
                                حذف</button> --}}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


    </div>

    <div id="orderBlock"
        class="fixed w-full h-dvh bg-black/50 top-0 right-0 z-999999 transition-all duration-300 invisible opacity-0">
        <div class="w-full h-full flex justify-center items-center lg:w-[calc(100%-265px)] lg:float-end">
            <div class="w-11/12 lg:w-3/4 p-3 lg:p-5 rounded-xl bg-white relative pt-5">
                {{-- <span class="absolute -top-4 -right-2 text-md bg-white p-2 rounded-full cursor-pointer" onclick="hideItems()">❌</span> --}}
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
                <div class="w-full flex flex-col gap-2 max-h-[500px] overflow-y-auto p-3 mt-3 border-t-1 border-gray-200"
                    style="scrollbar-width: thin;" id="itemList"></div>
            </div>
        </div>
    </div>

    <div id="receiptBlock"
        class="fixed w-full h-dvh bg-black/50 top-0 right-0 z-9 invisible opacity-0 transition-all duration-300">
        <div class="w-full lg:w-[calc(100%-265px)] float-end flex justify-center items-center h-full">
            <div class="w-11/12 lg:w-1/2 p-5 flex justify-center items-center rounded-lg bg-white relative">
                <span class="absolute top-3 right-6 cursor-pointer" onclick="closeReceipt()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-gray-600" viewBox="0 0 384 512">
                        <path
                            d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z" />
                    </svg>
                </span>
                <img src="" class="w-full h-100 mt-6" alt="">
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
        let receiptBlock = document.getElementById('receiptBlock')

        function showItems(el, orderId) {
            el.disabled = true
            el.classList.add('cursor-no-drop')
            el.classList.remove('cursor-pointer')
            el.classList.add('opacity-50')
            $.ajax({
                url: "{{ url('api/order/showItems') }}/" + orderId,
                type: "GET",
                success: function(data) {

                    let formatter = new Intl.NumberFormat('en-US')

                    itemList.innerHTML = ""
                    orderBlock.classList.remove('invisible')
                    orderBlock.classList.remove('opacity-0')
                    el.disabled = false
                    el.classList.remove('cursor-no-drop')
                    el.classList.remove('opacity-50')
                    el.classList.add('cursor-pointer')

                    tableName.innerHTML = data.qr_code ? (data.qr_code.description ? data.qr_code.description :
                        data.qr_code.slug) : `<svg xmlns="http://www.w3.org/2000/svg" onclick="hideItems()" class="w-4 cursor-pointer fill-gray-600" viewBox="0 0 384 512">
                        <path d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z"/>
                    </svg>`
                    orderStatus.classList =
                        `text-[10px] font-bold px-2 py-0.5 rounded-full border-1 border-[${ data.state.color }] text-[${ data.state.color }] bg-[${ data.state.color }]/10`
                    orderStatus.innerText = data.state.title
                    orderCode.innerText = '#' + data.order_code
                    if (data.address) {
                        address.parentElement.classList.remove('hidden')
                        address.innerText = data.address
                    }
                    data.carts.forEach((cart) => {
                        let item = document.createElement('div')
                        item.classList =
                            'w-full px-2 py-1.5 bg-white rounded-xl flex justify-between items-center shadow_box menuItems'
                        item.setAttribute('data-menu-item-id', cart.product_id)
                        let inner = `
                        <div class="w-full flex gap-3 items-center relative">
                            <div class="w-7/12 relative">
                    `
                        if (cart.product) {
                            inner += `
                        <img src='${cart.product.media[0].media_path ? "{{ asset('storage/') }}/" + cart.product.media[0].media_path : "{{ asset('storage/resturan_img/807c88cc-7948-4f75-88e5-4c4598ab8175_1767800481_6872954f6e4630ba6c0eda84b2ca1882.jpg') }}"}'
                                alt="" class="w-full min-h-24 max-h-24 rounded-xl object-cover">
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
                        }
                        console.log(cart)
                        if (cart.pack) {
                            inner += `
                        <img src='${cart.pack.image ? "{{ asset('storage/') }}/" + cart.pack.image : "{{ asset('storage/resturan_img/807c88cc-7948-4f75-88e5-4c4598ab8175_1767800481_6872954f6e4630ba6c0eda84b2ca1882.jpg') }}"}'
                                alt="" class="w-full min-h-24 max-h-24 rounded-xl object-cover">
                       </div>
                        <div class="w-full flex h-full flex-col gap-1 items-start">
                            <div class="w-full flex gap-1 items-center">
                                <span class="w-[7px] h-[7px] rounded-full bg-[#f6911e]"></span>
                                <h3 class="text-[14px] font-bold">${ cart.pack.title }</h3>
                            </div>
                            <div class="flex flex-row items-center gap-2">
                                <div class="flex gap-1 relative ${ cart.pack.secondary_price ? 'through' : '' }">
                                    <span class="text-[10px] text-[#f6911e] in-fa">${ formatter.format(cart.pack.primary_price) }</span>
                                    <span class='text-[10px] text-[#f6911e] ${ cart.pack.secondary_price ? '' : 'hidden' } '></span>
                                </div>
                                <div class="flex gap-1 relative ${ cart.pack.secondary_price ? '' : 'hidden' }">
                                    <span class="text-[10px] text-[#f6911e] font-bold in-fa">${ formatter.format(cart.pack.secondary_price) }</span>
                                    <span class="text-[10px] text-[#f6911e]">تومان</span>
                                </div>
                            </div>
                            <p class="text-[10px] text-[#6B7280] mt-0.5">${ cart.pack.description ?? "" }</p>
                            <div class="flex flex-wrap gap-1">
                                <span class="px-1.5 py-0.5 rounded-full text-[9px] bg-[#f5d4ae] text-[#f6911e]">محبوب ها</span>
                                <span class="px-1.5 py-0.5 rounded-full text-[9px] bg-[#F3F3F3] ">محبوب ها</span>
                                <span class="px-1.5 py-0.5 rounded-full text-[9px] bg-[#F3F3F3] ">محبوب ها</span>
                            </div>
                        </div>
                    </div>
                        <div class="flex gap-1 items-center">
                            <div class="h-full flex flex-col gap-2 items-center justify-center px-1" data-item-id="${ cart.pack_id }">
    
                                <span class="text-xs text-(--secondary-text-color)">تعداد</span>
                                <span class="text-xs text-(--primary-text-color) font-bold in-fa">${cart.quantity}</span>
    
                            </div>
                        </div>
                    `
                        }
                        item.innerHTML = inner
                        itemList.appendChild(item)

                    })
                },
                error: function() {
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

     
        function showReceipt(el, img) {
            let path = "{{ asset('storage/') }}/" + img
            receiptBlock.classList.remove('invisible', 'opacity-0')
            receiptBlock.querySelector('img').src = path
        }

        function closeReceipt() {
            receiptBlock.classList.add('invisible', 'opacity-0')
        }
    </script>


@endsection
