{{--  Modal NUEVA ORDEN   --}}
<div class="modal fade" id="modNuevo" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">NUEVA ORDEN DE SERVICIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">

          <!--aqui empieza el formulario -->
          <form method="POST" action="{{route('tomaServicios.store')}}">
              @csrf @method('POST')

              <div class="card  mb-3 bg-light">
              <div class="form-row">
                  <div class="form-group col">
                      <label for="selectPropietario" class="col-form-label col-form-label-sm">Seleccione la placa del vehiculo al cual se le va a generar la nueva orden de servicio</label>
                  </div>
              </div>
               <select id="placa" name="placa" class="form-control form-control-sm">
                   <option selected="selected" value="0">Seleccionar</option>
                   {{--  cargar los option desde la db  --}}
                   @php
                       $obtNumServicio = DB::table('toma_servicios')->max('num_servicio');
                       $vehiculos = DB::table('vehiculos')->get();
                       foreach ($vehiculos as $vehiculo) {
                           echo "<option value=$vehiculo->id> $vehiculo->placa </option>";
                       };
                   @endphp
               </select>

               <div class="form-row">
                 <div class="form-group col-md-5">
                   <label for="inputNumeroServicio" class="col-form-label col-form-label-sm">N° Servicio</label>
                   <input type="hidden" class="form-control form-control-sm" id="nServicio" name="nServicio" value={{$obtNumServicio+1}}>
                   <input type="text" class="form-control form-control-sm" value={{$obtNumServicio+1}} disabled>
                 </div>
                 <div class="form-group col-md-7">
                   <label for="inputFecha" class="col-form-label col-form-label-sm">Fecha</label>
                   <input type="date" class="form-control form-control-sm text-center" value="<?php echo date("Y-m-d");?>" id="fecha" name="fecha">
                 </div>
               </div>
              </div>
                {{--  botones  --}}
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                  <button type="submit" id="btnGenerar" class="btn btn-dark">Generar</button>
                </div>
            </form>

        </div>
      </div>
    </div>
  </div>
  {{--  FIN Modal NUEVA ORDEN   --}}
