@props(['inline'=>false])
<label {{$attributes}} class="{{$inline ? 'inline-block' : 'block'}} text-sm font-medium text-neutral-700 dark:text-neutral-200">
    {{$slot}}
</label>
