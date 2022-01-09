<x-layout>
    {{-- Main --}}
    <main class="flex justify-between w-full max-h-screen font-intern">
        <div class="flex flex-col py-10 px-4 w-full md:pl-32 md:w-7/12">
            <div class="mb-12">
                <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
            </div>
            <div>
                <h1 class="text-2xl font-bold mb-2">Welcome to Coronatime</h1>
                <h2 class="text-xl font-normal text-dark">Please enter required info to sign up</h2>
            </div>
            {{-- Form --}}
            <livewire:register />
        </div>

        {{-- Main page image --}}
        <div>
            <img class="h-screen bg-cover hidden md:flex" src="{{ asset('img/Rectangle 1.png') }}" alt="capsuleImg">
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
    </main>
</x-layout>
