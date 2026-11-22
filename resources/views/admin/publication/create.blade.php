@extends('admin.app.dashboard')
@section('title', 'طبابوک | ایجاد انتشارات')
@section('content')
<style>
    /* ===== پالت رنگی مترونیک ===== */
    :root {
        --metronic-primary: #1B84FF;
        --metronic-primary-dark: #0a6fd6;
        --metronic-primary-light: #4a9fff;
        --metronic-sidebar: #0D0E12;
        --metronic-bg-content: #FCFCFC;
        --metronic-bg-form: #FFFFFF;
        --metronic-shadow-form: #F5F5F5;
        --metronic-border: #DBDFE9;
        --metronic-text: #9A9CAE;
        --metronic-text-hover: #1B84FF;
        --metronic-success: #059669;
        --metronic-danger: #dc2626;
        --metronic-warning: #d97706;
        
        --shadow-sm: 0 2px 8px rgba(27, 132, 255, 0.06);
        --shadow-md: 0 4px 20px rgba(27, 132, 255, 0.10);
        --shadow-lg: 0 8px 40px rgba(27, 132, 255, 0.14);
    }

    /* ===== کارت اصلی ===== */
    .vafadar-form-card {
        background: var(--metronic-bg-form);
        border: 1px solid var(--metronic-border);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .vafadar-form-card:hover {
        box-shadow: var(--shadow-md);
    }

    /* ===== هدر فرم ===== */
    .vafadar-form-header {
        background: linear-gradient(135deg, #F5F5F5, #DBDFE9);
        border-bottom: 2px solid var(--metronic-border);
        padding: 18px 28px;
        border-radius: 20px 20px 0 0;
    }

    .vafadar-form-header h2 {
        color: #1e293b;
        font-size: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .vafadar-form-header .header-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--metronic-primary), var(--metronic-primary-dark));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        box-shadow: 0 4px 12px rgba(27, 132, 255, 0.25);
    }

    /* ===== فیلدها ===== */
    .vafadar-label {
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        display: block;
        margin-bottom: 5px;
        padding-right: 4px;
        transition: all 0.3s ease;
    }

    .vafadar-input {
        width: 100%;
        padding: 12px 16px;
        background: #F5F5F5;
        border: 1.5px solid var(--metronic-border);
        border-radius: 12px;
        color: #1e293b;
        font-size: 13px;
        transition: all 0.3s ease;
        outline: none;
    }
    .vafadar-input::placeholder {
        color: #9A9CAE;
        font-size: 12px;
    }
    .vafadar-input:hover {
        border-color: var(--metronic-primary-light);
    }
    .vafadar-input:focus {
        border-color: var(--metronic-primary);
        box-shadow: 0 0 0 4px rgba(27, 132, 255, 0.08);
        background: var(--metronic-bg-form);
    }

    /* ===== توگل ===== */
    .vafadar-toggle {
        width: 52px;
        height: 30px;
        padding: 2px;
        border-radius: 50px;
        background: #F5F5F5;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border: 1px solid var(--metronic-border);
        cursor: pointer;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.04);
    }
    .vafadar-toggle.active {
        background: var(--metronic-primary);
        border-color: var(--metronic-primary);
    }

    .vafadar-toggle-dot {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #ffffff;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .vafadar-toggle.active .vafadar-toggle-dot {
        transform: translateX(-22px);
        background: #ffffff;
    }

    .vafadar-toggle-label {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .vafadar-toggle-label span {
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
    }

    /* ===== دکمه ثبت ===== */
    .vafadar-btn {
        padding: 12px 32px;
        background: linear-gradient(135deg, var(--metronic-primary), var(--metronic-primary-dark));
        border: none;
        border-radius: 12px;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 16px rgba(27, 132, 255, 0.15);
    }
    .vafadar-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(27, 132, 255, 0.25);
    }
    .vafadar-btn:active {
        transform: translateY(0) scale(0.97);
    }

    /* ===== خطا ===== */
    .vafadar-error {
        color: var(--metronic-danger);
        font-size: 12px;
        margin-top: 4px;
        display: block;
        padding-right: 4px;
    }

    /* ===== ریسپانسیو ===== */
    @media (max-width: 768px) {
        .vafadar-form-grid {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }
        .vafadar-toggle-group {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 12px !important;
        }
        .vafadar-form-header h2 {
            font-size: 17px;
        }
        .vafadar-btn {
            padding: 10px 24px;
            font-size: 13px;
            width: 100%;
            justify-content: center;
        }
        .vafadar-form-footer {
            flex-direction: column;
            align-items: stretch !important;
            gap: 12px !important;
        }
    }

    @media (max-width: 480px) {
        .vafadar-form-header {
            padding: 14px 16px;
        }
        .vafadar-form-header h2 {
            font-size: 15px;
        }
        .vafadar-form-body {
            padding: 16px !important;
        }
        .vafadar-input {
            padding: 10px 14px;
            font-size: 12px;
        }
        .vafadar-toggle {
            width: 46px;
            height: 26px;
        }
        .vafadar-toggle-dot {
            width: 20px;
            height: 20px;
        }
        .vafadar-toggle.active .vafadar-toggle-dot {
            transform: translateX(20px);
        }
    }
