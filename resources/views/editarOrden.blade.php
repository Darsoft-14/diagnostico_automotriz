@extends('adminlte::page')

@section('title', 'Editar Orden')

@section('content_header')
<div class="row" style="width:40%;margin: 0 auto;">
    <div class="col-md-3">
        <label for="inputNumeroServicio" class="col-form-label">N°Servicio:</label>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control bg-warning" value={{$datos->num_servicio}} disabled>
    </div>
    <div class="col-md-2">
        <label for="inputFecha" class="col-form-label">Fecha:</label>
    </div>
    <div class="col-md-4">
        <input type="date" class="form-control text-center" value={{$datos->fecha}} id="fecha" name="fecha">
    </div>
  </div>
  <hr>
@stop

@section('content')

<div class="row" style="width:83%;margin: 0 auto;">
    <div class="col-md-2">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text form-control-sm" id="basic-addon1">Placa</span>
            </div>
            <input type="text" class="form-control form-control-sm bg-white" aria-describedby="basic-addon1" value={{$datos->placa}} disabled>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text form-control-sm" id="basic-addon1">Marca</span>
            </div>
            <input type="text" class="form-control form-control-sm bg-white" aria-describedby="basic-addon1" value={{$datos->marca}} disabled>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text form-control-sm" id="basic-addon1">Cliente</span>
            </div>
            <label for="" class="form-control form-control-sm mr-sm-2">{{$datos->nombre}}</label>
        </div>
    </div>

    <div class="col-md-2">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text form-control-sm" id="basic-addon1">C.C</span>
            </div>
            <input type="text" class="form-control form-control-sm bg-white" aria-describedby="basic-addon1" value={{$datos->cedula}} disabled>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text form-control-sm" id="basic-addon1">Dir</span>
            </div>
            <input type="text" class="form-control form-control-sm bg-white" aria-describedby="basic-addon1" value={{$datos->direccion}} disabled>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text form-control-sm" id="basic-addon1">Cel</span>
            </div>
            <input type="text" class="form-control form-control-sm bg-white" aria-describedby="basic-addon1" value={{$datos->celular}} disabled>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text form-control-sm" id="basic-addon1">@</span>
            </div>
            <input type="text" class="form-control form-control-sm bg-white" aria-describedby="basic-addon1" value={{$datos->email}} disabled>
        </div>
    </div>
</div>

{{--  FORMULARIO PARA DILIGENCIAR LOS SERVICIOS  --}}
<div class="container" style="width:83%;margin: 0 auto;">
    <form method="POST" action="{{route('nuevaOrden')}}">
        @csrf @method('POST')

        <input type="hidden" id="numServi" name="numServi" value={{$datos->num_servicio}}>
        <input type="hidden" id="servicioTotal" name="servicioTotal">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="inputServicio" class="form-label col-form-label-sm"><b>Servicio</b>
                    <button id="open-modal" type="button" class="btn btn-success btn-sm text-right btnSmall" data-toggle="modal" data-target="#modNuevoServ">
                        <i class="fas fa-plus"></i>
                    </button>
                </label>
                <select id="servic" name="servic" class="form-control form-control-sm">
                    <option selected="selected" value="0">Seleccionar</option>
                    {{--  cargar los option desde la db  --}}
                    @php
                    $total = 0;
                    $i=0;
                        $servic = DB::table("servicios")->get();
                        foreach ($servic as $serv) {
                            echo "<option class='form-control form-control-sm' value=$serv->id> $serv->nombre </option>";
                        };
                    @endphp
                </select>
            </div>
            <div class="col-md-1">
                <label for="inpuHora" class="form-label col-form-label-sm"><b>Hora(s)</b></label>
                <input type="number" step="any" class="form-control form-control-sm" id="hora" name="servicioHora" onkeyup="calc();">
            </div>
            <div class="col-md-2">
                <label for="inputValor" class="form-label col-form-label-sm"><b>Valor(H)</b></label>
                <input type="number" class="form-control form-control-sm" id="valor" name="servicioValor" onkeyup="calc();">
            </div>
            <div class="col-md-2">
                <label for="inputTotal" class="form-label col-form-label-sm"><b>Total</b></label>
                <input type="number" class="form-control form-control-sm" id="total" style="background-color: rgb(255, 255, 255)" disabled>
            </div>
            <div class="col-md-1">
                <label  class="form-label col-form-label-sm">.</label>
                <button type="submit" id="btnAgregarServ" class="btn btn-primary btn-sm form-control-sm">Agregar</button>
            </div>
        </div>
    </form>
