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

    {{-- deo za dodavanje komentara --}}
    <a class="btn btn-default" href="/comments/create/{{$post->id}}">Create Comment </a> 

    <h1>Comments</h1>
    @if(count($comments) > 0)
@foreach($comments as $comment)

<div class="well">
    <div class="row">
        <div class="col-md-8 col-sm-8">
        <p>{{$comment->text}}</p>
        
            {{--<h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3> --}}
            <small>Written on {{$comment->created_at}} by {{$comment->user['name']}} </small>
            
            @if($comment->user_id == Auth::user()->id)
            {!!Form::open(['action' => ['CommentsController@destroy', $comment['id']], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
            @endif
        </div>
    </div>
</div>
<br/>
@endforeach
{{--{{$posts->links()}}--}}
@else 
<p>No comments!</p>
@endif
@endsection