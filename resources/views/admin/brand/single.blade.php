@extends('admin.app.dashboard')
@section('title', 'طبابوک | سینگل برند')
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

    /* ===== استایل‌های جدید با پالت مترونیک ===== */
    .brand-container {
        background: var(--metronic-content-bg);
        border: 1px solid var(--metronic-border);
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(13,14,18,0.03);
        transition: all 0.3s ease;
    }
    .brand-container:hover {
        box-shadow: 0 8px 40px rgba(13,14,18,0.06);
    }

    .brand-item {
        background: var(--metronic-form-bg);
        border: 1px solid var(--metronic-border);
        border-radius: 14px;
        padding: 16px 20px;
        transition: all 0.3s ease;
        min-width: 120px;
    }
    .brand-item:hover {
        border-color: var(--metronic-blue);
        box-shadow: 0 4px 12px rgba(27, 132, 255, 0.04);
    }

    .brand-item .label {
        color: var(--metronic-text-dark);
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 4px;
    }

    .brand-item .value {
        color: var(--metronic-dark);
        font-size: 15px;
        font-weight: 600;
    }

    .brand-item .status-active {
        color: var(--metronic-blue);
        font-weight: 600;
    }

    .brand-item .status-inactive {
        color: var(--metronic-text-dark);
        font-weight: 600;
    }

    .brand-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    .brand-action-btn:hover {
        transform: translateY(-2px);
    }
    .brand-action-btn:active {
        transform: translateY(0) scale(0.97);
    }

    .brand-action-btn.view {
        background: var(--metronic-shadow);
        color: var(--metronic-text-dark);
        border: 1px solid var(--metronic-border);
    }
    .brand-action-btn.view:hover {
        background: var(--metronic-blue);
        color: #fff;
        border-color: var(--metronic-blue);
        box-shadow: 0 4px 16px rgba(27, 132, 255, 0.2);
    }

    .brand-action-btn.edit {
        background: var(--metronic-blue);
        color: #fff;
        box-shadow: 0 4px 16px rgba(27, 132, 255, 0.15);
    }
    .brand-action-btn.edit:hover {
        box-shadow: 0 8px 24px rgba(27, 132, 255, 0.25);
    }

    .brand-action-btn.delete {
        background: var(--metronic-dark);
        color: #fff;
        box-shadow: 0 4px 16px rgba(13, 14, 18, 0.15);
    }
    .brand-action-btn.delete:hover {
        box-shadow: 0 8px 24px rgba(13, 14, 18, 0.25);
    }

    /* ===== ریسپانسیو ===== */
    @media (max-width: 768px) {
        .brand-container {
            padding: 16px;
        }
        .brand-item {
            padding: 12px 16px;
            min-width: 100px;
        }
        .brand-item .value {
            font-size: 13px;
        }
        .brand-action-btn {
            padding: 8px 16px;
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .brand-container {
            padding: 12px;
        }
        .brand-item {
            padding: 10px 12px;
            min-width: 80px;
        }
        .brand-item .value {
            font-size: 12px;
        }
        .brand-action-btn {
            padding: 6px 12px;
            font-size: 11px;
        }
    }

    /* ===== استایل جدید برای نمایش اطلاعات ===== */
    .brand-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .brand-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        padding-top: 20px;
        border-top: 2px solid var(--metronic-border);
    }
</style>

<div class="flex flex-col gap-4 py-6 px-4">
    <div class="brand-container">
        <div class="brand-grid">
            <div class="brand-item">
                <span class="label"> عنوان</span>
                <span class="value">{{$brand->title}}</span>
            </div>
            <div class="brand-item">
                <span class="label"> لوگو</span>
                <span class="value"><img src="{{asset('storage/'.$brand->logo_path)}}" alt=""></span>
            </div>
            <div class="brand-item">
                <span class="label"> توضیحات</span>
                <span class="value">{{$brand->description}}</span>
            </div>
            <div class="brand-item">
                <span class="label"> نمایش در خانه</span>
                <span class="value">
                    @if($brand->show_in_home !=0) 
                        <span class="status-active"> فعال</span>
                    @else 
                        <span class="status-inactive"> غیرفعال</span>
                    @endif
                </span>
            </div>
            <div class="brand-item">
                <span class="label"> وضعیت</span>
                <span class="value">
                    @if($brand->is_active !=0) 
                        <span class="status-active"> فعال</span>
                    @else 
                        <span class="status-inactive"> غیرفعال</span>
                    @endif
                </span>
            </div>

        </div>

        <div class="brand-actions">
            <a href="{{route('brand.edit',['brand'=>$brand->id])}}" class="brand-action-btn edit">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                ویرایش
            </a>
            <a href="{{route('brand.delete',['brand'=>$brand->id])}}" class="brand-action-btn delete" onclick="return confirm('آیا از حذف برند «{{$brand->title}}» مطمئن هستید؟')">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18"/>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                </svg>
                حذف
            </a>
        </div>
    </div>
</div>

@endsection