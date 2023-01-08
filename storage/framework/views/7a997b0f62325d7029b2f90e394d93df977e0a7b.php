<!-- Modal -->
<div class="modal fade" id="dropZoneViewImg" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="dropZoneViewImgLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Vista de Imagenes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">

            
            <div class="card-body w-100 h-50" style="background-color: #f4f6f9;">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                    <?php
                        $images = DB::table('img_servicios')->get();
                            $i = 0;
                    ?>
                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($image->servicio == $datos->num_servicio): ?>
                            <?php if($i == 0): ?>
                            <div class="carousel-item active">
                                <center><img src="<?php echo e(URL::to($image->url)); ?>" type="button" class="d-block" data-toggle="modal" data-target="#modEliminarImg<?php echo e($image->id); ?>" height="200"></center>
                            </div>
                            <div class="modal fade" id="modEliminarImg<?php echo e($image->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar esta imagen?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                            <form action="<?php echo e(route('eliminarImg',$image->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            <?php
                            $i=1;
                            ?>
                            <?php else: ?>
                            <div class="carousel-item">
                                <center><img src="<?php echo e(URL::to($image->url)); ?>" type="button" class="d-block" data-toggle="modal" data-target="#modEliminarImg<?php echo e($image->id); ?>" height="200"></center>
                            </div>
                            <div class="modal fade" id="modEliminarImg<?php echo e($image->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar esta imagen?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                            <form action="<?php echo e(route('eliminarImg',$image->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #050505;"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #050505;"></span>
                        <span class="sr-only">Next</span>
                    </button>
                    </div>
            </div>

        </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\administrador\resources\views/modDzViewImg.blade.php ENDPATH**/ ?>