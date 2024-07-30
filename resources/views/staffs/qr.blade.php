<x-guest-layout>
    <x-slot name="header">
        Max QR code nhận xét
    </x-slot>

    <div class="mt-3 bg-white rounded min-h-[80vh]">
        <h2 class="font-extrabold p-4 px-5 rounded-t-lg border-b text-lg flex justify-center items-center">
            Mã QR code nhận xét
        </h2>
        <div class="p-4 text-center space-y-4 mt-10">
            <div class="text-gray-700">Đường dẫn đánh giá</div>
            <div class="grid grid-cols-1 justify-center text-center">
                <div class="flex justify-center items-center">
                    <img id="canvas" class="p-4 rounded-lg bg-gray-100" />
                </div>
                <div>
                    <a id="download" class="inline-block leading-6 h-6 px-2 text-xs font-bold mt-2 rounded-lg bg-gray-100" download>Download</a>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="module">
            let opts = {
                errorCorrectionLevel: 'H',
                type: 'image/png',
                margin: 0,
                width: 300
            }
            QRCode.toDataURL('{{ route('staff.signin.create') }}', opts, function (err, url) {
                $('#canvas').attr('src', url)
                $('#download').attr('href', url);
            })
        </script>
    </x-slot>
</x-guest-layout>
