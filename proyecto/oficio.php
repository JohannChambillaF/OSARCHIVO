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
			<form method="POST" id="frm_regoficio">
				<div class="row">
					<div class="col-sm-6">
						<input type="hidden" class="form-control" name='idconfoficio' id='idconfoficio' value="0">
						<input type="hidden" name="ofic" id="ofic" value="OFICIO">
						<input type="hidden" name="estado" id="estado" value="REGISTRADO">						
						<div class="input-field">
							<input type="date" name="fecreg" id="fecreg" class="form-control">
						</div>
						<div class="input-field">
							<input type="text" name="numreg" id="numreg" placeholder="Nro Registro" class="form-control" autocomplete="off" required>
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
					<button type="submit" class="btnn btn-1" name="btnsaveofic" id="btnsaveofic" style="width: 100%;">GUARDAR</button>
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
			<table class="table table-striped table-bordered" align="vertical" id="tablaofic">
				<thead class="table-primary" style='font-size: 12px; color: #626161;'>
					<tr>
						<th class="text-center" style="display: none;">ID</th>
						<th class="text-center">ESTADO</th>
						<th class="text-center">F REGISTRO</th>
						<th class="text-center">N° REGISTRO</th>
						<th class="text-center">N° OFICIO</th>
						<th class="text-center">ALUMNO</th>
						<th class="text-center">CÓDIGO</th>
						<th class="text-center">ESCUELA</th>
						<th class="text-center">MODALIDAD</th>
						<th class="text-center">SEDE</th>
						<th class="text-center" style="width: 15%;">ACCION</th>
					</tr>
				</thead>
				<tbody class="text-center" style='font-size: 12px;'><!--este id="tablaconfor" es para el buscador-->
				<?php  

					$sql = "SELECT r.idconfoficio ,r.fechrecepcion,r.nregistro,r.noficio,r.alumno,r.codigo,e.nombresc,m.descmod,s.descripsede,r.estado 
					FROM registro r 
					INNER JOIN escuela e ON r.idescuela = e.idescuela
					INNER JOIN sede s ON r.idsede = s.idsede
					INNER JOIN modalidad m ON r.idmodalidad = m.idmodalidad
					WHERE r.tipo = 'OFICIO' && r.estado = 'REGISTRADO'
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
							<td><?=$fila->fechrecepcion?></td>
							<td><?=$fila->nregistro?></td>
							<td><?=$fila->noficio?></td>
							<td><?=$fila->alumno?></td>
							<td><?=$fila->codigo?></td>
							<td><?=$fila->nombresc?></td>
							<td><?=$fila->descmod?></td>
							<td><?=$fila->descripsede?></td>
							<td>
							<a href="#" class="btn btn-warning editofic" idconfoficio="<?=$fila->idconfoficio?>" style="width: 30px; height: 35px;"><i class="material-symbols-outlined">edit</i></a>
							
							<a href="#" class="btn btn-danger delofic" idconfoficio="<?=$fila->idconfoficio?>" style="width: 30px; height: 35px;" id="deleteconfor" name="deleteconfor"><i class="material-symbols-outlined">delete</i></a>
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

<!--SCRIPT agregar_oficios()-->
<script>
	$(document).ready(function(){
		$("#btnsaveofic").on('click', function(e){//hace referencia a la accion de prescionar el boton

			e.preventDefault();//esto sirve para que la pagina no se recargue
			agregar_actuali_oficio();//esta llamando a la funcion creada en funciones.js

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
					url: "controlador/buscarcodigo2.php",
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
<!--SCRIPT eliminar datos-->
<script>
	$(document).ready(function(){
		$("body").on("click",".delofic",function(e){
				e.preventDefault();
				var idconfoficio=$(this).attr("idconfoficio");
				var btn=$(this);
				if(confirm("Are You Sure ? ")){
					$.ajax({
						type:'POST',
						url:'controlador/deleteofic.php',
						data:{id:idconfoficio},
						
						success:function(res){
							if(res){
								btn.closest("tr").remove();
								$('#tablaofic').load('proyecto/oficio.php #tablaofic');
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
		
		$("body").on("click",".editofic",function(e){
			e.preventDefault();
			var idconfoficio=$(this).attr("idconfoficio");
			$("#idconfoficio").val(idconfoficio);

			var fila=$(this);

			var fecreg=fila.closest("tr").find("td:eq(2)").text();
			$("#fecreg").val(fecreg);

			var numreg=fila.closest("tr").find("td:eq(3)").text();
			$("#numreg").val(numreg);

			var numreg=fila.closest("tr").find("td:eq(4)").text();
			$("#noficio").val(numreg);

			var alumno=fila.closest("tr").find("td:eq(5)").text();
			$("#alumno").val(alumno);

			var codigo=fila.closest("tr").find("td:eq(6)").text();
			$("#codigo").val(codigo);

			var escuela=fila.closest("tr").find("td:eq(7)").text();
			$("#escuela option").filter(function() {
			    return $(this).text() == escuela;
			  }).prop("selected", true);
			
			var modalidad=fila.closest("tr").find("td:eq(8)").text();
			$("#modalidad option").filter(function() {
			    return $(this).text() == modalidad;
			  }).prop("selected", true);

			var sede=fila.closest("tr").find("td:eq(9)").text();
			$("#sede option").filter(function() {
			    return $(this).text() == sede;
			  }).prop("selected", true);

			$("#btnsaveofic").text("ACTUALIZAR");
			

		});
	});
</script>
<!--SCRIPT JALAR DATOS DESDE TABLA BUSQUED CODIGO A FORMULARIO--->
<script>
	$(document).ready(function(){
		
		$("body").on("click",".editofic2",function(e){
			e.preventDefault();

			var fila=$(this);

			var alumno=fila.closest("tr").find("td:eq(3)").text();
			$("#alumno").val(alumno);

			var codigo=fila.closest("tr").find("td:eq(4)").text();
			$("#codigo").val(codigo);

			var escuela=fila.closest("tr").find("td:eq(7)").text();
			$("#escuela option").filter(function() {
			    return $(this).text() == escuela;
			  }).prop("selected", true);
			
			var modalidad=fila.closest("tr").find("td:eq(8)").text();
			$("#modalidad option").filter(function() {
			    return $(this).text() == modalidad;
			  }).prop("selected", true);

			var sede=fila.closest("tr").find("td:eq(9)").text();
			$("#sede option").filter(function() {
			    return $(this).text() == sede;
			  }).prop("selected", true);

		});
	});
</script>
</body>
</html>
