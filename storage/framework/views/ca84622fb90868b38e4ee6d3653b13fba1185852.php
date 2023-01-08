<!-- Modal -->
<div class="modal fade" id="dropZoneDoc" tabindex="-1" aria-labelledby="dropZoneDocLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Subir Archivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
                <form action="<?php echo e(route('dropzoneDoc',$datos->num_servicio)); ?>"
                    class="dropzone" id="dropzoneDoc"
                    method="POST">
                </form>
        </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\administrador\resources\views/modDzDocServicio.blade.php ENDPATH**/ ?>