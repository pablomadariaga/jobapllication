@props(['companies' => []])
<div class="fixed inset-0 z-50 bg-neutral-900 transition-colors
    duration-300 text-neutral-300 bg-opacity-90 overflow-y-auto" x-trap="loading" x-init="
    ready(() => {
        setTimeout(()=>{
            @if ($companies)
            if(selectedCompany){
                loading = false;
            }else{
                company = true;
            }
            @else
            loading = false;
            @endif
        },1000)
    });" x-show="loading" x-transition.opacity.duration.400ms x-transition:leave.opacity.duration.1500ms>
    <div class="absolute inset-0" x-show="!company" x-transition.opacity.duration.400ms
        x-transition:leave.opacity.duration.500ms>
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 -mt-20 text-amber-500">
            <svg class="spinner w-52 sm:w-64 lg:w-96 xl:w-110 h-auto" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="1"></circle>
            </svg>
        </div>
        <div class="absolute z-10 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center">
            <x-application-logo class="w-52 sm:w-64 lg:w-96 xl:w-110 h-auto" />
            <p class="mt-2 md:text-lg xl:text-2xl">
                {{__('Loading')}}...
            </p>
        </div>
    </div>
    @if ($companies)
    <div class="flex min-h-screen" x-show="company" x-transition.opacity.duration.700ms
        x-transition:leave.opacity.duration.400ms style="display: none;">
        <div class="m-auto p-3 text-neutral-200 w-11/12">
            <div class="grid grid-cols-1 2xs:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6
                lg:gap-8 2xl:gap-10 place-content-center w-fit mx-auto">
                @foreach ($companies as $company)
                <button @click="selectedCompany = {{$company->id}}; loading = false;"
                    class="text-center p-3 md:p-6 xl:p-10 rounded-md group relative focus:outline-none">
                    <div class="left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0
                        w-20 sm:w-24 md:w-36 lg:w-40 xl:w-48 transition-all shadow
                        h-20 sm:h-24 md:h-36 lg:h-40 xl:h-48 rounded-full group-focus:opacity-30
                        group-hover:opacity-30 absolute" style="background-color: {{$company->color}}">
                    </div>
                    <div class="relative z-10">
                        <x-dynamic-component :component="'logo.'.$company->logo"
                            class="w-28 sm:w-26 md:w-44 lg:w-52 xl:w-64 h-auto mx-auto" />
                        <p class="mt-2 md:text-lg xl:text-2xl">
                            {{$company->name}}
                        </p>
                        <div class="h-0.5 transition-width group-hover:w-full w-0 duration-300
                            group-focus:w-full mx-auto" style="background-color: {{$company->color}}">
                        </div>
                    </div>
                </button>

                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
