<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentationController extends Controller
{
    public function home(): View
    {
        return view('docs.home', [
            'title' => 'Laravel Telegram Bot Router — Route Telegram updates like HTTP requests',
        ]);
    }

    public function show(string $path = 'getting-started/introduction'): View
    {
        $pages = config('documentation.pages', []);
        $page = $pages[$path] ?? null;

        abort_if($page === null, 404);

        $slugs = array_keys($pages);
        $index = array_search($path, $slugs, true);

        return view('docs.page', [
            'page' => $page,
            'slug' => $path,
            'previous' => $index > 0 ? $pages[$slugs[$index - 1]] + ['slug' => $slugs[$index - 1]] : null,
            'next' => $index !== false && $index < count($slugs) - 1 ? $pages[$slugs[$index + 1]] + ['slug' => $slugs[$index + 1]] : null,
            'group' => config('documentation.groups')[$path] ?? 'Documentation',
        ]);
    }

    public function search(Request $request): View
    {
        $query = trim((string) $request->string('q'));
        $results = [];

        if ($query !== '') {
            foreach (config('documentation.pages', []) as $slug => $page) {
                $haystack = strtolower($page['title'].' '.($page['subtitle'] ?? '').' '.implode(' ', $page['search'] ?? []));
                if (str_contains($haystack, strtolower($query))) {
                    $results[] = ['slug' => $slug, ...$page];
                }
            }
        }

        return view('docs.search', compact('query', 'results'));
    }
}
