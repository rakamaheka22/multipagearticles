<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class GetArticleContent extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string  $slug
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(string $slug, Request $request)
    {
        $page = $request->page ??= 1;
        $article = Article::where('slug', $slug)->firstOrFail();

        if ($page == 'all') {
            return response()->json([
                'data' => [
                    'content' => $article->content,
                ],
            ]);
        }

        return $article->paginateContent((integer)$page);
    }
}
