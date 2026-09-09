<header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 backdrop-blur dark:border-slate-800 dark:bg-slate-950/90">
    <div class="mx-auto flex h-16 w-full max-w-[1400px] items-center gap-4 px-4 sm:px-6 lg:px-8">
        <button type="button" class="rounded-md p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-900 lg:hidden" data-mobile-toggle aria-label="Open navigation">☰</button>
        <a href="{{ url('/') }}" class="flex items-center gap-2.5">
            <span class="grid h-8 w-8 place-items-center rounded-lg border border-red-200 bg-red-50 text-sm font-bold text-red-600 dark:border-red-900 dark:bg-red-950 dark:text-red-400">RT</span>
            <span class="whitespace-nowrap text-[15px] font-semibold tracking-tight">Laravel <span class="text-slate-500">Telegram Bot Router</span></span>
        </a>
        <nav class="ml-4 hidden items-center gap-1 lg:flex">
            @foreach([
                ['Documentation','getting-started/introduction'],['API Reference','api/route-api'],['Examples','examples/simple-bot'],['Changelog','changelog']
            ] as [$label,$slug])
                <a href="{{ route('docs.show', ['path'=>$slug]) }}" class="rounded-md px-2.5 py-1.5 text-[14px] text-slate-500 hover:bg-slate-100 hover:text-slate-900 dark:hover:bg-slate-900 dark:hover:text-white">{{ $label }}</a>
            @endforeach
        </nav>
        <div class="ml-auto flex items-center gap-2">
            <form action="{{ route('docs.search') }}" method="GET" class="hidden sm:block">
                <input name="q" value="{{ request('q') }}" placeholder="Search docs…" class="h-9 w-56 rounded-md border border-slate-200 bg-slate-50 px-3 text-sm outline-none focus:border-red-400 dark:border-slate-800 dark:bg-slate-900">
            </form>
            <a href="https://github.com/ReyhanTeam/laravel-telegram-bot-router" target="_blank" rel="noreferrer" class="rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-900 dark:hover:bg-slate-900 dark:hover:text-white" aria-label="GitHub">GitHub</a>
            <button type="button" data-theme-toggle class="rounded-md p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-900" aria-label="Toggle dark mode">◐</button>
        </div>
    </div>
    <div data-mobile-nav class="hidden border-t border-slate-200 bg-white p-5 dark:border-slate-800 dark:bg-slate-950 lg:hidden">
        <nav class="space-y-1">
            @foreach(config('documentation.navigation') as $group => $items)
                <p class="mt-4 text-xs font-semibold uppercase tracking-wide text-slate-500">{{ $group }}</p>
                @foreach($items as $item)
                    <a href="{{ route('docs.show', ['path'=>$item]) }}" class="block rounded-md px-2 py-1.5 text-sm text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900">{{ config('documentation.pages.'.$item.'.title') }}</a>
                @endforeach
            @endforeach
        </nav>
    </div>
</header>
