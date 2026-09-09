@extends('docs.layout')
@section('content')
<div class="mx-auto flex w-full max-w-[1400px] gap-8 px-4 sm:px-6 lg:px-8">
    <aside class="hidden w-64 shrink-0 lg:block"><div class="sticky top-16 max-h-[calc(100vh-4rem)] overflow-y-auto py-8 pr-2">@include('docs.components.sidebar',['currentGroup'=>$group])</div></aside>
    <main class="min-w-0 flex-1 py-8 lg:py-10"><div class="mx-auto max-w-3xl">
        <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-[13px] text-slate-500"><a href="{{ url('/') }}" class="hover:text-slate-900 dark:hover:text-white">Home</a><span>›</span><span>{{ $group }}</span><span>›</span><span class="text-slate-900 dark:text-white">{{ $page['title'] }}</span></nav>
        <h1 class="mt-4 text-[34px] font-bold leading-tight tracking-tight">{{ $page['title'] }}</h1>
        @if(!empty($page['subtitle']))<p class="mt-3 text-[17px] leading-8 text-slate-500">{{ $page['subtitle'] }}</p>@endif
        <div class="mt-8">@include('docs.components.blocks',['blocks'=>$page['blocks']])</div>
        @include('docs.components.prev-next')
    </div></main>
    <aside class="hidden w-60 shrink-0 xl:block"><div class="sticky top-16 max-h-[calc(100vh-4rem)] overflow-y-auto py-10">@include('docs.components.toc')</div></aside>
</div>
@endsection
