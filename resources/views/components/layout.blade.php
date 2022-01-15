<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <livewire:styles/>
</head>

<body>
@if(!auth()->user())
    {{-- Language switcher --}}
    <div
        x-cloak
        x-data="{ show : false }"
        class="absolute right-1/2 top-2">
        <ul @click.outside="show = false">
            <li>
                <a @click="show = !show" href="#" class="flex items-center">
                    @if(session('lang') === 'en')
                        English
                    @else
                        ქართული
                    @endif
                    <span><img class="ml-2" src="{{ asset('img/Stroke 165.png') }}"
                               alt="arrowDown"></span>
                </a>
                <div x-show="show" x-transition.origin.top.duration.200ms
                     class="shadow-md w-36 absolute left-0 top-9 rounded-lg bg-gray-200 bg-opacity-75 text-black">
                    <ul>
                        <li>
                            <a href="{{ route('language.change', 'en') }}"
                               class="text-left px-4 p-3 transition duration-150 ease-in hover:bg-gray-300 rounded w-full block">
                                English
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('language.change', 'ka') }}"
                               class="text-left px-4 p-3 transition duration-150 ease-in hover:bg-gray-300 rounded w-full block">
                                ქართული
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
@endif

{{ $slot }}

<script src="{{ asset('js/app.js') }}"></script>
<livewire:scripts/>
</body>

</html>
