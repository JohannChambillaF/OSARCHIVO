<?php
include "../conexion/conexion.php";

if(isset($_POST['input'])){

    $input = $_POST['input'];
    $query = "SELECT * FROM  registro WHERE codigo LIKE '%{$input}%' LIMIT 6";

    $result = mysqli_query($conexion,$query);

    if(mysqli_num_rows($result) > 0){?>
        <table class="table table-striped table-bordered" align="vertical">
            <thead class="table-primary" style='font-size: 9px; color: #626161;'>
                <tr>
                     <th>TIPO</th>
                     <th>RECEP</th>
                     <th>ALUMNO</th>
                     <th>CODIGO</th>
                     <th>ESTADO</th>
                     <th>ENVIO</th>
                </tr>
            </thead>
            <tbody style='font-size: 12px;'>
                <?php
                
                while($row = mysqli_fetch_assoc($result)){

                    $tipo = $row['tipo'];
                    $fechrecepcion = $row['fechrecepcion'];
                    $alumno = $row['alumno'];
                    $codigo = $row['codigo'];
                    $estado = $row['estado'];
                    $fechenvio = $row['fechenvio'];

                    ?>
                        <tr>
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
                            <td><?=$fechenvio;?></td>
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