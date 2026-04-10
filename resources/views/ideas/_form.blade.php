@php
    $idea ??= null;
@endphp

<form method="POST" action="{{ $action }}" class="space-y-5">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <x-ui.input label="Title" name="title" :value="old('title', $idea?->title)" required />
    <x-ui.input label="Summary" name="summary" :value="old('summary', $idea?->summary)" required />
    <x-ui.textarea label="Details" name="details" rows="10" required :value="old('details', $idea?->details)" />

    <div class="flex items-center gap-3">
        <x-ui.button type="submit">{{ $submitLabel }}</x-ui.button>

        @if ($cancelHref)
            <a class="text-sm font-medium text-muted transition hover:text-copy" href="{{ $cancelHref }}">
                Cancel
            </a>
        @endif
    </div>
</form>
