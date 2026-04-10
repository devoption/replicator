<?php

use App\Models\Idea;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('promotes an idea draft into a proposed project', function (): void {
    $user = User::factory()->create();
    $idea = Idea::factory()->for($user)->create([
        'title' => 'Reduce proposal friction',
        'summary' => 'Help the team shape rough thoughts.',
        'details' => 'Give the owner a way to sharpen an idea before sharing it.',
    ]);

    $this->actingAs($user)
        ->post(route('ideas.propose', $idea))
        ->assertRedirect(route('ideas.edit', $idea));

    $project = Project::query()->sole();

    expect($project->idea->is($idea))->toBeTrue()
        ->and($project->user->is($user))->toBeTrue()
        ->and($project->status)->toBe('proposed')
        ->and($project->title)->toBe($idea->title)
        ->and($project->summary)->toBe($idea->summary);
});

it("prevents another user from proposing someone else's draft", function (): void {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $idea = Idea::factory()->for($owner)->create();

    $this->actingAs($intruder)
        ->post(route('ideas.propose', $idea))
        ->assertForbidden();
});
