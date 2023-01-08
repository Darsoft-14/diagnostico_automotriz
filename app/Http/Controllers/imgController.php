<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imgVehiculo;
use App\Models\archVehiculo;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class imgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //eliminar archivos
        $arch = archVehiculo::find($id);
         $url = $arch->url;
         if(File::exists($url)){
            File::delete($url);
         }

         archVehiculo::destroy($id);

        return back();
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
    public function update(Request $request, $url)
    {
        return $url;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $imagen = imgVehiculo::find($id);
         $url = $imagen->url;
         if(File::exists($url)){
            File::delete($url);
         }

         imgVehiculo::destroy($id);

        return back();
    }
}
