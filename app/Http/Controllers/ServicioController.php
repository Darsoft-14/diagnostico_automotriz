<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensaje = "";
        $servivios = DB::table("servicios")->get();
        return view ('servicio')->with('servicios',$servivios)
                                ->with('mensaje',$mensaje);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'codigo' => 'required',
            'nombre' => 'required'
        ]);
        $servicio = new Servicio;

        $servicio->codigo = $request->get('codigo');
        $servicio->nombre = $request->get('nombre');


        $codigo = $request->get('codigo');
        $valid1 = DB::table('servicios')->where('codigo', $codigo)->exists();
        $nombre = $request->get('nombre');
        $valid2 = DB::table('servicios')->where('nombre', $nombre)->exists();

        if($_POST['control'] == 0){

            if ($valid1 == 1 || $valid2 == 1) {
                return "existe";
            } else {
                $servicio->save();
                return back();
            }

        }else{

            if ($valid1 == 1 || $valid2 == 1) {
                $mensaje = "ya";
                $servicios = DB::table("servicios")->get();
                return view ('servicio')->with('servicios',$servicios)
                                        ->with('mensaje',$mensaje);
            } else {
                $mensaje = "no";
                $servicio->save();
                $servivios = DB::table("servicios")->get();
                return view ('servicio')->with('servicios',$servivios)
                                        ->with('mensaje',$mensaje);
            }
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
        $this->validate($request,[
            'codigo' => 'required',
            'nombre' => 'required'
        ]);

        $servicio = Servicio::find($id);

        $servicio->codigo = $request->codigo;
        $servicio->nombre = $request->nombre;

        $servicio->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Servicio::destroy($id);
        return back();
    }
}
