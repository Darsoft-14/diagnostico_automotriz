@extends('adminlte::page')

@section('title', 'Vehículos')

@section('css')


@stop

@section('content_header')
{{--  botones  --}}
<div class="container">
<div class="float-left">
    <button type="submit" class="btn btn-dark float-right" form="editar">Guardar</button>
    <a href="{{route('vehiculo')}}" class="btn btn-light float-right">Cancelar</a>
    <h2 class="float-right"><u>Editar Vehiculos</u></h2>
</div>
</div>
<h1 style="color: #f4f6f9;">.</h1>
@stop

@section('content')

<div class="card mb-3" style="max-width: 1300px;">
    <div class="row no-gutters">
        {{--  card derecho  --}}
        <div class="col-md-6" >
        <div class="card-body" style="background-color: #f4f6f9;">

            <!--aqui empieza el formulario -->
        <form method="POST" id="editar" action="{{route('vehiculos.update', $vehiculo->id)}}" enctype="multipart/form-data">
            @csrf @method('PUT')
            {{--  card de parte superior formulario  --}}
            <div class="card  mb-3 bg-light">

            <label for="selectPropietario" class="col-form-label col-form-label-sm">Propietario</label>
            <select id="propietarioActu" name="propietario" class="form-control form-control-sm">
                <option selected="selected" value={{$nombre->id}}>{{$nombre->nombre}}</option>
                {{--  cargar los option desde la db  --}}
                @php
                    //$nombres = DB::table('clientes')->pluck('nombre');
                    $clientes = DB::table('clientes')->get();
                    foreach ($clientes as $cliente) {
                        echo "<option value=$cliente->id> $cliente->nombre </option>";
                    };
                @endphp
            </select>

            <div class="form-row">
                <div class="form-group col-md-2">
                <label for="inputPlaca" class="col-form-label col-form-label-sm">Placa</label>
                <input type="text" class="form-control form-control-sm" id="placa" name="placa" required value={{$vehiculo->placa}}>
                </div>
                <div class="form-group col-md-5">
                <label for="inputLinea" class="col-form-label col-form-label-sm">Línea</label>
                <input type="text" class="form-control form-control-sm" id="linea" name="linea" required value={{$vehiculo->linea}}>
                </div>
                <div class="form-group col-md-5">
                <label for="inputMarca" class="col-form-label col-form-label-sm">Marca</label>
                <input type="text" class="form-control form-control-sm" id="marca" name="marca" required value={{$vehiculo->marca}}>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputModelo" class="col-form-label col-form-label-sm">Modelo</label>
                    <input type="number" class="form-control form-control-sm" id="modelo" name="modelo" required value={{$vehiculo->modelo}}>
                </div>
                <div class="form-group col-md-8">
                    <label for="inputVin" class="col-form-label col-form-label-sm">VIN</label>
                    <input type="text" class="form-control form-control-sm" id="vin" name="vin" required value={{$vehiculo->vin}}>
                </div>
                </div>

                <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="inputMotor" class="col-form-label col-form-label-sm">Num Motor</label>
                    <input type="text" class="form-control form-control-sm" id="motor" name="motor" required value={{$vehiculo->motor}}>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputColor" class="col-form-label col-form-label-sm">Color</label>
                    <input type="text" class="form-control form-control-sm" id="color" name="color" required value={{$vehiculo->color}}>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTipo" class="col-form-label col-form-label-sm">Tipo Vehiculo</label>
                    <input type="text" class="form-control form-control-sm" id="tipo" name="tipo" required value={{$vehiculo->tipo}}>
                </div>
                </div>
            </div>
            {{--  fin card de parte superior formulario  --}}
                {{--  card imagenes  --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="card mb-3" style="max-width: 18rem;">
                        <div class="card-header text-white small bg-success" style="max-height: 2rem">CARGAR IMAGENES</div>
                        <div class="card-body" style="background-color: #dfe7e088;">

                        <div class="input-group mb-2">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input small" name="imagenes[]" id="imagenes[]" multiple accept="image/*">
                            <label class="custom-file-label small" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"><b>Elige las imagenes</b></label>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
                {{--  card archivos  --}}
                <div class="form-group col-md-6">
                <div class="card mb-3" style="max-width: 18rem;">
                    <div class="card-header text-white small bg-success" style="max-height: 2rem">DOCS ANEXOS</div>
                    <div class="card-body bg-light" style="background-color: #dfe7e088;">

                    <div class="input-group mb-2">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input small" name="archivos[]" id="archivos[]"
                            multiple accept=".pdf,.doc, .docx, .docm, .odt, .csv, .xls, .xlsx, .xlsm, .ods">
                        <label class="custom-file-label small" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"><b>Elige los Archivos</b></label>
                        </div>
                    </div>

                    </div>
                </div>
                </div>
            </div>
            </form>


        </div>
        </div>
        {{--  card izquierdo  --}}
        <div class="col-md-6">
        <div class="card-body">

            <div class="card mb-3">
                {{-- carrusel imagenes --}}
                <div class="card-body w-100 h-50" style="background-color: #f4f6f9;">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                        @php
                            $images = DB::table('img_vehiculos')->get();
                                $i = 0;
                        @endphp
                        @foreach ($images as $image)
                            @if ($image->placa == $vehiculo->placa)
                                @if ($i == 0)
                                <div class="carousel-item active">
                                    <center><img src="{{URL::to($image->url)}}" type="button" class="d-block" data-toggle="modal" data-target="#modEliminarImg{{$image->id}}" height="200"></center>
                                </div>
                                <div class="modal fade" id="modEliminarImg{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar esta imagen?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                                <form action="{{route('imgVehiculos.destroy',$image->id)}}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                @php
                                $i=1;
                                @endphp
                                @else
                                <div class="carousel-item">
                                    <center><img src="{{URL::to($image->url)}}" type="button" class="d-block" data-toggle="modal" data-target="#modEliminarImg{{$image->id}}" height="200"></center>
                                </div>
                                <div class="modal fade" id="modEliminarImg{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar esta imagen?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                                <form action="{{route('imgVehiculos.destroy',$image->id)}}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                @endif

                            @endif
                        @endforeach

                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #050505;"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #050505;"></span>
                            <span class="sr-only">Next</span>
                        </button>
                        </div>
                </div>
                <!--mostrando archivos-->
                    {{--  <h5 class="card-title">DOCUMENTOS</h5>  --}}

                    <div class="table-responsive">
                        <table class="table table-sm  table-bordered table-hover table-striped mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nombre Archivo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $archivos = DB::table('arch_vehiculos')->get();
                                @endphp
                                @foreach ($archivos as $archivo)
                                    @php
                                        $nombre= substr($archivo->url, 40);
                                    @endphp
                                    @if ($archivo->placa == $vehiculo->placa)
                                        <tr>
                                            <td class="small"><b>{{$nombre}}</b></td>
                                            <td width="19%" class="small">
                                                <a href="{{URL::to($archivo->url)}}" target="_blank" class="btn btn-warning btn-sm text-right float-left">
                                                    <ion-icon name="eye-outline"></ion-icon>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm text-right float-right" data-toggle="modal" data-target="#modEliminarArch{{$archivo->id}}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modEliminarArch{{$archivo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar este Archivo?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{$nombre}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                                                    <a href="{{route('imgVehiculos.show',$archivo->id)}}" class="btn btn-danger">
                                                        Eliminar
                                                    </a>
                                                </form>
                                                </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        </div>
    </div>
</div>

@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


<script type="text/javascript">

    {{--  iniciar datatable  --}}
    $(document).ready(function(){
        $('#vehiculos').DataTable();
    });

    {{--  pone la cantidad de archivos cargados  --}}
    $('.custom-file-input').on('change', function(event) {
        var inputFile = event.currentTarget;
        $(inputFile).parent()
            .find('.custom-file-label')
            .html(this.files.length + " archivos cargados");
    });

    {{--  funcionalidad del select2  --}}
    $('#propietarioActu').select2();

    {{--  limpiar los modal  --}}
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
        $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
    });

    $('.carousel').carousel('pause');

</script>
@stop
