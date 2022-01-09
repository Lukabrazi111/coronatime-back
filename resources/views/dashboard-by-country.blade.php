<x-layout>
    <x-dashboard-header />

    <x-container>
        <section class="section__content pt-12 md:px-4">
            <div class="px-4 mb-8">
                <h1 class="text-black text-2xl font-semibold">Worldwide Statistics</h1>
            </div>

            <div class="px-4 mb-12">
                <nav class="navbar">
                    <ul class="flex space-x-14 border-b-2 pb-3">
                        <li><a href="{{ route('dashboard') }}"
                                class="pb-4 border-b-black border-b-4 font-semibold text-lg">Worldwide</a></li>
                        <li><a href="{{ route('dashboard.country') }}"
                                class="text-lg pb-4 hover:border-b-black hover:border-b-4">By
                                country</a></li>
                    </ul>
                </nav>
            </div>

            <div class="px-4 mb-8">
                <div class="relative w-full max-w-xss">
                    <div>
                        <img class="absolute top-2/4 left-5 transform -translate-y-1/2 text-center"
                            src="{{ asset('img/search.png') }}" alt="">
                    </div>
                    <div>
                        <input type="search" id="search"
                            class="md:w-full md:max-w-xss pl-14 rounded-lg outline-none focus:outline-none border-gray-200 py-3"
                            placeholder="Search by country">
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="flex flex-col">
                <div class="border-b border-gray-200 shadow-lg">
                    <table class="divide-y divide-gray-300 w-full text-center">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-2 text-xs text-black">
                                    Location
                                </th>
                                <th class="py-2 text-xs text-black">
                                    New cases
                                </th>
                                <th class="py-2 text-xs text-black">
                                    Deaths
                                </th>
                                <th class="py-2 text-xs text-black">
                                    Recovered
                                </th>
                                <th class="md:px-8 py-2 text-xs text-black"></th>
                                <th class="md:px-8 py-2 text-xs text-black"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            <tr class="whitespace-nowrap">
                                <td class="px-2 py-4 text-sm text-black">
                                    1
                                </td>
                                <td class="px-2 py-4">
                                    <div class="text-sm text-black">
                                        Jon doe
                                    </div>
                                </td>
                                <td class="px-2 py-4">
                                    <div class="text-sm text-black">jhondoe@example.com</div>
                                </td>
                                <td class="px-2 py-4 text-sm text-black">
                                    2021-1-12
                                </td>
                                <td class="py-4"></td>
                                <td class="py-4"></td>
                            </tr>
                            <tr class="whitespace-nowrap">
                                <td class="px-2 py-4 text-sm text-black">
                                    1
                                </td>
                                <td class="px-2 py-4">
                                    <div class="text-sm text-gray-900">
                                        Jon doe
                                    </div>
                                </td>
                                <td class="px-2 py-4">
                                    <div class="text-sm text-black">jhondoe@example.com</div>
                                </td>
                                <td class="px-2 py-4 text-sm text-black">
                                    2021-1-12
                                </td>
                                <td class="py-4"></td>
                                <td class="py-4"> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

    </x-container>
</x-layout>
