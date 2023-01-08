
<!--modal para CRUD  Nuevo-->
<div class="modal fade" id="modNuevoCli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">NUEVO CLIENTE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="formClientes" action="{{route('clientes.store')}}" method="POST">
          @csrf @method('POST')

          <div class="modal-body">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNombre" class="col-form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cedula" class="col-form-label">Cedula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" required pattern='.{6,12}' title='Digita bien la Cedula o Nit' onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="direccion" class="col-form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
                <div class="form-gorup col-md-6">
                    <label for="ciudad" class="col-form-label">Ciudad/Mpio</label>
                    <input type="text" autocomplete="new-text" class="form-control" id="ciudad" name="ciudad" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="celular" class="col-form-label">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" required pattern='.{10,10}' title='Debe contener 10 digitos' onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefono" class="col-form-label">Telefono Fijo</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" pattern='.{8,10}' title='Digita bien el número' onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="correo" class="col-form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo">
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
