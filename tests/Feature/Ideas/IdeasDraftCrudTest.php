<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lets an authenticated user create a private idea draft', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('ideas.store'), [
            'title' => 'Reduce proposal friction',
            'summary' => 'Capture rough thoughts before discussion.',
            'details' => 'We need a private place to work through scope before sharing.',
        ])
        ->assertRedirect();

    $idea = Idea::query()->sole();

    expect($idea->user->is($user))->toBeTrue()
        ->and($idea->shared_at)->toBeNull()
        ->and($idea->title)->toBe('Reduce proposal friction');
});

it('lets the owner edit and update an idea draft', function (): void {
    $user = User::factory()->create();
    $idea = Idea::factory()->for($user)->create([
        'title' => 'Capture smaller ideas',
        'summary' => 'Keep a draft queue.',
        'details' => 'Drafts should stay private until they are ready.',
    ]);

    $this->actingAs($user)
        ->get(route('ideas.edit', $idea))
        ->assertSuccessful()
        ->assertSee('Capture smaller ideas', false);

    $this->actingAs($user)
        ->put(route('ideas.update', $idea), [
            'title' => 'Capture sharper ideas',
            'summary' => 'Keep a private draft queue.',
            'details' => 'Drafts should stay private until the author is ready.',
        ])
        ->assertRedirect(route('ideas.edit', $idea));

    $idea->refresh();

    expect($idea->title)->toBe('Capture sharper ideas')
        ->and($idea->summary)->toBe('Keep a private draft queue.');
});

it('prevents another user from editing or deleting an idea draft', function (): void {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $idea = Idea::factory()->for($owner)->create();

    $this->actingAs($intruder)
        ->get(route('ideas.edit', $idea))
        ->assertForbidden();

    $this->actingAs($intruder)
        ->put(route('ideas.update', $idea), [
            'title' => 'Unauthorized change',
            'summary' => 'Should be blocked.',
            'details' => 'This request should not pass.',
        ])
        ->assertForbidden();

    $this->actingAs($intruder)
        ->delete(route('ideas.destroy', $idea))
        ->assertForbidden();
});

it('allows the owner to delete a draft', function (): void {
    $user = User::factory()->create();
    $idea = Idea::factory()->for($user)->create();

    $this->actingAs($user)
        ->delete(route('ideas.destroy', $idea))
        ->assertRedirect(route('ideas.index'));

    expect(Idea::query()->count())->toBe(0);
});
