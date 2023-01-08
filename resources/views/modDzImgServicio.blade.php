<!-- Modal -->
<div class="modal fade" id="dropZoneImg" tabindex="-1" aria-labelledby="dropZoneImgLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Subir Imagenes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            {{--  <form action="{{route('dropzoneImg',$datos->num_servicio)}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="file" name="imagenes" id="">


                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="registrar" class="btn btn-dark btn-block">Guardar Cambios</button>
                </div>
            </form>  --}}
                <form action="{{route('dropzoneImg',$datos->num_servicio)}}"
                    class="dropzone" id="dropzoneImg"
                    method="POST">
                    {{--  @csrf  --}}
                </form>
        </div>
    </div>
  </div>
</div>
