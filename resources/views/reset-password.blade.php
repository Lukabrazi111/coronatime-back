<x-layout>
    <main class="flex justify-center w-full max-h-screen font-intern">
        <div class="flex flex-col py-10 px-4 w-full">
            <div class="mb-12 min-w-full flex flex-col justify-center items-center text-center">
                <div class="mb-32">
                    <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
                </div>

                <div class="mb-8">
                    <h1 class="font-semibold text-black text-2xl">Reset Password</h1>
                </div>

                {{-- Form --}}
                <form action="{{ route('reset-password.post') }}" method="post"
                    class="flex flex-col mt-4 w-full max-w-lg">
                    @csrf

                    <input type="hidden" value="{{ $token }}" name="token">
                    <input type="hidden" value="{{ $email }}" name="email">

                    <label for="password" class="mb-2 text-left font-semibold">New password</label>
                    <input
                        class="px-4 py-4 rounded-lg border border-gray-200 mb-6 @error('password') mb-2 @enderror placeholder-dark"
                        type="password" name="password" id="password" placeholder="Enter new password">
                    @error('password')
                        <span class="text-sm text-red-600 flex mb-2 mt-1">
                            <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}"
                                alt="error">
                            {{ $message }}
                        </span>
                    @enderror

                    <label for="repeat_password" class="mb-2 text-left font-semibold">Repeat password</label>
                    <input
                        class="px-4 py-4 rounded-lg border border-gray-200 mb-6 @error('repeatPassword') mb-2 @enderror placeholder-dark"
                        type="password" name="repeat_password" id="repeat_password" placeholder="Repeat password" />
                    @error('repeat_password')
                        <span class="text-sm text-red-600 flex mb-2 mt-1">
                            <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}"
                                alt="error">
                            {{ $message }}
                        </span>
                    @enderror

                    <div>
                        <button type="submit"
                            class="py-4 transition duration-150 ease-in text-white font-semibold
                                 uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">Save
                            Changes</button>
                    </div>
                </form>

            </div>
        </div>

        @if (session()->has('success_message'))
            <div x-data="{show:true}" x-show="show" x-init="
                setTimeout(()=>{
                    show = false;
                }, 5000);
            " class="animate-pulse fixed bottom-8 left-4 bg-success px-5 py-3 rounded-xl">
                <span class="text-white">{{ session('success_message') }}</span>
            </div>
        @endif
        @if (session()->has('error_message'))
            <div x-data="{show:true}" x-show="show" x-init="
                setTimeout(()=>{
                    show = false;
                }, 5000);
            " class="animate-pulse fixed bottom-8 left-4 bg-red-500 px-5 py-3 rounded-xl">
                <span class="text-white">{{ session('error_message') }}</span>
            </div>
        @endif
    </main>
</x-layout>
