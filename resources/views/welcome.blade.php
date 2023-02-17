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
    <link rel="preconnect" href="https://thepineappletequila.com" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-display: optional
        }
    </style>
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'}
    </script>
    <script src="{{ asset('js/utils.js') }}?v={{config('app.version')}}" defer></script>
    @vite(['resources/css/app.css', 'resources/css/tippy.css', /* 'resources/css/select.css', */ 'resources/js/app.js'])
</head>

<body x-data="app" class="font-sans antialiased overflow-x-hidden" :class="{'dark': dark, 'overflow-hidden': loading}" >
    <x-loading :companies="$companies"></x-loading>
    <x-welcome-alert></x-welcome-alert>
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
            <form x-data="form" x-bind="events" id="application-form" method="POST" action="{{ route('application') }}"
                autocomplete="off">
                @csrf
                <div class="flex flex-wrap mb-4  space-x-3 justify-between font-semibold">
                    <h1 class="text-2xl dark:text-neutral-50">
                        {{__('Application for employment')}}
                    </h1>
                    <h2>
                        {{__('Equal opportunity employer')}}
                    </h2>
                </div>
                {{-- Personal information --}}
                <hr class="border-amber-600 mb-2">
                <h3 class="font-semibold mb-2">{{__('Personal information')}}</h3>
                <hr class="border-amber-600 mb-4">
                <div class="2xs:grid 2xs:grid-cols-12 lg:grid-cols-11 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input rules="'required','minLength:2'" label="{{__('First name')}}" type="text"
                            name="first_name" value="{{old('first_name') ?? ''}}" id="first_name" maxlength="100" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input rules="'required','minLength:2'" label="{{__('Last name')}}" type="text"
                            name="last_name" value="{{old('last_name') ?? ''}}" id="last_name" maxlength="100" />
                    </div>
                    {{-- <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3">
                        <x-input label="{{__('Social security No°')}}" type="tel" name="social_security"
                            value="{{old('social_security') ?? ''}}" id="social_security" class="only-digits"
                            maxlength="30" />
                    </div> --}}
                </div>
                {{-- Present location --}}
                <hr class="border-amber-600 mb-4 opacity-30">
                <div class="2xs:grid 2xs:grid-cols-12 lg:grid-cols-11 2xs:gap-x-6" x-data="{
                        present_state: '{{old('present_state') ?? ''}}',
                    }">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-8 lg:col-span-5">
                        <x-input rules="'required','minLength:10'" label="{{__('Present address')}}" type="text"
                            name="present_address" value="{{old('present_address') ?? ''}}" id="present_address"
                            maxlength="255" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3">
                        <x-input rules="'required','minLength:3'" label="{{__('State')}}" type="text"
                            name="present_state" value="{{old('present_state') ?? ''}}" id="present_state"
                            maxlength="100" />
                        {{-- <x-select rules="'required'" label="{{__('State')}}" route="{{ route('states') }}" val="id"
                            text="name" x-model="present_state" name="present_state"
                            x-on:change="changeSelect('present_city')" value="{{old('present_state') ?? ''}}"
                            id="present_state">
                        </x-select> --}}
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3"
                        {{-- x-bind:class="{'disabled': !present_state }" --}}>
                        <x-input rules="'required','minLength:3'" label="{{__('City')}}" type="text"
                            name="present_city" value="{{old('present_city') ?? ''}}" id="present_city"
                            maxlength="100" />
                        {{-- <x-select rules="'required'" label="{{__('City')}}" route="{{ route('cities') }}" val="id"
                            text="name" name="present_city" extra="present_state" value="{{old('present_city') ?? ''}}"
                            id="present_city">
                        </x-select> --}}
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3">
                        <x-input rules="'required','minLength:4'" label="{{__('ZIP Code')}}" class="only-digits"
                            type="tel" name="present_zip" value="{{old('present_zip') ?? ''}}" id="present_zip"
                            maxlength="20" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3">
                        <x-input rules="'required','minLength:4'" label="{{__('Phone')}}" class="only-digits" type="tel"
                            name="present_phone" value="{{old('present_phone') ?? ''}}" id="present_phone"
                            maxlength="20" />
                    </div>
                </div>
                {{-- Permanent location --}}
                {{-- <hr class="border-amber-600 mb-4 opacity-30">
                <div class="2xs:grid 2xs:grid-cols-12 lg:grid-cols-11 2xs:gap-x-6" x-data="{
                        permanent_state: '{{old('present_state') ?? ''}}'
                }">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-8 lg:col-span-5">
                        <x-input rules="'required','minLength:10'" label="{{__('Permanent address')}}" type="text"
                            name="permanent_address" value="{{old('permanent_address') ?? ''}}" id="permanent_address"
                            maxlength="255" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3">
                        <x-select rules="'required'" label="{{__('State')}}" route="{{ route('states') }}" val="id"
                            text="name" x-model="permanent_state" name="permanent_state"
                            x-on:change="changeSelect('permanent_city')" value="{{old('permanent_state') ?? ''}}"
                            id="permanent_state">
                        </x-select>
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3"
                        x-bind:class="{'disabled': !permanent_state }">
                        <x-select rules="'required'" label="{{__('City')}}" route="{{ route('cities') }}" val="id"
                            text="name" name="permanent_city" extra="permanent_state"
                            value="{{old('permanent_city') ?? ''}}" id="permanent_city">
                        </x-select>

                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3">
                        <x-input rules="'required','minLength:4'" label="{{__('ZIP Code')}}" class="only-digits"
                            type="tel" name="permanent_zip" value="{{old('permanent_zip') ?? ''}}" id="permanent_zip"
                            maxlength="20" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-3">
                        <x-input rules="'required','minLength:4'" label="{{__('Phone')}}" class="only-digits" type="tel"
                            name="permanent_phone" value="{{old('permanent_phone') ?? ''}}" id="permanent_phone"
                            maxlength="20" />
                    </div>
                </div>
                --}}
                <hr class="border-amber-600 mb-4 opacity-30">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6">
                        <x-input rules="'required','email'" label="{{__('Email address')}}" class="only-email"
                            type="email" name="email" value="{{old('email') ?? ''}}" id="email" maxlength="255" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6">
                        <x-input label="{{__('Referred by')}}" type="text" name="referred_by"
                            value="{{old('referred_by') ?? ''}}" id="referred_by" maxlength="255" />
                    </div>
                </div>

                {{-- Employment desired --}}
                <hr class="border-amber-600 mb-2">
                <h3 class="font-semibold mb-2">{{__('Employment desired')}}</h3>
                <hr class="border-amber-600 mb-4">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input rules="'required','minLength:3'" label="{{__('Position')}}" type="text" name="position"
                            value="{{old('position') ?? ''}}" id="postion" maxlength="255" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input rules="'required'" label="{{__('Date you can start')}}" type="date" name="start_date"
                            value="{{old('start_date') ?? ''}}" id="start_date" min="{{date('Y-m-d')}}" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-label>{{__('Are you employed now?')}}</x-label>
                        <div class="flex flex-wrap space-x-3 mt-1.5">
                            <x-input.radio label="{{__('Yes')}}" name="employed" id="employed_1" value="1" checked="{{old('employed')==1}}"/>
                            <x-input.radio label="{{__('No')}}" name="employed" id="employed_2" value="0" checked="{{old('employed')!=1}}"/>
                        </div>
                        @error('employed')
                        <p class="error-message">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-label>{{__('Ever applied to this company before?')}}</x-label>
                        <div class="flex flex-wrap space-x-3 mt-1.5">

                            <x-input.radio label="{{__('Yes')}}" name="applied" id="applied_1" value="1" checked="{{old('applied')==1}}"/>
                            <x-input.radio label="{{__('No')}}" name="applied" id="applied_2" value="0" checked="{{old('applied')!=1}}"/>
                        </div>
                        @error('applied')
                        <p class="error-message">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input label="{{__('Where?')}}" type="text" name="where_apply"
                            value="{{old('where_apply') ?? ''}}" id="where_apply" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input label="{{__('When?')}}" type="text" name="when_apply"
                            value="{{old('when_apply') ?? ''}}" id="when_apply" />
                    </div>
                </div>

                {{-- Education --}}
                {{-- <hr class="border-amber-600 mb-2">
                <h3 class="font-semibold mb-2">{{__('Education')}}</h3>
                <hr class="border-amber-600 mb-4">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-8 lg:col-span-4">
                        <x-input label="{{__('High school')}}" type="text" name="high_school"
                            value="{{old('high_school') ?? ''}}" id="high_school" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-2">
                        <x-label>{{__('Did you graduate?')}}</x-label>
                        <div class="flex flex-wrap space-x-3 mt-1.5">
                            <x-input.radio label="{{__('Yes')}}" name="high_school_graduate" id="high_school_graduate_1"
                                value="1" />
                            <x-input.radio label="{{__('No')}}" name="high_school_graduate" id="high_school_graduate_2"
                                value="0" />
                        </div>
                        @error('high_school_graduate')
                        <p class="error-message">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-6 2xs:col-span-12 lg:col-span-6">
                        <x-input label="{{__('Subjects studied')}}" type="text" name="high_school_subjects_studied"
                            value="{{old('high_school_subjects_studied') ?? ''}}" id="high_school_subjects_studied" />
                    </div>
                </div>
                <hr class="border-amber-600 mb-4 opacity-30">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-8 lg:col-span-4">
                        <x-input label="{{__('College')}}" type="text" name="college" value="{{old('college') ?? ''}}"
                            id="college" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-2">
                        <x-label>{{__('Did you graduate?')}}</x-label>
                        <div class="flex flex-wrap space-x-3 mt-1.5">
                            <x-input.radio label="{{__('Yes')}}" name="college_graduate" id="college_graduate_1"
                                value="1" />
                            <x-input.radio label="{{__('No')}}" name="college_graduate" id="college_graduate_2"
                                value="0" />
                        </div>
                        @error('college_graduate')
                        <p class="error-message">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-6 2xs:col-span-12 lg:col-span-6">
                        <x-input label="{{__('Subjects studied')}}" type="text" name="college_subjects_studied"
                            value="{{old('college_subjects_studied') ?? ''}}" id="college_subjects_studied" />
                    </div>
                </div>
                <hr class="border-amber-600 mb-4 opacity-30">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-8 lg:col-span-4">
                        <x-input label="{{__('Trade, business, or correspondence school')}}" type="text"
                            name="trade_school" value="{{old('trade_school') ?? ''}}" id="trade_school" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-4 lg:col-span-2">
                        <x-label>{{__('Did you graduate?')}}</x-label>
                        <div class="flex flex-wrap space-x-3 mt-1.5">
                            <x-input.radio label="{{__('Yes')}}" name="trade_school_graduate"
                                id="trade_school_graduate_1" value="1" />
                            <x-input.radio label="{{__('No')}}" name="trade_school_graduate"
                                id="trade_school_graduate_2" value="0" />
                        </div>
                    </div>
                    <div class="mb-6 2xs:col-span-12 lg:col-span-6">
                        <x-input label="{{__('Subjects studied')}}" type="text" name="trade_school_subjects_studied"
                            value="{{old('trade_school_subjects_studied') ?? ''}}" id="trade_school_subjects_studied" />
                    </div>
                </div> --}}
                {{-- General information --}}
                {{-- <hr class="border-amber-600 mb-2">
                <h3 class="font-semibold mb-2">{{__('General information')}}</h3>
                <hr class="border-amber-600 mb-4">
                <div class="2xs:grid 2xs:grid-cols-12 lg:grid-cols-11 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12">
                        <x-input label="{{__('Subjects of special study or research work')}}" type="text"
                            name="special_study" value="{{old('special_study') ?? ''}}" id="special_study" />
                    </div>
                    <div class="mb-6 2xs:col-span-12">
                        <x-input label="{{__('Special training')}}" type="text" name="special_training"
                            value="{{old('special_training') ?? ''}}" id="special_training" />
                    </div>
                    <div class="mb-6 2xs:col-span-12">
                        <x-input label="{{__('Special skills')}}" type="text" name="special_skills"
                            value="{{old('special_skills') ?? ''}}" id="special_skills" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6">
                        <x-input label="{{__('U.S Military service')}}" type="text" name="military"
                            value="{{old('military') ?? ''}}" id="military" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6">
                        <x-input label="{{__('Rank')}}" type="text" name="rank" value="{{old('rank') ?? ''}}"
                            id="rank" />
                    </div>
                </div>
                <input type="hidden" x-model="selectedCompany" name="company_id" id="company_id"> --}}
                {{-- Former employers --}}
                <hr class="border-amber-600 mb-2">
                <h3 class="font-semibold mb-2">{{__('Former employers')}}</h3>
                <hr class="border-amber-600 mb-4">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-label>{{__('From')}}</x-label>
                        <div class="grid grid-cols-2 space-x-3">
                            <div class="col-span-1">
                                <x-input label="{{__('Year')}}" :inline="true" type="number" inputmode="tel" min="1960"
                                    max="{{date('Y')}}" name="year_1" value="{{old('year_1') ?? ''}}" id="year_1" />
                            </div>
                            <div class="col-span-1">
                                <x-input label="{{__('Month')}}" :inline="true" type="number" inputmode="tel" min="01"
                                    max="12" name="month_1" value="{{old('month_1') ?? ''}}" id="month_1" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4 mt-auto">
                        <x-input label="{{__('Name')}}" type="text" name="name_1" value="{{old('name_1') ?? ''}}"
                            id="name_1" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4 mt-auto">
                        <x-input label="{{__('Phone')}}" type="tel" class="only-digits" name="phone_1"
                            value="{{old('phone_1') ?? ''}}" id="phone_1" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input label="{{__('Position')}}" type="text" name="position_1"
                            value="{{old('position_1') ?? ''}}" id="position_1" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 lg:col-span-8">
                        <x-input label="{{__('Reason for leaving')}}" type="text" name="reason_1"
                            value="{{old('reason_1') ?? ''}}" id="reason_1" />
                    </div>
                </div>
                <hr class="border-amber-600 mb-4 opacity-30">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-label>{{__('From')}}</x-label>
                        <div class="grid grid-cols-2 space-x-3">
                            <div class="col-span-1">
                                <x-input label="{{__('Year')}}" :inline="true" type="number" inputmode="tel" min="1960"
                                    max="{{date('Y')}}" name="year_2" value="{{old('year_2') ?? ''}}" id="year_2" />
                            </div>
                            <div class="col-span-1">
                                <x-input label="{{__('Month')}}" :inline="true" type="number" inputmode="tel" min="01"
                                    max="12" name="month_2" value="{{old('month_2') ?? ''}}" id="month_2" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4 mt-auto">
                        <x-input label="{{__('Name')}}" type="text" name="name_2" value="{{old('name_2') ?? ''}}"
                            id="name_2" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4 mt-auto">
                        <x-input label="{{__('Phone')}}" type="tel" class="only-digits" name="phone_2"
                            value="{{old('phone_2') ?? ''}}" id="phone_2" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input label="{{__('Position')}}" type="text" name="position_2"
                            value="{{old('position_2') ?? ''}}" id="position_2" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 lg:col-span-8">
                        <x-input label="{{__('Reason for leaving')}}" type="text" name="reason_2"
                            value="{{old('reason_2') ?? ''}}" id="reason_2" />
                    </div>
                </div>
                <hr class="border-amber-600 mb-4 opacity-30">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-label>{{__('From')}}</x-label>
                        <div class="grid grid-cols-2 space-x-3">
                            <div class="col-span-1">
                                <x-input label="{{__('Year')}}" :inline="true" type="number" inputmode="tel" min="1960"
                                    max="{{date('Y')}}" name="year_3" value="{{old('year_3') ?? ''}}" id="year_3" />
                            </div>
                            <div class="col-span-1">
                                <x-input label="{{__('Month')}}" :inline="true" type="number" inputmode="tel" min="01"
                                    max="12" name="month_3" value="{{old('month_3') ?? ''}}" id="month_3" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4 mt-auto">
                        <x-input label="{{__('Name')}}" type="text" name="name_3" value="{{old('name_3') ?? ''}}"
                            id="name_3" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4 mt-auto">
                        <x-input label="{{__('Phone')}}" type="tel" class="only-digits" name="phone_3"
                            value="{{old('phone_3') ?? ''}}" id="phone_3" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input label="{{__('Position')}}" type="text" name="position_3"
                            value="{{old('position_3') ?? ''}}" id="position_3" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 lg:col-span-8">
                        <x-input label="{{__('Reason for leaving')}}" type="text" name="reason_3"
                            value="{{old('reason_3') ?? ''}}" id="reason_3" />
                    </div>
                </div>
                <hr class="border-amber-600 mb-4 opacity-30">
                <div class="2xs:grid 2xs:grid-cols-12 2xs:gap-x-6">
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-label>{{__('From')}}</x-label>
                        <div class="grid grid-cols-2 space-x-3">
                            <div class="col-span-1">
                                <x-input label="{{__('Year')}}" :inline="true" type="number" inputmode="tel" min="1960"
                                    max="{{date('Y')}}" name="year_4" value="{{old('year_4') ?? ''}}" id="year_4" />
                            </div>
                            <div class="col-span-1">
                                <x-input label="{{__('Month')}}" :inline="true" type="number" inputmode="tel" min="01"
                                    max="12" name="month_4" value="{{old('month_4') ?? ''}}" id="month_4" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4 mt-auto">
                        <x-input label="{{__('Name')}}" type="text" name="name_4" value="{{old('name_4') ?? ''}}"
                            id="name_4" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4 mt-auto">
                        <x-input label="{{__('Phone')}}" type="tel" class="only-digits" name="phone_4"
                            value="{{old('phone_4') ?? ''}}" id="phone_4" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 sm:col-span-6 lg:col-span-4">
                        <x-input label="{{__('Position')}}" type="text" name="position_4"
                            value="{{old('position_4') ?? ''}}" id="position_4" />
                    </div>
                    <div class="mb-6 2xs:col-span-12 lg:col-span-8">
                        <x-input label="{{__('Reason for leaving')}}" type="text" name="reason_4"
                            value="{{old('reason_4') ?? ''}}" id="reason_4" />
                    </div>
                </div>
                <hr class="border-amber-600 mb-4 opacity-30">
                <div class="w-full mb-6">
                    <button @click="submit" type="button" class="outline-none inline-flex justify-center items-center transition-all ease-in group
                    duration-150 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80 font-semibold
                    disabled:cursor-not-allowed rounded gap-x-2 text-sm px-4 py-2 ring-amber-600 text-amber-600
                    border border-amber-600 hover:bg-amber-50dark:ring-offset-neutral-800 dark:hover:bg-neutral-700">
                        {{__('Submit application')}}
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ Vite::asset('resources/js/init-alpine.js')}}"></script>
</body>

</html>
