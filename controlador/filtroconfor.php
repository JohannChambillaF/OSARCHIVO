<?php
sleep(1);
include "../conexion/conexion.php";

$fechaInit = date("Y-m-d", strtotime($_POST['f_ingreso']));
$fechaFin  = date("Y-m-d", strtotime($_POST['f_fin']));

$sql = "SELECT r.idconfoficio ,r.alumno,e.nombresc,m.descmod,s.descripsede,r.estado,r.fechrecepcion
        FROM registro r
        INNER JOIN escuela e ON r.idescuela = e.idescuela
        INNER JOIN sede s ON r.idsede = s.idsede
        INNER JOIN modalidad m ON r.idmodalidad = m.idmodalidad
        WHERE r.tipo = 'CONFORMIDAD' && r.estado = 'INCOMPLETO' && r.fechrecepcion BETWEEN '$fechaInit' AND '$fechaFin' ORDER BY fechrecepcion ASC";
$query = mysqli_query($conexion, $sql);

?>

<table class="table table-hover">
    <thead class="table-primary" style='font-size: 11px; color: #626161;'>
        <tr>
            <th class="text-center" style="display: none;">ID</th>
            <th class="text-center">ESTADO</th>
            <th class="text-center">ALUMNO</th>
            <th class="text-center">ESCUELA</th>
            <th class="text-center">MODALIDAD</th>
            <th class="text-center">SEDE</th>
            <th class="text-center">FECHA</th>
            <th class="text-center" style="width: 15%;">ACCION</th> 
        </tr>
    </thead>
    <tbody class="text-center" style='font-size: 11px;'><!--este id="tablaconfor" es para el buscador-->
        <?php  

        while ($fila =mysqli_fetch_object($query))
            //mysqli_fetch_array jala los datos de la BD como arrays (esto sirve cuando una tabla tiene nombres con columnas iguales esta es una forma de diferenciarlas ya que si se duplicasa nombre al llamar datos de BD habria errores)

            //mysqli_fetch_object jala los datos pero con los mismos nombres como estan las columnas en la BD 
            { 
            ?>
                <tr>
                    <td style="display: none;"><?=$fila->idconfoficio?></td>
                    <?php 
                        if($fila->estado =='INCOMPLETO')
                            echo '<td><img src="librerias/img/off.png" alt="" width="40" height="25"></td>';
                        if($fila->estado =='COMPLETO')
                        echo '<td><img src="librerias/img/on.png" alt="" width="40" height="25"></td>';
                        if($fila->estado =='PROBLEMA')
                        echo '<td><img src="librerias/img/mediun.png" alt="" width="40" height="25"></td>';
                    ?>
                    <td><?=$fila->alumno?></td>
                    <td><?=$fila->nombresc?></td>
                    <td><?=$fila->descmod?></td>
                    <td><?=$fila->descripsede?></td>
                    <td><?=$fila->fechrecepcion?></td>
                    <td>
                    <a href="#" class="btn btn-success verifconfor" idconfoficio="<?=$fila->idconfoficio?>" style="width: 30px; height: 25px;"><i class="fa-solid fa-arrow-right"></i></a>
                    </td>
                    
                </tr>							
        <?php }
        ?>
    </tbody>
</table>
<?php
$total   = mysqli_num_rows($query);
echo '<strong>Total: </strong> ('. $total .')';
?>