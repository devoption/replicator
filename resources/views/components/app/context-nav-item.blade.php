@props([
    'href',
    'label',
    'icon',
    'current' => false,
])

<a
    href="{{ $href }}"
    @class([
        'flex items-center gap-3 rounded-md px-3 py-2.5 text-sm transition-colors',
        'bg-main font-medium text-copy' => $current,
        'text-muted hover:bg-main hover:text-copy' => ! $current,
    ])
>
    <span class="flex size-8 items-center justify-center rounded-md bg-main text-muted">
        <x-dynamic-component :component="$icon" class="size-4" />
    </span>
    <span>{{ $label }}</span>
</a>
