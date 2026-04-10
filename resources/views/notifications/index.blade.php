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
        ['label' => 'Inbox', 'href' => route('notifications.index'), 'current' => true, 'icon' => 'heroicon-o-bell'],
    ];
@endphp

<x-layouts.app-shell
    title="Notifications"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Inbox"
            title="Notifications"
            description="Private in-app notifications for your account."
        />

        <x-ui.panel title="Recent items" subtitle="Unread items stay visible until you mark them read.">
            <div class="space-y-3">
                @forelse ($notifications as $notification)
                    <div class="space-y-3 rounded-md bg-main px-4 py-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="font-medium text-copy">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                <p class="text-sm text-muted">{{ $notification->data['body'] ?? '' }}</p>
                            </div>
                            <x-ui.badge :tone="$notification->read_at ? 'neutral' : 'accent'">
                                {{ $notification->read_at ? 'Read' : 'Unread' }}
                            </x-ui.badge>
                        </div>

                        <div class="flex gap-3">
                            @if ($notification->read_at)
                                <form method="POST" action="{{ route('notifications.unread', $notification->id) }}">
                                    @csrf
                                    <x-ui.button variant="secondary" type="submit">Mark unread</x-ui.button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                    @csrf
                                    <x-ui.button variant="secondary" type="submit">Mark read</x-ui.button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-muted">You have no notifications yet.</p>
                @endforelse
            </div>
        </x-ui.panel>
    </div>
</x-layouts.app-shell>
