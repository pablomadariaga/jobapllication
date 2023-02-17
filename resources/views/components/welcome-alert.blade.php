<div class="fixed bottom-4 right-4 overflow-hidden dark:text-neutral-200 z-50 pt-7 px-6 pb-4 dark:bg-neutral-900
    max-w-75 sm:max-w-sm md:max-w-md w-full rounded-lg shadow-lg bg-gradient-to-tr bg-opacity-90 border-t-4
    border-amber-600 bg-neutral-50" x-data="{'loading':false}" x-init="ready(() => {
        setTimeout(()=>{
            loading = true
        },1000)
    });" x-show="loading" x-transition.opacity.duration.400ms x-transition:leave.opacity.duration.600ms
    style="display: none;">
    <x-icon.x-circle @click="loading=false" class="w-6 h-6 absolute right-2 top-2 cursor-pointer"></x-icon.x-circle>
    {{__("Hi, I'm Hugo Rosas General Manager of Azul Maya Inc. Send me your job application and I will contact you as soon as possible.")}}
</div>
