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
            'href' => '#roles',
            'icon' => 'heroicon-o-shield-check',
        ],
    ];
@endphp

<x-layouts.app-shell
    title="Edit user"
    :toolbar-items="$toolbarItems"
    :context-items="$contextItems"
    :show-admin-entry="true"
>
    <div class="mx-auto max-w-5xl space-y-8">
        <x-ui.page-header
            eyebrow="Admin"
            :title="$user->name"
            description="Update the user's core details and baseline role."
        />

        <x-ui.panel class="max-w-2xl" title="Edit user">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <x-ui.input label="First name" name="first_name" :value="$user->first_name" required />
                <x-ui.input label="Last name" name="last_name" :value="$user->last_name" required />
                <x-ui.input label="Email" name="email" type="email" :value="$user->email" required />

                <x-ui.select label="Role" name="role" required>
                    <option value="user" @selected($user->isNotAn('admin'))>User</option>
                    <option value="admin" @selected($user->isAn('admin'))>Admin</option>
                </x-ui.select>

                <x-ui.button type="submit">Save changes</x-ui.button>
            </form>
        </x-ui.panel>
    </div>
</x-layouts.app-shell>
