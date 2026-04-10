<?php

namespace App\Ai\Agents\Ideas;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

#[Provider('ollama')]
#[Model('llama3.1')]
class IdeaRefinementAgent implements Agent, Conversational, HasStructuredOutput, HasTools
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<'TEXT'
You refine private idea drafts for a software factory.

Keep the output focused on the draft owner's context only.
Do not invent implementation details.
Return concise, actionable refinement data around:
- problem statement
- target users
- expected outcomes
- scope gaps
- follow-up questions
TEXT;
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }

    /**
     * Get the agent's structured output schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'problem' => $schema->string()->required(),
            'users' => $schema->string()->required(),
            'outcomes' => $schema->string()->required(),
            'scope_gaps' => $schema->string()->required(),
            'follow_up_questions' => $schema->string()->required(),
        ];
    }
}
