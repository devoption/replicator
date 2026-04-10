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
        ['label' => 'Dashboard', 'href' => route('admin.dashboard'), 'icon' => 'heroicon-o-squares-2x2'],
        ['label' => 'Users', 'href' => route('admin.users.index'), 'icon' => 'heroicon-o-users'],
        ['label' => 'Notifications', 'href' => route('admin.notifications.index'), 'current' => true, 'icon' => 'heroicon-o-bell'],
        ['label' => 'Roles', 'href' => route('admin.roles.index'), 'icon' => 'heroicon-o-shield-check'],
    ];
@endphp

<x-layouts.app-shell
    title="Notifications"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
    :show-admin-entry="true"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Admin"
            title="In-app notifications"
            description="Send a private in-app notification to all users, a role, or selected users."
        />

        <div class="grid gap-6 lg:grid-cols-[minmax(0,2fr)_minmax(18rem,1fr)]">
            <x-ui.panel title="Compose notification" subtitle="Notifications stay inside the app and appear in each user's inbox.">
                <form method="POST" action="{{ route('admin.notifications.store') }}" class="space-y-5">
                    @csrf

                    <x-ui.input label="Title" name="title" required />
                    <x-ui.textarea label="Body" name="body" rows="6" required />

                    <x-ui.select label="Target" name="target" required>
                        <option value="all">All users</option>
                        <option value="role">Role</option>
                        <option value="users">Specific users</option>
                    </x-ui.select>

                    <x-ui.select label="Role" name="role">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </x-ui.select>

                    <x-ui.select label="Users" name="user_ids[]" multiple size="6">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </x-ui.select>

                    <x-ui.button type="submit">Send notification</x-ui.button>
                </form>
            </x-ui.panel>

            <x-ui.panel title="Recent inbox items" subtitle="The admin account can also review its own in-app notifications here.">
                <div class="space-y-3">
                    @forelse ($notifications as $notification)
                        <div class="space-y-2 rounded-md bg-main px-4 py-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-medium text-copy">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                    <p class="text-sm text-muted">{{ $notification->data['body'] ?? '' }}</p>
                                </div>
                                <x-ui.badge :tone="$notification->read_at ? 'neutral' : 'accent'">
                                    {{ $notification->read_at ? 'Read' : 'Unread' }}
                                </x-ui.badge>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-muted">No notifications yet.</p>
                    @endforelse
                </div>
            </x-ui.panel>
        </div>
    </div>
</x-layouts.app-shell>
