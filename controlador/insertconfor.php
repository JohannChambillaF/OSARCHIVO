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
}else{
    $sql = "CALL ActualizarConf ('$idconfoficio','$fecreg','$numreg','$alumno','$codigo','$escuela','$modalidad','$sede','$celular','$correo','$dni')";
}
echo mysqli_query($conexion,$sql);

?> 