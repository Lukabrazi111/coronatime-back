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
                <livewire:reset-password />
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
