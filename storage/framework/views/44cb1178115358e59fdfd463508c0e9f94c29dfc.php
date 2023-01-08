<?php $__env->startSection('title', 'Vehículos'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_header'); ?>
<!-- Button modal add-->
<button id="open-modal" type="button" class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#modNuevo">
    <i class="fas fa-car"></i>_NUEVO
</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<input type="hidden" id="mensaje" name="servicioCodigo" value=<?php echo e($mensaje); ?>>

<div class="table-responsive">
    <table id="vehiculos" class="table table-sm  table-bordered table-hover table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Propietario</th>
                <th scope="col">Placa</th>
                <th scope="col">Línea</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">VIN</th>
                <th scope="col">N° Motor</th>
                <th scope="col">Color</th>
                <th scope="col">Tipo</th>
                <th scope="col">Img</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
             <?php $__currentLoopData = $vehiculos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehiculo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
                $images = DB::table('img_vehiculos')->get();
                $i = 0;
             ?>
                <tr>
                    <td><?php echo e($vehiculo->nombre); ?></td>
                    <td><?php echo e($vehiculo->placa); ?></td>
                    <td><?php echo e($vehiculo->linea); ?></td>
                    <td><?php echo e($vehiculo->marca); ?></td>
                    <td><?php echo e($vehiculo->modelo); ?></td>
                    <td><?php echo e($vehiculo->vin); ?></td>
                    <td><?php echo e($vehiculo->motor); ?></td>
                    <td><?php echo e($vehiculo->color); ?></td>
                    <td><?php echo e($vehiculo->modelo); ?></td>
                    <td>
                        <button id="open-modal" type="button" class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#modImg<?php echo e($vehiculo->id); ?>">
                           <b>Ver</b>
                        </button>
                    </td>
                    <td>
                        <a href="<?php echo e(route('vehiculos.edit', $vehiculo->id)); ?>" type="button" class="btn btn-warning btn-sm text-right">
                            <i class="fas fa-marker"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="modImg<?php echo e($vehiculo->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #dee4ee;">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Placa Vehiculo:</b> <?php echo e($vehiculo->placa); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" >

                        <div id="carousel<?php echo e($vehiculo->id); ?>" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">

                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($image->placa == $vehiculo->placa): ?>
                                    <?php if($i == 0): ?>
                                    <div class="carousel-item active">
                                        <center><img src="<?php echo e(URL::to($image->url)); ?>" type="button" class="d-block" height="380"></center>
                                    </div>
                                    <?php
                                    $i=1;
                                    ?>
                                    <?php else: ?>
                                    <div class="carousel-item">
                                        <center><img src="<?php echo e(URL::to($image->url)); ?>" type="button" class="d-block" height="380"></center>
                                    </div>
                                    <?php endif; ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <button class="carousel-control-prev" type="button" data-target="#carousel<?php echo e($vehiculo->id); ?>" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #050505;"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-target="#carousel<?php echo e($vehiculo->id); ?>" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #050505;"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>



<?php echo $__env->make('modCrearVehiculo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('modCrearClient', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">

    
    $(document).ready(function(){

        function mensaje(){
            if(document.getElementById("mensaje").value == "ya"){

                Swal.fire(
                'ERROR',
                'La PLACA ya esta registrada',
                'warning'
                )
            }
            if(document.getElementById("mensaje").value == "Seleccionar"){

                Swal.fire(
                'ERROR',
                'Selecciona un PROPIETARIO',
                'warning'
                )
            }
            if(document.getElementById("mensaje").value == "no"){
                Swal.fire(
                'El registro ha sido exitoso',
                '.',
                'success'
                )
            }
        };

        mensaje();

        $('#vehiculos').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - disculpa",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                'search': 'Buscar',
                'paginate':{
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        });
    });

    
    $('.custom-file-input').on('change', function(event) {
        var inputFile = event.currentTarget;
        $(inputFile).parent()
            .find('.custom-file-label')
            .html(this.files.length + " archivos cargados");
    });

    
    $('#propietario').select2();

    
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
        $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
    });

    $('.carousel').carousel();
    //$("#carouselImg").carousel();

    function showFile(url){
        $.ajax({
            url: url,
            type: "get",
            dataType: "html",
            contentType: false,
            processData: false
        }).done(function(res){
            url = JSON.parse(res).response.url
            window.open(url,'_blank');
        }).fail(function(res){
            console.log(res)
        });
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\administrador\resources\views/vehiculo.blade.php ENDPATH**/ ?>