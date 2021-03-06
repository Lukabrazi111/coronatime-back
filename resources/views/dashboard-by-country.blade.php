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
                        <ul class="md:flex md:items-center md:space-x-14 space-y-2 md:space-y-0 md:border-b-2 md:pb-3">
                            <li><a href="{{ route('dashboard') }}" class="pb-4 text-lg">{{ __('Worldwide') }}</a>
                            </li>
                            <li><a href="{{ route('dashboard.country') }}"
                                   class="md:pb-4 pb-1 border-b-2 border-b-black text-lg font-semibold md:border-b-black md:border-b-4">{{ __('By country') }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            {{-- Table --}}
            <livewire:country-statistics-livewire/>
        </section>

    </x-container>
</x-layout>
