@extends('layouts.app')

@section('content')
<div class="container">


    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ Session::get('mensaje')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
    </div>

    @endif



<a href="{{url('persona/create')}}" class="btn btn-success"> Registar un cliente</a>
<br>
<br>
<table class="table table-borderless">
  <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Cedula</th>
            <th>Telefono</th>
            <th> Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($persona as $personas)
            <tr>
                <td>{{$personas->id}}</td>

                <td>
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$personas->foto }}" width="70" alt="">
                </td>

                <td>{{$personas->nombre}}</td>
                <td>{{$personas->apellido}}</td>
                <td>{{$personas->cedula}}</td>
                <td>{{$personas->telefono}}</td>
                <td>
                
                <a href="{{ url('/persona/'.$personas->id.'/edit/') }}" class="btn btn-warning">  Editar</a>

                <form action="{{url('/persona/'.$personas->id)}}"  class="d-inline" method="post">
                @csrf
                {{ method_field('DELETE')}}
                <input type="submit" value="Borrar" class="btn btn-danger" onclick="return confirm('Deseas borrar el resgistro??')">
                </form>    
            </td>
            </tr>
            @endforeach 
        </tbody>
</table>

{!! $persona->links() !!}

</div>

@endsection