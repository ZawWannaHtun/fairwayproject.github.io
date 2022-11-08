@extends("layouts.app")

@section("content")
    @if (session("danger"))
        <div class="alert alert-danger">
            {{ session("danger") }}
        </div>
    @endif
    @if (session("info"))
    <div class="alert alert-info">
        {{ session("info") }}
    </div>
    @endif
    <div class="container">

        {{ $articles->links() }}
        {{-- Comments({{ count($article->comments) }}) --}}
        @foreach($articles as $article)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>

                    <small class="text-muted card-subtitle mb-2">
                        <b class="text-success">{{ $article->user->name }}</b>
                        {{ $article->created_at->diffForHumans() }},
                        Category: {{ $article->category->name }},
                       Comments {{ count($article->comments) }}
                    </small>
                    <div class="card-text">{{ $article->body }}</div>
                </div>
                <div class="card-footer">
                    <a href="{{ url("/articles/detail/$article->id") }}" class="card-link" >View Details &raquo;</a>
                </div>

            </div>
        @endforeach
        {{ $articles->links() }}
    </div>
@endsection
