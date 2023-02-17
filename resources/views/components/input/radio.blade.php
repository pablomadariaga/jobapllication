@props(['label' => ''])
@php
$id = $attributes->has('id') ? $attributes->get('id') : 'input'.rand(1, 999999999999)
@endphp
<x-label for="{{$id}}" class="flex items-center cursor-pointer">
    <input type="radio" id="{{$id}}" {{old($attributes->get('name'))==$attributes->get('value') ? 'checked' : ''}}
    {{$attributes->merge(['class'=>
    'form-radio rounded-full transition ease-in-out duration-100 '.
    'border-neutral-300 text-amber-600 focus:ring-amber-600 focus:border-amber-400 '.
    'dark:border-neutral-500 dark:checked:border-neutral-600 dark:focus:ring-neutral-600 '.
    'dark:focus:border-neutral-500 dark:bg-neutral-600 dark:text-neutral-600 '.
    'dark:focus:ring-offset-neutral-800 bg-opacity-60 dark:bg-opacity-50 mr-1'])}}>
    {{$label}}
</x-label>
