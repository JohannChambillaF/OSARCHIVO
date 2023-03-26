<?php 
	include '../conexion/conexion.php';
 ?>

<body>
	<div class="w3-container" style="margin: 15px;">
		<div class="card col-md-5"  style="margin-bottom: 15px;">
			<div class="card">
				<div class="card-header" style="color: #FFFF;"><H5>Registro Conformidades</H5></div>
				<div class="card-body text-center">
					<form method="POST" id="frm_registrar">
						<input type="hidden" name="confor" id="confor" value="CONFORMIDAD">	
						
						<div class="input-field">
							<input type="date" name="fecreg" id="fecreg" class="form-control">
						</div>
						<div class="input-field">
							<input type="text" name="numreg" id="numreg" placeholder="Nro Registro" class="form-control">
						</div>
						<div class="input-field">
							<input type="text" name="alumno" id="alumno" placeholder="Alumno" class="form-control">
						</div>
						<div class="input-field">
							<input type="text" name="codigo" id="codigo" placeholder="Código" class="form-control">	
						</div>
						<div class="input-field">
							<select name="escuela" id="escuela" class="form-select">
								<?php 
									$sql=$conexion->query("SELECT * FROM escuela");
									while ($esc=mysqli_fetch_array($sql))
									{
										$id=$esc['idescuela'];
										$nomesc=$esc['nombresc'];
									?>
									
									<option value="<?=$id?>"><?=$nomesc?></option>
									<?php
									}

								?>
							</select>
						</div>
						<div class="input-field">
							<select name="modalidad" id="modalidad" class="form-select">
								
								<option value="ORDINARIO">ORDINARIO</option>
								<option value="EXTRAORDINARIO">EXTRAORDINARIO</option>
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
									
									<option value="<?=$id?>"><?=$nomsed?></option>
									<?php
									}

								?>
							</select>
						</div>
						<div class="input-field">
							<input type="text" name="celular" value="" id="celular" placeholder="Celular" class="form-control">	
						</div>
						<div class="input-field">
							<input type="text" name="correo" value="" id="correo" placeholder="Correo" class="form-control">	
						</div>
						<div class="input-field">
							<input type="text" name="dni" value="" id="dni" placeholder="DNI" class="form-control">	
						</div>
						
						<div class="input-field">
							<label for=""></label>
							<button type="submit" class="btn btn-primary" name="btn_guardar" id="btn_guardar">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" style="color: #FFFF;"><H5>Lista Conformidades</H5></div>
			<div class="card-body text-center">
				<table class="table table-striped table-bordered" align="vertical" id="tabla">
					<thead class="table-primary" style='font-size: 12px; color: #626161;'>
						<tr>
							<th class="text-center">F REGISTRO</th>
							<th class="text-center">N° REGISTRO</th>
							<th class="text-center">ALUMNO</th>
							<th class="text-center">CÓDIGO</th>
							<th class="text-center">ESCUELA</th>
							<th class="text-center">MODALIDAD</th>
							<th class="text-center">SEDE</th>
							<th class="text-center">ESTADO</th>
							<th class="text-center" style="width: 10%;">ACCION</th>
						</tr>
					</thead>

					<tbody style='font-size: 12px;'>
					<?php  

						$sql = "SELECT r.fechrecepcion,r.nregistro,r.alumno,r.codigo,e.nombresc,r.modalidad,s.descripsede,r.celular,r.correo,r.dni,r.estado 
							FROM registro r 
						    INNER JOIN escuela e ON r.idescuela = e.idescuela
						    INNER JOIN sede s ON r.idsede = s.idsede 
						    ORDER BY idconfoficio DESC";

						$ejecutar = mysqli_query($conexion, $sql);

						while ($fila =mysqli_fetch_array($ejecutar))
							//mysqli_fetch_array jala los datos de la BD como arrays (esto sirve cuando una tabla tiene nombres con columnas iguales esta es una forma de diferenciarlas ya que si se duplicasa nombre al llamar datos de BD habria errores)

							//mysqli_fetch_object jala los datos pero con los mismos nombres como estan las columnas en la BD 
						  	{ 
						  	?>
						  		<tr>
						  			<td><?=$fila[0]?></td>
						  			<td><?=$fila[1]?></td>
									<td><?=$fila[2]?></td>
									<td><?=$fila[3]?></td>
									<td><?=$fila[4]?></td>
									<td><?=$fila[5]?></td>
									<td><?=$fila[6]?></td>
									<td><?=$fila[10]?></td>
									<td>
							      	<a href="" class="btn btn-warning" style="width: 30px; height: 35px;"><i class="material-symbols-outlined">edit</i></a>
							      	
							      	<a href="" class="btn btn-danger" style="width: 30px; height: 35px;"><i class="material-symbols-outlined">delete</i></a>
							      </td>
									
								</tr>
					  <?php }

					?>
					</tbody>
				</table>
			</div>
		</div>			
	</div>
<!--SCRIPT agregar_datos()-->
<script> 
$(document).ready(function(){
	$("#btn_guardar").on('click', function(e){//hace referencia a la accion de prescionar el boton

		e.preventDefault();//esto sirve para que la pagina no se recargue
		agregar_datos();//esta llamando a la funcion creada en funciones.js
	});
});	
</script>
<script>
	$(document).ready(function () {
    $('#tabla').DataTable({
    	"pageLength": 5
    });
});
</script>
</body>
</html>
