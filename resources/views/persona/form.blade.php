
<h1>{{$modo}} Cliente</h1>


@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ul>        
    @foreach($errors->all() as $error)
        <li> {{$error}} </li>
    @endforeach 
    </ul>
</div>

@endif
<div class="form-group">
    <label for="nombre"> Nombre</label>
    <input type="text" class="form-control" value="{{ isset($clientes->nombre)?$clientes->nombre: old('nombre') }}" name="nombre">
    <br>
</div>
<div class="form-group">
    <label for="apellido"> Apellidos</label>
    <input type="text" class="form-control" value="{{ isset($clientes->apellido)?$clientes->apellido: old('apellido')}}" name="apellido">
    <br>
</div>
<div class="form-group">
    <label for="cedula"> Cedula</label>
    <input type="text" class="form-control" value="{{ isset($clientes->cedula)?$clientes->cedula: old('cedula')}}" name="cedula">
    <br>
</div>
<div class="form-group">
    <label for="telefono">Telefono</label>
    <input type="text" class="form-control" value="{{ isset($clientes->telefono)?$clientes->telefono: old('telefono')}}" name="telefono">
    <br>
</div>
<div class="form-group">
    <label for="foto">Foto</label>
    @if(isset($clientes->foto))
    <img src="{{ asset('storage').'/'.$clientes->foto }}" width="100" class="img-thumbnail img-fluid" alt="">
    @endif
    <input type="file" class="form-control" name="foto">
    <br>
</div>
    <input type="submit" value="{{$modo}} datos" class="btn btn-primary">
    
    <a href="{{url('persona/')}}" class="btn btn-success"> Regresar</a>

