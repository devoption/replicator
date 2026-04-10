<?php

use App\Livewire\StatusPing;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

it('renders the livewire smoke component', function () {
    Livewire::test(StatusPing::class)
        ->assertSee('Livewire ready')
        ->assertSeeHtml('svg');
});

it('renders heroicons in blade views', function () {
    $markup = Blade::render('<x-heroicon-o-light-bulb class="size-5" />');

    expect($markup)
        ->toContain('<svg')
        ->toContain('size-5');
});
