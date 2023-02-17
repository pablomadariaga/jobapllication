@props(['label' => '', 'inline' => false, 'rules' => ''])
@php
$id = $attributes->has('id') ? $attributes->get('id') : 'input'.rand(1, 999999999999);
@endphp
@if ($label)
<x-label for="{{$id}}" :inline="$inline">{{$label}}</x-label>
@endif
<input id="{{$id}}" data-rules="[{{$rules ?? ''}}]" @if ($attributes->has('name') && trim($attributes->get('name'))!=
'')
data-server-errors="[@error($attributes->get('name'))'{{str($message)->ucFirst()->__toString()}}'@enderror]"
x-bind:class="{'invalid':{{$attributes->get('name')}}.errorMessage && {{$attributes->get('name')}}.blurred}"
@endif
{{$attributes->merge(['autocomplete' => 'off',
'class' => 'placeholder-neutral-400 dark:bg-neutral-800 dark:text-neutral-400
dark:placeholder-neutral-500 border border-neutral-300 focus:ring-amber-500 focus:border-amber-500
dark:border-neutral-600 form-input w-full sm:text-sm rounded-md transition ease-in-out duration-100
focus:outline-none shadow-sm bg-opacity-60 dark:bg-opacity-50 '.($inline ? 'inline-block' : 'block')])}}>
@if ($attributes->has('name') && trim($attributes->get('name'))!= '')
<p x-show="{{$attributes->get('name')}}.errorMessage && {{$attributes->get('name')}}.blurred"
    x-transition.opacity.duration.300ms x-text="{{$attributes->get('name')}}.errorMessage" class="error-message">
@endif
