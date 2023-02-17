{{-- @props(['label' => '', 'route' => '', 'text' => 'description', 'val' => 'id', 'rules' => '','extra' => ''])
@php
$id = $attributes->has('id') ? $attributes->get('id') : 'select'.rand(1, 999999999999)
@endphp
@if ($label)
<x-label for="{{$id}}">{{$label}}</x-label>
@endif
<div class="w-full block "
    x-data="select('{{$route}}','{{$text}}','{{$val}}', '{{old($attributes->get('name')) ?? ''}}', '{{$extra}}')"
    x-bind:class="{'invalid':{{$attributes->get('name')}}.errorMessage && {{$attributes->get('name')}}.blurred}">
    <select x-ref="select" id="{{$id}}" data-rules="[{{$rules ?? ''}}]" @if ($attributes->has('name') &&
        trim($attributes->get('name'))!='')
        data-server-errors="[@error($attributes->get('name'))'{{str($message)->ucFirst()->__toString()}}'@enderror]"
        x-bind:class="{'invalid':{{$attributes->get('name')}}.errorMessage && {{$attributes->get('name')}}.blurred}"
        @endif
        {{$attributes->merge(['class' =>
        'placeholder-neutral-400 dark:bg-neutral-800 dark:text-neutral-400 truncate '.
        'dark:placeholder-neutral-500 border border-neutral-300 focus:ring-amber-500 focus:border-amber-500 '.
        'dark:border-neutral-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 '.
        'focus:outline-none shadow-sm bg-opacity-60 dark:bg-opacity-50'])}}>
        {{$slot}}
    </select>
</div>
@if ($attributes->has('name') && trim($attributes->get('name'))!= '')
<p x-show="{{$attributes->get('name')}}.errorMessage && {{$attributes->get('name')}}.blurred"
    x-transition.opacity.duration.300ms x-text="{{$attributes->get('name')}}.errorMessage" class="error-message">
    @endif
 --}}
