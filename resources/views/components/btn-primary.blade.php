@props(['tooltipId', 'tooltipMsg'])

<button type="button" @if (isset($tooltipId))
    data-tooltip-target="{{$tooltipId}}"
@endif {{ $attributes->merge(['class' => 'ti-btn dark:ti-btn ti-btn-outline-primary dark:ti-btn-primary-full ti-btn-wave font-bold uppercase text-xs mr-2']) }}>
    {{$slot}}
</button>

@if (isset($tooltipId))
    <div id="{{$tooltipId}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{$tooltipMsg}}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
@endif