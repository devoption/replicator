@props([
    'tone' => 'neutral',
])

@php
    $toneClasses = [
        'neutral' => 'bg-main text-muted',
        'accent' => 'bg-accent-soft text-accent-strong',
        'success' => 'bg-emerald-500/12 text-emerald-700 dark:text-emerald-300',
    ];
@endphp

<span {{ $attributes->class(['inline-flex items-center rounded-md px-2 py-1 text-xs font-medium', $toneClasses[$tone] ?? $toneClasses['neutral']]) }}>
    {{ $slot }}
</span>
