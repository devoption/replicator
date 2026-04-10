<x-layouts.app-shell title="Sign in" :toolbar-items="[]" :context-items="[]">
    <x-ui.page-header
        eyebrow="Authentication"
        title="Sign in"
        description="Use your team account to continue into Replicator."
    />

    <x-ui.panel class="mt-6 max-w-xl">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <x-ui.input label="Email address" name="email" type="email" autocomplete="email" required />
            <x-ui.input label="Password" name="password" type="password" autocomplete="current-password" required />

            <div class="flex items-center justify-between gap-4">
                <label class="inline-flex items-center gap-2 text-sm text-muted">
                    <input type="checkbox" name="remember" class="rounded-sm border-0 bg-main text-accent focus:ring-accent" />
                    Remember me
                </label>

                <a href="{{ route('password.request') }}" class="text-sm text-accent-strong hover:text-copy">
                    Forgot your password?
                </a>
            </div>

            <x-ui.button type="submit">Sign in</x-ui.button>
        </form>
    </x-ui.panel>
</x-layouts.app-shell>
