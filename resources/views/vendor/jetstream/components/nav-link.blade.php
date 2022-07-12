@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-green-500 text-sm font-medium leading-5 text-white focus:outline-none focus:border-green-500 transition'
            : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-white hover:text-green-500 hover:border-green-500 focus:outline-none focus:text-green-500 focus:border-green-500 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
