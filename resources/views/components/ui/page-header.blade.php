@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'actions' => null,
])

<header {{ $attributes->class(['space-y-3']) }}>
    @if ($eyebrow)
        <p class="text-sm font-medium uppercase text-muted">{{ $eyebrow }}</p>
    @endif

    @if ($title)
        <h1 class="max-w-3xl text-3xl font-semibold text-copy">{{ $title }}</h1>
    @endif

    @if ($description)
        <p class="max-w-3xl text-base leading-7 text-muted">{{ $description }}</p>
    @endif

    @if ($actions)
        <div class="flex flex-wrap items-center gap-3">
            {{ $actions }}
        </div>
    @endif
</header>
