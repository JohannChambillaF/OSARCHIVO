<?php 
include "../conexion/conexion.php";

$idconfoficio = $_POST['idconfoficio'];
$estado = mysqli_real_escape_string($conexion,$_POST['estado']);
$alumno = mysqli_real_escape_string($conexion,$_POST['alumno']);
$escuela = mysqli_real_escape_string($conexion,$_POST['escuela']);
$modalidad = mysqli_real_escape_string($conexion,$_POST['modalidad']);
$sede = mysqli_real_escape_string($conexion,$_POST['sede']);
$fecaten = mysqli_real_escape_string($conexion,$_POST['fecaten']);
$numate = mysqli_real_escape_string($conexion,$_POST['numate']);
$ubicexp = mysqli_real_escape_string($conexion,$_POST['ubicexp']);
$observ = mysqli_real_escape_string($conexion,$_POST['observ']);



$sql = "CALL ActuaConfCompl	($idconfoficio,'$estado','$alumno','$escuela','$modalidad','$sede','$fecaten','$numate','$ubicexp','$observ')";

echo mysqli_query($conexion,$sql);

?> 