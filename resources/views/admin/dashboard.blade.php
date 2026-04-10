@php
    $toolbarItems = [
        [
            'label' => 'Ideas',
            'href' => route('home'),
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
            'label' => 'Dashboard',
            'href' => route('admin.dashboard'),
            'current' => true,
            'icon' => 'heroicon-o-squares-2x2',
        ],
        [
            'label' => 'Users',
            'href' => '#users',
            'icon' => 'heroicon-o-users',
        ],
        [
            'label' => 'Roles',
            'href' => '#roles',
            'icon' => 'heroicon-o-shield-check',
        ],
    ];
@endphp

<x-layouts.app-shell
    title="Admin"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
    :show-admin-entry="true"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Admin"
            title="Control center"
            description="This area is reserved for administrative work and future user management."
        />

        <x-ui.panel
            title="Protected area"
            subtitle="Access here is restricted to users with the admin role."
        >
            <p class="text-sm leading-7 text-muted">
                This dashboard is the first admin-only landing surface. It uses the same shell and shared components as the rest of the app,
                but it stays behind the authorization gate and will grow into user, role, and system management from here.
            </p>
        </x-ui.panel>
    </div>
</x-layouts.app-shell>
