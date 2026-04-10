<x-layouts.app-shell title="Create account" :toolbar-items="[]" :context-items="[]">
    <x-ui.page-header
        eyebrow="Authentication"
        title="Create account"
        description="Start a new account so you can continue into Replicator."
    />

    <x-ui.panel class="mt-6 max-w-xl">
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <x-ui.input label="First name" name="first_name" autocomplete="given-name" required />
            <x-ui.input label="Last name" name="last_name" autocomplete="family-name" required />
            <x-ui.input label="Email address" name="email" type="email" autocomplete="email" required />
            <x-ui.input label="Password" name="password" type="password" autocomplete="new-password" required />
            <x-ui.input label="Confirm password" name="password_confirmation" type="password" autocomplete="new-password" required />

            <x-ui.button type="submit">Create account</x-ui.button>
        </form>
    </x-ui.panel>
</x-layouts.app-shell>