</style>

<div class="w-full flex justify-center py-6">
    <div class="w-full max-w-4xl vafadar-form-card">

        <!-- ===== هدر ===== -->
        <div class="vafadar-form-header">
            <h2>
                <span class="header-icon">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M4 7h16M4 12h16M4 17h10"/>
                        <rect x="2" y="3" width="20" height="18" rx="2"/>
                    </svg>
                </span>
                ایجاد انتشارات جدید
            </h2>
            <p class="text-sm text-[#9A9CAE] mt-1 mr-12">اطلاعات انتشارات را وارد کنید</p>
        </div>

        <!-- ===== فرم ===== -->
        <form action="{{route('publication.store')}}" method="POST" id='form' class="vafadar-form-body p-6" enctype='multipart/form-data'>
            @csrf

            <!-- ===== گرید فیلدها ===== -->
            <div class="vafadar-form-grid grid grid-cols-2 max-[420px]:flex max-[420px]:flex-col gap-6">

                <!-- عنوان -->
                <div>
                    <label class="vafadar-label" for="title"> عنوان</label>
                    <input type="text" id="title" required placeholder="عنوان انتشارات را وارد کنید" name='title' value="{{old('title')}}" class="vafadar-input">
                    @error('title') <span class="vafadar-error">{{$message}}</span> @enderror
                </div>

                <!-- لوگو -->
                <div>
                    <label class="vafadar-label" for="logo_path"> لوگو</label>
                    <input type="file" id="logo_path" placeholder="=لوگو را وارد کنید" name='logo_path' class="vafadar-input">
                </div>

                <!-- توضیحات -->
                <div>
                    <label class="vafadar-label" for="description"> توضیحات</label>
                    <input type="text" id="description" placeholder="توضیحات انتشارات را وارد کنید" name='description' class="vafadar-input">
                </div>

                <!-- ===== توگل‌ها ===== -->
                <div class="vafadar-toggle-group col-span-2 flex gap-8 justify-start items-center">

                    <!-- نمایش در خانه -->
                    <div class="vafadar-toggle-label">
                        <span> نمایش در خانه</span>
                        <div class="vafadar-toggle" onclick="toggleState(this)">
                            <div class="vafadar-toggle-dot"></div>
                        </div>
                        <input type="number" name='show_in_home' value="0" class="absolute invisible">
                    </div>

                    <!-- فعال -->
                    <div class="vafadar-toggle-label">
                        <span> فعال</span>
                        <div class="vafadar-toggle" onclick="toggleState(this)">
                            <div class="vafadar-toggle-dot"></div>
                        </div>
                        <input type="number" name='is_active' value="0" class="absolute invisible">
                    </div>

                </div>

            </div>

            <!-- ===== فوتر ===== -->
            <div class="vafadar-form-footer flex items-center justify-between mt-6 pt-6 border-t border-[#DBDFE9]">
                <button type="submit" class="vafadar-btn">
                    <span>ثبت انتشارات</span>
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
                <span class="text-xs text-[#9A9CAE]">* تمامی فیلدها ضروری هستند</span>
            </div>

        </form>

    </div>
</div>

<script>
    function toggleState(el) {
        // پیدا کردن input مخفی
        let input = el.parentElement.querySelector('input[type="number"]');
        
        if (el.classList.contains('active')) {
            // غیرفعال
            el.classList.remove('active');
            if (input) input.value = 0;
        } else {
            // فعال
            el.classList.add('active');
            if (input) input.value = 1;
        }
    }

    // ===== تنظیم اولیه توگل‌ها (اگر مقدار اولیه 1 باشد) =====
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.vafadar-toggle-label').forEach(function(label) {
            let input = label.querySelector('input[type="number"]');
            let toggle = label.querySelector('.vafadar-toggle');
            
            if (input && input.value == 1 && toggle) {
                toggle.classList.add('active');
            }
        });
    });
</script>

@endsection