@props([
    'title' => null,
])

<div {{ $attributes->class(['rounded-md bg-panel p-5']) }}>
    @if ($title)
        <h2 class="text-base font-semibold text-copy">{{ $title }}</h2>
    @endif

    <div class="mt-4">
        {{ $slot }}
    </div>
</div>
