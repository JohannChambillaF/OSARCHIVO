<?php 
	include '../conexion/conexion.php';
 ?>

<body>
<div style="margin: 15px; display: flex; flex-wrap: nowrap;">
	<div class="card col-6"  style="margin-bottom: 15px; border-color:rgb(115 199 101);">
		<div class="card-header" style="background-color: rgb(115 199 101);">
			<H5 style="color: #FFFF;">Registro Oficio</H5>
		</div>
		<div class="card-body text-center">
			<form method="POST" id="frm_registrar">
				<div class="row">
					<div class="col-sm-6">
						<input type="hidden" name="confor" id="confor" value="OFICIO">					
						<div class="input-field">
							<input type="date" name="fecreg" id="fecreg" class="form-control">
						</div>
						<div class="input-field">
							<input type="text" name="numreg" id="numreg" placeholder="Nro Registro" class="form-control" autocomplete="off">
						</div>
                        <div class="input-field">
							<input type="text" name="noficio" id="noficio" placeholder="Nro Oficio" class="form-control" autocomplete="off">
						</div>
						<div class="input-field">
							<input type="text" name="alumno" id="alumno" placeholder="Alumno" class="form-control" autocomplete="off">
						</div>
						
					</div>
					<div class="col-sm-6">
                    <div class="input-field" style="display: flex; flex-wrap: nowrap;">
							<input type="text" name="codigo" id="codigo" placeholder="Código" class="form-control" autocomplete="off">	
						</div>
						<div class="input-field">
							<select name="escuela" id="escuela" class="form-select" required>
								<?php 
									$sql=$conexion->query("SELECT * FROM escuela");
									while ($esc=mysqli_fetch_array($sql))
									{
										$id=$esc['idescuela'];
										$nomesc=$esc['nombresc'];
									?>
									<option hidden selected>Seleccione una Escuela</option>
									<option value="<?=$id?>"><?=$nomesc?></option>
									<?php
									}
								?>
							</select>
						</div>
						<div class="input-field">
						<select name="modalidad" id="modalidad" class="form-select">
							<?php 
									$sql=$conexion->query("SELECT * FROM modalidad");
									while ($esc=mysqli_fetch_array($sql))
									{
										$idmod=$esc['idmodalidad'];
										$descrip=$esc['descripcion'];
									?>
									<option hidden selected>Seleccione una Modalidad</option>
									<option value="<?=$idmod?>"><?=$descrip?></option>
									<?php
									}
								?>
							</select>
						</div>
						<div class="input-field">
							<select name="sede" id="sede" class="form-select">
								<?php 
									$sql=$conexion->query("SELECT * FROM sede");
									while ($sed=mysqli_fetch_array($sql))
									{
										$id=$sed['idsede'];
										$nomsed=$sed['descripsede'];
									?>
									<option hidden selected>Seleccione una Sede</option>
									<option value="<?=$id?>"><?=$nomsed?></option>
									<?php
									}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="input-field">
					<button type="submit" class="btn btn-secondary btn-block" name="btn_guardar" id="btn_guardar" style="width: 100%;">Guardar</button>
				</div>
			</form>
			
		</div>		
	</div>
	<div class="card col-6 ms-2"  style="margin-bottom: 15px; border-color:rgb(115 199 101);">
		<div class="card-header" style="background-color: rgb(115 199 101);"><H5 style="color: #FFFF;">Validación Expediente</H5>
		</div>
		<div class="card-body text-center">
			<div id="buscacodigo"></div>			
		</div>
	</div>							
