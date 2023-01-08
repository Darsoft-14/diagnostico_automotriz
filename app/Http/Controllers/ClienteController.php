<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensaje = "";
        $clientes = Cliente::all();
        return view('cliente')->with('clientes',$clientes)
                              ->with('mensaje',$mensaje);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'cedula' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'celular' => 'required'
        ]);



        $clientes = new Cliente;

        $clientes->nombre = $request->get('nombre');
        $clientes->cedula = $request->get('cedula');
        $clientes->direccion = $request->get('direccion');
        $clientes->ciudad = $request->get('ciudad');
        $clientes->celular = $request->get('celular');
        $clientes->telfijo = $request->get('telefono');
        $clientes->email = $request->get('correo');

        $cedula = $request->get('cedula');
        $valid = DB::table('clientes')->where('cedula', $cedula)->exists();

        if ($valid == 1) {
            $mensaje = "ya";
            $clientes = Cliente::all();
            return view('cliente')->with('clientes',$clientes)
                              ->with('mensaje',$mensaje);
        } else {
            $mensaje = "no";
            $clientes->save();
            $clientes = Cliente::all();
            return view('cliente')->with('clientes',$clientes)
                                  ->with('mensaje',$mensaje);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->nombre = $request->nombre;
        $cliente->cedula = $request->cedula;
        $cliente->direccion = $request->direccion;
        $cliente->ciudad = $request->ciudad;
        $cliente->celular = $request->celular;
        $cliente->telfijo = $request->telefono;
        $cliente->email = $request->correo;

        if($cliente->save()){
            return redirect('cliente');
        }else{
            return view('cliente');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect('cliente');
    }
}
