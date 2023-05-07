<?php 
	include '../conexion/conexion.php';
 ?>

<body>
<div class="w3-container" style="margin: 15px;">
	<div class="card" style="border-color:rgba(76, 150, 217);">
		<div class="card-header" style="background-color: rgba(76, 150, 217);"><H5 style="color: #FFFF;">Realice su Busqueda</H5></div>
		<div class="card-body">
			<table class="table table-striped table-bordered" align="vertical" id="tablabusqueda">
				<thead class="table-primary" style='font-size: 12px; color: #626161;'>
					<tr>
                        <th class="text-center">SOLICITUD</th>
						<th class="text-center">FECHA REGISTRO</th>
						<th class="text-center">N° REGISTRO</th>
                        <th class="text-center">N° OFICIO</th>
						<th class="text-center">ALUMNO</th>
						<th class="text-center">CÓDIGO</th>
						<th class="text-center">ESCUELA</th>
						<th class="text-center" style="width: 7%;">MODALIDAD</th>
						<th class="text-center">SEDE</th>
						<th class="text-center">NRO ATENCION</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center" style="width: 10%;">OBSERVACION</th>
                        <th class="text-center" style="width: 6%;">FECHA ATENCION</th>
						<th class="text-center" style="display: none;">CELULAR</th>
						<th class="text-center" style="display: none;">CORREO</th>
						<th class="text-center" style="display: none;">DNI</th>
						<th class="text-center">ACCION</th>
					</tr>
				</thead>
				<tbody class="text-center" style='font-size: 12px;'><!--este id="tablaconfor" es para el buscador-->
					<?php  

					$sql = "SELECT r.tipo,r.fechrecepcion,r.nregistro,r.noficio,r.alumno,r.codigo,e.nombresc,m.descmod,s.descripsede,r.atencion,r.estado, r.observacion,r.fechenvio,r.celular,r.correo,r.dni
							FROM registro r 
							INNER JOIN escuela e ON r.idescuela = e.idescuela 
							INNER JOIN sede s ON r.idsede = s.idsede 
							INNER JOIN modalidad m ON r.idmodalidad = m.idmodalidad;";

					$ejecutar = mysqli_query($conexion, $sql);

					while ($fila = mysqli_fetch_object($ejecutar))
						//mysqli_fetch_array jala los datos de la BD como arrays (esto sirve cuando una tabla tiene nombres con columnas iguales esta es una forma de diferenciarlas ya que si se duplicasa nombre al llamar datos de BD habria errores)

						//mysqli_fetch_object jala los datos pero con los mismos nombres como estan las columnas en la BD 
						{ 
						?>
							<tr>
								<td><?=$fila->tipo?></td>
								<td><?=$fila->fechrecepcion?></td>
								<td><?=$fila->nregistro?></td>
								<td><?=$fila->noficio?></td>
								<td><?=$fila->alumno?></td>
								<td><?=$fila->codigo?></td>
								<td><?=$fila->nombresc?></td>
								<td><?=$fila->descmod?></td>
								<td><?=$fila->descripsede?></td>
								<td><?=$fila->atencion?></td>
								<td><?php if($fila->estado =='PROBLEMA')
									echo '<img src="librerias/img/problem.png" alt="" width="40" height="25">';
									if($fila->estado =='COMPLETO')
									echo '<img src="librerias/img/on.png" alt="" width="40" height="25">';
									if($fila->estado =='OBSERVADO')
									echo '<img src="librerias/img/off.png" alt="" width="40" height="25">';
									if($fila->estado =='REGISTRADO')
									echo '<img src="librerias/img/mediun.png" alt="" width="40" height="25">';
									?>
								</td>
                                <td><?=$fila->observacion?></td>
								<td><?=$fila->fechenvio?></td>
								<td style="display: none;"><?=$fila->celular?></td>
								<td style="display: none;"><?=$fila->correo?></td>
								<td style="display: none;"><?=$fila->dni?></td>
								<td>
								<a href="#" class="btn btn-warning datos" idconfoficio="<?=$fila->idconfoficio?>" style="width: 30px; height: 25px;--bs-btn-padding-y: 0rem;"><i class="fa-solid fa-arrow-right"></i></a>
								</td>
							</tr>							
					<?php }
					?>
				</tbody>
			</table>
			<div class="alert alert-danger" role="alert">Solo se muestra los ultimos 5 registro...  
				<img src="librerias/img/on.png" width="40" height="25"> COMPLETO
				<img src="librerias/img/off.png" width="40" height="25"> OBSERVADO
				<img src="librerias/img/problem.png" width="40" height="25"> PROBLEMA
				<img src="librerias/img/mediun.png" width="40" height="25"> REGISTRADO
			</div>
		</div>
	</div>			
