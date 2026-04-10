@php
    $toolbarItems = [
        [
            'label' => 'Ideas',
            'href' => route('home'),
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
            'label' => 'Dashboard',
            'href' => route('admin.dashboard'),
            'current' => true,
            'icon' => 'heroicon-o-squares-2x2',
        ],
        [
            'label' => 'Users',
            'href' => route('admin.users.index'),
            'icon' => 'heroicon-o-users',
        ],
        [
            'label' => 'Notifications',
            'href' => route('admin.notifications.index'),
            'icon' => 'heroicon-o-bell',
        ],
        [
            'label' => 'Roles',
            'href' => route('admin.roles.index'),
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

        @if (session()->has('impersonator_id'))
            <form method="POST" action="{{ route('admin.impersonation.destroy') }}">
                @csrf
                @method('DELETE')

                <x-ui.button variant="secondary" type="submit">Stop impersonation</x-ui.button>
            </form>
        @endif
    </div>
</x-layouts.app-shell>
