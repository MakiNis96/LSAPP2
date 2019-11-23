@if(count($errors) > 0)           <!--greske u validaciji -->
@foreach($errors->all() as $error)
<div class="alert alert-danger">
    {{$error}}
</div>
@endforeach
@endif

@if(session('success'))           <!--greske u sesiji -->
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif
@if(session('error'))           <!--greske u sesiji -->
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif