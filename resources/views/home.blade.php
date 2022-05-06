@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-md-3">
        @foreach ($articles as $article)
        <div class="col mb-4">
            <div class="card shadow my-4 h-100">
                <img src="{{ $article->thumbnail }}" class="card-img-top" alt="Article Image" style="height: 220px">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{ $article->title }}</h5>
                    <p class="card-text">{{ $article->excerpt }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ $article->url }}" class="btn btn-primary float-right">Paginated Article</a>
                    <a href="{{ route('article.detail.infinite-scroll', $article->slug) }}" class="btn btn-primary float-right mr-2">Infinite Scroll</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
