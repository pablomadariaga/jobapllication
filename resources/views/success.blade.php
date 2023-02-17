<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" value="{{old('viewport') ?? ''}}" content="width=device-width, initial-scale=1.0">
    <meta name="csrf- value=" {{old('csrf') ?? '' }}"token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel').(isset($header) ? ' - '.$header :'' ) }}</title>
    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#030505">
    <meta name="msapplication- value=" {{old('msapplication') ?? '' }}"TileColor" content="#030505">
    <meta name="msapplication- value=" {{old('msapplication') ?? '' }}"TileImage" content="/mstile-144x144.png">
    <meta name="theme- value=" {{old('theme') ?? '' }}"color" content="#030505">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'}
    </script>
    <script src="{{ asset('js/utils.js') }}?v={{config('app.version')}}" defer></script>
    @vite(['resources/css/app.css', 'resources/css/tippy.css', /* 'resources/css/select.css', */ 'resources/js/app.js'])
</head>

<body x-data="app" class="font-sans antialiased overflow-x-hidden" :class="{'dark': dark, 'overflow-hidden': loading}">
    <x-loading></x-loading>
    <div class="fixed inset-0 z-10 bg-app"></div>
    <div class="fixed inset-0 z-10 dark:bg-black dark:bg-opacity-50 transition-all"></div>
    <main class=" min-h-screen w-full p-6 md:p-8 xl:p-12 text-neutral-700 dark:text-neutral-300 relative z-20">
        <div class="rounded bg-white dark:bg-neutral-900 bg-opacity-80 dark:bg-opacity-80 px-5 py-2 flex flex-wrap
            space-x-3 justify-between mb-4">

            <span class="cursor-pointer" x-bind="toggleTheme">
                <x-icon.moon
                    class="w-5 h-5 focus:outline-none rounded-md focus:ring focus:ring-amber-500 focus:border-amber-500"
                    x-show="!dark" x-tooltip.raw="{{__('Activate dark mode')}}" style="display: none;" />
                <x-icon.sun
                    class="w-5 h-5 focus:outline-none rounded-md focus:ring focus:ring-amber-500 focus:border-amber-500"
                    x-show="dark" x-tooltip.raw="{{__('Disable dark mode')}}" />
            </span>

            <div class="flex flex-wrap">
                @foreach(array_values(config('locale.languages')) as $language)
                <a href="{{ route('changeLang', $language[0]) }}"
                    class="relative mx-2 font-semibold hover:text-amber-600">
                    <span x-tooltip="'{{ $language[3] }}'" class="mx-auto uppercase
                        @if ($language[0]===App::getLocale())
                            underline decoration-amber-500
                        @endif">{{
                        $language[0]
                        }}</span>
                </a>
                @endforeach
            </div>
        </div>
        <div class="rounded bg-white dark:bg-neutral-900 bg-opacity-80 dark:bg-opacity-80 p-5">
            <div class="flex flex-wrap mb-4  space-x-3 justify-between font-semibold">
                <h1 class="text-2xl dark:text-neutral-50">
                    {{__('Application for employment')}}
                </h1>
                <h2>
                    {{__('Dear')}} {{$user->first_name}}
                </h2>
            </div>
            <hr class="border-amber-600 mb-6">
            <div class="text-center mb-6">
                {{__("On behalf of the entire team, thank you so much for applying. Your resume has reached us without any problem.\nPlease note that we may receive many applications and it may take us some time to review them all, so it may take a few days for us to contact you. Do not be impatient!\nYou will receive news from us no matter what happens to inform you of your progress in the selection process. All the best!")}}
            </div>
            <hr class="border-amber-600 mb-6">
            <div class="text-center">
                <a href="{{ route('index') }}" class="outline-none inline-flex justify-center items-center transition-all ease-in group
                duration-150 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80 font-semibold
                disabled:cursor-not-allowed rounded gap-x-2 text-sm px-4 py-2 ring-amber-600 text-amber-600
                border border-amber-600 hover:bg-amber-50dark:ring-offset-neutral-800 dark:hover:bg-neutral-700">
                    {{__('Apply another person')}}
                </a>
            </div>
        </div>
    </main>
    <script src="{{ Vite::asset('resources/js/init-alpine.js')}}"></script>
</body>

</html>
