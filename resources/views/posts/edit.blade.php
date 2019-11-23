@extends('layouts.app')
@section('content')
<h1>Edit post</h1>
<form method="post" action="{{ route('posts.update',$post->id) }}">

        <div class="form-group">

            @method('PUT')
            @csrf            
            <label for="title">Title</label>

            <input type="text" value="{{$post->title}}" class="form-control" name="title" placeholder="Title"/>

        </div>

        <div class="form-group">

            <label for="body">Body</label>

            <textarea class="form-control" name="body" cols="30" rows="10" placeholder="Body Text">{{$post->body}}</textarea>

        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
 </form>
@endsection