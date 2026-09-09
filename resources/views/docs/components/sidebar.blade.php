<nav aria-label="Documentation" class="space-y-1 pb-16 text-sm">
@foreach(config('documentation.navigation') as $group => $items)
    <details class="group" @if(($currentGroup ?? '') === $group) open @endif>
        <summary class="cursor-pointer list-none rounded-md px-2 py-1.5 text-[13px] font-semibold uppercase tracking-wide text-slate-500 hover:text-slate-900 dark:hover:text-white">› {{ $group }}</summary>
        <ul class="mb-2 ml-[13px] border-l border-slate-200 dark:border-slate-800">
        @foreach($items as $item)
            <li>
                <a href="{{ route('docs.show', ['path'=>$item]) }}" class="-ml-px block border-l py-1.5 pl-4 pr-2 text-[14px] {{ ($slug ?? '') === $item ? 'border-red-500 font-medium text-red-600 dark:text-red-400' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-900 dark:hover:text-white' }}">
                    {{ config('documentation.pages.'.$item.'.title') }}
                </a>
            </li>
        @endforeach
        </ul>
    </details>
@endforeach
</nav>
