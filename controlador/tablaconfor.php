<?php

include "../conexion/conexion.php";

$sql = "SELECT r.idconfoficio,r.fechrecepcion,r.nregistro,r.alumno,r.codigo,e.nombresc,r.modalidad,s.descripsede,r.celular,r.correo,r.dni,r.estado 
						FROM registro r 
						INNER JOIN escuela e ON r.idescuela = e.idescuela
						INNER JOIN sede s ON r.idsede = s.idsede
						ORDER BY idconfoficio DESC";
$resultado = mysqli_query($conexion, $sql);

if( !$resultado ){
    die("Error");
}else{
    while ($data = mysqli_fetch_assoc($resultado)){
        $arreglo ["data"][] = $data;
    }
    echo json_encode($arreglo);
}
mysqli_free_result($resultado);
mysqli_close($conexion);

?>