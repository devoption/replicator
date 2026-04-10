@props([
    'title' => config('app.name', 'Replicator'),
    'toolbarItems' => [],
    'contextItems' => [],
    'showAdminEntry' => false,
])

@php
    $themePreferences = auth()->user()?->theme_preferences ?? [];
    $requestedThemeMode = $themePreferences['mode'] ?? 'system';
    $themeMode = in_array($requestedThemeMode, ['light', 'dark', 'system'], true) ? $requestedThemeMode : 'system';

    $themeStyleMap = [
        'accent' => '--app-accent',
    ];

    $themeStyle = collect($themeStyleMap)
        ->map(function (string $cssVariable, string $key) use ($themePreferences): ?string {
            $value = $themePreferences[$key] ?? null;

            if (! is_string($value) || ! preg_match('/^#[0-9A-Fa-f]{6}$/', $value)) {
                return null;
            }

            return "{$cssVariable}: {$value}";
        })
        ->filter()
        ->implode('; ');
@endphp

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="h-full"
    data-theme-mode="{{ $themeMode }}"
    style="{{ $themeStyle }}"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <script>
            const themeMode = document.documentElement.dataset.themeMode ?? 'system';
            const systemDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const resolvedTheme = themeMode === 'system' ? (systemDarkMode ? 'dark' : 'light') : themeMode;

            document.documentElement.dataset.theme = resolvedTheme;
        </script>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-full bg-canvas font-sans text-copy antialiased">
        <div class="min-h-screen lg:flex">
            <aside
                aria-label="Application toolbar"
                class="bg-toolbar px-3 py-4 text-white lg:flex lg:min-h-screen lg:w-20 lg:flex-col lg:items-center lg:px-0"
            >
                <div class="flex items-center justify-between lg:mb-6 lg:w-full lg:flex-col lg:gap-4">
                    <a
                        href="{{ route('home') }}"
                        class="flex items-center gap-3 rounded-lg px-2 py-2 text-sm font-semibold text-white lg:flex-col lg:gap-2"
                    >
                        <span class="flex size-10 items-center justify-center rounded-lg bg-white/10">
                            <x-heroicon-o-squares-2x2 class="size-5" />
                        </span>
                        <span class="lg:text-[0.7rem]">Apps</span>
                    </a>

                    <button
                        type="button"
                        class="flex size-10 items-center justify-center rounded-lg bg-white/10 text-white lg:hidden"
                        aria-label="Open navigation"
                    >
                        <x-heroicon-o-bars-3 class="size-5" />
                    </button>
                </div>

                <nav aria-label="Applications" class="mt-4 flex gap-2 overflow-x-auto lg:mt-0 lg:flex-1 lg:flex-col lg:items-center">
                    @foreach ($toolbarItems as $item)
                        <x-app.toolbar-item
                            :href="$item['href'] ?? '#'"
                            :label="$item['label']"
                            :icon="$item['icon']"
                            :current="$item['current'] ?? false"
                        />
                    @endforeach

                    @if ($showAdminEntry && auth()->user()?->isAn('admin'))
                        <x-app.toolbar-item
                            href="{{ route('admin.dashboard') }}"
                            label="Admin"
                            icon="heroicon-o-shield-check"
                            :current="request()->routeIs('admin.*')"
                        />
                    @endif
                </nav>
            </aside>

            <div class="flex min-w-0 flex-1 flex-col lg:flex-row">
                <nav
                    aria-label="Context navigation"
                    class="bg-panel px-5 py-5 lg:w-72 lg:px-6 lg:py-8"
                >
                    <div class="mb-6 flex items-center gap-3">
                        <span class="flex size-10 items-center justify-center rounded-md bg-accent-soft text-accent-strong">
                            <x-heroicon-o-light-bulb class="size-5" />
                        </span>
                        <div>
                            <p class="text-xs font-medium uppercase text-muted">Current app</p>
                            <h1 class="text-lg font-semibold">Ideas</h1>
                        </div>
                    </div>

                    <ul class="space-y-1.5">
                        @foreach ($contextItems as $item)
                            <li>
                                <x-app.context-nav-item
                                    :href="$item['href'] ?? '#'"
                                    :label="$item['label']"
                                    :icon="$item['icon']"
                                    :current="$item['current'] ?? false"
                                />
                            </li>
                        @endforeach
                    </ul>
                </nav>

                <main aria-label="Main content" class="min-w-0 flex-1 bg-main px-5 py-5 lg:px-8 lg:py-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
