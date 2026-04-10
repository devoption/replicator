@props([
    'title' => null,
    'subtitle' => null,
])

<section {{ $attributes->class(['rounded-md bg-panel px-5 py-5']) }}>
    @if ($title || $subtitle)
        <header class="space-y-1">
            @if ($title)
                <h2 class="text-base font-semibold text-copy">{{ $title }}</h2>
            @endif

            @if ($subtitle)
                <p class="text-sm text-muted">{{ $subtitle }}</p>
            @endif
        </header>
    @endif

    {{ $slot }}
</section>
