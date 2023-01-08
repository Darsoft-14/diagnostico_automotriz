<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicons/STALogo3.ico') }}">
    <title>STA | Nuevo_Servicio</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" integrity="sha512-2L0dEjIN/DAmTV5puHriEIuQU/IL3CoPm/4eyZp3bM8dnaXri6lK8u6DC5L96b+YSs9f3Le81dDRZUSYeX4QcQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js" integrity="sha512-jhV1NyiaGUuhKDn+6sd6nLLKNMUslj3hf7gDf3FcG1F2Fg1W7v6VO5Il1pxCKJeE4+X+/Ktuqx+v/HHpZJ2NOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.all.js" integrity="sha512-yyxy5XBZPSzBaeJ1qlMBsh4AEH3gSsJY00jcy2gA0PtUDuAmRQzMNWyaaIFbl50/XzuKPqrrIo58bMzl2uxBbQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </head>

  <body>

    <div class="container border border-dark rounded-1 mt-2" style="background-color: rgb(255, 255, 255);width:75%;">

        <form id="formServicios" action="{{route('tomaServicios.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                <img src="http://127.0.0.1:8000/imagenes/STALogo.png" class="mt-3"  width="45%" height="69%">
                </div>
                <div class="col-md-6">
                <img src="http://127.0.0.1:8000/imagenes/STALogo1.png" class="mt-3" width="80%" height="69%">
                </div>
                <div class="col-md-2">
                    <div class="card border-none text-center mt-1">
                        <H6 class="bg-warning col-form" >N° SERVICIO</H6>

                        <label for="fecha" id="numServicio" class="col-form-label col-form-label-sm fs-5" style="color:rgb(255,0,0);">
                            <b>{{$datos->num_servicio}}</b>
                        </label>
                        <input type="date" class="form-control form-control-sm text-center" value={{$datos->fecha}} id="fecha" name="fecha">
                    </div>
                </div>
            </div>
            {{--  bloque datos vehiculo  --}}
            <div class="container border border-dark rounded-1" style="background-color: rgb(241, 240, 239)">
                <br>
                <div class="row g-3">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-text"><small>Placa:</small></div>
                            <input type="text" class="form-control form-control-sm" id="placa" name="placa" placeholder="placa" value={{$datos->placa}} style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-text"><small>Marca:</small></div>
                            <input type="text" class="form-control form-control-sm" id="marca" name="marca" placeholder="Marca" value={{$datos->marca}} style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <div class="input-group-text"><small>Propietario:</small></div>
                            <input type="text" class="form-control form-control-sm" id="propietario" name="propietario" placeholder="Propietario" value={{$datos->nombre}} style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-text"><small>C.C:</small></div>
                            <input type="text" class="form-control form-control-sm" id="cedula" name="cedula" placeholder="Cedula" value={{$datos->cedula}} style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <div class="input-group-text"><small>Dir:</small></div>
                            <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Dirección" value={{$datos->direccion}} style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-text"><small>Cel:</small></div>
                            <input type="text" class="form-control form-control-sm" id="celular" name="celular" placeholder="Celular" value={{$datos->celular}} style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <div class="input-group-text"><small>@:</small></div>
                            <input type="text" class="form-control form-control-sm" id="correo" name="correo" placeholder="E-mail" value={{$datos->email}} style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                </div>
                <br>
            </div>
                <br>
            {{--  bloque agregar servicios  --}}
            <!-- Button trigger modal -->
            <button type="button" id="btnModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>



             <br>
                    {{--  card imagenes  --}}
                <div class="row" id="divFiles" style="width:60%;margin: 0 auto;">
                    <div class="form-group col-md-6" id="divImagenes">
                        <div class="card mb-3" style="max-width: 18rem;">
                            <div class="card-header text-black small" style="max-height: 2rem; background-color: #fac800">CARGAR IMAGENES</div>
                            <div class="card-body" style="background-color: #e7f09c88;">

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
                <div class="form-group col-md-6" id="divArchivos">
                    <div class="card mb-3" style="max-width: 18rem;">
                        <div class="card-header text-black small" style="max-height: 2rem; background-color: #fac800">DOCS ANEXOS</div>
                        <div class="card-body" style="background-color: #dfe7e088;">

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
                    <div class="modal-footer">
                        {{--  <button type="button" id="btnOcultar" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  --}}
                        <button type="submit" id="btnEnviar" class="btn btn-primary">Enviar</button>
                    </div>
        </form>
        <br>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="POST" action="{{route('vehiculos.store')}}" enctype="multipart/form-data">
                        @csrf @method('POST')
                        <select id="servicio" name="servicio" class="form-control form-control-sm">
                            <option selected="selected" value ="0">Seleccionar El Servicio</option>
                                <!--cargar los option desde la db-->
                                @php
                                    $servicios = DB::table("servicios")->get();
                                    foreach ($servicios as $servicio) {
                                        echo "<option data-codigo=$servicio->codigo data-nombre=$servicio->nombre value=$servicio->id> $servicio->nombre </option>";
                                    };
                                @endphp
                        </select>

                        <select id="propietario" name="propietario" class="form-control form-control-sm">
                            <option selected="selected">Seleccionar</option>
                            {{--  cargar los option desde la db  --}}
                            @php
                                //$nombres = DB::table('clientes')->pluck('nombre');
                                $clientes = DB::table('clientes')->get();
                                foreach ($clientes as $cliente) {
                                    echo "<option value=$cliente->id> $cliente->nombre </option>";
                                };
                            @endphp
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
        </div>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $(document).ready(function(){

              $('#btnModal').click(function(){
                $('#exampleModal').modal('show');
                $('#servicio').select2({
                    dropdownParent: $('#exampleModal')
                  });
                $('#propietario').select2({
                    dropdownParent: $('#exampleModal')
                  });
            });

        });


        //paso los valores necesarios a los input escondidos del 2do select
        function selectServicio(e) {
            var codigo =  e.target.selectedOptions[0].getAttribute("data-codigo")
            document.getElementById("codigo").value = codigo;
            var nombre =  e.target.selectedOptions[0].getAttribute("data-nombre")
            document.getElementById("nombre").value = nombre;
        }
        //Fin paso los valores necesarios a los input escondidos del 2do select

        //Multiplico las horas * el valor del servicio
        function calc() {
            var h = document.getElementById("hora").value;
            var v = document.getElementById("valor").value;

            var result = document.getElementById("total");
            result.value = parseInt(h) * parseInt(v);

          }


         function sumar(){
            var total = 0;
                //sumar los resultados de la tabla
                $(".tresult").each(function() {
                    total += parseInt($(this).val());
                });

                //alert(total);
                document.getElementById('spTotal').innerHTML = total;
         };

         function recorrer(){
             let celdasHoras = document.querySelectorAll('td');
             let j=0;
             for(let i=0; i < celdasHoras.length; ++i){
                if(j== 1 || j == 4){
                    tot2= celdasHoras[i].id;
                    tServi.push(tot2);
                }
                if(j>1 && j<4){
                    tot2= celdasHoras[i].innerHTML;
                    tServi.push(tot2);
                }
                if(j==5){
                    j=0;
                }else{
                    j++;
                }
             }

         };
    </script>
  </body>
</html>

