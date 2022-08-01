@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-gray-700 bg-white focus:outline-none focus:text-gray-700 focus:bg-gray-700 focus:border-gray-400 transition'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-white hover:bg-gray-700 hover:border-gray-700 focus:outline-none focus:text-gray-700 focus:bg-green-400 focus:border-gray-700 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
