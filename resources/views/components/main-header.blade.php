{{-- Container --}}
<x-container>
    {{-- Header --}}
    <x-header>
        <div class="header__inner">
            <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
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
            <div class="flex items-center space-x-4">
                <p class="font-semibold">Takeshi K. </p>
                <span class="border-[#E6E6E7] border-r h-8 max-h-full"></span>
            </div>

            <div>
                <a href="#" class="text-black">Log Out</a>
            </div>
        </div>
    </x-header>
</x-container>

<hr>
