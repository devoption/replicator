@props([
    'label' => 'Menu',
])

<details {{ $attributes->class(['group relative']) }}>
    <summary class="list-none rounded-md bg-main px-3 py-2 text-sm font-medium text-copy marker:hidden">
        {{ $label }}
    </summary>

    <div class="absolute z-10 mt-2 min-w-48 rounded-md bg-panel p-2 shadow-none ring-1 ring-inset ring-black/5">
        {{ $slot }}
    </div>
</details>
