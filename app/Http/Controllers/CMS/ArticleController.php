<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\StoreArticleRequest;
use App\Http\Requests\CMS\UpdateArticleRequest;
use App\Models\Article;
use App\Services\ImageUpload\ImageUploader;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::whereHas('author', function ($author) {
            return $author->where('id', auth()->id());
        })->get();

        return view('cms.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('cms.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CMS\StoreArticleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreArticleRequest $request)
    {
        $imageUploader = new ImageUploader(
            $request->file('thumbnail'),
            'uploads/'.now()->year.'/'.now()->month.'/'
        );
        $imageUploader->saveImage();

        Article::create([
            'title' => $request->title,
            'slug' => Article::generateSlug($request->title),
            'excerpt' => $request->excerpt,
            'thumbnail' => $imageUploader->filePath,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect(route('cms.article.list'))
            ->with('status', 'Article successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::whereHas('author', function ($author) {
            return $author->where('id', auth()->id());
        })->findOrFail($id);

        return view('cms.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CMS\UpdateArticleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::whereHas('author', function ($author) {
            return $author->where('id', auth()->id());
        })->findOrFail($id);

        $data = [
            'title' => $request->title,
            'slug' => Article::generateSlug($request->title, $article->id),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ];

        if ($request->has('thumbnail')) {
            $imageUploader = new ImageUploader(
                $request->file('thumbnail'),
                'uploads/'.now()->year.'/'.now()->month.'/'
            );
            $imageUploader->saveImage();

            $data['thumbnail'] = $imageUploader->filePath;
        }

        $article->update($data);

        return redirect(route('cms.article.list'))
            ->with('status', 'Article successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $article = Article::whereHas('author', function ($author) {
            return $author->where('id', auth()->id());
        })->findOrFail($id);

        $article->delete();

        return redirect(route('cms.article.list'))
            ->with('status', 'Article successfully deleted.');
    }
}
