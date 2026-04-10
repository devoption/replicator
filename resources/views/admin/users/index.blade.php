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
            'icon' => 'heroicon-o-squares-2x2',
        ],
        [
            'label' => 'Users',
            'href' => route('admin.users.index'),
            'current' => true,
            'icon' => 'heroicon-o-users',
        ],
        [
            'label' => 'Roles',
            'href' => route('admin.roles.index'),
            'icon' => 'heroicon-o-shield-check',
        ],
    ];
@endphp

<x-layouts.app-shell
    title="Admin users"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
    :show-admin-entry="true"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Admin"
            title="Users"
            description="Browse accounts and manage their baseline role assignments."
        />

        <div class="grid gap-6">
            <x-ui.panel title="User directory" subtitle="This is the first pass at user administration.">
                <div class="overflow-hidden rounded-md">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-black/5 text-muted">
                            <tr>
                                <th class="py-3 pr-4 font-medium">Name</th>
                                <th class="py-3 pr-4 font-medium">Email</th>
                                <th class="py-3 pr-4 font-medium">Role</th>
                                <th class="py-3 pr-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b border-black/5 last:border-0">
                                    <td class="py-3 pr-4">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-copy hover:text-accent-strong">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td class="py-3 pr-4 text-muted">{{ $user->email }}</td>
                                    <td class="py-3 pr-4">
                                        <x-ui.badge :tone="$user->isAn('admin') ? 'accent' : 'neutral'">
                                            {{ $user->isAn('admin') ? 'Admin' : 'User' }}
                                        </x-ui.badge>
                                    </td>
                                    <td class="py-3 pr-4 text-right">
                                        <form method="POST" action="{{ route('admin.users.impersonate', $user) }}">
                                            @csrf
                                            <x-ui.button variant="ghost" type="submit">Impersonate</x-ui.button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-ui.panel>
        </div>
    </div>
</x-layouts.app-shell>
