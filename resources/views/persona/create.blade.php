@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/persona')}}" method="post" enctype="multipart/form-data">

@csrf 

@include('persona.form',['modo'=>'Crear']);



</form>

</div>

@endsection