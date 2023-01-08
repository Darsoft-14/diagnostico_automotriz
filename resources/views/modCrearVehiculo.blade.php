{{--  Modal NUEVO VEHICULO   --}}
<div class="modal fade" id="modNuevo" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">NUEVO VEHICULO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">

          <!--aqui empieza el formulario -->
          <form method="POST" action="{{route('vehiculos.store')}}" enctype="multipart/form-data">
              @csrf @method('POST')
              {{--  card de parte superior formulario  --}}
              <div class="card  mb-3 bg-light">
              <div class="form-row">
                  <div class="form-group col-md-3">
                      <label for="selectPropietario" class="col-form-label col-form-label-sm">Propietario</label>
                  </div>
                  <div class="form-group col-md-3">
                      {{--  Button cliente modal  --}}
                      <button id="btnNuevo" type="button" class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#modNuevoCli">
                          <i class="fas fa-user-plus"></i>
                      </button>
                  </div>
              </div>
               <select id="propietario" name="propietario" class="form-control form-control-sm" required>
                   <option selected="selected" value="">Seleccionar</option>
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
                   <input type="text" class="form-control form-control-sm" id="placa" name="placa" required>
                 </div>
                 <div class="form-group col-md-5">
                   <label for="inputLinea" class="col-form-label col-form-label-sm">Línea</label>
                   <input type="text" class="form-control form-control-sm" id="linea" name="linea" required>
                 </div>
                 <div class="form-group col-md-5">
                   <label for="inputMarca" class="col-form-label col-form-label-sm">Marca</label>
                   <input type="text" class="form-control form-control-sm" id="marca" name="marca" required>
                 </div>
               </div>

               <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputModelo" class="col-form-label col-form-label-sm">Modelo</label>
                    <input type="number" class="form-control form-control-sm" id="modelo" name="modelo" required>
                  </div>
                  <div class="form-group col-md-8">
                    <label for="inputVin" class="col-form-label col-form-label-sm">VIN</label>
                    <input type="text" class="form-control form-control-sm" id="vin" name="vin" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-5">
                    <label for="inputMotor" class="col-form-label col-form-label-sm">Num Motor</label>
                    <input type="text" class="form-control form-control-sm" id="motor" name="motor" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputColor" class="col-form-label col-form-label-sm">Color</label>
                    <input type="text" class="form-control form-control-sm" id="color" name="color" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputTipo" class="col-form-label col-form-label-sm">Tipo Vehiculo</label>
                    <input type="text" class="form-control form-control-sm" id="tipo" name="tipo" required>
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
                {{--  botones  --}}
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-dark">Guardar</button>
                </div>
            </form>

        </div>
      </div>
    </div>
  </div>
  {{--  FIN Modal NUEVO VEHICULO   --}}
