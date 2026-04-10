@props([
    'name' => null,
    'initials' => null,
    'size' => 'md',
])

@php
    $sizeClasses = [
        'sm' => 'size-8 text-xs',
        'md' => 'size-10 text-sm',
        'lg' => 'size-12 text-base',
    ];
@endphp

<span {{ $attributes->class(['inline-flex items-center justify-center rounded-md bg-accent-soft font-medium text-accent-strong', $sizeClasses[$size] ?? $sizeClasses['md']]) }}>
    {{ $initials ?? \Illuminate\Support\Str::of((string) $name)->trim()->explode(' ')->filter()->take(2)->map(fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)))->implode('') ?: '?' }}
</span>
