@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('comments.create') }}"> Create New comment</a>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Description</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($comments as $comment)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $comment->title }}</td>
        <td>{{ $comment->description }}</td>
        <td>
            <form action="{{ route('comments.destroy',$comment->id) }}" method="comment">

                <a class="btn btn-info" href="{{ route('comments.show',$comment->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('comments.edit',$comment->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $comments->links() !!}
@endsection
