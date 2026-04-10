<?php

use App\Ai\Agents\Ideas\IdeaRefinementAgent;
use App\Models\Idea;
use App\Models\User;
use App\Services\Ideas\IdeaRefinementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Ai\Ai;

uses(RefreshDatabase::class);

it('refines a private idea draft through the local ai agent', function (): void {
    $user = User::factory()->create();
    $idea = Idea::factory()->for($user)->create([
        'title' => 'Reduce proposal friction',
        'summary' => 'Help the team shape rough thoughts.',
        'details' => 'Give the owner a way to sharpen an idea before sharing it.',
    ]);

    Ai::fakeAgent(IdeaRefinementAgent::class, [[
        'problem' => 'The team needs a faster way to shape raw ideas.',
        'users' => 'Product and engineering leads.',
        'outcomes' => 'Clearer proposals and less back-and-forth.',
        'scope_gaps' => 'No explicit decision criteria yet.',
        'follow_up_questions' => 'What approval threshold should apply?',
    ]]);

    $service = app(IdeaRefinementService::class);
    $refinement = $service->refine($idea);

    expect($refinement)->toMatchArray([
        'problem' => 'The team needs a faster way to shape raw ideas.',
        'users' => 'Product and engineering leads.',
        'outcomes' => 'Clearer proposals and less back-and-forth.',
        'scope_gaps' => 'No explicit decision criteria yet.',
        'follow_up_questions' => 'What approval threshold should apply?',
    ]);

    Ai::assertAgentWasPrompted(
        IdeaRefinementAgent::class,
        fn ($prompt): bool => str_contains($prompt->prompt, $idea->title)
            && str_contains($prompt->prompt, $idea->summary)
            && str_contains($prompt->prompt, $idea->details)
    );
});

it('returns refinement data to the owner on the edit screen', function (): void {
    $user = User::factory()->create();
    $idea = Idea::factory()->for($user)->create();

    $this->instance(IdeaRefinementService::class, mock(IdeaRefinementService::class, function ($mock): void {
        $mock->shouldReceive('refine')
            ->once()
            ->andReturn([
                'problem' => 'The team needs a faster way to shape raw ideas.',
                'users' => 'Product and engineering leads.',
                'outcomes' => 'Clearer proposals and less back-and-forth.',
                'scope_gaps' => 'No explicit decision criteria yet.',
                'follow_up_questions' => 'What approval threshold should apply?',
            ]);
    }));

    $this->actingAs($user)
        ->post(route('ideas.refine', $idea))
        ->assertRedirect(route('ideas.edit', $idea));

    $this->withSession([
        'ideaRefinement' => [
            'problem' => 'The team needs a faster way to shape raw ideas.',
            'users' => 'Product and engineering leads.',
            'outcomes' => 'Clearer proposals and less back-and-forth.',
            'scope_gaps' => 'No explicit decision criteria yet.',
            'follow_up_questions' => 'What approval threshold should apply?',
        ],
    ])->get(route('ideas.edit', $idea))
        ->assertSee('AI refinement', false)
        ->assertSee('The team needs a faster way to shape raw ideas.', false);
});