</div>
<div style="margin: 15px; display: flex; flex-wrap: nowrap;">
	<div class="card col-6"  style="margin-bottom: 15px; border-color:rgba(76, 150, 217);">
		<div class="card-header" style="background-color: rgba(76, 150, 217);">
			<H5 style="color: #FFFF;">Datos de Contacto</H5>
		</div>
		<div class="card-body text-center">
			<form method="POST">
				<div class="row">			
					<div class="col-sm-6">
						<div class="input-field">
							<input type="text" name="celular" id="celular" placeholder="Celular" class="form-control" disabled >
						</div>
					</div>
                    <div class="col-sm-6">
						<input type="text" name="dni" id="dni" placeholder="DNI" class="form-control" autocomplete="off" disabled >
                    </div>
					<div class="col-sm-12">
						<div class="input-field">
							<input type="text" name="correo" id="correo" placeholder="Correo" class="form-control" disabled>
						</div>
					</div>
				</div>
			</form>
		</div>		
	</div>					
</div>

<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!--SCRIPT llamado DATATABLE-->
<script>
	$(document).ready(function(){
		$('#tablabusqueda').DataTable({ 
				"destroy":true,
				"lengthMenu" : [7, 15, 20, 30],
				"info":false,
				"ordering":false,
				"order": [[ 0, "desc" ]], //or asc 
				
				dom: 'Bfrtip',//desaparece la casilla de filtro 5-10-15...
				buttons: 
				[
					//'copy','excel', 'pdf'
					{	
						extend: 'excelHtml5',
						text: '<i class="fa-regular fa-file-excel"></i>',
						titleAttr: 'Exportar a Excel',
						className: 'btn btn-success'
					},
					{	
						extend: 'pdfHtml5',
						text: '<i class="fa-solid fa-file-pdf"></i>',
						titleAttr: 'Exportar a PDF',
						className: 'btn btn-danger'
					},
					{	
						extend: 'print',
						text: '<i class="fa-solid fa-print"></i>',
						titleAttr: 'Imprimir',
						className: 'btn btn-info'
					},
				],
				/*"ajax":{
				    	"method":"POST",
				    	"url": "controlador/tablaconfor.php"
		    		},
		    		"columns" : 
		    		[
		    			{"data":"idconfoficio"},
		    			{"data":"fechrecepcion"},
						{"data":"nregistro"},
						{"data":"alumno"},
						{"data":"codigo"},
						{"data":"nombresc"},
						{"data":"modalidad"},
						{"data":"descripsede"},
						{"data":"estado"},
						{"defaultContent":"<a class='btn btn-warning' style='width: 30px; height: 35px;'><i class='material-symbols-outlined'>edit</i></a><a class='btn btn-danger' style='width: 30px; height: 35px;' name='deleteconfor'><i class='material-symbols-outlined'>delete</i></a>"}
		    		]*/
		});
		$('.dataTables_filter input[type="search"]').css({'width':'500px','height':'40px','display':'inline-block'});
	});
</script>
<!--SCRIPT JALAR DATOS A FORMULARIO-->
<script>
	$(document).ready(function(){
		
		$("body").on("click",".datos",function(e){
			e.preventDefault();
			var idconfoficio=$(this).attr("idconfoficio");
			$("#idconfoficio").val(idconfoficio);

			var fila=$(this);
			
			var celular=fila.closest("tr").find("td:eq(13)").text();
			$("#celular").val(celular);

			var dni=fila.closest("tr").find("td:eq(15)").text();
			$("#dni").val(dni);

			var correo=fila.closest("tr").find("td:eq(14)").text();
			$("#correo").val(correo);
			
		});
	});
</script>
</body>
</html>
