function agregar_datos(){

	var datos = $("#frm_registrar").serialize();

	$.ajax({
		
		method: "POST",
		url: "controlador/insertconfor.php",
		data: datos,

		success: function(e){

			if (e==1){
				
				alert('registro exitoso');
				$('#frm_registrar').trigger('reset');
				$('#tabla').load('proyecto/conformidad.php #tabla');

			}else{
				alert('error de registro');
			}
		}
	});

	return false;
}
function agregar_datos_oficio(){

	var datos = $("#frm_registrar_oficio").serialize();

	$.ajax({
		
		method: "POST",
		url: "controlador/insertconfor.php",
		data: datos,

		success: function(e){

			if (e==1){
				
				alert('registro exitoso');
				$('#frm_registrar_oficio').trigger('reset');
				$('#tabla').load('proyecto/conformidad.php #tabla');

			}else{
				alert('error de registro');
			}
		}
	});

	return false;
}
/*function pagination(partida){
	//alert('holaa');
	$.ajax({
		method: 'POST',
		url: 'controlador/paginar.php',
		data: 'partida=' +partida,
		success: function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}*/