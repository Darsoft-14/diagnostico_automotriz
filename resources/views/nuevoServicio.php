<!doctype html>
<html lang="en">
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

    <style type="text/css">
        .input-group > .select2-container {
            width: auto;
            flex: 1 1 auto;
        }

        .input-group > .select2-container .select2-selection--single {
            height: 74%;
            line-height: inherit;
            padding: 0.5rem 1rem;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
    </style>

  </head>
  <body>

<div class="container border border-dark rounded-1 mt-2" style="background-color: rgb(255, 255, 255);width:75%;">

<form id="formServicios" action="{{route('tomaServicios.store')}}" enctype="multipart/form-data" method="POST">
    @csrf
        <div class="row">
            <div class="col-md-4">
            <img src="{{ asset('../../imagenes/STALogo.png') }}" class="mt-3"  width="45%" height="69%">
            </div>
            <div class="col-md-6">
            <img src="imagenes/STALogo1.png" class="mt-3" width="80%" height="69%">
            </div>
            <div class="col-md-2">
                <div class="card border-none text-center mt-1">
                    <H6 class="bg-warning col-form" >N° SERVICIO</H6>

                    <label for="fecha" id="numServicio" class="col-form-label col-form-label-sm fs-5" style="color:rgb(255,0,0);">
                        <b>@php
                        $obtNumServicio = DB::table('toma_servicios')->max('num_servicio');
                        echo $obtNumServicio+1;
                        @endphp</b>
                    </label>
                    <input type="date" class="form-control form-control-sm text-center" value="<?php echo date("Y-m-d");?>" id="fecha" name="fecha">
                </div>
            </div>
        </div>
            <br>
            <button type="button" id="btnMostrar" onclick="limpImg()" class="btn btn-secondary" data-bs-dismiss="modal">Iniciar</button>
            <br>
                <div class="container border border-dark rounded-1" style="background-color: rgb(241, 240, 239)">
                    <br>
                <div class="row g-3">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><small>Placa:</small></span>
                            </div>
                            <select onchange="selectPlaca(event)" id="idPlaca" name="placa" class="form-control form-control-sm select2" style="background-color: rgb(255, 255, 255)" disabled>
                                <option selected="selected" value ="0">Seleccionar</option>
                                {{--  cargar los option desde la db  --}}
                                @php
                                    $vehiculos = DB::table('vehiculos')->get();
                                    foreach ($vehiculos as $vehiculo) {
                                        $cliente = DB::table('clientes')->find($vehiculo->client_id);
                                        echo "<option data-marca=$vehiculo->marca data-propietario=$cliente->nombre data-cedula=$cliente->cedula data-direccion=$cliente->direccion data-celular=$cliente->celular data-correo=$cliente->email value=$vehiculo->id> $vehiculo->placa </option>";
                                    };
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-text"><small>Marca:</small></div>
                            <input type="text" class="form-control form-control-sm" id="marca" name="marca" placeholder="Marca" style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <div class="input-group-text"><small>Propietario:</small></div>
                            <input type="text" class="form-control form-control-sm" id="propietario" name="propietario" placeholder="Propietario" style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                  </div>

                  <div class="row g-3">
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-text"><small>C.C:</small></div>
                            <input type="text" class="form-control form-control-sm" id="cedula" name="cedula" placeholder="Cedula" style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <div class="input-group-text"><small>Dir:</small></div>
                            <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Dirección" style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-text"><small>Cel:</small></div>
                            <input type="text" class="form-control form-control-sm" id="celular" name="celular" placeholder="Celular" style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <div class="input-group-text"><small>@:</small></div>
                            <input type="text" class="form-control form-control-sm" id="correo" name="correo" placeholder="E-mail" style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                    </div>
                  </div>
                  <br>
                </div>
                <br>

                <div class="container " style="background-color: rgb(253, 254, 255)">
                <!-- inputs llenar tabla-->
                <div class="ocultar">
                    <div class="row g-3">
                        <div class="col-md-3">

                            <input type="hidden" id="codigo" name="servicioCodigo">
                            <input type="hidden" id="nombre" name="servicioNombre">
                            <input type="text" style="display:none" name="nServicio" id="nServicio">
                            <input type="text" style="display:none" name="tabServicio" id="tabServicio">

                            <label for="inputServicio" class="form-label col-form-label-sm"><b>Servicio</b></label>
                            <select onchange="selectServicio(event)" id="servicio" name="servicio" class="form-control form-control-sm" disabled>
                            <option selected="selected" value ="0">Seleccionar</option>
                                <!--cargar los option desde la db-->
                                @php
                                    $servicios = DB::table("servicios")->get();
                                    foreach ($servicios as $servicio) {
                                        echo "<option data-codigo=$servicio->codigo data-nombre=$servicio->nombre value=$servicio->id> $servicio->nombre </option>";
                                    };
                                @endphp
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="inpuHora" class="form-label col-form-label-sm"><b>Hora(s)</b></label>
                            <input type="number" class="form-control form-control-sm" id="hora" name="servicioHora" onkeyup="calc();">
                        </div>
                        <div class="col-md-1">
                            <label for="inputValor" class="form-label col-form-label-sm"><b>Valor(H)</b></label>
                            <input type="number" class="form-control form-control-sm" id="valor" name="servicioValor" onkeyup="calc();">
                        </div>
                        <div class="col-md-2">
                            <label for="inputTotal" class="form-label col-form-label-sm"><b>Total</b></label>
                            <input type="number" class="form-control form-control-sm" id="total" name="servicioTotal" style="background-color: rgb(255, 255, 255)" disabled>
                        </div>
                        <div class="col-md-1">
                            <label  class="form-label col-form-label-sm">.</label>
                            <label id="agregar" class="form-control form-control-sm bg-primary">Agregar</label>
                        </div>
                    </div>
                </div>
                <!-- Fin inputs llenar tabla-->
                <table id="tServicios" class="table table-bordered border-dark table-sm" name="tablaServicios" style="width:96%;margin: 0 auto;">
                    <thead>
                      <tr style="background-color: #e4dede">
                        <th scope="col" width="6%">Codigo</th>
                        <th scope="col"><center>Descripción</center></th>
                        <th scope="col" width="11%">Horas/Servicio</th>
                        <th scope="col" width="9%">Valor/Hora</th>
                        <th scope="col" width="10%"><center>Total</center></th>
                        <th scope="col" width="8%" class="ocultar">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr style="background-color: #e4dede">
                            <th colspan="4"><center>TOTAL</center></th>
                            <th><center><span id="spTotal"></center></span></th>
                            <th class="ocultar"></th>
                        </tr>
                      </tfoot>
                  </table>
                </div>
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
            <br>
                <div class="container">
                    <div class="row" style="float: right;">
                        <div class="col-md-9">
                            <select name="control" id="control" class="form-select ">
                                <option selected="selected" value ="0">Orden Abierta</option>
                                <option  value ="1">Cerrar Orden-Imprimir</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                    {{--  <button type="button" id="btnOcultar" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  --}}
                            <button type="submit" id="btnEnviar" class="btn btn-primary">Enviar</button>
                        </div>
                </div>
                </div>
                <br>
              </form>
<br>
</div>
<br>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script type="text/javascript">
        var idGlob = 0;
        var tServi = [];

        function limpImg(){
            let imagenes = document.getElementById('imagenes[]');
            //alert(imagenes.files[0])
            if(imagenes.value == ""){
                console.log('vacio');
                document.getElementById('formServicios').reset();
                document.getElementById('idPlaca').disabled = false;
                document.getElementById('servicio').disabled = false;
            }else{
                console.log('lleno');
                location.reload();
                document.getElementById('formServicios').reset();
                document.getElementById('idPlaca').disabled = false;
                document.getElementById('servicio').disabled = false;
            }
            //console.log(imagenes.value);
        }

        $(document).ready(function() {

            $("#btnEnviar").click(function (e) {
                e.preventDefault();

                let placa = document.getElementById("idPlaca")
                //recibir los datos de la tablar
                recorrer();


                if(placa.value == 0 || tServi.length == 0){
                    Swal.fire(
                    'Ingresa toda la información requerida',
                    'Gracias!',
                    'error'
                    )
                }else{
                    $(".ocultar").toggle();
                    //recibir los datos de la tabla y los convierto para enviar
                    let array = tServi.toString();
                    document.getElementById("tabServicio").value = array;

                    let numServicio = $("#numServicio").text();
                    document.getElementById("nServicio").value = numServicio;

                    location.reload();
                    $(this).unbind('click').click();
                }
            });
        });

        function abrirNuevoTab(url) {
            // Abrir nuevo tab
            //var win = window.open(url, '_blank');
            var win = window.open(url);
            // Cambiar el foco al nuevo tab (punto opcional)
            win.focus();
          }


        $(".select2").select2({
        } );
        $('#servicio').select2();

        //relleno los input del  select placa
        function selectPlaca(e) {
            var marca =  e.target.selectedOptions[0].getAttribute("data-marca")
            document.getElementById("marca").value = marca;

            var propietario =  e.target.selectedOptions[0].getAttribute("data-propietario")
            document.getElementById("propietario").value = propietario;

            var cedula =  e.target.selectedOptions[0].getAttribute("data-cedula")
            document.getElementById("cedula").value = cedula;

            var direccion =  e.target.selectedOptions[0].getAttribute("data-direccion")
            document.getElementById("direccion").value = direccion;

            var celular =  e.target.selectedOptions[0].getAttribute("data-celular")
            document.getElementById("celular").value = celular;

            var email =  e.target.selectedOptions[0].getAttribute("data-correo")
            document.getElementById("correo").value = email;
        }
        //Fin relleno los input del  select placa

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
            result.value = parseFloat(h) * parseFloat(v);

          }

          //Funcionalidad del Boton cargar Servicios
          $("#agregar").click(function(){
            idGlob +=1;
            var codNombre = document.getElementById("servicio");
            var hora = document.getElementById("hora");
            var valor = document.getElementById("valor");

            if(codNombre.value == 0 || hora.value == 0 || valor.value == 0){
                Swal.fire(
                    'Ingresa toda la información requerida',
                    'Gracias!',
                    'error'
                )
            }else{
                var codigo = document.getElementById("codigo");
                var nombre = document.getElementById("nombre");
                var total = document.getElementById("total");
                //var resultado = parseInt(hora.value) * parseInt(valor.value);
                $("#tServicios>tbody").append("<tr id='tracciones"+idGlob+"'><td>"+codigo.value+"</td><td id="+codNombre.value+">"+nombre.value+"</td><td style='text-align: center;'>"+hora.value+"</td><td style='text-align: center;'>"+valor.value+"</td><td id="+total.value+"><input type='number' class='form-control form-control-sm tresult' id='tresult' name='tresult' style='background-color: rgb(255, 255, 255)' disabled value="+total.value+"></td><td class='ocultar'><button id='acciones"+idGlob+"' type='button' class='btn btn-danger btn-sm text-right acciones'><i class='fas fa-tools'></i></button></td></tr>");
                $("#acciones"+idGlob).click(function(event){
                    let id = this.id;
                    var obtenerFila = document.getElementById("tr"+id);
                    var datosFila = obtenerFila.getElementsByTagName("td");

                    Swal.fire({
                        title: '¿Que acción deseas realizar?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Editar',
                        denyButtonText: `Eliminar`,
                      }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            cod = datosFila[0].innerHTML,
                            nom = datosFila[1].innerHTML,
                            nomId = datosFila[1].id,
                            horas = datosFila[2].innerHTML,
                            val = datosFila[3].innerHTML,
                            tot = horas * val,

                            document.getElementById("codigo").value = cod;
                            document.getElementById("nombre").value = nom;
                            $('#servicio').val(nomId);
                            $('#servicio').trigger('change');
                            document.getElementById("hora").value = horas;
                            document.getElementById("valor").value = val;
                            document.getElementById("total").value = tot;
                            obtenerFila.remove();
                            sumar();
                        } else if (result.isDenied) {
                            obtenerFila.remove();
                            sumar();
                            Swal.fire('Servicio eliminado', '', 'success')
                        }
                      })

                });
                //limpiar los campos
                codigo.value="";
                nombre.value="";
                codNombre.value=0;
                $('#servicio').trigger('change');
                hora.value = "";
                valor.value = "";
                total.value = "";
                sumar();
            }
          });
          //Funcionalidad del Boton cargar Servicios


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


         /*$("#btnOcultar").click(function(){
            $(".ocultar").toggle();
            //$('td:nth-child(6)').toggle();
         })*/
    </script>
  </body>
</html>
