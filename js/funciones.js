function agregar_actuali_confor(){ 
	var btn=$(this);
	var id=$("#idconfoficio").val();

	$.ajax({
		type:'POST',
		url:'controlador/insertconfor.php',
		data:$("#frm_registrar").serialize(),
		beforeSend:function(){
			$(btn).text("Wait...");
		},
		success:function(res){
			
			var id=$("#idconfoficio").val();
			
			if(id=="0"){
				$("#tabla").find("tbody").append(res);
				alert('registro exitoso');
				$('#frm_registrar').trigger('reset');
				$('#tabla').load('proyecto/conformidad.php #tabla');
			}else{
				$("#tabla").find("."+id).html(res);
				alert('registro actualizado');
				$('#frm_registrar').trigger('reset');
				$('#tabla').load('proyecto/conformidad.php #tabla');
				$("#btn_guardar_actual").text("Guardar");
				$("#btn_guardar_actual").css("btn-secondary");
			}
		}
	});
}
function agregar_actuali_oficio(){
	var btn=$(this);
	var id=$("#idconfoficio").val();

	$.ajax({
		type:'POST',
		url:'controlador/insertofic.php',
		data:$("#frm_registrar_oficio").serialize(),
		beforeSend:function(){
			$(btn).text("Wait...");
		},
		success:function(res){
			
			var id=$("#idconfoficio").val();
			
			if(id=="0"){
				$("#tablaofic").find("tbody").append(res);
				alert('registro exitoso');
				$('#frm_registrar_oficio').trigger('reset');
				$('#tablaofic').load('proyecto/oficio.php #tablaofic');
			}else{
				$("#tablaofic").find("."+id).html(res);
				alert('registro actualizado');
				$('#frm_registrar_oficio').trigger('reset');
				$('#tablaofic').load('proyecto/oficio.php #tablaofic');
				$("#btn_guardar_ofic").text("Guardar");
				$("#btn_guardar_ofic").css("btn-secondary");
			}
		}
	});
}
function conf_completo(){

	var datos = $('#frm_conf_atencion').serialize();
	var id=$("#idconfoficio").val();

	$.ajax({
		type:'POST',
		url:'controlador/actualicompleto.php',
		data:datos,
		success:function(res){
			
			if (res==1){
				alert('registro actualizado');
				$('#frm_conf_atencion').trigger('reset');
				$('#tablatenc').load('proyecto/revisarconfor.php #tablatenc');
				$('#tablaconfcomp').load('proyecto/revisarconfor.php #tablaconfcomp');

			}else{
				alert('Error de registro');
				$('#frm_conf_atencion').trigger('reset');
				$('#tablatenc').load('proyecto/revisarconfor.php #tablatenc');
				$('#tablaconfcomp').load('proyecto/revisarconfor.php #tablaconfcomp');
			}

			/*
			var id=$("#idconfoficio").val();
			
			if(id=="0"){
				alert('registro NO actualizado ERROR');
			}else{
				$("#tablatenc").find("."+id).html(res);
				alert('registro actualizado');
				$('#frm_conf_atencion').trigger('reset');
				$('#tablatenc').load('proyecto/revisarconfor.php #tablatenc');
				$('#tablaconfcomp').load('proyecto/revisarconfor.php #tablaconfcomp');
			}*/
		}
	});
}
function conf_filtro(){
	var f_ingreso = $('input[name=fecha_ingreso]').val();
	var f_fin = $('input[name=fechaFin]').val();
	console.log(f_ingreso + '' + f_fin);

	if(f_ingreso !="" && f_fin !="")
		{
			$.post("controlador/filtroconfor.php", {f_ingreso, f_fin}, function (data) {
				$(".resultado").html(data);
				$("#loaderFiltro").html('<div class="alert alert-success" style="height: 30px;padding: 1px;">Registros encontrados</div>');
			});  
		}else{
			$("#loaderFiltro").html('<div class="alert alert-danger" style="height: 30px;padding: 1px;">Registros NO encontrados</div>');
		}
}