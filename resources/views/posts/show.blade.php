{{-- @extends('layouts.app')
@section('content')
<a href="/posts" class="btn btn-default">Go back</a>
<h1>{{$post->title}}</h1>
<div>{{$post->body}}</div>
<br>
<small>Written on {{$post->created_at}}</small>
<br>
<a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

<form action="{{ route('posts.destroy',$post->id) }}" method="POST">
@csrf
@method('DELETE')
<!-- delete button -->
            <button type="submit" class="btn btn-danger float-right">Delete</button>
</form>
@endsection --}}

@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <div class="col-md-2 col-sm-2" >
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    </div>
    <br><br>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection