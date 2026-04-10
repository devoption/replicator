@props([
    'href',
    'label',
    'icon',
    'current' => false,
])

<a
    href="{{ $href }}"
    @class([
        'flex min-w-16 flex-col items-center gap-2 rounded-md px-2 py-3 text-center text-[0.7rem] transition-colors',
        'bg-white/12 text-white' => $current,
        'text-toolbar-muted hover:bg-white/8 hover:text-white' => ! $current,
    ])
>
    <span class="flex size-9 items-center justify-center rounded-md bg-white/8">
        <x-dynamic-component :component="$icon" class="size-5" />
    </span>
    <span>{{ $label }}</span>
</a>
