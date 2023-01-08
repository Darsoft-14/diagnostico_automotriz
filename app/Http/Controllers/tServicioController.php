<?php

namespace App\Http\Controllers;

use App\Models\arch_servicios;
use App\Models\img_servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\servicios_ts;
use App\Models\toma_servicio;
use PDF;




class tServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensaje = "";
        //estado activo es 0
        $servicios = DB::table('toma_servicios')
                    ->join('vehiculos', 'toma_servicios.placa','vehiculos.id')
                    ->join('clientes', 'vehiculos.client_id','clientes.id')
                    ->select('toma_servicios.id','toma_servicios.num_servicio','toma_servicios.fecha','vehiculos.placa','clientes.nombre')
                    ->where('estado', '=', 0)
                    ->get();

        return view('tomaServicio')->with('servicios',$servicios)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cerradas()
    {
        //estado cerrado es 1
        $servicios = DB::table('toma_servicios')
                    ->join('vehiculos', 'toma_servicios.placa','vehiculos.id')
                    ->join('clientes', 'vehiculos.client_id','clientes.id')
                    ->select('toma_servicios.id','toma_servicios.num_servicio','toma_servicios.fecha','vehiculos.placa','clientes.nombre')
                    ->where('estado', '=', 1)
                    ->get();
        return view('ordenesCerradas')->with('servicios',$servicios);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // tomamos el numero de servicio
        $numServicio = $_POST['nServicio'];
        $fecha = $_POST['fecha'];
        $placa = $_POST['placa'];
        $estado = 0;//activo

        // $valid = DB::table('toma_servicios')->where('num_servicio', $numServicio)->exists();

            toma_servicio::create([
                'num_servicio' => $numServicio,
                'fecha' => $fecha,
                'placa' => $placa,
                'estado' => $estado
                ]);

            return redirect()->route('tomaServicios.edit', $numServicio);

    }

    //funcion para llamar los datos necesarios para la vista de los servicios
    private function datosServicios($numServicio){

        $dato = DB::table('toma_servicios')
                        ->join('vehiculos', 'toma_servicios.placa', '=', 'vehiculos.id')
                        ->join('clientes', 'vehiculos.client_id', '=', 'clientes.id')
                        ->select('toma_servicios.id','toma_servicios.num_servicio','toma_servicios.fecha','vehiculos.placa','vehiculos.marca','clientes.nombre','clientes.cedula','clientes.direccion','clientes.celular','clientes.email')
                        ->where('toma_servicios.num_servicio', '=' , $numServicio)
                        ->get();


        $servicios = DB::table('servicios_ts')
                        ->join('servicios', 'servicios_ts.id_servicio','servicios.id')
                        ->select('servicios_ts.id','servicios.codigo','servicios.nombre','servicios_ts.hora','servicios_ts.valor','servicios_ts.total')
                        ->where('servicios_ts.num_servicio', '=', $numServicio)
                        ->get();
        $datos = $dato[0];
        return [$datos, $servicios];
    }

    /**
     * dropzoneImg a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $nServicio
     * @return \Illuminate\Http\Response
     */

    public function dropzoneImg (Request $request,$nServicio){
        $request->validate([
            'imagenes' => 'required|image'
        ]);

        $files = $request->file('imagenes');
        $imgName = md5(rand(1000,5000));
        $imageName = $imgName . '.' . strtolower($files->getClientOriginalExtension());
        $upload_path = 'archivos/servicios/serviciosImg/'.trim($nServicio).'/';
        $url = $upload_path.$imageName;
        $files->move($upload_path, $imageName);
        img_servicios::create([
                        'servicio' => trim($nServicio),
                        'url' => $url
                    ]);

        //return back();
    }

    /**
     * dropzoneDoc a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $nServicio
     * @return \Illuminate\Http\Response
     */

    public function dropzoneDoc (Request $request,$nServicio){
        $request->validate([
            'archivos' => 'required|mimes:pdf,doc,docx,docm,odt,csv,xls,xlsx,xlsm,ods'
        ]);
                $files = $request->file('archivos');
                $archName = strtolower($files->getClientOriginalName());
                $upload_path = 'archivos/servicios/serviciosArch/'.trim($nServicio).'/';
                $url = $upload_path.$archName;
                $files->move($upload_path, $archName);

                arch_servicios::create([
                    'servicio' => trim($nServicio),
                    'url' => $url
                ]);
    }


    //implementar metodo para cargar los servicios a la orden de servicio

     /**
     * Newservor the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newservor(Request $request)
    {
        $numServi = $_POST['numServi'];
        $serviTotal = $_POST['servicioTotal'];
        $idServicio = $_POST['servic'];
        $serviHora = $_POST['servicioHora'];
        $serviValor = $_POST['servicioValor'];

        servicios_ts::create([
            'num_servicio' => $numServi,
            'id_servicio' => $idServicio,
            'hora' => $serviHora,
            'valor' => $serviValor,
            'total' => $serviTotal
        ]);

        return back();

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serv = $id;
        $servicios = DB::table('servicios_ts')
                        ->join('servicios', 'servicios_ts.id_servicio','servicios.id')
                        ->select('servicios.codigo','servicios.nombre','servicios_ts.hora','servicios_ts.valor','servicios_ts.total')
                        ->where('servicios_ts.num_servicio', '=', $serv)
                        ->get();

        $pdf = PDF::loadView('reporte',['servicios'=>$servicios,'serv'=>$serv]);
        return $pdf->stream("Servicio.pdf",array("Attachment" => false));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //llamamos la funcion para llamar los servicios
        list($datos, $servicios) = $this->datosServicios($id);

        //return $datos;
       return view('editarOrden')->with('datos',$datos)
                                       ->with('servicios',$servicios);
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
        //actualizar orden de servicio
        $orden = toma_servicio::find($id);
        $orden->fecha = $request->fecha;
        $orden->estado = $request->control;
        $orden->save();
        //return $request->all();
        return back();
    }

    //actualizar los servicios de la orden de servicio
    /**
     * Newservor the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function actualizarserv(Request $request)
    {
        $numServi = $_POST['editServNum'];
        $idServicio = $_POST['editServId'];

        $editServ = servicios_ts::find($idServicio);
        $editServ->hora = $request->servicioHora;
        $editServ->valor = $request->servicioValor;
        $editServ->total = $request->editServTotal;
        $editServ->save();


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
        servicios_ts::destroy($id);

       return back();
    }

    public function eliminarImg($id){

        $imagen = img_servicios::find($id);
         $url = $imagen->url;
         if(File::exists($url)){
            File::delete($url);
         }

         img_servicios::destroy($id);

        return back();
    }

    public function eliminarDoc($id){

        $imagen = arch_servicios::find($id);
         $url = $imagen->url;
         if(File::exists($url)){
            File::delete($url);
         }

         arch_servicios::destroy($id);

        return back();
    }


}
