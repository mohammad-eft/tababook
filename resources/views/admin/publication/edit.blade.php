@extends('admin.app.dashboard')
@section('title', 'طبابوک | ویرایش انتشارات')
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

    /* ===== کانتینر اصلی ===== */
    .vafadar-publication-edit {
        background: var(--metronic-bg-content);
        min-height: 100vh;
        padding: 30px 20px;
    }

    /* ===== عنوان صفحه ===== */
    .vafadar-page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        text-align: center;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 12px;
    }
    .vafadar-page-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, var(--metronic-primary), var(--metronic-primary-dark));
        border-radius: 4px;
    }

    /* ===== تصویر ===== */
    .vafadar-image-box {
        width: 200px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid var(--metronic-border);
        position: relative;
        transition: all 0.3s ease;
        padding:10px;
    }
    .vafadar-image-box:hover {
        border-color: var(--metronic-primary);
        box-shadow: var(--shadow-sm);
    }
    .vafadar-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ===== کارت فرم ===== */
    .vafadar-publication-form {
        background: var(--metronic-bg-form);
        border: 1px solid var(--metronic-border);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        padding: 30px 35px 35px;
        max-width: 900px;
        margin: 0 auto;
        transition: all 0.3s ease;
    }
    .vafadar-publication-form:hover {
        box-shadow: var(--shadow-md);
    }

    /* ===== گرید فیلدها ===== */
    .vafadar-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
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

    /* ===== خطا ===== */
    .vafadar-error {
        color: var(--metronic-danger);
        font-size: 12px;
        margin-top: 4px;
        display: block;
        padding-right: 4px;
    }

    /* ===== توگل ===== */
    .vafadar-toggle-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .vafadar-toggle-wrapper .vafadar-label {
        margin-bottom: 0;
    }

    .vafadar-toggle-track {
        width: 52px;
        height: 30px;
        padding: 2px;
        border-radius: 50px;
        background: #F5F5F5;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border: 1.5px solid var(--metronic-border);
        cursor: pointer;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.04);
        flex-shrink: 0;
    }
    .vafadar-toggle-track.active {
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
    .vafadar-toggle-track.active .vafadar-toggle-dot {
        transform: translateX(-22px);
    }

    /* ===== دکمه ثبت ===== */
    .vafadar-submit-btn {
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
    .vafadar-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(27, 132, 255, 0.25);
    }
    .vafadar-submit-btn:active {
        transform: translateY(0) scale(0.97);
    }

    /* ===== فوتر فرم ===== */
    .vafadar-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid var(--metronic-border);
    }

    /* ===== ریسپانسیو ===== */
    @media (max-width: 768px) {
        .vafadar-form-grid {
            /* grid-template-columns: 1fr; */
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .vafadar-publication-form {
            padding: 20px 18px 24px;
            margin: 0 10px;
        }
        .vafadar-page-title {
            font-size: 20px;
        }
        .vafadar-form-footer {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }
        .vafadar-submit-btn {
            width: 100%;
            justify-content: center;
        }
        .vafadar-toggle-group {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 12px !important;
        }
    }

    @media (max-width: 480px) {
        .vafadar-publication-form {
            padding: 14px 12px 18px;
        }
        .vafadar-input {
            padding: 10px 14px;
            font-size: 12px;
        }
        .vafadar-page-title {
            font-size: 17px;
        }
        .vafadar-toggle-track {
            width: 46px;
            height: 26px;
        }
        .vafadar-toggle-dot {
            width: 20px;
            height: 20px;
        }
        .vafadar-toggle-track.active .vafadar-toggle-dot {
            transform: translateX(-20px);
        }
        .vafadar-submit-btn {
            padding: 10px 20px;
            font-size: 13px;
        }
    }
</style>

<div class="vafadar-publication-edit">

    <!-- ===== عنوان ===== -->
    <h1 class="vafadar-page-title"> ویرایش انتشارات</h1>

    <!-- ===== فرم ===== -->
    <form action="{{route('publication.update',['publication'=>$publication->id])}}" method="POST" id='form' class="vafadar-publication-form" enctype='multipart/form-data'>
        @csrf

        <!-- ===== گرید فیلدها ===== -->
        <div class="vafadar-form-grid">

            <!-- عنوان -->
            <div>
                <label class="vafadar-label" for="title"> عنوان</label>
                <input type="text" id="title" value="{{$publication->title}}" placeholder="عنوان انتشارات را وارد کنید" name='title' class="vafadar-input">
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
                <input type="text" id="description" value="{{$publication->description}}" placeholder="توضیحات انتشارات را وارد کنید" name='description' class="vafadar-input">
            </div>


                <div class="vafadar-image-box col-span-2">
                    @if($publication->logo_path!=null)
                        <img src="{{asset('storage/'.$publication->logo_path)}}" alt="{{$publication->title}}">
                    @else
                        <img class="" src="{{asset('assets/img/defaultPicture.jpg')}}" alt="{{$publication->title}}">
                    @endif
                </div>
            <!-- ===== توگل‌ها ===== -->
            <div class="col-span-2">
                <div class="flex gap-8 justify-start items-center flex-wrap vafadar-toggle-group">

                    <!-- نمایش در خانه -->
                    <div class="vafadar-toggle-wrapper">
                        <span class="vafadar-label"> نمایش در خانه</span>
                        <div class="vafadar-toggle-track {{$publication->show_in_home == 1 ? 'active' : ''}}" onclick="toggleState(this)">
                            <div class="vafadar-toggle-dot"></div>
                        </div>
                        <input type="number" name='show_in_home' value="{{$publication->show_in_home}}" class="absolute invisible">
                    </div>

                    <!-- فعال -->
                    <div class="vafadar-toggle-wrapper">
                        <span class="vafadar-label"> فعال</span>
                        <div class="vafadar-toggle-track {{$publication->is_active == 1 ? 'active' : ''}}" onclick="toggleState(this)">
                            <div class="vafadar-toggle-dot"></div>
                        </div>
                        <input type="number" name='is_active' value="{{$publication->is_active}}" class="absolute invisible">
                    </div>

                </div>

            </div>

        </div>

        <!-- ===== فوتر ===== -->
        <div class="vafadar-form-footer">
            <button type="submit" class="vafadar-submit-btn">
                <span> ذخیره تغییرات</span>
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M5 13l4 4L19 7"/>
                </svg>
            </button>
            <span class="text-xs text-[#9A9CAE]">* تمامی فیلدها ضروری هستند</span>
        </div>

    </form>

</div>

<script>
    function toggleState(el) {
        let input = el.parentElement.querySelector('input[type="number"]');
        
        if (el.classList.contains('active')) {
            el.classList.remove('active');
            if (input) input.value = 0;
        } else {
            el.classList.add('active');
            if (input) input.value = 1;
        }
    }
</script>

@endsection