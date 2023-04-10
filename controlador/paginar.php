<?php 

include "../conexion/conexion.php";

	$paginaActual = $_POST['partida'];

		if ($result = mysqli_query($conexion, "SELECT r.idconfoficio,r.fechrecepcion,r.nregistro,r.alumno,r.codigo,e.nombresc,r.modalidad,s.descripsede,r.celular,r.correo,r.dni,r.estado 
        FROM registro r 
        INNER JOIN escuela e ON r.idescuela = e.idescuela
        INNER JOIN sede s ON r.idsede = s.idsede")) {

		    /* determinar el número de filas del resultado */
		    $nroPaginas = mysqli_num_rows($result);
		}

		$nroLotes = 5;
		$nroPaginas = ceil($nroPaginas/$nroLotes);
		$lista = '';
		$tabla = '';

		if($paginaActual > 1)
		{
			$lista = $lista.'<ul class="pagination"><li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual-1).');">Anterior</a></li></u>';
		}
		for($i = 1; $i <= $nroPaginas; $i++){
			if($i == $paginaActual){
				$lista = $lista.'<ul class="pagination"><li class="active page-item"><a class="page-link" href="javascript:pagination('.$i.');">'.$i.'</a></li></ul>';
			}else{
				$lista = $lista.'<ul class="pagination"><li class="page-item"><a class="page-link" href="javascript:pagination('.$i.');">'.$i.'</a></li></ul>';
			}
		}
		if ($paginaActual < $nroPaginas){
			$lista = $lista.'<ul class="pagination"><li class="page-item"><a class="page-link" href="javascript:pagination('.($paginaActual+1).');">Siguiente</a></li></ul>';
		}
		if ($paginaActual <= 1){
			$limit = 0;
		}else{
			$limit = $nroLotes*($paginaActual-1);
		}
		
		$registro = mysqli_query($conexion,"SELECT r.idconfoficio,r.fechrecepcion,r.nregistro,r.alumno,r.codigo,e.nombresc,r.modalidad,s.descripsede,r.celular,r.correo,r.dni,r.estado 
        FROM registro r 
        INNER JOIN escuela e ON r.idescuela = e.idescuela
        INNER JOIN sede s ON r.idsede = s.idsede
        ORDER BY idconfoficio DESC 
		LIMIT $limit, $nroLotes");

		$tabla = $tabla.'<table class="table table-striped table-bordered" align="vertical" id="tabla">
			<thead class="table-primary" style="font-size: 12px; color: #626161;">		
				<tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">F REGISTRO</th>
                    <th class="text-center">N° REGISTRO</th>
                    <th class="text-center">ALUMNO</th>
                    <th class="text-center">CÓDIGO</th>
                    <th class="text-center">ESCUELA</th>
                    <th class="text-center">MODALIDAD</th>
                    <th class="text-center">SEDE</th>
                    <th class="text-center">ESTADO</th>
                    <th class="text-center" style="width: 15%;">ACCION</th>
				</tr>
			</thead>';
		while ($registro2 =mysqli_fetch_array($registro))
		{

		$tabla = $tabla.'
		<tbody style="font-size: 12px;" id="tablaconfor">
			<tr>
					<td>'.$registro2['idconfoficio'].'</td>
					<td>'.$registro2['fechrecepcion'].'</td>
                    <td>'.$registro2['nregistro'].'</td>
                    <td>'.$registro2['alumno'].'</td>
                    <td>'.$registro2['codigo'].'</td>
                    <td>'.$registro2['nombresc'].'</td>
                    <td>'.$registro2['modalidad'].'</td>
                    <td>'.$registro2['descripsede'].'</td>
                    <td>'.$registro2['estado'].'</td>
					<td><a href="" class="btn btn-warning" style="width: 30px; height: 35px;"><i class="material-symbols-outlined">edit</i></a>
								
                    <a href="" class="btn btn-danger" style="width: 30px; height: 35px;" name="deleteconfor" value="<?=$fila[0]?>;"><i class="material-symbols-outlined">delete</i></a>
					</td>
					</tr>
			</tbody>';
		}

		$tabla = $tabla.'</table>';

		$array = array(	0 => $tabla, 
						1 => $lista);

		echo json_encode($array);
?>