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
            'href' => '#planning',
            'icon' => 'heroicon-o-clipboard-document-list',
        ],
        [
            'label' => 'Development',
            'href' => '#development',
            'icon' => 'heroicon-o-code-bracket-square',
        ],
        [
            'label' => 'Testing',
            'href' => '#testing',
            'icon' => 'heroicon-o-beaker',
        ],
        [
            'label' => 'Security',
            'href' => '#security',
            'icon' => 'heroicon-o-shield-check',
        ],
        [
            'label' => 'Ops',
            'href' => '#ops',
            'icon' => 'heroicon-o-command-line',
        ],
    ];

    $contextItems = [
        [
            'label' => 'Inbox',
            'href' => '#inbox',
            'icon' => 'heroicon-o-inbox-stack',
        ],
        [
            'label' => 'Drafts',
            'href' => '#drafts',
            'current' => true,
            'icon' => 'heroicon-o-pencil-square',
        ],
        [
            'label' => 'Shared',
            'href' => '#shared',
            'icon' => 'heroicon-o-users',
        ],
        [
            'label' => 'Proposals',
            'href' => '#proposals',
            'icon' => 'heroicon-o-rocket-launch',
        ],
    ];
@endphp

<x-layouts.app-shell
    title="Ideas"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Ideas"
            title="Capture rough thoughts before they become projects."
            description="This area is for quick notes, private drafting, and later proposal work."
        />

        <div class="grid gap-6 lg:grid-cols-[minmax(0,2fr)_minmax(18rem,1fr)]">
            <x-ui.panel title="Private drafts" subtitle="Start small and return when the thought is sharper.">
                <div class="space-y-3">
                    @forelse ($ideas as $idea)
                        <div class="rounded-md bg-main px-4 py-4">
                            <div class="flex items-start justify-between gap-4">
                                <div class="space-y-1">
                                    <h3 class="font-semibold text-copy">{{ $idea->title }}</h3>
                                    <p class="text-sm text-muted">{{ $idea->summary }}</p>
                                </div>
                                <x-ui.badge :tone="$idea->shared_at ? 'accent' : 'neutral'">
                                    {{ $idea->shared_at ? 'Shared' : 'Private' }}
                                </x-ui.badge>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-muted">No drafts yet. Capture the first rough thought when you are ready.</p>
                    @endforelse
                </div>
            </x-ui.panel>

            <x-ui.panel title="Next step" subtitle="This app will grow from capture into shared proposals.">
                <ul class="space-y-3 text-sm text-muted">
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-accent"></span>
                        Capture a quick note
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-accent"></span>
                        Return later and add more context
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-accent"></span>
                        Propose a draft when it is ready
                    </li>
                </ul>
            </x-ui.panel>
        </div>
    </div>
</x-layouts.app-shell>
