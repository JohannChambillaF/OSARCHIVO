<?php
include "../conexion/conexion.php";

if(isset($_POST['input'])){

    $input = $_POST['input'];
    $query = "SELECT r.idconfoficio,r.tipo,r.fechrecepcion,r.alumno,r.codigo,r.estado,r.atencion,e.nombresc,m.descmod,s.descripsede
               FROM registro r 
               INNER JOIN escuela e ON r.idescuela = e.idescuela
               INNER JOIN sede s ON r.idsede = s.idsede
               INNER JOIN modalidad m ON r.idmodalidad = m.idmodalidad
               WHERE r.codigo LIKE '%{$input}%' LIMIT 6";
             

    $result = mysqli_query($conexion,$query);

    if(mysqli_num_rows($result) > 0){?>
        <table class="table table-striped table-bordered" align="vertical">
            <thead class="table-primary" style='font-size: 9px; color: #626161;'>
                <tr>
                    <th style="display: none;">ID</th>     
                    <th>TIPO</th>
                    <th>RECEP</th>
                    <th>ALUMNO</th>
                    <th>CODIGO</th>
                    <th>ESTADO</th>
                    <th>ATENCION</th>
                    <th style="display: none;">ESCUELA</th>
					<th style="display: none;">MODALIDAD</th>
					<th style="display: none;">SEDE</th>
                    <th class="text-center" style="width: 10%;">ACCION</th>
                </tr>
            </thead>
            <tbody style='font-size: 12px;'>
                <?php
                
                while($row = mysqli_fetch_assoc($result)){

                    $idconfoficio = $row['idconfoficio'];
                    $tipo = $row['tipo'];
                    $fechrecepcion = $row['fechrecepcion'];
                    $alumno = $row['alumno'];
                    $codigo = $row['codigo'];
                    $estado = $row['estado'];
                    $atencion = $row['atencion'];
                    $nombre = $row['nombresc'];
                    $descmod = $row['descmod'];
                    $descripsede = $row['descripsede'];

                    ?>
                        <tr>
                            <td style="display: none;"><?=$idconfoficio;?></td>
                            <td><?=$tipo;?></td>
                            <td><?=$fechrecepcion;?></td>
                            <td><?=$alumno;?></td>
                            <td><?=$codigo;?></td>
                            <?php 
                                if($estado =='REGISTRADO')
                                    echo '<td><img src="librerias/img/mediun.png" alt="" width="40" height="25"></td>';
                                if($estado =='COMPLETO')
                                echo '<td><img src="librerias/img/on.png" alt="" width="40" height="25"></td>';
                                if($estado =='OBSERVADO')
                                echo '<td><img src="librerias/img/off.png" alt="" width="40" height="25"></td>';
                                if($estado =='PROBLEMA')
                                echo '<td><img src="librerias/img/problem.png" alt="" width="40" height="25"></td>';
								?>
                            <td><?=$atencion;?></td>
                            <td style="display: none;"><?=$nombre;?></td>
                            <td style="display: none;"><?=$descmod;?></td>
                            <td style="display: none;"><?=$descripsede;?></td>
                            <td>
                                <a href="#" class="btn btn-success editofic2" style="width: 30px; height: 25px;--bs-btn-padding-y: 0rem;"><i class="fa-solid fa-rotate-left"></i></a>
                            </td>
                        </tr>
                    <?php
                }

                ?>
            </tbody>
        </table>
    <?php
    }else{
        echo "<h6 class='text-danger text-center mt-3'>No hay datos</h6>";
    }
}
?>