function CargarBusqueda(){
	$.get('proyecto/busqueda.php', function(e){
		$('#resultado').html(e);
	})
}
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