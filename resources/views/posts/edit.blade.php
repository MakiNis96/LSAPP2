@extends('layouts.app')
@section('content')
<h1>Edit post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group col-md-12 col-sm-12">
          
                {{Form::submit('Submit', ['class'=>'btn btn-success'])}}
                <button type="button" class="btn-primary fileInput btn" id="filebtn" onclick="$('#fileee').click()">
                        Choose image               
                </button>               
    
    
                {{Form::file('cover_image', ['style'=>'display:none;', 'id'=>'fileee'])}}
    
                <br/>
            <br/>
                <label id="filename" ></label>
            </div>
        {{Form::hidden('_method','PUT')}}
    {!! Form::close() !!}

@endsection
