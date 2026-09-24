@extends('app.document')
@section('title', 'جست و جو')
@section('content')
    <!-- address navbar -->



    <style>
        .heder_hover_item:hover .heder_hover_items_item{
    visibility: visible;
    opacity: 1;
    top:60px;
    transition: all 250ms ease-in 250ms;

}

.heder_hover_item:hover .dark_background{
    display: flex;
    visibility: visible;
    opacity: 1;
    position: fixed;
    top:80px;
    transition: all 250ms ease-in 250ms ;

}

.gradient{
background: linear-gradient(to bottom, #00000000 0px, rgb(255 255 255) 45px);
}
/* .dark_background:hover{
    visibility: invisible;
    display: none;
    opacity: 0;

    transition: all 250ms ease-in 250ms;
} /
/ .mahdi:hover{

    height: 700px;

} */
@media screen and (min-width:1024px){


    .product_box:hover .product_hover_box{
        height: auto;
         transition: all 250ms ease-in 100ms;
        transform: translate(0px,-50px);
    }

    .product_box:hover .product_hover_button_box {   
        visibility: visible;
        opacity: 1;
        transition: all 250ms ease-in 100ms;

    }
    .product_hover_button_box{
        transition: all 250ms ease-in 100ms;
        transform: translate(0px,0px);
    }
}



.product_box_button_hover:hover .product_box_button_hover_change_items1{
    opacity: 0;
    visibility: hidden;
     transition: all 250ms ease-in 100ms;
    transform: translate(0px,-23px);

}

.product_box_button_hover:hover .product_box_button_hover_change_items2{

    bottom: 0;
    opacity: 1;
    display: flex;
    justify-self: center;
    visibility: visible;
     transition: all 500ms ease-in 100ms;
    transform: translate(0px,-5px);

}
:root {
    --color-primary: #FD9636;
    --color-subheader-btn: #FD9636;
    --color-text: #425A8B;
    --color-secondary-text: #8C9EC5;
    --color-primary-text: #ffffff;
    --color-bg-card-btn: #425A8B;
    --color-bg-hover-btn: #425A8B;
    --color-primary-btn: #F0F3F8;
    --color-primary-btn-hover: #F0F3F8;
    --color-bg-contact-section: #425A8B;
    --color-btn-contact: #425A8B;
    --color-btn-contact-hover: #334a76;
    --color-border: #D5DFE4;
    --color-discount-bg: #D36B0B;
    --color-fill: #425A8B;
    --color-secondary: #0dcaf0;
    --color-success-bg: #00a049;
    --color-danger: #e6123d;
    --color-info: #1028ff;
    --color-secondary-bg: #efeff0;
}
@import url("fontiran.css");
/* @import url("primary_colors.css"); */



input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  margin: 0;
}

 {
  font-family: 'IRANSansX';
  scroll-behavior: smooth;
}

.samim {
  font-family: 'Samim';
}

.DimaShekasteh {
  font-family: 'DimaShekasteh';
}

.yekan {
  font-family: 'Yekan';
}

.menuLink svg path {
  transition: all 300ms;
}

.menuLink:hover {
  color: var(--color-primary);
}

.menuLink:hover svg>path {
  fill: var(--color-primary);
}

.menuItemParent:hover>.menuItemChild {
  margin-top: 0;
  opacity: 1;
  visibility: visible;
  pointer-events: visible;
  top: 56px;
}

.menuItemParent:hover>div {
  margin-top: 0;
  opacity: 1;
  visibility: visible;
  pointer-events: visible;
  max-height: 575px;
}


.activeSubMenuCat {
  background-color: #FD9636;
  color: white;
}

.productItem:hover div .buttonProduct {
  transform: translateX(16px);
  opacity: 1;
}


.productItem>div>.buttonProduct.btnAnimation,
.productItem>div>.buttonProduct.btnAnimation>svg>path,
.productAnimation,
.productAnimation>svg>path {
  animation: itemProduct 1s infinite;
}

.productItemNone:hover div.showMetric {
  display: block;
}

@keyframes itemProduct {
  0% {
    background-color: var(--color-primary);
    border-color: var(--color-primary);
    fill: white;

  }

  50% {
    background-color: white;
    border-color: #D5DFE4;
    fill: #425A8B;
  }

  100% {
    background-color: var(--color-primary);
    border-color: var(--color-primary);
    fill: white;
  }
}

.styles_Tooltip__tooltip___Mj8o {
  max-width: 320px;
  width: max-content;
  word-wrap: break-word;
  border: 1px solid black;
  background: var(--color-bg-card-btn);
  color: var(--color-primary-text);
  border-radius: 4px;
  padding: calc(2  4px) calc(3  4px);
  margin: calc(2  4px);
  display: none;
}

.hoverIcon:hover .styles_Tooltip__tooltip___Mj8o {
  display: block;
}


.productGrid:hover {
  z-index: 1;
  box-shadow: 0 1px 5px rgba(0, 0, 0, .2);
}

input[type="checkbox"] {
  appearance: none;
  width: 20px;
  height: 20px;
  border: 2px solid #555;
  border-radius: 4px;
  cursor: pointer;
  position: relative;
}

input[type="checkbox"]:checked {
  background-color: var(--color-secondary);
  border-color: var(--color-secondary);
}

input[type="checkbox"]:checked::after {
  content: "✔️";
  color: var(--color-primary-text);
  position: absolute;
  left: 3px;
  top: 0;
  font-size: 12px;
}

/ new /

.kt-card {
  border-radius: 12px;
  border: 1px solid white;
  box-shadow: 0 1px 2px 0 #0000000d;
}

.kt-btn {
  height: calc(.25rem  8.5);
  gap: calc(.25rem  1.5);
  border-radius: calc(.5rem - 2px);
  padding-inline: calc(.25rem  3);
  font-size: .8125rem;
  line-height: calc(1.25/.875);
}

.kt-btn-outline {
  border: 1px solid #e7e3e4;
  color: #1b1718;
  box-shadow: 0 0 #0000;
}

.kt-btn-outline:hover {
  background-color: #f5f4f4;
  color: #1b1718;
}

.kt-form-label {
  align-items: center;
  gap: calc(.25rem  2);
  width: 100%;
  font-size: .875rem;
  line-height: 1;
  font-weight: 500;
  display: flex;
}

.kt-input {
  width: 100%;
  height: calc(.25rem  8.5);
  border-radius: calc(.5rem - 2px);
  padding-inline: calc(.25rem * 3);
  font-size: .8125rem;
  line-height: calc(1.25/.875);
  outline: none;
  border: 1px solid #e7e3e4;
  color: #0b0809;
  box-shadow: 0 0 #0000;
  transition: all .15s;
}

.kt-input:focus-visible {
  border: 1px solid #9f9fa9;
  box-shadow: 0px 0px 3px 2px #b2b2ca;
}

.shadowHeader {
  box-shadow: -5px 2px 5px rgb(216 217 229);
}

