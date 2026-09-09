<div class="doc-content">
@foreach($blocks as $block)
    @switch($block['t'])
        @case('p')
            <p class="my-5 text-[15.5px] leading-8 text-slate-700 dark:text-slate-300">{!! preg_replace('/`([^`]+)`/', '<code class="rounded border border-slate-200 bg-slate-100 px-1.5 py-0.5 font-mono text-[0.85em] dark:border-slate-700 dark:bg-slate-900">$1</code>', e($block['text'])) !!}</p>
            @break
        @case('h2')
            <h2 id="{{ \Illuminate\Support\Str::slug($block['text']) }}" class="mt-12 scroll-mt-24 border-b border-slate-200 pb-2 text-[22px] font-semibold tracking-tight dark:border-slate-800">{{ $block['text'] }}</h2>
            @break
        @case('h3')
            <h3 id="{{ \Illuminate\Support\Str::slug($block['text']) }}" class="mt-9 scroll-mt-24 text-[17px] font-semibold tracking-tight">{{ $block['text'] }}</h3>
            @break
        @case('code')
            <div class="my-6 overflow-hidden rounded-lg border border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900">
                @if(!empty($block['title'])) <div class="border-b border-slate-200 px-4 py-2 text-xs text-slate-500 dark:border-slate-800">{{ $block['title'] }}</div> @endif
                <div class="relative"><button type="button" data-copy-code class="absolute right-3 top-3 rounded border border-slate-300 bg-white px-2 py-1 text-xs text-slate-500 dark:border-slate-700 dark:bg-slate-950">Copy</button><pre class="overflow-x-auto p-5 pr-16 text-[13px] leading-6"><code>{{ $block['code'] }}</code></pre></div>
            </div>
            @break
        @case('list')
            @if(!empty($block['ordered'])) <ol class="my-5 list-decimal space-y-2 pl-6 text-[15.5px] leading-8 text-slate-700 dark:text-slate-300"> @else <ul class="my-5 list-disc space-y-2 pl-6 text-[15.5px] leading-8 text-slate-700 dark:text-slate-300"> @endif
                @foreach($block['items'] as $item)<li class="pl-1">{{ $item }}</li>@endforeach
            @if(!empty($block['ordered'])) </ol> @else </ul> @endif
            @break
        @case('table')
            <div class="my-6 overflow-x-auto rounded-lg border border-slate-200 dark:border-slate-800"><table class="w-full min-w-[520px] border-collapse text-left text-sm"><thead><tr class="bg-slate-100 dark:bg-slate-900">@foreach($block['head'] as $cell)<th class="border-b border-slate-200 px-4 py-2.5 font-semibold dark:border-slate-800">{{ $cell }}</th>@endforeach</tr></thead><tbody>@foreach($block['rows'] as $row)<tr class="border-b border-slate-200/70 last:border-0 dark:border-slate-800/70">@foreach($row as $cell)<td class="px-4 py-2.5 align-top text-slate-700 dark:text-slate-300">{{ $cell }}</td>@endforeach</tr>@endforeach</tbody></table></div>
            @break
        @case('callout')
            @php $kind=$block['kind'] ?? 'note'; $classes=['tip'=>'border-emerald-500/40 bg-emerald-50 dark:bg-emerald-950/20','warning'=>'border-amber-500/50 bg-amber-50 dark:bg-amber-950/20','danger'=>'border-red-500/50 bg-red-50 dark:bg-red-950/20','note'=>'border-slate-300 bg-slate-50 dark:border-slate-700 dark:bg-slate-900']; @endphp
            <aside class="my-6 rounded-lg border-l-4 p-4 text-sm leading-7 {{ $classes[$kind] ?? $classes['note'] }}">@if(!empty($block['title']))<strong class="block mb-1">{{ $block['title'] }}</strong>@endif{{ $block['text'] }}</aside>
            @break
        @case('faq')
            <div class="my-6 divide-y rounded-lg border border-slate-200 dark:divide-slate-800 dark:border-slate-800">@foreach($block['items'] as $item)<details class="p-4"><summary class="cursor-pointer font-medium">{{ $item['q'] }}</summary><p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $item['a'] }}</p></details>@endforeach</div>
            @break
    @endswitch
@endforeach
</div>
