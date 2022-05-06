<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ShowArticlePage extends Controller
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
        $page = $request->page ??= 1;
        $article = Article::where('slug', $slug)->firstOrFail();
        $contents = $page == 'all' ?
                    $article->content :
                    $article->paginateContent((integer)$page);

        return view('article-detail', compact('article', 'contents'));
    }
}