</div>
<div class="w3-container" style="margin: 15px;">
	<div class="card" style="border-color:rgb(115 199 101);">
		<div class="card-header" style="background-color: rgb(115 199 101);"><H5 style="color: #FFFF;">Lista Conformidades</H5></div>
		<div class="card-body">
			<!--<form method="POST" id="frm_bustabla"> ESTE ES EL BUSCADORRRRRRRRRRRR
				<div class="input-field">
					<input type="text" name="busctabla" id="busctabla" placeholder="Buscar..." class="form-control" autocomplete="off" style="width: 20%;">
				</div>
			</form>
			<div class="registros" id="agrega-registros"></div>
			<center>
				<ul class="pagination" id="pagination"></ul>
			</center>-->
			<table class="table table-striped table-bordered" align="vertical" id="tabla">
				<thead class="table-primary" style='font-size: 12px; color: #626161;'>
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
				</thead>
				<tbody class="text-center" style='font-size: 12px;'><!--este id="tablaconfor" es para el buscador-->
					<?php  

					$sql = "SELECT r.idconfoficio,r.fechrecepcion,r.nregistro,r.alumno,r.codigo,e.nombresc,r.modalidad,s.descripsede,r.celular,r.correo,r.dni,r.estado 
						FROM registro r 
						INNER JOIN escuela e ON r.idescuela = e.idescuela
						INNER JOIN sede s ON r.idsede = s.idsede
						ORDER BY idconfoficio DESC LIMIT 7";

					$ejecutar = mysqli_query($conexion, $sql);

					while ($fila =mysqli_fetch_array($ejecutar))
						//mysqli_fetch_array jala los datos de la BD como arrays (esto sirve cuando una tabla tiene nombres con columnas iguales esta es una forma de diferenciarlas ya que si se duplicasa nombre al llamar datos de BD habria errores)

						//mysqli_fetch_object jala los datos pero con los mismos nombres como estan las columnas en la BD 
						{ 
						?>
							<tr id="<?=$fila[0]?>">
								<td><?=$fila[0]?></td>
								<td><?=$fila[1]?></td>
								<td><?=$fila[2]?></td>
								<td><?=$fila[3]?></td>
								<td><?=$fila[4]?></td>
								<td><?=$fila[5]?></td>
								<td><?=$fila[6]?></td>
								<td><?=$fila[7]?></td>
								<td><?=$fila[11]?></td>
								<td>
								<a href="" class="btn btn-warning" style="width: 30px; height: 35px;"><i class="material-symbols-outlined">edit</i></a>
								
								<a href="" class="btn btn-danger" style="width: 30px; height: 35px;" name="deleteconfor" value="<?=$fila[0]?>;"><i class="material-symbols-outlined">delete</i></a>
								</td>
								
							</tr>							
					<?php }
					?>
				</tbody>
			</table>
			<div class="alert alert-danger" role="alert">Solo se muestra los ultimos 7 registros... Para confirmar que se guardo en la BD</div>
		</div>
	</div>			
</div>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!--SCRIPT agregar_datos()-->
<script>
	$(document).ready(function(){
		$("#btn_guardar").on('click', function(e){//hace referencia a la accion de prescionar el boton

			e.preventDefault();//esto sirve para que la pagina no se recargue
			agregar_datos();//esta llamando a la funcion creada en funciones.js

		});
	});	
</script>
<!--SCRIPT BUSQUEDA DE CODIGO-->
<script>
	$(document).ready(function () {

		$("#codigo").keyup(function(){
			var input = $(this).val();
			//alert(input);

			if(input != ""){
				$.ajax({
					url: "controlador/buscarcodigo.php",
					method: "POST",
					data:{input:input}, 

					success:function(data){
						$("#buscacodigo").html(data);
						$("#buscacodigo").css("display","block");
					}
				});
			}else{
				$("#buscacodigo").css("display","none"); 
			}


		});
	});
</script>
<!--SCRIPT llamado DATATABLE-->
<!--
<script>
	$(document).ready(function(){
		$('#tabla').DataTable({ 
				"destroy":true,
				"lengthMenu" : [5 ,10, 15, 20],
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
	});
</script>-->
<!--SCRIPT BUSQUEDA DE TABLA CONFORMIDAD-->
<!--
<script>
	$(document).ready(function(){
		$("#busctabla").on("keyup", function() {
			var value = $(this).val().toLowerCase();
		$("#tablaconfor tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	</script>-->
<!--SCRIPT DE TABLA CONFORMIDAD 02-->
<!--
<script type="text/javascript">
		$(document).ready(pagination(1));
	</script>-->
</body>
</html>
