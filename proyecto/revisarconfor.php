<?php 
	include '../conexion/conexion.php';
 ?>

<body>
<div style="margin: 15px; display: flex; flex-wrap: nowrap;">
	<div class="card col-6"  style="margin-bottom: 15px; border-color:rgba(76, 150, 217);">
		<div class="card-header" style="background-color: rgba(76, 150, 217);">
			<H5 style="color: #FFFF;">Conformidades para Buscar</H5>
		</div>
		<div class="card-body">
			<form method="POST">
				<div class="row">	
					<div class="col-sm-4">
						<input type="date" name="fecha_ingreso" class="form-control"  placeholder="Fecha de Inicio" required>
					</div>
					<div class="col-sm-4">
						<input type="date" name="fechaFin" class="form-control" placeholder="Fecha Final" required>
					</div>
					<div class="col-sm-4">
						<div class="row">
							<div class="col-4"><button class="btn btn-outline-warning" style="width:70px; height:38px;" id="filtro">Filtrar</button></div>
							<div class="col-8 text-center" >
								<?php
									$sql = "SELECT * FROM registro	WHERE tipo = 'CONFORMIDAD' && estado = 'REGISTRADO'";
									$query = mysqli_query($conexion, $sql);
									$total   = mysqli_num_rows($query);
								?>
								<div style="width:90px; padding:7px;" id="totalfiltro">
									<h6>Regist. <?=$total?></h6>
								</div> 
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="col-sm-12 text-center mt-2" id="loaderFiltro">     
            </div>
            <table class="table table-bordered resultado" align="vertical" id="tablatenc" style="margin-top: 15px;">
				<thead class="table-primary" style='font-size: 11px; color: #626161;'>
					<tr>
						<th class="text-center" style="display: none;">ID</th>
						<th class="text-center">ESTADO</th>
						<th class="text-center">ALUMNO</th>
						<th class="text-center">ESCUELA</th>
						<th class="text-center">MODALIDAD</th>
						<th class="text-center">SEDE</th>
						<th class="text-center" style="width: 15%;">FECHA REGIS</th>
						<th class="text-center" style="display: none;">FECHA ENVIO</th>
						<th class="text-center" style="display: none;">NRO ATENCION</th>
						<th class="text-center" style="display: none;">UBICACION</th>
						<th class="text-center" style="display: none;">OBSERVACION</th>
						<th class="text-center" style="width: 10%;">ACCION</th>
					</tr>
				</thead>
				<tbody class="text-center" style='font-size: 11px;'><!--este id="tablaconfor" es para el buscador-->
					<?php  

					$sql = "SELECT r.idconfoficio ,r.alumno,e.nombresc,m.descmod,s.descripsede,r.estado,r.fechrecepcion,r.fechenvio, r.atencion, r.observacion, r.ubicacion 
						FROM registro r 
						INNER JOIN escuela e ON r.idescuela = e.idescuela
						INNER JOIN sede s ON r.idsede = s.idsede
						INNER JOIN modalidad m ON r.idmodalidad = m.idmodalidad
						WHERE r.tipo = 'CONFORMIDAD' && r.estado = 'REGISTRADO'
						ORDER BY idconfoficio DESC LIMIT 7";

					$ejecutar = mysqli_query($conexion, $sql);

					while ($fila =mysqli_fetch_object($ejecutar))
						//mysqli_fetch_array jala los datos de la BD como arrays (esto sirve cuando una tabla tiene nombres con columnas iguales esta es una forma de diferenciarlas ya que si se duplicasa nombre al llamar datos de BD habria errores)

						//mysqli_fetch_object jala los datos pero con los mismos nombres como estan las columnas en la BD 
						{ 
						?>
							<tr>
								<td style="display: none;"><?=$fila->idconfoficio?></td>
								<?php 
									if($fila->estado =='REGISTRADO')
									echo '<td><img src="librerias/img/mediun.png" alt="" width="40" height="25"></td>';
									if($fila->estado =='COMPLETO')
									echo '<td><img src="librerias/img/on.png" alt="" width="40" height="25"></td>';
									if($fila->estado =='OBSERVADO')
									echo '<td><img src="librerias/img/off.png" alt="" width="40" height="25"></td>';
								?>
								<td><?=$fila->alumno?></td>
								<td><?=$fila->nombresc?></td>
								<td><?=$fila->descmod?></td>
								<td><?=$fila->descripsede?></td>
								<td><?=$fila->fechrecepcion?></td>
								<td style="display: none;"><?=$fila->fechenvio?></td>
								<td style="display: none;"><?=$fila->atencion?></td>
								<td style="display: none;"><?=$fila->ubicacion?></td>
								<td style="display: none;"><?=$fila->observacion?></td>
								<td>
								<a href="#" class="btn btn-success verifconfor" idconfoficio="<?=$fila->idconfoficio?>" style="width: 30px; height: 25px;--bs-btn-padding-y: 0rem;"><i class="fa-solid fa-arrow-right"></i></a>
								</td>
								
							</tr>							
					<?php }
					?>
				</tbody>
			</table>
		</div>		
	</div>
	<div class="card col-6 ms-2"  style="margin-bottom: 15px; border-color:rgba(76, 150, 217);">
		<div class="card-header" style="background-color: rgba(76, 150, 217);"><H5 style="color: #FFFF;">Cumplimiento de Requisitos</H5>
		</div>
		<div class="card-body">
            <form method="POST" id="frm_conf_atencion">
				<div class="row">
					<div class="col-sm-6">
						<input type="hidden" class="form-control" name='idconfoficio' id='idconfoficio' value="0">
						<input type="hidden" name="estado" id="estado">					

						<div class="input-field">
							<input type="text" name="alumno" id="alumno" placeholder="Alumno" class="form-control" >
						</div>
						<div class="input-field">
							<select name="escuela" id="escuela" class="form-select" >
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
							<input type="date" name="fecaten" id="fecaten" class="form-control">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="input-field">
							<select name="modalidad" id="modalidad" class="form-select" >
								<?php 
									$sql=$conexion->query("SELECT * FROM modalidad");
									while ($esc=mysqli_fetch_array($sql))
									{
										$idmod=$esc['idmodalidad'];
										$descrip=$esc['descmod'];
									?>
									<option hidden selected>Seleccione una Modalidad</option>
									<option value="<?=$idmod?>"><?=$descrip?></option>
									<?php
									}
								?>
							</select>
						</div>
						<div class="input-field">
							<select name="sede" id="sede" class="form-select" >
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
						<div class="input-field">
							<input type="text" name="numate" id="numate" placeholder="Nro Atención" class="form-control" autocomplete="off">
						</div>
					</div>
                    <div class="col-sm-12">
						<input type="text" name="ubicexp" id="ubicexp" placeholder="¿EN DONDE SE UBICA?" class="form-control" autocomplete="off">
						<textarea class="form-control" style="margin-top: 5px;" id="observ" name="observ" rows="3" placeholder="OBSERVACIONES"></textarea>
                    </div>
				</div>
				<div class="form-group" style="text-align: center;">
					<input class="option-input radio" type="radio" name="estado" value="OBSERVADO">
					<label class="form-check-label" for="inlineRadio1">OBSERVADO</label>
					<input class="option-input radio" type="radio" name="estado" value="COMPLETO">
					<label class="form-check-label" for="inlineRadio2">COMPLETO</label>
					<input class="option-input radio" type="radio" name="estado" value="PROBLEMA">
					<label class="form-check-label" for="inlineRadio2">PROBLEMA</label>
				</div>
				<div class="input-field" style="text-align:right">
					<button type="submit" class="btnn btn-1" style="width: 100%; margin-top: 20px;" name="btn_confcompleto" id="btn_confcompleto">GUARDAR</button>
				</div>
			</form>		
		</div>
	</div>							
