@php
    $toolbarItems = [
        [
            'label' => 'Ideas',
            'href' => '#ideas',
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
        [
            'label' => 'Admin',
            'href' => '#admin',
            'icon' => 'heroicon-o-cog-6-tooth',
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

<x-layouts.app-shell :title="config('app.name', 'Replicator')" :toolbar-items="$toolbarItems" :context-items="$contextItems">
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Workspace"
            title="Turn rough product thoughts into team-ready software proposals."
            description="This shell is the first pass at the shared product frame: app switcher on the left, context navigation beside it, and a main work area ready for ideas, planning, development, testing, security, ops, and admin tools."
        />

        <section class="grid gap-6 lg:grid-cols-[minmax(0,2fr)_minmax(18rem,1fr)]">
            <x-ui.panel>
                <div class="flex items-start justify-between gap-4">
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-muted">Current draft</p>
                        <h3 class="text-xl font-semibold text-copy">Private idea workspace</h3>
                    </div>
                    <x-ui.badge tone="accent">
                        Draft
                    </x-ui.badge>
                </div>

                <div class="space-y-4 text-sm leading-7 text-muted">
                    <p>
                        Start with a quick note, leave it alone for a week, come back sharper, and keep shaping the idea until it is ready
                        to propose. The layout keeps navigation stable while the work area can become richer over time.
                    </p>
                    <p>
                        The main content region is intentionally plain here. It is a working surface, not a marketing panel, so future
                        features can slot in without rewriting the frame.
                    </p>
                </div>
            </x-ui.panel>

            <x-ui.panel
                title="Next in this app"
                subtitle="The app frame stays stable while the product grows around it."
            >

                <ul class="space-y-3 text-sm text-muted">
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-accent"></span>
                        Capture a new rough idea
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-accent"></span>
                        Revisit saved drafts later
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-accent"></span>
                        Propose a polished draft to the team
                    </li>
                </ul>
            </x-ui.panel>
        </section>
    </div>
</x-layouts.app-shell>
