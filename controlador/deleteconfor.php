<?php 

include "../conexion/conexion.php";

$idconsul = $_POST['id']; // id= es llamado del ajax ---> idconsult solo es una variable creada

$sql="DELETE FROM registro WHERE idconfoficio='{$idconsul}'";
	
if($conexion->query($sql)){
		echo true;
	}else{
		echo false;
	}

?> 