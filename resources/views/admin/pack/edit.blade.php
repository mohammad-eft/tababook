@extends('admin.app.dashboard')

@section('title')
    طبابوک | ویرایش پک {{ $pack->title }}
@endsection

@section('content')
    <style>
        /* ===== MultiSelect Base Styles ===== */
        .multi-select {
            position: relative;
            width: 100%;
        }

        .multi-select .multi-select-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
            min-height: 46px;
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
            transition: all 0.2s;
            direction: rtl;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .multi-select .multi-select-header:hover {
            border-color: #818cf8;
        }

        .multi-select .multi-select-header.multi-select-header-active {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .multi-select-header-placeholder {
            color: #94a3b8;
            font-size: 14px;
        }

        .multi-select-header-option {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #eef2ff;
            color: #4338ca;
            padding: 3px 8px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            direction: rtl;
            flex-direction: row;
        }

        .multi-select-header-option small {
            color: #6366f1;
            font-size: 11px;
        }

        .multi-select-header-remove {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ef4444;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 0;
            font-size: 12px;
            line-height: 1;
            transition: background 0.15s;
            flex-shrink: 0;
        }

        .multi-select-header-remove:hover {
            background: #dc2626;
        }

        .multi-select-header-max {
            font-size: 11px;
            color: #64748b;
            margin-right: auto;
        }

        .multi-select-options {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 100;
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 8px;
            margin-top: 4px;
            max-height: 320px;
            overflow-y: auto;
            direction: rtl;
        }

        .multi-select-header-active+.multi-select-options {
            display: block;
        }

        .multi-select-search {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 8px 12px;
            margin-bottom: 6px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            background: #f8fafc;
            direction: rtl;
            text-align: right;
        }

        .multi-select-search:focus {
            border-color: #6366f1;
            background: #fff;
        }

        .multi-select-option,
        .multi-select-all,
        .multi-select-group {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            transition: background 0.15s;
            direction: rtl;
            text-align: right;
        }

        .multi-select-option:hover,
        .multi-select-all:hover,
        .multi-select-group:hover {
            background: #f1f5f9;
        }

        .multi-select-option.multi-select-selected,
        .multi-select-all.multi-select-selected,
        .multi-select-group.multi-select-selected {
            background: #eef2ff;
            color: #4338ca;
            font-weight: 500;
        }

        .multi-select-option-radio {
            width: 16px;
            height: 16px;
            min-width: 16px;
            border: 2px solid #cbd5e1;
            border-radius: 50%;
            position: relative;
            transition: all 0.15s;
            flex-shrink: 0;
        }

        .multi-select-option.multi-select-selected .multi-select-option-radio,
        .multi-select-all.multi-select-selected .multi-select-option-radio,
        .multi-select-group.multi-select-selected .multi-select-option-radio {
            border-color: #6366f1;
            background: #6366f1;
        }

        .multi-select-option.multi-select-selected .multi-select-option-radio::after,
        .multi-select-all.multi-select-selected .multi-select-option-radio::after,
        .multi-select-group.multi-select-selected .multi-select-option-radio::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 6px;
            height: 6px;
            background: #fff;
            border-radius: 50%;
        }

        .multi-select-option-text {
            flex: 1;
        }

        .multi-select-all {
            border-bottom: 1px solid #e2e8f0;
            border-radius: 8px 8px 0 0;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .multi-select-group {
            font-weight: 600;
            color: #334155;
            margin-top: 4px;
        }

        .multi-select.disabled .multi-select-header {
            background: #f1f5f9;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .multi-select-invalid .multi-select-header {
            border-color: #ef4444;
        }

        /* ===== کلاس‌های کمکی جستجو ===== */
        .multi-select-option.multi-select-hidden,
        .multi-select-group.multi-select-hidden,
        .multi-select-all.multi-select-hidden {
            display: none !important;
        }

        .multi-select-no-result {
            text-align: center;
            padding: 16px;
            color: #94a3b8;
            font-size: 13px;
            font-style: italic;
        }
    </style>

    <!-- هدر -->
    <header class="max-w-7xl mx-auto mb-8">
        <div
            class="bg-white rounded-2xl shadow-sm p-5 flex flex-wrap items-center justify-between gap-4 border border-slate-200">
            <div class="flex items-center gap-3">
                <div class="bg-indigo-100 p-2 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-slate-800">ویرایش پک: {{ $pack->title }}</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-slate-500">تعداد انتخاب شده: <span id="selectedCount"
                        class="font-bold text-indigo-600">0</span></span>
                <button type="button" id="headerSubmitBtn"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    بروزرسانی پک
                </button>
            </div>
        </div>
    </header>

    <!-- محتوای اصلی -->
    <form id="packForm" method="POST" action="{{ route('pack.update', $pack->id) }}" enctype="multipart/form-data"
        class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

        @csrf
        
        <!-- ستون فرم اطلاعات پک -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 md:p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    اطلاعات پک
                </h2>

                <div class="space-y-5">
                    <!-- عنوان -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">عنوان پک <span
                                class="text-rose-500">*</span></label>
                        <input type="text" id="packTitle" name="title" required
                            value="{{ old('title', $pack->title ?? '') }}"
                            placeholder="مثلاً: پک کتاب‌های روانشناسی"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
                    </div>

                    <!-- خلاصه -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">خلاصه</label>
                        <textarea id="packSummary" name="summary" rows="2" placeholder="توضیح کوتاه درباره پک..."
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm resize-none">{{ old('summary', $pack->summary ?? '') }}</textarea>
                    </div>

                    <!-- توضیحات -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">توضیحات کامل</label>
                        <textarea id="packDescription" name="description" rows="4"
                            placeholder="توضیحات مفصل درباره محتوا، ویژگی‌ها و..."
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm resize-none">{{ old('description', $pack->description ?? '') }}</textarea>
                    </div>

                    <!-- قیمت و تخفیف -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">قیمت (تومان)</label>
                            <input type="number" id="packPrice" name="price" placeholder="۰"
                                value="{{ old('price', $pack->primary_price ?? '') }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">تخفیف (٪)</label>
                            <input type="number" id="packDiscount" name="discount" placeholder="۰"
                                value="{{ old('discount', $pack->secondary_price ?? '') }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
                        </div>
                    </div>

                    <!-- تصویر اصلی -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">تصویر اصلی</label>
                        <div id="mainImageDropzone"
                            class="border-2 border-dashed border-slate-300 rounded-xl p-4 text-center hover:border-indigo-400 transition-colors cursor-pointer bg-slate-50 relative overflow-hidden">
                            <input type="file" id="mainImageInput" name="main_image"
                                accept="image/png, image/jpeg, image/jpg" class="hidden">

                            <!-- پیش‌نمایش تصویر قبلی (اگر وجود داشته باشد) -->
                            @if (!empty($pack->image))
                                <div id="mainImagePreviewWrapper">
                                    <img id="mainImagePreview" src="{{ asset('storage/' . $pack->image) }}"
                                        alt="پیش‌نمایش" class="w-full h-32 object-cover rounded-lg mb-2">
                                    <button type="button" id="removeMainImage"
                                        class="text-xs text-rose-500 hover:text-rose-700 font-medium">
                                        حذف تصویر
                                    </button>
                                </div>
                                <div id="mainImagePlaceholder" class="hidden">
                            @else
                                <div id="mainImagePreviewWrapper" class="hidden">
                                    <img id="mainImagePreview" src="" alt="پیش‌نمایش"
                                        class="w-full h-32 object-cover rounded-lg mb-2">
                                    <button type="button" id="removeMainImage"
                                        class="text-xs text-rose-500 hover:text-rose-700 font-medium">
                                        حذف تصویر
                                    </button>
                                </div>
                                <div id="mainImagePlaceholder">
                            @endif

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-slate-400 mb-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-xs text-slate-500">برای آپلود کلیک کنید یا فایل را بکشید</p>
                                <p class="text-xs text-slate-400 mt-1">PNG, JPG تا 5MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- گالری تصاویر -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">گالری تصاویر</label>
                        <input type="file" id="galleryInput" name="gallery[]"
                            accept="image/png, image/jpeg, image/jpg" multiple class="hidden">
                        <div id="galleryContainer" class="flex flex-wrap gap-2">

                            {{-- نمایش تصاویر گالری قبلی --}}
                            @if (count($pack->gallery))
                                @foreach ($pack->gallery as $gallery)
                                    <div class="w-16 h-16 bg-slate-100 rounded-xl border border-slate-200 overflow-hidden relative group">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="گالری"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            @endif

                            <div id="addGalleryBtn"
                                class="w-16 h-16 bg-slate-100 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-200 transition-colors cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- خلاصه پک -->
            <div
                class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl shadow-sm border border-indigo-100 p-5 md:p-6">
                <h3 class="text-md font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    خلاصه انتخاب‌ها
                </h3>
                <div id="selectedItemsList" class="space-y-2 text-sm text-slate-600">
                    <p class="text-slate-400 italic text-center py-4">هنوز کتابی انتخاب نشده است</p>
                </div>
                <div class="mt-4 pt-4 border-t border-indigo-100 flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-700 in-fa">مجموع قیمت کتاب‌ها:</span>
                    <span id="totalPrice" class="font-bold text-indigo-700 in-fa">۰ تومان</span>
                </div>
            </div>
        </div>

        <!-- ستون انتخاب محصولات با MultiSelect -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 md:p-6 h-full">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                    <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        انتخاب کتاب‌ها
                    </h2>
                    <span class="text-xs text-slate-400">با کلیک روی کتاب‌ها، آن‌ها را به پک اضافه کنید</span>
                </div>

                <select id="booksMultiSelect" class="w-full" name="product[]"
                    data-placeholder="جستجو و انتخاب کتاب‌ها..." multiple data-multi-select>
                    @foreach ($pack->products as $product)
                        <option value="{{ $product->id }}"
                            data-html="<strong>{{ $product->title }}</strong><small class='in-fa'> {{ number_format($product->primary_price ?? 0) }} تومان </small>"
                            @if (in_array($product->id, $selectedProductIds ?? [])) selected @endif>
                            {{ $product->title }}
                        </option>
                    @endforeach
                </select>

                <!-- راهنما و دکمه‌ها -->
                <div
                    class="mt-6 bg-slate-50 rounded-xl border border-slate-200 p-4 text-xs text-slate-500 leading-relaxed">
                    <p class="mb-1"><span class="font-bold text-slate-700">راهنما:</span> روی باکس بالا کلیک کنید تا
                        لیست کتاب‌ها باز شود. می‌توانید جستجو کنید، همه را انتخاب کنید یا هر کتاب را به صورت جداگانه تیک
                        بزنید.</p>
                    <p>کتاب‌های انتخاب شده در باکس نمایش داده می‌شوند و با کلیک روی ضربدر هر کدام، بدون باز کردن لیست،
                        حذف می‌شوند.</p>
                </div>

                <!-- دکمه‌های عملیات -->
                <div class="mt-6 flex flex-wrap justify-end gap-3 border-t border-slate-200 pt-5">
                    <button type="button" id="clearSelectionBtn"
                        class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 text-sm font-medium hover:bg-slate-50 transition-colors">
                        پاک کردن انتخاب‌ها
                    </button>
                    <button type="button" id="submitPackBtn"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        بروزرسانی پک
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- ===== اسکریپت MultiSelect ===== -->
    <script>
        /* =========================================================
               MultiSelect - Created by David Adams
               https://codeshack.io/multi-select-dropdown-html-javascript/
               Released under the MIT license
               (with RTL header + Persian search modifications)
               ========================================================= */
        class MultiSelect {
            constructor(element, options = {}) {
                let defaults = {
                    placeholder: 'Select item(s)',
                    max: null,
                    min: null,
                    disabled: false,
                    search: true,
                    selectAll: true,
                    listAll: true,
                    closeListOnItemSelect: false,
                    name: '',
                    width: '',
                    height: '',
                    dropdownWidth: '',
                    dropdownHeight: '',
                    theme: 'auto',
                    required: false,
                    data: [],
                    onChange: function() {},
                    onSelect: function() {},
                    onUnselect: function() {},
                    onMaxReached: function() {}
                };
                this.options = Object.assign(defaults, options);
                this.selectElement = typeof element === 'string' ? document.querySelector(element) : element;
                if (this.selectElement._multiSelect) {
                    this.selectElement._multiSelect.destroy();
                }
                this.selectElement._multiSelect = this;
                this.originalStyle = this.selectElement.getAttribute('style') || '';
                this.originalTabIndex = this.selectElement.getAttribute('tabindex');
                this._isBatching = false;
                for (const prop in this.selectElement.dataset) {
                    if (this.options[prop] !== undefined) {
                        if (typeof this.options[prop] === 'boolean' || this.selectElement.dataset[prop] === 'true' || this
                            .selectElement.dataset[prop] === 'false') {
                            this.options[prop] = this.selectElement.dataset[prop] === 'true';
                        } else {
                            this.options[prop] = this.selectElement.dataset[prop];
                        }
                    }
                }
                if (this.selectElement.hasAttribute('required')) this.options.required = true;
                if (this.selectElement.hasAttribute('disabled')) this.options.disabled = true;
                this.name = this.selectElement.getAttribute('name') ? this.selectElement.getAttribute('name') :
                    'multi-select-' + Math.floor(Math.random() * 1000000);
                if (!this.options.data.length) {
                    let options = this.selectElement.querySelectorAll('option');
                    for (let i = 0; i < options.length; i++) {
                        let parent = options[i].parentElement;
                        let group = parent.tagName.toLowerCase() === 'optgroup' ? parent.getAttribute('label') : '';
                        this.options.data.push({
                            value: options[i].value,
                            text: options[i].textContent,
                            selected: options[i].selected,
                            disabled: options[i].disabled,
                            html: options[i].getAttribute('data-html'),
                            group: group
                        });
                    }
                }
                this.originalData = JSON.parse(JSON.stringify(this.options.data));
                this.element = this._template();
                this.selectElement.insertAdjacentElement('beforebegin', this.element);
                this.element.appendChild(this.selectElement);
                this.selectElement.multiple = true;
                this.selectElement.setAttribute('tabindex', '-1');
                this.selectElement.style.position = 'absolute';
                this.selectElement.style.left = '0';
                this.selectElement.style.top = '0';
                this.selectElement.style.width = '100%';
                this.selectElement.style.height = '100%';
                this.selectElement.style.opacity = '0';
                this.selectElement.style.zIndex = '-1';
                this.selectElement.style.pointerEvents = 'none';
                this.outsideClickHandler = this._outsideClick.bind(this);
                this._buildOriginalSelect();
                this._updateSelected();
                this._eventHandlers();
                if (this.options.disabled) this.disable();
                if (this.selectElement.form) {
                    this.formResetHandler = () => setTimeout(() => this.reset(), 0);
                    this.selectElement.form.addEventListener('reset', this.formResetHandler);
                }
            }

            _escapeHTML(str) {
                return str !== undefined && str !== null ? str.toString().replace(/[&<>'"]/g, tag => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    "'": '&#39;',
                    '"': '&quot;'
                } [tag] || tag)) : '';
            }

            _normalizeText(text) {
                return (text || '')
                    .toString()
                    .toLowerCase()
                    .replace(/ي/g, 'ی')
                    .replace(/ك/g, 'ک')
                    .replace(/[ًٌٍَُِّْ]/g, '')
                    .replace(/\u200c/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim();
            }

            _template() {
                let optionsHTML = '';
                let groupedData = {};
                this.data.forEach(item => {
                    let g = item.group || '';
                    if (!groupedData[g]) groupedData[g] = [];
                    groupedData[g].push(item);
                });
                for (const [groupName, items] of Object.entries(groupedData)) {
                    if (groupName) {
                        let enabledItems = items.filter(i => !i.disabled);
                        let allGroupSelected = enabledItems.length > 0 && enabledItems.every(i => i.selected);
                        optionsHTML += `
                            <div class="multi-select-group${allGroupSelected ? ' multi-select-selected' : ''}" data-group="${this._escapeHTML(groupName)}" role="option" tabindex="-1">
                                <span class="multi-select-option-radio"></span>
                                <span class="multi-select-option-text">${this._escapeHTML(groupName)}</span>
                            </div>
                        `;
                    }
                    items.forEach(item => {
                        const isSelected = item.selected;
                        const isDisabled = item.disabled;
                        optionsHTML += `
                            <div class="multi-select-option${isSelected ? ' multi-select-selected' : ''}" data-value="${this._escapeHTML(item.value)}" data-group="${this._escapeHTML(groupName)}" role="option" aria-selected="${isSelected}" tabindex="-1" ${isDisabled ? 'style="opacity: 0.5; pointer-events: none;"' : ''}>
                                <span class="multi-select-option-radio"></span>
                                <span class="multi-select-option-text">${item.html ? item.html : this._escapeHTML(item.text)}</span>
                            </div>
                        `;
                    });
                }
                let selectAllHTML = '';
                if (this.options.selectAll) {
                    let enabledData = this.data.filter(d => !d.disabled);
                    let allSelected = enabledData.length > 0 && enabledData.every(d => d.selected);
                    selectAllHTML = `<div class="multi-select-all${allSelected ? ' multi-select-selected' : ''}" role="option" tabindex="-1">
                        <span class="multi-select-option-radio"></span>
                        <span class="multi-select-option-text">انتخاب همه</span>
                    </div>`;
                }
                let template = `
                    <div class="multi-select ${this.name}"${this.selectElement.id ? ' id="ms-' + this._escapeHTML(this.selectElement.id) + '"' : ''} style="${this.width ? 'width:' + this.width + ';' : ''}${this.height ? 'height:' + this.height + ';' : ''}" role="combobox" aria-haspopup="listbox" aria-expanded="false" data-theme="${this.options.theme}">
                        <div class="multi-select-header" style="${this.width ? 'width:' + this.width + ';' : ''}${this.height ? 'height:' + this.height + ';' : ''}" tabindex="0">
                            <span class="multi-select-header-max">${this.options.max ? this.selectedValues.length + '/' + this.options.max : ''}</span>
                            <span class="multi-select-header-placeholder">${this._escapeHTML(this.options.placeholder)}</span>
                        </div>
                        <div class="multi-select-options" style="${this.options.dropdownWidth ? 'width:' + this.options.dropdownWidth + ';' : ''}${this.options.dropdownHeight ? 'height:' + this.options.dropdownHeight + ';' : ''}" role="listbox">
                            ${this.options.search ? '<input type="text" class="multi-select-search" placeholder="جست و جو" role="searchbox">' : ''}
                            ${selectAllHTML}
                            ${optionsHTML}
                            <div class="multi-select-no-result" style="display:none;">نتیجه‌ای یافت نشد</div>
                        </div>
                    </div>
                `;
                let element = document.createElement('div');
                element.innerHTML = template;
                return element.firstElementChild;
            }

            _eventHandlers() {
                let headerElement = this.element.querySelector('.multi-select-header');
                const toggleDropdown = (forceClose = false) => {
                    if (this.element.classList.contains('disabled')) return;
                    if (forceClose || headerElement.classList.contains('multi-select-header-active')) {
                        headerElement.classList.remove('multi-select-header-active');
                        this.element.setAttribute('aria-expanded', 'false');
                    } else {
                        headerElement.classList.add('multi-select-header-active');
                        this.element.setAttribute('aria-expanded', 'true');
                        if (this.options.search) {
                            const searchInput = this.element.querySelector('.multi-select-search');
                            if (searchInput) {
                                searchInput.value = '';
                                searchInput.dispatchEvent(new Event('input'));
                                setTimeout(() => searchInput.focus(), 50);
                            }
                        }
                    }
                };
                this.element.querySelectorAll('.multi-select-option').forEach(option => {
                    option.onclick = (e) => {
                        e.stopPropagation();
                        if (this.element.classList.contains('disabled')) return;
                        let dataItem = this.data.find(d => String(d.value) === String(option.dataset
                            .value));
                        if (!dataItem || dataItem.disabled) return;
                        let selected = true;
                        if (!option.classList.contains('multi-select-selected')) {
                            if (this.options.max && this.selectedValues.length >= this.options.max) {
                                if (!this._isBatching) this.options.onMaxReached(this.options.max);
                                return;
                            }
                            option.classList.add('multi-select-selected');
                            option.setAttribute('aria-selected', 'true');
                            dataItem.selected = true;
                        } else {
                            option.classList.remove('multi-select-selected');
                            option.setAttribute('aria-selected', 'false');
                            dataItem.selected = false;
                            selected = false;
                        }
                        if (!this._isBatching) {
                            this._updateSelected();
                            this._syncOriginalSelect();
                            if (this.options.closeListOnItemSelect) {
                                if (this.options.search) {
                                    this.element.querySelector('.multi-select-search').value = '';
                                    this.element.querySelectorAll(
                                        '.multi-select-option, .multi-select-group').forEach(opt => opt
                                        .classList.remove('multi-select-hidden'));
                                }
                                toggleDropdown(true);
                            }
                        }
                        this.options.onChange(option.dataset.value, option.querySelector(
                            '.multi-select-option-text').innerHTML, option);
                        if (selected) {
                            this.options.onSelect(option.dataset.value, option.querySelector(
                                '.multi-select-option-text').innerHTML, option);
                        } else {
                            this.options.onUnselect(option.dataset.value, option.querySelector(
                                '.multi-select-option-text').innerHTML, option);
                        }
                    };
                });

                this.element.querySelectorAll('.multi-select-group').forEach(groupEl => {
                    groupEl.onclick = (e) => {
                        e.stopPropagation();
                        if (this.element.classList.contains('disabled')) return;
                        let groupName = groupEl.dataset.group;
                        let isSelected = groupEl.classList.contains('multi-select-selected');
                        let hitMax = false;
                        this._isBatching = true;
                        this.element.querySelectorAll('.multi-select-option').forEach(option => {
                            if (option.dataset.group === groupName && !option.classList.contains(
                                    'multi-select-hidden')) {
                                let dataItem = this.data.find(d => String(d.value) === String(option
                                    .dataset.value));
                                if (dataItem && !dataItem.disabled && ((!isSelected && !dataItem
                                        .selected) || (isSelected && dataItem.selected))) {
                                    if (this.options.max && this.selectedValues.length >= this
                                        .options.max && !isSelected) {
                                        hitMax = true;
                                        return;
                                    }
                                    option.click();
                                }
                            }
                        });
                        this._isBatching = false;
                        this._updateSelected();
                        this._syncOriginalSelect();
                        if (this.options.closeListOnItemSelect) {
                            toggleDropdown(true);
                        }
                        if (hitMax) this.options.onMaxReached(this.options.max);
                    };
                });
                headerElement.onclick = () => toggleDropdown();

                if (this.options.search) {
                    let search = this.element.querySelector('.multi-select-search');
                    let noResultEl = this.element.querySelector('.multi-select-no-result');

                    search.oninput = () => {
                        const searchValue = this._normalizeText(search.value);
                        let visibleCount = 0;

                        this.element.querySelectorAll('.multi-select-option').forEach(option => {
                            const textEl = option.querySelector('.multi-select-option-text');
                            const optionText = this._normalizeText(textEl ? textEl.textContent : '');

                            if (!searchValue || optionText.includes(searchValue)) {
                                option.classList.remove('multi-select-hidden');
                                visibleCount++;
                            } else {
                                option.classList.add('multi-select-hidden');
                            }
                        });

                        this.element.querySelectorAll('.multi-select-group').forEach(group => {
                            const groupName = group.dataset.group || '';
                            const groupText = this._normalizeText(group.querySelector(
                                '.multi-select-option-text')?.textContent || '');
                            const groupMatches = searchValue && groupText.includes(searchValue);

                            const hasVisibleChildren = Array.from(this.element.querySelectorAll(
                                    `.multi-select-option[data-group="${CSS.escape(groupName)}"]`))
                                .some(opt => !opt.classList.contains('multi-select-hidden'));

                            if (!searchValue) {
                                group.classList.remove('multi-select-hidden');
                            } else if (groupMatches) {
                                group.classList.remove('multi-select-hidden');
                                this.element.querySelectorAll(
                                        `.multi-select-option[data-group="${CSS.escape(groupName)}"]`)
                                    .forEach(opt => {
                                        if (opt.classList.contains('multi-select-hidden')) {
                                            opt.classList.remove('multi-select-hidden');
                                            visibleCount++;
                                        }
                                    });
                            } else if (hasVisibleChildren) {
                                group.classList.remove('multi-select-hidden');
                            } else {
                                group.classList.add('multi-select-hidden');
                            }
                        });

                        const selectAllBtn = this.element.querySelector('.multi-select-all');
                        if (selectAllBtn) {
                            if (searchValue) {
                                selectAllBtn.classList.add('multi-select-hidden');
                            } else {
                                selectAllBtn.classList.remove('multi-select-hidden');
                            }
                        }

                        if (noResultEl) {
                            noResultEl.style.display = (searchValue && visibleCount === 0) ?
                                'block' : 'none';
                        }
                    };

                    search.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape') {
                            search.value = '';
                            search.dispatchEvent(new Event('input'));
                            e.stopPropagation();
                        }
                    });
                }

                if (this.options.selectAll) {
                    let selectAllButton = this.element.querySelector('.multi-select-all');
                    selectAllButton.onclick = (e) => {
                        e.stopPropagation();
                        if (this.element.classList.contains('disabled')) return;
                        let isSelected = selectAllButton.classList.contains('multi-select-selected');
                        let hitMax = false;
                        this._isBatching = true;
                        this.element.querySelectorAll('.multi-select-option').forEach(option => {
                            if (!option.classList.contains('multi-select-hidden')) {
                                let dataItem = this.data.find(d => String(d.value) === String(option
                                    .dataset.value));
                                if (dataItem && !dataItem.disabled && ((!isSelected && !dataItem
                                        .selected) || (isSelected && dataItem.selected))) {
                                    if (this.options.max && this.selectedValues.length >= this
                                        .options.max && !isSelected) {
                                        hitMax = true;
                                        return;
                                    }
                                    option.click();
                                }
                            }
                        });
                        this._isBatching = false;
                        this._updateSelected();
                        this._syncOriginalSelect();
                        if (this.options.closeListOnItemSelect) {
                            toggleDropdown(true);
                        }
                        if (hitMax) this.options.onMaxReached(this.options.max);
                    };
                }
                if (this.selectElement.id) {
                    if (this.labelClickHandler) {
                        document.querySelectorAll(`label[for="${CSS.escape(this.selectElement.id)}"]`).forEach(
                            label => {
                                label.removeEventListener('click', this.labelClickHandler);
                            });
                    }
                    this.labelClickHandler = (e) => {
                        e.preventDefault();
                        toggleDropdown();
                        headerElement.focus();
                    };
                    document.querySelectorAll(`label[for="${CSS.escape(this.selectElement.id)}"]`).forEach(label => {
                        label.addEventListener('click', this.labelClickHandler);
                    });
                }
                this.element.addEventListener('focusout', (e) => {
                    if (!this.element.contains(e.relatedTarget)) {
                        if (headerElement.classList.contains('multi-select-header-active')) {
                            headerElement.classList.remove('multi-select-header-active');
                            this.element.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
                document.addEventListener('click', this.outsideClickHandler);
                headerElement.addEventListener('keydown', (e) => {
                    if (['Enter', ' ', 'ArrowDown', 'ArrowUp'].includes(e.key)) {
                        e.preventDefault();
                        toggleDropdown();
                        const firstElement = this.element.querySelector('[role="searchbox"]') || this.element
                            .querySelector('[role="option"]');
                        if (firstElement) firstElement.focus();
                    }
                });
                this.element.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        toggleDropdown(true);
                        headerElement.focus();
                    }
                });
                const optionsContainer = this.element.querySelector('.multi-select-options');
                optionsContainer.addEventListener('keydown', (e) => {
                    const currentFocused = document.activeElement;
                    if (currentFocused.closest('.multi-select-options')) {
                        if (['ArrowDown', 'ArrowUp'].includes(e.key)) {
                            e.preventDefault();
                            const direction = e.key === 'ArrowDown' ? 'nextElementSibling' :
                                'previousElementSibling';
                            let nextElement = currentFocused[direction];

                            while (nextElement && (nextElement.classList.contains('multi-select-hidden') ||
                                    nextElement.style.pointerEvents === 'none' || !nextElement
                                    .matches('[role="option"],[role="searchbox"]'))) {
                                nextElement = nextElement[direction];
                            }
                            if (nextElement) nextElement.focus();
                        } else if (e.key === 'Enter') {
                            if (currentFocused.matches('[role="searchbox"]')) {
                                e.preventDefault();
                            } else if (currentFocused.matches('[role="option"]')) {
                                e.preventDefault();
                                currentFocused.click();
                            }
                        } else if (e.key === ' ' && currentFocused.matches('[role="option"]')) {
                            e.preventDefault();
                            currentFocused.click();
                        }
                    }
                });
            }

            _updateHeader() {
                this.element.querySelectorAll('.multi-select-header-option, .multi-select-header-placeholder').forEach(
                    el => el.remove());

                const headerEl = this.element.querySelector('.multi-select-header');

                if (this.selectedValues.length > 0) {
                    if (this.options.listAll) {
                        this.selectedItems.forEach(item => {
                            const el = document.createElement('span');
                            el.className = 'multi-select-header-option';
                            el.dataset.value = item.value;

                            const textSpan = document.createElement('span');
                            textSpan.innerHTML = item.html ? item.html : this._escapeHTML(item.text);

                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.className = 'multi-select-header-remove';
                            removeBtn.innerHTML = '&times;';
                            removeBtn.title = 'حذف';
                            removeBtn.dataset.value = item.value;

                            removeBtn.addEventListener('click', (e) => {
                                e.stopPropagation();
                                e.preventDefault();
                                this.unselect(item.value);
                            });

                            el.appendChild(textSpan);
                            el.appendChild(removeBtn);
                            headerEl.appendChild(el);
                        });
                    } else {
                        headerEl.insertAdjacentHTML('afterbegin',
                            `<span class="multi-select-header-option">${this.selectedValues.length} selected</span>`
                        );
                    }
                } else {
                    headerEl.insertAdjacentHTML('beforeend',
                        `<span class="multi-select-header-placeholder">${this._escapeHTML(this.options.placeholder)}</span>`
                    );
                }
                if (this.options.max) {
                    this.element.querySelector('.multi-select-header-max').innerHTML = this.selectedValues.length +
                        '/' + this.options.max;
                }
            }

            _updateSelectAll() {
                if (!this.options.selectAll) return;
                const selectAllBtn = this.element.querySelector('.multi-select-all');
                if (selectAllBtn) {
                    const enabledData = this.data.filter(d => !d.disabled);
                    const allSelected = enabledData.length > 0 && enabledData.every(d => d.selected);
                    if (allSelected) selectAllBtn.classList.add('multi-select-selected');
                    else selectAllBtn.classList.remove('multi-select-selected');
                }
            }

            _updateGroups() {
                this.element.querySelectorAll('.multi-select-group').forEach(groupEl => {
                    const groupName = groupEl.dataset.group;
                    const enabledItems = this.data.filter(d => d.group === groupName && !d.disabled);
                    if (enabledItems.length > 0 && enabledItems.every(d => d.selected)) {
                        groupEl.classList.add('multi-select-selected');
                    } else {
                        groupEl.classList.remove('multi-select-selected');
                    }
                });
            }

            _updateSelected() {
                this._updateHeader();
                this._updateSelectAll();
                this._updateGroups();
                this._validate();
            }

            _validate() {
                let isValid = true;
                if (this.options.required) isValid = this.selectedValues.length > 0;
                if (this.options.min && this.selectedValues.length < this.options.min) isValid = false;
                if (!isValid) {
                    this.element.classList.add('multi-select-invalid');
                    if (this.selectElement && this.options.required) this.selectElement.setCustomValidity(
                        'Please fill out this field.');
                } else {
                    this.element.classList.remove('multi-select-invalid');
                    if (this.selectElement) this.selectElement.setCustomValidity('');
                }
            }

            _buildOriginalSelect() {
                if (!this.selectElement) return;
                this.selectElement.innerHTML = '';
                let groupedData = {};
                this.data.forEach(item => {
                    let g = item.group || '';
                    if (!groupedData[g]) groupedData[g] = [];
                    groupedData[g].push(item);
                });
                for (const [groupName, items] of Object.entries(groupedData)) {
                    let parent = this.selectElement;
                    if (groupName) {
                        let optgroup = document.createElement('optgroup');
                        optgroup.label = groupName;
                        this.selectElement.appendChild(optgroup);
                        parent = optgroup;
                    }
                    items.forEach(item => {
                        let opt = document.createElement('option');
                        opt.value = item.value;
                        opt.textContent = item.text !== undefined && item.text !== null ? item.text : (item
                            .html ? item.html.replace(/<[^>]*>?/gm, '') : '');
                        opt.selected = item.selected;
                        opt.disabled = item.disabled || false;
                        if (item.html) opt.setAttribute('data-html', item.html);
                        parent.appendChild(opt);
                    });
                }
            }

            _syncOriginalSelect() {
                if (!this.selectElement) return;
                let changed = false;
                for (let option of this.selectElement.options) {
                    let dataItem = this.data.find(d => String(d.value) === String(option.value));
                    if (dataItem && option.selected !== dataItem.selected) {
                        option.selected = dataItem.selected;
                        changed = true;
                    }
                }
                if (changed) {
                    this.selectElement.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                }
            }

            _outsideClick(event) {
                if (!this.selectElement.isConnected) {
                    document.removeEventListener('click', this.outsideClickHandler);
                    return;
                }
                const labelSelector = this.selectElement.id ? `label[for="${CSS.escape(this.selectElement.id)}"]` :
                    null;
                const clickedOnLabel = labelSelector ? event.target.closest(labelSelector) : false;
                if (!this.element.contains(event.target) && !clickedOnLabel) {
                    let headerElement = this.element.querySelector('.multi-select-header');
                    if (headerElement.classList.contains('multi-select-header-active')) {
                        headerElement.classList.remove('multi-select-header-active');
                        this.element.setAttribute('aria-expanded', 'false');
                    }
                }
            }

            select(value) {
                const option = Array.from(this.element.querySelectorAll('.multi-select-option')).find(el => String(el
                    .dataset.value) === String(value));
                if (option && !option.classList.contains('multi-select-selected')) option.click();
            }

            unselect(value) {
                const option = Array.from(this.element.querySelectorAll('.multi-select-option')).find(el => String(el
                    .dataset.value) === String(value));
                if (option && option.classList.contains('multi-select-selected')) option.click();
            }

            setValues(values) {
                const valArray = Array.isArray(values) ? values : [values];
                const stringValues = valArray.map(String);
                let changed = false;
                this.data.forEach(item => {
                    const isSelected = stringValues.includes(String(item.value));
                    if (item.selected !== isSelected && !item.disabled) {
                        item.selected = isSelected;
                        changed = true;
                    }
                });
                if (changed) {
                    this.refresh();
                    this.selectElement.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                }
            }

            disable() {
                this.options.disabled = true;
                this.element.classList.add('disabled');
                this.element.querySelector('.multi-select-header').removeAttribute('tabindex');
                const searchInput = this.element.querySelector('.multi-select-search');
                if (searchInput) searchInput.disabled = true;
                if (this.selectElement) this.selectElement.disabled = true;
                let headerElement = this.element.querySelector('.multi-select-header');
                if (headerElement && headerElement.classList.contains('multi-select-header-active')) {
                    headerElement.classList.remove('multi-select-header-active');
                    this.element.setAttribute('aria-expanded', 'false');
                }
            }

            enable() {
                this.options.disabled = false;
                this.element.classList.remove('disabled');
                this.element.querySelector('.multi-select-header').setAttribute('tabindex', '0');
                const searchInput = this.element.querySelector('.multi-select-search');
                if (searchInput) searchInput.disabled = false;
                if (this.selectElement) this.selectElement.disabled = false;
            }

            destroy() {
                this.element.insertAdjacentElement('beforebegin', this.selectElement);
                this.element.remove();
                if (this.originalStyle) {
                    this.selectElement.setAttribute('style', this.originalStyle);
                } else {
                    this.selectElement.removeAttribute('style');
                }
                if (this.originalTabIndex !== null) {
                    this.selectElement.setAttribute('tabindex', this.originalTabIndex);
                } else {
                    this.selectElement.removeAttribute('tabindex');
                }
                if (this.selectElement.form && this.formResetHandler) {
                    this.selectElement.form.removeEventListener('reset', this.formResetHandler);
                }
                if (this.selectElement.id && this.labelClickHandler) {
                    document.querySelectorAll(`label[for="${CSS.escape(this.selectElement.id)}"]`).forEach(label => {
                        label.removeEventListener('click', this.labelClickHandler);
                    });
                }
                document.removeEventListener('click', this.outsideClickHandler);
                delete this.selectElement._multiSelect;
            }

            refresh() {
                this.element.insertAdjacentElement('beforebegin', this.selectElement);
                const newElement = this._template();
                this.element.replaceWith(newElement);
                this.element = newElement;
                this.element.appendChild(this.selectElement);
                this._buildOriginalSelect();
                this._updateSelected();
                this._eventHandlers();
            }

            addItem(item) {
                this.options.data.push(item);
                this.originalData.push(JSON.parse(JSON.stringify(item)));
                this.refresh();
            }

            addItems(items) {
                this.options.data.push(...items);
                this.originalData.push(...JSON.parse(JSON.stringify(items)));
                this.refresh();
            }

            async fetch(url, options = {}) {
                try {
                    const response = await window.fetch(url, options);
                    if (!response.ok) throw new Error('Network response was not ok');
                    const data = await response.json();
                    this.addItems(data);
                    if (this.options.onload) {
                        this.options.onload(data, this.options);
                    }
                } catch (error) {
                    console.error('MultiSelect Fetch Error:', error);
                }
            }

            removeItem(value) {
                this.options.data = this.options.data.filter(item => String(item.value) !== String(value));
                this.originalData = this.originalData.filter(item => String(item.value) !== String(value));
                this.refresh();
            }

            clear() {
                this.options.data = [];
                this.refresh();
                this.selectElement.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            }

            deselectAll() {
                let changed = false;
                this.data.forEach(item => {
                    if (item.selected && !item.disabled) {
                        item.selected = false;
                        changed = true;
                    }
                });
                if (changed) {
                    this.refresh();
                    this.selectElement.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                }
            }

            reset() {
                this.data = JSON.parse(JSON.stringify(this.originalData));
                this.refresh();
                this.selectElement.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            }

            selectAll() {
                let changed = false;
                this.data.forEach(item => {
                    if (!item.selected && !item.disabled) {
                        item.selected = true;
                        changed = true;
                    }
                });
                if (changed) {
                    this.refresh();
                    this.selectElement.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                }
            }

            get selectedValues() {
                return this.data.filter(d => d.selected).map(d => d.value);
            }
            get selectedItems() {
                return this.data.filter(d => d.selected);
            }
            get data() {
                return this.options.data;
            }
            set data(value) {
                this.options.data = value;
            }

            set selectElement(value) {
                this.options.selectElement = value;
            }
            get selectElement() {
                return this.options.selectElement;
            }

            set element(value) {
                this.options.element = value;
            }
            get element() {
                return this.options.element;
            }

            set placeholder(value) {
                this.options.placeholder = value;
            }
            get placeholder() {
                return this.options.placeholder;
            }

            set name(value) {
                this.options.name = value;
            }
            get name() {
                return this.options.name;
            }

            set width(value) {
                this.options.width = value;
            }
            get width() {
                return this.options.width;
            }

            set height(value) {
                this.options.height = value;
            }
            get height() {
                return this.options.height;
            }
        }

        /* =========================================================
           داده‌های کتاب‌ها
           ========================================================= */
        const booksData = {
            @foreach ($pack->products as $product)
                '{{ $product->id }}': {
                    title: '{{ addslashes($product->title) }}',
                    price: {{ $product->primary_price ?? 0 }}
                },
            @endforeach
        };

        // 👇 آرایه ID کتاب‌های انتخاب‌شده در این پک (از کنترلر پاس داده می‌شود)
        const preselectedIds = @json($selectedProductIds ?? []);

        const selectedCountSpan = document.getElementById('selectedCount');
        const selectedItemsList = document.getElementById('selectedItemsList');
        const totalPriceSpan = document.getElementById('totalPrice');

        function formatPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function updateSummary(selectedValues) {
            const selected = selectedValues
                .filter(v => booksData[v])
                .map(v => ({
                    value: v,
                    title: booksData[v].title,
                    price: booksData[v].price
                }));

            const total = selected.reduce((sum, item) => sum + item.price, 0);

            if (selectedCountSpan) selectedCountSpan.textContent = selected.length;

            if (selectedItemsList) {
                if (selected.length === 0) {
                    selectedItemsList.innerHTML =
                        '<p class="text-slate-400 italic text-center py-4">هنوز کتابی انتخاب نشده است</p>';
                } else {
                    selectedItemsList.innerHTML = selected.map(item => `
                        <div class="flex justify-between items-center py-1.5 border-b border-slate-100 last:border-0" style="font-family: "IRANSansXFaNum">
                            <span class="text-slate-700">${item.title}</span>
                            <span class="font-medium text-indigo-600">${formatPrice(item.price)} تومان</span>
                        </div>
                    `).join('');
                }
            }

            if (totalPriceSpan) totalPriceSpan.textContent = formatPrice(total) + ' تومان';
        }

        /* =========================================================
           راه‌اندازی MultiSelect
           ========================================================= */
        const booksMultiSelectEl = document.querySelector('#booksMultiSelect');
        let booksMultiSelect;

        if (booksMultiSelectEl) {
            booksMultiSelect = new MultiSelect(booksMultiSelectEl, {
                placeholder: 'جستجو و انتخاب کتاب‌ها...',
                search: true,
                selectAll: true,
                listAll: true,
                closeListOnItemSelect: false,
                onChange: function() {
                    updateSummary(this.selectedValues);
                },
                onSelect: function() {
                    updateSummary(this.selectedValues);
                },
                onUnselect: function() {
                    updateSummary(this.selectedValues);
                }
            });

            // 👇 اعمال انتخاب‌های قبلی (در حالت ویرایش)
            if (preselectedIds.length > 0) {
                booksMultiSelect.setValues(preselectedIds);
            }

            // به‌روزرسانی خلاصه با مقادیر فعلی
            updateSummary(booksMultiSelect.selectedValues);
        }

        document.getElementById('clearSelectionBtn')?.addEventListener('click', () => {
            if (booksMultiSelect) {
                booksMultiSelect.deselectAll();
                updateSummary([]);
            }
        });

        /* =========================================================
           مدیریت آپلود تصاویر
           ========================================================= */

        // --- تصویر اصلی ---
        const mainImageDropzone = document.getElementById('mainImageDropzone');
        const mainImageInput = document.getElementById('mainImageInput');
        const mainImagePreview = document.getElementById('mainImagePreview');
        const mainImagePreviewWrapper = document.getElementById('mainImagePreviewWrapper');
        const mainImagePlaceholder = document.getElementById('mainImagePlaceholder');
        const removeMainImage = document.getElementById('removeMainImage');

        if (mainImageDropzone && mainImageInput) {
            mainImageDropzone.addEventListener('click', (e) => {
                if (e.target.closest('#removeMainImage')) return;
                mainImageInput.click();
            });

            mainImageInput.addEventListener('change', (e) => {
                handleMainImage(e.target.files[0]);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                mainImageDropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    mainImageDropzone.classList.add('border-indigo-500', 'bg-indigo-50');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                mainImageDropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    mainImageDropzone.classList.remove('border-indigo-500', 'bg-indigo-50');
                });
            });

            mainImageDropzone.addEventListener('drop', (e) => {
                const file = e.dataTransfer.files[0];
                if (file) {
                    mainImageInput.files = e.dataTransfer.files;
                    handleMainImage(file);
                }
            });

            removeMainImage?.addEventListener('click', (e) => {
                e.stopPropagation();
                mainImageInput.value = '';
                mainImagePreview.src = '';
                mainImagePreviewWrapper.classList.add('hidden');
                mainImagePlaceholder.classList.remove('hidden');
            });

            function handleMainImage(file) {
                if (!file) return;

                if (!file.type.match('image/(png|jpeg|jpg)')) {
                    alert('فقط فرمت‌های PNG و JPG مجاز هستند.');
                    return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    alert('حجم تصویر نباید بیشتر از ۵ مگابایت باشد.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (ev) => {
                    mainImagePreview.src = ev.target.result;
                    mainImagePreviewWrapper.classList.remove('hidden');
                    mainImagePlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        // --- گالری تصاویر ---
        const galleryInput = document.getElementById('galleryInput');
        const galleryContainer = document.getElementById('galleryContainer');
        const addGalleryBtn = document.getElementById('addGalleryBtn');

        if (galleryInput && galleryContainer && addGalleryBtn) {
            let galleryFiles = new DataTransfer();

            addGalleryBtn.addEventListener('click', () => {
                galleryInput.click();
            });

            galleryInput.addEventListener('change', (e) => {
                const newFiles = Array.from(e.target.files);

                newFiles.forEach(file => {
                    if (!file.type.match('image/(png|jpeg|jpg)')) {
                        alert('فقط فرمت‌های PNG و JPG مجاز هستند.');
                        return;
                    }
                    if (file.size > 5 * 1024 * 1024) {
                        alert('حجم هر تصویر نباید بیشتر از ۵ مگابایت باشد.');
                        return;
                    }

                    galleryFiles.items.add(file);

                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        const wrapper = document.createElement('div');
                        wrapper.className =
                            'w-16 h-16 bg-slate-100 rounded-xl border border-slate-200 overflow-hidden relative group';
                        wrapper.dataset.fileName = file.name + '_' + file.size + '_' + file.lastModified;
                        wrapper.innerHTML = `
                            <img src="${ev.target.result}" alt="گالری" class="w-full h-full object-cover">
                            <button type="button" class="absolute top-0 right-0 bg-rose-500 text-white rounded-full p-0.5 text-xs opacity-0 group-hover:opacity-100 transition-opacity remove-gallery-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        `;

                        galleryContainer.insertBefore(wrapper, addGalleryBtn);

                        wrapper.querySelector('.remove-gallery-item').addEventListener('click', () => {
                            const uniqueId = wrapper.dataset.fileName;
                            wrapper.remove();

                            const newDT = new DataTransfer();
                            Array.from(galleryFiles.files).forEach(f => {
                                const fId = f.name + '_' + f.size + '_' + f.lastModified;
                                if (fId !== uniqueId) {
                                    newDT.items.add(f);
                                }
                            });
                            galleryFiles = newDT;
                            galleryInput.files = galleryFiles.files;
                        });
                    };
                    reader.readAsDataURL(file);
                });

                galleryInput.files = galleryFiles.files;
            });
        }

        /* =========================================================
           ارسال فرم
           ========================================================= */
        function submitPackForm() {
            const title = document.getElementById('packTitle').value.trim();
            if (!title) {
                alert('لطفاً عنوان پک را وارد کنید.');
                document.getElementById('packTitle').focus();
                return;
            }
            const selectedBooks = booksMultiSelect ? booksMultiSelect.selectedValues : [];
            if (selectedBooks.length === 0) {
                alert('لطفاً حداقل یک کتاب برای پک انتخاب کنید.');
                return;
            }

            console.log('تعداد فایل‌های گالری جدید:', galleryInput?.files?.length || 0);

            document.getElementById('packForm').submit();
        }

        document.getElementById('submitPackBtn')?.addEventListener('click', (e) => {
            e.preventDefault();
            submitPackForm();
        });

        document.getElementById('headerSubmitBtn')?.addEventListener('click', (e) => {
            e.preventDefault();
            submitPackForm();
        });
    </script>
@endsection