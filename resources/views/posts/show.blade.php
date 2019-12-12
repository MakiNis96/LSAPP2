
@extends('layouts.app')
@section('content')
<div class="well" style="float:right">
    <div class="row">
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary col-md-6 col-sm-6">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right col-md-2 col-sm-2'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
    </div>
</div>
<div class="well">
<div class="row" >
    <div class="col-md-12 col-sm-12" >
        <div class="col-md-2 col-sm-2" style="float:left">
            <div class="col-md-12 col-sm-12" >
                <h3>{{$post->title}}</h3>        
                <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                
            </div>
        </div>
        
        <div class="col-md-10 col-sm-10" style="float:left">
          
            <small>Written on {{$post->created_at}}</small>
            <br/>
            <br/>
            {!!$post->body!!}
            
        </div>
    </div>
</div>
</div>
<hr/>
    {{-- deo za dodavanje komentara --}}
<div class="well">
    <div class="row">
        <h3 class="col-md-10 col-sm-10" style="position:center">Comments</h3>
        <a class="btn btn-primary col-md-2 col-sm-2" href="/comments/create/{{$post->id}}" style="float:right">Add Comment </a> 
 
    </div>
</div>
@if(count($comments) > 0)

    @foreach($comments as $comment)
<hr/>
    <div class="well">
        <div class="row">
            <div class="col-md-9 col-sm-9" style="float:left">
                <p>{{$comment->text}}</p>
                
                
            </div>
            <div class="col-md-3 col-sm-3" style="float:right">
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
    @endforeach
@else 
<p>No comments!</p>
@endif
@endsection