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
        <section class="space-y-3">
            <p class="text-sm font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Workspace</p>
            <h2 class="max-w-3xl text-3xl font-semibold text-gray-950 dark:text-white">Turn rough product thoughts into team-ready software proposals.</h2>
            <p class="max-w-3xl text-base leading-7 text-gray-600 dark:text-gray-300">
                This shell is the first pass at the shared product frame: app switcher on the left, context navigation beside it,
                and a main work area ready for ideas, planning, development, testing, security, ops, and admin tools.
            </p>
        </section>

        <section class="grid gap-6 lg:grid-cols-[minmax(0,2fr)_minmax(18rem,1fr)]">
            <div class="space-y-5 rounded-lg bg-white px-5 py-5 dark:bg-gray-900">
                <div class="flex items-start justify-between gap-4">
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Current draft</p>
                        <h3 class="text-xl font-semibold text-gray-950 dark:text-white">Private idea workspace</h3>
                    </div>
                    <span class="rounded-lg bg-amber-100 px-3 py-1 text-sm font-medium text-amber-800 dark:bg-amber-400/10 dark:text-amber-300">
                        Draft
                    </span>
                </div>

                <div class="space-y-4 text-sm leading-7 text-gray-600 dark:text-gray-300">
                    <p>
                        Start with a quick note, leave it alone for a week, come back sharper, and keep shaping the idea until it is ready
                        to propose. The layout keeps navigation stable while the work area can become richer over time.
                    </p>
                    <p>
                        The main content region is intentionally plain here. It is a working surface, not a marketing panel, so future
                        features can slot in without rewriting the frame.
                    </p>
                </div>
            </div>

            <section class="space-y-4 rounded-lg bg-white px-5 py-5 dark:bg-gray-900">
                <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Next in this app</h3>

                <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-amber-500"></span>
                        Capture a new rough idea
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-amber-500"></span>
                        Revisit saved drafts later
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="size-2 rounded-full bg-amber-500"></span>
                        Propose a polished draft to the team
                    </li>
                </ul>
            </section>
        </section>
    </div>
</x-layouts.app-shell>
