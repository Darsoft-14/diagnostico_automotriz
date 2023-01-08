@extends('adminlte::page')

@section('title', 'Ordenes Cerradas')

@section('content_header')
<h1>Ordenes Cerradas</h1>
@stop

@section('content')

<div class="table-responsive">
    <table id="servicios" class="table table-sm  table-bordered table-hover table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="10%">N° Servicio</th>
                <th scope="col" width="11%"><center>Fecha</center></th>
                <th scope="col"><center>Placa</center></th>
                <th scope="col">Propietario</th>
                <th scope="col" width="6%"><center>PDF</center></th>
                {{--  <th scope="col" width="11%"><center>Acciones</center></th>  --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
            @php
            $originalDate = $servicio->fecha;
            $fecha = date("d/m/Y", strtotime($originalDate));
            @endphp
            <tr>
                <td><center>{{$servicio->num_servicio}}</center></td>
                <td><center>{{$fecha}}</center></td>
                <td><center>{{$servicio->placa}}</center></td>
                <td>{{$servicio->nombre}}</td>
                <td>
                    <center>
                        <a href="{{route('tomaServicios.show', $servicio->num_servicio)}}" type="button" class="btn  btn-sm text-right" target="_blank">
                            <i class='fas fa-file-pdf  fa-2x' style='color: red;'></i>
                        </a>
                    </center>
                </td>
                {{--  <td>
                    <a href="{{route('tomaServicios.edit', $servicio->id)}}" type="button" class="btn btn-warning btn-sm text-right" target="_blank">
                        <i class="fas fa-marker"></i>
                    </a>
                </td>  --}}
            </tr>

            @endforeach
        </tbody>
    </table>
</div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function(){
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
            //var win = window.open(url, '_blank');
            var win = window.open(url, '_blank');
            // Cambiar el foco al nuevo tab (punto opcional)
            win.focus();



          }
          $('#open').click(function(){

            abrirNuevoTab("{{ route('nuevoServicio') }}")
          })

          $('#open1').click(function(){
            abrirNuevoTab('/imprimirServicio')
          })
    </script>
@stop
