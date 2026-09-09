<footer class="border-t border-slate-200 dark:border-slate-800">
    <div class="mx-auto grid max-w-[1400px] gap-8 px-4 py-12 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:px-8">
        <div><div class="flex items-center gap-2"><span class="grid h-6 w-6 place-items-center rounded-md bg-red-50 text-[10px] font-bold text-red-600 dark:bg-red-950 dark:text-red-400">RT</span><span class="text-sm font-semibold">Telegram Bot Router</span></div><p class="mt-3 text-sm leading-6 text-slate-500">An open-source Laravel package. Released under the MIT license.</p></div>
        @foreach(['Docs'=>[['Introduction','getting-started/introduction'],['Installation','getting-started/installation'],['Routing','routing/commands']], 'Reference'=>[['Route API','api/route-api'],['Keyboard API','api/keyboard-api'],['Response API','api/response-api']], 'Project'=>[['Changelog','changelog'],['FAQ','faq'],['Contributing','contributing']]] as $title=>$links)
            <div><p class="text-[13px] font-semibold uppercase tracking-wide">{{ $title }}</p><ul class="mt-3 space-y-2">@foreach($links as [$label,$slug])<li><a class="text-sm text-slate-500 hover:text-slate-900 dark:hover:text-white" href="{{ route('docs.show',['path'=>$slug]) }}">{{ $label }}</a></li>@endforeach</ul></div>
        @endforeach
    </div>
</footer>
