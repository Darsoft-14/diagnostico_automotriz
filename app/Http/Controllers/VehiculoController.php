<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vehiculo;
use App\Models\imgVehiculo;
use App\Models\archVehiculo;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensaje = "";
        $vehiculos = DB::table("vehiculos")
                        ->join('clientes', 'vehiculos.client_id','clientes.id')
                        ->select('vehiculos.id','clientes.nombre','vehiculos.placa', 'vehiculos.linea', 'vehiculos.marca', 'vehiculos.modelo', 'vehiculos.vin', 'vehiculos.motor', 'vehiculos.color', 'vehiculos.modelo')
                        ->get();
        // $vehiculos = DB::table("vehiculos")->get();

        return view ('vehiculo')->with('vehiculos',$vehiculos)
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
            //'imagenes' => 'required|image',
            'propietario' => 'required',
            'placa'     => 'required',
            'linea'     => 'required',
            'marca'     => 'required',
            'modelo'    => 'required',
            'vin'       => 'required',
            'motor'     => 'required',
            'color'     => 'required',
            'tipo'      => 'required'
        ]);

        $vehiculos = new Vehiculo;

        $vehiculos->client_id = $request->get('propietario');
        $vehiculos->placa = $request->get('placa');
        $vehiculos->linea = $request->get('linea');
        $vehiculos->marca = $request->get('marca');
        $vehiculos->modelo = $request->get('modelo');
        $vehiculos->vin = $request->get('vin');
        $vehiculos->motor = $request->get('motor');
        $vehiculos->color = $request->get('color');
        $vehiculos->tipo = $request->get('tipo');

        $placa = $request->placa;
        $prop = $request->get('propietario');

        $valid = DB::table('vehiculos')->where('placa', $placa)->exists();
        //return $img;

        if($prop == "Seleccionar"){
            $mensaje = "Seleccionar";
            $vehiculos = DB::table("vehiculos")->get();
            return view ('vehiculo')->with('vehiculos',$vehiculos)
                                    ->with('mensaje',$mensaje);

        }
        if ($valid == 1) {
            $mensaje = "ya";

            $vehiculos = DB::table("vehiculos")->get();
            return view ('vehiculo')->with('vehiculos',$vehiculos)
                                    ->with('mensaje',$mensaje);
        } else {
            $mensaje = "no";
            //guardar los datos generales
            $vehiculos->save();

            //guardar las imagenes
            if($files = $request->file('imagenes')){

                foreach($files as $file){
                    $imgName = md5(rand(1000,5000));
                    $imageName = $imgName . '.' . strtolower($file->getClientOriginalExtension());
                    $upload_path = 'archivos/vehiculos/vehiculosImg/'.$placa.'/';
                    $url = $upload_path.$imageName;
                    $file->move($upload_path, $imageName);

                    imgVehiculo::create([
                        'placa' => $placa,
                        'url' => $url
                    ]);
                }
            }

            //guardar los archivos
            if($files = $request->file('archivos')){

                foreach($files as $file){
                    $archName = strtolower($file->getClientOriginalName());
                    $upload_path = 'archivos/vehiculos/vehiculosArch/'.$placa.'/';
                    $url = $upload_path.$archName;
                    $file->move($upload_path, $archName);

                    archVehiculo::create([
                        'placa' => $placa,
                        'url' => $url
                    ]);
                }
            }

            $vehiculos = DB::table("vehiculos")
                        ->join('clientes', 'vehiculos.client_id','clientes.id')
                        ->select('vehiculos.id','clientes.nombre','vehiculos.placa', 'vehiculos.linea', 'vehiculos.marca', 'vehiculos.modelo', 'vehiculos.vin', 'vehiculos.motor', 'vehiculos.color', 'vehiculos.modelo')
                        ->get();

            return view ('vehiculo')->with('vehiculos',$vehiculos)
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
        $vehiculo = DB::table("vehiculos")->find($id);
        $nombre = DB::table('clientes')->find($vehiculo->client_id);
        //$vehiculo=Vehiculo::find($id);
        //devuelvo la vista editar
         return view('vehiculoEdit')->with('vehiculo',$vehiculo)
                                    ->with('nombre',$nombre);

       // return $nombre;

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
            //'imagenes' => 'required|image',
            'propietario' => 'required',
            'placa'     => 'required',
            'linea'     => 'required',
            'marca'     => 'required',
            'modelo'    => 'required',
            'vin'       => 'required',
            'motor'     => 'required',
            'color'     => 'required',
            'tipo'      => 'required'
        ]);

        $vehiculo = Vehiculo::find($id);

        $vehiculo->client_id = $request->propietario;
        $vehiculo->placa = $request->placa;
        $vehiculo->linea = $request->linea;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->vin = $request->vin;
        $vehiculo->motor = $request->motor;
        $vehiculo->color = $request->color;
        $vehiculo->tipo = $request->tipo;
        $vehiculo->save();


        $placa = $request->placa;

        if($files = $request->file('imagenes')){

            foreach($files as $file){
                $imgName = md5(rand(1000,5000));
                $imageName = $imgName . '.' . strtolower($file->getClientOriginalExtension());
                $upload_path = 'archivos/vehiculos/vehiculosImg/'.$placa.'/';
                $url = $upload_path.$imageName;
                $file->move($upload_path, $imageName);

                imgVehiculo::create([
                    'placa' => $placa,
                    'url' => $url
                ]);
            }
        }

        if($files = $request->file('archivos')){

            foreach($files as $file){
                $archName = strtolower($file->getClientOriginalName());
                $upload_path = 'archivos/vehiculos/vehiculosArch/'.$placa.'/';
                $url = $upload_path.$archName;
                $file->move($upload_path, $archName);

                archVehiculo::create([
                    'placa' => $placa,
                    'url' => $url
                ]);
            }
        }

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
        //
    }
}
