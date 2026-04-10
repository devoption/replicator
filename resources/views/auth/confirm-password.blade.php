<x-layouts.app-shell title="Confirm password" :toolbar-items="[]" :context-items="[]">
    <x-ui.page-header
        eyebrow="Authentication"
        title="Confirm password"
        description="Re-enter your password before continuing."
    />

    <x-ui.panel class="mt-6 max-w-xl">
        <form method="POST" action="{{ route('password.confirm.store') }}" class="space-y-5">
            @csrf

            <x-ui.input label="Password" name="password" type="password" autocomplete="current-password" required />

            <x-ui.button type="submit">Confirm password</x-ui.button>
        </form>
    </x-ui.panel>
</x-layouts.app-shell>
