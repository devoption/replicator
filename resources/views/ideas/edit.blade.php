@php
    $toolbarItems = [
        [
            'label' => 'Ideas',
            'href' => route('ideas.index'),
            'current' => true,
            'icon' => 'heroicon-o-light-bulb',
        ],
        [
            'label' => 'Planning',
            'href' => route('planning.index'),
            'icon' => 'heroicon-o-clipboard-document-list',
        ],
        [
            'label' => 'Development',
            'href' => route('development.index'),
            'icon' => 'heroicon-o-code-bracket-square',
        ],
        [
            'label' => 'Testing',
            'href' => route('testing.index'),
            'icon' => 'heroicon-o-beaker',
        ],
        [
            'label' => 'Security',
            'href' => route('security.index'),
            'icon' => 'heroicon-o-shield-check',
        ],
        [
            'label' => 'Ops',
            'href' => route('ops.index'),
            'icon' => 'heroicon-o-command-line',
        ],
    ];

    $contextItems = [
        [
            'label' => 'Inbox',
            'href' => route('ideas.index'),
            'icon' => 'heroicon-o-inbox-stack',
        ],
        [
            'label' => 'Drafts',
            'href' => route('ideas.index'),
            'current' => true,
            'icon' => 'heroicon-o-pencil-square',
        ],
        [
            'label' => 'Shared',
            'href' => route('ideas.index'),
            'icon' => 'heroicon-o-users',
        ],
        [
            'label' => 'Proposals',
            'href' => route('ideas.index'),
            'icon' => 'heroicon-o-rocket-launch',
        ],
    ];
@endphp

<x-layouts.app-shell
    title="Edit idea"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Ideas"
            :title="$idea->title"
            description="Refine the draft without making it public."
        />

        <x-ui.panel class="max-w-3xl" title="Edit draft">
            @include('ideas._form', [
                'action' => route('ideas.update', $idea),
                'method' => 'PUT',
                'submitLabel' => 'Update draft',
                'cancelHref' => route('ideas.index'),
                'idea' => $idea,
            ])
            <div class="mt-6 flex items-center justify-between gap-4 border-t border-main/70 pt-6">
                <p class="text-sm text-muted">
                    Ask the local model to refine the current draft context.
                </p>
                <div class="flex items-center gap-3">
                    <form method="POST" action="{{ route('ideas.refine', $idea) }}">
                        @csrf
                        <x-ui.button variant="secondary" type="submit">Refine with AI</x-ui.button>
                    </form>

                    <form method="POST" action="{{ route('ideas.propose', $idea) }}">
                        @csrf
                        <x-ui.button type="submit">Propose project</x-ui.button>
                    </form>
                </div>
            </div>
        </x-ui.panel>

        @if (session('proposedProjectId'))
            <x-ui.panel class="max-w-3xl" title="Project created">
                <p class="text-sm text-muted">
                    This draft was promoted to a proposed project and linked back to the source idea.
                </p>
            </x-ui.panel>
        @endif

        @if (session()->has('ideaRefinement'))
            @php($ideaRefinement = session('ideaRefinement'))
            <x-ui.panel class="max-w-3xl" title="AI refinement">
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <p class="text-xs font-medium uppercase text-muted">Problem</p>
                        <p class="mt-2 text-sm leading-6 text-copy">{{ $ideaRefinement['problem'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase text-muted">Users</p>
                        <p class="mt-2 text-sm leading-6 text-copy">{{ $ideaRefinement['users'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase text-muted">Outcomes</p>
                        <p class="mt-2 text-sm leading-6 text-copy">{{ $ideaRefinement['outcomes'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase text-muted">Scope gaps</p>
                        <p class="mt-2 text-sm leading-6 text-copy">{{ $ideaRefinement['scope_gaps'] }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-xs font-medium uppercase text-muted">Follow-up questions</p>
                    <p class="mt-2 text-sm leading-6 text-copy">{{ $ideaRefinement['follow_up_questions'] }}</p>
                </div>
            </x-ui.panel>
        @endif

        <x-ui.panel class="max-w-3xl" title="Delete draft">
            <form method="POST" action="{{ route('ideas.destroy', $idea) }}">
                @csrf
                @method('DELETE')
                <p class="text-sm text-muted">
                    Deleting removes the private draft and its notes.
                </p>
                <div class="mt-4">
                    <x-ui.button variant="secondary" type="submit">Delete draft</x-ui.button>
                </div>
            </form>
        </x-ui.panel>
    </div>
</x-layouts.app-shell>
