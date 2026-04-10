@php
    $toolbarItems = [
        [
            'label' => 'Ideas',
            'href' => route('ideas.index'),
            'icon' => 'heroicon-o-light-bulb',
        ],
        [
            'label' => 'Planning',
            'href' => route('planning.index'),
            'current' => $title === 'Planning',
            'icon' => 'heroicon-o-clipboard-document-list',
        ],
        [
            'label' => 'Development',
            'href' => route('development.index'),
            'current' => $title === 'Development',
            'icon' => 'heroicon-o-code-bracket-square',
        ],
        [
            'label' => 'Testing',
            'href' => route('testing.index'),
            'current' => $title === 'Testing',
            'icon' => 'heroicon-o-beaker',
        ],
        [
            'label' => 'Security',
            'href' => route('security.index'),
            'current' => $title === 'Security',
            'icon' => 'heroicon-o-shield-check',
        ],
        [
            'label' => 'Ops',
            'href' => route('ops.index'),
            'current' => $title === 'Ops',
            'icon' => 'heroicon-o-command-line',
        ],
    ];

    $contextItems = [];
@endphp

<x-layouts.app-shell
    :title="$title"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            :eyebrow="$title"
            :title="$title"
            description="This section is being added in a later issue."
        />

        <x-ui.panel
            :title="$title"
            subtitle="Placeholder navigation target"
        >
            <p class="text-sm leading-7 text-muted">
                This section is not built yet. The route exists so navigation no longer points at dead hash links.
            </p>
        </x-ui.panel>
    </div>
</x-layouts.app-shell>
