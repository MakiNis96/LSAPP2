@extends('layouts.app')
<div class="main-container" >
    @section('content')
    <div class="form-group col-md-12 col-sm-12">
    <h1>Create post</h1>
    </div>
    {{-- koriscena naredba composer require "laravelcollective/html" --}}
    {{-- u config/app dodato rucno ono sto je na tutorijalu on iskopirao --}}

    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} 
    {{-- gadja store u post conrolleru, metodom post --}}

        <div class="form-group col-md-12 col-sm-12">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title']  )}}
        </div>

        <div class="form-group col-md-12 col-sm-12">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['class'=>'form-control', 'placeholder'=>'Body']  )}}
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


    {!! Form::close() !!} 

    @endsection
</div>