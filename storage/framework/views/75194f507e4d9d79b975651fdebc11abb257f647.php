<!--modal para CRUD  Nuevo-->
<div class="modal fade" id="modNuevoServ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">NUEVO SERVICIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="formClientes" action="<?php echo e(route('servicios.store')); ?>" method="POST">
          <?php echo csrf_field(); ?> <?php echo method_field('POST'); ?>

          <div class="modal-body">

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputcod" class="col-form-label">Codigo</label>
                    <input type="text" class="form-control" onkeyup="mayusculas(this);" id="codigo" name="codigo" required>
                    <input type="hidden"  id="control" name="control" value="">
                </div>
                <div class="form-group col-md-10">
                    <label for="nombre" class="col-form-label">Nombre</label>
                    <input type="text" class="form-control" onkeyup="mayusculas(this);" id="nombre" name="nombre" required>
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
<?php /**PATH C:\xampp\htdocs\administrador\resources\views/modCrearServicio.blade.php ENDPATH**/ ?>