<?php

namespace App\Services\Ideas;

use App\Ai\Agents\Ideas\IdeaRefinementAgent;
use App\Models\Idea;
use Illuminate\Support\Arr;

class IdeaRefinementService
{
    /**
     * @return array{
     *     problem: string,
     *     users: string,
     *     outcomes: string,
     *     scope_gaps: string,
     *     follow_up_questions: string
     * }
     */
    public function refine(Idea $idea): array
    {
        $prompt = implode("\n\n", array_filter([
            'Refine this private idea draft for the owner only.',
            'Title: '.$idea->title,
            'Summary: '.$idea->summary,
            'Details: '.$idea->details,
        ]));

        $response = IdeaRefinementAgent::make()->prompt(
            $prompt,
            provider: 'ollama',
            model: config('ai.providers.ollama.model')
        );

        return Arr::only($response->toArray(), [
            'problem',
            'users',
            'outcomes',
            'scope_gaps',
            'follow_up_questions',
        ]);
    }
}
