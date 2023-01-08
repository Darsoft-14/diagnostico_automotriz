<?php $__env->startSection('title', 'Principal'); ?>

<?php $__env->startSection('content_header'); ?>
<div class="card-header"><h2>Principal</h2></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <!--  Card Cliente -->
        <div class="col-lg-3 col-6">
            <a style="text-decoration:none" href="<?php echo e(route('cliente')); ?>">
                <div class="card border-left border-primary shadow h-80 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                    Clientes
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <a style="text-decoration:none" href="<?php echo e(route('vehiculo')); ?>">
                <div class="card border-left border-primary shadow h-80 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                    Vehiculos
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-car-side fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <a style="text-decoration:none" href="<?php echo e(route('servicio')); ?>">
                <div class="card border-left border-primary shadow h-80 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                    Servicios
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tools fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <a style="text-decoration:none" href="<?php echo e(route('tomaServicio')); ?>">
                <div class="card border-left border-primary shadow h-80 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                    Ordenes Activas
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container">
    <?php
        $clientesTot = DB::table('clientes')->count();
        $vehiculosTot = DB::table('vehiculos')->count();
        $ordenProces = DB::table('toma_servicios')->where('estado', 0)->count();
        $ordenTermin = DB::table('toma_servicios')->where('estado', 1)->count();
    ?>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo e($clientesTot); ?></h3>

                <p>Clientes Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!--fin Rep CLiente ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo e($vehiculosTot); ?></h3>

              <p>Vehiculos Registrados</p>
            </div>
            <div class="icon">
              
              <i class="fas fa-car"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo e($ordenProces); ?></h3>

              <p>Ordenes En Proceso</p>
            </div>
            <div class="icon">
              
              <i class="fas fa-clock"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo e($ordenTermin); ?></h3>

              <p>Ordenes Terminadas</p>
            </div>
            <div class="icon">
              
              <i class="fas fa-check-circle"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\administrador\resources\views/home.blade.php ENDPATH**/ ?>