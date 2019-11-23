@extends('layouts.app')
@section('content')
<a href="/lsapp2/public/posts" class="btn btn-default">Go back</a>
<h1>{{$post->title}}</h1>
<div>{{$post->body}}</div>
<br>
<small>Written on {{$post->created_at}}</small>
<br>
<a href="/lsapp2/public/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

<form action="{{ route('posts.destroy',$post->id) }}" method="POST">
@csrf
@method('DELETE')
<!-- delete button -->
            <button type="submit" class="btn btn-danger float-right">Delete</button>
</form>
@endsection