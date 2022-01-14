<x-layout>
    <x-dashboard-header/>

    <x-container>
        <section class="section__content pt-12 md:px-4 pb-10">
            <div class="px-4 md:px-0">
                <div class="mb-8">
                    <h1 class="text-black text-2xl font-semibold">{{ __('Statistics by country') }}</h1>
                </div>

                <div class="mb-12">
                    <nav class="navbar">
                        <ul class="flex space-x-14 border-b-2 pb-3">
                            <li><a href="{{ route('dashboard', app()->getLocale()) }}"
                                   class="pb-4 text-lg">{{ __('Worldwide') }}</a></li>
                            <li><a href="{{ route('dashboard.country', app()->getLocale()) }}"
                                   class="text-lg pb-4 font-semibold border-b-black border-b-4">{{ __('By country') }}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            {{-- Table --}}
            <livewire:country-statistics-livewire/>

    </x-container>
</x-layout>
