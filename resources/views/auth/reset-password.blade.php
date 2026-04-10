<x-layouts.app-shell title="Reset password" :toolbar-items="[]" :context-items="[]">
    <x-ui.page-header
        eyebrow="Authentication"
        title="Reset password"
        description="Choose a new password for your account."
    />

    <x-ui.panel class="mt-6 max-w-xl">
        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <x-ui.input label="Email address" name="email" type="email" autocomplete="email" required :value="request('email')" />
            <x-ui.input label="Password" name="password" type="password" autocomplete="new-password" required />
            <x-ui.input label="Confirm password" name="password_confirmation" type="password" autocomplete="new-password" required />

            <x-ui.button type="submit">Reset password</x-ui.button>
        </form>
    </x-ui.panel>
</x-layouts.app-shell>
