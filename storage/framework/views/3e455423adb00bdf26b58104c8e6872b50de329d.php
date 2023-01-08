<?php $__env->startSection('title', 'Clientes'); ?>

<?php $__env->startSection('content_header'); ?>
<button id="btnNuevo" type="button" class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#modNuevoCli">
    <i class="fas fa-user-plus"></i>_NUEVO
</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<input type="hidden" id="mensaje" name="servicioCodigo" value=<?php echo e($mensaje); ?>>

<div class="table-responsive">
    <table id="clientes" class="table table-sm  table-bordered table-hover table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Cédula</th>
                <th scope="col">Dirección</th>
                <th scope="col">Ciudad/Mpio</th>
                <th scope="col">Celular</th>
                <th scope="col">Tel Fijo</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($cliente->nombre); ?></td>
                <td><?php echo e($cliente->cedula); ?></td>
                <td><?php echo e($cliente->direccion); ?></td>
                <td><?php echo e($cliente->ciudad); ?></td>
                <td><?php echo e($cliente->celular); ?></td>
                <td><?php echo e($cliente->telfijo); ?></td>
                <td><?php echo e($cliente->email); ?></td>
                <td>
                    <button id="btnNuevo" type="button" class="btn btn-warning btn-sm text-right" data-toggle="modal" data-target="#modEditar<?php echo e($cliente->id); ?>">
                        <i class="fas fa-marker"></i>
                    </button>
                    <!--modal para CRUD  Editar-->
                    <div class="modal fade" id="modEditar<?php echo e($cliente->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="exampleModalLabel">EDITAR CLIENTE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>

                            <form id="formClientes" action="<?php echo e(route('clientes.update', $cliente->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <div class="modal-body">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="col-form-label">Nombre</label>
                                    <input autocomplete="new-text" type="text" class="form-control" id="nombre" name="nombre" value="<?php echo e($cliente->nombre); ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cedula" class="col-form-label">Cedula</label>
                                    <input autocomplete="new-number" type="number" class="form-control" id="cedula" name="cedula" value="<?php echo e($cliente->cedula); ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="direccion" class="col-form-label">Dirección</label>
                                    <input autocomplete="new-text" type="text" class="form-control" id="direccion" name="direccion" value="<?php echo e($cliente->direccion); ?>" required>
                                </div>
                                <div class="form-gorup col-md-6">
                                    <label for="ciudad" class="col-form-label">Ciudad/Mpio</label>
                                    <input type="text" autocomplete="new-text" class="form-control" id="ciudad" name="ciudad" value="<?php echo e($cliente->ciudad); ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="celular" class="col-form-label">Celular</label>
                                    <input autocomplete="new-number" type="number" class="form-control" id="celular" name="celular" value="<?php echo e($cliente->celular); ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefono" class="col-form-label">Telefono Fijo</label>
                                    <input autocomplete="new-number" type="number" class="form-control" id="telefono" name="telefono" value="<?php echo e($cliente->telfijo); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="correo" class="col-form-label">Correo</label>
                                    <input autocomplete="new-email" type="email" class="form-control" id="correo" name="correo" value="<?php echo e($cliente->email); ?>">
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
                    <!-- FIN modal para CRUD  Editar-->


                    <!--BOTON modal para CRUD  Eliminar-->
                    <button type="submit" class="btn btn-danger btn-sm text-right" data-toggle="modal" data-target="#modEliminar<?php echo e($cliente->id); ?>">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <!--modal para CRUD  Eliminar-->
                    <div class="modal fade" id="modEliminar<?php echo e($cliente->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Se va a eliminar el cliente <b><?php echo e($cliente->nombre); ?></b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                            <div class="modal-body">
                                <p>¿Estas seguro de eliminar este cliente?</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                            <form action="<?php echo e(route('clientes.destroy',$cliente->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>

                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- FIN modal para CRUD  Eliminar-->

                </td>
            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<!--modal para CRUD  Nuevo Cliente-->
<?php echo $__env->make('modCrearClient', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- FIN modal para CRUD  Nuevo-->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function(){

            function mensaje(){
                if(document.getElementById("mensaje").value == "ya"){

                    Swal.fire(
                    'ERROR',
                    'La Cedula o Nit ya esta registrado(a)',
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
            }

            mensaje();


            $('#clientes').DataTable({
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

        $('.modal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
            $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\administrador\resources\views/cliente.blade.php ENDPATH**/ ?>