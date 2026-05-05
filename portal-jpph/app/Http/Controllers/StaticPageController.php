<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StaticPageController extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $attrs = Cache::remember(
            "cms:Page:{$slug}",
            300,
            fn () => optional(Page::where('slug', $slug)->where('published', true)->first())->getAttributes()
        );
        abort_unless($attrs, 404);
        $page = (new Page())->forceFill($attrs);
        return view('public.page', ['page' => $page]);
    }
}
