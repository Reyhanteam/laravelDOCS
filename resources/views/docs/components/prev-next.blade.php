@if($previous || $next)
<nav class="mt-16 grid gap-4 border-t border-slate-200 pt-8 sm:grid-cols-2 dark:border-slate-800">
    @if($previous)<a href="{{ route('docs.show',['path'=>$previous['slug']]) }}" class="rounded-lg border border-slate-200 p-4 hover:border-red-300 hover:bg-slate-50 dark:border-slate-800 dark:hover:bg-slate-900"><span class="text-xs text-slate-500">← Previous</span><span class="mt-1.5 block font-medium">{{ $previous['title'] }}</span></a>@else<span></span>@endif
    @if($next)<a href="{{ route('docs.show',['path'=>$next['slug']]) }}" class="rounded-lg border border-slate-200 p-4 text-right hover:border-red-300 hover:bg-slate-50 dark:border-slate-800 dark:hover:bg-slate-900"><span class="text-xs text-slate-500">Next →</span><span class="mt-1.5 block font-medium">{{ $next['title'] }}</span></a>@endif
</nav>
@endif
