@extends('admin.app.dashboard')
@section('title', 'ایجاد درباره ما')
@section('content')

    <div class="absolute top-0 opacity-0 invisible right-1/2 translate-x-1/2 w-2/3 lg:w-1/3 bg-white rounded-lg shadow-md transition-all duration-500"
         id="message">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="size-4 absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer" onclick="showMessage('close')"
                 viewBox="0 0 384 512">
                <path
                        d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z"/>
            </svg>

        </div>
    </div>

    <div class="text-center mb-4">
        <h1 class="text-lg font-bold text-gray-800">
            ایجاد صفحه درباره ما
        </h1>
    </div>
    <form action="{{ route('aboutUs.updateOrcreate') }}" method="post" id="form">
        @csrf
        @if($aboutUs)
            <input type="hidden" name="id" value="{{$aboutUs->id}}">
        @endif
        <div class="min-h-screen flex items-start justify-center">
            <div class="bg-white rounded-2xl shadow-md p-3 w-full lg:w-3/4">
                <div class="text-center mb-4">
                    <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-3 my-4">
                        <div class="w-full flex flex-col gap-3 itmes-center max-md:flex-col max-md:gap-1">
                            <label for="title" class="w-30 text-sm mb-1 mt-2.5 flex">عنوان</label>
                            <div
                                    class="rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] text-[#99A1B7] w-full flex">
                                <input class="p-4 w-full focus:outline-none text-sm font-bold mr-2" type="text"
                                       name='title' placeholder="عنوان" title="عنوان" value="{{ $aboutUs?->title }}"
                                       id="title">
                            </div>
                        </div>
                        <div class="w-full flex flex-col gap-3 itmes-center max-md:flex-col max-md:gap-1 lg:col-span-2">
                            <label class="w-30 text-sm mb-1 mt-2.5 flex">توضیحات</label>
                            <div
                                    class="rounded-lg focus:border-none focus:outline-none focus:bg-[#F1F1F4] bg-[#F9F9F9] text-[#99A1B7] w-full flex">
                                    <textarea class="p-4 w-full focus:outline-none text-sm font-bold mr-2"
                                              type="text" name='description' placeholder="توضیحات"
                                              title="توضیحات">{{ $aboutUs?->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-center">
                        <button type="button" onclick="showText(this)"
                                class="active:bg-[#0080e5] mt-2 bg-[#03A9F4] text-white p-3 max-md:p-2 rounded-md hover:bg-blue-700 transition duration-200 font-medium cursor-pointer">
                            ثبت
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        let message = document.getElementById('message')
        let element = document.createElement('div')
        element.classList = "text-sm font-bold flex flex-row items-center justify-center py-3 gap-2 lg:gap-3"

        function showText(el) {
            let title = document.getElementById('title');
            if (title.value === '') {
                element.innerHTML = `
                            <span class="text-red-500">!</span>
                            <span>لطفا یک عنوان وارد کنید.</span>
                        `
                message.children[0].appendChild(element)
                showMessage('open')
                setTimeout(() => {
                    showMessage('close')
                }, 2000)
            } else {
                document.forms[0].submit()
                element.innerHTML = `
                            <span class="text-red-500">!</span>
                            <span>لطفا صبر کنید.</span>
                        `
                message.children[0].appendChild(element)
                showMessage('open')
                el.setAttribute('disabled', true)
                el.classList.remove('cursor-pointer')
                el.classList.add('cursor-no-drop')
                setTimeout(() => {
                    showMessage('close')
                }, 3000)
            }
        }


        function showMessage(state) {
            if (state == 'open') {
                message.classList.remove('top-0')
                message.classList.remove('opacity-0')
                message.classList.remove('invisible')
                message.classList.add('top-2/10')
            }
            if (state == 'close') {
                message.classList.remove('top-2/10')
                message.classList.add('top-0')
                message.classList.add('opacity-0')
                message.classList.add('invisible')
            }
        }
    </script>
@endsection
