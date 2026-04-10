@props([
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $variantClasses = [
        'primary' => 'bg-accent text-white hover:bg-accent-strong',
        'secondary' => 'bg-main text-copy hover:bg-panel',
        'ghost' => 'bg-transparent text-copy hover:bg-main',
    ];

    $baseClasses = 'inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 text-sm font-medium transition-colors disabled:cursor-not-allowed disabled:opacity-50';
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->class([$baseClasses, $variantClasses[$variant] ?? $variantClasses['primary']]) }}
>
    {{ $slot }}
</button>
