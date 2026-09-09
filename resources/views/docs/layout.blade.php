<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Documentation for Laravel Telegram Bot Router — route Telegram bot updates to controllers with middleware, keyboards and queues.">
    <title>{{ $title ?? 'Laravel Telegram Bot Router' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
<div class="flex min-h-screen flex-col">
    @include('docs.components.header')
    <div class="flex-1">@yield('content')</div>
    @include('docs.components.footer')
</div>
</body>
</html>
