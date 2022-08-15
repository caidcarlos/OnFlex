@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-[#00f2a1] text-base font-medium text-[#303c4e] bg-white focus:outline-none focus:text-[#3030c4e] focus:bg-[#303c4e] focus:border-gray-400 transition'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-white hover:bg-[#303c4e] hover:border-[#303c4e] focus:outline-none focus:text-[#303c4e] focus:bg-[#00f2a1] focus:border-[#303c4e] transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
