@php
    $headings = collect($page['blocks'])->whereIn('t', ['h2','h3']);
@endphp
@if($headings->isNotEmpty())
<div class="text-sm"><p class="mb-3 text-[13px] font-semibold uppercase tracking-wide text-slate-500">On this page</p><ul class="space-y-1 border-l border-slate-200 dark:border-slate-800">@foreach($headings as $heading)<li><a href="#{{ \Illuminate\Support\Str::slug($heading['text']) }}" class="block border-l border-transparent py-1 pr-2 text-[13.5px] leading-6 text-slate-500 hover:text-slate-900 dark:hover:text-white {{ $heading['t']==='h3' ? 'pl-7' : 'pl-4' }}">{{ $heading['text'] }}</a></li>@endforeach</ul></div>
@endif
