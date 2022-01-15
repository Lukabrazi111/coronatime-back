<div>
    <div class="mb-8">
        <div class="relative w-full max-w-xss">
            <div>
                <img class="absolute top-2/4 left-5 transform -translate-y-1/2 text-center"
                     src="{{ asset('img/search.png') }}" alt="">
            </div>
            <div class="ml-3 md:m-0">
                <input wire:model='search' type="search" id="search"
                       class="md:w-72 pl-14 rounded-lg outline-none focus:outline-none border-gray-200 py-3"
                       placeholder="{{ __('Search by country') }}">
            </div>
        </div>
    </div>

    <div class="overflow-scroll relative" style="height: 47rem;">
        <table class="divide-y divide-gray-200 w-full text-left">
            {{-- Table head --}}
            <thead class="bg-gray-200">
            <tr>
                <th class="md:w-64 md:p-5 py-5 text-xs text-black md:rounded-tl-lg">
                    <div class="flex inline-block gap-2">
                        {{ __('Location') }}
                        <div class="flex inline-flex flex-col items-center">
                            <button wire:click="sortBy('name')">
                                <img class="mb-1" src="{{ asset('img/arrow-up.png') }}" alt="arrowUp">
                            </button>
                            <button wire:click="sortBy('name')">
                                <img class="text-black" src="{{ asset('img/black-arrow.png') }}"
                                     alt="blackArrow">
                            </button>
                        </div>
                    </div>
                </th>
                <th class="md:w-64 text-xs text-black">
                    <div class="md:flex inline-block md:gap-2 break-all">
                        {{ __('New cases') }}
                        <div class="md:flex inline-flex flex-col items-center">
                            <button wire:click="sortBy('confirmed')">
                                <img class="mb-1" src="{{ asset('img/arrow-up.png') }}" alt="arrowUp">
                            </button>
                            <button wire:click="sortBy('confirmed')">
                                <img class="text-black" src="{{ asset('img/black-arrow.png') }}"
                                     alt="blackArrow">
                            </button>
                        </div>
                    </div>
                </th>
                <th class="md:w-64 text-xs text-black">
                    <div class="md:flex inline-block md:gap-2 break-all">
                        {{ __('Deaths') }}
                        <div class="md:flex inline-flex flex-col items-center">
                            <button wire:click="sortBy('deaths')">
                                <img class="mb-1" src="{{ asset('img/arrow-up.png') }}" alt="arrowUp">
                            </button>
                            <button wire:click="sortBy('deaths')">
                                <img class="text-black" src="{{ asset('img/black-arrow.png') }}"
                                     alt="blackArrow">
                            </button>
                        </div>
                    </div>
                </th>
                <th class="md:w-64 text-xs text-black">
                    <div class="md:flex inline-block md:gap-2 break-all">
                        {{ __('Recovered') }}
                        <div class="md:flex inline-flex flex-col items-center">
                            <button wire:click="sortBy('recovered')" href="#">
                                <img class="mb-1" src="{{ asset('img/arrow-up.png') }}" alt="arrowUp">
                            </button>
                            <button wire:click="sortBy('recovered')" href="#">
                                <img class="text-black" src="{{ asset('img/black-arrow.png') }}"
                                     alt="blackArrow">
                            </button>
                        </div>
                    </div>
                </th>
                <th class="md:w-32 py-2 text-xs text-black"></th>
                <th class="md:w-32 py-2 text-xs text-black md:rounded-tr-lg"></th>
            </tr>
            </thead>
            {{-- Table body --}}
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($countries as $country)
                <tr class="whitespace-nowrap">
                    <td class="md:p-5 text-sm pl-2 text-black">
                        {{ $country->name }}
                    </td>
                    <td>
                        <div class="text-sm text-black">
                            {{ $country->confirmed }}
                        </div>
                    </td>
                    <td class="">
                        <div class="text-sm text-black">{{ $country->deaths }}</div>
                    </td>
                    <td class="py-4 text-sm text-black">
                        {{ $country->recovered }}
                    </td>
                    <td class="py-4"></td>
                    <td class="py-4"></td>
                </tr>
            @empty
                <div class="absolute top-16 left-2">Nothing found for this query {{ $search }}...</div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
