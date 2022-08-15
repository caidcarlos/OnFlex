@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-[#00f2a1] text-sm font-medium leading-5 text-white focus:outline-none focus:border-[#00f2a1] transition'
            : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-white hover:text-[#00f2a1] hover:border-[#00f2a1] focus:outline-none focus:text-[#00f2a1] focus:border-[#00f2a1] transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
