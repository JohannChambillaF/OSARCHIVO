function agregar_datos(){

	var datos = $("#frm_registrar").serialize();

	$.ajax({
		method: "POST",
		url: "controlador/insertconfor.php",
		data: datos,

		success: function(e){

			if (e==1){
				
				alert('registro exitoso');
				$('#tabla').load('proyecto/conformidad.php #tabla');
				$('#frm_registrar').trigger('reset');
				
			}else{
				alert('error de registro');
			}
		}
	});

	return false;
}