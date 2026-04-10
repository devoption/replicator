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
    title="New idea"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Ideas"
            title="Capture a private draft."
            description="Start with a rough thought. You can return later and sharpen it."
        />

        <x-ui.panel class="max-w-3xl" title="New draft">
            @include('ideas._form', [
                'action' => route('ideas.store'),
                'method' => null,
                'submitLabel' => 'Save draft',
                'cancelHref' => route('ideas.index'),
            ])
        </x-ui.panel>
    </div>
</x-layouts.app-shell>
