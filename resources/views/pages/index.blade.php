@extends('layouts.app') 
@section('content')
<div class="jumbotron text-center">
                <h1>Welcome To Laravel!</h1>
                <p>
                  <a class="btn btn-primary btn-lg" href="{{ route('login') }}">{{ __('Login') }}</a>
                  <a class="btn btn-success btn-lg" href="{{ route('register') }}">{{ __('Register') }}</a>
                </p>
            </div>
@endsection
    
