<x-layout>
    {{-- Main --}}
    <main class="flex justify-between w-full max-h-screen font-intern pb-6">
        <div class="flex flex-col pt-10 px-4 w-full md:pl-32 md:w-7/12">
            <div class="mb-12">
                <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
            </div>
            <div>
                <h1 class="text-2xl font-bold mb-2">Welcome back</h1>
                <h2 class="text-xl font-normal text-dark">Welcome back! Please enter your details</h1>
            </div>
            {{-- Form --}}
            <livewire:login />
        </div>

        {{-- Main page image --}}
        <div>
            <img class="h-screen md:block hidden" src="{{ asset('img/Rectangle 1.png') }}" alt="capsuleImg">
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
