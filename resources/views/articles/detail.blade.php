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

            <div class="card mb-3 broder-1 border-primary">
                <div class="card-body">
                    <h5>{{ $article->title }}</h5>
                    <small class="text-muted card-subtitle mb-2">
                       <b class="text-success"> {{ $article->user->name }} </b>
                        {{ $article->created_at->diffForHumans() }}
                    </small>
                    <div class="card-text">{{ $article->body }}</div>
                </div>

                @auth
                <div class="card-footer">


                    @can("article-delete", $article)
                         <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger" >Delete</a>
                         <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-dark" >Edit</a>

                    @endcan

                </div>
                @endauth

            </div>
            <h4 class="ms-1 h5 mt-4">Comments({{ count($article->comments) }})</h4>
            <ul class="list-group">
                @foreach ($article->comments as $comment)
                    <li class="list-group-item">
                        @can("comment-delete", $comment)
                            <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                        @endcan
                        <div>
                            <small>
                                <b class="text-success">
                                    {{ $comment->user->name }}
                                </b>
                                {{ $comment->created_at->diffForHumans() }}
                            </small>
                        </div>
                        {{ $comment->content }}
                    </li>
                @endforeach
            </ul>
            @auth
            <form action="{{ url("/comments/add") }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control my-2"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
            @endauth
        </div>

@endsection
