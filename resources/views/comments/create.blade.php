@extends('layouts.app')
@section('content')
<h1>Create comment</h1>
{{-- koriscena naredba composer require "laravelcollective/html" --}}
{{-- u config/app dodato rucno ono sto je na tutorijalu on iskopirao --}}

{!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!} 
{{-- gadja store u post conrolleru, metodom post --}}

    <div class="form-group">
        {{Form::text('comment', '', ['class'=>'form-control', 'placeholder'=>'Comment']  )}}
    </div>

    {{-- <input name="post_id" type="hidden" value={{$id}}>  --}}
    {{ Form::hidden('post_id', $id) }}

{{Form::submit('Submit', ['class'=>'btn btn-success'])}}

{!! Form::close() !!} 

@endsection