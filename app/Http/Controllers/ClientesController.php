<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['persona']=clientes::paginate(10);
        return view('persona.index',$datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('persona.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos = [
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'cedula' => 'required|string|max:100',
        'telefono' => 'required|string|max:100',
        'foto' => 'required|max:10000|mimes:jpeg,png,jpg'
        ]; 
        
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'cedula.required' => 'La cedula es requerida',
            'foto.required' => 'La foto es requerida'
        ];

        $this->validate($request,$campos,$mensaje);
        $datospersona = request()->except('_token');

        if($request->hasFile('foto')){

            $datospersona['foto']=$request->file('foto')->store('uploads','public');
        
        }
        clientes::insert($datospersona);
        //return  response()->json($datospersona);
        return redirect('persona')->with('mensaje','Cliente Agregado'); 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $clientes = clientes::findOrFail($id);


        return view('persona.edit',compact('clientes'));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $campos = [
            
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cedula' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            
            ];
        $mensaje = [

            'required'=>'El :attribute es requerido',
        
        ];
        
        if($request->hasFile('foto')){

            $campos = ['foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje = ['foto.required' => 'La foto es requerida'];

        }
        $this->validate($request,$campos,$mensaje);



        $datospersona = request()->except(['_token','_method']);

        if($request->hasFile('foto')){

            $clientes = clientes::findOrFail($id);
            Storage::delete('public/'.$clientes->foto);
            $datospersona['foto'] = $request->file('foto')->store('uploads','public');
        }
        
        clientes::where('id','=',$id)->update($datospersona);
        $clientes = clientes::findOrFail($id);
        return redirect('persona')->with('mensaje','        Cliente Modificado   '); 


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $clientes = clientes::findOrFail($id);

        if(Storage::delete('public/'.$clientes->foto)){

            clientes::destroy($id);

        }
        return redirect('persona')->with('mensaje','        Cliente Eliminado   '); 

    }
}