</div>
<div class="w3-container" style="margin: 15px;">
	<div class="card" style="border-color:rgba(76, 150, 217);">
		<div class="card-header" style="background-color: rgba(76, 150, 217);"><H5 style="color: #FFFF;">XXXX CAMPO LIBRE</H5></div>
		<div class="card-body">
			<table class="table table-striped table-bordered" align="vertical" id="tablaconfcomp">
				<thead class="table-primary" style='font-size: 12px; color: #626161;'>
					<tr>
						<th class="text-center" style="display: none;">ID</th>
						<th class="text-center">ESTADO</th>
						<th class="text-center">FECHA REGISTRO</th>
						<th class="text-center">N° REGISTRO</th>
						<th class="text-center" style="width: 13%;">ALUMNO</th>
						<th class="text-center">CÓDIGO</th>
						<th class="text-center">ESCUELA</th>
						<th class="text-center" style="width: 13%;">MODALIDAD</th>
						<th class="text-center">SEDE</th>
						<th class="text-center">FECHA ATENCION</th>
						<th class="text-center">NRO ATENCION</th>
						<th class="text-center">UBICACION</th>
						<th class="text-center">OBSERVACION</th>
						<th class="text-center" style="width: 7%;">ACCION</th>
					</tr>
				</thead>
				<tbody class="text-center" style='font-size: 12px;'><!--este id="tablaconfor" es para el buscador-->
					<?php  

					$sql = "SELECT r.idconfoficio ,r.fechrecepcion,r.nregistro,r.alumno,r.codigo,e.nombresc,m.descmod,s.descripsede,r.estado,r.fechenvio, r.atencion, r.ubicacion, r.observacion 
						FROM registro r 
						INNER JOIN escuela e ON r.idescuela = e.idescuela
						INNER JOIN sede s ON r.idsede = s.idsede
						INNER JOIN modalidad m ON r.idmodalidad = m.idmodalidad
						WHERE r.tipo = 'CONFORMIDAD' && r.estado != 'REGISTRADO' 
						ORDER BY fechenvio DESC LIMIT 5";

					$ejecutar = mysqli_query($conexion, $sql);

					while ($fila =mysqli_fetch_object($ejecutar))
						//mysqli_fetch_array jala los datos de la BD como arrays (esto sirve cuando una tabla tiene nombres con columnas iguales esta es una forma de diferenciarlas ya que si se duplicasa nombre al llamar datos de BD habria errores)

						//mysqli_fetch_object jala los datos pero con los mismos nombres como estan las columnas en la BD 
						{ 
						?>
							<tr>
								<td style="display: none;"><?=$fila->idconfoficio?></td>
								<?php 
									if($fila->estado =='PROBLEMA')
										echo '<td><img src="librerias/img/problem.png" alt="" width="40" height="25"></td>';
									if($fila->estado =='COMPLETO')
									echo '<td><img src="librerias/img/on.png" alt="" width="40" height="25"></td>';
									if($fila->estado =='OBSERVADO')
									echo '<td><img src="librerias/img/off.png" alt="" width="40" height="25"></td>';
								?>
								<td><?=$fila->fechrecepcion?></td>
								<td><?=$fila->nregistro?></td>
								<td><?=$fila->alumno?></td>
								<td><?=$fila->codigo?></td>
								<td><?=$fila->nombresc?></td>
								<td><?=$fila->descmod?></td>
								<td><?=$fila->descripsede?></td>
								<td><?=$fila->fechenvio?></td>
								<td><?=$fila->atencion?></td>
								<td><?=$fila->ubicacion?></td>
								<td><?=$fila->observacion?></td>
								<td>
								<a href="#" class="btn btn-warning edit" idconfoficio="<?=$fila->idconfoficio?>" style="width: 30px; height: 35px;"><i class="material-symbols-outlined">edit</i></a>
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
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--SCRIPT agregar y actualizar datos-->
<script>
	$(document).ready(function(){
		$("#btn_confcompleto").on('click', function(e){//hace referencia a la accion de prescionar el boton

			e.preventDefault();//esto sirve para que la pagina no se recargue
			conf_completo();//esta llamando a la funcion creada en funciones.js

		});
	});	
</script>
<!--SCRIPT eliminar datos-->
<script>
	$(document).ready(function(){
		$("body").on("click",".del",function(e){
				e.preventDefault();
				var idconfoficio=$(this).attr("idconfoficio");
				var btn=$(this);
				if(confirm("Are You Sure ? ")){
					$.ajax({
						type:'POST',
						url:'controlador/deleteconfor.php',
						data:{id:idconfoficio},
						
						success:function(res){
							if(res){
								btn.closest("tr").remove();
							}
						}
					});
				}
			});
	});	
</script>
<!--SCRIPT JALAR DATOS A FORMULARIO-->
<script>
	$(document).ready(function(){
		
		$("body").on("click",".verifconfor",function(e){
			e.preventDefault();
			var idconfoficio=$(this).attr("idconfoficio");
			$("#idconfoficio").val(idconfoficio);

			var fila=$(this);
			
			var alumno=fila.closest("tr").find("td:eq(2)").text();
			$("#alumno").val(alumno);

			var escuela=fila.closest("tr").find("td:eq(3)").text();
			$("#escuela option").filter(function() {
			    return $(this).text() == escuela;
			  }).prop("selected", true);
			
			var modalidad=fila.closest("tr").find("td:eq(4)").text();
			$("#modalidad option").filter(function() {
			    return $(this).text() == modalidad;
			  }).prop("selected", true);

			var sede=fila.closest("tr").find("td:eq(5)").text();
			$("#sede option").filter(function() {
			    return $(this).text() == sede;
			  }).prop("selected", true);

			var fechenvio=fila.closest("tr").find("td:eq(7)").text();
			$("#fecaten").val(fechenvio);

			var natencion=fila.closest("tr").find("td:eq(8)").text();
			$("#numate").val(natencion);
			
			var ubic=fila.closest("tr").find("td:eq(9)").text();
			$("#ubicexp").val(ubic);
			
			var observac=fila.closest("tr").find("td:eq(10)").text();
			$("#observ").val(observac);
		});
	});
</script>
<script>
	$(document).ready(function(){
		
		$("body").on("click",".edit",function(e){
			e.preventDefault();
			var idconfoficio=$(this).attr("idconfoficio");
			$("#idconfoficio").val(idconfoficio);

			var fila=$(this);
			
			var alumno=fila.closest("tr").find("td:eq(4)").text();
			$("#alumno").val(alumno);

			var escuela=fila.closest("tr").find("td:eq(6)").text();
			$("#escuela option").filter(function() {
			    return $(this).text() == escuela;
			  }).prop("selected", true);
			
			var modalidad=fila.closest("tr").find("td:eq(7)").text();
			$("#modalidad option").filter(function() {
			    return $(this).text() == modalidad;
			  }).prop("selected", true);

			var sede=fila.closest("tr").find("td:eq(8)").text();
			$("#sede option").filter(function() {
			    return $(this).text() == sede;
			  }).prop("selected", true);

			var fechenvio=fila.closest("tr").find("td:eq(9)").text();
			$("#fecaten").val(fechenvio);

			var natencion=fila.closest("tr").find("td:eq(10)").text();
			$("#numate").val(natencion);
			
			var ubic=fila.closest("tr").find("td:eq(11)").text();
			$("#ubicexp").val(ubic);
			
			var observac=fila.closest("tr").find("td:eq(12)").text();
			$("#observ").val(observac);
		});
	});
</script>
<!--SCRIPT FILTRO-->
<script>
	$(document).ready(function(){
		$("#filtro").on('click', function(e){//hace referencia a la accion de prescionar el boton

			e.preventDefault();//esto sirve para que la pagina no se recargue
			conf_filtro();//esta llamando a la funcion creada en funciones.js

		});
	});
</script>
</body>
</html>
