<!-- Modal -->
<div class="modal fade" id="dropZoneViewDoc" tabindex="-1" aria-labelledby="dropZoneViewDocLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Ver Archivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">

            <div class="table-responsive">
                <table class="table table-sm  table-bordered table-hover table-striped mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre Archivo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $archivos = DB::table('arch_servicios')->get();
                        @endphp
                        @foreach ($archivos as $archivo)
                            @php
                                $nombre= substr($archivo->url, 37);
                            @endphp
                            @if ($archivo->servicio == $datos->num_servicio)
                                <tr>
                                    <td class="small"><b>{{$nombre}}</b></td>
                                    <td width="19%" class="small">
                                        <a href="{{URL::to($archivo->url)}}" target="_blank" class="btn btn-warning btn-sm text-right float-left">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm text-right float-right" data-toggle="modal" data-target="#modEliminarArch{{$archivo->id}}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modEliminarArch{{$archivo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar este Archivo?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{$nombre}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

                                            <a href="{{route('eliminarDoc',$archivo->id)}}" class="btn btn-danger">
                                                Eliminar
                                            </a>
                                        </form>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
  </div>
</div>
