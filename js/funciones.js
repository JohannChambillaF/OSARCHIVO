function agregar_datos(){ 
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
			}else{
				$("#tabla").find("."+id).html(res);
			}
			$("#btn_guardar").text("Add User");
		}
	});
}
/*function agregar_datos(){

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
}*/