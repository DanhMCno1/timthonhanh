<x-user-layout>
    <x-slot name="header">
        Quên mật khẩu
    </x-slot>

    <div class="py-10 px-7 bg-white mt-3 border shadow rounded rounded-t-md min-h-[75vh]">
        <h3 class="text-center font-medium text-3xl">Đổi mật khẩu</h3>
        <form method="POST" action="{{ route('reset-password.update') }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="token" value="{{ $token }}" required>
            <div class="py-7 space-y-2">
                <div class="form-control">
                    <span class="label-text">
                        Mật khẩu mới
                        <span class="text-red-600 ms-1">*</span>
                    </span>
                </div>
                <div class="form-control">
                    <input type="password" id="newPassword" name="password"
                           class="py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Mật khẩu mới">
                </div>
                <span id="inputPWErr" class="text-red-700 text-sm mt-1 hidden"></span>
                @error('password')
                <span id="inputPWErr" class="text-red-700 text-sm mt-1">{{ $message }}</span>
                @enderror

                <div class="form-control">
                    <span class="label-text mt-1">
                        Xác nhận mật khẩu mới
                        <span class="text-red-600 ms-1">*</span>
                    </span>
                </div>
                <div class="form-control">
                    <input type="password" id="confirmPassword" name="confirm_password" disabled
                           class="py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Xác nhận mật khẩu mới">
                </div>
                <span id="inputConfirmPWErr" class="text-red-700 text-sm mt-1 hidden"></span>
                <div class="flex justify-center !mt-10">
                    <button id="btnResetPW" type="submit"
                            class="min-w-[170px] mt-5 py-3 px-7 rounded-full text-base bg-blue-700 text-white hover:bg-blue-800 disabled:opacity-50 disabled:pointer-events-none"
                            disabled>
                        Đổi mật khẩu
                    </button>
                </div>
            </div>
        </form>
    </div>
    <x-slot name="script">
        @vite('resources/js/user/forget-password-form.js')
    </x-slot>
</x-user-layout>
