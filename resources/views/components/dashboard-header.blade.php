{{-- Container --}}
<x-container>
    {{-- Header --}}
    <x-header>
        <div class="header__inner">
            <a href="#">
                <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
            </a>
        </div>
        <div x-data="{show : false}" x-cloak class="flex items-center space-x-8">
            <div class="relative">
                <ul @click.outside="show = false">
                    <li>
                        <a @click="show = !show" href="#" class="flex items-center">
                            English
                            <span><img class="ml-2" src="{{ asset('img/Stroke 165.png') }}"
                                    alt="arrowDown"></span>
                        </a>
                        <div x-show="show" x-transition.origin.top.duration.200ms
                            class="shadow-md w-36 absolute left-0 top-9 rounded-lg bg-gray-200 bg-opacity-75 text-black text-left">
                            <ul>
                                <li>
                                    <a href="#"
                                        class="px-4 p-3 transition duration-150 ease-in hover:bg-gray-300 rounded w-full block">English</a>
                                </li>

                                <li>
                                    <a href="#"
                                        class="px-4 p-3 transition duration-150 ease-in hover:bg-gray-300 rounded w-full block">Georgia</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <p class="font-semibold">{{ auth()->user()->name }}</p>
                <span class="border-r h-8 max-h-full"></span>
            </div>
            @auth
                <livewire:logout />
            @endauth

            <div class="md:hidden block">
                <a href="#" class="block p-3">
                    <img src="{{ asset('img/vectors/Hamburger vector.png') }}" alt="">
                </a>
            </div>
        </div>
    </x-header>
</x-container>

<hr>