.responsive-menu-shadow {
  box-shadow: 0px 0px 8px #888888;
}
    </style>



    <section
        class="w-11/12 mx-auto lg:mb-5 py-5 flex flex-row justify-between items-center text-[#beb1d6] text-xs lg:text-sm">
        <nav class="flex flex-row items-center text-xs lg:text-base">
            <div>
                <a href="#" class="leading-[2.17]">
                    <span class="border-b border-[#beb1d6] lg:border-none">
                        تبابوک
                    </span>
                    <span class="mx-3">/</span>
                </a>
            </div>
            <div>
                <a href="#" class="leading-[2.17]">
                    <span class="border-b border-[#beb1d6] lg:border-none">
                        {{ $product->category->title ?? 'بدون دسته بندی' }}
                    </span>
                    <span class="mx-3">/</span>
                </a>
            </div>
            <div>
                <a href="#" class="leading-[2.17]">
                    <span class="border-b border-[#beb1d6] lg:border-none">
                        {{ $product->title }}
                    </span>
                </a>
            </div>
        </nav>
        <div class="hidden lg:block">
            <a href="#" class="flex flex-row gap-2 items-center">
                فروش در تبابوک
                <svg xmlns="http://www.w3.org/2000/svg" class="size-[18px]" viewBox="0 0 640 512">
                    <path fill="var(--color-fill)"
                        d="M0 185.8c0-6.4 1.6-12.7 4.7-18.3L82.4 25C90.8 9.6 106.9 0 124.5 0h391c17.6 0 33.7 9.6 42.1 25l77.7 142.4c3.1 5.6 4.7 11.9 4.7 18.3c0 21.1-17.1 38.2-38.2 38.2H576V496c0 8.8-7.2 16-16 16s-16-7.2-16-16V224H96V352H352V272 256h32v16V464c0 26.5-21.5 48-48 48H112c-26.5 0-48-21.5-48-48V224H38.2C17.1 224 0 206.9 0 185.8zM80 192H560h41.8c3.4 0 6.2-2.8 6.2-6.2c0-1-.3-2.1-.8-3L529.6 40.3c-2.8-5.1-8.2-8.3-14-8.3h-391c-5.9 0-11.2 3.2-14 8.3L32.8 182.8c-.5 .9-.8 1.9-.8 3c0 3.4 2.8 6.2 6.2 6.2H80zM96 464c0 8.8 7.2 16 16 16H336c8.8 0 16-7.2 16-16V384H96v80z" />
                </svg>
            </a>
        </div>
    </section>
    <!-- address navbar -->

    <!-- single product -->
    <section class="w-11/12 text-(--color-text) mx-auto">
        <div class="flex flex-col lg:flex-row">
            <div class="lg:ml-4 shrink-0 flex flex-col-reverse lg:flex-col lg:w-[36%] overflow-hidden">
                <div
                    class="flex gap-3 items-center justify-between px-2 py-2 lg:mb-5 bg-(--color-primary)/20 text-(--color-discount-bg) border-t-2 rounded-t-[19px] lg:hidden border-[--color-discount-bg]">
                    <div>
                        <span class="font-bold">
                            پیشنهاد شگفت انگیز
                        </span>
                    </div>
                    <div class="flex flex-row items-center gap-3">
                        <span class="text-sm">07 : 34 : 02</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512">
                            <path fill="var(--color-discount-bg)"
                                d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                        </svg>
                    </div>
                </div>
                <div
                    class="lg:flex gap-3 items-center justify-between px-2 py-2 lg:mb-5 bg-(--color-primary)/20 text-(--color-discount-bg) hidden">
                    <div>
                        <span class="font-bold">
                            پیشنهاد شگفت انگیز
                        </span>
                    </div>
                    <div class="flex flex-row items-center gap-3">
                        <span class="text-sm">07 : 34 : 02</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512">
                            <path fill="var(--color-discount-bg)"
                                d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col items-center lg:items-start lg:max-w-[368px] xl:max-w-[580px]">
                    <div class="w-full flex justify-center relative bg-(--color-primary-btn) lg:bg-white">
                        <div class="hidden lg:flex lg:flex-col lg:gap-y-4 self-end lg:self-start">
                            <div class="hoverIcon">
                                <div
                                    class="z-1 whitespace-nowrap ml-6 lg:ml-4 size-6 flex justify-center items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                        <path fill="var(--color-fill)"
                                            d="M244 130.6l-12-13.5-4.2-4.7c-26-29.2-65.3-42.8-103.8-35.8c-53.3 9.7-92 56.1-92 110.3v3.5c0 32.3 13.4 63.1 37.1 85.1L253 446.8c.8 .7 1.9 1.2 3 1.2s2.2-.4 3-1.2L443 275.5c23.6-22 37-52.8 37-85.1v-3.5c0-54.2-38.7-100.6-92-110.3c-38.5-7-77.8 6.6-103.8 35.8l-4.2 4.7-12 13.5c-3 3.4-7.4 5.4-12 5.4s-8.9-2-12-5.4zm34.9-57.1C311 48.4 352.7 37.7 393.7 45.1C462.2 57.6 512 117.3 512 186.9v3.5c0 36-13.1 70.6-36.6 97.5c-3.4 3.8-6.9 7.5-10.7 11l-184 171.3c-.8 .8-1.7 1.5-2.6 2.2c-6.3 4.9-14.1 7.5-22.1 7.5c-9.2 0-18-3.5-24.8-9.7L47.2 299c-3.8-3.5-7.3-7.2-10.7-11C13.1 261 0 226.4 0 190.4v-3.5C0 117.3 49.8 57.6 118.3 45.1c40.9-7.4 82.6 3.2 114.7 28.4c6.7 5.3 13 11.1 18.7 17.6l4.2 4.7 4.2-4.7c4.2-4.7 8.6-9.1 13.3-13.1c1.8-1.5 3.6-3 5.4-4.5z" />
                                    </svg>
                                </div>
                                <div class="z-4 text-sm styles_Tooltip__tooltip___Mj8o"
                                    style="position: absolute; inset: 0px 0px auto auto; transform: translate(-24px, -10px);">
                                    اضافه به علاقه مندی
                                </div>
                            </div>
                            <div class="hoverIcon">
                                <div
                                    class="z-1 whitespace-nowrap ml-6 lg:ml-4 size-6 flex justify-center items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 448 512">
                                        <path fill="var(--color-fill)"
                                            d="M448 112c0 44.2-35.8 80-80 80c-22.9 0-43.6-9.6-58.1-25l-151 75.5c.8 4.4 1.1 8.9 1.1 13.5s-.4 9.1-1.1 13.5l151 75.5c14.6-15.4 35.2-25 58.1-25c44.2 0 80 35.8 80 80s-35.8 80-80 80s-80-35.8-80-80c0-9.7 1.7-19 4.9-27.7L147.2 299.5c-14.3 22-39 36.5-67.2 36.5c-44.2 0-80-35.8-80-80s35.8-80 80-80c28.2 0 52.9 14.5 67.2 36.5l145.7-72.9c-3.2-8.6-4.9-17.9-4.9-27.7c0-44.2 35.8-80 80-80s80 35.8 80 80zM80 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM416 112a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM368 448a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                    </svg>
                                </div>
                                <div class="z-4 text-sm styles_Tooltip__tooltip___Mj8o"
                                    style="position: absolute; inset: 0px 0px auto auto; transform: translate(-24px, 30px);">
                                    به اشتراک گذاری کالا
                                </div>
                            </div>
                            <div class="hoverIcon">
                                <div
                                    class="z-1 whitespace-nowrap ml-6 lg:ml-4 size-6 flex justify-center items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                        <path fill="var(--color-fill)"
                                            d="M240 16c0-8.8 7.2-16 16-16s16 7.2 16 16V32.8c80.9 8 144 76.2 144 159.2v29.1c0 43.7 17.4 85.6 48.3 116.6l2.8 2.8c8.3 8.3 13 19.6 13 31.3c0 24.5-19.8 44.3-44.3 44.3H76.3C51.8 416 32 396.2 32 371.7c0-11.7 4.7-23 13-31.3l2.8-2.8C78.6 306.7 96 264.8 96 221.1V192c0-83 63.1-151.2 144-159.2V16zm16 48c-70.7 0-128 57.3-128 128v29.1c0 52.2-20.7 102.3-57.7 139.2L67.6 363c-2.3 2.3-3.6 5.4-3.6 8.7c0 6.8 5.5 12.3 12.3 12.3H435.7c6.8 0 12.3-5.5 12.3-12.3c0-3.3-1.3-6.4-3.6-8.7l-2.8-2.8c-36.9-36.9-57.7-87-57.7-139.2V192c0-70.7-57.3-128-128-128zM225.8 458.7c4.4 12.4 16.3 21.3 30.2 21.3s25.8-8.9 30.2-21.3c2.9-8.3 12.1-12.7 20.4-9.8s12.7 12.1 9.8 20.4C307.6 494.2 283.9 512 256 512s-51.6-17.8-60.4-42.7c-2.9-8.3 1.4-17.5 9.8-20.4s17.5 1.4 20.4 9.8zM119.4 21.8c5.7 6.8 4.7 16.9-2.1 22.5C74.9 79.5 48 132.6 48 192c0 8.8-7.2 16-16 16s-16-7.2-16-16C16 122.7 47.5 60.8 96.9 19.7c6.8-5.7 16.9-4.7 22.5 2.1zM397.8 44.3c-6.8-5.7-7.7-15.7-2.1-22.5s15.7-7.7 22.5-2.1c49.4 41.1 80.9 103 80.9 172.3c0 8.8-7.2 16-16 16s-16-7.2-16-16c0-59.4-26.9-112.5-69.3-147.7z" />
                                    </svg>
                                </div>
                                <div class="z-4 text-sm styles_Tooltip__tooltip___Mj8o"
                                    style="position: absolute; inset: 0px 0px auto auto; transform: translate(-24px, 70px);">
                                    اطلاع رسانی شگفت انگیز
                                </div>
                            </div>
                            <div class="hoverIcon">
                                <div
                                    class="z-1 whitespace-nowrap ml-6 lg:ml-4 size-6 flex justify-center items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                        <path fill="var(--color-fill)"
                                            d="M32 48c0-8.8-7.2-16-16-16S0 39.2 0 48V400c0 44.2 35.8 80 80 80H496c8.8 0 16-7.2 16-16s-7.2-16-16-16H80c-26.5 0-48-21.5-48-48V48zM475.3 155.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L320 265.4l-84.7-84.7c-6.2-6.2-16.4-6.2-22.6 0l-112 112c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L224 214.6l84.7 84.7c6.2 6.2 16.4 6.2 22.6 0l144-144z" />
                                    </svg>
                                </div>
                                <div class="z-4 text-sm styles_Tooltip__tooltip___Mj8o"
                                    style="position: absolute; inset: 0px 0px auto auto; transform: translate(-24px, 110px);">
                                    نمودار قیمت
                                </div>
                            </div>
                            <div class="hoverIcon">
                                <div
                                    class="z-1 whitespace-nowrap ml-6 lg:ml-4 size-6 flex justify-center items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                        <path fill="var(--color-fill)"
                                            d="M322.8 484.2c6.5 5.9 7 16.1 1.1 22.6s-16.1 7-22.6 1.1l-88-80c-3.3-3-5.2-7.3-5.2-11.8s1.9-8.8 5.2-11.8l88-80c6.5-5.9 16.7-5.5 22.6 1.1s5.5 16.7-1.1 22.6L265.4 400H336c44.2 0 80-35.8 80-80V158.4c-36.5-7.4-64-39.7-64-78.4c0-44.2 35.8-80 80-80s80 35.8 80 80c0 38.7-27.5 71-64 78.4V320c0 61.9-50.1 112-112 112H265.4l57.4 52.2zM384 80a48 48 0 1 0 96 0 48 48 0 1 0 -96 0zM189.2 27.8c-6.5-5.9-7-16.1-1.1-22.6s16.1-7 22.6-1.1l88 80c3.3 3 5.2 7.3 5.2 11.8s-1.9 8.8-5.2 11.8l-88 80c-6.5 5.9-16.7 5.5-22.6-1.1s-5.5-16.7 1.1-22.6L246.6 112H176c-44.2 0-80 35.8-80 80V353.6c36.5 7.4 64 39.7 64 78.4c0 44.2-35.8 80-80 80s-80-35.8-80-80c0-38.7 27.5-71 64-78.4V192c0-61.9 50.1-112 112-112h70.6L189.2 27.8zM128 432a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z" />
                                    </svg>
                                </div>
                                <div class="z-4 text-sm styles_Tooltip__tooltip___Mj8o"
                                    style="position: absolute; inset: 0px 0px auto auto; transform: translate(-24px, 150px);">
                                    مقایسه کالا
                                </div>
                            </div>
                            <div class="hoverIcon">
                                <div
                                    class="z-1 whitespace-nowrap ml-6 lg:ml-4 size-6 flex justify-center items-center cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 rotate-y-180"
                                        viewBox="0 0 512 512">
                                        <path fill="var(--color-fill)"
                                            d="M48 112V80H80v32H48zM16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40C26.7 48 16 58.7 16 72zm160 8c-8.8 0-16 7.2-16 16s7.2 16 16 16H496c8.8 0 16-7.2 16-16s-7.2-16-16-16H176zm0 160c-8.8 0-16 7.2-16 16s7.2 16 16 16H496c8.8 0 16-7.2 16-16s-7.2-16-16-16H176zm0 160c-8.8 0-16 7.2-16 16s7.2 16 16 16H496c8.8 0 16-7.2 16-16s-7.2-16-16-16H176zM48 240H80v32H48V240zm-8-32c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40zm8 224V400H80v32H48zM16 392v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24z" />
                                    </svg>
                                </div>
                                <div class="z-4 text-sm styles_Tooltip__tooltip___Mj8o"
                                    style="position: absolute; inset: 0px 0px auto auto; transform: translate(-24px, 190px);">
                                    افزودن به لیست
                                </div>
                            </div>
                        </div>
                        <div class="hidden lg:flex items-center cursor-pointer">
                            @foreach ($product->media as $media)
                                @if ($media->is_main)
                                    @if ($media->media_path)
                                        <img class="w-full rounded-large overflow-hidden inline-block"
                                            src="{{ asset('/storage/' . $media->media_path) }}" alt="product image">
                                    @else
                                        <img class="w-full rounded-large overflow-hidden inline-block"
                                            src="{{ asset('/storage/images/noImage.png') }}" alt="product image">
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div
                            class="lg:hidden flex items-center cursor-pointer max-h-[250px] h-[250px] w-[250px] bg-(--color-primary-btn) lg:bg-white">
                            @foreach ($product->media as $media)
                                @if ($media->is_main)
                                    @if ($media->media_path)
                                        <img class="w-full rounded-large overflow-hidden inline-block"
                                            src="{{ asset('/storage/' . $media->media_path) }}" alt="product image">
                                    @else
                                        <img class="w-full rounded-large overflow-hidden inline-block"
                                            src="{{ asset('/storage/images/noImage.png') }}" alt="product image">
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="w-full overflow-x-auto touch-pan-x" style="scrollbar-width:none;">
                        <div class="hidden lg:flex flex-row items-center mt-5 mb-3 ">
                            @foreach ($product->media as $media)
                                @if (!$media->is_main)
                                    <div class="cursor-pointer rounded border border-(--color-border)    p-1 ml-2">
                                        <div class="w-[72px] h-[72px]">
                                            <img class="size-full object-cover"
                                                src="{{ asset('storage/' . $media->media_path) }}" alt="">
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>

                    </div>
                    <div class="hidden w-full lg:flex items-center justify-start text-xs xl:text-sm">
                        <span
                            class="flex justify-center pt-1 items-center size-4 border border-[var(--color-text)] rounded-full">!</span>
                        <span class="mr-2 ml-5 xl:ml-9">
                            گزارش مشخصات کالا یا موارد قانونی
                        </span>
                        <span class="text-xs">مشخصات تستی کالا</span>
                    </div>
                </div>
            </div>
            <div class="grow min-w-0 flex flex-row gap-3">
                <div class="w-full lg:w-1/2 xl:w-7/12">
                    <div class="flex items-center w-full lg:px-0 pt-4 lg:pt-0 px-2">
                        <nav class="flex items-center text-sm lg:text-base">
                            <a href="#"
                                class="text-(--color-text) border-b border-(--color-border) lg:border-none lg:text-(--color-primary) text-xs lg:text-base">{{ $product->category->title ?? 'بدون دسته بندی' }}</a>
                            <span class="text-(--color-text) mx-2 hidden lg:inline-block">/</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3 mx-2 lg:hidden" viewBox="0 0 320 512">
                                <path fill="var(--color-text)"
                                    d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                            </svg>
                            <a href="#"
                                class="text-(--color-text) border-b border-(--color-border) lg:border-none lg:text-(--color-primary) text-xs lg:text-base">
                                {{ $product->title }}
                            </a>
                        </nav>
                    </div>
                    <h1
                        class="text-md xl:text-3xl text-(--color-text) font-bold mt-3 mb-2 pointer-events-none px-2 lg:px-0">
                        {{ $product->title }}
                    </h1>
                    <div class="lg:pb-5 mb-5 lg:border-b border-(--color-border)  px-2 lg:px-0">
                        <span class="text-xs text-[#beb1d6]">{{ $product->brand }}</span>
                    </div>
                    <div
                        class="flex flex-col items-start sm:flex-row sm:itesm-center lg:flex-col lg:items-start xl:flex-row xl:items-center gap-2.5  px-2 lg:px-0">
                        <div class="flex flex-row items-center gap-1 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512">
                                <path fill="gold"
                                    d="M288.1 0l86.5 164 182.7 31.6L428 328.5 454.4 512 288.1 430.2 121.7 512l26.4-183.5L18.9 195.6 201.5 164 288.1 0z" />
                            </svg>
                            <span>3.8</span>
                            <span class="text-[#beb1d6] inline-block w-[100px]">
                                (امتیاز 307 خریدار)
                            </span>
                        </div>
                        <div class="w-full overflow-x-auto" style="scrollbar-width: none;">
                            <div class="flex flex-row items-center gap-1 text-xs mb-3 lg:mb-0">
                                <div
                                    class="flex flex-row items-center gap-1 bg-(--color-primary-btn) rounded-full px-2 py-1 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512">
                                        <path fill="var(--color-primary)"
                                            d="M356 60L336 0 316 60 256 80l60 20 20 60 20-60 60-20L356 60zM464 208l-16-48-16 48-48 16 48 16 16 48 16-48 48-16-48-16zM253.3 265.1L193.5 144 133.7 265.1 0 284.6l96.7 94.3L73.9 512l119.6-62.9L313 512 290.2 378.9l96.7-94.3L253.3 265.1z" />
                                    </svg>
                                    <span class="block w-[90px]">
                                        خلاصه دیدگاه ها
                                    </span>
                                </div>
                                <div
                                    class="flex flex-row items-center gap-1 bg-(--color-primary-btn) rounded-full px-2 py-1 cursor-pointer">
                                    <span class="block w-[90px]">
                                        213 دیدگاه
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>

                                </div>
                                <div
                                    class="flex flex-row items-center gap-1 bg-(--color-primary-btn) rounded-full px-2 py-1 cursor-pointer">
                                    <span class="block w-[90px]">
                                        98 پرسش
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:hidden border-b border-(--color-border)  px-2 lg:px-0">
                        <div
                            class="relative mb-5 py-3 sm:py-4 pr-3 gap-1.5 overflow-hidden rounded-md bg-(--color-primary-btn) flex flex-row items-center before:absolute before:content-[''] before:right-0 before:top-0 before:h-full before:w-1 before:bg-(--color-primary) ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512">
                                <path fill="var(--color-primary)"
                                    d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                            </svg>
                            <span class="text-(--color-text) text-xs">
                                تحویل امروز با ارسال سریع
                            </span>
                        </div>

                    </div>
                    <div
                        class="py-3 flex flex-col gap-3 font-bold text-(--color-text) border-b border-(--color-border) lg:border-none  px-2 lg:px-0">
                        <div class="flex flex-row items-center text-sm lg:text-base">
                            <span>رنگ : </span>
                            <div class="flex flex-row items-center gap-1.5">
                                <span> مشکی </span>
                                <span class="size-4 rounded-full" style="background-color: rgb(33, 33, 33)"></span>
                            </div>
                        </div>
                        <div class="w-full">
                            <span
                                class="w-fit flex flex-row items-center lg:mt-3 gap-1.5 border border-black lg:border-none rounded-md px-3 py-1.5 lg:px-0 lg:py-0 cursor-pointer">
                                <span
                                    class="size-5 lg:size-[30px] bg-black rounded-full flex justify-center items-center lg:ring-4 lg:ring-[var(--color-primary)] lg:ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 lg:size-6"
                                        viewBox="0 0 448 512">
                                        <path fill="white"
                                            d="M443.3 100.7c6.2 6.2 6.2 16.4 0 22.6l-272 272c-6.2 6.2-16.4 6.2-22.6 0l-144-144c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L160 361.4 420.7 100.7c6.2-6.2 16.4-6.2 22.6 0z" />
                                    </svg>
                                </span>
                                <span class="text-xs text-(--color-text) lg:hidden">
                                    مشکی
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col-reverse lg:flex-col">
                        {{-- <div class="mb-4 lg:mb-2  px-2 lg:px-0">
                            <p class="py-3 text-md font-bold text-(--color-text)">بیمه</p>
                            <div class="flex flex-row items-center border border-(--color-border) rounded-md">
                                <div>
                                    <label class="flex items-center cursor-pointer py-1 pl-1 pr-3">
                                        <input type="checkbox" name="">
                                    </label>
                                </div>
                                <div
                                    class="grow p-2 lg:border-r border-(--color-border) flex flex-row justify-between items-center lg:items-end">
                                    <div>
                                        <p class="text-xs md:text-sm leading-[2.17]">
                                            بیمه تجهیزات دیجیتال - بیمه سامان
                                        </p>
                                        <div class="flex items-center ml-auto">
                                            <div class="flex flex-row items-center ml-1">
                                                <div
                                                    class="px-1.5 flex flex-row items-center bg-[var(--color-discount-bg)] rounded-full text-(--color-primary-text) ml-1">
                                                    <span class="leading-normal text-xs">50%</span>
                                                </div>
                                                <div
                                                    class="text-[#beb1d6] leading-normal line-through font-bold md:text-sm text-xs">
                                                    30,800
                                                </div>
                                            </div>
                                            <div
                                                class="flex items-center gap-1  text-(--color-text) text-xs md:text-sm grow">
                                                <span class="font-bold">15,400</span>
                                                <span class="text-xs">تومان</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="flex flex-row justify-between items-center mt-1">
                                        <div
                                            class="inline-flex items-center cursor-pointer text-xs md:text-sm text-[var(--color-secondary)]">
                                            <span>
                                                جزئیات
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3 md:size-4"
                                                viewBox="0 0 320 512">
                                                <path fill="var(--color-secondary)"
                                                    d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div
                            class="w-full lg:pt-2 pb-3 lg:pb-0 border-b border-(--color-border) lg:border-none text-(--color-text)  px-2 lg:px-0">
                            <h3 class="text-lg font-bold py-3 hidden lg:block">
                                ویژگی ها
                            </h3>
                            <h3 class="text-md font-bold py-3 lg:hidden flex felx-row justify-between items-center">
                                <span>ویژگی ها</span>
                                <a href="#" class="text-xs flex flex-row items-center">
                                    <span>مشاهده همه</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </a>
                            </h3>
                            <ul class="w-full flex flex-row items-center lg:grid lg:grid-cols-3 gap-1 overflow-x-scroll"
                                style="scrollbar-width:none;">
                                <li class="w-fit lg:w-full bg-(--color-primary-btn) p-2 rounded-md h-full">
                                    <div class="flex flex-row items-center">
                                        <p class="text-sm text-[var(--color-text-secondary)]">
                                            فناوری صفحه نمایش
                                        </p>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 mr-2 lg:hidden"
                                            viewBox="0 0 320 512">
                                            <path fill="var(--color-fill)"
                                                d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-(--color-text) font-bold">
                                        TFT
                                    </p>
                                </li>
                                <li class="w-fit lg:w-full bg-(--color-primary-btn) p-2 rounded-md h-full">
                                    <div class="flex flex-row items-center">
                                        <p class="text-sm text-[var(--color-text-secondary)]">
                                            اندازه
                                        </p>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 mr-2 lg:hidden"
                                            viewBox="0 0 320 512">
                                            <path fill="var(--color-fill)"
                                                d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-(--color-text) font-bold">
                                        15.2
                                    </p>
                                </li>

                            </ul>
                        </div>
                        <div class="hidden lg:flex flex-row gap-4 justify-center items-center mt-4">
                            <hr class="border-t border-(--color-border) w-1/6 xl:w-full">
                            <button
                                class="px-4 py-2 rounded-md flex flex-row gap-2 items-center justify-center border border-(--color-border) cursor-pointer w-4/6 xl:w-full">
                                <span class="text-(--color-text) text-sm font-bold">
                                    مشاهده ویژگی ها
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                    <path fill="var(--color-fill)"
                                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                </svg>
                            </button>
                            <hr class="border-t border-(--color-border) w-1/6 xl:w-full">
                        </div>
                    </div>


                    <div class="my-3 hidden lg:flex flex-row gap-2">
                        <span class="size-[18px] flex justify-center items-center bg-[var(--color-text)] rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-[18px]" viewBox="0 0 192 512">
                                <path fill="var(--color-primary-text)"
                                    d="M64 64a32 32 0 1 1 64 0A32 32 0 1 1 64 64zM16 176c0-8.8 7.2-16 16-16H96c8.8 0 16 7.2 16 16V448h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H16c-8.8 0-16-7.2-16-16s7.2-16 16-16H80V192H32c-8.8 0-16-7.2-16-16z" />
                            </svg>
                        </span>
                        <p class="text-sm leading-[2.15] text-[#beb1d6] text-justify">
                            {{ $product->description }}
                        </p>
                    </div>

                    <hr class="w-full border-none h-2 bg-[var(--color-border)] lg:hidden">

                    <div class="lg:hidden py-5 px-2 text-(--color-text)">
                        <h3 class="text-md font-bold leading-[180%]">
                            فروشنده
                        </h3>


                        <a href="#" class="flex flex-row gap-3 items-center">
                            <!-- logo -->
                            <div class="size-9 p-2 bg-(--color-primary) rounded-full">
                                <!-- logo content -->
                            </div>
                            <!-- logo -->

                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <div class="flex flex-row items-center">
                                    <span class="text-sm font-bold">
                                        تبابوک
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>

                                    <span
                                        class="rounded-full bg-(--color-primary-btn) text-xs text-(--color-primary) leading-[180%] px-2 mr-2 font-bold">
                                        رسمی
                                    </span>
                                    <span
                                        class="rounded-full bg-(--color-primary-btn) text-xs text-(--color-primary) leading-[180%] px-2 mr-2 font-bold">
                                        منتخب
                                    </span>
                                </div>
                                <div class="flex flex-row items-center gap-1.5">
                                    <div
                                        class="flex flex-row items-center gap-1.5 py-0.5 pr-2 pl-0.5 border border-(--color-border) rounded-full text-xs font-bold">
                                        رضایت از کالا
                                        <span
                                            class="text-xs leading-[125%] rounded-full bg-(--color-primary) text-(--color-primary-text) px-2 py-0.5">77.8%</span>
                                    </div>
                                    <div
                                        class="flex flex-row items-center gap-1.5 py-0.5 pr-2 pl-0.5 border border-(--color-border) rounded-full text-xs font-bold">
                                        عملکرد
                                        <span
                                            class="text-xs leading-[125%] rounded-full bg-[var(--color-success-bg)] text-(--color-primary-text) px-2 py-0.5">
                                            عالی
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="flex flex-row gap-3 items-center">

                            <div class="size-9 p-2 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                    <path fill="var(--color-fill)"
                                        d="M243.5 37.3c8-3.4 17-3.4 25 0l176.7 75c11.3 4.8 18.9 15.5 18.8 27.6c-.5 94-39.4 259.8-195.5 334.5c-7.9 3.8-17.2 3.8-25.1 0C87.3 399.6 48.5 233.8 48 139.8c-.1-12.1 7.5-22.8 18.8-27.6l176.7-75zM281 7.8c-16-6.8-34-6.8-50 0L54.3 82.8c-22 9.3-38.4 31-38.3 57.2c.5 99.2 41.3 280.7 213.6 363.2c16.7 8 36.1 8 52.8 0C454.7 420.7 495.5 239.2 496 140c.1-26.2-16.3-47.9-38.3-57.2L281 7.8zm82.3 195.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L224 297.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l64 64c6.2 6.2 16.4 6.2 22.6 0l128-128z" />
                                </svg>
                            </div>


                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <p class="text-xs font-medium leading-[180%]">
                                    گارانتی 18 ماهه هوشمند پردازان ژیوان
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-row gap-3 items-start">

                            <div class="pt-2">
                                <div
                                    class="size-9 p-2 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 448 512">
                                        <path fill="var(--color-fill)"
                                            d="M240 64H342.4c12.6 0 24.1 7.4 29.2 19l34.2 77H240V64zm0 128H416V416c0 17.7-14.3 32-32 32H64c-17.7 0-32-14.3-32-32V192H208h32zm-32-32H42.1L76.3 83c5.1-11.6 16.6-19 29.2-19H208v96zM400.9 70c-10.3-23.1-33.2-38-58.5-38H105.6C80.3 32 57.4 46.9 47.1 70L5.5 163.6c-3.6 8.2-5.5 17-5.5 26V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V189.6c0-9-1.9-17.8-5.5-26L400.9 70zM331.3 251.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 345.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l64 64c6.2 6.2 16.4 6.2 22.6 0l128-128z" />
                                    </svg>
                                </div>
                            </div>


                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <div class="text-xs font-medium leading-[180%] flex flex-row justify-between items-center">
                                    <span>
                                        روش ها و هزینه های ارسال
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </div>
                                <div class="text-xs font-medium leading-[180%] flex flex-row justify-start items-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 rotate-y-180"
                                        viewBox="0 0 640 512">
                                        <path fill="var(--color-danger)"
                                            d="M64 32C46.3 32 32 46.3 32 64V352c0 17.7 14.3 32 32 32h5.5c13.2-37.3 48.7-64 90.5-64s77.4 26.7 90.5 64H384V64c0-17.7-14.3-32-32-32H64zm0 384c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H352c35.3 0 64 28.7 64 64V96h65.3c14 0 27.3 6.1 36.4 16.8l78.7 91.8c7.5 8.7 11.6 19.8 11.6 31.2V384h16c8.8 0 16 7.2 16 16s-7.2 16-16 16H576c0 53-43 96-96 96s-96-43-96-96H256c0 53-43 96-96 96s-96-43-96-96zM416 224H570.9l-77.5-90.4c-3-3.5-7.5-5.6-12.1-5.6H416v96zm0 32v88.4c17-15.2 39.4-24.4 64-24.4c41.8 0 77.4 26.7 90.5 64H576V256H416zM224 416A64 64 0 1 0 96 416a64 64 0 1 0 128 0zm256 64a64 64 0 1 0 0-128 64 64 0 1 0 0 128z" />
                                    </svg>
                                    <span class="mr-2 text-xs text-[#beb1d6]">
                                        توسط مجموعه تبابوک
                                    </span>
                                </div>
                                <div class="text-sm font-bold leading-[180%] flex flex-row justify-start items-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                        <path fill="var(--color-info)"
                                            d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                    </svg>
                                    <span class="mr-2 text-xs text-[#beb1d6]">
                                        ارسال سریع
                                    </span>
                                </div>

                            </div>
                        </div>



                        <div class="flex flex-row gap-3 items-center">
                            <div class="size-9 p-2 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 448 512">
                                    <path fill="var(--color-fill)"
                                        d="M224 32c6.2 0 11.9 3.6 14.5 9.3l63.2 136.9 136.9 63.2c5.7 2.6 9.3 8.3 9.3 14.5s-3.6 11.9-9.3 14.5L301.8 333.8 238.5 470.7c-2.6 5.7-8.3 9.3-14.5 9.3s-11.9-3.6-14.5-9.3L146.2 333.8 9.3 270.5C3.6 267.9 0 262.2 0 256s3.6-11.9 9.3-14.5l136.9-63.2L209.5 41.3c2.6-5.7 8.3-9.3 14.5-9.3zm0 54.2L172.8 197c-1.6 3.5-4.4 6.2-7.8 7.8L54.2 256 165 307.2c3.5 1.6 6.2 4.4 7.8 7.8L224 425.8 275.2 315c1.6-3.5 4.4-6.2 7.8-7.8L393.8 256 283 204.8c-3.5-1.6-6.2-4.4-7.8-7.8L224 86.2z" />
                                </svg>
                            </div>


                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <h3 class="text-xs font-medium leading-[180%]">
                                    ویژه اعضای پلاس
                                </h3>
                                <p class="text-xs text-[#beb1d6]">
                                    ارسال سریع مجموعه تبابوک (فقط برای تهران و کرج)
                                </p>
                            </div>
                        </div>



                        <div class="flex flex-row gap-3 items-center">
                            <div class="size-9 p-2 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 448 512">
                                    <path fill="var(--color-fill)"
                                        d="M320 128a96 96 0 1 0 -192 0 96 96 0 1 0 192 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM32 480H416c-1.2-79.7-66.2-144-146.3-144H178.3c-80 0-145 64.3-146.3 144zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                                </svg>
                            </div>


                            <div
                                class="w-full flex flex-row justify-between items-center gap-2 py-4 border-b border-(--color-border)">
                                <h3 class="text-xs font-bold leading-[180%]">
                                    92 امتیاز دیجی کلاب دریافت می کنید
                                </h3>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                    <path fill="var(--color-fill)"
                                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <hr class="w-full border-none h-2 bg-[var(--color-border)] lg:hidden">

                    {{-- <div class="lg:px-0 px-2 pt-5 pb-5 lg:pb-0">
                        <h3 class="text-md font-bold leading-[180%] pb-3">
                            خدمات پرداخت و ارسال
                        </h3>
                        <div class="pt-3 border border-(--color-border) rounded-md relative">
                            <div class="pb-4 px-3 flex flex-col gap-2">

                                <div class="flex flex-row items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 448 512">
                                        <path fill="var(--color-primary)"
                                            d="M224 32c6.2 0 11.9 3.6 14.5 9.3l63.2 136.9 136.9 63.2c5.7 2.6 9.3 8.3 9.3 14.5s-3.6 11.9-9.3 14.5L301.8 333.8 238.5 470.7c-2.6 5.7-8.3 9.3-14.5 9.3s-11.9-3.6-14.5-9.3L146.2 333.8 9.3 270.5C3.6 267.9 0 262.2 0 256s3.6-11.9 9.3-14.5l136.9-63.2L209.5 41.3c2.6-5.7 8.3-9.3 14.5-9.3zm0 54.2L172.8 197c-1.6 3.5-4.4 6.2-7.8 7.8L54.2 256 165 307.2c3.5 1.6 6.2 4.4 7.8 7.8L224 425.8 275.2 315c1.6-3.5 4.4-6.2 7.8-7.8L393.8 256 283 204.8c-3.5-1.6-6.2-4.4-7.8-7.8L224 86.2z" />
                                    </svg>
                                    <span class="font-medium text-(--color-primary) text-sm">
                                        ارسال
                                        <b> رایگان </b>
                                        سفارش ها برای اعضای پلاس
                                    </span>
                                </div>


                                <ul
                                    class="pr-5 relative lg:before:absolute lg:before:content-[''] lg:before:right-0 lg:before:top-0 lg:before:w-0.5 lg:before:h-full lg:before:bg-[var(--color-border)] mr-2">
                                    <li
                                        class="text-xs text-[#beb1d6] lg:py-1 leading-[1.7] lg:leading-[2.17] lg:relative lg:before:absolute lg:before:content-[''] lg:before:w-1.5 lg:before:h-1.5 lg:before:rounded-full lg:before:bg-(--color-primary) lg:before:-right-[22px] lg:before:top-[38%]">
                                        4 ارسال رایگاه عادی
                                    </li>
                                    <li
                                        class="text-xs text-[#beb1d6] lg:py-1 leading-[1.7] lg:leading-[2.17] lg:relative lg:before:absolute lg:before:content-[''] lg:before:w-1.5 lg:before:h-1.5 lg:before:rounded-full lg:before:bg-(--color-primary) lg:before:-right-[22px] lg:before:top-[38%]">
                                        2 ارسال سوپر مارکت
                                    </li>
                                    <li
                                        class="text-xs text-[#beb1d6] lg:py-1 leading-[1.7] lg:leading-[2.17] lg:relative lg:before:absolute lg:before:content-[''] lg:before:w-1.5 lg:before:h-1.5 lg:before:rounded-full lg:before:bg-(--color-primary) lg:before:-right-[22px] lg:before:top-[38%]">
                                        4 ارسال رایگان 45 دقیقه ای
                                    </li>
                                    <li
                                        class="text-xs text-[#beb1d6] lg:py-1 leading-[1.7] lg:leading-[2.17] lg:relative lg:before:absolute lg:before:content-[''] lg:before:w-1.5 lg:before:h-1.5 lg:before:rounded-full lg:before:bg-(--color-primary) lg:before:-right-[22px] lg:before:top-[38%]">
                                        پشتیبانی اختصاصی
                                    </li>
                                    <li
                                        class="text-xs text-[#beb1d6] lg:py-1 leading-[1.7] lg:leading-[2.17] lg:relative lg:before:absolute lg:before:content-[''] lg:before:w-1.5 lg:before:h-1.5 lg:before:rounded-full lg:before:bg-(--color-primary) lg:before:-right-[22px] lg:before:top-[38%]">
                                        ارسال سریع و رایگان تبابوک (فقط تهران و کرج)
                                    </li>
                                </ul>

                                <div
                                    class="mr-8 mt-2 lg:flex hidden flex-row items-center text-[var(--color-secondary)] leading-[2.17]">
                                    <span class="font-medium text-sm ml-2">
                                        خرید اشتراک
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-secondary)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </div>

                                <div class="flex">
                                    <div
                                        class="mr-8 mt-2 flex lg:hidden flex-row items-center text-(--color-primary) leading-[2.17] border-2 rounded-full border-(--color-primary) px-4 py-1">
                                        <span class="font-medium text-xs ml-2">
                                            خرید اشتراک
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                            <path fill="var(--color-primary)"
                                                d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                        </svg>
                                    </div>
                                </div>

                                <img src="https://www.digikala.com/statics/img/svg/digiplus/free-delivery.svg"
                                    class="hidden lg:inline-block absolute left-0 bottom-0" alt="logo">



                            </div>
                        </div>
                    </div> --}}

                    <hr class="w-full border-none h-2 bg-[var(--color-border)] lg:hidden">

                    <div class="py-5 px-2 lg:hidden">
                        <h3 class="text-base font-bold leading-[180%] mb-5">
                            دیگر سرویس های تبابوک
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">


                            <a href="#"
                                class="py-3 px-4 rounded-md border border-(--color-border) flex flex-row items-start gap-3">
                                <div class="size-9 rounded-full bg-(--color-primary-btn) flex justify-center items-center">
                                    <img class="size-5"
                                        src="https://dkstatics-public.digikala.com/digikala-static/d56c45d1fd0d9ea7e7141783af11125f67b50895_1737802814.svg"
                                        alt="">
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium leading-[180%] mb-1">
                                        مشاوره رایگان با تبابوک
                                    </h4>
                                    <span
                                        class="text-xs text-[#beb1d6] font-medium inline-block mb-2 leading-[180%] max-h-[45px] sm:h-[45px]">
                                        خرید موبایل و مشاوره رایگان از ساعت 8 صبح تا 4 بعد از ظهر
                                    </span>
                                    <div class="flex">
                                        <div
                                            class="flex flex-row items-center text-(--color-primary) leading-[180%] rounded-full border border-(--color-primary) py-0.5 pr-2 pl-1">
                                            <span class="text-xs">
                                                تماس با مشاور ها
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                                <path fill="var(--color-primary)"
                                                    d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <a href="#"
                                class="py-3 px-4 rounded-md border border-(--color-border) flex flex-row items-start gap-3">
                                <div class="size-9 rounded-full bg-(--color-primary-btn) flex justify-center items-center">
                                    <img class="size-5"
                                        src="https://dkstatics-public.digikala.com/digikala-static/9cb7c2523f795dea8081970865d89faff08ffab4_1738589893.svg"
                                        alt="">
                                </div>
                                <div>

                                    <h4 class="text-sm font-medium leading-[180%] mb-1">
                                        پیندو
                                    </h4>
                                    <span
                                        class="text-xs text-[#beb1d6] font-medium inline-block mb-2 leading-[180%] max-h-[45px] sm:h-[45px]">
                                        خرید و فروش کالا های کارکرده و نو
                                    </span>
                                    <div class="flex">
                                        <div
                                            class="flex flex-row items-center text-[var(--color-color)] leading-[180%] rounded-full border border-[var(--color-color)] py-0.5 pr-2 pl-1">
                                            <span class="text-xs">
                                                تماس با مشاور ها
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                                <path fill="var(--color-color)"
                                                    d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>







                        </div>
                    </div>

                    <hr class="w-full border-none h-2 bg-[var(--color-border)] lg:hidden">





                    <div class="lg:hidden py-5 px-2 text-(--color-text)">
                        <h3 class="text-base font-bold leading-[180%]">
                            شرایط و قوانین
                        </h3>


                        <div class="flex flex-row gap-3 items-start">

                            <div class="pt-3">
                                <div class="size-9 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                        <path fill="var(--color-fill)"
                                            d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM208 352c-8.8 0-16 7.2-16 16s7.2 16 16 16h96c8.8 0 16-7.2 16-16s-7.2-16-16-16H272V240c0-8.8-7.2-16-16-16H216c-8.8 0-16 7.2-16 16s7.2 16 16 16h24v96H208zm48-168a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                                    </svg>
                                </div>
                            </div>


                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <div class="text-sm font-medium leading-[180%] flex flex-row justify-between items-center">
                                    <span>
                                        شرایط بازگشت کالا
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </div>
                                <div class="text-sm font-medium leading-[180%] flex flex-row justify-start items-center">
                                    <p class="mr-2 text-xs text-[#beb1d6] leading-[180%]">
                                        امکان برگشت کالا در گروه موبایل با دلیل "انصراف از خرید" تنها در صورتی مورد
                                        قبول است که پلمب کالا باز نشده باشد.
                                        تمام گوشی‌های دیجی‌کالا ضمانت رجیستری دارند. در صورت وجود مشکل رجیستری،
                                        می‌توانید بعد از مهلت قانونی ۳۰ روزه، گوشی خریداری‌شده را مرجوع کنید.
                                    </p>
                                </div>

                            </div>
                        </div>

                        <a href="#" class="flex flex-row gap-3 items-center">

                            <div class="size-9 p-2 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 rotate-y-180"
                                    viewBox="0 0 448 512">
                                    <path fill="var(--color-fill)"
                                        d="M32 229.5V80c0-8.8 7.2-16 16-16H197.5c8.5 0 16.6 3.4 22.6 9.4l176 176c12.5 12.5 12.5 32.8 0 45.3L262.6 428.1c-12.5 12.5-32.8 12.5-45.3 0l-176-176L18.7 274.7l22.6-22.6c-6-6-9.4-14.1-9.4-22.6zm-32 0c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7H48C21.5 32 0 53.5 0 80V229.5zM112 168a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                                </svg>
                            </div>


                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <p class="text-sm font-medium leading-[180%] flex flex-row justify-between items-center">
                                    <span>
                                        گزارش قیمت مناسب تر
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </p>
                            </div>
                        </a>

                        <a href="#" class="flex flex-row gap-3 items-center">

                            <div class="size-9 p-2 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                    <path fill="var(--color-fill)"
                                        d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM208 352c-8.8 0-16 7.2-16 16s7.2 16 16 16h96c8.8 0 16-7.2 16-16s-7.2-16-16-16H272V240c0-8.8-7.2-16-16-16H216c-8.8 0-16 7.2-16 16s7.2 16 16 16h24v96H208zm48-168a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                                </svg>
                            </div>


                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <p class="text-sm font-medium leading-[180%] flex flex-row justify-between items-center">
                                    <span>
                                        گزارش مشخصات کالا یا موارد قانونی
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </p>
                            </div>
                        </a>

                        <a href="#" class="flex flex-row gap-3 items-center">

                            <div class="size-9 p-2 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 576 512">
                                    <path fill="var(--color-fill)"
                                        d="M480 96c0 35.3 28.7 64 64 64V128c0-17.7-14.3-32-32-32H480zm-32 0H128c0 53-43 96-96 96V320c53 0 96 43 96 96H448c0-53 43-96 96-96V192c-53 0-96-43-96-96zM32 384c0 17.7 14.3 32 32 32H96c0-35.3-28.7-64-64-64v32zm512-32c-35.3 0-64 28.7-64 64h32c17.7 0 32-14.3 32-32V352zM64 96c-17.7 0-32 14.3-32 32v32c35.3 0 64-28.7 64-64H64zM0 128C0 92.7 28.7 64 64 64H512c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM352 256a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm-160 0a96 96 0 1 1 192 0 96 96 0 1 1 -192 0z" />
                                </svg>
                            </div>


                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <p class="text-sm font-medium leading-[180%] flex flex-row justify-between items-center">
                                    <span>
                                        روش قیمت گذاری و نظارت بر قیمت
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </p>
                            </div>
                        </a>


                        <div class="flex flex-row gap-3 items-start">

                            <div class="pt-3">
                                <div class="size-9 bg-(--color-primary-btn) flex justify-center items-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                        <path fill="var(--color-fill)"
                                            d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM208 352c-8.8 0-16 7.2-16 16s7.2 16 16 16h96c8.8 0 16-7.2 16-16s-7.2-16-16-16H272V240c0-8.8-7.2-16-16-16H216c-8.8 0-16 7.2-16 16s7.2 16 16 16h24v96H208zm48-168a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                                    </svg>
                                </div>
                            </div>


                            <div class="w-full flex flex-col gap-2 py-4">
                                <div class="text-sm font-medium leading-[180%] flex flex-row justify-between items-center">
                                    <span>
                                        هشدار سامانه همتا
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </div>
                                <div class="text-sm font-medium leading-[180%] flex flex-row justify-start items-center">
                                    <p class="mr-2 text-xs text-[#beb1d6] leading-[180%]">
                                        هشدار سامانه همتا: در صورت انجام معامله، از فروشنده کد فعالسازی را گرفته و
                                        حتما در حضور ایشان، دستگاه را از طریق #7777*، برای سیمکارت خود فعالسازی
                                        نمایید.
                                        آموزش تصویری در آدرس اینترنتی
                                        hmti.ir/06
                                    </p>
                                </div>

                            </div>
                        </div>





                    </div>

                    <hr class="w-full border-none h-2 bg-[var(--color-border)] lg:hidden">



                </div>

                <div class="hidden lg:block lg:w-1/2 xl:w-5/12">
                    <div class="sticky top-10">
                        <div
                            class=" bg-[var(--color-secondary-bg)] rounded-md border border-(--color-border) p-5 text-[var(--color=-text)]">
                            <h3 class="pb-2 font-medium">
                                فروشنده
                            </h3>
                            <div class="flex flex-row items-start gap-4 py-4 border-b border-(--color-border)">
                                <div class="size-6 rounded-full bg-(--color-primary) mt-[5px]"></div>
                                <div>
                                    <h3 class="leading-[2.15] mb-1">تبابوک</h3>
                                    <div class="flex flex-row items-center">
                                        <div
                                            class="flex flex-row items-center gap-1 pl-2 border-l border-(--color-border)">
                                            <span class="text-xs text-[#beb1d6]">77.6%</span>
                                            <span class="text-xs">
                                                رضایت از کالا
                                            </span>
                                        </div>
                                        <div class="flex flex-row items-center gap-1 pr-2">
                                            <span class="text-xs">
                                                عملکرد
                                            </span>
                                            <span class="text-xs text-[var(--color-success-bg)]">
                                                عالی
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="py-4">
                                <div class="flex flex-row justify-end">
                                    <div>
                                        <div class="flex flex-row items-end gap-3">
                                            <span
                                                class="text-xs text-[#beb1d6] line-through">{{ $product->primary_price }}</span>
                                            <span
                                                class="px-2 leading-[1.9] bg-[var(--color-discount-bg)] text-(--color-primary-text) text-xs font-medium rounded-full">
                                                
                                            </span>
                                        </div>
                                        <div class="flex flex-row gap-1 mt-1 items-end">
                                            <span class="text-lg font-bold">{{ $product->secondary_price }}</span>
                                            <span class="text-xs pb-1.5">تومان</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="flex flex-row items-center gap-2 mb-3">
                                    <img class="size-[18px]"
                                        src="https://dkstatics-public.digikala.com/digikala-static/54419b9303246cde131fcb5b251b86f2ab4aeb71_1716833765.svg"
                                        alt="">
                                    <span class="text-xs text-(--color-text) leading-[2.17]">
                                        + 200 فروش در هفته گذشته
                                    </span>
                                </div>
                                <div>
                                    @if(Auth::check() && in_array($product->id, $cartProIds))
                                    <div class="w-full p-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="{{ $product->id }}">
                                        <button onclick="setCount(this)" class="w-1/3 text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="+">+</button>
                                        <input type="number" class="w-1/3 text-white text-sm text-center outline-none" readonly="" value="{{ $product->carts[0]->quantity }}">
                                        <button onclick="setCount(this)" class="w-1/3 text-white flex justify-center items-center text-lg font-bold cursor-pointer" data-state="-">-</button>
                                    </div>
                                    @else
                                    <button onclick="addToCart(this)" class="w-full p-2 bg-green-700 flex gap-2 justify-center items-center rounded-xl" data-product-id="3">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="lg:size-4 size-3" fill="white">
                                                <path d="M16 0H0V32H16 67.2l77.2 339.5 2.8 12.5H160 496h16V352H496 172.8l-14.5-64H496L566 64l10-32H542.5 100L95.6 12.5 92.8 0H80 16zm91.3 64H532.5l-60 192H151L107.3 64zM184 432a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm0 80a56 56 0 1 0 0-112 56 56 0 1 0 0 112zm248-56a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm80 0a56 56 0 1 0 -112 0 56 56 0 1 0 112 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="lg:text-sm text-[10px] text-white font-bold">افزودن به سبد خرید</span>
                                    </button>
                                    @endif
                                </div>
                            </div>

                            <div class="pb-4 flex flex-row gap-4 items-center border-b border-(--color-border)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                                    <path fill="var(--color-fill)"
                                        d="M243.5 37.3c8-3.4 17-3.4 25 0l176.7 75c11.3 4.8 18.9 15.5 18.8 27.6c-.5 94-39.4 259.8-195.5 334.5c-7.9 3.8-17.2 3.8-25.1 0C87.3 399.6 48.5 233.8 48 139.8c-.1-12.1 7.5-22.8 18.8-27.6l176.7-75zM281 7.8c-16-6.8-34-6.8-50 0L54.3 82.8c-22 9.3-38.4 31-38.3 57.2c.5 99.2 41.3 280.7 213.6 363.2c16.7 8 36.1 8 52.8 0C454.7 420.7 495.5 239.2 496 140c.1-26.2-16.3-47.9-38.3-57.2L281 7.8zm82.3 195.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L224 297.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l64 64c6.2 6.2 16.4 6.2 22.6 0l128-128z" />
                                </svg>
                                <span class="font-bold text-xs">
                                    گارانتی 18 ماهه هوشمند پردازان ژیوان
                                </span>
                            </div>

                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <div class="text-sm font-medium leading-[180%] flex flex-row justify-between items-center">
                                    <div class="flex flex-row gap-4 items-center">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 448 512">
                                            <path fill="var(--color-secondary)"
                                                d="M240 64H342.4c12.6 0 24.1 7.4 29.2 19l34.2 77H240V64zm0 128H416V416c0 17.7-14.3 32-32 32H64c-17.7 0-32-14.3-32-32V192H208h32zm-32-32H42.1L76.3 83c5.1-11.6 16.6-19 29.2-19H208v96zM400.9 70c-10.3-23.1-33.2-38-58.5-38H105.6C80.3 32 57.4 46.9 47.1 70L5.5 163.6c-3.6 8.2-5.5 17-5.5 26V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V189.6c0-9-1.9-17.8-5.5-26L400.9 70zM331.3 251.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 345.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l64 64c6.2 6.2 16.4 6.2 22.6 0l128-128z" />
                                        </svg>

                                        <span class="text-xs">
                                            روش ها و هزینه های ارسال
                                        </span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                        <path fill="var(--color-fill)"
                                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                    </svg>
                                </div>
                                <div class="pr-5 border-r-2 mr-2 border-(--color-border)">
                                    <div
                                        class="text-sm font-bold leading-[180%] flex flex-row justify-start items-center py-1 relative before:absolute before:content-[''] before:size-1.5 before:rounded-full before:bg-[var(--color-secondary)] before:-right-[24px]">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 rotate-y-180"
                                            viewBox="0 0 640 512">
                                            <path fill="var(--color-danger)"
                                                d="M64 32C46.3 32 32 46.3 32 64V352c0 17.7 14.3 32 32 32h5.5c13.2-37.3 48.7-64 90.5-64s77.4 26.7 90.5 64H384V64c0-17.7-14.3-32-32-32H64zm0 384c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H352c35.3 0 64 28.7 64 64V96h65.3c14 0 27.3 6.1 36.4 16.8l78.7 91.8c7.5 8.7 11.6 19.8 11.6 31.2V384h16c8.8 0 16 7.2 16 16s-7.2 16-16 16H576c0 53-43 96-96 96s-96-43-96-96H256c0 53-43 96-96 96s-96-43-96-96zM416 224H570.9l-77.5-90.4c-3-3.5-7.5-5.6-12.1-5.6H416v96zm0 32v88.4c17-15.2 39.4-24.4 64-24.4c41.8 0 77.4 26.7 90.5 64H576V256H416zM224 416A64 64 0 1 0 96 416a64 64 0 1 0 128 0zm256 64a64 64 0 1 0 0-128 64 64 0 1 0 0 128z" />
                                        </svg>
                                        <span class="mr-2 text-xs text-[#beb1d6] font-normal">
                                            توسط مجموعه تبابوک
                                        </span>
                                    </div>
                                    <div
                                        class="text-sm font-bold leading-[180%] flex flex-row justify-start items-center py-1 relative before:absolute before:content-[''] before:size-1.5 before:rounded-full before:bg-[var(--color-secondary)] before:-right-[24px]">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 512 512">
                                            <path fill="var(--color-info)"
                                                d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                        </svg>
                                        <span class="mr-2 text-xs text-[#beb1d6] font-normal">
                                            ارسال سریع
                                        </span>
                                    </div>

                                </div>

                            </div>


                            <div class="w-full flex flex-col gap-2 py-4 border-b border-(--color-border)">
                                <div class="flex flex-row gap-4 items-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 448 512">
                                        <path fill="var(--color-primary)"
                                            d="M224 32c6.2 0 11.9 3.6 14.5 9.3l63.2 136.9 136.9 63.2c5.7 2.6 9.3 8.3 9.3 14.5s-3.6 11.9-9.3 14.5L301.8 333.8 238.5 470.7c-2.6 5.7-8.3 9.3-14.5 9.3s-11.9-3.6-14.5-9.3L146.2 333.8 9.3 270.5C3.6 267.9 0 262.2 0 256s3.6-11.9 9.3-14.5l136.9-63.2L209.5 41.3c2.6-5.7 8.3-9.3 14.5-9.3zm0 54.2L172.8 197c-1.6 3.5-4.4 6.2-7.8 7.8L54.2 256 165 307.2c3.5 1.6 6.2 4.4 7.8 7.8L224 425.8 275.2 315c1.6-3.5 4.4-6.2 7.8-7.8L393.8 256 283 204.8c-3.5-1.6-6.2-4.4-7.8-7.8L224 86.2z" />
                                    </svg>

                                    <span class="text-xs font-bold">
                                        ویژه اعضای پلاس
                                    </span>
                                </div>

                                <div class="pr-5 border-r-2 mr-2 border-(--color-border)">

                                    <div
                                        class="text-sm font-bold leading-[180%] flex flex-row justify-start items-center py-1 relative before:absolute before:content-[''] before:size-1.5 before:rounded-full before:bg-(--color-primary) before:-right-[24px]">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 512 512">
                                            <path fill="var(--color-info)"
                                                d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                        </svg>
                                        <span class="mr-2 text-xs font-normal text-[#beb1d6]">
                                            ارسال سریع و رایگان تبابوک
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="pt-4 flex flex-row items-center">
                                <img class="size-6" src="https://www.digikala.com/statics/img/svg/club-point.svg"
                                    alt="">
                                <span class="text-xs font-bold text-(--color-text) mr-5">
                                    83 امتیاز دیجی کلاب
                                </span>
                                <div
                                    class="size-[18px] border-2 border-[var(--color-fill)] rounded-full flex items-center justify-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-2.5" viewBox="0 0 192 512">
                                        <path fill="var(--color-fill)"
                                            d="M64 64a32 32 0 1 1 64 0A32 32 0 1 1 64 64zM16 176c0-8.8 7.2-16 16-16H96c8.8 0 16 7.2 16 16V448h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H16c-8.8 0-16-7.2-16-16s7.2-16 16-16H80V192H32c-8.8 0-16-7.2-16-16z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="#"
                                class="flex flex-row justify-between items-center border border-(--color-border) rounded-md mt-2 py-3 px-2">
                                <div class="flex flex-row items-center">
                                    <div
                                        class="size-[18px] border-2 border-[var(--color-fill)] rounded-full flex items-center justify-center ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-2.5" viewBox="0 0 192 512">
                                            <path fill="var(--color-fill)"
                                                d="M64 64a32 32 0 1 1 64 0A32 32 0 1 1 64 64zM16 176c0-8.8 7.2-16 16-16H96c8.8 0 16 7.2 16 16V448h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H16c-8.8 0-16-7.2-16-16s7.2-16 16-16H80V192H32c-8.8 0-16-7.2-16-16z" />
                                        </svg>
                                    </div>
                                    <span class="text-xs text-[#beb1d6] leading-[2.17]">
                                        فرآیند قیمت گذاری و نظارت بر قیمت
                                    </span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                                    <path fill="var(--color-fill)"
                                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                </svg>
                            </a>
                        </div>


                    </div>

                </div>

            </div>
        </div>

        <div class="hidden pt-4 mt-7 px-3 pb-7 lg:grid grid-cols-5 border-t border-b-4 border-(--color-border)">


            <div class="w-full flex justify-center items-center">
                <a href="#" class="flex flex-row justify-center items-center">
                    <img class="size-[42px] ml-2"
                        src="https://www.digikala.com/statics/img/svg/infosection/express-delivery.svg" alt="">
                    <span class="text-xs font-medium text-[#beb1d6]">
                        امکان تحویل اکسپرس
                    </span>
                </a>
            </div>

            <div class="w-full flex justify-center items-center">
                <a href="#" class="flex flex-row justify-center items-center">
                    <img class="size-[42px] ml-2" src="https://www.digikala.com/statics/img/svg/infosection/support.svg"
                        alt="">
                    <span class="text-xs font-medium text-[#beb1d6]">
                        24 ساعته ، 7 روز هفته
                    </span>
                </a>
            </div>

            <div class="w-full flex justify-center items-center">
                <a href="#" class="flex flex-row justify-center items-center">
                    <img class="size-[42px] ml-2"
                        src="https://www.digikala.com/statics/img/svg/infosection/cash-on-delivery.svg" alt="">
                    <span class="text-xs font-medium text-[#beb1d6]">
                        امکان پرداخت در محل
                    </span>
                </a>
            </div>


            <div class="w-full flex justify-center items-center">
                <a href="#" class="flex flex-row justify-center items-center">
                    <img class="size-[42px] ml-2"
                        src="https://www.digikala.com/statics/img/svg/infosection/days-return.svg" alt="">
                    <span class="text-xs font-medium text-[#beb1d6]">
                        هفت روز ضمانت بازگشت کالا
                    </span>
                </a>
            </div>

            <div class="w-full flex justify-center items-center">
                <a href="#" class="flex flex-row justify-center items-center">
                    <img class="size-[42px] ml-2"
                        src="https://www.digikala.com/statics/img/svg/infosection/original-products.svg" alt="">
                    <span class="text-xs font-medium text-[#beb1d6]">
                        ضمانت اصل بودن کالا
                    </span>
                </a>
            </div>






        </div>
    </section>
    <!-- single product -->

    <!-- related product desktop -->
    {{-- <section class="text-(--color-text) ">
        <div class="hidden lg:block pt-2 pb-3 mt-4 rounded-lg border border-b-4 border-(--color-border) px-2">
            <div class="py-3">
                <h2 class="font-bold leading-[2.17]">
                    کالا های مشابه
                </h2>
                <div class="w-[70px] h-0.5 bg-(--color-primary) mt-2"></div>
            </div>
            <div class="w-full">
                <div class="flex flex-row items-center overflow-x-auto touch-pan-x hide-scrollbar"
                    style="scrollbar-width:none;">


                    <div class="w-auto h-auto ml-6 border-l border-(--color-border)">
                        <a href="#" class="inline-block w-[192px] max-w-[192px] min-w-[192px] px-2 py-3">
                            <div class="mb-3">
                                <div>
                                    <img class="w-[64px] h-[14px] mb-3"
                                        src="https://www.digikala.com/statics/img/svg/productCard/topBadge/SpecialSell.svg"
                                        alt="special sell">
                                </div>
                                <img class="size-[150px] m-auto"
                                    src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                    alt="product image">
                            </div>
                            <div>
                                <div class="text-xs font-bold leading-[2.17] mb-2">
                                    گوشی موبایل هانوفر مدل 8210 دو سیمکارت
                                </div>
                                <div class="flex flex-row items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-1.5" viewBox="0 0 512 512">
                                        <path fill="var(--color-info)"
                                            d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                    </svg>
                                    <span class="text-xs text-[var(--colo-secondary)]">
                                        ارسال سریع تبابوک
                                    </span>
                                </div>
                                <div class="flex flex-row items-center justify-between">
                                    <span
                                        class="rounded-full text-white bg-[var(--color-danger)] text-xs font-medium px-2 py-0.5">
                                        4%
                                    </span>
                                    <div class="flex flex-row items-end justify-end">
                                        <h4 class="text-sm font-bold">
                                            1,590,000
                                        </h4>
                                        <span class="text-xs mr-1">
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-end pl-8 mt-3">
                                    <span class="text-xs text-[#beb1d6] line-through">
                                        1,650,000
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="w-auto h-auto ml-6 border-l border-(--color-border)">
                        <a href="#" class="inline-block w-[192px] max-w-[192px] min-w-[192px] px-2 py-3">
                            <div class="mb-3">
                                <div>
                                    <img class="w-[64px] h-[14px] mb-3"
                                        src="https://www.digikala.com/statics/img/svg/productCard/topBadge/SpecialSell.svg"
                                        alt="special sell">
                                </div>
                                <img class="size-[150px] m-auto"
                                    src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                    alt="product image">
                            </div>
                            <div>
                                <div class="text-xs font-bold leading-[2.17] mb-2">
                                    گوشی موبایل هانوفر مدل 8210 دو سیمکارت
                                </div>
                                <div class="flex flex-row items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-1.5" viewBox="0 0 512 512">
                                        <path fill="var(--color-info)"
                                            d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                    </svg>
                                    <span class="text-xs text-[var(--colo-secondary)]">
                                        ارسال سریع تبابوک
                                    </span>
                                </div>
                                <div class="flex flex-row items-center justify-between">
                                    <span
                                        class="rounded-full text-white bg-[var(--color-danger)] text-xs font-medium px-2 py-0.5">
                                        4%
                                    </span>
                                    <div class="flex flex-row items-end justify-end">
                                        <h4 class="text-sm font-bold">
                                            1,590,000
                                        </h4>
                                        <span class="text-xs mr-1">
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-end pl-8 mt-3">
                                    <span class="text-xs text-[#beb1d6] line-through">
                                        1,650,000
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="w-auto h-auto ml-6 border-l border-(--color-border)">
                        <a href="#" class="inline-block w-[192px] max-w-[192px] min-w-[192px] px-2 py-3">
                            <div class="mb-3">
                                <div>
                                    <img class="w-[64px] h-[14px] mb-3"
                                        src="https://www.digikala.com/statics/img/svg/productCard/topBadge/SpecialSell.svg"
                                        alt="special sell">
                                </div>
                                <img class="size-[150px] m-auto"
                                    src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                    alt="product image">
                            </div>
                            <div>
                                <div class="text-xs font-bold leading-[2.17] mb-2">
                                    گوشی موبایل هانوفر مدل 8210 دو سیمکارت
                                </div>
                                <div class="flex flex-row items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-1.5" viewBox="0 0 512 512">
                                        <path fill="var(--color-info)"
                                            d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                    </svg>
                                    <span class="text-xs text-[var(--colo-secondary)]">
                                        ارسال سریع تبابوک
                                    </span>
                                </div>
                                <div class="flex flex-row items-center justify-between">
                                    <span
                                        class="rounded-full text-white bg-[var(--color-danger)] text-xs font-medium px-2 py-0.5">
                                        4%
                                    </span>
                                    <div class="flex flex-row items-end justify-end">
                                        <h4 class="text-sm font-bold">
                                            1,590,000
                                        </h4>
                                        <span class="text-xs mr-1">
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-end pl-8 mt-3">
                                    <span class="text-xs text-[#beb1d6] line-through">
                                        1,650,000
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="w-auto h-auto ml-6 border-l border-(--color-border)">
                        <a href="#" class="inline-block w-[192px] max-w-[192px] min-w-[192px] px-2 py-3">
                            <div class="mb-3">
                                <div>
                                    <img class="w-[64px] h-[14px] mb-3"
                                        src="https://www.digikala.com/statics/img/svg/productCard/topBadge/SpecialSell.svg"
                                        alt="special sell">
                                </div>
                                <img class="size-[150px] m-auto"
                                    src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                    alt="product image">
                            </div>
                            <div>
                                <div class="text-xs font-bold leading-[2.17] mb-2">
                                    گوشی موبایل هانوفر مدل 8210 دو سیمکارت
                                </div>
                                <div class="flex flex-row items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-1.5" viewBox="0 0 512 512">
                                        <path fill="var(--color-info)"
                                            d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                    </svg>
                                    <span class="text-xs text-[var(--colo-secondary)]">
                                        ارسال سریع تبابوک
                                    </span>
                                </div>
                                <div class="flex flex-row items-center justify-between">
                                    <span
                                        class="rounded-full text-white bg-[var(--color-danger)] text-xs font-medium px-2 py-0.5">
                                        4%
                                    </span>
                                    <div class="flex flex-row items-end justify-end">
                                        <h4 class="text-sm font-bold">
                                            1,590,000
                                        </h4>
                                        <span class="text-xs mr-1">
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-end pl-8 mt-3">
                                    <span class="text-xs text-[#beb1d6] line-through">
                                        1,650,000
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="w-auto h-auto ml-6 border-l border-(--color-border)">
                        <a href="#" class="inline-block w-[192px] max-w-[192px] min-w-[192px] px-2 py-3">
                            <div class="mb-3">
                                <div>
                                    <img class="w-[64px] h-[14px] mb-3"
                                        src="https://www.digikala.com/statics/img/svg/productCard/topBadge/SpecialSell.svg"
                                        alt="special sell">
                                </div>
                                <img class="size-[150px] m-auto"
                                    src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                    alt="product image">
                            </div>
                            <div>
                                <div class="text-xs font-bold leading-[2.17] mb-2">
                                    گوشی موبایل هانوفر مدل 8210 دو سیمکارت
                                </div>
                                <div class="flex flex-row items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-1.5" viewBox="0 0 512 512">
                                        <path fill="var(--color-info)"
                                            d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                    </svg>
                                    <span class="text-xs text-[var(--colo-secondary)]">
                                        ارسال سریع تبابوک
                                    </span>
                                </div>
                                <div class="flex flex-row items-center justify-between">
                                    <span
                                        class="rounded-full text-white bg-[var(--color-danger)] text-xs font-medium px-2 py-0.5">
                                        4%
                                    </span>
                                    <div class="flex flex-row items-end justify-end">
                                        <h4 class="text-sm font-bold">
                                            1,590,000
                                        </h4>
                                        <span class="text-xs mr-1">
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-end pl-8 mt-3">
                                    <span class="text-xs text-[#beb1d6] line-through">
                                        1,650,000
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="w-auto h-auto ml-6 border-l border-(--color-border)">
                        <a href="#" class="inline-block w-[192px] max-w-[192px] min-w-[192px] px-2 py-3">
                            <div class="mb-3">
                                <div>
                                    <img class="w-[64px] h-[14px] mb-3"
                                        src="https://www.digikala.com/statics/img/svg/productCard/topBadge/SpecialSell.svg"
                                        alt="special sell">
                                </div>
                                <img class="size-[150px] m-auto"
                                    src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                    alt="product image">
                            </div>
                            <div>
                                <div class="text-xs font-bold leading-[2.17] mb-2">
                                    گوشی موبایل هانوفر مدل 8210 دو سیمکارت
                                </div>
                                <div class="flex flex-row items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-1.5" viewBox="0 0 512 512">
                                        <path fill="var(--color-info)"
                                            d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                    </svg>
                                    <span class="text-xs text-[var(--colo-secondary)]">
                                        ارسال سریع تبابوک
                                    </span>
                                </div>
                                <div class="flex flex-row items-center justify-between">
                                    <span
                                        class="rounded-full text-white bg-[var(--color-danger)] text-xs font-medium px-2 py-0.5">
                                        4%
                                    </span>
                                    <div class="flex flex-row items-end justify-end">
                                        <h4 class="text-sm font-bold">
                                            1,590,000
                                        </h4>
                                        <span class="text-xs mr-1">
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-end pl-8 mt-3">
                                    <span class="text-xs text-[#beb1d6] line-through">
                                        1,650,000
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="w-auto h-auto ml-6 border-l border-(--color-border)">
                        <a href="#" class="inline-block w-[192px] max-w-[192px] min-w-[192px] px-2 py-3">
                            <div class="mb-3">
                                <div>
                                    <img class="w-[64px] h-[14px] mb-3"
                                        src="https://www.digikala.com/statics/img/svg/productCard/topBadge/SpecialSell.svg"
                                        alt="special sell">
                                </div>
                                <img class="size-[150px] m-auto"
                                    src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                    alt="product image">
                            </div>
                            <div>
                                <div class="text-xs font-bold leading-[2.17] mb-2">
                                    گوشی موبایل هانوفر مدل 8210 دو سیمکارت
                                </div>
                                <div class="flex flex-row items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 ml-1.5" viewBox="0 0 512 512">
                                        <path fill="var(--color-info)"
                                            d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z" />
                                    </svg>
                                    <span class="text-xs text-[var(--colo-secondary)]">
                                        ارسال سریع تبابوک
                                    </span>
                                </div>
                                <div class="flex flex-row items-center justify-between">
                                    <span
                                        class="rounded-full text-white bg-[var(--color-danger)] text-xs font-medium px-2 py-0.5">
                                        4%
                                    </span>
                                    <div class="flex flex-row items-end justify-end">
                                        <h4 class="text-sm font-bold">
                                            1,590,000
                                        </h4>
                                        <span class="text-xs mr-1">
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-end pl-8 mt-3">
                                    <span class="text-xs text-[#beb1d6] line-through">
                                        1,650,000
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </section> --}}
    <!-- related product desktop -->



    <!-- related video desktop -->

    {{-- <section class="text-(--color-text) ">
        <div class="hidden lg:block pt-2 pb-3 mt-4 rounded-lg border border-b-4 border-(--color-border) px-2">
            <div class="py-3">
                <h2 class="font-bold leading-[2.17]">
                    ویدئو های مرتبط
                </h2>
            </div>
            <div class="w-full">
                <div class="flex flex-row items-center overflow-x-auto touch-pan-x hide-scrollbar"
                    style="scrollbar-width:none;">


                    <div class="w-auto h-auto ml-6">
                        <div class="w-auto px-2 py-3">
                            <div class="size-[280px] bg-black mb-3">

                                <video class="size-[280px] m-auto"
                                    poster="https://dkstatics-public.digikala.com/digikala-content-x-post-media/61c709a2f5e9660d587c66c7d056ba85306a5e8d_1749458853.jpg?x-oss-process=image/resize,w_600/quality,q_80"
                                    alt="product image"></video>
                            </div>
                            <div>
                                <div class="text-xs font-bold leading-[2.17] mb-2">
                                    این گوشی ارزش خرید داره
                                </div>
                                <a href="#" class="flex flex-row items-center mb-3">
                                    <img class="rounded-full size-6 ml-3"
                                        src="https://dkstatics-public.digikala.com/digikala-content-x-profile/a1250500f4ecb5ad706ab578a19c235f86c83585_1716202955.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80"
                                        alt="">
                                    <span class="text-xs text-[#beb1d6]">
                                        ArianAbrouni
                                    </span>
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}

    <!-- related video desktop -->

    <!-- ads desktop -->

    <section class="w-11/12 mx-auto hidden lg:block">
        <div class="w-full overflow-hidden mt-4">
            <a href="#" class="inline-block w-full">
                <img class="inline-block w-full object-cover rounded-md"
                    src="https://dkstatics-public.digikala.com/digikala-admin-landing/943ae092e7f2539a425b91e03be95c2631c07914_1748070961.jpg"
                    alt="ads">
            </a>
        </div>
    </section>

    <!-- ads desktop -->

    <!-- specifications table mobile -->

    <section class="w-11/12 lg:hidden text-(--color-text)">
        <div class="py-5 px-2">
            <h3 class="text-lg font-bold leading-[180%] mb-4">
                جدول مشخصات
            </h3>
            <div>
                @foreach ($product->attributes as $attribute)
                    <div class="flex flex-row border-b border-(--color-border)">
                        <div class="w-1/4 p-1 text-[10px] bg-[var(--color-secondary-bg)] leading-[180%]">
                            {{ $attribute->attribute_key }}
                        </div>
                        <div class="w-3/4 p-1 text-[10px] leading-[180%]">
                            {{ $attribute->attribute_value }}
                        </div>
                    </div>
            </div>
            @endforeach
            <div class="my-3 flex justify-center items-center">
                <button
                    class="flex flex-row gap-2 items-center pr-4 pl-3 py-2 bg-[var(--color-secondary-bg)] rounded-full">
                    <span class="text-xs leading-[180%] font-medium">
                        مشاهده ادامه مشخصات
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                        <path fill="var(--color-fill)"
                            d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- specifications table mobile -->

    <hr class="w-11/12 border-none h-2 bg-[var(--color-border)] lg:hidden">

    <!-- specifications table desktop -->

    <section class="w-11/12 mx-auto text-(--color-text) mt-4 lg:pb-10">
        <div class="hidden lg:block sticky top-0 bg-white z-[555]">
            <ul class="flex flex-row border-b border-(--color-border)">
                <li
                    class="text-sm font-medium leading-[180%] py-2 px-4 text-(--color-primary) border-b-4 border-(--color-primary) rounded-b-sm cursor-pointer">
                    مشخصات
                </li>
                <li class="text-sm font-medium leading-[180%] py-2 px-4 cursor-pointer">
                    دیدگاه ها
                </li>
                <li class="text-sm font-medium leading-[180%] py-2 px-4 cursor-pointer">
                    پرسش ها
                </li>
            </ul>
        </div>


        <div class="flex flex-col lg:flex-row gap-10 w-full">

            <div class="2xl:w-9/12 w-full">
                <div class="w-full mt-4">


                    <div class="hidden lg:block">
                        <div class="py-3">
                            <h2 class="font-bold leading-[2.17]">
                                مشخصات
                            </h2>
                            <div class="w-[70px] h-0.5 bg-(--color-primary) mt-2"></div>
                        </div>
                        <div class="mt-4 pt-4 flex flex-row items-start">
                            <div class="w-1/4">
                                <h2 class="font-bold leading-[2.17]">
                                    مشخصات کلی
                                </h2>
                            </div>
                            <div class="w-3/4">

                                @php
                                    $counterSize = 0;
                                    $counterMaterial = 0;
                                @endphp
                                @foreach ($product->attributes as $attribute)
                                    <div class="flex flex-row items-start">
                                        <div class="w-1/4 text-[#beb1d6] text-sm py-3 leading-[2.17]">
                                            {{ $attribute->attribute_key }}
                                        </div>
                                        <div class="w-3/4 text-sm @if($product->attributes[count($product->attributes)-1]->attribute_key !== $attribute->attribute_key) border-b border-(--color-border) @endif py-3 leading-[2.17]">
                                            {{ $attribute->attribute_value }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-10">
                            <a href="#" class="flex flex-row items-center gap-2">
                                <span class="text-xs font-bold text-[var(--color-secondary)]">
                                    مشاهده بیشتر
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                    <path fill="var(--color-secondary)"
                                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                </svg>
                            </a>
                        </div>
                        <div class="flex flex-row items-center gap-3 mt-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512">
                                <path fill="var[#beb1d6]"
                                    d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM208 352c-8.8 0-16 7.2-16 16s7.2 16 16 16h96c8.8 0 16-7.2 16-16s-7.2-16-16-16H272V240c0-8.8-7.2-16-16-16H216c-8.8 0-16 7.2-16 16s7.2 16 16 16h24v96H208zm48-168a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                            </svg>
                            <p class="text-xs text-[#beb1d6] leading-[2.17]">
                                هشدار سامانه همتا: در صورت انجام معامله، از فروشنده کد فعالسازی را گرفته و حتما در
                                حضور ایشان، دستگاه را از طریق #7777*، برای سیمکارت خود فعالسازی نمایید. آموزش تصویری
                                در آدرس اینترنتی hmti.ir/06
                            </p>
                        </div>

                        <hr class="hidden lg:block w-full border-none h-1 bg-[var(--color-border)] mt-5">




                    </div>
                </div>
                <div class="w-full mt-4">
                    <div>
                        <div class="hidden lg:block py-3">
                            <h2 class="font-bold leading-[2.17]">
                                امتیاز و دیدگاه کاربران
                            </h2>
                            <div class="w-[70px] h-0.5 bg-(--color-primary) mt-2"></div>
                        </div>
                        <div class="lg:hidden block px-2">
                            <div class="flex flex-row items-center justify-between pb-3">
                                <h3 class="text-md font-bold">
                                    دیدگاه کاربرها
                                </h3>
                                <div>
                                    <a href="#" class="flex flex-row items-center gap-2">
                                        <span class="text-xs font-medium">
                                            مشاهده 333 دیدگاه
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                            <path fill="var(--color-fill)"
                                                d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="flex flex-row items-center gap-2">
                                <span class="text-lg font-bold">
                                    3.8
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 576 512">
                                    <path fill="gold"
                                        d="M288.1 0l86.5 164 182.7 31.6L428 328.5 454.4 512 288.1 430.2 121.7 512l26.4-183.5L18.9 195.6 201.5 164 288.1 0z" />
                                </svg>
                                <span class="text-xs text-[#beb1d6]">
                                    ( بر اساس نظر 337 خریدار )
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 flex flex-row items-start">


                            <div class="hidden lg:block w-1/5 sticky top-16 ml-12">

                                <div class="flex flex-row items-center">
                                    <h3 class="text-[2rem] font-medium ml-1">
                                        3.8
                                    </h3>
                                    <span class="text-xs">
                                        از 5
                                    </span>
                                </div>
                                <div class="flex flex-row items-center mt-1">
                                    <div class="flex flex-row items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512">
                                            <path fill="gold"
                                                d="M288.1 0l86.5 164 182.7 31.6L428 328.5 454.4 512 288.1 430.2 121.7 512l26.4-183.5L18.9 195.6 201.5 164 288.1 0z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512">
                                            <path fill="gold"
                                                d="M288.1 0l86.5 164 182.7 31.6L428 328.5 454.4 512 288.1 430.2 121.7 512l26.4-183.5L18.9 195.6 201.5 164 288.1 0z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512">
                                            <path fill="gold"
                                                d="M288.1 0l86.5 164 182.7 31.6L428 328.5 454.4 512 288.1 430.2 121.7 512l26.4-183.5L18.9 195.6 201.5 164 288.1 0z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512">
                                            <path fill="gold"
                                                d="M288.1 0l86.5 164 182.7 31.6L428 328.5 454.4 512 288.1 430.2 121.7 512l26.4-183.5L18.9 195.6 201.5 164 288.1 0z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 576 512">
                                            <path fill="var[#beb1d6]"
                                                d="M288.1 0l86.5 164 182.7 31.6L428 328.5 454.4 512 288.1 430.2 121.7 512l26.4-183.5L18.9 195.6 201.5 164 288.1 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-[10px] text-[#beb1d6] mr-2">
                                        از مجموع 333 امتیاز
                                    </span>
                                </div>
                                <div class="mt-4 mb-3">
                                    <span class="text-[10px]">
                                        شما هم در این کالا دیدگاه ثبت کنید
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <button
                                        class="block w-full rounded-lg px-4 py-2 border border-(--color-primary) text-(--color-primary) text-xs leading-[2.17] cursor-pointer"
                                        @if (Auth::check()) onclick="comment('open')" @else onclick="login('open')" @endif>
                                        ثبت دیدگاه
                                    </button>
                                </div>
                                <div class="flex flex-row items-start gap-3 mt-3">
                                    <div class="size-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512">
                                            <path fill="var[#beb1d6]"
                                                d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM208 352c-8.8 0-16 7.2-16 16s7.2 16 16 16h96c8.8 0 16-7.2 16-16s-7.2-16-16-16H272V240c0-8.8-7.2-16-16-16H216c-8.8 0-16 7.2-16 16s7.2 16 16 16h24v96H208zm48-168a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-[#beb1d6] leading-[2.17]">
                                        با ثبت دیدگاه بر روی کالاهای خریداری شده ۵ امتیاز در دیجی‌کلاب دریافت کنید
                                    </p>
                                </div>
                            </div>




                            <div class="lg:w-4/5 overflow-x-auto lg:overflow-visible" style="scrollbar-width:none;">

                                <div class="hidden lg:flex flex-row items-center justify-between">
                                    <div class="flex flex-row items-center gap-4">
                                        <div class="flex flex-row items-center gap-2">
                                            <div class="size-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6"
                                                    viewBox="0 0 576 512">
                                                    <path fill="var(--color-fill)"
                                                        d="M235.3 379.3l-96 96c-6.2 6.2-16.4 6.2-22.6 0l-96-96c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L112 425.4V48c0-8.8 7.2-16 16-16s16 7.2 16 16V425.4l68.7-68.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6zM304 464c-8.8 0-16-7.2-16-16s7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H304zm0-128c-8.8 0-16-7.2-16-16s7.2-16 16-16H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H304zm0-128c-8.8 0-16-7.2-16-16s7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H304zm0-128c-8.8 0-16-7.2-16-16s7.2-16 16-16H560c8.8 0 16 7.2 16 16s-7.2 16-16 16H304z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="text-xs font-medium cursor-pointer">
                                                    مرتب سازی بر اساس:
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex flex-row items-center gap-4">
                                            <a href="#" class="text-xs text-[#beb1d6] font-medium">
                                                جدید ترین
                                            </a>
                                            <a href="#" class="text-xs text-[#beb1d6] font-medium">
                                                دیدگاه کاربران
                                            </a>
                                            <a href="#" class="text-xs text-(--color-primary) font-medium">
                                                مفید ترین
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <span class="text-xs text-[#beb1d6]">
                                            333 دیدگاه
                                        </span>
                                    </div>
                                </div>


                                <div class="hidden lg:block py-4 border-b border-(--color-border)">
                                    <h3 class="text-md font-medium py-4 leading-[2.17]">
                                        فیلتر بر اساس موضوع
                                    </h3>
                                    <div class="flex flex-row items-center gap-3">
                                        <span
                                            class="text-sm font-medium px-2 py-2 leading-normal rounded-full border border-(--color-border) cursor-pointer">
                                            قیمت و ارزش خرید
                                        </span>
                                        <span
                                            class="text-sm font-medium px-2 py-2 leading-normal rounded-full border border-(--color-border) cursor-pointer">
                                            کیفیت و کارایی
                                        </span>
                                    </div>
                                </div>


                                <div class="w-full px-2 lg:px-0 lg:block flex flex-row">



                                    <!-- <div class="hidden lg:block mt-2">
                                                                                                                        <a href="#" class="leading-[2.17] flex flex-row items-center gap-2">
                                                                                                                            <span class="text-xs font-medium text-[var(--color-secondary)]">
                                                                                                                                ادامه
                                                                                                                            </span>
                                                                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3"
                                                                                                                                viewBox="0 0 320 512">
                                                                                                                                <path fill="var(--color-secondary)"
                                                                                                                                    d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                                                                                                                            </svg>
                                                                                                                        </a>
                                                                                                                    </div> -->

                                    <!-- <div class="flex flex-row justify-between items-center mt-7">
                                                                                                                        <span class="lg:hidden text-xs text-[#beb1d6]">
                                                                                                                            11 شهریور 1404
                                                                                                                        </span>
                                                                                                                        <div class="hidden lg:flex flex-row items-center gap-4">
                                                                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                                                                                                viewBox="0 0 640 512">
                                                                                                                                <path fill="var(--color-fill)"
                                                                                                                                    d="M0 185.8c0-6.4 1.6-12.7 4.7-18.3L82.4 25C90.8 9.6 106.9 0 124.5 0h391c17.6 0 33.7 9.6 42.1 25l77.7 142.4c3.1 5.6 4.7 11.9 4.7 18.3c0 21.1-17.1 38.2-38.2 38.2H576V496c0 8.8-7.2 16-16 16s-16-7.2-16-16V224H96V352H352V272 256h32v16V464c0 26.5-21.5 48-48 48H112c-26.5 0-48-21.5-48-48V224H38.2C17.1 224 0 206.9 0 185.8zM80 192H560h41.8c3.4 0 6.2-2.8 6.2-6.2c0-1-.3-2.1-.8-3L529.6 40.3c-2.8-5.1-8.2-8.3-14-8.3h-391c-5.9 0-11.2 3.2-14 8.3L32.8 182.8c-.5 .9-.8 1.9-.8 3c0 3.4 2.8 6.2 6.2 6.2H80zM96 464c0 8.8 7.2 16 16 16H336c8.8 0 16-7.2 16-16V384H96v80z" />
                                                                                                                            </svg>
                                                                                                                            <span class="text-xs text-[#beb1d6]">
                                                                                                                                تبابوک
                                                                                                                            </span>
                                                                                                                            <div
                                                                                                                                class="size-1.5 rounded-full bg-[var[#beb1d6]]/30">
                                                                                                                            </div>
                                                                                                                            <div class="size-3 rounded-full"
                                                                                                                                style="background-color: rgb(33, 33, 33);"></div>
                                                                                                                            <span class="text-xs">
                                                                                                                                مشکی
                                                                                                                            </span>
                                                                                                                        </div>
                                                                                                                        <div class="flex flex-row items-center gap-4">
                                                                                                                            <button class="flex flex-row items-center gap-2">
                                                                                                                                <span class="text-xs">0</span>
                                                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                                                                                                    viewBox="0 0 512 512">
                                                                                                                                    <path fill="var(--color-fill)"
                                                                                                                                        d="M288.8 81.7c3.5-12.8 16.7-20.3 29.5-16.8s20.3 16.7 16.8 29.5l-4.5 16.4c-5.5 20.2-13.9 39.3-24.7 56.9c-3.1 4.9-3.2 11.1-.4 16.2s8.2 8.2 14 8.2H448c17.7 0 32 14.3 32 32c0 11.3-5.9 21.3-14.8 27c-7.2 4.6-9.5 13.9-5.3 21.3c2.6 4.6 4.1 10 4.1 15.7c0 12.4-7 23.1-17.3 28.5c-4.2 2.2-7.3 6.1-8.3 10.8s.1 9.5 3 13.2c4.2 5.4 6.7 12.2 6.7 19.5c0 14.2-9.2 26.3-22.1 30.4c-7.8 2.5-12.4 10.6-10.7 18.6c.5 2.2 .7 4.5 .7 6.9c0 17.7-14.3 32-32 32H294.5c-15.8 0-31.2-4.7-44.4-13.4l-38.5-25.7c-9-6-16.6-13.7-22.4-22.6c-4.9-7.4-14.8-9.4-22.2-4.6s-9.4 14.8-4.6 22.2c8.1 12.3 18.7 23.1 31.4 31.6l38.5 25.7c18.4 12.3 40 18.8 62.1 18.8H384c35.3 0 64-28.7 64-64l0-.6c19.1-11.1 32-31.7 32-55.4c0-8.7-1.8-17.1-4.9-24.7C487.9 323.6 496 306.8 496 288c0-6.5-1-12.8-2.8-18.7C504.8 257.7 512 241.7 512 224c0-35.3-28.7-64-64-64H346.4c6.2-13.1 11.3-26.7 15.1-40.9l4.5-16.4c8.1-29.8-9.5-60.6-39.3-68.8s-60.6 9.5-68.8 39.3l-4.5 16.4c-8.9 32.6-29.6 60.8-58.2 79l-3.1 2c-11.8 7.5-21.7 17.1-29.5 28.2c-5.1 7.2-3.3 17.2 4 22.3s17.2 3.3 22.3-4c5.4-7.7 12.2-14.4 20.4-19.5l3.1-2c35.3-22.4 60.9-57.2 71.9-97.5l4.5-16.4zM32 224H96V448H32V224zM0 224V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32c-17.7 0-32 14.3-32 32z" />
                                                                                                                                </svg>
                                                                                                                            </button>
                                                                                                                            <button class="flex flex-row items-center gap-2">
                                                                                                                                <span class="text-xs">0</span>
                                                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                                                                                                    viewBox="0 0 512 512">
                                                                                                                                    <path fill="var(--color-fill)"
                                                                                                                                        d="M288.8 430.3c3.5 12.8 16.7 20.3 29.5 16.8s20.3-16.7 16.8-29.5l-4.5-16.4c-5.5-20.2-13.9-39.3-24.7-56.9c-3.1-4.9-3.2-11.1-.4-16.2s8.2-8.2 14-8.2H448c17.7 0 32-14.3 32-32c0-11.3-5.9-21.3-14.8-27c-7.2-4.6-9.5-13.9-5.3-21.3c2.6-4.6 4.1-10 4.1-15.7c0-12.4-7-23.1-17.3-28.5c-4.2-2.2-7.3-6.1-8.3-10.8s.1-9.5 3-13.2c4.2-5.4 6.7-12.2 6.7-19.5c0-14.2-9.2-26.3-22.1-30.4c-7.8-2.5-12.4-10.6-10.7-18.6c.5-2.2 .7-4.5 .7-6.9c0-17.7-14.3-32-32-32H294.5c-15.8 0-31.2 4.7-44.4 13.4l-38.5 25.7c-9 6-16.6 13.7-22.4 22.6c-4.9 7.4-14.8 9.4-22.2 4.6s-9.4-14.8-4.6-22.2c8.1-12.3 18.7-23.1 31.4-31.6l38.5-25.7c18.4-12.3 40-18.8 62.1-18.8H384c35.3 0 64 28.7 64 64l0 .6c19.1 11.1 32 31.7 32 55.4c0 8.7-1.8 17.1-4.9 24.7C487.9 188.4 496 205.2 496 224c0 6.5-1 12.8-2.8 18.7C504.8 254.3 512 270.3 512 288c0 35.3-28.7 64-64 64H346.4c6.2 13.1 11.3 26.7 15.1 40.9l4.5 16.4c8.1 29.8-9.5 60.6-39.3 68.8s-60.6-9.5-68.8-39.3l-4.5-16.4c-8.9-32.6-29.6-60.8-58.2-79l-3.1-2 8.2-12.9-8.2 12.9c-11.8-7.5-21.7-17.1-29.5-28.2c-5.1-7.2-3.3-17.2 4-22.3s17.2-3.3 22.3 4c5.4 7.7 12.2 14.4 20.4 19.5l3.1 2c35.3 22.4 60.9 57.2 71.9 97.5l4.5 16.4zM32 352H96V128H32V352zM0 352V128c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32z" />
                                                                                                                                </svg>
                                                                                                                            </button>
                                                                                                                        </div>
                                                                                                                    </div> -->
                                </div>

                            </div>


                        </div>


                    </div>



                    <div class="hidden lg:block mt-4">
                        <a href="#" class="leading-[2.17] flex flex-row items-center gap-2">
                            <span class="text-xs font-medium text-[var(--color-secondary)]">
                                229 دیدگاه
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                <path fill="var(--color-secondary)"
                                    d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                            </svg>
                        </a>
                    </div>


                </div>
                <div>
                    <div class="py-3 hidden lg:block ">
                        <h2 class="font-bold leading-[2.17]">
                            پرسش ها
                        </h2>
                        <div class="w-[70px] h-0.5 bg-(--color-primary) mt-2"></div>
                    </div>
                    <div class="py-3 lg:hidden flex flex-row items-center justify-between px-2">
                        <h2 class="font-medium leading-[2.17]">
                            پرسش و پاسخ
                        </h2>

                        <div>
                            <a href="#" class="flex flex-row items-center gap-1">
                                <span class="text-xs">
                                    مشاهده 103 پرسش
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                    <path fill="var(--color-fill)"
                                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />

                                </svg>
                            </a>

                        </div>

                    </div>
                    <div class="mt-4 pt-4 flex flex-row items-start overflow-x-auto lg:overflow-x-clip px-2 lg:px-0"
                        style="scrollbar-width:none;">
                        <div class="w-1/5 sticky top-16 ml-12 hidden lg:block">
                            <div class="mt-4 mb-3">
                                <span class="text-[10px]">
                                    شما هم در این کالا پرسش ثبت کنید
                                </span>
                            </div>
                            <div class="mt-2">
                                <button
                                    class="block w-full rounded-lg px-4 py-2 border border-(--color-primary) text-(--color-primary) text-xs leading-[2.17] cursor-pointer"
                                    @if (Auth::check()) onclick="question('open')" @else onclick="login('open')" @endif>
                                    ثبت پرسش
                                </button>
                            </div>
                        </div>
                        <div class="lg:w-4/5 flex flex-row lg:block">
                            <div class="hidden lg:flex flex-row items-center justify-between">
                                <div class="flex flex-row items-center gap-4">
                                    <div class="flex flex-row items-center gap-2">
                                        <div class="size-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 576 512">
                                                <path fill="var(--color-fill)"
                                                    d="M235.3 379.3l-96 96c-6.2 6.2-16.4 6.2-22.6 0l-96-96c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L112 425.4V48c0-8.8 7.2-16 16-16s16 7.2 16 16V425.4l68.7-68.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6zM304 464c-8.8 0-16-7.2-16-16s7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H304zm0-128c-8.8 0-16-7.2-16-16s7.2-16 16-16H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H304zm0-128c-8.8 0-16-7.2-16-16s7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H304zm0-128c-8.8 0-16-7.2-16-16s7.2-16 16-16H560c8.8 0 16 7.2 16 16s-7.2 16-16 16H304z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium cursor-pointer">
                                                مرتب سازی بر اساس:
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-row items-center gap-4">
                                        <a href="#" class="text-xs text-[#beb1d6] font-medium">
                                            جدید ترین
                                        </a>
                                        <a href="#" class="text-xs text-[#beb1d6] font-medium">
                                            بیشترین پاسخ
                                        </a>

                                    </div>
                                </div>

                                <div>
                                    <span class="text-xs text-[#beb1d6]">
                                        333 دیدگاه
                                    </span>
                                </div>
                            </div>




                            <!-- comment -->

                        </div>

                    </div>

                    <!-- comment -->

                    <div class="hidden lg:block mt-4">
                        <a href="#" class="leading-[2.17] flex flex-row items-center gap-2">
                            <span class="text-xs font-medium text-[var(--color-secondary)]">
                                98 پرسش دیگر
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 320 512">
                                <path fill="var(--color-secondary)"
                                    d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                            </svg>
                        </a>
                    </div>


                </div>
            </div>

            <div class="lg:hidden px-2 mt-7 pb-2">
                <div class="flex flex-row justify-between items-start">
                    <div class="flex flex-row items-start gap-3">
                        <div class="w-full flex justify-center items-center gap-3">
                            <div
                                class="size-9 flex justify-center items-center bg-[var(--color-secondary-bg)] rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 512 512">
                                    <path fill="var(--color-fill)"
                                        d="M256 64C125.8 64 32 148.6 32 240c0 37.1 15.5 70.6 40 100c5.2 6.3 8.4 14.8 7.4 23.9c-3.1 27-11.4 52.5-25.7 76.3c-.5 .9-1.1 1.8-1.6 2.6c11.1-2.9 22.2-7 32.7-11.5L91.2 446l-6.4-14.7c17-7.4 33-16.7 48.4-27.4c8.5-5.9 19.4-7.5 29.2-4.2C193 410.1 224 416 256 416c130.2 0 224-84.6 224-176s-93.8-176-224-176zM0 240C0 125.2 114.5 32 256 32s256 93.2 256 208s-114.5 208-256 208c-36 0-70.5-6.7-103.8-17.9c-.2-.1-.5 0-.7 .1c-16.9 11.7-34.7 22.1-53.9 30.5C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.8s-1.1-12.8 3.4-17.4c8.1-8.2 15.2-18.2 21.7-29c11.7-19.6 18.7-40.6 21.3-63.1c0 0-.1-.1-.1-.2C19.6 327.1 0 286.6 0 240z" />

                                </svg>
                            </div>
                            <div class="w-full">
                                <p class="text-xs font-bold leading-[180%]">
                                    دیدگاه خود را درباره این کالا بنویسید
                                </p>
                                <p class="text-xs text-[#beb1d6] leading-[180%]">
                                    با ثبت دیدگاه بر روی کالا های خریداری شده 5 امتیاز در دیجی‌کلاب دریافت
                                    کنید
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="size-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                            <path fill="var(--color-fill)"
                                d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />


                        </svg>
                    </div>
                </div>


                <hr class="w-full border-none h-1 bg-[var(--color-border)] mt-5">
            </div>
            <div class="w-3/12 hidden 2xl:block">
                <div
                    class="sticky top-[60px] mt-5 p-4 rounded border border-(--color-border) bg-[var(--color-secondary-bg)]">
                    <div class="flex flex-row gap-5 items-start pb-3 mb-3 border-b border-(--color-border)">
                        <div class="size-20">
                            <img class="size-full" src="{{ asset('/storage/' . $media->path) }}" alt="product image">
                        </div>
                        <div>
                            <p class="text-sm leading-[2.17]">
                                {{ $product->title }}
                            </p>
                            <div class="flex flex-row gap-4 items-center">
                                <div class="size-[14px] rounded-full" style="background-color: rgb(33, 33, 33);">
                                </div>
                                <span class="text-xs leading-[2.17]">
                                    مشکی
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-2 mb-2">
                        <div class="size-6 rounded-full bg-(--color-primary)"></div>
                        <span class="text-xs leading-[2.17]">
                            تبابوک
                        </span>
                    </div>
                    <div class="flex flex-row items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-[5px]" viewBox="0 0 512 512">
                            <path fill="var(--color-fill)"
                                d="M243.5 37.3c8-3.4 17-3.4 25 0l176.7 75c11.3 4.8 18.9 15.5 18.8 27.6c-.5 94-39.4 259.8-195.5 334.5c-7.9 3.8-17.2 3.8-25.1 0C87.3 399.6 48.5 233.8 48 139.8c-.1-12.1 7.5-22.8 18.8-27.6l176.7-75zM281 7.8c-16-6.8-34-6.8-50 0L54.3 82.8c-22 9.3-38.4 31-38.3 57.2c.5 99.2 41.3 280.7 213.6 363.2c16.7 8 36.1 8 52.8 0C454.7 420.7 495.5 239.2 496 140c.1-26.2-16.3-47.9-38.3-57.2L281 7.8zm82.3 195.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L224 297.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l64 64c6.2 6.2 16.4 6.2 22.6 0l128-128z" />
                        </svg>
                        <span class="text-xs leading-[2.17]">
                            گارانتی 18 ماهه هوشمند پردازان ژیوان
                        </span>
                    </div>
                    <div class="flex flex-row items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 448 512">
                            <path fill="var(--color-secondary)"
                                d="M240 64H342.4c12.6 0 24.1 7.4 29.2 19l34.2 77H240V64zm0 128H416V416c0 17.7-14.3 32-32 32H64c-17.7 0-32-14.3-32-32V192H208h32zm-32-32H42.1L76.3 83c5.1-11.6 16.6-19 29.2-19H208v96zM400.9 70c-10.3-23.1-33.2-38-58.5-38H105.6C80.3 32 57.4 46.9 47.1 70L5.5 163.6c-3.6 8.2-5.5 17-5.5 26V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V189.6c0-9-1.9-17.8-5.5-26L400.9 70zM331.3 251.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 345.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l64 64c6.2 6.2 16.4 6.2 22.6 0l128-128z" />
                        </svg>
                        <span class="text-xs leading-[2.17]">
                            گارانتی 18 ماهه هوشمند پردازان ژیوان
                        </span>
                    </div>
                    <div class="flex flex-row justify-end">
                        <div>
                            <div class="flex flex-row items-end gap-3">
                                <span
                                    class="text-xs text-[#beb1d6] line-through">{{ $product->primary_price }}</span>
                                <span
                                    class="px-2 leading-[1.9] bg-[var(--color-discount-bg)] text-(--color-primary-text) text-xs font-medium rounded-full">
                                    
                                </span>
                            </div>
                            <div class="flex flex-row gap-1 mt-1 items-end">
                                <span class="text-lg font-bold">{{ $product->secondary_price }}</span>
                                <span class="text-xs pb-1.5">تومان</span>
                            </div>

                        </div>
                    </div>

                    <div class="flex flex-row items-center gap-2 mb-3">
                        <img class="size-[18px]"
                            src="https://dkstatics-public.digikala.com/digikala-static/54419b9303246cde131fcb5b251b86f2ab4aeb71_1716833765.svg"
                            alt="">
                        <span class="text-xs text-(--color-text) leading-[2.17]">
                            + 200 فروش در هفته گذشته
                        </span>
                    </div>
                    <div>
                        <button
                            onclick="addToShoppingCart()"
                            class="rounded-lg leading-[2.17] bg-(--color-primary) text-(--color-primary-text) block text-center w-full py-2 cursor-pointer">
                            افزودن به سبد خرید
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:hidden p-5">
            <a href="#" class="flex flex-row justify-between items-center">
                <div class="flex flex-row items-center gap-2">
                    <div class="size-9 rounded-full bg-[var(--color-secondary-bg)] flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 512 512">
                            <path fill="var(--color-fill)"
                                d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm168.7-86.2c6.5-24.6 28.7-41.8 54.2-41.8H280c35.5 0 64 29 64 64.3c0 24-13.4 46.2-34.9 57.2L272 268.3V288c0 8.8-7.2 16-16 16s-16-7.2-16-16V258.5c0-6 3.4-11.5 8.7-14.3l45.8-23.4c10.7-5.4 17.5-16.6 17.5-28.7c0-17.8-14.4-32.3-32-32.3H222.9c-10.9 0-20.5 7.4-23.2 17.9l-.2 .7c-2.2 8.5-11 13.7-19.5 11.4s-13.7-11-11.4-19.5l.2-.7zM232 352a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z" />
                        </svg>
                    </div>
                    <span class="text-xs text-[#beb1d6] font-medium">
                        شما هم درباره این کالا سوال بپرسید
                    </span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                    <path fill="var(--color-fill)"
                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />
                </svg>
            </a>
        </div>







    </section>

    <!-- specifications table desktop -->

    <hr class="w-full border-none h-2 bg-[var(--color-border)] lg:hidden">

    <!-- related video mobile -->

    <section class="p-5 text-(--color-text) lg:hidden">
        <div class="pb-3">
            <a href="#" class="flex flex-row justify-between items-center">
                <div class="flex flex-row items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 576 512">
                        <path fill="var(--color-text)"
                            d="M64 96c-17.7 0-32 14.3-32 32V384c0 17.7 14.3 32 32 32H320c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32H64zM0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64v47.2V336.8 384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM519.4 411.3L416 354.4V317.9l118.8 65.4c.9 .5 1.9 .8 3 .8c3.4 0 6.2-2.8 6.2-6.2V134.2c0-3.4-2.8-6.2-6.2-6.2c-1 0-2.1 .3-3 .8L416 194.1V157.6l103.4-56.9c5.6-3.1 12-4.7 18.4-4.7c21.1 0 38.2 17.1 38.2 38.2V377.8c0 21.1-17.1 38.2-38.2 38.2c-6.4 0-12.8-1.6-18.4-4.7z" />

                    </svg>
                    <h3 class="text-md font-medium leading-[180%]">
                        ویدئو های بررسی این کالا
                    </h3>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 320 512">
                    <path fill="var(--color-text)"
                        d="M52.7 267.3c-6.2-6.2-6.2-16.4 0-22.6l160-160c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6L86.6 256 235.3 404.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0l-160-160z" />

                </svg>
            </a>
        </div>

        <!-- اگه تعداد ویدئو ها زیاد باشه تگ زیر رو از کامنت دربیارین -->
        <div class="overflow-x-auto" style="scrollbar-width:none;">
            <div class="flex flex-row items-center">
                <!-- video -->
                <div class="w-[150px] max-w-[150px]">
                    <div class="w-full h-[210px] max-h-[210px] relative">
                        <video class="rounded-lg size-full object-cover cursor-pointer"
                            poster="https://dkstatics-public.digikala.com/digikala-content-x-post-media/61c709a2f5e9660d587c66c7d056ba85306a5e8d_1749458853.jpg?x-oss-process=image/resize,w_600/quality,q_80"></video>
                        <a href="#"
                            class="absolute inline-block size-12 rounded-full border-2 border-white -bottom-2 right-2">
                            <img class="size-full rounded-full"
                                src="https://dkstatics-public.digikala.com/digikala-content-x-profile/a1250500f4ecb5ad706ab578a19c235f86c83585_1716202955.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80"
                                alt="user image">
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-12 absolute inset-[35%]"
                            viewBox="0 0 512 512">

                            <defs>
                                <style>
                                    .fa-primary {
                                        opacity: .9
                                    }

                                    .fa-secondary {
                                        opacity: .7
                                    }
                                </style>
                            </defs>
                            <path fill="white" class="fa-secondary"
                                d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                            <path fill="gray" class="fa-primary"
                                d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />
                            <path fill="white" class="fa-secondary"
                                d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                            <path fill="gray" class="fa-primary"
                                d="M212.5 147.5c-7.4-4.5-16.7-4.7-24.3-.5s-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88z" />

                        </svg>
                    </div>
                    <p class="text-xs mt-3">
                        این گوشی ارزش خرید داره
                    </p>
                </div>
                <!-- video -->
            </div>
        </div>


    </section>

    <!-- related video mobile end -->

    <hr class="w-full border-none h-2 bg-[var(--color-border)] lg:hidden">

    <!-- related products mobile -->

    <section class="lg:hidden p-5 text-(--color-text)">
        <div class="py-2">
            <div class="mb-3">
                <h3 class="text-lg font-bold leading-[180%]">
                    پیشنهاد ما
                </h3>
            </div>
            <div class="w-full overflow-x-auto" style="scrollbar-width:none;">
                <div class="flex justify-start items-center gap-2 w-full overflow-auto hide-scrollbar"
                    style="scrollbar-width:none;">
                    <a href="#"
                        class="rounded-full px-3 whitespace-nowrap max-w-[300px] ellipsis-1 py-1 select-none leading-[180%] text-xs !flex items-center justify-center text-white bg-[var(--color-text)]">
                        کالا های مشابه
                    </a>
                    <a href="#"
                        class="rounded-full px-3 whitespace-nowrap max-w-[300px] ellipsis-1 py-1 select-none leading-[180%] text-xs !flex items-center justify-center  bg-[var(--color-secondary-bg)]">
                        قطعات یدکی موبایل و تبلت
                    </a>
                    <a href="#"
                        class="rounded-full px-3 whitespace-nowrap max-w-[300px] ellipsis-1 py-1 select-none leading-[180%] text-xs !flex items-center justify-center  bg-[var(--color-secondary-bg)]">
                        تلفن
                    </a>
                    <a href="#"
                        class="rounded-full px-3 whitespace-nowrap max-w-[300px] ellipsis-1 py-1 select-none leading-[180%] text-xs !flex items-center justify-center  bg-[var(--color-secondary-bg)]">
                        گوشی پزشکی
                    </a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <!-- products -->
            <a href="#" class="inline-block w-full border border-(--color-border) rounded-lg">
                <div class="p-1">
                    <img class="w-full rounded-lg"
                        src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/quality,q_80"
                        alt="product image">
                </div>
                <div class="py-1 px-2">
                    <div>
                        <span class="text-xs leading-[180%] font-medium">
                            گوشی موبایل هانوفر مدل 8210 دو سیم کارت
                        </span>
                    </div>
                    <div class="mt-5 lg:mt-14 flex flex-row items-center gap-2">
                        <span class="font-medium">
                            1,640,000
                        </span>
                        <span class="text-xs font-medium">
                            تومان
                        </span>
                    </div>
                </div>
            </a>
            <a href="#" class="inline-block w-full border border-(--color-border) rounded-lg">
                <div class="p-1">
                    <img class="w-full rounded-lg"
                        src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/quality,q_80"
                        alt="product image">
                </div>
                <div class="py-1 px-2">
                    <div>
                        <span class="text-xs leading-[180%] font-medium">
                            گوشی موبایل هانوفر مدل 8210 دو سیم کارت
                        </span>
                    </div>
                    <div class="mt-5 lg:mt-14 flex flex-row items-center gap-2">
                        <span class="font-medium">
                            1,640,000
                        </span>
                        <span class="text-xs font-medium">
                            تومان
                        </span>
                    </div>
                </div>
            </a>
            <a href="#" class="inline-block w-full border border-(--color-border) rounded-lg">
                <div class="p-1">
                    <img class="w-full rounded-lg"
                        src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/quality,q_80"
                        alt="product image">
                </div>
                <div class="py-1 px-2">
                    <div>
                        <span class="text-xs leading-[180%] font-medium">
                            گوشی موبایل هانوفر مدل 8210 دو سیم کارت
                        </span>
                    </div>
                    <div class="mt-5 lg:mt-14 flex flex-row items-center gap-2">
                        <span class="font-medium">
                            1,640,000
                        </span>
                        <span class="text-xs font-medium">
                            تومان
                        </span>
                    </div>
                </div>
            </a>
            <a href="#" class="inline-block w-full border border-(--color-border) rounded-lg">
                <div class="p-1">
                    <img class="w-full rounded-lg"
                        src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/quality,q_80"
                        alt="product image">
                </div>
                <div class="py-1 px-2">
                    <div>
                        <span class="text-xs leading-[180%] font-medium">
                            گوشی موبایل هانوفر مدل 8210 دو سیم کارت
                        </span>
                    </div>
                    <div class="mt-5 lg:mt-14 flex flex-row items-center gap-2">
                        <span class="font-medium">
                            1,640,000
                        </span>
                        <span class="text-xs font-medium">
                            تومان
                        </span>
                    </div>
                </div>
            </a>
            <a href="#" class="inline-block w-full border border-(--color-border) rounded-lg">
                <div class="p-1">
                    <img class="w-full rounded-lg"
                        src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/quality,q_80"
                        alt="product image">
                </div>
                <div class="py-1 px-2">
                    <div>
                        <span class="text-xs leading-[180%] font-medium">
                            گوشی موبایل هانوفر مدل 8210 دو سیم کارت
                        </span>
                    </div>
                    <div class="mt-5 lg:mt-14 flex flex-row items-center gap-2">
                        <span class="font-medium">
                            1,640,000
                        </span>
                        <span class="text-xs font-medium">
                            تومان
                        </span>
                    </div>
                </div>
            </a>
            <a href="#" class="inline-block w-full border border-(--color-border) rounded-lg">
                <div class="p-1">
                    <img class="w-full rounded-lg"
                        src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/quality,q_80"
                        alt="product image">
                </div>
                <div class="py-1 px-2">
                    <div>
                        <span class="text-xs leading-[180%] font-medium">
                            گوشی موبایل هانوفر مدل 8210 دو سیم کارت
                        </span>
                    </div>
                    <div class="mt-5 lg:mt-14 flex flex-row items-center gap-2">
                        <span class="font-medium">
                            1,640,000
                        </span>
                        <span class="text-xs font-medium">
                            تومان
                        </span>
                    </div>
                </div>
            </a>
            <a href="#" class="inline-block w-full border border-(--color-border) rounded-lg">
                <div class="p-1">
                    <img class="w-full rounded-lg"
                        src="https://dkstatics-public.digikala.com/digikala-products/b4056f3dc563d6dd83ab72d457093290429a5b75_1738158994.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/quality,q_80"
                        alt="product image">
                </div>
                <div class="py-1 px-2">
                    <div>
                        <span class="text-xs leading-[180%] font-medium">
                            گوشی موبایل هانوفر مدل 8210 دو سیم کارت
                        </span>
                    </div>
                    <div class="mt-5 lg:mt-14 flex flex-row items-center gap-2">
                        <span class="font-medium">
                            1,640,000
                        </span>
                        <span class="text-xs font-medium">
                            تومان
                        </span>
                    </div>
                </div>
            </a>
            <!-- products -->
        </div>
    </section>

    <!-- related products mobile -->


    <!-- comment form -->

    <div class="fixed bg-black/30 inset-0 z-[1111] text-(--color-text) transition-all duration-500 opacity-0 invisible"
        id="commentModal">
        <div
            class="relative max-w-[460px] m-auto bg-white rounded-lg mt-[4%] scale-50 opacity-0 transition-all duration-500 delay-300">
            <div class="w-full px-2 py-3 border-b-2 border-(--color-border)">
                <div class="flex flex-row items-center">
                    <div class="cursor-pointer" onclick="comment('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 448 512">


                            <path fill="var(--color-fill)"
                                d="M443.3 267.3c6.2-6.2 6.2-16.4 0-22.6l-176-176c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L393.4 240 16 240c-8.8 0-16 7.2-16 16s7.2 16 16 16l377.4 0L244.7 420.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l176-176z" />


                        </svg>
                    </div>
                    <div class="mr-1 leading-[2.17] font-medium">
                        ثبت دیدگاه
                    </div>
                </div>
            </div>
            <div class="w-full">
                <form class="p-4" action="" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="w-full h-[305px] overflow-y-auto hide-scrollbar">
                        <div class="flex flex-row items-start gap-3 pb-4 border-b border-(--color-border)">
                            <img class="size-[56px]"
                                src="https://dkstatics-public.digikala.com/digikala-products/d6518a10b641b32833525b184f518e9ad0a38ec0_1751860865.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                alt="">
                            <p class="font-medium">
                                گوشی موبایل ژیواکو مدل F121 دو سیم کارت
                            </p>
                        </div>
                        <div class="py-4">
                            <div class="py-3 flex flex-row items-start">
                                <label class="font-medium" for="comment">
                                    متن دیدگاه :
                                </label>
                                <span class="font-medium text-red-500">*</span>
                            </div>
                            <div class="pt-2 border border-(--color-border) rounded-lg">
                                <textarea class="w-full outline-none resize-none p-3" name="comment" rows="3"
                                    placeholder="نظر خودرا درباره این کالا بنویسید"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="py-4">
                        <button
                            class="rounded-lg block w-full leading-[2.17] text-(--color-primary-text) bg-(--color-primary) text-center py-3 px-2 cursor-pointer">
                            ثبت دیدگاه
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end comment form -->




    <!-- question form -->


    <div class="fixed bg-black/30 inset-0 z-[1111] text-(--color-text) transition-all duration-500 opacity-0 invisible"
        id="questionModal">
        <div
            class="relative max-w-[460px] m-auto bg-white rounded-lg mt-[4%] scale-50 opacity-0 transition-all duration-500 delay-300">
            <div class="w-full px-2 py-3 border-b-2 border-(--color-border)">
                <div class="flex flex-row items-center">
                    <div class="cursor-pointer" onclick="question('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 448 512">


                            <path fill="var(--color-fill)"
                                d="M443.3 267.3c6.2-6.2 6.2-16.4 0-22.6l-176-176c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L393.4 240 16 240c-8.8 0-16 7.2-16 16s7.2 16 16 16l377.4 0L244.7 420.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l176-176z" />


                        </svg>
                    </div>
                    <div class="mr-1 leading-[2.17] font-medium">
                        ثبت پرسش
                    </div>
                </div>
            </div>
            <div class="w-full">

                <form class="p-4" action="" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="w-full h-[305px] overflow-y-auto hide-scrollbar">
                        <div class="flex flex-row items-start gap-3 pb-4 border-b border-(--color-border)">
                            <img class="size-[56px]"
                                src="https://dkstatics-public.digikala.com/digikala-products/d6518a10b641b32833525b184f518e9ad0a38ec0_1751860865.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                alt="">
                            <p class="font-medium">
                                گوشی موبایل ژیواکو مدل F121 دو سیم کارت
                            </p>
                        </div>
                        <div class="py-4">
                            <div class="py-3 flex flex-row items-start">

                                <label class="font-medium" for="comment">
                                    پرسش خود را در مورد محصول مطرح کنید

                                </label>
                                <span class="font-medium text-red-500">*</span>
                            </div>
                            <div class="pt-2 border border-(--color-border) rounded-lg">

                                <textarea class="w-full outline-none resize-none p-3" rows="3" placeholder="ثبت سوال در مورد این محصول "
                                    id="question" name="text"></textarea>
                            </div>


                        </div>
                    </div>
                    <div class="py-4">
                        <button
                            class="rounded-lg block w-full leading-[2.17] text-(--color-primary-text) bg-(--color-primary) text-center py-3 px-2 cursor-pointer">
                            ثبت پرسش
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end question form -->


    <!-- comment form mobile -->

    <div class="fixed w-full -bottom-full z-[1111] text-(--color-text) transition-all duration-500"
        id="commentModalMobile">
        <div class="relative w-full h-svh m-auto bg-white rounded-lg">
            <div class="w-full px-2 py-3 border-b-2 border-(--color-border)">
                <div class="flex flex-row items-center">
                    <div class="cursor-pointer" onclick="commentMobile('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 448 512">

                            <path fill="var(--color-fill)"
                                d="M443.3 267.3c6.2-6.2 6.2-16.4 0-22.6l-176-176c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L393.4 240 16 240c-8.8 0-16 7.2-16 16s7.2 16 16 16l377.4 0L244.7 420.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l176-176z" />

                        </svg>
                    </div>
                    <div class="mr-1 leading-[2.17] font-medium">
                        ثبت دیدگاه
                    </div>
                </div>
            </div>
            <div class="w-full">
                <form class="p-4" action="" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="w-full h-[305px] overflow-y-auto hide-scrollbar">
                        <div class="flex flex-row items-start gap-3 pb-4 border-b border-(--color-border)">
                            <img class="size-[56px]"
                                src="https://dkstatics-public.digikala.com/digikala-products/d6518a10b641b32833525b184f518e9ad0a38ec0_1751860865.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                alt="">
                            <p class="font-medium">
                                گوشی موبایل ژیواکو مدل F121 دو سیم کارت
                            </p>
                        </div>
                        <div class="py-4">
                            <div class="py-3 flex flex-row items-start">
                                <label class="font-medium" for="comment">
                                    متن دیدگاه :
                                </label>
                                <span class="font-medium text-red-500">*</span>
                            </div>
                            <div class="pt-2 border border-(--color-border) rounded-lg">
                                <textarea class="w-full outline-none resize-none p-3" name="comment" rows="3"
                                    placeholder="نظر خودرا درباره این کالا بنویسید"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="py-4">
                        <button
                            class="rounded-lg block w-full leading-[2.17] text-(--color-primary-text) bg-(--color-primary) text-center py-3 px-2 cursor-pointer">
                            ثبت دیدگاه
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end comment form mobile -->


    <!-- question form mobile -->

    <div class="fixed w-full -bottom-full z-[1111] text-(--color-text) transition-all duration-500"
        id="questionModalMobile">
        <div class="relative w-full h-svh m-auto bg-white rounded-lg">
            <div class="w-full px-2 py-3 border-b-2 border-(--color-border)">
                <div class="flex flex-row items-center">
                    <div class="cursor-pointer" onclick="questionMobile('close')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 448 512">

                            <path fill="var(--color-fill)"
                                d="M443.3 267.3c6.2-6.2 6.2-16.4 0-22.6l-176-176c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L393.4 240 16 240c-8.8 0-16 7.2-16 16s7.2 16 16 16l377.4 0L244.7 420.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l176-176z" />
                        </svg>
                    </div>
                    <div class="mr-1 leading-[2.17] font-medium">
                        جزئیات پرسش

                    </div>
                </div>
            </div>
            <div class="w-full">
                <form class="p-4" action="" method="">
                    <div class="w-full h-[305px] overflow-y-auto hide-scrollbar">
                        <div class="flex flex-row items-start gap-3 pb-4 border-b border-(--color-border)">
                            <img class="size-[56px]"
                                src="https://dkstatics-public.digikala.com/digikala-products/d6518a10b641b32833525b184f518e9ad0a38ec0_1751860865.jpg?x-oss-process=image/resize,m_lfit,h_300,w_300/format,webp/quality,q_80"
                                alt="">
                            <p class="font-medium">
                                گوشی موبایل ژیواکو مدل F121 دو سیم کارت
                            </p>
                        </div>
                        <div class="py-4">
                            <div class="py-3 flex flex-row items-start">
                                <label class="font-medium" for="comment">

                                    پرسش خود را درمورد محصول مطرح کنید

                                </label>
                                <span class="font-medium text-red-500">*</span>
                            </div>
                            <div class="pt-2 border border-(--color-border) rounded-lg">
                                <textarea class="w-full outline-none resize-none p-3" rows="3" placeholder="ثبت سوال در مورد این محصول"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="py-4">
                        <button
                            class="rounded-lg block w-full leading-[2.17] text-(--color-primary-text) bg-(--color-primary) text-center py-3 px-2 cursor-pointer">
                            ثبت پرسش
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end question form mobile -->


    <!-- login popup -->

    <div class="w-full h-svh bg-black/30 transition-all duration-300 fixed top-0 right-0 z-[22222] pt-[5%] opacity-0 invisible"
        id="login">
        <div class="size-full relative">
            <div class="absolute size-10 right-[30%] -top-[10%] cursor-pointer bg-white rounded-full flex flex-row justify-center items-center"
                onclick="login('close')">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 384 512">
                    <path fill="var(--color-fill)"
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </div>
            <div class="kt-card max-w-[370px] m-auto transition-all duration-300 opacity-0 scale-75">
                <form action="{{ route('user.check') }}" method="post"
                    class="flex flex-col gap-5 p-10 bg-white">
                    @csrf
                    <div class="text-center mb-2.5">
                        <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                            ورود
                        </h3>
                        <div class="flex items-center justify-center">
                            <span class="text-sm text-secondary-foreground me-1.5">
                                اکانت ندارید؟
                            </span>
                            <a href="{{ route('user.store') }}" class="text-sm">ثبت نام</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2.5">
                        <a href="#" class="kt-btn kt-btn-outline flex items-center justify-center">
                            <img src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/google.svg"
                                class="size-3.5 shrink-0" alt="google logo">
                            استفاده از گوگل
                        </a>
                        <a href="#" class="kt-btn kt-btn-outline flex items-center justify-center">
                            <img src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/apple-black.svg"
                                class="size-3.5 shrink-0" alt="google logo">
                            استفاده از اپل
                        </a>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="border-t border-[#eeeaeb] w-full"></span>
                        <span class="text-xs text-[#1b1718] uppercase">یا</span>
                        <span class="border-t border-[#eeeaeb] w-full"></span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="phoneNumber" class="kt-form-label text-[#0b0809]">شماره تلفن</label>
                        <input type="number" name="phoneNumber" id="phoneNumber" class="kt-input"
                            placeholder="09141234567">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password" class="kt-form-label text-[#0b0809]">گذرواژه</label>

                        <input type="password" name="password" id="password" class="kt-input outline-none">

                    </div>
                    <div class="flex flex-row justify-start items-center">
                        <span for="accept"
                            class="text-sm text-[#0b0809] mr-2 flex flex-row justify-start items-center">
                            گذرواژه خود را
                            <a href="" class="text-blue-500 mr-1"> فراموش کردم </a>
                        </span>
                    </div>
                    <button
                        class="py-1.5 rounded-md text-white text-sm font-bold bg-[#2b7fff] cursor-pointer hover:bg-[#2b7fff]/90">ورود
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- login popup -->



    <!-- buy button mobile -->

    <div
        class="w-full px-2 py-3 bg-white fixed bottom-0 right-0 lg:hidden border-t border-(--color-border) text-(--color-text)">
        <div class="flex flex-row justify-between items-center py-2">
            <div class="w-1/2">
                <button
                    onclick="addToShoppingCart()"
                    class="block font-medium w-full rounded-lg text-white bg-(--color-primary) leading-[180%] text-sm text-center py-2">
                    افزودن به سبد خرید
                </button>
            </div>
            <div class="flex flex-row items-center gap-2 text-sm">
                <span class="font-bold">919,000</span>
                <span class="font-medium text-xs">
                    تومان
                </span>
            </div>
        </div>
    </div>


    <!-- buy button mobile end -->
     <script>
//         let chocolateMenu = document.getElementById('chocolateMenu')
// let chocIcon = document.getElementById('chocIcon')
// let chocIconMobile = document.getElementById('chocIconMobile')
// let boxC = document.getElementById('boxC')

// function closeChocMenu() {
//     chocolateMenu.classList.remove('right-0')
//     chocolateMenu.classList.add('-right-full')
//     boxC.classList.add('opacity-0')
// }
// chocIcon.addEventListener('click', () => {
//     chocolateMenu.classList.remove('-right-full')
//     boxC.classList.remove('opacity-0')
//     chocolateMenu.classList.add('right-0')
// })
// chocIconMobile.addEventListener('click', () => {
//     chocolateMenu.classList.remove('-right-full')
//     boxC.classList.remove('opacity-0')
//     chocolateMenu.classList.add('right-0')
// })

let subMenuActive = document.querySelectorAll('.subMenuActive');
subMenuActive.forEach((item) => {
    item.addEventListener('click', () => {
        if (item.parentElement.nextElementSibling.classList.contains('max-h-0')) {
            item.parentElement.nextElementSibling.classList.remove("max-h-0")
            item.parentElement.nextElementSibling.classList.add("max-h-[2000px]")
            item.children[0].classList.add('rotate-180');
            subMenuActive.forEach((close) => {
                if (close.parentElement.nextElementSibling != item.parentElement.nextElementSibling) {
                    close.parentElement.nextElementSibling.classList.add("max-h-0")
                    close.parentElement.nextElementSibling.classList.remove("max-h-[2000px]")
                    close.children[0].classList.remove('rotate-180');
                }

            })
        } else {
            subMenuActive.forEach((item) => {
                item.parentElement.nextElementSibling.classList.add("max-h-0")
                item.parentElement.nextElementSibling.classList.remove("max-h-[2000px]")
                item.children[0].classList.remove('rotate-180');
            })
        }
    });
});

let subMenuCat = document.querySelectorAll('.subMenuCat')
subMenuCat.forEach((item) => {
    item.addEventListener('click', () => {
        subMenuCat.forEach((element) => {
            element.classList.remove('activeSubMenuCat')
        })
        item.classList.add('activeSubMenuCat')
    })
})


const children = document.querySelectorAll('.child');
let maxHeight = 0;

children.forEach(el => {
    if (el.offsetHeight > maxHeight) {
        maxHeight = el.offsetHeight;
    }
});

children.forEach(el => {
    el.style.height = maxHeight + 'px';
});

let commentModal = document.getElementById('commentModal')
function comment(state) {
    if (state == "open") {
        commentModal.classList.remove('invisible')
        commentModal.classList.remove('opacity-0')
        commentModal.children[0].classList.remove('opacity-0')
        commentModal.children[0].classList.remove('scale-50')
    }
    if (state == "close") {
        commentModal.children[0].classList.remove('delay-300')
        commentModal.classList.add('invisible')
        commentModal.classList.add('opacity-0')
        commentModal.children[0].classList.add('opacity-0')
        commentModal.children[0].classList.add('scale-50')
    }
}

let questionModal = document.getElementById('questionModal')
function question(state) {
    if (state == "open") {
        questionModal.classList.remove('invisible')
        questionModal.classList.remove('opacity-0')
        questionModal.children[0].classList.remove('opacity-0')
        questionModal.children[0].classList.remove('scale-50')
    }
    if (state == "close") {
        questionModal.children[0].classList.remove('delay-300')
        questionModal.classList.add('invisible')
        questionModal.classList.add('opacity-0')
        questionModal.children[0].classList.add('opacity-0')
        questionModal.children[0].classList.add('scale-50')
    }
}

let commentModalMobile = document.getElementById('commentModalMobile')
function commentMobile(state) {
    if (state == "open") {
        commentModalMobile.classList.remove('-bottom-full')
        commentModalMobile.classList.add('bottom-0')
    }
    





    if(state == 'close') {
        commentModalMobile.classList.remove('bottom-0')
        commentModalMobile.classList.add('-bottom-full')
    }
}

let questionModalMobile = document.getElementById('questionModalMobile')
function questionMobile(state) {
    if (state == 'open') {
        questionModalMobile.classList.remove('-bottom-full')
        questionModalMobile.classList.add('bottom-0')
    }
    if (state == 'close') {
        questionModalMobile.classList.remove('bottom-0')
        questionModalMobile.classList.add('-bottom-full')
    }
}

// search page

function btn(el) {
    if (el.children[0].classList.contains('translate-x-0')) {
        el.children[0].classList.remove('translate-x-0')
        el.children[0].classList.add('-translate-x-5')
        el.children[0].classList.add('bg-white')
        el.classList.add('bg-[var(--color-secondary)]')
        el.classList.remove('border-gray-400')
        el.classList.add('border-[var(--color-secondary)]')
    } else {
        el.children[0].classList.remove('-translate-x-5')
        el.children[0].classList.add('translate-x-0')
        el.children[0].classList.remove('bg-white')
        el.classList.remove('bg-[var(--color-secondary)]')
        el.classList.add('border-gray-400')
        el.classList.remove('border-[var(--color-secondary)]')
    }
}

let sidebarFeatures = document.querySelectorAll('.sidebarFeatures')
sidebarFeatures.forEach((item) => {
    item.addEventListener('click', () => {
        if (item.children[1].classList.contains('max-h-0')) {
            item.children[1].classList.remove('max-h-0')
            item.children[1].classList.add('max-h-svh')
            item.children[0].children[0].children[1].classList.add('rotate-180')
            sidebarFeatures.forEach((subItem) => {
                // console.log(item);
                // console.log(subItem);
                if (subItem.children[1] != item.children[1]) {
                    subItem.children[1].classList.remove('max-h-svh')
                    subItem.children[0].children[0].children[1].classList.remove('rotate-180')
                    subItem.children[1].classList.add('max-h-0')
                }
            })
        } else {
            item.children[1].classList.remove('max-h-svh')
            item.children[0].children[0].children[1].classList.remove('rotate-180')
            item.children[1].classList.add('max-h-0')
        }
    })
})

// new
let loginItem = document.getElementById('login')
function login(state) {
    if (state == "open") {
        loginItem.classList.remove('opacity-0')
        loginItem.classList.remove('invisible')
        loginItem.children[0].children[1].classList.remove('opacity-0')
        loginItem.children[0].children[1].classList.remove('scale-75')
    }
    if (state == "close") {
        loginItem.classList.add('opacity-0')
        loginItem.classList.add('invisible')
        loginItem.children[0].children[1].classList.add('opacity-0')
        loginItem.children[0].children[1].classList.add('scale-75')
    }

}

//! add to shopping cart by mr.olyafam
function addToShoppingCart(element, id, title, description, image, price) {
    let productCountInCookie = 0;
    let allCookies = document.cookie;
    let allCookiesArr = allCookies.split(';');
    allCookiesArr.forEach((cookie) => {
        if (cookie.indexOf('shahkarProduct') !== -1) {
            productCountInCookie++;
        }
    })
    let productCartInfo = 'shahkarProduct' + (productCountInCookie + 1) + 'title=' + title + '&&shahkarProduct' + (productCountInCookie + 1) + 'price=' + price + '&&shahkarProduct' + (productCountInCookie + 1) + 'description=' + description + '&&shahkarProduct' + (productCountInCookie + 1) + 'image=' + image + '&&shahkarProduct' + (productCountInCookie + 1) + 'id=' + id;
    document.cookie = productCartInfo;
    proNumber()
}
// product count in top of shopping cart icon
function proNumber() {
    let productCount = 0
    document.cookie.split(';').forEach((cookie) => {
        if (cookie.indexOf('shahkarProduct') !== -1) {
            productCount++
        }
    })




    document.querySelectorAll('.product-count-in-shoppingCart').forEach((proCount) => {
        proCount.innerHTML = productCount;
    })
}
proNumber()

let shoppingCartProducts = document.getElementById('shoppingCartProducts');
let mobileShoppingCartProducts = document.getElementById('mobileShoppingCartProducts');
let i = 1
let array = []
let x = []
let count = 0
let totalPrice = 0
function getCookies() {
    shoppingCartProducts.innerHTML = '';
    mobileShoppingCartProducts.innerHTML = '';
    let allCookies = document.cookie;
    i = 1
    count = 0
    totalPrice = 0
    let finalCountOfArray = 0
    allCookies.split(';').forEach((cookie) => {
        if (cookie.indexOf('shahkarProduct') !== -1) {
            let div = document.createElement('div')
            count++
            array = []
            cookie.split('&&').forEach((part) => {
                part.trim().split('=').forEach((info, index) => {
                    if (index == 0) key = info;
                    if (index == 1) array[key] = info;
                    if (index == 1) x[key] = info;
                    if (index == 1) {
                        finalCountOfArray++
                        if (finalCountOfArray == 5) {
                            let element = `
                                <div class="relative mb-5 w-full h-25 border-b border-(--color-border) pb-5">
                                        <input type="hidden" value="${array['shahkarProduct' + i + 'id']}">
                                        <div class="size-full flex gap-2">
                                            <div class="w-1/3 h-full">
                                                <img src="${array['shahkarProduct' + i + 'image']}" class="size-full" alt="">
                                            </div>
                                            <div class="flex flex-col gap-2 w-2/3 h-full">
                                                <span class="font-bold text-(--color-text)">${array['shahkarProduct' + i + 'title']}</span>
                                                <span class="text-sm font-light text-(--color-secondary-text)">${array['shahkarProduct' + i + 'description']}</span>
                                                <span class="text-sm font-light text-(--color-secondary-text)">
                                                    <span>${array['shahkarProduct' + i + 'price']}</span>
                                                    <span>تومان</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="absolute left-0 bottom-3 font-light text-(--color-secondary-text)">
                                            <div
                                                class="w-18 flex flex-row justify-between items-center border border-(--color-border) rounded-md p-0.5">
                                                <button class="rounded-md w-5 h-7 flex items-center justify-center cursor-pointer" onclick="changeProductCount(this, 'minus')">
                                                    <div class="cursor-pointer" onclick="removeProductFromShoppingCart(this,${array['shahkarProduct' + i + 'id']})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                            class="size-full">
                                                            <path fill="var(--color-fill)"
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
                                                </button>
                                                <input type="number" class="w-7 outline-none text-center"
                                                    value="1" min="0" name="" id="">
                                                <button
                                                    class="bg-(--color-primary-btn) rounded-md w-5 h-7 flex items-center justify-center cursor-pointer" onclick="changeProductCount(this, 'plus')">+</button>
                                            </div>
                                        </div>
                                </div>
                                `
                            div.innerHTML = element
                            totalPrice += parseInt(array['shahkarProduct' + i + 'price'])
                            finalCountOfArray = 0
                        }
                    }
                })
            })
            i++
            mobileShoppingCartProducts.appendChild(div);
            const clonedDiv = div.cloneNode(true);
            shoppingCartProducts.appendChild(clonedDiv);
        }
    })
    document.getElementById('shoppingCartProductCount').innerHTML = count
    document.getElementById('mobileShoppingCartProductCount').innerHTML = count
    document.getElementById('shoppingCartTotalPrice').innerHTML = totalPrice
    document.getElementById('mobileShoppingCartTotalPrice').innerHTML = totalPrice
    console.log(x);
}

let shoppingCartContent = document.getElementById('shoppingCartContent')
let mobileShoppingCartContent = document.getElementById('mobileShoppingCartContent')
function showCartContent() {
    getCookies()
    shoppingCartContent.classList.toggle('invisible');
    shoppingCartContent.classList.toggle('opacity-0');
    mobileShoppingCartContent.classList.toggle('invisible');
    mobileShoppingCartContent.classList.toggle('opacity-0');
}
function closeCart() {
    shoppingCartContent.classList.add('invisible');
    shoppingCartContent.classList.add('opacity-0');
    mobileShoppingCartContent.classList.add('invisible');
    mobileShoppingCartContent.classList.add('opacity-0');
}
//! remove product from shopping cart
function removeProductFromShoppingCart(el, id) {
    console.log(id);
    console.log(el.parentElement);
}

function changeProductCount(el, state) {
    if (state == "plus") {
        count++
        document.getElementById('shoppingCartProductCount').innerHTML = count
        document.getElementById('mobileShoppingCartProductCount').innerHTML = count
        document.getElementById('shoppingCartTotalPrice').innerHTML = totalPrice
        document.getElementById('mobileShoppingCartTotalPrice').innerHTML = totalPrice
        el.parentElement.children[1].value++
        if (el.parentElement.children[1].value > 1) {
            el.parentElement.children[0].classList.add('bg-(--color-primary-btn)')
            el.parentElement.children[0].innerHTML = '-'
        }
    }
    if (state == "minus") {
        count--
        document.getElementById('shoppingCartProductCount').innerHTML = count
        document.getElementById('mobileShoppingCartProductCount').innerHTML = count
        document.getElementById('shoppingCartTotalPrice').innerHTML = totalPrice
        document.getElementById('mobileShoppingCartTotalPrice').innerHTML = totalPrice
        if (el.parentElement.children[1].value > 1) {
            el.parentElement.children[1].value--
        }
        if (el.parentElement.children[1].value == 1) {
            el.parentElement.children[0].classList.remove('bg-(--color-primary-btn)')
            el.parentElement.children[0].innerHTML = `
                                                    <div class="cursor-pointer" onclick="removeProductFromShoppingCart(this,${array['shahkarProduct' + i + 'id']})">
                                                                                                            <svg xmlns="http://www.w3.org/2000/

svg" viewBox="0 0 448 512"
                                                            class="size-full">
                                                            <path fill="var(--color-fill)"
                                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
            `
        }
    }
}

//! related products to per category by mr.olyafam
let categoryTitles = document.querySelectorAll('.category-title')
categoryTitles.forEach((item) => {
    item.addEventListener('click', () => {
        categoryTitles.forEach((el) => {
            el.classList.remove('text-(--color-text)')
            el.classList.add('text-(--color-secondary-text)')
        })
        item.classList.add('text-(--color-text)')
    })
})

let relatedProducts = document.getElementById('relatedProducts');
let headerRelatedProducts = document.querySelectorAll('.headerRelatedProducts');
function getRelatedProducts(param, section) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    $.ajax({
        url: route,
        type: "POST",
        dataType: "json",
        data: {
            'id': param
        },
        success: function (data) {
            if (section == "home") {
                document.getElementById('relatedProductsCount').innerHTML = data.length
                relatedProducts.innerHTML = '';
                data.forEach((product) => {
                    let id = product.id;
                    let title = product.title;
                    let description = product.description;
                    let price = product.price.price;
                    let image = product.img;
                    let div = document.createElement('div');
                    div.classList = 'p-2 min-w-65 h-100 border border-(--color-border) rounded-[10px] relative flex flex-col justify-between productItem'
                    let element = `

                            <div>
                                <a href=""
                                    class="flex justify-center mb-1 overflow-hidden">
                                    <img src="${image}"
                                        class="w-full transition-all duration-500 hover:scale-[1.04] relative z-10 max-h-[182px] lg:max-h-[186px] md:max-h-[348px] xl:max-h-[171px]"
                                        alt="product">
                                </a>
                            </div>
                            <div class="flex flex-col">
                                <div class="mb-2 font-bold text-[14px] lg:text-base">
                                    <a href=""
                                        class="text-[12px] lg:text-[14px] text-(--color-text)">${title}</a>
                                </div>
                                <div class="mb-1">
                                    <a href="">${description}</a>
                                </div>
                            </div>
                            <div class="flex flex-row items-center mb-3 gap-3">
                                <div class="lg:w-1/2 flex flex-row items-center text-[12px]">
                                    <div class="text-(--color-secondary-text) flex flex-row items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"

viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-4"
                                            viewBox="0 0 576 512">
                                            <path fill="#8C9EC5"
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l2

6.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                    </div>
                                    <span>(0)</span>
                                </div>
                            </div>
                            <div class="">
                                <div
                                    class="hidden lg:flex flex-row items-center gap-2 text-(--color-text) mb-3 text-[18px] font-bold">
                                    <span class="font-bold text-lg">${price}</span>
                                    <span class="text-sm">تومان</span>
                                </div>
                                <div class="flex lg:hidden flex-row items-start gap-2 text-(--color-text) mb-3 font-bold">
                                    <span class="font-bold text-lg">${price}</span>
                                    <span class="text-sm">تومان</span>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row gap-2 lg:gap-4">
                                <div class="w-full h-12">
                                    <button
                                        onclick="addToShoppingCart(this,'${id}', '${title}', '${description}', '${image}', '${price}')"
                                        class="w-full h-full py-3 lg:py-1 text-[12px] lg:text-[14px] text-(--color-primary-text) bg-(--color-bg-card-btn) leading-5 rounded-[10px] cursor-pointer">افزودن
                                        به سبد خرید</button>
                                </div>
                            </div>
                    `
                    div.innerHTML = element;
                    relatedProducts.appendChild(div)
                })
            }
            if (section == "header") {
                headerRelatedProducts.forEach((headerRelatedProduct) => {
                    headerRelatedProduct.innerHTML = '';
                    data.forEach((product) => {
                        let div = document.createElement('div');
                        div.classList = 'p-4 border border-(--color-border) rounded-[10px]'
                        let element = `
                            <a href="http://localhost/shahkar/public/product/show/${product.id}"
                                class="block mb-1">
                                <img src="${product.img}"
                                    class="w-full transition-all duration-500 hover:scale-[1.04] relative z-10 max-h-[276px] lg:max-h-[186px] md:max-h-[348px] xl:max-h-[171px]"
                                    alt="product">
                                    <span
                                        class="inline-block w-full text-center pt-3">${product.title}</span>
                                    <span
                                        class="block text-center text-[14px] text-(--color-secondary-text)">${product.description}</span>
                            </a>
                        `
                        div.innerHTML = element;
                        headerRelatedProduct.appendChild(div)
                    })
                })
            }
        },
        error: function () {
            alert('error')
        }
    })
}
     </script>
@endsection