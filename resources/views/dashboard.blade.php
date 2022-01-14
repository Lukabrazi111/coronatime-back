<x-layout>
    <x-dashboard-header />

    <x-container>
        <section class="section__content pt-12 px-4">
            <div class="mb-8">
                <h1 class="text-black text-2xl font-semibold">{{ __('Worldwide Statistics') }}</h1>
            </div>

            <div class="mb-12">
                <nav class="navbar">
                    <ul class="flex space-x-14 border-b-2 pb-3">
                        <li><a href="{{ route('dashboard', app()->getLocale()) }}"
                                class="pb-4 border-b-black border-b-4 font-semibold text-lg">{{ __('Worldwide') }}</a></li>
                        <li><a href="{{ route('dashboard.country', app()->getLocale()) }}" class="text-lg pb-4">{{ __('By country') }}</a></li>
                    </ul>
                </nav>
            </div>

            <div>
                <div class="grid md:grid-cols-3 grid-cols-2 gap-4">
                    <div class="bg-brand-primary bg-opacity-7 rounded-xl md:col-span-1 col-span-full">
                        <div class="px-10 py-12 flex flex-col justify-center items-center space-y-6">
                            <div class="mb-4">
                                <img src="{{ asset('img/vectors/Blue vector.png') }}" alt="">
                            </div>

                            <div>
                                <h3 class="text-black text-xl">{{ __('New cases') }}</h3>
                            </div>

                            <div>
                                <h1 class="text-brand-primary font-black text-4xl">{{ $confirmed }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="bg-brand-secondary bg-opacity-7 rounded-xl">
                        <div class="px-10 py-12 flex flex-col justify-center items-center space-y-6">
                            <div class="mb-6 mt-4">
                                <img src="{{ asset('img/vectors/Green vector.png') }}" alt="">
                            </div>

                            <div>
                                <h3 class="text-black text-xl">{{ __('Recovered') }}</h3>
                            </div>

                            <div>
                                <h1 class="text-brand-secondary font-black text-4xl">{{ $recovered }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class=" bg-brand-tertiary bg-opacity-7 rounded-xl">
                        <div class="px-10 py-12 flex flex-col justify-center items-center space-y-6">
                            <div class="mb-4 mt-3">
                                <img src="{{ asset('img/vectors/Yellow vector.png') }}" alt="">
                            </div>

                            <div>
                                <h3 class="text-black text-xl">{{ __('Deaths') }}</h3>
                            </div>

                            <div>
                                <h1 class="text-brand-tertiary font-black text-4xl">{{ $deaths }}</h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </x-container>
</x-layout>
