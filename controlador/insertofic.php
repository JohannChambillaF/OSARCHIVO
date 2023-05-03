<?php 

include "../conexion/conexion.php";

$idconfoficio = $_POST['idconfoficio'];
$ofic = mysqli_real_escape_string($conexion,$_POST['ofic']);
$fecreg = mysqli_real_escape_string($conexion,$_POST['fecreg']);
$numreg = mysqli_real_escape_string($conexion,$_POST['numreg']);
$noficio = mysqli_real_escape_string($conexion,$_POST['noficio']);
$alumno = mysqli_real_escape_string($conexion,$_POST['alumno']);
$codigo = mysqli_real_escape_string($conexion,$_POST['codigo']);
$escuela = mysqli_real_escape_string($conexion,$_POST['escuela']);
$modalidad = mysqli_real_escape_string($conexion,$_POST['modalidad']);
$sede = mysqli_real_escape_string($conexion,$_POST['sede']);
$estado = mysqli_real_escape_string($conexion,$_POST['estado']);

if($idconfoficio == "0")
{
    $sql = "CALL InsertarOfic ('$ofic','$fecreg','$numreg','$noficio','$alumno','$codigo','$escuela','$modalidad','$sede','$estado')";
}else{
    $sql = "CALL ActualizarOfic ('$idconfoficio','$fecreg','$numreg','$noficio','$alumno','$codigo','$escuela','$modalidad','$sede')";
}
echo mysqli_query($conexion,$sql);

?> 