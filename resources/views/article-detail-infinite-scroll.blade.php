@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h3 class="font-weight-bold">{{ $article->title }}</h3>
            <h5>{{ $article->author->name }}, &nbsp; <span class="text-muted">{{ $article->created_at->format('d-m-Y H:i') }}</span></h5>
        </div>
        <div class="col-12 text-center my-4">
            <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}">
        </div>
        <div class="col-8 my-4" style="font-weight: 500; font-size: 1rem">
            <infinite-scroll-article-content api-url="{{ route('api.article.content', $article->slug) }}"></infinite-scroll-article-content>
        </div>
    </div>
</div>
@endsection