</div>

{{--  tabla  --}}
<div class="table-responsive">
    <table id="clientes" class="table table-sm  table-bordered table-hover table-striped mt-4" style="width:90%;margin: 0 auto;">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="8%"><center>CODIGO</center></th>
                <th scope="col" width=""><center>DESCRIPCION</center></th>
                <th scope="col" width="8%"><center>HORAS</center></th>
                <th scope="col" width="12%"><center>VALOR/HORA</center></th>
                <th scope="col" width="12%"><center>TOTAL</center></th>
                <th scope="col" width="12%"><center>Acciones</center></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
            <tr>
                @php
                    $total += $servicio->total;
                    $i +=1;
                @endphp
                <td><center>{{$servicio->codigo}}</center></td>
                <td>{{$servicio->nombre}}</td>
                <td><center>{{$servicio->hora}}</center></td>
                <td><center>${{number_format($servicio->valor, 0, ",", ".");}}</center></td>
                <td><center>${{number_format($servicio->total, 0, ",", ".");}}</center></td>
                <td>
                    <button id="btnNuevo" type="button" class="btn btn-warning btn-sm text-right" data-toggle="modal" data-target="#modEditar{{$servicio->id}}">
                        <i class="fas fa-marker"></i>
                    </button>
                    <!--modal para CRUD  Editar-->
                    <div class="modal fade" id="modEditar{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="exampleModalLabel">EDITAR</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form id="formClientes" action="{{route('nuevaOrdenUpdate')}}" method="POST">
                                @csrf @method('POST')
                            <div class="modal-body">
                            {{--  recibimos el id  --}}
                            <input type="hidden" id="editServId" name="editServId" value={{$servicio->id}}>
                            {{--  recibimos el numero de servicio  --}}
                            <input type="hidden" id="editServNum" name="editServNum" value={{$datos->num_servicio}}>
                            {{--  recibimos el total del servicio  --}}
                            <input type="hidden" id="editServTotal{{$i}}" name="editServTotal" value={{$servicio->total}}>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="codigo" class="col-form-label">Codigo</label>
                                    <input autocomplete="new-text" type="text" class="form-control" id="codigo" name="codigo" value="{{$servicio->codigo}}" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cedula" class="col-form-label">Descripción</label>
                                    <input autocomplete="new-text" type="text" class="form-control" id="codigo" name="codigo" value="{{$servicio->nombre}}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inpuHora" class="form-label col-form-label-sm"><b>Hora(s)</b></label>
                                    <input type="number" step="any" class="form-control form-control-sm" id="horaEdit{{$i}}" name="servicioHora" onkeyup="calcu1({{$i}})" value="{{$servicio->hora}}" required>
                                </div>
                                <div class="form-gorup col-md-6">
                                    <label for="inputValor" class="form-label col-form-label-sm"><b>Valor(H)</b></label>
                                    <input type="number" class="form-control form-control-sm" id="valorEdit{{$i}}" name="servicioValor" onkeyup="calcu1({{$i}})" value="{{$servicio->valor}}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputTotal" class="form-label col-form-label-sm"><b>Total</b></label>
                                    <input type="number" class="form-control form-control-sm" id="totalEdit{{$i}}" style="background-color: rgb(255, 255, 255)" value="{{$servicio->total}}" disabled>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-dark">Guardar</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    <!-- FIN modal para CRUD  Editar-->
                    <!--BOTON modal para CRUD  Eliminar-->
                    <button type="submit" class="btn btn-danger btn-sm text-right" data-toggle="modal" data-target="#modEliminar{{$servicio->id}}">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <!--modal para CRUD  Eliminar-->
                    <div class="modal fade" id="modEliminar{{$servicio->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Se va a eliminar el servicio <b>{{$servicio->nombre}}</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                            <div class="modal-body">
                                <p>¿Estas seguro de eliminar este servicio?</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                            <form action="{{route('tomaServicios.destroy',$servicio->id)}}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>

                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- FIN modal para CRUD  Eliminar-->
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot class="thead-dark">
            <tr style="background-color: #e4dede">
                <th colspan="4"><center>TOTAL</center></th>
                <th><center><span id="spTotal">${{number_format($total, 0, ",", ".");}}</span></center></th>
                <th></th>
            </tr>
          </tfoot>
    </table>
