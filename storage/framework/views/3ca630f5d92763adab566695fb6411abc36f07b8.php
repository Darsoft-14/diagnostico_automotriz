<?php $__env->startSection('title', 'Ordenes Activas'); ?>

<?php $__env->startSection('content_header'); ?>
<!-- Button modal add-->
<button id="open-modal" type="button" class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#modNuevo">
    <i class="fas fa-clipboard-list"></i>_NUEVA ORDEN
</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="table-responsive">
    <table id="servicios" class="table table-sm  table-bordered table-hover table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="10%">N° Servicio</th>
                <th scope="col" width="11%"><center>Fecha</center></th>
                <th scope="col"><center>Placa</center></th>
                <th scope="col">Propietario</th>
                
                <th scope="col" width="11%"><center>Acciones</center></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $originalDate = $servicio->fecha;
            $fecha = date("d/m/Y", strtotime($originalDate));
            ?>
            <tr>
                <td><center><?php echo e($servicio->num_servicio); ?></center></td>
                <td><center><?php echo e($fecha); ?></center></td>
                <td><center><?php echo e($servicio->placa); ?></center></td>
                <td><?php echo e($servicio->nombre); ?></td>
                
                <td>
                    <a href="<?php echo e(route('tomaServicios.edit', $servicio->num_servicio)); ?>" type="button" class="btn btn-warning btn-sm text-right">
                        <i class="fas fa-marker"></i>
                    </a>
                </td>
            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>


<?php echo $__env->make('modCrearOrden', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
        $(document).ready(function(){

            $("#btnGenerar").click(function (e) {
                e.preventDefault();
                var cod = document.getElementById("placa").value;
                //alert(cod);

                if(cod == 0){

                    Swal.fire(
                    'ERROR',
                    'Seleccione una PLACA para generar una nueva orden',
                    'warning'
                    )
                }else{

                    $(this).unbind('click').click();
                }

            });



            $('#servicios').DataTable({
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
                    },
                }
            });
        });

        $('.modal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
            $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
        });
        
        $('#placa').select2();

        function abrirNuevoTab(url) {
            // Abrir nuevo tab
            //var win = window.open(url, '_blank');
            var win = window.open(url, '_blank');
            // Cambiar el foco al nuevo tab (punto opcional)
            win.focus();

          }
          $('#open').click(function(){

            abrirNuevoTab("<?php echo e(route('nuevoServicio')); ?>")
          })

          $('#open1').click(function(){
            abrirNuevoTab('/imprimirServicio')
          })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\administrador\resources\views/tomaServicio.blade.php ENDPATH**/ ?>