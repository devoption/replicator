<?php

use Illuminate\Support\Facades\Blade;

it('renders the shared button component', function (): void {
    $rendered = Blade::render('<x-ui.button>Save</x-ui.button>');

    expect($rendered)->toContain('type="button"');
    expect($rendered)->toContain('Save');
});

it('renders the shared form controls', function (): void {
    $rendered = Blade::render(<<<'BLADE'
        <x-ui.input label="Name" />
        <x-ui.textarea label="Summary"></x-ui.textarea>
        <x-ui.select label="State">
            <option>Draft</option>
        </x-ui.select>
        BLADE);

    expect($rendered)->toContain('Name');
    expect($rendered)->toContain('Summary');
    expect($rendered)->toContain('State');
});

it('renders the shared display primitives', function (): void {
    $rendered = Blade::render('<x-ui.badge tone="accent">Draft</x-ui.badge><x-ui.avatar initials="TO" />');

    expect($rendered)->toContain('Draft');
    expect($rendered)->toContain('TO');
});

it('renders the shared avatar fallback from a name', function (): void {
    $rendered = Blade::render('<x-ui.avatar name="Taylor Otwell" />');

    expect($rendered)->toContain('TO');
});
