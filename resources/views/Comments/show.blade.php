@extends('layouts.layout')
@section('content')
    <div class="row">


        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show comment</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('articles.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            @foreach ($comments as $comment )
            <div class="form-group">



                <strong>Body:</strong>
                {{ $comment->body }}
                <br>
                <strong>From user:</strong>
                {{ $comment->users->name }}
                <br>
                <strong>Date:</strong>
                {{ $comment->created_at }}


            </div>
            @endforeach
        </div>

        <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="articles_id" value="{{ $article->id }}" />
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add Comment" />
                        </div>
                    </form>

    </div>
@endsection
