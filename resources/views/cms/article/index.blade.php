@extends('cms.layouts.app')

@section('title_postfix', 'Article List')

@section('header')
<div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Article</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="{{ route('cms.article.list') }}"><i class="fa fa-newspaper"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('cms.article.list') }}">Article List</a></li>
        </ol>
    </nav>
</div>
<div class="col-lg-6 col-5 text-right">
    <a href="{{ route('cms.article.create') }}" class="btn btn-sm btn-neutral">Write New Article</a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1>Article List</h1>
            </div>
            <div class="card-body table-responsive py-4">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text">
                            {{ session('status') }}
                        </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <table class="table align-items-center table-flush" id="datatable-basic">
                    <thead class="thead-light">
                        <tr>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Thumbnail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->excerpt }}</td>
                            <td class="table-user">
                                <img src="{{ $article->thumbnail }}" class="img-thumbnail img-responsive rounded border" width="50" height="50">
                            </td>
                            <td>
                                <a href="{{ route('cms.article.edit', $article->id) }}" class="btn btn-warning" title="Edit Article">
                                    <span class="btn-inner--icon">
                                        <i class="fa fa-pen"></i>
                                    </span>
                                </a>
                                <button class="btn btn-danger btn-delete" title="Delete Article" data-article-id="{{ $article->id }}">
                                    <span class="btn-inner--icon">
                                        <i class="fa fa-trash-alt"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form id="delete-form" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@parent
<script>
$(function () {
    $('.btn-delete').on('click', function () {
        Swal.fire({
            title: 'Delete Article',
            text: 'Are you sure want to delete this Article?',
            icon: 'warning',
            showLoaderOnConfirm: true,
            showCancelButton: true,
        }).then(result => {
            if (result.isConfirmed) {
                let articleId = $(this).data('articleId');
                let deleteUrl = "{{ route('cms.article.delete', ':id') }}";
                deleteUrl = deleteUrl.replace(':id', articleId);

                let deleteForm = $('#delete-form');
                deleteForm.attr('action', deleteUrl)
                deleteForm.submit();
            }
        });
    });
});
</script>
@endsection
