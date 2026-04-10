<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the ideas workspace to authenticated users', function (): void {
    $user = User::factory()->create();

    Idea::factory()->for($user)->create([
        'title' => 'Shared search surface',
    ]);

    $this->actingAs($user)
        ->get(route('ideas.index'))
        ->assertSuccessful()
        ->assertSee('Shared search surface', false);
});

it('keeps ideas tied to their owner', function (): void {
    $user = User::factory()->create();
    $idea = Idea::factory()->for($user)->create();

    expect($idea->user->is($user))->toBeTrue();
});
