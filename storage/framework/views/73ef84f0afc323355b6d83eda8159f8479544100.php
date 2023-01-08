<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicio_<?php echo e($serv); ?>_PDF</title>
    <style>
        /** Define the margins of your page **/
        @page  {
            margin: 100px 25px;
        }
        body {
            margin-top: 2.5cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
        }

        header {
            position: fixed;
            top: -60px;
            left: 6px;
            right: 6px;
            /*height: 70px;*/

            /** Extra personal styles **/
            background-color: #ffffff;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 0cm;

            /** Estilos extra personales **/
            background-color: #ffffff;
            color: rgb(3, 3, 3);
            text-align: center;
            font-size:   14px;
            line-height: 0.4cm;
        }
        table{

            font-family: Arial, Helvetica, sans-serif;
        }

        #tabla2{
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            border: 1px solid #000;
         }
         .th,.tdh,.tdf {
            text-align: center;
            vertical-align: top;
            border: 1px solid #000;
            border-collapse: collapse;
            caption-side: bottom;
         }
         .th{
             background-color: #fac800;
             font-size: 13px;
         }
         .tdh{
            padding: 0.3em;
            font-size: 19px;
         }
         .tdf{
             font-size: 13px;
         }

         #firma{
            border-top: solid 2px black;
            width: 45%;
         }
         #dfooter{
            border-top: solid 2px #fac800;
         }

        #tdatos{
            border-collapse: collapse;
            font-size: 15px;
            margin: 0 auto;
            width: 100%;
        }
        #tdatos tr {
            border-top: rgb(177, 176, 176) 1px solid;
          }
        #tdatos th{
            padding: 5;
            text-align: left;
        }
        #tdatos td {
            padding: 5;
            text-align: left;
        }

        #tservicios{
            border-collapse: collapse;
            font-size: 13px;
            width:98%;
            margin: 0 auto;
        }
        #tservicios th{
            background-color: rgb(197, 194, 194);
            border: solid 1px black;
            padding: 4;
        }
        #tservicios td{
            border: solid 1px black;
            padding: 4;
        }
    </style>
</head>
<body>

    <?php
    define('DB_HOST','localhost');
    define('DB_NAME','administrador');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_CHARSET','utf8');

    $conex = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $consulta = "SELECT a.num_servicio,a.fecha,c.placa,c.marca, s.nombre,s.cedula,s.direccion,s.celular,s.email
                       FROM toma_servicios a
                       inner join  vehiculos c on a.placa=c.id
                       inner join clientes s on c.client_id=s.id
                       where a.num_servicio =$serv;";
        $datos = mysqli_query($conex,$consulta)->fetch_array();
        $originalDate = $datos['fecha'];
        $fecha = date("d/m/Y", strtotime($originalDate));
        $cont = 0;
        $col = 0;
    ?>

    <!-- Definir bloques de encabezado y pie de página antes de su contenido -->
        <header>
            <table>
                <tr>
                    <td width="23%">
                        <img src="imagenes/STALogo.png" class=" mt-3" width="96%" height="5%">
                    </td>
                    <td>
                        <center><img src="imagenes/STALogo1.png" class="mt-2" width="86%" height="6%"></center>
                    </td>
                    <td width="13%">
                        <table id="tabla2">
                            <tr>
                                <th class="th">N° SERVICIO</th>
                            </tr>
                            <tr>
                                <td class="tdh"> <b><?php echo e($datos['num_servicio']); ?></b></td>
                            </tr>
                            <tr>
                                <td class="tdf"><?php echo e($fecha); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </header>

        <footer>
            <div id="dfooter">
                <table class=" " style="width:69%;margin: 0 auto;">
                    <tr>
                        <th width="38%">
                            <img src="imagenes/address.png" class=" mt-3" width="5%" height="13px">  Carrera 52 N° 41 - 50 Carabobo
                        </th>
                        <th width="20%">
                            <img src="imagenes/cellphone.png" class=" mt-3" width="15%" height="13px">  3017844967
                        </th>
                        <th width="20%">
                            <img src="imagenes/instagram.png" class=" mt-3" width="11%" height="13px">  tallersta
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <img src="imagenes/emailpng.png" class=" mt-3" width="3%" height="9px">  solucionestecnicasauto@gmail.com</center>
                        </th>
                    </tr>
                </table>
            </div>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
                <table id="tdatos">
                    <tr>
                        <th>Placa:</th>
                        <td><?php echo e($datos['placa']); ?></td>
                        <th>Marca:</th>
                        <td><?php echo e($datos['marca']); ?></td>
                        <th>Propietario:</th>
                        <td><?php echo e($datos['nombre']); ?></td>
                    </tr>
                    <tr>
                        <th>Cedula:</th>
                        <td><?php echo e($datos['cedula']); ?></td>
                        <th>Dirección:</th>
                        <td><?php echo e($datos['direccion']); ?></td>
                        <th>Celular:</th>
                        <td><?php echo e($datos['celular']); ?></td>
                    </tr>
                    <tr>
                        <th>Correo:</th>
                        <td colspan="5"><?php echo e($datos['email']); ?></td>
                    </tr>
                </table>
<br><br>

                <table id="tservicios">
                    <thead>
                        <tr>
                            <th><center>CODIGO</center></th>
                            <th><center>DESCRIPCION</center></th>
                            <th><center>HORAS</center></th>
                            <th><center>VALOR/HORA</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><center><?php echo e($servicio->codigo); ?></center></td>
                            <td><?php echo e($servicio->nombre); ?></td>
                            <td><center><?php echo e($servicio->hora); ?></center></td>
                            <td><center>$<?php echo e(number_format($servicio->valor, 0, ",", ".")); ?></center></td>
                            <td><center>$<?php echo e(number_format($servicio->total, 0, ",", ".")); ?></center></td>
                        </tr>
                        <?php
                        $col += 1;
                        $cont += $servicio->total;
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php for($i = 0; $i < 14-$col; $i++): ?>
                            <tr>
                                <td><center>----</center></td>
                                <td><center>----</center></td>
                                <td><center>----</center></td>
                                <td><center>----</center></td>
                                <td><center>----</center></td>
                            </tr>
                        <?php endfor; ?>
                        <tr>
                            
                            <th colspan="4">
                                TOTAL
                            </th>
                            <th>
                                <center>$<?php echo e(number_format($cont, 0, ",", ".")); ?></center>
                            </th>
                        </tr>
                    </tbody>
                </table>
<br><br><br><br><br><br>
        <div id="firma">
            <span>FIRMA DE CONFORMIDAD</span>
        </div>

        </main>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\administrador\resources\views/reporte.blade.php ENDPATH**/ ?>