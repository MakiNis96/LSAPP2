@extends('layouts.app')
@section('content')
<h1>Create post</h1>
{{-- koriscena naredba composer require "laravelcollective/html" --}}
{{-- u config/app dodato rucno ono sto je na tutorijalu on iskopirao --}}

{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} 
{{-- gadja store u post conrolleru, metodom post --}}

    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title']  )}}
    </div>

    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', '', ['class'=>'form-control', 'placeholder'=>'Body']  )}}
        {{-- ostaje textarea po dogovoru --}}
    </div>

    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>

{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

{!! Form::close() !!} 
<!-- <form method="post" action="{{ route('posts.store') }}"> -->

        <!-- <div class="form-group">

            //@csrf            
            <label for="title">Title</label>

            <input type="text" class="form-control" name="title" placeholder="Title"/>

        </div>

        <div class="form-group">

            <label for="body">Body</label>

            <textarea class="form-control" name="body" cols="30" rows="10" placeholder="Body Text"></textarea>

        </div> -->


<!-- 
        <button type="submit" class="btn btn-primary">Submit</button>
 </form> -->


@endsection