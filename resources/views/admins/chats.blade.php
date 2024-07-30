
<x-admin-layout>
    <x-slot name="header">
        Quản lý chats
    </x-slot>
    <div>
        <div class="font-bold text-2xl">Quản lý chats</div>
        <div class="flex w-full mt-4">
            <div class="w-[30%] border rounded-lg shadow-lg mr-2 h-[88vh]">
                <div class="font-bold text-xl py-2 px-4 border-gray-400 border-b">Đoạn chat</div>
                @foreach ($requests as $request)
                    <button data-id="{{ $request->id }}" class="w-full flex justify-start px-4 py-5 bg-white hover:bg-blue-100 message-btn">
                        Đoạn chat giữa người dùng {{ $request->user->name }} và thợ {{ $request->staff->name }}
                    </button>
                    <hr>
                @endforeach
            </div>
            <div id="loading" class="hidden">
                <div class="absolute z-1000 top-0 start-0 size-full bg-white/50 rounded-lg"></div>

                <div class="absolute top-1/2 start-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div class="animate-spin inline-block size-6 border-2 border-current border-t-transparent text-blue-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="scroll" class="w-[70%] border rounded-lg shadow-lg overflow-x-auto [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-thumb]:rounded-full">
                <div class="">
                    <div id="message-content" class=""></div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="module">
            $(document).ready(function() {
                let loading = false;
                let page = 1;

                //Message
                $('.message-btn').each(function() {
                    $(this).on('click', function() {
                        page = 1;
                        loading = false;
                        $('.message-btn').removeClass('bg-blue-100 pointer-events-none');
                        $(this).addClass('bg-blue-100 pointer-events-none');
                        $('#loading').removeClass('hidden');

                        let requestId = $(this).data('id');

                        let url = '{{ route('admin.chat.request', ':request') }}'.replace(':request', requestId);

                        axios.get(url)
                            .then(function(response) {
                                $('#message-content').html(response.data.view);
                                $('#chatbox').html(response.data.additional_view);
                                $('#loading').addClass('hidden');

                                $('#chatbox').off('scroll').on('scroll', function() {
                                    if (loading) return;

                                    if ($(this).scrollTop() === 0) {
                                        loading = true;
                                        page++;
                                        let $loadingMessage = $('#loadingMessage');
                                        $loadingMessage.removeClass('hidden');

                                        let loadUrl = '{{ route('admin.chat.load', [':request', ':page']) }}';
                                        loadUrl = loadUrl.replace(':request', requestId).replace(':page', page);
                                        
                                        axios.get(loadUrl)
                                        .then(function(response) {
                                            $('#chatbox').prepend(response.data.view);
                                            loading = false;
                                            $loadingMessage.addClass('hidden');
                                        })
                                    }
                                });
                            })
                    });
                });
            });
        </script>
    </x-slot>
</x-admin-layout>
