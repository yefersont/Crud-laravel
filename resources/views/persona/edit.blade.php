@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/persona/'.$clientes->id)}}" method="post" enctype="multipart/form-data">
@csrf
{{method_field('PATCH')}}
@include('persona.form',['modo'=>'Editar']);


</form>

</div>
@endsection