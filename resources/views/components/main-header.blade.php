{{-- Container --}}
<x-container>
    {{-- Header --}}
    <x-header>
        <div class="header__inner">
            <a href="#">
                <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
            </a>
        </div>
        <div class="flex items-center space-x-8">
            <div>
                <ul>
                    <li>
                        <a href="#" class="flex items-center">
                            English
                            <span><img class="ml-2" src="{{ asset('img/Stroke 165.png') }}"
                                    alt="arrowDown"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <p class="font-semibold">Takeshi K. </p>
                <span class="border-r h-8 max-h-full"></span>
            </div>

            <div class="hidden md:block">
                <a href="#" class="text-black">Log Out</a>
            </div>

            <div class="md:hidden block">
                <a href="#" class="block p-3">
                    <img src="{{ asset('img/vectors/Hamburger vector.png') }}" alt="">
                </a>
            </div>
        </div>
    </x-header>
</x-container>

<hr>
