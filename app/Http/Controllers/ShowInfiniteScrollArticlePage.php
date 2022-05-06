<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ShowInfiniteScrollArticlePage extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string  $slug
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function __invoke(string $slug, Request $request)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('article-detail-infinite-scroll', compact('article'));
    }
}
