<x-admin-layout>
    <x-slot name="header">
        Đăng nhập trang quản trị
    </x-slot>
    <div class="flex justify-center mt-16 h-full">
        <div class="sm:max-w-lg sm:w-full sm:mx-auto">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <h2 class="block text-2xl font-bold text-gray-800">Sign in</h2>
                    </div>

                    <div class="mt-5">
                        <form method="post">
                            @csrf
                            <div class="grid grid-cols-1 gap-5">
                                <div>
                                    <label for="username" class="block text-sm mb-2">Tên đăng nhập</label>
                                    <div class="relative space-y-2">
                                        <input type="text" id="username" name="username" value="{{ old('username') }}" class="py-3 px-4 block w-full border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" required autofocus>
                                        @error('username')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="password" class="block text-sm mb-2">Mật khẩu</label>
                                    <div class="relative space-y-2">
                                        <input type="password" id="password" name="password" class="py-3 px-4 block w-full border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                                        @error('password')
                                            <p class="text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <button type="submit" class="w-32 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">Đăng nhập</button>
                                </div>
                            </div>
                        </>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
