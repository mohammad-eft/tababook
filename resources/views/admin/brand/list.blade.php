@extends('admin.app.dashboard')
@section('title', 'طبابوک | لیست برندها')
@section('content')
<style>
    /* ===== پالت رنگی مترونیک (Metronic) ===== */
    :root {
        --metronic-dark: #0D0E12;
        --metronic-content-bg: #FCFCFC;
        --metronic-form-bg: #FFFFFF;
        --metronic-shadow: #F5F5F5;
        --metronic-border: #DBDFE9;
        --metronic-text-dark: #9A9CAE;
        --metronic-text-hover: #F5F5F5;
        --metronic-blue: #1B84FF;
    }
    
    /* ===== کارت اصلی ===== */
    .vafadar-table-card {
        background: var(--metronic-content-bg);
        border: 1px solid var(--metronic-border);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(13,14,18,0.03);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .vafadar-table-card:hover {
        box-shadow: 0 8px 40px rgba(13,14,18,0.06);
    }
    .dark .vafadar-table-card {
        background: var(--metronic-dark);
        border-color: var(--metronic-border);
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    .dark .vafadar-table-card:hover {
        box-shadow: 0 8px 40px rgba(0,0,0,0.4);
    }

    /* ===== هدر جدول ===== */
    .vafadar-table-header {
        background: var(--metronic-shadow);
        border-bottom: 2px solid var(--metronic-border);
    }
    .dark .vafadar-table-header {
        background: var(--metronic-shadow);
        border-bottom-color: var(--metronic-border);
    }

    .vafadar-table-header th {
        color: var(--metronic-text-dark);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        text-align: right;
    }
    .dark .vafadar-table-header th {
        color: var(--metronic-text-dark);
    }

    /* ===== ردیف‌ها ===== */
    .vafadar-table-row {
        border-bottom: 1px solid var(--metronic-border);
        transition: all 0.3s ease;
    }
   
    .vafadar-table-row:last-child {
        border-bottom: none;
    }
    .dark .vafadar-table-row {
        border-bottom-color: var(--metronic-border);
    }
    .dark .vafadar-table-row:hover {
        background: var(--metronic-shadow);
    }

    .vafadar-table-row td {
        padding: 14px 16px;
        color: var(--metronic-dark);
        font-size: 14px;
        vertical-align: middle;
    }
    .dark .vafadar-table-row td {
        color: var(--metronic-content-bg);
    }

    /* ===== بج برند ===== */
    .vafadar-brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        background: var(--metronic-shadow);
        color: var(--metronic-text-dark);
        border: 1px solid var(--metronic-border);
    }
    .dark .vafadar-brand-badge {
        background: var(--metronic-shadow);
        color: var(--metronic-text-dark);
        border-color: var(--metronic-border);
    }

    .vafadar-thumb {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid var(--metronic-border);
        transition: all 0.3s ease;
    }
    .vafadar-thumb:hover {
        transform: scale(1.1);
        border-color: var(--metronic-blue);
        box-shadow: 0 4px 12px rgba(27, 132, 255, 0.15);
    }

    .vafadar-thumb-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--metronic-shadow);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        border: 2px solid var(--metronic-border);
    }

    /* ===== وضعیت ===== */
    .vafadar-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .vafadar-status.active {
        background: var(--metronic-blue);
        color: #fff;
    }
    .vafadar-status.inactive {
        background: var(--metronic-shadow);
        color: var(--metronic-text-dark);
    }
    .dark .vafadar-status.active {
        background: var(--metronic-blue);
        color: #fff;
    }
    .dark .vafadar-status.inactive {
        background: var(--metronic-shadow);
        color: var(--metronic-text-dark);
    }

    .vafadar-status .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
    }
    .vafadar-status.active .dot {
        background: #fff;
        animation: pulse-dot 2s infinite;
    }
    .vafadar-status.inactive .dot {
        background: var(--metronic-text-dark);
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.3; transform: scale(0.8); }
    }

    /* ===== دکمه‌های اکشن ===== */
    .vafadar-action-group {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .vafadar-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 7px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
    }
    .vafadar-action-btn:hover {
        transform: translateY(-2px);
    }
    .vafadar-action-btn:active {
        transform: translateY(0) scale(0.95);
    }

    .vafadar-action-btn.view {
        color: var(--metronic-text-dark);
        background: var(--metronic-shadow);
        border-color: var(--metronic-border);
    }
    .vafadar-action-btn.view:hover {
        background: var(--metronic-blue);
        color: #fff;
        box-shadow: 0 4px 16px rgba(27, 132, 255, 0.25);
    }

    .vafadar-action-btn.edit {
        color: #fff;
        background: var(--metronic-blue);
        border-color: var(--metronic-blue);
    }
    .vafadar-action-btn.edit:hover {
        background: var(--metronic-blue);
        color: #fff;
        box-shadow: 0 4px 16px rgba(27, 132, 255, 0.25);
    }

    .vafadar-action-btn.delete {
        color: var(--metronic-dark);
        background: var(--metronic-shadow);
        border-color: var(--metronic-border);
    }
    .vafadar-action-btn.delete:hover {
        background: var(--metronic-dark);
        color: #fff;
        box-shadow: 0 4px 16px rgba(13, 14, 18, 0.25);
    }

    .dark .vafadar-action-btn.view {
        color: var(--metronic-text-dark);
        background: var(--metronic-shadow);
        border-color: var(--metronic-border);
    }
    .dark .vafadar-action-btn.view:hover {
        background: var(--metronic-blue);
        color: #fff;
    }

    .dark .vafadar-action-btn.edit {
        color: #fff;
        background: var(--metronic-blue);
        border-color: var(--metronic-blue);
    }
    .dark .vafadar-action-btn.edit:hover {
        background: var(--metronic-blue);
        color: #fff;
    }

    .dark .vafadar-action-btn.delete {
        color: var(--metronic-text-dark);
        background: var(--metronic-shadow);
        border-color: var(--metronic-border);
    }
    .dark .vafadar-action-btn.delete:hover {
        background: var(--metronic-dark);
        color: #fff;
    }

    /* ===== شمارنده ===== */
    .vafadar-counter {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--metronic-shadow);
        color: var(--metronic-text-dark);
        font-size: 13px;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 50px;
        border: 1px solid var(--metronic-border);
    }
    .dark .vafadar-counter {
        background: var(--metronic-shadow);
        color: var(--metronic-text-dark);
        border-color: var(--metronic-border);
    }

    /* ===== سرچ ===== */
    .vafadar-search {
        background: var(--metronic-shadow);
        border: 1px solid var(--metronic-border);
        border-radius: 12px;
        padding: 10px 16px 10px 44px;
        color: var(--metronic-dark);
        font-size: 14px;
        transition: all 0.3s ease;
        width: 100%;
        max-width: 300px;
        outline: none;
    }
    .vafadar-search::placeholder {
        color: var(--metronic-text-dark);
    }
    .vafadar-search:focus {
        border-color: var(--metronic-blue);
        box-shadow: 0 0 0 4px rgba(27, 132, 255, 0.06);
        background: var(--metronic-form-bg);
    }
    .dark .vafadar-search {
        background: var(--metronic-shadow);
        border-color: var(--metronic-border);
        color: var(--metronic-content-bg);
    }
    .dark .vafadar-search::placeholder {
        color: var(--metronic-text-dark);
    }
    .dark .vafadar-search:focus {
        border-color: var(--metronic-blue);
        box-shadow: 0 0 0 4px rgba(27, 132, 255, 0.08);
        background: var(--metronic-shadow);
    }

    .vafadar-search-wrap {
        position: relative;
    }
    .vafadar-search-wrap .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--metronic-text-dark);
    }
    .dark .vafadar-search-wrap .search-icon {
        color: var(--metronic-text-dark);
    }

    /* ===== اسکرول ===== */
    .vafadar-table-wrap {
        overflow-x: auto;
    }
    .vafadar-table-wrap::-webkit-scrollbar {
        height: 4px;
    }
    .vafadar-table-wrap::-webkit-scrollbar-track {
        background: transparent;
    }
    .vafadar-table-wrap::-webkit-scrollbar-thumb {
        background: var(--metronic-text-dark);
        border-radius: 10px;
    }
    .dark .vafadar-table-wrap::-webkit-scrollbar-thumb {
        background: var(--metronic-text-dark);
    }

    /* ===== خالی ===== */
    .vafadar-empty {
        padding: 60px 20px;
        text-align: center;
    }
    .vafadar-empty svg {
        width: 64px;
        height: 64px;
        fill: var(--metronic-border);
        margin: 0 auto 16px;
    }
    .dark .vafadar-empty svg {
        fill: var(--metronic-border);
    }
    .vafadar-empty h3 {
        color: var(--metronic-dark);
        font-size: 18px;
        font-weight: 600;
    }
    .dark .vafadar-empty h3 {
        color: var(--metronic-content-bg);
    }
    .vafadar-empty p {
        color: var(--metronic-text-dark);
        font-size: 14px;
        margin-top: 4px;
    }

    /* ===== دکمه اضافه کردن ===== */
    .vafadar-add-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: var(--metronic-blue);
        color: #fff;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
        box-shadow: 0 4px 16px rgba(27, 132, 255, 0.15);
    }
    .vafadar-add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(27, 132, 255, 0.25);
        color: #fff;
    }
    .vafadar-add-btn:active {
        transform: translateY(0) scale(0.97);
    }
    .dark .vafadar-add-btn {
        background: var(--metronic-blue);
    }
    .dark .vafadar-add-btn:hover {
        box-shadow: 0 8px 24px rgba(27, 132, 255, 0.25);
    }

    /* ===== ریسپانسیو ===== */
    @media (max-width: 768px) {
        .vafadar-table-row td {
            padding: 10px 12px;
            font-size: 13px;
        }
        .vafadar-table-header th {
            padding: 10px 12px;
            font-size: 10px;
        }
        .vafadar-action-btn {
            padding: 5px 10px;
            font-size: 11px;
        }
        .vafadar-action-btn span {
            display: none;
        }
        .vafadar-search {
            max-width: 100%;
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .vafadar-table-row td {
            padding: 8px 8px;
            font-size: 12px;
        }
        .vafadar-table-header th {
            padding: 8px 8px;
            font-size: 9px;
        }
        .vafadar-action-btn {
            padding: 4px 7px;
            font-size: 10px;
        }
        .vafadar-counter {
            font-size: 11px;
            padding: 4px 10px;
        }
    }
</style>

<div class="w-full">
    
    <!-- ===== هدر لیست ===== -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold" style="color: var(--metronic-dark);"> لیست برندها</h2>
            <p class="text-sm mt-1" style="color: var(--metronic-text-dark);">مدیریت برندهای محصولات</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            <a href="{{route('brand.create')}}" class="vafadar-add-btn">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                برند جدید
            </a>
        </div>
    </div>

    <!-- ===== کارت جدول ===== -->
    <div class="vafadar-table-card">
        
        <!-- ===== نوار جستجو ===== -->
        <div class="p-4 border-b" style="border-color: var(--metronic-border);">
            <div class="vafadar-search-wrap">
                <svg class="search-icon w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                <input type="text" id="searchBrand" placeholder="جستجوی برندها..." class="vafadar-search">
            </div>
        </div>

        <!-- ===== جدول ===== -->
        <div class="vafadar-table-wrap">
            <table class="w-full" id="brandTable">
                <thead class="vafadar-table-header">
                    <tr>
                        <th style="width: 50px;">ردیف</th>
                        <th class="hidden md:table-cell">لوگو</th>
                        <th>عنوان</th>
                        <th class="hidden lg:table-cell">توضیحات</th>
                        <th class="hidden sm:table-cell">نمایش در خانه</th>
                        <th class="hidden sm:table-cell">وضعیت</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                </thead>
                <tbody id="brandTableBody">
                    @forelse($brands as $brand)
                    <tr class="vafadar-table-row" data-id="{{$brand->id}}" data-title="{{$brand->title}}" data-slug="{{$brand->slug}}">
                        <td>
                            <span class="vafadar-brand-badge">{{$brand->id}}</span>
                        </td>
                        <td class="hidden md:table-cell">
                            @if($brand->logo_path)
                                <img class="vafadar-thumb sm:min-w-14 min-w-10 sm:min-h-14 min-h-10 sm:max-w-20 max-w-15 sm:max-h-20 max-h-15" src="{{asset('storage/'.$brand->logo_path)}}" alt="{{$brand->title}}">
                            @else
                                <img class="vafadar-thumb sm:min-w-14 min-w-10 sm:min-h-14 min-h-10 sm:max-w-20 max-w-15 sm:max-h-20 max-h-15" src="{{asset('assets/img/defaultPicture.jpg')}}" alt="{{$brand->title}}">
                            @endif
                        </td>
                        <td>
                            <span class="font-semibold" style="color: var(--metronic-dark);">{{$brand->title}}</span>
                            <div class="text-xs lg:hidden" style="color: var(--metronic-text-dark);">{{$brand->slug}}</div>
                        </td>
                        <td class="hidden lg:table-cell">
                            @if($brand->description)
                                <span class="text-sm" style="color: var(--metronic-text-dark);">{{ Str::limit($brand->description, 30) }}</span>
                            @else
                                <span class="text-xs" style="color: var(--metronic-text-dark);">—</span>
                            @endif
                        </td>
                        <td class="hidden sm:table-cell text-center">
                            <span class="vafadar-status {{ $brand->show_in_home != 0 ? 'active' : 'inactive' }}">
                                <span class="dot"></span>
                                {{ $brand->show_in_home != 0 ? 'فعال' : 'غیرفعال' }}
                            </span>
                        </td>
                        <td class="hidden sm:table-cell">
                            <span class="vafadar-status {{ $brand->is_active != 0 ? 'active' : 'inactive' }}">
                                <span class="dot"></span>
                                {{ $brand->is_active != 0 ? 'فعال' : 'غیرفعال' }}
                            </span>
                        </td>
                        <td>
                            <div class="vafadar-action-group justify-center">
                                <a href="{{route('brand.single',['brand'=>$brand->id])}}" class="vafadar-action-btn view" title="مشاهده برند">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    <span class="hidden sm:inline">مشاهده</span>
                                </a>
                                <a href="{{route('brand.edit',['brand'=>$brand->id])}}" class="vafadar-action-btn edit" title="ویرایش برند">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    <span class="hidden sm:inline">ویرایش</span>
                                </a>
                                <a href="{{route('brand.delete',['brand'=>$brand->id])}}" class="vafadar-action-btn delete" title="حذف برند" onclick="return confirm('آیا از حذف برند «{{$brand->title}}» مطمئن هستید؟')">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                    <span class="hidden sm:inline">حذف</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="vafadar-empty">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <path d="M4 7h16M4 12h16M4 17h10"/>
                                    <rect x="2" y="3" width="20" height="18" rx="2"/>
                                </svg>
                                <h3>هیچ برندی یافت نشد</h3>
                                <p>برای شروع، روی دکمه «برند جدید» کلیک کنید</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ===== فوتر جدول ===== -->
        <div class="vafadar-table-header px-4 py-3 border-t" style="border-color: var(--metronic-border);">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-xs" style="color: var(--metronic-text-dark);">
                <span>تعداد کل: <strong style="color: var(--metronic-dark);">{{ count($brands) }}</strong> برند</span>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchBrand');
        const table = document.getElementById('brandTable');
        const rows = table.querySelectorAll('tbody tr');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();

                rows.forEach(row => {
                    const title = row.getAttribute('data-title')?.toLowerCase() || '';
                    const slug = row.getAttribute('data-slug')?.toLowerCase() || '';
                    const id = row.getAttribute('data-id') || '';

                    const match = title.includes(query) || slug.includes(query) || id.includes(query);
                    row.style.display = match ? '' : 'none';
                });
            });
        }
    });
</script>

@endsection