</div>
<br>
<div class="container margin" style="width:50%;margin: 0 auto;">
    <div class="row">
        <div class="card col-md-6" style="width: 18rem;">
            <h5 class="card-title" style="margin: 0 auto;">IMAGENES</h5>
            <hr>
            <div class="card-body"style="margin: 0 auto;">
                <!-- Button modal dropZoneImg -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dropZoneImg">
                    <i class="fas fa-plus-circle"></i>
                </button>

                <!-- Button modal dropZoneViewImg -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dropZoneViewImg">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        <div class="card col-md-6" style="width: 18rem;">
            <h5 class="card-title" style="margin: 0 auto;">ARCHIVOS</h5>
            <hr>
            <div class="card-body"style="margin: 0 auto;">
                <!-- Button modal dropZoneImg -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dropZoneDoc">
                    <i class="fas fa-plus-circle"></i>
                </button>

                <!-- Button modal dropZoneViewImg -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dropZoneViewDoc">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!--generar pdf-->
<div class="modal-footer">
    <form method="POST" id="actualizar" action="{{route('tomaServicios.update', $datos->id)}}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <input type="hidden" name="fecha" id="dateServicio">
        @php
        $estado = DB::table('toma_servicios')->where('num_servicio', $datos->num_servicio)->value('estado');
        @endphp
        @if ($estado == 0)
            <select name="control" id="control" class="form-select ">
                <option selected="selected" value ="0">Orden Abierta</option>
                <option  value ="1">Cerrar Orden</option>
            </select>
        @else
            <select name="control" id="control" class="form-select ">
                <option value ="0">Orden Abierta</option>
                <option selected="selected" value ="1">Cerrar Orden</option>
            </select>
        @endif

        <button type="submit" id="guardarCambios" class="btn btn-sm btn-dark">Guardar</button>
    </form>
    <a href="{{route('tomaServicios.show', $datos->num_servicio)}}" type="button" class="btn  btn-sm text-right" target="_blank"> Generar PDF
        <i class='fas fa-file-pdf  fa-2x' style='color: red;'></i>
    </a>
</div>

<!--modal para dropzoneImg-->
@include('modDzImgServicio')
<!-- FIN modal para  dropzoneImg-->
<!--modal para dropzoneImg-->
@include('modDzViewImg')
<!-- FIN modal para  dropzoneImg-->

<!--modal para dropzoneDoc-->
@include('modDzDocServicio')
<!-- FIN modal para  dropzoneDoc-->
<!--modal para dropzoneDoc-->
@include('modDzViewDoc')
<!-- FIN modal para  dropzoneDoc-->

