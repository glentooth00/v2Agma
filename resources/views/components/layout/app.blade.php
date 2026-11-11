<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'BlatUI App' }}</title>

    <!-- Tailwind CSS v4 / Vite asset import -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground antialiased">
    
    <!-- Example BlatUI Header / Navbar or Slot -->
    <div class="min-h-screen flex flex-col">
        <header class="border-b px-6 py-4 flex items-center justify-between">
            <span class="font-bold text-lg">My BlatUI App</span>
            <!-- Example BlatUI Button -->
            <x-ui.button variant="outline">Toggle Theme</x-ui.button>
        </header>

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
