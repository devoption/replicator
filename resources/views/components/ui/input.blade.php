@props([
    'label' => null,
    'error' => null,
])

@php
    $fieldClasses = 'block w-full rounded-md border-0 bg-main px-3 py-2 text-sm text-copy shadow-none ring-1 ring-inset ring-transparent transition placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-accent';
@endphp

<label class="block space-y-2">
    @if ($label)
        <span class="text-sm font-medium text-copy">{{ $label }}</span>
    @endif

    <input {{ $attributes->class([$fieldClasses]) }}>

    @if ($error)
        <span class="text-sm text-red-500">{{ $error }}</span>
    @endif
</label>
