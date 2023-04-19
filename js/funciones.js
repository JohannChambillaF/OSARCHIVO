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