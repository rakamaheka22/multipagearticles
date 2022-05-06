@extends('cms.layouts.app')

@section('title_postfix', 'Edit Article')

@section('header')
<div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Article</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="{{ route('cms.article.list') }}"><i class="fa fa-newspaper"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('cms.article.edit', $article->id) }}">Edit Article</a></li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1>Article List</h1>
            </div>
            <div class="card-body">
                <form role="form" action="{{ route('cms.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-control-label" for="title">Title</label>
                        <input
                            type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            id="title" name="title" value="{{ old('title', $article->title) }}"
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="excerpt">Excerpt</label>
                        <textarea
                            class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}"
                            id="excerpt" name="excerpt" rows="3"
                        >{{ old('excerpt', $article->excerpt) }}</textarea>
                        <div class="invalid-feedback">
                            {{ $errors->first('excerpt') }}
                        </div>
                    </div>

                    <label class="form-control-label" for="thumbnail">Article Thumbnail</label>

                    <div class="text-center py-4 px-2">
                        <img src="{{ $article->thumbnail }}" class="img-thumbnail img-responsive rounded border" id="article-thumbnail" alt="Article Thumbnail" width="400" height="400">
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="form-control custom-file-input {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" id="thumbnail" name="thumbnail">
                            <label class="custom-file-label" for="thumbnail">Select file</label>
                            <div class="invalid-feedback">
                                {{ $errors->first('thumbnail') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="content">Content</label>
                        <textarea
                            class="form-control editor {{ $errors->has('content') ? 'is-invalid' : '' }}"
                            id="content" name="content"
                        >{{ old('content', $article->content) }}</textarea>
                        <div class="invalid-feedback">
                            {{ $errors->first('content') }}
                        </div>
                    </div>

                    <div class="float-right">
                        <a href="{{ route('cms.article.list') }}" class="btn btn-warning">
                            Cancel
                        </a>
                        <button class="btn btn-primary" type="submit">
                            Update Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@parent
@include('cms.components.editor')
@include('cms.components.image-upload-previewer', [
    'uploader' => 'thumbnail',
    'previewer' => 'article-thumbnail',
])
@endsection
