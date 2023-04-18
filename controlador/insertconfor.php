<?php 

include "../conexion/conexion.php";

$idconfoficio = $_POST['idconfoficio'];
$confor = mysqli_real_escape_string($conexion,$_POST['confor']);
$fecreg = mysqli_real_escape_string($conexion,$_POST['fecreg']);
$numreg = mysqli_real_escape_string($conexion,$_POST['numreg']);
$alumno = mysqli_real_escape_string($conexion,$_POST['alumno']);
$codigo = mysqli_real_escape_string($conexion,$_POST['codigo']);
$escuela = mysqli_real_escape_string($conexion,$_POST['escuela']);
$modalidad = mysqli_real_escape_string($conexion,$_POST['modalidad']);
$sede = mysqli_real_escape_string($conexion,$_POST['sede']);
$celular = mysqli_real_escape_string($conexion,$_POST['celular']);
$correo = mysqli_real_escape_string($conexion,$_POST['correo']);
$dni = mysqli_real_escape_string($conexion,$_POST['dni']);
$estado = mysqli_real_escape_string($conexion,$_POST['estado']);

if($idconfoficio == "0")
{
    $sql = "CALL InsertarConf ('$confor','$fecreg','$numreg','$alumno','$codigo','$escuela','$modalidad','$sede','$celular','$correo','$dni','$estado')";

    if($conexion -> query($sql))
    {
        $idconfoficio = $conexion->insert_id;
        echo "<tr class='{$idconfoficio}'>
            <td style='display: none;'>{$idconfoficio}</td>
            <?php 
                if({$estado} =='INCOMPLETO')
                    echo '<td><img src='librerias/img/off.png' width='40' height='25'></td>';
                if({$estado} =='COMPLETO')
                echo '<td><img src='librerias/img/on.png'  width='40' height='25'></td>';
                if({$estado} =='PROBLEMA')
                echo '<td><img src='librerias/img/mediun.png' width='40' height='25'></td>';
            ?>
            <td>{$fecreg}</td>
            <td>{$numreg}</td>
            <td>{$alumno}</td>
            <td>{$codigo}</td>
            <td>{$escuela}</td>
            <td>{$modalidad}</td>
            <td>{$sede}</td>
            <td style='display: none;'>{$celular}</td>
            <td style='display: none;'>{$correo}</td>
            <td style='display: none;'>{$dni}</td>
            <td>
            <a href='#' class='btn btn-warning edit' idconfoficio='<?=$fila->idconfoficio?>' style='width: 30px; height: 35px;'><i class='material-symbols-outlined'>edit</i></a>
            
            <a href='#' class='btn btn-danger' style='width: 30px; height: 35px;' id='deleteconfor' name='deleteconfor'><i class='material-symbols-outlined'>delete</i></a>
            </td>
            
        </tr>";
    }else{
        
    }
}


echo mysqli_query($conexion,$sql);

?> 