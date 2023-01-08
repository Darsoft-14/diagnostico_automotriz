@extends('adminlte::page')

@section('title', 'Servicio')

@section('content_header')
<!-- Button modal add-->
<button id="open-modal" type="button" class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#modNuevoServ">
    <i class="fas fa-tools"></i>_NUEVOs
</button>
@stop

@section('content')

<input type="hidden" id="mensaje" name="servicioCodigo" value={{$mensaje}}>

<div class="table-responsive">
    <table id="servicios" class="table table-sm  table-bordered table-hover table-striped mt-4" style="width:80%;margin: 0 auto;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Descrpción</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
            <tr>
                <td width="10%">{{$servicio->codigo}}</td>
                <td>{{$servicio->nombre}}</td>
                <td width="10%">
                    <button id="btnNuevo" type="button" class="btn btn-warning btn-sm text-right" data-toggle="modal" data-target="#modEditar{{$servicio->id}}">
                        <i class="fas fa-marker"></i>
                    </button>
                    <!--modal para CRUD  Editar-->
                    <div class="modal fade" id="modEditar{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="exampleModalLabel">EDITAR SERVICIO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>

                            <form id="formClientes" action="{{route('servicios.update', $servicio->id)}}" method="POST">
                                @csrf @method('PUT')
                            <div class="modal-body">

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="codigo" class="col-form-label">Codigo</label>
                                    <input autocomplete="new-text" type="text" class="form-control" id="codigo" name="codigo" value="{{$servicio->codigo}}" onkeyup="mayusculas(this);" required>
                                </div>
                                <div class="form-group col-md-10">
                                    <label for="nombre" class="col-form-label">Nombre</label>
                                    <input autocomplete="new-text" type="text" class="form-control" id="nombre" name="nombre" value="{{$servicio->nombre}}" onkeyup="mayusculas(this);" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Se va a eliminar el Servicio <b>{{$servicio->nombre}}</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                            <div class="modal-body">
                                <p>¿Estas seguro de eliminar este servicio?</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                            <form action="{{route('servicios.destroy',$servicio->id)}}" method="POST">
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
    </table>
</div>


@include('modCrearServicio');

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }
        $(document).ready(function(){

            function mensaje(){
                if(document.getElementById("mensaje").value == "ya"){

                    Swal.fire(
                    'ERROR',
                    'Ya existe el Registro',
                    'warning'
                    )
                }
                if(document.getElementById("mensaje").value == "no"){
                    Swal.fire(
                    'El registro ha sido exitoso',
                    '.',
                    'success'
                    )
                }
            }

            mensaje();

            $('#servicios').DataTable({
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
            });
        });

        $('.modal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
            $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
        });

        function abrirNuevoTab(url) {
            // Abrir nuevo tab
            var win = window.open(url, '_blank');
            // Cambiar el foco al nuevo tab (punto opcional)
            win.focus();
          }
          $('#open').click(function(){
            abrirNuevoTab('/nuevo_servicio')
          })
    </script>
@stop
