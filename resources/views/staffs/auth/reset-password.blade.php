<x-staff-layout>
    <x-slot name="header">
        Đổi mật khẩu
    </x-slot>

    <div class="py-5 px-7 border rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded">
        <h3 class="text-center font-medium text-3xl">Đổi mật khẩu</h3>
        <form action="{{ route('staff.reset-password.update') }}" method="post">
            @csrf
            @method('PATCH')

            <div class="mt-7">
                <label for="password" class="block text-sm mb-2">Mật khẩu mới<span class="text-red-600 ms-1">*</span></label>
                <div class="flex rounded-lg h-12">
                    <input type="password" name="password" id="password" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Mật khẩu mới">
                </div>
                @error('password')
                <div class="text-sm text-[#dc2626] mt-2" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mt-7">
                <label for="password-confirmation" class="block text-sm mb-2">Xác nhận mật khẩu mới<span class="text-red-600 ms-1">*</span></label>
                <div class="flex rounded-lg h-12">
                    <input type="password" name="password_confirmation" id="password-confirmation" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Xác nhận mật khẩu mới">
                </div>
                @error('password_confirmation')
                <div class="text-sm text-[#dc2626] mt-2" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <input type="hidden" name="token" value="{{ $token }}" required>

            <div class="flex justify-center mt-9">
                <button id="submit" type="submit" class="py-3 px-4 w-44 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-primary text-white hover:bg-hover-primary disabled:opacity-30 disabled:text-black disabled:bg-gray-500 disabled:pointer-events-none">
                    Đổi mật khẩu
                </button>
            </div>
        </form>
    </div>
</x-staff-layout>
