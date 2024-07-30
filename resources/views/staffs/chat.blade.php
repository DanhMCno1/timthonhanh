<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Yêu cầu #{{ $modelsRequest->id }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://preline.co/assets/js/hs-textarea-autoheight.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-[#F7F9FC]">
<div class="flex h-screen antialiased text-gray-800 max-w-[540px] m-auto">
    <div class="flex flex-row h-full w-full bg-[#F7F9FC] gap-2">
        <div class="flex flex-col flex-auto h-full bg-white shadow rounded-b-lg">
            <div class="relative flex flex-col flex-auto flex-shrink-0 h-full">
                <div class="h-16 flex flex-row-reverse justify-start items-center p-2 px-5 shadow-md gap-2">
                    <span class="inline-flex items-center justify-center size-10 rounded-full bg-gray-500 font-semibold text-white leading-none">
                        {{ substr($modelsRequest->user->name, 0, 1) }}
                    </span>
                    {{ $modelsRequest->user->name }}
                </div>
                <div id="loading" class="hidden">
                    <div class="absolute z-1000 top-0 start-0 size-full bg-white/50 rounded-lg"></div>

                    <div class="absolute top-1/2 start-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <div class="animate-spin inline-block size-6 border-2 border-current border-t-transparent text-blue-600 rounded-full" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div id="scroll" class="flex flex-col h-full overflow-x-auto [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-thumb]:rounded-full mb-2">
                    <div class="flex flex-col h-full">
                        <div id="chat" class="flex flex-col-reverse gap-y-2"></div>
                    </div>
                </div>
                <form id="send-message" class="flex flex-row items-end rounded-xl bg-white w-full p-2 gap-x-2" action="{{ route('staff.messages.store', $modelsRequest) }}" method="post">
                    @csrf
                    <div class="w-full px-1 border border-gray-200 rounded-lg has-[:focus]:border-blue-500 focus:ring-blue-500">
                        <textarea id="message" name="message" class="border-none focus:border-none focus:ring-0 rounded-md max-h-36 p-3 block w-full text-sm resize-none overflow-y-auto [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-orange-300 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-thumb]:rounded-full" placeholder="Nhập tin nhắn..." rows="1" data-hs-default-height="48"></textarea>
                    </div>
                    <div class="self-center basis-1/6">
                        <button id="submit" class="flex items-center w-full justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white p-2 flex-shrink-0">
                            <span id="submit-icon" class="block">
                                <svg class="size-5 transform rotate-45 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </span>
                            <div id="loading-icon" class="hidden inline-block animate-spin size-5 border-2 border-current border-t-transparent text-white-600 rounded-full" role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script type="module">
        $(document).ready(function() {
            const loadingDiv = $('#loading');
            const scrollDiv = $('#scroll');
            const chatDiv = $('#chat');
            const sendForm = $('#send-message');
            const message = $('#message');
            const submitBtn = $('#submit');
            const submitIcon = $('#submit-icon');
            const loadingIcon = $('#loading-icon');
            let quantity = {{ config('app.constants.QUANTITY_DEFAULT') }};
            let count = 0;
            let loading = false;

            textareaAutoHeight(['#message']);

            loadMessages(true);
            setInterval(loadMessages, 1000);

            function loadMessages(scroll = false) {
                if (loading) return;
                loading = true;

                return axios.get('{{ route('staff.messages.index', $modelsRequest) }}', {
                    params: {
                        quantity: quantity
                    }
                })
                    .then(function (response) {
                        count = response.data.count;
                        chatDiv.html(response.data.view);

                        if (scroll) {
                            scrollDiv.animate({
                                scrollTop: scrollDiv.prop('scrollHeight')
                            }, 'fast');
                        }
                        loading = false;
                    })
            }

            scrollDiv.on('scroll', function () {
                if (scrollDiv.scrollTop() === 0 && count === quantity) {
                    loadingDiv.removeClass('hidden');
                    let position = quantity + 1;
                    quantity += {{ config('app.constants.QUANTITY_DEFAULT') }};
                    loading = false;
                    loadMessages().then(function() {
                        loadingDiv.addClass('hidden');
                        let scrollTo = scrollDiv.find('#chat').children().eq(position);
                        scrollDiv.scrollTop(scrollTo.position().top);
                    });
                }
            })

            sendForm.on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                if (formData.get('message').trim() === '') return;
                submitIcon.addClass('hidden');
                loadingIcon.removeClass('hidden');
                submitBtn.addClass('pointer-events-none');

                axios.post('{{ route('staff.messages.store', $modelsRequest) }}', formData)
                    .then(function () {
                        quantity += 1;
                        loading = false;
                        loadMessages(true);

                        submitIcon.removeClass('hidden');
                        loadingIcon.addClass('hidden');
                        submitBtn.removeClass('pointer-events-none');
                        message.val('').css('height', message.data('hs-default-height'));
                    })
            })
        });
    </script>
</body>
