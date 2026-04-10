<x-layouts.app-shell title="Forgot password" :toolbar-items="[]" :context-items="[]">
    <x-ui.page-header
        eyebrow="Authentication"
        title="Forgot password"
        description="Request a reset link for your account."
    />

    <x-ui.panel class="mt-6 max-w-xl">
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <x-ui.input label="Email address" name="email" type="email" autocomplete="email" required />

            <x-ui.button type="submit">Send reset link</x-ui.button>
        </form>
    </x-ui.panel>
</x-layouts.app-shell>
