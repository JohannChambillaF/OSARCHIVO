function CargarConformidad(){
	$.get('proyecto/conformidad.php', function(e){
		$('#resultado').html(e);
	})
}
function CargarOficio(){
	$.get('proyecto/oficio.php', function(e){
		$('#resultado').html(e);
	})
}