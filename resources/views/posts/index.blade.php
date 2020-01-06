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
            <div class="col-md-6 col-sm-6">
                <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3> 
                <small>Written on {{$post->created_at}} by {{$post->user['name']}}</small>
            </div>
            <div class="col-md-4 col-sm-4">
                @if(count($post->likes) == 1)  
                    <h2>{{$post->likes->count()}} like</h2>  
                @else  
                    <h2>{{$post->likes->count()}} likes</h2> 
                @endif 
                @if(!Auth::guest())
                @php $userLike = 0; @endphp
                @foreach($post->likes as $like)
                    @if($like->user->id == Auth::user()->id)
                        @php $userLike = 1; @endphp
                    @endif
                @endforeach
                @if($userLike == 0)
                <a href="posts/{{$post->id}}/like" class="btn btn-primary ">Like</a>
                @else
                <a href="posts/{{$post->id}}/like" class="btn btn-primary ">Dislike</a>
                @endif
            
                @endif

                {{-- pozeljno je koristiti <a> umesto dugmeta jer link moze da sadrzi celu putanju a dugme samo nadovezuje na trenutno ime kontrolera --}}
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