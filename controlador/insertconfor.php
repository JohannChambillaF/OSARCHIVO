<?php 

include "../conexion/conexion.php";

$confor = $_POST['confor'];
$fecreg = $_POST['fecreg'];
$numreg = $_POST['numreg'];
$alumno = $_POST['alumno'];
$codigo = $_POST['codigo'];
$escuela = $_POST['escuela'];
$modalidad = $_POST['modalidad'];
$sede = $_POST['sede'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];
$dni = $_POST['dni'];

$sql = "CALL InsertarConf ('$confor','$fecreg','$numreg','$alumno','$codigo','$escuela','$modalidad','$sede','$celular','$correo','$dni')";

echo mysqli_query($conexion,$sql);

?> 