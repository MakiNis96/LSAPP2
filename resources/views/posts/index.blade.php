@extends('layouts.app')
@section('content')
<h1>Posts</h1>
@if(count($posts) > 0)
@foreach($posts as $post)

<div class="well">
    <div class="row">
        <div class="col-md-2 col-sm-2" >
            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
        </div>
        <div class="col-md-8 col-sm-8">
            <h5>potrebna je naredba php artisan storage:link da bi prikaz slika radio, 
                i u LSAPP2\storage\app\public\cover_images da se stavi defaultna koja ce da se zove noimage.jpg</h5>
            <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3> 
            <small>Written on {{$post->created_at}}</small>
        </div>
    </div>
</div>
<br/>
@endforeach
{{$posts->links()}}
@else 
<p>No posts found!</p>
@endif
@endsection