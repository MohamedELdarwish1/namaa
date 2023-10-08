@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">

        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('articles.create') }}">Create New Article</a>
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

<div class="form-group">
    <input type="text" class="form-control" id="search-input" placeholder="Search...">
</div>

<div id="search-results" style="background-color: #cad5c5"></div>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Description</th>
        @if(auth()->user()->role_id === 1)
        <th>Approved</th>
        @endif
        <th width="280px">Action</th>
    </tr>
    @foreach ($articles as $article)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $article->title }}</td>
        <td>{{ $article->description }}</td>

        @if(auth()->user()->role_id === 1)
        @if($article->approved)
        <td><i class="fas fa-check-circle" style="color: #008000; font-size: 20px; align-items: center"></i></td>
        @else
        <td><i class="fas fa-times-circle" style="color: red; font-size: 20px"></i></td>
        @endif

        @endif

        <td>
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('articles.edit', $article->id) }}">Edit</a>
                <a class="btn btn-success" href="{{ route('comments.show', $article->id) }}">Comments</a>
                @if(auth()->user()->role_id === 1)
                <a class="btn btn-success" href="{{ route('approve', $article->id) }}">Approve</a>


                @endif
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $articles->links() !!}

<script>
    $(document).ready(function () {
        $('#search-input').on('input', function () {
            let query = $(this).val().trim();

            if (query !== '') {
                $.ajax({
                    url: "{{ route('live-search') }}",
                    method: 'GET',
                    data: { query: query },
                    success: function (data) {
                        let results = '';


                        $.each(data, function (index, item) {
                            results += '<div>' + item.title + '</div>';
                        });

                        $('#search-results').html(results);
                    }
                });
            } else {
                $('#search-results').html('');
            }
        });
    });
</script>

@endsection