<!--modal para CRUD  Nuevo servicio-->
<div class="modal fade" id="modNuevoServ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">NUEVO SERVICIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="formServicio">
          @csrf

          <div class="modal-body">

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputcod" class="col-form-label">Codigo</label>
                    <input type="text" class="form-control" onkeyup="mayusculas(this);" id="codigoServ" name="codigoServ" required>
                    <input type="hidden"  id="control" name="control" value={{$datos->num_servicio}}>
                </div>
                <div class="form-group col-md-10">
                    <label for="nombre" class="col-form-label">Nombre</label>
                    <input type="text" class="form-control" onkeyup="mayusculas(this);" id="nombreServ" name="nombreServ" required>
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-dark">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- FIN modal para CRUD  Nuevo-->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
    <style type="text/css">
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        .btnSmall {
            padding: 0 7px;
            height: 21px;
            align-items: center;
        }
        .btnSmall i {
            margin-top: 0px;
            padding: 0px;
            font-size: 12px;
            text-align: center;
        }

    </style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<script type="text/javascript">
    {{--  funcionalidad del select2  --}}
    $('#servic').select2();

    //Multiplico las horas * el valor del servicio
    function calc() {
        var h = document.getElementById("hora").value;
        var v = document.getElementById("valor").value;

        var result = document.getElementById("total");
        result.value = parseFloat(h) * parseFloat(v);

        var result2 = document.getElementById("servicioTotal");
        result2.value = parseFloat(h) * parseFloat(v);

      };

    function calcu1(num) {
        let hora = "horaEdit"+num;
        let valor = "valorEdit"+num;
        let total = "totalEdit"+num;
        let servTotal = "editServTotal"+num;

        var h = document.getElementById(hora).value;
        var v = document.getElementById(valor).value;

        var result = document.getElementById(total);
        result.value = parseFloat(h) * parseFloat(v);

        var result2 = document.getElementById(servTotal);
        result2.value = parseFloat(h) * parseFloat(v);

    }

        $(document).ready(function(){

            //formulario  crear servicio
            $('#formServicio').submit(function (e) {
                e.preventDefault();

                var control = $('#control').val();
                var codigo = $('#codigoServ').val();
                var nombre = $('#nombreServ').val();
                var _token = $('input[name=_token]').val();

                $.ajax({
                   url: "{{route('servicios.store')}}",
                   type: "POST",
                   data:{
                        control: control,
                        codigo: codigo,
                        nombre: nombre,
                        _token: _token
                   },
                   success:function(response){
                       if(response == "existe"){
                            $('#modNuevoServ').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'El codigo o nombre de servicio ya esta creado',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }else{
                            $('#modNuevoServ').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'El registro se ha guardado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        }
                   }

                });
            });

            //formulario agregar servicio
            $("#btnAgregarServ").click(function (e) {
                e.preventDefault();
                var codNombre = document.getElementById("servic");
                var hora = document.getElementById("hora");
                var valor = document.getElementById("valor");

                if(codNombre.value == 0 || hora.value == 0 || valor.value == 0){
                    Swal.fire(
                        'Ingresa toda la información requerida',
                        'Gracias!',
                        'error'
                    )
                }else{

                    $(this).unbind('click').click();
                }

            });

            /*$('#clientes').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar',
                    'paginate':{
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            });*/

            $("#guardarCambios").click(function (e) {
                e.preventDefault();
                document.getElementById('dateServicio').value = document.getElementById('fecha').value;
                $(this).unbind('click').click();
            });

        });


        $('.modal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
            $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
        });


        //iniciando dropzonImg
        Dropzone.options.dropzoneImg = {
            headers:{
                'X-CSRF-TOKEN' : "{{csrf_token()}}"
            },
            dictDefaultMessage: 'Sube aquí tus Imagenes',
            acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp",
            paramName: 'imagenes',
        };

        $('#dropZoneImg').on('hidden.bs.modal', function(){
            location.reload();
        });

        //iniciando dropzonDoc
        Dropzone.options.dropzoneDoc = {
            headers:{
                'X-CSRF-TOKEN' : "{{csrf_token()}}"
            },
            dictDefaultMessage: 'Sube aquí tus Archivos',
            acceptedFiles: ".pdf,.doc,.docx,.docm,.odt,.csv,.xls,.xlsx,.xlsm,.ods",
            paramName: 'archivos',
        };

        $('#dropZoneDoc').on('hidden.bs.modal', function(){
            location.reload();
        });

        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }




</script>
@stop
